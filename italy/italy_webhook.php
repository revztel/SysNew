<?php
/**
 * italy_webhook.php
 * 
 * Once this file receives a JSON with a "username" key, 
 * it automatically processes recharges, sets plan_id=1, price=1, router_id=1,
 * and finally includes adduser.php to configure the user on the router.
 */

// 1) Initialization
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../init.php'; // Adjust if needed (e.g., ./init.php)
global $config, $ui;

// Log file path
$logFilePath = __DIR__ . '/italy_webhook.log';

/**
 * Helper: Log to a file
 */
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;

    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// ------------------------------------------------
// 2) Read & parse incoming JSON (we only need "username")
// ------------------------------------------------
$rawData = file_get_contents('php://input');
logToFile($logFilePath, "Received raw data: $rawData");

$event = json_decode($rawData, true);
if (!$event) {
    logToFile($logFilePath, "Invalid JSON data received.");
    http_response_code(400);
    exit;
}

// Check that we have a 'username'
if (!isset($event['username'])) {
    logToFile($logFilePath, "Missing 'username' in JSON payload.");
    http_response_code(400);
    exit;
}

// Use the username from the webhook
$uname = trim($event['username']);

// Hard-code these values
$plan_id   = 1;
$price     = 1;
$router_id = 1;

logToFile($logFilePath, "Starting Italy webhook processing for username: $uname (plan_id=$plan_id, price=$price, router_id=$router_id)");

// ------------------------------------------------
// 3) Find (or confirm) user in tbl_customers
// ------------------------------------------------
$user = ORM::for_table('tbl_customers')->where('username', $uname)->find_one();
if (!$user) {
    logToFile($logFilePath, "User not found in tbl_customers: $uname");
    http_response_code(200); // 200 so the webhook doesn't retry
    exit;
}
logToFile($logFilePath, "Found user record in tbl_customers: $uname (ID: {$user->id})");

// ------------------------------------------------
// 4) Fetch plan #1
// ------------------------------------------------
$plan = ORM::for_table('tbl_plans')->find_one($plan_id);
if (!$plan) {
    logToFile($logFilePath, "Plan not found: ID=$plan_id");
    http_response_code(200);
    exit;
}

$plan_name = $plan->name_plan;
$plan_type = $plan->type;          // e.g. "Limited" or "Unlimited"
$validity  = $plan->validity;      // e.g. 30
$units     = $plan->validity_unit; // e.g. "Days"

logToFile($logFilePath, "Plan found => [ID=$plan_id, name=$plan_name, type=$plan_type, validity=$validity $units]");

// ------------------------------------------------
// 5) Determine timezone from tbl_appconfig (or fallback)
// ------------------------------------------------
$tzRec = ORM::for_table('tbl_appconfig')->where('setting', 'timezone')->find_one();
if ($tzRec) {
    $timezoneString = $tzRec->value;
} else {
    $timezoneString = 'UTC';
}

logToFile($logFilePath, "Using timezone: $timezoneString");
$now = new DateTime('now', new DateTimeZone($timezoneString));

// ------------------------------------------------
// 6) Calculate expiry
// ------------------------------------------------
$unit_in_seconds = [
    'Mins'   => 60,
    'Hrs'    => 3600,
    'Days'   => 86400,
    'Months' => 2592000,
];
$unitSeconds = isset($unit_in_seconds[$units]) ? $unit_in_seconds[$units] : 86400;

$expiryTimestamp = $now->getTimestamp() + ($validity * $unitSeconds);
$expiryDateTime  = (new DateTime("@$expiryTimestamp"))->setTimezone(new DateTimeZone($timezoneString));

$expiry_date = $expiryDateTime->format('Y-m-d');
$expiry_time = $expiryDateTime->format('H:i:s');

logToFile($logFilePath, "Calculated expiry => $expiry_date $expiry_time");

// ------------------------------------------------
// 7) Clear old recharges for this user & create new
// ------------------------------------------------
$existingRecharges = ORM::for_table('tbl_user_recharges')->where('username', $uname)->find_many();
foreach ($existingRecharges as $old) {
    $old->delete();
}
logToFile($logFilePath, "Deleted old recharges for user $uname");

