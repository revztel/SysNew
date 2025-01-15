<?php
/**
 * PHP Mikrotik Billing (https://github.com/hotspotbilling/phpnuxbill/)
 *
 * Payment Gateway xendit.com
 **/

function xendit_validate_config()
{
    global $config;
    if (empty($config['xendit_secret_key']) || empty($config['xendit_verification_token'])) {
        Message::sendTelegram("Xendit payment gateway not configured");
        r2(U . 'order/package', 'w', Lang::T("Admin has not yet setup Xendit payment gateway, please tell admin"));
    }
}

function xendit_show_config()
{
    global $ui, $config;
    $ui->assign('_title', 'Xendit - Payment Gateway');
    $ui->assign('channels', json_decode(file_get_contents('system/paymentgateway/channel_xendit.json'), true));
    $ui->display('xendit.tpl');
}

function xendit_save_config()
{
    global $admin, $_L;
    $xendit_secret_key = _post('xendit_secret_key');
    $xendit_verification_token = _post('xendit_verification_token');

    // Retrieve and filter the channels
    $xendit_channels = isset($_POST['xendit_channel']) ? $_POST['xendit_channel'] : [];
    $xendit_channels = array_filter($xendit_channels, function ($value) {
        return $value !== '';
    });

    // Save xendit_secret_key
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'xendit_secret_key')->find_one();
    if ($d) {
        $d->value = $xendit_secret_key;
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'xendit_secret_key';
        $d->value = $xendit_secret_key;
        $d->save();
    }

    // Save xendit_verification_token
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'xendit_verification_token')->find_one();
    if ($d) {
        $d->value = $xendit_verification_token;
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'xendit_verification_token';
        $d->value = $xendit_verification_token;
        $d->save();
    }

    // Save xendit_channel
    $d = ORM::for_table('tbl_appconfig')->where('setting', 'xendit_channel')->find_one();
    if ($d) {
        $d->value = implode(',', $xendit_channels);
        $d->save();
    } else {
        $d = ORM::for_table('tbl_appconfig')->create();
        $d->setting = 'xendit_channel';
        $d->value = implode(',', $xendit_channels);
        $d->save();
    }

    _log('[' . $admin['username'] . ']: Xendit ' . $_L['Settings_Saved_Successfully'], 'Admin', $admin['id']);
    r2(U . 'paymentgateway/xendit', 's', $_L['Settings_Saved_Successfully']);
}

function xendit_create_transaction($trx, $user)
{
    global $config;

    // Get the selected channels from the configuration
    $selected_channels = explode(',', $config['xendit_channel']);
    $selected_channels = array_map('trim', $selected_channels);

    // Filter out empty strings
    $selected_channels = array_filter($selected_channels, function ($value) {
        return $value !== '';
    });

    // Debugging: Log selected channels



    if (empty($selected_channels)) {

        r2(U . 'order/package', 'e', Lang::T("No payment channels configured. Please contact admin."));
    }

    // Prepare the JSON request
    $json = [
        'external_id' => (string)$trx['id'],
        'amount' => $trx['price'],
        'description' => $trx['plan_name'],
        'customer' => [
            'mobile_number' => $user['phonenumber'],
        ],
        'customer_notification_preference' => [
            'invoice_created' => ['whatsapp', 'sms'],
            'invoice_reminder' => ['whatsapp', 'sms'],
            'invoice_paid' => ['whatsapp', 'sms'],
            'invoice_expired' => ['whatsapp', 'sms']
        ],
        'payment_methods' => array_values($selected_channels), // Use configured payment channels
        'success_redirect_url' => U . 'order/view/' . $trx['id'] . '/check',
        'failure_redirect_url' => U . 'order/view/' . $trx['id'] . '/check'
    ];



    // Execute the HTTP POST request to Xendit
    $result = json_decode(Http::postJsonData(xendit_get_server() . 'invoices', $json, [
        'Authorization: Basic ' . base64_encode($config['xendit_secret_key'] . ':')
    ]), true);



    if (empty($result['id'])) {
        // Log detailed response from Xendit in case of failure

        r2(U . 'order/package', 'e', Lang::T("Failed to create transaction."));
    }

    // Save the successful response
    $d = ORM::for_table('tbl_payment_gateway')
        ->where('username', $user['username'])
        ->where('status', 1)
        ->find_one();
    $d->gateway_trx_id = $result['id'];
    $d->pg_url_payment = $result['invoice_url'];
    $d->pg_request = json_encode($result);
    $d->expired_date = date('Y-m-d H:i:s', strtotime($result['expiry_date']));
    $d->save();

    // Log the success


    // Redirect the user to the invoice URL
    header('Location: ' . $result['invoice_url']);
    exit();
}

