<?php
/* Smarty version 4.3.1, created on 2024-09-18 23:21:27
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_bridge_add_port.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb3647364eb9_71052672',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a68d0643a8ad2df86c97cf76b5d4c008d587fe2' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_bridge_add_port.tpl',
      1 => 1726690846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb3647364eb9_71052672 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Add Port to Bridge -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Add Port to Bridge');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/add-port">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <div class="form-group">
                        <label for="interface"><?php echo Lang::T('Interface');?>
</label>
                        <select name="interface" class="form-control" required>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['interfaces']->value, 'interface');
$_smarty_tpl->tpl_vars['interface']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['interface']->value) {
$_smarty_tpl->tpl_vars['interface']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['interface']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['interface']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bridge"><?php echo Lang::T('Bridge');?>
</label>
                        <select name="bridge" class="form-control" required>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bridges']->value, 'bridge');
$_smarty_tpl->tpl_vars['bridge']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bridge']->value) {
$_smarty_tpl->tpl_vars['bridge']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['bridge']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['bridge']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment"><?php echo Lang::T('Comment');?>
</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Add Port');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
