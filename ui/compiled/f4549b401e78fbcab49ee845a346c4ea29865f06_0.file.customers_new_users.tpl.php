<?php
/* Smarty version 4.3.1, created on 2024-06-09 17:43:45
  from 'F:\xampp\htdocs\radius\ui\themes\nova\customers_new_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6665bfa1db8273_43026686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4549b401e78fbcab49ee845a346c4ea29865f06' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\customers_new_users.tpl',
      1 => 1717943723,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6665bfa1db8273_43026686 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('New Users');?>
</span>
                <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 10px;">
                            <?php echo Lang::T('Need Help?');?>

                        </button>
                        <a class="btn btn-primary btn-xs" title="save" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/csv" onclick="return confirm('This will export to CSV?')">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> CSV
                        </a>
                    </div>
                <?php }?>
            </div>

            <ul class="nav nav-tabs nav-justified">
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'all') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list" class="bg-primary">
                        <i class="fa fa-users"></i> <?php echo Lang::T('All Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'active') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/active_users" class="bg-success">
                        <i class="fa fa-check-circle"></i> <?php echo Lang::T('Active Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'expired') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/expired_users" class="bg-danger">
                        <i class="fa fa-times-circle"></i> <?php echo Lang::T('Expired Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'hotspot') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/hotspot_users" class="bg-warning">
                        <i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'static') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/static_users" class="bg-info">
                        <i class="fa fa-desktop"></i> <?php echo Lang::T('Static Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'pppoe') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/pppoe_users" class="bg-purple">
                        <i class="fa fa-exchange"></i> <?php echo Lang::T('PPPoE Users');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'new') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/new_users" class="bg-pink">
                        <i class="fa fa-plus-circle"></i> <?php echo Lang::T('New Users');?>

                    </a>
                </li>
            </ul>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/new_users">
                            <div class="input-group">
                                <input type="text" name="search" value="<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
" class="form-control" placeholder="<?php echo Lang::T('Search');?>
...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/add" class="btn btn-primary btn-block"><i class="ion ion-android-add"> </i> <?php echo Lang::T('Add New Contact');?>
</a>
                    </div>&nbsp;
                </div>
                <div class="table-responsive table_mobile">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Username');?>
</th>
                                <th><?php echo Lang::T('Full Name');?>
</th>
                                <th><?php echo Lang::T('Balance');?>
</th>
                                <th><?php echo Lang::T('Phone Number');?>
</th>
                                <th><?php echo Lang::T('Email');?>
</th>
                                <th><?php echo Lang::T('Package');?>
</th>
                                <th><?php echo Lang::T('Service Type');?>
</th>
                                <th><?php echo Lang::T('Created On');?>
</th>
                                <th><?php echo Lang::T('IP Address');?>
</th>
                                <th><?php echo Lang::T('Router');?>
</th>
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
                            <tr>
                                <td onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'" style="cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                <td onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'" style="cursor: pointer;"><?php echo $_smarty_tpl->tpl_vars['ds']->value['fullname'];?>
</td>
                                <td>
                                    <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['balance']);?>

                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit-balance/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-primary btn-xs">Edit</a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['phonenumber'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>
</td>
                                <td align="center" api-get-text="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
autoload/customer_is_active/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                                    <span class="label label-default">&bull;</span>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['service_type'];?>
</td>
                                <td><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['created_at']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['ip_address'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['router_name'];?>
</td>
                                <td align="center">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" style="margin: 0px;" class="btn btn-success btn-xs">&nbsp;&nbsp;<?php echo Lang::T('View');?>
&nbsp;&nbsp;</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/recharge/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" style="margin: 0px;" class="btn btn-primary btn-xs"><?php echo Lang::T('Recharge');?>
</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" style="margin: 0px;" class="btn btn-warning btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/delete/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" style="margin: 0px;" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo Lang::T('Delete');?>
?')"><?php echo Lang::T('Delete');?>
</a>
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
</div>

<div class="modal fade" id="editBalanceModal" tabindex="-1" role="dialog" aria-labelledby="editBalanceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editBalanceModalLabel"><?php echo Lang::T('Edit Balance');?>
</h4>
            </div>
            <div class="modal-body">
                <form id="editBalanceForm" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit-balance">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="form-group">
                        <label for="balance"><?php echo Lang::T('Balance');?>
</label>
                        <input type="text" class="form-control" id="balance" name="balance" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Save Changes');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php echo '<script'; ?>
>
$(document).ready(function() {
    $('.edit-balance').click(function() {
        console.log('Edit balance click event triggered');
        var customerId = $(this).data('customer-id');
        var balance = $(this).data('balance');
        console.log('Customer ID:', customerId);
        console.log('Current Balance:', balance);
        $('#customer_id').val(customerId);
        $('#balance').val(balance);
        $('#editBalanceModal').modal('show');
    });

    $('#editBalanceForm').submit(function(e) {
        e.preventDefault();
        console.log('Form submission event triggered');
        var customerId = $('#customer_id').val();
        var balance = $('#balance').val();
        console.log('Customer ID:', customerId);
        console.log('New Balance:', balance);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: {
                customer_id: customerId,
                balance: balance
            },
            success: function(response) {
                console.log('AJAX success response:', response);
                // Handle success response
                $('#editBalanceModal').modal('hide');
                location.reload(); // Optionally reload the page
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', error);
                // Handle error response
            }
        });
    });
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Uya2UmLUipk?si=fKLpPV-PQ3Z_8zXh" allowfullscreen></iframe>
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
