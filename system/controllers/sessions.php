<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files



// Ensure the admin is logged in and has the necessary permissions
_admin();
$ui->assign('_system_menu', 'sessions');
$action = $routes['1'];
$ui->assign('_admin', $admin);

$admin_id = $_SESSION['aid'];
$admin = ORM::for_table('tbl_users')->find_one($admin_id);

if (!$admin || $admin['user_type'] != 'SuperAdmin') {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
    exit;
}

// Handle actions
$action = isset($routes['1']) ? $routes['1'] : 'list';

// Fetch current session ID
$current_session_id = session_id();
$ui->assign('current_session_id', $current_session_id);

switch ($action) {
    case 'list':
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
        break;

    case 'delete':
        $session_id = isset($routes['2']) ? $routes['2'] : null;
        if ($session_id) {
            // Find the session by session_id
            $session = ORM::for_table('tbl_active_sessions')
                ->where('session_id', $session_id)
                ->find_one();
            if ($session) {
                $session->delete();
                _alert(Lang::T('Session deleted successfully'), 'success', "sessions/list");
            } else {
                _alert(Lang::T('Session not found'), 'danger', "sessions/list");
            }
        } else {
            _alert(Lang::T('Invalid session ID'), 'danger', "sessions/list");
        }
        break;

    default:
        header('Location: ' . U . 'sessions/list');
        exit;
}
