<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Troubleshooting Guide') . ' - ' . $config['CompanyName']);
$ui->assign('_system_menu', 'logs');
$ui->assign('_admin', $admin);

// Check if the user has permission
if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin', 'Support'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'view';

switch ($action) {
    case 'view':
    default:
        // Define the troubleshooting content
        $troubleshooting = [
            'hotspot' => [
                'title' => Lang::T('Hotspot Troubleshooting'),
                'description' => Lang::T('Common issues and solutions for Hotspot users.'),
                'sections' => [
                    [
                        'title' => Lang::T('User Not Connected After Payment'),
                        'description' => Lang::T('This can happen when you lose internet connectivity but your router remains active, causing the client to complete the payment without being added to the MikroTik system.'),
                        'steps' => [
                            Lang::T('Check the router status under Network > Routers to ensure the router is online.'),
                            Lang::T('If the router is offline, the user wasn\'t connected due to the router being unreachable during the payment process.'),
                        ],
                    ],
                    [
                        'title' => Lang::T('Troubleshooting User Connection Issues'),
                        'description' => Lang::T('If a customer reports they weren’t reconnected after payment, follow these steps:'),
                        'steps' => [
                            Lang::T('Go to Logs > MikroTik Logs, select the router the customer is supposed to be connected to, and load the logs.'),
                            Lang::T('Search for the customer’s number or username to find potential errors.'),
                        ],
                        'errors' => [
                            [
                                'error' => Lang::T('Failed to login via cookies or MAC cookies'),
                                'log_message' => '2547xxxx:f:d4 failed to login via cookies or MAC cookies',
                                'description' => Lang::T('This error typically means that the customer was using the internet but was later logged out. The most likely causes are that the user\'s package expired, or their username was removed from the system.'),
                                'solution' => Lang::T('First, verify if the user is present in the MikroTik Hotspot system by navigating to Network > Hotspot > Users. If the user is listed, they might be using HTTP-PAP authentication. If not, check if the user has an active package. If they do, click "Sync" to re-add them to the system.'),
                            ],
                            [
                                'error' => Lang::T('Failed to login via HTTP-PAP'),
                                'log_message' => 'Failed to login via HTTP-PAP',
                                'description' => Lang::T('This error indicates that the user wasn’t added to the Hotspot system, possibly due to a timeout or other issue during the user addition process.'),
                                'solution' => Lang::T('Click "Sync" to re-add the user. This will address any issue caused by the initial failure during the adding process.'),
                            ],
                            [
                                'error' => Lang::T('Configuration failure when trying to log in'),
                                'log_message' => 'Configuration failure when trying to log in',
                                'description' => Lang::T('This error occurs when the user is present in the MikroTik system, but the user profiles (packages) are not correctly configured in MikroTik. This often happens if the user profiles were removed from MikroTik while users were still assigned to them.'),
                                'solution' => Lang::T('Log in to your MikroTik, navigate to Hotspot > Users, and delete all affected users. Once the users are removed, they can either repurchase their packages or you can recharge them on your new user profiles (packages).'),
                            ],
                            [
                                'error' => Lang::T('Login failed: data limit reached'),
                                'log_message' => 'Login failed: data limit reached',
                                'description' => Lang::T('This error occurs when a user reaches their data limit before the package’s time limit expires.'),
                                'solution' => Lang::T('Check the user’s package settings to ensure the data limit is sufficient for the expected usage. Communicate these limitations clearly to customers to avoid confusion.'),
                            ],
                            [
                                'error' => Lang::T('Login failed: time limit reached'),
                                'log_message' => 'Login failed: time limit reached',
                                'description' => Lang::T('This error occurs when the user exceeds the allocated time limit for their package, even though the package duration is still valid.'),
                                'solution' => Lang::T('Be clear when naming your plans and specifying time limits on the sign-in page. Make sure customers understand the difference between the overall package duration and the actual time they are allowed to use the internet.'),
                            ],
                            [
                                'error' => Lang::T('Invalid username or password'),
                                'log_message' => 'Invalid username or password',
                                'description' => Lang::T('This error occurs when the user enters incorrect login credentials.'),
                                'solution' => Lang::T('Ask the user to double-check their username and password, paying attention to common mistakes such as confusing the letter "O" with the number "0". If necessary, reset their credentials or guide them through the password recovery process.'),
                            ],
                            [
                                'error' => Lang::T('No available IP address in pool'),
                                'log_message' => 'No available IP address in pool',
                                'description' => Lang::T('This error appears when the DHCP pool runs out of available IP addresses, preventing users from connecting.'),
                                'solution' => Lang::T('Check the IP pool configuration under IP > Pool in the MikroTik router. Ensure that there are enough available IP addresses to accommodate new users. If necessary, expand the IP pool to avoid future issues.'),
                            ],
                        ],
                    ],
                ],
            ],
            'pppoe' => [
                'title' => Lang::T('PPPoE Troubleshooting'),
                'description' => Lang::T('Common issues and solutions for PPPoE users.'),
                'sections' => [
                    [
                        'title' => Lang::T('Authentication Failure'),
                        'description' => Lang::T('If the logs show "authentication failed" for a specific user, the first step is to verify if the user has an active package and is activated. If the user is activated, log in to your MikroTik router and check if the user has been added under PPP Secrets. In the admin panel, navigate to Network > PPP > Secrets. If the user is missing, a quick fix is to sync users under Prepaid Users, which will add the user.'),
                        'steps' => [
                            Lang::T('Verify if the user has an active package and is activated.'),
                            Lang::T('Check if the user exists under PPP Secrets in MikroTik.'),
                            Lang::T('If the user is missing, sync users under Prepaid Users in the admin panel.'),
                        ],
                        'note' => Lang::T('Be mindful of potential confusion between the number "0" and the letter "O" in usernames and passwords.'),
                    ],
                    [
                        'title' => Lang::T('User in Secrets but Still Failing'),
                        'description' => Lang::T('If the user appears in the secrets list but the authentication issue persists, double-check the username and password.'),
                        'steps' => [
                            Lang::T('Ensure the username and password are correct.'),
                            Lang::T('Pay attention to potential confusion between similar characters.'),
                        ],
                    ],
                    [
                        'title' => Lang::T('No PPPoE Logs'),
                        'description' => Lang::T('If you connect a user and no logs show a "PPPoE connection established," it indicates that the PPPoE server may not be set up.'),
                        'steps' => [
                            Lang::T('Go to the admin panel under Network > PPPoE Server and create a new server.'),
                            Lang::T('Alternatively, set up the PPPoE server directly on the MikroTik router.'),
                            Lang::T('The service name can be anything.'),
                            Lang::T('For the interface, select "hotspot-bridge" to use the same port for both Hotspot and PPPoE.'),
                        ],
                    ],
                ],
            ],
        ];

        $ui->assign('troubleshooting', $troubleshooting);
        $ui->display('troubleshoot.tpl');
        break;
}
?>
