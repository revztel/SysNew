<?php
// mpesacode.php

include __DIR__ . '/../config.php';

// Function to write logs to mpesacode.log with a maximum of 5000 lines
function writeLog($message) {
    $logFile = __DIR__ . '/mpesacode.log'; 
    $maxLines = 5000;

    $date = date('Y-m-d H:i:s');
    $formattedMessage = "[$date] $message" . PHP_EOL;
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);

    // Prune if > 5000 lines
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, -$maxLines);
        file_put_contents($logFile, implode(PHP_EOL, $lines) . PHP_EOL);
    }
}

header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    writeLog('Database connection successful');
} catch (PDOException $e) {
    writeLog('Database connection failed: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Grab JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate mpesa_code
if (!isset($data['mpesa_code']) || empty(trim($data['mpesa_code']))) {
    writeLog('mpesa_code not provided or empty in the request');
    echo json_encode(['status' => 'error', 'message' => 'mpesa_code not provided or empty']);
    exit;
}

// Validate router_name
if (!isset($data['router_name']) || empty(trim($data['router_name']))) {
    writeLog('router_name not provided or empty in the request');
    echo json_encode(['status' => 'error', 'message' => 'router_name not provided or empty']);
    exit;
}

$mpesa_message = trim($data['mpesa_code']);
$mpesa_code    = strtok($mpesa_message, " ");
$router_name   = trim($data['router_name']);

writeLog("Received mpesa_message: $mpesa_message, extracted mpesa_code: $mpesa_code, current router: $router_name");

// 1. Find an active transaction for this mpesa_code
$stmt = $conn->prepare("
    SELECT r.id AS recharge_id, r.username, r.plan_id, r.routers, r.expiration,
           p.name_plan, p.id_bw, p.validity, p.validity_unit
    FROM tbl_user_recharges r
    LEFT JOIN tbl_plans p ON p.id = r.plan_id
    WHERE r.method LIKE CONCAT('%-', :mpesa_code)
      AND r.status = 'on'
    ORDER BY r.recharged_on DESC, r.recharged_time DESC
    LIMIT 1
");
$stmt->bindParam(':mpesa_code', $mpesa_code);
$stmt->execute();
$originalRecord = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$originalRecord) {
    // Not found or expired
    writeLog("Transaction not found for mpesa_code $mpesa_code");
    echo json_encode([
        'status' => 'error',
        'message' => 'Transaction not found or account has already expired.'
    ]);
    exit;
}

// 2. Check if the user is already active *on this same router*
$username   = $originalRecord['username'];
$planId     = $originalRecord['plan_id'];
$planName   = $originalRecord['name_plan'];
$expiration = $originalRecord['expiration'];
$routers    = $originalRecord['routers']; // This might be "Router1" or "Allinonecomrade", etc.

writeLog("Transaction found: username=$username, planId=$planId, planName=$planName, expiration=$expiration, routers=$routers");

// 3. If the user is ALREADY on the same router, we just confirm success
if (strpos($routers, $router_name) !== false) {
    writeLog("User is already active on router $router_name.");
    echo json_encode([
        'status'  => 'success',
        'message' => "Transaction found (already on $router_name).",
        'username'=> $username
    ]);
    exit;
}

// 4. Otherwise, we do the "roaming" logic
//    We'll create or copy the plan into the current router if needed, 
//    and then create a new user_recharges entry for that router.

try {
    $conn->beginTransaction();

    // --- 4a. Duplicate the plan if you want a new plan entry per router ---
    // Example approach: 
    // Check if there's an existing plan with the name "Roaming from {planName} - $router_name"
    $roamingPlanName = "Roaming from {$planName} - {$routers}"; 
    // Or you can do something like: "Roaming from Router1" 
    // if you prefer to parse out from $routers
    
    // Query to see if the plan is already created for this router
    $stmtCheckPlan = $conn->prepare("
        SELECT id 
        FROM tbl_plans
        WHERE name_plan = :planName
          AND routers = :routerName
        LIMIT 1
    ");
    $stmtCheckPlan->execute([
        ':planName'   => $roamingPlanName,
        ':routerName' => $router_name
    ]);
    $existingRoamingPlan = $stmtCheckPlan->fetch(PDO::FETCH_ASSOC);

    $newPlanId = null;
    if (!$existingRoamingPlan) {
        // Plan doesn't exist yet, so let's insert one
        $stmtInsertPlan = $conn->prepare("
            INSERT INTO tbl_plans 
            (name_plan, id_bw, price, type, typebp, limit_type, time_limit, time_unit, 
             data_limit, data_unit, validity, validity_unit, shared_users, routers, is_radius)
            VALUES
            (:name_plan, :id_bw, 0, 'Hotspot', 'Unlimited', 'Time_Limit', 0, 'Hrs', 
             0, 'MB', :validity, :validity_unit, 1, :routers, 0)
        ");
        $stmtInsertPlan->execute([
            ':name_plan'     => $roamingPlanName,
            ':id_bw'         => $originalRecord['id_bw'],        // same bandwidth
            ':validity'      => $originalRecord['validity'],     // e.g. 6
            ':validity_unit' => $originalRecord['validity_unit'],// e.g. "Hrs"
            ':routers'       => $router_name
        ]);
        $newPlanId = $conn->lastInsertId();
        writeLog("Created new roaming plan with id=$newPlanId for router=$router_name");
    } else {
        // We found an existing plan for this "roaming" scenario
        $newPlanId = $existingRoamingPlan['id'];
        writeLog("Reusing existing roaming plan id=$newPlanId for router=$router_name");
    }

    // --- 4b. Insert a new user_recharges row for the current router ---
    $stmtInsertRecharge = $conn->prepare("
        INSERT INTO tbl_user_recharges (
            customer_id, username, plan_id, namebp,
            recharged_on, recharged_time, expiration, time, status,
            method, routers, type, admin_id, state,
            last_seen, disconnection_reason, disconnection_time, was_connected,
            reconnection, fup_enabled, original_profile, reminder_sent, extend
        )
        SELECT 
            customer_id, username, :newPlanId, :roamingPlanName,
            recharged_on, recharged_time, expiration, time, status,
            method, :newRouter, type, admin_id, state,
            last_seen, disconnection_reason, disconnection_time, was_connected,
            reconnection, fup_enabled, original_profile, reminder_sent, extend
        FROM tbl_user_recharges
        WHERE id = :originalId
        LIMIT 1
    ");
    $stmtInsertRecharge->execute([
        ':newPlanId'       => $newPlanId,
        ':roamingPlanName' => $roamingPlanName,
        ':newRouter'       => $router_name,
        ':originalId'      => $originalRecord['recharge_id']
    ]);
    $newRechargeId = $conn->lastInsertId();

    // Optionally update the new row’s `method` so it’s unique 
    // (important to avoid collisions with the same Mpesa code).
    // Example: append the new router name
    $newMethod = $mpesa_code . '-roaming-' . $router_name;
    $stmtUpdateMethod = $conn->prepare("
        UPDATE tbl_user_recharges
        SET method = CONCAT(method, ' | $router_name')
        WHERE id = :id
    ");
    $stmtUpdateMethod->execute([':id' => $newRechargeId]);

    // --- 4c. (Optional) Add the user to Mikrotik for Router2 ---
    // You might call a function or an API to add the user to the new router’s Hotspot/PPP
    // e.g. mikrotikAddUser($username, $something...);

    $conn->commit();

    // 5. Return success
    writeLog("Roaming record created successfully for username=$username on router=$router_name, newRechargeId=$newRechargeId");
    echo json_encode([
        'status'   => 'success',
        'message'  => "Transaction found on another router; roaming plan auto-created.",
        'username' => $username
    ]);

} catch (Exception $e) {
    $conn->rollBack();
    writeLog("Error in roaming logic: " . $e->getMessage());
    echo json_encode([
        'status'  => 'error',
        'message' => 'Failed to create roaming subscription: ' . $e->getMessage()
    ]);
    exit;
}

?>
