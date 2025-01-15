<?php
/* Smarty version 4.3.1, created on 2024-06-07 21:32:55
  from 'F:\xampp\htdocs\radius\ui\themes\nova\message.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6663525708cb85_49611652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a938eb824f5c61449388170c6e618f546151743' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\message.tpl',
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
function content_6663525708cb85_49611652 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Send Personal Message');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
			<div class="panel-body">
				<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send-post">
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Customer');?>
</label>
						<div class="col-md-6">
							<select <?php if ($_smarty_tpl->tpl_vars['cust']->value) {
} else { ?>id="personSelect" <?php }?> class="form-control select2"
								name="id_customer" style="width: 100%"
								data-placeholder="<?php echo Lang::T('Select a customer');?>
...">
								<?php if ($_smarty_tpl->tpl_vars['cust']->value) {?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['cust']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['cust']->value['username'];?>
 &bull; <?php echo $_smarty_tpl->tpl_vars['cust']->value['fullname'];?>
 &bull;
									<?php echo $_smarty_tpl->tpl_vars['cust']->value['email'];?>
</option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Send Via');?>
</label>
						<div class="col-md-6">
							<select class="form-control" name="via" id="via">
								<option value="sms" selected> <?php echo Lang::T('SMS');?>
</option>
								<option value="wa"> <?php echo Lang::T('WhatsApp');?>
</option>
								<option value="both"> <?php echo Lang::T('SMS and WhatsApp');?>
</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Message');?>
</label>
						<div class="col-md-6">
							<textarea class="form-control" id="message" name="message"
								placeholder="<?php echo Lang::T('Compose your message...');?>
" rows="5"></textarea>
						</div>
						<p class="help-block col-md-4">
							<?php echo Lang::T('Use placeholders:');?>

							<br>
							<b>[[name]]</b> - <?php echo Lang::T('Customer Name');?>

							<br>
							<b>[[user_name]]</b> - <?php echo Lang::T('Customer Username');?>

							<br>
							<b>[[phone]]</b> - <?php echo Lang::T('Customer Phone');?>

							<br>
							<b>[[company_name]]</b> - <?php echo Lang::T('Your Company Name');?>

						</p>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-success" type="submit"><?php echo Lang::T('Send Message');?>
</button>
							<a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="btn btn-default"><?php echo Lang::T('Cancel');?>
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
