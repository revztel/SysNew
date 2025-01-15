<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Bridge'));
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
        // List existing bridges and ports
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch bridges
                    $bridgeRequest = new RouterOS\Request('/interface/bridge/print');
                    $bridgeResponse = $client->sendSync($bridgeRequest);
                    $bridges = [];
                    foreach ($bridgeResponse as $bridge) {
                        $bridges[] = [
                            'id' => $bridge->getProperty('.id'),
                            'name' => $bridge->getProperty('name'),
                            'comment' => $bridge->getProperty('comment'),
                        ];
                    }

                    // Fetch bridge ports
                    $portRequest = new RouterOS\Request('/interface/bridge/port/print');
                    $portResponse = $client->sendSync($portRequest);
                    $ports = [];
                    foreach ($portResponse as $port) {
                        $ports[] = [
                            'id' => $port->getProperty('.id'),
                            'interface' => $port->getProperty('interface'),
                            'bridge' => $port->getProperty('bridge'),
                            'comment' => $port->getProperty('comment'),
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('bridges', $bridges);
                    $ui->assign('ports', $ports);
                } catch (Exception $e) {
                    error_log('Error fetching bridges and ports: ' . $e->getMessage());
                    r2(U . 'router_bridge/list', 'e', Lang::T('Error fetching bridges and ports: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_bridge.tpl');
        break;

    case 'add-bridge':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $name = _post('name');
            $comment = _post('comment');

            if (empty($name)) {
                r2(U . 'router_bridge/add-bridge', 'e', Lang::T('Bridge name is required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $addBridgeRequest = new RouterOS\Request('/interface/bridge/add');
                    $addBridgeRequest->setArgument('name', $name);
                    if (!empty($comment)) {
                        $addBridgeRequest->setArgument('comment', $comment);
                    }

                    $client->sendSync($addBridgeRequest);

                    r2(U . 'router_bridge/list', 's', Lang::T('Bridge added successfully'));
                } catch (Exception $e) {
                    error_log('Error adding bridge: ' . $e->getMessage());
                    r2(U . 'router_bridge/add-bridge', 'e', Lang::T('Error adding bridge: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_bridge/add-bridge', 'e', Lang::T('Router not found'));
            }
        } else {
            $routers = ORM::for_table('tbl_routers')->find_many();
            $ui->assign('routers', $routers);
            $ui->display('router_bridge_add.tpl');
        }
        break;

    case 'edit-bridge':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $bridge_id = _post('bridge_id');
            $name = _post('name');
            $comment = _post('comment');

            if (empty($name)) {
                r2(U . 'router_bridge/edit-bridge?router_id=' . $router_id . '&bridge_id=' . $bridge_id, 'e', Lang::T('Bridge name is required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setBridgeRequest = new RouterOS\Request('/interface/bridge/set');
                    $setBridgeRequest->setArgument('numbers', $bridge_id);
                    $setBridgeRequest->setArgument('name', $name);
                    $setBridgeRequest->setArgument('comment', $comment);

                    $client->sendSync($setBridgeRequest);

                    r2(U . 'router_bridge/list', 's', Lang::T('Bridge updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating bridge: ' . $e->getMessage());
                    r2(U . 'router_bridge/edit-bridge?router_id=' . $router_id . '&bridge_id=' . $bridge_id, 'e', Lang::T('Error updating bridge: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_bridge/edit-bridge', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = _get('router_id');
            $bridge_id = _get('bridge_id');
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $bridgeRequest = new RouterOS\Request('/interface/bridge/print');
                    $bridgeRequest->setQuery(RouterOS\Query::where('.id', $bridge_id));
                    $bridgeResponse = $client->sendSync($bridgeRequest);

                    if (count($bridgeResponse) > 0) {
                        $bridge = $bridgeResponse->getProperty(0);
                        $bridgeData = [
                            'id' => $bridge_id,
                            'name' => $bridge->getProperty('name'),
                            'comment' => $bridge->getProperty('comment'),
                        ];

                        $ui->assign('router_id', $router_id);
                        $ui->assign('bridge', $bridgeData);
                        $ui->display('router_bridge_edit.tpl');
                    } else {
                        r2(U . 'router_bridge/list', 'e', Lang::T('Bridge not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching bridge details: ' . $e->getMessage());
                    r2(U . 'router_bridge/list', 'e', Lang::T('Error fetching bridge details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete-bridge':
        $router_id = _post('router_id');
        $bridge_id = _post('bridge_id');
        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeBridgeRequest = new RouterOS\Request('/interface/bridge/remove');
                $removeBridgeRequest->setArgument('numbers', $bridge_id);

                $client->sendSync($removeBridgeRequest);

                r2(U . 'router_bridge/list', 's', Lang::T('Bridge deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting bridge: ' . $e->getMessage());
                r2(U . 'router_bridge/list', 'e', Lang::T('Error deleting bridge: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
        }
        break;

        case 'add-port':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $router_id = _post('router_id');
                $interface = _post('interface');
                $bridge = _post('bridge');
                $comment = _post('comment');
    
                if (empty($interface) || empty($bridge)) {
                    r2(U . 'router_bridge/add-port/' . $router_id, 'e', Lang::T('Interface and Bridge are required'));
                }
    
                $router = ORM::for_table('tbl_routers')->find_one($router_id);
    
                if ($router) {
                    try {
                        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
    
                        $addPortRequest = new RouterOS\Request('/interface/bridge/port/add');
                        $addPortRequest->setArgument('interface', $interface);
                        $addPortRequest->setArgument('bridge', $bridge);
                        if (!empty($comment)) {
                            $addPortRequest->setArgument('comment', $comment);
                        }
    
                        $client->sendSync($addPortRequest);
    
                        r2(U . 'router_bridge/list', 's', Lang::T('Port added to bridge successfully'));
                    } catch (Exception $e) {
                        error_log('Error adding port to bridge: ' . $e->getMessage());
                        r2(U . 'router_bridge/add-port/' . $router_id, 'e', Lang::T('Error adding port to bridge: ') . $e->getMessage());
                    }
                } else {
                    r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
                }
            } else {
                $router_id = $routes['2'] ?? null;
                $router = ORM::for_table('tbl_routers')->find_one($router_id);
    
                if ($router) {
                    try {
                        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
    
                        // Fetch available interfaces
                        $interfaceRequest = new RouterOS\Request('/interface/print');
                        $interfaceResponse = $client->sendSync($interfaceRequest);
                        $allInterfaces = [];
                        foreach ($interfaceResponse as $interface) {
                            $allInterfaces[] = $interface->getProperty('name');
                        }
    
                        // Fetch interfaces already assigned to bridges
                        $bridgePortRequest = new RouterOS\Request('/interface/bridge/port/print');
                        $bridgePortResponse = $client->sendSync($bridgePortRequest);
                        $assignedInterfaces = [];
                        foreach ($bridgePortResponse as $port) {
                            $assignedInterfaces[] = $port->getProperty('interface');
                        }
    
                        // Get interfaces not assigned to any bridge
                        $availableInterfaces = array_diff($allInterfaces, $assignedInterfaces);
    
                        // Fetch bridges
                        $bridgeRequest = new RouterOS\Request('/interface/bridge/print');
                        $bridgeResponse = $client->sendSync($bridgeRequest);
                        $bridges = [];
                        foreach ($bridgeResponse as $bridge) {
                            $bridges[] = $bridge->getProperty('name');
                        }
    
                        $ui->assign('router_id', $router_id);
                        $ui->assign('interfaces', $availableInterfaces);
                        $ui->assign('bridges', $bridges);
                        $ui->display('router_bridge_add_port.tpl');
                    } catch (Exception $e) {
                        error_log('Error fetching interfaces and bridges: ' . $e->getMessage());
                        r2(U . 'router_bridge/list', 'e', Lang::T('Error fetching interfaces and bridges: ') . $e->getMessage());
                    }
                } else {
                    r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
                }
            }
            break;
    
            case 'edit-port':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $router_id = _post('router_id');
                    $port_id = _post('port_id');
                    $interface = _post('interface');
                    $bridge = _post('bridge');
                    $comment = _post('comment');
            
                    if (empty($interface) || empty($bridge)) {
                        r2(U . 'router_bridge/edit-port/' . $router_id . '/' . urlencode($port_id), 'e', Lang::T('Interface and Bridge are required'));
                    }
            
                    $router = ORM::for_table('tbl_routers')->find_one($router_id);
            
                    if ($router) {
                        try {
                            $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
            
                            $setPortRequest = new RouterOS\Request('/interface/bridge/port/set');
                            $setPortRequest->setArgument('numbers', $port_id);
                            $setPortRequest->setArgument('bridge', $bridge);
                            // Note: Changing the interface may not be allowed; you might need to remove and re-add the port.
                            $setPortRequest->setArgument('interface', $interface);
                            if (!empty($comment)) {
                                $setPortRequest->setArgument('comment', $comment);
                            }
            
                            $client->sendSync($setPortRequest);
            
                            r2(U . 'router_bridge/list', 's', Lang::T('Port updated successfully'));
                        } catch (Exception $e) {
                            error_log('Error updating port: ' . $e->getMessage());
                            r2(U . 'router_bridge/edit-port/' . $router_id . '/' . urlencode($port_id), 'e', Lang::T('Error updating port: ') . $e->getMessage());
                        }
                    } else {
                        r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
                    }
                } else {
                    $router_id = $routes['2'] ?? null;
                    $port_id = $routes['3'] ?? null;
                    $router = ORM::for_table('tbl_routers')->find_one($router_id);
            
                    if ($router) {
                        try {
                            $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
            
                            // Fetch port details
                            $portRequest = new RouterOS\Request('/interface/bridge/port/print');
                            $portRequest->setQuery(RouterOS\Query::where('.id', $port_id));
                            $portResponse = $client->sendSync($portRequest);
            
                            if (count($portResponse) > 0) {
                                // Corrected code starts here
                                foreach ($portResponse as $port) {
                                    $portData = [
                                        'id' => $port->getProperty('.id'),
                                        'interface' => $port->getProperty('interface'),
                                        'bridge' => $port->getProperty('bridge'),
                                        'comment' => $port->getProperty('comment'),
                                    ];
                                    break; // Since we only need the first result
                                }
                                // Corrected code ends here
            
                                // Fetch interfaces (include the current interface)
                                $interfaceRequest = new RouterOS\Request('/interface/print');
                                $interfaceResponse = $client->sendSync($interfaceRequest);
                                $allInterfaces = [];
                                foreach ($interfaceResponse as $interface) {
                                    $allInterfaces[] = $interface->getProperty('name');
                                }
            
                                // Fetch interfaces assigned to bridges excluding current interface
                                $bridgePortRequest = new RouterOS\Request('/interface/bridge/port/print');
                                $bridgePortResponse = $client->sendSync($bridgePortRequest);
                                $assignedInterfaces = [];
                                foreach ($bridgePortResponse as $bridgePort) {
                                    $assignedInterface = $bridgePort->getProperty('interface');
                                    if ($assignedInterface !== $portData['interface']) {
                                        $assignedInterfaces[] = $assignedInterface;
                                    }
                                }
            
                                // Get interfaces not assigned to any bridge or current interface
                                $availableInterfaces = array_diff($allInterfaces, $assignedInterfaces);
            
                                // Fetch bridges
                                $bridgeRequest = new RouterOS\Request('/interface/bridge/print');
                                $bridgeResponse = $client->sendSync($bridgeRequest);
                                $bridges = [];
                                foreach ($bridgeResponse as $bridge) {
                                    $bridges[] = $bridge->getProperty('name');
                                }
            
                                $ui->assign('router_id', $router_id);
                                $ui->assign('port', $portData);
                                $ui->assign('interfaces', $availableInterfaces);
                                $ui->assign('bridges', $bridges);
                                $ui->display('router_bridge_edit_port.tpl');
                            } else {
                                r2(U . 'router_bridge/list', 'e', Lang::T('Port not found'));
                            }
                        } catch (Exception $e) {
                            error_log('Error fetching port details: ' . $e->getMessage());
                            r2(U . 'router_bridge/list', 'e', Lang::T('Error fetching port details: ') . $e->getMessage());
                        }
                    } else {
                        r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
                    }
                }
                break;
            

    case 'delete-port':
        $router_id = _post('router_id');
        $port_id = _post('port_id');
        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removePortRequest = new RouterOS\Request('/interface/bridge/port/remove');
                $removePortRequest->setArgument('numbers', $port_id);

                $client->sendSync($removePortRequest);

                r2(U . 'router_bridge/list', 's', Lang::T('Port deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting port: ' . $e->getMessage());
                r2(U . 'router_bridge/list', 'e', Lang::T('Error deleting port: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_bridge/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_bridge/list', 's', '');
}
?>
