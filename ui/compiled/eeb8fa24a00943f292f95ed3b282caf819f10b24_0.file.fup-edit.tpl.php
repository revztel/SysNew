<?php
/* Smarty version 4.3.1, created on 2024-11-17 21:46:16
  from 'F:\xampp\htdocs\radius\ui\themes\nova\fup-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_673a39f8b65cf7_88378369',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eeb8fa24a00943f292f95ed3b282caf819f10b24' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\fup-edit.tpl',
      1 => 1731869173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_673a39f8b65cf7_88378369 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- FUP Profile Edit Form -->
<div class="row">
    <div class="col-md-12">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/edit-post">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit FUP Profile</h3>
                </div>
                <div class="panel-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
" required>
                    </div>
                    <!-- Data Limit -->
                    <div class="form-group">
                        <label for="data_limit">Data Limit *</label>
                        <input type="number" name="data_limit" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['data_limit'];?>
" required>
                    </div>
                    <!-- Data Limit Unit -->
                    <div class="form-group">
                        <label for="data_limit_unit">Data Limit Unit *</label>
                        <select name="data_limit_unit" class="form-control" required>
                            <option value="MB" <?php if ($_smarty_tpl->tpl_vars['d']->value['data_limit_unit'] == 'MB') {?>selected<?php }?>>MB</option>
                            <option value="GB" <?php if ($_smarty_tpl->tpl_vars['d']->value['data_limit_unit'] == 'GB') {?>selected<?php }?>>GB</option>
                            <option value="TB" <?php if ($_smarty_tpl->tpl_vars['d']->value['data_limit_unit'] == 'TB') {?>selected<?php }?>>TB</option>
                        </select>
                    </div>
                    <!-- Router -->
                    <div class="form-group">
                        <label for="router_id">Router *</label>
                        <select name="router_id" class="form-control" required>
                            <option value="">Select Router</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value['router_id'] == $_smarty_tpl->tpl_vars['router']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Service Type -->
                    <div class="form-group">
                        <label for="service_type">Service Type *</label>
                        <select name="service_type" class="form-control" required>
                            <option value="">Select Service Type</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_types']->value, 'type');
$_smarty_tpl->tpl_vars['type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value['service_type'] == $_smarty_tpl->tpl_vars['type']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Plan Under FUP -->
                    <div class="form-group">
                        <label for="selected_plan">Plan Under FUP *</label>
                        <select name="selected_plan" class="form-control" required>
                            <option value="">Select Plan</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allPlans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['plan']->value['id'] == $_smarty_tpl->tpl_vars['plans']->value[0]['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Plan After Limit -->
                    <div class="form-group">
                        <label for="profile_on_limit">Plan to Switch To *</label>
                        <select name="profile_on_limit" class="form-control" required>
                            <option value="">Select Plan</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allPlans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['plan']->value['id'] == $_smarty_tpl->tpl_vars['d']->value['profile_on_limit']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Active -->
                    <div class="form-group">
                        <label for="active">Active</label>
                        <input type="checkbox" name="active" value="1" <?php if ($_smarty_tpl->tpl_vars['d']->value['active'] == 1) {?>checked<?php }?>>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Update FUP Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
