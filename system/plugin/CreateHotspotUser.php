<?php

function Alloworigins()
{
    // First, check if "type" is in the query string
    if (isset($_GET['type'])) {
        $type = $_GET['type'];

        // Decide which function to call
        if ($type === "verify") {
            VerifyHotspot();
            exit(); // End after JSON response for verify
        } 
        elseif ($type === "grant") {
            CreateHostspotUser();
            exit(); // End after JSON response for grant
        }
    }

    // If neither "verify" nor "grant" matched, do nothing
    // Removing the final "exit()" so we don't kill the entire panel.
    // return; // or do nothing
}

function VerifyHotspot()
{
    // Always return JSON
    header('Content-Type: application/json; charset=utf-8');

    // We expect POST: phone_number
    if (!isset($_POST['phone_number'])) {
        echo json_encode([
            "Resultcode" => "400",
            "Message"    => "Missing phone_number in POST",
            "Status"     => "error"
        ]);
        exit();
    }

    $phone = $_POST['phone_number'];

    $user = ORM::for_table('tbl_payment_gateway')
        ->where('username', $phone)
        ->order_by_desc('id')
        ->find_one();

    // If no record found, return an error as JSON
    if (!$user) {
        echo json_encode([
            "Resultcode" => "404",
            "Message"    => "No user/payment record found for phone=$phone",
            "Status"     => "error"
        ]);
        exit();
    }

    $status    = $user->status;          // e.g., 1,2,4...
    $mpesacode = $user->gateway_trx_id;  // e.g., M-Pesa code
    $res       = $user->pg_paid_response;

    // Payment success = status=2 and mpesacode not empty
    if ($status == 2 && !empty($mpesacode)) {
        $data = [
            "Resultcode" => "3",
            "phone"      => $phone,
            "tyhK"       => "1234",
            "Message"    => "We have received your transaction under Mpesa Transaction $mpesacode, please don't leave this page as we are redirecting you",
            "Status"     => "success"
        ];
        echo json_encode($data);
        exit();
    }

    // If "Not enough balance"
    if ($res == "Not enough balance") {
        $data = [
            "Resultcode" => "2",
            "Message1"   => "Insufficient Balance for the transaction",
            "Status"     => "danger",
            "Redirect"   => "Insufficient balance"
        ];
        echo json_encode($data);
        exit();
    }

    // If "Wrong Mpesa pin"
    if ($res == "Wrong Mpesa pin") {
        $data = [
            "Resultcode" => "2",
            "Message"    => "You entered Wrong Mpesa pin, please resubmit",
            "Status"     => "danger",
            "Redirect"   => "Wrong Mpesa pin"
        ];
        echo json_encode($data);
        exit();
    }

    // If user canceled
    if ($status == 4) {
        $data = [
            "Resultcode" => "2",
            "Message"    => "You cancelled the transaction, you can enter phone number again to activate",
            "Status"     => "info",
            "Redirect"   => "Transaction Cancelled"
        ];
        echo json_encode($data);
        exit();
    }

    // If no mpesacode => Payment is probably still pending
    if (empty($mpesacode)) {
        $data = [
            "Resultcode" => "1",
            "Message"    => "A payment pop up has been sent to $phone, Please enter pin to continue (Please do not leave or reload the page until redirected)",
            "Status"     => "primary"
        ];
        echo json_encode($data);
        exit();
    }

    // If we got here, no known status matched => fallback
    echo json_encode([
        "Resultcode" => "0",
        "Message"    => "No recognized payment status. Possibly pending or unknown.",
        "Status"     => "info"
    ]);
    exit();
}

