{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <!-- Main Panel -->
        <div class="panel panel-hovered mb20 panel-primary">
            
            <!-- Panel Heading -->
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Left Title/Heading -->
                <span>
                    <i class="fa fa-wifi"></i> {Lang::T('Hotspot Settings')}
                </span>
                
                <!-- Right Button Group -->
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fa fa-wifi"></i> {Lang::T('Hotspot Settings')}
                    </button>
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{$_url}plugin/hotspot_settings">
                                <i class="fa fa-cog"></i> {Lang::T('General Settings')}
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{$_url}plugin/captive_portal_login" target="_blank">
                                <i class="fa fa-eye"></i> {Lang::T('Preview Hotspot Login Page')}
                            </a>
                        </li>
                        <li>
                            <a href="{$app_url}/system/plugin/download.php?download=1" target="_blank">
                                <i class="fa fa-download"></i> {Lang::T('Download Login Page')}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Panel Body -->
            <div class="panel-body">
                
                <!-- Optional breadcrumb / download button row -->
                <div class="mb20 text-center">
                    <a href="{$app_url}/system/plugin/download.php?download=1" class="btn btn-info btn-lg">
                        <i class="fa fa-download"></i> {Lang::T('Click Here To Download Login Page')}
                    </a>
                </div>
                
                <!-- Country Navigation Tabs -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <!-- Assume Kenya is the default/active tab -->
                            <li class="active">
                                <a href="{$_url}plugin/hotspot_settings">{Lang::T('Kenya')}</a>
                            </li>
                            <li><a href="{$_url}plugin/hotspot_settings_tanzania">{Lang::T('Tanzania')}</a></li>
                            <li><a href="{$_url}plugin/hotspot_settings_uganda">{Lang::T('Uganda')}</a></li>
                            <li><a href="{$_url}plugin/hotspot_settings_philippines">{Lang::T('Philippines')}</a></li>
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
                                    <i class="fa fa-cog"></i> {Lang::T('General Settings')}
                                </h3>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                                    {Lang::T('Need Help?')}
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
                                            <i class="fa fa-header"></i> {Lang::T('Hotspot Page Title')}
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-lg"
                                                   name="hotspot_title" id="hotspot_title"
                                                   value="{$hotspot_title}" required>
                                            <small class="form-text text-muted">
                                                {Lang::T('In this field, you can enter the name of your ISP company. It will appear as the main title on the hotspot page.')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Free Trial -->
                                    <div class="form-group">
                                        <label for="free_trial" class="col-sm-2 control-label">
                                            <i class="fa fa-toggle-on"></i> {Lang::T('Free Trial')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="free_trial" id="free_trial">
                                                <option value="disable" {if !$free_trial_enabled}selected{/if}>
                                                    {Lang::T('Disable')}
                                                </option>
                                                <option value="enable" {if $free_trial_enabled}selected{/if}>
                                                    {Lang::T('Enable')}
                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                {Lang::T('Select to enable or disable the free trial feature. Default is "Disable".')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">
                                            <i class="fa fa-info-circle"></i> {Lang::T('Brief Description Of Company/Tagline')}
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-lg"
                                                   name="description" id="description"
                                                   value="{$description}" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Router -->
                                    <div class="form-group">
                                        <label for="router_id" class="col-sm-2 control-label">
                                            <i class="fa fa-wifi"></i> {Lang::T('Router')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select name="router_id" id="router_id" class="form-control input-lg">
                                                <option value="">{Lang::T('Select a router')}</option>
                                                {foreach $routers as $router}
                                                    <option value="{$router.id}" {if $router.id eq $selected_router_id}selected{/if}>
                                                        {$router.name}
                                                    </option>
                                                {/foreach}
                                            </select>
                                            <small class="form-text text-muted">
                                                {Lang::T('This is the most important part of the form. Select the router from the dropdown list.')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Logo -->
                                    <div class="form-group">
                                        <label for="logo_upload" class="col-sm-2 control-label">
                                            <i class="fa fa-image"></i> {Lang::T('Upload Logo')}
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control input-lg" name="logo_upload" id="logo_upload" accept=".png, .jpg, .jpeg">
                                            <small class="form-text text-muted">
                                                {Lang::T('The logo will be automatically resized. Only .png, .jpg, or .jpeg allowed.')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Advert Banner -->
                                    <div class="form-group">
                                        <label for="advert_upload" class="col-sm-2 control-label">
                                            <i class="fa fa-ad"></i> {Lang::T('Upload Advert Banner')}
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control input-lg" name="advert_upload" id="advert_upload" accept=".png, .jpg, .jpeg">
                                            <small class="form-text text-muted">
                                                {Lang::T('Only one advert image is allowed. Ensure it is a rectangular/landscape banner and does not exceed 500KB to avoid slowing down the login page')}
                                            </small>
                                        </div>
                                    </div>

<!-- Previews Side by Side -->
<div class="form-group">
    <label class="col-sm-2 control-label">
        {Lang::T('Previews')}:
    </label>
    <div class="col-sm-10">
        <div class="row">

            <!-- Logo Preview (Left Column) -->
            <div class="col-sm-6 text-center">
                <img 
                    src="{$app_url}/system/plugin/logo.png" 
                    alt="Logo Preview"
                    class="img-thumbnail"
                    style="max-width:100px; height:auto;"
                    onload="console.log('Logo image loaded successfully')"
                    onerror="console.error('Failed to load logo image')"
                />
                <p class="help-block">{Lang::T('Logo Preview')}</p>
            </div>

            <!-- Advert Preview (Right Column) -->
            <div class="col-sm-6 text-center">
                <img 
                    src="{$app_url}/system/plugin/advert.png" 
                    alt="Advert Preview" 
                    class="img-thumbnail"
                    style="max-width:150px; height:auto;"
                    onload="console.log('Advert image loaded successfully')"
                    onerror="console.error('Failed to load advert image')"
                />
                <p class="help-block">{Lang::T('Advert Preview')}</p>
            </div>

        </div>
    </div>
</div>



                                    
                                    <!-- Advert Position (Top or Bottom) -->
                                    <div class="form-group">
                                        <label for="advert_position" class="col-sm-2 control-label">
                                            <i class="fa fa-align-left"></i> {Lang::T('Advert Position')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="advert_position" id="advert_position">
                                                <option value="top"    {if $advert_position == 'top'}selected{/if}>
                                                    {Lang::T('Top')}
                                                </option>
                                                <option value="bottom" {if $advert_position == 'bottom'}selected{/if}>
                                                    {Lang::T('Bottom')}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable Advert -->
                                    <div class="form-group">
                                        <label for="enable_advert" class="col-sm-2 control-label">
                                            <i class="fa fa-toggle-on"></i> {Lang::T('Enable Advert')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_advert" id="enable_advert">
                                                <option value="disable" {if $enable_advert == 'disable'}selected{/if}>
                                                    {Lang::T('Disable')}
                                                </option>
                                                <option value="enable"  {if $enable_advert == 'enable'}selected{/if}>
                                                    {Lang::T('Enable')}
                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                {Lang::T('If set to "Enable", your advert banner will appear.')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable Testimonials -->
                                    <div class="form-group">
                                        <label for="enable_testimonials" class="col-sm-2 control-label">
                                            <i class="fa fa-comment-dots"></i> {Lang::T('Testimonials')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_testimonials" id="enable_testimonials">
                                                <option value="disable" {if $enable_testimonials == 'disable'}selected{/if}>
                                                    {Lang::T('Disable')}
                                                </option>
                                                <option value="enable"  {if $enable_testimonials == 'enable'}selected{/if}>
                                                    {Lang::T('Enable')}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Enable/Disable FAQ -->
                                    <div class="form-group">
                                        <label for="enable_faq" class="col-sm-2 control-label">
                                            <i class="fa fa-question-circle"></i> {Lang::T('FAQ Section')}
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-lg" name="enable_faq" id="enable_faq">
                                                <option value="disable" {if $enable_faq == 'disable'}selected{/if}>
                                                    {Lang::T('Disable')}
                                                </option>
                                                <option value="enable"  {if $enable_faq == 'enable'}selected{/if}>
                                                    {Lang::T('Enable')}
                                                </option>
                                            </select>
                                            <small class="form-text text-muted">
                                                {Lang::T('If "Disable", the FAQ section won\'t appear on the login page.')}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <!-- Preview of Logo -->
                                    {if $logo_file eq 'logo.png'}
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">
                                                {Lang::T('Current Logo Preview')}:
                                            </label>
                                            <div class="col-sm-10">
                                                <img src="../logo.png"
                                                     alt="Logo Preview"
                                                     style="max-width:150px; height:auto;"
                                                />
                                            </div>
                                        </div>
                                    {/if}
                                    
                                    <!-- Preview of Advert -->
                                    {if $advert_file eq 'advert.png'}
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">
                                                {Lang::T('Current Advert Preview')}:
                                            </label>
                                            <div class="col-sm-10">
                                                <img src="../advert.png"
                                                     alt="Advert Preview"
                                                     style="max-width:300px; height:auto;"
                                                />
                                            </div>
                                        </div>
                                    {/if}
                                    
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
                                                           value="{$frequently_asked_questions_headline1}" required>
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
                                                              rows="4" required>{$frequently_asked_questions_answer1}</textarea>
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
                                                           value="{$frequently_asked_questions_headline2}" required>
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
                                                              rows="4" required>{$frequently_asked_questions_answer2}</textarea>
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
                                                           value="{$frequently_asked_questions_headline3}" required>
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
                                                              rows="4" required>{$frequently_asked_questions_answer3}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="color_scheme" class="col-sm-4 control-label">
                                                    <i class="fa fa-paint-brush"></i> {Lang::T('Color Scheme')}:
                                                </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-lg select2"
                                                            name="color_scheme" id="color_scheme"
                                                            data-placeholder="{Lang::T('Select a color scheme')}"
                                                            style="width: 100%;">
                                                        <option value="green"  {if $selected_color_scheme == 'green'}selected{/if}>{Lang::T('Green')}</option>
                                                        <option value="brown"  {if $selected_color_scheme == 'brown'}selected{/if}>{Lang::T('Brown')}</option>
                                                        <option value="orange" {if $selected_color_scheme == 'orange'}selected{/if}>{Lang::T('Orange')}</option>
                                                        <option value="red"    {if $selected_color_scheme == 'red'}selected{/if}>{Lang::T('Red')}</option>
                                                        <option value="blue"   {if $selected_color_scheme == 'blue'}selected{/if}>{Lang::T('Blue')}</option>
                                                        <option value="black"  {if $selected_color_scheme == 'black'}selected{/if}>{Lang::T('Black')}</option>
                                                        <option value="yellow" {if $selected_color_scheme == 'yellow'}selected{/if}>{Lang::T('Yellow')}</option>
                                                        <option value="pink"   {if $selected_color_scheme == 'pink'}selected{/if}>{Lang::T('Pink')}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end .box-body -->
                                
                                <!-- Submit Button -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success btn-lg pull-right">
                                        <i class="fa fa-save"></i> {Lang::T('Save Changes and Upload File')}
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
                                    <i class="fa fa-info-circle"></i> {Lang::T('Usage Instructions')}
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
                                        <i class="icon fa fa-primary"></i> {Lang::T('Steps')}:
                                    </h4>
                                    <ol>
                                        <li>{Lang::T('You can Edit Anything Here to update The Page')}</li>
                                        <li>{Lang::T('Remember to choose router')}</li>
                                        <li>{Lang::T('Under color Scheme once you choose a different color on the login page it will update to the new scheme')}</li>
                                        <li>{Lang::T('After Enabling Free Trial Remember to Add the Hotspot Trial Plans')}</li>
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
                    {Lang::T('Close')}
                </button>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
