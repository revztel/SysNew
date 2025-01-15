<?php
/* Smarty version 4.3.1, created on 2024-06-11 18:11:19
  from 'F:\xampp\htdocs\radius\ui\themes\nova\prepaid_active_hotspot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_666869178e5278_86584173',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bd4709411f077b8343d4c621c2c058367cf36e3' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\prepaid_active_hotspot.tpl',
      1 => 1717948129,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_666869178e5278_86584173 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Active Packages');?>
</span>
                <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 10px;">
                            <?php echo Lang::T('Need Help?');?>

                        </button>
                        <a class="btn btn-primary btn-xs" title="sync" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/sync" onclick="return confirm('This will sync/send Customer active plan to Mikrotik?')">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Sync
                        </a>
                        <a class="btn btn-info btn-xs" title="export" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/csv-prepaid" onclick="return confirm('This will export to CSV?')">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> CSV
                        </a>
                    </div>
                <?php }?>
            </div>

            <ul class="nav nav-tabs nav-justified">
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'active_packages') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_packages" class="bg-primary">
                        <i class="fa fa-users"></i> <?php echo Lang::T('All Active');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'active_hotspot') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_hotspot" class="bg-warning">
                        <i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'active_static') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_static" class="bg-info">
                        <i class="fa fa-desktop"></i> <?php echo Lang::T('Static');?>

                    </a>
                </li>
                <li class="<?php if ($_smarty_tpl->tpl_vars['filter']->value == 'active_pppoe') {?>active<?php }?>">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_pppoe" class="bg-purple">
                        <i class="fa fa-exchange"></i> <?php echo Lang::T('PPPoE');?>

                    </a>
                </li>
            </ul>

            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_packages">
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
                                <tr <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'off') {?>class="danger" <?php }?>>
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
                                        <span class="label <?php if ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'Online') {?>label-success<?php } else { ?>label-danger<?php }?>">
                                            <?php echo $_smarty_tpl->tpl_vars['ds']->value['state'];?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['state'] == 'Online') {?>
                                            <span class="label label-success"><?php echo Lang::T('Currently Online');?>
</span>
                                        <?php } else { ?>
                                            <span class="label label-danger"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['last_seen'],'');?>
</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/edit/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-warning btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
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
</div>

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

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
