<?php

/*
|--------------------------------------------------------------------------
| PayPal Configuration & Utility Functions
|--------------------------------------------------------------------------
|
| These functions validate your PayPal config, retrieve access tokens,
| and build the correct API endpoint depending on Live/Sandbox mode.
|
*/

function paypal_validate_config()
{
    global $config;
    if (empty($config['paypal_client_id']) || empty($config['paypal_secret_key'])) {
        sendTelegram("PayPal payment gateway not configured");
        r2(U . 'order/package', 'w', "Admin has not yet setup Paypal payment gateway, please tell admin");
    }
}

function paypal_show_config()
{
    global $ui;
    $ui->assign('_title', 'Paypal - Payment Gateway');
    $ui->assign('currency', json_decode(file_get_contents('system/paymentgateway/paypal_currency.json'), true));
    $ui->display('paypal.tpl');
}

function paypal_save_config()
{
    global $admin, $_L;
    $paypal_client_id  = _post('paypal_client_id');
    $paypal_secret_key = _post('paypal_secret_key');
    $paypal_currency   = _post('paypal_currency');

    $d = ORM::for_table('tbl_appconfig')->where('setting', 'paypal_secret_key')->find_one();
    if ($d) {
        $d->value = $paypal_secret_key;
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'paypal_secret_key';
        $d->value = $paypal_secret_key;
        $d->save();
    }
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'paypal_client_id')->find_one();
    if ($d) {
        $d->value = $paypal_client_id;
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'paypal_client_id';
        $d->value = $paypal_client_id;
        $d->save();
    }
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'paypal_currency')->find_one();
    if ($d) {
        $d->value = $paypal_currency;
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'paypal_currency';
        $d->value = $paypal_currency;
        $d->save();
    }

    _log('[' . $admin['username'] . ']: Paypal ' . Lang::T('Settings Saved Successfully'), 'Admin', $admin['id']);
    r2(U . 'paymentgateway/paypal', 's', Lang::T('Settings Saved Successfully'));
}

/*
|--------------------------------------------------------------------------
| One-Time Payment Flow
|--------------------------------------------------------------------------
|
| These functions are your existing integration for single payments using
| "checkout/orders" and capturing them.
|
*/

function paypal_create_transaction($trx, $user)
{
    global $config;

    $json = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => $config['paypal_currency'],
                    'value'         => strval($trx['price'])
                ]
            ]
        ],
        "application_context" => [
            "return_url" => U . "order/view/" . $trx['id'] . '/check',
            "cancel_url" => U . "order/view/" . $trx['id'],
        ]
    ];

    $result = json_decode(
        Http::postJsonData(
            paypal_get_server() . 'checkout/orders',
            $json,
            [
                'Prefer: return=minimal',
                'PayPal-Request-Id: paypal_' . $trx['id'],
                'Authorization: Bearer ' . paypalGetAccessToken()
            ]
        ),
        true
    );

    if (empty($result['id'])) {
        sendTelegram("paypal_create_transaction FAILED: \n\n" . json_encode($result, JSON_PRETTY_PRINT));
        r2(U . 'order/package', 'e', "Failed to create Paypal transaction.");
    }

    $urlPayment = "";
    foreach ($result['links'] as $link) {
        if ($link['rel'] === 'approve') {
            $urlPayment = $link['href'];
            break;
        }
    }

    // Store the transaction in DB
    $d = ORM::for_table('tbl_payment_gateway')
        ->where('username', $user['username'])
        ->where('status', 1)
        ->find_one();

    $d->gateway_trx_id = $result['id'];
    $d->pg_url_payment  = $urlPayment;
    $d->pg_request      = json_encode($result);
    $d->expired_date    = date('Y-m-d H:i:s', strtotime("+ 6 HOUR"));
    $d->save();

    // Redirect user to PayPal
    header('Location: ' . $urlPayment);
    exit();
}

function paypal_payment_notification()
{
    // Not yet implemented for one-time payments
    die('OK');
}

