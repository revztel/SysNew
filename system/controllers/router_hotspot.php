<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Hotspot Management'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

// Check if the user has permission
if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'list';

switch ($action) {
    case 'list':
        // Display Hotspot configurations
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch Hotspot Servers
                    $serverRequest = new RouterOS\Request('/ip/hotspot/print');
                    $serverResponse = $client->sendSync($serverRequest);

                    $servers = [];
                    foreach ($serverResponse as $server) {
                        $servers[] = [
                            'id' => $server->getProperty('.id'),
                            'name' => $server->getProperty('name'),
                            'interface' => $server->getProperty('interface'),
                            'address_pool' => $server->getProperty('address-pool'),
                            'profile' => $server->getProperty('profile'),
                            'disabled' => $server->getProperty('disabled') == 'false' ? 'No' : 'Yes',
                        ];
                    }

                    // Fetch Hotspot Server Profiles
                    $profileRequest = new RouterOS\Request('/ip/hotspot/profile/print');
                    $profileResponse = $client->sendSync($profileRequest);

                    $profiles = [];
                    foreach ($profileResponse as $profile) {
                        $profiles[] = [
                            'id' => $profile->getProperty('.id'),
                            'name' => $profile->getProperty('name'),
                            'hotspot_address' => $profile->getProperty('hotspot-address'),
                            'dns_name' => $profile->getProperty('dns-name'),
                            'login_by' => $profile->getProperty('login-by'),
                        ];
                    }

                    // Fetch other Hotspot info (read-only)
                    // Users
                    $userRequest = new RouterOS\Request('/ip/hotspot/user/print');
                    $userResponse = $client->sendSync($userRequest);

                    $users = [];
                    foreach ($userResponse as $user) {
                        $users[] = [
                            'id' => $user->getProperty('.id'),
                            'name' => $user->getProperty('name'),
                            'profile' => $user->getProperty('profile'),
                            'uptime' => $user->getProperty('uptime'),
                        ];
                    }

                    // Active Users
                    $activeRequest = new RouterOS\Request('/ip/hotspot/active/print');
                    $activeResponse = $client->sendSync($activeRequest);

                    $activeUsers = [];
                    foreach ($activeResponse as $active) {
                        $activeUsers[] = [
                            'id' => $active->getProperty('.id'),
                            'user' => $active->getProperty('user'),
                            'address' => $active->getProperty('address'),
                            'uptime' => $active->getProperty('uptime'),
                        ];
                    }

                    // Hosts
                    $hostRequest = new RouterOS\Request('/ip/hotspot/host/print');
                    $hostResponse = $client->sendSync($hostRequest);

                    $hosts = [];
                    foreach ($hostResponse as $host) {
                        $hosts[] = [
                            'id' => $host->getProperty('.id'),
                            'address' => $host->getProperty('address'),
                            'mac_address' => $host->getProperty('mac-address'),
                            'to_address' => $host->getProperty('to-address'),
                        ];
                    }

                    // IP Bindings
                    $ipBindingRequest = new RouterOS\Request('/ip/hotspot/ip-binding/print');
                    $ipBindingResponse = $client->sendSync($ipBindingRequest);

                    $ipBindings = [];
                    foreach ($ipBindingResponse as $binding) {
                        $ipBindings[] = [
                            'id' => $binding->getProperty('.id'),
                            'mac_address' => $binding->getProperty('mac-address'),
                            'address' => $binding->getProperty('address'),
                            'type' => $binding->getProperty('type'),
                        ];
                    }

                    // Walled Garden
                    $walledGardenRequest = new RouterOS\Request('/ip/hotspot/walled-garden/print');
                    $walledGardenResponse = $client->sendSync($walledGardenRequest);

                    $walledGardens = [];
                    foreach ($walledGardenResponse as $wg) {
                        $walledGardens[] = [
                            'id' => $wg->getProperty('.id'),
                            'dst_host' => $wg->getProperty('dst-host'),
                            'dst_port' => $wg->getProperty('dst-port'),
                            'action' => $wg->getProperty('action'),
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('servers', $servers);
                    $ui->assign('profiles', $profiles);
                    $ui->assign('users', $users);
                    $ui->assign('activeUsers', $activeUsers);
                    $ui->assign('hosts', $hosts);
                    $ui->assign('ipBindings', $ipBindings);
                    $ui->assign('walledGardens', $walledGardens);
                } catch (Exception $e) {
                    error_log('Error fetching Hotspot configurations: ' . $e->getMessage());
                    r2(U . 'router_hotspot/list', 'e', Lang::T('Error fetching Hotspot configurations: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_hotspot/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_hotspot.tpl');
        break;

    // Add, Edit, Delete for Servers and Server Profiles
    // Similar to previous implementations for adding, editing, and deleting
    // Implementing 'edit-server', 'edit-profile', etc.

    // Example for editing a server:
    case 'edit-server':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $server_id = _post('server_id');
            $name = _post('name');
            $address_pool = _post('address_pool');
            $profile = _post('profile');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setServerRequest = new RouterOS\Request('/ip/hotspot/set');
                    $setServerRequest->setArgument('numbers', $server_id);
                    $setServerRequest->setArgument('name', $name);
                    $setServerRequest->setArgument('address-pool', $address_pool);
                    $setServerRequest->setArgument('profile', $profile);
                    $setServerRequest->setArgument('disabled', $disabled);

                    $client->sendSync($setServerRequest);

                    r2(U . 'router_hotspot/list', 's', Lang::T('Hotspot server updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating Hotspot server: ' . $e->getMessage());
                    r2(U . 'router_hotspot/list', 'e', Lang::T('Error updating Hotspot server: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_hotspot/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $server_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch server details
                    $serverRequest = new RouterOS\Request('/ip/hotspot/print');
                    $serverRequest->setQuery(RouterOS\Query::where('.id', $server_id));
                    $serverResponse = $client->sendSync($serverRequest);

                    if (count($serverResponse) > 0) {
                        foreach ($serverResponse as $server) {
                            $serverData = [
                                'id' => $server->getProperty('.id'),
                                'name' => $server->getProperty('name'),
                                'interface' => $server->getProperty('interface'),
                                'address_pool' => $server->getProperty('address-pool'),
                                'profile' => $server->getProperty('profile'),
                                'disabled' => $server->getProperty('disabled') == 'false' ? false : true,
                            ];
                            break;
                        }

                        // Fetch profiles for selection
                        $profileRequest = new RouterOS\Request('/ip/hotspot/profile/print');
                        $profileResponse = $client->sendSync($profileRequest);

                        $profiles = [];
                        foreach ($profileResponse as $profile) {
                            $profiles[] = $profile->getProperty('name');
                        }

                        $ui->assign('router_id', $router_id);
                        $ui->assign('server', $serverData);
                        $ui->assign('profiles', $profiles);
                        $ui->display('router_hotspot_edit_server.tpl');
                    } else {
                        r2(U . 'router_hotspot/list', 'e', Lang::T('Hotspot server not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching Hotspot server details: ' . $e->getMessage());
                    r2(U . 'router_hotspot/list', 'e', Lang::T('Error fetching Hotspot server details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_hotspot/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

        case 'edit-profile':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $router_id = _post('router_id');
                $profile_id = _post('profile_id');
                $dns_name = _post('dns_name');
                $login_by = isset($_POST['login_by']) ? implode(',', $_POST['login_by']) : '';
    
                $router = ORM::for_table('tbl_routers')->find_one($router_id);
    
                if ($router) {
                    try {
                        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
    
                        $setProfileRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                        $setProfileRequest->setArgument('numbers', $profile_id);
                        $setProfileRequest->setArgument('dns-name', $dns_name);
                        $setProfileRequest->setArgument('login-by', $login_by);
    
                        $client->sendSync($setProfileRequest);
    
                        r2(U . 'router_hotspot/list', 's', Lang::T('Hotspot server profile updated successfully'));
                    } catch (Exception $e) {
                        error_log('Error updating Hotspot server profile: ' . $e->getMessage());
                        r2(U . 'router_hotspot/list', 'e', Lang::T('Error updating Hotspot server profile: ') . $e->getMessage());
                    }
                } else {
                    r2(U . 'router_hotspot/list', 'e', Lang::T('Router not found'));
                }
            } else {
                $router_id = $routes['2'] ?? null;
                $profile_id = $routes['3'] ?? null;
                $router = ORM::for_table('tbl_routers')->find_one($router_id);
    
                if ($router) {
                    try {
                        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
    
                        // Fetch profile details
                        $profileRequest = new RouterOS\Request('/ip/hotspot/profile/print');
                        $profileRequest->setQuery(RouterOS\Query::where('.id', $profile_id));
                        $profileResponse = $client->sendSync($profileRequest);
    
                        if (count($profileResponse) > 0) {
                            foreach ($profileResponse as $profile) {
                                $profileData = [
                                    'id' => $profile->getProperty('.id'),
                                    'name' => $profile->getProperty('name'),
                                    'dns_name' => $profile->getProperty('dns-name'),
                                    'login_by' => $profile->getProperty('login-by'),
                                ];
                                break;
                            }
    
                            // Possible login methods
                            $loginMethods = ['http-chap', 'http-pap', 'https', 'mac-cookie', 'mac', 'cookie', 'trial'];
    
                            $ui->assign('router_id', $router_id);
                            $ui->assign('profile', $profileData);
                            $ui->assign('loginMethods', $loginMethods);
                            $ui->display('router_hotspot_edit_profile.tpl');
                        } else {
                            r2(U . 'router_hotspot/list', 'e', Lang::T('Hotspot server profile not found'));
                        }
                    } catch (Exception $e) {
                        error_log('Error fetching Hotspot server profile details: ' . $e->getMessage());
                        r2(U . 'router_hotspot/list', 'e', Lang::T('Error fetching Hotspot server profile details: ') . $e->getMessage());
                    }
                } else {
                    r2(U . 'router_hotspot/list', 'e', Lang::T('Router not found'));
                }
            }
            break;

    // Similar implementations can be made for editing server profiles.

    default:
        r2(U . 'router_hotspot/list', 's', '');
}
?>
