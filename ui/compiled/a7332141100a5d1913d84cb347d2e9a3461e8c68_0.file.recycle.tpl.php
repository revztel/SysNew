<?php
/* Smarty version 4.3.1, created on 2025-01-08 18:21:21
  from 'F:\xampp\htdocs\radius\ui\themes\nova\recycle.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677e97f1d0b8e7_89866451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7332141100a5d1913d84cb347d2e9a3461e8c68' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\recycle.tpl',
      1 => 1728845335,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677e97f1d0b8e7_89866451 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Recycle Bin -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Recycle Bin');?>
</span>
                <div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmEmptyRecycleBin()">
                        <?php echo Lang::T('Empty Recycle Bin');?>

                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
recycle/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="<?php echo Lang::T('Search by Item Name or ID');?>
...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><?php echo Lang::T('Search');?>
</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <!-- You can add any buttons or links here if needed -->
                    </div>&nbsp;
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('ID');?>
</th>
                                <!-- Removed Original Table column -->
                                <th><?php echo Lang::T('Original ID');?>
</th>
                                <th><?php echo Lang::T('Deleted By');?>
</th>
                                <th><?php echo Lang::T('Deleted At');?>
</th>
                                <th><?php echo Lang::T('Item Details');?>
</th>
                                <th><?php echo Lang::T('Actions');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
                                <!-- Removed Original Table column -->
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['original_id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['deleted_by_username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['deleted_at'];?>
</td>
                                <td>
                                    <!-- Display a summary of the data -->
                                    <?php if ($_smarty_tpl->tpl_vars['item']->value['data_summary']['username']) {?>
                                        <?php echo Lang::T('Customer');?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['data_summary']['username'];?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['data_summary']['name']) {?>
                                        <?php echo Lang::T('Router');?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['data_summary']['name'];?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['data_summary']['name_plan']) {?>
                                        <?php echo Lang::T('Plan');?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['data_summary']['name_plan'];?>

                                    <?php } else { ?>
                                        <?php echo Lang::T('Unknown Item');?>

                                    <?php }?>
                                </td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
recycle/restore/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn btn-success btn-xs"><?php echo Lang::T('Restore');?>
</a>
                                    <a href="javascript:void(0);" onclick="confirmPermanentDelete('<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
', '<?php echo strtr((string)$_smarty_tpl->tpl_vars['item']->value['data_summary']['name'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
')" class="btn btn-danger btn-xs"><?php echo Lang::T('Delete Permanently');?>
</a>
                                </td>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <!-- If you have pagination, include it here -->
                <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modals -->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
function confirmPermanentDelete(itemId, itemName) {
    Swal.fire({
        title: '<?php echo Lang::T('Are you sure?');?>
',
        text: "<?php echo Lang::T('This action will permanently delete');?>
 " + itemName + ". <?php echo Lang::T('You will not be able to recover this item!');?>
",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<?php echo Lang::T('Yes, delete it!');?>
'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
recycle/delete/" + itemId;
        }
    });
}

function confirmEmptyRecycleBin() {
    Swal.fire({
        title: '<?php echo Lang::T('Are you sure?');?>
',
        text: "<?php echo Lang::T('This action will permanently delete all items in the recycle bin. You will not be able to recover them!');?>
",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<?php echo Lang::T('Yes, empty it!');?>
'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
recycle/empty";
        }
    });
}
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
