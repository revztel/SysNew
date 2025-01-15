<?php
/* Smarty version 4.3.1, created on 2024-10-02 01:34:25
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers_forgot_password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fc78f1f32501_15656138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b88c09312a7c6ffee685cae45e5e58d546423006' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers_forgot_password.tpl',
      1 => 1727822026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66fc78f1f32501_15656138 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container">
    <h2>Forgot Password</h2>
    <?php if ((isset($_smarty_tpl->tpl_vars['_error']->value))) {?>
        <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['_error']->value;?>
</div>
    <?php }?>
    <form method="post" action="">
        <div class="form-group">
            <label for="master_password">Enter Master Password to Reset Your Password:</label>
            <input type="password" class="form-control" id="master_password" name="master_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
