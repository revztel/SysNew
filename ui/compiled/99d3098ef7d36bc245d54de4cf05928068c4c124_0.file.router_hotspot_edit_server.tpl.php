<?php
/* Smarty version 4.3.1, created on 2024-09-19 01:02:09
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_hotspot_edit_server.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb4de16a4764_48543099',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '99d3098ef7d36bc245d54de4cf05928068c4c124' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_hotspot_edit_server.tpl',
      1 => 1726696831,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb4de16a4764_48543099 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Edit Hotspot Server -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Edit Hotspot Server');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/edit-server/<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['server']->value['id']);?>
">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <input type="hidden" name="server_id" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
">
                    <div class="form-group">
                        <label for="name"><?php echo Lang::T('Name');?>
</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['name'];?>
" required>
                    </div>
                    <div class="form-group">
                        <label for="address_pool"><?php echo Lang::T('Address Pool');?>
</label>
                        <input type="text" name="address_pool" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['address_pool'];?>
">
                    </div>
                    <div class="form-group">
                        <label for="profile"><?php echo Lang::T('Profile');?>
</label>
                        <select name="profile" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['profile']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['profile']->value == $_smarty_tpl->tpl_vars['server']->value['profile']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled" <?php if ($_smarty_tpl->tpl_vars['server']->value['disabled']) {?>checked<?php }?>> <?php echo Lang::T('Disable Server');?>

                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update Server');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
