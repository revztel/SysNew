<?php
/**
 * disconnection.php
 *
 * This script monitors user disconnection events from MikroTik routers,
 * processes the logs, and updates the database accordingly.
 * It is intended to be run periodically via a cron job.
 */

// Include the config file
include __DIR__ . '/../config.php';

// Include the PEAR2 Autoload file
require __DIR__ . '/../system/autoload/PEAR2/Autoload.php';
use PEAR2\Net\RouterOS;

// Function to write logs to disconnection.log
function writeLog($message) {
    $logFile = 'disconnection.log';
    $maxLines = 5000;

    $date = date('Y-m-d H:i:s');
    $formattedMessage = "[$date] $message" . PHP_EOL;

    file_put_contents($logFile, $formattedMessage, FILE_APPEND);

    // Limit the log file size
    $lines = file($logFile);
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, -$maxLines);
        file_put_contents($logFile, implode('', $lines));
    }
}

// Connect to the database using PDO
try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    writeLog('Database connection successful');
} catch (PDOException $e) {
    writeLog('Database connection failed: ' . $e->getMessage());
    die('Connection failed: ' . $e->getMessage());
}

// Update disconnection_reason to 'N/A' for users where status is 'on' and state is 'Online'
try {
    $updateOnlineUsersStmt = $conn->prepare("
        UPDATE tbl_user_recharges
        SET disconnection_reason = 'N/A'
        WHERE status = 'on' AND LOWER(state) = 'online'
    ");
    if ($updateOnlineUsersStmt->execute()) {
        $rowsAffected = $updateOnlineUsersStmt->rowCount();
        writeLog("Updated disconnection_reason to 'N/A' for $rowsAffected online users");
    } else {
        $errorInfo = $updateOnlineUsersStmt->errorInfo();
        writeLog("Failed to update disconnection_reason for online users: " . $errorInfo[2]);
    }
} catch (PDOException $e) {
    writeLog('Exception during updating online users: ' . $e->getMessage());
}

// Function to get the last log timestamp
function getLastLogTimestamp($routerId) {
    $file = "last_log_time_{$routerId}.txt";
    if (file_exists($file)) {
        $timestamp = file_get_contents($file);
        // If the timestamp is in the future, reset it to 24 hours ago
        if ($timestamp > date('Y-m-d H:i:s')) {
            $timestamp = date('Y-m-d H:i:s', strtotime('-1 day'));
        }
        return $timestamp;
    }
    // If no timestamp exists, default to 24 hours ago
    return date('Y-m-d H:i:s', strtotime('-1 day'));
}

// Function to update the last log timestamp
function updateLastLogTimestamp($routerId, $timestamp) {
    $file = "last_log_time_{$routerId}.txt";
    file_put_contents($file, $timestamp);
}

// Function to process log messages
function processLogMessage($conn, $message, $logDateTime) {
    // Process 'logged out' messages
    if (strpos($message, 'logged out') !== false) {
        preg_match('/^(\S+) \([^)]+\): logged out: (.+)$/', $message, $matches);
        if (count($matches) == 3) {
            $username = $matches[1];
            $reason = $matches[2];

            // Handle 'admin reset' reason
            if (trim($reason) == 'admin reset') {
                $reason = 'expired';
            }

            writeLog("User $username disconnected at $logDateTime due to $reason");

            // Update user's disconnection info
            $stmt = $conn->prepare("
                SELECT id, status, state FROM tbl_user_recharges 
                WHERE username = :username AND status = 'on'
                ORDER BY recharged_on DESC, recharged_time DESC 
                LIMIT 1
            ");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $userRecharge = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRecharge) {
                if (strtolower($userRecharge['state']) == 'offline') {
                    // Update disconnection info
                    $updateStmt = $conn->prepare("
                        UPDATE tbl_user_recharges
                        SET disconnection_time = :disconnection_time, disconnection_reason = :disconnection_reason
                        WHERE id = :id
                    ");
                    $updateStmt->bindParam(':disconnection_time', $logDateTime);
                    $updateStmt->bindParam(':disconnection_reason', $reason);
                    $updateStmt->bindParam(':id', $userRecharge['id']);
                    if ($updateStmt->execute()) {
                        writeLog("Updated disconnection info for user $username");
                    } else {
                        $errorInfo = $updateStmt->errorInfo();
                        writeLog("Failed to update disconnection info for user $username: " . $errorInfo[2]);
                    }
                } else {
                    writeLog("User $username is not offline. Skipping disconnection update.");
                }
            } else {
                writeLog("User $username is not active or status is 'off'. Skipping.");
            }
        } else {
            writeLog("Failed to parse log message: $message");
        }
    }
    // No need to process 'logged in' messages here
}

function buildLogDateTime($logTime) {
    $logTime = trim($logTime);
    // Capitalize the month abbreviation
    if (preg_match('/^([a-z]{3})\//i', $logTime, $matches)) {
        $monthAbbr = ucfirst(strtolower($matches[1]));
        $logTime = $monthAbbr . substr($logTime, 3);
    }
    // Now proceed to parse
    if (preg_match('/^[A-Za-z]{3}\/\d{1,2}\/\d{4} \d{2}:\d{2}:\d{2}$/', $logTime)) {
        // Format: M/d/Y H:i:s
        $dateTime = DateTime::createFromFormat('M/d/Y H:i:s', $logTime);
    } elseif (preg_match('/^[A-Za-z]{3}\/\d{1,2} \d{2}:\d{2}:\d{2}$/', $logTime)) {
        // Format: M/d H:i:s
        $dateTime = DateTime::createFromFormat('M/d H:i:s', $logTime);
        if ($dateTime instanceof DateTime) {
            // Add current year
            $dateTime->setDate(date('Y'), $dateTime->format('n'), $dateTime->format('j'));
        }
    } elseif (preg_match('/^\d{2}:\d{2}:\d{2}$/', $logTime)) {
        // Time without date, assume today's date
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . ' ' . $logTime);
        // Remove adjustment for future times
    } else {
        // If parsing failed, log an error and return current time
        writeLog("Failed to parse log time: $logTime");
        return date('Y-m-d H:i:s');
    }
    if ($dateTime instanceof DateTime) {
        return $dateTime->format('Y-m-d H:i:s');
    } else {
        // If parsing failed, log an error and return current time
        writeLog("Failed to parse log time: $logTime");
        return date('Y-m-d H:i:s');
    }
}


// Fetch all routers from the database
$stmt = $conn->prepare("SELECT * FROM tbl_routers");
$stmt->execute();
$routers = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($routers as $router) {
    $routerId = $router['id'];
    $routerIpAddress = $router['ip_address'];
    $routerUsername = $router['username'];
    $routerPassword = $router['password'];
    writeLog("Processing router ID: $routerId at IP: $routerIpAddress");

    try {
        // Create a RouterOS client
        $client = new RouterOS\Client($routerIpAddress, $routerUsername, $routerPassword);
        writeLog("Connected to router at $routerIpAddress");

        // Get the last log timestamp for this router
        $lastLogTimestamp = getLastLogTimestamp($routerId);
        writeLog("Last log retrieval time for router $routerId: $lastLogTimestamp");

        // Fetch logs
        $logRequest = new RouterOS\Request('/log/print');
        $logRequest->setArgument('.proplist', '.id,time,topics,message');

        // Fetch all logs
        $logResponse = $client->sendSync($logRequest);

        // Process logs
        $logsToProcess = [];

        foreach ($logResponse as $logEntry) {
            $logTime = $logEntry->getProperty('time'); // Possible formats: HH:MM:SS, MMM/DD HH:MM:SS, MMM/DD/YYYY HH:MM:SS
            $topics = $logEntry->getProperty('topics');
            $message = $logEntry->getProperty('message');

            // Only process logs with 'hotspot' topic or messages containing 'hotspot'
            if (strpos($topics, 'hotspot') !== false || strpos($message, 'hotspot') !== false) {
                // Build the full log timestamp
                $logDateTime = buildLogDateTime($logTime);

                // Compare log timestamps
                if ($logDateTime > $lastLogTimestamp) {
                    $logsToProcess[] = [
                        'datetime' => $logDateTime,
                        'message' => $message
                    ];
                }
            }
        }

        writeLog("Total logs to process: " . count($logsToProcess));

        // Sort logs by datetime
        usort($logsToProcess, function($a, $b) {
            return strcmp($a['datetime'], $b['datetime']);
        });

        // Process each log
        foreach ($logsToProcess as $logData) {
            processLogMessage($conn, $logData['message'], $logData['datetime']);
            // Update the last log timestamp
            $lastLogTimestamp = $logData['datetime'];
        }

        // Update the last log timestamp
        updateLastLogTimestamp($routerId, $lastLogTimestamp);
        writeLog("Updated last log retrieval time for router $routerId to $lastLogTimestamp");

    } catch (Exception $e) {
        writeLog("Exception occurred while processing router $routerId: " . $e->getMessage());
        continue;
    }
}

writeLog("Disconnection check completed.");

?>
