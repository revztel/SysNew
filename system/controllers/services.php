<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);


/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/
_admin();
$ui->assign('_title', Lang::T('Hotspot Plans'));
$ui->assign('_system_menu', 'services');

$action = $routes['1'];
//$admin = Admin::_info();
$ui->assign('_admin', $admin);

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'),'danger', "dashboard");
}
// Fetch routers to populate the dropdown for syncing, assign to $routerssync
$routers = ORM::for_table('tbl_routers')->where('enabled', 1)->find_array();
$ui->assign('routers', $routers);
// Fetch routers to populate the dropdown for syncing
$routerssync = ORM::for_table('tbl_routers')->where('enabled', 1)->find_array();
$ui->assign('routerssync', $routerssync); // Assign routers to the template


// Fetch all enabled Hotspot plans to display in the table
$plans = ORM::for_table('tbl_bandwidth')
            ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
            ->where('tbl_plans.type', 'Hotspot')
            ->where('tbl_plans.enabled', '1')
            ->find_array();
$ui->assign('d', $plans); // Assign plans to the template
use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

// Get the action and router ID from the request
$action = $routes['1'] ?? '';
$routerId = $_POST['router'] ?? null;

switch ($action) {
    case 'sync':
        set_time_limit(-1);
        if ($routes['2'] == 'hotspot') {
            // Retrieve all enabled Hotspot plans from the database
            $plans = ORM::for_table('tbl_bandwidth')
                        ->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))
                        ->where('tbl_plans.type', 'Hotspot')
                        ->where('tbl_plans.enabled', '1')
                        ->find_many();
            $log = '';
            $router = '';
        
            // Iterate through each plan
            foreach ($plans as $plan) {
                // Check if the plan uses RADIUS for authentication and bandwidth management
                if ($plan['is_radius']) {
                    // Convert the bandwidth rates to the appropriate format for RADIUS
                    $raddown = $plan['rate_down_unit'] == 'Kbps' ? '000' : '000000';
                    $radup = $plan['rate_up_unit'] == 'Kbps' ? '000' : '000000';
                    $radiusRate = $plan['rate_up'] . $radup . '/' . $plan['rate_down'] . $raddown;
        
                    // Update or insert the plan into the RADIUS server
                    Radius::planUpSert($plan['id'], $radiusRate);
                    $log .= "DONE : Radius $plan[name_plan], $plan[shared_users], $radiusRate<br>";
                } else {
                    // Establish a new router connection if the current router is different
                    if ($router != $plan['routers']) {
                        $mikrotik = Mikrotik::info($plan['routers']);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        $router = $plan['routers'];
                    }
        
                    // Determine the units for the bandwidth
                    $unitdown = $plan['rate_down_unit'] == 'Kbps' ? 'k' : 'M';
                    $unitup = $plan['rate_up_unit'] == 'Kbps' ? 'k' : 'M';
                    $rate = $plan['rate_up'] . $unitup . "/" . $plan['rate_down'] . $unitdown;
        
                    // Check if all burst fields are provided and not zero
                    if (!empty($plan['burst_limit_up']) && !empty($plan['burst_limit_down']) &&
                        !empty($plan['burst_threshold_up']) && !empty($plan['burst_threshold_down']) &&
                        !empty($plan['burst_time'])) {
                        // Construct the burst settings string
                        $burst_limit = $plan['burst_limit_up'] . ($plan['burst_limit_up_unit'] == 'Kbps' ? 'k' : 'M') .
                                        "/" . $plan['burst_limit_down'] . ($plan['burst_limit_down_unit'] == 'Kbps' ? 'k' : 'M');
                        $burst_threshold = $plan['burst_threshold_up'] . ($plan['burst_threshold_up_unit'] == 'Kbps' ? 'k' : 'M') .
                                            "/" . $plan['burst_threshold_down'] . ($plan['burst_threshold_down_unit'] == 'Kbps' ? 'k' : 'M');
                        $burst_time = $plan['burst_time'];
        
                        // Append burst settings to the rate limit string
                        $rate .= " " . $burst_limit . " " . $burst_threshold . " " . $burst_time . "/" . $burst_time;
                    }
        
                    // Send the rate limit settings to the MikroTik router
                    Mikrotik::addHotspotPlan($client, $plan['name_plan'], $plan['shared_users'], $rate);
                    $log .= "DONE : $plan[name_plan], $plan[shared_users], $rate<br>";
        
                    // Set the expired pool if applicable
                    if (!empty($plan['pool_expired'])) {
                        Mikrotik::setHotspotExpiredPlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired']);
                        $log .= "DONE Expired: EXPIRED FREEISPRADIUS $plan[pool_expired]<br>";
                    }
                }
            }
        
            // Redirect to the Hotspot services page with a success message and log
            r2(U . 'services/hotspot', 's', $log);
        }
        

        else if ($routes['2'] == 'pppoe') {
            // Retrieve all enabled PPPoE plans from the database
            $plans = ORM::for_table('tbl_bandwidth')
                        ->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))
                        ->where('tbl_plans.type', 'PPPOE')
                        ->where('tbl_plans.enabled', '1')
                        ->find_many();
            $log = '';
            $router = '';
        
            // Iterate through each plan
            foreach ($plans as $plan) {
                // Check if the plan uses RADIUS for authentication and bandwidth management
                if ($plan['is_radius']) {
                    // Convert the bandwidth rates to the appropriate format for RADIUS
                    $raddown = $plan['rate_down_unit'] == 'Kbps' ? '000' : '000000';
                    $radup = $plan['rate_up_unit'] == 'Kbps' ? '000' : '000000';
                    $radiusRate = $plan['rate_up'] . $radup . '/' . $plan['rate_down'] . $raddown;
        
                    // Update or insert the plan into the RADIUS server
                    Radius::planUpSert($plan['id'], $radiusRate, $plan['pool']);
                    $log .= "DONE : RADIUS $plan[name_plan], $plan[pool], $radiusRate<br>";
                } else {
                    // Establish a new router connection if the current router is different
                    if ($router != $plan['routers']) {
                        $mikrotik = Mikrotik::info($plan['routers']);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        $router = $plan['routers'];
                    }
        
                    // Determine the units for the bandwidth
                    $unitdown = $plan['rate_down_unit'] == 'Kbps' ? 'k' : 'M';
                    $unitup = $plan['rate_up_unit'] == 'Kbps' ? 'k' : 'M';
                    $rate = $plan['rate_up'] . $unitup . "/" . $plan['rate_down'] . $unitdown;
        
                    // Check if all burst fields are provided and not zero
                    if (!empty($plan['burst_limit_up']) && !empty($plan['burst_limit_down']) &&
                        !empty($plan['burst_threshold_up']) && !empty($plan['burst_threshold_down']) &&
                        !empty($plan['burst_time'])) {
                        // Construct the burst settings string
                        $burst_limit = $plan['burst_limit_up'] . ($plan['burst_limit_up_unit'] == 'Kbps' ? 'k' : 'M') .
                                        "/" . $plan['burst_limit_down'] . ($plan['burst_limit_down_unit'] == 'Kbps' ? 'k' : 'M');
                        $burst_threshold = $plan['burst_threshold_up'] . ($plan['burst_threshold_up_unit'] == 'Kbps' ? 'k' : 'M') .
                                            "/" . $plan['burst_threshold_down'] . ($plan['burst_threshold_down_unit'] == 'Kbps' ? 'k' : 'M');
                        $burst_time = $plan['burst_time'];
        
                        // Append burst settings to the rate limit string
                        $rate .= "/" . $burst_limit . "/" . $burst_threshold . "/" . $burst_time . "/" . $burst_time;
                    }
        
                    // Send the rate limit settings to the MikroTik router
                    Mikrotik::addPpoePlan($client, $plan['name_plan'], $plan['pool'], $rate);
                    $log .= "DONE : $plan[name_plan], $plan[pool], $rate<br>";
        
                    // Set the expired pool if applicable
                    if (!empty($plan['pool_expired'])) {
                        Mikrotik::setPpoePlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired'], '1K/1K');
                        $log .= "DONE Expired : EXPIRED FREEISPRADIUS $plan[pool_expired]<br>";
                    }
                }
            }
        
            // Redirect to the PPPoE services page with a success message and log
            r2(U . 'services/pppoe', 's', $log);
        }
        


    else if ($routes['2'] == 'static') {
        $plans = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'static')->where('tbl_plans.enabled', '1')->find_many();
        $log = '';
        $router = '';
        foreach ($plans as $plan) {
            if ($plan['is_radius']) {
                if ($b['rate_down_unit'] == 'Kbps') {
                    $raddown = '000';
                } else {
                    $raddown = '000000';
                }
                if ($b['rate_up_unit'] == 'Kbps') {
                    $radup = '000';
                } else {
                    $radup = '000000';
                }
                $radiusRate = $plan['rate_up'] . $radup . '/' . $plan['rate_down'] . $raddown;
                Radius::planUpSert($plan['id'], $radiusRate, $plan['pool']);
                $log .= "DONE : RADIUS $plan[name_plan], $plan[pool], $rate<br>";
            } else {
                if ($router != $plan['routers']) {
                    $mikrotik = Mikrotik::info($plan['routers']);
                    $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                    $router = $plan['routers'];
                }
                if ($plan['rate_down_unit'] == 'Kbps') {
                    $unitdown = 'K';
                } else {
                    $unitdown = 'M';
                }
                if ($plan['rate_up_unit'] == 'Kbps') {
                    $unitup = 'K';
                } else {
                    $unitup = 'M';
                }



// Your existing code to construct the basic rate limit string
$rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;

// Append burst limit parameters if they are set and not zero
if (!empty($b['burst_limit_for_upload']) && !empty($b['burst_limit_for_download'])) {
    $burstLimitUpload = $b['burst_limit_for_upload'] . $unitup;
    $burstLimitDownload = $b['burst_limit_for_download'] . $unitdown;
    $rate .= " $burstLimitUpload/$burstLimitDownload";
}

// Append burst threshold parameters if they are set and not zero
if (!empty($b['burst_threshold_for_upload']) && !empty($b['burst_threshold_for_download'])) {
    $burstThresholdUpload = $b['burst_threshold_for_upload'] . $unitup;
    $burstThresholdDownload = $b['burst_threshold_for_download'] . $unitdown;
    $rate .= " $burstThresholdUpload/$burstThresholdDownload";
}

// Append burst time parameters if they are set and not zero
if (!empty($b['burst_time_for_upload']) && !empty($b['burst_time_for_download'])) {
    $burstTimeUpload = $b['burst_time_for_upload'];
    $burstTimeDownload = $b['burst_time_for_download'];
    $rate .= " $burstTimeUpload/$burstTimeDownload";
}

// Now $rate contains the full rate limit string, including burst settings if applicable
// Continue with the code that sends this rate limit to MikroTik

                Mikrotik::addStaticPlan($client, $plan['name_plan'], $plan['pool'], $rate);
                $log .= "DONE : $plan[name_plan], $plan[pool], $rate<br>";
                if (!empty($plan['pool_expired'])) {
                    Mikrotik::setStaticPlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired'], '1K/1K');
                    $log .= "DONE Expired : EXPIRED FREEISPRADIUS $plan[pool_expired]<br>";
                }
            }
        }

        r2(U . 'services/static', 's', $log);
            break;
        }















        case 'sync-static':
         
            $routerId = _post('router') ?? null; // Fetch the router ID from the POST data
            if (!$routerId) {
               
                r2(U . 'services/static', 'e', Lang::T('Router ID not provided.'));
                break;
            }
        
            // Fetch router details from the database
            $router = ORM::for_table('tbl_routers')->find_one($routerId);
            if (!$router) {
              
                r2(U . 'services/static', 'e', Lang::T('Router not found.'));
                break;
            }
        
         
            // Retrieve all enabled Static IP plans for the selected router
            $plans = ORM::for_table('tbl_bandwidth')
                        ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
                        ->where('tbl_plans.type', 'static')
                        ->where('tbl_plans.enabled', '1')
                        ->where('tbl_plans.routers', $router->name) // Match router by name
                        ->find_many();
        
            if (empty($plans)) {
        
                r2(U . 'services/static', 'e', Lang::T('No Static IP plans found for this router.'));
                break;
            }
        
            $log = '';
            try {
                // Establish a connection to the router
           
                $client = new RouterOS\Client($router->ip_address, $router->username, $router->password);
 
                // Iterate through each Static IP plan and sync
                foreach ($plans as $plan) {
        
        
                    // Determine bandwidth rate format for MikroTik
                    $unitdown = ($plan['rate_down_unit'] == 'Kbps') ? 'k' : 'M';
                    $unitup = ($plan['rate_up_unit'] == 'Kbps') ? 'k' : 'M';
                    $rate = "{$plan['rate_up']}{$unitup}/{$plan['rate_down']}{$unitdown}";
        
                    // Include burst settings if applicable
                    if (!empty($plan['burst_limit_for_upload']) && !empty($plan['burst_limit_for_download'])) {
                        $burstLimitUpload = "{$plan['burst_limit_for_upload']}{$unitup}";
                        $burstLimitDownload = "{$plan['burst_limit_for_download']}{$unitdown}";
                        $rate .= " {$burstLimitUpload}/{$burstLimitDownload}";
                    }
        
                    if (!empty($plan['burst_threshold_for_upload']) && !empty($plan['burst_threshold_for_download'])) {
                        $burstThresholdUpload = "{$plan['burst_threshold_for_upload']}{$unitup}";
                        $burstThresholdDownload = "{$plan['burst_threshold_for_download']}{$unitdown}";
                        $rate .= " {$burstThresholdUpload}/{$burstThresholdDownload}";
                    }
        
                    if (!empty($plan['burst_time_for_upload']) && !empty($plan['burst_time_for_download'])) {
                        $burstTimeUpload = "{$plan['burst_time_for_upload']}";
                        $burstTimeDownload = "{$plan['burst_time_for_download']}";
                        $rate .= " {$burstTimeUpload}/{$burstTimeDownload}";
                    }
        
                    // Add the Static IP plan to the router
                    Mikrotik::addStaticPlan($client, $plan['name_plan'], $plan['pool'], $rate);
                    $log .= "DONE: {$plan['name_plan']}, {$plan['pool']}, {$rate}<br>";
        
                    // Set expired pool if applicable
                    if (!empty($plan['pool_expired'])) {
                        Mikrotik::setStaticPlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired'], '1K/1K');
                        $log .= "DONE Expired: EXPIRED FREEISPRADIUS {$plan['pool_expired']}<br>";
                    }
                }
        
                // Redirect to the Static IP services page with success log
                r2(U . 'services/static', 's', $log);
        
            } catch (Exception $e) {

                r2(U . 'services/static', 'e', Lang::T('Failed to connect to router. Check router credentials and network settings.'));
            }
            break;
        



        case 'sync-pppoe':

            $routerId = _post('router') ?? null; // Fetch the router ID from the POST data
            if (!$routerId) {
           
                r2(U . 'services/pppoe', 'e', Lang::T('Router ID not provided.'));
                break;
            }
        
            // Fetch router details from the database
            $router = ORM::for_table('tbl_routers')->find_one($routerId);
            if (!$router) {
          
                r2(U . 'services/pppoe', 'e', Lang::T('Router not found.'));
                break;
            }
        
     
        
            // Retrieve all enabled PPPoE plans for the selected router
            $plans = ORM::for_table('tbl_bandwidth')
                        ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
                        ->where('tbl_plans.type', 'PPPOE')
                        ->where('tbl_plans.enabled', '1')
                        ->where('tbl_plans.routers', $router->name) // Match router by name
                        ->find_many();
        
            if (empty($plans)) {

                r2(U . 'services/pppoe', 'e', Lang::T('No PPPoE plans found for this router.'));
                break;
            }
        
            $log = '';
            try {
                // Establish a connection to the router
 
                $client = new RouterOS\Client($router->ip_address, $router->username, $router->password);
 
        
                // Iterate through each PPPoE plan and sync
                foreach ($plans as $plan) {
 
                    // Determine bandwidth rate format for MikroTik
                    $unitdown = ($plan['rate_down_unit'] == 'Kbps') ? 'k' : 'M';
                    $unitup = ($plan['rate_up_unit'] == 'Kbps') ? 'k' : 'M';
                    $rate = "{$plan['rate_up']}{$unitup}/{$plan['rate_down']}{$unitdown}";
        
                    // Include burst settings if applicable
                    if (!empty($plan['burst_limit_up']) && !empty($plan['burst_limit_down']) &&
                        !empty($plan['burst_threshold_up']) && !empty($plan['burst_threshold_down']) &&
                        !empty($plan['burst_time'])) {
                        $burst_limit = "{$plan['burst_limit_up']}{$unitup}/{$plan['burst_limit_down']}{$unitdown}";
                        $burst_threshold = "{$plan['burst_threshold_up']}{$unitup}/{$plan['burst_threshold_down']}{$unitdown}";
                        $burst_time = $plan['burst_time'];
                        $rate .= "/{$burst_limit}/{$burst_threshold}/{$burst_time}/{$burst_time}";
                    }
        
                    // Add the PPPoE plan to the router
                    Mikrotik::addPpoePlan($client, $plan['name_plan'], $plan['pool'], $rate);
                    $log .= "DONE: {$plan['name_plan']}, {$plan['pool']}, {$rate}<br>";
        
                    // Set expired pool if applicable
                    if (!empty($plan['pool_expired'])) {
                        Mikrotik::setPpoePlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired'], '1K/1K');
                        $log .= "DONE Expired: EXPIRED FREEISPRADIUS {$plan['pool_expired']}<br>";
                    }
                }
        
                // Redirect to the PPPoE services page with success log
                r2(U . 'services/pppoe', 's', $log);
        
            } catch (Exception $e) {

                r2(U . 'services/pppoe', 'e', Lang::T('Failed to connect to router. Check router credentials and network settings.'));
            }
            break;
        



















        case 'sync-hotspot':

    
            if (!$routerId) {
 
                r2(U . 'services/hotspot', 'e', Lang::T('Router ID not provided.'));
                break;
            }
    
            // Fetch router details from the database
            $router = ORM::for_table('tbl_routers')->find_one($routerId);
            if (!$router) {
  
                r2(U . 'services/hotspot', 'e', Lang::T('Router not found.'));
                break;
            }
    
 
    
            // Retrieve all enabled Hotspot plans for the selected router
            $plans = ORM::for_table('tbl_bandwidth')
                        ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
                        ->where('tbl_plans.type', 'Hotspot')
                        ->where('tbl_plans.enabled', '1')
                        ->where('tbl_plans.routers', $router->name) // Match router by name
                        ->find_many();
    
            if (empty($plans)) {
 
                r2(U . 'services/hotspot', 'e', Lang::T('No hotspot plans found for this router.'));
                break;
            }
    
            $log = '';
            try {
                // Establish a connection to the router
 
                $client = new RouterOS\Client($router->ip_address, $router->username, $router->password);

    
                // Iterate through each hotspot plan and sync
                foreach ($plans as $plan) {

    
                    // Determine bandwidth rate format for MikroTik
                    $unitdown = ($plan['rate_down_unit'] == 'Kbps') ? 'k' : 'M';
                    $unitup = ($plan['rate_up_unit'] == 'Kbps') ? 'k' : 'M';
                    $rate = "{$plan['rate_up']}{$unitup}/{$plan['rate_down']}{$unitdown}";
    
                    // Include burst settings if applicable
                    if (!empty($plan['burst_limit_up']) && !empty($plan['burst_limit_down']) &&
                        !empty($plan['burst_threshold_up']) && !empty($plan['burst_threshold_down']) &&
                        !empty($plan['burst_time'])) {
                        $burst_limit = "{$plan['burst_limit_up']}{$unitup}/{$plan['burst_limit_down']}{$unitdown}";
                        $burst_threshold = "{$plan['burst_threshold_up']}{$unitup}/{$plan['burst_threshold_down']}{$unitdown}";
                        $burst_time = $plan['burst_time'];
                        $rate .= " $burst_limit $burst_threshold $burst_time/$burst_time";
                    }
    
                    // Add the hotspot plan to the router
                    Mikrotik::addHotspotPlan($client, $plan['name_plan'], $plan['shared_users'], $rate);
                    $log .= "DONE: {$plan['name_plan']}, {$plan['shared_users']}, {$rate}<br>";
    
                    // Set expired pool if applicable
                    if (!empty($plan['pool_expired'])) {
                        Mikrotik::setHotspotExpiredPlan($client, 'EXPIRED FREEISPRADIUS ' . $plan['pool_expired'], $plan['pool_expired']);
                        $log .= "DONE Expired: EXPIRED FREEISPRADIUS {$plan['pool_expired']}<br>";
                    }
                }
    
                // Redirect to the hotspot services page with success log
                r2(U . 'services/hotspot', 's', $log);
    
            } catch (Exception $e) {
 
                r2(U . 'services/hotspot', 'e', Lang::T('Failed to connect to router. Check router credentials and network settings.'));
            }
            break;
 
    
   
        
        
















    case 'hotspot':
        $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/hotspot.js"></script>');

        $name = _post('name');
        if ($name != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['name_plan' => '%' . $name . '%', 'type' => 'Hotspot'], $name);
            $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'Hotspot')->where_like('tbl_plans.name_plan', '%' . $name . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['type' => 'Hotspot']);
            $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'Hotspot')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        }

        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        run_hook('view_list_plans'); #HOOK
        $ui->display('hotspot.tpl');
        break;

    case 'add':
        $d = ORM::for_table('tbl_bandwidth')->find_many();
        $ui->assign('d', $d);
        $r = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('r', $r);
        run_hook('view_add_plan'); #HOOK
        $ui->display('hotspot-add.tpl');
        break;

    case 'edit':
        $id  = $routes['2'];
        $d = ORM::for_table('tbl_plans')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            $p = ORM::for_table('tbl_pool')->where('routers', $d['routers'])->find_many();
            $ui->assign('p', $p);
            $b = ORM::for_table('tbl_bandwidth')->find_many();
            $ui->assign('b', $b);
            run_hook('view_edit_plan'); #HOOK
            $ui->display('hotspot-edit.tpl');
        } else {
            r2(U . 'services/hotspot', 'e', Lang::T('Account Not Found'));
        }
        break;

        case 'delete':
            $id  = $routes['2'];
        
            $d = ORM::for_table('tbl_plans')->find_one($id);
            if ($d) {
                run_hook('delete_plan'); #HOOK
        
                // Store the deleted record in the recycle bin (tbl_recycle)
                try {
                    $recycleEntry = ORM::for_table('tbl_recycle')->create();
                    $recycleEntry->original_table = 'tbl_plans'; // Specify the original table
                    $recycleEntry->original_id = $id; // The original ID in tbl_plans
                    $recycleEntry->data = json_encode($d->as_array()); // Store the data as JSON
                    $recycleEntry->deleted_by = $admin['id']; // Store who deleted the record
                    $recycleEntry->deleted_at = date('Y-m-d H:i:s'); // Store when it was deleted
                    $recycleEntry->save();
                } catch (Exception $e) {
                    _alert(Lang::T('Failed to move record to recycle bin'), 'danger', 'services/hotspot');
                    error_log('Error storing record in recycle bin: ' . $e->getMessage());
                    exit;
                }
        
                if ($d['is_radius']) {
                    Radius::planDelete($d['id']);
                } else {
                    try {
                        $mikrotik = Mikrotik::info($d['routers']);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        // Remove Hotspot plan from the router
                        Mikrotik::removeHotspotPlan($client, $d['name_plan']);
                    } catch (Exception $e) {
                        // Ignore exception, it means the router has already deleted the plan
                    } catch (Throwable $e) {
                        // Ignore exception, it means the router has already deleted the plan
                    }
                }
        
                // Proceed to delete the Hotspot plan from tbl_plans
                try {
                    $d->delete();
                } catch (Exception $e) {
                    error_log('Error deleting Hotspot plan: ' . $e->getMessage());
                }
        
                // Log the deletion and redirect
                _log('[' . $admin['username'] . ']: Hotspot Plan ' . $d['name_plan'] . ' moved to recycle bin', $admin['user_type'], $admin['id']);
                r2(U . 'services/hotspot', 's', Lang::T('Hotspot plan moved to recycle bin successfully'));
            }
            break;
        

    case 'add-post':
        $name = _post('name');
        $radius = _post('radius');
        $typebp = _post('typebp');
        $limit_type = _post('limit_type');
        $time_limit = _post('time_limit');
        $time_unit = _post('time_unit');
        $data_limit = _post('data_limit');
        $data_unit = _post('data_unit');
        $id_bw = _post('id_bw');
        $price = _post('price');
        $sharedusers = _post('sharedusers');
        $validity = _post('validity');
        $validity_unit = _post('validity_unit');
        $routers = _post('routers');
        $pool_expired = _post('pool_expired');
        $list_expired = _post('list_expired');        
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');

        $msg = '';
        if (Validator::UnsignedNumber($validity) == false) {
            $msg .= 'The validity must be a number' . '<br>';
        }
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '' or $id_bw == '' or $price == '' or $validity == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }
        if (empty($radius)) {
            if ($routers == '') {
                $msg .= Lang::T('All field is required') . '<br>';
            }
        }
        $d = ORM::for_table('tbl_plans')->where('name_plan', $name)->where('type', 'Hotspot')->find_one();
        if ($d) {
            $msg .= Lang::T('Name Plan Already Exist') . '<br>';
        }

        run_hook('add_plan'); #HOOK
        
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'k';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'k';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
    
            // Check if all burst fields are entered
            if (!empty($b['burst_limit_up']) && !empty($b['burst_limit_down']) && !empty($b['burst_threshold_up']) && !empty($b['burst_threshold_down']) && !empty($b['burst_time'])) {
                // Get the burst limit
                $burst_limit_up = $b['burst_limit_up'];
                $burst_limit_up_unit = $b['burst_limit_up_unit'] == 'Kbps' ? 'k' : 'M';
                $burst_limit_down = $b['burst_limit_down'];
                $burst_limit_down_unit = $b['burst_limit_down_unit'] == 'Kbps' ? 'k' : 'M';
                $burst_limit = $burst_limit_up . $burst_limit_up_unit . "/" . $burst_limit_down . $burst_limit_down_unit;
    
                // Get the burst threshold
                $burst_threshold_up = $b['burst_threshold_up'];
                $burst_threshold_up_unit = $b['burst_threshold_up_unit'] == 'Kbps' ? 'k' : 'M';
                $burst_threshold_down = $b['burst_threshold_down'];
                $burst_threshold_down_unit = $b['burst_threshold_down_unit'] == 'Kbps' ? 'k' : 'M';
                $burst_threshold = $burst_threshold_up . $burst_threshold_up_unit . "/" . $burst_threshold_down . $burst_threshold_down_unit;
    
                // Get the burst time
                $burst_time = $b['burst_time'];
    
                // Construct the rate limit string with burst information
                $rate = $rate . " " . $burst_limit . " " . $burst_threshold . " " . $burst_time . "/" . $burst_time;
            }

            $d = ORM::for_table('tbl_plans')->create();
            $d->name_plan = $name;
            $d->id_bw = $id_bw;
            $d->price = $price;
            $d->type = 'Hotspot';
            $d->typebp = $typebp;
            $d->limit_type = $limit_type;
            $d->time_limit = $time_limit;
            $d->time_unit = $time_unit;
            $d->data_limit = $data_limit;
            $d->data_unit = $data_unit;
            $d->validity = $validity;
            $d->validity_unit = $validity_unit;
            $d->shared_users = $sharedusers;
            if (!empty($radius)) {
                $d->is_radius = 1;
                $d->routers = '';
            } else {
                $d->is_radius = 0;
                $d->routers = $routers;
            }
            $d->pool_expired = $pool_expired;
            $d->list_expired = $list_expired;            
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();
            $plan_id = $d->id();

            _log('[' . $admin['username'] . ']: Hotspot Plan ' . $d->name_plan . ' created successfully', $admin['user_type'], $admin['id']);

            if ($d['is_radius']) {
                Radius::planUpSert($plan_id, $radiusRate);
            } else {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::addHotspotPlan($client, $name, $sharedusers, $rate);
                if (!empty($pool_expired)) {
                    Mikrotik::setHotspotExpiredPlan($client, 'EXPIRED FREEISPRADIUS ' . $pool_expired, $pool_expired);
                }
            }


            r2(U . 'services/hotspot', 's', Lang::T('Data Created Successfully'));
        } else {
            r2(U . 'services/add', 'e', $msg);
        }
        break;


    case 'edit-post':
        $id = _post('id');
        $name = _post('name');
        $id_bw = _post('id_bw');
        $typebp = _post('typebp');
        $price = _post('price');
        $limit_type = _post('limit_type');
        $time_limit = _post('time_limit');
        $time_unit = _post('time_unit');
        $data_limit = _post('data_limit');
        $data_unit = _post('data_unit');
        $sharedusers = _post('sharedusers');
        $validity = _post('validity');
        $validity_unit = _post('validity_unit');
        $pool_expired = _post('pool_expired');
        $list_expired = _post('list_expired');        
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');
        $routers = _post('routers');
        $msg = '';
        if (Validator::UnsignedNumber($validity) == false) {
            $msg .= 'The validity must be a number' . '<br>';
        }
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '' or $id_bw == '' or $price == '' or $validity == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }
        $d = ORM::for_table('tbl_plans')->where('id', $id)->find_one();
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }
        run_hook('edit_plan'); #HOOK
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'k';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'k';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
    
            // Check if all burst fields are entered
            if (!empty($b['burst_limit_up']) && !empty($b['burst_limit_down']) && !empty($b['burst_threshold_up']) && !empty($b['burst_threshold_down']) && !empty($b['burst_time'])) {
                // Burst Limit
                if ($b['burst_limit_up_unit'] == 'Kbps') {
                    $burstlimitup = $b['burst_limit_up'] . 'k';
                } else {
                    $burstlimitup = $b['burst_limit_up'] . 'M';
                }
                if ($b['burst_limit_down_unit'] == 'Kbps') {
                    $burstlimitdown = $b['burst_limit_down'] . 'k';
                } else {
                    $burstlimitdown = $b['burst_limit_down'] . 'M';
                }
                $burstlimit = $burstlimitup . "/" . $burstlimitdown;
    
                // Burst Threshold
                if ($b['burst_threshold_up_unit'] == 'Kbps') {
                    $burstthresholdup = $b['burst_threshold_up'] . 'k';
                } else {
                    $burstthresholdup = $b['burst_threshold_up'] . 'M';
                }
                if ($b['burst_threshold_down_unit'] == 'Kbps') {
                    $burstthresholddown = $b['burst_threshold_down'] . 'k';
                } else {
                    $burstthresholddown = $b['burst_threshold_down'] . 'M';
                }
                $burstthreshold = $burstthresholdup . "/" . $burstthresholddown;
    
                // Burst Time
                $bursttime = $b['burst_time'];
    
                // Priority
                $priority = $b['priority'];
    
                // Append burst parameters to the rate
                $rate .= " " . $burstlimit . " " . $burstthreshold . " " . $bursttime . "/" . $bursttime;
            }


            if ($d['is_radius']) {
                Radius::planUpSert($id, $radiusRate);
            } else {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::setHotspotPlan($client, $name, $sharedusers, $rate);
                if (!empty($pool_expired)) {
                    Mikrotik::setHotspotExpiredPlan($client, 'EXPIRED FREEISPRADIUS ' . $pool_expired, $pool_expired);
                }
            }

            $d->name_plan = $name;
            $d->id_bw = $id_bw;
            $d->price = $price;
            $d->typebp = $typebp;
            $d->limit_type = $limit_type;
            $d->time_limit = $time_limit;
            $d->time_unit = $time_unit;
            $d->data_limit = $data_limit;
            $d->data_unit = $data_unit;
            $d->validity = $validity;
            $d->validity_unit = $validity_unit;
            $d->shared_users = $sharedusers;
            $d->pool_expired = $pool_expired;
            $d->pool_expired = $pool_expired;            
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();

            _log('[' . $admin['username'] . ']: Hotspot Plan ' . $d->name_plan . ' edited successfully', $admin['user_type'], $admin['id']);

            r2(U . 'services/hotspot', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'services/edit/' . $id, 'e', $msg);
        }
        break;

    case 'pppoe':
        $ui->assign('_title', Lang::T('PPPOE Plans'));
        $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/pppoe.js"></script>');

        $name = _post('name');
        if ($name != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['name_plan' => '%' . $name . '%', 'type' => 'PPPOE'], $name);
            $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'PPPOE')->where_like('tbl_plans.name_plan', '%' . $name . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['type' => 'PPPOE'], $name);
            $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'PPPOE')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        }

        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        run_hook('view_list_ppoe'); #HOOK
        $ui->display('pppoe.tpl');
        break;

    case 'pppoe-add':
        $ui->assign('_title', Lang::T('PPPOE Plans'));
        $d = ORM::for_table('tbl_bandwidth')->find_many();
        $ui->assign('d', $d);
        $r = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('r', $r);
        //difference here
        run_hook('view_add_ppoe'); #HOOK
        //difference here between static,pppoe and hotspot
        $ui->display('pppoe-add.tpl');
        break;

    case 'pppoe-edit':
        //use this to matchstatic instead of hotspot
        $ui->assign('_title', Lang::T('PPPOE Plans'));
        $id  = $routes['2'];
        $d = ORM::for_table('tbl_plans')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            $p = ORM::for_table('tbl_pool')->where('routers', ($d['is_radius']) ? 'radius' : $d['routers'])->find_many();
            $ui->assign('p', $p);
            $b = ORM::for_table('tbl_bandwidth')->find_many();
            $ui->assign('b', $b);
            $r = [];
            if ($d['is_radius']) {
                $r = ORM::for_table('tbl_routers')->find_many();
            }
            $ui->assign('r', $r);
            run_hook('view_edit_ppoe'); #HOOK
            $ui->display('pppoe-edit.tpl');
            //research about the r2u thing thouroughly
        } else {
            r2(U . 'services/pppoe', 'e', Lang::T('Account Not Found'));
        }
        break;

        case 'pppoe-delete':
            $id  = $routes['2'];
        
            $d = ORM::for_table('tbl_plans')->find_one($id);
            if ($d) {
                run_hook('delete_ppoe'); #HOOK
        
                // Store the deleted record in the recycle bin (tbl_recycle)
                try {
                    $recycleEntry = ORM::for_table('tbl_recycle')->create();
                    $recycleEntry->original_table = 'tbl_plans'; // Specify the original table
                    $recycleEntry->original_id = $id; // The original ID in tbl_plans
                    $recycleEntry->data = json_encode($d->as_array()); // Store the data as JSON
                    $recycleEntry->deleted_by = $admin['id']; // Store who deleted the record
                    $recycleEntry->deleted_at = date('Y-m-d H:i:s'); // Store when it was deleted
                    $recycleEntry->save();
                } catch (Exception $e) {
                    _alert(Lang::T('Failed to move record to recycle bin'), 'danger', 'services/pppoe');
                    error_log('Error storing record in recycle bin: ' . $e->getMessage());
                    exit;
                }
        
                if ($d['is_radius']) {
                    Radius::planDelete($d['id']);
                } else {
                    try {
                        $mikrotik = Mikrotik::info($d['routers']);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        // Remove PPPoE plan from the router
                        Mikrotik::removePpoePlan($client, $d['name_plan']);
                    } catch (Exception $e) {
                        // Ignore exception, it means the router has already deleted the plan
                    } catch(Throwable $e){
                        // Ignore exception, it means the router has already deleted the plan
                    }
                }
        
                // Proceed to delete the PPPoE plan from tbl_plans
                try {
                    $d->delete();
                } catch (Exception $e) {
                    error_log('Error deleting PPPoE plan: ' . $e->getMessage());
                }
        
                // Log the deletion and redirect
                _log('[' . $admin['username'] . ']: PPPoE Plan ' . $d['name_plan'] . ' moved to recycle bin', $admin['user_type'], $admin['id']);
                r2(U . 'services/pppoe', 's', Lang::T('PPPoE plan moved to recycle bin successfully'));
            }
            break;
        

        // on below we will follow the pppoe way

    case 'pppoe-add-post':
        $name = _post('name_plan');
        $radius = _post('radius');
        $id_bw = _post('id_bw');
        $price = _post('price');
        $validity = _post('validity');
        $validity_unit = _post('validity_unit');
        $routers = _post('routers');
        $pool = _post('pool_name');
        $pool_expired = _post('pool_expired');
        $list_expired = _post('list_expired');        
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');

        $msg = '';
        if (Validator::UnsignedNumber($validity) == false) {
            $msg .= 'The validity must be a number' . '<br>';
        }
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '' or $id_bw == '' or $price == '' or $validity == '' or $pool == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }
        if (empty($radius)) {
            if ($routers == '') {
                $msg .= Lang::T('All field is required') . '<br>';
            }
        }

        $d = ORM::for_table('tbl_plans')->where('name_plan', $name)->find_one();
        if ($d) {
            $msg .= Lang::T('Name Plan Already Exist') . '<br>';
        }
        //add difference like add_static
        run_hook('add_ppoe'); #HOOK
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'K';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'K';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
            
            // Check if all burst fields are entered
            if (!empty($b['burst_limit_up']) && !empty($b['burst_limit_down']) && !empty($b['burst_threshold_up']) && !empty($b['burst_threshold_down']) && !empty($b['burst_time'])) {
                // Burst Limit
                if ($b['burst_limit_up_unit'] == 'Kbps') {
                    $burstlimitup = $b['burst_limit_up'] . 'K';
                } else {
                    $burstlimitup = $b['burst_limit_up'] . 'M';
                }
                if ($b['burst_limit_down_unit'] == 'Kbps') {
                    $burstlimitdown = $b['burst_limit_down'] . 'K';
                } else {
                    $burstlimitdown = $b['burst_limit_down'] . 'M';
                }
                $burstlimit = $burstlimitup . "/" . $burstlimitdown;
                
                // Burst Threshold
                if ($b['burst_threshold_up_unit'] == 'Kbps') {
                    $burstthresholdup = $b['burst_threshold_up'] . 'K';
                } else {
                    $burstthresholdup = $b['burst_threshold_up'] . 'M';
                }
                if ($b['burst_threshold_down_unit'] == 'Kbps') {
                    $burstthresholddown = $b['burst_threshold_down'] . 'K';
                } else {
                    $burstthresholddown = $b['burst_threshold_down'] . 'M';
                }
                $burstthreshold = $burstthresholdup . "/" . $burstthresholddown;
                
                // Burst Time
                $bursttime = $b['burst_time'];
                
                // Priority
                $priority = $b['priority'];
                
                // Append burst parameters to the rate
                $rate .= "/" . $burstlimit . "/" . $burstthreshold . "/" . $bursttime . "/" . $priority;
            }

            $d = ORM::for_table('tbl_plans')->create();
            $d->type = 'PPPOE';
            $d->name_plan = $name;
            $d->id_bw = $id_bw;
            $d->price = $price;
            $d->validity = $validity;
            $d->validity_unit = $validity_unit;
            $d->pool = $pool;
            if (!empty($radius)) {
                $d->is_radius = 1;
                $d->routers = '';
            } else {
                $d->is_radius = 0;
                $d->routers = $routers;
            }
            $d->pool_expired = $pool_expired;
            $d->list_expired = $list_expired;            
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();
            $plan_id = $d->id();
            _log('[' . $admin['username'] . ']: PPPoE Plan ' . $d->name_plan . ' created successfully', $admin['user_type'], $admin['id']);

            if ($d['is_radius']) {
                Radius::planUpSert($plan_id, $radiusRate, $pool);
            } else {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::addPpoePlan($client, $name, $pool, $rate);
                if (!empty($pool_expired)) {
                    Mikrotik::setPpoePlan($client, 'EXPIRED FREEISPRADIUS ' . $pool_expired, $pool_expired, '1K/1K');
                }
            }
