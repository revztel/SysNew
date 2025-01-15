<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Query;
use PEAR2\Net\RouterOS\Request;

include "../init.php";

$isCli = true;
if (php_sapi_name() !== 'cli') {
    $isCli = false;
    echo "<pre>";
}

$logFile = __DIR__ . '/../removehotspot.log';

// Function to write log messages to a file with a limit of 1000 lines
function logMessage($message) {
    global $logFile;
    $maxLines = 5000;
    
    // Read existing log file
    $logs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES) : [];
    
    // Add new log message
    $logs[] = $message;
    
    // Keep only the last 1000 lines
    if (count($logs) > $maxLines) {
        $logs = array_slice($logs, -$maxLines);
    }
    
    // Write back to the log file
    file_put_contents($logFile, implode("\n", $logs) . "\n");
}

logMessage("PHP Time\t" . date('Y-m-d H:i:s'));
$res = ORM::raw_execute('SELECT NOW() AS WAKTU;');
$statement = ORM::get_last_statement();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    logMessage("MYSQL Time\t" . $row['WAKTU']);
}

echo "PHP Time\t" . date('Y-m-d H:i:s') . "\n";
$res = ORM::raw_execute('SELECT NOW() AS WAKTU;');
$statement = ORM::get_last_statement();
$rows = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "MYSQL Time\t" . $row['WAKTU'] . "\n";
}

$_c = $config;// Check if columns `state` and `last_seen` exist in tbl_user_recharges, if not, add them
$columns = ORM::for_table('tbl_user_recharges')->raw_query("SHOW COLUMNS FROM `tbl_user_recharges` LIKE 'state'")->find_one();
if (!$columns) {
    ORM::raw_execute("ALTER TABLE `tbl_user_recharges` ADD COLUMN `state` VARCHAR(10) NOT NULL DEFAULT 'Offline'");
}

$columns = ORM::for_table('tbl_user_recharges')->raw_query("SHOW COLUMNS FROM `tbl_user_recharges` LIKE 'last_seen'")->find_one();
if (!$columns) {
    ORM::raw_execute("ALTER TABLE `tbl_user_recharges` ADD COLUMN `last_seen` DATETIME NULL DEFAULT NULL");
}

function handleNotificationsAndUpdateState($router, $currentState) {
    logMessage("Reached handleNotificationsAndUpdateState function for Router ID " . $router['id']);
    
    // Fetch the previous state directly using SQL
    $cacheQuery = "SELECT prev_state FROM tbl_router_cache WHERE router_id = :routerId";
    $cacheParams = array(':routerId' => $router['id']);
    $cacheStatement = ORM::get_db()->prepare($cacheQuery);
    $cacheStatement->execute($cacheParams);
    $cache = $cacheStatement->fetch(PDO::FETCH_ASSOC);

    if ($cache) {
        $previousState = $cache['prev_state'];
        logMessage("Router ID " . $router['id'] . ": Current state is " . $currentState . ", Previous state is " . $previousState);
        
        // Fetch the notification phone number from the app config
        $notificationConfig = ORM::for_table('tbl_appconfig')->where('setting', 'router_notifications')->find_one();
        $phone = $notificationConfig ? $notificationConfig->value : '';
        $router['notification_phone'] = $phone;
        logMessage("Router ID " . $router['id'] . ": Notification phone is " . $phone);
        
        if ($currentState === 'Offline' && $previousState !== 'Offline') {
            // Send offline notification
            // Existing notification code...
                  // Send offline notification
                  $offlineMessage = "Router [[router_name]] ([[router_ip]]) is offline!";
                  $message = str_replace('[[router_name]]', $router['name'], $offlineMessage);
                  $message = str_replace('[[router_ip]]', $router['ip_address'], $message);
                  
                  Message::sendRouterStatusNotification($router, $message, 'sms');
                  logMessage("Sent offline notification for Router ID " . $router['id']);
            // Log the offline event
            $event = ORM::for_table('tbl_router_status_history')->create();
            $event->router_id = $router['id'];
            $event->event_type = 'Offline';
            $event->timestamp = date('Y-m-d H:i:s');
            $event->save();

            logMessage("Logged offline event for Router ID " . $router['id']);
        } elseif ($currentState === 'Online' && $previousState !== 'Online') {
            // Send online notification
            // Existing notification code...
                    // Send online notification
                    $onlineMessage = "Router [[router_name]] ([[router_ip]]) is back online!";
                    $message = str_replace('[[router_name]]', $router['name'], $onlineMessage);
                    $message = str_replace('[[router_ip]]', $router['ip_address'], $message);
                    
                    Message::sendRouterStatusNotification($router, $message, 'sms');
                    logMessage("Sent online notification for Router ID " . $router['id']);
            // Log the online event
            $event = ORM::for_table('tbl_router_status_history')->create();
            $event->router_id = $router['id'];
            $event->event_type = 'Online';
            $event->timestamp = date('Y-m-d H:i:s');
            $event->save();

            logMessage("Logged online event for Router ID " . $router['id']);
        } else {
            logMessage("No state change for Router ID " . $router['id'] . ": Current state is " . $currentState . ", Previous state is " . $previousState);
        }

        // Update the previous state to the current state using direct SQL
        logMessage("Updating prev_state for Router ID " . $router['id'] . " from " . $previousState . " to " . $currentState);
        $updateQuery = "UPDATE tbl_router_cache SET prev_state = :currentState WHERE router_id = :routerId";
        $params = array(':currentState' => $currentState, ':routerId' => $router['id']);
        $result = ORM::raw_execute($updateQuery, $params);
        
        if ($result) {
            logMessage("Successfully updated prev_state for Router ID " . $router['id'] . " to " . $currentState);
        } else {
            logMessage("Failed to update prev_state for Router ID " . $router['id']);
        }
    } else {
        logMessage("No cache found for Router ID " . $router['id']);
    }
}



// Check if the prev_state column exists in tbl_router_cache, if not, add it
$columnCheck = ORM::for_table('tbl_router_cache')->raw_query("SHOW COLUMNS FROM `tbl_router_cache` LIKE 'prev_state'")->find_one();
if (!$columnCheck) {
    logMessage("Adding prev_state column to tbl_router_cache.");
    ORM::raw_execute("ALTER TABLE `tbl_router_cache` ADD COLUMN `prev_state` VARCHAR(10) DEFAULT NULL");
} else {
    logMessage("Column prev_state already exists in tbl_router_cache.");
}

// Check if the last_seen column exists in tbl_router_cache, if not, add it
$columnCheck = ORM::for_table('tbl_router_cache')->raw_query("SHOW COLUMNS FROM `tbl_router_cache` LIKE 'last_seen'")->find_one();
if (!$columnCheck) {
    logMessage("Adding last_seen column to tbl_router_cache.");
    ORM::raw_execute("ALTER TABLE `tbl_router_cache` ADD COLUMN `last_seen` DATETIME DEFAULT NULL");
} else {
    logMessage("Column last_seen already exists in tbl_router_cache.");
}


// Fetch all routers
$routers = ORM::for_table('tbl_routers')->find_many();

