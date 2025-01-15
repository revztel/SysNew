<?php

require_once '../init.php';
global $config, $ui;
// -----------------------------------------------------------------------------
// 2. Log function
// -----------------------------------------------------------------------------
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// -----------------------------------------------------------------------------
// 3. Fetch ioTec Pay credentials from DB
// -----------------------------------------------------------------------------
$iotec_client_id     = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_id')->find_one();
$iotec_client_secret = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_secret')->find_one();
$iotec_wallet_id     = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_wallet_id')->find_one();

$clientId     = $iotec_client_id     ? $iotec_client_id->value     : '';
$clientSecret = $iotec_client_secret ? $iotec_client_secret->value : '';
$walletId     = $iotec_wallet_id     ? $iotec_wallet_id->value     : '';

$logFile = 'create_iotec_payment.log';

// -----------------------------------------------------------------------------
// 4. Log credentials and check if missing
// -----------------------------------------------------------------------------
logToFile($logFile, "Fetched credentials - Client ID: $clientId, Wallet ID: $walletId");
if (empty($clientId) || empty($clientSecret) || empty($walletId)) {
    logToFile($logFile, "Missing ioTec credentials.");
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Missing ioTec credentials. Please configure them in the admin panel.']);
    exit();
}

// -----------------------------------------------------------------------------
// 5. Read input & log it
// -----------------------------------------------------------------------------
header('Content-Type: application/json');
$input = file_get_contents('php://input');
$data  = json_decode($input, true);

logToFile($logFile, "Received data: " . print_r($data, true));

// -----------------------------------------------------------------------------
// 6. Check for required fields
//    NOTE: Adjust these to match exactly what you are sending from JS!
// -----------------------------------------------------------------------------
$requiredFields = ['phone_number', 'plan_id', 'router_id', 'mac_address', 'amount'];
$missingFields  = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile($logFile, "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['error' => 'Invalid input data - missing fields']);
    exit();
}

// -----------------------------------------------------------------------------
// 7. Extract data from request
// -----------------------------------------------------------------------------
$phoneNumber = trim($data['phone_number']);
$planId      = trim($data['plan_id']);
$routerId    = trim($data['router_id']);
$macAddress  = trim($data['mac_address']);
$amount      = trim($data['amount']); // e.g. "100.00" or "5000"

// For logs:
logToFile($logFile, "Fields - Phone: $phoneNumber, Plan ID: $planId, Router ID: $routerId, MAC: $macAddress, Amount: $amount");

// -----------------------------------------------------------------------------
// 8. Fetch the plan and router from your DB
// -----------------------------------------------------------------------------
$plan   = ORM::for_table('tbl_plans')->find_one($planId);
$router = ORM::for_table('tbl_routers')->find_one($routerId);

if (!$plan || !$router) {
    logToFile($logFile, "Plan or router not found. PlanID=$planId, RouterID=$routerId");
    echo json_encode(['error' => 'Plan or router not found']);
    exit();
}

$planName   = $plan->name_plan; // or whatever your column is
$routerName = $router->name;    // or whatever your column is

logToFile($logFile, "Found Plan: $planName, Router: $routerName");

// -----------------------------------------------------------------------------
// 9. Generate a unique reference
// -----------------------------------------------------------------------------
$reference = uniqid();
logToFile($logFile, "Generated order reference: $reference");

// -----------------------------------------------------------------------------
// 10. Prepare the Auth & API endpoints
// -----------------------------------------------------------------------------
$authUrl = 'https://id.iotec.io/connect/token';
$apiUrl  = 'https://pay.iotec.io/api/collections/collect';
$currency = 'UGX';  // Adjust if needed

logToFile($logFile, "Auth URL: $authUrl, API URL: $apiUrl, Currency: $currency");

// -----------------------------------------------------------------------------
// 11. Obtain OAuth 2.0 Token from ioTec Pay
// -----------------------------------------------------------------------------
function getAccessToken($authUrl, $clientId, $clientSecret) {
    $data = [
        'client_id'     => $clientId,
        'client_secret' => $clientSecret,
        'grant_type'    => 'client_credentials'
    ];
    
    $ch = curl_init($authUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        logToFile('create_iotec_payment.log', "Curl error during token request: " . curl_error($ch));
    }
    curl_close($ch);

    logToFile('create_iotec_payment.log', "Access token response: " . $response);
    $result = json_decode($response, true);
    return $result['access_token'] ?? null;
}

