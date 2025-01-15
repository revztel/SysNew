<?php
_auth();
$user = User::_info();

if (!$user) {
    error_log('User not authenticated.');
    r2(U . 'login', 'e', Lang::T('Please login first'));
    exit;
} else {
    error_log('User authenticated: ' . $user['username']);
}

$ui->assign('_user', $user);
$ui->assign('_title', Lang::T('Messages'));
$ui->assign('_system_menu', 'messages');

$action = isset($routes[1]) ? $routes[1] : 'inbox';
error_log('user_messages.php called, action: ' . $action);

switch ($action) {

    case '':
    case 'inbox':
        error_log('user_messages.php: inbox case');
        $messages = [];

        try {
            // Fetch transactions
            $transactions = ORM::for_table('tbl_transactions')
                ->where('username', $user['username'])
                ->order_by_desc('recharged_on')
                ->find_array();
            error_log('Transactions fetched: ' . count($transactions));

            foreach ($transactions as $transaction) {
                $messages[] = [
                    'id' => 'txn_' . $transaction['id'],
                    'title' => 'Transaction Successful',
                    'date' => date('Y-m-d H:i:s', strtotime($transaction['recharged_on'] . ' ' . $transaction['recharged_time'])),
                    'unread' => !$transaction['is_read'],
                    'type' => 'transaction',
                    'details' => $transaction,
                    'content' => 'Hello ' . $user['username'] . ', your transaction of ' . Lang::moneyFormat($transaction['amount']) . ' was successful.'
                ];
            }

            // Fetch recharges
            $recharges = ORM::for_table('tbl_user_recharges')
                ->where('username', $user['username'])
                ->order_by_desc('recharged_on')
                ->find_array();
            error_log('Recharges fetched: ' . count($recharges));

            foreach ($recharges as $recharge) {
                $messages[] = [
                    'id' => 'rchg_' . $recharge['id'],
                    'title' => 'Recharge Successful',
                    'date' => date('Y-m-d H:i:s', strtotime($recharge['recharged_on'] . ' ' . $recharge['recharged_time'])),
                    'unread' => !$recharge['is_read'],
                    'type' => 'recharge',
                    'details' => $recharge,
                    'content' => 'Hello ' . $user['username'] . ', your account has been successfully activated with a recharge of ' . Lang::moneyFormat($recharge['amount']) . '.'
                ];
            }

            // Sort messages by date
            usort($messages, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            // Get unread messages count
            $unread_count = 0;
            $latest_messages = [];
            foreach ($messages as $message) {
                if ($message['unread']) {
                    $unread_count++;
                }
                // Get latest 5 messages for dropdown
                if (count($latest_messages) < 5) {
                    $latest_messages[] = $message;
                }
            }

            $ui->assign('messages', $messages);
            $ui->assign('unread_count', $unread_count);
            $ui->assign('latest_messages', $latest_messages);

            error_log('About to display user-messages.tpl');
            $ui->display('user-messages.tpl');
            error_log('Displayed user-messages.tpl');
        } catch (Exception $e) {
            error_log('Error in inbox case: ' . $e->getMessage());
            r2(U . 'home', 'e', Lang::T('An error occurred while fetching messages.'));
        }
        break;

    case 'view':
        error_log('user_messages.php: view case');
        $message_id = isset($routes[2]) ? $routes[2] : null;

        if (!$message_id) {
            r2(U . 'user_messages/inbox', 'e', Lang::T('Message not found'));
        }

        $message = null;
        $type = substr($message_id, 0, 5);
        $id = substr($message_id, 5);

        if ($type == 'txn_') {
            $transaction = ORM::for_table('tbl_transactions')
                ->where('username', $user['username'])
                ->find_one($id);

            if ($transaction) {
                $message = [
                    'id' => 'txn_' . $transaction['id'],
                    'title' => 'Transaction Successful',
                    'date' => date('Y-m-d H:i:s', strtotime($transaction['recharged_on'] . ' ' . $transaction['recharged_time'])),
                    'unread' => !$transaction['is_read'],
                    'type' => 'transaction',
                    'details' => $transaction,
                    'content' => 'Hello ' . $user['username'] . ', your transaction of ' . Lang::moneyFormat($transaction['amount']) . ' was successful.'
                ];

                // Mark as read
                if (!$transaction['is_read']) {
                    $transaction->set('is_read', 1);
                    $transaction->save();
                }
            }
        } elseif ($type == 'rchg_') {
            $recharge = ORM::for_table('tbl_user_recharges')
                ->where('username', $user['username'])
                ->find_one($id);

            if ($recharge) {
                $message = [
                    'id' => 'rchg_' . $recharge['id'],
                    'title' => 'Recharge Successful',
                    'date' => date('Y-m-d H:i:s', strtotime($recharge['recharged_on'] . ' ' . $recharge['recharged_time'])),
                    'unread' => !$recharge['is_read'],
                    'type' => 'recharge',
                    'details' => $recharge,
                    'content' => 'Hello ' . $user['username'] . ', your account has been successfully activated with a recharge of ' . Lang::moneyFormat($recharge['amount']) . '.'
                ];

                // Mark as read
                if (!$recharge['is_read']) {
                    $recharge->set('is_read', 1);
                    $recharge->save();
                }
            }
        }

        if (!$message) {
            r2(U . 'user_messages/inbox', 'e', Lang::T('Message not found'));
        }

        $ui->assign('message', $message);

        // Update unread count for header
        $unread_count = ORM::for_table('tbl_transactions')
            ->where('username', $user['username'])
            ->where('is_read', 0)
            ->count()
            + ORM::for_table('tbl_user_recharges')
            ->where('username', $user['username'])
            ->where('is_read', 0)
            ->count();
        $ui->assign('unread_count', $unread_count);

        $ui->display('user-message-view.tpl');
        break;

    case 'mark-as-unread':
        error_log('user_messages.php: mark-as-unread case');
        $message_id = isset($routes[2]) ? $routes[2] : null;

        if (!$message_id) {
            r2(U . 'user_messages/inbox', 'e', Lang::T('Message not found'));
        }

        $type = substr($message_id, 0, 5);
        $id = substr($message_id, 5);

        if ($type == 'txn_') {
            $transaction = ORM::for_table('tbl_transactions')
                ->where('username', $user['username'])
                ->find_one($id);

            if ($transaction) {
                $transaction->set('is_read', 0);
                $transaction->save();
            }
        } elseif ($type == 'rchg_') {
            $recharge = ORM::for_table('tbl_user_recharges')
                ->where('username', $user['username'])
                ->find_one($id);

            if ($recharge) {
                $recharge->set('is_read', 0);
                $recharge->save();
            }
        }

        r2(U . 'user_messages/inbox', 's', Lang::T('Message marked as unread'));
        break;

    default:
        error_log('user_messages.php: default case');
        $ui->display('a404.tpl');
}
