<?php
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

// Log the raw input
logToFile('register.log', "Received user_input: $userInput");

// 2) Basic validation
if (empty($userInput)) {
    logToFile('register.log', "Error: user_input is empty.");
    echo json_encode([
        'success' => false,
        'error'   => 'No input provided.'
    ]);
    exit;
}

// 3) Check if it's email or phone
$isEmail = filter_var($userInput, FILTER_VALIDATE_EMAIL);

// Default password
$defaultPassword = '12345';

try {
    // 4) Check if user already exists
    $existing = ORM::for_table('tbl_customers')
        ->where('username', $userInput)
        ->find_one();

    if ($existing) {
        logToFile('register.log', "User already exists: $userInput");
        // We do NOT exit here — we still call the webhook below.
    } else {
        // 5) Create new user (only if they don't already exist)
        $newUser = ORM::for_table('tbl_customers')->create();
        $newUser->username     = $userInput;
        $newUser->password     = $defaultPassword;
        $newUser->service_type = 'Hotspot'; 
        $newUser->router_id    = 1;

        if ($isEmail) {
            $newUser->email    = $userInput;
            $newUser->fullname = 'Guest (via Email)';
        } else {
            $newUser->phonenumber = $userInput;
            $newUser->fullname    = 'Guest (via Phone)';
        }

        $newUser->save();
        logToFile('register.log', "Created new user: $userInput");
    }

    // 6) Construct the full URL (using APP_URL if defined) and log it
    if (defined('APP_URL')) {
        $appUrl = APP_URL;
    } else {
        logToFile('register.log', "APP_URL not defined. Using fallback URL.");
        $appUrl = 'http://localhost'; // fallback if APP_URL is undefined
    }

    $webhookUrl = rtrim($appUrl, '/') . '/italy/italy_webhook.php';
    logToFile('register.log', "Constructed webhook URL: $webhookUrl");

    // 7) Fire-and-forget cURL call to italy_webhook.php
    //    We won't wait for the response. We'll just keep the timeouts very short.
    try {
        $payload = json_encode(['username' => $userInput]);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        // Don't attempt to read the response body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

        // Set short timeouts (in seconds) to avoid slowing down the user
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);

        // Execute the request but ignore any output
        curl_exec($ch);
        curl_close($ch);

        logToFile('register.log', "Triggered webhook in background (not waiting).");
    } catch (Exception $e) {
        logToFile('register.log', "Error calling webhook: " . $e->getMessage());
    }

    // 8) Return success JSON (same password if user existed or was new)
    echo json_encode([
        'success'  => true,
        'username' => $userInput,
        'password' => $defaultPassword
    ]);
    exit;
} catch (Exception $e) {
    // 9) On error
    logToFile('register.log', "DB Error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Server error. Please try again.'
    ]);
    exit;
}
