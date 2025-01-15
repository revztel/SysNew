<?php
/* Smarty version 4.3.1, created on 2024-12-30 00:53:46
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-activation-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6771c4ead5ea76_36450852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85f4d7f5b6472fa3230a0dd41e0623dd440ac59c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-activation-list.tpl',
      1 => 1710960774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_6771c4ead5ea76_36450852 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-activation-list -->
<div class="card">
  <header class=" card-header noborder">
    <h4 class="card-title"><?php echo Lang::T('List Activated Voucher');?>
 </h4>
  </header>
  <div class="card-body px-6 pb-6">
    <div class="overflow-x-auto -mx-6">
      <div class="inline-block min-w-full align-middle">
        <div class="overflow-hidden ">
          <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
            <thead class="bg-slate-200 dark:bg-slate-700">
              <tr>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Username');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Plan Name');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Plan Price');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Type');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Created On');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Expires On');?>
 </th>
                <th scope="col" class=" table-th "> <?php echo Lang::T('Method');?>
 </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?> <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                <td class="table-td"><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                <td class="table-td"><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                <td class="table-td "><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                <td class="table-td "><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                <td class="table-td "><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>
</td>
                <td class="table-td "><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                <td class="table-td "><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
              </tr> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br> <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>
 <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
