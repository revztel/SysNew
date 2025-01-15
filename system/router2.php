<?php

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

// Function to write log messages to a file with a limit of 5000 lines
function logMessage($message) {
    global $logFile;
    $maxLines = 5000;
    
    // Read existing log file
    $logs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES) : [];
    
    // Add new log message
    $logs[] = $message;
    
    // Keep only the last 5000 lines
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

$_c = $config; // Load configuration

// Function to fetch data usage from routers
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
                // logMessage("No customer found for queue: " . $name);
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }

    return $dataUsage;
}

// Function to update data usage in the database
function updateDataUsageInDatabase($customerId, $currentUpload, $currentDownload) {
    try {
        // Fetch the existing record or create a new one
        $dataUsageRecord = ORM::for_table('tbl_data_usage')
            ->where('customer_id', $customerId)
            ->find_one();

        if ($dataUsageRecord) {
            // Previous cumulative counters
            $prevUpload = $dataUsageRecord->get('prev_upload');
            $prevDownload = $dataUsageRecord->get('prev_download');

            // Calculate the data usage since last check
            if ($currentUpload >= $prevUpload) {
                $uploadDiff = $currentUpload - $prevUpload;
            } else {
                // Counter reset detected (unexpected)
                $uploadDiff = $currentUpload;
            }

            if ($currentDownload >= $prevDownload) {
                $downloadDiff = $currentDownload - $prevDownload;
            } else {
                // Counter reset detected (unexpected)
                $downloadDiff = $currentDownload;
            }

            // Accumulate the total usage
            $totalUpload = $dataUsageRecord->get('total_upload') + $uploadDiff;
            $totalDownload = $dataUsageRecord->get('total_download') + $downloadDiff;

            // Update the data usage record
            $dataUsageRecord->set('prev_upload', $currentUpload);
            $dataUsageRecord->set('prev_download', $currentDownload);
            $dataUsageRecord->set('total_upload', $totalUpload);
            $dataUsageRecord->set('total_download', $totalDownload);
            $dataUsageRecord->set('updated_at', date('Y-m-d H:i:s'));
            $dataUsageRecord->save();

            // Update daily data usage
            updateDailyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update weekly data usage
            updateWeeklyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update monthly data usage
            updateMonthlyDataUsage($customerId, $uploadDiff, $downloadDiff);

        } else {
            // First time data collection for this customer
            $dataUsageRecord = ORM::for_table('tbl_data_usage')->create();
            $dataUsageRecord->set('customer_id', $customerId);
            $dataUsageRecord->set('prev_upload', $currentUpload);
            $dataUsageRecord->set('prev_download', $currentDownload);
            $dataUsageRecord->set('total_upload', 0);
            $dataUsageRecord->set('total_download', 0);
            $dataUsageRecord->set('updated_at', date('Y-m-d H:i:s'));
            $dataUsageRecord->save();

            // Since this is the first data point, we can't calculate a difference yet
            // We can choose to ignore this data point or consider the current counters as the usage
            $uploadDiff = $currentUpload;
            $downloadDiff = $currentDownload;

            // Update daily data usage
            updateDailyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update weekly data usage
            updateWeeklyDataUsage($customerId, $uploadDiff, $downloadDiff);

            // Update monthly data usage
            updateMonthlyDataUsage($customerId, $uploadDiff, $downloadDiff);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

// Function to update daily data usage
function updateDailyDataUsage($customerId, $uploadDiff, $downloadDiff) {
    try {
        $currentDate = date('Y-m-d');

        // Check if a record exists for the customer and current date in the tbl_daily_data_usage table
        $dailyDataUsageRecord = ORM::for_table('tbl_daily_data_usage')
            ->where('customer_id', $customerId)
            ->where('date', $currentDate)
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
            $dailyDataUsageRecord->set('date', $currentDate);
            $dailyDataUsageRecord->save();
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

// Function to update weekly data usage
function updateWeeklyDataUsage($customerId, $uploadDiff, $downloadDiff) {
    try {
        // Get the ISO-8601 week number and year
        $weekNumber = date('W');
        $year = date('o'); // 'o' is used for ISO-8601 year number

        // Get the Monday of the current week
        $weekStartDate = date('Y-m-d', strtotime($year . 'W' . str_pad($weekNumber, 2, '0', STR_PAD_LEFT)));

        // Get the Sunday of the current week
        $weekEndDate = date('Y-m-d', strtotime($weekStartDate . ' +6 days'));

        // Get the current day of the week in lowercase (monday, tuesday, etc.)
        $currentDay = strtolower(date('l'));

        // Check if a record exists for the customer and current week in the tbl_weekly_data_usage table
        $weeklyDataUsageRecord = ORM::for_table('tbl_weekly_data_usage')
            ->where('customer_id', $customerId)
            ->where('week_start_date', $weekStartDate)
            ->where('week_end_date', $weekEndDate)
            ->find_one();

        if ($weeklyDataUsageRecord) {
            // Accumulate the data usage differences
            $weeklyDataUsageRecord->set($currentDay . '_upload', $weeklyDataUsageRecord->get($currentDay . '_upload') + $uploadDiff);
            $weeklyDataUsageRecord->set($currentDay . '_download', $weeklyDataUsageRecord->get($currentDay . '_download') + $downloadDiff);
            $weeklyDataUsageRecord->save();
        } else {
            // Create a new record for the new week
            $weeklyDataUsageRecord = ORM::for_table('tbl_weekly_data_usage')->create();
            $weeklyDataUsageRecord->set('customer_id', $customerId);
            $weeklyDataUsageRecord->set('week_start_date', $weekStartDate);
            $weeklyDataUsageRecord->set('week_end_date', $weekEndDate);

            // Initialize all days' upload and download to zero
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            foreach ($days as $day) {
                $weeklyDataUsageRecord->set($day . '_upload', 0);
                $weeklyDataUsageRecord->set($day . '_download', 0);
            }

            // Set the current day's upload and download to the differences
            $weeklyDataUsageRecord->set($currentDay . '_upload', $uploadDiff);
            $weeklyDataUsageRecord->set($currentDay . '_download', $downloadDiff);

            $weeklyDataUsageRecord->save();
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

// Function to update monthly data usage
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

        $monthUploadColumn = $currentMonthName . '_upload';
        $monthDownloadColumn = $currentMonthName . '_download';

        if ($monthlyDataUsageRecord) {
            // Accumulate the data usage differences
            $monthlyDataUsageRecord->set($monthUploadColumn, $monthlyDataUsageRecord->get($monthUploadColumn) + $uploadDiff);
            $monthlyDataUsageRecord->set($monthDownloadColumn, $monthlyDataUsageRecord->get($monthDownloadColumn) + $downloadDiff);
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

// Function to reset counters if it's a new day
function resetCountersIfNewDay($client, $routerId) {
    try {
        $currentDate = date('Y-m-d');

        // Check if a record exists for the router in tbl_router_counters_reset
        $resetRecord = ORM::for_table('tbl_router_counters_reset')
            ->where('router_id', $routerId)
            ->find_one();

        if ($resetRecord) {
            $lastResetDate = $resetRecord->get('last_reset_date');

            if ($lastResetDate != $currentDate) {
                // It's a new day, reset the counters
                $resetRequest = new RouterOS\Request('/queue/simple/reset-counters-all');
                $client->sendSync($resetRequest);

                // Update the last reset date
                $resetRecord->set('last_reset_date', $currentDate);
                $resetRecord->save();
            }
        } else {
            // No record exists, reset counters and create a new record
            $resetRequest = new RouterOS\Request('/queue/simple/reset-counters-all');
            $client->sendSync($resetRequest);

            // Create new record
            $resetRecord = ORM::for_table('tbl_router_counters_reset')->create();
            $resetRecord->set('router_id', $routerId);
            $resetRecord->set('last_reset_date', $currentDate);
            $resetRecord->save();
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
                `prev_upload` bigint(20) NOT NULL DEFAULT '0',
                `prev_download` bigint(20) NOT NULL DEFAULT '0',
                `total_upload` bigint(20) NOT NULL DEFAULT '0',
                `total_download` bigint(20) NOT NULL DEFAULT '0',
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

        // Check if the tbl_router_counters_reset table exists
        $routerCountersResetTableExists = ORM::for_table('tbl_router_counters_reset')->raw_query("SHOW TABLES LIKE 'tbl_router_counters_reset'")->find_one();

        if (!$routerCountersResetTableExists) {
            // Create the tbl_router_counters_reset table
            $routerCountersResetTableQuery = "CREATE TABLE `tbl_router_counters_reset` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `router_id` int(11) NOT NULL,
                `last_reset_date` date NOT NULL,
                PRIMARY KEY (`id`),
                KEY `router_id` (`router_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            ORM::raw_execute($routerCountersResetTableQuery);
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

            // Reset counters if it's a new day
            resetCountersIfNewDay($client, $router['id']);

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

?>
