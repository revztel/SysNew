<?php
/* Smarty version 4.3.1, created on 2025-01-08 18:00:38
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router-specific.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677e9316248d65_71907409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d1566b039478bf9159df93db7710ff2d893fcb2' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router-specific.tpl',
      1 => 1714258744,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677e9316248d65_71907409 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    .black-option, .select2-selection__choice, .select2-results__option {
        color: black !important;
    }
</style>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
            <div class="panel-heading">Send Messages to Specific Router</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/specific-post">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Router');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="router" id="router">
                                <option value=""><?php echo Lang::T('Select a router');?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value->name;?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Send Via');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="via" id="via">
                                <option value="sms" selected><?php echo Lang::T('SMS');?>
</option>
                                <option value="wa"><?php echo Lang::T('WhatsApp');?>
</option>
                                <option value="both"><?php echo Lang::T('SMS and WhatsApp');?>
</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Message per time');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="batch" id="batch">
                                <option value="5"><?php echo Lang::T('5 Messages');?>
</option>
                                <option value="10" selected><?php echo Lang::T('10 Messages');?>
</option>
                                <option value="15"><?php echo Lang::T('15 Messages');?>
</option>
                                <option value="20"><?php echo Lang::T('20 Messages');?>
</option>
                                <option value="20"><?php echo Lang::T('30 Messages');?>
</option>
                                <option value="20"><?php echo Lang::T('40 Messages');?>
</option>
                                <option value="20"><?php echo Lang::T('50 Messages');?>
</option>
                                <option value="20"><?php echo Lang::T('60 Messages');?>
</option>
                            </select><?php echo Lang::T('Use 20 and above if you are sending to all customers to avoid server time out');?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Delay');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="delay" id="delay">
                                <option value="0" selected><?php echo Lang::T('No Delay');?>
</option>
                                <option value="5"><?php echo Lang::T('5 Seconds');?>
</option>
                                <option value="10"><?php echo Lang::T('10 Seconds');?>
</option>
                                <option value="15"><?php echo Lang::T('15 Seconds');?>
</option>
                                <option value="20"><?php echo Lang::T('20 Seconds');?>
</option>
                            </select><?php echo Lang::T('Use at least 5 secs if you are sending to all customers to avoid being banned by your message provider');?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Message');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="message" name="message" placeholder="<?php echo Lang::T('Compose your message...');?>
" rows="5"></textarea>
                            <input name="test" type="checkbox"> <?php echo Lang::T('Testing [if checked no real message is sent]');?>

                        </div>
                        <p class="help-block col-md-4">
                            <?php echo Lang::T('Use placeholders:');?>
<br>
                            <b>[[name]]</b> - <?php echo Lang::T('Customer Name');?>
<br>
                            <b>[[user_name]]</b> - <?php echo Lang::T('Customer Username');?>
<br>
                            <b>[[phone]]</b> - <?php echo Lang::T('Customer Phone');?>
<br>
                            <b>[[company_name]]</b> - <?php echo Lang::T('Your Company Name');?>

                        </p>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit"><?php echo Lang::T('Send Message');?>
</button>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="btn btn-default"><?php echo Lang::T('Cancel');?>
</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['batchStatus']->value) {?>
<p>
    <span class="label label-success"><?php echo Lang::T('Total SMS Sent');?>
: <?php echo $_smarty_tpl->tpl_vars['totalSMSSent']->value;?>
</span>
    <span class="label label-danger"><?php echo Lang::T('Total SMS Failed');?>
: <?php echo $_smarty_tpl->tpl_vars['totalSMSFailed']->value;?>
</span>
    <span class="label label-success"><?php echo Lang::T('Total WhatsApp Sent');?>
: <?php echo $_smarty_tpl->tpl_vars['totalWhatsappSent']->value;?>
</span>
    <span class="label label-danger"><?php echo Lang::T('Total WhatsApp Failed');?>
: <?php echo $_smarty_tpl->tpl_vars['totalWhatsappFailed']->value;?>
</span>
</p>
<?php }?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Lang::T('Message Results');?>
</h3>
    </div>
    <div class="box-body">
        <table id="messageResultsTable" class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th><?php echo Lang::T('Name');?>
</th>
                    <th><?php echo Lang::T('Phone');?>
</th>
                    <th><?php echo Lang::T('Message');?>
</th>
                    <th><?php echo Lang::T('Status');?>
</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['batchStatus']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['phone'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['message'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['status'];?>
</td>
                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var $j = jQuery.noConflict();

    $j(document).ready(function () {
        $j('#messageResultsTable').DataTable();

        $j('#router').on('change', function() {
            var selectedRouterId = $j(this).val();
            if (selectedRouterId) {
                $j.ajax({
                    url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/get_users',
                    type: 'GET',
                    data: { router_id: selectedRouterId },
                    success: function(response) {
                        var users = JSON.parse(response);
                        var userSelect = $j('#users');
                        userSelect.empty();
                        $j.each(users, function(index, user) {
                            userSelect.append($j('<option>', {
                                value: user.id,
                                text: user.username
                            }));
                        });
                    },
                    error: function() {
                        console.log('Failed to retrieve users.');
                    }
                });
            } else {
                $j('#users').empty();
            }
        });
    });
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
