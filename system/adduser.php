<?php

// Include the config file with proper error handling
include 'config.php';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Prepare and fetch the router info
$stmt = $conn->prepare("SELECT * FROM tbl_routers WHERE id = :routerId");
$stmt->bindParam(':routerId', $routerId);
$stmt->execute();
$routerResult = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$routerResult) {
    die('Router not found');
}

$username        = $routerResult['username'];
$password        = $routerResult['password'];
$routerIpAddress = $routerResult['ip_address'];

use PEAR2\Net\RouterOS;

try {
    // Create a RouterOS client
    $client = new RouterOS\Client($routerIpAddress, $username, $password);

    // Additional parameters for limited plans
    $typebp     = $plans->typebp;
    $data_limit = $plans->data_limit;
    $data_unit  = $plans->data_unit;
    $time_limit = $plans->time_limit;
    $time_unit  = $plans->time_unit;

    // Prepare user details, adding date + time to the comment.
    // Example: "Exp: 2025-01-15 14:30:00"
    $userDetails = [
        'name'     => $uname,
        'password' => '1234',
        'profile'  => $plan_name,
        'comment'  => 'Exp: ' . $expiry_date . ' ' . $expiry_time,
    ];

    // Remove the user first if they exist
    $removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
    $removeRequest->setArgument('numbers', $uname);
    try {
        $client->sendSync($removeRequest);
    } catch (Exception $e) {
        // It's okay if the user doesn't exist
    }

    // If the plan is "Limited", add time & data limits
    if ($typebp === "Limited") {
        // Time limit
        if (!empty($time_limit) && !empty($time_unit)) {
            if ($time_unit === 'Hrs') {
                $timelimit = $time_limit . ":00:00";
            } else {
                $timelimit = "00:" . $time_limit . ":00";
            }
            $userDetails['limit-uptime'] = $timelimit;
        }
        // Data limit
        if (!empty($data_limit) && !empty($data_unit)) {
            if ($data_unit === 'GB') {
                $datalimit = $data_limit * 1000000000;
            } else {
                $datalimit = $data_limit * 1000000;
            }
            $userDetails['limit-bytes-total'] = $datalimit;
        }
    }

    // Build request to add the user
    $addRequest = new RouterOS\Request('/ip/hotspot/user/add');
    $addRequest->setArgument('name',     $userDetails['name'])
               ->setArgument('password', $userDetails['password'])
               ->setArgument('profile',  $userDetails['profile'])
               ->setArgument('comment',  $userDetails['comment']);

    // If there's a time limit
    if (!empty($userDetails['limit-uptime'])) {
        $addRequest->setArgument('limit-uptime', $userDetails['limit-uptime']);
    }
    // If there's a data limit
    if (!empty($userDetails['limit-bytes-total'])) {
        $addRequest->setArgument('limit-bytes-total', $userDetails['limit-bytes-total']);
    }

    // Send the request
    $client->sendSync($addRequest);

    // cURL request to connected.php ...
    $connectedUrl = APP_URL . '/system/connected.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            $connectedUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST,           true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode(['username' => $uname, 'routerId' => $routerId]));
    curl_setopt($ch, CURLOPT_HTTPHEADER,    ['Content-Type: application/json']);
    $curlResponse = curl_exec($ch);
    curl_close($ch);

} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