foreach ($routers as $router) {
    logMessage("Processing Router ID " . $router['id']);
    
    try {
        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
        
        // Perform a simple API request to check connectivity
        $pingRequest = new RouterOS\Request('/system/identity/print');
        $pingResponse = $client->sendSync($pingRequest);
        
        $resourceRequest = new RouterOS\Request('/system/resource/print');
        $resourceResponse = $client->sendSync($resourceRequest);
        
        $uptime = $resourceResponse->getProperty('uptime');
        $model = $resourceResponse->getProperty('board-name');
        
        $cache = ORM::for_table('tbl_router_cache')->where('router_id', $router['id'])->find_one();
        
        if ($cache) {
            // If an entry exists, update it with the new information
            $updateQuery = "UPDATE tbl_router_cache SET state = 'Online', uptime = :uptime, model = :model, last_seen = NULL WHERE router_id = :routerId";
            $updateParams = array(':uptime' => $uptime, ':model' => $model, ':routerId' => $router['id']);
            $updateResult = ORM::raw_execute($updateQuery, $updateParams);
            
            echo "Router " . $router['id'] . " updated successfully.\n";
        } else {
            // If no entry exists, create a new one
            $insertQuery = "INSERT INTO tbl_router_cache (router_id, state, uptime, model) VALUES (:routerId, 'Online', :uptime, :model)";
            $insertParams = array(':routerId' => $router['id'], ':uptime' => $uptime, ':model' => $model);
            $insertResult = ORM::raw_execute($insertQuery, $insertParams);
            
            echo "Router " . $router['id'] . " added successfully.\n";
        }

        logMessage("Calling handleNotificationsAndUpdateState for Router ID " . $router['id']);
        handleNotificationsAndUpdateState($router, 'Online');

    } catch (Exception $e) {
        logMessage("Error with router ID " . $router['id'] . ": " . $e->getMessage());
        
        // Check if an entry exists in the cache table
        $cache = ORM::for_table('tbl_router_cache')->where('router_id', $router['id'])->find_one();
        
        if ($cache) {
            // If an entry exists, update it with the offline status, keeping the model unchanged if it was already set
            $lastSeen = $cache['last_seen'] ? $cache['last_seen'] : date('Y-m-d H:i:s');
            $model = $cache['model'] ? $cache['model'] : $model;
            $updateQuery = "UPDATE tbl_router_cache SET state = 'Offline', uptime = NULL, last_seen = :lastSeen WHERE router_id = :routerId";
            $updateParams = array(':routerId' => $router['id'], ':lastSeen' => $lastSeen);
            $updateResult = ORM::raw_execute($updateQuery, $updateParams);
            
            echo "Router " . $router['id'] . " updated with offline status.\n";
        } else {
            // If no entry exists, create a new one with the offline status
            $insertQuery = "INSERT INTO tbl_router_cache (router_id, state, uptime, model, last_seen) VALUES (:routerId, 'Offline', NULL, :model, :lastSeen)";
            $insertParams = array(':routerId' => $router['id'], ':model' => $model, ':lastSeen' => date('Y-m-d H:i:s'));
            $insertResult = ORM::raw_execute($insertQuery, $insertParams);
            
            echo "Router " . $router['id'] . " added with offline status.\n";
        }

        logMessage("Calling handleNotificationsAndUpdateState for Router ID " . $router['id']);
        handleNotificationsAndUpdateState($router, 'Offline');
    }
}

// Check if the tbl_router_status_history table exists, if not, create it
try {
    // Execute a raw SQL query to check if the table exists
    $tableCheck = ORM::for_table('tbl_router_status_history')->raw_query("SHOW TABLES LIKE 'tbl_router_status_history'")->find_one();

    if (!$tableCheck) {
        logMessage("Creating tbl_router_status_history table.");
        
        // Create the tbl_router_status_history table
        $createTableQuery = "
            CREATE TABLE `tbl_router_status_history` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `router_id` int(11) NOT NULL,
                `event_type` varchar(10) NOT NULL,
                `timestamp` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        ORM::raw_execute($createTableQuery);
        logMessage("Table tbl_router_status_history created successfully.");
    } else {
        logMessage("Table tbl_router_status_history already exists.");
    }
} catch (Exception $e) {
    logMessage("Error while checking or creating tbl_router_status_history table: " . $e->getMessage());
}




