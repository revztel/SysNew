<?php
// register_user.php

// Reduce error reporting (only critical errors; hides notices/warnings)
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

// Include your init or DB config
require_once '../init.php';
global $config, $ui;

/**
 * A function to log registration events to a file
 */
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $timestamp = '[' . date('Y-m-d H:i:s') . ']';
    $lines[] = "$timestamp $message";

    // Keep the file from growing too large
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }

    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// 1) Gather the input from $_POST
$userInput = isset($_POST['user_input']) ? trim($_POST['user_input']) : '';
$fullName  = isset($_POST['full_name'])  ? trim($_POST['full_name'])  : '';

// Log the raw input
logToFile('register.log', "Received user_input: $userInput, full_name: $fullName");

// 2) Basic validation
if (empty($userInput)) {
    logToFile('register.log', "Error: user_input is empty.");
    echo json_encode([
        'success' => false,
        'error'   => 'No input provided.'
    ]);
    exit;
}

if (empty($fullName)) {
    // You could decide if fullName is strictly required or not
    logToFile('register.log', "Warning: full_name is empty. Using fallback name.");
    $fullName = 'Guest';
}

// 3) Check if it's email or phone (not strictly necessary here, but can be useful)
$isEmail = filter_var($userInput, FILTER_VALIDATE_EMAIL);

// 4) Generate a random 5-digit password
$randomPassword = random_int(10000, 99999);

try {
    // 5) Check if user already exists
    $existing = ORM::for_table('tbl_customers')
        ->where('username', $userInput)
        ->find_one();

    if ($existing) {
        // User is already registered - do NOT overwrite password
        logToFile('register.log', "User already exists: $userInput. Returning 'already registered' response.");
        
        echo json_encode([
            'success' => false,
            'error'   => 'User is already registered.'
        ]);
        exit;
    }

    // 6) Create new user (only if they don't already exist)
    $newUser = ORM::for_table('tbl_customers')->create();
    $newUser->username     = $userInput;
    $newUser->password     = $randomPassword;
    $newUser->service_type = 'Hotspot'; 
    $newUser->router_id    = 1; // adjust if needed

    if ($isEmail) {
        $newUser->email    = $userInput;
        $newUser->fullname = $fullName ?: 'Guest (via Email)';
    } else {
        $newUser->phonenumber = $userInput;
        $newUser->fullname    = $fullName ?: 'Guest (via Phone)';
    }

    $newUser->save();
    logToFile('register.log', "Created new user: $userInput (password: $randomPassword)");

    // 7) Construct the full URL (using APP_URL if defined)
    if (defined('APP_URL')) {
        $appUrl = APP_URL;
    } else {
        logToFile('register.log', "APP_URL not defined. Using fallback URL.");
        $appUrl = 'http://localhost'; // fallback if APP_URL is undefined
    }

    $webhookUrl = rtrim($appUrl, '/') . '/italy/italy_webhook.php';
    logToFile('register.log', "Constructed webhook URL: $webhookUrl");

    // 8) Fire-and-forget cURL call to italy_webhook.php
    //    We add plan_id, price, router_id to the JSON payload
    try {
        $payload = json_encode([
            'username'  => $userInput,
            'plan_id'   => 1,       // or your plan
            'price'     => 1.0,     // or your price
            'router_id' => 1        // or the router you want
        ]);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false); // we won't read the response
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);

        curl_exec($ch);
        curl_close($ch);

        logToFile('register.log', "Triggered normal user webhook with plan/price/router. (not waiting)");
    } catch (Exception $e) {
        logToFile('register.log', "Error calling webhook: " . $e->getMessage());
    }

    // 9) Return success JSON
    echo json_encode([
        'success'  => true,
        'username' => $userInput,
        'password' => (string) $randomPassword
    ]);
    exit;

} catch (Exception $e) {
    // 10) On error
    logToFile('register.log', "DB Error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Server error. Please try again.'
    ]);
    exit;
}
