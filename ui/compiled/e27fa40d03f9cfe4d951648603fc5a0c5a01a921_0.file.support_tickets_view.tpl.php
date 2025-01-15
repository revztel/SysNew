<?php
/* Smarty version 4.3.1, created on 2024-04-26 22:57:56
  from 'F:\xampp\htdocs\radius\system\plugin\ui\support_tickets_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_662c0744a1fa67_30913838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e27fa40d03f9cfe4d951648603fc5a0c5a01a921' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\support_tickets_view.tpl',
      1 => 1708432254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_662c0744a1fa67_30913838 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js">
<?php echo '</script'; ?>
>
<section class="content-header">
  <h1>
    <div class="btn-group">
      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets" class="btn btn-success"><?php echo Lang::T('BACK');?>
 </a>
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
<div class="modal fade" id="create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?php echo Lang::T('Create New Ticket');?>
</h4>
      </div>
      <div class="box-body">
        <div class="tab-pane">
          <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets" method="post" enctype="multipart/form-data" class="form-horizontal">
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
              <label for="inputName" class="col-sm-2 control-label"><?php echo Lang::T('Subject');?>
:</label>

              <div class="col-sm-10">
                <input class="form-control" name="subject" placeholder="<?php echo Lang::T('Subject');?>
" required>
              </div>
             </div>
            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label"><?php echo Lang::T('Message');?>
:</label>

              <div class="col-sm-10">
                <textarea name="message" class="form-control" placeholder="<?php echo Lang::T('Message');?>
" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"><?php echo Lang::T('Priority');?>
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
                  <input type="radio" name="report" value="landline" onclick="showSubcategories('landline')">  <?php echo Lang::T('Landline');?>

                </label>
                <label class="radio-inline">
                  <input type="radio" name="report" value="iptv" onclick="showSubcategories('iptv')"><?php echo Lang::T('IPTV');?>
 
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
              <label class="col-sm-2 control-label"> <?php echo Lang::T('Issue');?>
:</label>
              <div class="col-sm-10">
                <select class="form-control" name="issue" id="subcategorySelect" required>
                  <option value=""><?php echo Lang::T('Select One');?>
</option>
                </select>
                <input type="text" class="form-control" name="custom" placeholder="<?php echo Lang::T('Please specify');?>
" id="customSubcategoryInput" style="display: none;">
              </div>
            </div>
             -->
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
              <label for="inputSkills" class="col-sm-2 control-label"><?php echo Lang::T('Attachment');?>
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
          <button class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#create"> <?php echo Lang::T('Create Ticket');?>
</button> <br>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Lang::T('Customer Details');?>
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
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?>
                  <?php if ($_smarty_tpl->tpl_vars['customer']->value['id'] == $_smarty_tpl->tpl_vars['ticket']->value['userid']) {?>
                <li class="">
                  <a href="#">
                    <?php echo Lang::T('Name');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>

                  </a>
                </li>
                <li class="">
                  <a href="#">
                    <?php echo Lang::T('Email');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['email'];?>

                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Active Service');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['service'];?>

                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Service Type');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['type'];?>

                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Balance');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['balance'];?>

                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Phone');?>
: <?php echo $_smarty_tpl->tpl_vars['customer']->value['phone'];?>

                  </a>
                </li>
                <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Lang::T('Ticket Details');?>
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
                    <?php echo Lang::T('Priority');?>
: <span
                     class="label  pull-right <?php if ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Low') {?>label-success <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Medium') {?>label-primary <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'High') {?>label-danger <?php }?>"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['priority'];?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Status');?>
: <span class="label pull-right <?php if ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'open') {?>label-danger <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'in_progress') {?>label-primary <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'resolved') {?>label-success <?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'closed') {?>label-default<?php }?> "><?php echo $_smarty_tpl->tpl_vars['ticket']->value['status'];?>
</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Department');?>
: <span class="label label-primary pull-right"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['department'];?>
</span>
                  </a>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['ticket']->value['report']) {?>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Report');?>
: <span class="label label-primary pull-right"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['report'];?>
</span>
                  </a>
                </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['ticket']->value['issue']) {?>
                <li>
                  <a href="#">
                    <?php echo Lang::T('Issue');?>
: <span class="label label-primary pull-right"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['issue'];?>
</span>
                  </a>
                </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['ticket']->value['custom']) {?>
                <li>
                  <a href="#">
                   <pre class=""><?php echo $_smarty_tpl->tpl_vars['ticket']->value['custom'];?>
</pre>
                  </a>
                </li>
                <?php }?>
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
              <h3 class="box-title"><?php echo Lang::T('Ticket');?>
: [<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
] </h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                    class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                    class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $_smarty_tpl->tpl_vars['ticket']->value['title'];?>
</h3>
                <h5><?php echo Lang::T('From');?>
: <?php
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
                  <span class="mailbox-read-time pull-right"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['created'];?>
</span>
                </h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body"
                    title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body"
                    title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body"
                    title="Forward">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p><?php echo $_smarty_tpl->tpl_vars['ticket']->value['message'];?>
</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <ul class="mailbox-attachments clearfix"> <?php if ($_smarty_tpl->tpl_vars['ticket']->value['attachment_id'] && $_smarty_tpl->tpl_vars['ticket']->value['attachment_path']) {?> <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['ticket']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['attachment_path'];?>
"
                      alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['attachment_path'];?>
" class="mailbox-attachment-name"><i class="fa fa-camera"></i><?php if ($_smarty_tpl->tpl_vars['ticket']->value['attachment_id']) {?> <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['ticket']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php $_smarty_tpl->_assignInScope('attachmentType', '');?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Image");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'pdf') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PDF");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'doc' || $_smarty_tpl->tpl_vars['extension']->value == 'docx') {?>
                      <?php $_smarty_tpl->_assignInScope('attachmentType', "Word Document");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'xls' || $_smarty_tpl->tpl_vars['extension']->value == 'xlsx') {?>
                      <?php $_smarty_tpl->_assignInScope('attachmentType', "Excel Spreadsheet");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'ppt' || $_smarty_tpl->tpl_vars['extension']->value == 'pptx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PowerPoint Presentation");?>
                      <?php } else { ?>
                      <?php $_smarty_tpl->_assignInScope('attachmentType', "File");?>
                      <?php }?> <?php echo $_smarty_tpl->tpl_vars['attachmentType']->value;?>

                      <?php } else { ?> <?php echo Lang::T('Undefined');?>

                      <?php }?></a>
                    <span class="mailbox-attachment-size">
                      1.9 MB
                      <a href="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['attachment_path'];?>
" class="btn btn-default btn-xs pull-right"><i
                          class="fa fa-cloud-download"></i></a>
                    </span>
                  </div>
                </li>
                <?php } else { ?>
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['attachment_path'];?>
" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                      Sep2014-report.pdf</a>
                    <span class="mailbox-attachment-size">
                      1,245 KB
                      <a href="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['attachment_path'];?>
" class="btn btn-default btn-xs pull-right"><i
                          class="fa fa-cloud-download"></i></a>
                    </span>
                  </div>
                </li>
                <?php }?>
                <?php } else { ?> <li><?php echo Lang::T('No uploaded attachments');?>
</li>
                <?php }?>
              </ul>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="chat-messages-container">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <!-- /.direct-chat-msg -->
                <!-- Message to the right --> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['replies']->value, 'reply');
$_smarty_tpl->tpl_vars['reply']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['reply']->value) {
$_smarty_tpl->tpl_vars['reply']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['reply']->value['ticket_id'] == $_smarty_tpl->tpl_vars['ticket']->value['ticket_id']) {?> <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_by'] == 'Admin') {?> <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right"><?php echo $_smarty_tpl->tpl_vars['reply']->value['admin_name'];?>
</span>
                    <span class="direct-chat-timestamp pull-left"><?php echo Lang::timeElapsed($_smarty_tpl->tpl_vars['reply']->value['created'],true);?>
</span>
                  </div>
                  <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['reply']->value['userid'];?>
?set=set3&size=100x100&bgset=bg1"
                    onerror="this.src='system/uploads/admin.default.png'" class="direct-chat-img" alt="Avatar">
                  <div class="direct-chat-text"> <?php echo $_smarty_tpl->tpl_vars['reply']->value['reply_message'];?>
 </div>
                </div> <?php }?> <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_by'] == 'User') {?> <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'customer');
$_smarty_tpl->tpl_vars['customer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
$_smarty_tpl->tpl_vars['customer']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['customer']->value['id'] == $_smarty_tpl->tpl_vars['reply']->value['userid']) {?> <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
"
                        data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['customer']->value['info'];?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value['name'];?>
</a> <?php }?>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </span>
                    <span class="direct-chat-timestamp pull-right"><?php echo Lang::timeElapsed($_smarty_tpl->tpl_vars['reply']->value['created'],true);?>
</span>
                  </div>
                  <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['reply']->value['userid'];?>
?set=set3&size=100x100&bgset=bg1"
                    onerror="this.src='system/uploads/admin.default.png'" class="direct-chat-img" alt="Avatar">
                  <div class="direct-chat-text"> <?php echo $_smarty_tpl->tpl_vars['reply']->value['reply_message'];?>
 </div>
                </div> <?php }?>
                <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              <div class="box-footer">
                <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_admin_reply" method="post" enctype="multipart/form-data">
                  <div class="direct-chat-info clearfix">
                    <input type="hidden" name="ticketId" value="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
">
                    <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
">
                    <input type="hidden" name="reply_by" value="Admin">
                    <input type="hidden" name="admin_name" value="<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
">
                    <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">
                  </div>
                  <div class="input-group">
                    <input type="text" name="reply" placeholder="Type Message ..." class="form-control" required>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-success btn-flat"><?php echo Lang::T('Send');?>
</button>
                    </span>
                  </div>
                </form>
              </div>
              <!--/.direct-chat-messages-->
            </div>
            <!-- /.direct-chat-pane -->
            <!-- /.box-footer-->
          </div>
          <!-- /.box-footer -->
          <div class="box-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-default btn-reply"><i class="fa fa-reply"></i> <?php echo Lang::T('Reply');?>
</button>
              <button type="button" class="btn btn-success btn-reply dropdown-toggle" data-toggle="dropdown">
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
">
                    <?php echo Lang::T('In Progress');?>
</a>
                </li>
                <li>
                  <a
                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=resolved&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"> <?php echo Lang::T('Resolved');?>
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
              </ul>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_update_status&ticketId=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
&newStatus=closed&delete=trash&updatedBy=<?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
&csrf_token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> <?php echo Lang::T('Delete');?>
</button></a>
            <button type="button" class="btn btn-default"><i class="fa fa-print"></i> <?php echo Lang::T('Print');?>
</button>
          </div>
          <!-- /.box-footer -->
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
  var table = document.querySelector('.table');
  table.addEventListener('click', function (e) {
    if (e.target.classList.contains('ticket-link')) {
      e.preventDefault();
      var ticketId = e.target.getAttribute('data-ticket-id');
      var messageRow = document.getElementById('messageRow_' + ticketId);
      // Hide other message rows
      var messageRows = document.querySelectorAll('.message-row');
      messageRows.forEach(function (row) {
        if (row !== messageRow) {
          row.style.display = 'none';
        }
      });
      // Toggle display of clicked message row
      if (messageRow.style.display === 'none') {
        messageRow.style.display = 'table-row';
      } else {
        messageRow.style.display = 'none';
      }
    }
    if (e.target.classList.contains('status-change-btn')) {
      var ticketId = e.target.getAttribute('data-ticket-id');
      var status = prompt('Enter new status:');
      if (status !== null) {
        // Update the status in your backend or perform any further actions
        console.log('New status for ticket ' + ticketId + ': ' + status);
      }
    }
  });
  // Hide all message rows by default
  var messageRows = document.querySelectorAll('.message-row');
  messageRows.forEach(function (row) {
    row.style.display = 'none';
  });
  const searchInput = document.getElementById('searchTickets');
  const ticketTable = document.getElementById('ticketTable');
  const ticketRows = ticketTable.getElementsByTagName('tr');
  searchInput.addEventListener('input', function () {
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
  searchInput.addEventListener('keyup', function (event) {
    if (event.keyCode === 8 && searchInput.value === '') {
      location.reload();
    }
  });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  document.addEventListener('DOMContentLoaded', function () {
    var chatMessagesContainer = document.getElementById('chat-messages-container');
    var replyButton = document.querySelector('.btn-reply');

    chatMessagesContainer.style.display = 'none'; // Hide the chat messages container by default

    replyButton.addEventListener('click', function () {
      chatMessagesContainer.style.display = 'block'; // Show the chat messages container when the button is clicked
    });
  });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  window.addEventListener('DOMContentLoaded', function () {
    var portalLink = "https://github.com/focuslinkstech";
    $('#version').html('Support Tickets | Ver: 1.5.3 | by: <a href="' + portalLink + '">Focuslinks Tech</a>');
  });
<?php echo '</script'; ?>
> <?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
