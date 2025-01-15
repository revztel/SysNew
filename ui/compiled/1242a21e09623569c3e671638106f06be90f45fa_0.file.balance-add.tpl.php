<?php
/* Smarty version 4.3.1, created on 2024-07-28 16:25:29
  from 'F:\xampp\htdocs\radius\ui\themes\nova\balance-add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a646c902d5c0_38895455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1242a21e09623569c3e671638106f06be90f45fa' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\balance-add.tpl',
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
function content_66a646c902d5c0_38895455 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Add Service Plan');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
						<div class="panel-body">
                        <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/balance-add-post" >
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo Lang::T('Status');?>
</label>
                                <div class="col-md-10">
                                    <label class="radio-inline warning">
                                        <input type="radio" checked name="enabled" value="1"> Enable
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="enabled" value="0"> Disable
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
																<label class="col-md-2 control-label"><?php echo Lang::T('Client Can Purchase');?>
</label>
																<div class="col-md-10">
																		<label class="radio-inline warning">
																				<input type="radio" checked name="allow_purchase" value="yes"> Yes
																		</label>
																		<label class="radio-inline">
																				<input type="radio" name="allow_purchase" value="no"> No
																		</label>
																</div>
														</div>
                            <div class="form-group">
                                 <label class="col-md-2 control-label"><?php echo Lang::T('Plan Name');?>
</label>
                                <div class="col-md-6">
                                    <input type="text" required class="form-control" id="name" name="name" maxlength="40" placeholder="Topup 100">
                                </div>
                            </div>
                            <div class="form-group">
                               <label class="col-md-2 control-label"><?php echo Lang::T('Plan Price');?>
</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
</span>
                                        <input type="number" class="form-control" name="price" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                                    Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/balance"><?php echo Lang::T('Cancel');?>
</a>
                                </div>
                            </div>
                        </form>
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/M91aZf1wrEw?si=f3cxhNtD6wDbMBwz" allowfullscreen></iframe>
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
