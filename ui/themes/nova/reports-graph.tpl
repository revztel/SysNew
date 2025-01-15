{include file="sections/header.tpl"}

<!-- Transactions Graph -->
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>{Lang::T('Transactions Overview')}</h2>
            <p class="text-muted">{Lang::T('As of')} {$mdate} {Lang::T('at')} {$mtime}</p>
        </div>
    </div>

    <!-- Sales Comparisons Section -->
    <div class="row">
        <!-- Today vs Yesterday -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    {Lang::T('Today vs Yesterday')}
                </div>
                <div class="panel-body">
                    <h5>{Lang::T('Today')}: {Lang::moneyFormat($sales_today)}</h5>
                    <h5>{Lang::T('Yesterday')}: {Lang::moneyFormat($sales_yesterday)}</h5>
                    <h5>{Lang::T('Change')}:</h5>
                    <p>
                        {$today_vs_yesterday_percentage|number_format:2}% 
                        {if $today_vs_yesterday_percentage > 0}
                            <span class="badge badge-success">{Lang::T('Increase')}</span>
                        {elseif $today_vs_yesterday_percentage < 0}
                            <span class="badge badge-danger">{Lang::T('Decrease')}</span>
                        {else}
                            <span class="badge badge-secondary">{Lang::T('No Change')}</span>
                        {/if}
                    </p>
                </div>
            </div>
        </div>

        <!-- This Week vs Last Week -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    {Lang::T('This Week vs Last Week')}
                </div>
                <div class="panel-body">
                    <h5>{Lang::T('This Week')}: {Lang::moneyFormat($sales_this_week)}</h5>
                    <h5>{Lang::T('Last Week')}: {Lang::moneyFormat($sales_last_week)}</h5>
                    <h5>{Lang::T('Change')}:</h5>
                    <p>
                        {$this_week_vs_last_week_percentage|number_format:2}% 
                        {if $this_week_vs_last_week_percentage > 0}
                            <span class="badge badge-success">{Lang::T('Increase')}</span>
                        {elseif $this_week_vs_last_week_percentage < 0}
                            <span class="badge badge-danger">{Lang::T('Decrease')}</span>
                        {else}
                            <span class="badge badge-secondary">{Lang::T('No Change')}</span>
                        {/if}
                    </p>
                </div>
            </div>
        </div>

        <!-- This Month vs Last Month -->
        <div class="col-md-4 mb-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    {Lang::T('This Month vs Last Month')}
                </div>
                <div class="panel-body">
                    <h5>{Lang::T('This Month')}: {Lang::moneyFormat($sales_this_month)}</h5>
                    <h5>{Lang::T('Last Month')}: {Lang::moneyFormat($sales_last_month)}</h5>
                    <h5>{Lang::T('Change')}:</h5>
                    <p>
                        {$this_month_vs_last_month_percentage|number_format:2}% 
                        {if $this_month_vs_last_month_percentage > 0}
                            <span class="badge badge-success">{Lang::T('Increase')}</span>
                        {elseif $this_month_vs_last_month_percentage < 0}
                            <span class="badge badge-danger">{Lang::T('Decrease')}</span>
                        {else}
                            <span class="badge badge-secondary">{Lang::T('No Change')}</span>
                        {/if}
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
                    {Lang::T('Daily Transactions')}
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
                    {Lang::T('Weekly Transactions')}
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
                    {Lang::T('Monthly Transactions')}
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
                    {Lang::T('Transactions by Router (Current Month)')}
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
                    {Lang::T('Average Transaction Value (Daily)')}
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
                    {Lang::T('Revenue by Service Plan(Current Month)')}
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
                    {Lang::T('Top 10 Customers by Transactions')}
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
                    {Lang::T('Peak Transaction Hours')}
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
                    {Lang::T('Transactions by Payment Method (Current Month)')}
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
                    {Lang::T('New vs Returning Customers (Last 30 Days)')}
                </div>
                <div class="panel-body">
                    <canvas id="newVsReturningCustomersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JavaScript to Generate Charts -->
