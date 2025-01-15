<?php
/* Smarty version 4.3.1, created on 2024-07-28 16:43:00
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-sendPlan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a64ae412c955_19834373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70b9ae491546c640deb6b952d05a82ee58027590' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-sendPlan.tpl',
      1 => 1710881706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_66a64ae412c955_19834373 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-orderView -->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-solid box-default">
            <div class="box-header"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><?php echo Lang::T('Type');?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo Lang::T('Price');?>
</td>
                            <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo Lang::T('Validity');?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <form method="post" onsubmit="return askConfirm()" role="form">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input type="text" id="username" name="username" class="form-control" required value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
"
                                placeholder="<?php echo Lang::T('Username');?>
">
                        </div>
                        <div class="form-group col-sm-3" align="center">
                            <button class="btn btn-success btn-block" id="sendBtn" type="submit" name="send" onclick="return confirm('<?php echo Lang::T("Are You Sure?");?>
')"
                                value="plan"><i class="glyphicon glyphicon-send"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
