<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:51:19
  from 'F:\xampp\htdocs\radius\ui\themes\nova\customers-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c45764d593_19078234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1245f2a1a1f05c4e8d73c369504fb23f252ae4e1' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\customers-view.tpl',
      1 => 1724856039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:pagination.tpl' => 1,
  ),
),false)) {
function content_6771c45764d593_19078234 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle"
                    src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                    onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/user.default.jpg'" alt="avatar">

                <h3 class="profile-username text-center"><?php echo $_smarty_tpl->tpl_vars['d']->value['fullname'];?>
</h3>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Username');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Phone Number');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['phonenumber'];?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Email');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
</span>
                    </li>
                     <!-- Add the IP Address display here -->
                    <li class="list-group-item">
                        <b>IP Address</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['ip_address'];?>
</span>
                    </li>
                </ul>
                <p class="text-muted"><?php echo Lang::nl2br($_smarty_tpl->tpl_vars['d']->value['address']);?>
</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Password');?>
</b> <input type="password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['password'];?>
"
                            style=" border: 0px; text-align: right;" class="pull-right"
                            onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'"
                            onclick="this.select()">
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['d']->value['pppoe_password'] != '') {?>
                        <li class="list-group-item">
                            <b>PPPOE <?php echo Lang::T('Password');?>
</b> <input type="password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['pppoe_password'];?>
"
                                style=" border: 0px; text-align: right;" class="pull-right"
                                onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'"
                                onclick="this.select()">
                        </li>
                    <?php }?>
                    <!--Customers Attributes view start -->
                    <?php if ($_smarty_tpl->tpl_vars['customFields']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customFields']->value, 'customField');
$_smarty_tpl->tpl_vars['customField']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customField']->value) {
$_smarty_tpl->tpl_vars['customField']->do_else = false;
?>
                            <li class="list-group-item">
                                <b><?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
</b> <span class="pull-right">
                                    <?php if (strpos($_smarty_tpl->tpl_vars['customField']->value['field_value'],':0') === false) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['customField']->value['field_value'];?>

                                    <?php } else { ?>
                                        <b><?php echo Lang::T('Paid');?>
</b>
                                    <?php }?>
                                </span>

                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    <!--Customers Attributes view end -->
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Service Type');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['service_type']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Balance');?>
</b> <span class="pull-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['d']->value['balance']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Auto Renewal');?>
</b> <span class="pull-right">
                            <?php if ($_smarty_tpl->tpl_vars['d']->value['auto_renewal']) {?>yes<?php } else { ?>no<?php }?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Created On');?>
</b> <span class="pull-right"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['d']->value['created_at']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Last Login');?>
</b> <span class="pull-right"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['d']->value['last_login']);?>
</span>
                    </li>
<?php if ($_smarty_tpl->tpl_vars['d']->value['coordinates']) {?>
<li class="list-group-item">
    <b><?php echo Lang::T('Coordinates');?>
</b>
    <span class="pull-right">
        <i class="glyphicon glyphicon-road"></i>
        <a style="color: black;" href="https://www.google.com/maps/dir//<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
/" target="_blank">Get Directions</a>
    </span>
    <div style="height: 100px; overflow: hidden;">
        <div id="map" style="width: 100%; height: 100%;"></div>
    </div>
</li>
<?php }?>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/delete/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                           class="btn btn-danger btn-block btn-sm" onclick="return confirm('<?php echo Lang::T('Delete');?>
?')">
                           <span class="fa fa-trash"></span>
                        </a>
                    </div>
                    <div class="col-xs-8">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                           class="btn btn-warning btn-sm btn-block"><?php echo Lang::T('Edit');?>
</a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['package']->value) {?>
            <div class="box box-<?php if ($_smarty_tpl->tpl_vars['package']->value['status'] == 'on') {?>success<?php } else { ?>danger<?php }?>">
                <div class="box-body box-profile">
                    <h4 class="text-center"><?php echo $_smarty_tpl->tpl_vars['package']->value['type'];?>
 - <?php echo $_smarty_tpl->tpl_vars['package']->value['namebp'];?>
</h4>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <?php echo Lang::T('Active');?>
 <span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['package']->value['status'] == 'on') {?>yes<?php } else { ?>no<?php }?></span>
                        </li>
                        <li class="list-group-item">
                            <?php echo Lang::T('Created On');?>
 <span class="pull-right"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['package']->value['recharged_on'],$_smarty_tpl->tpl_vars['package']->value['recharged_time']);?>
