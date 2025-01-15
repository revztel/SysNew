<?php
/* Smarty version 4.3.1, created on 2024-12-30 01:53:10
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771d2d6ca6990_82260701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e345678f25e4003afadda3e9c183897a9fe5dfc' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-dashboard.tpl',
      1 => 1735512780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771d2d6ca6990_82260701 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- BEGIN: Company Table -->
<div class="space-y-5">
  <!-- BEGIN: BreadCrumb -->
  <div class="flex justify-between flex-wrap items-center mb-6">
    <h4 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0"><?php echo Lang::T('Your Account Information');?>
</h4>
    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse"> <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes') {?> <button class="btn inline-flex justify-center btn-outline-success rounded-[25px] btn-sm m-1 active" data-bs-toggle="modal" data-bs-target="#voucher_modal">
        <span class="flex items-center">
          <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:credit-card"></iconify-icon>
          <span>Redeem Voucher</span>
        </span>
      </button> <?php }?> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_c']->value['allow_balance_transfer'] == 'yes') {?> <button class="btn inline-flex justify-center btn-outline-warning rounded-[25px] btn-sm m-1 active" data-bs-toggle="modal" data-bs-target="#transfer_modal">
        <span class="flex items-center">
          <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="basil:telegram-outline"></iconify-icon>
          <span><?php echo Lang::T("Transfer Balance");?>
</span>
        </span>
      </button> <?php }?> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_c']->value['allow_balance_transfer'] == 'yes') {?> <button class="btn inline-flex justify-center btn-outline-primary rounded-[25px] btn-sm m-1 active" data-bs-toggle="modal" data-bs-target="#plan_modal">
        <span class="flex items-center">
          <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:user-plus"></iconify-icon>
          <span><?php echo Lang::T("Recharge a friend");?>
</span>
        </span>
      </button> <?php }?>
    </div>
  </div>
</div>
<div class="space-y-5">
<!--  <div class="py-[18px] px-6 font-normal font-Inter text-sm rounded-md bg-danger-500 text-white dark:bg-danger-500 dark:text-slate-300">
    <div class="flex items-start space-x-3 rtl:space-x-reverse">
      <div class="flex-1"> An error occured while connection to the network. </div>
    </div>
  </div> -->
  <div class="grid grid-cols-12 gap-5 mb-5">
    <div class="2xl:col-span-3 lg:col-span-4 col-span-12">
      <div class="bg-no-repeat bg-cover bg-center p-5 rounded-[6px] relative" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/widget-bg-2.png)">
        <div class="max-w-[180px]">
          <h4 class="text-xl font-medium text-white mb-2">
            <span class="block font-normal" id="greeting"></span>
            <span class="block" id="fullnameSpan"><?php echo $_smarty_tpl->tpl_vars['_user']->value['fullname'];?>
</span>
          </h4>
          <p class="text-sm text-white font-normal"> Welcome to <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
 </p>
        </div>
      </div>
    </div>
    <div class="2xl:col-span-9 lg:col-span-8 col-span-12">
      <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
        <!-- BEGIN: Group Chart -->
        <div class="bg-no-repeat bg-cover bg-center px-5 py-8 rounded-[6px] relative flex items-center" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/widget-bg-6.png)">
          <div class="flex-1">
            <div class="max-w-[180px]">
              <h4 class="text-2xl font-medium text-white mb-2">
                <span class="block text-sm">Current Balance</span>
                <span class="block"><?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['_user']->value['balance']);?>
 <?php } else { ?> N/A <?php }?></span>
              </h4>
            </div>
          </div> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?> <div class="flex-none"> <?php if ($_smarty_tpl->tpl_vars['_user']->value['auto_renewal'] == 1) {?> <button class="btn-success bg-white btn-sm btn">
              <a class="label label-success pull-right" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home&renewal=0" onclick="return confirm('<?php echo Lang::T('Disable auto renewal?');?>
')"><?php echo Lang::T('Auto Renewal On');?>
</a>
            </button> <?php } else { ?> <button class="btn-danger bg-white btn-sm btn">
              <a class="label label-danger pull-right" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home&renewal=1" onclick="return confirm('<?php echo Lang::T('Enable auto renewal?');?>
')"><?php echo Lang::T('Auto Renewal Off');?>
</a>
            </button> <?php }?> </div> <?php } else { ?> <div class="flex-none">
            <button class="btn inline-flex justify-center btn-sm btn-danger cursor-not-allowed light" disabled="disabled"><?php echo Lang::T('Auto Renewal Off');?>
</button>
          </div> <?php }?>
        </div>
         <?php if ($_smarty_tpl->tpl_vars['_bills']->value) {?>
        <div class="bg-no-repeat bg-cover bg-center px-5 py-8 rounded-[6px] relative flex items-center" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/widget-bg-6.png)">
          <div class="flex-1">
            <div class="max-w-[180px]">
              <h4 class="text-2xl font-medium text-white mb-2">
                <span class="block text-sm">Account Status</span>
                <span class="block">
                  <?php $_smarty_tpl->_assignInScope('isActiveFlag', false);?>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_bills']->value, '_bill');
$_smarty_tpl->tpl_vars['_bill']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_bill']->value) {
$_smarty_tpl->tpl_vars['_bill']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['_bill']->value['status'] == 'on') {?>
                   <?php $_smarty_tpl->_assignInScope('isActiveFlag', true);?>
                   <?php }?>
                 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                 <?php if ($_smarty_tpl->tpl_vars['isActiveFlag']->value) {?>
               <font color="green">Active</font>
                 <?php } else { ?>
               <font color="red">Inactive</font>
              <?php }?></span>
              </h4>
            </div>
          </div>
          <div class="flex-none">
            <button onClick="window.location.reload();" class="btn-primary bg-white btn-sm btn">Refresh</button>
          </div>
        </div>

        <div class="bg-no-repeat bg-cover bg-center px-5 py-8 rounded-[6px] relative flex items-center" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/widget-bg-6.png)">
          <div class="flex-1">
            <div class="max-w-[180px]">
             <h4 class="text-sm font-medium text-white mb-2">
    <span class="block text-sm">
        <?php if ($_smarty_tpl->tpl_vars['_bills']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_bills']->value, '_bill');
$_smarty_tpl->tpl_vars['_bill']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_bill']->value) {
$_smarty_tpl->tpl_vars['_bill']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['_bill']->value['status'] == 'on') {?>
                    <?php echo $_smarty_tpl->tpl_vars['_bill']->value['namebp'];?>
 &nbsp;
                    <span class="badge bg-primary-500 text-small text-white capitalize">
                        <a class="flex-none" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home&deactivate=<?php echo $_smarty_tpl->tpl_vars['_bill']->value['id'];?>
"
                            onclick="return confirm('<?php echo Lang::T('Deactivate');?>
?')"><?php echo Lang::T('Deactivate');?>
</a>
                    </span>
                    <br>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
            <span class="block text-sm"><?php echo Lang::T('Plan Name');?>
</span><span class="block"><?php echo Lang::T('Buy Package');?>
</span>
        <?php }?>
    </span>
</h4>

            </div>
          </div>
        </div>
        <?php }?>
        <!-- END: Group Chart -->
      </div>
    </div>
  </div>
  <div class=" space-y-5">
    <div class="grid grid-cols-12 gap-5">
      <div class="lg:col-span-8 col-span-12 space-y-5">

        <div class="card">
          <header class=" card-header">
            <h4 class="card-title">Data Usage | Coming Soon  </h4>
          </header>
          <div class="card-body px-6 pb-6">
            <div id="areaSpaline"></div>
          </div>
        </div>
      </div>
      <div class="lg:col-span-4 col-span-12 space-y-5">
        <div class="lg:col-span-4 col-span-12 space-y-5">
          <div class="card">
            <header class="card-header">
              <h4 class="card-title"> <?php echo Lang::T('Announcement');?>
 </h4>
              <div></div>
            </header>
            <div class="card-body p-6">
              <p class="text-sm font-Inter text-slate-600 dark:text-slate-300"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['_path']->value)."/../pages/Announcement.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></p>
            </div>
          </div>
          <div class="card">
            <header class="card-header">
              <h4 class="card-title"> Account Overview </h4>
              <div>
                <!-- BEGIN: Card Dropdown -->
                <div class="relative">
                  <div class="dropdown relative"></div>
                </div>
                <!-- END: Card Droopdown -->
              </div>
            </header>
            <div class="card-body p-6">
              <div class="legend-ring3">
                <div id="">
                  <div class="card-body px-6 pb-6">
                    <div class="overflow-x-auto ">
                      <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                          <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                            <tbody class="bg-white dark:bg-slate-800 ">
                              <tr>
                                <td class="table-td "> <?php echo Lang::T('Username');?>
&nbsp;: <br> <?php echo $_smarty_tpl->tpl_vars['_user']->value['username'];?>
 </td>
                                <td class="table-td "> <?php echo Lang::T('Password');?>
&nbsp;: <br>
                                  <input type="password" value="<?php echo $_smarty_tpl->tpl_vars['_user']->value['password'];?>
" style="width:100%; border: 0px; color: red;" onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'" onclick="this.select()">
                                </td>
                                <td class="table-td  "> <?php echo Lang::T('Balance');?>
&nbsp;: <br> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['_user']->value['balance']);?>
 <?php } else { ?> N/A <?php }?> </td>
                              </tr>
                               <?php if ($_smarty_tpl->tpl_vars['_bills']->value) {?>
                              <tr>
                                <td class="table-td "><?php echo Lang::T('Plan Name');?>
&nbsp;: <br><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_bills']->value, '_bill');
$_smarty_tpl->tpl_vars['_bill']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_bill']->value) {
$_smarty_tpl->tpl_vars['_bill']->do_else = false;
?>
                                    <?php echo $_smarty_tpl->tpl_vars['_bill']->value['namebp'];?>
 &nbsp;
                                    <?php if ($_smarty_tpl->tpl_vars['_bill']->value['status'] == 'on') {?>
                                            <a class="flex-none" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home&deactivate=<?php echo $_smarty_tpl->tpl_vars['_bill']->value['id'];?>
"
                                                onclick="return confirm('<?php echo Lang::T('Deactivate');?>
?')"><font color="red"><?php echo Lang::T('Deactivate');?>
</font></a>
                                        </span>
                                    <?php } else { ?>

                                            <a class="flex-none" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/package"><font color="red"><?php echo Lang::T('expired');?>
</font></a>

                                    <?php }?><br>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td>
                                <td class="table-td "><?php echo Lang::T('Created On');?>
 <br> <?php if ($_smarty_tpl->tpl_vars['_bill']->value['time'] != '') {
echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['_bill']->value['recharged_on'],$_smarty_tpl->tpl_vars['_bill']->value['recharged_time']);?>
 <?php }?> </td>
                                <td class="table-td  "> <?php echo Lang::T('Expires On');?>
&nbsp;: <br> <?php if ($_smarty_tpl->tpl_vars['_bill']->value['time'] != '') {
echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['_bill']->value['expiration'],$_smarty_tpl->tpl_vars['_bill']->value['time']);
}?> </td>
                              </tr>
                              <tr>
                                <td class="table-td "> <?php echo Lang::T('Current IP');?>
&nbsp;: <br> <?php if ($_smarty_tpl->tpl_vars['nux_ip']->value) {?> <br> <?php echo $_smarty_tpl->tpl_vars['nux_ip']->value;?>
 <?php } else { ?> N/A <?php }?> </td>
                                <td class="table-td "> <?php echo Lang::T('Current MAC');?>
&nbsp;: <br> <?php if ($_smarty_tpl->tpl_vars['nux_mac']->value) {?> <br> <?php echo $_smarty_tpl->tpl_vars['nux_mac']->value;?>
 <?php } else { ?> N/A <?php }?> </td>
                                <td id="login_status_<?php echo $_smarty_tpl->tpl_vars['_bill']->value['id'];?>
" class="table-td "><?php echo Lang::T('Login Status');?>
 <br> <?php if ($_smarty_tpl->tpl_vars['_bill']->value['type'] == 'Hotspot' && $_smarty_tpl->tpl_vars['_bill']->value['status'] == 'on') {?> <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/loading.gif">
                                </td> <?php }?>
                              </tr>
                              <?php }?>
                              <tr>
                                <td class="table-td "> <?php echo Lang::T('Service Type');?>
&nbsp;: <br> <?php if ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'Hotspot') {?>
                                     Hotspot
                                  <?php } elseif ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'PPPoE') {?>
                                     PPPoE
                                      <?php } elseif ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'Static') {?>
                                     Static
                                    <?php } elseif ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'Others' || $_smarty_tpl->tpl_vars['_user']->value['service_type'] == null) {?>
                                  Others
                                 <?php }?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="transfer_modal" tabindex="-1" aria-labelledby="transfer_modal" aria-hidden="true">
  <div class="modal-dialog relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                    rounded-md outline-none text-current">
      <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
          <h3 class="text-xl font-medium text-white dark:text-white capitalize"> <?php echo Lang::T("Transfer Balance");?>
&nbsp;| <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['_user']->value['balance']);?>
 </h3>
          <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                                dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                        11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div>
          <form method="post" onsubmit="return askConfirm()" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home">
            <div class="p-6 space-y-6">
              <div class="input-group">
                <label for="username" class="text-sm font-Inter font-normal text-slate-900 block"></label>
                <div class="relative">
                  <input type="text" id="username" name="username" required autocomplete="on" placeholder="input the receiver username" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border !border-slate-400 rounded-md mt-2">
                </div>
                <div class="input-group">
                  <label for="balance" class="text-sm font-Inter font-normal text-slate-900 block"></label>
                  <div class="relative">
                    <input type="number" id="balance" name="balance" required placeholder="input the required amount" autocomplete="off" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 pr-9 focus:!outline-none  focus:!ring-0 border !border-slate-400 rounded-md mt-2">
                  </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                  <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary rounded-[25px]">Cancel</button>
                  <button class="btn btn-outline-success rounded-[25px]" id="sendBtn" type="submit" name="send" onclick="return confirm('<?php echo Lang::T(" Are You Sure?");?>
')" value="balance">Transfer</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="voucher_modal" tabindex="-1" aria-labelledby="voucher_modal" aria-hidden="true">
  <div class="modal-dialog relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                    rounded-md outline-none text-current">
      <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
          <h3 class="text-xl font-medium text-white dark:text-white capitalize"> <?php echo Lang::T('Voucher Activation');?>
 </h3>
          <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                                dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                        11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div>
          <form method="post" role="form" class="" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
voucher/activation-post">
            <div class="p-6 space-y-6">
              <div class="input-group">
                <label for="voucher" class="text-sm font-Inter font-normal text-slate-900 block">
                  <h6><?php echo Lang::T('Code Voucher');?>
</h6>
                </label>
                <div class="relative">
                  <input type="text" id="code" name="code" required placeholder="<?php echo Lang::T('Enter voucher code here');?>
" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                              !border-slate-400 rounded-md mt-2">
                </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button type="button" data-bs-dismiss="modal" class="btn  btn-outline-primary rounded-[25px]">Cancel</button>
                <button type="submit" class="btn btn-outline-success rounded-[25px]"><?php echo Lang::T('Recharge');?>
</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="plan_modal" tabindex="-1" aria-labelledby="plan_modal" aria-hidden="true">
  <div class="modal-dialog relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                  rounded-md outline-none text-current">
      <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
          <h3 class="text-xl font-medium text-white dark:text-white capitalize"> <?php echo Lang::T("Recharge a friend");?>
 </h3>
          <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                              dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                      11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div>
          <form method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home">
            <div class="p-6 space-y-6">
              <div class="input-group">
                <label for="voucher" class="text-sm font-Inter font-normal text-slate-900 block">
                  <h6><?php echo Lang::T('Username');?>
</h6>
                </label>
                <div class="relative">
                  <input type="text" id="username" name="username" required placeholder="input the receiver username" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                          !border-slate-400 rounded-md mt-2">
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                  <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary rounded-[25px]">Cancel</button>
                  <button class="btn btn-outline-success rounded-[25px]" id="sendBtn" type="submit" name="send" onclick="return confirm('<?php echo Lang::T(" Are You Sure?");?>
')" value="plan"><?php echo Lang::T('Recharge');?>
</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_bills']->value, '_bill');
$_smarty_tpl->tpl_vars['_bill']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_bill']->value) {
$_smarty_tpl->tpl_vars['_bill']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['_bill']->value['type'] == 'Hotspot' && $_smarty_tpl->tpl_vars['_bill']->value['status'] == 'on') {?>
        <?php echo '<script'; ?>
>
            setTimeout(() => {
                $.ajax({
                    url: "index.php?_route=autoload_user/isLogin/<?php echo $_smarty_tpl->tpl_vars['_bill']->value['id'];?>
",
                    cache: false,
                    success: function(msg) {
                        $("#login_status_<?php echo $_smarty_tpl->tpl_vars['_bill']->value['id'];?>
").html(msg);
                    }
                });
            }, 2000);
        <?php echo '</script'; ?>
>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
echo '<script'; ?>
>
    var greeting;
    var time = new Date().getHours();
    if (time < 12) {
      greeting = "Good Morning,";
    } else if (time < 18) {
      greeting = "Good Afternoon,";
    } else if (time < 24) {
      greeting = "Good Evening,"
    } else {
      greeting = "Welcome";
    }
    document.getElementById("greeting").innerHTML = greeting;
  <?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    function askConfirm() {
      if (confirm('<?php echo Lang::T('
          Send your balance ? ');?>
')) {
        setTimeout(() => {
          document.getElementById('sendBtn').setAttribute('disabled', '');
        }, 1000);
        return true;
      }
      return false;
    }
  <?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    var fullnameSpan = document.getElementById("fullnameSpan");
    var maxlength = 12;
    var content = fullnameSpan.innerHTML;
    if (content.length > maxlength) {
        fullnameSpan.innerHTML = content.substring(0, maxlength) + "...";
    }
<?php echo '</script'; ?>
>
 <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
$(document).ready(function() {
    // Set an interval to check for the button every 2 seconds
    var checkInterval = setInterval(function() {
        var button = $('.btn-danger').filter(function() {
            return $(this).text() === 'Not Online, Login now?';
        });
        if (button.length) {
            button[0].click(); // Click the button
            clearInterval(checkInterval); // Stop checking after the button is clicked
        }
    }, 200); // Check every 2 seconds
});
<?php echo '</script'; ?>
>

<?php }
}
