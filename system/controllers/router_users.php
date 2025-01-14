<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Users Management'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

// Check if the user has permission
if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'list';

switch ($action) {
    case 'list':
        // List router users
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch users
                    $userRequest = new RouterOS\Request('/user/print');
                    $userResponse = $client->sendSync($userRequest);

                    $users = [];
                    foreach ($userResponse as $user) {
                        $users[] = [
                            'id' => $user->getProperty('.id'),
                            'name' => $user->getProperty('name'),
                            'group' => $user->getProperty('group'),
                            'comment' => $user->getProperty('comment'),
                            'disabled' => $user->getProperty('disabled') == 'false' ? 'No' : 'Yes',
                        ];
                    }

                    $ui->assign('selected_router', $router);
                    $ui->assign('users', $users);
                } catch (Exception $e) {
                    error_log('Error fetching users: ' . $e->getMessage());
                    r2(U . 'router_users/list', 'e', Lang::T('Error fetching users: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_users.tpl');
        break;

    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $name = _post('name');
            $password = _post('password');
            $group = _post('group');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($name) || empty($password) || empty($group)) {
                r2(U . 'router_users/add/' . $router_id, 'e', Lang::T('Name, Password, and Group are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Check if user already exists
                    $userExistsRequest = new RouterOS\Request('/user/print');
                    $userExistsRequest->setQuery(RouterOS\Query::where('name', $name));
                    $userExistsResponse = $client->sendSync($userExistsRequest);

                    if (count($userExistsResponse) > 0) {
                        r2(U . 'router_users/add/' . $router_id, 'e', Lang::T('User already exists on the router'));
                    }

                    // Add new user
                    $addUserRequest = new RouterOS\Request('/user/add');
                    $addUserRequest->setArgument('name', $name);
                    $addUserRequest->setArgument('password', $password);
                    $addUserRequest->setArgument('group', $group);
                    if (!empty($comment)) {
                        $addUserRequest->setArgument('comment', $comment);
                    }
                    $addUserRequest->setArgument('disabled', $disabled);

                    $client->sendSync($addUserRequest);

                    r2(U . 'router_users/list', 's', Lang::T('User added successfully to the router'));
                } catch (Exception $e) {
                    error_log('Error adding user: ' . $e->getMessage());
                    r2(U . 'router_users/add/' . $router_id, 'e', Lang::T('Error adding user: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch groups for selection
                    $groupRequest = new RouterOS\Request('/user/group/print');
                    $groupResponse = $client->sendSync($groupRequest);

                    $groups = [];
                    foreach ($groupResponse as $group) {
                        $groups[] = $group->getProperty('name');
                    }

                    $ui->assign('router_id', $router_id);
                    $ui->assign('groups', $groups);
                    $ui->display('router_users_add.tpl');
                } catch (Exception $e) {
                    error_log('Error fetching groups: ' . $e->getMessage());
                    r2(U . 'router_users/list', 'e', Lang::T('Error fetching groups: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router_id = _post('router_id');
            $user_id = _post('user_id');
            $name = _post('name');
            $password = _post('password');
            $group = _post('group');
            $comment = _post('comment');
            $disabled = isset($_POST['disabled']) ? 'yes' : 'no';

            if (empty($name) || empty($group)) {
                r2(U . 'router_users/edit/' . $router_id . '/' . urlencode($user_id), 'e', Lang::T('Name and Group are required'));
            }

            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Set user properties
                    $setUserRequest = new RouterOS\Request('/user/set');
                    $setUserRequest->setArgument('numbers', $user_id);
                    $setUserRequest->setArgument('name', $name);
                    $setUserRequest->setArgument('group', $group);
                    if (!empty($comment)) {
                        $setUserRequest->setArgument('comment', $comment);
                    }
                    $setUserRequest->setArgument('disabled', $disabled);

                    if (!empty($password)) {
                        $setUserRequest->setArgument('password', $password);
                    }

                    $client->sendSync($setUserRequest);

                    r2(U . 'router_users/list', 's', Lang::T('User updated successfully on the router'));
                } catch (Exception $e) {
                    error_log('Error updating user: ' . $e->getMessage());
                    r2(U . 'router_users/edit/' . $router_id . '/' . urlencode($user_id), 'e', Lang::T('Error updating user: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
            }
        } else {
            $router_id = $routes['2'] ?? null;
            $user_id = $routes['3'] ?? null;
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch user details
                    $userRequest = new RouterOS\Request('/user/print');
                    $userRequest->setQuery(RouterOS\Query::where('.id', $user_id));
                    $userResponse = $client->sendSync($userRequest);

                    if (count($userResponse) > 0) {
                        foreach ($userResponse as $user) {
                            $userData = [
                                'id' => $user->getProperty('.id'),
                                'name' => $user->getProperty('name'),
                                'group' => $user->getProperty('group'),
                                'comment' => $user->getProperty('comment'),
                                'disabled' => $user->getProperty('disabled') == 'false' ? false : true,
                            ];
                            break;
                        }

                        // Fetch groups for selection
                        $groupRequest = new RouterOS\Request('/user/group/print');
                        $groupResponse = $client->sendSync($groupRequest);

                        $groups = [];
                        foreach ($groupResponse as $group) {
                            $groups[] = $group->getProperty('name');
                        }

                        $ui->assign('router_id', $router_id);
                        $ui->assign('user', $userData);
                        $ui->assign('groups', $groups);
                        $ui->display('router_users_edit.tpl');
                    } else {
                        r2(U . 'router_users/list', 'e', Lang::T('User not found on the router'));
                    }
                } catch (Exception $e) {
                    error_log('Error fetching user details: ' . $e->getMessage());
                    r2(U . 'router_users/list', 'e', Lang::T('Error fetching user details: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
            }
        }
        break;

    case 'delete':
        $router_id = _post('router_id');
        $user_id = _post('user_id');

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                // Prevent deletion of the current user
                if ($user_id == $client->getUser()) {
                    r2(U . 'router_users/list', 'e', Lang::T('You cannot delete the currently logged-in user on the router'));
                }

                $removeUserRequest = new RouterOS\Request('/user/remove');
                $removeUserRequest->setArgument('numbers', $user_id);

                $client->sendSync($removeUserRequest);

                r2(U . 'router_users/list', 's', Lang::T('User deleted successfully from the router'));
            } catch (Exception $e) {
                error_log('Error deleting user: ' . $e->getMessage());
                r2(U . 'router_users/list', 'e', Lang::T('Error deleting user: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_users/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_users/list', 's', '');
}
?>
