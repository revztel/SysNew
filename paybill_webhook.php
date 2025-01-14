<?php

require_once 'config.php';
require_once 'system/orm.php';
require_once 'system/autoload/PEAR2/Autoload.php';
include "system/autoload/Hookers.php";
require_once 'system/autoload/Message.php'; // Include the Message class

// Enable full error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

ORM::configure("mysql:host=$db_host;dbname=$db_name");
ORM::configure('username', $db_user);
ORM::configure('password', $db_password);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);

// Function to manage log file lines
function logToFile($filePath, $message, $maxLines = 5000) {
    if (is_writable($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);
        $lines[] = $message;
        if (count($lines) > $maxLines) {
            $lines = array_slice($lines, count($lines) - $maxLines);
        }
        file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
    }
}

// Retrieve the timezone setting from tbl_appconfig
$timezoneConfig = ORM::for_table('tbl_appconfig')->where('setting', 'timezone')->find_one();
$timezone = $timezoneConfig ? $timezoneConfig->value : 'UTC'; // Default to UTC if not set
date_default_timezone_set($timezone); // Set the default timezone

// Retrieve the SMS URL from tbl_appconfig where setting is 'sms_url'
$smsUrlConfig = ORM::for_table('tbl_appconfig')
    ->where('setting', 'sms_url')
    ->find_one();
$smsUrl = $smsUrlConfig ? $smsUrlConfig->value : null;

// Retrieve the phone number from tbl_appconfig where setting is 'router_notifications'
$phoneConfig = ORM::for_table('tbl_appconfig')
    ->where('setting', 'router_notifications')
    ->find_one();
$adminPhone = $phoneConfig ? $phoneConfig->value : null;

// Check if payment notifications are enabled
$paymentNotificationsConfig = ORM::for_table('tbl_appconfig')
    ->where('setting', 'payment_notifications')
    ->find_one();
$paymentNotificationsEnabled = $paymentNotificationsConfig ? strtolower($paymentNotificationsConfig->value) === 'yes' : false;

// Capture the logs from input
$captureLogs = file_get_contents("php://input");
$analizzare = json_decode($captureLogs);

// Use current date and time with the default timezone
$receivedTimestamp = date('Y-m-d H:i:s');
logToFile('paybill.log', "Received at $receivedTimestamp: $captureLogs");

$transID = $analizzare->TransID ?? null;
$amount = $analizzare->TransAmount ?? null;
$billRefNumber = $analizzare->BillRefNumber ?? null;

