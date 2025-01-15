<?php
/**
 * iotec_user_creation.php
 */

// Adjust paths as needed; if you have init.php, etc.
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

header('Content-Type: application/json');

// 1. Read Input & Log
$input = file_get_contents('php://input');
$data  = json_decode($input, true);

$logFile = 'user_creation_iotec.log';
logToFile($logFile, "Received data: " . print_r($data, true));

// 2. Check Required Fields
$requiredFields = ['buyer_email', 'buyer_phone', 'router_id', 'mac_address'];
$missingFields  = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile($logFile, "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

// 3. Extract & Trim
$email    = trim($data['buyer_email']);
$phone    = trim($data['buyer_phone']);
$routerId = trim($data['router_id']);
$mac      = trim($data['mac_address']); 

// 4. Phone Transformation
//    If starts with '0', replace with '256'.
//    If starts with '256', leave as-is.
//    Otherwise => error.
if (strpos($phone, '0') === 0) {
    // Example: 0786350615 => 256786350615
    $purePhone = '256' . substr($phone, 1);
}
elseif (strpos($phone, '256') === 0) {
    $purePhone = $phone; // already correct
}
else {
    logToFile($logFile, "Invalid phone format: " . $phone);
    echo json_encode(['error' => 'Invalid phone number format']);
    exit();
}

// 5. Build Hotspot Username => pure phone + '-' + last 4 of MAC
$lastFourMac = substr($mac, -4);         // e.g. "D:EF" or "CDEF"
$username    = $purePhone . '-' . $lastFourMac;
$fullName    = $purePhone;               // store phone in 'fullname'

// 6. Check if user already exists
$userExist = ORM::for_table('tbl_customers')->where('username', $username)->find_one();

if (!$userExist) {
    // Create new user in tbl_customers
    $createUser = ORM::for_table('tbl_customers')->create();
    $createUser->username       = $username;
    $createUser->password       = '1234';
    $createUser->fullname       = $fullName;
    $createUser->phonenumber    = $purePhone;
    $createUser->pppoe_password = '1234';
    $createUser->email          = $email;
    $createUser->service_type   = 'Hotspot';
    $createUser->router_id      = $routerId;
    $createUser->save();
    logToFile($logFile, "New user created successfully: " . $username);
} else {
    logToFile($logFile, "User already exists: " . $username);
}

// 7. Log final username and return success
logToFile($logFile, "Final username: " . $username . " | Pure phone: " . $purePhone);

echo json_encode([
    'success'    => 'User created or already exists',
    'username'   => $username,   // For Hotspot login
    'pure_phone' => $purePhone   // For iotec payment
]);
