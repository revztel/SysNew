<?php

// Include the config file with proper error handling
include __DIR__ . '/../config.php';

// Function to write logs to connected.log with a maximum of 5000 lines
function writeLog($message) {
    $logFile = 'connected.log';
    $maxLines = 5000;

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Format the message
    $formattedMessage = "[$date] $message" . PHP_EOL;

    // Append the message to the log file
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);

    // Check if the log file exceeds the maximum number of lines
    $lines = file($logFile);

    if (count($lines) > $maxLines) {
        // Keep only the last $maxLines lines
        $lines = array_slice($lines, -$maxLines);
        file_put_contents($logFile, implode('', $lines));
    }
}

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    writeLog('Database connection successful');
} catch (PDOException $e) {
    writeLog('Database connection failed: ' . $e->getMessage());
    die('Connection failed: ' . $e->getMessage());
}

// Function to check and add a column if it doesn't exist
function ensureColumnExists($conn, $db_name, $table, $column, $columnDefinition) {
    $stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = :db AND TABLE_NAME = :table AND COLUMN_NAME = :column");
    $stmt->execute([':db' => $db_name, ':table' => $table, ':column' => $column]);
    if ($stmt->rowCount() == 0) {
        $alterStmt = $conn->prepare("ALTER TABLE `$table` ADD `$column` $columnDefinition");
        if ($alterStmt->execute()) {
            writeLog("Column `$column` added to `$table`");
        } else {
            writeLog("Failed to add column `$column` to `$table`");
        }
    } else {
        writeLog("Column `$column` already exists in `$table`");
    }
}

// Ensure 'was_connected' and 'reconnection' columns exist
ensureColumnExists($conn, $db_name, 'tbl_user_recharges', 'was_connected', "ENUM('yes','no','n/a') DEFAULT 'n/a'");
ensureColumnExists($conn, $db_name, 'tbl_user_recharges', 'reconnection', "VARCHAR(50) DEFAULT 'n/a'");

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Ensure the username and routerId are provided
if (!isset($data['username']) || !isset($data['routerId'])) {
    writeLog('Missing username or routerId in the request');
    exit;
}

$username = $data['username'];
$routerId = $data['routerId'];
writeLog("Received request for username: $username, routerId: $routerId");

// Fetch router details from the database
$stmt = $conn->prepare("SELECT * FROM tbl_routers WHERE id = :routerId");
$stmt->bindParam(':routerId', $routerId);
$stmt->execute();
$routerResult = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$routerResult) {
    writeLog("Router with ID $routerId not found");
    exit;
}

writeLog("Router details fetched for routerId: $routerId");

// Router connection details
$routerIpAddress = $routerResult['ip_address'];
$routerUsername = $routerResult['username'];
$routerPassword = $routerResult['password'];

// Include the PEAR2 Autoload file
require __DIR__ . '/../system/autoload/PEAR2/Autoload.php';
use PEAR2\Net\RouterOS;

