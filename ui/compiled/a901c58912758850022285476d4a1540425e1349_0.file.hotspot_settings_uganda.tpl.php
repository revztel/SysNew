<?php
/* Smarty version 4.3.1, created on 2025-01-07 18:37:37
  from 'F:\xampp\htdocs\radius\system\plugin\ui\hotspot_settings_uganda.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677d4a4169d750_52962476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a901c58912758850022285476d4a1540425e1349' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\hotspot_settings_uganda.tpl',
      1 => 1734460127,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677d4a4169d750_52962476 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<section class="content-header">
    <h1>
        <div class="btn-group">
            <button type="button" class="btn btn-success btn-lg">
                <i class="fa fa-wifi"></i> Hotspot Settings - Uganda
            </button>
            <button type="button" class="btn btn-success btn-lg dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings"><i class="fa fa-cog"></i> <?php echo Lang::T('General Settings');?>
</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/captive_portal_login" target="_blank"><i class="fa fa-eye"></i> Preview Hotspot Login Page</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/download.php?download=1" target="_blank"><i class="fa fa-download"></i> Download Login Page</a></li>
            </ul>
        </div>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/system/plugin/download.php?download=1" class="btn btn-info btn-lg"><i class="fa fa-download"></i> Click Here To Download Login Page</a></li>
        <li class="active">Hotspot Settings - Uganda</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings"><?php echo Lang::T('Kenya');?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_tanzania"><?php echo Lang::T('Tanzania');?>
</a></li>
                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_uganda"><?php echo Lang::T('Uganda');?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/hotspot_settings_philippines"><?php echo Lang::T('Philippines');?>
</a></li>
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div id="uganda" class="tab-pane fade in active">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="box-title"><i class="fa fa-cog"></i> <?php echo Lang::T('General Settings');?>
 - Uganda</h3>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                                <?php echo Lang::T('Need Help?');?>

                            </button>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="hotspot_title" class="col-sm-2 control-label"><i class="fa fa-header"></i> Hotspot Page Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-lg" name="hotspot_title" id="hotspot_title" value="<?php echo $_smarty_tpl->tpl_vars['hotspot_title']->value;?>
" required>
                                        <small class="form-text text-muted">Enter your ISP company name as the hotspot page title for Uganda.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="free_trial" class="col-sm-2 control-label"><i class="fa fa-toggle-on"></i> Free Trial</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-lg" name="free_trial" id="free_trial">
                                            <option value="disable" <?php if (!$_smarty_tpl->tpl_vars['free_trial_enabled']->value) {?>selected<?php }?>>Disable</option>
                                            <option value="enable" <?php if ($_smarty_tpl->tpl_vars['free_trial_enabled']->value) {?>selected<?php }?>>Enable</option>
                                        </select>
                                        <small class="form-text text-muted">Enable or disable the free trial feature.</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label"><i class="fa fa-info-circle"></i> Brief Description/Tagline</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-lg" name="description" id="description" value="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="router_id" class="col-sm-2 control-label"><i class="fa fa-wifi"></i> Router</label>
                                    <div class="col-sm-10">
                                        <select name="router_id" id="router_id" class="form-control input-lg">
                                            <option value="">Select a router</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['router']->value['id'] == $_smarty_tpl->tpl_vars['selected_router_id']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                        <small class="form-text text-muted">Select the router for the Uganda hotspot configuration.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- FAQ 1 -->
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_headline1" class="col-sm-4 control-label"><i class="fa fa-question-circle"></i> FAQ Headline 1</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-lg" name="frequently_asked_questions_headline1" id="frequently_asked_questions_headline1" value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline1']->value;?>
" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_answer1" class="col-sm-4 control-label"><i class="fa fa-comment"></i> FAQ Answer 1</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control input-lg" id="frequently_asked_questions_answer1" name="frequently_asked_questions_answer1" rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer1']->value;?>
</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- FAQ 2 -->
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_headline2" class="col-sm-4 control-label"><i class="fa fa-question-circle"></i> FAQ Headline 2</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-lg" id="frequently_asked_questions_headline2" name="frequently_asked_questions_headline2" value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline2']->value;?>
" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_answer2" class="col-sm-4 control-label"><i class="fa fa-comment"></i> FAQ Answer 2</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control input-lg" id="frequently_asked_questions_answer2" name="frequently_asked_questions_answer2" rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer2']->value;?>
</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- FAQ 3 -->
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_headline3" class="col-sm-4 control-label"><i class="fa fa-question-circle"></i> FAQ Headline 3</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-lg" name="frequently_asked_questions_headline3" id="frequently_asked_questions_headline3" value="<?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_headline3']->value;?>
" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="frequently_asked_questions_answer3" class="col-sm-4 control-label"><i class="fa fa-comment"></i> FAQ Answer 3</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control input-lg" id="frequently_asked_questions_answer3" name="frequently_asked_questions_answer3" rows="4" required><?php echo $_smarty_tpl->tpl_vars['frequently_asked_questions_answer3']->value;?>
</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Color Scheme -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color_scheme" class="col-sm-4 control-label"><i class="fa fa-paint-brush"></i> Color Scheme:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control input-lg select2" name="color_scheme" id="color_scheme" data-placeholder="Select a color scheme" style="width: 100%;">
                                                    <option value="green" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'green') {?>selected<?php }?>>Green</option>
                                                    <option value="brown" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'brown') {?>selected<?php }?>>Brown</option>
                                                    <option value="orange" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'orange') {?>selected<?php }?>>Orange</option>
                                                    <option value="red" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'red') {?>selected<?php }?>>Red</option>
                                                    <option value="blue" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'blue') {?>selected<?php }?>>Blue</option>
                                                    <option value="black" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'black') {?>selected<?php }?>>Black</option>
                                                    <option value="yellow" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'yellow') {?>selected<?php }?>>Yellow</option>
                                                    <option value="pink" <?php if ($_smarty_tpl->tpl_vars['selected_color_scheme']->value == 'pink') {?>selected<?php }?>>Pink</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success btn-lg pull-right"><i class="fa fa-save"></i> Save Changes and Upload File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Usage Instructions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-info-circle"></i> Usage Instructions</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="callout callout-info">
                                <h4><i class="icon fa fa-primary"></i> Steps:</h4>
                                <ol>
                                    <li>Try "Save Changes and Upload File" twice for a quick upload.</li>
                                    <li>Personalize your Ugandan hotspot settings above.</li>
                                    <li>Click "Download Login Page" to get the <code>login.html</code> file.</li>
                                    <li>Upload <code>login.html</code> to your MikroTik router.</li>
                                    <li>Ensure the file name is <code>login.html</code> exactly.</li>
                                    <li>Place the login file between <code>error.html</code> and <code>status.html</code>.</li>
                                    <li>Add your website URL to the MikroTik hotspot walled garden.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end uganda tab content -->
    </div><!-- end tab-content -->
</section>

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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/d1X8NrQodU4?si=mAUdMH7aIlbg9eva" allowfullscreen></iframe>
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
