<?php
// register_test.php

// Reduce error reporting (only critical errors; hides notices/warnings)
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

// Include your init or DB config
require_once '../init.php'; // Adjust path if needed
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
logToFile('register_test.log', "Received user_input: $userInput, full_name: $fullName");

// 2) Basic validation
if (empty($userInput)) {
    logToFile('register_test.log', "Error: user_input is empty.");
    echo json_encode([
        'success' => false,
        'error'   => 'No input provided.'
    ]);
    exit;
}

if (empty($fullName)) {
    logToFile('register_test.log', "Warning: full_name is empty. Using fallback name.");
    $fullName = 'Guest';
}

// 3) Check if it's email or phone
$isEmail = filter_var($userInput, FILTER_VALIDATE_EMAIL);

// 4) Generate a random 5-digit password for normal user
$randomPassword = random_int(10000, 99999);

// For the "test" user, we always use "1234"
$testFixedPassword = '1234';

// We'll define plan/price/router for normal vs. test
// Example placeholders: plan_id=1, price=1.0, router_id=1 for normal user
//                       plan_id=2, price=0.0, router_id=2 for test user
$normalPlanId  = 1;
$normalPrice   = 1.0;
$normalRouter  = 1;

$testPlanId    = 3;
$testPrice     = 1.0;
$testRouter    = 1;

