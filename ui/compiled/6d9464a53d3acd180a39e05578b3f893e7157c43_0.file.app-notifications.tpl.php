<?php
/* Smarty version 4.3.1, created on 2025-01-09 23:02:17
  from 'F:\xampp\htdocs\radius\ui\themes\nova\app-notifications.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67802b499aaef7_62947645',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d9464a53d3acd180a39e05578b3f893e7157c43' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\app-notifications.tpl',
      1 => 1736452922,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_67802b499aaef7_62947645 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/notifications-post">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
<div class="panel-heading">
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 5px;">
            <?php echo Lang::T('Need Help?');?>

        </button>
        <button class="btn btn-primary btn-xs" title="save" type="submit">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
        </button>
    </div>
    <?php echo Lang::T('User Notification');?>

</div>

                <div class="panel-body">
 <!-- Existing "Expired Notification Message" -->
<div class="form-group">
    <label class="col-md-2 control-label"><?php echo Lang::T('PPPoE/Static Expired Notification');?>
</label>
    <div class="col-md-6">
        <textarea class="form-control" id="expired" name="expired"
            placeholder="Hello [[name]], your internet package [[package]] has expired"
            rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['expired'] != '') {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['expired']);
} else { ?>Hello [[name]], your internet package [[package]] has expired.<?php }?></textarea>
    </div>
    <p class="help-block col-md-4">
        <b>[[name]]</b> will be replaced with Customer Name.<br>
        <b>[[username]]</b> will be replaced with Username.<br>
        <b>[[package]]</b> will be replaced with Package name.<br>
        <b>[[price]]</b> will be replaced with Package price.<br>
    </p>
</div>

<!-- New "Hotspot Expiry Notification" -->
<div class="form-group">
    <label class="col-md-2 control-label">Hotspot Expiry Notification</label>
    <div class="col-md-6">
        <textarea class="form-control" id="hotspot_expiry" name="hotspot_expiry"
            placeholder="Hello [[name]], your *hotspot* package [[package]] has expired. To reconnect kindly click on sign in again."
            rows="3">
<?php if ($_smarty_tpl->tpl_vars['_json']->value['hotspot_expiry'] != '') {?>
   <?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['hotspot_expiry']);?>

<?php } else { ?>
   Hello [[name]], your *hotspot* package [[package]] has expired.
<?php }?>
</textarea>
    </div>
    <p class="help-block col-md-4">
        <b>[[name]]</b> will be replaced with Customer Name.<br>
        <b>[[username]]</b> will be replaced with Username.<br>
        <b>[[package]]</b> will be replaced with Package name.<br>
        <b>[[price]]</b> will be replaced with Package price.<br>
    </p>
</div>



                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Reminder 7 days');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="reminder_7_day" name="reminder_7_day"
                                rows="3"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['reminder_7_day']);?>
</textarea>
                        </div>
                        <p class="help-block col-md-4">
                             <b>[[name]]</b> will be replaced with Customer Name.
                                 <b>[[username]]</b> will be replaced with Username.<br>
                            <b>[[package]]</b> will be replaced with Package name.
                            <b>[[price]]</b> will be replaced with Package price.
                            <b>[[expired_date]]</b> will be replaced with Expiration date.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Reminder 3 days');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="reminder_3_day" name="reminder_3_day"
                                rows="3"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['reminder_3_day']);?>
</textarea>
                        </div>
                        <p class="help-block col-md-4">
                                                  <b>[[name]]</b> will be replaced with Customer Name.
                                                      <b>[[username]]</b> will be replaced with Username.<br>
                            <b>[[package]]</b> will be replaced with Package name.
                            <b>[[price]]</b> will be replaced with Package price.
                            <b>[[expired_date]]</b> will be replaced with Expiration date.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Reminder 1 day');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="reminder_1_day" name="reminder_1_day"
                                rows="3"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['reminder_1_day']);?>
</textarea>
                        </div>
                        <p class="help-block col-md-4">
                             <b>[[name]]</b> will be replaced with Customer Name.
                                 <b>[[username]]</b> will be replaced with Username.<br>
                            <b>[[package]]</b> will be replaced with Package name.
                            <b>[[price]]</b> will be replaced with Package price.
                            <b>[[expired_date]]</b> will be replaced with Expiration date.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Recharge /Activation Notification');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="invoice_paid" name="invoice_paid"
                                placeholder="Hello [[name]], your internet package [[package]] has expired"
                                rows="20"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['invoice_paid']);?>
</textarea>
                        </div>
                        <p class="col-md-4 help-block">
                            <b>[[company_name]]</b> Your Company Name at Settings.<br>
                            <b>[[address]]</b> Your Company Address at Settings.<br>
                            <b>[[phone]]</b> Your Company Phone at Settings.<br>
                            <b>[[invoice]]</b> invoice number.<br>
                            <b>[[date]]</b> Date invoice created.<br>
                            <b>[[payment_gateway]]</b> Payment gateway user paid from.<br>
                            <b>[[payment_channel]]</b> Payment channel user paid from.<br>
                            <b>[[type]]</b> is Hotspot/PPPOE.<br>
                            <b>[[plan_name]]</b> Internet Package.<br>
                            <b>[[plan_price]]</b> Internet Package Prices.<br>
                            <b>[[name]]</b> Receiver name.<br>
                            <b>[[user_name]]</b> Username internet.<br>
                            <b>[[user_password]]</b> User password.<br>
                            <b>[[expired_date]]</b> Expired datetime.<br>
                            <b>[[footer]]</b> Invoice Footer.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Balance Notification Payment');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="invoice_balance" name="invoice_balance"
                                placeholder="Hello [[name]], your internet package [[package]] has expired"
                                rows="20"><?php echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['invoice_balance']);?>
</textarea>
                        </div>
                        <p class="col-md-4 help-block">
                            <b>[[company_name]]</b> Your Company Name at Settings.<br>
                            <b>[[address]]</b> Your Company Address at Settings.<br>
                            <b>[[phone]]</b> Your Company Phone at Settings.<br>
                            <b>[[invoice]]</b> invoice number.<br>
                            <b>[[date]]</b> Date invoice created.<br>
                            <b>[[payment_gateway]]</b> Payment gateway user paid from.<br>
                            <b>[[payment_channel]]</b> Payment channel user paid from.<br>
                            <b>[[type]]</b> is Hotspot/PPPOE.<br>
                            <b>[[plan_name]]</b> Internet Package.<br>
                            <b>[[plan_price]]</b> Internet Package Prices.<br>
                            <b>[[name]]</b> Receiver name.<br>
                            <b>[[user_name]]</b> Username internet.<br>
                            <b>[[user_password]]</b> User password.<br>
                            <b>[[trx_date]]</b> Transaction datetime.<br>
                            <b>[[balance_before]]</b> Balance Before.<br>
                            <b>[[balance]]</b> Balance After.<br>
                            <b>[[footer]]</b> Invoice Footer.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Send Balance');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="balance_send" name="balance_send"
                                rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['balance_send']) {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['balance_send']);
} else {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_default']->value['balance_send']);
}?></textarea>
                        </div>
                        <p class="col-md-4 help-block">
                            <b>[[name]]</b> Receiver name.<br>
                            <b>[[balance]]</b> how much balance have been send.<br>
                            <b>[[current_balance]]</b> Current Balance.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Received Balance');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="balance_received" name="balance_received"
                                rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['balance_received']) {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['balance_received']);
} else {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_default']->value['balance_received']);
}?></textarea>
                        </div>
                        <p class="col-md-4 help-block">
                            <b>[[name]]</b> Sender name.<br>
                            <b>[[balance]]</b> how much balance have been received.<br>
                            <b>[[current_balance]]</b> Current Balance.
                        </p>
                    </div>
                </div>

<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Account Created SMS Template');?>
</label>
        <div class="col-md-6">
            <textarea class="form-control" id="account_created_sms" name="account_created_sms"
                rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['account_created_sms']) {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['account_created_sms']);
} else { ?>Hello [[name]], your account has been created.<?php }?></textarea>
        </div>
        <p class="col-md-4 help-block">
            <b>[[name]]</b> will be replaced with Customer Name.<br>
            <b>[[user_password]]</b> will be replaced with user password to customer portal.<br>
            <b>[[user_name]]</b> will be replaced with username to customer portal.
        </p>
    </div>
</div>


<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Payment Notification');?>
</label>
        <div class="col-md-6">
            <textarea class="form-control" id="payment_notification" name="payment_notification"
                rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['payment_notification']) {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['payment_notification']);
} else { ?>Hello, you have received a payment of [[amount]] from [[username]].<?php }?></textarea>
        </div>
        <p class="col-md-4 help-block">
            <b>[[username]]</b> will be replaced with the Customer's Username.<br>
            <b>[[amount]]</b> will be replaced with the payment amount.<br>
            <b>[[payment_method]]</b> will be replaced with the payment method used.<br>
            <b>[[transaction_id]]</b> will be replaced with the transaction ID.
        </p>
    </div>
</div>


<div class="panel-body">
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Unknown Payments For Till Users');?>
</label>
        <div class="col-md-6">
            <textarea class="form-control" id="custom_message" name="custom_message"
                rows="3"><?php if ($_smarty_tpl->tpl_vars['_json']->value['custom_message']) {
echo Lang::htmlspecialchars($_smarty_tpl->tpl_vars['_json']->value['custom_message']);
} else { ?> Dear [[phone]], we couldn't link your payment of [[amount]] to any account as the number wasn't used during registration. Please contact our support center to activate your account<?php }?></textarea>
        </div>
        <p class="col-md-4 help-block">
            <b>[[amount]]</b> will be replaced with the payment amount.<br>
            <b>[[phone]]</b> will be replaced with the decoded phone number.
        </p>
    </div>
</div>


                
 
                       
                    </div>
                </div>


            </div>





            <div class="panel-body">
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                </div>
            </div>
        </div>
    </div>
</form>

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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_Aiel13F7CM?si=SDZMUrQeDO5BbMJy" allowfullscreen></iframe>
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
