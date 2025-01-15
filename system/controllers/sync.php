<?php
// Include necessary files and initialize
require_once 'system/autoload/PEAR2/Autoload.php';
require_once 'system/init.php'; // Adjust the path if necessary

use PEAR2\Net\RouterOS;

// Only allow SuperAdmin and Admin to access this functionality
_admin();
$ui->assign('_title', Lang::T('Sync Services'));
$ui->assign('_system_menu', 'services');

$admin = $ui->get('_admin');
if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
    exit;
}

// Fetch routers to populate the dropdown in the template
$routers = ORM::for_table('tbl_routers')->where('enabled', 1)->find_array();
$ui->assign('routers', $routers); // Assign routers to the template
error_log("Routers fetched: " . count($routers)); // Log the count of routers fetched

// Fetch all enabled Hotspot plans to display in the table
$plans = ORM::for_table('tbl_bandwidth')
            ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
            ->where('tbl_plans.type', 'Hotspot')
            ->where('tbl_plans.enabled', '1')
            ->find_array();

$ui->assign('d', $plans); // Assign plans to the template

// Assign a dummy variable to test template assignment
$dummyVariable = 'This is a test message';
$ui->assign('dummy', $dummyVariable); // Assign dummy variable

// Display the correct template
$ui->display('hotspot.tpl'); // Render the 'hotspot.tpl' template

// Rest of your code for sync-hotspot action...
?>
