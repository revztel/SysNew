<?php
/* Smarty version 4.3.1, created on 2024-09-19 18:06:43
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_ppp_add_pppoe_server.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66ec3e037024c0_58628964',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c45038de2abac4c8627c54fa842aeeaa9910581' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_ppp_add_pppoe_server.tpl',
      1 => 1726691875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66ec3e037024c0_58628964 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Add PPPoE Server -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Add PPPoE Server');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/add-pppoe-server/<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <div class="form-group">
                        <label for="service_name"><?php echo Lang::T('Service Name');?>
</label>
                        <input type="text" name="service_name" class="form-control" required>
                    </div>
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
                        <label for="max_mtu"><?php echo Lang::T('Max MTU');?>
</label>
                        <input type="number" name="max_mtu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="max_mru"><?php echo Lang::T('Max MRU');?>
</label>
                        <input type="number" name="max_mru" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled"> <?php echo Lang::T('Enable PPPoE Server');?>

                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Add PPPoE Server');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
