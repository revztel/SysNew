<?php
/* Smarty version 4.3.1, created on 2024-09-30 14:00:36
  from 'F:\xampp\htdocs\radius\ui\themes\nova\sessions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fa84d49c2930_34965542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae5095aaf4b9175a6528e9e54672cc3a5146e38d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\sessions.tpl',
      1 => 1727693970,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66fa84d49c2930_34965542 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Active Sessions');?>
</span>
                <div class="btn-group">
                    <!-- Refresh Button -->
                    <a href="<?php echo U;?>
sessions/list" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> <?php echo Lang::T('Refresh');?>

                    </a>
                </div>
            </div>

            <div class="panel-body">
                <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['sessions']->value) > 0) {?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('Session ID');?>
</th>
                                    <th><?php echo Lang::T('User ID');?>
</th>
                                    <th><?php echo Lang::T('Username');?>
</th>
                                    <th><?php echo Lang::T('Last Activity');?>
</th>
                                    <th><?php echo Lang::T('IP Address');?>
</th>
                                    <th><?php echo Lang::T('Manage');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sessions']->value, 'session');
$_smarty_tpl->tpl_vars['session']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['session']->value) {
$_smarty_tpl->tpl_vars['session']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['session']->value['session_id'] == $_smarty_tpl->tpl_vars['current_session_id']->value) {?>
                                        <tr class="info">
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['session_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['user_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['username'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['last_activity'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['ip_address'];?>
</td>
                                            <td>
                                                <span class="label label-success"><?php echo Lang::T('Current Device');?>
</span>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['session_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['user_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['username'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['last_activity'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['session']->value['ip_address'];?>
</td>
                                            <td>
                                                <a href="<?php echo U;?>
sessions/delete/<?php echo $_smarty_tpl->tpl_vars['session']->value['session_id'];?>
" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo Lang::T('Are you sure you want to log out this user?');?>
')">
                                                    <i class="glyphicon glyphicon-trash"></i> <?php echo Lang::T('Log Out');?>

                                                </a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p><?php echo Lang::T('No active sessions found.');?>
</p>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
