<?php
// Step 1: Get values from the URL parameters
$apikey = isset($_GET['token']) ? $_GET['token'] : ''; // Semaphore API key (using 'token' parameter for compatibility)
$recipients = isset($_GET['recipients']) ? $_GET['recipients'] : ''; // Recipients' phone numbers
$message = isset($_GET['message']) ? $_GET['message'] : ''; // Message to be sent
$senderID = isset($_GET['senderID']) ? $_GET['senderID'] : 'SEMAPHORE'; // Optional sender name

// Step 2: Validate that required parameters are provided
if (empty($apikey) || empty($recipients) || empty($message)) {
    echo "Error: 'token', 'recipients', and 'message' parameters are required.";
    exit;
}

// Step 3: Prepare the POST request to the Semaphore API
$ch = curl_init();
$parameters = array(
    'apikey' => $apikey,  // API key from the GET parameter 'token'
    'number' => $recipients,  // Recipients' numbers from the GET parameter 'recipients'
    'message' => $message,  // Message text from the GET parameter 'message'
    'sendername' => $senderID  // Sender name from the GET parameter 'senderID'
);

curl_setopt($ch, CURLOPT_URL, 'https://api.semaphore.co/api/v4/messages');
curl_setopt($ch, CURLOPT_POST, 1);  // Use POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));  // Send data as form fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Capture the response

// Step 4: Get the server response from Semaphore
$response = curl_exec($ch);
curl_close($ch);

// Step 5: Output the response
echo $response;
?>
