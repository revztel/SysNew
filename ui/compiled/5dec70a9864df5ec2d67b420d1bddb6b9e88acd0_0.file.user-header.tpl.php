<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:51:35
  from 'F:\xampp\htdocs\radius\ui\themes\nova\sections\user-header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c46760ac81_74672663',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5dec70a9864df5ec2d67b420d1bddb6b9e88acd0' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\sections\\user-header.tpl',
      1 => 1728395448,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6771c46760ac81_74672663 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
 : : <?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
</title>
    <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" crossorigin="anonymous" rel="stylesheet">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/css/rt-plugins.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/css/app.css">
    
        </style>
      </style>
    <!-- End : Theme CSS-->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/js/settings.js" sync><?php echo '</script'; ?>
>
    <?php if ((isset($_smarty_tpl->tpl_vars['xheader']->value))) {?>
         <?php echo $_smarty_tpl->tpl_vars['xheader']->value;?>

    <?php }?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.min.css">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.1/dist/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="ui/ui/styles/sweetalert2.min.css" />
    <?php echo '<script'; ?>
 src="ui/ui/scripts/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
  </head>
  <body class=" font-inter dashcode-app" id="body_class">
    <main class="app-wrapper">
      <div class="sidebar-wrapper group">
        <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
        <div class="logo-segment">
          <a class="flex items-center" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="black_logo" alt="logo">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="white_logo" alt="logo">
            <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</span>
          </a>
          <!-- Sidebar Type Button -->
          <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
            <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
              <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700"></div>
            </span>
            <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
              <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150"></div>
            </span>
          </div>
          <button class="sidebarCloseIcon text-2xl">
            <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
          </button>
        </div>
        <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
        <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50" id="sidebar_menus">
          <ul class="sidebar-menu">
            <li class="sidebar-menu-title">MENU</li>
            <li class="">
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'home') {?> active <?php }?>">
                <span class="flex items-center">
                  <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                 <span><?php echo Lang::T('Dashboard');?>
</span>
                </span>
              </a>
            </li> <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_DASHBOARD']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes') {?> <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
voucher/activation" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'voucher') {?> active <?php }?>">
                <span class="flex items-center">
                  <iconify-icon class="nav-icon" icon="heroicons-outline:ticket"></iconify-icon>
                  <span><?php echo Lang::T('Voucher');?>
</span>
                </span>
              </a>
            </li> <?php }?> <?php if ($_smarty_tpl->tpl_vars['_c']->value['payment_gateway'] != 'none' || $_smarty_tpl->tpl_vars['_c']->value['payment_gateway'] == '') {?>
            <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?>
            <li class="">
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/balance" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'balance') {?> active <?php }?>">
                <span class="flex items-center">
                  <iconify-icon class=" nav-icon" icon="heroicons-outline:shopping-cart"></iconify-icon>
                  <span><?php echo Lang::T('Buy Balance');?>
</span>
                </span>
              </a>
            </li>
             <?php }?>
            <li class="">
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/package" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'package') {?> active <?php }?>">
                <span class="flex items-center">
                  <iconify-icon class=" nav-icon" icon="heroicons-outline:shopping-cart"></iconify-icon>
                  <span><?php echo Lang::T('Buy Package');?>
</span>
                </span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/history" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'history') {?> active <?php }?>">
                <span class="flex items-center">
                  <iconify-icon class=" nav-icon" icon="heroicons-outline:document-text"></iconify-icon>
                  <span><?php echo Lang::T('Order History');?>
</span>
                </span>
              </a>
 </li> <?php }?> <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_ORDER']->value;?>
 <li class="">
  <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
voucher/list-activated" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'list-activated') {?> active <?php }?>">
    <span class="flex items-center">
      <iconify-icon class=" nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
      <span><?php echo Lang::T('Activation History');?>
</span>
    </span>
  </a>
</li>
<?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_HISTORY']->value;?>

<li class="">
  <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients" class="navItem <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'support_tickets_clients') {?> active <?php }?>">
    <span class="flex items-center">
      <iconify-icon class=" nav-icon" icon="heroicons-outline:mail"></iconify-icon>
      <span><?php echo Lang::T('Support Ticket');?>
</span>
    </span>
  </a>
