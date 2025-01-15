<?php
require_once '../init.php';
global $config, $ui;
$logFilePath = 'xendit_webhook.log';

function logToFile($filePath, $message, $maxLines = 5000)
{
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;

    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// ------------------------------------------------
// 1) Read the Xendit webhook payload
// ------------------------------------------------
$inputData = file_get_contents("php://input");
logToFile($logFilePath, "Received raw data: " . $inputData);

$event = json_decode($inputData, true);
if (!$event) {
    logToFile($logFilePath, "Invalid JSON data received.");
    http_response_code(400);
    exit();
}

// We expect Xendit to send fields: id, status, amount
$requiredFields = ['id', 'status', 'amount'];
foreach ($requiredFields as $f) {
    if (!isset($event[$f])) {
        logToFile($logFilePath, "Missing field: $f");
        http_response_code(400);
        exit();
    }
}

$invoiceId  = $event['id'];      // Xendit invoice ID
$status     = $event['status'];  // 'PAID', 'PENDING', 'EXPIRED'
$amountPaid = $event['amount'];

logToFile($logFilePath, "Webhook for invoice ID: $invoiceId, status: $status");

// ------------------------------------------------
// 2) Only proceed if invoice is PAID
// ------------------------------------------------
if ($status !== 'PAID') {
    logToFile($logFilePath, "Invoice not paid. No action taken.");
    http_response_code(200);
    exit();
}

// ------------------------------------------------
// 3) Find PaymentGateway record by invoice ID
// ------------------------------------------------
$paymentGatewayRecord = ORM::for_table('tbl_payment_gateway')
    ->where('gateway_trx_id', $invoiceId)
    ->find_one();

if (!$paymentGatewayRecord) {
    logToFile($logFilePath, "No payment gateway record found for invoice ID: $invoiceId");
    http_response_code(200);
    exit();
}

$uname          = $paymentGatewayRecord->username;
$plan_id        = $paymentGatewayRecord->plan_id;
$routerName     = $paymentGatewayRecord->routers;
$gatewayMethod  = $paymentGatewayRecord->gateway;          // e.g. 'xendit'
$paymentChannel = $paymentGatewayRecord->payment_channel;  // e.g. 'GCASH'
$router_id      = $paymentGatewayRecord->routers_id;

// If routers_id is missing, fallback by routerName
if (empty($router_id)) {
    $routerRow = ORM::for_table('tbl_routers')->where('name', $routerName)->find_one();
    if (!$routerRow) {
        logToFile($logFilePath, "Router not found by name: $routerName");
        http_response_code(200);
        exit();
    }
    $router_id = $routerRow->id;
}

logToFile($logFilePath, "Found user: $uname, plan_id: $plan_id, router_id: $router_id");

// ------------------------------------------------
// 4) Fetch the user from tbl_customers
// ------------------------------------------------
$user = ORM::for_table('tbl_customers')->where('username', $uname)->find_one();
if (!$user) {
    logToFile($logFilePath, "User not found: $uname");
    http_response_code(200);
    exit();
}

// ------------------------------------------------
// 5) Fetch the plan from tbl_plans
// ------------------------------------------------
$plan = ORM::for_table('tbl_plans')->find_one($plan_id);
if (!$plan) {
    logToFile($logFilePath, "Plan not found: $plan_id");
    http_response_code(200);
    exit();
}

$plan_name = $plan->name_plan;
$plan_type = $plan->type;      // e.g. 'Limited' or 'Unlimited'
$validity  = $plan->validity;
$units     = $plan->validity_unit;

logToFile($logFilePath, "Plan: $plan_name, Type: $plan_type, Validity: $validity $units");

// ------------------------------------------------
// 6) Fetch the configured timezone from tbl_appconfig
// ------------------------------------------------
$tzRec = ORM::for_table('tbl_appconfig')->where('setting', 'timezone')->find_one();
if ($tzRec) {
    $timezoneString = $tzRec->value; // e.g. "Africa/Nairobi"
} else {
    $timezoneString = 'GMT+3'; // fallback
}
logToFile($logFilePath, "Using Timezone: $timezoneString");

// ------------------------------------------------
// 7) Calculate expiry time
// ------------------------------------------------
$now = new DateTime('now', new DateTimeZone($timezoneString));
$unit_in_seconds = [
    'Mins'   => 60,
    'Hrs'    => 3600,
    'Days'   => 86400,
    'Months' => 2592000,
];
$unit_seconds = isset($unit_in_seconds[$units]) ? $unit_in_seconds[$units] : 86400;

$expiry_timestamp = $now->getTimestamp() + ($validity * $unit_seconds);
$expiry_datetime  = new DateTime("@$expiry_timestamp");
$expiry_datetime->setTimezone(new DateTimeZone($timezoneString));
$expiry_date = $expiry_datetime->format('Y-m-d');
$expiry_time = $expiry_datetime->format('H:i:s');

logToFile($logFilePath, "Calculated expiry date/time: $expiry_date $expiry_time");

// ------------------------------------------------
// 8) Clear old recharges & Insert new recharge
// ------------------------------------------------
$recharged_on   = $now->format('Y-m-d');
$recharged_time = $now->format('H:i:s');

$existing_recharges = ORM::for_table('tbl_user_recharges')
    ->where('username', $uname)
    ->find_many();

foreach ($existing_recharges as $recharge) {
    $recharge->delete();
}
logToFile($logFilePath, "Deleted existing recharges for $uname");

try {
    $rechargeRecord = ORM::for_table('tbl_user_recharges')->create([
        'customer_id'    => $user->id,
        'username'       => $uname,
        'plan_id'        => $plan_id,
        'namebp'         => $plan_name,
        'recharged_on'   => $recharged_on,
        'recharged_time' => $recharged_time,
        'expiration'     => $expiry_date,
        'time'           => $expiry_time,
        'status'         => "on",
        'method'         => ucfirst($gatewayMethod) . '-' . ($paymentChannel ?: 'N/A'),
        'routers'        => $routerName,
        'type'           => $plan_type
    ]);
    $rechargeRecord->save();
    logToFile($logFilePath, "Recharge record inserted for $uname");
} catch (Exception $e) {
    logToFile($logFilePath, "Error inserting recharge record: " . $e->getMessage());
    http_response_code(500);
    exit();
}

// ------------------------------------------------
// 9) Insert transaction record in tbl_transactions
// ------------------------------------------------
try {
    $shortInvoiceId = substr($invoiceId, 0, 10);
    $transactionRecord = ORM::for_table('tbl_transactions')->create([
        'invoice'        => $shortInvoiceId,
        'username'       => $uname,
        'plan_name'      => $plan_name,
        'price'          => $amountPaid,
        'recharged_on'   => $recharged_on,
        'recharged_time' => $recharged_time,
        'expiration'     => $expiry_date,
        'time'           => $expiry_time,
        'method'         => ucfirst($gatewayMethod) . '-' . ($paymentChannel ?: 'N/A'),
        'routers'        => $routerName,
        'type'           => $plan_type
    ]);
    $transactionRecord->save();
    logToFile($logFilePath, "Transaction record inserted for $uname");
} catch (Exception $e) {
    logToFile($logFilePath, "Error inserting transaction record: " . $e->getMessage());
    http_response_code(500);
    exit();
}

// ------------------------------------------------
// 10) Mark payment gateway record as "paid"
// ------------------------------------------------
try {
    $nowStr = $now->format('Y-m-d H:i:s');
    $paymentGatewayRecord->status           = 2; // 2 => Paid
    $paymentGatewayRecord->paid_date        = $nowStr;
    $paymentGatewayRecord->pg_paid_response = json_encode($event);
    $paymentGatewayRecord->gateway_trx_id   = $invoiceId; // Overwrite with final invoice ID
    $paymentGatewayRecord->expired_date     = $expiry_date . ' ' . $expiry_time;
    $paymentGatewayRecord->save();

    logToFile($logFilePath, "Payment gateway record updated for $uname");
} catch (Exception $e) {
    logToFile($logFilePath, "Error updating payment gateway record: " . $e->getMessage());
    http_response_code(500);
    exit();
}

// ------------------------------------------------
// 11) Prepare for adding user to router
// ------------------------------------------------
$routerId = $router_id;  // for adduser.php
$plans    = $plan;       // pass the plan object
// We assume that global $config, $ui are already set

// ------------------------------------------------
// 12) (Optional) Send the user an invoice (SMS/Email)
// ------------------------------------------------
$customer = ORM::for_table('tbl_customers')
    ->where('username', $uname)
    ->find_one();

if ($customer) {

    $cust = [
        'phonenumber' => $customer->phonenumber,
        'fullname'    => $customer->fullname,
        'password'    => $customer->password,
        'email'    => $customer->email, // or pppoe_password, etc.
    ];

    $trx = [
        'invoice'        => $invoiceId,
        'recharged_on'   => $recharged_on,
        'recharged_time' => $recharged_time,
        'method'         => $paymentGatewayRecord->gateway . "-" . $invoiceId,
        'type'           => $plan_type,
        'plan_name'      => $plan_name,
        'price'          => $amountPaid,
        'username'       => $uname,
        'expiration'     => $expiry_date,
        'time'           => $expiry_time
    ];


    // Fetch the 'hotspot_sms' setting from tbl_appconfig
    $configData2 = ORM::for_table('tbl_appconfig')->find_array();
    if ($configData2) {
        $config = array_column($configData2, 'value', 'setting');
    } else {
    }

    $service_type = strtolower($customer->service_type);

    if ($service_type === 'hotspot') {
        if (!empty($config['hotspot_sms']) && strtolower($config['hotspot_sms']) === 'yes') {
            try {
                Message::sendInvoice($cust, $trx);
            } catch (Exception $e) {
            }
        } else {
        }
    } else {
        try {
            Message::sendInvoice($cust, $trx);
        } catch (Exception $e) {
        }
    }
}

// ------------------------------------------------
// 13) Include adduser.php for router configuration
// ------------------------------------------------
$file_path = __DIR__ . '../../system/adduser.php';
logToFile($logFilePath, "Attempting to include adduser.php at: $file_path");

if (file_exists($file_path)) {
    include_once $file_path;
} else {
}

// ------------------------------------------------
// 14) Done
// ------------------------------------------------
logToFile($logFilePath, "Xendit webhook processing completed successfully for $uname");
http_response_code(200);
