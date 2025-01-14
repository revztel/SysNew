<?php

require_once '../init.php';
global $config, $ui;
/**
 * Log function to keep track of events in xendit_user_creation.log
 */
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

header('Content-Type: application/json');

// 1. Read JSON input
$input = file_get_contents('php://input');
$data  = json_decode($input, true);

// 2. Log received data
$logFile = 'xendit_user_creation.log';
logToFile($logFile, "Received data: " . print_r($data, true));

// 3. Check for required fields
$requiredFields = ['buyer_email', 'buyer_phone', 'router_id', 'mac_address'];
$missingFields  = array_diff($requiredFields, array_keys($data));
if (!empty($missingFields)) {
    logToFile($logFile, "Missing fields: " . print_r($missingFields, true));
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

// 4. Extract data
$email    = trim($data['buyer_email']);
$phone    = trim($data['buyer_phone']);
$routerId = trim($data['router_id']);
$mac      = trim($data['mac_address']); // e.g. "12:34:56:AB:CD:EF"

// === Phone Number Transformation Start ===
if (strpos($phone, '0') === 0) {
    // Remove the leading '0' and prepend '63'
    $phone = '63' . substr($phone, 1);
} elseif (strpos($phone, '63') === 0) {
    // Leave as is
} else {
    // Invalid phone format
    logToFile($logFile, "Invalid phone format: " . $phone);
    echo json_encode(['error' => 'Invalid phone number format']);
    exit();
}
// === Phone Number Transformation End ===

// 5. Build username by combining phone with the last 4 characters of MAC
$lastFourMac    = substr($mac, -4); // e.g. "D:EF" or "CDEF"
$username       = $phone . '-' . $lastFourMac; // e.g. "63912345678-D:EF"

// We'll store phone as the "fullname"
$fullName = $phone;

// 6. Check if user already exists
$userExist = ORM::for_table('tbl_customers')->where('username', $username)->find_one();
if (!$userExist) {
    // 7. Create new user
    $createUser = ORM::for_table('tbl_customers')->create();
    $createUser->username       = $username;
    $createUser->password       = '1234';   // or use a better hashing method in production
    $createUser->fullname       = $fullName;
    $createUser->phonenumber    = $phone;
    $createUser->pppoe_password = '1234';
    $createUser->email          = $email;
    $createUser->service_type   = 'Hotspot';
    $createUser->router_id      = $routerId;
    $createUser->save();

    logToFile($logFile, "New user created successfully: " . $username);
} else {
    logToFile($logFile, "User already exists: " . $username);
}

// 8. Return success response
echo json_encode([
    'success'  => 'User created or already exists',
    'username' => $username
]);
?>