function paypal_get_status($trx, $user)
{
    $capture = [];
    if (empty($trx->pg_paid_response)) {
        $capture = paypal_capture_transaction($trx['gateway_trx_id']);
    } else {
        $capture = json_decode($trx->pg_paid_response, true)['paypal_capture'];
        if (empty($capture)) {
            $capture = paypal_capture_transaction($trx['gateway_trx_id']);
        }
    }

    $result = json_decode(
        Http::getData(
            paypal_get_server() . 'checkout/orders/' . $trx['gateway_trx_id'],
            ['Authorization: Bearer ' . paypalGetAccessToken()]
        ),
        true
    );

    if (in_array($result['status'], ['APPROVED', 'COMPLETED']) && $trx['status'] != 2) {
        if (
            (isset($capture['status']) && $capture['status'] == 'COMPLETED') ||
            (isset($capture['name']) && $capture['name'] == 'UNPROCESSABLE_ENTITY' && $capture['details'][0]['issue'] == 'ORDER_ALREADY_CAPTURED')
        ) {
            // Recharge user
            if (!Package::rechargeUser($user['id'], $trx['routers'], $trx['plan_id'], $trx['gateway'], 'Paypal')) {
                r2(U . "order/view/" . $trx['id'], 'd', "Failed to activate your Package, try again later.");
            }

            $result['paypal_capture']    = json_encode($capture);
            $trx->pg_paid_response       = json_encode($result);
            $trx->payment_method         = 'PAYPAL';
            $trx->payment_channel        = 'paypal';
            $trx->paid_date              = date('Y-m-d H:i:s', strtotime($result['updated']));
            $trx->status                 = 2;
            $trx->save();

            r2(U . "order/view/" . $trx['id'], 's', "Transaction has been paid.");
        } else {
            r2(U . "order/view/" . $trx['id'], 'e', "Transaction Success, but not yet captured.");
        }
    } elseif ($result['status'] == 'VOIDED') {
        $trx->pg_paid_response = json_encode($result);
        $trx->status           = 3;
        $trx->save();

        r2(U . "order/view/" . $trx['id'], 'd', "Transaction expired.");
    } else {
        sendTelegram("xendit_get_status: unknown result\n\n" . json_encode($result, JSON_PRETTY_PRINT));
        r2(U . "order/view/" . $trx['id'], 'w', "Transaction status :" . $result['status']);
    }
}

function paypal_capture_transaction($trx_id)
{
    return json_decode(
        Http::postJsonData(
            paypal_get_server() . 'checkout/orders/' . $trx_id . '/capture',
            [],
            [
                'PayPal-Partner-Attribution-Id: <BN-Code>',
                'Authorization: Bearer ' . paypalGetAccessToken()
            ]
        ),
        true
    );
}

function paypalGetAccessToken()
{
    global $config;
    // Notice we replace 'v2' with 'v1' for the OAuth token endpoint:
    $result = Http::postData(
        str_replace('v2', 'v1', paypal_get_server()) . 'oauth2/token',
        ["grant_type" => "client_credentials"],
        [],
        $config['paypal_client_id'] . ":" . $config['paypal_secret_key']
    );

    $json = json_decode($result, true);
    return $json['access_token'] ?? null;
}

function paypal_get_server()
{
    global $_app_stage;
    if ($_app_stage == 'Live') {
        return 'https://api-m.paypal.com/v2/';
    } else {
        return 'https://api-m.sandbox.paypal.com/v2/';
    }
}


/*
|--------------------------------------------------------------------------
| SUBSCRIPTION FLOW
|--------------------------------------------------------------------------
|
| Below are additional functions for creating PayPal products, billing plans,
| and subscriptions. This is for recurring billing, so PayPal auto-charges
| customers on a schedule (e.g., monthly).
|
| You'll also find a basic webhook listener. Adjust to your own needs.
|
*/

/**
 * 1) Create a Product (only once or via Admin Panel).
 *    Store the product_id in your database or config for later use.
 */
function paypal_create_product($name, $description)
{
    $accessToken = paypalGetAccessToken();
    // For product creation, we typically use /v1/catalogs/products
    $url = str_replace('/v2/', '/v1/', paypal_get_server()) . 'catalogs/products';

    $data = [
        "name"        => $name,
        "description" => $description,
        "type"        => "SERVICE",    // or "DIGITAL"
        "category"    => "SOFTWARE"
    ];

    $response = Http::postJsonData($url, $data, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ]);

    return json_decode($response, true);
}

