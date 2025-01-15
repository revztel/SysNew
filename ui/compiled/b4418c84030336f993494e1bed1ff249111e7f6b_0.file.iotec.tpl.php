<?php
/* Smarty version 4.3.1, created on 2025-01-07 19:22:11
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\iotec.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677d54b3e13c67_59647857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4418c84030336f993494e1bed1ff249111e7f6b' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\iotec.tpl',
      1 => 1731571117,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677d54b3e13c67_59647857 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/iotec">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Iotec Uganda Payment Gateway</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_client_id" name="iotec_client_id"
                                value="<?php echo $_smarty_tpl->tpl_vars['iotec_client_id']->value;?>
">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Client ID.</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Secret</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_client_secret" name="iotec_client_secret"
                                value="<?php echo $_smarty_tpl->tpl_vars['iotec_client_secret']->value;?>
">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Client Secret.</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Wallet ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_wallet_id" name="iotec_wallet_id"
                                value="<?php echo $_smarty_tpl->tpl_vars['iotec_wallet_id']->value;?>
">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Wallet ID.</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
