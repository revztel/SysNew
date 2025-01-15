<?php
/* Smarty version 4.3.1, created on 2024-10-13 21:31:29
  from 'F:\xampp\htdocs\radius\system\plugin\ui\mikrotik_import.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_670c12010259f0_74477482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03b90b8b39559905b010a3414ec00afd28eeb8f6' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\mikrotik_import.tpl',
      1 => 1728844284,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_670c12010259f0_74477482 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
mikrotik_import_start_ui">
    <div class="panel panel-primary">
        <div class="panel-heading">Mikrotik Import</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="router_id">Select Router</label>
                <select name="router_id" id="router_id" class="form-control" required>
                    <option value="">Select Router</option>
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
            <div class="form-group">
                <label for="type">Select Service Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Select Service Type</option>
                    <option value="Hotspot">Hotspot</option>
                    <option value="PPPOE">PPPoE</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Start Import</button>
        </div>
    </div>
</form>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
