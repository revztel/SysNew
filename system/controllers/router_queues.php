<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Queues Management'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'list';

switch ($action) {
    case 'list':
        // Display the main Queues management page
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch Queues
                    $queueRequest = new RouterOS\Request('/queue/simple/print');
                    $queueResponse = $client->sendSync($queueRequest);

                    $queues = [];
                    foreach ($queueResponse as $queue) {
                        $queues[] = [
                            'id' => $queue->getProperty('.id'),
                            'name' => $queue->getProperty('name'),
                            'target' => $queue->getProperty('target'),
                            'max_limit' => $queue->getProperty('max-limit'),
                            'comment' => $queue->getProperty('comment'),
                            'disabled' => $queue->getProperty('disabled') == 'false' ? 'No' : 'Yes',
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('queues', $queues);
                } catch (Exception $e) {
                    error_log('Error fetching queues: ' . $e->getMessage());
                    r2(U . 'router_queues/list', 'e', Lang::T('Error fetching queues: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_queues/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_queues.tpl');
        break;

    case 'add-queue':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $name = _post('name');
            $target = _post('target');
            $max_limit = _post('max_limit');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($name) || empty($target) || empty($max_limit)) {
                r2(U . 'router_queues/add-queue/' . $router_id, 'e', Lang::T('Name, Target, and Max Limit are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $addQueueRequest = new RouterOS\Request('/queue/simple/add');
                    $addQueueRequest->setArgument('name', $name);
                    $addQueueRequest->setArgument('target', $target);
                    $addQueueRequest->setArgument('max-limit', $max_limit);
                    if (!empty($comment)) {
                        $addQueueRequest->setArgument('comment', $comment);
                    }
                    $addQueueRequest->setArgument('disabled', $disabled);

                    $client->sendSync($addQueueRequest);

                    r2(U . 'router_queues/list', 's', Lang::T('Queue added successfully'));
                } catch (Exception $e) {
                    error_log('Error adding queue: ' . $e->getMessage());
                    r2(U . 'router_queues/add-queue/' . $router_id, 'e', Lang::T('Error adding queue: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_queues/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $ui->assign('router_id', $router_id);
            $ui->display('router_queues_add.tpl');
        }
        break;

    case 'edit-queue':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $queue_id = _post('queue_id');
            $name = _post('name');
            $target = _post('target');
            $max_limit = _post('max_limit');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($name) || empty($target) || empty($max_limit)) {
                r2(U . 'router_queues/edit-queue/' . $router_id . '/' . urlencode($queue_id), 'e', Lang::T('Name, Target, and Max Limit are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setQueueRequest = new RouterOS\Request('/queue/simple/set');
                    $setQueueRequest->setArgument('numbers', $queue_id);
                    $setQueueRequest->setArgument('name', $name);
                    $setQueueRequest->setArgument('target', $target);
                    $setQueueRequest->setArgument('max-limit', $max_limit);
                    if (!empty($comment)) {
                        $setQueueRequest->setArgument('comment', $comment);
                    }
                    $setQueueRequest->setArgument('disabled', $disabled);

                    $client->sendSync($setQueueRequest);

                    r2(U . 'router_queues/list', 's', Lang::T('Queue updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating queue: ' . $e->getMessage());
                    r2(U . 'router_queues/edit-queue/' . $router_id . '/' . urlencode($queue_id), 'e', Lang::T('Error updating queue: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_queues/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $queue_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch Queue details
                    $queueRequest = new RouterOS\Request('/queue/simple/print');
                    $queueRequest->setQuery(RouterOS\Query::where('.id', $queue_id));
                    $queueResponse = $client->sendSync($queueRequest);

                    if (count($queueResponse) > 0) {
                        foreach ($queueResponse as $queue) {
                            $queueData = [
                                'id' => $queue->getProperty('.id'),
                                'name' => $queue->getProperty('name'),
                                'target' => $queue->getProperty('target'),
                                'max_limit' => $queue->getProperty('max-limit'),
                                'comment' => $queue->getProperty('comment'),
                                'disabled' => $queue->getProperty('disabled') == 'false' ? false : true,
                            ];
                            break;
                        }

                        $ui->assign('router_id', $router_id);
                        $ui->assign('queue', $queueData);
                        $ui->display('router_queues_edit.tpl');
                    } else {
                        r2(U . 'router_queues/list', 'e', Lang::T('Queue not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching queue details: ' . $e->getMessage());
                    r2(U . 'router_queues/list', 'e', Lang::T('Error fetching queue details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_queues/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete-queue':
        $router_id = _post('router_id');
        $queue_id = _post('queue_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeQueueRequest = new RouterOS\Request('/queue/simple/remove');
                $removeQueueRequest->setArgument('numbers', $queue_id);

                $client->sendSync($removeQueueRequest);

                r2(U . 'router_queues/list', 's', Lang::T('Queue deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting queue: ' . $e->getMessage());
                r2(U . 'router_queues/list', 'e', Lang::T('Error deleting queue: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_queues/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_queues/list', 's', '');
}

?>
