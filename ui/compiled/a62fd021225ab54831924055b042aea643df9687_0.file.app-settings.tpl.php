<?php
/* Smarty version 4.3.1, created on 2025-01-09 20:53:35
  from 'F:\xampp\htdocs\radius\ui\themes\nova\app-settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67800d1f8deac9_92129637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a62fd021225ab54831924055b042aea643df9687' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\app-settings.tpl',
      1 => 1736445200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_67800d1f8deac9_92129637 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app-post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
<div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
    <span><?php echo Lang::T('General Settings');?>
</span>
    <div class="btn-group">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 10px;">
            <?php echo Lang::T('Need Help?');?>

        </button>
        <button class="btn btn-primary btn-xs" title="save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
</div>

                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Application Name/ Company Name');?>
</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control" id="CompanyName" name="CompanyName"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
">
                        </div>
                       <span class="help-block col-md-4"><?php echo Lang::T('This Name will be shown on the Title');?>
</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Company Logo');?>
</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <span class="help-block">For PDF Reports | Best size 1078 x 200 | uploaded image will be
                                autosize</span>
                        </div>
                        <span class="help-block col-md-4">
                            <a href="./<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
" target="_blank"><img src="./<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
" height="48" alt="logo for PDF"></a>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Company Footer');?>
</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control" id="CompanyFooter" name="CompanyFooter"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyFooter'];?>
">
                        </div>
                        <span class="help-block col-md-4"><?php echo Lang::T('Will show below user pages');?>
</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Address');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="address" name="address"
                                rows="3"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_c']->value['address']);?>
</textarea>
                        </div>
                       <span class="help-block col-md-4"><?php echo Lang::T('You can use html tag');?>
</span>
                    </div>
<div class="form-group">
    <label class="col-md-2 control-label"><?php echo Lang::T('Phone Number');?>
</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['phone'];?>
">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label"><?php echo Lang::T('Router / Payment Notification No');?>
</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="router_notifications" name="router_notifications" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['router_notifications'];?>
">
    </div>
</div>


                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Invoice Footer');?>
</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="api_key" name="api_key"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['api_key'];?>
" placeholder="Empty this to randomly created API key"
                                onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'">
                        </div>
                        <p class="col-md-4 help-block"><?php echo Lang::T('This Token will act as SuperAdmin/Admin');?>
</p>                        
                    </div>                    

                    <div class="form-group">
                        <label class="col-md-2 control-label">APP URL</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
">
                        </div>
                        <p class="help-block col-md-4">edit at config.php</p>
                    </div>
                </div>







                <div class="panel-heading" id="hide_dashboard_content">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    Hide Dashboard Content
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><input type="checkbox" name="hide_mrc" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_mrc'] == 'yes') {?>checked<?php }?>>
                            <?php echo Lang::T('Monthly Registered Customers');?>
</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_tms" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_tms'] == 'yes') {?>checked<?php }?>> <?php echo Lang::T('Total Monthly Sales');?>
</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_aui" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_aui'] == 'yes') {?>checked<?php }?>> <?php echo Lang::T('All Users Insights');?>
</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_al" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_al'] == 'yes') {?>checked<?php }?>> <?php echo Lang::T('Activity Log');?>
</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_uet" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_uet'] == 'yes') {?>checked<?php }?>> <?php echo Lang::T('User Expiring, Today');?>
</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_vs" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_vs'] == 'yes') {?>checked<?php }?>> Vouchers Stock</label>
                        <label class="col-md-2 control-label"><input type="checkbox" name="hide_pg" value="yes"
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['hide_pg'] == 'yes') {?>checked<?php }?>> Payment Gateway</label>
                    </div>
                </div>









                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    User Accounts
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Disable Voucher');?>
</label>
                        <div class="col-md-6">
                            <select name="disable_voucher" id="disable_voucher" class="form-control">
                                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] == 'no') {?>selected="selected" <?php }?>>No
                                </option>
                                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] == 'yes') {?>selected="selected" <?php }?>>Yes
                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><?php echo Lang::T('Voucher activation menu will be hidden');?>
</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Voucher Format');?>
</label>
                        <div class="col-md-6">
                            <select name="voucher_format" id="voucher_format" class="form-control">
                                <option value="up" <?php if ($_smarty_tpl->tpl_vars['_c']->value['voucher_format'] == 'up') {?>selected="selected" <?php }?>>UPPERCASE
                                </option>
                                <option value="low" <?php if ($_smarty_tpl->tpl_vars['_c']->value['voucher_format'] == 'low') {?>selected="selected" <?php }?>>
                                    lowercase
                                </option>
                                <option value="rand" <?php if ($_smarty_tpl->tpl_vars['_c']->value['voucher_format'] == 'rand') {?>selected="selected" <?php }?>>
                                    RaNdoM
                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4">UPPERCASE lowercase RaNdoM</p>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes') {?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('Disable Customer Portal');?>
</label>
                            <div class="col-md-6">
                                <select name="disable_registration" id="disable_registration" class="form-control">
                                    <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_registration'] == 'no') {?>selected="selected" <?php }?>>No
                                    </option>
                                    <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_registration'] == 'yes') {?>selected="selected" <?php }?>>
                                        Yes
                                    </option>
                                </select>
                            </div>
                            <p class="help-block col-md-4">
                                <?php echo Lang::T('Customer just Login with Phone number and Voucher Code, Voucher will be password');?>

                            </p>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Redirect after Activation</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="voucher_redirect" name="voucher_redirect"
                                    placeholder="https://192.168.88.1/status" value="<?php echo $_smarty_tpl->tpl_vars['voucher_redirect']->value;?>
">
                            </div>
                            <p class="help-block col-md-4">
                                <?php echo Lang::T('After Customer activate voucher or login, customer will be redirected to this url');?>

                            </p>
                        </div>
                    <?php }?>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">


                    
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    FreeRadius
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Enable Radius</label>
                        <div class="col-md-6">
                            <select name="radius_enable" id="radius_enable" class="form-control text-muted">
                                <option value="0">No</option>
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>selected="selected" <?php }?>>Yes</option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><a
                                href="https://freeispradius.com"
                                target="_blank">Radius Instructions</a></p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Radius Client</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="radius_client" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['radius_client'];?>
">
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Balance System');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Enable System');?>
</label>
                        <div class="col-md-6">
                            <select name="enable_balance" id="enable_balance" class="form-control">
                                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'no') {?>selected="selected" <?php }?>>No
                                </option>
                                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?>selected="selected" <?php }?>>Yes
                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><?php echo Lang::T('Customer can deposit money to buy voucher');?>
</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Allow Transfer');?>
</label>
                        <div class="col-md-6">
                            <select name="allow_balance_transfer" id="allow_balance_transfer" class="form-control">
                                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['allow_balance_transfer'] == 'no') {?>selected="selected" <?php }?>>
                                    No</option>
                                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['allow_balance_transfer'] == 'yes') {?>selected="selected"
                                    <?php }?>>Yes</option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><?php echo Lang::T('Allow balance transfer between customers');?>
</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Minimum Balance Transfer');?>
</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="minimum_transfer" name="minimum_transfer"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['minimum_transfer'];?>
">
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a class="btn btn-success btn-xs" style="color: black;" href="javascript:testTg()">Test TG</a>
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Telegram Notification');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Telegram Bot Token</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="telegram_bot" name="telegram_bot"
                                onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['telegram_bot'];?>
" placeholder="123456:asdasgdkuasghddlashdashldhalskdklasd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Telegram User/Channel/Group ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="telegram_target_id" name="telegram_target_id"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['telegram_target_id'];?>
" placeholder="12345678">
                        </div>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">You will get Payment and Error
                        notification</small>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                       <a class="btn btn-success btn-xs" style="color: black;" href="javascript:testSms()">Test SMS</a>
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('SMS OTP Registration');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">SMS Server URL</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="sms_url" name="sms_url" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['sms_url'];?>
"
                                placeholder="https://domain/?param_number=[number]&param_text=[text]&secret=">
                        </div>
                        <p class="help-block col-md-4">Must include <b>[text]</b> &amp; <b>[number]</b>, it will be
                            replaced.
                        </p>
                    </div>
                    <div class="form-group">
                       
<label class="col-md-2 control-label">Or use Mikrotik SMS</label>
<div class="col-md-6">
    <select class="form-control"
        onchange="document.getElementById('sms_url').value = this.value">
        <option value="">Select Router</option>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value, 'rs');
$_smarty_tpl->tpl_vars['rs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
" <?php if ($_smarty_tpl->tpl_vars['rs']->value['name'] == $_smarty_tpl->tpl_vars['_c']->value['sms_url']) {?>selected<?php }?>>
                <?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</option>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>
</div>
<p class="help-block col-md-4">Must include <b>[text]</b> &amp; <b>[number]</b>, it will be
    replaced.
</p>

 
                    <small id="emailHelp" class="form-text text-muted">You can use WhatsApp  here too. <a
                            href="https://sms.ispledger.com" target="_blank">Free Server</a></small>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                       <a class="btn btn-success btn-xs" style="color: black;" href="javascript:testWa()">Test WA</a>
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Whatsapp Notification');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Whatsapp Server URL</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="wa_url" name="wa_url" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['wa_url'];?>
"
                                placeholder="https://domain/?param_number=[number]&param_text=[text]&secret=">
                        </div>
                        <p class="help-block col-md-4">Must include <b>[text]</b> &amp; <b>[number]</b>, it will be
                            replaced.
                        </p>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">You can use WhatsApp in here too. <a
                            href="https://sms.ispledger.com" target="_blank">Free Server</a></small>
                </div>



                               <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a class="btn btn-success btn-xs" style="color: black;" href="javascript:testEmail()">Test
                            Email</a>
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Email Notification');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">SMTP Host : port</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="smtp_host" name="smtp_host"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['smtp_host'];?>
" placeholder="smtp.host.tld">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="smtp_port" name="smtp_port"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['smtp_port'];?>
" placeholder="465 587 port">
                        </div>
                        <p class="help-block col-md-4">Empty this to use internal mail() PHP</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">SMTP username</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="smtp_user" name="smtp_user"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['smtp_user'];?>
" placeholder="user@host.tld">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">SMTP Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="smtp_pass" name="smtp_pass"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['smtp_pass'];?>
" onmouseleave="this.type = 'password'"
                                onmouseenter="this.type = 'text'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">SMTP Security</label>
                        <div class="col-md-6">
                            <select name="smtp_ssltls" id="smtp_ssltls" class="form-control">
                                <option value="" <?php if ($_smarty_tpl->tpl_vars['_c']->value['smtp_ssltls'] == '') {?>selected="selected" <?php }?>>Not Secure
                                </option>
                                <option value="ssl" <?php if ($_smarty_tpl->tpl_vars['_c']->value['smtp_ssltls'] == 'ssl') {?>selected="selected" <?php }?>>SSL
                                </option>
                                <option value="tls" <?php if ($_smarty_tpl->tpl_vars['_c']->value['smtp_ssltls'] == 'tls') {?>selected="selected" <?php }?>>TLS
                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4">UPPERCASE lowercase RaNdoM</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mail From</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="mail_from" name="mail_from"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['mail_from'];?>
" placeholder="noreply@host.tld">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mail Reply To</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="mail_reply_to" name="mail_reply_to"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['mail_reply_to'];?>
" placeholder="support@host.tld">
                        </div>
                        <p class="help-block col-md-4">Customer will reply email to this address, empty if you want to
                            use From Address</p>
                    </div>
                </div>



<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('User Notification');?>

</div>
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Expired Notification');?>
</label>
        <div class="col-md-6">
            <select name="user_notification_expired" id="user_notification_expired" class="form-control">
                <option value="none" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'none') {?>selected="selected"<?php }?>>None</option>
                <option value="wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'wa') {?>selected="selected"<?php }?>>WhatsApp</option>
                <option value="sms" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'sms') {?>selected="selected"<?php }?>>SMS</option>
                <option value="email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'email') {?>selected="selected"<?php }?>>Email</option>
                <option value="both" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'both') {?>selected="selected"<?php }?>>WhatsApp and SMS</option>
                <option value="sms_email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'sms_email') {?>selected="selected"<?php }?>>SMS and Email</option>
                <option value="email_wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'email_wa') {?>selected="selected"<?php }?>>Email and WhatsApp</option>
                <option value="all" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_expired'] == 'all') {?>selected="selected"<?php }?>>All</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('User will get notification when package expired');?>
</p>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Payment Notification');?>
</label>
        <div class="col-md-6">
            <select name="user_notification_payment" id="user_notification_payment" class="form-control">
                <option value="none" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'none') {?>selected="selected"<?php }?>>None</option>
                <option value="wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'wa') {?>selected="selected"<?php }?>>WhatsApp</option>
                <option value="sms" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'sms') {?>selected="selected"<?php }?>>SMS</option>
                <option value="email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'email') {?>selected="selected"<?php }?>>Email</option>
                <option value="both" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'both') {?>selected="selected"<?php }?>>WhatsApp and SMS</option>
                <option value="sms_email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'sms_email') {?>selected="selected"<?php }?>>SMS and Email</option>
                <option value="email_wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'email_wa') {?>selected="selected"<?php }?>>Email and WhatsApp</option>
                <option value="all" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_payment'] == 'all') {?>selected="selected"<?php }?>>All</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('User will get invoice notification when buying a package or refilling a package');?>
</p>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Reminder Notification');?>
</label>
        <div class="col-md-6">
            <select name="user_notification_reminder" id="user_notification_reminder" class="form-control">
                <option value="none" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'none') {?>selected="selected"<?php }?>>None</option>
                <option value="wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'wa') {?>selected="selected"<?php }?>>WhatsApp</option>
                <option value="sms" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'sms') {?>selected="selected"<?php }?>>SMS</option>
                <option value="email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'email') {?>selected="selected"<?php }?>>Email</option>
                <option value="both" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'both') {?>selected="selected"<?php }?>>WhatsApp and SMS</option>
                <option value="sms_email" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'sms_email') {?>selected="selected"<?php }?>>SMS and Email</option>
                <option value="email_wa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'email_wa') {?>selected="selected"<?php }?>>Email and WhatsApp</option>
                <option value="all" <?php if ($_smarty_tpl->tpl_vars['_c']->value['user_notification_reminder'] == 'all') {?>selected="selected"<?php }?>>All</option>
            </select>
        </div>
    </div>
</div>


                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Tawk.to Chat Widget');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">https://tawk.to/chat/</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="tawkto" name="tawkto" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['tawkto'];?>
"
                                placeholder="62f1ca7037898912e961f5/1ga07df">
                        </div>
                        <p class="help-block col-md-4">From Direct Chat Link.</p>
                    </div>
                    <label class="col-md-2"></label>
                    <p class="col-md-6 help-block">/ip hotspot walled-garden<br>
                        add dst-host=tawk.to<br>
                        add dst-host=*.tawk.to</p>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    API Key
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Access Token</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="note" name="note"
                                rows="3"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_c']->value['note']);?>
</textarea>
                                                     <span class="help-block"><?php echo Lang::T('You can use html tag');?>
</span>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Proxy');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Proxy Server');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="http_proxy" name="http_proxy"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['http_proxy'];?>
" placeholder="127.0.0.1:3128">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Proxy Server Login');?>
</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="http_proxyauth" name="http_proxyauth"
                                autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['http_proxyauth'];?>
" placeholder="username:password"
                                onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'">
                        </div>
                    </div>
                </div>

<!-- New panel for Hashback API Key section -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
    </div>
    <?php echo Lang::T('Hashback API Key');?>

</div>
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Hashback API Key');?>
</label>
        <div class="col-md-6">
            <input type="text" name="hashback_api_key" id="hashback_api_key" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['_c']->value['hashback_api_key'], ENT_QUOTES, 'UTF-8', true);?>
">
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Enter your Hashback API Key here');?>
</p>
    </div>
</div>

<!-- New panel for Reset Password Email section -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('Reset Password Email');?>

</div>
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Reset Password Email');?>
</label>
        <div class="col-md-6">
            <input type="email" name="reset_password" id="reset_password" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['_c']->value['reset_password'], ENT_QUOTES, 'UTF-8', true);?>
">
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Enter the email to be used for resetting the password');?>
</p>
    </div>
</div>

<!-- New panel for Payment Notification setting -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('Payment Notification Setting');?>

</div>
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable Payment Notification');?>
</label>
        <div class="col-md-6">
            <select name="payment_notifications" id="payment_notifications" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['payment_notifications'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['payment_notifications'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Select whether to enable or disable payment notifications');?>
</p>
    </div>
</div>


<!-- New panel for 2FA Settings -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('2 Factor Authentication');?>

</div>
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable 2F Authentication');?>
</label>
        <div class="col-md-6">
            <select name="2fa" id="2fa" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['2fa'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['2fa'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Select whether to enable or disable 2 Factor Authentication');?>
</p>
    </div>
</div>



<!-- Panel for Hotspot Notifications -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('Hotspot Notifications');?>

</div>

<div class="panel-body">
    <!-- Enable Hotspot Notifications -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable Hotspot Notifications');?>
</label>
        <div class="col-md-6">
            <select name="hotspot_sms" id="hotspot_sms" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['hotspot_sms'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['hotspot_sms'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Select whether to enable or disable hotspot notifications.');?>
</p>
    </div>

    <!-- Enable Hotspot Data Reminder Notifications -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable Hotspot Data Reminder Notifications');?>
</label>
        <div class="col-md-6">
            <select name="data_reminder" id="data_reminder" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['data_reminder'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['data_reminder'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Enable this to send a reminder when data usage reaches 80% or the remaining data for limited packages is low.');?>
</p>
    </div>

    <!-- Enable Expiry Notification -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable Expiry Notifications Minutes Before Expiry');?>
</label>
        <div class="col-md-6">
            <select name="time_reminder" id="time_reminder" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['time_reminder'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['time_reminder'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Enable this to send notifications 10 minutes before the hotspot session expires.');?>
</p>
    </div>
</div>






<!-- Panel for PPPOE and Static Notifications -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('PPPOE and Static Expiry Notifications');?>

</div>

<div class="panel-body">
    <!-- Enable Hotspot Notifications -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable PPPoE Notification');?>
</label>
        <div class="col-md-6">
            <select name="pppoe_sms" id="pppoe_sms" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['pppoe_sms'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['pppoe_sms'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Select whether to enable or disable PPPoE notifications.');?>
</p>
    </div>

    <!-- Enable Static Expiry Notifcations -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Enable Static Notifications');?>
</label>
        <div class="col-md-6">
            <select name="static_sms" id="static_sms" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['static_sms'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['static_sms'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('Select whether to enable or disable Static notifications.');?>
</p>
    </div>


</div>




<!-- Midnight Expiry PPOE and Static Users -->
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button class="btn btn-primary btn-xs" title="Save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('Midnight Expiry PPOE and Static Users ');?>

</div>

<div class="panel-body">
    <!-- Enable Hotspot Notifications -->
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Expiry at Midnight');?>
</label>
        <div class="col-md-6">
            <select name="midnight_expiry" id="midnight_expiry" class="form-control">
                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['midnight_expiry'] == 'yes') {?>selected<?php }?>><?php echo Lang::T('Yes');?>
</option>
                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['midnight_expiry'] == 'no') {?>selected<?php }?>><?php echo Lang::T('No');?>
</option>
            </select>
        </div>
        <p class="help-block col-md-4"><?php echo Lang::T('If you enable pppoe and static users will be expiring at midnight on the expiry date');?>
</p>
    </div>


</div>





   <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary btn-xs" title="save" type="submit"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                    </div>
                    <?php echo Lang::T('Miscellaneous');?>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('OTP Required');?>
</label>
                        <div class="col-md-6">
                            <select name="allow_phone_otp" id="allow_phone_otp" class="form-control">
                                <option value="no" <?php if ($_smarty_tpl->tpl_vars['_c']->value['allow_phone_otp'] == 'no') {?>selected="selected" <?php }?>>
                                    No</option>
                                <option value="yes" <?php if ($_smarty_tpl->tpl_vars['_c']->value['allow_phone_otp'] == 'yes') {?>selected="selected" <?php }?>>Yes
                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><?php echo Lang::T('OTP is required when user want to change phone
                            number');?>
</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('OTP Method');?>
</label>
                        <div class="col-md-6">
                            <select name="phone_otp_type" id="phone_otp_type" class="form-control">
                                <option value="sms" <?php if ($_smarty_tpl->tpl_vars['_c']->value['phone_otp_type'] == 'sms') {?>selected="selected" <?php }?>>
                                    <?php echo Lang::T('SMS');?>

                                <option value="whatsapp" <?php if ($_smarty_tpl->tpl_vars['_c']->value['phone_otp_type'] == 'whatsapp') {?>selected="selected"
                                    <?php }?>> <?php echo Lang::T('WhatsApp');?>

                                <option value="both" <?php if ($_smarty_tpl->tpl_vars['_c']->value['phone_otp_type'] == 'both') {?>selected="selected" <?php }?>>
                                    <?php echo Lang::T('SMS and WhatsApp');?>

                                </option>
                            </select>
                        </div>
                        <p class="help-block col-md-4"><?php echo Lang::T('The method which OTP will be sent to user');?>
</p>
                    </div>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit"><?php echo Lang::T('Save
                        Changes');?>
</button>
                </div>
            </div>

            <pre>/ip hotspot walled-garden
add dst-host=<?php echo $_smarty_tpl->tpl_vars['_domain']->value;?>

add dst-host=*.<?php echo $_smarty_tpl->tpl_vars['_domain']->value;?>
</pre>

            <pre>
# Expired Cronjob Every 5 Minutes
*/5 * * * * cd <?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
 && <?php echo $_smarty_tpl->tpl_vars['php']->value;?>
 cron.php

# Expired Cronjob Every 1 Hour
0 * * * * cd <?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
 && <?php echo $_smarty_tpl->tpl_vars['php']->value;?>
 cron.php
</pre>
            <pre>
# Reminder Cronjob Every 7 AM
0 7 * * * cd <?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
 && <?php echo $_smarty_tpl->tpl_vars['php']->value;?>
 cron_reminder.php
</pre>
        </div>
    </div>
</form>

<?php echo '<script'; ?>
>
    function testWa() {
        var target = prompt("Phone number\nSave First before Test", "");
        if (target != null) {
            window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app&testWa='+target;
        }
    }
    function testSms() {
        var target = prompt("Phone number\nSave First before Test", "");
        if (target != null) {
            window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app&testSms='+target;
        }
    }
    function testTg() {
        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app&testTg=test';
    }

        function testEmail() {
        var target = prompt("Email\nSave First before Test", "");
        if (target != null) {
            window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app&testEmail=' + target;
        }
    }
<?php echo '</script'; ?>
>



<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/kWP_ca0VxCI?si=ixB8gXEILXdeCGV2" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
