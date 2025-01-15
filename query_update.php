<?php
require_once 'config.php';
require_once 'system/orm.php';
require_once 'system/autoload/PEAR2/Autoload.php';
include "system/autoload/Hookers.php";

// ORM configuration
ORM::configure("mysql:host=$db_host;dbname=$db_name");
ORM::configure('username', $db_user);
ORM::configure('password', $db_password);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);

// Function to manage log file lines
function logToFile($filePath, $message, $maxLines = 5000) {
    $lines = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
    $lines[] = '[' . date('Y-m-d H:i:s') . '] ' . $message;
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, count($lines) - $maxLines);
    }
    file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
}

// Define log file path
$logFilePath = 'queryupdate.log';

// Capture incoming POST data
$captureLogs = file_get_contents("php://input");
$analizzare = json_decode($captureLogs);

$now = new DateTime('now', new DateTimeZone('GMT+3'));
$receivedTimestamp = $now->format('Y-m-d H:i:s');
logToFile($logFilePath, "Received callback data in query_update.php at " . $receivedTimestamp . ":\n" . $captureLogs);

// Extract data from the received JSON
$response_code = $analizzare->ResponseCode ?? null;
$response_desc = $analizzare->ResponseDescription ?? '';
$merchant_req_id = $analizzare->MerchantRequestID ?? '';
$checkout_req_id = $analizzare->CheckoutRequestID ?? '';
$result_code = $analizzare->ResultCode ?? null;
$result_desc = $analizzare->ResultDesc ?? '';

if (is_null($result_code)) {
    // If ResultCode is not present in the JSON, attempt to extract it from nested structures
    if (isset($analizzare->Body->stkCallback->ResultCode)) {
        $result_code = $analizzare->Body->stkCallback->ResultCode;
        $result_desc = $analizzare->Body->stkCallback->ResultDesc ?? '';
    }
}

// Log the extracted callback data
logToFile($logFilePath, "Extracted callback data:\nResponse Code: $response_code\nResponse Description: $response_desc\nMerchant Request ID: $merchant_req_id\nCheckout Request ID: $checkout_req_id\nResult Code: $result_code\nResult Description: $result_desc");

// Initialize $uname to ensure it's in scope
$uname = "";