//check here too how its structured on our case should be static or something services/dtatic
            r2(U . 'services/pppoe', 's', Lang::T('Data Created Successfully'));
        } else {
            r2(U . 'services/pppoe-add', 'e', $msg);
        }
        break;

    case 'edit-pppoe-post':
        $id = _post('id');
        $name = _post('name_plan');
        $id_bw = _post('id_bw');
        $price = _post('price');
        $validity = _post('validity');
        $validity_unit = _post('validity_unit');
        $routers = _post('routers');
        $pool = _post('pool_name');
        $pool_expired = _post('pool_expired');
        $list_expired = _post('list_expired');                
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');

        $msg = '';
        if (Validator::UnsignedNumber($validity) == false) {
            $msg .= 'The validity must be a number' . '<br>';
        }
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '' or $id_bw == '' or $price == '' or $validity == '' or $pool == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $d = ORM::for_table('tbl_plans')->where('id', $id)->find_one();
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }

        run_hook('edit_ppoe'); #HOOK
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'K';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'K';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
            
            // Check if all burst fields are entered
            if (!empty($b['burst_limit_up']) && !empty($b['burst_limit_down']) && !empty($b['burst_threshold_up']) && !empty($b['burst_threshold_down']) && !empty($b['burst_time'])) {
                // Burst Limit
                if ($b['burst_limit_up_unit'] == 'Kbps') {
                    $burstlimitup = $b['burst_limit_up'] . 'K';
                } else {
                    $burstlimitup = $b['burst_limit_up'] . 'M';
                }
                if ($b['burst_limit_down_unit'] == 'Kbps') {
                    $burstlimitdown = $b['burst_limit_down'] . 'K';
                } else {
                    $burstlimitdown = $b['burst_limit_down'] . 'M';
                }
                $burstlimit = $burstlimitup . "/" . $burstlimitdown;
                
                // Burst Threshold
                if ($b['burst_threshold_up_unit'] == 'Kbps') {
                    $burstthresholdup = $b['burst_threshold_up'] . 'K';
                } else {
                    $burstthresholdup = $b['burst_threshold_up'] . 'M';
                }
                if ($b['burst_threshold_down_unit'] == 'Kbps') {
                    $burstthresholddown = $b['burst_threshold_down'] . 'K';
                } else {
                    $burstthresholddown = $b['burst_threshold_down'] . 'M';
                }
                $burstthreshold = $burstthresholdup . "/" . $burstthresholddown;
                
                // Burst Time
                $bursttime = $b['burst_time'];
                
                // Priority
                $priority = $b['priority'];
                
                // Append burst parameters to the rate
                $rate .= "/" . $burstlimit . "/" . $burstthreshold . "/" . $bursttime . "/" . $priority;
            }
            if ($d['is_radius']) {
                Radius::planUpSert($id, $radiusRate, $pool);
            } else {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
               //needs more research on setpppoe plan
                Mikrotik::setPpoePlan($client, $name, $pool, $rate);
                if (!empty($pool_expired)) {
                    Mikrotik::setPpoePlan($client, 'EXPIRED FREEISPRADIUS ' . $pool_expired, $pool_expired, '1K/1K');
                }
            }

            $d->name_plan = $name;
            $d->id_bw = $id_bw;
            $d->price = $price;
            $d->validity = $validity;
            $d->validity_unit = $validity_unit;
            $d->routers = $routers;
            $d->pool = $pool;
            $d->pool_expired = $pool_expired;
            $d->list_expired = $list_expired;
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();
//check here needs more
_log('[' . $admin['username'] . ']: PPPoE Plan ' . $d->name_plan . ' Edited successfully', $admin['user_type'], $admin['id']);
            r2(U . 'services/pppoe', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'services/pppoe-edit/' . $id, 'e', $msg);
        }
        break;


        // working on replicating pppoe plans but on static side
         // working on replicating pppoe plans but on static side
          // working on replicating pppoe plans but on static side
           // working on replicating pppoe plans but on static side
            // working on replicating pppoe plans but on static side
             // working on replicating pppoe plans but on static side
              // working on replicating pppoe plans but on static side
               // working on replicating pppoe plans but on static side
                // working on replicating pppoe plans but on static side
                 // working on replicating pppoe plans but on static side

