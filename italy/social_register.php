<?php
// social_register.php

// Reduce error reporting (only critical errors; hides notices/warnings)
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

// Include your init or DB config
require_once '../init.php'; // Adjust path if needed
global $config, $ui;

/**
 * A function to log to a file
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

// 1) Gather the input
$userInput = isset($_POST['user_input']) ? trim($_POST['user_input']) : '';

logToFile('social_register.log', "Received user_input: $userInput");

// 2) Basic validation
if (empty($userInput)) {
    logToFile('social_register.log', "Error: user_input is empty.");
    echo json_encode([
        'success' => false,
        'error'   => 'No email provided.'
    ]);
    exit;
}

// 3) Validate that userInput is a valid email
if (!filter_var($userInput, FILTER_VALIDATE_EMAIL)) {
    logToFile('social_register.log', "Error: user_input is not a valid email. Got: $userInput");
    echo json_encode([
        'success' => false,
        'error'   => 'Invalid email address.'
    ]);
    exit;
}

// 4) Check for existing user or create new
try {
    // Try to find existing user in tbl_customers
    $existing = ORM::for_table('tbl_customers')
        ->where('username', $userInput)
        ->find_one();

    if ($existing) {
        // Already exists, so retrieve their current password
        $existingUsername = $existing->username;
        $existingPassword = $existing->password;

        logToFile('social_register.log', "Existing social user found: $existingUsername / $existingPassword");

        // Return success with existing credentials
        echo json_encode([
            'success'  => true,
            'username' => $existingUsername,
            'password' => $existingPassword
        ]);
        exit;
    }

    // Not found, create new user
    $randomPassword = (string) random_int(10000, 99999);

    $newUser = ORM::for_table('tbl_customers')->create();
    $newUser->username     = $userInput;      // same as email
    $newUser->password     = $randomPassword; // in plain text
    $newUser->service_type = 'Hotspot'; 
    $newUser->router_id    = 1;               // Adjust if needed
    $newUser->email        = $userInput;
    $newUser->fullname     = 'Social User';

    $newUser->save();

    logToFile('social_register.log', "Created new social user: $userInput / $randomPassword");

    // 5) Construct the full URL (using APP_URL if defined)
    if (defined('APP_URL')) {
        $appUrl = APP_URL;
    } else {
        logToFile('social_register.log', "APP_URL not defined. Using fallback URL.");
        $appUrl = 'http://localhost'; // fallback if APP_URL is undefined
    }

    $webhookUrl = rtrim($appUrl, '/') . '/italy/italy_webhook.php';
    logToFile('social_register.log', "Constructed webhook URL: $webhookUrl");

    // 6) Fire-and-forget cURL call to italy_webhook.php
    //    We send plan_id, price, router_id along with the username
    try {
        $payload = json_encode([
            'username'  => $userInput,
            'plan_id'   => 1,    // or any plan for social users
            'price'     => 0.0,  // or your chosen price for social
            'router_id' => 1     // or whichever router ID
        ]);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        // We won't read the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

        // Set short timeouts to avoid blocking
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);

        curl_exec($ch);
        curl_close($ch);

        logToFile('social_register.log', "Triggered webhook in background (not waiting).");
    } catch (Exception $e) {
        logToFile('social_register.log', "Error calling webhook: " . $e->getMessage());
    }

    // 7) Return success with new credentials
    echo json_encode([
        'success'  => true,
        'username' => $userInput,
        'password' => $randomPassword
    ]);
    exit;

} catch (Exception $e) {
    // DB error or other exception
    logToFile('social_register.log', "DB Error: " . $e->getMessage());

    echo json_encode([
        'success' => false,
        'error'   => 'Server error. Please try again.'
    ]);
    exit;
}
