<?php
// time_data_reminder.php

// Include the config file
include __DIR__ . '/../config.php';

// Function to write logs to reminder.log
function writeLog($message) {
    $logFile = 'reminder.log';
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

// Include the PEAR2 Autoload file
require __DIR__ . '/../system/autoload/PEAR2/Autoload.php';
use PEAR2\Net\RouterOS;

// Fetch the reminder settings from tbl_appconfig
$dataReminderEnabled = getAppConfigValue($conn, 'data_reminder');
$timeReminderEnabled = getAppConfigValue($conn, 'time_reminder');

// Fetch active hotspot users from tbl_user_recharges
try {
    $stmt = $conn->prepare("
        SELECT ur.*, p.*
        FROM tbl_user_recharges ur
        INNER JOIN tbl_plans p ON ur.plan_id = p.id
        WHERE ur.status = 'on' AND ur.type = 'Hotspot' AND (ur.reminder_sent IS NULL OR ur.reminder_sent != 'yes')
    ");
    $stmt->execute();
    $activeUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    writeLog("Fetched " . count($activeUsers) . " active hotspot users");
} catch (PDOException $e) {
    writeLog('Exception during fetching active users: ' . $e->getMessage());
    exit;
}

foreach ($activeUsers as $user) {
    $username = $user['username'];
    $planId = $user['plan_id'];
    $planTypebp = $user['typebp']; // 'Limited' or 'Unlimited'
    $limitType = strtolower($user['limit_type']); // 'data_limit' or 'time_limit'
    $dataLimit = $user['data_limit'];
    $dataUnit = $user['data_unit']; // 'MB', 'GB', etc.
    $routerNames = $user['routers']; // The 'routers' field from tbl_plans
    $planName = $user['name_plan']; // Plan name from tbl_plans
    $expiresOn = $user['expiration'];
    $expiresTime = $user['time'];

    // Construct expiration DateTime
    $expirationDateTimeStr = $expiresOn . ' ' . $expiresTime;
    $expirationDateTime = new DateTime($expirationDateTimeStr);

    writeLog("Processing user $username with plan $planId ($planName)");

    // Get router details
    $routerNameList = explode(',', $routerNames);
    foreach ($routerNameList as $routerName) {
        $routerName = trim($routerName);
        // Get router details from tbl_routers
        $stmtRouter = $conn->prepare("SELECT * FROM tbl_routers WHERE name = :routerName");
        $stmtRouter->bindParam(':routerName', $routerName);
        $stmtRouter->execute();
        $router = $stmtRouter->fetch(PDO::FETCH_ASSOC);
        if ($router) {
            $routerIpAddress = $router['ip_address'];
            $routerUsername = $router['username'];
            $routerPassword = $router['password'];

            try {
                $client = new RouterOS\Client($routerIpAddress, $routerUsername, $routerPassword);
                writeLog("Connected to router at $routerIpAddress for user $username");

                if ($limitType == 'data_limit') {
                    if ($dataReminderEnabled == 'yes') {
                        // Data limit plan
                        // Fetch data usage using queues
                        $dataUsage = fetchDataUsageFromRouter($client, $username);

                        if ($dataUsage !== false) {
                            $bytesUsed = $dataUsage['upload'] + $dataUsage['download'];

                            // Convert data limit to bytes
                            $dataLimitBytes = convertToBytes($dataLimit, $dataUnit);

                            // Avoid division by zero
                            if ($dataLimitBytes > 0) {
                                // Calculate percentage used
                                $percentageUsed = ($bytesUsed / $dataLimitBytes) * 100;

                                // Calculate remaining data
                                $bytesRemaining = $dataLimitBytes - $bytesUsed;
                                $remainingData = convertFromBytes($bytesRemaining);

                                writeLog("User $username data usage details:");
                                writeLog("Data Limit: $dataLimitBytes bytes");
                                writeLog("Bytes Used: $bytesUsed bytes");
                                writeLog("Percentage Used: " . round($percentageUsed, 2) . "%");
                                writeLog("Remaining Data: $remainingData");

                                if ($percentageUsed >= 75 && $percentageUsed <= 100) {
                                    // Prepare message
                                    $message = "Dear Customer, your internet plan '" . $planName . "' is " . round($percentageUsed, 2) . "% used. Remaining data is " . $remainingData . ".";

                                    // Extract phone number from username
                                    $phone = strpos($username, '-') !== false ? explode('-', $username)[0] : $username;

                                    // Send message (both SMS and WhatsApp)
                                    $smsSent = sendMessage($conn, $phone, $message, 'sms');
                                    $waSent = sendMessage($conn, $phone, $message, 'wa');

                                    if ($smsSent || $waSent) {
                                        // Update reminder_sent to 'yes'
                                        $updateStmt = $conn->prepare("
                                            UPDATE tbl_user_recharges
                                            SET reminder_sent = 'yes'
                                            WHERE username = :username
                                        ");
                                        $updateStmt->bindParam(':username', $username);
                                        if ($updateStmt->execute()) {
                                            writeLog("Set reminder_sent to 'yes' for user $username");
                                        } else {
                                            writeLog("Failed to update reminder_sent for user $username");
                                        }
                                    }
                                } else {
                                    writeLog("User $username has not reached the data usage threshold");
                                }
                            } else {
                                writeLog("Data limit bytes is zero for user $username. Cannot calculate percentage used.");
                            }
                        } else {
                            writeLog("Could not retrieve data usage for user $username");
                        }
                    } else {
                        writeLog("Data reminders are disabled in app config. Skipping user $username.");
                    }
                } elseif ($limitType == 'time_limit') {
                    if ($timeReminderEnabled == 'yes') {
                        // Time limit plan
                        // Use expiration and time from tbl_user_recharges
                        $currentDateTime = new DateTime();

                        $remainingSeconds = $expirationDateTime->getTimestamp() - $currentDateTime->getTimestamp();

                        // Log the time calculations
                        writeLog("Expiration DateTime: " . $expirationDateTime->format('Y-m-d H:i:s'));
                        writeLog("Current DateTime: " . $currentDateTime->format('Y-m-d H:i:s'));
                        writeLog("Remaining Seconds: $remainingSeconds");

                        if ($remainingSeconds > 0 && $remainingSeconds <= 13 * 60) {
                            // Remaining time is less than or equal to 13 minutes
                            // Prepare message
                            $message = "Dear customer, your internet plan '" . $planName . "' is 90% used. Expiry at " . $expirationDateTime->format('Y-m-d H:i:s') . ".";

                            // Extract phone number from username
                            $phone = strpos($username, '-') !== false ? explode('-', $username)[0] : $username;

                            // Send message (both SMS and WhatsApp)
                            $smsSent = sendMessage($conn, $phone, $message, 'sms');
                            $waSent = sendMessage($conn, $phone, $message, 'wa');

                            if ($smsSent || $waSent) {
                                // Update reminder_sent to 'yes'
                                $updateStmt = $conn->prepare("
                                    UPDATE tbl_user_recharges
                                    SET reminder_sent = 'yes'
                                    WHERE username = :username
                                ");
                                $updateStmt->bindParam(':username', $username);
                                if ($updateStmt->execute()) {
                                    writeLog("Set reminder_sent to 'yes' for user $username");
                                } else {
                                    writeLog("Failed to update reminder_sent for user $username");
                                }
                            }
                        } else {
                            writeLog("User $username has more than 13 minutes remaining or already expired");
                        }
                    } else {
                        writeLog("Time reminders are disabled in app config. Skipping user $username.");
                    }
                } else {
                    writeLog("Unknown limit type '$limitType' for user $username");
                }
            } catch (Exception $e) {
                writeLog("Exception occurred while processing user $username: " . $e->getMessage());
                continue;
            }
        } else {
            writeLog("Router $routerName not found in tbl_routers");
            continue;
        }
    }
}

writeLog("Reminder check completed.");

// Function to fetch data usage from router using queues
function fetchDataUsageFromRouter($client, $username) {
    $dataUsage = array('upload' => 0, 'download' => 0);

    try {
        // Fetch queue list
        $printRequest = new RouterOS\Request('/queue/simple/print');
        $printRequest->setArgument('.proplist', '.id,name,bytes');
        $queueList = $client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

        foreach ($queueList as $queue) {
            $name = $queue->getProperty('name');
            $bytesData = $queue->getProperty('bytes');

            // Split the bytes data into upload and download values
            list($uploadBytes, $downloadBytes) = explode('/', $bytesData);

            // Identify the customer based on the queue name
            if (strpos($name, '<hotspot-' . $username . '>') !== false ||
                strpos($name, 'Queue-' . $username) === 0) {

                // Add the upload and download bytes to the customer's data usage
                $dataUsage['upload'] += $uploadBytes;
                $dataUsage['download'] += $downloadBytes;

                // Since we've found the queue for the user, we can break the loop
                break;
            }
        }

        return $dataUsage;
    } catch (Exception $e) {
        writeLog("Error fetching data usage for user $username: " . $e->getMessage());
        return false;
    }
}

// Function to get app config value
function getAppConfigValue($conn, $setting) {
    try {
        $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = :setting");
        $stmt->bindParam(':setting', $setting);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && !empty($result['value'])) {
            return strtolower($result['value']);
        } else {
            return 'no'; // Default to 'no' if not set
        }
    } catch (PDOException $e) {
        writeLog('Failed to fetch app config value for ' . $setting . ': ' . $e->getMessage());
        return 'no';
    }
}

// Function to convert data limit to bytes
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

// Function to convert bytes to human-readable format
function convertFromBytes($bytes) {
    if ($bytes >= 1099511627776) {
        $bytes = number_format($bytes / 1099511627776, 2) . ' TB';
    } elseif ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } else {
        $bytes = $bytes . ' bytes';
    }

    return $bytes;
}

// Function to send messages (SMS or WhatsApp)
function sendMessage($conn, $phone, $message, $type = 'sms') {
    // Determine the URL setting based on message type
    $urlSetting = ($type === 'wa') ? 'wa_url' : 'sms_url';

    // Fetch the URL from tbl_appconfig
    $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = :urlSetting");
    $stmt->execute([':urlSetting' => $urlSetting]);
    $configResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($configResult && !empty($configResult['value'])) {
        $messageUrl = $configResult['value'];

        $messageUrlReplaced = str_replace('[text]', urlencode($message), $messageUrl);
        $messageUrlReplaced = str_replace('[number]', $phone, $messageUrlReplaced);
        writeLog("Sending $type message to $phone using URL: $messageUrlReplaced");

        // Send message via cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $messageUrlReplaced);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $curlError = curl_error($ch);
            writeLog("cURL error when sending $type message: $curlError");
            curl_close($ch);
            return false;
        } else {
            writeLog(ucfirst($type) . " message sent successfully to $phone. Response: $response");
            curl_close($ch);
            return true;
        }
    } else {
        writeLog(ucfirst($type) . " URL not configured. $type message not sent to $phone.");
        return false;
    }
}
?>
