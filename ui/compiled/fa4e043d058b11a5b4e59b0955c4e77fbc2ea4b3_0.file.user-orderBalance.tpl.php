<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:53:51
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-orderBalance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c4ef8b0368_10190231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa4e043d058b11a5b4e59b0955c4e77fbc2ea4b3' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-orderBalance.tpl',
      1 => 1705528239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771c4ef8b0368_10190231 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-orderPlan --> <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?> <div class=" space-y-5">
  <div class="card">
    <header class="card-header">
      <div class="card-title"><?php echo Lang::T('Balance Plans');?>
</div>
    </header>
    <div class="card-body p-6">
      <div class="grid xl:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans_balance']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?> <div class="price-table bg-opacity-[0.16] dark:bg-opacity-[0.36] rounded-[6px] p-6 text-slate-900 dark:text-white relative
                overflow-hidden z-[1] bg-info-500">
          <div class="overlay absolute right-0 top-0 w-full h-full z-[-1]">
            <img src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/assets/images/all-img/big-shap2.png" alt="" class="ml-auto block">
          </div>
          <div class="text-sm font-medium bg-slate-900 dark:bg-slate-900 text-white py-2 text-center absolute ltr:-right-[43px]
                    rtl:-left-[43px] top-6 px-10 transform ltr:rotate-[45deg] rtl:-rotate-45"> <?php echo Lang::T('Balance Plans');?>
 </div>
          <header class="mb-6">
            <h4 class="text-xl mb-5"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</h4>
            <div class="space-x-4 relative flex items-center mb-5 rtl:space-x-reverse">
              <span class="text-[32px] leading-10 font-medium"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['plan']->value['price']);?>
</span>
              <span class="text-xs text-warning-500 font-medium px-3 py-1 rounded-full inline-block bg-white uppercase h-auto">Save 20%</span>
            </div>
            <p class="text-slate-500 dark:text-slate-300 text-sm"></p>
          </header>
          <div class="price-body space-y-8">
            <p class="text-sm leading-5 text-slate-600 dark:text-slate-300"></p>
            <div>
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/buy/0/<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Buy Balance?');?>
')">
                <button class="btn-outline-dark dark:border-slate-400 w-full btn"> Order Now</button>
              </a>
            </div>
          </div>
        </div> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </div>
    </div>
  </div>
</div>
<?php }
$_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