if ($result_code == "0") {
    // Proceed with processing the payment
    // Fetch the payment gateway record based on the Checkout Request ID
    $PaymentGatewayRecord = ORM::for_table('tbl_payment_gateway')
        ->where('checkout', $checkout_req_id)
        ->order_by_desc('id')
        ->find_one();

    if (!$PaymentGatewayRecord) {
        logToFile($logFilePath, "PaymentGatewayRecord not found for Checkout Request ID: $checkout_req_id");
    } else {
        $uname = $PaymentGatewayRecord->username; // Assign username from the record
        logToFile($logFilePath, "Username set to: " . $uname);

        $plan_id = $PaymentGatewayRecord->plan_id;
        $routerId = $PaymentGatewayRecord->routers_id;

        $userid = ORM::for_table('tbl_customers')
            ->where('username', $uname)
            ->order_by_desc('id')
            ->find_one();

        if (!$userid) {
            logToFile($logFilePath, "User not found for username: $uname");
        } else {
            $plans = ORM::for_table('tbl_plans')
                ->where('id', $plan_id)
                ->order_by_desc('id')
                ->find_one();

            if (!$plans) {
                logToFile($logFilePath, "Plan not found for plan_id: $plan_id");
            } else {
                $plan_type = $plans->type;
                $plan_name = $plans->name_plan;
                $validity = $plans->validity;
                $units = $plans->validity_unit;

                // Convert units to seconds
                $unit_in_seconds = [
                    'Mins' => 60,
                    'Hrs' => 3600,
                    'Days' => 86400,
                    'Months' => 2592000 // Assuming 30 days per month for simplicity
                ];

                $unit_seconds = $unit_in_seconds[$units];
                $expiry_timestamp = $now->getTimestamp() + ($validity * $unit_seconds);

                // Set the timezone explicitly for expiry date and time
                $expiry_datetime = new DateTime("@$expiry_timestamp");
                $expiry_datetime->setTimezone(new DateTimeZone('GMT+3'));
                $expiry_date = $expiry_datetime->format('Y-m-d');
                $expiry_time = $expiry_datetime->format('H:i:s');

                $recharged_on = $now->format('Y-m-d');
                $recharged_time = $now->format('H:i:s');

                // Log the recharge details
                logToFile($logFilePath, "Recharge details:\nPlan Type: $plan_type\nPlan Name: $plan_name\nValidity: $validity $units\nExpiry Date: $expiry_date\nExpiry Time: $expiry_time");

                // Include the external script if needed
                $file_path = 'system/adduser2.php';
                file_put_contents('queryupdate.log', "Including external script: $file_path\n", FILE_APPEND);
                include_once $file_path;
                file_put_contents('queryupdate.log', "external script included: $file_path\n", FILE_APPEND);

                // Now check if PaymentGatewayRecord is already processed
                if ($PaymentGatewayRecord->status == 2) {
                    logToFile($logFilePath, "PaymentGatewayRecord already processed for Checkout Request ID: $checkout_req_id.");
                    return; // Exit the script since it's already processed
                } else {
                    // Continue processing the PaymentGatewayRecord if not already processed

                    // Fetch the router name
                    $router = ORM::for_table('tbl_routers')
                        ->where('id', $routerId)
                        ->find_one();

                    $router_name = $router->name;
                    logToFile($logFilePath, "Fetched router name: $router_name for router ID: $routerId");

                    // Check if the status of the username is 'on'
                    $existing_recharge = ORM::for_table('tbl_user_recharges')
                        ->where('username', $uname)
                        ->where('status', 'on')
                        ->find_one();

                    if ($existing_recharge) {
                        logToFile($logFilePath, "Username: $uname already has an active recharge. Exiting.");
                    } else {
                        // Delete existing records for the username
                        $deleted_count = ORM::for_table('tbl_user_recharges')
                            ->where('username', $uname)
                            ->delete_many();

                        logToFile($logFilePath, "Deleted $deleted_count existing recharge records for username: $uname");

                        // Insert new record into tbl_user_recharges
                        ORM::for_table('tbl_user_recharges')->create(array(
                            'customer_id' => $userid->id,
                            'username' => $uname,
                            'plan_id' => $plan_id,
                            'namebp' => $plan_name,
                            'recharged_on' => $recharged_on,
                            'recharged_time' => $recharged_time,
                            'expiration' => $expiry_date,
                            'time' => $expiry_time,
                            'status' => "on",
                            'method' => $PaymentGatewayRecord->gateway . "-STK_FAILOVER",
                            'routers' => $router_name, // Use the router name instead of the ID
                            'type' => $plan_type
                        ))->save();

                        logToFile($logFilePath, "New recharge record inserted successfully for username: $uname");
                    }

                    // Check if a transaction with the same invoice already exists
                    $existingTransactions = ORM::for_table('tbl_transactions')
                        ->where('invoice', 'STK_FAILOVER' . $checkout_req_id)
                        ->order_by_desc('id')
                        ->find_many();

                    if (count($existingTransactions) > 1) {
                        // Convert to array for using array_pop
                        $existingTransactionsArray = $existingTransactions->as_array();
                        $keepTransaction = array_pop($existingTransactionsArray); // Keep the most recent transaction
                        logToFile($logFilePath, "Keeping transaction with ID: " . $keepTransaction['id']);

                        foreach ($existingTransactionsArray as $transaction) {
                            logToFile($logFilePath, "Attempting to delete transaction with ID: " . $transaction['id']);
                            $transactionToDelete = ORM::for_table('tbl_transactions')->find_one($transaction['id']);
                            if ($transactionToDelete) {
                                $transactionToDelete->delete();
                                logToFile($logFilePath, "Deleted duplicate transaction with invoice: " . 'STK_FAILOVER' . $checkout_req_id . " and ID: " . $transaction['id']);
                            } else {
                                logToFile($logFilePath, "Failed to find transaction with ID: " . $transaction['id']);
                            }
                        }
                    } else {
                        logToFile($logFilePath, "No duplicates found or only one transaction found for invoice: " . 'STK_FAILOVER' . $checkout_req_id);
                    }

                    if (count($existingTransactions) == 0) {
                        // Insert new record into tbl_transactions
                        ORM::for_table('tbl_transactions')->create(array(
                            'invoice' => 'STK_FAILOVER' . (ORM::for_table('tbl_transactions')->max('id') + 1), // Incremental QUERY code
                            'username' => $uname,
                            'plan_name' => $plan_name,
                            'price' => $PaymentGatewayRecord->price,
                            'recharged_on' => $recharged_on,
                            'recharged_time' => $recharged_time,
                            'expiration' => $expiry_date,
                            'time' => $expiry_time,
                            'method' => $PaymentGatewayRecord->gateway . "-STK_FAILOVER",
                            'routers' => $router_name,
                            'type' => $plan_type
                        ))->save();

                        logToFile($logFilePath, "New transaction record inserted successfully for username: $uname");
                    } else {
                        logToFile($logFilePath, "Transaction record already exists for invoice: " . 'STK_FAILOVER' . $checkout_req_id);
                    }

                    // Secondary check for duplicate transactions
                    $secondaryCheckTransactions = ORM::for_table('tbl_transactions')
                        ->where('invoice', 'STK_FAILOVER' . $checkout_req_id)
                        ->order_by_desc('id')
                        ->find_many();

                    if (count($secondaryCheckTransactions) > 1) {
                        $secondaryCheckTransactionsArray = $secondaryCheckTransactions->as_array(); // Convert to array
                        $keepTransaction = array_pop($secondaryCheckTransactionsArray); // Keep the most recent transaction
                        foreach ($secondaryCheckTransactionsArray as $transaction) {
                            $transactionToDelete = ORM::for_table('tbl_transactions')->find_one($transaction['id']);
                            if ($transactionToDelete) {
                                $transactionToDelete->delete();
                                logToFile($logFilePath, "Deleted duplicate transaction with invoice in secondary check: " . 'STK_FAILOVER' . $checkout_req_id);
                            } else {
                                logToFile($logFilePath, "Failed to find transaction with ID: " . $transaction['id']);
                            }
                        }
                    }

                    // Fetch the customer details
                    $customer = ORM::for_table('tbl_customers')
                        ->where('username', $uname)
                        ->find_one();

                    // Update the PaymentGatewayRecord after successful processing
                    $PaymentGatewayRecord->status = 2;
                    $PaymentGatewayRecord->paid_date = $now->format('Y-m-d H:i:s');
                    $PaymentGatewayRecord->gateway_trx_id = 'STK_FAILOVER' . $checkout_req_id;
                    $PaymentGatewayRecord->save();

                    logToFile($logFilePath, "Updated PaymentGatewayRecord status to: 2");
                    logToFile($logFilePath, "Updated PaymentGatewayRecord paid_date to: " . $PaymentGatewayRecord->paid_date);
                    logToFile($logFilePath, "Updated PaymentGatewayRecord gateway_trx_id to: " . $PaymentGatewayRecord->gateway_trx_id);
                }
            }
        }
    }

    // Log completion
    $completionTimestamp = (new DateTime('now', new DateTimeZone('GMT+3')))->format('Y-m-d H:i:s');
    logToFile($logFilePath, "Process completed at $completionTimestamp");

} else {
    logToFile($logFilePath, "Result code is not 0. No action taken.");
}

