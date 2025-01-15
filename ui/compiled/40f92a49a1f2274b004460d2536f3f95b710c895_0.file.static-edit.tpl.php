<?php
/* Smarty version 4.3.1, created on 2024-06-12 00:46:50
  from 'F:\xampp\htdocs\radius\ui\themes\nova\static-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6668c5ca4799f1_12417301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40f92a49a1f2274b004460d2536f3f95b710c895' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\static-edit.tpl',
      1 => 1717784289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6668c5ca4799f1_12417301 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
          <div class="panel-heading"><?php echo Lang::T('Edit Service Plan');?>
 || <?php echo $_smarty_tpl->tpl_vars['d']->value['name_plan'];?>
</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/edit-static-post/">
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
                                <input type="radio" <?php if ($_smarty_tpl->tpl_vars['d']->value['enabled'] == 0) {?>checked<?php }?> name="enabled" value="0">
                                Disable
                            </label>
                        </div>
                    </div>
      <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Client Can Purchase');?>
</label>
                        <div class="col-md-10">
                            <label class="radio-inline warning">
                                <input type="radio" <?php if ($_smarty_tpl->tpl_vars['d']->value['allow_purchase'] == 'yes') {?>checked<?php }?> name="allow_purchase" value="yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" <?php if ($_smarty_tpl->tpl_vars['d']->value['allow_purchase'] == 'no') {?>checked<?php }?> name="allow_purchase" value="no">
                                No
                            </label>
                        </div>
                    </div>

                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable'] && $_smarty_tpl->tpl_vars['d']->value['is_radius']) {?>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Radius</label>
                            <div class="col-md-10">
                                <label class="label label-primary">RADIUS</label>
                            </div>
                        </div>
                    <?php }?>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Plan Name');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name_plan" maxlength="40" name="name_plan"
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name_plan'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><a
                                href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bandwidth/add"><?php echo Lang::T('Bandwidth Name');?>
</a></label>
                        <div class="col-md-6">
                            <select id="id_bw" name="id_bw" class="form-control select2">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['b']->value, 'bs');
$_smarty_tpl->tpl_vars['bs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bs']->value) {
$_smarty_tpl->tpl_vars['bs']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['bs']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value['id_bw'] == $_smarty_tpl->tpl_vars['bs']->value['id']) {?> selected <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['bs']->value['name_bw'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Plan Price');?>
</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
</span>
                                <input type="number" class="form-control" name="price" required value="<?php echo $_smarty_tpl->tpl_vars['d']->value['price'];?>
">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Plan Validity');?>
</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="validity" name="validity"
                                value="<?php echo $_smarty_tpl->tpl_vars['d']->value['validity'];?>
">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="validity_unit" name="validity_unit">
                                <option value="Mins" <?php if ($_smarty_tpl->tpl_vars['d']->value['validity_unit'] == 'Mins') {?> selected <?php }?>><?php echo Lang::T('Mins');?>

                                </option>
                                <option value="Hrs" <?php if ($_smarty_tpl->tpl_vars['d']->value['validity_unit'] == 'Hrs') {?> selected <?php }?>><?php echo Lang::T('Hrs');?>

                                </option>
                                <option value="Days" <?php if ($_smarty_tpl->tpl_vars['d']->value['validity_unit'] == 'Days') {?> selected <?php }?>><?php echo Lang::T('Days');?>

                                </option>
                                <option value="Months" <?php if ($_smarty_tpl->tpl_vars['d']->value['validity_unit'] == 'Months') {?> selected <?php }?>>
                                    <?php echo Lang::T('Months');?>
</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                                               <label class="col-md-2 control-label"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pool/add"><?php echo Lang::T('IP Pool');?>
</a></label>
                        <div class="col-md-6">
                            <select id="pool_name" name="pool_name" required class="form-control select2">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['p']->value, 'ps');
$_smarty_tpl->tpl_vars['ps']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ps']->value) {
$_smarty_tpl->tpl_vars['ps']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ps']->value['pool_name'];?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value['pool'] == $_smarty_tpl->tpl_vars['ps']->value['pool_name']) {?> selected <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['ps']->value['pool_name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Router Name');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="routers" name="routers" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['routers'];?>
"
                                readonly>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success"
                               type="submit"><?php echo Lang::T('Save Changes');?>
</button>
                              Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/static"><?php echo Lang::T('Cancel');?>
</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable'] && $_smarty_tpl->tpl_vars['d']->value['is_radius']) {?>
    
        <?php echo '<script'; ?>
>
            document.getElementById("routers").required = false;
            document.getElementById("routers").disabled = true;
            setTimeout(() => {
                $.ajax({
                    url: "index.php?_route=autoload/pool",
                    data: "routers=radius",
                    cache: false,
                    success: function(msg) {
                        $("#pool_expired").html(msg);
                    }
                });
            }, 2000);
        <?php echo '</script'; ?>
>
    
<?php }?>

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
