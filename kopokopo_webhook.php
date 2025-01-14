<?php
require_once 'config.php';
require_once 'system/orm.php';
require_once 'system/autoload/PEAR2/Autoload.php';
include "system/autoload/Hookers.php";

ORM::configure("mysql:host=$db_host;dbname=$db_name");
ORM::configure('username', $db_user);
ORM::configure('password', $db_password);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);

// Retrieve the timezone setting from tbl_settings
$timezoneConfig = ORM::for_table('tbl_appconfig')->where('setting', 'timezone')->find_one();
$timezone = $timezoneConfig ? $timezoneConfig->value : 'UTC'; // Default to UTC if not set
date_default_timezone_set($timezone); // Set the default timezone

// Log to kopokopo_webhook.log
function logToFile($message) {
    $filePath = 'kopokopo_webhook.log';
    file_put_contents($filePath, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

logToFile("Webhook received.");

$hashbackApiKeyConfig = ORM::for_table('tbl_appconfig')->where('setting', 'hashback_api_key')->find_one();
$hashbackApiKey = $hashbackApiKeyConfig ? $hashbackApiKeyConfig->value : 'default_api_key';

$smsUrlConfig = ORM::for_table('tbl_appconfig')->where('setting', 'sms_url')->find_one();
$smsUrl = $smsUrlConfig ? $smsUrlConfig->value : 'https://example.com/sms/send?api=YOUR_API_KEY&SenderId=YOUR_SENDER_ID&msg=[text]&phone=[number]';

$paymentNotificationsConfig = ORM::for_table('tbl_appconfig')->where('setting', 'payment_notifications')->find_one();
$paymentNotificationsEnabled = $paymentNotificationsConfig ? strtolower($paymentNotificationsConfig->value) === 'yes' : false;

$adminPhoneConfig = ORM::for_table('tbl_appconfig')->where('setting', 'router_notifications')->find_one();
$adminPhone = $adminPhoneConfig ? $adminPhoneConfig->value : null;

$captureLogs = file_get_contents("php://input");
$analizzare = json_decode($captureLogs);

$topic = $analizzare->topic ?? '';
$id = $analizzare->id ?? '';
$createdAt = $analizzare->created_at ?? '';
$eventType = $analizzare->event->type ?? '';
$resourceId = $analizzare->event->resource->id ?? '';
$amount = $analizzare->event->resource->amount ?? null;
$status = $analizzare->event->resource->status ?? '';
$system = $analizzare->event->resource->system ?? '';
$currency = $analizzare->event->resource->currency ?? '';
$reference = $analizzare->event->resource->reference ?? '';
$tillNumber = $analizzare->event->resource->till_number ?? '';
$originationTime = $analizzare->event->resource->origination_time ?? '';
$hashedSenderPhone = $analizzare->event->resource->hashed_sender_phone ?? '';

if ($reference !== null && $amount !== null && $hashedSenderPhone !== null) {
    $decodedPhoneNumber = decodePhoneNumber($hashedSenderPhone, $hashbackApiKey);
    $phoneNumberLast9Digits = substr($decodedPhoneNumber, -9);

    $userData = ORM::for_table('tbl_customers')
        ->where_like('phonenumber', "%$phoneNumberLast9Digits")
        ->find_one();

    if ($userData) {
        $username = $userData->username;
        $routerId = $userData->router_id;
        $userId = $userData->id;

        $routerData = ORM::for_table('tbl_routers')
            ->where('id', $routerId)
            ->find_one();
        $routerName = $routerData ? $routerData->name : 'test router';

        $planData = ORM::for_table('tbl_user_recharges')
            ->where('username', $username)
            ->order_by_desc('id')
            ->find_one();
        $planId = $planData ? $planData->plan_id : 1;
        $planName = $planData ? $planData->namebp : 'test';

        $currentDateTime = date("Y-m-d H:i:s"); // Current date and time

        $paymentGatewayRecord = ORM::for_table('tbl_payment_gateway')->create();
        $paymentGatewayRecord->username = $username;
        $paymentGatewayRecord->gateway = 'Kopokopo Manual';
        $paymentGatewayRecord->gateway_trx_id = $reference;
        $paymentGatewayRecord->checkout = $id;
        $paymentGatewayRecord->plan_id = $planId;
        $paymentGatewayRecord->plan_name = $planName;
        $paymentGatewayRecord->routers_id = $routerId;
        $paymentGatewayRecord->routers = $routerName;
        $paymentGatewayRecord->price = $amount;
        $paymentGatewayRecord->pg_url_payment = 'freeispradius.com';
        $paymentGatewayRecord->payment_method = 'kopokopo';
        $paymentGatewayRecord->payment_channel = 'kopokopo';
        $paymentGatewayRecord->pg_request = '';
        $paymentGatewayRecord->pg_paid_response = '';
        $paymentGatewayRecord->expired_date = $currentDateTime;
        $paymentGatewayRecord->created_date = $currentDateTime;
        $paymentGatewayRecord->paid_date = $currentDateTime;
        $paymentGatewayRecord->status = '2';

        $paymentGatewayRecord->save();

        $transaction = ORM::for_table('tbl_transactions')->create();
        $transaction->invoice = $reference;
        $transaction->username = $username;
        $transaction->plan_name = $planName;
        $transaction->price = $amount;
        $transaction->recharged_on = date("Y-m-d");
        $transaction->recharged_time = date("H:i:s");
        $transaction->expiration = $currentDateTime;
        $transaction->time = $currentDateTime;
        $transaction->method = 'Kopokopo Manual';
        $transaction->routers = $routerName;
        $transaction->Type = 'Balance';
        $transaction->save();

        logToFile("Payment received and associated with user: $username, Amount: $amount, Reference: $reference");

        $latestRecharge = ORM::for_table('tbl_user_recharges')
            ->where('customer_id', $userId)
            ->order_by_desc('id')
            ->find_one();

        $planData = ORM::for_table('tbl_plans')
            ->where('id', $planId)
            ->find_one();
        $planPrice = $planData ? $planData->price : 0;

        $userData->balance += $amount;
        $userData->save();

        if ($userData->balance >= $planPrice && $latestRecharge && $latestRecharge->status == 'off') {
            $deleted_count = ORM::for_table('tbl_user_recharges')
                ->where('username', $username)
                ->delete_many();

            $userData->balance -= $planPrice;
            $userData->save();

            $rechargeResult = Package::rechargeUser($userId, $routerName, $planId, 'Kopokopo Manual', 'kopokopo');
            logToFile("Recharge completed for user: $username with plan: $planName");
        }

        if ($paymentNotificationsEnabled && !empty($adminPhone)) {
            $customMessage = "You have received a Payment:\n";
            $customMessage .= "Amount: " . $amount . "\n";
            $customMessage .= "Transaction ID: " . $reference . "\n";
            $customMessage .= "Customer Username is: " . $username;

            $smsUrlAdmin = str_replace('[text]', urlencode($customMessage), $smsUrl);
            $smsUrlAdmin = str_replace('[number]', urlencode($adminPhone), $smsUrlAdmin);

            $response = file_get_contents($smsUrlAdmin);
            if ($response !== false && stripos($response, 'Error') === false) {
                logToFile("SMS sent to admin for user: $username, Amount: $amount");
            }
        }
    } else {
        logToFile("Payment received for unknown user. Amount: $amount, Reference: $reference");

        $transaction = ORM::for_table('tbl_transactions')->create();
        $transaction->invoice = $reference;
        $transaction->username = 'unknown ' . $decodedPhoneNumber;
        $transaction->plan_name = 'unknown';
        $transaction->price = $amount;
        $transaction->recharged_on = date("Y-m-d");
        $transaction->recharged_time = date("H:i:s");
        $transaction->expiration = date("Y-m-d H:i:s");
        $transaction->time = date("Y-m-d H:i:s");
        $transaction->method = 'Kopokopo Manual';
        $transaction->routers = 'unknown';
        $transaction->Type = 'Balance';
        $transaction->save();

        if ($paymentNotificationsEnabled && !empty($adminPhone)) {
            $customMessage = "You have received a Payment of " . $amount . " from an unknown username with account no " . $decodedPhoneNumber . ". Transaction ID: " . $reference;
            $smsUrlUnknown = str_replace('[text]', urlencode($customMessage), $smsUrl);
            $smsUrlUnknown = str_replace('[number]', urlencode($adminPhone), $smsUrlUnknown);

            $response = file_get_contents($smsUrlUnknown);
            if ($response !== false && stripos($response, 'Error') === false) {
                logToFile("SMS sent to admin for unknown payment. Amount: $amount");
            }
        }

        $customerMessage = "Dear $decodedPhoneNumber, we couldn't link your payment of $amount to any account as the number wasn't used during registration. Please contact our support center to activate your account.";
        
        $smsUrlCustomer = str_replace('[text]', urlencode($customerMessage), $smsUrl);
        $smsUrlCustomer = str_replace('[number]', urlencode($decodedPhoneNumber), $smsUrlCustomer);

        $result = file_get_contents($smsUrlCustomer);
        if ($result !== false && stripos($result, 'Error') === false) {
            logToFile("SMS sent to customer for unknown payment. Phone: $decodedPhoneNumber, Amount: $amount");
        }
    }
}

function decodePhoneNumber($hash, $apiKey) {
    $url = "https://api.hashback.co.ke/decode";
    $data = array(
        'hash' => $hash,
        'API_KEY' => $apiKey
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);
    return $responseData['ResultCode'] == '0' ? $responseData['MSISDN'] : null;
}

?>
