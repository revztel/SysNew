<?php
/* Smarty version 4.3.1, created on 2024-04-20 16:39:45
  from 'F:\xampp\htdocs\radius\ui\themes\nova\page-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6623c5a1dd4687_41156963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf2b3293aa38605c239f04f984b1f3a72625424e' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\page-edit.tpl',
      1 => 1710964295,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6623c5a1dd4687_41156963 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel mb20 panel-primary panel-hovered">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a class="btn btn-danger btn-xs" title="Reset File" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/<?php echo $_smarty_tpl->tpl_vars['PageFile']->value;?>
-reset" onclick="return confirm('Reset File?')"><span
                            class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['pageHeader']->value;?>

            </div>
            <div id="myNicPanel" style="width: 100%;"></div>
            <div id="panel-edit" class="panel-body"><?php echo $_smarty_tpl->tpl_vars['htmls']->value;?>
</div>
            <?php if ($_smarty_tpl->tpl_vars['writeable']->value) {?>
                <div class="panel-footer">
                    <a href="javascript:saveIt()" class="btn btn-primary btn-block">SAVE</a>
                    <br>
                    <p class="help-block"><?php echo Lang::T('info Page');?>
</p>
                    <input type="text" class="form-control" onclick="this.select()" readonly
                        value="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/pages/<?php echo $_smarty_tpl->tpl_vars['PageFile']->value;?>
.html">
                </div>
            <?php } else { ?>
                <div class="panel-footer">
                    <?php echo Lang::T('Failed to Save Pages');?>

                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['PageFile']->value == 'Voucher') {?>
                <div class="panel-footer">
                    <p class="help-block">
                        <b>[[company_name]]</b> Your Company Name at Settings.<br>
                        <b>[[price]]</b> Plan Price.<br>
                        <b>[[voucher_code]]</b> Voucher Code.<br>
                        <b>[[plan]]</b> Voucher Plan.<br>
                        <b>[[counter]]</b> Counter.<br>
                    </p>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<form id="formpages" class="hidden" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/<?php echo $_smarty_tpl->tpl_vars['PageFile']->value;?>
-post">
    <textarea name="html" id="html"></textarea>
</form>
<?php echo '<script'; ?>
 src="ui/ui/scripts/nicEdit.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript">
        var myNicEditor
        bkLib.onDomLoaded(function() {
            myNicEditor = new nicEditor({fullPanel : true});
            myNicEditor.setPanel('myNicPanel');
            myNicEditor.addInstance('panel-edit');
        });

        function saveIt() {
            //alert(document.getElementById('panel-edit').innerHTML);
            document.getElementById('html').value = nicEditors.findEditor('panel-edit').getContent()
            document.getElementById('formpages').submit();
        }
    <?php echo '</script'; ?>
>


<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
