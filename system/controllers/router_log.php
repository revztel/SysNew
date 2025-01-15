<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Logs'));
$ui->assign('_system_menu', 'logs');
$ui->assign('_admin', $admin);

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'list';

switch ($action) {
    case 'list':
        // Display router logs
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch Logs
                    $logRequest = new RouterOS\Request('/log/print');
                    $logResponse = $client->sendSync($logRequest);

                    $logs = [];
                    foreach ($logResponse as $log) {
                        $logs[] = [
                            'time' => $log->getProperty('time'),
                            'topics' => $log->getProperty('topics'),
                            'message' => $log->getProperty('message'),
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('logs', $logs);
                } catch (Exception $e) {
                    error_log('Error fetching logs: ' . $e->getMessage());
                    r2(U . 'router_log/list', 'e', Lang::T('Error fetching logs: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_log/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_log.tpl');
        break;

    default:
        r2(U . 'router_log/list', 's', '');
}
?>
