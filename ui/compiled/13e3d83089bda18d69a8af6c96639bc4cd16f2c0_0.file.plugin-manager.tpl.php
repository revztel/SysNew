<?php
/* Smarty version 4.3.1, created on 2024-10-03 15:35:19
  from 'F:\xampp\htdocs\radius\ui\themes\nova\plugin-manager.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fe8f879fb2f3_78855312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13e3d83089bda18d69a8af6c96639bc4cd16f2c0' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\plugin-manager.tpl',
      1 => 1705528239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66fe8f879fb2f3_78855312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary panel-hovered">
            <div class="panel-heading"><?php echo Lang::T('Plugin');?>
</div>
            <div class="panel-body row">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plugins']->value, 'plugin');
$_smarty_tpl->tpl_vars['plugin']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plugin']->value) {
$_smarty_tpl->tpl_vars['plugin']->do_else = false;
?>
                    <div class="col-md-4">
                        <div class="box box-hovered mb20 box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $_smarty_tpl->tpl_vars['plugin']->value['name'];?>
</h3>
                            </div>
                            <div class="box-body"><?php echo $_smarty_tpl->tpl_vars['plugin']->value['description'];?>
<br><small><i>@<?php echo $_smarty_tpl->tpl_vars['plugin']->value['author'];?>
 Last update: <?php echo $_smarty_tpl->tpl_vars['plugin']->value['last_update'];?>
</i></small></div>
                            <div class="box-footer ">
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['plugin']->value['url'];?>
" target="_blank"
                                        class="btn btn-primary"><i class="ion ion-chatboxes"></i> Website</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['plugin']->value['github'];?>
" target="_blank"
                                        class="btn btn-success"><i class="ion ion-chatboxes"></i> Github</a>
                                    <a <?php if ($_smarty_tpl->tpl_vars['zipExt']->value) {?>
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pluginmanager/install/plugin/<?php echo $_smarty_tpl->tpl_vars['plugin']->value['id'];?>
" onclick="return confirm('Installing plugin will take some time to complete, do not close the page while it loading to install the plugin')"
                                        <?php } else { ?>
                                            href="#" onclick="alert('PHP ZIP extension is not available')"
                                        <?php }?>
                                        class="btn btn-warning"><i class="ion ion-chatboxes"></i> Install</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
        <div class="panel panel-primary panel-hovered">
            <div class="panel-heading"><?php echo Lang::T('Payment Gateway');?>
</div>
            <div class="panel-body row">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pgs']->value, 'pg');
$_smarty_tpl->tpl_vars['pg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pg']->value) {
$_smarty_tpl->tpl_vars['pg']->do_else = false;
?>
                    <div class="col-md-4">
                        <div class="box box-hovered mb20 box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $_smarty_tpl->tpl_vars['pg']->value['name'];?>
</h3>
                            </div>
                            <div class="box-body"><?php echo $_smarty_tpl->tpl_vars['pg']->value['description'];?>
<br><small><i>@<?php echo $_smarty_tpl->tpl_vars['plugin']->value['author'];?>
 Last update: <?php echo $_smarty_tpl->tpl_vars['plugin']->value['last_update'];?>
</i></small></div>
                            <div class="box-footer ">
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['pg']->value['url'];?>
" target="_blank"
                                        class="btn btn-primary"><i class="ion ion-chatboxes"></i> Website</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['pg']->value['github'];?>
" target="_blank"
                                        class="btn btn-success"><i class="ion ion-chatboxes"></i> Github</a>
                                        <a <?php if ($_smarty_tpl->tpl_vars['zipExt']->value) {?>
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pluginmanager/install/payment/<?php echo $_smarty_tpl->tpl_vars['pg']->value['id'];?>
" onclick="return confirm('Installing plugin will take some time to complete, do not close the page while it loading to install the plugin')"
                                        <?php } else { ?>
                                            href="#" onclick="alert('PHP ZIP extension is not available')"
                                        <?php }?>
                                        class="btn btn-warning"><i class="ion ion-chatboxes"></i> Install</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </div>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
