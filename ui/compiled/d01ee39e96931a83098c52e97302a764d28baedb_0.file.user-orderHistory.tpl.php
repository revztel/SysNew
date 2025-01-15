<?php
/* Smarty version 4.3.1, created on 2024-12-30 01:02:31
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-orderHistory.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c6f79569f9_93705022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd01ee39e96931a83098c52e97302a764d28baedb' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-orderHistory.tpl',
      1 => 1710961526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771c6f79569f9_93705022 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-orderHistory -->
<div class=" space-y-5">
  <div class="card">
    <header class=" card-header noborder">
      <h4 class="card-title"><?php echo Lang::T('Order History');?>
 </h4>
    </header>
    <div class="card-body px-6 pb-6">
      <div class="overflow-x-auto -mx-6 dashcode-data-table">
        <span class=" col-span-8  hidden"></span>
        <span class="  col-span-4 hidden"></span>
        <div class="inline-block min-w-full align-middle">
          <div class="overflow-hidden ">
            <table id="datatable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
              <thead class=" bg-slate-200 dark:bg-slate-700">
                <tr>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Plan Name');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Gateway');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Routers');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Type');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Plan Price');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Created On');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Expires On');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Date Done');?>
 </th>
                  <th scope="col" class=" table-th "> <?php echo Lang::T('Method');?>
 </th>
                  <th scope="col" class=" table-th "> Action </th>
                </tr>
              </thead> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?> <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                <tr>
                  <td class="table-td"><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                  <td class="table-td "><?php echo $_smarty_tpl->tpl_vars['ds']->value['gateway'];?>
</td>
                  <td class="table-td "><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                  <td class="table-td "><?php echo $_smarty_tpl->tpl_vars['ds']->value['payment_channel'];?>
</td>
                  <td class="table-td ">
                    <div><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</div>
                  </td>
                  <td class="table-td ">
                    <div> <?php echo date(((string)$_smarty_tpl->tpl_vars['_c']->value['date_format'])." H:i",strtotime($_smarty_tpl->tpl_vars['ds']->value['created_date']));?>
 </div>
                  </td>
                  <td class="table-td ">
                    <div> <?php echo date(((string)$_smarty_tpl->tpl_vars['_c']->value['date_format'])." H:i",strtotime($_smarty_tpl->tpl_vars['ds']->value['expired_date']));?>
 </div>
                  </td>
                  <td class="table-td ">
                    <div> <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] != 1) {
echo date(((string)$_smarty_tpl->tpl_vars['_c']->value['date_format'])." H:i",strtotime($_smarty_tpl->tpl_vars['ds']->value['paid_date']));
}?> </div>
                  </td>
                  <td class="table-td "> <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 1) {?> <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                              bg-warning-500"><?php echo Lang::T('UNPAID');?>
</div> <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 2) {?> <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                            bg-success-500"><?php echo Lang::T('Paid');?>
</div> <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 3) {?> <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-secondary-500
                              bg-secondary-500"><?php echo Lang::T('FAILED');?>
</div> <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 4) {?> <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500"><?php echo Lang::T('CANCELED');?>
</div> <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 5) {?> <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-primary-500
                              bg-primary-500"><?php echo Lang::T('UNKNOWN');?>
</div> <?php }?> </td>
                  <td class="table-td ">
                    <div class="flex space-x-3 rtl:space-x-reverse">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
order/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                        <button class="action-btn" type="button">
                          <iconify-icon icon="heroicons:eye"></iconify-icon>
                        </button>
                      </a>
                    </div>
                  </td>
                </tr> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

</div> <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
