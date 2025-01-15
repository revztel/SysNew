<?php
/* Smarty version 4.3.1, created on 2025-01-08 19:01:03
  from 'F:\xampp\htdocs\radius\ui\themes\nova\autoload-pool.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677ea13f0127e1_82357407',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c14db5b0478c1ed70888d34f60cd98514d71b32' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\autoload-pool.tpl',
      1 => 1710882219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677ea13f0127e1_82357407 (Smarty_Internal_Template $_smarty_tpl) {
?><option value=''><?php echo Lang::T('Select Pool');?>
</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['ds']->value['pool_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['ds']->value['pool_name'];
if ($_smarty_tpl->tpl_vars['routers']->value == '') {?> - <?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];
}?></option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
