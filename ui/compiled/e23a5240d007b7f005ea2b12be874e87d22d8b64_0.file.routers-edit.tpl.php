<?php
/* Smarty version 4.3.1, created on 2024-12-30 20:57:31
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6772df0b81e329_05030963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e23a5240d007b7f005ea2b12be874e87d22d8b64' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers-edit.tpl',
      1 => 1717784964,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6772df0b81e329_05030963 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- routers-edit -->

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Edit Router');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/edit-post" >
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('Status');?>
</label>
                            <div class="col-md-10">
                                <label class="radio-inline warning">
                                    <input type="radio" <?php if ($_smarty_tpl->tpl_vars['d']->value['enabled'] == 1) {?>checked<?php }?> name="enabled" value="1"> Enable
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" <?php if ($_smarty_tpl->tpl_vars['d']->value['enabled'] == 0) {?>checked<?php }?> name="enabled" value="0"> Disable
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('Router Name');?>
</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
">
                                <p class="help-block"><?php echo Lang::T('Name of Area that router operated');?>
</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('IP Address');?>
</label>
                            <div class="col-md-6">
                                <input type="text" placeholder="192.168.88.1:8728" class="form-control" id="ip_address" name="ip_address" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['ip_address'];?>
">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('Username');?>
</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
">
                            </div>
                        </div>
                        <div class="form-group">
                                   <label class="col-md-2 control-label"><?php echo Lang::T('Router Secret');?>
</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['password'];?>
" onmouseleave="this.type = 'password'"
                                onmouseenter="this.type = 'text'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo Lang::T('Description');?>
</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description"><?php echo $_smarty_tpl->tpl_vars['d']->value['description'];?>
</textarea>
                                <p class="help-block"><?php echo Lang::T('Explain Coverage of router');?>
</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
             Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list"><?php echo Lang::T('Cancel');?>
</a>
                            </div>
                        </div>
                    </form>
                </div>
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
