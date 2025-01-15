<?php
/* Smarty version 4.3.1, created on 2024-12-30 02:13:52
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\xendit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771d7b09bbd43_79120530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39b0ae6cf204bb97eabf21cc6a3fd01e73799be6' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\xendit.tpl',
      1 => 1735514027,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6771d7b09bbd43_79120530 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/xendit">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">XENDIT</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Secret Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="xendit_secret_key" name="xendit_secret_key" placeholder="xnd_" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['xendit_secret_key'];?>
">
                            <a href="https://dashboard.xendit.co/settings/developers#api-keys" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#api-keys</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Verification Token</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="xendit_verification_token" name="xendit_verification_token" placeholder="Your Verification Token" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['xendit_verification_token'];?>
">
                            <a href="https://dashboard.xendit.co/settings/developers#callbacks" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#callbacks</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Callback URL</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control" onclick="this.select()" value="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
callback/xendit">
                            <a href="https://dashboard.xendit.co/settings/developers#callbacks" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#callbacks</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Channels</label>
                        <div class="col-md-6">
                            <!-- Display available payment channels -->
                            <!-- Remove the hidden input causing issues -->
                            <!-- <input type="hidden" name="xendit_channel[]" value=""> -->

                            <!-- Checkbox for each payment channel -->
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CREDIT_CARD" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'CREDIT_CARD') !== false) {?>checked="true"<?php }?>> CREDIT CARD
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_BPI" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DD_BPI') !== false) {?>checked="true"<?php }?>> BPI
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_CHINABANK" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DD_CHINABANK') !== false) {?>checked="true"<?php }?>> Chinabank
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_RCBC" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DD_RCBC') !== false) {?>checked="true"<?php }?>> RCBC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_UBP" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DD_UBP') !== false) {?>checked="true"<?php }?>> UBP
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="GCASH" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'GCASH') !== false) {?>checked="true"<?php }?>> GCash
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="GRABPAY" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'GRABPAY') !== false) {?>checked="true"<?php }?>> GrabPay
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="PAYMAYA" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'PAYMAYA') !== false) {?>checked="true"<?php }?>> Maya
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="SHOPEEPAY" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'SHOPEEPAY') !== false) {?>checked="true"<?php }?>> ShopeePay
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="7ELEVEN" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'7ELEVEN') !== false) {?>checked="true"<?php }?>> 7-Eleven
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CEBUANA" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'CEBUANA') !== false) {?>checked="true"<?php }?>> Cebuana
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="LBC" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'LBC') !== false) {?>checked="true"<?php }?>> LBC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="BILLEASE" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'BILLEASE') !== false) {?>checked="true"<?php }?>> BillEase
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="QRPH" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'QRPH') !== false) {?>checked="true"<?php }?>> QRPH
                            </label>
                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_MLHUILLIER" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DP_MLHUILLIER') !== false) {?>checked="true"<?php }?>> DP_MLHUILLIER
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_PALAWAN" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DP_PALAWAN') !== false) {?>checked="true"<?php }?>> PALAWAN
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="EPAY" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'EPAY') !== false) {?>checked="true"<?php }?>> EPAY
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CASHALO" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'CASHALO') !== false) {?>checked="true"<?php }?>> CASHALO
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_ECPAY_SCHOOL" <?php if (strpos($_smarty_tpl->tpl_vars['_c']->value['xendit_channel'],'DP_ECPAY_SCHOOL') !== false) {?>checked="true"<?php }?>> ECPAY_School
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary waves-effect waves-light" type="submit"><?php echo Lang::T('Save');?>
</button>
                        </div>
                    </div>
                    <pre>/ip hotspot walled-garden
add dst-host=xendit.co
add dst-host=*.xendit.co</pre>
                    <small id="emailHelp" class="form-text text-muted">Set Telegram Bot to get any error and notification</small>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
