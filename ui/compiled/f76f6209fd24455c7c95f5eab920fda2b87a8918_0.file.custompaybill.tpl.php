<?php
/* Smarty version 4.3.1, created on 2024-10-02 21:17:37
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\custompaybill.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fd8e41001ba8_38552796',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f76f6209fd24455c7c95f5eab920fda2b87a8918' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\custompaybill.tpl',
      1 => 1727882447,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66fd8e41001ba8_38552796 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/CustomPaybill">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Update Custom Bank Paybill</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Enter Paybill Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="paybill" placeholder="Enter Paybill Number" value="<?php echo $_smarty_tpl->tpl_vars['current_paybill']->value;?>
">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
