<?php
/* Smarty version 4.3.1, created on 2024-10-08 17:02:11
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-message-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67053b63d12ad1_44846560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '614debfabd3478f5ee358334315ae44cd0ef0093' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-message-view.tpl',
      1 => 1728395473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_67053b63d12ad1_44846560 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- Message View -->
<div class="grid grid-cols-1 gap-6">
  <div class="card shadow-lg rounded-lg bg-white dark:bg-slate-800">
    <div class="card-body p-6">
      <header class="flex justify-between mb-5 items-center border-b border-slate-200 dark:border-slate-700 pb-5">
        <div class="flex-1">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white"><?php echo $_smarty_tpl->tpl_vars['message']->value['title'];?>
</h2>
          <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo $_smarty_tpl->tpl_vars['message']->value['date'];?>
</p>
        </div>
        <div class="flex space-x-4 rtl:space-x-reverse">
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/mark-as-unread/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" class="flex items-center text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white" title="<?php echo Lang::T('Mark as Unread');?>
">
            <iconify-icon icon="heroicons-outline:bookmark" class="text-2xl"></iconify-icon>
            <span class="ml-2 hidden sm:inline-block"><?php echo Lang::T('Mark as Unread');?>
</span>
          </a>
        </div>
      </header>

      <div class="bg-gray-50 dark:bg-slate-700 rounded-md p-4 mb-5">
        <p class="text-slate-800 dark:text-slate-200">
          <!-- Display personalized message content -->
          <?php echo $_smarty_tpl->tpl_vars['message']->value['content'];?>

        </p>
      </div>

      <div class="flex justify-between items-center mt-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/inbox" class="btn bg-slate-500 hover:bg-slate-600 text-white rounded-lg px-4 py-2">
          <iconify-icon icon="heroicons-outline:arrow-left" class="text-xl mr-2"></iconify-icon>
          <?php echo Lang::T('Back to Inbox');?>

        </a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/delete/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" class="btn bg-red-500 hover:bg-red-600 text-white rounded-lg px-4 py-2">
          <iconify-icon icon="heroicons-outline:trash" class="text-xl mr-2"></iconify-icon>
          <?php echo Lang::T('Delete Message');?>

        </a>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
