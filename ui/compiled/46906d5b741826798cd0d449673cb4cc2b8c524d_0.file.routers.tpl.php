<?php
/* Smarty version 4.3.1, created on 2024-12-30 20:57:25
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6772df055bd034_67718068',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46906d5b741826798cd0d449673cb4cc2b8c524d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers.tpl',
      1 => 1729886472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6772df055bd034_67718068 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- routers -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Routers');?>
</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    <?php echo Lang::T('Need Help?');?>

                </button>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="<?php echo Lang::T('Search by Name');?>
...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><?php echo Lang::T('Search');?>
</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/add" class="btn btn-primary btn-block waves-effect"><i class="ion ion-android-add"> </i> <?php echo Lang::T('New Router');?>
</a>
                    </div>&nbsp;
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?php echo Lang::T('Router Name');?>
</th>
                                <th><?php echo Lang::T('IP Address');?>
</th>
                                <th><?php echo Lang::T('Username');?>
</th>
                                <th><?php echo Lang::T('Description');?>
</th>
                                <th><?php echo Lang::T('Status');?>
</th>
                                <th><?php echo Lang::T('State');?>
</th>
                                <th><?php echo Lang::T('Uptime');?>
</th>
                                <th><?php echo Lang::T('Model');?>
</th>
                                <th><?php echo Lang::T('Last Seen');?>
</th>
                                <th><?php echo Lang::T('Reboot');?>
</th>
                                <th><?php echo Lang::T('Manage');?>
</th>
                                <th><?php echo Lang::T('Remote Access');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                            <tr <?php if ($_smarty_tpl->tpl_vars['router']->value['enabled'] != 1) {?>class="danger" title="disabled"<?php }?>>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['ip_address'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['description'];?>
</td>
                                <td><?php if ($_smarty_tpl->tpl_vars['router']->value['enabled'] == 1) {?>Enabled<?php } else { ?>Disabled<?php }?></td>
                                <td><span class="label label-<?php echo $_smarty_tpl->tpl_vars['router']->value['pingClass'];?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value['pingStatus'];?>
</span></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['uptime'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['model'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['router']->value['pingStatus'] == 'Online') {?>
                                        <span class="label label-success">Currently Online</span>
                                    <?php } else { ?>
                                        <span class="label label-danger" style="color: white;"><?php echo $_smarty_tpl->tpl_vars['router']->value['last_seen'];?>
</span>
                                    <?php }?>
                                </td>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/reboot/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" class="btn btn-warning btn-xs">Reboot</a></td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/edit/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
<a href="javascript:void(0);" onclick="confirmDelete('<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/history/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" class="btn btn-primary btn-xs"><?php echo Lang::T('Offline History');?>
</a>
                                </td>
                                <td>
                                    <a href="https://vpn.ispledger.com" class="btn btn-success btn-xs" target="_blank"><?php echo Lang::T('Access');?>
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

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapseInstructions" class="text-primary">
                        <i class="fa fa-plus-circle"></i> <?php echo Lang::T('Enable Reboot Functionality');?>

                    </a>
                </h4>
            </div>
            <div id="collapseInstructions" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> <?php echo Lang::T('To enable the router reboot functionality, please follow the instructions below:');?>

                    </div>
                    <ol>
                        <li><?php echo Lang::T('Copy the code snippet from the box below.');?>
</li>
                        <li><?php echo Lang::T('Log in to your MikroTik router\'s terminal.');?>
</li>
                        <li><?php echo Lang::T('Paste the code into the terminal and press Enter.');?>
</li>
                        <li><?php echo Lang::T('The reboot functionality will be enabled on your router.');?>
</li>
                    </ol>
                    <div class="well">
                        <pre><code>/file print file=reboot.txt
/file set reboot.txt contents="0"
/system script add name="reboot" source="/file set reboot.txt contents=\"1\""
/system scheduler add name="watch-reboot" interval=1m on-event=":local needReboot [/file get reboot.txt contents]; :if (\$needReboot != \"0\") do={ /file set \"reboot.txt\" contents=\"0\"; /system reboot; }"</code></pre>
                        <button class="btn btn-primary btn-block" onclick="copyCode()"><i class="fa fa-copy"></i> <?php echo Lang::T('Copy Code');?>
</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
function confirmDelete(routerId, routerName) {
    Swal.fire({
        title: '<?php echo Lang::T('Are you sure?');?>
',
        text: "<?php echo Lang::T('You wont be able to revert this!');?>
 " + routerName,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<?php echo Lang::T('Yes, delete it!');?>
'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/delete/" + routerId;
        }
    });
}

function copyCode() {
    var code = document.querySelector("pre code");
    var range = document.createRange();
    range.selectNode(code);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    alert("<?php echo Lang::T('Code copied to clipboard!');?>
");
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tQNY_TfIIQE?si=pu14iOtkGNa3sO59" allowfullscreen></iframe>
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
