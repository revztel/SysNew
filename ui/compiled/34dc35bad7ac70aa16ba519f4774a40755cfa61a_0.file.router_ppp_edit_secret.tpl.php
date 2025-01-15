<?php
/* Smarty version 4.3.1, created on 2024-09-18 23:42:33
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_ppp_edit_secret.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb3b398b75f7_46988373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34dc35bad7ac70aa16ba519f4774a40755cfa61a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_ppp_edit_secret.tpl',
      1 => 1726691954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb3b398b75f7_46988373 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Edit Secret -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Edit Secret');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/edit-secret/<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['secret']->value['id']);?>
">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <input type="hidden" name="secret_id" value="<?php echo $_smarty_tpl->tpl_vars['secret']->value['id'];?>
">
                    <div class="form-group">
                        <label for="name"><?php echo Lang::T('Name');?>
</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['secret']->value['name'];?>
" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><?php echo Lang::T('Password');?>
</label>
                        <input type="text" name="password" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['secret']->value['password'];?>
" required>
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
" <?php if ($_smarty_tpl->tpl_vars['profile']->value == $_smarty_tpl->tpl_vars['secret']->value['profile']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['profile']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service"><?php echo Lang::T('Service');?>
</label>
                        <select name="service" class="form-control">
                            <option value="any" <?php if ($_smarty_tpl->tpl_vars['secret']->value['service'] == 'any') {?>selected<?php }?>>Any</option>
                            <option value="pppoe" <?php if ($_smarty_tpl->tpl_vars['secret']->value['service'] == 'pppoe') {?>selected<?php }?>>PPPoE</option>
                            <option value="pptp" <?php if ($_smarty_tpl->tpl_vars['secret']->value['service'] == 'pptp') {?>selected<?php }?>>PPTP</option>
                            <!-- Add other services as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment"><?php echo Lang::T('Comment');?>
</label>
                        <input type="text" name="comment" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['secret']->value['comment'];?>
">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled" <?php if ($_smarty_tpl->tpl_vars['secret']->value['enabled']) {?>checked<?php }?>> <?php echo Lang::T('Enable Secret');?>

                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update Secret');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
