<?php
/* Smarty version 4.3.1, created on 2025-01-08 11:48:59
  from 'F:\xampp\htdocs\radius\ui\themes\nova\prepaid-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677e3bfb804826_38233016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e4702fbf3ceb75136994f693bfc24e0f0921cc2' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\prepaid-edit.tpl',
      1 => 1711569771,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677e3bfb804826_38233016 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Plan</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/edit-post">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Select Account');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-2 control-label"><?php echo Lang::T('Service Plan');?>
</label>
                        <div class="col-md-6">
                            <select id="id_plan" name="id_plan" class="form-control select2">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['p']->value, 'ps');
$_smarty_tpl->tpl_vars['ps']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ps']->value) {
$_smarty_tpl->tpl_vars['ps']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ps']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value['plan_id'] == $_smarty_tpl->tpl_vars['ps']->value['id']) {?> selected <?php }?>>
                                    <?php if ($_smarty_tpl->tpl_vars['ps']->value['is_radius'] == '1') {?>Radius<?php } else {
echo $_smarty_tpl->tpl_vars['ps']->value['routers'];
}?> - <?php echo $_smarty_tpl->tpl_vars['ps']->value['name_plan'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                     <label class="col-md-2 control-label"><?php echo Lang::T('Created On');?>
</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="expiration" readonly
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['recharged_on'];?>
">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="00:00:00" readonly
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['recharged_time'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Expires On');?>
</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="expiration" name="expiration"
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['expiration'];?>
">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="time" name="time" placeholder="00:00:00"
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['time'];?>
">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success"
                                                             type="submit"><?php echo Lang::T('Edit');?>
</button>
                            Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list"><?php echo Lang::T('Cancel');?>
</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