//my added files gomez incase delete here




case 'static':
    $ui->assign('_title', Lang::T('Static Ip Plans'));
    $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/static-ip.js"></script>');

    $name = _post('name');
    if ($name != '') {
        $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['name_plan' => '%' . $name . '%', 'type' => 'static'], $name);
        $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'static')->where_like('tbl_plans.name_plan', '%' . $name . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
    } else {
        $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['type' => 'static'], $name);
        $d = ORM::for_table('tbl_bandwidth')->join('tbl_plans', array('tbl_bandwidth.id', '=', 'tbl_plans.id_bw'))->where('tbl_plans.type', 'static')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
    }

    $ui->assign('d', $d);
    $ui->assign('paginator', $paginator);
    run_hook('view_list_static'); #HOOK
    $ui->display('static.tpl');

    break; 

    




    case 'static-add':
        $ui->assign('_title', Lang::T('Static Ip Plans'));
        $d = ORM::for_table('tbl_bandwidth')->find_many();
        $ui->assign('d', $d);
        $r = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('r', $r);
        run_hook('view_add_static'); // Update the hook for static IP
        $ui->display('static-add.tpl'); // Ensure this template exists for adding static IP plans
        break;

    case 'static-edit':
        $ui->assign('_title', Lang::T('Static Ip Plans'));
        $id = $routes['2'];
        $d = ORM::for_table('tbl_plans')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            $p = ORM::for_table('tbl_pool')->where('routers', ($d['is_radius']) ? 'radius' : $d['routers'])->find_many();
            $ui->assign('p', $p);
            $b = ORM::for_table('tbl_bandwidth')->find_many();
            $ui->assign('b', $b);
            $r = ORM::for_table('tbl_routers')->find_many();
            $ui->assign('r', $r);
            run_hook('view_edit_static'); // Update the hook for editing static IP
            $ui->display('static-edit.tpl'); // Ensure this template exists for editing static IP plans
        } else {
            r2(U . 'services/static', 'e', Lang::T('Account Not Found'));
        }
        break;

        case 'static-delete':
            $id = $routes['2'];
        
            $d = ORM::for_table('tbl_plans')->find_one($id);
            if ($d) {
                run_hook('delete_static'); // Hook for static IP deletion
        
                // Store the deleted record in the recycle bin (tbl_recycle)
                try {
                    $recycleEntry = ORM::for_table('tbl_recycle')->create();
                    $recycleEntry->original_table = 'tbl_plans'; // Specify the original table
                    $recycleEntry->original_id = $id; // The original ID in tbl_plans
                    $recycleEntry->data = json_encode($d->as_array()); // Store the data as JSON
                    $recycleEntry->deleted_by = $admin['id']; // Store who deleted the record
                    $recycleEntry->deleted_at = date('Y-m-d H:i:s'); // Store when it was deleted
                    $recycleEntry->save();
                } catch (Exception $e) {
                    _alert(Lang::T('Failed to move record to recycle bin'), 'danger', 'services/static');
                    error_log('Error storing record in recycle bin: ' . $e->getMessage());
                    exit;
                }
        
                if ($d['is_radius']) {
                    Radius::planDelete($d['id']);
                } else {
                    try {
                        $mikrotik = Mikrotik::info($d['routers']);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        Mikrotik::removeStaticPlan($client, $d['name_plan']);
                    } catch (Exception $e) {
                        // Ignore exception, router may have already deleted the plan
                    } catch (Throwable $e) {
                        // Ignore exception, router may have already deleted the plan
                    }
                }
        
                // Proceed to delete the Static Plan from tbl_plans
                try {
                    $d->delete();
                } catch (Exception $e) {
                    error_log('Error deleting Static Plan: ' . $e->getMessage());
                }
        
                // Log the deletion and redirect
                _log('[' . $admin['username'] . ']: Static Plan ' . $d['name_plan'] . ' moved to recycle bin', $admin['user_type'], $admin['id']);
                r2(U . 'services/static', 's', Lang::T('Static plan moved to recycle bin successfully'));
            } else {
                r2(U . 'services/static', 'e', Lang::T('Account Not Found'));
            }
            break;
        

     /*       case 'static-add-post':
                $name = _post('name_plan');
                $radius = _post('radius');
                $id_bw = _post('id_bw');

                $price = _post('price');
                $validity = _post('validity');
                $validity_unit = _post('validity_unit');
                $routers = _post('routers');
                $pool = _post('pool_name');
                $pool_expired = _post('pool_expired');
                $enabled = _post('enabled');
                $allow_purchase = _post('allow_purchase');


                $msg = '';
                if (Validator::UnsignedNumber($validity) == false) {
                    $msg .= 'The validity must be a number' . '<br>';
                }
                if (Validator::UnsignedNumber($price) == false) {
                    $msg .= 'The price must be a number' . '<br>';
                }
                if ($name == '' or $id_bw == '' or $price == '' or $validity == '') {
                    $msg .= Lang::T('All field is required') . '<br>';
                }
                if ($routers == '') {
                    $msg .= Lang::T('All field is required') . '<br>';
                }

                $d = ORM::for_table('tbl_plans')->where('name_plan', $name)->find_one();
                if ($d) {
                    $msg .= Lang::T('Name Plan Already Exist') . '<br>';
                }
                run_hook('add_static'); */// Update the hook for static IP*/


                case 'static-add-post':
                    $name = _post('name_plan');
                    $radius = _post('radius');
                    $id_bw = _post('id_bw');
                    $price = _post('price');
                    $validity = _post('validity');
                    $validity_unit = _post('validity_unit');
                    $routers = _post('routers');
                    $pool = _post('pool_name');
                    $pool_expired = _post('pool_expired');
                    $list_expired = _post('list_expired');        
                    $enabled = _post('enabled');
                    $allow_purchase = _post('allow_purchase');
            
                    $msg = '';
                    if (Validator::UnsignedNumber($validity) == false) {
                        $msg .= 'The validity must be a number' . '<br>';
                    }
                    if (Validator::UnsignedNumber($price) == false) {
                        $msg .= 'The price must be a number' . '<br>';
                    }
                    if ($name == '' or $id_bw == '' or $price == '' or $validity == '' or $pool == '') {
                        $msg .= Lang::T('All field is required') . '<br>';
                    }
                    if (empty($radius)) {
                        if ($routers == '') {
                            $msg .= Lang::T('All field is required') . '<br>';
                        }
                    }
            
                    $d = ORM::for_table('tbl_plans')->where('name_plan', $name)->find_one();
                    if ($d) {
                        $msg .= Lang::T('Name Plan Already Exist') . '<br>';
                    }
                    //add difference like add_static

        //add difference like add_static
        run_hook('add_static'); #HOOK
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'K';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'K';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
            $rate = trim($rate . " " . $b['burst']);

                    $d = ORM::for_table('tbl_plans')->create();
                    $d->type = 'static';
                    $d->name_plan = $name;
                    $d->id_bw = $id_bw;
                    $d->price = $price;
                    $d->validity = $validity;
                    $d->validity_unit = $validity_unit;
                    $d->pool = $pool;
                    if (!empty($radius)) {
                        $d->is_radius = 1;
                        $d->routers = '';
                    } else {
                        $d->is_radius = 0;
                        $d->routers = $routers;

                    }
                    $d->pool_expired = $pool_expired;
                    $d->list_expired = $list_expired;                    
                    $d->enabled = $enabled;
                    $allow_purchase = _post('allow_purchase');
                    $d->save();
                    $plan_id = $d->id();

                    _log('[' . $admin['username'] . ']: Static Plan ' . $d->name_plan . ' created successfully', $admin['user_type'], $admin['id']);

                    if ($d['is_radius']) {
                        Radius::planUpSert($plan_id, $radiusRate, $pool);
                    } else {
                        $mikrotik = Mikrotik::info($routers);
                        $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                        Mikrotik::addStaticPlan($client, $name, $pool, $rate);
                        if (!empty($pool_expired)) {
                            Mikrotik::setStaticPlan($client, 'EXPIRED FREEISPRADIUS ' . $pool_expired, $pool_expired, '1K/1K');
                        }
                    }
        //check here too how its structured on our case should be static or something services/dtatic
                    r2(U . 'services/static', 's', Lang::T('Data Created Successfully'));
                } else {
                    r2(U . 'services/static-add', 'e', $msg);
                }
                break;

                case 'edit-static-post':
                    $id = _post('id');
                    $name = _post('name_plan');
                    $id_bw = _post('id_bw');
                    $price = _post('price');
                    $validity = _post('validity');
                    $validity_unit = _post('validity_unit');
                    $routers = _post('routers');
                    $pool = _post('pool_name');
                    $pool_expired = _post('pool_expired');
                    $list_expired = _post('list_expired');                    
                    $enabled = _post('enabled');
                    $allow_purchase = _post('allow_purchase');


                    $msg = '';
        if (Validator::UnsignedNumber($validity) == false) {
            $msg .= 'The validity must be a number' . '<br>';
        }
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '' or $id_bw == '' or $price == '' or $validity == '' or $pool == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $d = ORM::for_table('tbl_plans')->where('id', $id)->find_one();
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }

        //check below
        run_hook('edit_static'); #HOOK
        if ($msg == '') {
            $b = ORM::for_table('tbl_bandwidth')->where('id', $id_bw)->find_one();
            if ($b['rate_down_unit'] == 'Kbps') {
                $unitdown = 'K';
                $raddown = '000';
            } else {
                $unitdown = 'M';
                $raddown = '000000';
            }
            if ($b['rate_up_unit'] == 'Kbps') {
                $unitup = 'K';
                $radup = '000';
            } else {
                $unitup = 'M';
                $radup = '000000';
            }
            $rate = $b['rate_up'] . $unitup . "/" . $b['rate_down'] . $unitdown;
            $radiusRate = $b['rate_up'] . $radup . '/' . $b['rate_down'] . $raddown;
            $rate = trim($rate . " " . $b['burst']);            

            if ($d['is_radius']) {
                Radius::planUpSert($id, $radiusRate, $pool);
            } else {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
               //needs more research on setpppoe plan
                Mikrotik::setStaticPlan($client, $name, $pool, $rate);
                if (!empty($pool_expired)) {
                    Mikrotik::setStaticPlan($client, 'EXPIRED ' . $pool_expired, $pool_expired, '1K/1K');
                }
            }

            $d->name_plan = $name;
            $d->id_bw = $id_bw;
            $d->price = $price;
            $d->validity = $validity;
            $d->validity_unit = $validity_unit;
            $d->routers = $routers;
            $d->pool = $pool;
            $d->pool_expired = $pool_expired;
            $d->list_expired = $list_expired;            
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();
            _log('[' . $admin['username'] . ']: Static Plan ' . $d->name_plan . ' edited successfully', $admin['user_type'], $admin['id']);
//check here needs more
            r2(U . 'services/static', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'services/static-edit/' . $id, 'e', $msg);
        }
        break;



