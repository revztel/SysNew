<?php
include "../init.php";
ob_start();

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Network'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

$action = $routes['1'];

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

// Set the master password
$master_password = '1996';

// Cookie settings
$cookie_name = 'router_authenticated';

// Check for password cookie
if (!isset($_COOKIE[$cookie_name])) {
    // Handle password-related POST requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // User is setting new password
        if (isset($_POST['new_router_password']) && isset($_POST['confirm_router_password'])) {
            $new_password = _post('new_router_password');
            $confirm_password = _post('confirm_router_password');

            // Check if user has a stored password
            $setting_name = 'router_password_' . $admin['id'];
            $user_password_record = ORM::for_table('tbl_appconfig')
                ->where('setting', $setting_name)
                ->find_one();

            if (!$user_password_record) {
                // User has not set a password yet
                if ($new_password === $master_password && $confirm_password === $master_password) {
                    // Admin bypasses password setup
                    $cookie_expiry = time() + 30 * 60; // 30 minutes
                    setcookie($cookie_name, 'true', $cookie_expiry, "/", "", false, true);

                    // Log bypass
                    error_log("Admin {$admin['username']} bypassed password setup using master password.");

                    // Redirect to prevent form resubmission
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    ob_end_flush();
                    exit;
                } else {
                    // Proceed to set the new password
                    if ($new_password === $confirm_password) {
                        try {
                            $user_password_record = ORM::for_table('tbl_appconfig')->create();
                            $user_password_record->setting = $setting_name;
                            $user_password_record->value = $new_password;
                            $user_password_record->save();

                            // Log password creation
                            error_log("Router password set for user {$admin['username']}.");

                            // Set authentication cookie
                            $cookie_expiry = time() + 30 * 60; // 30 minutes
                            setcookie($cookie_name, 'true', $cookie_expiry, "/", "", false, true);

                            // Redirect to prevent form resubmission
                            header("Location: " . $_SERVER['REQUEST_URI']);
                            ob_end_flush();
                            exit;
                        } catch (Exception $e) {
                            $ui->assign('_error', 'An unexpected error occurred. Please try again later.');
                            $ui->display('routers_set_password.tpl');
                            error_log("Error saving user password for user {$admin['username']}: " . $e->getMessage());
                            ob_end_flush();
                            exit;
                        }
                    } else {
                        // Passwords do not match
                        $ui->assign('_error', 'Passwords do not match. Please try again.');
                        $ui->display('routers_set_password.tpl');
                        ob_end_flush();
                        exit;
                    }
                }
            } else {
                // User already has a password set
                $ui->assign('_error', 'You already have a password set. Please use the login form.');
                $ui->display('routers_password_prompt.tpl');
                ob_end_flush();
                exit;
            }
        }
        // User is entering password
        elseif (isset($_POST['router_password'])) {
            $entered_password = _post('router_password');

            // Fetch stored password for the current user
            try {
                $setting_name = 'router_password_' . $admin['id'];
                $user_password_record = ORM::for_table('tbl_appconfig')
                    ->where('setting', $setting_name)
                    ->find_one();

                if ($user_password_record) {
                    $stored_password = $user_password_record->value;

                    if ($entered_password === $master_password || $entered_password === $stored_password) {
                        // Authentication successful
                        $cookie_expiry = time() + 300 * 60; // 30 minutes
                        setcookie($cookie_name, 'true', $cookie_expiry, "/", "", false, true);

                        // Log successful authentication
                        error_log("Router authentication successful for user {$admin['username']}.");

                        // Redirect to prevent form resubmission
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        ob_end_flush();
                        exit;
                    } else {
                        // Authentication failed
                        error_log("Router authentication failed for user {$admin['username']}. Entered password: {$entered_password}");

                        // Assign error and display prompt again
                        $ui->assign('_error', 'Invalid password. Please try again.');
                        $ui->display('routers_password_prompt.tpl');
                        ob_end_flush();
                        exit;
                    }
                } else {
                    // User hasn't set a password yet, prompt them to set one
                    $ui->display('routers_set_password.tpl');
                    ob_end_flush();
                    exit;
                }
            } catch (Exception $e) {
                $ui->assign('_error', 'An unexpected error occurred. Please try again later.');
                $ui->display('routers_password_prompt.tpl');
                error_log("Error fetching user password for user {$admin['username']}: " . $e->getMessage());
                ob_end_flush();
                exit;
            }
        }
        // Handling forgot password reset token
        elseif (isset($_POST['reset_token'])) {
            $reset_token = _post('reset_token');

            // For simplicity, assume any reset token is valid if it matches the master password
            if ($reset_token === $master_password) {
                // Delete the user's password entry
                $setting_name = 'router_password_' . $admin['id'];
                $user_password_record = ORM::for_table('tbl_appconfig')
                    ->where('setting', $setting_name)
                    ->find_one();

                if ($user_password_record) {
                    $user_password_record->delete();
                    error_log("Password reset for user {$admin['username']} via reset token.");

                    // Prompt user to set a new password
                    $ui->assign('_success', 'Your password has been reset. Please set a new password.');
                    $ui->display('routers_set_password.tpl');
                    ob_end_flush();
                    exit;
                } else {
                    $ui->assign('_error', 'No password found to reset.');
                    $ui->display('routers_set_password.tpl');
                    ob_end_flush();
                    exit;
                }
            } else {
                // Invalid reset token
                $ui->assign('_error', 'Invalid reset token. Please try again.');
                $ui->display('routers_forgot_password.tpl');
                ob_end_flush();
                exit;
            }
        }
        else {
            // No valid POST data, display password prompt
            $ui->display('routers_password_prompt.tpl');
            ob_end_flush();
            exit;
        }
    } else {
        // No password submitted yet, display the appropriate prompt
        // Check if the user has a stored password
        try {
            $setting_name = 'router_password_' . $admin['id'];
            $user_password_record = ORM::for_table('tbl_appconfig')
                ->where('setting', $setting_name)
                ->find_one();

            if ($user_password_record && $user_password_record->value) {
                // User has a stored password, display password prompt
                $ui->display('routers_password_prompt.tpl');
            } else {
                // User doesn't have a stored password, display set password form
                $ui->display('routers_set_password.tpl');
            }
            ob_end_flush();
            exit;
        } catch (Exception $e) {
            $ui->assign('_error', 'An unexpected error occurred. Please try again later.');
            $ui->display('routers_password_prompt.tpl');
            error_log("Error fetching user password for user {$admin['username']}: " . $e->getMessage());
            ob_end_flush();
            exit;
        }
    }
}

