<?php
/**
 * PHP Mikrotik Billing (https://github.com/hotspotbilling/phpnuxbill/)
 *
 * Payment Gateway: Selcom
 *
 * This example is styled similarly to your Xendit integration.
 */

// ----------------------------------------------------------------------
// 1) Validate Selcom config (similar to xendit_validate_config)
// ----------------------------------------------------------------------
function selcom_validate_config()
{
    global $config;
    if (
        empty($config['selcom_api_key']) ||
        empty($config['selcom_api_secret']) ||
        empty($config['selcom_vendor'])
    ) {
        Message::sendTelegram("Selcom payment gateway not configured");
        r2(U . 'order/package', 'w', Lang::T("Admin has not yet setup Selcom payment gateway, please tell admin"));
    }
}

// ----------------------------------------------------------------------
// 2) Show Selcom config page (if you have an admin UI) - optional
// ----------------------------------------------------------------------
function selcom_show_config()
{
    global $ui, $config;
    $ui->assign('_title', 'Selcom - Payment Gateway');
    // If you want to show config fields, do it here. Example:
    // $ui->assign('selcom_api_key', $config['selcom_api_key']);
    // $ui->assign('selcom_api_secret', $config['selcom_api_secret']);
    // $ui->assign('selcom_vendor', $config['selcom_vendor']);
    $ui->display('selcom.tpl'); // an example .tpl
}

// ----------------------------------------------------------------------
// 3) Save Selcom config (similar to xendit_save_config) - optional
// ----------------------------------------------------------------------
function selcom_save_config()
{
    global $admin, $_L;

    $selcom_api_key    = _post('selcom_api_key');
    $selcom_api_secret = _post('selcom_api_secret');
    $selcom_vendor     = _post('selcom_vendor');

    // Save selcom_api_key
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'selcom_api_key')->find_one();
    if (!$d) {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'selcom_api_key';
    }
    $d->value = $selcom_api_key;
    $d->save();

    // Save selcom_api_secret
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'selcom_api_secret')->find_one();
    if (!$d) {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'selcom_api_secret';
    }
    $d->value = $selcom_api_secret;
    $d->save();

    // Save selcom_vendor
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'selcom_vendor')->find_one();
    if (!$d) {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'selcom_vendor';
    }
    $d->value = $selcom_vendor;
    $d->save();

    _log('[' . $admin['username'] . ']: Selcom ' . $_L['Settings_Saved_Successfully'], 'Admin', $admin['id']);
    r2(U . 'paymentgateway/selcom', 's', $_L['Settings_Saved_Successfully']);
}

