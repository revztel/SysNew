<?php
require_once '../init.php';

global $config, $ui;

function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

$logFile = '../xendit_payment.log';
header('Content-Type: application/json');

// 1. Parse JSON input
$inputData = file_get_contents('php://input');
logToFile($logFile, "Received data: " . print_r($inputData, true));

$data = json_decode($inputData, true);
if (!$data) {
    logToFile($logFile, "Invalid JSON input.");
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    exit();
}

// 2. Required fields
$requiredFields = ['phone_number', 'plan_id', 'router_id', 'mac_address'];
$missingFields  = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile($logFile, "Missing fields: " . implode(', ', $missingFields));
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

// 3. Extract posted data
// 1. Extract the necessary data
$phone_number = trim($data['phone_number']);
$plan_id      = trim($data['plan_id']);
$router_id    = trim($data['router_id']);
$mac_address  = trim($data['mac_address']);

// === Phone Number Transformation Start ===
if (strpos($phone_number, '0') === 0) {
    // Remove the leading '0' and prepend '63'
    $phone_number = '63' . substr($phone_number, 1);
} elseif (strpos($phone_number, '63') === 0) {
    // Leave as is (already starts with 63)
} else {
    // Invalid phone format
    logToFile($logFile, "Invalid phone format: $phone_number");
    echo json_encode(['error' => 'Invalid phone number format']);
    exit();
}
// === Phone Number Transformation End ===

// 2. Build the final username by combining the phone number with the last 4 characters of MAC
//please note clean last four is juts the last 4 characters
$cleanLastFour  = substr($mac_address, -4);
$final_username = $phone_number . '-' . $cleanLastFour;  // e.g. "63912345678-9ABC"

// 3. Log the result
logToFile($logFile, "Computed username: $final_username from phone=$phone_number, mac=$mac_address");


// 5. Fetch Xendit credentials
$xendit_secret_key = ORM::for_table('tbl_appconfig')
    ->where('setting', 'xendit_secret_key')
    ->find_one();
$xendit_channel = ORM::for_table('tbl_appconfig')
    ->where('setting', 'xendit_channel')
    ->find_one();

$secretKey = $xendit_secret_key ? $xendit_secret_key->value : '';
$channel   = $xendit_channel    ? $xendit_channel->value    : '';

if (empty($secretKey) || empty($channel)) {
    logToFile($logFile, "Missing Xendit credentials or channel");
    echo json_encode(['status' => 'error', 'message' => 'Xendit not configured']);
    exit();
}

// 6. Fetch plan details
$plan = ORM::for_table('tbl_plans')->find_one($plan_id);
if (!$plan) {
    logToFile($logFile, "Plan not found: $plan_id");
    echo json_encode(['status' => 'error', 'message' => 'Plan not found']);
    exit();
}
$price     = $plan->price;
$plan_name = $plan->name_plan;

// 7. Fetch router details
$router = ORM::for_table('tbl_routers')->find_one($router_id);
if (!$router) {
    logToFile($logFile, "Router not found: $router_id");
    echo json_encode(['status' => 'error', 'message' => 'Router not found']);
    exit();
}
$router_name = $router->name;

logToFile($logFile, "Plan: $plan_name, Price: $price, Router: $router_name");

// 8. Create a pending transaction record
$trx = ORM::for_table('tbl_payment_gateway')->create();
$trx->username        = $final_username;   // use combined username
$trx->gateway         = 'xendit';
$trx->plan_id         = $plan_id;
$trx->routers         = $router_name;
$trx->routers_id      = $router_id;
$trx->plan_name       = $plan_name;
$trx->price           = $price;
$trx->payment_method  = 'Xendit';
$trx->payment_channel = 'Xendit';
$trx->created_date    = date('Y-m-d H:i:s');
$trx->status          = 1; // Pending
$trx->save();

$trx_id = $trx->id();
logToFile($logFile, "Transaction record created: $trx_id, username: $final_username");

// 9. Create the Xendit invoice
$invoice = xendit_create_transaction(
    $trx_id,
    $final_username,
    $price,
    $plan_name,
    $secretKey,
    $channel,
    $router_id
);

// 10. Check creation result
if ($invoice['status'] === 'success') {
    // Save invoice info
    $trx->gateway_trx_id = $invoice['invoice_id'];
    $trx->pg_url_payment = $invoice['invoice_url'];
    $trx->save();

    logToFile($logFile, "Invoice created successfully at URL: " . $invoice['invoice_url']);
    echo json_encode([
        'status'      => 'success',
        'invoice_url' => $invoice['invoice_url']
    ]);
} else {
    logToFile($logFile, "Invoice creation failed: " . $invoice['message']);
    echo json_encode([
        'status'  => 'error',
        'message' => $invoice['message'] ?? 'Failed to create invoice'
    ]);
}
exit();

/**
 * Create a Xendit invoice
 *
 * @param int    $trx_id
 * @param string $final_username
 * @param float  $price
 * @param string $plan_name
 * @param string $secretKey
 * @param string $channels   Comma-separated payment channels
 * @param int    $router_id
 *
 * @return array  [status => 'success'/'error', invoice_id => ..., invoice_url => ...]
 */
function xendit_create_transaction(
    $trx_id,
    $final_username,
    $price,
    $plan_name,
    $secretKey,
    $channels,
    $router_id
) {
    // success = login user automatically
    $successUrl = APP_URL . "/login.php?username=$final_username&password=1234";

    // failure = custom page. Remember to customize
    $failureUrl = APP_URL . '/xendit/index1.html';

    // Build Xendit payload
    $payload = [
        'external_id' => (string)$trx_id,
        'amount'      => $price,
        'description' => $plan_name,
        'customer'    => [
            // This phone number is just for Xendit notifications. We can set it to the final username or phone only
            'mobile_number' => $final_username
        ],
        'payment_methods'      => explode(',', $channels),
        'success_redirect_url' => $successUrl,
        'failure_redirect_url' => $failureUrl
    ];

    // cURL to Xendit
    $ch = curl_init('https://api.xendit.co/v2/invoices');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . 'Basic ' . base64_encode($secretKey . ':')
    ]);

    $response = curl_exec($ch);
    $errorNo  = curl_errno($ch);
    $errorMsg = curl_error($ch);
    curl_close($ch);

    if ($errorNo) {
        return [
            'status'  => 'error',
            'message' => "cURL Error: $errorMsg"
        ];
    }

    $result = json_decode($response, true);
    if (isset($result['id'])) {
        return [
            'status'     => 'success',
            'invoice_id' => $result['id'],
            'invoice_url'=> $result['invoice_url']
        ];
    }

    return [
        'status'  => 'error',
        'message' => $result['message'] ?? 'Unknown error from Xendit'
    ];
}