try {
    // Sleep for 80 seconds before checking the connection
    writeLog("Sleeping for 80 seconds before checking the connection");
    sleep(80);

    // Create a RouterOS client
    $client = new RouterOS\Client($routerIpAddress, $routerUsername, $routerPassword);
    writeLog("Connected to router at $routerIpAddress");

    // Create a request to check if the user is active in the hotspot
    $request = new RouterOS\Request('/ip/hotspot/active/print');
    $response = $client->sendSync($request);

    // Iterate over the response to check if the username exists in the active users
    $isConnected = false;
    foreach ($response as $entry) {
        if ($entry->getProperty('user') == $username) {
            $isConnected = true;
            break;
        }
    }

    if ($isConnected) {
        writeLog("User $username is connected to the hotspot");

        $was_connected = 'yes';
        $reconnection = 'n/a';
        $state = 'Online';

        // Update tbl_user_recharges
        $updateStmt = $conn->prepare("
            UPDATE tbl_user_recharges 
            SET was_connected = :was_connected, reconnection = :reconnection, state = :state
            WHERE username = :username 
            ORDER BY recharged_on DESC, recharged_time DESC 
            LIMIT 1
        ");
        $updateStmt->bindParam(':was_connected', $was_connected);
        $updateStmt->bindParam(':reconnection', $reconnection);
        $updateStmt->bindParam(':state', $state);
        $updateStmt->bindParam(':username', $username);
        if ($updateStmt->execute()) {
            writeLog("Updated tbl_user_recharges for user $username (was_connected: $was_connected, reconnection: $reconnection, state: $state)");
        } else {
            writeLog("Failed to update tbl_user_recharges for user $username");
        }

    } else {
        writeLog("User $username is NOT connected to the hotspot");

        // Extract phone number from username (part before the dash)
        $phone = '';
        if (strpos($username, '-') !== false) {
            $phone = explode('-', $username)[0];
        } else {
            $phone = $username; // If no dash, use entire username
        }
        writeLog("Extracted phone number: $phone");

        $message = "Hello, we have noticed you haven't been connected to internet. Kindly open your WiFi and click on sign in. You will be reconnected automatically.";

        // Fetch the SMS and WhatsApp URLs from tbl_appconfig
        $stmt = $conn->prepare("SELECT * FROM tbl_appconfig WHERE setting IN ('sms_url', 'wa_url')");
        $stmt->execute();
        $configResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $smsUrl = '';
        $waUrl = '';
        foreach ($configResults as $config) {
            if ($config['setting'] == 'sms_url') {
                $smsUrl = $config['value'];
            } elseif ($config['setting'] == 'wa_url') {
                $waUrl = $config['value'];
            }
        }
        writeLog("Fetched SMS URL: $smsUrl");
        writeLog("Fetched WhatsApp URL: $waUrl");

        // If SMS URL is available, send an SMS
        if (!empty($smsUrl)) {
            $smsUrlReplaced = str_replace('[text]', urlencode($message), $smsUrl);
            $smsUrlReplaced = str_replace('[number]', $phone, $smsUrlReplaced);
            writeLog("Sending SMS to $phone using URL: $smsUrlReplaced");

            // Send SMS via cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $smsUrlReplaced);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsResponse = curl_exec($ch);
            if (curl_errno($ch)) {
                $curlError = curl_error($ch);
                writeLog("cURL error when sending SMS: $curlError");
            } else {
                writeLog("SMS sent successfully. Response: $smsResponse");
            }
            curl_close($ch);
        } else {
            writeLog("SMS URL not configured. SMS not sent.");
        }

        // If WhatsApp URL is available, send a WhatsApp message
        if (!empty($waUrl)) {
            $waUrlReplaced = str_replace('[text]', urlencode($message), $waUrl);
            $waUrlReplaced = str_replace('[number]', $phone, $waUrlReplaced);
            writeLog("Sending WhatsApp message to $phone using URL: $waUrlReplaced");

            // Send WhatsApp message via cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $waUrlReplaced);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $waResponse = curl_exec($ch);
            if (curl_errno($ch)) {
                $curlError = curl_error($ch);
                writeLog("cURL error when sending WhatsApp message: $curlError");
            } else {
                writeLog("WhatsApp message sent successfully. Response: $waResponse");
            }
            curl_close($ch);
        } else {
            writeLog("WhatsApp URL not configured. WhatsApp message not sent.");
        }

        $was_connected = 'no';
        $reconnection = 'sms sent';

        // Update tbl_user_recharges
        $updateStmt = $conn->prepare("
            UPDATE tbl_user_recharges 
            SET was_connected = :was_connected, reconnection = :reconnection
            WHERE username = :username 
            ORDER BY recharged_on DESC, recharged_time DESC 
            LIMIT 1
        ");
        $updateStmt->bindParam(':was_connected', $was_connected);
        $updateStmt->bindParam(':reconnection', $reconnection);
        $updateStmt->bindParam(':username', $username);
        if ($updateStmt->execute()) {
            writeLog("Updated tbl_user_recharges for user $username (was_connected: $was_connected, reconnection: $reconnection)");
        } else {
            writeLog("Failed to update tbl_user_recharges for user $username");
        }
    }

} catch (Exception $e) {
    writeLog('Exception occurred: ' . $e->getMessage());
    exit;
}