function fetchDataUsageFromRouters($client, $customers) {
    $dataUsage = array();

    try {
        // Fetch queue list
        $printRequest = new RouterOS\Request('/queue/simple/print');
        $printRequest->setArgument('.proplist', '.id,name,bytes');
        $queueList = $client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

        foreach ($queueList as $queue) {
            $name = $queue->getProperty('name');
            $bytesData = $queue->getProperty('bytes');

            // Split the bytes data into upload and download values
            list($uploadBytes, $downloadBytes) = explode('/', $bytesData);

            // Initialize a flag to track if a customer is found for the queue
            $customerFound = false;

            // Identify the customer based on the queue name
            foreach ($customers as $customer) {
                if (strpos($name, '<hotspot-' . $customer['username'] . '>') !== false ||
                    strpos($name, '<pppoe-' . $customer['username'] . '>') !== false ||
                    strpos($name, 'Queue-' . $customer['username']) === 0) {

                    if (!isset($dataUsage[$customer['id']])) {
                        $dataUsage[$customer['id']] = array(
                            'upload' => 0,
                            'download' => 0
                        );
                    }

                    // Add the upload and download bytes to the customer's data usage
                    $dataUsage[$customer['id']]['upload'] += $uploadBytes;
                    $dataUsage[$customer['id']]['download'] += $downloadBytes;
                    // Set the flag to indicate that a customer is found for the queue
                    $customerFound = true;

                    break;
                }
            }

            // Log if no customer is found for the queue
            if (!$customerFound) {
                // You can log this information if necessary
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }

    return $dataUsage;
}
function updateDataUsageInDatabase($customerId, $uploadUsage, $downloadUsage) {
    try {
        // Check if a record exists for the customer in the tbl_data_usage table
        $dataUsageRecord = ORM::for_table('tbl_data_usage')
            ->where('customer_id', $customerId)
            ->find_one();

        if ($dataUsageRecord) {
            // Record exists, compare the values and update accordingly
            $oldUpload = $dataUsageRecord->get('old_upload');
            $oldDownload = $dataUsageRecord->get('old_download');
            $prevUpload = $dataUsageRecord->get('prev_upload');
            $prevDownload = $dataUsageRecord->get('prev_download');

            if ($uploadUsage >= $prevUpload && $downloadUsage >= $prevDownload) {
                // Router hasn't rebooted, update the old and new data usage
                $uploadDiff = $uploadUsage - $prevUpload;
                $downloadDiff = $downloadUsage - $prevDownload;
                $dataUsageRecord->set('old_upload', $oldUpload + $uploadDiff);
                $dataUsageRecord->set('old_download', $oldDownload + $downloadDiff);
            } else {
                // Router has rebooted, calculate the difference and add it to the old data usage
                $uploadDiff = $uploadUsage;
                $downloadDiff = $downloadUsage;
                $dataUsageRecord->set('old_upload', $oldUpload + $uploadDiff);
                $dataUsageRecord->set('old_download', $oldDownload + $downloadDiff);
            }

            // Update the previous, new, upload, and download values
            $dataUsageRecord->set('prev_upload', $uploadUsage);
            $dataUsageRecord->set('prev_download', $downloadUsage);
            $dataUsageRecord->set('new_upload', $uploadUsage);
            $dataUsageRecord->set('new_download', $downloadUsage);
            $dataUsageRecord->set('upload', $oldUpload + $uploadDiff);
            $dataUsageRecord->set('download', $oldDownload + $downloadDiff);
            $dataUsageRecord->set('updated_at', date('Y-m-d H:i:s'));
            $dataUsageRecord->save();

            // Update daily data usage with the difference (incremental usage)
            updateDailyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update weekly data usage with the difference
            updateWeeklyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update monthly data usage with the difference
            updateMonthlyDataUsage($customerId, $uploadDiff, $downloadDiff);

        } else {
            // Record doesn't exist, create a new record with the customer ID and data usage values
            $dataUsageRecord = ORM::for_table('tbl_data_usage')->create();
            $dataUsageRecord->set('customer_id', $customerId);
            $dataUsageRecord->set('old_upload', $uploadUsage);
            $dataUsageRecord->set('old_download', $downloadUsage);
            $dataUsageRecord->set('prev_upload', $uploadUsage);
            $dataUsageRecord->set('prev_download', $downloadUsage);
            $dataUsageRecord->set('new_upload', $uploadUsage);
            $dataUsageRecord->set('new_download', $downloadUsage);
            $dataUsageRecord->set('upload', $uploadUsage);
            $dataUsageRecord->set('download', $downloadUsage);
            $dataUsageRecord->set('updated_at', date('Y-m-d H:i:s'));
            $dataUsageRecord->save();

            // Since it's the first record, the difference is the usage itself
            updateDailyDataUsage($customerId, $uploadUsage, $downloadUsage);

            // Update weekly data usage
            updateWeeklyDataUsage($customerId, $uploadUsage, $downloadUsage);

            // Update monthly data usage
            updateMonthlyDataUsage($customerId, $uploadUsage, $downloadUsage);
        }

        // After updating data usage, check for FUP
        // Fetch the customer record


    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

function updateDailyDataUsage($customerId, $uploadDiff, $downloadDiff) {
    try {
        // Check if a record exists for the customer and current date in the tbl_daily_data_usage table
        $dailyDataUsageRecord = ORM::for_table('tbl_daily_data_usage')
            ->where('customer_id', $customerId)
            ->where('date', date('Y-m-d'))
            ->find_one();

        if ($dailyDataUsageRecord) {
            // Accumulate the upload and download values
            $dailyDataUsageRecord->set('upload', $dailyDataUsageRecord->get('upload') + $uploadDiff);
            $dailyDataUsageRecord->set('download', $dailyDataUsageRecord->get('download') + $downloadDiff);
            $dailyDataUsageRecord->save();
        } else {
            // Create a new daily data usage record for the current date
            $dailyDataUsageRecord = ORM::for_table('tbl_daily_data_usage')->create();
            $dailyDataUsageRecord->set('customer_id', $customerId);
            $dailyDataUsageRecord->set('upload', $uploadDiff);
            $dailyDataUsageRecord->set('download', $downloadDiff);
            $dailyDataUsageRecord->set('date', date('Y-m-d'));
            $dailyDataUsageRecord->save();
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

function updateWeeklyDataUsage($customerId, $uploadDiff, $downloadDiff) {
    try {
        // Set the desired timezone
        $timezone = new DateTimeZone('Africa/Nairobi'); // Replace with your timezone, e.g., 'America/New_York'
        $currentDate = new DateTime('now', $timezone);
        
        // Get the current ISO week number and ISO year
        $weekNumber = $currentDate->format('W');
        $isoYear = $currentDate->format('o');
        
        // Calculate the start (Monday) and end (Sunday) dates of the current week using DateTimeImmutable
        $date = new DateTimeImmutable();
        $weekStartDate = $date->setISODate($isoYear, $weekNumber)->format('Y-m-d');
        $weekEndDate = $date->setISODate($isoYear, $weekNumber)->modify('+6 days')->format('Y-m-d');
        
        // Get the current day of the week in lowercase
        $currentDay = strtolower($currentDate->format('l'));
        
        // Validate currentDay
        $validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        if (!in_array($currentDay, $validDays)) {
            throw new Exception("Invalid day of the week: {$currentDay}");
        }
        
        // Begin a transaction to ensure atomicity
        ORM::get_db()->beginTransaction();
        
        // Fetch the existing weekly data usage record
        $weeklyDataUsageRecord = ORM::for_table('tbl_weekly_data_usage')
            ->where('customer_id', $customerId)
            ->where('week_start_date', $weekStartDate)
            ->where('week_end_date', $weekEndDate)
            ->find_one();
        
        if ($weeklyDataUsageRecord) {
            // Retrieve current upload/download values, defaulting to 0 if null
            $currentUpload = (int) $weeklyDataUsageRecord->get("{$currentDay}_upload") ?: 0;
            $currentDownload = (int) $weeklyDataUsageRecord->get("{$currentDay}_download") ?: 0;
            
            // Update the upload and download values
            $weeklyDataUsageRecord->set("{$currentDay}_upload", $currentUpload + $uploadDiff);
            $weeklyDataUsageRecord->set("{$currentDay}_download", $currentDownload + $downloadDiff);
            $weeklyDataUsageRecord->save();
        } else {
            // Create a new weekly data usage record
            $weeklyDataUsageRecord = ORM::for_table('tbl_weekly_data_usage')->create();
            $weeklyDataUsageRecord->set('customer_id', $customerId);
            $weeklyDataUsageRecord->set('week_start_date', $weekStartDate);
            $weeklyDataUsageRecord->set('week_end_date', $weekEndDate);
            
            // Initialize all days' upload and download to zero
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            foreach ($days as $day) {
                $weeklyDataUsageRecord->set("{$day}_upload", 0);
                $weeklyDataUsageRecord->set("{$day}_download", 0);
            }
            
            // Set the current day's upload and download
            $weeklyDataUsageRecord->set("{$currentDay}_upload", $uploadDiff);
            $weeklyDataUsageRecord->set("{$currentDay}_download", $downloadDiff);
            $weeklyDataUsageRecord->save();
        }
        
        // Commit the transaction
        ORM::get_db()->commit();
        
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        ORM::get_db()->rollBack();
        error_log("Error in updateWeeklyDataUsage for customer_id {$customerId}: " . $e->getMessage());
    }
}

function updateMonthlyDataUsage($customerId, $uploadDiff, $downloadDiff) {
    try {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Array of month names
        $monthNames = array(
            '01' => 'january',
            '02' => 'february',
            '03' => 'march',
            '04' => 'april',
            '05' => 'may',
            '06' => 'june',
            '07' => 'july',
            '08' => 'august',
            '09' => 'september',
            '10' => 'october',
            '11' => 'november',
            '12' => 'december'
        );

        // Get the current month name
        $currentMonthName = $monthNames[$currentMonth];

        // Check if a record exists for the customer and current year in the tbl_monthly_data_usage table
        $monthlyDataUsageRecord = ORM::for_table('tbl_monthly_data_usage')
            ->where('customer_id', $customerId)
            ->where('year', $currentYear)
            ->find_one();

        if ($monthlyDataUsageRecord) {
            // Accumulate the upload and download values for the current month
            $monthColumnUpload = $currentMonthName . '_upload';
            $monthColumnDownload = $currentMonthName . '_download';

            $currentUpload = $monthlyDataUsageRecord->get($monthColumnUpload);
            $currentDownload = $monthlyDataUsageRecord->get($monthColumnDownload);

            $monthlyDataUsageRecord->set($monthColumnUpload, $currentUpload + $uploadDiff);
            $monthlyDataUsageRecord->set($monthColumnDownload, $currentDownload + $downloadDiff);
            $monthlyDataUsageRecord->save();
        } else {
            // Create a new record with the customer ID, year, and data usage for all months
            $monthlyDataUsageRecord = ORM::for_table('tbl_monthly_data_usage')->create();
            $monthlyDataUsageRecord->set('customer_id', $customerId);
            $monthlyDataUsageRecord->set('year', $currentYear);

            // Initialize all months to zero
            foreach ($monthNames as $monthNumber => $monthName) {
                $monthColumnUpload = $monthName . '_upload';
                $monthColumnDownload = $monthName . '_download';

                if ($monthNumber == $currentMonth) {
                    $monthlyDataUsageRecord->set($monthColumnUpload, $uploadDiff);
                    $monthlyDataUsageRecord->set($monthColumnDownload, $downloadDiff);
                } else {
                    $monthlyDataUsageRecord->set($monthColumnUpload, 0);
                    $monthlyDataUsageRecord->set($monthColumnDownload, 0);
                }
            }
            $monthlyDataUsageRecord->save();
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}


// Function to create tables if they don't exist
function createTablesIfNotExists() {
    try {
        // Check if the tbl_data_usage table exists
        $dataUsageTableExists = ORM::for_table('tbl_data_usage')->raw_query("SHOW TABLES LIKE 'tbl_data_usage'")->find_one();

        if (!$dataUsageTableExists) {
            // Create the tbl_data_usage table
            $dataUsageTableQuery = "CREATE TABLE `tbl_data_usage` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `customer_id` int(11) NOT NULL,
                `old_upload` bigint(20) NOT NULL DEFAULT '0',
                `old_download` bigint(20) NOT NULL DEFAULT '0',
                `prev_upload` bigint(20) NOT NULL DEFAULT '0',
                `prev_download` bigint(20) NOT NULL DEFAULT '0',
                `new_upload` bigint(20) NOT NULL DEFAULT '0',
                `new_download` bigint(20) NOT NULL DEFAULT '0',
                `upload` bigint(20) NOT NULL DEFAULT '0',
                `download` bigint(20) NOT NULL DEFAULT '0',
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                KEY `customer_id` (`customer_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($dataUsageTableQuery);
        }

        // Check if the tbl_daily_data_usage table exists
        $dailyDataUsageTableExists = ORM::for_table('tbl_daily_data_usage')->raw_query("SHOW TABLES LIKE 'tbl_daily_data_usage'")->find_one();

        if (!$dailyDataUsageTableExists) {
            // Create the tbl_daily_data_usage table
            $dailyDataUsageTableQuery = "CREATE TABLE `tbl_daily_data_usage` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `customer_id` int(11) NOT NULL,
                `upload` bigint(20) NOT NULL DEFAULT '0',
                `download` bigint(20) NOT NULL DEFAULT '0',
                `date` date NOT NULL,
                PRIMARY KEY (`id`),
                KEY `customer_id` (`customer_id`),
                KEY `date` (`date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($dailyDataUsageTableQuery);
        }

        // Check if the tbl_weekly_data_usage table exists
        $weeklyDataUsageTableExists = ORM::for_table('tbl_weekly_data_usage')->raw_query("SHOW TABLES LIKE 'tbl_weekly_data_usage'")->find_one();

        if (!$weeklyDataUsageTableExists) {
            // Create the tbl_weekly_data_usage table
            $weeklyDataUsageTableQuery = "CREATE TABLE `tbl_weekly_data_usage` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `customer_id` int(11) NOT NULL,
                `week_start_date` date NOT NULL,
                `week_end_date` date NOT NULL,
                `monday_upload` bigint(20) NOT NULL DEFAULT '0',
                `monday_download` bigint(20) NOT NULL DEFAULT '0',
                `tuesday_upload` bigint(20) NOT NULL DEFAULT '0',
                `tuesday_download` bigint(20) NOT NULL DEFAULT '0',
                `wednesday_upload` bigint(20) NOT NULL DEFAULT '0',
                `wednesday_download` bigint(20) NOT NULL DEFAULT '0',
                `thursday_upload` bigint(20) NOT NULL DEFAULT '0',
                `thursday_download` bigint(20) NOT NULL DEFAULT '0',
                `friday_upload` bigint(20) NOT NULL DEFAULT '0',
                `friday_download` bigint(20) NOT NULL DEFAULT '0',
                `saturday_upload` bigint(20) NOT NULL DEFAULT '0',
                `saturday_download` bigint(20) NOT NULL DEFAULT '0',
                `sunday_upload` bigint(20) NOT NULL DEFAULT '0',
                `sunday_download` bigint(20) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`),
                KEY `customer_id` (`customer_id`),
                KEY `week_start_date` (`week_start_date`),
                KEY `week_end_date` (`week_end_date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($weeklyDataUsageTableQuery);
        }

        // Check if the tbl_monthly_data_usage table exists
        $monthlyDataUsageTableExists = ORM::for_table('tbl_monthly_data_usage')->raw_query("SHOW TABLES LIKE 'tbl_monthly_data_usage'")->find_one();

        if (!$monthlyDataUsageTableExists) {
            // Create the tbl_monthly_data_usage table
            $monthlyDataUsageTableQuery = "CREATE TABLE `tbl_monthly_data_usage` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `customer_id` int(11) NOT NULL,
                `year` int(4) NOT NULL,
                `january_upload` bigint(20) NOT NULL DEFAULT '0',
                `january_download` bigint(20) NOT NULL DEFAULT '0',
                `february_upload` bigint(20) NOT NULL DEFAULT '0',
                `february_download` bigint(20) NOT NULL DEFAULT '0',
                `march_upload` bigint(20) NOT NULL DEFAULT '0',
                `march_download` bigint(20) NOT NULL DEFAULT '0',
                `april_upload` bigint(20) NOT NULL DEFAULT '0',
                `april_download` bigint(20) NOT NULL DEFAULT '0',
                `may_upload` bigint(20) NOT NULL DEFAULT '0',
                `may_download` bigint(20) NOT NULL DEFAULT '0',
                `june_upload` bigint(20) NOT NULL DEFAULT '0',
                `june_download` bigint(20) NOT NULL DEFAULT '0',
                `july_upload` bigint(20) NOT NULL DEFAULT '0',
                `july_download` bigint(20) NOT NULL DEFAULT '0',
                `august_upload` bigint(20) NOT NULL DEFAULT '0',
                `august_download` bigint(20) NOT NULL DEFAULT '0',
                `september_upload` bigint(20) NOT NULL DEFAULT '0',
                `september_download` bigint(20) NOT NULL DEFAULT '0',
                `october_upload` bigint(20) NOT NULL DEFAULT '0',
                `october_download` bigint(20) NOT NULL DEFAULT '0',
                `november_upload` bigint(20) NOT NULL DEFAULT '0',
                `november_download` bigint(20) NOT NULL DEFAULT '0',
                `december_upload` bigint(20) NOT NULL DEFAULT '0',
                `december_download` bigint(20) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`),
                KEY `customer_id` (`customer_id`),
                KEY `year` (`year`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($monthlyDataUsageTableQuery);
        }

        // Check if the tbl_cumulative_totals table exists
        $cumulativeTotalsTableExists = ORM::for_table('tbl_cumulative_totals')->raw_query("SHOW TABLES LIKE 'tbl_cumulative_totals'")->find_one();

        if (!$cumulativeTotalsTableExists) {
            // Create the tbl_cumulative_totals table
            $cumulativeTotalsTableQuery = "CREATE TABLE `tbl_cumulative_totals` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `customer_id` int(11) NOT NULL,
                `cumulative_upload` bigint(20) NOT NULL DEFAULT '0',
                `cumulative_download` bigint(20) NOT NULL DEFAULT '0',
                `last_reset_date` date NOT NULL,
                PRIMARY KEY (`id`),
                KEY `customer_id` (`customer_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($cumulativeTotalsTableQuery);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

// Call the function to create tables if they don't exist
createTablesIfNotExists();

// Main code
try {
    // Fetch all routers from the database
    $routers = ORM::for_table('tbl_routers')->find_many();

    foreach ($routers as $router) {
        try {
            $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

            // Get all customer accounts associated with the router
            $customers = ORM::for_table('tbl_customers')
                ->where('router_id', $router['id'])
                ->find_many();

            // Fetch data usage from queues for each customer
            $dataUsage = fetchDataUsageFromRouters($client, $customers);

            foreach ($dataUsage as $customerId => $usage) {
                // Update data usage in the database for the specific customer
                updateDataUsageInDatabase($customerId, $usage['upload'], $usage['download']);
            }

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
}







// Check if columns `state` and `last_seen` exist, if not, add them
$columns = ORM::for_table('tbl_user_recharges')->raw_query("SHOW COLUMNS FROM `tbl_user_recharges` LIKE 'state'")->find_one();
if (!$columns) {
    ORM::raw_execute("ALTER TABLE `tbl_user_recharges` ADD COLUMN `state` VARCHAR(10) NOT NULL DEFAULT 'Offline'");
}

$columns = ORM::for_table('tbl_user_recharges')->raw_query("SHOW COLUMNS FROM `tbl_user_recharges` LIKE 'last_seen'")->find_one();
if (!$columns) {
    ORM::raw_execute("ALTER TABLE `tbl_user_recharges` ADD COLUMN `last_seen` DATETIME NULL DEFAULT NULL");
}

















// Fetch all routers
$routers = ORM::for_table('tbl_routers')->find_many();

foreach ($routers as $router) {
    logMessage("Processing Router ID: " . $router['id']);
    try {
        logMessage("Attempting to establish connection to Router ID: " . $router['id'] . " at IP: " . $router['ip_address']);
        
        // Attempt to establish a connection to the router
        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
        
        logMessage("Connection to Router ID: " . $router['id'] . " successful.");
        
        // Fetch active users for hotspot, PPPoE, and queue
        logMessage("Fetching active users for Router ID: " . $router['id']);
        $hotspotUsers = $client->sendSync(new RouterOS\Request('/ip/hotspot/active/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);
        $pppoeUsers = $client->sendSync(new RouterOS\Request('/ppp/active/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);
        $queueUsers = $client->sendSync(new RouterOS\Request('/queue/simple/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);

        logMessage("Active users fetched for Router ID: " . $router['id']);

        // Fetch customers connected to this router
        $customers = ORM::for_table('tbl_customers')->where('router_id', $router['id'])->find_many();
        logMessage("Fetched " . count($customers) . " customers connected to Router ID: " . $router['id']);

        foreach ($customers as $customer) {
            logMessage("Processing customer: " . $customer['username']);
            $userRecharge = ORM::for_table('tbl_user_recharges')->where('username', $customer['username'])->find_one();

            if ($userRecharge) {
                logMessage("User recharge record found for customer: " . $customer['username']);
                if ($userRecharge->status == 'off') {
                    $userRecharge->state = 'Offline';
                    $userRecharge->save();
                    logMessage("Customer: " . $customer['username'] . " is inactive. Set to Offline.");
                    continue; // Skip further checks for this user
                }
            } else {
                logMessage("No user recharge record found for customer: " . $customer['username']);
            }

            $isOnline = false;

            // Check if the user is online in hotspot users
            foreach ($hotspotUsers as $activeUser) {
                if ($activeUser->getProperty('user') == $customer['username']) {
                    $isOnline = true;
                    logMessage("Customer: " . $customer['username'] . " is online in Hotspot.");
                    break;
                }
            }

            // Check if the user is online in PPPoE users
            foreach ($pppoeUsers as $activeUser) {
                if ($activeUser->getProperty('name') == $customer['username']) {
                    $isOnline = true;
                    logMessage("Customer: " . $customer['username'] . " is online in PPPoE.");
                    break;
                }
            }

            // Check if the user is online in queue users (assuming traffic passing check) and is a static user
            foreach ($queueUsers as $queueUser) {
                if (strpos($queueUser->getProperty('name'), 'Queue-') === 0) {
                    $staticUsername = str_replace('Queue-', '', $queueUser->getProperty('name'));
                    if ($staticUsername == $customer['username']) {
                        $traffic = explode('/', $queueUser->getProperty('bytes'));
                        if ($traffic[0] > 0 || $traffic[1] > 0) {
                            $isOnline = true;
                            logMessage("Customer: " . $customer['username'] . " is online in Queue with traffic.");
                            break;
                        }
                    }
                }
            }

            $state = $isOnline ? 'Online' : 'Offline';
            logMessage("Setting state for customer: " . $customer['username'] . " to " . $state);

            // Update user's state and last seen in tbl_user_recharges
            if ($userRecharge) {
                if ($userRecharge->state == 'Online' && $state == 'Offline') {
                    $userRecharge->last_seen = date('Y-m-d H:i:s');
                    logMessage("Customer: " . $customer['username'] . " went offline. Updating last_seen.");
                }
                $userRecharge->state = $state;
                $userRecharge->save();
                logMessage("State for customer: " . $customer['username'] . " updated to " . $state);
            }
        }

    } catch (Exception $e) {
        logMessage("Error with Router ID: " . $router['id'] . " - " . $e->getMessage());
        logMessage("Router ID " . $router['id'] . " is unreachable or offline. Setting all users to Offline.");

        try {
            // Update users based on matching the router name in tbl_user_recharges with the router name in tbl_routers
            $users = ORM::for_table('tbl_user_recharges')
                ->where('routers', $router['name'])
                ->find_many();
            logMessage("Fetched " . count($users) . " users associated with Router ID: " . $router['id']);

            // Update each user's state to Offline
            foreach ($users as $userRecharge) {
                logMessage("Setting state to Offline for user: " . $userRecharge->username);
                $userRecharge->state = 'Offline';
                $userRecharge->save();
                logMessage("User: " . $userRecharge->username . " set to Offline.");
            }
        } catch (Exception $e) {
            logMessage("Error updating users to Offline for Router ID: " . $router['id'] . " - " . $e->getMessage());
        }
    }
}





















$lastBackupFile = __DIR__ . '/../last_backup_date.txt';

$backupDir = __DIR__ . '/../backups';
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0777, true);
    logMessage("Created backup directory at $backupDir");
}


function performBackup() {
    global $lastBackupFile;
    
    $today = date('Y-m-d');
    $lastBackupDate = @file_get_contents($lastBackupFile);

    // If the last backup date is today, skip the backup
    if ($lastBackupDate === $today) {
        logMessage("Backup already performed today, exiting script.");
        return;
    }

    // Update the last backup date
    file_put_contents($lastBackupFile, $today);

    $routers = ORM::for_table('tbl_routers')->find_many();
    foreach ($routers as $router) {
        try {
            logMessage("Starting backup for router with IP: " . $router['ip_address']);
            
            $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

            // Save the backup on the router
            $backupName = 'freeispradius_backup_' . date('Ymd_His');
            $backup = new RouterOS\Request('/system/backup/save');
            $backup->setArgument('name', $backupName);
            $response = $client->sendSync($backup);
            logMessage("Backup save response: " . json_encode($response->getAllOfType(RouterOS\Response::TYPE_FINAL)));

            // Connect to the router via FTP
            $ftp = ftp_connect($router['ip_address']);
            if (!$ftp) {
                logMessage("Failed to connect to FTP server at " . $router['ip_address']);
                continue;
            }
            
            logMessage("Connected to FTP server at " . $router['ip_address']);
            
            if (!ftp_login($ftp, $router['username'], $router['password'])) {
                logMessage("Failed to login to FTP server at " . $router['ip_address'] . " with username " . $router['username']);
                ftp_close($ftp);
                continue;
            }
            
            ftp_pasv($ftp, true);
            logMessage("Logged in to FTP server and set passive mode");

            $remoteFile = $backupName . '.backup';
            $localFile = __DIR__ . '/../backups/' . $remoteFile;
            
            if (!file_exists(__DIR__ . '/../backups/')) {
                mkdir(__DIR__ . '/../backups/', 0777, true);
                logMessage("Created backups directory at " . __DIR__ . '/../backups/');
            }

            if (ftp_get($ftp, $localFile, $remoteFile, FTP_BINARY)) {
                logMessage("Successfully downloaded backup file $remoteFile to $localFile");
                ftp_close($ftp);
                saveBackupRecord($router['id'], $localFile);
                manageBackupRetention($router['id'], $client, $backupName);
            } else {
                logMessage("Failed to download backup file $remoteFile to $localFile");
                ftp_close($ftp);
            }
        } catch (Exception $e) {
            logMessage("Backup error for router with IP " . $router['ip_address'] . ": " . $e->getMessage());
        }
    }
}



function saveBackupRecord($router_id, $backupPath) {
    $backupDate = date('Y-m-d H:i:s');

    // Save the backup record to the database
    $backupRecord = ORM::for_table('tbl_router_backups')->create();
    $backupRecord->set('router_id', $router_id);
    $backupRecord->set('backup_date', $backupDate);
    $backupRecord->set('file_path', $backupPath);
    $backupRecord->save();

    logMessage("Backup record saved for router ID $router_id at $backupDate with path $backupPath");
}
function manageBackupRetention($router_id, $client, $backupName) {
    $backupDir = __DIR__ . '/../backups/';
    $maxBackups = 5;

    // Get all backup files for the server
    $backupFiles = glob($backupDir . 'freeispradius_backup_*.backup');

    // Sort the files by modification time in descending order (newest first)
    usort($backupFiles, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    // If there are more than $maxBackups, delete the oldest ones on the server
    if (count($backupFiles) > $maxBackups) {
        $filesToDelete = array_slice($backupFiles, $maxBackups);

        foreach ($filesToDelete as $file) {
            if (unlink($file)) {
                logMessage("Deleted old backup file from server: $file");
            } else {
                logMessage("Failed to delete old backup file from server: $file");
            }
        }
    }

    // Fetch backup files from the router
    try {
        logMessage("Fetching backup files from router");
        $request = new RouterOS\Request('/file/print');
        $response = $client->sendSync($request);
        $routerFiles = $response->getAllOfType(RouterOS\Response::TYPE_DATA);

        // Convert RouterOS response collection to an array of file names
        $routerFileNames = [];
        foreach ($routerFiles as $file) {
            $fileName = $file->getProperty('name');
            if (strpos($fileName, 'freeispradius_backup_') === 0) {
                $routerFileNames[] = $file;
            }
        }

        // Sort router backup files by creation time, oldest first
        usort($routerFileNames, function($a, $b) {
            return strtotime($a->getProperty('creation-time')) - strtotime($b->getProperty('creation-time'));
        });

        // Log the sorted backup files for debugging
        foreach ($routerFileNames as $file) {
            logMessage("Backup file on router: " . $file->getProperty('name') . ", created at: " . $file->getProperty('creation-time'));
        }

        // Check if there are more than $maxBackups and delete the oldest ones
        if (count($routerFileNames) > $maxBackups) {
            $filesToDelete = array_slice($routerFileNames, 0, count($routerFileNames) - $maxBackups);
            $fileNamesToDelete = array_map(function($file) {
                return $file->getProperty('name');
            }, $filesToDelete);

            foreach ($fileNamesToDelete as $fileName) {
                logMessage("Attempting to delete file from router: " . $fileName);
                $deleteRequest = new RouterOS\Request('/file/remove');
                $deleteRequest->setArgument('numbers', $fileName);
                $deleteResponse = $client->sendSync($deleteRequest);

                // Check if the delete operation was successful
                if ($deleteResponse->getType() === RouterOS\Response::TYPE_FINAL) {
                    logMessage("Deleted old backup file from router: " . $fileName);
                } else {
                    logMessage("Failed to delete old backup file from router: " . $fileName . ". Response: " . json_encode($deleteResponse->getAll()));
                }
            }
        }
    } catch (Exception $e) {
        logMessage("Exception while managing router backups: " . $e->getMessage());
    }
}



// Check if the tbl_router_backups table exists, if not, create it
$tableCheck = ORM::for_table('tbl_router_backups')->raw_query("SHOW TABLES LIKE 'tbl_router_backups'")->find_one();
if (!$tableCheck) {
    logMessage("Creating tbl_router_backups table.");
    ORM::raw_execute("
        CREATE TABLE tbl_router_backups (
            id INT NOT NULL AUTO_INCREMENT,
            router_id INT NOT NULL,
            backup_date DATETIME NOT NULL,
            file_path VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
} else {
    logMessage("Table tbl_router_backups already exists.");
}

// Perform the backup every time the script runs for testing purposes
performBackup();

function createTableIfNotExists($tableName, $createQuery) {
    $db = ORM::get_db();
    $result = $db->query("SHOW TABLES LIKE '{$tableName}'")->fetch();
    if (!$result) {
        $db->exec($createQuery);
        echo "Table {$tableName} created.\n";
    } else {
        echo "Table {$tableName} already exists.\n";
    }
}

// Create tbl_sms_groups table if not exists
createTableIfNotExists('tbl_sms_groups', "
    CREATE TABLE `tbl_sms_groups` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `group_name` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");

// Create tbl_sms_group_customers table if not exists
createTableIfNotExists('tbl_sms_group_customers', "
    CREATE TABLE `tbl_sms_group_customers` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `group_id` INT NOT NULL,
        `customer_id` INT NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`group_id`) REFERENCES `tbl_sms_groups`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");

// Create tbl_router_backups table if not exists
createTableIfNotExists('tbl_router_backups', "
    CREATE TABLE `tbl_router_backups` (
        id INT NOT NULL AUTO_INCREMENT,
        router_id INT NOT NULL,
        backup_date DATETIME NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");


// Drop and create the tbl_trials table
createTableIfNotExists('tbl_trials', "
    CREATE TABLE `tbl_trials` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `plan_id` INT NOT NULL,
        `time_limit` INT NOT NULL COMMENT 'Trial Uptime Limit in Minutes',
        `uptime_reset` INT NOT NULL COMMENT 'Trial Uptime Reset in Days',
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation time',
        `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record update time',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");

// Create tbl_active_sessions table if not exists
createTableIfNotExists('tbl_active_sessions', "
    CREATE TABLE `tbl_active_sessions` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `session_id` VARCHAR(128) NOT NULL,
        `user_id` INT NOT NULL,
        `last_activity` DATETIME NOT NULL,
        `ip_address` VARCHAR(45) NOT NULL,
        `user_agent` VARCHAR(255) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");
// Create tbl_recycle table if not exists
createTableIfNotExists('tbl_recycle', "
    CREATE TABLE `tbl_recycle` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `original_table` VARCHAR(255) NOT NULL,
        `original_id` INT NOT NULL,
        `data` LONGTEXT NOT NULL,
        `deleted_by` INT NOT NULL,
        `deleted_at` DATETIME NOT NULL,
        PRIMARY KEY (`id`),
        INDEX (`original_table`),
        INDEX (`original_id`),
        INDEX (`deleted_by`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");

createTableIfNotExists('tbl_fup', "
    CREATE TABLE `tbl_fup` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        `data_limit` BIGINT(20) NOT NULL DEFAULT '0',
        `data_limit_unit` VARCHAR(10) DEFAULT 'MB',
        `service_type` VARCHAR(20) NOT NULL,
        `router_id` INT(11) NOT NULL,
        `profile_on_limit` VARCHAR(100) NOT NULL,
        `active` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");


function addSettingIfNotExists($settingName, $value) {
    // Check if the setting already exists
    $existingSetting = ORM::for_table('tbl_appconfig')
        ->where('setting', $settingName)
        ->find_one();

    // If the setting does not exist, insert it
    if (!$existingSetting) {
        $newSetting = ORM::for_table('tbl_appconfig')->create();
        $newSetting->setting = $settingName;
        $newSetting->value = $value;
        $newSetting->save();
        echo "Setting '{$settingName}' added with value '{$value}'.\n";
    } else {
        echo "Setting '{$settingName}' already exists.\n";
    }
}

// Add 'free_trial' setting with value 'disabled' if it does not exist
addSettingIfNotExists('free_trial', 'disabled');

// Add 'payment_notification' setting with value 'yes' if it does not exist
addSettingIfNotExists('payment_notifications', 'yes');


addSettingIfNotExists('hotspot_sms', 'yes');
addSettingIfNotExists('pppoe_sms', 'yes');
addSettingIfNotExists('static_sms', 'yes');
addSettingIfNotExists('midnight_expiry', 'no');


function dataAndTimeReminderIfNotExists() {
    $settings = [
        'data_reminder' => 'no',
        'time_reminder' => 'no'
    ];

    foreach ($settings as $settingName => $value) {
        // Check if the setting already exists
        $existingSetting = ORM::for_table('tbl_appconfig')
            ->where('setting', $settingName)
            ->find_one();

        // If the setting does not exist, insert it
        if (!$existingSetting) {
            $newSetting = ORM::for_table('tbl_appconfig')->create();
            $newSetting->setting = $settingName;
            $newSetting->value = $value;
            $newSetting->save();
            echo "Setting '{$settingName}' added with value '{$value}'.\n";
        } else {
            echo "Setting '{$settingName}' already exists.\n";
        }
    }
}

// Add the settings 'data_reminder' and 'time_reminder' if they do not exist
dataAndTimeReminderIfNotExists();


function addColumnIfNotExists($tableName, $columnName, $columnDefinition) {
    // Check if the column already exists
    $columnCheck = ORM::for_table($tableName)
        ->raw_query("SHOW COLUMNS FROM `{$tableName}` LIKE '{$columnName}'")
        ->find_one();

    // If the column does not exist, add it
    if (!$columnCheck) {
        ORM::raw_execute("ALTER TABLE `{$tableName}` ADD COLUMN `{$columnName}` {$columnDefinition}");
        echo "Column '{$columnName}' added to table '{$tableName}'.\n";
    } else {
        echo "Column '{$columnName}' already exists in table '{$tableName}'.\n";
    }
}

// Add `disconnection_reason` column if it does not exist
addColumnIfNotExists('tbl_user_recharges', 'disconnection_reason', "VARCHAR(255) DEFAULT 'N/A'");

// Add `disconnection_time` column if it does not exist
addColumnIfNotExists('tbl_user_recharges', 'disconnection_time', "DATETIME NULL DEFAULT NULL");


// Function to add a column if it does not already exist


// Function to add a column for FUP if it does not already exist
function addFupColumnIfNotExists($tableName, $columnName, $columnDefinition) {
    $db = ORM::get_db();
    try {
        // Check if the column already exists
        $result = $db->query("SHOW COLUMNS FROM `{$tableName}` LIKE '{$columnName}'")->fetch();
        if (!$result) {
            // Add the column if it does not exist
            $db->exec("ALTER TABLE `{$tableName}` ADD COLUMN `{$columnName}` {$columnDefinition}");
            echo "FUP column '{$columnName}' added to table '{$tableName}'.\n";
        } else {
            echo "FUP column '{$columnName}' already exists in table '{$tableName}'.\n";
        }
    } catch (PDOException $e) {
        echo "Error adding FUP column '{$columnName}' to table '{$tableName}': " . $e->getMessage() . "\n";
    }
}

// Example of adding FUP-related columns
addFupColumnIfNotExists('tbl_plans', 'fup_id', "INT NULL");
addFupColumnIfNotExists('tbl_plans', 'fup_plan_id', "INT NULL");
addFupColumnIfNotExists('tbl_user_recharges', 'fup_enabled', "TINYINT(1) NOT NULL DEFAULT '0'");
addFupColumnIfNotExists('tbl_user_recharges', 'original_profile', "VARCHAR(100) DEFAULT NULL");



function addReminderSentIfNotExists($tableName) {
    $columnName = 'reminder_sent';
    $columnDefinition = "TINYINT(1) DEFAULT 0"; // Boolean-like column (0 for false, 1 for true)

    // Check if the column already exists
    $columnCheck = ORM::for_table($tableName)
        ->raw_query("SHOW COLUMNS FROM `{$tableName}` LIKE '{$columnName}'")
        ->find_one();

    // If the column does not exist, add it
    if (!$columnCheck) {
        ORM::raw_execute("ALTER TABLE `{$tableName}` ADD COLUMN `{$columnName}` {$columnDefinition}");
        echo "Column '{$columnName}' added to table '{$tableName}'.\n";
    } else {
        echo "Column '{$columnName}' already exists in table '{$tableName}'.\n";
    }
}

// Add `reminder_sent` column if it does not exist
addReminderSentIfNotExists('tbl_user_recharges');



function addBankIfNotExists($id, $bankName, $paybill) {
    // Check if the bank already exists by name
    $existingBank = ORM::for_table('tbl_banks')
        ->where('name', $bankName)
        ->find_one();

    // If the bank does not exist, insert it with the specified id
    if (!$existingBank) {
        $newBank = ORM::for_table('tbl_banks')->create();
        $newBank->id = $id; // Set id explicitly
        $newBank->name = $bankName;
        $newBank->paybill = $paybill;
        $newBank->save();
        echo "Bank '{$bankName}' added with paybill '{$paybill}' and id '{$id}'.\n";
    } else {
        echo "Bank '{$bankName}' already exists.\n";
    }
}

// Adding new banks with corresponding paybills and explicit ids if they do not exist
addBankIfNotExists(7, 'StandardChartered', 329329);
addBankIfNotExists(8, 'Barclays', 303030);
addBankIfNotExists(9, 'Family', 222111);
addBankIfNotExists(10, 'KCB_Business', 522533);
addBankIfNotExists(11, 'Custom', 11111);
addBankIfNotExists(12, 'National', 625625);
addBankIfNotExists(13, 'IM', 542542);



function addFaqAdvertTestimonials() {
    // Define the new settings and default values
    $newSettings = [
        'enable_faq'          => 'enable',
        'enable_advert'       => 'disable',
        'enable_testimonials' => 'enable',
        'advert_position'     => 'top'
    ];

    foreach ($newSettings as $settingName => $defaultValue) {
        // Check if the setting already exists
        $existing = ORM::for_table('tbl_appconfig')
            ->where('setting', $settingName)
            ->find_one();

        if (!$existing) {
            // If not found, create a new row with the default value
            $newSetting = ORM::for_table('tbl_appconfig')->create();
            $newSetting->setting = $settingName;
            $newSetting->value   = $defaultValue;
            $newSetting->save();

            echo "Setting '{$settingName}' added with value '{$defaultValue}'.\n";
        } else {
            // Already exists; do not overwrite
            echo "Setting '{$settingName}' already exists with value '{$existing->value}'.\n";
        }
    }
}

// Just call this function wherever you want to add those settings:
addFaqAdvertTestimonials();

// Execute a URL
function executeUrl($url) {
    logMessage("Triggering $url...");
    $response = file_get_contents($url); // Fetch content from the URL
    logMessage("$url triggered. Response: " . substr($response, 0, 100)); // Log first 100 chars of response
}

// Automatically define the script URLs
$disconnectionUrl = APP_URL . '/system/disconnection.php';
$timeDataReminderUrl = APP_URL . '/system/time_data_reminder.php';
$fupUrl = APP_URL . '/system/fup_cron.php';

// Trigger disconnection.php
executeUrl($disconnectionUrl);

// Trigger time_data_reminder.php
executeUrl($timeDataReminderUrl);

executeUrl($fupUrl);

// Proceed with the rest of the script
logMessage("Script execution continues...");


// Set the default timezone to GMT+3
date_default_timezone_set('Africa/Nairobi'); // Set timezone to Africa/Nairobi (GMT+3)


// Check if the current time is 5 AM
$currentHour = date('G'); // 'G' returns the hour in 24-hour format without leading zeros

if ($currentHour != 5) {
    logMessage("Script executed at hour $currentHour. This script runs only at 5 AM. Exiting...");
    exit;
}

// Proceed with the script since it's 5 AM
logMessage("Script started at 5 AM.");

// Your existing script continues here...

// Fetch all routers
$routers = ORM::for_table('tbl_routers')->find_many();

foreach ($routers as $router) {
    try {
        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

        // Fetch active users for hotspot
        $hotspotUsers = $client->sendSync(new RouterOS\Request('/ip/hotspot/active/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);

        // Log the active Hotspot users
        logMessage("Active Hotspot Users for Router ID " . $router['id'] . ":");
        foreach ($hotspotUsers as $user) {
            logMessage("User: " . $user->getProperty('user'));
        }

        // Remove inactive Hotspot users
        removeInactiveHotspotUsers($client);

    } catch (Exception $e) {
        // Handle exceptions
        logMessage("Error with router ID " . $router['id'] . ": " . $e->getMessage());
    }
}

// Define the function to remove inactive Hotspot users from the users list
function removeInactiveHotspotUsers($client) {
    // Fetch all Hotspot users
    $usersRequest = new RouterOS\Request('/ip/hotspot/user/print');
    $users = $client->sendSync($usersRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

    foreach ($users as $user) {
        $username = $user->getProperty('name');
        logMessage("Checking user: $username"); // Log user being checked

        // Skip users whose names start with 'T' (trial users)
        if (strpos($username, 'T') === 0) {
            logMessage("User $username is a trial user. Skipping removal...");
            continue; // Skip trial users
        }

        // Re-check the user's status in the database with status 'off' and type 'Hotspot'
        $userRecharge = ORM::for_table('tbl_user_recharges')
            ->where('username', $username)
            ->where('status', 'off')
            ->where('type', 'Hotspot')
            ->find_one();

        // Check if user is not in the database or is inactive
        if (!$userRecharge) {
            $userRechargeExists = ORM::for_table('tbl_user_recharges')
                ->where('username', $username)
                ->find_one();

            if (!$userRechargeExists) {
                logMessage("User $username is not in the database. Proceeding to remove...");
                removeUserFromHotspot($client, $user);
            } else {
                logMessage("User $username is active in the database. Skipping removal...");
                continue; // Skip active users
            }
        } else {
            logMessage("User $username is inactive in the database. Proceeding to remove...");
            removeUserFromHotspot($client, $user);
        }
    }
}

// Helper function to remove a user from Hotspot users and active users
function removeUserFromHotspot($client, $user) {
    try {
        $username = $user->getProperty('name');

        // Skip users whose names start with 'T' (trial users)
        if (strpos($username, 'T') === 0) {
            logMessage("User $username is a trial user. Skipping removal...");
            return; // Skip trial users and exit the function
        }

        // Re-check the user's status in the database with type 'Hotspot'
        $userRecharge = ORM::for_table('tbl_user_recharges')
            ->where('username', $username)
            ->where('type', 'Hotspot')
            ->find_one();

        if ($userRecharge) {
            if ($userRecharge->status != 'off') {
                // User is now active
                logMessage("User $username is now active in the database. Skipping removal...");
                return; // Do not remove the user
            } else {
                // User is still inactive
                logMessage("User $username is still inactive in the database. Proceeding to remove...");
            }
        } else {
            // User is not in the database
            logMessage("User $username is not in the database. Proceeding to remove...");
        }

        // Proceed to remove the user from Hotspot users list
        $removeUserRequest = new RouterOS\Request('/ip/hotspot/user/remove');
        $removeUserRequest->setArgument('.id', $user->getProperty('.id'));
        $client->sendSync($removeUserRequest);
        logMessage("Removed user $username from Hotspot users list");

        // Remove the user from Hotspot active users
        $activeUsersRequest = new RouterOS\Request('/ip/hotspot/active/print');
        $activeUsers = $client->sendSync($activeUsersRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

        foreach ($activeUsers as $activeUser) {
            if ($activeUser->getProperty('user') == $username) {
                $removeActiveUserRequest = new RouterOS\Request('/ip/hotspot/active/remove');
                $removeActiveUserRequest->setArgument('.id', $activeUser->getProperty('.id'));
                $client->sendSync($removeActiveUserRequest);
                logMessage("Removed user $username from Hotspot active users");
                break;
            }
        }
    } catch (Exception $e) {
        logMessage("Error removing Hotspot user $username: " . $e->getMessage());
    }
}




// Fetch all routers
$routers = ORM::for_table('tbl_routers')->find_many();

foreach ($routers as $router) {
    try {
        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

        // Fetch active users for PPPoE
        $pppoeUsers = $client->sendSync(new RouterOS\Request('/ppp/active/print'))->getAllOfType(RouterOS\Response::TYPE_DATA);

        // Log the active PPPoE users
        logMessage("Active PPPoE Users for Router ID " . $router['id'] . ":");
        foreach ($pppoeUsers as $user) {
            logMessage("User: " . $user->getProperty('name'));
        }

        // Remove inactive PPPoE users
        removeInactivePPPoEUsers($client);

    } catch (Exception $e) {
        // Handle exceptions
        logMessage("Error with router ID " . $router['id'] . ": " . $e->getMessage());
    }
}

// Define the function to remove inactive PPPoE users and from the users list
function removeInactivePPPoEUsers($client) {
    // Fetch all PPPoE users
    $usersRequest = new RouterOS\Request('/ppp/secret/print');
    $users = $client->sendSync($usersRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

    foreach ($users as $user) {
        $username = $user->getProperty('name');
        logMessage("Checking user: $username"); // Log user being checked

        // Check if the user is in tbl_user_recharges with status 'off' and type 'PPPoE'
        $userRecharge = ORM::for_table('tbl_user_recharges')
            ->where('username', $username)
            ->where('status', 'off')
            ->where('type', 'PPPoE')
            ->find_one();

        if ($userRecharge) {
            logMessage("User $username is inactive in the database. Removing from PPPoE users list and active users...");
            try {
                // Remove the user from PPPoE users list
                $removeUserRequest = new RouterOS\Request('/ppp/secret/remove');
                $removeUserRequest->setArgument('.id', $user->getProperty('.id'));
                $client->sendSync($removeUserRequest);
                logMessage("Removed user $username from PPPoE users list");

                // Remove the user from PPPoE active users
                $activeUsersRequest = new RouterOS\Request('/ppp/active/print');
                $activeUsers = $client->sendSync($activeUsersRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

                foreach ($activeUsers as $activeUser) {
                    if ($activeUser->getProperty('name') == $username) {
                        $removeActiveUserRequest = new RouterOS\Request('/ppp/active/remove');
                        $removeActiveUserRequest->setArgument('.id', $activeUser->getProperty('.id'));
                        $client->sendSync($removeActiveUserRequest);
                        logMessage("Removed inactive PPPoE user: $username from active users");
                        break;
                    }
                }
            } catch (Exception $e) {
                logMessage("Error removing PPPoE user $username: " . $e->getMessage());
            }
        } else {
            logMessage("User $username is not inactive or not of type PPPoE in the database.");
        }
    }
}

// Function to remove a static user
function removeStaticUser($client, $username) {
    global $_app_stage;
    if ($_app_stage == 'demo') {
        logMessage("Demo mode - skipping removal for user: $username");
        return null;
    }

    // Retrieve the customer data from the database
    $customer = ORM::for_table('tbl_customers')->where('username', $username)->find_one();

    if (!$customer) {
        // Handle the case where the customer was not found in the database
        logMessage("Customer $username not found in the database.");
        return;
    }

    // Get the IP address from the customer data
    $ipAddress = $customer->ip_address;
    logMessage("Customer $username found with IP address: $ipAddress");

    try {
        // Find the address list entry
        $findAddressListRequest = new RouterOS\Request('/ip/firewall/address-list/print');
        $findAddressListRequest->setQuery(Query::where('list', 'allowed')->andWhere('address', $ipAddress));
        $addressListResponses = $client->sendSync($findAddressListRequest);
        foreach ($addressListResponses as $addressListResponse) {
            if ($addressListResponse->getType() === RouterOS\Response::TYPE_DATA) {
                $addressListId = $addressListResponse->getProperty('.id');
                // Verify if the address exactly matches the IP address from customer data
                $address = $addressListResponse->getProperty('address');
                if ($address === $ipAddress) {
                    // Remove the address list entry only if it matches the IP address
                    $removeAddressListRequest = new RouterOS\Request('/ip/firewall/address-list/remove');
                    $removeAddressListRequest->setArgument('.id', $addressListId);
                    $client->sendSync($removeAddressListRequest);
                    logMessage("Removed address list entry for IP: $ipAddress");
                }
            }
        }

        $findQueueRequest = new RouterOS\Request('/queue/simple/print');
        $findQueueRequest->setQuery(Query::where('target', $ipAddress . '/32'));
        $queueResponses = $client->sendSync($findQueueRequest);

        foreach ($queueResponses as $queueResponse) {
            if ($queueResponse->getType() === RouterOS\Response::TYPE_DATA) {
                $queueId = $queueResponse->getProperty('.id');
                // Verify if the queue target exactly matches the IP address
                $target = $queueResponse->getProperty('target');
                if ($target === $ipAddress . '/32') {
                    // Remove the queue only if it matches the IP address
                    $removeQueueRequest = new RouterOS\Request('/queue/simple/remove');
                    $removeQueueRequest->setArgument('.id', $queueId);
                    $client->sendSync($removeQueueRequest);
                    logMessage("Removed queue for IP: $ipAddress");
                }
            }
        }

    } catch (Exception $e) {
        logMessage("Error removing static user $username: " . $e->getMessage());
    }
}

// Define the function to remove inactive static users
function removeInactiveStaticUsers($client) {
    // Fetch all queue entries
    $queueRequest = new RouterOS\Request('/queue/simple/print');
    $queues = $client->sendSync($queueRequest)->getAllOfType(RouterOS\Response::TYPE_DATA);

    if (empty($queues)) {
        logMessage("No queue entries found.");
        return;
    }

    foreach ($queues as $queue) {
        $queueName = $queue->getProperty('name');

        if (strpos($queueName, 'Queue-') === 0) {
            $username = substr($queueName, 6); // Extract the username part
            logMessage("Checking static user: $username in queue $queueName");

            // Check if the user is in tbl_user_recharges with status 'off' and type 'Static'
            $userRecharge = ORM::for_table('tbl_user_recharges')
                ->where('username', $username)
                ->where('status', 'off')
                ->where('type', 'Static')
                ->find_one();

            if ($userRecharge) {
                logMessage("User $username is inactive in the database. Removing from queues and address list...");
                try {
                    // Remove the user from the queue
                    $removeQueueRequest = new RouterOS\Request('/queue/simple/remove');
                    $removeQueueRequest->setArgument('.id', $queue->getProperty('.id'));
                    $client->sendSync($removeQueueRequest);
                    logMessage("Removed queue $queueName for user $username");

                    // Remove the user from the address list
                    removeStaticUser($client, $username);
                } catch (Exception $e) {
                    logMessage("Error removing static user $username: " . $e->getMessage());
                }
            } else {
                logMessage("User $username is not inactive or not of type Static in the database.");
            }
        }
    }
}

// Example usage to trigger the function
// This part will be executed when the script runs
try {
    // Fetch all routers and process each one
    $routers = ORM::for_table('tbl_routers')->find_many();

    foreach ($routers as $router) {
        $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);
        logMessage("Starting processing for Router ID " . $router['id']);
        removeInactiveStaticUsers($client);
        logMessage("Finished processing for Router ID " . $router['id']);
    }
} catch (Exception $e) {
    logMessage("General error: " . $e->getMessage());


}