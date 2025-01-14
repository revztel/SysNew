<?php
include "../init.php";
ob_start();

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Bulk Actions'));
$ui->assign('_system_menu', 'bulk_actions');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

// Get the action from the routes
$action = isset($routes[1]) ? $routes[1] : 'list';

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

// Include necessary models or libraries
// For example, if you have a Customer model, Plan model, etc.

// Now handle the action
switch ($action) {
    case 'list':
        // Display the main bulk actions page
        $ui->display('bulk_actions.tpl');
        break;

        case 'mass_delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Process the mass delete action
                $criteria = $_POST['criteria']; // e.g., 'expired', 'inactive', 'service_type'
                $service_type = $_POST['service_type'] ?? null;
                $router_id = $_POST['router_id'] ?? null;
        
                try {
                    // Start building the query
                    $query = ORM::for_table('tbl_customers')->table_alias('c')->select('c.*');
        
                    if ($criteria === 'expired') {
                        // Join with tbl_user_recharges to find expired accounts
                        $query->join('tbl_user_recharges', ['c.id', '=', 'r.customer_id'], 'r')
                              ->where_lt('r.expiration', date('Y-m-d H:i:s'));
                    } elseif ($criteria === 'inactive') {
                        // Find customers who are not in tbl_user_recharges (no active recharges)
                        $query->left_outer_join('tbl_user_recharges', ['c.id', '=', 'r.customer_id'], 'r')
                              ->where_null('r.id');
                    }
        
                    if ($service_type) {
                        $query->where('c.service_type', $service_type);
                    }
        
                    if ($router_id) {
                        $query->where('c.router_id', $router_id);
                    }
        
                    $customers = $query->find_many();
                } catch (Exception $e) {
                    _log('Error in mass_delete query: ' . $e->getMessage(), 'Error', $admin['id']);
                    _alert(Lang::T('An error occurred while fetching customers: ') . $e->getMessage(), 'danger', 'bulk_actions/mass_delete');
                    exit;
                }
        
                // Move customers to recycle bin and delete them
                foreach ($customers as $customer) {
                    try {
                        // Ensure customer ID is valid
                        if (!$customer->id) {
                            _log('Customer ID is null for customer: ' . print_r($customer->as_array(), true), 'Error', $admin['id']);
                            continue; // Skip this customer to prevent errors
                        }
        
                        // Store the customer in recycle bin
                        $recycleEntry = ORM::for_table('tbl_recycle')->create();
                        $recycleEntry->original_table = 'tbl_customers';
                        $recycleEntry->original_id = $customer->id;
                        $recycleEntry->data = json_encode($customer->as_array());
                        $recycleEntry->deleted_by = $admin['id'];
                        $recycleEntry->deleted_at = date('Y-m-d H:i:s');
                        $recycleEntry->save();
        
                        // Log the deletion activity
                        _log('Customer ID ' . $customer->id . ' (' . $customer->username . ') moved to recycle bin and deleted', 'Info', $admin['id']);
        
                        // Delete the customer record
                        $customer->delete();
        
                        // Also delete related records in tbl_user_recharges by matching the username
                        $user_recharges = ORM::for_table('tbl_user_recharges')->where('username', $customer->username)->find_many();
                        foreach ($user_recharges as $recharge) {
                            // Move recharge to recycle bin
                            $recycleEntry = ORM::for_table('tbl_recycle')->create();
                            $recycleEntry->original_table = 'tbl_user_recharges';
                            $recycleEntry->original_id = $recharge->id;
                            $recycleEntry->data = json_encode($recharge->as_array());
                            $recycleEntry->deleted_by = $admin['id'];
                            $recycleEntry->deleted_at = date('Y-m-d H:i:s');
                            $recycleEntry->save();
        
                            // Log the recharge deletion
                            _log('User recharge ID ' . $recharge->id . ' for username ' . $recharge->username . ' moved to recycle bin and deleted', 'Info', $admin['id']);
        
                            // Delete the recharge record
                            $recharge->delete();
                        }
        
                    } catch (Exception $e) {
                        _log('Error deleting customer ID ' . $customer->id . ': ' . $e->getMessage(), 'Error', $admin['id']);
                    }
                }
        
                // Redirect with success message
                r2(U . 'bulk_actions/list', 's', Lang::T('Selected customers have been deleted successfully'));
            } else {
                // Display the mass delete form
                // Fetch necessary data like service types, routers, etc.
                $service_types = ['Hotspot', 'PPPOE', 'Static']; // Example service types
                $routers = ORM::for_table('tbl_routers')->find_array();
        
                $ui->assign('service_types', $service_types);
                $ui->assign('routers', $routers);
                $ui->display('bulk_actions_mass_delete.tpl');
            }
            break;
        
        
        

            case 'bulk_edit_expiry':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Process the bulk expiry edit action
                    $service_type = $_POST['service_type'] ?? null;
                    $router_id = $_POST['router_id'] ?? null;
                    $plan_id = $_POST['plan_id'] ?? null; // If plan selection is included
                    $new_expiry_date = $_POST['new_expiry_date'] ?? null;
            
                    if (!$new_expiry_date) {
                        _alert(Lang::T('Please provide a new expiry date'), 'danger', 'bulk_actions/bulk_edit_expiry');
                    }
            
                    // Build the query based on criteria
                    $query = ORM::for_table('tbl_user_recharges')->table_alias('r');
            
                    if ($service_type) {
                        $query->where('r.type', $service_type);
                    }
            
                    if ($router_id) {
                        // Fetch router information
                        $router = ORM::for_table('tbl_routers')->find_one($router_id);
                        if ($router) {
                            $router_name = $router->name;
            
                            // Depending on how 'routers' is stored in 'tbl_user_recharges', adjust the condition
                            // If 'r.routers' stores router names
                            $query->where('r.routers', $router_name);
            
                            // If 'r.routers' stores router IDs, use the following instead:
                            // $query->where('r.routers', $router_id);
                        } else {
                            _alert(Lang::T('Router not found'), 'danger', 'bulk_actions/bulk_edit_expiry');
                            exit;
                        }
                    }
            
                    if ($plan_id) {
                        $query->where('r.plan_id', $plan_id);
                    }
            
                    $user_recharges = $query->find_many();
            
                    // Update the expiry date for each user recharge
                    foreach ($user_recharges as $recharge) {
                        $recharge->expiration = $new_expiry_date;
                        $recharge->save();
                    }
            
                    // Redirect with success message
                    r2(U . 'bulk_actions/list', 's', Lang::T('Expiry dates have been updated successfully'));
                } else {
                    // Display the bulk edit expiry form
                    // Fetch necessary data like service types, routers, plans, etc.
                    $service_types = ['Hotspot', 'PPPOE', 'Static']; // Example service types
                    $routers = ORM::for_table('tbl_routers')->find_array();
                    $plans = ORM::for_table('tbl_plans')->find_array();
            
                    $ui->assign('service_types', $service_types);
                    $ui->assign('routers', $routers);
                    $ui->assign('plans', $plans); // Include plans if needed
                    $ui->display('bulk_actions_edit_expiry.tpl');
                }
                break;
            

                case 'bulk_edit_plan':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Process the bulk plan edit action
                        $service_type = $_POST['service_type'] ?? null;
                        $router_id = $_POST['router_id'] ?? null;
                        $current_plan_id = $_POST['current_plan_id'] ?? null;
                        $new_plan_id = $_POST['new_plan_id'] ?? null;
                
                        if (!$new_plan_id) {
                            _alert(Lang::T('Please select a new plan'), 'danger', 'bulk_actions/bulk_edit_plan');
                        }
                
                        // Fetch the new plan details
                        $new_plan = ORM::for_table('tbl_plans')->find_one($new_plan_id);
                        if (!$new_plan) {
                            _alert(Lang::T('New plan not found'), 'danger', 'bulk_actions/bulk_edit_plan');
                        }
                
                        // Build the query based on criteria
                        $query = ORM::for_table('tbl_user_recharges')->table_alias('r');
                
                        // Apply filters based on service type and router
                        if ($service_type) {
                            $query->where('r.type', $service_type);
                        }
                
                        if ($router_id) {
                            // Fetch router information
                            $router = ORM::for_table('tbl_routers')->find_one($router_id);
                            if ($router) {
                                $router_name = $router->name;
                                $query->where('r.routers', $router_name);
                            } else {
                                _alert(Lang::T('Router not found'), 'danger', 'bulk_actions/bulk_edit_plan');
                                exit;
                            }
                        }
                
                        if ($current_plan_id) {
                            $query->where('r.plan_id', $current_plan_id);
                        }
                
                        $user_recharges = $query->find_many();
                
                        // Update the plan for each user recharge
                        foreach ($user_recharges as $recharge) {
                            try {
                                $recharge->plan_id = $new_plan_id;
                                $recharge->namebp = $new_plan->name_plan; // Update 'namebp' to the new plan's name
                                $recharge->save();
                                error_log('Updated recharge ID ' . $recharge->id . ' to plan ID ' . $new_plan_id);
                            } catch (Exception $e) {
                                error_log('Error updating recharge ID ' . $recharge->id . ': ' . $e->getMessage());
                            }
                        }
                
                        // Redirect with success message
                        r2(U . 'bulk_actions/list', 's', Lang::T('Plans have been updated successfully'));
                    } else {
                        // Display the bulk edit plan form
                        // Fetch necessary data like service types, routers, plans, etc.
                        $service_types = ['Hotspot', 'PPPOE', 'Static']; // Example service types
                        $routers = ORM::for_table('tbl_routers')->find_array();
                        $plans = ORM::for_table('tbl_plans')->find_array();
                
                        $ui->assign('service_types', $service_types);
                        $ui->assign('routers', $routers);
                        $ui->assign('plans', $plans);
                        $ui->display('bulk_actions_edit_plan.tpl');
                    }
                    break;
                

            case 'bulk_edit_router':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Process the bulk router edit action
                    $service_type = $_POST['service_type'] ?? null;
                    $current_router_id = $_POST['current_router_id'] ?? null;
                    $new_router_id = $_POST['new_router_id'] ?? null;
            
                    if (!$new_router_id) {
                        _alert(Lang::T('Please select a new router'), 'danger', 'bulk_actions/bulk_edit_router');
                    }
            
                    // Build the query based on criteria
                    $query = ORM::for_table('tbl_customers')->table_alias('c');
            
                    if ($service_type) {
                        $query->where('c.service_type', $service_type);
                    }
            
                    if ($current_router_id) {
                        $query->where('c.router_id', $current_router_id);
                    }
            
                    $customers = $query->find_many();
            
                    // Update the router for each customer
                    foreach ($customers as $customer) {
                        $customer->router_id = $new_router_id;
                        $customer->save();
                    }
            
                    // Redirect with success message
                    r2(U . 'bulk_actions/list', 's', Lang::T('Routers have been updated successfully'));
                } else {
                    // Display the bulk edit router form
                    // Fetch necessary data like service types, routers, etc.
                    $service_types = ['Hotspot', 'PPPOE', 'Static']; // Example service types
                    $routers = ORM::for_table('tbl_routers')->find_array();
            
                    $ui->assign('service_types', $service_types);
                    $ui->assign('routers', $routers);
                    $ui->display('bulk_actions_edit_router.tpl');
                }
                break;
            
        

    default:
        _alert(Lang::T('Invalid action'), 'danger', 'bulk_actions/list');
        break;
}
