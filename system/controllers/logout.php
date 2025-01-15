<?php

if (session_status() == PHP_SESSION_NONE) session_start();
if (isset($_SESSION['aid'])) {
    $session_id = session_id();

    // Find the session by session_id
    $active_session = ORM::for_table('tbl_active_sessions')
        ->where('session_id', $session_id)
        ->find_one();
    if ($active_session) {
        $active_session->delete();
    }

    Admin::removeCookie();
    User::removeCookie();
    session_destroy();
}

_alert(Lang::T('Logout Successful'), 'warning', "login");

