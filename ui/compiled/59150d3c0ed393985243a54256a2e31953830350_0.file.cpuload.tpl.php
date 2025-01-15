<?php
/* Smarty version 4.3.1, created on 2024-06-14 19:31:19
  from 'F:\xampp\htdocs\radius\system\plugin\ui\cpuload.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_666c7057e2e0f1_11646493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59150d3c0ed393985243a54256a2e31953830350' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\cpuload.tpl',
      1 => 1718382669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_666c7057e2e0f1_11646493 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="container mt-4">
  <div class="col-sm-12 col-md-12">
    <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/cpuload_ui">
      <ul class="nav nav-tabs mb-4">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'r');
$_smarty_tpl->tpl_vars['r']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->do_else = false;
?>
        <li class="nav-item">
          <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['r']->value['id'] == $_smarty_tpl->tpl_vars['router']->value) {?>active<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/cpuload_ui/<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</a>
        </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    </form>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive" api-get-text="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/monitoring/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
"></div>
      </div>
    </div>
    <div class="card-header-bg-danger text-white card mt-4">
      <div class="card-header text-white"><i class="fas fa-bolt"> Performance</i></div>
<div class="card-body">
    <div class="mb-3">
        <label><i class="fas fa-microchip"></i> CPU Load</label>
        <div class="progress">
            <div id="cpu-load-bar" class="progress-bar bg-info" role="progressbar" style="width: 0%;">0%</div>
        </div>
    </div>
    <div class="mb-3">
        <label><i class="fas fa-thermometer-half"></i> Temperature</label>
        <div class="progress">
            <div id="temperature-bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%;">0°C</div>
        </div>
    </div>
    <div class="mb-3">
        <label><i class="fas fa-bolt"></i> Voltage</label>
        <div class="progress">
            <div id="voltage-bar" class="progress-bar bg-warning" role="progressbar" style="width: 0%;">0 V</div>
        </div>
    </div>
    <div class="mb-3">
        <label><i class="fas fa-clock"></i> Current Time</label>
        <div class="progress">
            <div id="current-time-bar" class="progress-bar bg-dark" role="progressbar" style="width: 100%;">0</div>
        </div>
    </div>
</div>

    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  $(document).ready(function() {
    function updateProgressBars() {
      $.ajax({
        url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/get_monitoring_data/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          $('#cpu-load-bar').css('width', data.cpu_load + '%').text(data.cpu_load + '%');
          $('#temperature-bar').css('width', data.temperature + '%').text(data.temperature + '°C');
          $('#voltage-bar').css('width', data.voltage + '%').text(data.voltage + ' V');
          $('#disk-usage-bar').css('width', data.write_sect_total_percentage + '%').text(data.write_sect_total_percentage + '%');
          $('#disk-usage-since-reboot-bar').css('width', data.write_sect_since_reboot_percentage + '%').text(data.write_sect_since_reboot_percentage + '%');
          $('#current-time-bar').text(data.current_time);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching monitoring data:', error);
          // Handle error case, if needed
        }
      });
    }

    updateProgressBars();
    setInterval(updateProgressBars, 1000); // Refresh every 1 second
  });
<?php echo '</script'; ?>
><?php }
}
