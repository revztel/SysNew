<?php

include "../init.php";
$isCli = true;


if (php_sapi_name() !== 'cli') {
    $isCli = false;
    echo "<pre>";
}

echo "PHP Time\t" . date('Y-m-d H:i:s') . "\n";
$res = ORM::raw_execute('SELECT NOW() AS WAKTU;');
$statement = ORM::get_last_statement();
$rows = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "MYSQL Time\t" . $row['WAKTU'] . "\n";
}

$_c = $config;


$textExpired = Lang::getNotifText('expired');

$d = ORM::for_table('tbl_user_recharges')->where('status', 'on')->where_lte('expiration', date("Y-m-d"))->find_many();
echo "Found " . count($d) . " user(s)\n";
run_hook('cronjob'); #HOOK

foreach ($d as $ds) {
    if ($ds['type'] == 'Hotspot') {
        $date_now = strtotime(date("Y-m-d H:i:s"));
        $expiration = strtotime($ds['expiration'] . ' ' . $ds['time']);
        echo $ds['expiration'] . " : " . (($isCli) ? $ds['username'] : Lang::maskText($ds['username']));
        if ($date_now >= $expiration) {
            echo " : EXPIRED \r\n";
            $u = ORM::for_table('tbl_user_recharges')->where('id', $ds['id'])->find_one();
            $c = ORM::for_table('tbl_customers')->where('id', $ds['customer_id'])->find_one();
            $m = Mikrotik::info($ds['routers']);
            $p = ORM::for_table('tbl_plans')->where('id', $u['plan_id'])->find_one();
            $price = Lang::moneyFormat($p['price']);


            if ($p['is_radius']) {
                if (empty($p['pool_expired'])) {
                    print_r(Radius::customerDeactivate($c['username']));
                } else {
                    Radius::upsertCustomerAttr($c['username'], 'Framed-Pool', $p['pool_expired'], ':=');
                    print_r(Radius::disconnectCustomer($c['username']));
                }
            } else {
                try {
                    $client = Mikrotik::getClient($m['ip_address'], $m['username'], $m['password']);
                    if (!empty($p['pool_expired'])) {
                        Mikrotik::setHotspotUserPackage($client, $c['username'], 'EXPIRED FREEISPRADIUS ' . $p['pool_expired']);
                    } else {
                        Mikrotik::removeHotspotUser($client, $c['username']);
                    }
                    Mikrotik::removeHotspotActiveUser($client, $c['username']);
                } catch (Exception $e) {
                    echo "Failed to connect to router: " . $m['ip_address'] . "\n";
                    echo "Error: " . $e->getMessage() . "\n";
                    continue; // Skip to the next router
                }
            }
    


            $planPrice = (float)$p['price'];

            // 3) Check if user has enough balance
            if ($c['balance'] >= $planPrice) {
                // Customer can pay for renewal from balance
                echo "Customer has sufficient balance ({$c['balance']}). Skipping 'expired' SMS.\n";
            } else {
                // 4) They do NOT have enough balance —> send the expired message
                if ($config['hotspot_sms'] == 'yes') {
                    $priceFormatted = Lang::moneyFormat($p['price']);
                    echo Message::sendHotspotExpiryNotification(
                        $c,               // $customer
                        $u['namebp'],     // $package
                        $priceFormatted,  // $price
                        $config['user_notification_expired']  // $via
                    ) . "\n";
                }
            }
    
// Update database user with status 'off'
$u->status = 'off';
// Update disconnection_reason and disconnection_time
$u->disconnection_reason = 'expired';
$u->disconnection_time = date('Y-m-d H:i:s');
$u->save();
    
            // Auto-renewal from deposit
            if ($config['enable_balance'] == 'yes' && $c['auto_renewal']) {
                if ($p && $p['enabled'] && $c['balance'] >= $p['price']) {
                    if (Package::rechargeUser($ds['customer_id'], $p['routers'], $p['id'], 'Customer', 'Balance')) {
                        // If success, then deduct the balance
                        Balance::min($ds['customer_id'], $p['price']);
                        echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                        echo "auto renewal Success\n";
                    } else {
                        echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                        echo "auto renewal Failed\n";
                        Message::sendTelegram("FAILED RENEWAL #cron\n\n#u$c[username] #buy #Hotspot \n" . $p['name_plan'] .
                            "\nRouter: " . $p['routers'] .
                            "\nPrice: " . $p['price']);
                    }
                } else {
                    echo "no renewal | plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                }
            } else {
                echo "no renewal | balance $config[enable_balance] auto_renewal $c[auto_renewal]\n";
            }
        } else {
            echo " : ACTIVE \r\n";
        }
    }
    
    elseif ($ds['type'] == 'Static') {
                $date_now = strtotime(date("Y-m-d H:i:s"));
                $expiration = strtotime($ds['expiration'] . ' ' . $ds['time']);
                echo $ds['expiration'] . " : " . (($isCli) ? $ds['username'] : Lang::maskText($ds['username']));
                if ($date_now >= $expiration) {
                    echo " : EXPIRED \r\n";
                    $u = ORM::for_table('tbl_user_recharges')->where('id', $ds['id'])->find_one();
                    $c = ORM::for_table('tbl_customers')->where('id', $ds['customer_id'])->find_one();
                    $m = Mikrotik::info($ds['routers']);
                    $p = ORM::for_table('tbl_plans')->where('id', $u['plan_id'])->find_one();
                    $price = Lang::moneyFormat($p['price']);
                    if ($p['is_radius']) {
                        if (empty($p['pool_expired'])) {
                            print_r(Radius::customerDeactivate($c['username']));
                        } else {
                            Radius::upsertCustomerAttr($c['username'], 'Framed-Pool', $p['pool_expired'], ':=');
                            print_r(Radius::disconnectCustomer($c['username']));
                        }
                    } else {
                        try {
                            $client = Mikrotik::getClient($m['ip_address'], $m['username'], $m['password']);
                            Mikrotik::removeStaticUser($client, $c['username']);
                        } catch (Exception $e) {
                            echo "Failed to connect to router: " . $m['ip_address'] . "\n";
                            echo "Error: " . $e->getMessage() . "\n";
                            continue; // Skip to the next router
                        }
                    }
                
                    
           
            $planPrice = (float)$p['price'];

            // 3) Check if user has enough balance
            if ($c['balance'] >= $planPrice) {
                // Customer can pay for renewal from balance
                echo "Customer has sufficient balance ({$c['balance']}). Skipping 'expired' SMS.\n";
            } else {
                // 4) They do NOT have enough balance —> send the expired message
                if ($config['static_sms'] == 'yes') {
                    $priceFormatted = Lang::moneyFormat($p['price']);
                    echo Message::sendPackageNotification(
                        $c, 
                        $u['namebp'], 
                        $priceFormatted, 
                        $textExpired, 
                        $config['user_notification_expired']
                    ) . "\n";
                }
            }
                    //update database user dengan status off
// Update database user with status 'off'
$u->status = 'off';
// Update disconnection_reason and disconnection_time
$u->disconnection_reason = 'expired';
$u->disconnection_time = date('Y-m-d H:i:s');
$u->save();
        
                    // autorenewal from deposit
                    if ($config['enable_balance'] == 'yes' && $c['auto_renewal']) {
                        if ($p && $p['enabled'] && $c['balance'] >= $p['price']) {
                            if (Package::rechargeUser($ds['customer_id'], $p['routers'], $p['id'], 'Customer', 'Balance')) {
                                // if success, then get the balance
                                Balance::min($ds['customer_id'], $p['price']);
                                echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                                echo "auto renewall Success\n";
                            } else {
                                echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                                echo "auto renewall Failed\n";
                                Message::sendTelegram("FAILED RENEWAL #cron\n\n#u$c[username] #buy #Hotspot \n" . $p['name_plan'] .
                                    "\nRouter: " . $p['routers'] .
                                    "\nPrice: " . $p['price']);
                            }
                        } else {
                            echo "no renewall | plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                        }
                    } else {
                        echo "no renewall | balance $config[enable_balance] auto_renewal $c[auto_renewal]\n";
                    }
                } else
                    echo " : ACTIVE \r\n";


    } 
    
    else {
        $date_now = strtotime(date("Y-m-d H:i:s"));
        $expiration = strtotime($ds['expiration'] . ' ' . $ds['time']);
        echo $ds['expiration'] . " : " . (($isCli) ? $ds['username'] : Lang::maskText($ds['username']));
    
        if ($date_now >= $expiration) {
            echo " : EXPIRED \r\n";
    
            // Fetch the necessary user and plan information
            $u = ORM::for_table('tbl_user_recharges')->where('id', $ds['id'])->find_one();
            $c = ORM::for_table('tbl_customers')->where('id', $ds['customer_id'])->find_one();
            $m = ORM::for_table('tbl_routers')->where('name', $ds['routers'])->find_one();
            $p = ORM::for_table('tbl_plans')->where('id', $u['plan_id'])->find_one();
            $price = Lang::moneyFormat($p['price']);
    
            // Check if the plan has 'is_radius' enabled and handle accordingly
            if ($p['is_radius']) {
                if (empty($p['pool_expired'])) {
                    print_r(Radius::customerDeactivate($c['username']));
                } else {
                    // Move user to the expired pool
                    Radius::upsertCustomerAttr($c['username'], 'Framed-Pool', $p['pool_expired'], ':=');
                    print_r(Radius::disconnectCustomer($c['username']));
                }
            } else {
                try {
                    // Connect to the Mikrotik router
                    $client = Mikrotik::getClient($m['ip_address'], $m['username'], $m['password']);
    
                    if (!empty($p['pool_expired'])) {
                        // Set the PPPoE user to the expired pool
                        Mikrotik::setPpoeUserPlan($client, $c['username'], 'EXPIRED FREEISPRADIUS ' . $p['pool_expired']);
                    } else {
                        // Remove the PPPoE user if there's no expired pool set
                        Mikrotik::removePpoeUser($client, $c['username']);
                    }
    
                    // Remove the user from active PPPoE connections
                    Mikrotik::removePpoeActive($client, $c['username']);
                } catch (Exception $e) {
                    echo "Failed to connect to router: " . $m['ip_address'] . "\n";
                    echo "Error: " . $e->getMessage() . "\n";
                    continue; // Skip to the next router
                }
            }
    
           
            $planPrice = (float)$p['price'];

            // 3) Check if user has enough balance
            if ($c['balance'] >= $planPrice) {
                // Customer can pay for renewal from balance
                echo "Customer has sufficient balance ({$c['balance']}). Skipping 'expired' SMS.\n";
            } else {
                // 4) They do NOT have enough balance —> send the expired message
                if ($config['pppoe_sms'] == 'yes') {
                    $priceFormatted = Lang::moneyFormat($p['price']);
                    echo Message::sendPackageNotification(
                        $c, 
                        $u['namebp'], 
                        $priceFormatted, 
                        $textExpired, 
                        $config['user_notification_expired']
                    ) . "\n";
                }
            }


    
// Update database user with status 'off'
$u->status = 'off';
// Update disconnection_reason and disconnection_time
$u->disconnection_reason = 'expired';
$u->disconnection_time = date('Y-m-d H:i:s');
$u->save();
    
            // Handle auto-renewal from balance if enabled
            if ($config['enable_balance'] == 'yes' && $c['auto_renewal']) {
                if ($p && $p['enabled'] && $c['balance'] >= $p['price']) {
                    if (Package::rechargeUser($ds['customer_id'], $p['routers'], $p['id'], 'Customer', 'Balance')) {
                        // Deduct the balance after a successful renewal
                        Balance::min($ds['customer_id'], $p['price']);
                        echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                        echo "auto renewal Success\n";
                    } else {
                        echo "plan enabled: $p[enabled] | User balance: $c[balance] | price $p[price]\n";
                        echo "auto renewal Failed\n";
                        Message::sendTelegram("FAILED RENEWAL #cron\n\n#u$c[username] #buy #PPPOE \n" . $p['name_plan'] .
                            "\nRouter: " . $p['routers'] . "\nPrice: " . $p['price']);
                    }
                }
            }
        } else {
            echo " : ACTIVE \r\n";
        }
    }
}    