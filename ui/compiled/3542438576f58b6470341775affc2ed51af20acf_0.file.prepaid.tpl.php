<?php
/* Smarty version 4.3.1, created on 2024-12-23 19:26:22
  from 'F:\xampp\htdocs\radius\ui\themes\nova\prepaid.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67698f2ed2c630_69149134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3542438576f58b6470341775affc2ed51af20acf' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\prepaid.tpl',
      1 => 1732286069,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_67698f2ed2c630_69149134 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Prepaid Users');?>
</span>
                <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 10px;">
                            <?php echo Lang::T('Need Help?');?>

                        </button>
                        <a class="btn btn-primary btn-xs" title="sync" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/sync" onclick="return confirm('This will sync/send Customer active plan to Mikrotik?')">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Sync All
                        </a>
                        <!-- Sync by Router Button -->
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#routerSyncModal">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php echo Lang::T('Sync by Router');?>

                        </button>
                        <a class="btn btn-info btn-xs" title="export" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/csv-prepaid" onclick="return confirm('This will export to CSV?')">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> CSV
                        </a>
                    </div>
                <?php }?>
            </div>

            <!-- Tab Navigation for different types of users -->
            <ul class="nav nav-tabs nav-justified">
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'list') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list" class="bg-primary">
                        <i class="fa fa-users"></i> <?php echo Lang::T('All Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'hotspot') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list_hotspot" class="bg-warning">
                        <i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'static') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list_static" class="bg-info">
                        <i class="fa fa-desktop"></i> <?php echo Lang::T('Static Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'pppoe') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list_pppoe" class="bg-purple">
                        <i class="fa fa-exchange"></i> <?php echo Lang::T('PPPoE Users');?>

                    </a>
                </li>
            </ul>

            <!-- Prepaid Users Table -->
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="<?php echo Lang::T('Search by Username');?>
..." value="<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><?php echo Lang::T('Search');?>
</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/recharge" class="btn btn-primary btn-block">
                            <i class="ion ion-android-add"> </i> <?php echo Lang::T('Recharge Account');?>

                        </a>
                    </div>&nbsp;
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Username');?>
</th>
                                <th><?php echo Lang::T('Plan Name');?>
</th>
                                <th><?php echo Lang::T('Type');?>
</th>
                                <th><?php echo Lang::T('Created On');?>
</th>
                                <th><?php echo Lang::T('Expires On');?>
</th>
                                <th><?php echo Lang::T('Method');?>
</th>
                                <th><?php echo Lang::T('Routers');?>
</th>
                                <th><?php echo Lang::T('Status');?>
</th>
                                <th><?php echo Lang::T('Last Seen');?>
</th>
                                <th><?php echo Lang::T('Daily Data');?>
 </th>
                                <th><?php echo Lang::T('Was Connected?');?>
 <a href="#" data-toggle="tooltip" title="This column shows if the account was connected during payment."><i class="fa fa-question-circle"></i></a></th>
                                <th><?php echo Lang::T('Reconnection SMS');?>
 <a href="#" data-toggle="tooltip" title="If not connected, we send SMS for reconnection to the customer."><i class="fa fa-question-circle"></i></a></th>
                                <!-- New Disconnection Reason Column -->
                                <th><?php echo Lang::T('Disconnection Reason');?>
 <a href="#" data-toggle="tooltip" title="This column shows the reason for disconnection."><i class="fa fa-question-circle"></i></a></th>
                                <th><?php echo Lang::T('FUP');?>
</th> <!-- Added FUP Column -->
                                <th><?php echo Lang::T('Manage');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                                <tr <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'off') {?>class="danger"<?php }?>>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/viewu/<?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
"><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</a></td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['namebp'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                                    <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>
</td>
                                    <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                                    <td>
                                        <span class="label <?php if ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'Online') {?>label-success<?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'disabled') {?>label-warning<?php } else { ?>label-danger<?php }?>">
                                            <?php echo $_smarty_tpl->tpl_vars['ds']->value['state'];?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'Online') {?>
                                            <span class="label label-success"><?php echo Lang::T('Currently Online');?>
</span>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'disabled') {?>
                                            <span class="label label-warning"><?php echo Lang::T('Disabled');?>
</span>
                                        <?php } else { ?>
                                            <span class="label label-danger"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['last_seen'],'');?>
</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['daily_usage']) {?>
                                            <strong><?php echo Lang::T('');?>
</strong> <?php echo smarty_modifier_convert_bytes($_smarty_tpl->tpl_vars['ds']->value['daily_usage']['total']);?>

                                        <?php } else { ?>
                                            <span class="label label-danger"><?php echo Lang::T('No data');?>
</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['was_connected'] == 'yes') {?>
                                            <span class="label label-success">Yes</span>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['was_connected'] == 'no') {?>
                                            <span class="label label-danger">No</span>
                                        <?php } else { ?>
                                            <span class="label label-default">N/A</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['reconnection'] == 'sms sent') {?>
                                            <span class="label label-success">Sent</span>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['reconnection'] == 'n/a') {?>
                                            <span class="label label-default">N/A</span>
                                        <?php } else { ?>
                                            <span class="label label-warning">Not Sent</span>
                                        <?php }?>
                                    </td>
                                    <!-- Disconnection Reason Column -->
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['disconnection_reason'] != '') {?>
                                            <div class="label label-danger">
                                                <?php echo $_smarty_tpl->tpl_vars['ds']->value['disconnection_reason'];?>

                                            </div>
                                            <a href="#" class="label label-success btn-xs rectify-button" data-username="<?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
" data-reason="<?php echo $_smarty_tpl->tpl_vars['ds']->value['disconnection_reason'];?>
">Click to Rectify</a>
                                        <?php } else { ?>
                                            <span class="label label-default">N/A</span>
                                        <?php }?>
                                    </td>
                                    <td>
    <?php if ($_smarty_tpl->tpl_vars['ds']->value['fup_enabled'] == 1) {?>
        <span class="label label-success"><?php echo Lang::T('Enabled');?>
</span>
    <?php } else { ?>
        <span class="label label-danger"><?php echo Lang::T('Disabled');?>
</span>
    <?php }?>
</td>

                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/edit/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-success btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/extend/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Extend');?>
</a>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/enable/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Enable');?>
?')" class="btn btn-primary btn-xs"><?php echo Lang::T('Enable');?>
</a>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/disable/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Disable');?>
?')" class="btn btn-warning btn-xs"><?php echo Lang::T('Disable');?>
</a>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/delete/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Delete');?>
?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

            </div>
        </div>
    </div>

<!-- Tutorial Modal -->
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/8sHAiUXxH9w?si=KWoO8w_-dSFWuJoL" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Sync by Router Modal -->
<div class="modal fade" id="routerSyncModal" tabindex="-1" role="dialog" aria-labelledby="routerSyncModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="routerSyncModalLabel"><?php echo Lang::T('Select Router to Sync');?>
</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="routerSyncForm" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/sync-router">
                    <div class="form-group">
                        <label for="routerSelect"><?php echo Lang::T('Router');?>
</label>
                        <select id="routerSelect" name="router" class="form-control select2" required>
                            <option value=""><?php echo Lang::T('Select Router');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routerssync']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger"><?php echo Lang::T('Sync Now');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="path/to/sweetalert2.min.css">
<?php echo '<script'; ?>
 src="path/to/sweetalert2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function() {
        $('.rectify-button').on('click', function(e) {
            e.preventDefault();
            var username = $(this).data('username');
            var reason = $(this).data('reason');

            // Check disconnection reason and show appropriate message
            if (reason === 'keepalive timeout') {
                Swal.fire({
                    title: 'Connection Issue',
                    html: 'Customer disconnected/moved out of network. To reconnect, tell the customer to click on sign in. If it doesn\'t work, use this username: <strong>' + username + '</strong> and password: <strong>1234</strong> and enter on "Already Paid" Section. Only do this if Client Complains He/She might have disconnected willingly',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'traffic limit reached') {
                Swal.fire({
                    title: 'Information',
                    text: 'Customer has exhausted assigned data. Renew the account to reconnect.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'session timeout') {
                Swal.fire({
                    title: 'Session Expired/Time Limit Reached',
                    text: 'The customer\'s allocated time has ended. Ask them to Pay again to continue using the service.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'N/A') {
                Swal.fire({
                    title: 'Information',
                    text: 'Customer is either expired / online / just disconnected/Router is Offline or the system hasn\'t checked yet. Please wait at least 10 minutes and check again.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'expired') {
                Swal.fire({
                    title: 'Account Expired',
                    text: 'This disconnection was caused by account  expiry. Reactivate or let the customer buy again.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Unknown Reason',
                    text: 'No specific instructions available for this disconnection reason.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
<?php echo '</script'; ?>
>
<?php }
}
