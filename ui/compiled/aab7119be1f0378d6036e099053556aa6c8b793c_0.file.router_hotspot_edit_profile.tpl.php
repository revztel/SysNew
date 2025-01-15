<?php
/* Smarty version 4.3.1, created on 2024-09-19 01:07:11
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_hotspot_edit_profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb4f0f7ebda4_91542204',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aab7119be1f0378d6036e099053556aa6c8b793c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_hotspot_edit_profile.tpl',
      1 => 1726697221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb4f0f7ebda4_91542204 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Edit Hotspot Server Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Edit Hotspot Server Profile');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/edit-profile/<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['profile']->value['id']);?>
">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <input type="hidden" name="profile_id" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value['id'];?>
">
                    <div class="form-group">
                        <label for="name"><?php echo Lang::T('Profile Name');?>
</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value['name'];?>
" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dns_name"><?php echo Lang::T('DNS Name');?>
</label>
                        <input type="text" name="dns_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['profile']->value['dns_name'];?>
">
                    </div>
                    <div class="form-group">
                        <label><?php echo Lang::T('Login By');?>
</label>
                        <?php $_smarty_tpl->_assignInScope('selectedMethods', smarty_modifier_explode(',',$_smarty_tpl->tpl_vars['profile']->value['login_by']));?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['loginMethods']->value, 'method');
$_smarty_tpl->tpl_vars['method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['method']->value) {
$_smarty_tpl->tpl_vars['method']->do_else = false;
?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="login_by[]" value="<?php echo $_smarty_tpl->tpl_vars['method']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['method']->value,$_smarty_tpl->tpl_vars['selectedMethods']->value)) {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['method']->value;?>

                            </label>
                        </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update Profile');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
