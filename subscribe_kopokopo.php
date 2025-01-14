<?php
global $conn;

require 'vendor/autoload.php';

use Kopokopo\SDK\K2;
//Use this to accept Kopokopo API calls
// Explicitly state the client ID, client secret, API key, and webhook URL
$clientId = 'sIpQ6Xu_46G6QuxvHnyUdiv9Wq-dIEDNtzTgkhc3IE0';
$clientSecret = 'BbgE76Sms1gFY65qMgYuEewBpxpRHU5Bzt6uJjyiN80';
$apiKey = '7c0534f96c85f255b822d20072e56c1c58cfedc1';
$webhookEndpoint = 'kopokopo_webhook.php';
$baseUrl = 'https://api.kopokopo.com';
$tillNumber = '9104135';

// Construct the full webhook URL
$webhookUrl = 'https://eldonet.ispledger.com/' . $webhookEndpoint; // Replace with your actual domain

$options = [
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'apiKey' => $apiKey,
    'baseUrl' => $baseUrl
];

$K2 = new K2($options);

$tokens = $K2->TokenService();
$result = $tokens->getToken();

if ($result['status'] == 'success') {
    $data = $result['data'];
    $accessToken = $data['accessToken'];

    $webhooks = $K2->Webhooks();

    // Log the details being used for the webhook subscription
    error_log("Client ID: $clientId");
    error_log("Client Secret: $clientSecret");
    error_log("API Key: $apiKey");
    error_log("Webhook URL being registered: $webhookUrl");
    error_log("Till Number: $tillNumber");

    $response = $webhooks->subscribe([
        'eventType' => 'buygoods_transaction_received',
        'url' => $webhookUrl, // Use the full webhook URL
        'scope' => 'till',
        'scopeReference' => $tillNumber, // Use the till number
        'accessToken' => $accessToken
    ]);

    // Log the response
    error_log("Response: " . print_r($response, true));

    if ($response['status'] == 'success') {
        echo "The resource location is:" . json_encode($response['location']);
    }
}
