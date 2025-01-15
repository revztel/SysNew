<?php
require_once 'config.php'; // Include your configuration file

// Function to manage log file lines (reuse the existing function)
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// Configuration
$authUrl = 'https://id.iotec.io/connect/token';
$clientId = 'luminous-client';
$clientSecret = 'tDY9nxvGqL5VM9UmNtchV1iY82SwV13o';
$statusApiBaseUrl = 'https://pay.iotec.io/api/collections/status/';
$transactionId = '4101e69d-499f-43f0-815a-0213874991f6'; // Replace with your actual transaction ID

// Function to get access token (reuse from your main script)
function getAccessToken($authUrl, $clientId, $clientSecret) {
    $data = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $authUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        logToFile('check_status.log', "Curl error during token request: " . curl_error($ch));
    }
    curl_close($ch);

    logToFile('check_status.log', "Access token response: " . $response);
    $result = json_decode($response, true);
    return $result['access_token'] ?? null;
}

// Function to send GET request
function sendGET($url, $accessToken) {
    $headers = [
        "Authorization: Bearer $accessToken",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        logToFile('check_status.log', "Curl error during GET request: " . curl_error($ch));
        return false;
    }

    logToFile('check_status.log', "GET request response: " . $result);
    curl_close($ch);
    return json_decode($result, true);
}

// Get access token
$accessToken = getAccessToken($authUrl, $clientId, $clientSecret);
if (!$accessToken) {
    logToFile('check_status.log', "Unable to obtain access token.");
    echo json_encode(['error' => 'Unable to obtain access token']);
    exit();
}

// Construct the status URL
$statusApiUrl = $statusApiBaseUrl . $transactionId;
logToFile('check_status.log', "Checking status for Transaction ID: $transactionId");

// Send the GET request to check payment status
$statusResponse = sendGET($statusApiUrl, $accessToken);
if ($statusResponse === false) {
    logToFile('check_status.log', "Error in getting payment status.");
    echo json_encode(['error' => 'Error in getting payment status.']);
    exit();
}

// Log and display the response
logToFile('check_status.log', "Payment status response: " . print_r($statusResponse, true));
echo json_encode($statusResponse);
?>