/**
 * 2) Create a Billing Plan for Recurring Payments.
 *    - product_id: ID returned from paypal_create_product()
 *    - interval_unit: "DAY", "WEEK", "MONTH", "YEAR"
 *    - interval_count: how many intervals per cycle (1 = every month, for example)
 *    - total_cycles: 0 means infinite
 */
function paypal_create_billing_plan($productId, $planName, $description, $price, $currency, $intervalUnit = 'MONTH', $intervalCount = 1)
{
    $accessToken = paypalGetAccessToken();
    // For billing plans, we typically use /v1/billing/plans
    $url = str_replace('/v2/', '/v1/', paypal_get_server()) . 'billing/plans';

    $data = [
        "product_id"  => $productId,
        "name"        => $planName,
        "description" => $description,
        "status"      => "ACTIVE",
        "billing_cycles" => [
            [
                "frequency" => [
                    "interval_unit"   => $intervalUnit,
                    "interval_count"  => $intervalCount
                ],
                "tenure_type"   => "REGULAR",
                "sequence"      => 1,
                "total_cycles"  => 0, // 0 => infinite
                "pricing_scheme" => [
                    "fixed_price" => [
                        "value"         => strval($price),
                        "currency_code" => $currency
                    ]
                ]
            ]
        ],
        "payment_preferences" => [
            "auto_bill_outstanding"     => true,
            "setup_fee"                 => [
                "value"         => "0",
                "currency_code" => $currency
            ],
            "setup_fee_failure_action"  => "CONTINUE",
            "payment_failure_threshold" => 3
        ]
    ];

    $response = Http::postJsonData($url, $data, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ]);

    return json_decode($response, true);
}

/**
 * 3) Create a Subscription (user flow).
 *    - planId: ID returned from paypal_create_billing_plan()
 *    - returnUrl, cancelUrl: where the user goes after approval/cancel
 *    - $user: user info for subscriber data
 */
function paypal_create_subscription($planId, $returnUrl, $cancelUrl, $user)
{
    $accessToken = paypalGetAccessToken();
    // For subscriptions, we typically use /v1/billing/subscriptions
    $url = str_replace('/v2/', '/v1/', paypal_get_server()) . 'billing/subscriptions';

    // Add your user details, email, etc.
    $data = [
        "plan_id" => $planId,
        "application_context" => [
            "brand_name"          => "My Brand",
            "locale"              => "en-US",
            "shipping_preference" => "NO_SHIPPING",
            "user_action"         => "SUBSCRIBE_NOW",
            "return_url"          => $returnUrl,
            "cancel_url"          => $cancelUrl
        ],
        "subscriber" => [
            "name" => [
                "given_name" => $user['first_name'] ?? 'FirstName',
                "surname"    => $user['last_name']  ?? 'LastName'
            ],
            "email_address" => $user['email'] ?? 'user@example.com'
        ]
    ];

    $response = Http::postJsonData($url, $data, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ]);

    $json = json_decode($response, true);
    if (empty($json['links'])) {
        sendTelegram("paypal_create_subscription FAILED:\n\n" . json_encode($json, JSON_PRETTY_PRINT));
        r2(U . 'order/package', 'e', "Failed to create Paypal subscription.");
    }

    // Store subscription_id in DB for future reference
    $subscription_id = $json['id'];

    // Typically, you'd store it in a table:
    // $d = ORM::for_table('subscriptions')->create();
    // $d->user_id          = $user['id'];
    // $d->paypal_plan_id   = $planId;
    // $d->paypal_sub_id    = $subscription_id;
    // $d->status           = 'pending';
    // $d->save();

    // Redirect user to approval link
    foreach ($json['links'] as $link) {
        if ($link['rel'] === 'approve') {
            header("Location: " . $link['href']);
            exit();
        }
    }
}

/**
 * 4) Handle Return URL after Subscription Approval
 *    - Typically you check if the subscription is ACTIVE or not and update DB.
 */
