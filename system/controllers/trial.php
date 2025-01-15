<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/
_admin();
$ui->assign('_title', Lang::T('Trial'));
$ui->assign('_system_menu', 'trial');

$action = $routes['1'] ?? '';
$ui->assign('_admin', $admin);

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

// Fetch all routers to populate the dropdown for selecting a router
try {
    $routers = ORM::for_table('tbl_routers')->where('enabled', 1)->find_array();
    $ui->assign('routers', $routers);

} catch (Exception $e) {
 
}

use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Query;
use PEAR2\Net\RouterOS\Request;

require_once 'system/autoload/PEAR2/Autoload.php';

// Fetch hotspot plans if a router is selected
$routerId = _post('router_id') ?? null;

$hotspotPlans = [];

if ($routerId) {
    try {
        // Find the selected router details (fetching by router ID to get the router name)
        $selectedRouter = ORM::for_table('tbl_routers')->find_one($routerId);
        if ($selectedRouter) {
            $routerName = $selectedRouter->name; // Use the router name for matching
 
            
            // Fetch plans specific to the selected router name and type 'Hotspot'
            $hotspotPlans = ORM::for_table('tbl_plans')
                ->where('type', 'Hotspot')
                ->where('routers', $routerName)  // Matching by router name
                ->find_array();

            if (empty($hotspotPlans)) {
 
            }
        } else {
   
        }
    } catch (Exception $e) {

    }
} else {
 
}

$ui->assign('hotspotPlans', $hotspotPlans);