// -----------------------------------------------------------------------------
// 12. Send POST request to ioTec Pay
// -----------------------------------------------------------------------------
function sendJSONPost($url, $json, $accessToken) {
    $headers = [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        logToFile('create_iotec_payment.log', "Curl error during API request: " . curl_error($ch));
        return false;
    }

    logToFile('create_iotec_payment.log', "API request response: " . $result);
    curl_close($ch);
    return json_decode($result, true);
}

// -----------------------------------------------------------------------------
// 13. Get an access token
// -----------------------------------------------------------------------------
$accessToken = getAccessToken($authUrl, $clientId, $clientSecret);
if (!$accessToken) {
    logToFile($logFile, "Unable to obtain access token.");
    echo json_encode(['error' => 'Unable to obtain access token']);
    exit();
}
logToFile($logFile, "Obtained access token successfully.");

// -----------------------------------------------------------------------------
// 14. Build request payload for ioTec Pay
// -----------------------------------------------------------------------------
$req = [
    "category"                   => "MobileMoney",
    "currency"                   => $currency,
    "walletId"                   => $walletId,
    "externalId"                 => $reference,         // Unique order reference
    "payer"                      => $phoneNumber,        // e.g. "63xxxxxxxx"
    "amount"                     => $amount,            // e.g. 100.00
    "payerNote"                  => "Payment for $planName",
    "payeeNote"                  => "ioTec Payment",
    "channel"                    => "MobileMoney",
    "transactionChargesCategory" => "ChargeWallet"
];

$jsonReq = json_encode($req);
logToFile($logFile, "Payload to ioTec: " . $jsonReq);

// -----------------------------------------------------------------------------
// 15. Insert a record in tbl_payment_gateway (optional logging before request)
// -----------------------------------------------------------------------------
$d = ORM::for_table('tbl_payment_gateway')->create();
$d->username          = $phoneNumber;  // who is paying
$d->gateway           = 'ioTec Pay';
$d->plan_id           = $planId;
$d->routers_id        = $routerId;
$d->plan_name         = $planName;
$d->routers           = $routerName;
$d->price             = $amount;
$d->payment_method    = 'ioTec Pay';
$d->payment_channel   = 'ioTec';
$d->created_date      = date('Y-m-d H:i:s');
$d->pg_url_payment    = '';
$d->status            = 1;
$d->gateway_trx_id    = ''; // to be updated with ID from ioTec response
$d->save();

logToFile($logFile, "Inserted payment record into tbl_payment_gateway.");

// -----------------------------------------------------------------------------
// 16. Send the payment request to ioTec Pay
// -----------------------------------------------------------------------------
$response = sendJSONPost($apiUrl, $jsonReq, $accessToken);
if ($response === false) {
    logToFile($logFile, "Error in sending payment request.");
    echo json_encode(['error' => 'Error in sending payment request.']);
    exit();
}

// -----------------------------------------------------------------------------
// 17. Log the response & update DB record
// -----------------------------------------------------------------------------
$d->pg_request      = $jsonReq;
$d->pg_paid_response= json_encode($response);
$d->save();

logToFile($logFile, "Response from ioTec Pay: " . print_r($response, true));

// -----------------------------------------------------------------------------
// 18. Check if response has a transaction ID
// -----------------------------------------------------------------------------
if (isset($response['id'])) {
    $transactionId = $response['id'];
    $d->gateway_trx_id = $transactionId;
    $d->save();
} else {
    logToFile($logFile, "No transaction ID in response.");
    echo json_encode(['error' => 'No transaction ID in response.']);
    exit();
}

// -----------------------------------------------------------------------------
// 19. Return final status to the client
// -----------------------------------------------------------------------------
echo json_encode([
    'status'           => $response['status']        ?? 'unknown',
    'statusMessage'    => $response['statusMessage'] ?? 'No statusMessage',
    'transactionId'    => $transactionId,
    'paymentResponse'  => $response
]);
