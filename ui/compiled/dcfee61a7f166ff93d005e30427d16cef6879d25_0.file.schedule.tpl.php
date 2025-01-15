<?php
/* Smarty version 4.3.1, created on 2024-06-12 19:22:36
  from 'F:\xampp\htdocs\radius\ui\themes\nova\schedule.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6669cb4c41afa9_44260098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcfee61a7f166ff93d005e30427d16cef6879d25' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\schedule.tpl',
      1 => 1718209307,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6669cb4c41afa9_44260098 (Smarty_Internal_Template $_smarty_tpl) {
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
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Schedule Messages');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" id="scheduleMessageForm" action="">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Group');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="group" id="group">
                                <option value="all" selected><?php echo Lang::T('All Customers');?>
</option>
                                <option value="new"><?php echo Lang::T('New Customers');?>
</option>
                                <option value="expired"><?php echo Lang::T('Expired Customers');?>
</option>
                                <option value="active"><?php echo Lang::T('Active Customers');?>
</option>
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
                        <label class="col-md-2 control-label"><?php echo Lang::T('Schedule Time');?>
</label>
                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control" name="schedule_time" required>
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
                                <option value="30"><?php echo Lang::T('30 Messages');?>
</option>
                                <option value="40"><?php echo Lang::T('40 Messages');?>
</option>
                                <option value="50"><?php echo Lang::T('50 Messages');?>
</option>
                                <option value="60"><?php echo Lang::T('60 Messages');?>
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
                            <button class="btn btn-success" type="submit" name="send" value="now">
                                <?php echo Lang::T('Schedule Message');?>

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
    });
<?php echo '</script'; ?>
>
<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="
                    true">×</span>
</button>
</div>
<div class="modal-body">
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/M91aZf1wrEw?si=f3cxhNtD6wDbMBwz" allowfullscreen></iframe>
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
