<?php

// Adjust paths as needed; if you have init.php, etc.
require_once '../init.php';
global $config, $ui;

// Add the 'use' statement here, at the top of the file
use PEAR2\Net\RouterOS;



// Function to manage log file lines
function logToFile($filePath, $message, $maxLines = 5000)
{
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

$logFilePath = 'iotec_webhook.log';

// Capture and log incoming webhook data
$inputData = file_get_contents("php://input");
logToFile($logFilePath, "Received raw data: " . $inputData);

// Decode JSON data
$event = json_decode($inputData, true);

if (!$event) {
    logToFile($logFilePath, "Invalid JSON data received.");
    http_response_code(400);
    exit();
}

// Check for required fields
$requiredFields = ['id', 'status', 'externalId', 'amount'];
$missingFields = array_diff($requiredFields, array_keys($event));

if (!empty($missingFields)) {
    logToFile($logFilePath, "Missing fields: " . implode(', ', $missingFields));
    http_response_code(400);
    exit();
}

$transactionId = $event['id'];
$status = $event['status'];
$externalId = $event['externalId'];
$amountPaid = $event['amount'];
$statusMessage = $event['statusMessage'] ?? '';

logToFile($logFilePath, "Processing webhook for transaction ID: $transactionId, status: $status");

// Only proceed if the status is 'Success'
if ($status !== 'Success') {
    logToFile($logFilePath, "Transaction status is not 'Success'. No action taken.");
    http_response_code(200);
    exit();
}

// Retrieve the payment gateway record
$paymentGatewayRecord = ORM::for_table('tbl_payment_gateway')
    ->where_any_is([
        ['gateway_trx_id' => $transactionId],
        ['gateway_trx_id' => $externalId]
    ])
    ->find_one();

if (!$paymentGatewayRecord) {
    logToFile($logFilePath, "Payment gateway record not found for transaction ID: $transactionId or external ID: $externalId");
    http_response_code(200); // Respond 200 to prevent retries
    exit();
}

$uname = $paymentGatewayRecord->username;
$plan_id = $paymentGatewayRecord->plan_id;
$router_id = $paymentGatewayRecord->routers_id;

logToFile($logFilePath, "Retrieved plan_id: $plan_id and router_id: $router_id for username: $uname");

// Retrieve user, plan, and router details
$user = ORM::for_table('tbl_customers')->where('username', $uname)->find_one();
if (!$user) {
    logToFile($logFilePath, "User not found with username: $uname");
    http_response_code(200);
    exit();
}

$plan = ORM::for_table('tbl_plans')->where('id', $plan_id)->find_one();
$router = ORM::for_table('tbl_routers')->where('id', $router_id)->find_one();

if (!$plan || !$router) {
    logToFile($logFilePath, "Plan or router not found for plan_id: $plan_id and router_id: $router_id");
    http_response_code(200);
    exit();
}

$plan_name = $plan->name_plan;
$plan_type = $plan->type;
$validity = $plan->validity;
$units = $plan->validity_unit;
$router_name = $router->name;

logToFile($logFilePath, "Plan name: $plan_name, Plan type: $plan_type, Validity: $validity $units");
logToFile($logFilePath, "Router name: $router_name");

// Calculate expiry time
$now = new DateTime('now', new DateTimeZone('GMT+3'));
$unit_in_seconds = [
    'Mins' => 60,
    'Hrs' => 3600,
    'Days' => 86400,
    'Months' => 2592000 // Assuming 30 days per month for simplicity
];
$unit_seconds = $unit_in_seconds[$units];
$expiry_timestamp = $now->getTimestamp() + ($validity * $unit_seconds);
$expiry_datetime = new DateTime("@$expiry_timestamp");
$expiry_datetime->setTimezone(new DateTimeZone('GMT+3'));
$expiry_date = $expiry_datetime->format('Y-m-d');
$expiry_time = $expiry_datetime->format('H:i:s');

logToFile($logFilePath, "Calculated expiry date: $expiry_date $expiry_time");

// Recharge details
$recharged_on = $now->format('Y-m-d');
$recharged_time = $now->format('H:i:s');

// Update recharge and transaction records
$existing_recharges = ORM::for_table('tbl_user_recharges')->where('username', $uname)->find_many();
foreach ($existing_recharges as $recharge) {
    $recharge->delete();
}
logToFile($logFilePath, "Deleted existing recharge records for username: $uname");

// Insert new recharge record
try {
    $rechargeRecord = ORM::for_table('tbl_user_recharges')->create([
        'customer_id' => $user->id,
        'username' => $uname,
        'plan_id' => $plan_id,
        'namebp' => $plan_name,
        'recharged_on' => $recharged_on,
        'recharged_time' => $recharged_time,
        'expiration' => $expiry_date,
        'time' => $expiry_time,
        'status' => "on",
        'method' => "ioTec-" . substr($transactionId, 0, 10), // Shorten for 'method' field if necessary
        'routers' => $router_name,
        'type' => $plan_type
    ]);
    $rechargeRecord->save();
    logToFile($logFilePath, "Recharge record inserted successfully for username: $uname");
} catch (Exception $e) {
    logToFile($logFilePath, 'Exception during recharge record insertion: ' . $e->getMessage());
    http_response_code(500);
    exit();
}

// Shorten the transaction ID for the 'invoice' field
$shortInvoiceId = substr($transactionId, 0, 10); // Get first 10 characters

// Insert transaction record
try {
    logToFile($logFilePath, "Attempting to insert transaction record");
    $transactionRecord = ORM::for_table('tbl_transactions')->create([
        'invoice' => $shortInvoiceId,
        'username' => $uname,
        'plan_name' => $plan_name,
        'price' => $amountPaid,
        'recharged_on' => $recharged_on,
        'recharged_time' => $recharged_time,
        'expiration' => $expiry_date,
        'time' => $expiry_time,
        'method' => "ioTec-" . substr($transactionId, 0, 10), // Shorten for 'method' field if necessary
        'routers' => $router_name,
        'type' => $plan_type
    ]);
    $transactionRecord->save();
    logToFile($logFilePath, "Transaction record inserted successfully for username: $uname");
} catch (Exception $e) {
    logToFile($logFilePath, 'Exception during transaction record insertion: ' . $e->getMessage());
    http_response_code(500);
    exit();
}

// Include external script for adding user to MikroTik
try {
    logToFile($logFilePath, "Attempting to connect to database for router details");
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    logToFile($logFilePath, "Database connection successful");

    $stmt = $conn->prepare("SELECT * FROM tbl_routers WHERE id = :routerId");
    $stmt->bindParam(':routerId', $router_id);
    $stmt->execute();
    $routerResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($routerResult) {
        $routerUsername = $routerResult['username'];
        $routerPassword = $routerResult['password'];
        $routerIpAddress = $routerResult['ip_address'];

        logToFile($logFilePath, "Router details - IP: $routerIpAddress, Username: $routerUsername");

        // Connect to the MikroTik router
        logToFile($logFilePath, "Attempting to connect to MikroTik router");

        $client = new RouterOS\Client($routerIpAddress, $routerUsername, $routerPassword);
        logToFile($logFilePath, "Connected to MikroTik router successfully");

        $util = new RouterOS\Util($client);
        $util->setMenu('/ip hotspot user');

        // Check if user already exists
        $userExists = $util->find(
            RouterOS\Query::where('name', $uname)
        );

        if ($userExists) {
            logToFile($logFilePath, "Hotspot user '$uname' already exists on the router, updating user");

            // Update existing user
            $util->set(RouterOS\Query::where('name', $uname), [
                'password' => '1234', // Update password if needed
                'profile' => $plan_name
            ]);
            logToFile($logFilePath, "Hotspot user '$uname' updated successfully");
        } else {
            logToFile($logFilePath, "Adding new hotspot user '$uname'");

            // Add new user
            $util->add([
                'name' => $uname,
                'password' => '1234',
                'profile' => $plan_name
            ]);
            logToFile($logFilePath, "Hotspot user '$uname' added successfully");
        }

    } else {
        logToFile($logFilePath, "Router with ID $router_id not found");
        http_response_code(200);
        exit();
    }

} catch (RouterOS\Exception $e) {
    logToFile($logFilePath, 'RouterOS Exception: ' . $e->getMessage());
} catch (Exception $e) {
    logToFile($logFilePath, 'General Exception: ' . $e->getMessage());
}

logToFile($logFilePath, "User creation process completed for username: $uname");

// Update payment gateway record
try {
    logToFile($logFilePath, "Attempting to update payment gateway record");
    $paymentGatewayRecord->status = 2; // Assuming 2 indicates 'Success'
    $paymentGatewayRecord->paid_date = $now->format('Y-m-d H:i:s');
    $paymentGatewayRecord->gateway_trx_id = $transactionId;
    $paymentGatewayRecord->pg_paid_response = json_encode($event); // Store the webhook data

    // **Added line to update 'expired_date' field**
    $paymentGatewayRecord->expired_date = $expiry_date . ' ' . $expiry_time;

    $paymentGatewayRecord->save();
    logToFile($logFilePath, "Payment gateway record updated successfully for username: $uname");
} catch (Exception $e) {
    logToFile($logFilePath, 'Exception during payment gateway record update: ' . $e->getMessage());
    http_response_code(500);
    exit();
}

http_response_code(200); // Respond 200 to acknowledge receipt of the webhook
?>
