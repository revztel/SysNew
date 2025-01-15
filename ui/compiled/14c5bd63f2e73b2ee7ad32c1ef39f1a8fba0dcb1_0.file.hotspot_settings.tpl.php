<?php
/* Smarty version 4.3.1, created on 2025-01-10 12:48:07
  from 'F:\xampp\htdocs\radius\system\plugin\ui\hotspot_settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6780ecd731c081_76457918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14c5bd63f2e73b2ee7ad32c1ef39f1a8fba0dcb1' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\hotspot_settings.tpl',
      1 => 1736464759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6780ecd731c081_76457918 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <!-- Main Panel -->
        <div class="panel panel-hovered mb20 panel-primary">
            
            <!-- Panel Heading -->
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Left Title/Heading -->
                <span>
                    <i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot Settings');?>

                </span>
                
                <!-- Right Button Group -->
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot Settings');?>

                    </button>
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings">
                                <i class="fa fa-cog"></i> <?php echo Lang::T('General Settings');?>

                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/captive_portal_login" target="_blank">
                                <i class="fa fa-eye"></i> <?php echo Lang::T('Preview Hotspot Login Page');?>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/download.php?download=1" target="_blank">
                                <i class="fa fa-download"></i> <?php echo Lang::T('Download Login Page');?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Panel Body -->
            <div class="panel-body">
                
                <!-- Optional breadcrumb / download button row -->
                <div class="mb20 text-center">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/download.php?download=1" class="btn btn-info btn-lg">
                        <i class="fa fa-download"></i> <?php echo Lang::T('Click Here To Download Login Page');?>

                    </a>
                </div>
                
                <!-- Country Navigation Tabs -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <!-- Assume Kenya is the default/active tab -->
                            <li class="active">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings"><?php echo Lang::T('Kenya');?>
</a>
                            </li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_tanzania"><?php echo Lang::T('Tanzania');?>
</a></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_uganda"><?php echo Lang::T('Uganda');?>
</a></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_philippines"><?php echo Lang::T('Philippines');?>
</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Hotspot Settings Form -->
                <div class="row">
                    <div class="col-md-12">
                        
                        <!-- You can keep or remove this inner box if you want a simpler look -->
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                                <h3 class="box-title">
                                    <i class="fa fa-cog"></i> <?php echo Lang::T('General Settings');?>

                                </h3>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                                    <?php echo Lang::T('Need Help?');?>

                                </button>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
                                <div class="box-body">
                                    
                                    <!-- Hotspot Title -->
                                    <div class="form-group">
                                        <label for="hotspot_title" class="col-sm-2 control-label">
                                            <i class="fa fa-header"></i> <?php echo Lang::T('Hotspot Page Title');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-lg"
                                                   name="hotspot_title" id="hotspot_title"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['hotspot_title']->value;?>
" required>
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('In this field, you can enter the name of your ISP company. It will appear as the main title on the hotspot page.');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Free Trial -->
                                    <div class="form-group">
                                        <label for="free_trial" class="col-sm-2 control-label">
                                            <i class="fa fa-toggle-on"></i> <?php echo Lang::T('Free Trial');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="free_trial" id="free_trial">
                                                <option value="disable" <?php if (!$_smarty_tpl->tpl_vars['free_trial_enabled']->value) {?>selected<?php }?>>
                                                    <?php echo Lang::T('Disable');?>

                                                </option>
                                                <option value="enable" <?php if ($_smarty_tpl->tpl_vars['free_trial_enabled']->value) {?>selected<?php }?>>
                                                    <?php echo Lang::T('Enable');?>

                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('Select to enable or disable the free trial feature. Default is "Disable".');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">
                                            <i class="fa fa-info-circle"></i> <?php echo Lang::T('Brief Description Of Company/Tagline');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-lg"
                                                   name="description" id="description"
                                                   value="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Router -->
                                    <div class="form-group">
                                        <label for="router_id" class="col-sm-2 control-label">
                                            <i class="fa fa-wifi"></i> <?php echo Lang::T('Router');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select name="router_id" id="router_id" class="form-control input-lg">
                                                <option value=""><?php echo Lang::T('Select a router');?>
</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['router']->value['id'] == $_smarty_tpl->tpl_vars['selected_router_id']->value) {?>selected<?php }?>>
                                                        <?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>

                                                    </option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('This is the most important part of the form. Select the router from the dropdown list.');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Logo -->
                                    <div class="form-group">
                                        <label for="logo_upload" class="col-sm-2 control-label">
                                            <i class="fa fa-image"></i> <?php echo Lang::T('Upload Logo');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control input-lg" name="logo_upload" id="logo_upload" accept=".png, .jpg, .jpeg">
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('The logo will be automatically resized. Only .png, .jpg, or .jpeg allowed.');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Advert Banner -->
                                    <div class="form-group">
                                        <label for="advert_upload" class="col-sm-2 control-label">
                                            <i class="fa fa-ad"></i> <?php echo Lang::T('Upload Advert Banner');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control input-lg" name="advert_upload" id="advert_upload" accept=".png, .jpg, .jpeg">
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('Only one advert image is allowed. Ensure it is a rectangular/landscape banner and does not exceed 500KB to avoid slowing down the login page');?>

                                            </small>
                                        </div>
                                    </div>

<!-- Previews Side by Side -->
<div class="form-group">
    <label class="col-sm-2 control-label">
        <?php echo Lang::T('Previews');?>
:
    </label>
    <div class="col-sm-10">
        <div class="row">

            <!-- Logo Preview (Left Column) -->
            <div class="col-sm-6 text-center">
                <img 
                    src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/logo.png" 
                    alt="Logo Preview"
                    class="img-thumbnail"
                    style="max-width:100px; height:auto;"
                    onload="console.log('Logo image loaded successfully')"
                    onerror="console.error('Failed to load logo image')"
                />
                <p class="help-block"><?php echo Lang::T('Logo Preview');?>
</p>
            </div>

            <!-- Advert Preview (Right Column) -->
            <div class="col-sm-6 text-center">
                <img 
                    src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/advert.png" 
                    alt="Advert Preview" 
                    class="img-thumbnail"
                    style="max-width:150px; height:auto;"
                    onload="console.log('Advert image loaded successfully')"
                    onerror="console.error('Failed to load advert image')"
                />
                <p class="help-block"><?php echo Lang::T('Advert Preview');?>
</p>
            </div>

        </div>
    </div>
</div>



                                    
                                    <!-- Advert Position (Top or Bottom) -->
                                    <div class="form-group">
                                        <label for="advert_position" class="col-sm-2 control-label">
                                            <i class="fa fa-align-left"></i> <?php echo Lang::T('Advert Position');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="advert_position" id="advert_position">
                                                <option value="top"    <?php if ($_smarty_tpl->tpl_vars['advert_position']->value == 'top') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Top');?>

                                                </option>
                                                <option value="bottom" <?php if ($_smarty_tpl->tpl_vars['advert_position']->value == 'bottom') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Bottom');?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable Advert -->
                                    <div class="form-group">
                                        <label for="enable_advert" class="col-sm-2 control-label">
                                            <i class="fa fa-toggle-on"></i> <?php echo Lang::T('Enable Advert');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_advert" id="enable_advert">
                                                <option value="disable" <?php if ($_smarty_tpl->tpl_vars['enable_advert']->value == 'disable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Disable');?>

                                                </option>
                                                <option value="enable"  <?php if ($_smarty_tpl->tpl_vars['enable_advert']->value == 'enable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Enable');?>

                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('If set to "Enable", your advert banner will appear.');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable Testimonials -->
                                    <div class="form-group">
                                        <label for="enable_testimonials" class="col-sm-2 control-label">
                                            <i class="fa fa-comment-dots"></i> <?php echo Lang::T('Testimonials');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_testimonials" id="enable_testimonials">
                                                <option value="disable" <?php if ($_smarty_tpl->tpl_vars['enable_testimonials']->value == 'disable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Disable');?>

                                                </option>
                                                <option value="enable"  <?php if ($_smarty_tpl->tpl_vars['enable_testimonials']->value == 'enable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Enable');?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable FAQ -->
                                    <div class="form-group">
                                        <label for="enable_faq" class="col-sm-2 control-label">
                                            <i class="fa fa-question-circle"></i> <?php echo Lang::T('FAQ Section');?>

                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_faq" id="enable_faq">
                                                <option value="disable" <?php if ($_smarty_tpl->tpl_vars['enable_faq']->value == 'disable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Disable');?>

                                                </option>
                                                <option value="enable"  <?php if ($_smarty_tpl->tpl_vars['enable_faq']->value == 'enable') {?>selected<?php }?>>
                                                    <?php echo Lang::T('Enable');?>

                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                <?php echo Lang::T('If "Disable", the FAQ section won\'t appear on the login page.');?>

                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Preview of Logo -->
                                    <?php if ($_smarty_tpl->tpl_vars['logo_file']->value == 'logo.png') {?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">
                                                <?php echo Lang::T('Current Logo Preview');?>
:
                                            </label>
                                            <div class="col-sm-10">
                                                <img src="../logo.png"
                                                     alt="Logo Preview"
                                                     style="max-width:150px; height:auto;"
                                                />
                                            </div>
                                        </div>
                                    <?php }?>
                                    
                                    <!-- Preview of Advert -->
                                    <?php if ($_smarty_tpl->tpl_vars['advert_file']->value == 'advert.png') {?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">
                                                <?php echo Lang::T('Current Advert Preview');?>
:
                                            </label>
                                            <div class="col-sm-10">
                                                <img src="../advert.png"
                                                     alt="Advert Preview"
                                                     style="max-width:300px; height:auto;"
                                                />
                                            </div>
                                        </div>
                                    <?php }?>
                                    
                                    <!-- FAQ HEADLINES & ANSWERS -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_headline1" class="col-sm-4 control-label">
                                                    <i class="fa fa-question-circle"></i> FAQ Headline 1
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-lg"
                                                           name="frequently_asked_questions_headline1"
                                                           id="frequently_asked_questions_headline1"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline1']->value;?>
" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_answer1" class="col-sm-4 control-label">
                                                    <i class="fa fa-comment"></i> FAQ Answer 1
                                                </label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control input-lg"
                                                              id="frequently_asked_questions_answer1"
                                                              name="frequently_asked_questions_answer1"
                                                              rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer1']->value;?>
</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_headline2" class="col-sm-4 control-label">
                                                    <i class="fa fa-question-circle"></i> FAQ Headline 2
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-lg"
                                                           id="frequently_asked_questions_headline2"
                                                           name="frequently_asked_questions_headline2"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline2']->value;?>
" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_answer2" class="col-sm-4 control-label">
                                                    <i class="fa fa-comment"></i> FAQ Answer 2
                                                </label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control input-lg"
                                                              id="frequently_asked_questions_answer2"
                                                              name="frequently_asked_questions_answer2"
                                                              rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer2']->value;?>
</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_headline3" class="col-sm-4 control-label">
                                                    <i class="fa fa-question-circle"></i> FAQ Headline 3
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-lg"
                                                           name="frequently_asked_questions_headline3"
                                                           id="frequently_asked_questions_headline3"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline3']->value;?>
" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="frequently_asked_questions_answer3" class="col-sm-4 control-label">
                                                    <i class="fa fa-comment"></i> FAQ Answer 3
                                                </label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control input-lg"
                                                              id="frequently_asked_questions_answer3"
                                                              name="frequently_asked_questions_answer3"
                                                              rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer3']->value;?>
</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="color_scheme" class="col-sm-4 control-label">
                                                    <i class="fa fa-paint-brush"></i> <?php echo Lang::T('Color Scheme');?>
:
                                                </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-lg select2"
                                                            name="color_scheme" id="color_scheme"
                                                            data-placeholder="<?php echo Lang::T('Select a color scheme');?>
"
                                                            style="width: 100%;">
                                                        <option value="green"  <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'green') {?>selected<?php }?>><?php echo Lang::T('Green');?>
</option>
                                                        <option value="brown"  <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'brown') {?>selected<?php }?>><?php echo Lang::T('Brown');?>
</option>
                                                        <option value="orange" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'orange') {?>selected<?php }?>><?php echo Lang::T('Orange');?>
</option>
                                                        <option value="red"    <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'red') {?>selected<?php }?>><?php echo Lang::T('Red');?>
</option>
                                                        <option value="blue"   <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'blue') {?>selected<?php }?>><?php echo Lang::T('Blue');?>
</option>
                                                        <option value="black"  <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'black') {?>selected<?php }?>><?php echo Lang::T('Black');?>
</option>
                                                        <option value="yellow" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'yellow') {?>selected<?php }?>><?php echo Lang::T('Yellow');?>
</option>
                                                        <option value="pink"   <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'pink') {?>selected<?php }?>><?php echo Lang::T('Pink');?>
</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end .box-body -->
                                
                                <!-- Submit Button -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success btn-lg pull-right">
                                        <i class="fa fa-save"></i> <?php echo Lang::T('Save Changes and Upload File');?>

                                    </button>
                                </div>
                            </form><!-- end form -->
                            
                        </div><!-- end box -->
                        
                    </div>
                </div>
                
                <!-- Usage Instructions -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="fa fa-info-circle"></i> <?php echo Lang::T('Usage Instructions');?>

                                </h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="callout callout-info">
                                    <h4>
                                        <i class="icon fa fa-primary"></i> <?php echo Lang::T('Steps');?>
:
                                    </h4>
                                    <ol>
                                        <li><?php echo Lang::T('You can Edit Anything Here to update The Page');?>
</li>
                                        <li><?php echo Lang::T('Remember to choose router');?>
</li>
                                        <li><?php echo Lang::T('Under color Scheme once you choose a different color on the login page it will update to the new scheme');?>
</li>
                                        <li><?php echo Lang::T('After Enabling Free Trial Remember to Add the Hotspot Trial Plans');?>
</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end usage instructions -->
                
            </div><!-- end panel-body -->
        </div><!-- end panel -->
    </div><!-- end col-sm-12 -->
</div><!-- end row -->

<!-- Tutorial Modal -->
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
                    <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/d1X8NrQodU4?si=mAUdMH7aIlbg9eva"
                            allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?php echo Lang::T('Close');?>

                </button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