// Check if $uname is set before fetching transactions
if (!empty($uname)) {
    // Fetch the latest 2 transactions for the username, ordered by id in descending order
    logToFile($logFilePath, "Fetching the latest 2 transactions for username: " . $uname);
    $transactionsToCheck = ORM::for_table('tbl_transactions')
        ->where('username', $uname)
        ->order_by_desc('id')
        ->limit(2)
        ->find_many();

    $transactionCount = count($transactionsToCheck);
    logToFile($logFilePath, "Number of transactions found: " . $transactionCount);

    if ($transactionCount == 2) {
        $latestTransaction = $transactionsToCheck[0];
        $previousTransaction = $transactionsToCheck[1];

        logToFile($logFilePath, "Latest transaction ID: " . $latestTransaction->id . " with recharged time: " . $latestTransaction->recharged_time);
        logToFile($logFilePath, "Previous transaction ID: " . $previousTransaction->id . " with recharged time: " . $previousTransaction->recharged_time);

        // Convert times to timestamps
        $latestRechargedDateTime = new DateTime($latestTransaction->recharged_on . ' ' . $latestTransaction->recharged_time);
        $previousRechargedDateTime = new DateTime($previousTransaction->recharged_on . ' ' . $previousTransaction->recharged_time);

        // Calculate the time difference in seconds
        $timeDifference = abs($latestRechargedDateTime->getTimestamp() - $previousRechargedDateTime->getTimestamp());
        logToFile($logFilePath, "Time difference between transactions: " . $timeDifference . " seconds");

        // Check if the time difference is within 5 minutes (300 seconds)
        if ($timeDifference <= 300) {
            $previousTransaction->delete();
            logToFile($logFilePath, "Deleted previous transaction with ID: " . $previousTransaction->id . " for username: " . $uname . " (Time difference: $timeDifference seconds)");
        } else {
            logToFile($logFilePath, "No transaction deletion needed as the time difference is more than 5 minutes.");
        }
    } else {
        logToFile($logFilePath, "Less than 2 transactions found, skipping deletion check.");
    }

    logToFile($logFilePath, "Completed check for transactions within 5 minutes for username: " . $uname);
} else {
    logToFile($logFilePath, "Username is empty. Skipping transaction check.");
}
?>
