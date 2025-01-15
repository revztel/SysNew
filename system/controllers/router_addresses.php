<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Addresses Management'));
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
        // Display the main IP addresses management page
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch IP Addresses
                    $ipAddressRequest = new RouterOS\Request('/ip/address/print');
                    $ipAddressResponse = $client->sendSync($ipAddressRequest);

                    $ipAddresses = [];
                    foreach ($ipAddressResponse as $ip) {
                        $ipAddresses[] = [
                            'id' => $ip->getProperty('.id'),
                            'address' => $ip->getProperty('address'),
                            'network' => $ip->getProperty('network'),
                            'interface' => $ip->getProperty('interface'),
                            'comment' => $ip->getProperty('comment'),
                            'disabled' => $ip->getProperty('disabled') == 'false' ? 'Yes' : 'No',
                        ];
                    }

                    // Fetch ARP entries (read-only)
                    $arpRequest = new RouterOS\Request('/ip/arp/print');
                    $arpResponse = $client->sendSync($arpRequest);

                    $arpEntries = [];
                    foreach ($arpResponse as $arp) {
                        $arpEntries[] = [
                            'id' => $arp->getProperty('.id'),
                            'address' => $arp->getProperty('address'),
                            'mac_address' => $arp->getProperty('mac-address'),
                            'interface' => $arp->getProperty('interface'),
                            'comment' => $arp->getProperty('comment'),
                        ];
                    }

                    // Fetch IP Services
                    $ipServiceRequest = new RouterOS\Request('/ip/service/print');
                    $ipServiceResponse = $client->sendSync($ipServiceRequest);

                    $ipServices = [];
                    foreach ($ipServiceResponse as $service) {
                        $ipServices[] = [
                            'id' => $service->getProperty('.id'),
                            'name' => $service->getProperty('name'),
                            'port' => $service->getProperty('port'),
                            'address' => $service->getProperty('address'),
                            'disabled' => $service->getProperty('disabled') == 'false' ? 'Yes' : 'No',
                        ];
                    }

                    // Fetch Firewall Rules
                    $firewallRequest = new RouterOS\Request('/ip/firewall/filter/print');
                    $firewallResponse = $client->sendSync($firewallRequest);

                    $firewallRules = [];
                    foreach ($firewallResponse as $rule) {
                        $firewallRules[] = [
                            'id' => $rule->getProperty('.id'),
                            'chain' => $rule->getProperty('chain'),
                            'action' => $rule->getProperty('action'),
                            'src_address' => $rule->getProperty('src-address'),
                            'dst_address' => $rule->getProperty('dst-address'),
                            'comment' => $rule->getProperty('comment'),
                            'disabled' => $rule->getProperty('disabled') == 'false' ? 'Yes' : 'No',
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('ipAddresses', $ipAddresses);
                    $ui->assign('arpEntries', $arpEntries);
                    $ui->assign('ipServices', $ipServices);
                    $ui->assign('firewallRules', $firewallRules);
                } catch (Exception $e) {
                    error_log('Error fetching data: ' . $e->getMessage());
                    r2(U . 'router_addresses/list', 'e', Lang::T('Error fetching data: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_addresses.tpl');
        break;

    // IP Addresses
    case 'add-ip':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $address = _post('address');
            $interface = _post('interface');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($address) || empty($interface)) {
                r2(U . 'router_addresses/add-ip/' . $router_id, 'e', Lang::T('Address and Interface are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $addIpRequest = new RouterOS\Request('/ip/address/add');
                    $addIpRequest->setArgument('address', $address);
                    $addIpRequest->setArgument('interface', $interface);
                    if (!empty($comment)) {
                        $addIpRequest->setArgument('comment', $comment);
                    }
                    $addIpRequest->setArgument('disabled', $disabled);

                    $client->sendSync($addIpRequest);

                    r2(U . 'router_addresses/list', 's', Lang::T('IP Address added successfully'));
                } catch (Exception $e) {
                    error_log('Error adding IP Address: ' . $e->getMessage());
                    r2(U . 'router_addresses/add-ip/' . $router_id, 'e', Lang::T('Error adding IP Address: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
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
                    $ui->display('router_addresses_add_ip.tpl');
                } catch (Exception $e) {
                    error_log('Error fetching interfaces: ' . $e->getMessage());
                    r2(U . 'router_addresses/list', 'e', Lang::T('Error fetching interfaces: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'edit-ip':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $ip_id = _post('ip_id');
            $address = _post('address');
            $interface = _post('interface');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($address) || empty($interface)) {
                r2(U . 'router_addresses/edit-ip/' . $router_id . '/' . urlencode($ip_id), 'e', Lang::T('Address and Interface are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    $setIpRequest = new RouterOS\Request('/ip/address/set');
                    $setIpRequest->setArgument('numbers', $ip_id);
                    $setIpRequest->setArgument('address', $address);
                    $setIpRequest->setArgument('interface', $interface);
                    if (!empty($comment)) {
                        $setIpRequest->setArgument('comment', $comment);
                    }
                    $setIpRequest->setArgument('disabled', $disabled);

                    $client->sendSync($setIpRequest);

                    r2(U . 'router_addresses/list', 's', Lang::T('IP Address updated successfully'));
                } catch (Exception $e) {
                    error_log('Error updating IP Address: ' . $e->getMessage());
                    r2(U . 'router_addresses/edit-ip/' . $router_id . '/' . urlencode($ip_id), 'e', Lang::T('Error updating IP Address: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $ip_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch IP Address details
                    $ipRequest = new RouterOS\Request('/ip/address/print');
                    $ipRequest->setQuery(RouterOS\Query::where('.id', $ip_id));
                    $ipResponse = $client->sendSync($ipRequest);

                    if (count($ipResponse) > 0) {
                        foreach ($ipResponse as $ip) {
                            $ipData = [
                                'id' => $ip->getProperty('.id'),
                                'address' => $ip->getProperty('address'),
                                'interface' => $ip->getProperty('interface'),
                                'comment' => $ip->getProperty('comment'),
                                'disabled' => $ip->getProperty('disabled') == 'false' ? false : true,
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
                        $ui->assign('ip', $ipData);
                        $ui->assign('interfaces', $interfaces);
                        $ui->display('router_addresses_edit_ip.tpl');
                    } else {
                        r2(U . 'router_addresses/list', 'e', Lang::T('IP Address not found'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching IP Address details: ' . $e->getMessage());
                    r2(U . 'router_addresses/list', 'e', Lang::T('Error fetching IP Address details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete-ip':
        $router_id = _post('router_id');
        $ip_id = _post('ip_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeIpRequest = new RouterOS\Request('/ip/address/remove');
                $removeIpRequest->setArgument('numbers', $ip_id);

                $client->sendSync($removeIpRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('IP Address deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting IP Address: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error deleting IP Address: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    // IP Services
    case 'enable-service':
        $router_id = $routes['2'] ?? null;
        $service_id = $routes['3'] ?? null;

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $enableServiceRequest = new RouterOS\Request('/ip/service/enable');
                $enableServiceRequest->setArgument('numbers', $service_id);

                $client->sendSync($enableServiceRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('Service enabled successfully'));
            } catch (Exception $e) {
                error_log('Error enabling service: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error enabling service: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    case 'disable-service':
        $router_id = $routes['2'] ?? null;
        $service_id = $routes['3'] ?? null;

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $disableServiceRequest = new RouterOS\Request('/ip/service/disable');
                $disableServiceRequest->setArgument('numbers', $service_id);

                $client->sendSync($disableServiceRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('Service disabled successfully'));
            } catch (Exception $e) {
                error_log('Error disabling service: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error disabling service: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    // Firewall Rules
    case 'disable-firewall-rule':
        $router_id = $routes['2'] ?? null;
        $rule_id = $routes['3'] ?? null;

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $disableRuleRequest = new RouterOS\Request('/ip/firewall/filter/disable');
                $disableRuleRequest->setArgument('numbers', $rule_id);

                $client->sendSync($disableRuleRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('Firewall rule disabled successfully'));
            } catch (Exception $e) {
                error_log('Error disabling firewall rule: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error disabling firewall rule: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    case 'enable-firewall-rule':
        $router_id = $routes['2'] ?? null;
        $rule_id = $routes['3'] ?? null;

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $enableRuleRequest = new RouterOS\Request('/ip/firewall/filter/enable');
                $enableRuleRequest->setArgument('numbers', $rule_id);

                $client->sendSync($enableRuleRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('Firewall rule enabled successfully'));
            } catch (Exception $e) {
                error_log('Error enabling firewall rule: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error enabling firewall rule: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    case 'delete-firewall-rule':
        $router_id = _post('router_id');
        $rule_id = _post('rule_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                $removeRuleRequest = new RouterOS\Request('/ip/firewall/filter/remove');
                $removeRuleRequest->setArgument('numbers', $rule_id);

                $client->sendSync($removeRuleRequest);

                r2(U . 'router_addresses/list', 's', Lang::T('Firewall rule deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting firewall rule: ' . $e->getMessage());
                r2(U . 'router_addresses/list', 'e', Lang::T('Error deleting firewall rule: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_addresses/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_addresses/list', 's', '');
}

?>
