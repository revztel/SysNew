<?php
session_start(); // Start the session at the beginning

_admin(); // Ensure the user is logged in

if (!isset($_SESSION['aid'])) {
    header('Location: ' . U . 'admin');
    exit;
}

// Get the action from the URL
if (isset($routes['1'])) {
    $action = $routes['1'];
} else {
    $action = 'dashboard'; // Default action
}

// Debugging: Log the action and request method
error_log("Action: $action, Method: " . $_SERVER['REQUEST_METHOD']);

switch ($action) {
    case 'change-password':
        // Ensure the user is logged in
        _admin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Log POST data
            error_log("POST Data: " . print_r($_POST, true));

            // Retrieve POST variables
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($newPassword === $confirmPassword) {
                if (strlen($newPassword) < 8) {
                    _alert(Lang::T('Password must be at least 8 characters long'), 'danger', "change-password/change-password");
                    exit;
                }

                // Hash the new password using SHA1
                $hashedPassword = sha1($newPassword);

                // Update the user's password in the database
                $user = ORM::for_table('tbl_users')->find_one($_SESSION['aid']);
                if ($user) {
                    $user->password = $hashedPassword;
                    $user->save();

                    // Unset the force password change flag
                    unset($_SESSION['force_password_change']);

                    // Regenerate session ID for security
                    session_regenerate_id(true);

                    // Redirect to the dashboard with a success message
                    _alert(Lang::T('Password changed successfully'), 'success', "dashboard");
                } else {
                    _alert(Lang::T('User not found'), 'danger', "change-password/change-password");
                }
            } else {
                _alert(Lang::T('Passwords do not match'), 'danger', "change-password/change-password");
            }
        } else {
            // Display the password change form
            $ui->display('admin-change-password.tpl');
        }
        break;

    // ... other cases ...

    default:
        // Redirect to dashboard or show an error
        header('Location: ' . U . 'admin/dashboard');
        break;
}
