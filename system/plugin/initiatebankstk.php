<?php

function initiatebankstk()
{
    // **Important**: Always return JSON
    header('Content-Type: application/json; charset=utf-8');



    // Collect form POST data
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $phone    = isset($_POST['phone']) ? $_POST['phone'] : '';

    // Basic phone formatting
    $phone = (substr($phone, 0,1) == '+') ? str_replace('+', '', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^0/', '254', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '7') ? preg_replace('/^7/', '2547', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '1') ? preg_replace('/^1/', '2541', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^01/', '2541', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^07/', '2547', $phone) : $phone;

    // Load bank account name, etc.
    $bankaccountRow = ORM::for_table('tbl_appconfig')
        ->where('setting', 'Stkbankacc')
        ->find_one();
    $banknameRow = ORM::for_table('tbl_appconfig')
        ->where('setting', 'Stkbankname')
        ->find_one();

    $bankaccount = $bankaccountRow ? $bankaccountRow->value : null;
    $bankname    = $banknameRow ? $banknameRow->value : null;

    // If something is missing, return JSON error
    if (empty($bankaccount) || empty($bankname)) {
        error_log("initiatebankstk.php: bankaccount or bankname is empty. Cannot proceed.");
        echo json_encode([
            "status"  => "error",
            "message" => "Could not complete payment: missing bank info. Please contact admin."
        ]);
        return;
    }

    // Check user duplication
    $CheckId = ORM::for_table('tbl_customers')
        ->where('username', $username)
        ->order_by_desc('id')
        ->find_one();

    if (!$CheckId) {
        // If there's no such user at all, we can't proceed
        error_log("initiatebankstk.php: No such user: $username");
        echo json_encode([
            "status"  => "error",
            "message" => "No user found with username=$username"
        ]);
        return;
    }

    $CheckUser = ORM::for_table('tbl_customers')
        ->where('username', $username)
        ->find_many();

    $UserId = $CheckId->id;
    if (!empty($CheckUser)) {
        ORM::for_table('tbl_customers')
            ->where('username', $username)
            ->where_not_equal('id', $UserId)
            ->delete_many();
    }

    // PaymentGatewayRecord
    $PaymentGatewayRecord = ORM::for_table('tbl_payment_gateway')
        ->where('username', $username)
        ->where('status', 1)
        ->order_by_desc('id')
        ->find_one();

    if (!$PaymentGatewayRecord) {
        echo json_encode([
            "status"  => "error",
            "message" => "Could not complete payment request. No active Payment Gateway Record."
        ]);
        return;
    }

    // Update phone in tbl_customers
    $ThisUser = ORM::for_table('tbl_customers')
        ->where('username', $username)
        ->order_by_desc('id')
        ->find_one();
    if ($ThisUser) {
        $ThisUser->phonenumber = $phone;
        $ThisUser->save();
    }

    // The amount to be charged
    $amount = $PaymentGatewayRecord->price;

    // If no price found, can't proceed
    if (!$amount) {

        return;
    }

    // Retrieve paybill from tbl_banks
    $getpaybill = ORM::for_table('tbl_banks')
        ->where('name', $bankname)
        ->find_one();

    if (!$getpaybill) {
        error_log("initiatebankstk.php: Could not find paybill for bank=$bankname");
        echo json_encode([
            "status"  => "error",
            "message" => "Could not find bank paybill, contact admin."
        ]);
        return;
    }

    $paybill = $getpaybill->paybill; // e.g. 123456

    // Callback URL
    $cburl = U . 'callback/BankStkPush';

    //-----------------------------
    // 1) OBTAIN OAUTH TOKEN
    //-----------------------------
    $consumerKey    = '3AmVP1WFDQn7GrDH8GcSSKxcAvnJdZGC'; 
    $consumerSecret = '71Lybl6jUtxM0F35'; 
    $headers        = ['Content-Type:application/json; charset=utf8'];
    $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);

    $result  = curl_exec($curl);
    $status  = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // cURL error check
    if (curl_errno($curl)) {
        $curl_err = curl_error($curl);
        error_log("initiatebankstk.php: cURL error obtaining token: " . $curl_err);
        echo json_encode([
            "status"  => "error",
            "message" => "Could not fetch token from Safaricom. Please try again later."
        ]);
        curl_close($curl);
        return;
    }

    if ($status !== 200) {
        error_log("initiatebankstk.php: Unexpected HTTP status=$status from token endpoint. Raw response=$result");
        echo json_encode([
            "status"  => "error",
            "message" => "Safaricom token request returned an unexpected status. Please try again."
        ]);
        curl_close($curl);
        return;
    }

    $resultData   = json_decode($result);
    if (!isset($resultData->access_token)) {
        error_log("initiatebankstk.php: No access_token in response. Raw=$result");
        echo json_encode([
            "status"  => "error",
            "message" => "Missing access token in Safaricom response."
        ]);
        curl_close($curl);
        return;
    }
    $access_token = $resultData->access_token;
    curl_close($curl);

    //-----------------------------
    // 2) INITIATE STK PUSH
    //-----------------------------
    $stk_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $PartyA   = $phone; 
    $AccountReference = $bankaccount;
    $TransactionDesc  = 'TestMapayment'; 
    $Amount           = $amount;

    // Hard-coded from your snippet
    $BusinessShortCode = '4137989';
    $Passkey           = '3a45e88faa037b86fbd0c494676d71c3c23574203b2bf721066f90598bbd8bb8';
    $Timestamp         = date("YmdHis");
    $Password          = base64_encode($BusinessShortCode . $Passkey . $Timestamp);
    $CallBackURL       = $cburl;

    $curl2 = curl_init($stk_url);
    curl_setopt($curl2, CURLOPT_HTTPHEADER, [
        'Content-Type:application/json',
        'Authorization:Bearer ' . $access_token
    ]);
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl2, CURLOPT_POST, true);

    // Build STK push data
    $curl_post_data = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password'          => $Password,
        'Timestamp'         => $Timestamp,
        'TransactionType'   => 'CustomerPayBillOnline',
        'Amount'            => $Amount,
        'PartyA'            => $PartyA,
        'PartyB'            => $paybill,
        'PhoneNumber'       => $PartyA,
        'CallBackURL'       => $CallBackURL,
        'AccountReference'  => $AccountReference,
        'TransactionDesc'   => $TransactionDesc
    ];

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl2, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl2);

    // cURL error check
    if (curl_errno($curl2)) {
        $curl2_err = curl_error($curl2);
        error_log("initiatebankstk.php: cURL error sending STK push: " . $curl2_err);
        echo json_encode([
            "status"  => "error",
            "message" => "Could not initiate STK push. Please try again."
        ]);
        curl_close($curl2);
        return;
    }

    $httpStatus2 = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
    if ($httpStatus2 !== 200) {
        error_log("initiatebankstk.php: Unexpected HTTP status=$httpStatus2 from STK push. Raw response=$curl_response");
        echo json_encode([
            "status"  => "error",
            "message" => "Safaricom STK push endpoint returned an unexpected status. Please try again."
        ]);
        curl_close($curl2);
        return;
    }

    // Decode the STK push response
    $mpesaResponse = json_decode($curl_response);
    if (!$mpesaResponse) {
        error_log("initiatebankstk.php: Invalid JSON response from STK push. Raw=$curl_response");
        echo json_encode([
            "status"  => "error",
            "message" => "Got invalid JSON from Safaricom STK push. Please try again later."
        ]);
        curl_close($curl2);
        return;
    }

    // For a successful push, we usually see: ResponseCode=="0"
    $responseCode      = isset($mpesaResponse->ResponseCode) ? $mpesaResponse->ResponseCode : null;
    $resultDesc        = isset($mpesaResponse->resultDesc) ? $mpesaResponse->resultDesc : '';
    $MerchantRequestID = isset($mpesaResponse->MerchantRequestID) ? $mpesaResponse->MerchantRequestID : '';
    $CheckoutRequestID = isset($mpesaResponse->CheckoutRequestID) ? $mpesaResponse->CheckoutRequestID : '';

    curl_close($curl2);

    if ($responseCode == "0") {
        // Payment request was accepted. Update record and respond with success
        date_default_timezone_set('Africa/Nairobi');
        $PaymentGatewayRecord->pg_paid_response = $resultDesc;
        $PaymentGatewayRecord->username         = $username;
        $PaymentGatewayRecord->checkout         = $CheckoutRequestID;
        $PaymentGatewayRecord->payment_method   = 'Mpesa Stk Push';
        $PaymentGatewayRecord->payment_channel  = 'Mpesa Stk Push';
        $PaymentGatewayRecord->save();

        // Query script in background
        $queryUrl = APP_URL . '/query.php';
        $postData = http_build_query(['CheckoutRequestID' => $CheckoutRequestID]);
        $command  = "curl -X POST -d \"$postData\" \"$queryUrl\" > /dev/null 2>&1 &";
        $handle   = popen($command, 'r');
        pclose($handle);

        // Return success JSON
        echo json_encode([
            "status"  => "success",
            "message" => "Enter M-Pesa Pin to complete",
            "info"    => "CheckoutRequestID=$CheckoutRequestID"
        ]);
        return;
    } else {
        // Something went wrong with the STK push
        // Log the entire $mpesaResponse for debugging
        error_log("initiatebankstk.php: STK push failed. raw response: " . $curl_response);


        return;
    }
}