// If authenticated via cookie, proceed with the rest of the script

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'),'danger', "dashboard");
}

switch ($action) {
    case 'list':
        $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/routers.js"></script>');
        $name = _post('name');
        if ($name != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_routers'), ['name' => '%' . $name . '%'], $name);
            $routers = ORM::for_table('tbl_routers')
                ->table_alias('r')
                ->select('r.*')
                ->select('c.state', 'pingStatus')
                ->select('c.uptime')
                ->select('c.model')
                ->select('c.last_seen')
                ->left_outer_join('tbl_router_cache', array('r.id', '=', 'c.router_id'), 'c')
                ->where_like('r.name', '%' . $name . '%')
                ->offset($paginator['startpoint'])
                ->limit($paginator['limit'])
                ->order_by_desc('r.id')
                ->find_array();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_routers'));
            $routers = ORM::for_table('tbl_routers')
                ->table_alias('r')
                ->select('r.*')
                ->select('c.state', 'pingStatus')
                ->select('c.uptime')
                ->select('c.model')
                ->select('c.last_seen')
                ->left_outer_join('tbl_router_cache', array('r.id', '=', 'c.router_id'), 'c')
                ->offset($paginator['startpoint'])
                ->limit($paginator['limit'])
                ->order_by_desc('r.id')
                ->find_array();
        }

        foreach ($routers as &$router) {
            if ($router['pingStatus'] == 'Online') {
                $router['pingClass'] = 'success';
            } else {
                $router['pingClass'] = 'danger';
                if (!isset($router['uptime'])) {
                    $router['uptime'] = 'Error';
                }
                if (!isset($router['model'])) {
                    $router['model'] = 'Error';
                }
            }
            if (!isset($router['pingStatus'])) {
                $router['pingStatus'] = 'Offline';
                $router['pingClass'] = 'danger';
                $router['uptime'] = 'Error';
                $router['model'] = 'Error';
            }
        }

        $ui->assign('routers', $routers);
        $ui->assign('paginator', $paginator);
        run_hook('view_list_routers'); #HOOK
        $ui->display('routers.tpl');
        break;

        case 'history':
            // Retrieve router ID from the routes array
            $id = $routes[2];
        
            // Fetch the router from the database
            $router = ORM::for_table('tbl_routers')->find_one($id);
            if (!$router) {
                _alert(Lang::T('Router not found'), 'danger', "routers/list");
                break; // Ensure we break if the router is not found
            }
        
            // Fetch events to determine offline periods
            $events = ORM::for_table('tbl_router_status_history')
                ->where('router_id', $id)
                ->order_by_asc('timestamp') // Order by ascending timestamp to process events chronologically
                ->find_array();
        
            // Process events to calculate offline durations
            $offlineEvents = [];
            $prevEvent = null;
        
            foreach ($events as $event) {
                if ($event['event_type'] === 'Offline') {
                    // Capture the 'Offline' event as the start of an offline period
                    $prevEvent = $event;
                } elseif ($event['event_type'] === 'Online' && $prevEvent) {
                    // Pair with an 'Online' event to determine the offline duration
                    $offlineTime = strtotime($prevEvent['timestamp']);
                    $onlineTime = strtotime($event['timestamp']);
        
                    if ($onlineTime > $offlineTime) {
                        $duration = $onlineTime - $offlineTime;
        
                        // Format the duration into H:i:s
                        $hours = floor($duration / 3600);
                        $minutes = floor(($duration % 3600) / 60);
                        $seconds = $duration % 60;
        
                        $formatted_duration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
        
                        // Append to offline events list
                        $offlineEvents[] = [
                            'offline_timestamp' => $prevEvent['timestamp'],
                            'online_timestamp' => $event['timestamp'],
                            'duration' => $duration,
                            'formatted_duration' => $formatted_duration,
                        ];
                    }
        
                    // Reset $prevEvent to null after calculating the duration
                    $prevEvent = null;
                }
            }
        
            // Limit to the last 10 offline events
            $offlineEvents = array_slice(array_reverse($offlineEvents), 0, 10);
        
            // Assign variables to the template
            $ui->assign('router', $router);
            $ui->assign('offlineEvents', $offlineEvents);
        
            // Display the template
            $ui->display('router_history.tpl');
        
            break;
        
        
    
        case 'ping':
            $id = $routes['2'];
            $cache = ORM::for_table('tbl_router_cache')->where('router_id', $id)->find_one();
            if ($cache) {
                http_response_code(200);
                echo json_encode(['status' => $cache->state]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'Error']);
            }
            exit;
        
            case 'reboot':
                $id = $routes['2'];
                $router = ORM::for_table('tbl_routers')->find_one($id);
                if ($router) {
                    $result = Mikrotik::rebootRouter($router['ip_address'], $router['username'], $router['password']);
                    // Redirect back to the routers list page with a success message
                    r2(U . 'routers/list', 's', Lang::T('Router reboot initiated'));
                } else {
                    // Handle the case when the router is not found
                    // Redirect back to the routers list page with an error message
                    r2(U . 'routers/list', 'e', Lang::T('Router Not Found'));
                }
                break;
    case 'add':
        run_hook('view_add_routers'); #HOOK
        $ui->display('routers-add.tpl');
        break;

        case 'edit':
            $id  = $routes['2'];
            $d = ORM::for_table('tbl_routers')->find_one($id);
            if (!$d) {
                $d = ORM::for_table('tbl_routers')->where_equal('name', _get('name'))->find_one();
            }
            if ($d) {
                $ui->assign('d', $d);
                run_hook('view_router_edit'); #HOOK
                $ui->display('routers-edit.tpl');
            } else {
                r2(U . 'routers/list', 'e', Lang::T('Account Not Found'));
            }
            break;

            case 'delete':
                $id  = $routes['2'];
                run_hook('router_delete'); #HOOK
                $d = ORM::for_table('tbl_routers')->find_one($id);
                if ($d) {
                    // Serialize the data
                    $data = $d->as_array();
                    $serialized_data = json_encode($data);
            
                    // Insert into recycle bin
                    $recycle = ORM::for_table('tbl_recycle')->create();
                    $recycle->original_table = 'tbl_routers';
                    $recycle->original_id = $id;
                    $recycle->data = $serialized_data;
                    $recycle->deleted_by = $admin['id'];
                    $recycle->deleted_at = date('Y-m-d H:i:s');
                    $recycle->save();
            
                    // Delete the original record
                    $d->delete();
            
                    // Log and redirect
                    _log('[' . $admin['username'] . ']: Router ' . $d->name . ' moved to recycle bin', $admin['user_type'], $admin['id']);
                    r2(U . 'routers/list', 's', Lang::T('Router moved to recycle bin'));
                }
                break;
            
            

                case 'add-post':
                    $name = _post('name');
                    $ip_address = _post('ip_address');
                    $username = _post('username');
                    $password = _post('password');
                    $description = _post('description');
                    $enabled = _post('enabled');
                
                    $msg = '';
                    if (Validator::Length($name, 30, 4) == false) {
                        $msg .= 'Name should be between 5 to 30 characters' . '<br>';
                    }
                    if ($ip_address == '' || $username == '') {
                        $msg .= Lang::T('All fields are required') . '<br>';
                    }
                
                    // Check if IP address already exists
                    $d = ORM::for_table('tbl_routers')->where('ip_address', $ip_address)->find_one();
                    if ($d) {
                        $msg .= Lang::T('IP Router Already Exists') . '<br>';
                    }
                
                    // Check if name already exists
                    $existingRouter = ORM::for_table('tbl_routers')->where('name', $name)->find_one();
                    if ($existingRouter) {
                        $msg .= Lang::T('Router Name Already Exists') . '<br>';
                    }
                
                    // Check for reserved name
                    if (strtolower($name) == 'radius') {
                        $msg .= '<b>Radius</b> name is reserved<br>';
                    }
                
                    if ($msg == '') {
                        // Attempt to connect to Mikrotik
                        Mikrotik::getClient($ip_address, $username, $password);
                        run_hook('add_router'); #HOOK
                
                        // Create new router record
                        $d = ORM::for_table('tbl_routers')->create();
                        $d->name = $name;
                        $d->ip_address = $ip_address;
                        $d->username = $username;
                        $d->password = $password;
                        $d->description = $description;
                        $d->enabled = $enabled;
                        $d->save();
                
                        // Log successful creation
                        _log('[' . $admin['username'] . ']: Router ' . $d->name . ' created successfully', $admin['user_type'], $admin['id']);
                
                        r2(U . 'routers/list', 's', Lang::T('Data Created Successfully'));
                    } else {
                        // Redirect back with error message
                        r2(U . 'routers/add', 'e', $msg);
                    }
                    break;
                


            case 'wireless':
                $routers = ORM::for_table('tbl_routers')->find_many();
                $ui->assign('routers', $routers);
                $ui->assign('current_ssid', '');
                $ui->assign('selected_router', null);
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (_post('action') == 'select_router') {
                        $id = _post('router_id');
                        $router = ORM::for_table('tbl_routers')->find_one($id);
            
                        if ($router) {
                            try {
                                $client = Mikrotik::getClient($router['ip_address'], $router['username'], $router['password']);
                                $ssidRequest = new RouterOS\Request('/interface/wireless/print');
                                $ssidResponse = $client->sendSync($ssidRequest);
                                $ssid = $ssidResponse->getProperty('ssid');
            
                                $ui->assign('current_ssid', $ssid);
                                $ui->assign('selected_router', $router);
                            } catch (Exception $e) {
                                r2(U . 'routers/wireless', 'e', Lang::T('Error: ') . $e->getMessage());
                            }
                        }
                    } else {
                        $id = _post('router_id');
                        $ssid = _post('ssid');
                        $password = _post('password');
            
                        if ($ssid == '') {
                            r2(U . "routers/wireless/$id", 'e', Lang::T('SSID is required'));
                        }
            
                        $router = ORM::for_table('tbl_routers')->find_one($id);
                        if (!$router) {
                            r2(U . 'routers/list', 'e', Lang::T('Router Not Found'));
                        }
            
                        try {
                            $client = Mikrotik::getClient($router['ip_address'], $router['username'], $router['password']);
                            $ssidRequest = new RouterOS\Request('/interface/wireless/set');
                            $ssidRequest->setArgument('numbers', '0'); // Assuming '0' is the wireless interface index
                            $ssidRequest->setArgument('ssid', $ssid);
                            $client->sendSync($ssidRequest);
            
                            if ($password != '') {
                                $passwordRequest = new RouterOS\Request('/interface/wireless/security-profiles/set');
                                $passwordRequest->setArgument('numbers', 'default'); // Assuming 'default' is the security profile name
                                $passwordRequest->setArgument('wpa-pre-shared-key', $password);
                                $passwordRequest->setArgument('wpa2-pre-shared-key', $password);
                                $client->sendSync($passwordRequest);
                            }
            
                            r2(U . "routers/wireless/$id", 's', Lang::T('Wireless settings updated successfully'));
                        } catch (Exception $e) {
                            r2(U . "routers/wireless/$id", 'e', Lang::T('Error: ') . $e->getMessage());
                        }
                    }
                } else {
                    $id = $routes['2'];
                    if ($id) {
                        $router = ORM::for_table('tbl_routers')->find_one($id);
                        if ($router) {
                            try {
                                $client = Mikrotik::getClient($router['ip_address'], $router['username'], $router['password']);
                                $ssidRequest = new RouterOS\Request('/interface/wireless/print');
                                $ssidResponse = $client->sendSync($ssidRequest);
                                $ssid = $ssidResponse->getProperty('ssid');
            
                                $ui->assign('current_ssid', $ssid);
                                $ui->assign('selected_router', $router);
                            } catch (Exception $e) {
                                r2(U . 'routers/wireless', 'e', Lang::T('Error: ') . $e->getMessage());
                            }
                        }
                    }
                }
            
                $ui->display('routers-wireless.tpl');
                break;
            
            

            
    case 'edit-post':
        $name = _post('name');
        $ip_address = _post('ip_address');
        $username = _post('username');
        $password = _post('password');
        $description = _post('description');
        $enabled = $_POST['enabled'];
        $msg = '';
        if (Validator::Length($name, 30, 4) == false) {
            $msg .= 'Name should be between 5 to 30 characters' . '<br>';
        }
        if ($ip_address == '' or $username == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $id = _post('id');
        $d = ORM::for_table('tbl_routers')->find_one($id);
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }

        if ($d['name'] != $name) {
            $c = ORM::for_table('tbl_routers')->where('name', $name)->where_not_equal('id', $id)->find_one();
            if ($c) {
                $msg .= 'Name Already Exists<br>';
            }
        }
        $oldname = $d['name'];

        if ($d['ip_address'] != $ip_address) {
            $c = ORM::for_table('tbl_routers')->where('ip_address', $ip_address)->where_not_equal('id', $id)->find_one();
            if ($c) {
                $msg .= 'IP Already Exists<br>';
            }
        }

        if (strtolower($name) == 'radius') {
            $msg .= '<b>Radius</b> name is reserved<br>';
        }


        if ($msg == '') {
            Mikrotik::getClient($ip_address, $username, $password);
            run_hook('router_edit'); #HOOK
            $d->name = $name;
            $d->ip_address = $ip_address;
            $d->username = $username;
            $d->password = $password;
            $d->description = $description;
            $d->enabled = $enabled;
            $d->save();

            _log('[' . $admin['username'] . ']: Router ' . $d->name . ' edited successfully', $admin['user_type'], $admin['id']);
            if ($name != $oldname) {
                $p = ORM::for_table('tbl_plans')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
                $p = ORM::for_table('tbl_payment_gateway')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
                $p = ORM::for_table('tbl_pool')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
                $p = ORM::for_table('tbl_transactions')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
                $p = ORM::for_table('tbl_user_recharges')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
                $p = ORM::for_table('tbl_voucher')->where('routers', $oldname)->find_result_set();
                $p->set('routers', $name);
                $p->save();
            }
            r2(U . 'routers/list', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'routers/edit/' . $id, 'e', $msg);
        }
        break;

    default:
        r2(U . 'routers/list/', 's', '');
}
