<?php
/**
 * PHP Mikrotik Billing (https://gl/)
 * This file for reminding user about expiration
 * Example to run every at 7:00 in the morning
 * 0 7 * * * /usr/bin/php /var/www/system/cron_reminder.php
 **/
include "../init.php";
$isCli = true;
if (php_sapi_name() !== 'cli') {
    $isCli = false;
    echo "<pre>";
}

// Ensure $config includes 'hotspot_sms' setting
// If not already loaded, fetch it from tbl_appconfig
$configData = ORM::for_table('tbl_appconfig')->find_array();
$config = array_column($configData, 'value', 'setting');

// Fetch all active user recharges
$d = ORM::for_table('tbl_user_recharges')->where('status', 'on')->find_many();
run_hook('cronjob_reminder'); #HOOK

echo "PHP Time\t" . date('Y-m-d H:i:s') . "\n";
$res = ORM::raw_execute('SELECT NOW() AS WAKTU;');
$statement = ORM::get_last_statement();
$rows = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "MYSQL Time\t" . $row['WAKTU'] . "\n";
}

$currentDate = date('Y-m-d');
foreach ($d as $ds) {
    $daysRemaining = (strtotime($ds['expiration']) - strtotime($currentDate)) / (60 * 60 * 24);

    echo "Processing user recharge ID {$ds['id']}\n";
    echo "Days remaining: $daysRemaining\n";

    $sendReminder = false;
    if ($daysRemaining >= 7 && $daysRemaining < 8) {
        $reminderType = 'reminder_7_day';
        $sendReminder = true;
    } else if ($daysRemaining >= 3 && $daysRemaining < 4) {
        $reminderType = 'reminder_3_day';
        $sendReminder = true;
    } else if ($daysRemaining >= 1 && $daysRemaining < 2) {
        $reminderType = 'reminder_1_day';
        $sendReminder = true;
    }

    echo "sendReminder: " . ($sendReminder ? 'true' : 'false') . "\n";

    if ($sendReminder) {
        $u = ORM::for_table('tbl_user_recharges')->where('id', $ds['id'])->find_one();
        $p = ORM::for_table('tbl_plans')->where('id', $u['plan_id'])->find_one();
        $c = ORM::for_table('tbl_customers')->where('id', $ds['customer_id'])->find_one();
        $price = $p['price'];
        $customer_balance = $c['balance'];

        echo "Customer ID: {$c['id']}, Name: {$c['name']}, Balance: $customer_balance, Plan Price: $price\n";
        echo "Service Type: {$c['service_type']}\n";

        // Check if customer balance is greater than or equal to plan price
        if ($customer_balance >= $price) {
            // Customer has enough balance, skip sending reminder
            echo "Customer has sufficient balance. Skipping reminder.\n";
            continue;
        } else {
            echo "Customer does not have sufficient balance.\n";
        }

        // Check if customer is hotspot user and hotspot_sms is not 'yes'
        if (strtolower($c['service_type']) == 'hotspot') {
            echo "Customer is a hotspot user.\n";
            echo "hotspot_sms setting: " . (isset($config['hotspot_sms']) ? $config['hotspot_sms'] : 'not set') . "\n";
            if (isset($config['hotspot_sms']) && $config['hotspot_sms'] != 'yes') {
                // Do not send message to hotspot user
                echo "hotspot_sms is not 'yes'. Skipping reminder for hotspot user.\n";
                continue;
            } else {
                echo "hotspot_sms is 'yes'. Proceeding to send reminder.\n";
            }
        }

        // Proceed to send reminder message
        $formatted_price = Lang::moneyFormat($price);
        $reminder_text = Lang::getNotifText($reminderType);

        echo "Sending reminder to customer.\n";
        echo Message::sendPackageNotification($c, $p['name_plan'], $formatted_price, $reminder_text, $config['user_notification_reminder']) . "\n";
    }
}
