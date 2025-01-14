<?php
$api_token = "25qbsrYwfGN1YiSGOK4cfEtSGSHYUby1X2pnn5EH";
$sender_id = "TOPSPEED";
$message = "Test message from ispledger.com";
$phone_number = "254796381603"; // Replace with an actual number

$url = "https://sms.ispledger.com/sms/hostpinnacle";
$data = array(
    'api' => $api_token,
    'SenderId' => $sender_id,
    'msg' => $message,
    'phone' => $phone_number
);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo "Error sending SMS.";
} else {
    echo "Response from server: " . $result;
}
?>