</span>
                        </li>
                        <li class="list-group-item">
                            <?php echo Lang::T('Expires On');?>
 <span class="pull-right"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['package']->value['expiration'],$_smarty_tpl->tpl_vars['package']->value['time']);?>
</span>
                        </li>
                        <li class="list-group-item">
                            <?php echo $_smarty_tpl->tpl_vars['package']->value['routers'];?>
 <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['package']->value['method'];?>
</span>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/deactivate/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                                class="btn btn-danger btn-block btn-sm"
                                onclick="return confirm('This will deactivate Customer Plan, and make it expired')"><?php echo Lang::T('Deactivate');?>
</a>
                        </div>

                        <div class="col-xs-4">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/sync/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                                onclick="return confirm('This will sync Customer to Mikrotik?')"
                                class="btn btn-primary btn-sm btn-block"><?php echo Lang::T('Sync');?>
</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
           
        <?php }?>
        <div class="row">
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list" class="btn btn-primary btn-sm btn-block"><?php echo Lang::T('Back');?>
</a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/sync/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                    onclick="return confirm('This will sync Customer to Mikrotik?')"
                    class="btn btn-info btn-sm btn-block"><?php echo Lang::T('Sync');?>
</a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" class="btn btn-success btn-sm btn-block"><?php echo Lang::T('Send Message');?>
</a>
            </div>
        </div>
    </div>
    
    <div class="col-sm-8 col-md-8">
<ul class="nav nav-tabs">
    <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'order') {?>class="active" <?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/order">30 <?php echo Lang::T('Order History');?>
</a></li>
    <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'activation') {?>class="active" <?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/activation">30 <?php echo Lang::T('Activation History');?>
</a></li>
                    <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'traffic') {?>class="active" <?php }?>><a
                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/traffic"><?php echo Lang::T('Traffic Monitor');?>
