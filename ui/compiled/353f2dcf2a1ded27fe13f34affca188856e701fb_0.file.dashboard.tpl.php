<?php
/* Smarty version 4.3.1, created on 2024-12-20 20:40:48
  from 'F:\xampp\htdocs\radius\ui\themes\nova\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6765ac20e12b50_53948981',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '353f2dcf2a1ded27fe13f34affca188856e701fb' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\dashboard.tpl',
      1 => 1718740449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6765ac20e12b50_53948981 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h4><sup><?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
</sup>
                    <?php echo number_format($_smarty_tpl->tpl_vars['iday']->value,0,$_smarty_tpl->tpl_vars['_c']->value['dec_point'],$_smarty_tpl->tpl_vars['_c']->value['thousands_sep']);?>
</h4>
                <p><?php echo Lang::T('Income Today');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/by-date" class="small-box-footer"><?php echo Lang::T('View Reports');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h4><sup><?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
</sup>
                    <?php echo number_format($_smarty_tpl->tpl_vars['imonth']->value,0,$_smarty_tpl->tpl_vars['_c']->value['dec_point'],$_smarty_tpl->tpl_vars['_c']->value['thousands_sep']);?>
</h4>
                <p><?php echo Lang::T('Income This Month');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/by-period" class="small-box-footer"><?php echo Lang::T('View Reports');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
  <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['u_act']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['u_exp']->value;?>
</h4>
                <p><?php echo Lang::T('Active/Expired');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="index.php?_route=prepaid/list" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['c_all']->value;?>
</h4>
                <p><?php echo Lang::T('Total Users');?>
</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['hotspotUsers']->value;?>
</h4>
                <p><?php echo Lang::T('Hotspot Online Users');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-wifi"></i>
            </div>
            <a href="index.php?_route=prepaid/online_hotspot" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['pppoeUsers']->value;?>
</h4>
                <p><?php echo Lang::T('PPPoE Online Users');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-network"></i>
            </div>
            <a href="index.php?_route=prepaid/online_pppoe" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['staticUsers']->value;?>
</h4>
                <p><?php echo Lang::T('Static Online Users');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-wifi"></i>
            </div>
            <a href="index.php?_route=prepaid/online_static" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
            <div class="inner">
                <h4><?php echo $_smarty_tpl->tpl_vars['totalOnlineUsers']->value;?>
</h4>
                <p><?php echo Lang::T('Total Online Users');?>
</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-people"></i>
            </div>
            <a href="index.php?_route=prepaid/online_users" class="small-box-footer"><?php echo Lang::T('View All');?>
 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-7">
   <!-- solid sales graph -->
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_mrc'] != 'yes') {?>
        <div class="box box-solid ">
            <div class="box-header">
                <i class="fa fa-th"></i>

                <h3 class="box-title"><?php echo Lang::T('Monthly Registered Customers');?>
</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app#hide_dashboard_content" class="btn bg-teal btn-sm"><i
                            class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <canvas class="chart" id="chart" style="height: 250px;"></canvas>
            </div>
        </div>
    <?php }?>

    <!-- solid sales graph -->
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_tms'] != 'yes') {?>
        <div class="box box-solid ">
            <div class="box-header">
                <i class="fa fa-inbox"></i>

                <h3 class="box-title"><?php echo Lang::T('Total Monthly Sales');?>
</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app#hide_dashboard_content" class="btn bg-teal btn-sm"><i
                            class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <canvas class="chart" id="salesChart" style="height: 250px;"></canvas>
            </div>
                </div>
                   <?php }?> 
 <div class="data-usage">
  <div class="row">
    <div class="col-md-12">
      <!-- Section title goes here -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h4>Today's Data Usage</h4>
        </div>
        <div class="card-body d-flex flex-column">
          <div class="chart-container flex-grow-1">
            <canvas id="todayUsageChart"></canvas>
          </div>
          <div class="usage-info">
            <p><strong>Upload:</strong> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert_bytes' ][ 0 ], array( $_smarty_tpl->tpl_vars['todayUpload']->value ));?>
</p>
            <p><strong>Download:</strong> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert_bytes' ][ 0 ], array( $_smarty_tpl->tpl_vars['todayDownload']->value ));?>
</p>
            <p><strong>Total:</strong> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert_bytes' ][ 0 ], array( ($_smarty_tpl->tpl_vars['todayUpload']->value+$_smarty_tpl->tpl_vars['todayDownload']->value) ));?>
</p>
            <p><strong>Date:</strong> <?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4>Weekly Data Usage</h4>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="weeklyUsageChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .data-usage {
    padding: 20px;
  }
.section-title {
font-size: 24px;
font-weight: bold;
margin-bottom: 20px;
}
.card {
border-radius: 5px;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
margin-bottom: 20px;
height: 100%;
}
.card-header {
background-color: #f8f9fa;
border-bottom: 1px solid #dee2e6;
padding: 10px;
}
.card-header h4 {
margin: 0;
}
.card-body {
padding: 20px;
}
.chart-container {
margin-bottom: 20px;
}
.usage-info p {
margin-bottom: 5px;
}
</style>
 <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes' && $_smarty_tpl->tpl_vars['stocks']->value['unused'] > 0 || $_smarty_tpl->tpl_vars['stocks']->value['used'] > 0) {?>
        <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_vs'] != 'yes') {?>
            <div class="panel panel-primary mb20 panel-hovered project-stats table-responsive">
                <div class="panel-heading">Vouchers Stock</div>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Plan Name');?>
</th>
                                <th>unused</th>
                                <th>used</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'stok');
$_smarty_tpl->tpl_vars['stok']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['stok']->value) {
$_smarty_tpl->tpl_vars['stok']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['name_plan'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['unused'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['used'];?>
</td>
                                </tr>
                            </tbody>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <tr>
                            <td>Total</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['stocks']->value['unused'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['stocks']->value['used'];?>
</td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php }?>
    <?php }?>
 <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes' && $_smarty_tpl->tpl_vars['stocks']->value['unused'] > 0 || $_smarty_tpl->tpl_vars['stocks']->value['used'] > 0) {?>
        <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_vs'] != 'yes') {?>
            <div class="panel panel-primary mb20 panel-hovered project-stats table-responsive">
                <div class="panel-heading">Vouchers Stock</div>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Plan Name');?>
</th>
                                <th>unused</th>
                                <th>used</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'stok');
$_smarty_tpl->tpl_vars['stok']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['stok']->value) {
$_smarty_tpl->tpl_vars['stok']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['name_plan'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['unused'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['stok']->value['used'];?>
</td>
                                </tr>
                            </tbody>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <tr>
                            <td>Total</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['stocks']->value['unused'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['stocks']->value['used'];?>
</td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php }?>
    <?php }?>
    <div class="box box-solid">
    <div class="box-header">
        <i class="fa fa-line-chart"></i>
        <h3 class="box-title"><?php echo Lang::T('Customers Growth');?>
</h3>
        <!-- Add any additional header content or tools -->
    </div>
    <div class="box-body border-radius-none">
        <canvas class="chart" id="customersGrowthChart" style="height: 250px;"></canvas>
    </div>
</div>
<div class="row">
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-star"></i> Best Selling Packages Per Month</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bestSellingPackages']->value, 'package');
$_smarty_tpl->tpl_vars['package']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['package']->value) {
$_smarty_tpl->tpl_vars['package']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['package']->value['name_plan'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['currencyCode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['package']->value['formattedPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['package']->value['sales'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['currencyCode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['package']->value['formattedRevenue'];?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-wifi"></i> Transactions per Router</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Router</th>
                                <th>Transactions</th>
                                <th>Percentage</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
<tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['transactionsPerRouter']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['router']->value['router_name'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['router']->value['transactions'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['router']->value['percentage'];?>
%</td>
        <td><?php echo $_smarty_tpl->tpl_vars['currencyCode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['router']->value['formattedAmount'];?>
</td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_uet'] != 'yes') {?>
        <div class="panel panel-warning mb20 panel-hovered project-stats table-responsive">
                  <div class="panel-heading"><?php echo Lang::T('Users Expiring Today');?>
</div>
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                             <th><?php echo Lang::T('Username');?>
</th>
                             <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['expire']->value, 'expired');
$_smarty_tpl->tpl_vars['expired']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['expired']->value) {
$_smarty_tpl->tpl_vars['expired']->do_else = false;
?>
                            <tr>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/viewu/<?php echo $_smarty_tpl->tpl_vars['expired']->value['username'];?>
"><?php echo $_smarty_tpl->tpl_vars['expired']->value['username'];?>
</a></td>
                                <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['expired']->value['recharged_on'],$_smarty_tpl->tpl_vars['expired']->value['recharged_time']);?>

                                </td>
                                <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['expired']->value['expiration'],$_smarty_tpl->tpl_vars['expired']->value['time']);?>

                                </td>
                            </tr>
                        </tbody>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </div>
            &nbsp; <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

        </div>
    <?php }?>
</div>


<div class="col-md-5">
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_pg'] != 'yes') {?>
        <div class="panel panel-success panel-hovered mb20 activities">
            <div class="panel-heading"><?php echo Lang::T('Payment Gateway');?>
: <?php echo $_smarty_tpl->tpl_vars['_c']->value['payment_gateway'];?>
</div>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_aui'] != 'yes') {?>
        <div class="panel panel-info panel-hovered mb20 activities">
            <div class="panel-heading"><?php echo Lang::T('All Users Insights');?>
</div>
            <div class="panel-body">
                <canvas id="userRechargesChart"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Monthly Data Usage</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="monthlyUsageChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Last 5 Transactions</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>username</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastTransactions']->value, 'transaction');
$_smarty_tpl->tpl_vars['transaction']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['transaction']->value) {
$_smarty_tpl->tpl_vars['transaction']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['username'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['price'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['recharged_on'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users"></i> Users by Service Type</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Users</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['serviceTypes']->value, 'serviceType');
$_smarty_tpl->tpl_vars['serviceType']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['serviceType']->value) {
$_smarty_tpl->tpl_vars['serviceType']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['serviceType']->value['service_type'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['serviceType']->value['count'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['serviceType']->value['percentage'];?>
%</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-download"></i> Top 5 Daily Data Users</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['topDownloaders']->value, 'downloader');
$_smarty_tpl->tpl_vars['downloader']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['downloader']->value) {
$_smarty_tpl->tpl_vars['downloader']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['downloader']->value['username'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['downloader']->value['total_download'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_al'] != 'yes') {?>
<div class="row">
<div class="col-md-12">
<div class="panel panel-info panel-hovered mb20 activities">
<div class="panel-heading"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logs"><?php echo Lang::T('Activity Log');?>
</a></div>
<div class="panel-body">
<ul class="list-unstyled">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dlog']->value, 'dlogs');
$_smarty_tpl->tpl_vars['dlogs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dlogs']->value) {
$_smarty_tpl->tpl_vars['dlogs']->do_else = false;
?>
<li class="primary">
<span class="point"></span>
<span class="time small text-muted"><?php echo Lang::timeElapsed($_smarty_tpl->tpl_vars['dlogs']->value['date'],true);?>
</span>
<p><?php echo $_smarty_tpl->tpl_vars['dlogs']->value['description'];?>
</p>
</li>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
</div>
</div>
</div>
</div>
<?php }?>


























































<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
 document.addEventListener("DOMContentLoaded", function() {
    var monthlyRegistered = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['monthlyRegistered']->value);?>
');
    var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var labels = monthNames;

    // Calculate the cumulative values
    var cumulativeValues = [];
    var previousValue = 0;
    monthlyRegistered.forEach(function(item) {
        previousValue += item.count;
        cumulativeValues.push(previousValue);
    });
// Fill the remaining months with the last cumulative value
var lastValue = cumulativeValues[cumulativeValues.length - 1];
for (var i = cumulativeValues.length; i < monthNames.length; i++) {
    cumulativeValues.push(lastValue);
}
    var data = cumulativeValues;

    var ctx = document.getElementById('customersGrowthChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Customers Growth',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    });
});
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_mrc'] != 'yes') {?>
        
            document.addEventListener("DOMContentLoaded", function() {
                var counts = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['monthlyRegistered']->value);?>
');

                var monthNames = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];

                var labels = [];
                var data = [];

                for (var i = 1; i <= 12; i++) {
                    var month = counts.find(count => count.date === i);
                    labels.push(month ? monthNames[i - 1] : monthNames[i - 1].substring(0, 3));
                    data.push(month ? month.count : 0);
                }

                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Registered Members',
                            data: data,
                            backgroundColor: 'rgba(0, 0, 255, 0.5)',
                            borderColor: 'rgba(0, 0, 255, 0.7)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                }
                            }
                        }
                    }
                });
            });
        
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_tmc'] != 'yes') {?>
        
            document.addEventListener("DOMContentLoaded", function() {
                var monthlySales = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['monthlySales']->value);?>
');

                var monthNames = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];

                var labels = [];
                var data = [];

                for (var i = 1; i <= 12; i++) {
                    var month = findMonthData(monthlySales, i);
                    labels.push(month ? monthNames[i - 1] : monthNames[i - 1].substring(0, 3));
                    data.push(month ? month.totalSales : 0);
                }

                var ctx = document.getElementById('salesChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Monthly Sales',
                            data: data,
                            backgroundColor: 'rgba(2, 10, 242)', // Customize the background color
                            borderColor: 'rgba(255, 99, 132, 1)', // Customize the border color
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                }
                            }
                        }
                    }
                });
            });

            function findMonthData(monthlySales, month) {
                for (var i = 0; i < monthlySales.length; i++) {
                    if (monthlySales[i].month === month) {
                        return monthlySales[i];
                    }
                }
                return null;
            }
        
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_aui'] != 'yes') {?>
        
            document.addEventListener("DOMContentLoaded", function() {
                // Get the data from PHP and assign it to JavaScript variables
                var u_act = '<?php echo $_smarty_tpl->tpl_vars['u_act']->value;?>
';
                var c_all = '<?php echo $_smarty_tpl->tpl_vars['c_all']->value;?>
';
                var u_all = '<?php echo $_smarty_tpl->tpl_vars['u_all']->value;?>
';
                //lets calculate the inactive users as reported
                var expired = u_all - u_act;
                var inactive = c_all - u_all;
                // Create the chart data
                var data = {
                    labels: ['Active Users', 'Expired Users', 'Inactive Users'],
                    datasets: [{
                        label: 'User Recharges',
                        data: [parseInt(u_act), parseInt(expired), parseInt(inactive)],
                        backgroundColor: ['rgba(4, 191, 13)', 'rgba(191, 35, 4)', 'rgba(0, 0, 255, 0.5'],
                        borderColor: ['rgba(0, 255, 0, 1)', 'rgba(255, 99, 132, 1)', 'rgba(0, 0, 255, 0.7'],
                        borderWidth: 1
                    }]
                };

                // Create chart options
                var options = {
                    responsive: true,
                    aspectRatio: 1,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 15
                            }
                        }
                    }
                };

                // Get the canvas element and create the chart
                var ctx = document.getElementById('userRechargesChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: options
                });
            });
        
    <?php }
echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    window.addEventListener('DOMContentLoaded', function() {
        $.getJSON("./version.json?" + Math.random(), function(data) {
            var localVersion = data.version;
            $('#version').html('Version: ' + localVersion);
            $.getJSON(
                "https://raw.githubuserc/master/version.json?" +
                Math
                .random(),
                function(data) {
                    var latestVersion = data.version;
                    if (localVersion !== latestVersion) {
                        $('#version').html('Latest Version: ' + latestVersion);
                    }
                });
        });

    });
<?php echo '</script'; ?>
>
























<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    // Today's Usage Chart
    var todayUsageCtx = document.getElementById('todayUsageChart').getContext('2d');
    var todayUsageChart = new Chart(todayUsageCtx, {
        type: 'doughnut',
        data: {
            labels: ['Upload', 'Download'],
            datasets: [{
                data: [<?php echo $_smarty_tpl->tpl_vars['todayUpload']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['todayDownload']->value;?>
],
                backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
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
            },
            cutout: '50%',
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Weekly Usage Chart
    var weeklyUsageCtx = document.getElementById('weeklyUsageChart').getContext('2d');
    var weeklyUsageChart = new Chart(weeklyUsageCtx, {
        type: 'bar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Upload',
                data: [
                    <?php echo $_smarty_tpl->tpl_vars['mondayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['tuesdayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['wednesdayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['thursdayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['fridayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['saturdayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['sundayUpload']->value;?>

                ],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Download',
                data: [
                    <?php echo $_smarty_tpl->tpl_vars['mondayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['tuesdayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['wednesdayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['thursdayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['fridayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['saturdayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['sundayDownload']->value;?>

                ],
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
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
                    text: 'Weekly Data Usage'
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    ticks: {
                        callback: function(value) {
                            return formatBytes(value);
                        }
                    }
                }
            },
            tooltips: {
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
    });

    // Monthly Usage Chart
    var monthlyUsageCtx = document.getElementById('monthlyUsageChart').getContext('2d');
    var monthlyUsageChart = new Chart(monthlyUsageCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Upload',
                data: [
                    <?php echo $_smarty_tpl->tpl_vars['januaryUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['februaryUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['marchUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['aprilUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['mayUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['juneUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['julyUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['augustUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['septemberUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['octoberUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['novemberUpload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['decemberUpload']->value;?>

                ],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Download',
                data: [
                    <?php echo $_smarty_tpl->tpl_vars['januaryDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['februaryDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['marchDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['aprilDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['mayDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['juneDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['julyDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['augustDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['septemberDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['octoberDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['novemberDownload']->value;?>
,
                    <?php echo $_smarty_tpl->tpl_vars['decemberDownload']->value;?>

                ],
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
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
                    text: 'Monthly Data Usage'
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    ticks: {
                        callback: function(value) {
                            return formatBytes(value);
                        }
                    }
                }
            },
            tooltips: {
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
    });

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

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
