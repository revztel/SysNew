<?php



function CustomPaybill_update()
{
    global $admin, $_L;

    // Get the paybill number from POST
    $paybillNumber = _post('paybill');

    // Validate if paybill number is provided
    if (empty($paybillNumber)) {
        r2(U . 'paymentgateway/CustomPaybill', 'e', 'Paybill number cannot be empty.');
        return;
    }

    // Find the existing entry for 'Custom' bank using a strict match
    $customBank = ORM::for_table('tbl_banks')
        ->where('name', 'Custom')
        ->find_one();

    if ($customBank) {
        // Update the paybill number if the bank exists
        $customBank->paybill = $paybillNumber;
        $customBank->save();

        _log('[' . $admin['username'] . ']: Updated Custom Paybill to ' . $paybillNumber, 'Admin', $admin['id']);
        r2(U . 'paymentgateway/CustomPaybill', 's', Lang::T('Paybill updated successfully.'));
    } else {
        // If 'Custom' bank entry does not exist
        r2(U . 'paymentgateway/CustomPaybill', 'e', 'Custom bank entry does not exist.');
    }
}

function CustomPaybill_show()
{
    global $ui, $config;

    // Get current paybill value from tbl_banks for 'Custom'
    $customBank = ORM::for_table('tbl_banks')
        ->where('name', 'Custom')
        ->find_one();

    // Assign current paybill to the UI if it exists
    $paybill = $customBank ? $customBank->paybill : '';

    $ui->assign('_title', 'Custom Paybill Update - ' . $config['CompanyName']);
    $ui->assign('current_paybill', $paybill);
    $ui->display('custompaybill.tpl');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    CustomPaybill_update();
} else {
    CustomPaybill_show();
}
