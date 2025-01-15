<?php
/* Smarty version 4.3.1, created on 2024-11-22 17:23:15
  from 'F:\xampp\htdocs\radius\ui\themes\nova\reports-period-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_674093d3b69418_07042297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74a9398da14d45356b102a7f3b00d4a251821ce3' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\reports-period-view.tpl',
      1 => 1732285090,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_674093d3b69418_07042297 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- reports-period-view -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h3 class="text-uppercase text-bold">
                    <i class="fa fa-calendar-alt"></i> <?php echo Lang::T('Period Reports');?>

                </h3>
                <p class="small" style="color: #fff;">
                    <?php echo Lang::T('All Transactions at Date');?>
: 
                    <?php echo $_smarty_tpl->tpl_vars['stype']->value;?>
 [<?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['fdate']->value));?>
 - <?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['tdate']->value));?>
]
                </p>
            </div>
            <div class="panel-body">
                <div class="clearfix mb20">
                    <div class="pull-left">
                        <h5 class="text-bold mb5"><?php echo Lang::T('All Transactions');?>
:</h5>
                        <p><?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['fdate']->value));?>
 - <?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['tdate']->value));?>
</p>
                    </div>
                    <div class="pull-right">
                        <!-- Export to Print -->
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
export/print-by-period" target="_blank" class="d-inline-block">
                            <input type="hidden" name="fdate" value="<?php echo $_smarty_tpl->tpl_vars['fdate']->value;?>
">
                            <input type="hidden" name="tdate" value="<?php echo $_smarty_tpl->tpl_vars['tdate']->value;?>
">
                            <input type="hidden" name="stype" value="<?php echo $_smarty_tpl->tpl_vars['stype']->value;?>
">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-print"></i> <?php echo Lang::T('Export for Print');?>

                            </button>
                        </form>
                        <!-- Export to PDF -->
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
export/pdf-by-period" target="_blank" class="d-inline-block">
                            <input type="hidden" name="fdate" value="<?php echo $_smarty_tpl->tpl_vars['fdate']->value;?>
">
                            <input type="hidden" name="tdate" value="<?php echo $_smarty_tpl->tpl_vars['tdate']->value;?>
">
                            <input type="hidden" name="stype" value="<?php echo $_smarty_tpl->tpl_vars['stype']->value;?>
">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-file-pdf-o"></i> <?php echo Lang::T('Export to PDF');?>

                            </button>
                        </form>
                    </div>
                </div>

                <!-- Transactions Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead style="background-color: #f8f9fa; color: #000;">
                            <tr>
                                <th><?php echo Lang::T('Username');?>
</th>
                                <th><?php echo Lang::T('Type');?>
</th>
                                <th><?php echo Lang::T('Plan Name');?>
</th>
                                <th class="text-right"><?php echo Lang::T('Plan Price');?>
</th>
                                <th><?php echo Lang::T('Created On');?>
</th>
                                <th><?php echo Lang::T('Expires On');?>
</th>
                                <th><?php echo Lang::T('Method');?>
</th>
                                <th><?php echo Lang::T('Routers');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                    <td class="text-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                    <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>
</td>
                                    <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>

                <!-- Total Income -->
                <div class="clearfix text-right total-sum mt20">
                    <h4 class="text-uppercase text-bold"><?php echo Lang::T('Total Income');?>
:</h4>
                    <h3 class="text-primary"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['dr']->value);?>
</h3>
                </div>

                <!-- Footer Note -->
                <p class="text-center small text-info mt20">
                    <?php echo Lang::T('Transactions for');?>
 <?php echo $_smarty_tpl->tpl_vars['stype']->value;?>
 [<?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['fdate']->value));?>
 - <?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['tdate']->value));?>
]
                </p>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