function CreateHostspotUser()
{
    // Set JSON header
    header('Content-Type: application/json; charset=utf-8');

    // Parse JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Extract data from JSON input
    $phone    = isset($input['phone_number']) ? $input['phone_number'] : '';
    $planId   = isset($input['plan_id'])      ? $input['plan_id']      : '';
    $routerId = isset($input['router_id'])    ? $input['router_id']    : '';

    // Retrieve the MAC address from the login page
    $macAddress = isset($input['mac_address']) ? $input['mac_address'] : '';

    // Create the username using the MAC address
    $username = $phone . '-' . $macAddress;

    // Validate/clean the phone
    $phone = (substr($phone, 0, 1) == '+') ? str_replace('+', '', $phone) : $phone;
    $phone = (substr($phone, 0, 1) == '0') ? preg_replace('/^0/', '254', $phone) : $phone;
    $phone = (substr($phone, 0, 1) == '7') ? preg_replace('/^7/', '2547', $phone) : $phone;
    $phone = (substr($phone, 0, 1) == '1') ? preg_replace('/^1/', '2541', $phone) : $phone;
    $phone = (substr($phone, 0, 1) == '0') ? preg_replace('/^01/', '2541', $phone) : $phone;
    $phone = (substr($phone, 0, 1) == '0') ? preg_replace('/^07/', '2547', $phone) : $phone;

    // Check length
    if (strlen($phone) !== 12) {
        echo json_encode([
            'status'  => 'error',
            'code'    => 1,
            'message' => 'Phone number is invalid please confirm'
        ]);
        exit();
    }

    // Make sure plan/router is present
    if (strlen($phone) == 12 && !empty($planId) && !empty($routerId)) {
        $PlanExist   = ORM::for_table('tbl_plans')->where('id', $planId)->count() > 0;
        $RouterExist = ORM::for_table('tbl_routers')->where('id', $routerId)->count() > 0;

        if (!$PlanExist || !$RouterExist) {
            echo json_encode([
                "status"  => "error",
                "message" => "Unable to process your request, please refresh the page"
            ]);
            exit();
        }

        // Check if user with same username already exists
        $Userexist = ORM::for_table('tbl_customers')->where('username', $username)->find_one();
        if ($Userexist) {
            // Update the router ID for existing user
            $Userexist->router_id = $routerId;
            $Userexist->save();

            // Initiate STK push
            InitiateStkpush($phone, $username, $planId, $routerId);
            exit();
        }

        // Create a new user
        $defpass = '1234';
        $defaddr = 'FreeispRadius';
        $defmail = $phone . '@gmail.com';
        $router  = $routerId;

        $createUser = ORM::for_table('tbl_customers')->create();
        $createUser->username       = $username;
        $createUser->password       = $defpass;
        $createUser->fullname       = $phone;
        $createUser->phonenumber    = $phone;
        $createUser->pppoe_password = $defpass;
        $createUser->address        = $defaddr;
        $createUser->email          = $defmail;
        $createUser->service_type   = 'Hotspot';
        $createUser->router_id      = $router;

        if ($createUser->save()) {
            InitiateStkpush($phone, $username, $planId, $routerId);
            // we do the stk push here
            exit();
        } else {
            echo json_encode([
                "status"  => "error",
                "message" => "There was a system error when registering user, please contact support"
            ]);
            exit();
        }
    }

    // If we reach here, no response has been sent; plan/router missing?
    // If that’s expected, we can do nothing OR return an error
    echo json_encode([
        "status"  => "error",
        "message" => "Plan ID or Router ID not specified or phone invalid length"
    ]);
    exit();
}

function InitiateStkpush($phone, $username, $planId, $routerId)
{
    $gateway = ORM::for_table('tbl_appconfig')
        ->where('setting', 'payment_gateway')
        ->find_one();
    $gateway = ($gateway) ? $gateway->value : null;

    $url = '';
    if ($gateway == "MpesatillStk") {
        $url = (U . "plugin/initiatetillstk");
    } elseif ($gateway == "BankStkPush") {
        $url = (U . "plugin/initiatebankstk");
    } elseif ($gateway == "MpesaPaybill") {
        $url = (U . "plugin/initiatePaybillStk");
    }

    $PlannameObj = ORM::for_table('tbl_plans')
        ->where('id', $planId)
        ->order_by_desc('id')
        ->find_one();

    $Findrouter = ORM::for_table('tbl_routers')
        ->where('id', $routerId)
        ->order_by_desc('id')
        ->find_one();

    $rname    = $Findrouter->name;
    $price    = $PlannameObj->price;
    $Planname = $PlannameObj->name_plan;

    $Checkorders = ORM::for_table('tbl_payment_gateway')
        ->where('username', $username)
        ->where('status', 1)
        ->order_by_desc('id')
        ->find_many();

    if ($Checkorders) {
        foreach ($Checkorders as $Dorder) {
            $Dorder->delete();
        }
    }

    // Create new record in payment_gateway
    $d = ORM::for_table('tbl_payment_gateway')->create();
    $d->username       = $username;
    $d->gateway        = $gateway;
    $d->plan_id        = $planId;
    $d->plan_name      = $Planname;
    $d->routers_id     = $routerId;
    $d->routers        = $rname;
    $d->price          = $price;
    $d->payment_method = $gateway;
    $d->payment_channel= $gateway;
    $d->created_date   = date('Y-m-d H:i:s');
    $d->paid_date      = date('Y-m-d H:i:s');
    $d->expired_date   = date('Y-m-d H:i:s');
    $d->pg_url_payment = $url;
    $d->status         = 1;
    $d->save();

    // Immediately return success JSON
    echo json_encode([
        "status"  => "success",
        "phone"   => $phone,
        "message" => "Registration complete, Please enter Mpesa Pin to activate the package"
    ]);

    // Then do the STK push in the background
    SendSTKcred($phone, $username, $url);
}

function SendSTKcred($phone, $username, $url)
{
    // Do not echo anything here
    $link = $url;
    $fields = [
        'username' => $username,
        'phone'    => $phone,
        'channel'  => 'Yes',
    ];

    $postvars = http_build_query($fields);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    // If there's a cURL error, you can log it but don't echo it
    if (curl_errno($ch)) {
        error_log("SendSTKcred cURL error: " . curl_error($ch));
    }

    curl_close($ch);
}

// Finally, call the function
Alloworigins();
?>
