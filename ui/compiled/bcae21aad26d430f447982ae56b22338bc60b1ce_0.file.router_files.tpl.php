<?php
/* Smarty version 4.3.1, created on 2024-09-19 00:48:31
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_files.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb4aaf98eea2_72765437',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcae21aad26d430f447982ae56b22338bc60b1ce' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_files.tpl',
      1 => 1726696067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb4aaf98eea2_72765437 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Files Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Files Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_files/list/">
                    <div class="form-group">
                        <label for="router_id"><?php echo Lang::T('Select Router');?>
</label>
                        <select name="router_id" id="router_id" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['selected_router']->value)) && $_smarty_tpl->tpl_vars['selected_router']->value['id'] == $_smarty_tpl->tpl_vars['router']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Files');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['files']->value))) {?>
                <h3><?php echo Lang::T('Files on');?>
 <?php echo $_smarty_tpl->tpl_vars['selected_router']->value['name'];?>
</h3>

                <!-- File Upload Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_files/upload" enctype="multipart/form-data" id="file-upload-form">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                    <div class="form-group">
                        <label><?php echo Lang::T('Destination Directory');?>
</label>
                        <select name="destination_path" class="form-control" id="destination_path">
                            <option value=""><?php echo Lang::T('Root Directory');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['directories']->value, 'directory');
$_smarty_tpl->tpl_vars['directory']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['directory']->value) {
$_smarty_tpl->tpl_vars['directory']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['directory']->value['path'];?>
">/<?php echo $_smarty_tpl->tpl_vars['directory']->value['path'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo Lang::T('Upload Files or Folders');?>
</label>
                        <div id="drop-zone" class="drop-zone">
                            <p><?php echo Lang::T('Drag & drop files or folders here or click to select');?>
</p>
                            <input type="file" name="files[]" id="file-input" multiple webkitdirectory directory>
                        </div>
                    </div>
                    <!-- Upload button is optional since form submits automatically -->
                    <!-- <button type="submit" class="btn btn-success"><?php echo Lang::T('Upload Files');?>
</button> -->
                </form>

                <!-- File List -->
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('ID');?>
</th>
                            <th><?php echo Lang::T('Name');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Size');?>
</th>
                            <th><?php echo Lang::T('Creation Time');?>
</th>
                            <th><?php echo Lang::T('Actions');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'file');
$_smarty_tpl->tpl_vars['file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['file']->value['type'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['file']->value['size'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['file']->value['creation_time'];?>
</td>
                            <td>
                                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_files/delete" style="display:inline;">
                                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                    <input type="hidden" name="file_name" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
">
                                    <button type="submit" class="btn btn-danger btn-xs"><?php echo Lang::T('Delete');?>
</button>
                                </form>
                            </td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<!-- Drag and Drop Script -->
<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', function() {
    var dropZone = document.getElementById('drop-zone');
    var fileInput = document.getElementById('file-input');
    var uploadForm = document.getElementById('file-upload-form');

    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        uploadForm.submit();
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        uploadForm.submit();
    });
});
<?php echo '</script'; ?>
>

<!-- Styles for Drag and Drop -->
<style>
.drop-zone {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
}

.drop-zone.dragover {
    background-color: #eee;
}
</style>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
