<?php
/* Smarty version 4.3.1, created on 2024-05-08 01:31:41
  from 'F:\xampp\htdocs\radius\ui\themes\nova\bandwidth-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_663aabcd526da4_76437151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7615c74ba42ea36756ee4bcfff7c662c0535af32' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\bandwidth-edit.tpl',
      1 => 1711453141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_663aabcd526da4_76437151 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="panel panel-primary panel-hovered panel-stacked mb30">
			<div class="panel-heading"><?php echo Lang::T('Edit Bandwidth');?>
</div>
			<div class="panel-body">

				<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bandwidth/edit-post">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Bandwidth Name');?>
</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name_bw'];?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Rate Download');?>
</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rate_down" name="rate_down"
								value="<?php echo $_smarty_tpl->tpl_vars['d']->value['rate_down'];?>
">
						</div>
						<div class="col-md-2">
							<select class="form-control" id="rate_down_unit" name="rate_down_unit">
								<option value="Kbps" <?php if ($_smarty_tpl->tpl_vars['d']->value['rate_down_unit'] == 'Kbps') {?>selected="selected" <?php }?>>Kbps
								</option>
								<option value="Mbps" <?php if ($_smarty_tpl->tpl_vars['d']->value['rate_down_unit'] == 'Mbps') {?>selected="selected" <?php }?>>Mbps
								</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"><?php echo Lang::T('Rate Upload');?>
</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="rate_up" name="rate_up" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['rate_up'];?>
">
						</div>
						<div class="col-md-2">
							<select class="form-control" id="rate_up_unit" name="rate_up_unit">
								<option value="Kbps" <?php if ($_smarty_tpl->tpl_vars['d']->value['rate_up_unit'] == 'Kbps') {?>selected="selected" <?php }?>>Kbps
								</option>
								<option value="Mbps" <?php if ($_smarty_tpl->tpl_vars['d']->value['rate_up_unit'] == 'Mbps') {?>selected="selected" <?php }?>>Mbps
								</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Burst Limit</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="burst[]" placeholder="[Burst/Limit]" value="<?php echo $_smarty_tpl->tpl_vars['burst']->value[0];?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Burst Threshold</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="burst[]" placeholder="[Burst/Threshold]" value="<?php echo $_smarty_tpl->tpl_vars['burst']->value[1];?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Burst Time</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="burst[]" placeholder="[Burst/Time]" value="<?php echo $_smarty_tpl->tpl_vars['burst']->value[2];?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Priority</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="burst[]" placeholder="[Priority]" value="<?php echo $_smarty_tpl->tpl_vars['burst']->value[3];?>
">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Limit At</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="burst[]" placeholder="[Limit/At]" value="<?php echo $_smarty_tpl->tpl_vars['burst']->value[4];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
					<small><?php echo Lang::T('Editing Bandwidth will not automatically update the plan, you need to edit the plan then save again');?>
</small>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-primary"
								type="submit"><?php echo Lang::T('Submit');?>
</button>
							Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bandwidth/list"><?php echo Lang::T('Cancel');?>
</a>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
