<?php
/* Smarty version 4.3.1, created on 2024-11-22 18:25:23
  from 'F:\xampp\htdocs\radius\ui\themes\nova\reports-graph.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6740a263b33e42_31089798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '913f352adbcd20ae6ff2b4cebf525299a829ad3c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\reports-graph.tpl',
      1 => 1732289120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6740a263b33e42_31089798 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Transactions Graph -->
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2><?php echo Lang::T('Transactions Overview');?>
</h2>
            <p class="text-muted"><?php echo Lang::T('As of');?>
 <?php echo $_smarty_tpl->tpl_vars['mdate']->value;?>
 <?php echo Lang::T('at');?>
 <?php echo $_smarty_tpl->tpl_vars['mtime']->value;?>
</p>
        </div>
    </div>

    <!-- Sales Comparisons Section -->
    <div class="row">
        <!-- Today vs Yesterday -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <?php echo Lang::T('Today vs Yesterday');?>

                </div>
                <div class="panel-body">
                    <h5><?php echo Lang::T('Today');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_today']->value);?>
</h5>
                    <h5><?php echo Lang::T('Yesterday');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_yesterday']->value);?>
</h5>
                    <h5><?php echo Lang::T('Change');?>
:</h5>
                    <p>
                        <?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['today_vs_yesterday_percentage']->value,2);?>
% 
                        <?php if ($_smarty_tpl->tpl_vars['today_vs_yesterday_percentage']->value > 0) {?>
                            <span class="badge badge-success"><?php echo Lang::T('Increase');?>
</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['today_vs_yesterday_percentage']->value < 0) {?>
                            <span class="badge badge-danger"><?php echo Lang::T('Decrease');?>
</span>
                        <?php } else { ?>
                            <span class="badge badge-secondary"><?php echo Lang::T('No Change');?>
</span>
                        <?php }?>
                    </p>
                </div>
            </div>
        </div>

        <!-- This Week vs Last Week -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <?php echo Lang::T('This Week vs Last Week');?>

                </div>
                <div class="panel-body">
                    <h5><?php echo Lang::T('This Week');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_this_week']->value);?>
</h5>
                    <h5><?php echo Lang::T('Last Week');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_last_week']->value);?>
</h5>
                    <h5><?php echo Lang::T('Change');?>
:</h5>
                    <p>
                        <?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['this_week_vs_last_week_percentage']->value,2);?>
% 
                        <?php if ($_smarty_tpl->tpl_vars['this_week_vs_last_week_percentage']->value > 0) {?>
                            <span class="badge badge-success"><?php echo Lang::T('Increase');?>
</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['this_week_vs_last_week_percentage']->value < 0) {?>
                            <span class="badge badge-danger"><?php echo Lang::T('Decrease');?>
</span>
                        <?php } else { ?>
                            <span class="badge badge-secondary"><?php echo Lang::T('No Change');?>
</span>
                        <?php }?>
                    </p>
                </div>
            </div>
        </div>

        <!-- This Month vs Last Month -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <?php echo Lang::T('This Month vs Last Month');?>

                </div>
                <div class="panel-body">
                    <h5><?php echo Lang::T('This Month');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_this_month']->value);?>
</h5>
                    <h5><?php echo Lang::T('Last Month');?>
: <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['sales_last_month']->value);?>
</h5>
                    <h5><?php echo Lang::T('Change');?>
:</h5>
                    <p>
                        <?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['this_month_vs_last_month_percentage']->value,2);?>
% 
                        <?php if ($_smarty_tpl->tpl_vars['this_month_vs_last_month_percentage']->value > 0) {?>
                            <span class="badge badge-success"><?php echo Lang::T('Increase');?>
</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['this_month_vs_last_month_percentage']->value < 0) {?>
                            <span class="badge badge-danger"><?php echo Lang::T('Decrease');?>
</span>
                        <?php } else { ?>
                            <span class="badge badge-secondary"><?php echo Lang::T('No Change');?>
</span>
                        <?php }?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphs Section -->
    <div class="row">
        <!-- Daily Transactions Graph -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Daily Transactions');?>

                </div>
                <div class="panel-body">
                    <canvas id="dailyTransactionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Weekly Transactions Graph -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Weekly Transactions');?>

                </div>
                <div class="panel-body">
                    <canvas id="weeklyTransactionsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Monthly Transactions Graph -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Monthly Transactions');?>

                </div>
                <div class="panel-body">
                    <canvas id="monthlyTransactionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Transactions by Router -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Transactions by Router (Current Month)');?>

                </div>
                <div class="panel-body">
                    <canvas id="transactionsByRouterChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Average Transaction Value Over Time -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Average Transaction Value (Daily)');?>

                </div>
                <div class="panel-body">
                    <canvas id="averageTransactionValueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue by Service Plan -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Revenue by Service Plan(Current Month)');?>

                </div>
                <div class="panel-body">
                    <canvas id="transactionsByPlanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Transactions by Customer -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Top 10 Customers by Transactions');?>

                </div>
                <div class="panel-body">
                    <canvas id="transactionsByCustomerChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Peak Transaction Hours -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Peak Transaction Hours');?>

                </div>
                <div class="panel-body">
                    <canvas id="transactionsByHourChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Transactions by Payment Method -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('Transactions by Payment Method(Current Month)');?>

                </div>
                <div class="panel-body">
                    <canvas id="transactionsByPaymentMethodChart"></canvas>
                </div>
            </div>
        </div>

        <!-- New vs Returning Customers -->
        <div class="col-md-6 mb-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Lang::T('New vs Returning Customers (Last 30 Days)');?>

                </div>
                <div class="panel-body">
                    <canvas id="newVsReturningCustomersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js Library -->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>

<!-- JavaScript to Generate Charts -->
<?php echo '<script'; ?>
>
    // Parse the JSON data safely using JSON.parse and Smarty's escape:"javascript"

    // Daily Transactions Data
    var transactionsDaily = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_daily_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var dailyLabels = transactionsDaily.map(item => item.date);
    var dailyTotals = transactionsDaily.map(item => parseFloat(item.total));

    // Weekly Transactions Data
    var transactionsWeekly = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_weekly_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var weeklyLabels = transactionsWeekly.map(item => 'Week ' + item.week);
    var weeklyTotals = transactionsWeekly.map(item => parseFloat(item.total));

    // Monthly Transactions Data
    var transactionsMonthly = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_monthly_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var monthlyLabels = transactionsMonthly.map(item => item.month);
    var monthlyTotals = transactionsMonthly.map(item => parseFloat(item.total));

    // Transactions by Router Data
    var transactionsByRouter = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_by_router_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var routerLabels = transactionsByRouter.map(item => item.routers);
    var routerAmounts = transactionsByRouter.map(item => parseFloat(item.amount));

    // Average Transaction Value Data
    var averageTransactionValueDaily = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['average_transaction_value_daily_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var avgLabels = averageTransactionValueDaily.map(item => item.date);
    var avgData = averageTransactionValueDaily.map(item => parseFloat(item.average));

    // Revenue by Service Plan Data
    var transactionsByPlan = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_by_plan_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var planLabels = transactionsByPlan.map(item => item.plan_name);
    var planTotals = transactionsByPlan.map(item => parseFloat(item.total));

    // Transactions by Customer Data
    var transactionsByCustomer = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_by_customer_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var customerLabels = transactionsByCustomer.map(item => item.username);
    var customerTotals = transactionsByCustomer.map(item => parseFloat(item.total));

    // Peak Transaction Hours Data
    var transactionsByHour = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_by_hour_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var hourLabels = transactionsByHour.map(item => item.hour + ':00');
    var hourTotals = transactionsByHour.map(item => parseFloat(item.total));

    // Transactions by Payment Method Data
    var transactionsByPaymentMethod = JSON.parse('<?php echo strtr((string)$_smarty_tpl->tpl_vars['transactions_by_payment_method_json']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
    var paymentMethodLabels = transactionsByPaymentMethod.map(item => item.method_short);
    var paymentMethodTotals = transactionsByPaymentMethod.map(item => parseFloat(item.total));

    // New vs Returning Customers Data
    var newCustomers = <?php echo $_smarty_tpl->tpl_vars['new_customers']->value;?>
;
    var returningCustomers = <?php echo $_smarty_tpl->tpl_vars['returning_customers']->value;?>
;

    // Now, create the charts using Chart.js

    // Daily Transactions Chart
    new Chart(document.getElementById('dailyTransactionsChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: dailyTotals,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });

    // Weekly Transactions Chart
    new Chart(document.getElementById('weeklyTransactionsChart'), {
        type: 'bar',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: weeklyTotals,
                backgroundColor: '#1cc88a',
                hoverBackgroundColor: '#17a673',
                borderColor: '#1cc88a'
            }]
        },
        options: { responsive: true }
    });

    // Monthly Transactions Chart
    new Chart(document.getElementById('monthlyTransactionsChart'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: monthlyTotals,
                borderColor: '#36b9cc',
                backgroundColor: 'rgba(54, 185, 204, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });

    // Transactions by Router Chart
    new Chart(document.getElementById('transactionsByRouterChart'), {
        type: 'pie',
        data: {
            labels: routerLabels,
            datasets: [{
                data: routerAmounts,
                backgroundColor: ['#f6c23e', '#e74a3b', '#36b9cc', '#1cc88a', '#4e73df'],
                hoverBackgroundColor: ['#dda20a', '#be2617', '#25858e', '#13855c', '#2e59d9'],
                borderColor: '#fff'
            }]
        },
        options: { responsive: true }
    });

    // Average Transaction Value Chart
    new Chart(document.getElementById('averageTransactionValueChart'), {
        type: 'line',
        data: {
            labels: avgLabels,
            datasets: [{
                label: '<?php echo Lang::T('Average Transaction Value');?>
',
                data: avgData,
                borderColor: '#e74a3b',
                backgroundColor: 'rgba(231, 74, 59, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });

    // Revenue by Service Plan Chart
    new Chart(document.getElementById('transactionsByPlanChart'), {
        type: 'doughnut',
        data: {
            labels: planLabels,
            datasets: [{
                data: planTotals,
                backgroundColor: ['#858796', '#f6c23e', '#e74a3b', '#4e73df', '#1cc88a'],
                hoverBackgroundColor: ['#6c757d', '#dda20a', '#be2617', '#2e59d9', '#13855c'],
                borderColor: '#fff'
            }]
        },
        options: { responsive: true }
    });

    // Transactions by Customer Chart
    new Chart(document.getElementById('transactionsByCustomerChart'), {
        type: 'bar',
        data: {
            labels: customerLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: customerTotals,
                backgroundColor: '#4e73df',
                hoverBackgroundColor: '#2e59d9',
                borderColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y' // This makes the bar chart horizontal
        }
    });

    // Peak Transaction Hours Chart
    new Chart(document.getElementById('transactionsByHourChart'), {
        type: 'bar',
        data: {
            labels: hourLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: hourTotals,
                backgroundColor: '#1cc88a',
                hoverBackgroundColor: '#17a673',
                borderColor: '#1cc88a'
            }]
        },
        options: { responsive: true }
    });

    // Transactions by Payment Method Chart
    new Chart(document.getElementById('transactionsByPaymentMethodChart'), {
        type: 'bar',
        data: {
            labels: paymentMethodLabels,
            datasets: [{
                label: '<?php echo Lang::T('Total Amount');?>
',
                data: paymentMethodTotals,
                backgroundColor: '#f6c23e',
                hoverBackgroundColor: '#dda20a',
                borderColor: '#f6c23e'
            }]
        },
        options: { responsive: true }
    });

    // New vs Returning Customers Chart
    new Chart(document.getElementById('newVsReturningCustomersChart'), {
        type: 'pie',
        data: {
            labels: ['<?php echo Lang::T('New Customers');?>
', '<?php echo Lang::T('Returning Customers');?>
'],
            datasets: [{
                data: [parseInt(<?php echo $_smarty_tpl->tpl_vars['new_customers']->value;?>
), parseInt(<?php echo $_smarty_tpl->tpl_vars['returning_customers']->value;?>
)],
                backgroundColor: ['#4e73df', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                borderColor: '#fff'
            }]
        },
        options: { responsive: true }
    });
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