</li>
</ul>
          <!-- Upgrade Your Business Plan Card Start -->
          <div class="bg-slate-900 mb-10 mt-24 p-4 relative text-center rounded-2xl text-white" id="sidebar_bottom_wizard">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/svg/rabit.svg" alt="" class="mx-auto relative -mt-[73px]">
            <div class="max-w-[160px] mx-auto mt-6">
              <div class="widget-title font-Inter mb-1">Unlimited Internet Access</div>
              <div class="text-xs font-light font-Inter"> Upgrade your Internet to business plan </div>
            </div>
            <div class="mt-6">
              <button class="bg-white hover:bg-opacity-80 text-slate-900 text-sm font-Inter rounded-md w-full block py-2 font-medium"> Upgrade </button>
            </div>
          </div>
          <!-- Upgrade Your Business Plan Card Start -->
        </div>
      </div>
      <!-- End: Sidebar -->
      <!-- End: Sidebar -->
      <!-- BEGIN: Settings -->
      <div class="flex flex-col justify-between min-h-screen">
        <div>
          <!-- BEGIN: Header -->
          <!-- BEGIN: Header -->
          <div class="z-[9]" id="app_header">
            <div class="app-header z-[999] ltr:ml-[248px] rtl:mr-[248px] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
              <div class="flex justify-between items-center h-full">
                <div class="flex items-center md:space-x-4 space-x-2 xl:space-x-0 rtl:space-x-reverse vertical-box">
                  <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home" class="mobile-logo xl:hidden inline-block">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="black_logo" alt="logo">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/images/logo.png" class="white_logo" alt="logo">
                  </a>
                  <button class="smallDeviceMenuController hidden md:inline-block xl:hidden">
                    <iconify-icon class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                  </button>
                  <p class=" text-sm leading-5 text-slate-600 dark:text-slate-300 "><?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?> &nbsp; <?php echo Lang::T('Balance');?>
,&nbsp; <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['_user']->value['balance']);?>
 <?php }?></p>
                </div>
                <!-- end vertcial -->
                <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse leading-0">
                  <!-- BEGIN: Language Dropdown  -->
                  <!-- Theme Changer -->
                  <!-- END: Language Dropdown -->
                  <!-- BEGIN: Toggle Theme -->
                  <div>
                    <button id="themeMood" class="h-[28px] w-[28px] lg:h-[32px] lg:w-[32px] lg:bg-gray-500-f7 bg-slate-50 dark:bg-slate-900 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center">
                      <iconify-icon class="text-slate-800 dark:text-white text-xl dark:block hidden" id="moonIcon" icon="line-md:sunny-outline-to-moon-alt-loop-transition"></iconify-icon>
                      <iconify-icon class="text-slate-800 dark:text-white text-xl dark:hidden block" id="sunIcon" icon="line-md:moon-filled-to-sunny-filled-loop-transition"></iconify-icon>
                    </button>
                  </div>
                  <!-- END: TOggle Theme -->
                  <!-- BEGIN: gray-scale Dropdown -->
                  <div>
                    <button id="grayScale" class="lg:h-[32px] lg:w-[32px] lg:bg-slate-100 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer
            rounded-full text-[20px] flex flex-col items-center justify-center">
                      <iconify-icon class="text-slate-800 dark:text-white text-xl" icon="mdi:paint-outline"></iconify-icon>
                    </button>
                  </div>
                  <!-- END: gray-scale Dropdown -->









 <!-- BEGIN: Message Dropdown -->
<div class="relative md:block">
  <button
    class="lg:h-[32px] lg:w-[32px] lg:bg-slate-100 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer
    rounded-full text-[20px] flex flex-col items-center justify-center"
    type="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
  >
    <iconify-icon class="text-slate-800 dark:text-white text-xl" icon="heroicons-outline:mail"></iconify-icon>
    <!-- Notification Count -->
    <?php if ($_smarty_tpl->tpl_vars['unread_count']->value > 0) {?>
    <span
      class="absolute -right-1 lg:top-0 -top-[6px] h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
      justify-center rounded-full text-white z-[45]"
    >
      <?php echo $_smarty_tpl->tpl_vars['unread_count']->value;?>

    </span>
    <?php }?>
  </button>
  <!-- Messages Dropdown Menu -->
  <div
    class="dropdown-menu z-10 hidden bg-white divide-y divide-slate-100 shadow w-80 dark:bg-slate-800 border dark:border-slate-700 !top-[23px] rounded-md
    overflow-hidden"
  >
    <div class="py-2">
      <!-- Display latest messages -->
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['latest_messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>
      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/view/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" class="flex items-start px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-600">
        <div class="flex-1">
          <p class="text-sm text-slate-800 dark:text-white font-semibold"><?php echo $_smarty_tpl->tpl_vars['message']->value['title'];?>
</p>
          <p class="text-xs text-slate-500 dark:text-slate-400 mt-1"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['message']->value['content'],50,"...",true);?>
