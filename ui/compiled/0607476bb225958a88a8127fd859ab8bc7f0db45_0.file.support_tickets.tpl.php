<?php
/* Smarty version 4.3.1, created on 2024-04-27 00:01:55
  from 'F:\xampp\htdocs\radius\system\plugin\ui\support_tickets.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_662c16436180a3_38403117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0607476bb225958a88a8127fd859ab8bc7f0db45' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\support_tickets.tpl',
      1 => 1714165313,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_662c16436180a3_38403117 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style>tr.unread-ticket {
  border: 1px solid red;
}</style>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js">
<?php echo '</script'; ?>
>
<section class="content-header">
  <h1>
    <div class="btn-group">
      <?php echo $_smarty_tpl->tpl_vars['buttonSettings']->value;?>

    </div>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard">
        </i> <?php echo Lang::T('Dashboard');?>
</a>
    </li>
    <li class="active"><?php echo Lang::T('Support Tickets');?>
</li>
  </ol>
</section>

<!-- support ticket settings modal start -->

<div class="modal fade" id="settings">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?php echo Lang::T('Support Tickets Settings');?>
</h4>
      </div>
      <div class="box-body">
        <div class="tab-pane">
          <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_settings" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label"><?php echo Lang::T('Enable In UCP');?>
:</label>

              <div class="col-sm-10">
                <select name="ucp" id="ucp" class="form-control">
                  <option value="enable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['ucp'];
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1 == 'enable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Enable');?>

                  <option value="disable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['ucp'];
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 == 'disable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Disable');?>

                  </option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label"><?php echo Lang::T('Notifications');?>
:</label>

              <div class="col-sm-10">
                <select name="notification" id="notification" class="form-control">
                  <option value="enable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['enable'];
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3 == 'enable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Enable');?>

                  <option value="disable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['enable'];
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 == 'disable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Disable');?>

                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label"><?php echo Lang::T('Notify Type');?>
:</label>

              <div class="col-sm-10">
                <select name="type" id="type" class="form-control">
                  <option value="sms" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['type'];
$_prefixVariable5 = ob_get_clean();
if ($_prefixVariable5 == 'sms') {?>selected="selected" <?php }?>> <?php echo Lang::T('SMS');?>

                  <option value="whatsapp" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['type'];
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6 == 'whatsapp') {?>selected="selected" <?php }?>> <?php echo Lang::T('WhatsApp');?>

                  <option value="both" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['type'];
$_prefixVariable7 = ob_get_clean();
if ($_prefixVariable7 == 'both') {?>selected="selected" <?php }?>> <?php echo Lang::T('SMS and WhatsApp');?>

                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"> <?php echo Lang::T('Notify Admin');?>
:</label>

              <div class="col-sm-10">
                <select name="admin" id="admin" class="form-control">
                  <option value="enable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['admin'];
$_prefixVariable8 = ob_get_clean();
if ($_prefixVariable8 == 'enable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Enable');?>

                  <option value="disable" <?php ob_start();
echo $_smarty_tpl->tpl_vars['settings']->value['admin'];
$_prefixVariable9 = ob_get_clean();
if ($_prefixVariable9 == 'disable') {?>selected="selected" <?php }?>> <?php echo Lang::T('Disable');?>

                  </option>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-telegram">
                  </i> <?php echo Lang::T('Save');?>
 </button>
              </div>
              <button type="button" data-dismiss="modal" class="btn btn-danger">
                <i class="">
                </i><?php echo Lang::T('Cancel');?>
</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- support ticket settings modal end -->



<div class="modal fade" id="create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"> <?php echo Lang::T('Create New Ticket');?>
</h4>
      </div>
      <div class="box-body">
        <div class="tab-pane">
          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" class="form-control" name="created_by" value="<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
">
            <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label"><?php echo Lang::T('Customer');?>
:</label>

              <div class="col-sm-10">
                <select <?php if ($_smarty_tpl->tpl_vars['customers']->value) {
} else { ?>id="personSelect" <?php }?> class="form-control select2" name="id_customer"
                  style="width: 100%" data-placeholder="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Select_Customer'];?>
..."> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
</option> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label"> <?php echo Lang::T('Subject');?>
:</label>

              <div class="col-sm-10">
                <input class="form-control" name="subject" placeholder="<?php echo Lang::T('Subject');?>
" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label"> <?php echo Lang::T('Message');?>
:</label>

              <div class="col-sm-10">
                <textarea name="message" class="form-control" placeholder="<?php echo Lang::T('Message');?>
" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"> <?php echo Lang::T('Priority');?>
:</label>

              <div class="col-sm-10">
                <select class="form-control" name="priority">
                  <option value="Low"><?php echo Lang::T('Low');?>
</option>
                  <option value="Medium"><?php echo Lang::T('Medium');?>
</option>
                  <option value="High"><?php echo Lang::T('High');?>
</option>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo Lang::T('Report');?>
:</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="report" value="internet" onclick="showSubcategories('internet')"> <?php echo Lang::T('Internet');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="change_speed" onclick="showSubcategories('change_speed')"> <?php echo Lang::T('Change Speed');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="landline" onclick="showSubcategories('landline')"> <?php echo Lang::T('Landline');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="iptv" onclick="showSubcategories('iptv')"> <?php echo Lang::T('IPTV');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="bills" onclick="showSubcategories('bills')"> <?php echo Lang::T('Bills');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="others" onclick="showSubcategories('others')"> <?php echo Lang::T('Others');?>

                </label>
              </div>
            </div>
            
            <div class="form-group" id="subcategorySection" style="display: none;">
              <label class="col-sm-2 control-label"><?php echo Lang::T('Issue');?>
:</label>
              <div class="col-sm-10">
                <select class="form-control" name="issue" id="subcategorySelect" required>
                  <option value=""><?php echo Lang::T('Select One');?>
</option>
                </select>
                <input type="text" class="form-control" name="custom" placeholder="<?php echo Lang::T('Please specify');?>
" id="customSubcategoryInput" style="display: none;">
              </div>
            </div> -->
            
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"><?php echo Lang::T('Department');?>
:</label>

              <div class="col-sm-10">
                <select class="form-control" name="department">
                  <option value="Sales Team"><?php echo Lang::T('Sales Team');?>
</option>
                  <option value="Technical Team"><?php echo Lang::T('Technical Team');?>
</option>
                  <option value="Support Team"><?php echo Lang::T('Support Team');?>
</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"> <?php echo Lang::T('Attachment');?>
:</label>
              <div class="col-sm-10">
                <input type="file" name="attachment">
                <span><?php echo Lang::T('File Max Size. 2MB');?>
</span>
              </div>
            </div>
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-telegram">
                  </i> <?php echo Lang::T('Create Ticket');?>
</button>
              </div>
              <button type="button" data-dismiss="modal" class="btn btn-danger">
                <i class="">
                </i> <?php echo Lang::T('Cancel');?>
</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-md-3">
          <button class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#create"> <?php echo Lang::T('Create
            Ticket');?>
</button> <br>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Lang::T('Support Tickets');?>
</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus">
                  </i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="">
                  <a href="#">
                    <i class="ion-email-unread">
                    </i><?php echo Lang::T('Unread Ticket');?>
 <span class="label label-danger pull-right"><?php echo $_smarty_tpl->tpl_vars['newTicketCount']->value;?>
</span>
                  </a>
                </li>
                <li class="">
                  <a href="#">
                    <i class="fa fa-envelope">
                    </i> <?php echo Lang::T('Open');?>
 <span class="label label-danger pull-right"><?php echo $_smarty_tpl->tpl_vars['openTicketCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-calendar">
                    </i> <?php echo Lang::T('In Progress');?>
 <span class="label label-primary pull-right"><?php echo $_smarty_tpl->tpl_vars['inProgressTicketCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-thumbs-up">
                    </i> <?php echo Lang::T('Resolved');?>
 <span class="label label-success pull-right"><?php echo $_smarty_tpl->tpl_vars['resolvedTicketCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-close">
                    </i> <?php echo Lang::T('Closed');?>
 <span class="label label-default pull-right"><?php echo $_smarty_tpl->tpl_vars['closedTicketCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-trash">
                    </i> <?php echo Lang::T('Trash');?>
<span class="label label-warning pull-right"><?php echo $_smarty_tpl->tpl_vars['trashTicketCount']->value;?>
</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Lang::T('Priority');?>
</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus">
                  </i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li>
                  <a href="#">
                    <i class="fa fa-circle-o text-red">
                    </i> <?php echo Lang::T('HIGH');?>
 <span class="label label-danger pull-right"><?php echo $_smarty_tpl->tpl_vars['highPriorityCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-circle-o text-yellow">
                    </i> <?php echo Lang::T('MEDIUM');?>
 <span class="label label-warning pull-right"><?php echo $_smarty_tpl->tpl_vars['mediumPriorityCount']->value;?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-circle-o text-light-blue">
                    </i> <?php echo Lang::T('LOW');?>
 <span class="label label-primary pull-right"><?php echo $_smarty_tpl->tpl_vars['lowPriorityCount']->value;?>
</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Lang::T('Tickets List');?>
</h3>
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <div class="form-group">
                    <input type="text" class="form-control input-sm" id="searchTickets" placeholder="<?php echo Lang::T('Search Tickets');?>
">
                  </div>
                  <span class="glyphicon glyphicon-search form-control-feedback">
                  </span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="fa fa-square-o">
                  </i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fa fa-trash-o">
                    </i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fa fa-reply">
                    </i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fa fa-share">
                    </i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fa fa-refresh">
                  </i>
                </button>
                <div class="pull-right"><?php echo Lang::T('Total Active Tickets');?>
: <b><?php echo $_smarty_tpl->tpl_vars['totalActiveTickets']->value;?>
</b> &nbsp; &nbsp; <?php if ($_smarty_tpl->tpl_vars['totalPages']->value > 1) {?> <?php if ($_smarty_tpl->tpl_vars['currentPage']->value > 1) {?> <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets&page=<?php echo $_smarty_tpl->tpl_vars['currentPage']->value-1;?>
"
                      class="btn btn-default btn-sm">
                      <i class="fa fa-chevron-left">
                      </i>
                    </a> <?php }?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, range(1,$_smarty_tpl->tpl_vars['totalPages']->value), 'pageNumber');
$_smarty_tpl->tpl_vars['pageNumber']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pageNumber']->value) {
$_smarty_tpl->tpl_vars['pageNumber']->do_else = false;
?>
                        <?php if ($_smarty_tpl->tpl_vars['pageNumber']->value == $_smarty_tpl->tpl_vars['currentPage']->value) {?> <span
                          class="btn btn-primary btn-sm"><?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
</span> <?php } else { ?> <a
                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets&page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"
                            class="btn btn-default btn-sm"><?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
</a> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> <?php if ($_smarty_tpl->tpl_vars['currentPage']->value < $_smarty_tpl->tpl_vars['totalPages']->value) {?> <a
                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets&page=<?php echo $_smarty_tpl->tpl_vars['currentPage']->value+1;?>
" class="btn btn-default btn-sm">
                            <i class="fa fa-chevron-right">
                            </i>
                        </a> <?php }?>
                      <?php }?>
                      <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table id="ticketTable" class="table table-hover table-striped">
                      <tbody> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sortedTickets']->value, 'ticket');
$_smarty_tpl->tpl_vars['ticket']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ticket']->value) {
$_smarty_tpl->tpl_vars['ticket']->do_else = false;
?>
                          <tr <?php if ($_smarty_tpl->tpl_vars['ticket']->value['read_flag'] == 0) {?>class="unread-ticket" <?php }?>>
                            <td style="padding: 0px">
                              <table class="table table-bordered" style="margin: 0px">
                                <tr>
                                  <td>
                                    <input type="checkbox"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_view/<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
" class="ticket-link" data-toggle="tooltip"
                                      title="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['message'];?>
"> <?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
 </a>
                                  </td>
                                  <td class="mailbox-subject" colspan="4"><b><?php echo $_smarty_tpl->tpl_vars['ticket']->value['title'];?>
</b></td>
                                  <td class="mailbox-name"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['created_by'];?>
</td>
                                  <td class="mailbox">
                                    <span
                                      class="label <?php if ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Low') {?>label-success <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Medium') {?>label-primary <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'High') {?>label-danger <?php }?>"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['priority'];?>
</span>
                                    <span
                                      class="label <?php if ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'open') {?>label-danger <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'in_progress') {?>label-primary <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'resolved') {?>label-success <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'closed') {?>label-default<?php }?> "><?php echo $_smarty_tpl->tpl_vars['ticket']->value['status'];?>
</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="mailbox-subject"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['department'];?>
</td>
                                  <td class="mailbox"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['customer']->value['id'] == $_smarty_tpl->tpl_vars['ticket']->value['userid']) {?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
" data-toggle="tooltip"
                                        title="<?php echo $_smarty_tpl->tpl_vars['customer']->value['info'];?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
</a> <?php }?>
                                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                  </td>
                                  <td class="mailbox-attachment"> <?php if ($_smarty_tpl->tpl_vars['ticket']->value['attachment_id']) {?> <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['ticket']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php $_smarty_tpl->_assignInScope('attachmentType', '');?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Image");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'pdf') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PDF");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'doc' || $_smarty_tpl->tpl_vars['extension']->value == 'docx') {?>
                                      <?php $_smarty_tpl->_assignInScope('attachmentType', "Word Document");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'xls' || $_smarty_tpl->tpl_vars['extension']->value == 'xlsx') {?>
                                      <?php $_smarty_tpl->_assignInScope('attachmentType', "Excel Spreadsheet");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'ppt' || $_smarty_tpl->tpl_vars['extension']->value == 'pptx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PowerPoint Presentation");?>
                                    <?php } else { ?>
                                    <?php $_smarty_tpl->_assignInScope('attachmentType', "File");?>
                                    <?php }?> <?php echo $_smarty_tpl->tpl_vars['attachmentType']->value;?>

                                  <?php } else { ?> <?php echo Lang::T('None');?>

                                  <?php }?> </td>
                                <td class="mailbox-date"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedCreated'];?>
</td>
                                <td class="mailbox-date"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedLastUpdated'];?>
</td>
                                <td class="mailbox-date"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['updated_by'];?>
</td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                      data-toggle="dropdown">
                                      <?php echo Lang::T('Update Status');?>
 <span class="caret">
                                      </span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                      <li>
                                        <a
                                          href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=in_progress&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><?php echo Lang::T('In Progress');?>
</a>
                                      </li>
                                      <li>
                                        <a
                                          href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=resolved&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><?php echo Lang::T('Resolved');?>
</a>
                                      </li>
                                      <li>
                                        <a
                                          href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=closed&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><?php echo Lang::T('Closed');?>
</a>
                                      </li>
                                      <li>
                                        <a
                                          href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=closed&delete=trash&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><?php echo Lang::T('Trash');?>
</a>
                                      </li>
                                    </ul>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                  </tbody>
                </table>
              </div>
              <!-- /.mail-box-messages -->
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>

<!-- <?php echo '<script'; ?>
>
  function showSubcategories(category) {
    var subcategorySection = document.getElementById('subcategorySection');
    var subcategorySelect = document.getElementById('subcategorySelect');
    var customSubcategoryInput = document.getElementById('customSubcategoryInput');

    if (category === 'internet') {
      subcategorySection.style.display = 'block';
      subcategorySelect.innerHTML = `
        <option value="">Select One</option>
        <option value="no_internet">No Internet</option>
        <option value="slow_browsing">Slow Browsing</option>
        <option value="intermittent">Intermittent</option>
      `;
      customSubcategoryInput.style.display = 'none';
    } else if (category === 'change_speed') {
      subcategorySection.style.display = 'block';
      subcategorySelect.innerHTML = `
        <option value="">Select One</option>
        <option value="upgrade">Upgrade</option>
        <option value="downgrade">Downgrade</option>
      `;
      customSubcategoryInput.style.display = 'none';
    } else if (category === 'others') {
      subcategorySection.style.display = 'block';
      subcategorySelect.innerHTML = `
        <option value="custom">Other</option>
      `;
      customSubcategoryInput.style.display = 'block';
    } else {
      subcategorySection.style.display = 'none';
      subcategorySelect.innerHTML = `<option value="">Select One</option>`;
      customSubcategoryInput.style.display = 'none';
    }
  }
<?php echo '</script'; ?>
> -->
<?php echo '<script'; ?>
>
  // Attach click event listener to the table

  // Hide all message rows by default
  var messageRows = document.querySelectorAll('.message-row');
  messageRows.forEach(function(row) {
    row.style.display = 'none';
  });
  const searchInput = document.getElementById('searchTickets');
  const ticketTable = document.getElementById('ticketTable');
  const ticketRows = ticketTable.getElementsByTagName('tr');
  searchInput.addEventListener('input', function() {
    const searchQuery = searchInput.value.toLowerCase();
    for (let i = 1; i < ticketRows.length; i++) {
      const ticketRow = ticketRows[i];
      const ticketData = ticketRow.getElementsByTagName('td');
      let hasMatch = false;
      for (let j = 0; j < ticketData.length; j++) {
        const ticketCell = ticketData[j];
        if (ticketCell.textContent.toLowerCase().includes(searchQuery)) {
          hasMatch = true;
          break;
        }
      }
      if (hasMatch || searchQuery === '') {
        ticketRow.style.display = '';
      } else {
        ticketRow.style.display = 'none';
      }
    }
  });
  // Reload the page when the search input is cleared
  searchInput.addEventListener('keyup', function(event) {
    if (event.keyCode === 8 && searchInput.value === '') {
      location.reload();
    }
  });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  window.addEventListener('DOMContentLoaded', function() {
    var portalLink = "https://freeispradius.com";
    $('#version').html('Support Tickets | Ver: 1.5.3 | by: <a href="' + portalLink + '">FreeIspRadius</a>');
  });
<?php echo '</script'; ?>
> <?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
