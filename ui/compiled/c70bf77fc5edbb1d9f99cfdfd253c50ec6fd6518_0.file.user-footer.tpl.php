<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:51:35
  from 'F:\xampp\htdocs\radius\ui\themes\nova\sections\user-footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c467623b94_49712044',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c70bf77fc5edbb1d9f99cfdfd253c50ec6fd6518' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\sections\\user-footer.tpl',
      1 => 1711614618,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6771c467623b94_49712044 (Smarty_Internal_Template $_smarty_tpl) {
?>        </div>
      </div>
    </div>
    </div>
  </div>
		 <footer class="md:block hidden" id="footer">
        <div class="site-footer px-6 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-300 py-4 ltr:ml-[248px] rtl:mr-[248px]">
          <div class="grid md:grid-cols-2 grid-cols-1 md:gap-5">
            <div class="text-center ltr:md:text-start rtl:md:text-right text-sm">
             <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyFooter'];?>

            </div>
            <div class="ltr:md:text-right rtl:md:text-end text-center text-sm">
              Billing Software by <a href="https://freeispradius.com" rel="nofollow noreferrer noopener"
                    target="_blank">FreeIspRadius</a>, Theme by <a href="https://FreeIspRadius.com" rel="nofollow noreferrer noopener"
                    target="_blank">FreeIspRadius.</a>
              </a>
            </div>
          </div>
        </div>
      </footer>
      <!-- END: Footer For Desktop and tab -->

      <div class="bg-white bg-no-repeat custom-dropshadow footer-bg dark:bg-slate-700 flex justify-around items-center
    backdrop-filter backdrop-blur-[40px] fixed left-0 bottom-0 w-full z-[9999] bothrefm-0 py-[12px] px-4 md:hidden">
    <a href="#">
          <div>
            <span class=" relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white
          text-slate-900">
        <iconify-icon icon="heroicons-outline:bell"></iconify-icon>
        <span class="absolute right-[17px] lg:hrefp-0 -hrefp-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
            justify-center rounded-full text-white z-[99]">
          2
        </span>
            </span>
            <span class=" block text-[11px] text-slate-600 dark:text-slate-300">
        Notifications
      </span>
          </div>
        </a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/profile" class="relative bg-white bg-no-repeat backdrop-filter backdrop-blur-[40px] rounded-full footer-bg dark:bg-slate-700
      h-[65px] w-[65px] z-[-1] -mt-[40px] flex justify-center items-center">
          <div class="h-[50px] w-[50px] rounded-full relative left-[0px] hrefp-[0px] custom-dropshadow">
            <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_user']->value['id'];?>
?set=set3&size=100x100&bgset=bg1" onerror="this.src='system/uploads/user.default.jpg'" alt="" class="w-full h-full rounded-full border-2 border-slate-100">
          </div>
        </a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout">
          <div>
            <span class="relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white
          text-slate-900 ">
        <iconify-icon icon="heroicons-outline:login"></iconify-icon>
        <span class="">

        </span>
            </span>
            <span class="block text-[11px] text-slate-600 dark:text-slate-300">
        <?php echo Lang::T('Logout');?>

      </span>
          </div>
        </a>
      </div>
    </div>
  </main>
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
		 <?php if ((isset($_smarty_tpl->tpl_vars['xfooter']->value))) {?>
            <?php echo $_smarty_tpl->tpl_vars['xfooter']->value;?>

        <?php }?>



        
            <?php echo '<script'; ?>
>
                var listAtts = document.querySelectorAll(`[api-get-text]`);
                listAtts.forEach(function(el) {
                    $.get(el.getAttribute('api-get-text'), function(data) {
                        el.innerHTML = data;
                    });
                });
                $(document).ready(function() {
                    var listAtts = document.querySelectorAll(`button[type="submit"]`);
                    listAtts.forEach(function(el) {
                        if (el.addEventListener) { // all browsers except IE before version 9
                            el.addEventListener("click", function() {
                                $(this).html(
                                    `<span class="loading"></span>`
                                );
                                setTimeout(() => {
                                    $(this).prop("disabled", true);
                                }, 100);
                            }, false);
                        } else {
                            if (el.attachEvent) { // IE before version 9
                                el.attachEvent("click", function() {
                                    $(this).html(
                                        `<span class="loading"></span>`
                                    );
                                    setTimeout(() => {
                                        $(this).prop("disabled", true);
                                    }, 100);
                                });
                            }
                        }

                    });
                });
            <?php echo '</script'; ?>
>
        

  <!-- scripts -->
  <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/highchart/js/highcharts.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/highchart/js/themes/gray.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/jquery-3.6.0.min.js" sync><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/popper.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/SimpleBar.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/iconify.js"><?php echo '</script'; ?>
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
