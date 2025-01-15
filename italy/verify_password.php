<?php
// Reduce error reporting (only critical errors; hides notices/warnings)
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

header('Content-Type: application/json');

// Include your init or DB config
require_once '../init.php';
global $config, $ui;

/**
 * A function to log verification events to a file
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

$userInput    = isset($_POST['user_input'])    ? trim($_POST['user_input'])    : '';
$passwordInput = isset($_POST['password_input']) ? trim($_POST['password_input']) : '';

// Log request
logToFile('verify.log', "Verifying user_input: $userInput, password_input: $passwordInput");

// Basic validation
if (empty($userInput) || empty($passwordInput)) {
    logToFile('verify.log', "Error: Missing username or password.");
    echo json_encode([
        'success' => false,
        'error'   => 'Missing username or password.'
    ]);
    exit;
}

try {
    // Retrieve user from DB
    $user = ORM::for_table('tbl_customers')
        ->where('username', $userInput)
        ->find_one();

    if (!$user) {
        // User not found
        logToFile('verify.log', "User not found: $userInput");
        echo json_encode([
            'success' => false,
            'error'   => 'User not found.'
        ]);
        exit;
    }

    // Compare passwords
    if ($user->password == $passwordInput) {
        // success
        logToFile('verify.log', "Password verified for user: $userInput");
        echo json_encode([
            'success' => true
        ]);
    } else {
        // invalid password
        logToFile('verify.log', "Invalid password for user: $userInput");
        echo json_encode([
            'success' => false,
            'error'   => 'Invalid password.'
        ]);
    }
    exit;
} catch (Exception $e) {
    // Database or server error
    logToFile('verify.log', "DB Error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Server error. Please try again.'
    ]);
    exit;
}
