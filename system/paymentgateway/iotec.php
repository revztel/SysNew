<?php

function iotec_save_config()
{
    global $admin, $_L;

    // Get the Iotec configuration values from POST
    $iotec_client_id = _post('iotec_client_id');
    $iotec_client_secret = _post('iotec_client_secret');
    $iotec_wallet_id = _post('iotec_wallet_id');

    // Validate if all fields are provided
    if (empty($iotec_client_id) || empty($iotec_client_secret) || empty($iotec_wallet_id)) {
        r2(U . 'paymentgateway/iotec', 'e', 'All fields are required.');
        return;
    }

    // Prepare settings to save
    $settings = [
        'iotec_client_id' => $iotec_client_id,
        'iotec_client_secret' => $iotec_client_secret,
        'iotec_wallet_id' => $iotec_wallet_id
    ];

    // Save settings into the database
    foreach ($settings as $key => $value) {
        $d = ORM::for_table('tbl_appconfig')->where('setting', $key)->find_one();
        if ($d) {
            $d->value = $value;
            $d->save();
        } else {
            $d = ORM::for_table('tbl_appconfig')->create();
            $d->setting = $key;
            $d->value = $value;
            $d->save();
        }
    }

    // Log the update
    _log('[' . $admin['username'] . ']: Updated Iotec configuration.', 'Admin', $admin['id']);
    
    // Redirect with success message
    r2(U . 'paymentgateway/iotec', 's', Lang::T('Settings saved successfully.'));
}

function iotec_show_config()
{
    global $ui, $config;

    // Fetch settings from the database
    $iotec_client_id = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_id')->find_one();
    $iotec_client_secret = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_client_secret')->find_one();
    $iotec_wallet_id = ORM::for_table('tbl_appconfig')->where('setting', 'iotec_wallet_id')->find_one();

    // Assign default values if settings are missing
    $iotec_client_id = $iotec_client_id ? $iotec_client_id->value : '';
    $iotec_client_secret = $iotec_client_secret ? $iotec_client_secret->value : '';
    $iotec_wallet_id = $iotec_wallet_id ? $iotec_wallet_id->value : '';

    // Assign data to the UI
    $ui->assign('_title', 'Iotec Uganda - Payment Gateway');
    $ui->assign('iotec_client_id', $iotec_client_id);
    $ui->assign('iotec_client_secret', $iotec_client_secret);
    $ui->assign('iotec_wallet_id', $iotec_wallet_id);

    // Display the template
    $ui->display('iotec.tpl');
}


