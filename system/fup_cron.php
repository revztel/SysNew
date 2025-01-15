<?php
// fup_cron.php

include __DIR__ . '/../config.php';

// Function to write logs
function writeLog($message) {
    $logFile = 'fup_cron.log';
    $date = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$date] $message" . PHP_EOL, FILE_APPEND);
}

// Include the PEAR2 Autoload file
require __DIR__ . '/../system/autoload/PEAR2/Autoload.php';
use PEAR2\Net\RouterOS;

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    writeLog('Database connection successful');
} catch (PDOException $e) {
    writeLog('Database connection failed: ' . $e->getMessage());
    die('Connection failed: ' . $e->getMessage());
}

// Fetch and set the timezone from tbl_appconfig
try {
    $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'timezone'");
    $stmt->execute();
    $timezoneResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($timezoneResult && !empty($timezoneResult['value'])) {
        $timezone = $timezoneResult['value'];
        date_default_timezone_set($timezone);
        writeLog("Timezone set to: $timezone");
    } else {
        writeLog("Timezone not configured in tbl_appconfig. Using default.");
    }
} catch (PDOException $e) {
    writeLog('Failed to fetch timezone: ' . $e->getMessage());
}

// Get current date
$currentDate = date('Y-m-d');

// Check if the date has changed since the last run
$lastRunDateFile = 'last_run_date.txt';
$lastRunDate = null;
if (file_exists($lastRunDateFile)) {
    $lastRunDate = file_get_contents($lastRunDateFile);
}

if ($lastRunDate !== $currentDate) {
    // Date has changed since the last run
    writeLog("Date has changed from $lastRunDate to $currentDate.");
    // Restore original profiles for users under FUP
    restoreOriginalPlans($conn);

    // Update the last run date
    file_put_contents($lastRunDateFile, $currentDate);
} else {
    writeLog("Date has not changed. Current date: $currentDate.");
}

// Enforce FUP
enforceFUP($conn);

