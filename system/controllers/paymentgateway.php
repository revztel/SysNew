<?php
/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

// Ensuring no output is sent before setting cookies or headers
ob_start();

_admin();
$ui->assign('_system_menu', 'paymentgateway');

$action = alphanumeric($routes['1']);
$admin = Admin::_info();
$ui->assign('_admin', $admin);

// Set the master password
$master_password = 'mpesa';

// Cookie settings: define cookie name for reuse
$cookie_name = 'paymentgateway_authenticated';

// Check for password cookie
if (!isset($_COOKIE[$cookie_name])) {
    // If a password has been submitted via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pg_password'])) {
        $entered_password = _post('pg_password');

        // Fetch stored passwords from tbl_appconfig
        try {
            $password2 = ORM::for_table('tbl_appconfig')->where('setting', 'mpesa_till_partyb')->find_one();
            $stkbankacc = ORM::for_table('tbl_appconfig')->where('setting', 'Stkbankacc')->find_one();
        } catch (Exception $e) {
            $ui->assign('_error', 'An unexpected error occurred. Please try again later.');
            $ui->display('password_prompt.tpl');
            exit;
        }

        // Validate the entered password
        if (
            $entered_password === $master_password || // Hardcoded password
            ($password2 && $entered_password === $password2->value) || // Password from mpesa_till_partyb
            ($stkbankacc && $entered_password === $stkbankacc->value) // Password from Stkbankacc
        ) {
            // Authentication successful - set a cookie valid for 1 hour
            $cookie_expiry = time() + 360; // Cookie expires in 1 hour
            setcookie($cookie_name, 'true', $cookie_expiry, "/", "", false, true); // Cookie is HttpOnly
            
            // Log successful authentication
            $log_message = "paymentgateway authentication successful.";
            if ($entered_password !== $master_password) {
                $log_message .= " Authenticated with password: ";
            }
            _log($log_message, 'authentication');

            // Redirect to prevent form resubmission
            header("Location: " . U . "paymentgateway");
            ob_end_flush();
            exit;
        } else {
            // Authentication failed
            $log_message = "Paymentgateway authentication failed. Entered password: {$entered_password}";
            _log($log_message, 'authentication_failed');

            // Assign error and display prompt again
            $ui->assign('_error', 'Invalid password. Please try again.');
            $ui->display('password_prompt.tpl'); // Display the password prompt with error

            ob_end_flush();
            exit;
        }
    } else {
        // No password submitted yet, display the password prompt
        $ui->display('password_prompt.tpl');
        ob_end_flush();
        exit;
    }
}

// If authenticated via cookie, proceed with the rest of the script

if (file_exists('system/paymentgateway/' . $action . '.php')) {
    include 'system/paymentgateway/' . $action . '.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (function_exists($action . '_save_config')) {
            call_user_func($action . '_save_config');
            _log("Settings for {$action} saved successfully.", 'settings');
        } else {
            $ui->display('a404.tpl');
        }
    } else {
        if (function_exists($action . '_show_config')) {
            call_user_func($action . '_show_config');
        } else {
            $ui->display('a404.tpl');
        }
    }
} else {
    if (!empty($action)) {
        r2(U . 'paymentgateway', 'w', Lang::T('Payment Gateway Not Found'));
    } else {
        $files = scandir('system/paymentgateway/');
        $pgs = []; // Initialize the array to prevent undefined variable notice
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                $pgs[] = str_replace('.php', '', $file);
            }
        }

        if (isset($_POST['payment_gateway'])) {
            $payment_gateway = _post('payment_gateway');

            try {
                $d = ORM::for_table('tbl_appconfig')->where('setting', 'payment_gateway')->find_one();
                if ($d) {
                    $d->value = $payment_gateway;
                    $d->save();
                } else {
                    $d = ORM::for_table('tbl_appconfig')->create();
                    $d->setting = 'payment_gateway';
                    $d->value = $payment_gateway;
                    $d->save();
                }
                _log("Payment gateway configuration saved successfully: {$payment_gateway}", 'settings');
            } catch (Exception $e) {
                // Handle database error if needed
            }

            r2(U . 'paymentgateway', 's', Lang::T('Payment Gateway saved successfully'));
        }

        $ui->assign('_title', 'Payment Gateway Settings');
        $ui->assign('pgs', $pgs);
        $ui->display('paymentgateway.tpl');
    }
}
?>
