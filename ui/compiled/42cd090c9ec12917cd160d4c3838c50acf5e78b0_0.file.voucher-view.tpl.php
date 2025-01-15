<?php
/* Smarty version 4.3.1, created on 2024-06-11 16:37:51
  from 'F:\xampp\htdocs\radius\ui\themes\nova\voucher-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6668532f590c83_40858301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42cd090c9ec12917cd160d4c3838c50acf5e78b0' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\voucher-view.tpl',
      1 => 1711311804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6668532f590c83_40858301 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-md-offset-3">
        <div class="panel panel-hovered panel-primary panel-stacked mb30">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/print" target="_blank">
                    <pre id="content"></pre>
                    <textarea class="hidden" id="formcontent" name="content"><?php echo $_smarty_tpl->tpl_vars['print']->value;?>
</textarea>
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['in']->value['id'];?>
">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/voucher" class="btn btn-primary btn-sm"><i
                            class="ion-reply-all"></i><?php echo Lang::T('Finish');?>
</a>
                    <a href="https://api.whatsapp.com/send/?text=<?php echo $_smarty_tpl->tpl_vars['wa']->value;?>
" target="_blank" class="btn btn-info text-black btn-sm"><i
                            class="glyphicon glyphicon-envelope"></i> <?php echo Lang::T("Send To Customer");?>
</a>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-print"></i>
                        <?php echo Lang::T('Click Here to Print');?>
</button>
                </form>
                <javascript type="text/javascript">
                </javascript>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
    document.getElementById('content').innerHTML = document.getElementById('formcontent').innerHTML;
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
