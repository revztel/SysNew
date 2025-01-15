<?php
/* Smarty version 4.3.1, created on 2024-10-08 01:43:08
  from 'F:\xampp\htdocs\radius\ui\themes\nova\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_670463fc282037_53241900',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3d0659f3501570f572d2c176095cd2d2a6dd10d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\register.tpl',
      1 => 1712947796,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_670463fc282037_53241900 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr" class="dark">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title><?php echo Lang::T('Register');?>
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
        <link rel="stylesheet" href="ui/ui/styles/sweetalert2.min.css" />
    <?php echo '<script'; ?>
 src="ui/ui/scripts/sweetalert2.all.min.js"><?php echo '</script'; ?>
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
              <h4 class="font-medium"><?php echo Lang::T('Register Member');?>
</h4>
              <div class="text-slate-500 dark:text-slate-400 text-base">
                <small></small>
              </div>
            </div> <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?> <div> <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
 <br>
            </div><?php }?>
            <!-- BEGIN: Login Form -->
            <div class="wizard card">
              <div class="card-body p-6">
                <div class="wizard-steps flex z-[5] items-center relative justify-center md:mx-8">
                  <div class="  active pass  relative z-[1] items-center item flex flex-start flex-1
                                  last:flex-none group wizard-step" data-step="1">
                    <div class="number-box">
                      <span class="number"> 1 </span>
                      <span class="no-icon text-3xl">
                        <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                    </div>
                    <div class="bar-line"></div>
                    <div class="circle-box">
                      <span class="w-max">Account</span>
                    </div>
                  </div>
                  <div class="  relative z-[1] items-center item flex flex-start flex-1
                                  last:flex-none group wizard-step" data-step="2">
                    <div class="number-box">
                      <span class="number"> 2 </span>
                      <span class="no-icon text-3xl">
                        <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                    </div>
                    <div class="bar-line"></div>
                    <div class="circle-box">
                      <span class="w-max"><?php echo Lang::T('Password');?>
</span>
                    </div>
                  </div>
                  <div class="  relative z-[1] items-center item flex flex-start flex-1
                                  last:flex-none group wizard-step" data-step="3">
                    <div class="number-box">
                      <span class="number"> 3 </span>
                      <span class="no-icon text-3xl">
                        <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                    </div>
                    <div class="bar-line"></div>
                    <div class="circle-box">
                      <span class="w-max">Address</span>
                    </div>
                  </div>
                  <div class="relative z-[1] items-center item flex flex-start flex-1
                                  last:flex-none group wizard-step" data-step="4">
                    <div class="number-box">
                      <span class="number"> 4 </span>
                      <span class="no-icon text-3xl">
                        <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                    </div>
                    <div class="bar-line"></div>
                    <div class="circle-box">
                      <span class="w-max">Done</span>
                    </div>
                  </div>
                </div>
                <form class="wizard-form mt-10" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
register/post" method="post">
                  <div class="wizard-form-step active" data-step="1">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                      <div class="lg:col-span-3 md:col-span-2 col-span-1">
                        <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Enter Your Account Details</h4>
                      </div>
                      <div class="input-area">
                        <label for="" class="form-label"><?php echo Lang::T('Phone Number');?>
*</label>
                        <input name="username" type="text" class="form-control" placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
                      </div>
                      <div class="input-area">
                        <label for="" class="form-label"><?php echo Lang::T('Full Name');?>
*</label>
                        <input type="text" required class="form-control" id="fullname" value="<?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>
" name="fullname" placeholder="Enter your full name">
                      </div>
                      <div class="input-area">
                        <label for="" class="form-label"><?php echo Lang::T('Email');?>
*</label>
                        <input id="email" required type="text" class="form-control" placeholder="xxxxxxx@xxxx.xx" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="wizard-form-step" data-step="2">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                      <div class="lg:col-span-3 md:col-span-2 col-span-1">
                        <h4 class="text-base text-slate-800 dark:text-slate-300 my-6"><?php echo Lang::T('Password');?>
</h4>
                      </div>
                      <div class="input-area">
                        <label for="" class="form-label"><?php echo Lang::T('Password');?>
*</label>
                        <input type="password" required class="form-control" id="password" name="password">
                      </div>
                      <div class="input-area">
                        <label for="" class="form-label"><?php echo Lang::T('Confirm Password');?>
*</label>
                        <input type="password" required class="form-control" id="cpassword" name="cpassword">
                      </div>
                    </div>
                  </div>
                  <div class="wizard-form-step" data-step="3">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                      <div class="lg:col-span-3 md:col-span-2 col-span-1">
                        <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Address</h4>
                      </div>
                      <div class="input-area lg:col-span-3 md:col-span-2 col-span-1">
                        <label for="" class="form-label"><?php echo Lang::T('Address');?>
*</label>
                        <textarea name="address" required id="address" rows="3" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="wizard-form-step" data-step="4">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                      <div class="lg:col-span-3 md:col-span-2 col-span-1">
                        <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Terms and Conditions</h4>
                      </div>
                      <div class="checkbox-area">
                        <label class="inline-flex items-center cursor-pointer">
                          <input type="checkbox" required class="hidden" name="checkbox">
                          <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative
                                        transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0">
                          </span>
                          <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">You Accept Our T &amp; C </span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-6   space-x-3">
                    <button class="btn btn-dark prev-button" type="button">prev</button>
                    <button class="btn btn-dark next-button" type="button">next</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- END: Login Form -->
            <div class="mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm text-center"> Already registered? <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login" class="text-slate-900 dark:text-white font-medium hover:underline"> <?php echo Lang::T('Login');?>
</a>
            </div>
          </div>
        </div>
        <div class="auth-footer3 text-white py-5 px-5 text-xl w-full"> &copy; 2023 <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
 &nbsp; <a href="pages/Privacy_Policy.html" target="_blank">Privacy</a> &nbsp; <a href="pages/Terms_and_Conditions.html" target="_blank">T &amp; C</a>
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
  </body>
</html>
<?php }
}
