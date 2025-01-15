<?php
/* Smarty version 4.3.1, created on 2024-07-27 02:10:15
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\kopokopo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a42cd7bca958_50211710',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25ae46a8a8fa963e38145ad08d32770c65e6fe62' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\kopokopo.tpl',
      1 => 1711568985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66a42cd7bca958_50211710 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/kopokopo" >
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Kopo Kopo Payment Gateway Settings</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client ID / Application Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kopokopo_app_key" name="kopokopo_app_key" placeholder="*************************" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['kopokopo_app_key'];?>
">
                            <small class="form-text text-muted">Production - Live: <a href="https://app.kopokopo.com/oauth/applications" target="_blank">https://app.kopokopo.com/oauth/applications</a></small><br>
                            <small class="form-text text-muted">Sandbox - Testing: <a href="https://sandbox.kopokopo.com/oauth/applications" target="_blank">https://sandbox.kopokopo.com/oauth/applications</a></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Secret / Application Secret</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="kopokopo_app_secret" name="kopokopo_app_secret" placeholder="**************************" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['kopokopo_app_secret'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Application API Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kopokopo_api_key" name="kopokopo_api_key" placeholder="******************************" maxlength="" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['kopokopo_api_key'];?>
">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-2 control-label">Till Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kopokopo_till_number" name="kopokopo_till_number" placeholder="K000000" maxlength="7" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['kopokopo_till_number'];?>
">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-2 control-label">Kopo Kopo Environment</label>
                        <div class="col-md-6">
                          <select class="form-control" name="kopokopo_env" id="kopokopo_env">
                            <option value="sandbox" <?php if ($_smarty_tpl->tpl_vars['_c']->value['kopokopo_env'] == 'sandbox') {?>selected<?php }?>>SandBox or Testing</option>
                            <option value="live" <?php if ($_smarty_tpl->tpl_vars['_c']->value['kopokopo_env'] == 'live') {?>selected<?php }?>>Live or Production</option>
                          </select>
                            <small class="form-text text-muted"><font color="red"><b>Sandbox</b></font> is for testing purpose, please switch to <font color="green"><b>Live</b></font> in production.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Url Notification</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control" onclick="this.select()" value="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
callback/kopokopo">
                            <p class="help-block">CallBack URL</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                        </div>
                    </div>
                        <pre>/ip hotspot walled-garden
                   add dst-host=kopokopo.com
                   add dst-host=*.kopokopo.com</pre>
                </div>
            </div>

        </div>
    </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
