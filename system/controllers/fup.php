<?php
// fup.php

// Include the PEAR2 Autoload file
require_once 'system/autoload/PEAR2/Autoload.php';
use PEAR2\Net\RouterOS;

_admin();
$ui->assign('_title', 'Daily Fair Usage Policy');
$ui->assign('_system_menu', 'services');

$action = $routes[1] ?? 'list';

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    r2(U . "dashboard", 'e', 'You do not have permission to access this page');
}
$plans = ORM::for_table('tbl_plans')->find_array();
$ui->assign('plans', $plans);
switch ($action) {
    case 'list':
        // Fetch FUP profiles
        $fupProfiles = ORM::for_table('tbl_fup')->order_by_desc('id')->find_many();
    
        // Fetch all routers for router name mapping
        $routers = ORM::for_table('tbl_routers')->find_array();
        $routerNames = [];
        foreach ($routers as $router) {
            $routerNames[$router['id']] = $router['name'];
        }
    
        // Fetch all plans for FUP mapping
        $plans = ORM::for_table('tbl_plans')->find_array();
        $fupPlans = [];
        $switchPlans = [];
        foreach ($plans as $plan) {
            if ($plan['fup_id']) {
                $fupPlans[$plan['fup_id']][] = $plan;
            }
            $switchPlans[$plan['id']] = $plan['name_plan'];
        }
    
        // Assign variables to the template
        $ui->assign('fupProfiles', $fupProfiles);
        $ui->assign('routerNames', $routerNames);
        $ui->assign('fupPlans', $fupPlans);
        $ui->assign('switchPlans', $switchPlans);
    
        // Render the list template
        $ui->display('fup-list.tpl');
        break;
    

        case 'add':
            // Fetch routers and assign to template
            $routers = ORM::for_table('tbl_routers')->find_array();
            $ui->assign('routers', $routers);
        
            // Fetch service types
            $service_types = ['Hotspot', 'PPPOE', 'Static'];
            $ui->assign('service_types', $service_types);
        
            // Fetch all plans
            $plans = ORM::for_table('tbl_plans')->find_array();
            $ui->assign('plans', $plans);
        
            // Display the form
            $ui->display('fup-add.tpl');
            break;
        
        
        
        
        
    
            case 'add-post':
                // Handle add form submission
                $name = _post('name');
                $data_limit = _post('data_limit');
                $data_limit_unit = _post('data_limit_unit');
                $service_type = _post('service_type');
                $router_name = _post('router_name');
                $profile_on_limit = _post('profile_on_limit'); // Plan to switch to (plan ID)
                $active = _post('active') ? 1 : 0;
                $plan_under_fup = _post('plan_under_fup'); // Single plan ID
            
                $msg = '';
            
                // Debugging
                file_put_contents('debug.log', "POST data: " . print_r($_POST, true) . PHP_EOL, FILE_APPEND);
            
                // Validation
                if (is_array($name)) {
                    $msg .= 'Name field has multiple values<br>';
                }
                if (Validator::Length($name, 50, 4) == false) {
                    $msg .= 'Name should be between 4 to 50 characters<br>';
                }
            
                $d = ORM::for_table('tbl_fup')->where('name', $name)->find_one();
                if ($d) {
                    $msg .= 'FUP Profile Name Already Exists<br>';
                }
            
                if (!$data_limit || !Validator::UnsignedNumber($data_limit)) {
                    $msg .= 'Data limit must be a number<br>';
                }
            
                if (!$service_type) {
                    $msg .= 'Service type is required<br>';
                }
            
                if (!$router_name) {
                    $msg .= 'Router is required<br>';
                }
            
                if (!$profile_on_limit || !Validator::UnsignedNumber($profile_on_limit)) {
                    $msg .= 'Plan to switch to is required and must be a valid plan<br>';
                }
            
                if (!$plan_under_fup || !Validator::UnsignedNumber($plan_under_fup)) {
                    $msg .= 'Plan under FUP is required and must be a valid plan<br>';
                }
            
                // Fetch router ID based on router name
                $router = ORM::for_table('tbl_routers')->where('name', $router_name)->find_one();
                if ($router) {
                    $router_id = $router->id;
                } else {
                    $msg .= 'Invalid Router selected<br>';
                }
            
                if ($msg == '') {
                    // Create FUP profile
                    $d = ORM::for_table('tbl_fup')->create();
                    $d->name = $name;
                    $d->data_limit = $data_limit;
                    $d->data_limit_unit = $data_limit_unit;
                    $d->service_type = $service_type;
                    $d->router_id = $router_id;
                    $d->profile_on_limit = $profile_on_limit; // Plan ID to switch to
                    $d->active = $active;
                    $d->save();
            
                    // Get the ID of the newly created FUP profile
                    $fup_id = $d->id;
            
                    // Update the selected plan to set the fup_id and fup_plan_id
                    $plan = ORM::for_table('tbl_plans')->find_one($plan_under_fup);
                    if ($plan) {
                        $plan->fup_id = $fup_id;
                        $plan->fup_plan_id = $profile_on_limit; // Plan ID to switch to
                        $plan->save();
                    }
            
                    r2(U . 'fup/list', 's', 'FUP Profile Created Successfully');
                } else {
                    r2(U . 'fup/add', 'e', $msg);
                }
                break;
            
            
        

                case 'edit':
                    // Show edit form
                    $id = $routes[2];
                    $d = ORM::for_table('tbl_fup')->find_one($id);
                    if ($d) {
                        // Fetch all routers
                        $routers = ORM::for_table('tbl_routers')->find_array();
                        $ui->assign('routers', $routers);
                
                        // Service types
                        $service_types = ['Hotspot', 'PPPOE', 'Static'];
                        $ui->assign('service_types', $service_types);
                
                        // Fetch plans under FUP
                        $plans = ORM::for_table('tbl_plans')->where('fup_id', $d->id)->find_array();
                        $ui->assign('plans', $plans);
                
                        // Fetch all available plans for the selected router
                        $allPlans = ORM::for_table('tbl_plans')->where('routers', $d->router_id)->find_array();
                        $ui->assign('allPlans', $allPlans);
                
                        // Assign FUP profile details
                        $ui->assign('d', $d);
                
                        $ui->display('fup-edit.tpl');
                    } else {
                        r2(U . 'fup/list', 'e', 'FUP Profile Not Found');
                    }
                    break;
                
                case 'edit-post':
                    // Handle edit form submission
                    $id = _post('id');
                    $name = _post('name');
                    $data_limit = _post('data_limit');
                    $data_limit_unit = _post('data_limit_unit');
                    $service_type = _post('service_type');
                    $router_id = _post('router_id');
                    $profile_on_limit = _post('profile_on_limit');
                    $selected_plan = _post('selected_plan'); // Plan under FUP
                    $active = _post('active') ? 1 : 0;
                
                    $msg = '';
                
                    $d = ORM::for_table('tbl_fup')->find_one($id);
                    if (!$d) {
                        $msg .= 'FUP Profile Not Found<br>';
                    }
                
                    if ($d['name'] != $name) {
                        $c = ORM::for_table('tbl_fup')->where('name', $name)->find_one();
                        if ($c) {
                            $msg .= 'FUP Profile Name Already Exists<br>';
                        }
                    }
                
                    if (Validator::Length($name, 50, 4) == false) {
                        $msg .= 'Name should be between 4 to 50 characters<br>';
                    }
                
                    if (!$data_limit || !Validator::UnsignedNumber($data_limit)) {
                        $msg .= 'Data limit must be a number<br>';
                    }
                
                    if (!$service_type) {
                        $msg .= 'Service type is required<br>';
                    }
                
                    if (!$router_id) {
                        $msg .= 'Router is required<br>';
                    }
                
                    if (!$profile_on_limit) {
                        $msg .= 'Plan to switch to is required<br>';
                    }
                
                    if ($msg == '') {
                        $d->name = $name;
                        $d->data_limit = $data_limit;
                        $d->data_limit_unit = $data_limit_unit;
                        $d->service_type = $service_type;
                        $d->router_id = $router_id;
                        $d->profile_on_limit = $profile_on_limit;
                        $d->active = $active;
                        $d->save();
                
                        // Update the plan under FUP
                        $plan = ORM::for_table('tbl_plans')->find_one($selected_plan);
                        if ($plan) {
                            $plan->fup_id = $id;
                            $plan->save();
                        }
                
                        r2(U . 'fup/list', 's', 'Data Updated Successfully');
                    } else {
                        r2(U . 'fup/edit/' . $id, 'e', $msg);
                    }
                    break;
                

    case 'delete':
        // Delete a FUP profile
        $id = $routes[2];
        $d = ORM::for_table('tbl_fup')->find_one($id);
        if ($d) {
            $d->delete();
            r2(U . 'fup/list', 's', 'Data Deleted Successfully');
        } else {
            r2(U . 'fup/list', 'e', 'FUP Profile Not Found');
        }
        break;

    default:
        $ui->display('a404.tpl');
        break;
}

// Function to get all profiles from Mikrotik routers
function getAllProfiles() {
    $profiles = [];
    try {
        $routers = ORM::for_table('tbl_routers')->find_many();
        foreach ($routers as $router) {
            $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password'], $router['port']);
            // Get PPPoE profiles
            $pppoeProfiles = $client->sendSync(new RouterOS\Request('/ppp/profile/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);
            foreach ($pppoeProfiles as $profile) {
                $profiles[] = [
                    'router_id' => $router->id,
                    'service_type' => 'PPPOE',
                    'name' => $profile->getProperty('name')
                ];
            }
            // Get Hotspot user profiles
            $hotspotProfiles = $client->sendSync(new RouterOS\Request('/ip/hotspot/user/profile/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);
            foreach ($hotspotProfiles as $profile) {
                $profiles[] = [
                    'router_id' => $router->id,
                    'service_type' => 'Hotspot',
                    'name' => $profile->getProperty('name')
                ];
            }
            // For Static users, implement accordingly (e.g., simple queues)
        }
    } catch (Exception $e) {
        error_log('Error fetching profiles: ' . $e->getMessage());
    }
    return $profiles;
}