#ase 'static-ip':
  #  $ui->assign('_title', $_L['Static_IP_Plans']);

    // Replace 'your_table_name' with the actual table name
 #   $staticIpPlans = ORM::for_table('tbl_static')->find_many();

    // Assign the fetched data to the Smarty variable
   # $ui->assign('staticIpPlans', $staticIpPlans);

    // Render the template
   # $ui->display('static-ip-plans.tpl');
  #  break;


//my added files incase delete here

    case 'balance':
        $ui->assign('_title', Lang::T('Balance Plans'));
        $name = _post('name');
        if ($name != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['name_plan' => '%' . $name . '%', 'type' => 'Balance'], $name);
            $d = ORM::for_table('tbl_plans')->where('tbl_plans.type', 'Balance')->where_like('tbl_plans.name_plan', '%' . $name . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_plans'), ['type' => 'Balance'], $name);
            $d = ORM::for_table('tbl_plans')->where('tbl_plans.type', 'Balance')->offset($paginator['startpoint'])->limit($paginator['limit'])->find_many();
        }

        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        run_hook('view_list_balance'); #HOOK
        $ui->display('balance.tpl');
        break;
    case 'balance-add':
        $ui->assign('_title', Lang::T('Balance Plans'));
        run_hook('view_add_balance'); #HOOK
        $ui->display('balance-add.tpl');
        break;
    case 'balance-edit':
        $ui->assign('_title', Lang::T('Balance Plans'));
        $id  = $routes['2'];
        $d = ORM::for_table('tbl_plans')->find_one($id);
        $ui->assign('d', $d);
        run_hook('view_edit_balance'); #HOOK
        $ui->display('balance-edit.tpl');
        break;
    case 'balance-delete':
        $id  = $routes['2'];

        $d = ORM::for_table('tbl_plans')->find_one($id);
        if ($d) {
            run_hook('delete_balance'); #HOOK
            $d->delete();
            r2(U . 'services/balance', 's', Lang::T('Data Deleted Successfully'));
        }
        break;
    case 'balance-edit-post':
        $id = _post('id');
        $name = _post('name');
        $price = _post('price');
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');

        $msg = '';
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $d = ORM::for_table('tbl_plans')->where('id', $id)->find_one();
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }
        run_hook('edit_ppoe'); #HOOK
        if ($msg == '') {
            $d->name_plan = $name;
            $d->price = $price;
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();

            r2(U . 'services/balance', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'services/balance-edit/' . $id, 'e', $msg);
        }
        break;
    case 'balance-add-post':
        $name = _post('name');
        $price = _post('price');
        $enabled = _post('enabled');
        $allow_purchase = _post('allow_purchase');

        $msg = '';
        if (Validator::UnsignedNumber($price) == false) {
            $msg .= 'The price must be a number' . '<br>';
        }
        if ($name == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $d = ORM::for_table('tbl_plans')->where('name_plan', $name)->find_one();
        if ($d) {
            $msg .= Lang::T('Name Plan Already Exist') . '<br>';
        }
        run_hook('add_ppoe'); #HOOK
        if ($msg == '') {
            $d = ORM::for_table('tbl_plans')->create();
            $d->type = 'Balance';
            $d->name_plan = $name;
            $d->id_bw = 0;
            $d->price = $price;
            $d->validity = 0;
            $d->validity_unit = 'Months';
            $d->routers = '';
            $d->pool = '';
            $d->enabled = $enabled;
            $d->allow_purchase = $allow_purchase;
            $d->save();

            r2(U . 'services/balance', 's', Lang::T('Data Created Successfully'));
        } else {
            r2(U . 'services/balance-add', 'e', $msg);
        }
        break;
    default:
        $ui->display('a404.tpl');
}
