<?php
function initiatetillstk()
{
    // If you want logs in your server's error log
    error_log("initiatetillstk.php: Starting initiatetillstk()...");

    $username = $_POST['username'];
    $phone    = $_POST['phone'];
    error_log("initiatetillstk.php: Received username=$username, phone=$phone from POST data.");

    // Clean phone
    $phone = (substr($phone, 0,1) == '+') ? str_replace('+', '', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^0/', '254', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '7') ? preg_replace('/^7/', '2547', $phone) : $phone; 
    $phone = (substr($phone, 0,1) == '1') ? preg_replace('/^1/', '2541', $phone) : $phone; 
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^01/', '2541', $phone) : $phone;
    $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^07/', '2547', $phone) : $phone;

    // DB lookups with your ORM
    $consumer_key = ORM::for_table('tbl_appconfig')
        ->where('setting', 'mpesa_till_consumer_key')
        ->find_one();
    $consumer_secret = ORM::for_table('tbl_appconfig')
        ->where('setting', 'mpesa_till_consumer_secret')
        ->find_one();
    $BusinessShortCode = ORM::for_table('tbl_appconfig')
        ->where('setting', 'mpesa_till_shortcode_code')
        ->find_one();
    $PartyB = ORM::for_table('tbl_appconfig')
        ->where('setting', 'mpesa_till_partyb')
        ->find_one();
    $LipaNaMpesaPasskey = ORM::for_table('tbl_appconfig')
        ->where('setting', 'mpesa_till_pass_key')
        ->find_one();

    // Convert them to real values
    $consumer_key        = ($consumer_key) ? $consumer_key->value : null;
    $consumer_secret     = ($consumer_secret) ? $consumer_secret->value : null;
    $BusinessShortCode   = ($BusinessShortCode) ? $BusinessShortCode->value : null;
    $PartyB              = ($PartyB) ? $PartyB->value : null;
    $LipaNaMpesaPasskey  = ($LipaNaMpesaPasskey) ? $LipaNaMpesaPasskey->value : null;

    $cburl = U . 'callback/MpesatillStk';

    // Clean up user duplication
    $CheckId = ORM::for_table('tbl_customers')
        ->where('username', $username)
        ->order_by_desc('id')
        ->find_one();

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

    // Payment Gateway record
    $PaymentGatewayRecord = ORM::for_table('tbl_payment_gateway')
        ->where('username', $username)
        ->where('status', 1)
        ->order_by_desc('id')
        ->find_one();

    if (!$PaymentGatewayRecord) {
        // Always return JSON
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status'  => 'error',
            'message' => 'Unable to process payment, please reload the page'
        ]);
        exit();
    }

    // Update this user in DB
    $ThisUser = ORM::for_table('tbl_customers')
        ->where('username', $username)
        ->order_by_desc('id')
        ->find_one();

    $ThisUser->phonenumber = $phone;
    $ThisUser->save();

    // Payment amount
    $amount = $PaymentGatewayRecord->price;

    // STK push parameters
    $TransactionType = 'CustomerBuyGoodsOnline';
    $tokenUrl       = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $lipaOnlineUrl  = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $CallBackURL    = $cburl;

    date_default_timezone_set('Africa/Nairobi');
    $timestamp = date("YmdHis");
    $password  = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $timestamp);

    //================ FETCH TOKEN ==================
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $tokenUrl);
    $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $curl_response = curl_exec($curl);
    if (curl_errno($curl)) {
        // cURL error
        error_log("initiatetillstk.php: cURL error fetching token: " . curl_error($curl));



        exit();
    }

    // Check if token is valid JSON
    $tokenData = json_decode($curl_response);
    if (!isset($tokenData->access_token)) {
        error_log("initiatetillstk.php: No access_token in response: " . $curl_response);


        exit();
    }
    $token = $tokenData->access_token;

    //================ SEND STK PUSH =================
    $curl2 = curl_init();
    curl_setopt($curl2, CURLOPT_URL, $lipaOnlineUrl);
    curl_setopt($curl2, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization:Bearer ' . $token
    ));
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl2, CURLOPT_POST, true);

    $curl2_post_data = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password'          => $password,
        'Timestamp'         => $timestamp,
        'TransactionType'   => $TransactionType,
        'Amount'            => $amount,
        'PartyA'            => $phone,
        'PartyB'            => $PartyB,
        'PhoneNumber'       => $phone,
        'CallBackURL'       => $CallBackURL,
        'AccountReference'  => 'Payment For Goods',
        'TransactionDesc'   => 'Payment for goods',
    ];
    $data2_string = json_encode($curl2_post_data);
    curl_setopt($curl2, CURLOPT_POSTFIELDS, $data2_string);
    curl_setopt($curl2, CURLOPT_HEADER, false);
    curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, 0);

    $stk_response = curl_exec($curl2);
    if (curl_errno($curl2)) {
        error_log("initiatetillstk.php: cURL error sending STK push: " . curl_error($curl2));


        exit();
    }

    $mpesaResponse = json_decode($stk_response);
    if (empty($mpesaResponse)) {
        error_log("initiatetillstk.php: Invalid JSON from STK push: " . $stk_response);


        exit();
    }

    // Check Safaricom response
    $responseCode      = isset($mpesaResponse->ResponseCode) ? $mpesaResponse->ResponseCode : null;
    $MerchantRequestID = isset($mpesaResponse->MerchantRequestID) ? $mpesaResponse->MerchantRequestID : '';
    $CheckoutRequestID = isset($mpesaResponse->CheckoutRequestID) ? $mpesaResponse->CheckoutRequestID : '';
    $resultDesc        = isset($mpesaResponse->CustomerMessage) ? $mpesaResponse->CustomerMessage : '';

    if ($responseCode !== "0") {
        // STK push failed
        error_log("initiatetillstk.php: STK push failed - code=$responseCode, raw response: $stk_response");


        exit();
    }

    // If everything is OK
    $PaymentGatewayRecord->pg_paid_response = $resultDesc;
    $PaymentGatewayRecord->checkout         = $CheckoutRequestID;
    $PaymentGatewayRecord->username         = $username;
    $PaymentGatewayRecord->payment_method   = 'Mpesa Stk Push';
    $PaymentGatewayRecord->payment_channel  = 'Mpesa Stk Push';
    $PaymentGatewayRecord->save();

    // Background call to query.php
    $queryUrl = APP_URL . '/query.php';
    $postData = http_build_query(['CheckoutRequestID' => $CheckoutRequestID]);
    $command  = "curl -X POST -d \"$postData\" \"$queryUrl\" > /dev/null 2>&1 &";
    $handle   = popen($command, 'r');
    pclose($handle);

    exit();
}
