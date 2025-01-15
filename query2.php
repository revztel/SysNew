<?php
sleep(75);
require_once 'config.php';
require_once 'system/orm.php';
require_once 'system/autoload/PEAR2/Autoload.php';
include "system/autoload/Hookers.php";

// ORM configuration
ORM::configure("mysql:host=$db_host;dbname=$db_name");
ORM::configure('username', $db_user);
ORM::configure('password', $db_password);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);

// Logging function
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// Define log file path
$logFilePath = 'query2.log';

// Capture incoming POST data
$inputData = file_get_contents('php://input');
logToFile($logFilePath, "Received data: " . $inputData);

// Decode JSON data to an array
$data = json_decode($inputData, true);

// If JSON decoding fails, try to capture URL-encoded form data
if (json_last_error() !== JSON_ERROR_NONE) {
    parse_str($inputData, $data);
}

// Log the processed data
logToFile($logFilePath, "Processed data: " . print_r($data, true));

// Check if 'CheckoutRequestID' is set and proceed with STK Push query
if (isset($data['CheckoutRequestID'])) {
    $CheckoutRequestID = $data['CheckoutRequestID'];
    logToFile($logFilePath, "Captured CheckoutRequestID: $CheckoutRequestID");

    // Sleep for 25 seconds before processing


    // Call queryStkPush function with the captured CheckoutRequestID
    $response = queryStkPush($CheckoutRequestID);

    // Decode the response from STK Push query
    $responseArray = json_decode($response, true);

    // Merge the original data with the response data for complete forwarding
    if (is_array($responseArray)) {
        $data = array_merge($data, $responseArray);
    }

    // Log the updated data before forwarding
    logToFile($logFilePath, "Updated data to send: " . print_r($data, true));

    // Update record in the database
    $payment = ORM::for_table('tbl_payment_gateway')
        ->where('checkout', $CheckoutRequestID)
        ->find_one();

    if ($payment) {
        $payment->save();
        logToFile($logFilePath, "Updated record for CheckoutRequestID: $CheckoutRequestID");
    }
} else {
    logToFile($logFilePath, "No CheckoutRequestID found in the received data.");
}

// URL of query2_update.php
$query2UpdateUrl = APP_URL . '/query2_update.php';

// Encode the updated data to JSON for sending
$responseData = json_encode($data);

// Initialize cURL to send the data to query2_update.php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $query2UpdateUrl);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false); // Set to false to ignore the response
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_POSTFIELDS, $responseData); // Send the updated data as JSON

// Execute the cURL request and ignore the response or any errors
curl_exec($curl);

// Close the cURL session
curl_close($curl);

// Function to query STK Push status
function queryStkPush($CheckoutRequestID) {
    global $logFilePath;

    // Ensure CheckoutRequestID is valid
    if (empty($CheckoutRequestID)) {
        logToFile($logFilePath, "Invalid CheckoutRequestID: $CheckoutRequestID");
        return null;
    }

    // Fetch M-Pesa credentials from tbl_appconfig table
    $consumerKey = ORM::for_table('tbl_appconfig')->where('setting', 'mpesa_till_consumer_key')->find_one()->value;
    $consumerSecret = ORM::for_table('tbl_appconfig')->where('setting', 'mpesa_till_consumer_secret')->find_one()->value;
    $BusinessShortCode = ORM::for_table('tbl_appconfig')->where('setting', 'mpesa_till_shortcode_code')->find_one()->value;
    $Passkey = ORM::for_table('tbl_appconfig')->where('setting', 'mpesa_till_pass_key')->find_one()->value;

    $headers = ['Content-Type:application/json; charset=utf8'];

    $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    logToFile($logFilePath, "Requesting access token");

    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);

    if ($result === false) {
        $error = 'Curl failed: ' . curl_error($curl);
        logToFile($logFilePath, $error);
        die($error);
    }

    $result = json_decode($result);

    if (isset($result->access_token)) {
        $access_token = $result->access_token;
        logToFile($logFilePath, "Access token obtained successfully");
    } else {
        $error = 'Failed to get access token.';
        logToFile($logFilePath, $error);
        die($error);
    }

    curl_close($curl);

    $urlfinal = 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';

    logToFile($logFilePath, "Querying STK Push status for CheckoutRequestID: $CheckoutRequestID");

    $curlfinal = curl_init();
    curl_setopt($curlfinal, CURLOPT_URL, $urlfinal);
    curl_setopt($curlfinal, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); // Setting custom header

    $Timestamp = date("YmdHis", time());
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

    $curl_post_data_final = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'CheckoutRequestID' => $CheckoutRequestID
    );

    $data_string_final = json_encode($curl_post_data_final);

    curl_setopt($curlfinal, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlfinal, CURLOPT_POST, true);
    curl_setopt($curlfinal, CURLOPT_POSTFIELDS, $data_string_final);

    $curl_responsefinal = curl_exec($curlfinal);

    if ($curl_responsefinal === false) {
        $error = 'Curl failed: ' . curl_error($curlfinal);
        logToFile($logFilePath, $error);
        die($error);
    }

    logToFile($logFilePath, "Raw response: " . $curl_responsefinal); // Log the raw response

    curl_close($curlfinal);

    return $curl_responsefinal; // Return the full raw response
}
?>
