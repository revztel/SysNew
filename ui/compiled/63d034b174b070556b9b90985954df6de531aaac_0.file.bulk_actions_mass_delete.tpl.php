<?php
/* Smarty version 4.3.1, created on 2024-10-13 21:55:59
  from 'F:\xampp\htdocs\radius\ui\themes\nova\bulk_actions_mass_delete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_670c17bfeb0ef0_14782116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63d034b174b070556b9b90985954df6de531aaac' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\bulk_actions_mass_delete.tpl',
      1 => 1728845757,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_670c17bfeb0ef0_14782116 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/mass_delete">
            <div class="panel panel-hovered mb20 panel-danger"> <!-- Kept 'panel-danger' for consistency in delete actions -->
                <div class="panel-heading"><?php echo Lang::T('Mass Delete Users');?>
</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="criteria"><?php echo Lang::T('Delete Users Based On');?>
</label>
                        <select name="criteria" id="criteria" class="form-control" required>
                            <option value="expired"><?php echo Lang::T('Expired Accounts');?>
</option>
                            <option value="inactive"><?php echo Lang::T('Inactive Accounts');?>
</option>
                            <!-- Add more criteria if needed -->
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
                    <button type="submit" class="btn btn-danger"><?php echo Lang::T('Delete Users');?>
</button> <!-- Kept 'btn-danger' for delete action -->
                </div>
            </div>
        </form>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
