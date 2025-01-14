<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Terminal'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

// Check if the user has permission
if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'terminal';

switch ($action) {
    case 'terminal':
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $command = $_POST['command'] ?? '';
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                $output = '';
                try {
                    // Connect via SSH
                    if (!function_exists("ssh2_connect")) {
                        throw new Exception("SSH2 extension is not installed");
                    }

                    $connection = ssh2_connect($router['ip_address'], 22);
                    if (!$connection) {
                        throw new Exception("Could not connect to router via SSH");
                    }

                    if (!ssh2_auth_password($connection, $router['username'], $router['password'])) {
                        throw new Exception("SSH authentication failed");
                    }

                    if (!empty($command)) {
                        $stream = ssh2_exec($connection, $command);
                        stream_set_blocking($stream, true);
                        $output = stream_get_contents($stream);
                        fclose($stream);
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('command', $command);
                    $ui->assign('output', $output);
                } catch (Exception $e) {
                    error_log('Error executing command: ' . $e->getMessage());
                    r2(U . 'router_terminal/terminal', 'e', Lang::T('Error executing command: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_terminal/terminal', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_terminal.tpl');
        break;

    default:
        r2(U . 'router_terminal/terminal', 's', '');
}
?>