function restoreOriginalPlans($conn) {
    writeLog('Restoring original plans for users under FUP.');
    try {
        // Get users who are currently under FUP
        $stmt = $conn->prepare("
            SELECT ur.*, c.router_id, c.service_type, r.ip_address, r.username as router_username, r.password as router_password
            FROM tbl_user_recharges ur
            INNER JOIN tbl_customers c ON ur.customer_id = c.id
            INNER JOIN tbl_routers r ON c.router_id = r.id
            WHERE ur.fup_enabled = 1
        ");
        $stmt->execute();
        $usersUnderFUP = $stmt->fetchAll(PDO::FETCH_ASSOC);

        writeLog("Number of users under FUP to restore: " . count($usersUnderFUP));

        foreach ($usersUnderFUP as $user) {
            writeLog("Processing user {$user['username']} for profile restoration.");
            if ($user['original_profile']) {
                // Switch back to the original profile
                $result = switchUserProfile($user, $user['original_profile']);
                if ($result) {
                    // Disconnect the user
                    disconnectUser($user);
                    // Update the user record
                    $updateStmt = $conn->prepare("
                        UPDATE tbl_user_recharges
                        SET fup_enabled = 0, original_profile = NULL
                        WHERE username = :username
                    ");
                    $updateStmt->bindParam(':username', $user['username']);
                    $updateStmt->execute();
                    writeLog("Restored original profile for user {$user['username']}.");
                } else {
                    writeLog("Failed to restore original profile for user {$user['username']}.");
                }
            } else {
                writeLog("No original profile found for user {$user['username']}. Skipping.");
            }
        }
    } catch (Exception $e) {
        writeLog('Error in restoreOriginalPlans: ' . $e->getMessage());
    }
}

function enforceFUP($conn) {
    writeLog('Enforcing FUP for users.');
    try {
        // Get all active users with FUP profiles assigned via their plans
        $stmt = $conn->prepare("
            SELECT ur.*, c.router_id, c.service_type, r.ip_address, r.username as router_username, r.password as router_password,
                   fup.data_limit, fup.data_limit_unit, p.name_plan as original_plan_name, p.id as plan_id,
                   fup_plan.name_plan as fup_plan_name
            FROM tbl_user_recharges ur
            INNER JOIN tbl_customers c ON ur.customer_id = c.id
            INNER JOIN tbl_routers r ON c.router_id = r.id
            INNER JOIN tbl_plans p ON ur.plan_id = p.id
            INNER JOIN tbl_fup fup ON p.fup_id = fup.id
            INNER JOIN tbl_plans fup_plan ON p.fup_plan_id = fup_plan.id
            WHERE ur.status = 'on' AND fup.active = 1 AND ur.fup_enabled = 0
        ");
        $stmt->execute();
        $activeUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        writeLog("Number of active users to check for FUP: " . count($activeUsers));

        foreach ($activeUsers as $user) {
            writeLog("Processing user {$user['username']}.");

            // Get user's daily data usage
            $stmtUsage = $conn->prepare("
                SELECT (upload + download) as total_usage
                FROM tbl_daily_data_usage
                WHERE customer_id = :customer_id AND date = :date
            ");
            $stmtUsage->execute([
                ':customer_id' => $user['customer_id'],
                ':date' => date('Y-m-d')
            ]);
            $usageResult = $stmtUsage->fetch(PDO::FETCH_ASSOC);
            $totalUsage = $usageResult['total_usage'] ?? 0;

            writeLog("User {$user['username']} has used {$totalUsage} bytes today.");

            // Convert data limit to bytes
            $dataLimitBytes = convertToBytes($user['data_limit'], $user['data_limit_unit']);
            writeLog("User {$user['username']} data limit is {$dataLimitBytes} bytes.");

            if ($totalUsage >= $dataLimitBytes) {
                // User has exceeded the data limit
                writeLog("User {$user['username']} has exceeded the data limit.");
                // Save original profile
                $user['original_profile'] = $user['original_plan_name'];

                // Switch to FUP plan
                $result = switchUserProfile($user, $user['fup_plan_name']);
                if ($result) {
                    // Disconnect the user
                    disconnectUser($user);
                    // Update the user record
                    $updateStmt = $conn->prepare("
                        UPDATE tbl_user_recharges
                        SET fup_enabled = 1, original_profile = :original_profile
                        WHERE username = :username
                    ");
                    $updateStmt->bindParam(':original_profile', $user['original_profile']);
                    $updateStmt->bindParam(':username', $user['username']);
                    $updateStmt->execute();
                    writeLog("Applied FUP to user {$user['username']}.");
                } else {
                    writeLog("Failed to apply FUP to user {$user['username']}.");
                }
            } else {
                writeLog("User {$user['username']} has not exceeded the data limit.");
            }
        }
    } catch (Exception $e) {
        writeLog('Error in enforceFUP: ' . $e->getMessage());
    }
}

function switchUserProfile($user, $newProfile) {
    // Implement the code to switch the user's profile on the router
    try {
        writeLog("Switching profile for user {$user['username']} to {$newProfile}.");
        $client = new RouterOS\Client($user['ip_address'], $user['router_username'], $user['router_password']);
        // Determine the service type
        $serviceType = $user['service_type']; // From tbl_customers

        if ($serviceType == 'PPPOE') {
            // PPPoE user
            $request = new RouterOS\Request('/ppp/secret/set');
            $request->setArgument('numbers', $user['username']);
            $request->setArgument('profile', $newProfile);
            $client->sendSync($request);
        } elseif ($serviceType == 'Hotspot') {
            // Hotspot user
            $request = new RouterOS\Request('/ip/hotspot/user/set');
            $request->setArgument('numbers', $user['username']);
            $request->setArgument('profile', $newProfile);
            $client->sendSync($request);
        } elseif ($serviceType == 'Static') {
            // Static user, implement accordingly
            // For static users, you might need to update their queue or address list
            writeLog("Service type 'Static' is not implemented yet for user {$user['username']}.");
            return false;
        } else {
            writeLog("Unknown service type '{$serviceType}' for user {$user['username']}. Skipping profile switch.");
            return false;
        }
        writeLog("Successfully switched profile of user {$user['username']} to $newProfile.");
        return true;
    } catch (Exception $e) {
        writeLog("Error switching profile for user {$user['username']}: " . $e->getMessage());
        return false;
    }
}

function disconnectUser($user) {
    // Implement the code to disconnect the user from the router
    try {
        writeLog("Disconnecting user {$user['username']}.");
        $client = new RouterOS\Client($user['ip_address'], $user['router_username'], $user['router_password']);
        $serviceType = $user['service_type']; // From tbl_customers

        if ($serviceType == 'PPPOE') {
            // Find active PPPoE sessions
            $util = new RouterOS\Util($client);
            $util->setMenu('/ppp/active');
            $util->remove(RouterOS\Query::where('name', $user['username']));
        } elseif ($serviceType == 'Hotspot') {
            // Find active Hotspot sessions
            $util = new RouterOS\Util($client);
            $util->setMenu('/ip/hotspot/active');
            $util->remove(RouterOS\Query::where('user', $user['username']));
        } elseif ($serviceType == 'Static') {
            // Static user, implement accordingly
            writeLog("Service type 'Static' disconnection is not implemented yet for user {$user['username']}.");
            return false;
        } else {
            writeLog("Unknown service type '{$serviceType}' for user {$user['username']}. Skipping disconnection.");
            return false;
        }
        writeLog("Successfully disconnected user {$user['username']}.");
        return true;
    } catch (Exception $e) {
        writeLog("Error disconnecting user {$user['username']}: " . $e->getMessage());
        return false;
    }
}

function convertToBytes($value, $unit) {
    $unit = strtolower($unit);
    switch ($unit) {
        case 'kb':
            return $value * 1024;
        case 'mb':
            return $value * 1024 * 1024;
        case 'gb':
            return $value * 1024 * 1024 * 1024;
        case 'tb':
            return $value * 1024 * 1024 * 1024 * 1024;
        default:
            return $value; // Assume bytes
    }
}
?>
