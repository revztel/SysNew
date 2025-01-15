<?php
/* Smarty version 4.3.1, created on 2024-09-29 23:50:22
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66f9bd8e1d8fb4_48425264',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6e13d377ccf1da743640d487e7c3f39ea87eaff' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_history.tpl',
      1 => 1727643018,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66f9bd8e1d8fb4_48425264 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="panel-title"><?php echo Lang::T('Offline History for Router');?>
 <strong><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</strong></h3>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> <?php echo Lang::T('Back to Routers');?>

                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed">
                        <thead>
                            <tr class="info">
                                <th><?php echo Lang::T('Offline Timestamp');?>
</th>
                                <th><?php echo Lang::T('Online Timestamp');?>
</th>
                                <th><?php echo Lang::T('Duration');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['offlineEvents']->value) > 0) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offlineEvents']->value, 'event');
$_smarty_tpl->tpl_vars['event']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['event']->value) {
$_smarty_tpl->tpl_vars['event']->do_else = false;
?>
                                <tr>
                                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['event']->value['offline_timestamp'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['event']->value['online_timestamp'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['event']->value['formatted_duration'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted"><?php echo Lang::T('No offline events found');?>
</td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .panel {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
    .panel-heading {
        background-color: #31708f;
        color: #ffffff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        padding: 15px;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .table thead {
        background-color: #f0f8ff;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-primary {
        background-color: #31708f;
        border-color: #31708f;
    }
</style>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
