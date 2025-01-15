<?php
/* Smarty version 4.3.1, created on 2024-09-06 22:21:48
  from 'F:\xampp\htdocs\radius\ui\themes\nova\trial_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66db564c622426_96494495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fae6acdf1e365dcc14b8976c43a003aa96e4506c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\trial_edit.tpl',
      1 => 1725650504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66db564c622426_96494495 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Edit Hotspot Trial Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span><?php echo Lang::T('Edit Hotspot Trial');?>
</span>
            </div>
            <div class="panel-body">
                <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/edit-post" method="post" id="trial-edit-form">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['trial']->value['id'];?>
">
                    
                    <div class="form-group">
                        <label for="trial_name"><?php echo Lang::T('Trial Name');?>
</label>
                        <input type="text" name="trial_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['trial']->value['name'];?>
" placeholder="<?php echo Lang::T('Enter Trial Name');?>
" required>
                    </div>

                    <div class="form-group">
                        <label for="router_id"><?php echo Lang::T('Select Router');?>
</label>
                        <select name="router_id" id="router_id" class="form-control" required>
                            <option value=""><?php echo Lang::T('Select Router');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['router']->value['id'] == $_smarty_tpl->tpl_vars['trial']->value['router_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_id"><?php echo Lang::T('Select Plan');?>
</label>
                        <select name="plan_id" id="plan_id" class="form-control" required>
                            <option value=""><?php echo Lang::T('Select Plan');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotspotPlans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['plan']->value['id'] == $_smarty_tpl->tpl_vars['trial']->value['plan_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time_limit"><?php echo Lang::T('Trial Uptime Limit (Minutes)');?>
</label>
                        <input type="number" name="time_limit" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['trial']->value['time_limit'];?>
" placeholder="<?php echo Lang::T('Enter Trial Uptime Limit in Minutes');?>
" required>
                    </div>

                    <div class="form-group">
                        <label for="uptime_reset"><?php echo Lang::T('Trial Uptime Reset (Days)');?>
</label>
                        <input type="number" name="uptime_reset" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['trial']->value['uptime_reset'];?>
" placeholder="<?php echo Lang::T('Enter Trial Uptime Reset in Days');?>
" required>
                    </div>

                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update Trial');?>
</button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/list" class="btn btn-secondary"><?php echo Lang::T('Cancel');?>
</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
