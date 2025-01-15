<?php
/* Smarty version 4.3.1, created on 2024-06-18 22:02:06
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_backup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6671d9ae4584e9_99063078',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7682e5ddddb1742ee9369b6146c5c5b09e6fbe04' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_backup.tpl',
      1 => 1718611888,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6671d9ae4584e9_99063078 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
.table th, .table td {
    vertical-align: middle !important;
}

.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
}

.thead-dark th {
    background-color: #343a40;
    color: #000; /* Change to black */
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.accordion .card {
    margin-bottom: 1rem;
}

.accordion .card-header {
    cursor: pointer;
    background-color: #007bff;
    color: white;
}

.accordion .card-header h5 {
    margin-bottom: 0;
}

.accordion .card-header .btn {
    width: 100%;
    text-align: left;
    color: white;
}

.accordion .card-header .btn:hover {
    text-decoration: none;
}

.card-body {
    background-color: #f8f9fa;
}
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Router Backups');?>
</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    <?php echo Lang::T('Need Help?');?>

                </button>
            </div>
            <div class="panel-body">
                <div id="accordion" class="accordion">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                    <div class="card">
                        <div class="card-header" id="heading<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" aria-expanded="true" aria-controls="collapse<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>

                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" class="collapse" aria-labelledby="heading<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" data-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="color: black;"><?php echo Lang::T('Backup Date');?>
</th>
                                                <th style="color: black;"><?php echo Lang::T('Actions');?>
</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['backups']->value, 'backup');
$_smarty_tpl->tpl_vars['backup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['backup']->value) {
$_smarty_tpl->tpl_vars['backup']->do_else = false;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['backup']->value['router_id'] == $_smarty_tpl->tpl_vars['router']->value['id']) {?>
                                                <tr>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['backup']->value['backup_date'];?>
</td>
                                                    <td>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_backups/download-backup?id=<?php echo $_smarty_tpl->tpl_vars['backup']->value['id'];?>
" class="btn btn-info btn-sm">
                                                            <i class="fa fa-download"></i> <?php echo Lang::T('Download');?>

                                                        </a>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_backups/restore-backup?id=<?php echo $_smarty_tpl->tpl_vars['backup']->value['id'];?>
" class="btn btn-success btn-sm">
                                                            <i class="fa fa-undo"></i> <?php echo Lang::T('Restore');?>

                                                        </a>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_backups/delete-backup?id=<?php echo $_smarty_tpl->tpl_vars['backup']->value['id'];?>
" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> <?php echo Lang::T('Delete');?>

                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel"><?php echo Lang::T('Tutorial Video');?>
</h5>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Lang::T('Close');?>
</button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
