<?php
ini_set('max_execution_time', 120); // Increase max execution time if necessary

require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'system/orm.php';
require_once 'system/autoload/PEAR2/Autoload.php';
include "system/autoload/Hookers.php";

ORM::configure("mysql:host=$db_host;dbname=$db_name");
ORM::configure('username', $db_user);
ORM::configure('password', $db_password);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);

// Function to manage log file lines
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}
// Fetch ioTec Pay credentials from the database
$iotec_client_id = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_id')->find_one();
$iotec_client_secret = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_secret')->find_one();
$iotec_wallet_id = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_wallet_id')->find_one();

// Assign default values if not found
$clientId = $iotec_client_id ? $iotec_client_id->value : '';
$clientSecret = $iotec_client_secret ? $iotec_client_secret->value : '';
$walletId = $iotec_wallet_id ? $iotec_wallet_id->value : '';

// Log configuration details
logToFile('create_ioTec_payment.log', "Fetched credentials - Client ID: $clientId, Wallet ID: $walletId");

// Ensure required credentials are present
if (empty($clientId) || empty($clientSecret) || empty($walletId)) {
    logToFile('create_ioTec_payment.log', "Missing ioTec credentials.");
    echo json_encode(['error' => 'Missing ioTec credentials. Please configure them in the admin panel.']);
    exit();
}
// Log the received input data
$input = file_get_contents('php://input');
$data = json_decode($input, true);
logToFile('create_ioTec_payment.log', "Received data: " . print_r($data, true));

// Check for required fields in the input data
$requiredFields = ['buyer_email', 'buyer_phone', 'amount', 'plan_id', 'router_id'];
$missingFields = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile('create_ioTec_payment.log', "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

// Extract necessary fields from the incoming data
$buyer_name = $data['buyer_phone']; // Using phone number as name
$buyer_email = $data['buyer_email'];
$buyer_phone = $data['buyer_phone'];
$amount = $data['amount'];
$planId = $data['plan_id'];
$routerId = $data['router_id'];
logToFile('create_ioTec_payment.log', "Extracted fields - Buyer: $buyer_name, Email: $buyer_email, Phone: $buyer_phone, Amount: $amount, Plan ID: $planId, Router ID: $routerId");

// Fetch the plan name and router name from their respective tables
$plan = ORM::for_table('tbl_plans')->find_one($planId);
$router = ORM::for_table('tbl_routers')->find_one($routerId);

if (!$plan || !$router) {
    logToFile('create_ioTec_payment.log', "Plan or router not found.");
    echo json_encode(['error' => 'Plan or router not found']);
    exit();
}

$planName = $plan->name_plan; // Assuming 'name_plan' is the correct column for plan name
$routerName = $router->name; // Assuming 'name' is the correct column for router name
logToFile('create_ioTec_payment.log', "Fetched Plan Name: $planName, Router Name: $routerName");

// Generate a unique reference for the order
$reference = uniqid();
logToFile('create_ioTec_payment.log', "Generated order reference: $reference");


$authUrl = 'https://id.iotec.io/connect/token';
$apiUrl = 'https://pay.iotec.io/api/collections/collect';
$currency = 'UGX';  // Use appropriate currency
logToFile('create_ioTec_payment.log', "Client ID: $clientId, Auth URL: $authUrl, API URL: $apiUrl, Wallet ID: $walletId, Currency: $currency");

/**
 * Get OAuth 2.0 Token from ioTec Pay
 */
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
        logToFile('create_ioTec_payment.log', "Curl error during token request: " . curl_error($ch));
    }
    curl_close($ch);

    logToFile('create_ioTec_payment.log', "Access token response: " . $response);
    $result = json_decode($response, true);
    return $result['access_token'] ?? null;
}

/**
 * Send JSON request to ioTec API
 */
function sendJSONPost($url, $json, $accessToken) {
    $headers = [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        logToFile('create_ioTec_payment.log', "Curl error during API request: " . curl_error($ch));
        return false;
    }

    logToFile('create_ioTec_payment.log', "API request response: " . $result);
    curl_close($ch);
    return json_decode($result, true);
}

// Obtain access token
$accessToken = getAccessToken($authUrl, $clientId, $clientSecret);
if (!$accessToken) {
    logToFile('create_ioTec_payment.log', "Unable to obtain access token.");
    echo json_encode(['error' => 'Unable to obtain access token']);
    exit();
}
logToFile('create_ioTec_payment.log', "Obtained access token successfully.");

// Prepare request payload for ioTec Pay
$req = [
    "category" => "MobileMoney",
    "currency" => $currency,
    "walletId" => $walletId,
    "externalId" => $reference,
    "payer" => $buyer_phone,
    "amount" => $amount,
    "payerNote" => "Payment for $planName",
    "payeeNote" => "ioTec Payment",
    "channel" => "MobileMoney",
    "transactionChargesCategory" => "ChargeWallet"
];
logToFile('create_ioTec_payment.log', "Request payload to ioTec: " . print_r($req, true));

// Convert request to JSON
$jsonReq = json_encode($req);

// Insert payment gateway record before sending request
$d = ORM::for_table('tbl_payment_gateway')->create();
$d->username = $buyer_phone;
$d->gateway = 'ioTec Pay';
$d->plan_id = $planId;
$d->routers_id = $routerId;
$d->plan_name = $planName;  // Adding plan name
$d->routers = $routerName;  // Adding router name (column should be `routers`)
$d->price = $amount;
$d->payment_method = 'ioTec Pay';
$d->payment_channel = 'ioTec';
$d->created_date = date('Y-m-d H:i:s');
$d->pg_url_payment = '';
$d->status = 1;
$d->gateway_trx_id = ''; // We will update this after getting the transaction ID
$d->save();
logToFile('create_ioTec_payment.log', "Payment record inserted into database.");

// Send the payment request to ioTec Pay
$response = sendJSONPost($apiUrl, $jsonReq, $accessToken);
if ($response === false) {
    logToFile('create_ioTec_payment.log', "Error in sending payment request.");
    echo json_encode(['error' => 'Error in sending payment request.']);
    exit();
}

// Log the response and update the payment gateway record
$d->pg_request = $jsonReq;
$d->pg_paid_response = json_encode($response);
$d->save();

logToFile('create_ioTec_payment.log', "Response from ioTec Pay: " . print_r($response, true));

// Check if response contains transaction ID
if (isset($response['id'])) {
    $transactionId = $response['id'];
    $d->gateway_trx_id = $transactionId;
    $d->save();
} else {
    logToFile('create_ioTec_payment.log', "No transaction ID in response.");
    echo json_encode(['error' => 'No transaction ID in response.']);
    exit();
}

// Return the final status to the client
echo json_encode([
    'status' => $response['status'],
    'statusMessage' => $response['statusMessage'],
    'transactionId' => $transactionId,
    'paymentResponse' => $response
]);
?>
