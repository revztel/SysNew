<?php
/* Smarty version 4.3.1, created on 2025-01-08 22:13:17
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\bankstkpush.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677ece4ddb7500_33947035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63d40e4fea8487d079bfe420d1a801d1cf99b1a4' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\bankstkpush.tpl',
      1 => 1727881253,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677ece4ddb7500_33947035 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/BankStkPush" >
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Fill the details below to complete the bank stk Push</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Enter Bank account number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kopokopo_app_key" name="account" placeholder="*************************" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['Stkbankacc'];?>
">
                           
                        </div>
                    </div>
                   
					<div class="form-group">
                        <label class="col-md-2 control-label">Bank Name</label>
                        <div class="col-md-6">
                          <select class="form-control" name="bankname" id="bankstk">
                            <option value="Equity"  <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Equity') {?>selected<?php }?>>Equity bank</option>
                            <option value="KCB" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'KCB') {?>selected<?php }?>>Kenya Commercial Bank</option>
                            <option value="Coop" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Coop') {?>selected<?php }?>>Cooperative Bank of Kenya</option>
                            <option value="Absa" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Absa') {?>selected<?php }?>>Absa Bank Kenya</option>
                            <option value="DTB" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Dtb') {?>selected<?php }?>>Diamond Trust Bank (DTB)</option>
                            <option value="NCBA" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'NCBA') {?>selected<?php }?>>NCBA Bank</option>
                            
                              <!-- New Banks Added Below -->
                                <option value="StandardChartered" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'StandardChartered') {?>selected<?php }?>>Standard Chartered Bank</option>
                                <option value="Barclays" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Barclays') {?>selected<?php }?>>Barclays Bank Kenya</option>
                                <option value="Family" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Family') {?>selected<?php }?>>Family Bank Ltd</option>
                                <option value="KCB_Business" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'KCB_Business') {?>selected<?php }?>>KCB Business</option>
                                <option value="Custom" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'Custom') {?>selected<?php }?>>Custom Bank</option>
                            
                            
                            <!-- New Banks Added Below -->
                                <option value="National" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'National') {?>selected<?php }?>>National Bank of Kenya</option>
                                <option value="IM" <?php if ($_smarty_tpl->tpl_vars['_c']->value['Stkbankname'] == 'IM') {?>selected<?php }?>>I&M Bank</option>
                            
                            
                            
                          </select>

                        </div>
                    </div>
<pre>After aplying these changes, the funds shall be going to the saved bank account, please make sure the bank name and account matches</pre>
                   
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                        </div>
                    </div>
                        
            </div>

        </div>
    </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
