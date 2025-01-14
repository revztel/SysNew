<?php
session_start();

// Include necessary files (e.g., ORM initialization, functions)
// include 'init.php';

// Ensure the admin is logged in and has the necessary permissions
_admin();

$admin_id = $_SESSION['aid'];
$admin = ORM::for_table('tbl_users')->find_one($admin_id);

if (!$admin || $admin['user_type'] != 'SuperAdmin') {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
    exit;
}

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

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
        $ui->display('session-management.tpl');
        break;

    case 'delete':
        $session_id = isset($_GET['session_id']) ? $_GET['session_id'] : null;
        if ($session_id) {
            $session = ORM::for_table('tbl_active_sessions')->find_one($session_id);
            if ($session) {
                $session->delete();
                _alert(Lang::T('Session deleted successfully'), 'success', "session_management.php?action=list");
            } else {
                _alert(Lang::T('Session not found'), 'danger', "session_management.php?action=list");
            }
        } else {
            _alert(Lang::T('Invalid session ID'), 'danger', "session_management.php?action=list");
        }
        break;

    default:
        header('Location: session_management.php?action=list');
        break;
}
