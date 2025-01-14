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

// Log function
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

header('Content-Type: application/json');

// Read JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

logToFile('xendit_payment.log', "Received data: " . print_r($data, true));

// Check required fields: phone_number, plan_id, router_id, mac_address
$requiredFields = ['phone_number', 'plan_id', 'router_id', 'mac_address'];
$missingFields = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile('xendit_payment.log', "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    exit();
}

$phone_number = $data['phone_number'];
$plan_id = $data['plan_id'];
$router_id = $data['router_id'];
$mac_address = $data['mac_address'];

// Fetch Xendit credentials from tbl_appconfig (xendit_secret_key, xendit_verification_token, xendit_channel)
$xendit_secret_key = ORM::for_table('tbl_appconfig')->where('setting', 'xendit_secret_key')->find_one();
$xendit_channel = ORM::for_table('tbl_appconfig')->where('setting', 'xendit_channel')->find_one();

$secretKey = $xendit_secret_key ? $xendit_secret_key->value : '';
$channel = $xendit_channel ? $xendit_channel->value : '';

if (empty($secretKey) || empty($channel)) {
    logToFile('xendit_payment.log', "Missing Xendit credentials or channel.");
    echo json_encode(['status' => 'error', 'message' => 'Xendit payment gateway not configured']);
    exit();
}

logToFile('xendit_payment.log', "Xendit credentials fetched. Channels: $channel");

// Fetch plan details
$plan = ORM::for_table('tbl_plans')->find_one($plan_id);
if (!$plan) {
    logToFile('xendit_payment.log', "Plan not found: $plan_id");
    echo json_encode(['status' => 'error', 'message' => 'Plan not found']);
    exit();
}

$price = $plan->price;
$plan_name = $plan->name_plan;

// Fetch router details
$router = ORM::for_table('tbl_routers')->find_one($router_id);
if (!$router) {
    logToFile('xendit_payment.log', "Router not found: $router_id");
    echo json_encode(['status' => 'error', 'message' => 'Router not found']);
    exit();
}
$router_name = $router->name;

logToFile('xendit_payment.log', "Plan: $plan_name, Price: $price, Router: $router_name");

// Create a pending transaction record
$trx = ORM::for_table('tbl_payment_gateway')->create();
$trx->username = $phone_number;
$trx->gateway = 'xendit';
$trx->plan_id = $plan_id;
$trx->routers = $router_name;
$trx->plan_name = $plan_name;
$trx->price = $price;
$trx->payment_method = 'Xendit';
$trx->payment_channel = 'Xendit';
$trx->created_date = date('Y-m-d H:i:s');
$trx->pg_url_payment = '';
$trx->status = 1;
$trx->gateway_trx_id = '';
$trx->save();

$trx_id = $trx->id();
logToFile('xendit_payment.log', "Transaction record created: $trx_id");

// Mock user array
$user = [
    'id' => 1, // You should identify a real user from phone_number or session if necessary
    'username' => $phone_number,
    'phonenumber' => $phone_number
];

$result = xendit_create_transaction_and_return([
    'id' => $trx_id,
    'price' => $price,
    'plan_name' => $plan_name,
    'routers' => $router_name,
    'gateway' => 'xendit'
], $user, $secretKey, $channel);

// Check result
if ($result['status'] === 'success') {
    // Update transaction with gateway_trx_id and invoice_url
    $d = ORM::for_table('tbl_payment_gateway')->find_one($trx_id);
    if ($d) {
        $d->gateway_trx_id = $result['invoice_id'];
        $d->pg_url_payment = $result['invoice_url'];
        $d->pg_request = json_encode($result);
        $d->save();
    }
    echo json_encode(['status' => 'success', 'invoice_url' => $result['invoice_url']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to create Xendit invoice']);
}

/**
 * Function to create a Xendit invoice and return invoice_url
 */
function xendit_create_transaction_and_return($trx, $user, $secretKey, $channelString) {
    // Channels configured as comma-separated, convert to array
    $channels = array_filter(array_map('trim', explode(',', $channelString)));
    if (empty($channels)) {
        return ['status' => 'error', 'message' => 'No payment channels configured'];
    }

    // Xendit invoice creation
    $json = [
        'external_id' => (string)$trx['id'],
        'amount' => $trx['price'],
        'description' => $trx['plan_name'],
        'customer' => [
            'mobile_number' => $user['phonenumber'],
        ],
        'customer_notification_preference' => [
            'invoice_created' => ['whatsapp', 'sms'],
            'invoice_reminder' => ['whatsapp', 'sms'],
            'invoice_paid' => ['whatsapp', 'sms'],
            'invoice_expired' => ['whatsapp', 'sms']
        ],
        'payment_methods' => array_values($channels),
        'success_redirect_url' => APP_URL . 'index.php?_route=order/view/' . $trx['id'] . '/check',
        'failure_redirect_url' => APP_URL . 'index.php?_route=order/view/' . $trx['id'] . '/check'
    ];

    $ch = curl_init('https://api.xendit.co/v2/invoices');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($secretKey . ':')
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return ['status' => 'error', 'message' => "CURL Error: $error"];
    }
    curl_close($ch);
    $result = json_decode($response, true);

    if (empty($result['id'])) {
        return ['status' => 'error', 'message' => 'No invoice ID returned from Xendit'];
    }

    return [
        'status' => 'success',
        'invoice_id' => $result['id'],
        'invoice_url' => $result['invoice_url']
    ];
}
