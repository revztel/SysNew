<?php

/**
 *  PHP Mikrotik Billing (https://freeispradius.com/)
 *  by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Reports'));
$ui->assign('_system_menu', 'reports');

$action = $routes['1'];
//$admin = Admin::_info();
$ui->assign('_admin', $admin);

$mdate = date('Y-m-d');
$mtime = date('H:i:s');
$tdate = date('Y-m-d', strtotime('today - 30 days'));
$firs_day_month = date('Y-m-01');
$this_week_start = date('Y-m-d', strtotime('previous sunday'));
$before_30_days = date('Y-m-d', strtotime('today - 30 days'));
$month_n = date('n');
$last_week_start = date('Y-m-d', strtotime('monday last week'));
$last_week_end = date('Y-m-d', strtotime('sunday last week'));

switch ($action) {
    case 'by-date':
    case 'activation':
        $q = (_post('q') ? _post('q') : _get('q'));
        $keep = _post('keep');
        if (!empty($keep)) {
            ORM::raw_execute("DELETE FROM tbl_transactions WHERE date < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL $keep DAY))");
            r2(U . "logs/list/", 's', "Delete logs older than $keep days");
        }
        if ($q != '') {
            $paginator = Paginator::build(ORM::for_table('tbl_transactions'), ['invoice' => '%' . $q . '%'], $q);
            $d = ORM::for_table('tbl_transactions')->where_like('invoice', '%' . $q . '%')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        } else {
            $paginator = Paginator::build(ORM::for_table('tbl_transactions'));
            $d = ORM::for_table('tbl_transactions')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        }

        $ui->assign('activation', $d);
        $ui->assign('q', $q);
        $ui->assign('paginator', $paginator);
        $ui->display('reports-activation.tpl');
        break;
    case 'daily-report':
        $paginator = Paginator::build(ORM::for_table('tbl_transactions'), ['recharged_on' => $mdate]);
        $d = ORM::for_table('tbl_transactions')->where('recharged_on', $mdate)->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        $dr = ORM::for_table('tbl_transactions')->where('recharged_on', $mdate)->sum('price');

        $ui->assign('d', $d);
        $ui->assign('dr', $dr);
        $ui->assign('mdate', $mdate);
        $ui->assign('mtime', $mtime);
        $ui->assign('paginator', $paginator);
        run_hook('view_daily_reports'); #HOOK
        $ui->display('reports-daily.tpl');
        break;

        case 'by-period':
            // Fetch routers from tbl_routers
            $routers = ORM::for_table('tbl_routers')
                ->select('name') // Assuming `router_name` is the column for router names
                ->find_array();
        
            // Assign variables to the template
            $ui->assign('mdate', $mdate);
            $ui->assign('mtime', $mtime);
            $ui->assign('tdate', $tdate);
            $ui->assign('routers', $routers); // Pass routers to the template
        
            run_hook('view_reports_by_period'); #HOOK
            $ui->display('reports-period.tpl');
            break;
        

            case 'period-view':
                $fdate = _post('fdate');
                $tdate = _post('tdate');
                $stype = _post('stype');
                $router = _post('router'); // Capture the selected router
            
                // Query for transactions
                $d = ORM::for_table('tbl_transactions');
                if (!empty($stype)) {
                    $d->where('type', $stype);
                }
            
                if (!empty($router)) {
                    $d->where('routers', $router); // Add router filter
                }
            
                $d->where_gte('recharged_on', $fdate);
                $d->where_lte('recharged_on', $tdate);
                $d->order_by_desc('id');
                $x = $d->find_many();
            
                // Query for total price (filtered by the same criteria)
                $dr = ORM::for_table('tbl_transactions');
                if (!empty($stype)) {
                    $dr->where('type', $stype);
                }
            
                if (!empty($router)) {
                    $dr->where('routers', $router); // Add router filter
                }
            
                $dr->where_gte('recharged_on', $fdate);
                $dr->where_lte('recharged_on', $tdate);
                $xy = $dr->sum('price');
            
                // Assign variables to the template
                $ui->assign('d', $x);
                $ui->assign('dr', $xy);
                $ui->assign('fdate', $fdate);
                $ui->assign('tdate', $tdate);
                $ui->assign('stype', $stype);
                $ui->assign('router', $router); // Pass the selected router to the template
            
                run_hook('view_reports_period'); #HOOK
                $ui->display('reports-period-view.tpl');
                break;
            
// In your PHP controller file (e.g., index.php or controller.php)

// In your PHP controller file (e.g., index.php or controller.php)

case 'transactions-graph':
    // Current date and time
    $mdate = date('Y-m-d');
    $mtime = date('H:i:s');

    // Calculate week start and end dates
    $this_week_start = date('Y-m-d', strtotime('monday this week'));
    $last_week_start = date('Y-m-d', strtotime('monday last week'));
    $last_week_end = date('Y-m-d', strtotime('sunday last week'));

    // Transactions grouped by date (daily for the past month)
    $transactions_daily = ORM::for_table('tbl_transactions')
        ->select_expr('DATE(recharged_on)', 'date')
        ->select_expr('SUM(price)', 'total')
        ->where_gte('recharged_on', date('Y-m-d', strtotime('-30 days')))
        ->group_by('date')
        ->order_by_asc('date')
        ->find_array();

    // Transactions grouped by week for the past 12 weeks
    $transactions_weekly = ORM::for_table('tbl_transactions')
        ->select_expr('YEARWEEK(recharged_on, 1)', 'week')
        ->select_expr('SUM(price)', 'total')
        ->where_gte('recharged_on', date('Y-m-d', strtotime('-12 weeks')))
        ->group_by('week')
        ->order_by_asc('week')
        ->find_array();

    // Transactions grouped by month for the past year
    $transactions_monthly = ORM::for_table('tbl_transactions')
        ->select_expr('DATE_FORMAT(recharged_on, "%Y-%m")', 'month')
        ->select_expr('SUM(price)', 'total')
        ->where_gte('recharged_on', date('Y-m-d', strtotime('-1 year')))
        ->group_by('month')
        ->order_by_asc('month')
        ->find_array();

// Transactions by type (for the current month only)
$transactions_by_type = ORM::for_table('tbl_transactions')
    ->select('type')
    ->select_expr('SUM(price)', 'total')
    ->where_gte('recharged_on', date('Y-m-01')) // Start of the current month
    ->where_lte('recharged_on', date('Y-m-d')) // Today's date
    ->group_by('type')
    ->find_array();


// Transactions by router (for the current month only)
$transactions_by_router = ORM::for_table('tbl_transactions')
    ->select('routers')
    ->select_expr('SUM(price)', 'amount')
    ->where_gte('recharged_on', date('Y-m-01')) // Start of the current month
    ->where_lte('recharged_on', date('Y-m-d')) // Today's date
    ->group_by('routers')
    ->find_array();


    // Sales Comparisons

    // Today vs Yesterday
    $sales_today = ORM::for_table('tbl_transactions')
        ->where('recharged_on', $mdate)
        ->sum('price') ?: 0;
    $sales_yesterday = ORM::for_table('tbl_transactions')
        ->where('recharged_on', date('Y-m-d', strtotime('-1 day')))
        ->sum('price') ?: 0;
    $today_vs_yesterday_percentage = calculate_percentage_change($sales_yesterday, $sales_today);

    // This Week vs Last Week
    $sales_this_week = ORM::for_table('tbl_transactions')
        ->where_gte('recharged_on', $this_week_start)
        ->where_lte('recharged_on', $mdate)
        ->sum('price') ?: 0;
    $sales_last_week = ORM::for_table('tbl_transactions')
        ->where_gte('recharged_on', $last_week_start)
        ->where_lte('recharged_on', $last_week_end)
        ->sum('price') ?: 0;
    $this_week_vs_last_week_percentage = calculate_percentage_change($sales_last_week, $sales_this_week);

    // This Month vs Last Month
    $this_month_start = date('Y-m-01');
    $last_month_start = date('Y-m-d', strtotime('first day of last month'));
    $last_month_end = date('Y-m-d', strtotime('last day of last month'));
    $sales_this_month = ORM::for_table('tbl_transactions')
        ->where_gte('recharged_on', $this_month_start)
        ->where_lte('recharged_on', $mdate)
        ->sum('price') ?: 0;
    $sales_last_month = ORM::for_table('tbl_transactions')
        ->where_gte('recharged_on', $last_month_start)
        ->where_lte('recharged_on', $last_month_end)
        ->sum('price') ?: 0;
    $this_month_vs_last_month_percentage = calculate_percentage_change($sales_last_month, $sales_this_month);

    // Transactions by Customer (Top 10)
    $transactions_by_customer = ORM::for_table('tbl_transactions')
        ->select('username')
        ->select_expr('SUM(price)', 'total')
        ->group_by('username')
        ->order_by_desc('total')
        ->limit(10)
        ->find_array();

    // Revenue by Service Plan
// Revenue by Service Plan (for the current month only)
$transactions_by_plan = ORM::for_table('tbl_transactions')
    ->select('plan_name')
    ->select_expr('SUM(price)', 'total')
    ->where_gte('recharged_on', date('Y-m-01')) // Start of the current month
    ->where_lte('recharged_on', date('Y-m-d')) // Today's date
    ->group_by('plan_name')
    ->order_by_desc('total')
    ->find_array();


    // Average Transaction Value Over Time (Daily)
    $average_transaction_value_daily = ORM::for_table('tbl_transactions')
        ->select_expr('DATE(recharged_on)', 'date')
        ->select_expr('AVG(price)', 'average')
        ->where_gte('recharged_on', date('Y-m-d', strtotime('-30 days')))
        ->group_by('date')
        ->order_by_asc('date')
        ->find_array();

    // Peak Transaction Hours (Last 7 Days)
    $transactions_by_hour = ORM::for_table('tbl_transactions')
        ->select_expr('HOUR(CONCAT(recharged_on, " ", recharged_time))', 'hour')
        ->select_expr('SUM(price)', 'total')
        ->where_gte('recharged_on', date('Y-m-d', strtotime('-7 days')))
        ->group_by('hour')
        ->order_by_asc('hour')
        ->find_array();

// Transactions by Payment Method (using the first word of 'method') for the current month
$transactions_by_payment_method = ORM::for_table('tbl_transactions')
    ->select_expr('TRIM(SUBSTRING_INDEX(method, "-", 1))', 'method_short') // Extract the first word before the hyphen
    ->select_expr('SUM(price)', 'total') // Sum the prices
    ->where_gte('recharged_on', date('Y-m-01')) // Start of the current month
    ->where_lte('recharged_on', date('Y-m-d')) // Today's date
    ->group_by_expr('TRIM(SUBSTRING_INDEX(method, "-", 1))') // Group by the first word of 'method'
    ->find_array();


    // New vs Returning Customers (Last 30 Days)
    // Determine new and returning customers based on first transaction date
    $customer_first_transactions = ORM::for_table('tbl_transactions')
        ->select('username')
        ->select_expr('MIN(recharged_on)', 'first_transaction_date')
        ->group_by('username')
        ->find_array();

    // Initialize counts
    $new_customers = 0;
    $returning_customers = 0;

    // Set the date 30 days ago
    $thirty_days_ago = date('Y-m-d', strtotime('-30 days'));

    // Determine new and returning customers
    foreach ($customer_first_transactions as $customer) {
        if ($customer['first_transaction_date'] >= $thirty_days_ago) {
            $new_customers++;
        } else {
            $returning_customers++;
        }
    }

    // Encode data to JSON for use in JavaScript
    $transactions_daily_json = json_encode($transactions_daily);
    $transactions_weekly_json = json_encode($transactions_weekly);
    $transactions_monthly_json = json_encode($transactions_monthly);
    $transactions_by_type_json = json_encode($transactions_by_type);
    $transactions_by_router_json = json_encode($transactions_by_router);
    $transactions_by_customer_json = json_encode($transactions_by_customer);
    $transactions_by_plan_json = json_encode($transactions_by_plan);
    $average_transaction_value_daily_json = json_encode($average_transaction_value_daily);
    $transactions_by_hour_json = json_encode($transactions_by_hour);
    $transactions_by_payment_method_json = json_encode($transactions_by_payment_method);

    // Assign data to the template
    $ui->assign('transactions_daily_json', $transactions_daily_json);
    $ui->assign('transactions_weekly_json', $transactions_weekly_json);
    $ui->assign('transactions_monthly_json', $transactions_monthly_json);
    $ui->assign('transactions_by_type_json', $transactions_by_type_json);
    $ui->assign('transactions_by_router_json', $transactions_by_router_json);
    $ui->assign('transactions_by_customer_json', $transactions_by_customer_json);
    $ui->assign('transactions_by_plan_json', $transactions_by_plan_json);
    $ui->assign('average_transaction_value_daily_json', $average_transaction_value_daily_json);
    $ui->assign('transactions_by_hour_json', $transactions_by_hour_json);
    $ui->assign('transactions_by_payment_method_json', $transactions_by_payment_method_json);
    $ui->assign('new_customers', $new_customers);
    $ui->assign('returning_customers', $returning_customers);

    // Assign sales comparisons
    $ui->assign('sales_today', $sales_today);
    $ui->assign('sales_yesterday', $sales_yesterday);
    $ui->assign('today_vs_yesterday_percentage', $today_vs_yesterday_percentage);

    $ui->assign('sales_this_week', $sales_this_week);
    $ui->assign('sales_last_week', $sales_last_week);
    $ui->assign('this_week_vs_last_week_percentage', $this_week_vs_last_week_percentage);

    $ui->assign('sales_this_month', $sales_this_month);
    $ui->assign('sales_last_month', $sales_last_month);
    $ui->assign('this_month_vs_last_month_percentage', $this_month_vs_last_month_percentage);

    $ui->assign('mdate', $mdate);
    $ui->assign('mtime', $mtime);

    // Display the template
    $ui->display('reports-graph.tpl');
    break;

default:
    $ui->display('a404.tpl');
}

// Helper function to calculate percentage change
function calculate_percentage_change($old_value, $new_value) {
    if ($old_value == 0 && $new_value == 0) {
        return 0;
    } elseif ($old_value == 0) {
        return 100; // From zero to something is a 100% increase
    } else {
        return (($new_value - $old_value) / abs($old_value)) * 100;
    }
}
