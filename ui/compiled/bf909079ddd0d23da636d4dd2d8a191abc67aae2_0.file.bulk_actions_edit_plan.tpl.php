<?php
/* Smarty version 4.3.1, created on 2024-10-13 21:54:10
  from 'F:\xampp\htdocs\radius\ui\themes\nova\bulk_actions_edit_plan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_670c17523d0041_05679019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf909079ddd0d23da636d4dd2d8a191abc67aae2' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\bulk_actions_edit_plan.tpl',
      1 => 1728845646,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_670c17523d0041_05679019 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/bulk_edit_plan">
            <div class="panel panel-hovered mb20 panel-primary"> <!-- Changed to 'panel-primary' for consistent styling -->
                <div class="panel-heading"><?php echo Lang::T('Bulk Edit Plans');?>
</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="current_plan_id"><?php echo Lang::T('Current Plan');?>
</label>
                        <select name="current_plan_id" id="current_plan_id" class="form-control">
                            <option value=""><?php echo Lang::T('All');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_plan_id"><?php echo Lang::T('New Plan');?>
</label>
                        <select name="new_plan_id" id="new_plan_id" class="form-control" required>
                            <option value=""><?php echo Lang::T('Select New Plan');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_type"><?php echo Lang::T('Service Type');?>
</label>
                        <select name="service_type" id="service_type" class="form-control">
                            <option value=""><?php echo Lang::T('All');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_types']->value, 'type');
$_smarty_tpl->tpl_vars['type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="router_id"><?php echo Lang::T('Router');?>
</label>
                        <select name="router_id" id="router_id" class="form-control">
                            <option value=""><?php echo Lang::T('All');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update Plans');?>
</button> <!-- Changed button color to 'primary' for consistency -->
                </div>
            </div>
        </form>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
