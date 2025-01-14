<?php
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

// Log the received input data
$input = file_get_contents('php://input');
$data = json_decode($input, true);
logToFile('create_pix_payment.log', "Received data: " . print_r($data, true));

// Extract necessary fields
$buyer_name = $data['buyer_name'];
$buyer_email = $data['buyer_email'];
$buyer_phone = $data['buyer_phone'];
$amount = $data['amount'];
$planId = $data['plan_id'];
$routerId = $data['router_id'];

// Generate a unique reference for the order
$reference = uniqid();

$accessToken = 'YOUR_ACCESS_TOKEN'; // Replace with your actual access token
$baseUrl = 'https://sandbox-api.spinpay.com.br/v1';

/**
 * @param $url
 * @param $isPost
 * @param $json
 * @param $authorization
 * @return mixed
 */
function sendJSONPost($url, $isPost, $json, $authorization) {
    $headers = [
        "Content-Type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Authorization: Bearer $authorization",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    if ($isPost) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        exit;
    }

    curl_close($ch);
    $response = json_decode($result, true);
    return $response;
}

$api_endpoint = "/checkouts/payments";
$url = $baseUrl . $api_endpoint;

$isPost = true;

// Define the redirect URL
$redirectUrl = APP_URL . '/pix_success.html?username=' . urlencode($buyer_phone) . '&password=1234';

$req = [
    "merchantOrderReference" => $reference,
    "transactionId" => "D3AA1FC8372E430E8236649DB5EBD08E", // Example transaction ID
    "referenceId" => uniqid(),
    "merchantName" => "Your Store",
    "storeName" => "Your Store Branch",
    "amount" => [
        "value" => $amount,
        "currency" => "BRL",
        "details" => [
            "taxValue" => 0.9
        ]
    ],
    "delayToAutoCancel" => 15,
    "paymentMethod" => [
        "type" => "pix",  // Changed to PIX payment type
        "authorizationType" => "manually_authorized"
    ],
    "paymentFlow" => [
        "returnUrl" => $redirectUrl,
        "cancelUrl" => APP_URL
    ],
    "shopper" => [
        "firstName" => $buyer_name,
        "lastName" => "Doe", // Static last name; adjust as needed
        "document" => "64262091040", // Example CPF
        "documentType" => "CPF",
        "email" => $buyer_email,
        "phone" => [
            "country" => "55",
            "number" => $buyer_phone
        ],
        "ip" => "255.110.231.231",
        "locale" => "pt-BR"
    ],
    "shipping" => [
        "value" => 49.99,
        "company" => "Correios",
        "address" => [
            "country" => "BRA",
            "street" => "Praia de Botafogo St.",
            "number" => "300",
            "complement" => "3o. Andar",
            "neighborhood" => "Botafogo",
            "postalCode" => "22250040",
            "city" => "Rio de Janeiro",
            "state" => "RJ"
        ]
    ],
    "billingAddress" => [
        "country" => "BRA",
        "street" => "Rua Capote Valente",
        "number" => "39",
        "neighborhood" => "Pinheiros",
        "postalCode" => "05409000",
        "city" => "São Paulo",
        "state" => "SP"
    ],
    "items" => [
        [
            "id" => "132981",
            "description" => "Product Test",
            "value" => $amount,
            "quantity" => 1,
            "discount" => 0,
            "taxAmount" => 0.9,
            "amountExcludingTax" => $amount - 0.9,
            "amountIncludingTax" => $amount
        ]
    ],
    "orderUrl" => APP_URL . "/orders/v32478982",
    "callbackUrl" => APP_URL . '/pix_webhook.php'
];

$authorization = $accessToken;

// Get the plan name and router name
$plan = ORM::for_table('tbl_plans')->where('id', $planId)->find_one();
$router = ORM::for_table('tbl_routers')->where('id', $routerId)->find_one();

if (!$plan || !$router) {
    echo json_encode(['error' => 'Invalid plan or router id']);
    exit();
}

$plan_name = $plan->name_plan;
$router_name = $router->name;

// Insert payment gateway record before sending request
$d = ORM::for_table('tbl_payment_gateway')->create();
$d->username = $buyer_phone;
$d->gateway = 'PIX';
$d->plan_id = $planId;
$d->plan_name = $plan_name;
$d->routers_id = $routerId;
$d->routers = $router_name;
$d->price = $amount;
$d->payment_method = 'PIX';
$d->payment_channel = 'PIX';
$d->created_date = date('Y-m-d H:i:s');
$d->pg_url_payment = '';
$d->status = 1;
$d->gateway_trx_id = $reference;
$d->save();

$response = sendJSONPost($url, $isPost, json_encode($req), $authorization);

// Update payment gateway record with response
$d->pg_request = json_encode($req);
$d->pg_paid_response = json_encode($response);
$d->save();

echo json_encode($response);
?>