if ($transID !== null && $amount !== null && $billRefNumber !== null) {
    logToFile('paybill.log', "Processing transaction: TransID: $transID, Amount: $amount, BillRefNumber: $billRefNumber");

    $userData = ORM::for_table('tbl_customers')
        ->where('username', $billRefNumber)
        ->find_one();

    if ($userData) {
        $username = $userData->username;
        $type = $userData->service_type;
        $routerId = $userData->router_id;
        $userId = $userData->id;
        logToFile('paybill.log', "User found: Username: $username, RouterID: $routerId, UserID: $userId");

        $routerData = ORM::for_table('tbl_routers')
            ->where('id', $routerId)
            ->find_one();
        $routerName = $routerData ? $routerData->name : 'test router';

        $planData = ORM::for_table('tbl_user_recharges')
            ->where('username', $username)
            ->order_by_desc('id')
            ->find_one();
        $planId = $planData ? $planData->plan_id : 1;
        $planName = $planData ? $planData->namebp : 'No Plan';

        // Get current date and time
        $currentDateTime = date("Y-m-d H:i:s");

        // Payment gateway record creation
        $paymentGatewayRecord = ORM::for_table('tbl_payment_gateway')->create();
        $paymentGatewayRecord->username = $username;
        $paymentGatewayRecord->gateway = 'Mpesa Paybill';
        $paymentGatewayRecord->gateway_trx_id = $transID;
        $paymentGatewayRecord->checkout = $transID;
        $paymentGatewayRecord->plan_id = $planId;
        $paymentGatewayRecord->plan_name = $planName;
        $paymentGatewayRecord->routers_id = $routerId;
        $paymentGatewayRecord->routers = $routerName;
        $paymentGatewayRecord->price = $amount;
        $paymentGatewayRecord->pg_url_payment = 'paybill.freeispradius.com';
        $paymentGatewayRecord->payment_method = 'Mpesa Paybill';
        $paymentGatewayRecord->payment_channel = 'Mpesa Paybill';
        $paymentGatewayRecord->pg_request = '';
        $paymentGatewayRecord->pg_paid_response = '';
        $paymentGatewayRecord->expired_date = $currentDateTime;
        $paymentGatewayRecord->created_date = $currentDateTime;
        $paymentGatewayRecord->paid_date = $currentDateTime;
        $paymentGatewayRecord->status = '2';

        $paymentGatewayRecord->save();
        logToFile('paybill.log', "Payment gateway record saved successfully for username: $username");

        $transaction = ORM::for_table('tbl_transactions')->create();
        $transaction->invoice = $transID;
        $transaction->username = $username;
        $transaction->plan_name = $planName;
        $transaction->price = $amount;
        $transaction->recharged_on = date("Y-m-d");
        $transaction->recharged_time = date("H:i:s");
        $transaction->expiration = $currentDateTime;
        $transaction->time = $currentDateTime;
        $transaction->method = 'Mpesa Paybill Manual';
        $transaction->routers = $routerName;
        $transaction->Type = 'Balance';
        $transaction->save();
        logToFile('paybill.log', "Transaction record saved successfully for username: $username");

        // Send SMS if payment notifications are enabled
        if ($paymentNotificationsEnabled && !empty($adminPhone) && !empty($smsUrl)) {
            $customMessage = "You Have Received a Payment:\n";
            $customMessage .= "Amount: " . $amount . "\n";
            $customMessage .= "Transaction ID: " . $transID . "\n";
            $customMessage .= "Customer Username is: " . $username;

            // Replace placeholders in the URL
            $smsUrlToUse = str_replace('[text]', urlencode($customMessage), $smsUrl);
            $smsUrlToUse = str_replace('[number]', urlencode($adminPhone), $smsUrlToUse);

            // Send the SMS
            try {
                $response = file_get_contents($smsUrlToUse);
                logToFile('paybill.log', "SMS sent to admin successfully. Response: $response");
            } catch (Exception $e) {
                logToFile('paybill.log', "Failed to send SMS to admin. Error: " . $e->getMessage());
            }
        }

        // Further processing: Balance updates, recharges, etc.
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
        logToFile('paybill.log', "User balance updated. New balance: " . $userData->balance);

        if ($userData->balance >= $planPrice && $latestRecharge && $latestRecharge->status == 'off') {
            $deleted_count = ORM::for_table('tbl_user_recharges')
                ->where('username', $username)
                ->delete_many();

            $userData->balance -= $planPrice;
            $userData->save();
            logToFile('paybill.log', "Recharged user: $username. Balance after deduction: " . $userData->balance);

            $rechargeResult = Package::rechargeUser($userId, $routerName, $planId, 'Mpesa Paybill Manual', 'Mpesa');
            logToFile('paybill.log', "Recharge result: " . json_encode($rechargeResult));
        }
    } else {
        logToFile('paybill.log', "User not found for BillRefNumber: $billRefNumber. Processing as unknown.");

        $currentDateTime = date("Y-m-d H:i:s");

        $transaction = ORM::for_table('tbl_transactions')->create();
        $transaction->invoice = $transID;
        $transaction->username = 'unknown ' . $billRefNumber;
        $transaction->plan_name = 'unknown';
        $transaction->price = $amount;
        $transaction->recharged_on = date("Y-m-d");
        $transaction->recharged_time = date("H:i:s");
        $transaction->expiration = $currentDateTime;
        $transaction->time = $currentDateTime;
        $transaction->method = 'Mpesa Paybill Manual';
        $transaction->routers = 'unknown';
        $transaction->Type = 'Balance';
        $transaction->save();
        logToFile('paybill.log', "Transaction record saved for unknown user.");

        // Send the SMS for unknown payment if notifications are enabled
        if ($paymentNotificationsEnabled && !empty($adminPhone) && !empty($smsUrl)) {
            $customMessage = "You have received a Payment of " . $amount . " from an unknown username with account no " . $billRefNumber . ". Transaction ID: " . $transID;
            $smsUrlToUse = str_replace('[text]', urlencode($customMessage), $smsUrl);
            $smsUrlToUse = str_replace('[number]', urlencode($adminPhone), $smsUrlToUse);

            try {
                $response = file_get_contents($smsUrlToUse);
                logToFile('paybill.log', "SMS sent to admin for unknown payment. Response: $response");
            } catch (Exception $e) {
                logToFile('paybill.log', "Failed to send SMS to admin for unknown payment. Error: " . $e->getMessage());
            }
        }
    }
} else {
    logToFile('paybill.log', "Missing required fields: TransID, Amount, or BillRefNumber.");
}

?>