try {
    $recharge = ORM::for_table('tbl_user_recharges')->create();
    $recharge->customer_id    = $user->id;
    $recharge->username       = $uname;
    $recharge->plan_id        = $plan_id;
    $recharge->namebp         = $plan_name;
    $recharge->recharged_on   = $now->format('Y-m-d');
    $recharge->recharged_time = $now->format('H:i:s');
    $recharge->expiration     = $expiry_date;
    $recharge->time           = $expiry_time;
    $recharge->status         = 'on';
    $recharge->method         = 'Italy'; // or any label
    $recharge->routers        = '';      // Not used here
    $recharge->type           = $plan_type;
    $recharge->save();

    logToFile($logFilePath, "Inserted new recharge record for user=$uname, plan_id=$plan_id");
} catch (Exception $e) {
    logToFile($logFilePath, "Error inserting new recharge: " . $e->getMessage());
    http_response_code(500);
    exit;
}

// ------------------------------------------------
// 8) Insert a new transaction
// ------------------------------------------------
try {
    $transaction = ORM::for_table('tbl_transactions')->create();
    $transaction->invoice        = 'IT-' . time(); // or any invoice pattern
    $transaction->username       = $uname;
    $transaction->plan_name      = $plan_name;
    $transaction->price          = $price;
    $transaction->recharged_on   = $now->format('Y-m-d');
    $transaction->recharged_time = $now->format('H:i:s');
    $transaction->expiration     = $expiry_date;
    $transaction->time           = $expiry_time;
    $transaction->method         = 'Italy'; // or any label
    $transaction->routers        = '';
    $transaction->type           = $plan_type;
    $transaction->save();

    logToFile($logFilePath, "Transaction record inserted for user=$uname");
} catch (Exception $e) {
    logToFile($logFilePath, "Error inserting transaction record: " . $e->getMessage());
    http_response_code(500);
    exit;
}

// ------------------------------------------------
// 9) Send SMS (if desired)
// ------------------------------------------------
// We'll reuse your logic that calls "Message::sendInvoice($cust, $trx)"
try {
    // Prepare data for the SMS function
    $cust = [
        'phonenumber' => $user->phonenumber,
        'fullname'    => $user->fullname,
        'password'    => $user->password, // or pppoe_password, etc.
    ];

    $trx = [
        'invoice'        => 'IT-' . time(), // or same as transaction->invoice
        'recharged_on'   => $now->format('Y-m-d'),
        'recharged_time' => $now->format('H:i:s'),
        'method'         => 'Italy Webhook',
        'type'           => $plan_type,
        'plan_name'      => $plan_name,
        'price'          => $price,
        'username'       => $uname,
        'expiration'     => $expiry_date,
        'time'           => $expiry_time
    ];

    // If your code uses a config from tbl_appconfig for "hotspot_sms" or similar, fetch it here
    // e.g., $configData2 = ORM::for_table('tbl_appconfig')->find_array();
    // if($configData2){ $config = array_column($configData2, 'value', 'setting'); }

    // This is just an example call. 
    // Make sure the Message class is loaded and has sendInvoice($cust, $trx).
    Message::sendInvoice($cust, $trx);
    logToFile($logFilePath, "SMS invoice sent to user=$uname, phone={$user->phonenumber}");
} catch (Exception $e) {
    logToFile($logFilePath, "Error sending SMS: " . $e->getMessage());
    // Not critical, continue
}

// ------------------------------------------------
// 10) Include adduser.php to add them to router
// ------------------------------------------------
$file_path = __DIR__ . '/../system/adduser.php'; // Adjust if needed
logToFile($logFilePath, "Attempting to include adduser.php: $file_path");

if (file_exists($file_path)) {
    include_once $file_path;
    logToFile($logFilePath, "Successfully included adduser.php for user=$uname");
} else {
    logToFile($logFilePath, "adduser.php not found at: $file_path");
}

// ------------------------------------------------
// 11) Done
// ------------------------------------------------
logToFile($logFilePath, "Webhook processing complete for user=$uname with plan_id=$plan_id.");
http_response_code(200);
exit;
