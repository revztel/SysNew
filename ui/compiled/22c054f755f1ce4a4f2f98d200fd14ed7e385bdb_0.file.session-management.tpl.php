<?php
/* Smarty version 4.3.1, created on 2024-09-30 13:22:46
  from 'F:\xampp\htdocs\radius\ui\themes\nova\session-management.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fa7bf6755410_23245765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22c054f755f1ce4a4f2f98d200fd14ed7e385bdb' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\session-management.tpl',
      1 => 1727691763,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66fa7bf6755410_23245765 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php echo Lang::T('Active Sessions');?>
</h2>
<table class="table table-bordered table-striped">
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
            <th><?php echo Lang::T('Actions');?>
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
                <a href="sessions.php?action=delete&session_id=<?php echo $_smarty_tpl->tpl_vars['session']->value['session_id'];?>
" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo Lang::T('Are you sure you want to log out this user?');?>
')">
                    <?php echo Lang::T('Log Out');?>

                </a>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<?php }
}