switch ($action) {
    case 'list':
        try {
            // Fetch all trials
            $trials = ORM::for_table('tbl_trials')->find_array();

    
            // Fetch all plans
            $plans = ORM::for_table('tbl_plans')->find_array();
 
    
            // Create a map of plan IDs to plan names
            $planMap = [];
            foreach ($plans as $plan) {
                $planMap[$plan['id']] = $plan['name_plan'];
            }
  
    
            // Add the plan name to each trial based on the plan_id
            foreach ($trials as &$trial) {
                $planId = $trial['plan_id'];
                $trial['plan_name'] = isset($planMap[$planId]) ? $planMap[$planId] : 'N/A'; // Assign plan name or 'N/A' if not found
    
            }
    
            $ui->assign('trials', $trials);
 
            $ui->display('trial.tpl');
 
        } catch (Exception $e) {

        }
        break;

        case 'fetch-plans':
            $routerId = _post('router_id');
            $plans = [];
    
            if ($routerId) {
                try {
                    // Fetch the router by ID to get the router name
                    $selectedRouter = ORM::for_table('tbl_routers')->find_one($routerId);
                    if ($selectedRouter) {
                        $routerName = $selectedRouter->name; // Get the router name
    
                        // Fetch plans where the routers field matches the router's name and type is 'Hotspot'
                        $plans = ORM::for_table('tbl_plans')
                            ->where('type', 'Hotspot')
                            ->where('routers', $routerName)  // Matching by router name
                            ->find_array();
                    }
                } catch (Exception $e) {
 
                }
            }
    
            header('Content-Type: application/json');
            echo json_encode(['plans' => $plans]);
            exit;
    

  
            case 'add':
                // Display the trial addition form
                $ui->display('trial_add.tpl');
                break;
        
                case 'add-post':
                    // Handle form submission for adding a trial
                    $trialName = _post('trial_name');
                    $planId = _post('plan_id');
                    $timeLimit = _post('time_limit'); // Uptime limit is always in minutes
                    $uptimeReset = _post('uptime_reset'); // Uptime reset is always in days
                    $routerId = _post('router_id'); // Assume router_id is sent via the form
                
                    // Validate input
                    $msg = '';
                    if ($trialName == '' || $planId == '' || $timeLimit == '' || $uptimeReset == '' || $routerId == '') {
                        $msg .= Lang::T('All fields are required') . '<br>';
                    }
                
                    if (Validator::UnsignedNumber($timeLimit) == false) {
                        $msg .= Lang::T('The trial uptime limit must be a valid number in minutes') . '<br>';
                    }
                
                    if (Validator::UnsignedNumber($uptimeReset) == false) {
                        $msg .= Lang::T('The trial uptime reset must be a valid number in days') . '<br>';
                    }
                
                    if ($msg == '') {
                        try {
                            // Check if the selected plan exists
                            $selectedPlan = ORM::for_table('tbl_plans')->find_one($planId);
                
                            if ($selectedPlan) {
                                // Extract the name_plan field to be used as the trial user profile
                                $trialUserProfile = trim($selectedPlan->name_plan);
                
                                // Create a new trial entry in the database
                                $trial = ORM::for_table('tbl_trials')->create();
                                $trial->name = $trialName;
                                $trial->plan_id = $planId;
                                $trial->time_limit = $timeLimit; // Always in minutes
                                $trial->uptime_reset = $uptimeReset; // Always in days
                                try {
                                    $trial->save();

                                } catch (Exception $e) {

                                    r2(U . 'trial/add', 'e', Lang::T('Error creating trial. Please check logs.'));
                                    break;
                                }
                
                                // Fetch router details
                                $router = ORM::for_table('tbl_routers')->find_one($routerId);
                
                                if ($router) {
                                    $routerIp = $router->ip_address;
                                    $routerUsername = $router->username;
                                    $routerPassword = $router->password;
                
                                    // Connect to MikroTik Router
                                    try {
                                        $client = new RouterOS\Client($routerIp, $routerUsername, $routerPassword);
                
                                        // Step 1: Set the login method to include trial
                                        $setLoginMethodRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setLoginMethodRequest->setArgument('numbers', 'hsprof1');
                                        $setLoginMethodRequest->setArgument('login-by', 'http-pap,mac-cookie,cookie,trial');
                                        $client->sendSync($setLoginMethodRequest);
                
                                        // Step 2: Set the trial uptime limit (always in minutes)
                                        $setTrialUptimeLimitRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUptimeLimitRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUptimeLimitRequest->setArgument('trial-uptime-limit', $timeLimit . 'm'); // Fixed as minutes
                                        $client->sendSync($setTrialUptimeLimitRequest);
                
                                        // Step 3: Set the trial uptime reset (always in days)
                                        $setTrialUptimeResetRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUptimeResetRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUptimeResetRequest->setArgument('trial-uptime-reset', $uptimeReset . 'd'); // Fixed as days
                                        $client->sendSync($setTrialUptimeResetRequest);
                
                                        // Step 4: Set the trial user profile from the `name_plan`
                                        $setTrialUserProfileRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUserProfileRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUserProfileRequest->setArgument('trial-user-profile', $trialUserProfile);
                                        $client->sendSync($setTrialUserProfileRequest);
                
                                        // Redirect to the trial list with a success message
                                        r2(U . 'trial/list', 's', Lang::T('Trial Created Successfully'));
                
                                    } catch (Exception $e) {
                                        // Handle router connection errors
               
                                        r2(U . 'trial/add', 'e', Lang::T('Error connecting to router. Please check logs.'));
                                    }
                
                                } else {
                                    // Handle case where router is not found
                         
                                    r2(U . 'trial/add', 'e', Lang::T('Router Not Found'));
                                }
                
                            } else {
                                // Handle case where the selected plan is not found
                 
                                r2(U . 'trial/add', 'e', Lang::T('Selected Plan Not Found'));
                            }
                        } catch (Exception $e) {
                            // Handle general errors
                   
                            r2(U . 'trial/add', 'e', Lang::T('Error creating trial. Please check logs.'));
                        }
                    } else {
                        // Redirect with validation errors
                        r2(U . 'trial/add', 'e', $msg);
                    }
                    break;
                
       
            

































        case 'edit':
            // Handle the edit form display
            $id = $routes['2'];
            $trial = ORM::for_table('tbl_trials')->find_one($id);
    
            if ($trial) {
                // Fetch all hotspot plans
                $hotspotPlans = ORM::for_table('tbl_plans')->where('type', 'Hotspot')->find_array();
                $ui->assign('hotspotPlans', $hotspotPlans);
                $ui->assign('trial', $trial);
                $ui->display('trial_edit.tpl');

            } else {

                r2(U . 'trial/list', 'e', Lang::T('Trial Not Found'));
            }
            break;
    
            case 'edit-post':
                // Handle form submission for editing a trial
                $id = _post('id');
                $trial = ORM::for_table('tbl_trials')->find_one($id);
            
                if ($trial) {
                    $trialName = _post('trial_name');
                    $planId = _post('plan_id');
                    $timeLimit = _post('time_limit'); // Uptime limit is always in minutes
                    $uptimeReset = _post('uptime_reset'); // Uptime reset is always in days
                    $routerId = _post('router_id'); // Assume router_id is sent via the form
            
                    // Validate input
                    $msg = '';
                    if ($trialName == '' || $planId == '' || $timeLimit == '' || $uptimeReset == '') {
                        $msg .= Lang::T('All fields are required') . '<br>';
                    }
            
                    if (Validator::UnsignedNumber($timeLimit) == false) {
                        $msg .= Lang::T('The trial uptime limit must be a valid number in minutes') . '<br>';
                    }
            
                    if (Validator::UnsignedNumber($uptimeReset) == false) {
                        $msg .= Lang::T('The trial uptime reset must be a valid number in days') . '<br>';
                    }
            
                    if ($msg == '') {
                        try {
                            // Update the trial entry in the database
                            $trial->name = $trialName;
                            $trial->plan_id = $planId;
                            $trial->time_limit = $timeLimit; // Always in minutes
                            $trial->uptime_reset = $uptimeReset; // Always in days
                            $trial->save();
            
                            // Fetch the selected plan to get the name_plan
                            $selectedPlan = ORM::for_table('tbl_plans')->find_one($planId);
            
                            if ($selectedPlan) {
                                // Extract the name_plan field to be used as the trial user profile
                                $trialUserProfile = trim($selectedPlan->name_plan);
            
                                // Fetch router details
                                $router = ORM::for_table('tbl_routers')->find_one($routerId);
            
                                if ($router) {
                                    $routerIp = $router->ip_address;
                                    $routerUsername = $router->username;
                                    $routerPassword = $router->password;
            
                                    // Connect to MikroTik Router
                                    try {
                                        $client = new RouterOS\Client($routerIp, $routerUsername, $routerPassword);
            
                                        // Update the login method to include trial
                                        $setLoginMethodRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setLoginMethodRequest->setArgument('numbers', 'hsprof1');
                                        $setLoginMethodRequest->setArgument('login-by', 'http-pap,mac-cookie,cookie,trial');
                                        $client->sendSync($setLoginMethodRequest);
            
                                        // Update the trial uptime limit (always in minutes)
                                        $setTrialUptimeLimitRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUptimeLimitRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUptimeLimitRequest->setArgument('trial-uptime-limit', $timeLimit . 'm'); // Fixed as minutes
                                        $client->sendSync($setTrialUptimeLimitRequest);
            
                                        // Update the trial uptime reset (always in days)
                                        $setTrialUptimeResetRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUptimeResetRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUptimeResetRequest->setArgument('trial-uptime-reset', $uptimeReset . 'd'); // Fixed as days
                                        $client->sendSync($setTrialUptimeResetRequest);
            
                                        // Update the trial user profile
                                        $setTrialUserProfileRequest = new RouterOS\Request('/ip/hotspot/profile/set');
                                        $setTrialUserProfileRequest->setArgument('numbers', 'hsprof1');
                                        $setTrialUserProfileRequest->setArgument('trial-user-profile', $trialUserProfile);
                                        $client->sendSync($setTrialUserProfileRequest);
            
                                        r2(U . 'trial/list', 's', Lang::T('Trial Updated Successfully'));
            
                                    } catch (Exception $e) {
                                        r2(U . 'trial/edit/' . $id, 'e', Lang::T('Error connecting to router. Please check logs.'));
                                    }
            
                                } else {
                                    r2(U . 'trial/edit/' . $id, 'e', Lang::T('Router Not Found'));
                                }
            
                            } else {
                                r2(U . 'trial/edit/' . $id, 'e', Lang::T('Selected Plan Not Found'));
                            }
                        } catch (Exception $e) {
                            r2(U . 'trial/edit/' . $id, 'e', Lang::T('Error updating trial. Please check logs.'));
                        }
                    } else {
                        r2(U . 'trial/edit/' . $id, 'e', $msg);
                    }
                } else {
                    r2(U . 'trial/list', 'e', Lang::T('Trial Not Found'));
                }
                break;
            
            
}
?>