</a></li>
                            <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'data-usage') {?>class="active" <?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/data-usage"><?php echo Lang::T('Data Usage');?>
</a></li>
</ul>
        </ul>
        <div class="table-responsive" style="background-color: white;">
            <table id="datatable" class="table table-bordered table-striped">













<?php if ($_smarty_tpl->tpl_vars['v']->value == 'data-usage') {?>
    <div class="data-usage">
        <h1>Data Usage for <?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Today's Data Usage</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($_smarty_tpl->tpl_vars['hasTodayUsage']->value) {?>
                            <div class="chart-container">
                                <canvas id="todayUsageChart"></canvas>
                            </div>
                            <div class="usage-info">
                                <p><strong>Upload:</strong> <?php echo smarty_modifier_convert_bytes($_smarty_tpl->tpl_vars['todayUsage']->value['upload']);?>
</p>
                                <p><strong>Download:</strong> <?php echo smarty_modifier_convert_bytes($_smarty_tpl->tpl_vars['todayUsage']->value['download']);?>
</p>
                                <p><strong>Total:</strong> <?php echo smarty_modifier_convert_bytes(($_smarty_tpl->tpl_vars['todayUsage']->value['upload']+$_smarty_tpl->tpl_vars['todayUsage']->value['download']));?>
</p>
                            </div>
                        <?php } else { ?>
                            <p class="text-center">No data usage found for today.</p>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Weekly Data Usage</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($_smarty_tpl->tpl_vars['hasWeeklyUsage']->value) {?>
                            <div class="chart-container">
                                <canvas id="weeklyUsageChart"></canvas>
                            </div>
                        <?php } else { ?>
                            <p class="text-center">No weekly data usage found.</p>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Monthly Data Usage</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($_smarty_tpl->tpl_vars['hasMonthlyUsage']->value) {?>
                            <div class="chart-container">
                                <canvas id="monthlyUsageChart"></canvas>
                            </div>
                        <?php } else { ?>
                            <p class="text-center">No monthly data usage found.</p>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        // Today's Usage Chart
        <?php if ($_smarty_tpl->tpl_vars['hasTodayUsage']->value) {?>
            var todayUsageCtx = document.getElementById('todayUsageChart').getContext('2d');
            var todayUsageChart = new Chart(todayUsageCtx, {
                type: 'pie',
                data: {
                    labels: ['Upload', 'Download'],
                    datasets: [{
                        data: [<?php echo $_smarty_tpl->tpl_vars['todayUsage']->value['upload'];?>
, <?php echo $_smarty_tpl->tpl_vars['todayUsage']->value['download'];?>
],
                        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Today\'s Data Usage'
                        }
                    }
                }
            });
        <?php }?>

        // Weekly Usage Chart
        <?php if ($_smarty_tpl->tpl_vars['hasWeeklyUsage']->value) {?>
            var weeklyUsageCtx = document.getElementById('weeklyUsageChart').getContext('2d');
            var weeklyUsageChart = new Chart(weeklyUsageCtx, {
                type: 'bar',
                data: {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    datasets: [{
                        label: 'Upload',
                        data: [
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['monday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['tuesday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['wednesday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['thursday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['friday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['saturday_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['sunday_upload'];?>

                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    }, {
                        label: 'Download',
                        data: [
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['monday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['tuesday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['wednesday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['thursday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['friday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['saturday_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['weeklyUsage']->value['sunday_download'];?>

                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatBytes(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += formatBytes(context.parsed.y);
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        <?php }?>

        // Monthly Usage Chart
        <?php if ($_smarty_tpl->tpl_vars['hasMonthlyUsage']->value) {?>
            var monthlyUsageCtx = document.getElementById('monthlyUsageChart').getContext('2d');
            var monthlyUsageChart = new Chart(monthlyUsageCtx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Upload',
                        data: [
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['january_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['february_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['march_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['april_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['may_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['june_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['july_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['august_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['september_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['october_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['november_upload'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['december_upload'];?>

                        ],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.1)',
                        fill: true
                    }, {
                        label: 'Download',
                        data: [
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['january_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['february_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['march_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['april_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['may_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['june_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['july_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['august_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['september_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['october_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['november_download'];?>
,
                            <?php echo $_smarty_tpl->tpl_vars['monthlyUsage']->value['december_download'];?>

                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatBytes(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += formatBytes(context.parsed.y);
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        <?php }?>

        // Format bytes to a readable format
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    <?php echo '</script'; ?>
>
<?php }?>























<?php if ($_smarty_tpl->tpl_vars['v']->value == 'traffic') {?>
<div class="tab-pane">
    <div class="box-body">
        <h4 class="text-center">Traffic Monitor</h4>
        <div class="chart">
            <canvas id="trafficFlow" width="800" height="400"></canvas>
        </div>
    </div>
</div>
<?php }?>


                <?php if (Lang::arrayCount($_smarty_tpl->tpl_vars['activation']->value)) {?>
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Invoice');?>
</th>
                            <th><?php echo Lang::T('Username');?>
</th>
                            <th><?php echo Lang::T('Plan Name');?>
</th>
                            <th><?php echo Lang::T('Plan Price');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                            <th><?php echo Lang::T('Method');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activation']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'" style="cursor:pointer;">
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['invoice'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                                <td class="text-success"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>

                                </td>
                                <td class="text-danger"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                <?php }?>
                <?php if (Lang::arrayCount($_smarty_tpl->tpl_vars['order']->value)) {?>
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Plan Name');?>
</th>
                            <th><?php echo Lang::T('Gateway');?>
</th>
                            <th><?php echo Lang::T('Routers');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Plan Price');?>
</th>
                            <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                            <th><?php echo Lang::T('Date Done');?>
</th>
                            <th><?php echo Lang::T('Method');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['gateway'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['payment_channel'];?>
</td>
                                <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                <td class="text-primary"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['created_date']);?>
</td>
                                <td class="text-danger"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expired_date']);?>
</td>
                                <td class="text-success"><?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] != 1) {
echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['paid_date']);
}?></td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 1) {
echo Lang::T('UNPAID');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 2) {
echo Lang::T('PAID');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 3) {
echo $_smarty_tpl->tpl_vars['_L']->value['FAILED'];?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 4) {
echo Lang::T('CANCELED');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 5) {
echo Lang::T('UNKNOWN');?>

                                    <?php }?></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['v']->value == 'traffic') {?>
                <div style="overflow-x:auto;" class="tab-pane">
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="trafficFlow" width="400" height="200"></canvas>
                        </div>
                    </div>
                  </div>
                <?php }?>
            </table>
        </div>
        <?php $_smarty_tpl->_subTemplateRender("file:pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['d']->value['coordinates']) {?>

<?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    function setupMap(lat, lon) {
        var map = L.map('map').setView([lat, lon], 17);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);
        var marker = L.marker([lat, lon]).addTo(map);
        
        // Disable zoom on scroll
        map.scrollWheelZoom.disable();
    }
    window.onload = function() {
        setupMap(<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
);
    }
<?php echo '</script'; ?>
>




<?php }?>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    // Global variables for the chart and data
    var chart;
    var chartData = {
        labels: [],
        txData: [],
        rxData: []
    };

    // Function to create and update the chart
    function createChart() {
        var ctx = document.getElementById('trafficFlow').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'TX',
                    data: chartData.txData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 0,
                    tension: 0.4,
                    fill: 'start' // Use 'start' to fill the area from the starting point
                }, {
                    label: 'RX',
                    data: chartData.rxData,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 0,
                    tension: 0.4,
                    fill: 'start' // Use 'start' to fill the area from the starting point
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Live Traffic'
                        },
                        ticks: {
                            callback: function (value) {
                                return formatBytes(value); // Format the tick values using formatBytes()
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                var value = context.parsed.y || 0;
                                return label + ': ' + formatBytes(value) + 'ps';
                            }
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 0, // Set the point radius to 0 to remove the dots
                        hoverRadius: 0 // Set the hover point radius to 0 to remove the dots
                    },
                    line: {
                        tension: 0 // Set the line tension to 0 to remove the curve
                    }
                }
            }
        });
    }

    function formatBytes(bytes) {
        if (bytes === 0) {
            return '0 B';
        }
        var k = 1024;
        var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        var formattedValue = parseFloat((bytes / Math.pow(k, i)).toFixed(2));
        return formattedValue + ' ' + sizes[i];
    }
    function updateTrafficValues() {
      // Get the username and router values
      var username = '<?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
'; // Replace with the actual username
      var router = '<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
'; // Replace with the actual router
  
      // Create the AJAX request
      $.ajax({
        url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/data_usage_monitor_traffic', // Replace with the actual PHP file path
        type: 'GET',
        dataType: 'json',
        data: {
          router: router,
          username: username
        },
        success: function(data) {
              var labels = data.labels;
              var txData = data.rows.tx;
              var rxData = data.rows.rx;
              if (txData.length > 0 && rxData.length > 0) {
                var TX = parseInt(txData[0]);
                var RX = parseInt(rxData[0]);
                // Update chart data
                chartData.labels.push(labels[0]);
                chartData.txData.push(TX);
                chartData.rxData.push(RX);
                // Limit the number of data points to display (e.g., show the last 10 entries)
                var maxDataPoints = 10;
                if (chartData.labels.length > maxDataPoints) {
                  chartData.labels.shift();
                  chartData.txData.shift();
                  chartData.rxData.shift();
                }
                // Update the chart with the new data
                chart.update();
                // Update the table values
                document.getElementById("tabletx").textContent = formatBytes(TX);
                document.getElementById("tablerx").textContent = formatBytes(RX);
              } else {
                document.getElementById("tabletx").textContent = "0";
                document.getElementById("tablerx").textContent = "0";
              }
            },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
          console.error("Error: " + errorThrown);
        }
      });
    }
   // Call createChart() to initialize the chart
   createChart();

// Example usage:
// updateTrafficValues();
// Update the traffic values every 1 seconds
setInterval(updateTrafficValues, 1000);
  
  <?php echo '</script'; ?>
>

<?php }
}
