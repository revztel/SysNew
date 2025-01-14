<?php
         
// Include the config file with proper error handling
include 'init.php';


try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Assuming $conn is your PDO connection object
$stmt = $conn->prepare("SELECT * FROM tbl_routers WHERE id = :routerId");

// Bind the routerId parameter to the placeholder
$stmt->bindParam(':routerId', $routerId);

// Execute the query
$stmt->execute();

// Fetch the router result
$routerResult = $stmt->fetch(PDO::FETCH_ASSOC);

if ($routerResult) {
    // Router with the specified ID found
    $username = $routerResult['username'];
    $password = $routerResult['password'];
    $routerIpAddress = $routerResult['ip_address'];
} else {
    die('Router not found');
}


use PEAR2\Net\RouterOS;

try {
    // Create a RouterOS client
    $client = new RouterOS\Client($routerIpAddress, $username, $password);

    // Create a Util object using the client
    $util = new RouterOS\Util($client);

    // Additional parameters for limited plans
    $typebp = $plans->typebp;
    $data_limit = $plans->data_limit;
    $data_unit = $plans->data_unit;
    $time_limit = $plans->time_limit;
    $time_unit = $plans->time_unit;

    // Prepare user details
    $userDetails = array(
        'name'     => $uname,
        'password' => '1234',
        'profile'  => $plan_name
    );

    // Remove the user first if they exist (applies to both Limited and Unlimited plans)
    $removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
    $removeRequest->setArgument('numbers', $uname);
    try {
        $client->sendSync($removeRequest);
    } catch (Exception $e) {
        // User might not exist; handle exception if necessary
    }

    // If the plan is "Limited", add time and data limits
    if ($typebp == "Limited") {
        // Set time limit if provided
        if (!empty($time_limit) && !empty($time_unit)) {
            if ($time_unit == 'Hrs') {
                $timelimit = $time_limit . ":00:00";
            } else {
                $timelimit = "00:" . $time_limit . ":00";
            }
            $userDetails['limit-uptime'] = $timelimit;
        }

        // Set data limit if provided
        if (!empty($data_limit) && !empty($data_unit)) {
            if ($data_unit == 'GB') {
                $datalimit = $data_limit * 1000000000; // Convert GB to bytes
            } else {
                $datalimit = $data_limit * 1000000; // Convert MB to bytes
            }
            $userDetails['limit-bytes-total'] = $datalimit;
        }
    }

    // Add the new hotspot user with limits if applicable
    $addRequest = new RouterOS\Request('/ip/hotspot/user/add');
    $addRequest->setArgument('name', $userDetails['name'])
               ->setArgument('password', $userDetails['password'])
               ->setArgument('profile', $userDetails['profile']);

    if (isset($userDetails['limit-uptime'])) {
        $addRequest->setArgument('limit-uptime', $userDetails['limit-uptime']);
    }

    if (isset($userDetails['limit-bytes-total'])) {
        $addRequest->setArgument('limit-bytes-total', $userDetails['limit-bytes-total']);
    }

    // Send the request to add the user
    $client->sendSync($addRequest);
// In adduser.php, after adding the user
// Generate the URL for connected.php using APP_URL
$connectedUrl = APP_URL . '/system/connected.php';

// Send a JSON request to connected.php to check if the user is connected
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $connectedUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['username' => $uname, 'routerId' => $routerId]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);



} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
