<?php
include "../init.php";
ob_start();

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Recycle Bin'));
$ui->assign('_system_menu', 'recycle');

// Fetch current admin information


$ui->assign('_admin', $admin);

// Get the action from the routes
$action = isset($routes[1]) ? $routes[1] : 'list';

// Define helper functions before they are used
function restoreItem($id) {
    global $admin;

    // Log the restore attempt
    _log('Attempting to restore item ID ' . $id, 'Debug', $admin['id']);

    $recycle_entry = ORM::for_table('tbl_recycle')->find_one($id);
    if ($recycle_entry) {
        $original_table = $recycle_entry->original_table;
        $original_id = $recycle_entry->original_id;
        $data = json_decode($recycle_entry->data, true);

        // Remove the 'id' field to prevent conflicts
        unset($data['id']);

        // Restore the item
        $new_item = ORM::for_table($original_table)->create();
        foreach ($data as $key => $value) {
            $new_item->set($key, $value);
        }
        $new_item->save();

        // Remove the entry from the recycle bin
        $recycle_entry->delete();

        // Log and redirect
        _log('[' . $admin['username'] . ']: Restored item from ' . $original_table, $admin['user_type'], $admin['id']);
        r2(U . 'recycle/list', 's', Lang::T('Item restored successfully'));
    } else {
        r2(U . 'recycle/list', 'e', Lang::T('Item not found in recycle bin'));
    }
}

function deleteItem($id) {
    global $admin;

    // Log the delete attempt
    _log('Attempting to permanently delete recycle bin item ID ' . $id, 'Debug', $admin['id']);

    $recycle_entry = ORM::for_table('tbl_recycle')->find_one($id);
    if ($recycle_entry) {
        // Permanently delete the recycle bin entry
        $recycle_entry->delete();

        // Log and redirect
        _log('[' . $admin['username'] . ']: Permanently deleted item from recycle bin', $admin['user_type'], $admin['id']);
        r2(U . 'recycle/list', 's', Lang::T('Item permanently deleted'));
    } else {
        r2(U . 'recycle/list', 'e', Lang::T('Item not found in recycle bin'));
    }
}

function emptyRecycleBin() {
    global $admin;

    // Log the empty attempt
    _log('Attempting to empty the recycle bin', 'Debug', $admin['id']);

    // Delete all entries from tbl_recycle
    ORM::for_table('tbl_recycle')->delete_many();

    // Log and redirect
    _log('[' . $admin['username'] . ']: Emptied the recycle bin', $admin['user_type'], $admin['id']);
    r2(U . 'recycle/list', 's', Lang::T('Recycle bin emptied successfully'));
}

// Now handle the action
switch ($action) {
    case 'list':
        $ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/recycle.js"></script>');
        $search = _post('search');

        $query = ORM::for_table('tbl_recycle')->order_by_desc('deleted_at');

        if ($search != '') {
            $query->where_raw('(data LIKE ?)', ['%' . $search . '%']);
        }

        $recycled_items = $query->find_many();

        // Prepare data for the view
        $items = [];
        foreach ($recycled_items as $item) {
            $data = json_decode($item->data, true);

            // Fetch deleted_by username from tbl_users
            $deleted_by_user = ORM::for_table('tbl_users')->find_one($item->deleted_by);
            $deleted_by_username = $deleted_by_user ? $deleted_by_user->username : 'Unknown';

            $items[] = [
                'id' => $item->id,
                // 'original_table' => $item->original_table, // Removed as per your request
                'original_id' => $item->original_id,
                'deleted_by' => $item->deleted_by,
                'deleted_by_username' => $deleted_by_username,
                'deleted_at' => $item->deleted_at,
                'data_summary' => $data // Use this to extract key information to display
            ];
        }

        $ui->assign('items', $items);
        $ui->display('recycle.tpl');
        break;

    case 'restore':
        $id = isset($routes[2]) ? $routes[2] : null;
        if ($id !== null) {
            restoreItem($id);
        } else {
            _alert(Lang::T('No ID specified for restore action'), 'danger', 'recycle/list');
        }
        break;

    case 'delete':
        $id = isset($routes[2]) ? $routes[2] : null;
        if ($id !== null) {
            deleteItem($id);
        } else {
            _alert(Lang::T('No ID specified for delete action'), 'danger', 'recycle/list');
        }
        break;

    case 'empty':
        emptyRecycleBin();
        break;

    default:
        _alert(Lang::T('Invalid action'), 'danger', 'recycle/list');
        break;
}
