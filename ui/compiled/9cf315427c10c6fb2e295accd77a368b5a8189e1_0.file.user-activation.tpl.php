<?php
/* Smarty version 4.3.1, created on 2024-12-30 01:54:41
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-activation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771d3319f04b1_33444918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9cf315427c10c6fb2e295accd77a368b5a8189e1' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-activation.tpl',
      1 => 1710960664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771d3319f04b1_33444918 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-activation -->
<div class="grid grid-cols-12 gap-6">
  <div class="lg:col-span-4 col-span-12">
    <div class="card h-full">
      <div class="card">
        <div class="card-body flex flex-col p-6">
          <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white"><?php echo Lang::T('Voucher Activation');?>
</div>
            </div>
          </header>
          <div class="card-text h-full">
            <form class="space-y-4" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
voucher/activation-post">
              <div class="input-area">
                <label for="" class="form-label"><?php echo Lang::T('Code Voucher');?>
</label>
                <input id="code" name="code" type="text" class="form-control" required placeholder="<?php echo Lang::T('Enter voucher code here');?>
">
              </div>
              <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home">
                  <button type="button" class="btn  btn-outline-primary rounded-[25px]"><?php echo Lang::T('Cancel');?>
</button>
                </a>
                <button type="submit" class="btn btn-outline-success rounded-[25px]"><?php echo Lang::T('Recharge');?>
</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="lg:col-span-8 col-span-12">
    <div class="card ">
      <header class="card-header">
        <h4 class="card-title"><?php echo Lang::T('Order Voucher');?>
 </h4>
      </header>
      <div class="card-body">
        <div class="card-body p-6">
          <p class="text-base text-slate-600 dark:text-slate-400 leading-6"> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['_path']->value)."/../pages/Order_Voucher.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> </p>
        </div>
      </div>
    </div>
  </div>
</div> <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
