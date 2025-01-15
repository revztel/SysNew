<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:51:49
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-selectGateway.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c475eb7932_69636940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c24035e26cd6ca1276dfb9fe12c1d6757535836' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-selectGateway.tpl',
      1 => 1722170733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771c475eb7932_69636940 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info panel-hovered">
            <div class="panel-heading"><?php echo Lang::T('Available Payment Gateway');?>
</div>
            <div class="panel-footer">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/pay_now">
                    <div class="form-group row">

                        <div class="col-md-8">
                            <select name="gateway" id="gateway" class="form-control">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pgs']->value, 'pg');
$_smarty_tpl->tpl_vars['pg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pg']->value) {
$_smarty_tpl->tpl_vars['pg']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
"><?php echo ucwords($_smarty_tpl->tpl_vars['pg']->value);?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <!-- Add hidden fields for router_id and plan_id -->
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['route2']->value;?>
">
                    <input type="hidden" name="plan_id" value="<?php echo $_smarty_tpl->tpl_vars['route3']->value;?>
">
            </div>
            <div class="panel-body">
                <center><b><?php echo Lang::T('Package Details');?>
</b></center>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Plan Name');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</span>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['plan']->value['is_radius'] || $_smarty_tpl->tpl_vars['plan']->value['routers']) {?>

                    <?php }?>

                    <li class="list-group-item">
                        <b><?php echo Lang::T('Plan Price');?>
</b> <span class="pull-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
</span>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['plan']->value['validity']) {?>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Plan Validity');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
</span>
                    </li>
                    <?php }?>
                </ul>
                <center><b><?php echo Lang::T('Summary');?>
</b></center>
                <ul class="list-group list-group-unbordered">
                    <?php if ($_smarty_tpl->tpl_vars['tax']->value) {?>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Tax');?>
</b> <span class="pull-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['tax']->value);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Total');?>
</b> <small>(<?php echo Lang::T('Plan Price');?>
 + <?php echo Lang::T('Tax');?>
)</small><span class="pull-right"
                            style="font-size: large; font-weight:bolder; font-family: 'Courier New', Courier, monospace;"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']+$_smarty_tpl->tpl_vars['tax']->value);?>
</span>
                    </li>
                    <?php } else { ?>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Total');?>
</b> <span class="pull-right"
                            style="font-size: large; font-weight:bolder; font-family: 'Courier New', Courier, monospace;">
                          <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
</span>
                    </li>
                    <?php }?>
                </ul>
                <center>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Pay Now');?>
</button><br>
                    <a class="btn btn-link" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home"><?php echo Lang::T('Cancel');?>
</a>
                </center>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
