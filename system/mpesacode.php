<?php
// mpesacode.php

// Include the config file with proper error handling
include __DIR__ . '/../config.php';

// Function to write logs to mpesacode.log with a maximum of 5000 lines
function writeLog($message) {
    $logFile = __DIR__ . '/mpesacode.log'; // Ensure the log file path is correct
    $maxLines = 5000;

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Format the message
    $formattedMessage = "[$date] $message" . PHP_EOL;

    // Append the message to the log file
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);

    // Check if the log file exceeds the maximum number of lines
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (count($lines) > $maxLines) {
        // Keep only the last $maxLines lines
        $lines = array_slice($lines, -$maxLines);
        file_put_contents($logFile, implode(PHP_EOL, $lines) . PHP_EOL);
    }
}

header('Content-Type: application/json');

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    writeLog('Database connection successful');
} catch (PDOException $e) {
    writeLog('Database connection failed: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Check if 'mpesa_code' is provided
if (!isset($data['mpesa_code']) || empty(trim($data['mpesa_code']))) {
    writeLog('mpesa_code not provided or empty in the request');
    echo json_encode(['status' => 'error', 'message' => 'mpesa_code not provided or empty']);
    exit;
}

// Extract the first word from the Mpesa message
$mpesa_message = trim($data['mpesa_code']);
$mpesa_code = strtok($mpesa_message, " ");
writeLog("Received mpesa_message: $mpesa_message, extracted mpesa_code: $mpesa_code");

// Search in 'tbl_user_recharges' where 'method' ends with '-mpesa_code' and 'status' is 'on'
$stmt = $conn->prepare("
    SELECT username FROM tbl_user_recharges 
    WHERE method LIKE CONCAT('%-', :mpesa_code)
    AND status = 'on'
    ORDER BY recharged_on DESC, recharged_time DESC
    LIMIT 1
");
$stmt->bindParam(':mpesa_code', $mpesa_code);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $username = $result['username'];
    writeLog("Transaction found for mpesa_code $mpesa_code, username: $username");

    // Return success with the username
    echo json_encode([
        'status' => 'success',
        'message' => 'Transaction found.',
        'username' => $username
    ]);
} else {
    writeLog("Transaction not found for mpesa_code $mpesa_code");
    echo json_encode([
        'status' => 'error',
        'message' => 'Transaction not found or account has already expired.'
    ]);
}
?>
