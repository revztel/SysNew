<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:51:04
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c448c34598_15631059',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f98028fee382d997401c9d8407853cee6a300d79' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-login.tpl',
      1 => 1715386042,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6771c448c34598_15631059 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr" class="dark">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
     <title><?php echo Lang::T('Login');?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/css/rt-plugins.css">
    <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.min.css">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
    <!-- START : Theme Config js-->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/settings.js" sync><?php echo '</script'; ?>
>
    <!-- END : Theme Config js-->
  </head>
  <body class=" font-inter skin-default">
    <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
    <?php echo '<script'; ?>
>
        // Display SweetAlert toast notification
        Swal.fire({
            icon: '<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == "s") {?>success<?php } else { ?>error<?php }?>',
            title: '<?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    <?php echo '</script'; ?>
>
<?php }?>
    <div class="loginwrapper bg-cover bg-no-repeat bg-center" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/bg.png);">
      <div class="lg-inner-column">
        <div class="left-columns lg:w-1/2 lg:block hidden">
          <div class="logo-box-3">
            <a class="flex items-center" href="./">
              <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="black_logo" alt="logo">
              <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="white_logo" alt="logo">
              <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</span>
            </a>
          </div>
        </div>
        <div class="lg:w-1/2 w-full flex flex-col items-center justify-center">
          <div class="auth-box-3">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a class="flex items-center" href="./">
                <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="black_logo" alt="logo">
                <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="white_logo" alt="logo">
                <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</span>
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-5">
              <h4 class="font-medium">Sign In</h4>
              <div class="text-slate-500 dark:text-slate-400 text-base"> <?php echo Lang::T('Log in to Member Panel');?>
 </div>
            </div>
            <!-- BEGIN: Login Form -->
            <form class="space-y-4" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login/post" method="post">
<form class="space-y-4" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login/post" method="post">
  <div class="fromGroup">
    <label class="block capitalize form-label"><?php echo Lang::T('Username');?>
</label>
    <div class="relative ">
<input type="text" name="username" class="form-control py-2" required value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['username']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" placeholder="<?php echo Lang::T('username');?>
">
    </div>
  </div>
  <div class="fromGroup">
    <label class="block capitalize form-label"><?php echo Lang::T('Password');?>
</label>
    <div class="relative ">
      <input type="password" name="password" class="form-control py-2" required value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['password']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" placeholder="<?php echo Lang::T('Password');?>
">
    </div>
  </div>
              <div class="flex justify-between">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" class="hiddens">
                  <span class="text-slate-500 dark:text-slate-400 text-sm leading-6 capitalize">Keep me signed in</span>
                </label>
                <a class="text-sm text-slate-800 dark:text-slate-400 leading-6 font-medium" href="">Forgot Password? </a>
              </div>
              <button type="submit" class="btn btn-dark block w-full text-center"><?php echo Lang::T('Login');?>
</button>
            </form>
            <!-- END: Login Form -->
            <div class="mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm text-center"> Don't have Account? <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
register" class="text-slate-900 dark:text-white font-medium hover:underline"> <?php echo Lang::T('Register');?>
</a>
            </div>
          </div>
        </div>
        <div class="auth-footer3 text-white py-5 px-5 text-xl w-full"> &copy; 2023 <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
 &nbsp; <a href="./pages/Privacy_Policy.html" target="_blank">Privacy</a> &nbsp;  <a href="./pages/Terms_and_Conditions.html" target="_blank">T &amp; C</a>
        </div>
      </div>
    </div>
    <!-- scripts -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/scripts/vendors.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/rt-plugins.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/app.js"><?php echo '</script'; ?>
>

   <?php echo '<script'; ?>
>
window.onload = function() {
    // Get the URL parameters
    var params = new URLSearchParams(window.location.search);

    // Check if the user is coming from connect.php
    if (params.get('from_connect') === 'true') {
        // If a redirect parameter is present, add it as a hidden input to the form
        if (params.get('redirect')) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'redirect';
            input.value = params.get('redirect');
            document.querySelector('form').appendChild(input);
        }

        // Submit the form immediately
        document.querySelector('form').submit();
    }
};
<?php echo '</script'; ?>
>

  </body>
</html>
<?php }
}
