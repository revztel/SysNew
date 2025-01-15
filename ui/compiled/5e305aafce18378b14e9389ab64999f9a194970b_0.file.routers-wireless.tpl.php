<?php
/* Smarty version 4.3.1, created on 2024-06-12 23:30:50
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers-wireless.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_666a057a010225_19121269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e305aafce18378b14e9389ab64999f9a194970b' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers-wireless.tpl',
      1 => 1718224245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_666a057a010225_19121269 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Wireless Settings');?>
</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    <?php echo Lang::T('Need Help?');?>

                </button>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="index.php?_route=routers/wireless">
                    <input type="hidden" name="action" value="select_router">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Select Router');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="router_id" onchange="this.form.submit()">
                                <option value=""><?php echo Lang::T('Select a Router');?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['selected_router']->value && $_smarty_tpl->tpl_vars['router']->value['id'] == $_smarty_tpl->tpl_vars['selected_router']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                </form>
                <?php if ($_smarty_tpl->tpl_vars['selected_router']->value) {?>
                <form class="form-horizontal" method="post" action="index.php?_route=routers/wireless">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Current SSID');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['current_ssid']->value;?>
" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('New SSID');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ssid" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('New Password');?>
</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-primary"><?php echo Lang::T('Update');?>
</button>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list" class="btn btn-default"><?php echo Lang::T('Cancel');?>
</a>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tQNY_TfIIQE?si=pu14iOtkGNa3sO59" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