function xendit_get_status($trx, $user)
{
    global $config;

    // A) If $trx->status == 2 => local transaction already "paid"
    if ($trx->status == 2) {
        error_log("[DEBUG] \$trx->status is already 2 => let's check tbl_user_recharges.");

        // Look up the user’s recharge record
        $recharge = ORM::for_table('tbl_user_recharges')
            ->where('username', $user['username'])
            ->where('plan_id', $trx->plan_id)
            ->order_by_desc('id')
            ->find_one();

        if ($recharge) {
            error_log("[DEBUG] Found tbl_user_recharges #{$recharge->id} => status: {$recharge->status}");
        } else {
            error_log("[DEBUG] No recharge row found => will do rechargeUser().");
        }

        // If found + status == 'on' => add to balance
        if ($recharge && $recharge->status === 'on') {
            $amount = $trx->price; // or $trx['price']
            error_log("[DEBUG] recharge->status = 'on' => adding balance: {$amount}");
            if (!Balance::add($user['id'], $amount)) {
                r2(U . "order/view/" . $trx->id, 'd', "Failed to add balance, try again later.");
            }
            error_log("[DEBUG] Successfully added {$amount} to user #{$user['id']}'s balance.");
            r2(U . "order/view/" . $trx->id, 's', "Transaction is already paid; we've added the amount to your balance.");
        } 
        else {
            // If NOT found or found but status != 'on' => do normal recharge
            error_log("[DEBUG] recharge->status != 'on' => calling Package::rechargeUser.");
            if (!Package::rechargeUser(
                $user['id'],
                $trx->routers,
                $trx->plan_id,
                $trx->gateway,
                'AlreadyPaid'
            )) {
                r2(U . "order/view/" . $trx->id, 'd', "Failed to activate your Package, try again later.");
            }
            error_log("[DEBUG] Successfully recharged plan for user #{$user['id']}.");
            r2(U . "order/view/" . $trx->id, 's', "Transaction is already paid; we've activated your package.");
        }

        return; // stop here
    }

    // B) If $trx->status != 2, let's ask Xendit about the invoice status
    $result = json_decode(
        Http::getData(
            xendit_get_server() . 'invoices/' . $trx->gateway_trx_id,
            [
                'Authorization: Basic ' . base64_encode($config['xendit_secret_key'] . ':')
            ]
        ),
        true
    );

    error_log("[DEBUG] Xendit invoice status => {$result['status']}");
    error_log("[DEBUG] Local \$trx->status => {$trx->status} (Transaction ID: {$trx->id})");

    if ($result['status'] === 'PENDING') {
        r2(U . "order/view/" . $trx->id, 'w', "Transaction still unpaid.");
    }
    else if (in_array($result['status'], ['PAID','SETTLED'])) {
        // Mark local transaction as 2 => paid
        $trx->pg_paid_response = json_encode($result);
        $trx->payment_method   = $result['payment_method'];
        $trx->payment_channel  = $result['payment_channel'];
        $trx->paid_date        = date('Y-m-d H:i:s', strtotime($result['updated']));
        $trx->status           = 2;  // "2" = Paid
        $trx->save();

        error_log("[DEBUG] Marked transaction #{$trx->id} as paid => now re-checking to do on/off logic.");

        // After marking it paid, we can either:
        // - Redirect to the same function (the "if $trx->status == 2" block above),
        //   or just replicate the logic right here. We'll replicate to keep it all in one pass.

        $recharge = ORM::for_table('tbl_user_recharges')
            ->where('username', $user['username'])
            ->where('plan_id', $trx->plan_id)
            ->order_by_desc('id')
            ->find_one();

        if ($recharge) {
            error_log("[DEBUG] Found tbl_user_recharges #{$recharge->id} => status: {$recharge->status}");
        } else {
            error_log("[DEBUG] No recharge row found => will do rechargeUser().");
        }

        if ($recharge && $recharge->status === 'on') {
            $amount = $trx->price;
            error_log("[DEBUG] recharge->status = 'on' => adding balance: {$amount}");
            if (!Balance::add($user['id'], $amount)) {
                r2(U . "order/view/" . $trx->id, 'd', "Failed to add balance, try again later.");
            }
            error_log("[DEBUG] Successfully added {$amount} to user #{$user['id']}'s balance.");
            r2(U . "order/view/" . $trx->id, 's', "Transaction has been paid; the amount has been added to your balance.");
        }
        else {
            error_log("[DEBUG] recharge->status != 'on' => do normal recharge.");
            if (!Package::rechargeUser(
                $user['id'],
                $trx->routers,
                $trx->plan_id,
                $trx->gateway,
                $result['payment_channel']
            )) {
                r2(U . "order/view/" . $trx->id, 'd', "Failed to activate your Package, try again later.");
            }
            error_log("[DEBUG] Successfully recharged plan for user #{$user['id']}.");
            r2(U . "order/view/" . $trx->id, 's', "Transaction has been paid and your package is now active.");
        }

    }
    else if ($result['status'] === 'EXPIRED') {
        // Mark local as expired
        $trx->pg_paid_response = json_encode($result);
        $trx->status = 3; // e.g. "3" = Expired
        $trx->save();
        r2(U . "order/view/" . $trx->id, 'd', "Transaction expired.");
    }
    else {
        // unknown
        error_log("[DEBUG] Unknown Xendit status => " . print_r($result, true));
        Message::sendTelegram(
            "xendit_get_status: unknown result\n\n" . 
            json_encode($result, JSON_PRETTY_PRINT)
        );
        r2(U . "order/view/" . $trx->id, 'd', "Unknown Command.");
    }
}





// Callback function (if needed)
function xendit_payment_notification()
{
    // Currently set to ignore and return 'OK'
    die('OK');
}

function xendit_get_server()
{
    global $_app_stage;
    if ($_app_stage == 'Live') {
        return 'https://api.xendit.co/v2/';
    } else {
        return 'https://api.xendit.co/v2/';
    }
}