// ----------------------------------------------------------------------
// 4) Create Selcom transaction (similar to xendit_create_transaction)
// ----------------------------------------------------------------------
function selcom_create_transaction($trx, $user)
{
    global $config;

    /**
     * $trx is an array or object that contains:
     *   $trx['id']        => local transaction ID
     *   $trx['price']     => amount to be paid
     *   $trx['plan_id']   => the plan user chose
     *   $trx['plan_name'] => name of that plan, etc.
     * $user is your user array from DB
     */
    
    // Validate config
    selcom_validate_config();

    // Prepare your Selcom credentials & base URL
    $apiKey    = $config['selcom_api_key'];    // e.g. TILL61056399-ed66...
    $apiSecret = $config['selcom_api_secret']; // e.g. 621a499113380bc0a1...
    $vendor    = $config['selcom_vendor'];     // e.g. TILL61056399
    $baseUrl   = selcom_get_server();          // returns e.g. "https://apigw.selcommobile.com/v1"

    // Prepare the request
    // For uniqueness, let's generate an "order_id"
    // or you can use $trx['id'] or a combination:
    $reference = "SELCOM_" . uniqid() . "_" . $trx['id'];

    // Build the data array (similar to your manual code)
    $req = [
        "vendor"      => $vendor,
        "order_id"    => $reference,
        "buyer_email" => $user['email'],
        "buyer_name"  => $user['fullname'] ?: $user['username'],
        "buyer_phone" => $user['phonenumber'],
        "amount"      => $trx['price'],
        "currency"    => "TZS",
        "payment_methods" => "ALL",
        "redirect_url" => base64_encode(U . 'order/view/' . $trx['id'] . '/check'),
        "cancel_url"   => base64_encode(U . 'order/view/' . $trx['id']),
        "webhook"      => base64_encode(APP_URL . '/selcom_webhook.php'), 
        // optional billing fields
        "billing.firstname" => $user['firstname'] ?? 'NA',
        "billing.lastname"  => $user['lastname']  ?? 'NA',
        "billing.address_1" => "969 Market",
        "billing.address_2" => "",
        "billing.city"      => "Dar es Salaam",
        "billing.state_or_region" => "CA",
        "billing.postcode_or_pobox" => "82818",
        "billing.country"   => "TZ",
        "billing.phone"     => $user['phonenumber'],
        "buyer_remarks"     => "None",
        "merchant_remarks"  => "None",
        "no_of_items"       => 1
    ];

    // Create record in tbl_payment_gateway with status=1 (pending)
    // similar to your Xendit approach
    $d = ORM::for_table('tbl_payment_gateway')->create();
    $d->username     = $user['username'];
    $d->gateway      = 'Selcom';
    $d->plan_id      = $trx['plan_id'];
    $d->plan_name    = $trx['plan_name'];
    $d->routers_id   = $trx['routers_id'] ?? 0;
    $d->routers      = $trx['routers']    ?? '';
    $d->price        = $trx['price'];
    $d->payment_method  = 'Selcom';
    $d->payment_channel = 'Selcom';
    $d->created_date    = date('Y-m-d H:i:s');
    $d->pg_url_payment  = ''; // we'll update later
    $d->status       = 1; // pending
    $d->gateway_trx_id = $reference;
    $d->save();

    // Sign & Send the request to Selcom
    $timestamp = date('c');
    $signed_fields = implode(',', array_keys($req));
    $digest = selcom_compute_signature($req, $signed_fields, $timestamp, $apiSecret);
    $authorization = base64_encode($apiKey);

    $url = $baseUrl . "/checkout/create-order";
    $response = selcom_send_json(
        $url,
        true,
        json_encode($req),
        $authorization,
        $digest,
        $signed_fields,
        $timestamp
    );

    // Save the request & response
    $d->pg_request      = json_encode($req);
    $d->pg_paid_response = json_encode($response);
    // If success, you might get a payment page link from the $response
    if (!empty($response['checkout_url'])) {
        $checkout_url = $response['checkout_url'];
        $d->pg_url_payment = $checkout_url;
    }
    // Optionally parse the response further to see if there's an error
    if (!empty($response['result']) && $response['result'] == 'SUCCESS') {
        $d->save();
        // Now redirect user to the checkout_url
        header('Location: ' . $d->pg_url_payment);
        exit();
    } else {
        // Some error from Selcom
        $d->save();
        r2(U . 'order/package', 'e', Lang::T("Failed to create Selcom transaction. Please try again."));
    }
}