function paypal_handle_subscription_return($subscriptionId)
{
    // 1. Fetch subscription details from PayPal
    $accessToken = paypalGetAccessToken();
    $url = str_replace('/v2/', '/v1/', paypal_get_server()) . "billing/subscriptions/{$subscriptionId}";

    $response = Http::getData($url, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ]);
    $json = json_decode($response, true);

    // 2. Check subscription status
    if (!empty($json['status']) && $json['status'] === 'ACTIVE') {
        // Mark subscription as active in your DB, give user access, etc.
        // $sub = ORM::for_table('subscriptions')->where('paypal_sub_id', $subscriptionId)->find_one();
        // if ($sub) {
        //     $sub->status = 'active';
        //     $sub->save();
        // }
        r2(U . "order/view/" . $subscriptionId, 's', "Subscription is active and approved.");
    } else {
        r2(U . "order/package", 'e', "Subscription not active.");
    }
}

/**
 * 5) Webhook Listener for Subscription Events
 *    - Add a route in your app that points here: e.g. /paypal/webhook
 *    - Register the same URL in PayPal Developer dashboard.
 */
function paypal_webhook_listener()
{
    $body    = file_get_contents('php://input');
    $headers = getallheaders();

    // Verify the webhook signature
    if (!paypal_verify_webhook($body, $headers)) {
        http_response_code(400);
        die('Invalid PayPal Webhook Signature');
    }

    $event = json_decode($body, true);
    $eventType = $event['event_type'] ?? '';

    switch ($eventType) {
        case 'BILLING.SUBSCRIPTION.ACTIVATED':
            // The subscription is now active. Mark in DB.
            $subscriptionId = $event['resource']['id'] ?? '';
            // $sub = ORM::for_table('subscriptions')->where('paypal_sub_id', $subscriptionId)->find_one();
            // if ($sub) { $sub->status = 'active'; $sub->save(); }
            break;

        case 'BILLING.SUBSCRIPTION.CANCELLED':
            // Subscription was cancelled by user or merchant.
            // Mark in DB as cancelled.
            $subscriptionId = $event['resource']['id'] ?? '';
            // ...
            break;

        case 'BILLING.PAYMENT.SUCCEEDED':
            // A recurring payment just succeeded
            // You can retrieve the subscription ID from resource if needed
            // e.g. $subscriptionId = $event['resource']['billing_agreement_id'] or billing_subscription_id
            // Then update your DB, extend user's plan, etc.
            break;

        case 'BILLING.PAYMENT.FAILED':
            // Payment attempt for a recurring subscription failed
            // Possibly notify user or set subscription as past due
            break;

        // Add more cases as needed

        default:
            // Unknown or unused event type
            break;
    }

    http_response_code(200);
    echo "OK";
}

/**
 * 6) Verify the PayPal Webhook Signature
 *    - Compare signature, cert, etc. with PayPal to ensure authenticity.
 *    - Replace "YOUR_WEBHOOK_ID" with the ID from your PayPal dashboard.
 */
function paypal_verify_webhook($body, $headers)
{
    $accessToken = paypalGetAccessToken();

    // PayPal’s recommended endpoint:
    $url = str_replace('/v2/', '/v1/', paypal_get_server()) . 'notifications/verify-webhook-signature';

    $signature        = $headers['PAYPAL-TRANSMISSION-SIG'] ?? '';
    $transmissionId   = $headers['PAYPAL-TRANSMISSION-ID'] ?? '';
    $transmissionTime = $headers['PAYPAL-TRANSMISSION-TIME'] ?? '';
    $authAlgo         = $headers['PAYPAL-AUTH-ALGO'] ?? '';
    $certUrl          = $headers['PAYPAL-CERT-URL'] ?? '';
    
    // IMPORTANT: Put your actual Webhook ID from PayPal Developer Dashboard
    $webhookId = 'YOUR_WEBHOOK_ID';

    $data = [
        "transmission_id"   => $transmissionId,
        "transmission_time" => $transmissionTime,
        "transmission_sig"  => $signature,
        "cert_url"          => $certUrl,
        "auth_algo"         => $authAlgo,
        "webhook_id"        => $webhookId,
        "webhook_event"     => json_decode($body, true)
    ];

    $response = Http::postJsonData($url, $data, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ]);

    $res = json_decode($response, true);
    return (isset($res['verification_status']) && $res['verification_status'] === 'SUCCESS');
}