try {
    // 5) Check if user already exists (the "normal" username)
    $existing = ORM::for_table('tbl_customers')
        ->where('username', $userInput)
        ->find_one();

    if ($existing) {
        // If user already exists, do not create new accounts
        logToFile('register_test.log', "User already exists: $userInput. 'already registered' response.");

        echo json_encode([
            'success' => false,
            'error'   => 'User is already registered.'
        ]);
        exit;
    }

    // ------------------------------------------------------------------------
    // If it's PHONE, we do the standard single creation (like normal code)
    // If it's EMAIL, we do the 2-user scenario (normal + test).
    //   Also note we send the webhook for the test user FIRST, then normal user.
    // ------------------------------------------------------------------------
    if ($isEmail) {
        // =============== EMAIL LOGIC (create 2 accounts) ================= //

        // (A) Normal user
        $newUser = ORM::for_table('tbl_customers')->create();
        $newUser->username     = $userInput;
        $newUser->password     = $randomPassword;
        $newUser->service_type = 'Hotspot'; 
        $newUser->router_id    = $normalRouter;
        $newUser->email        = $userInput;
        $newUser->fullname     = $fullName ?: 'Guest';
        $newUser->save();

        logToFile('register_test.log', "Created normal user: $userInput / pass=$randomPassword");

        // (B) Test user => "emailtest", pass= "1234"
        // i.e. userInput + 'test'
        $testUserName = $userInput . 'test';

        // Check if that test user already exists:
        $existingTest = ORM::for_table('tbl_customers')
            ->where('username', $testUserName)
            ->find_one();

        if (!$existingTest) {
            $newTestUser = ORM::for_table('tbl_customers')->create();
            $newTestUser->username     = $testUserName;
            $newTestUser->password     = $testFixedPassword;
            $newTestUser->service_type = 'Hotspot'; 
            $newTestUser->router_id    = $testRouter;
            $newTestUser->email        = $testUserName; // optional
            $newTestUser->fullname     = $fullName . ' (Test)';
            $newTestUser->save();

            logToFile('register_test.log', "Created test user: $testUserName / pass=$testFixedPassword");
        } else {
            logToFile('register_test.log', "Test user $testUserName already existed (unexpected).");
        }

        // (C) Fire webhooks for both new accounts
        //     => Test user FIRST, then normal user
        if (defined('APP_URL')) {
            $appUrl = APP_URL;
        } else {
            logToFile('register_test.log', "APP_URL not defined. Using fallback URL.");
            $appUrl = 'http://localhost';
        }

        $webhookUrl = rtrim($appUrl, '/') . '/italy/italy_webhook.php';
        logToFile('register_test.log', "Constructed webhook URL: $webhookUrl");

        // (C1) TEST USER WEBHOOK => plan_id=$testPlanId, price=$testPrice, router_id=$testRouter
        try {
            $payloadTest = json_encode([
                'username'  => $testUserName,
                'plan_id'   => $testPlanId,
                'price'     => $testPrice,
                'router_id' => $testRouter
            ]);

            $chTest = curl_init($webhookUrl);
            curl_setopt($chTest, CURLOPT_POST, true);
            curl_setopt($chTest, CURLOPT_POSTFIELDS, $payloadTest);
            curl_setopt($chTest, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payloadTest)
            ]);
            curl_setopt($chTest, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($chTest, CURLOPT_CONNECTTIMEOUT, 4);
            curl_setopt($chTest, CURLOPT_TIMEOUT, 4);

            curl_exec($chTest);
            curl_close($chTest);
            logToFile('register_test.log', "Triggered test user webhook (first).");
        } catch (Exception $e) {
            logToFile('register_test.log', "Error calling test user webhook: " . $e->getMessage());
        }

        // (C2) NORMAL USER WEBHOOK => plan_id=$normalPlanId, price=$normalPrice, router_id=$normalRouter
        try {
            $payloadNormal = json_encode([
                'username'  => $userInput,
                'plan_id'   => $normalPlanId,
                'price'     => $normalPrice,
                'router_id' => $normalRouter
            ]);

            $chNormal = curl_init($webhookUrl);
            curl_setopt($chNormal, CURLOPT_POST, true);
            curl_setopt($chNormal, CURLOPT_POSTFIELDS, $payloadNormal);
            curl_setopt($chNormal, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payloadNormal)
            ]);
            curl_setopt($chNormal, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($chNormal, CURLOPT_CONNECTTIMEOUT, 4);
            curl_setopt($chNormal, CURLOPT_TIMEOUT, 4);

            curl_exec($chNormal);
            curl_close($chNormal);
            logToFile('register_test.log', "Triggered normal user webhook (second).");
        } catch (Exception $e) {
            logToFile('register_test.log', "Error calling normal user webhook: " . $e->getMessage());
        }

        // (D) Return success JSON with both sets of credentials
        echo json_encode([
            'success'         => true,
            'normal_username' => $userInput,
            'normal_pass'     => (string) $randomPassword,
            'test_username'   => $testUserName,
            'test_pass'       => $testFixedPassword
        ]);
        exit;

    } else {
        // =============== PHONE LOGIC (create single user only) ============ //
        // single user with random password
        $newUser = ORM::for_table('tbl_customers')->create();
        $newUser->username     = $userInput;
        $newUser->password     = $randomPassword;
        $newUser->service_type = 'Hotspot'; 
        $newUser->router_id    = 1;
        $newUser->phonenumber  = $userInput;
        $newUser->fullname     = $fullName ?: 'Guest (via Phone)';
        $newUser->save();

        logToFile('register_test.log', "Created single phone user: $userInput / pass=$randomPassword");

        // Fire one webhook => plan_id=1, price=1.0, router_id=1 (example)
        if (defined('APP_URL')) {
            $appUrl = APP_URL;
        } else {
            logToFile('register_test.log', "APP_URL not defined. Using fallback URL.");
            $appUrl = 'http://localhost'; 
        }

        $webhookUrl = rtrim($appUrl, '/') . '/italy/italy_webhook.php';
        logToFile('register_test.log', "Constructed webhook URL: $webhookUrl");

        try {
            $payload = json_encode([
                'username'  => $userInput,
                'plan_id'   => 1,      // example plan for phone
                'price'     => 1.0,    // example price
                'router_id' => 1
            ]);

            $ch = curl_init($webhookUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload)
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);

            curl_exec($ch);
            curl_close($ch);
            logToFile('register_test.log', "Triggered phone user webhook (not waiting).");
        } catch (Exception $e) {
            logToFile('register_test.log', "Error calling phone user webhook: " . $e->getMessage());
        }

        // Return success with phone credentials
        echo json_encode([
            'success'  => true,
            'username' => $userInput,
            'password' => (string) $randomPassword
        ]);
        exit;
    }

} catch (Exception $e) {
    logToFile('register_test.log', "DB Error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Server error. Please try again.'
    ]);
    exit;
}
