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

$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Log the received input data
logToFile('xendit_user_creation.log', "Received data: " . print_r($data, true));

// Check for required fields
$requiredFields = ['buyer_email', 'buyer_phone', 'router_id'];
$missingFields = array_diff($requiredFields, array_keys($data));

if (!empty($missingFields)) {
    logToFile('xendit_user_creation.log', "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

$phone = $data['buyer_phone'];
$email = $data['buyer_email'];
$routerId = $data['router_id'];

// Use phone as the username and fullname
$fullName = $phone;

// Check if user already exists
$Userexist = ORM::for_table('tbl_customers')->where('username', $phone)->find_one();
if (!$Userexist) {
    $createUser = ORM::for_table('tbl_customers')->create();
    $createUser->username = $phone;
    $createUser->password = '1234';
    $createUser->fullname = $fullName;
    $createUser->phonenumber = $phone;
    $createUser->pppoe_password = '1234';
    $createUser->email = $email;
    $createUser->service_type = 'Hotspot';
    $createUser->router_id = $routerId;
    $createUser->save();
    logToFile('xendit_user_creation.log', "User created successfully: " . $phone);
} else {
    logToFile('xendit_user_creation.log', "User already exists: " . $phone);
}

// Return success response
echo json_encode(['success' => 'User created or already exists']);
