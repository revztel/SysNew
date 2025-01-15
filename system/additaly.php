<?php

// Include your config file
include 'config.php';

try {
    // Connect to DB
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Fetch the router info
$stmt = $conn->prepare("SELECT * FROM tbl_routers WHERE id = :routerId");
$stmt->bindParam(':routerId', $routerId, PDO::PARAM_INT);
$stmt->execute();
$routerResult = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$routerResult) {
    die('Router not found');
}

$username        = $routerResult['username'];    // Router login
$password        = $routerResult['password'];    // Router password
$routerIpAddress = $routerResult['ip_address'];

use PEAR2\Net\RouterOS;

try {
    // Create a RouterOS client
    $client = new RouterOS\Client($routerIpAddress, $username, $password);

    // For "limited" plans, we may have fields:
    //   $plans->typebp, $plans->data_limit, $plans->data_unit,
    //   $plans->time_limit, $plans->time_unit
    $typebp     = $plans->typebp;
    $data_limit = $plans->data_limit;
    $data_unit  = $plans->data_unit;
    $time_limit = $plans->time_limit;
    $time_unit  = $plans->time_unit;

    // Prepare user details. We'll use $user->password as the dynamic password.
    // e.g., if $user is a record from tbl_customers, do $userDetails['password'] = $user->password
    $userDetails = [
        'name'     => $uname,
        'password' => $user->password,  // DYNAMIC password from DB
        'profile'  => $plan_name,       // from $plans->name or similar
        'comment'  => 'Exp: ' . $expiry_date . ' ' . $expiry_time
    ];

    // We NO LONGER remove the user if they exist; you asked to remove that code

    // If the plan is "Limited", add time & data limits
    if ($typebp === "Limited") {
        // Time limit
        if (!empty($time_limit) && !empty($time_unit)) {
            // Example: if time_unit='Hrs' => "X:00:00"
            //          if time_unit='Mins' => "00:X:00"
            if ($time_unit === 'Hrs') {
                $timelimit = $time_limit . ":00:00";
            } else {
                // default to minutes
                $timelimit = "00:" . $time_limit . ":00";
            }
            $userDetails['limit-uptime'] = $timelimit;
        }
        // Data limit
        if (!empty($data_limit) && !empty($data_unit)) {
            if ($data_unit === 'GB') {
                $datalimit = $data_limit * 1000000000;
            } else {
                // default to MB
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

    if (!empty($userDetails['limit-uptime'])) {
        $addRequest->setArgument('limit-uptime', $userDetails['limit-uptime']);
    }
    if (!empty($userDetails['limit-bytes-total'])) {
        $addRequest->setArgument('limit-bytes-total', $userDetails['limit-bytes-total']);
    }

    // Send the request to add/replace user
    $client->sendSync($addRequest);

    // cURL request to connected.php ...
    $connectedUrl = APP_URL . '/system/connected.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            $connectedUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST,           true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode(['username' => $uname, 'routerId' => $routerId]));
    curl_setopt($ch, CURLOPT_HTTPHEADER,     ['Content-Type: application/json']);
    $curlResponse = curl_exec($ch);
    curl_close($ch);

} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
