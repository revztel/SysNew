<?php
/* Smarty version 4.3.1, created on 2024-09-03 23:42:11
  from 'F:\xampp\htdocs\radius\ui\themes\nova\app-localisation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66d774a3a70d94_95665514',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60c9c2c40a5aff78d2d72055ae5e2444fca8beed' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\app-localisation.tpl',
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
function content_66d774a3a70d94_95665514 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Localisation');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
            <div class="panel-body">

                <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/localisation-post">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Timezone');?>
</label>
                        <div class="col-md-6">
                            <select name="tzone" id="tzone" class="form-control">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tlist']->value, 'label', false, 'value');
$_smarty_tpl->tpl_vars['label']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value => $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['_c']->value['timezone'] == $_smarty_tpl->tpl_vars['value']->value) {?>selected="selected" <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Date Format');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="date_format" id="date_format">
                                <option value="d/m/Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'd/m/Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('d/m/Y');?>
</option>
                                <option value="d.m.Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'd.m.Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('d.m.Y');?>
</option>
                                <option value="d-m-Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'd-m-Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('d-m-Y');?>
</option>
                                <option value="m/d/Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'm/d/Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('m/d/Y');?>
</option>
                                <option value="Y/m/d" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'Y/m/d') {?> selected="selected" <?php }?>>
                                    <?php echo date('Y/m/d');?>
</option>
                                <option value="Y-m-d" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'Y-m-d') {?> selected="selected" <?php }?>>
                                    <?php echo date('Y-m-d');?>
</option>
                                <option value="M d Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'M d Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('M d Y');?>
</option>
                                <option value="d M Y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'd M Y') {?> selected="selected" <?php }?>>
                                    <?php echo date('d M Y');?>
</option>
                                <option value="jS M y" <?php if ($_smarty_tpl->tpl_vars['_c']->value['date_format'] == 'jS M y') {?> selected="selected" <?php }?>>
                                    <?php echo date('jS M y');?>
</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Default Language');?>
</label>
                        <div class="col-md-6">
                            <select class="form-control" name="lan" id="lan">
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lani']->value, 'lanis');
$_smarty_tpl->tpl_vars['lanis']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lanis']->key => $_smarty_tpl->tpl_vars['lanis']->value) {
$_smarty_tpl->tpl_vars['lanis']->do_else = false;
$__foreach_lanis_1_saved = $_smarty_tpl->tpl_vars['lanis'];
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['lanis']->key;?>
" <?php if ($_smarty_tpl->tpl_vars['_c']->value['language'] == $_smarty_tpl->tpl_vars['lanis']->key) {?> selected="selected" <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['lanis']->key;?>

                                    </option>
                                <?php
$_smarty_tpl->tpl_vars['lanis'] = $__foreach_lanis_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <option disabled>_________</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lan']->value, 'lans');
$_smarty_tpl->tpl_vars['lans']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lans']->key => $_smarty_tpl->tpl_vars['lans']->value) {
$_smarty_tpl->tpl_vars['lans']->do_else = false;
$__foreach_lans_2_saved = $_smarty_tpl->tpl_vars['lans'];
?>
                                                                   <option value="<?php echo $_smarty_tpl->tpl_vars['lans']->key;?>
" <?php if ($_smarty_tpl->tpl_vars['_c']->value['language'] == $_smarty_tpl->tpl_vars['lans']->key) {?> selected="selected" <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['lans']->key;?>

                                    </option>
                                <?php
$_smarty_tpl->tpl_vars['lans'] = $__foreach_lans_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                        <div class="col-md-4 help-block">
                             <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/language"><?php echo Lang::T('Language Editor');?>
</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Decimal Point');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="dec_point" name="dec_point"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['dec_point'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Thousands Separator');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="thousands_sep" name="thousands_sep"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['thousands_sep'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Currency Code');?>
</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="currency_code" name="currency_code"
                                value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
">
                        </div>
                       <span
                            class="help-block col-md-4"><?php echo Lang::T('Keep it blank if you do not want to show currency code');?>
</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo Lang::T('Country Code Phone');?>
</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">+</span>
                                <input type="text" class="form-control" id="country_code_phone" placeholder="62"
                                    name="country_code_phone" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];?>
">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Radius Plan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="radius_plan" name="radius_plan"
                                value="<?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_plan'] == '') {?>Radius Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['radius_plan'];
}?>">
                        </div>
                        <span class="help-block col-md-4"><?php echo Lang::T('Change title in user Plan order');?>
</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Hotspot Plan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="hotspot_plan" name="hotspot_plan"
                                value="<?php if ($_smarty_tpl->tpl_vars['_c']->value['hotspot_plan'] == '') {?>Hotspot Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['hotspot_plan'];
}?>">
                        </div>
                        <span class="help-block col-md-4"><?php echo Lang::T('Change title in user Plan order');?>
</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">PPPOE Plan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="pppoe_plan" name="pppoe_plan"
                                value="<?php if ($_smarty_tpl->tpl_vars['_c']->value['pppoe_plan'] == '') {?>PPPOE Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['pppoe_plan'];
}?>">
                        </div>
                        <span class="help-block col-md-4"><?php echo Lang::T('Change title in user Plan order');?>
</span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary"
                               type="submit"><?php echo Lang::T('Save Changes');?>
</button>
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
