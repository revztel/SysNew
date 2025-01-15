<?php
/* Smarty version 4.3.1, created on 2025-01-03 01:13:19
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-orderPlan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67770f7f6d5c62_66313134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89b621ec1e17dc1a2388bc97d4f5659b316344ab' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-orderPlan.tpl',
      1 => 1735850017,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_67770f7f6d5c62_66313134 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-orderPlan -->
<?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>
  <!-- Check if user's service type is PPPoE and if there are PPPoE plans available -->
  <?php if ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'PPPoE' && Lang::arrayCount($_smarty_tpl->tpl_vars['radius_pppoe']->value) > 0) {?>
  <div class="space-y-5">
    <div class="card">
      <header class="card-header">
        <div class="card-title">
          <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_plan'] == '') {?>Radius Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['radius_plan'];
}?> | <?php if ($_smarty_tpl->tpl_vars['_c']->value['pppoe_plan'] == '') {?>PPPoE Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['pppoe_plan'];
}?>
        </div>
      </header>
      <div class="card-body p-6">
        <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['radius_pppoe']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
          <!-- PPPoE Plan Display Logic Here -->
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
      </div>
    </div>
  </div>









    <div class="card-body p-6">


<div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['radius_hotspot']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?> <div class="price-table bg-opacity-[0.16] dark:bg-opacity-[0.36] rounded-[6px] p-6 text-slate-900 dark:text-white relative
                  overflow-hidden z-[1] bg-warning-500">
          <div class="overlay absolute right-0 top-0 w-full h-full z-[-1]">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/big-shap2.png" alt="" class="ml-auto block">
          </div>




          <div class="text-sm font-medium bg-slate-900 dark:bg-slate-900 text-white py-2 text-center absolute ltr:-right-[43px]
                      rtl:-left-[43px] top-6 px-10 transform ltr:rotate-[45deg] rtl:-rotate-45"> <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_plan'] == '') {?>Radius Plan<?php } else {
echo $_smarty_tpl->tpl_vars['_c']->value['radius_plan'];
}?> </div>
          <header class="mb-6">
            <h4 class="text-xl mb-5"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</h4>
            <div class="space-x-4 relative flex items-center mb-5 rtl:space-x-reverse">
              <span class="text-[32px] leading-10 font-medium"> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
 </span>
              <span class="text-xs text-warning-500 font-medium px-3 py-1 rounded-full inline-block bg-white uppercase h-auto">Save 20%</span>
            </div>
            <p class="text-slate-500 dark:text-slate-300 text-sm"> <?php echo Lang::T('Validity');?>
 : <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
 </p>
          </header>
          <div class="price-body space-y-8">
            <p class="text-sm leading-5 text-slate-600 dark:text-slate-300">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td>Service Type:&nbsp; </td>
                  <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
</td>
                </tr>
                <tr>
                  <td>Include:&nbsp; </td>
                  <td> 24/7 Support</td>
                </tr>
                <tr>
                  <td>Include:&nbsp; </td>
                  <td>Speed Burst</td>
                </tr>
              </tbody>
            </table>
            </p>
            <div>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/buy/radius/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Buy this? your active package will be overwrite');?>
')">
                <button class="btn-outline-dark dark:border-slate-400 w-full btn"> Order Now</button>
              </a>
            </div> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_user']->value['balance'] >= $_smarty_tpl->tpl_vars['plan']->value['price']) {?> <div>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/pay/radius/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Pay this with Balance? your active package will be overwrite');?>
')">
                <button class="btn-outline-dark dark:border-slate-400 w-full btn"> <?php echo Lang::T('Pay With Balance');?>
</button>
              </a>
            </div> <?php }?>
          </div>
        </div> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
    </div>
  </div>
</div> <?php }
}?>

<br> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?> <div class=" space-y-5">
  <div class="card">
    <header class="card-header">
      <div class="card-title"><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
 | <?php if ($_smarty_tpl->tpl_vars['router']->value['description'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['router']->value['description'];?>
 <?php }?> <?php echo $_smarty_tpl->tpl_vars['_user']->value['service_type'];?>
 </div>
    </header>
    <div class="card-body p-6"> <?php if ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'Hotspot') {?> <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans_hotspot']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['router']->value['name'] == $_smarty_tpl->tpl_vars['plan']->value['routers']) {?> <div class="price-table bg-opacity-[0.16] dark:bg-opacity-[0.36] rounded-[6px] p-6 text-slate-900 dark:text-white relative
                  overflow-hidden z-[1] bg-primary-500">
          <div class="overlay absolute right-0 top-0 w-full h-full z-[-1]">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/big-shap3.png" alt="" class="ml-auto block">
          </div>
          <div class="text-sm font-medium bg-slate-900 dark:bg-slate-900 text-white py-2 text-center absolute ltr:-right-[43px]
                      rtl:-left-[43px] top-6 px-10 transform ltr:rotate-[45deg] rtl:-rotate-45"> <?php echo Lang::T('Hotspot Plan');?>
 </div>
          <header class="mb-6">
            <h4 class="text-xl mb-5"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</h4>
            <div class="space-x-4 relative flex items-center mb-5 rtl:space-x-reverse">
              <span class="text-[32px] leading-10 font-medium"> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
 </span>
              <span class="text-xs text-warning-500 font-medium px-3 py-1 rounded-full inline-block bg-white uppercase h-auto">Save 20%</span>
            </div>
            <p class="text-slate-500 dark:text-slate-300 text-sm"> <?php echo Lang::T('Validity');?>
 : <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
 </p>
          </header>
          <div class="price-body space-y-8">
            <p class="text-sm leading-5 text-slate-600 dark:text-slate-300">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td>Service Type:&nbsp; </td>
                  <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
</td>
                </tr>
                <tr>
                  <td>Include:&nbsp; </td>
                  <td> 24/7 Support</td>
                </tr>
                <tr>
                  <td>Include:&nbsp; </td>
                  <td>Speed Burst</td>
                </tr>
              </tbody>
            </table>
            </p>
            <div>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/buy/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Order Now? If you have an active Package Amount will be added to balance');?>
')">
                <button class="btn-outline-dark dark:border-slate-400 w-full btn"> Order Now</button>
              </a>
            </div> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_user']->value['balance'] >= $_smarty_tpl->tpl_vars['plan']->value['price']) {?> <div>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/pay/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Pay this with Balance? your active package will be overwrite');?>
')">
                <button class="btn-outline-dark dark:border-slate-400 w-full btn"> <?php echo Lang::T('Pay With Balance');?>
</button>
              </a>
            </div> <?php }?>
          </div>
        </div> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
    </div>
  </div> <?php }?> 
  
  <!--static start-->
  
    <?php if ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'Static') {?>
    <!-- Add your Static service type logic here -->
    <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5"> 
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans_static']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
  
                <div class="col col-md-4">
                    <div class="box box- box-primary">
    <div class="price-table rounded-[6px] shadow-base dark:bg-slate-800 p-6 text-slate-900 dark:text-white relative
                      overflow-hidden z-[1] bg-slate-900">
      <div class="overlay absolute right-0 top-0 w-full h-full z-[-1]">
        <img src="" alt="" class="ml-auto block">
      </div>
      <div class="text-sm font-medium bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-300 py-2 text-center absolute
                          ltr:-right-[43px] rtl:-left-[43px] top-6 px-10 transform ltr:rotate-[45deg] rtl:-rotate-45"> <?php echo Lang::T('Static Plan');?>
 </div>
      <header class="mb-6">
        <h4 class="text-xl mb-5  text-slate-100  "> <?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
 </h4>
        <div class="space-x-4 relative flex items-center mb-5 rtl:space-x-reverse  text-slate-100  ">
          <span class="text-[32px] leading-10 font-medium"> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
 </span>
          <span class="text-xs bg-warning-50 text-warning-500 font-medium px-2 py-1 rounded-full inline-block dark:bg-slate-700 uppercase
                            h-auto"> Save 20%</span>
        </div>
        <p class="text-sm leading-5  text-slate-100"> <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
 </p>
      </header>
      <div class="price-body space-y-8">
        <table class=" text-sm leading-5  text-slate-100">
          <tbody>
            <tr>
              <td>Service Type:&nbsp; </td>
              <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
</td>
            </tr>
            <tr>
              <td>Include:&nbsp; </td>
              <td> 24/7 Support</td>
            </tr>
            <tr>
              <td>Include: &nbsp; </td>
              <td>Speed Burst</td>
            </tr>
          </tbody>
        </table>
        <div>
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/buy/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Order Now? If you have an active Package Amount will be added to balance');?>
')">
            <button class="w-full btn bt text-slate-100 border-slate-300 border "> Order Now </button>
          </a>
        </div> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_user']->value['balance'] >= $_smarty_tpl->tpl_vars['plan']->value['price']) {?> <div>
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/pay/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Pay this with Balance? your active package will be overwrite');?>
')">
            <button class="w-full btn  text-slate-100 border-slate-300 border "> <?php echo Lang::T('Pay With Balance');?>
 </button>
          </a>
        </div> <?php }?>
      </div>
    </div>  </div> </div>

    
    
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php }?>
  
      
  <!--static end -->
  
  
  
 <?php if ($_smarty_tpl->tpl_vars['_user']->value['service_type'] == 'PPPoE' && count($_smarty_tpl->tpl_vars['plans_pppoe']->value) > 0) {?>
 <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans_pppoe']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['router']->value['name'] == $_smarty_tpl->tpl_vars['plan']->value['routers']) {?> <div class="price-table rounded-[6px] shadow-base dark:bg-slate-800 p-6 text-slate-900 dark:text-white relative
                      overflow-hidden z-[1] bg-slate-900">
      <div class="overlay absolute right-0 top-0 w-full h-full z-[-1]">
        <img src="" alt="" class="ml-auto block">
      </div>
      <div class="text-sm font-medium bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-300 py-2 text-center absolute
                          ltr:-right-[43px] rtl:-left-[43px] top-6 px-10 transform ltr:rotate-[45deg] rtl:-rotate-45"> <?php echo Lang::T('PPPOE Plan');?>
 </div>
      <header class="mb-6">
        <h4 class="text-xl mb-5  text-slate-100  "> <?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
 </h4>
        <div class="space-x-4 relative flex items-center mb-5 rtl:space-x-reverse  text-slate-100  ">
          <span class="text-[32px] leading-10 font-medium"> <?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
 </span>
          <span class="text-xs bg-warning-50 text-warning-500 font-medium px-2 py-1 rounded-full inline-block dark:bg-slate-700 uppercase
                            h-auto"> Save 20%</span>
        </div>
        <p class="text-sm leading-5  text-slate-100"> <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity'];?>
 <?php echo $_smarty_tpl->tpl_vars['plan']->value['validity_unit'];?>
 </p>
      </header>
      <div class="price-body space-y-8">
        <table class=" text-sm leading-5  text-slate-100">
          <tbody>
            <tr>
              <td>Service Type:&nbsp; </td>
              <td><?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
</td>
            </tr>
            <tr>
              <td>Include:&nbsp; </td>
              <td> 24/7 Support</td>
            </tr>
            <tr>
              <td>Include: &nbsp; </td>
              <td>Speed Burst</td>
            </tr>
          </tbody>
        </table>
        <div>
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/buy/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Order Now? If you have an active Package Amount will be added to balance');?>
')">
            <button class="w-full btn bt text-slate-100 border-slate-300 border "> Order Now </button>
          </a>
        </div> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes' && $_smarty_tpl->tpl_vars['_user']->value['balance'] >= $_smarty_tpl->tpl_vars['plan']->value['price']) {?> <div>
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/pay/<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Pay this with Balance? your active package will be overwrite');?>
')">
            <button class="w-full btn  text-slate-100 border-slate-300 border "> <?php echo Lang::T('Pay With Balance');?>
 </button>
          </a>
        </div> <?php }?>
      </div>
    </div>  <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div>
</div><br>  <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
