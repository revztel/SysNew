<?php
/* Smarty version 4.3.1, created on 2024-06-18 01:06:27
  from 'F:\xampp\htdocs\radius\ui\themes\nova\message_sms_group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6670b3639826a1_11016206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8696e69746c6ddd472704eead0b3f6a8cc9f18da' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\message_sms_group.tpl',
      1 => 1718661985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6670b3639826a1_11016206 (Smarty_Internal_Template $_smarty_tpl) {
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
                <span><?php echo Lang::T('Manage SMS Groups');?>
</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    <?php echo Lang::T('Need Help?');?>

                </button>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" id="createGroupForm" action="<?php echo U;?>
message/sms_groups_post">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Group Name');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="group_name" id="group_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit">
                                <?php echo Lang::T('Create Group');?>

                            </button>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="btn btn-default"><?php echo Lang::T('Cancel');?>
</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
            <div class="panel-heading">
                <span><?php echo Lang::T('Existing Groups');?>
</span>
            </div>
            <div class="panel-body">
                <table id="groupsTable" class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Group Name');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Send Group Message');?>
</span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" id="sendGroupMessageForm" action="<?php echo U;?>
message/send_group_message">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Group');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="group_id" id="group_id" required>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
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
                        <label class="col-md-2 control-label"><?php echo Lang::T('Message');?>
</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="message" name="message" placeholder="<?php echo Lang::T('Compose your message...');?>
" rows="5" required></textarea>
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
                            <button class="btn btn-success" type="submit">
                                <?php echo Lang::T('Send Message');?>

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
        $j('#groupsTable').DataTable();
    });
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