// ----------------------------------------------------------------------
// 5) Get Selcom Payment Status (similar to xendit_get_status)
// ----------------------------------------------------------------------
function selcom_get_status($trx, $user)
{
    // $trx is your local transaction row from tbl_payment_gateway
    // If $trx->status == 2 => already paid, do the same logic as Xendit
    if ($trx->status == 2) {
        // We can do the same "rechargeUser" or "Balance::add" logic
        // ...
        r2(U . "order/view/" . $trx->id, 's', "Transaction is already paid.");
        return;
    }

    global $config;
    selcom_validate_config();

    $apiKey    = $config['selcom_api_key'];
    $apiSecret = $config['selcom_api_secret'];
    $vendor    = $config['selcom_vendor'];
    $baseUrl   = selcom_get_server();

    // Possibly Selcom has an endpoint like "/checkout/get-order-status"
    // We'll call it with the order_id we used:
    $order_id = $trx->gateway_trx_id; 
    $url      = $baseUrl . "/checkout/get-order-status"; // Hypothetical endpoint

    // Build query or body
    $req = [
        "vendor"   => $vendor,
        "order_id" => $order_id
    ];

    $timestamp     = date('c');
    $signed_fields = implode(',', array_keys($req));
    $digest        = selcom_compute_signature($req, $signed_fields, $timestamp, $apiSecret);
    $authorization = base64_encode($apiKey);

    // Send request
    $response = selcom_send_json(
        $url,
        true,
        json_encode($req),
        $authorization,
        $digest,
        $signed_fields,
        $timestamp
    );

    // Evaluate $response
    // Let's assume the response has e.g. 'order_status' => 'SUCCESS', 'FAILED', 'PENDING' etc.
    if (!empty($response['order_status'])) {
        $status = strtoupper($response['order_status']); 
        if ($status == 'SUCCESS') {
            // Mark local transaction as Paid
            $trx->pg_paid_response = json_encode($response);
            $trx->payment_method   = 'Selcom';
            $trx->payment_channel  = 'Selcom';
            $trx->paid_date        = date('Y-m-d H:i:s');
            $trx->status           = 2; // paid
            $trx->save();

            // Now do your plan or balance logic
            // e.g., Package::rechargeUser($user['id'], $trx->routers, $trx->plan_id, $trx->gateway, 'Selcom');
            // or if ($someCondition) { Balance::add($user['id'], $trx->price); }
            r2(U . "order/view/" . $trx->id, 's', "Transaction has been paid. Your package is now active.");
        }
        elseif ($status == 'PENDING') {
            r2(U . "order/view/" . $trx->id, 'w', "Transaction is still pending payment.");
        }
        elseif ($status == 'FAILED') {
            // Possibly mark local transaction as 3 => failed
            $trx->pg_paid_response = json_encode($response);
            $trx->status = 3;
            $trx->save();
            r2(U . "order/view/" . $trx->id, 'd', "Transaction failed.");
        }
        elseif ($status == 'EXPIRED') {
            $trx->pg_paid_response = json_encode($response);
            $trx->status           = 3;
            $trx->save();
            r2(U . "order/view/" . $trx->id, 'd', "Transaction expired.");
        }
        else {
            Message::sendTelegram("selcom_get_status: unknown result => " . json_encode($response, JSON_PRETTY_PRINT));
            r2(U . "order/view/" . $trx->id, 'd', "Unknown Command: " . $status);
        }
    } else {
        Message::sendTelegram("selcom_get_status: No order_status => " . json_encode($response, JSON_PRETTY_PRINT));
        r2(U . "order/view/" . $trx->id, 'd', "Could not retrieve order status from Selcom.");
    }
}

// ----------------------------------------------------------------------
// 6) Selcom Payment Notification (similar to xendit_payment_notification)
// ----------------------------------------------------------------------
function selcom_payment_notification()
{
    // If Selcom sends a webhook/callback, handle it here
    // parse input, verify signature, update DB
    die('OK');
}

// ----------------------------------------------------------------------
// 7) Helper Functions
// ----------------------------------------------------------------------

/**
 * This mimics your computeSignature function for Selcom.
 */
function selcom_compute_signature($parameters, $signed_fields, $request_timestamp, $api_secret)
{
    $fields_order = explode(',', $signed_fields);
    $sign_data    = "timestamp=$request_timestamp";
    foreach ($fields_order as $key) {
        $sign_data .= "&$key=" . $parameters[$key];
    }
    return base64_encode(hash_hmac('sha256', $sign_data, $api_secret, true));
}

/**
 * This mimics your sendJSONPost function, renamed to selcom_send_json.
 */
function selcom_send_json($url, $isPost, $json, $authorization, $digest, $signed_fields, $timestamp)
{
    $headers = [
        "Content-Type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Authorization: SELCOM $authorization",
        "Digest-Method: HS256",
        "Digest: $digest",
        "Timestamp: $timestamp",
        "Signed-Fields: $signed_fields",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($isPost) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Selcom Curl error: ' . curl_error($ch));
        curl_close($ch);
        return [
            'result' => 'ERROR',
            'message'=> 'Curl error: ' . curl_error($ch),
        ];
    }

    curl_close($ch);
    return json_decode($result, true);
}

/**
 * Return the base URL for Selcom, similar to xendit_get_server().
 */
function selcom_get_server()
{
    global $_app_stage;
    if ($_app_stage == 'Live') {
        return 'https://apigw.selcommobile.com/v1';
    } else {
        // If there's a sandbox or staging environment for Selcom,
        // specify it here. Otherwise, use the same:
        return 'https://apigw.selcommobile.com/v1';
    }
}
