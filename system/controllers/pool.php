<?php

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Network'));
$ui->assign('_system_menu', 'network');
                    // Try connecting to the MikroTik router using PEAR2 RouterOS
                    require 'system/autoload/PEAR2/Autoload.php';
                    use PEAR2\Net\RouterOS;

$action = $routes['1'];
//$admin = Admin::_info();
$ui->assign('_admin', $admin);

        // Fetch routers to populate the dropdown
        $routers = ORM::for_table('tbl_routers')->where('enabled', 1)->find_array();
    
        $ui->assign('routers', $routers); // Assign routers to the template
        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        run_hook('view_pool'); // Hook for additional processing
   
        

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'),'danger', "dashboard");
}


switch ($action) {
    case 'list':
        $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/pool.js"></script>');

        $name = _post('name');
        if ($name != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_pool'), ['pool_name' => '%' . $name . '%'], $name);
            $d = ORM::for_table('tbl_pool')->where_like('pool_name', '%' . $name . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_pool'));
            $d = ORM::for_table('tbl_pool')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        }

        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        run_hook('view_pool'); #HOOK
        $ui->display('pool.tpl');
        break;

    case 'add':
        $r = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('r', $r);
        run_hook('view_add_pool'); #HOOK
        $ui->display('pool-add.tpl');
        break;

    case 'edit':
        $id  = $routes['2'];
        $d = ORM::for_table('tbl_pool')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            run_hook('view_edit_pool'); #HOOK
            $ui->display('pool-edit.tpl');
        } else {
            r2(U . 'pool/list', 'e', Lang::T('Account Not Found'));
        }
        break;

    case 'delete':
        $id  = $routes['2'];
        run_hook('delete_pool'); #HOOK
        $d = ORM::for_table('tbl_pool')->find_one($id);
        if ($d) {
            if ($d['routers'] != 'radius') {
                try {
                    $mikrotik = Mikrotik::info($d['routers']);
                    $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                    Mikrotik::removePool($client, $d['pool_name']);
                } catch (Exception $e) {
                    //ignore exception, it means router has already deleted
                } catch(Throwable $e){
                    //ignore exception, it means router has already deleted
                }
                
            }
            $d->delete();

            r2(U . 'pool/list', 's', Lang::T('Data Deleted Successfully'));
        }
        break;

        case 'sync-specific':
            $routerId = _post('router_id', null); // Fetch router ID from POST data
 
        
            if ($routerId) {
                // Fetch the router details directly from the tbl_routers table
                $router = ORM::for_table('tbl_routers')->find_one($routerId);
        
                if ($router) {
                    $username = $router['username'];
                    $password = $router['password'];
                    $routerIpAddress = $router['ip_address'];
                    $routerName = $router['name']; // Fetch the router name
                   
        

        
                    try {
                        // Create a RouterOS client
                        $client = new RouterOS\Client($routerIpAddress, $username, $password);
                  
                        // Fetch pools associated with this router from the database by matching the router name
                        $dbPools = ORM::for_table('tbl_pool')->where('routers', $routerName)->find_many();
  
        
                        $log = '';
                        if (count($dbPools) > 0) {
                            foreach ($dbPools as $pool) {
                                try {
                                  
                                    // Use addPool function to add the pool to the MikroTik router
                                    Mikrotik::addPool($client, $pool['pool_name'], $pool['range_ip']);
                                    $log .= "DONE: {$pool['pool_name']}: {$pool['range_ip']}<br>";
                                } catch (Exception $e) {
                                    $log .= "ERROR: {$e->getMessage()}<br>";
 
                                }
                            }
                        } else {
                            $log = 'No pools found to sync for this router.';
                        }
        
                        // Redirect back to pool list with the log message
                        r2(U . 'pool/list', 's', $log);
                    } catch (Exception $e) {
                        $log = 'Failed to connect to router. Check router credentials and network settings.';

                        r2(U . 'pool/list', 'e', $log); // Redirect with error message
                    }
                } else {
                    $log = 'Router not found';
 
                    r2(U . 'pool/list', 'e', $log); // Redirect with error message
                }
            } else {
                $log = 'Router ID not provided.';
 
                r2(U . 'pool/list', 'e', $log); // Redirect with error message
            }
            break; // Correctly exit the case without terminating the script
        

    case 'sync':
        $pools = ORM::for_table('tbl_pool')->find_many();
        $log = '';
        foreach ($pools as $pool) {
            if ($pool['routers'] != 'radius') {
                $mikrotik = Mikrotik::info($pool['routers']);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::addPool($client, $pool['pool_name'], $pool['range_ip']);
                $log .= 'DONE: ' . $pool['pool_name'] . ': ' . $pool['range_ip'] . '<br>';
            }
        }
        r2(U . 'pool/list', 's', $log);
        break;
    case 'add-post':
        $name = _post('name');
        $ip_address = _post('ip_address');
        $routers = _post('routers');
        run_hook('add_pool'); #HOOK
        $msg = '';
        if (Validator::Length($name, 30, 2) == false) {
            $msg .= 'Name should be between 3 to 30 characters' . '<br>';
        }
        if ($ip_address == '' or $routers == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $d = ORM::for_table('tbl_pool')->where('pool_name', $name)->find_one();
        if ($d) {
            $msg .= Lang::T('Pool Name Already Exist') . '<br>';
        }
        if ($msg == '') {
            if ($routers != 'radius') {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::addPool($client, $name, $ip_address);
            }

            $b = ORM::for_table('tbl_pool')->create();
            $b->pool_name = $name;
            $b->range_ip = $ip_address;
            $b->routers = $routers;
            $b->save();

            r2(U . 'pool/list', 's', Lang::T('Data Created Successfully'));
        } else {
            r2(U . 'pool/add', 'e', $msg);
        }
        break;


    case 'edit-post':
        $ip_address = _post('ip_address');
        $routers = _post('routers');
        run_hook('edit_pool'); #HOOK
        $msg = '';

        if ($ip_address == '' or $routers == '') {
            $msg .= Lang::T('All field is required') . '<br>';
        }

        $id = _post('id');
        $d = ORM::for_table('tbl_pool')->find_one($id);
        if ($d) {
        } else {
            $msg .= Lang::T('Data Not Found') . '<br>';
        }

        if ($msg == '') {
            if ($routers != 'radius') {
                $mikrotik = Mikrotik::info($routers);
                $client = Mikrotik::getClient($mikrotik['ip_address'], $mikrotik['username'], $mikrotik['password']);
                Mikrotik::setPool($client, $d['pool_name'], $ip_address);
            }

            $d->range_ip = $ip_address;
            $d->routers = $routers;
            $d->save();

            r2(U . 'pool/list', 's', Lang::T('Data Updated Successfully'));
        } else {
            r2(U . 'pool/edit/' . $id, 'e', $msg);
        }
        break;

    default:
        r2(U . 'pool/list/', 's', '');
}
