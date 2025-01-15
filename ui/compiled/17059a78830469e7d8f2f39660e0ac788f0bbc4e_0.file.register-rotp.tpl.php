<?php
/* Smarty version 4.3.1, created on 2024-04-18 22:36:32
  from 'F:\xampp\htdocs\radius\ui\themes\nova\register-rotp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66217640a4ad37_52089884',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17059a78830469e7d8f2f39660e0ac788f0bbc4e' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\register-rotp.tpl',
      1 => 1712947796,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66217640a4ad37_52089884 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Lang::T('Register');?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <!-- Icons -->
    <link rel="stylesheet" href="ui/ui/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="ui/ui/styles/plugins/waves.css">
    <link rel="stylesheet" href="ui/ui/styles/plugins/perfect-scrollbar.css">

    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/styles/main.min.css">

    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]> <?php echo '<script'; ?>
 src="ui/ui/scripts/ie/matchMedia.js"><?php echo '</script'; ?>
>  <![endif]-->
        <link rel="stylesheet" href="ui/ui/styles/sweetalert2.min.css" />
    <?php echo '<script'; ?>
 src="ui/ui/scripts/sweetalert2.all.min.js"><?php echo '</script'; ?>
>

</head>

<body id="app" class="app off-canvas body-full">

    <div class="container">
        <div class="hidden-xs" style="height:150px"></div>
        <div class="form-head mb20">
            <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"
                style="text-shadow: 2px 2px 4px #757575;"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</h1>
            <hr>
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
        <?php echo '<script'; ?>
>
            // Display SweetAlert toast notification
            Swal.fire({
                icon: '<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == "s") {?>success<?php } else { ?>warning<?php }?>',
                title: '<?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        <?php echo '</script'; ?>
>
        <?php }?>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                   <div class="panel-heading"><?php echo Lang::T('Registration Info');?>
</div>
                    <div class="panel-body">
                        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['_path']->value)."/../pages/Registration_Info.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                    </div>
                </div>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
register" method="post">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">1. <?php echo Lang::T('Register as Member');?>
</div>
                        <div class="panel-body">
                            <div class="form-group">
                              <label><?php echo Lang::T('Phone Number');?>
</label>
                                <div class="input-group">
                                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {?>
                                        <span class="input-group-addon" id="basic-addon1">+</span>
                                    <?php } else { ?>
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="glyphicon glyphicon-phone-alt"></i></span>
                                    <?php }?>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
                                </div>
                            </div>
                            <div class="btn-group btn-group-justified mb15">
                                <div class="btn-group">
                                                  <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login" class="btn btn-warning"><?php echo Lang::T('Cancel');?>
</a>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-success"
                                        type="submit"><?php echo Lang::T('Request OTP');?>
</button>
                                </div>
                            </div>
                            <br>
                            <center>
                                <a href="./pages/Privacy_Policy.html" target="_blank">Privacy</a>
                                &bull;
                                <a href="./pages/Terms_and_Conditions.html" target="_blank">T &amp; C</a>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['_c']->value['tawkto'] != '') {?>
        <!--Start of Tawk.to Script-->
        <?php echo '<script'; ?>
 type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src='https://embed.tawk.to/<?php echo $_smarty_tpl->tpl_vars['_c']->value['tawkto'];?>
';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        <?php echo '</script'; ?>
>
        <!--End of Tawk.to Script-->
    <?php }?>
    <?php echo '<script'; ?>
 src="ui/ui/scripts/vendors.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