</p>
          <p class="text-xs text-slate-400 dark:text-slate-500 mt-1"><?php echo $_smarty_tpl->tpl_vars['message']->value['date'];?>
</p>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['message']->value['unread']) {?>
        <span class="ml-2 text-blue-500 text-xs"><?php echo Lang::T('Unread');?>
</span>
        <?php }?>
      </a>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <div class="py-2 text-center">
      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/inbox" class="text-sm text-blue-500"><?php echo Lang::T('View All Messages');?>
</a>
    </div>
  </div>
</div>
<!-- END: Message Dropdown -->














                  <!-- BEGIN: Notification Dropdown -->
                  <!-- Notifications Dropdown area -->
                  <div class="relative md:block hidden">
                    <button class="lg:h-[32px] lg:w-[32px] lg:bg-slate-100 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer
      rounded-full text-[20px] flex flex-col items-center justify-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <iconify-icon class="animate-tada text-slate-800 dark:text-white text-xl" icon="heroicons-outline:bell"></iconify-icon>
                      <span class="absolute -right-1 lg:top-0 -top-[6px] h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
                    justify-center rounded-full text-white z-[99]"> 5</span>
                    </button>
                    <!-- Notifications Dropdown -->
                  </div>
                  <!-- END: Notification Dropdown -->
                  <!-- BEGIN: Profile Dropdown -->
                  <!-- Profile DropDown Area -->
                  <div class="md:block hidden w-full">
                    <button class="text-slate-800 dark:text-white focus:ring-0 focus:outline-none font-medium rounded-lg text-sm text-center
      inline-flex items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="lg:h-8 lg:w-8 h-7 w-7 rounded-full flex-1 ltr:mr-[10px] rtl:ml-[10px]">
                        <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_user']->value['id'];?>
?set=set3&size=100x100&bgset=bg1" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/user.default.jpg'" alt="user" class="border-white block w-full h-full object-cover rounded-full border">
                      </div>
                      <span class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis whitespace-nowrap"><?php echo $_smarty_tpl->tpl_vars['_user']->value['fullname'];?>
</span>
                      <svg class="w-[16px] h-[16px] dark:text-white hidden lg:inline-block text-base inline-block ml-[10px] rtl:mr-[10px]" aria-hidden="true" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu z-10 hidden bg-white divide-y divide-slate-100 shadow w-44 dark:bg-slate-800 border dark:border-slate-700 !top-[23px] rounded-md
      overflow-hidden">
                      <ul class="py-1 text-sm text-slate-800 dark:text-slate-200">
                        <li>
                          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/profile" class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600
                            dark:text-white font-normal">
                            <span class="font-Inter"><?php echo Lang::T('My Account');?>

                          </a>
                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/change-password" class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600
            dark:text-white font-normal">
                            <span class="font-Inter"><?php echo Lang::T('Change Password');?>
</span>
                          </a>
                        </li>
                        <li>
                          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout" class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600
            dark:text-white font-normal">
                            <span class="font-Inter"><?php echo Lang::T('Logout');?>
</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- END: Header -->
                  <button class="smallDeviceMenuController md:hidden block leading-0">
                    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                  </button>
                  <!-- end mobile menu -->
                </div>
                <!-- end nav tools -->
              </div>
            </div>
          </div>
          <!-- END: Header -->
          <!-- END: Header -->
          <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
            <div class="page-content">
              <div class="transition-all duration-150 container-fluid" id="page_layout">
                <div id="content_layout">
                  <!-- BEGIN: Breadcrumb -->
                  <div class="mb-5">
                    <ul class="m-0 p-0 list-none">
                      <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home">
                          <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                          <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                        </a>
                      </li>
                      <li class="inline-block relative text-sm text-primary-500 font-Inter "> <?php echo $_smarty_tpl->tpl_vars['_user']->value['fullname'];?>
 <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                      </li>
                      <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white"> <?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
</li>
                    </ul>
                  </div>

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
                          timer: 5000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                      });
                  <?php echo '</script'; ?>
>
              <?php }
}
}
