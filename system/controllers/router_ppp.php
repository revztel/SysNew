<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router PPP Management'));
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
        // Display the main PPP management page
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch PPPoE Servers
                    $pppoeServerRequest = new RouterOS\Request('/interface/pppoe-server/server/print');
                    $pppoeServerResponse = $client->sendSync($pppoeServerRequest);

                    $pppoeServers = [];
                    foreach ($pppoeServerResponse as $server) {
                        $pppoeServers[] = [
                            'id' => $server->getProperty('.id'),
                            'service_name' => $server->getProperty('service-name'),
                            'interface' => $server->getProperty('interface'),
                            'max_mtu' => $server->getProperty('max-mtu'),
                            'max_mru' => $server->getProperty('max-mru'),
                            'enabled' => $server->getProperty('disabled') == 'false' ? 'Yes' : 'No',
                        ];
                    }

                    // Fetch Secrets
                    $secretsRequest = new RouterOS\Request('/ppp/secret/print');
                    $secretsResponse = $client->sendSync($secretsRequest);

                    $secrets = [];
                    foreach ($secretsResponse as $secret) {
                        $secrets[] = [
                            'id' => $secret->getProperty('.id'),
                            'name' => $secret->getProperty('name'),
                            'password' => $secret->getProperty('password'),
                            'service' => $secret->getProperty('service'),
                            'profile' => $secret->getProperty('profile'),
                            'comment' => $secret->getProperty('comment'),
                            'enabled' => $secret->getProperty('disabled') == 'false' ? 'Yes' : 'No',
                        ];
                    }

                    // Fetch Interfaces (read-only)
                    $interfacesRequest = new RouterOS\Request('/interface/print');
                    $interfacesResponse = $client->sendSync($interfacesRequest);

                    $interfaces = [];
                    foreach ($interfacesResponse as $interface) {
                        $interfaces[] = [
                            'id' => $interface->getProperty('.id'),
                            'name' => $interface->getProperty('name'),
                            'type' => $interface->getProperty('type'),
                            'mtu' => $interface->getProperty('mtu'),
                            'mac_address' => $interface->getProperty('mac-address'),
                            'running' => $interface->getProperty('running') == 'true' ? 'Yes' : 'No',
                        ];
                    }

                    // Fetch Profiles (read-only)
                    $profilesRequest = new RouterOS\Request('/ppp/profile/print');
                    $profilesResponse = $client->sendSync($profilesRequest);

                    $profiles = [];
                    foreach ($profilesResponse as $profile) {
                        $profiles[] = [
                            'id' => $profile->getProperty('.id'),
                            'name' => $profile->getProperty('name'),
                            'local_address' => $profile->getProperty('local-address'),
                            'remote_address' => $profile->getProperty('remote-address'),
                            'only_one' => $profile->getProperty('only-one'),
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('pppoeServers', $pppoeServers);
                    $ui->assign('secrets', $secrets);
                    $ui->assign('interfaces', $interfaces);
                    $ui->assign('profiles', $profiles);
                } catch (Exception $e) {
                    error_log('Error fetching PPP data: ' . $e->getMessage());
                    r2(U . 'router_ppp/list', 'e', Lang::T('Error fetching PPP data: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_ppp.tpl');
        break;

    // PPPoE Servers
    case 'add-pppoe-server':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $service_name = _post('service_name');
            $interface = _post('interface');
            $max_mtu = _post('max_mtu');
            $max_mru = _post('max_mru');
            $enabled = isset($_POST['enabled']) ? 'no' : 'yes'; // 'disabled' property in RouterOS

            if (empty($service_name) || empty($interface)) {
                r2(U . 'router_ppp/add-pppoe-server/' . $router_id, 'e', Lang::T('Service Name and Interface are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $addServerRequest = new RouterOS\Request('/interface/pppoe-server/server/add');
                    $addServerRequest->setArgument('service-name', $service_name);
                    $addServerRequest->setArgument('interface', $interface);
                    if (!empty($max_mtu)) {
                        $addServerRequest->setArgument('max-mtu', $max_mtu);
                    }
                    if (!empty($max_mru)) {
                        $addServerRequest->setArgument('max-mru', $max_mru);
                    }
                    $addServerRequest->setArgument('disabled', $enabled);

                    $client->sendSync($addServerRequest);

                    r2(U . 'router_ppp/list', 's', Lang::T('PPPoE Server added successfully'));
                } catch (Exception $e) {
                    error_log('Error adding PPPoE Server: ' . $e->getMessage());
                    r2(U . 'router_ppp/add-pppoe-server/' . $router_id, 'e', Lang::T('Error adding PPPoE Server: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch interfaces for selection
                    $interfacesRequest = new RouterOS\Request('/interface/print');
                    $interfacesResponse = $client->sendSync($interfacesRequest);

                    $interfaces = [];
                    foreach ($interfacesResponse as $interface) {
                        $interfaces[] = $interface->getProperty('name');
                    }

                    $ui->assign('router_id', $router_id);
                    $ui->assign('interfaces', $interfaces);
                    $ui->display('router_ppp_add_pppoe_server.tpl');
                } catch (Exception $e) {
                    error_log('Error fetching interfaces: ' . $e->getMessage());
                    r2(U . 'router_ppp/list', 'e', Lang::T('Error fetching interfaces: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'edit-pppoe-server':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $server_id = _post('server_id');
            $service_name = _post('service_name');
            $interface = _post('interface');
            $max_mtu = _post('max_mtu');
            $max_mru = _post('max_mru');
            $enabled = isset($_POST['enabled']) ? 'no' : 'yes';

            if (empty($service_name) || empty($interface)) {
                r2(U . 'router_ppp/edit-pppoe-server/' . $router_id . '/' . urlencode($server_id), 'e', Lang::T('Service Name and Interface are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setServerRequest = new RouterOS\Request('/interface/pppoe-server/server/set');
                    $setServerRequest->setArgument('numbers', $server_id);
                    $setServerRequest->setArgument('service-name', $service_name);
                    $setServerRequest->setArgument('interface', $interface);
                    if (!empty($max_mtu)) {
                        $setServerRequest->setArgument('max-mtu', $max_mtu);
                    }
                    if (!empty($max_mru)) {
                        $setServerRequest->setArgument('max-mru', $max_mru);
                    }
                    $setServerRequest->setArgument('disabled', $enabled);

                    $client->sendSync($setServerRequest);

                    r2(U . 'router_ppp/list', 's', Lang::T('PPPoE Server updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating PPPoE Server: ' . $e->getMessage());
                    r2(U . 'router_ppp/edit-pppoe-server/' . $router_id . '/' . urlencode($server_id), 'e', Lang::T('Error updating PPPoE Server: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $server_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch PPPoE Server details
                    $serverRequest = new RouterOS\Request('/interface/pppoe-server/server/print');
                    $serverRequest->setQuery(RouterOS\Query::where('.id', $server_id));
                    $serverResponse = $client->sendSync($serverRequest);

                    if (count($serverResponse) > 0) {
                        foreach ($serverResponse as $server) {
                            $serverData = [
                                'id' => $server->getProperty('.id'),
                                'service_name' => $server->getProperty('service-name'),
                                'interface' => $server->getProperty('interface'),
                                'max_mtu' => $server->getProperty('max-mtu'),
                                'max_mru' => $server->getProperty('max-mru'),
                                'enabled' => $server->getProperty('disabled') == 'false' ? true : false,
                            ];
                            break;
                        }

                        // Fetch interfaces for selection
                        $interfacesRequest = new RouterOS\Request('/interface/print');
                        $interfacesResponse = $client->sendSync($interfacesRequest);

                        $interfaces = [];
                        foreach ($interfacesResponse as $interface) {
                            $interfaces[] = $interface->getProperty('name');
                        }

                        $ui->assign('router_id', $router_id);
                        $ui->assign('server', $serverData);
                        $ui->assign('interfaces', $interfaces);
                        $ui->display('router_ppp_edit_pppoe_server.tpl');
                    } else {
                        r2(U . 'router_ppp/list', 'e', Lang::T('PPPoE Server not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching PPPoE Server details: ' . $e->getMessage());
                    r2(U . 'router_ppp/list', 'e', Lang::T('Error fetching PPPoE Server details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete-pppoe-server':
        $router_id = _post('router_id');
        $server_id = _post('server_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeServerRequest = new RouterOS\Request('/interface/pppoe-server/server/remove');
                $removeServerRequest->setArgument('numbers', $server_id);

                $client->sendSync($removeServerRequest);

                r2(U . 'router_ppp/list', 's', Lang::T('PPPoE Server deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting PPPoE Server: ' . $e->getMessage());
                r2(U . 'router_ppp/list', 'e', Lang::T('Error deleting PPPoE Server: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
        }
        break;

    // Secrets
    case 'add-secret':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $name = _post('name');
            $password = _post('password');
            $profile = _post('profile');
            $service = _post('service');
            $comment = _post('comment');
            $enabled = isset($_POST['enabled']) ? 'no' : 'yes';

            if (empty($name) || empty($password)) {
                r2(U . 'router_ppp/add-secret/' . $router_id, 'e', Lang::T('Name and Password are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $addSecretRequest = new RouterOS\Request('/ppp/secret/add');
                    $addSecretRequest->setArgument('name', $name);
                    $addSecretRequest->setArgument('password', $password);
                    if (!empty($profile)) {
                        $addSecretRequest->setArgument('profile', $profile);
                    }
                    if (!empty($service)) {
                        $addSecretRequest->setArgument('service', $service);
                    }
                    if (!empty($comment)) {
                        $addSecretRequest->setArgument('comment', $comment);
                    }
                    $addSecretRequest->setArgument('disabled', $enabled);

                    $client->sendSync($addSecretRequest);

                    r2(U . 'router_ppp/list', 's', Lang::T('Secret added successfully'));
                } catch (Exception $e) {
                    error_log('Error adding Secret: ' . $e->getMessage());
                    r2(U . 'router_ppp/add-secret/' . $router_id, 'e', Lang::T('Error adding Secret: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch profiles for selection
                    $profilesRequest = new RouterOS\Request('/ppp/profile/print');
                    $profilesResponse = $client->sendSync($profilesRequest);

                    $profiles = [];
                    foreach ($profilesResponse as $profile) {
                        $profiles[] = $profile->getProperty('name');
                    }

                    $ui->assign('router_id', $router_id);
                    $ui->assign('profiles', $profiles);
                    $ui->display('router_ppp_add_secret.tpl');
                } catch (Exception $e) {
                    error_log('Error fetching profiles: ' . $e->getMessage());
                    r2(U . 'router_ppp/list', 'e', Lang::T('Error fetching profiles: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'edit-secret':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $secret_id = _post('secret_id');
            $name = _post('name');
            $password = _post('password');
            $profile = _post('profile');
            $service = _post('service');
            $comment = _post('comment');
            $enabled = isset($_POST['enabled']) ? 'no' : 'yes';

            if (empty($name) || empty($password)) {
                r2(U . 'router_ppp/edit-secret/' . $router_id . '/' . urlencode($secret_id), 'e', Lang::T('Name and Password are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setSecretRequest = new RouterOS\Request('/ppp/secret/set');
                    $setSecretRequest->setArgument('numbers', $secret_id);
                    $setSecretRequest->setArgument('name', $name);
                    $setSecretRequest->setArgument('password', $password);
                    if (!empty($profile)) {
                        $setSecretRequest->setArgument('profile', $profile);
                    }
                    if (!empty($service)) {
                        $setSecretRequest->setArgument('service', $service);
                    }
                    if (!empty($comment)) {
                        $setSecretRequest->setArgument('comment', $comment);
                    }
                    $setSecretRequest->setArgument('disabled', $enabled);

                    $client->sendSync($setSecretRequest);

                    r2(U . 'router_ppp/list', 's', Lang::T('Secret updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating Secret: ' . $e->getMessage());
                    r2(U . 'router_ppp/edit-secret/' . $router_id . '/' . urlencode($secret_id), 'e', Lang::T('Error updating Secret: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $secret_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch secret details
                    $secretRequest = new RouterOS\Request('/ppp/secret/print');
                    $secretRequest->setQuery(RouterOS\Query::where('.id', $secret_id));
                    $secretResponse = $client->sendSync($secretRequest);

                    if (count($secretResponse) > 0) {
                        foreach ($secretResponse as $secret) {
                            $secretData = [
                                'id' => $secret->getProperty('.id'),
                                'name' => $secret->getProperty('name'),
                                'password' => $secret->getProperty('password'),
                                'profile' => $secret->getProperty('profile'),
                                'service' => $secret->getProperty('service'),
                                'comment' => $secret->getProperty('comment'),
                                'enabled' => $secret->getProperty('disabled') == 'false' ? true : false,
                            ];
                            break;
                        }

                        // Fetch profiles for selection
                        $profilesRequest = new RouterOS\Request('/ppp/profile/print');
                        $profilesResponse = $client->sendSync($profilesRequest);

                        $profiles = [];
                        foreach ($profilesResponse as $profile) {
                            $profiles[] = $profile->getProperty('name');
                        }

                        $ui->assign('router_id', $router_id);
                        $ui->assign('secret', $secretData);
                        $ui->assign('profiles', $profiles);
                        $ui->display('router_ppp_edit_secret.tpl');
                    } else {
                        r2(U . 'router_ppp/list', 'e', Lang::T('Secret not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching secret details: ' . $e->getMessage());
                    r2(U . 'router_ppp/list', 'e', Lang::T('Error fetching secret details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete-secret':
        $router_id = _post('router_id');
        $secret_id = _post('secret_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeSecretRequest = new RouterOS\Request('/ppp/secret/remove');
                $removeSecretRequest->setArgument('numbers', $secret_id);

                $client->sendSync($removeSecretRequest);

                r2(U . 'router_ppp/list', 's', Lang::T('Secret deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting Secret: ' . $e->getMessage());
                r2(U . 'router_ppp/list', 'e', Lang::T('Error deleting Secret: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_ppp/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_ppp/list', 's', '');
}

?>
