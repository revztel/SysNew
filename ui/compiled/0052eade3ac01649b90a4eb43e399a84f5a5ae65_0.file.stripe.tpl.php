<?php
/* Smarty version 4.3.1, created on 2024-07-14 18:22:54
  from 'F:\xampp\htdocs\radius\system\paymentgateway\ui\stripe.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6693ed4e5f6f95_88797083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0052eade3ac01649b90a4eb43e399a84f5a5ae65' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\paymentgateway\\ui\\stripe.tpl',
      1 => 1720970538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6693ed4e5f6f95_88797083 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/stripe">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Stripe Payment Gateway</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Publishable Key (Public)</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="stripe_api_key" name="stripe_api_key"
                                value="<?php echo $_smarty_tpl->tpl_vars['stripe_api_key']->value;?>
">
                            <a href="https://dashboard.stripe.com/apikeys" target="_blank"
                                class="help-block">Get your Stripe Publishable Key from the Stripe Dashboard</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Secret Key (Private)</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="stripe_secret_key" name="stripe_secret_key"
                                value="<?php echo $_smarty_tpl->tpl_vars['stripe_secret_key']->value;?>
">
                            <a href="https://dashboard.stripe.com/apikeys" target="_blank"
                                class="help-block">Get your Stripe Secret Key from the Stripe Dashboard</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Currency</label>
                        <div class="col-md-6">
                            <select class="form-control" name="stripe_currency">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currency']->value, 'cur');
$_smarty_tpl->tpl_vars['cur']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cur']->value) {
$_smarty_tpl->tpl_vars['cur']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cur']->value['id'];?>
"
                                    <?php if ($_smarty_tpl->tpl_vars['cur']->value['id'] == $_smarty_tpl->tpl_vars['stripe_currency']->value) {?>selected<?php }?>
                                    ><?php echo $_smarty_tpl->tpl_vars['cur']->value['id'];?>
 - <?php echo $_smarty_tpl->tpl_vars['cur']->value['name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                            <small class="form-text text-muted">Select the currency for transactions (e.g., USD, EUR).</small>
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