<script>
    // Parse the JSON data safely using JSON.parse and Smarty's escape:"javascript"

    // Daily Transactions Data
    var transactionsDaily = JSON.parse('{$transactions_daily_json|escape:"javascript"}');
    var dailyLabels = transactionsDaily.map(item => item.date);
    var dailyTotals = transactionsDaily.map(item => parseFloat(item.total));

    // Weekly Transactions Data
    var transactionsWeekly = JSON.parse('{$transactions_weekly_json|escape:"javascript"}');
    var weeklyLabels = transactionsWeekly.map(item => 'Week ' + item.week);
    var weeklyTotals = transactionsWeekly.map(item => parseFloat(item.total));

    // Monthly Transactions Data
    var transactionsMonthly = JSON.parse('{$transactions_monthly_json|escape:"javascript"}');
    var monthlyLabels = transactionsMonthly.map(item => item.month);
    var monthlyTotals = transactionsMonthly.map(item => parseFloat(item.total));

    // Transactions by Router Data
    var transactionsByRouter = JSON.parse('{$transactions_by_router_json|escape:"javascript"}');
    var routerLabels = transactionsByRouter.map(item => item.routers);
    var routerAmounts = transactionsByRouter.map(item => parseFloat(item.amount));

    // Average Transaction Value Data
    var averageTransactionValueDaily = JSON.parse('{$average_transaction_value_daily_json|escape:"javascript"}');
    var avgLabels = averageTransactionValueDaily.map(item => item.date);
    var avgData = averageTransactionValueDaily.map(item => parseFloat(item.average));

    // Revenue by Service Plan Data
    var transactionsByPlan = JSON.parse('{$transactions_by_plan_json|escape:"javascript"}');
    var planLabels = transactionsByPlan.map(item => item.plan_name);
    var planTotals = transactionsByPlan.map(item => parseFloat(item.total));

    // Transactions by Customer Data
    var transactionsByCustomer = JSON.parse('{$transactions_by_customer_json|escape:"javascript"}');
    var customerLabels = transactionsByCustomer.map(item => item.username);
    var customerTotals = transactionsByCustomer.map(item => parseFloat(item.total));

    // Peak Transaction Hours Data
    var transactionsByHour = JSON.parse('{$transactions_by_hour_json|escape:"javascript"}');
    var hourLabels = transactionsByHour.map(item => item.hour + ':00');
    var hourTotals = transactionsByHour.map(item => parseFloat(item.total));

    // Transactions by Payment Method Data
    var transactionsByPaymentMethod = JSON.parse('{$transactions_by_payment_method_json|escape:"javascript"}');
    var paymentMethodLabels = transactionsByPaymentMethod.map(item => item.method_short);
    var paymentMethodTotals = transactionsByPaymentMethod.map(item => parseFloat(item.total));

    // New vs Returning Customers Data
    var newCustomers = {$new_customers};
    var returningCustomers = {$returning_customers};

    // Now, create the charts using Chart.js

    // Daily Transactions Chart
    new Chart(document.getElementById('dailyTransactionsChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: '{Lang::T('Total Amount')}',
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
                label: '{Lang::T('Total Amount')}',
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
                label: '{Lang::T('Total Amount')}',
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
                label: '{Lang::T('Average Transaction Value')}',
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
                label: '{Lang::T('Total Amount')}',
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
                label: '{Lang::T('Total Amount')}',
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
                label: '{Lang::T('Total Amount')}',
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
            labels: ['{Lang::T('New Customers')}', '{Lang::T('Returning Customers')}'],
            datasets: [{
                data: [parseInt({$new_customers}), parseInt({$returning_customers})],
                backgroundColor: ['#4e73df', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                borderColor: '#fff'
            }]
        },
        options: { responsive: true }
    });
</script>

{include file="sections/footer.tpl"}
