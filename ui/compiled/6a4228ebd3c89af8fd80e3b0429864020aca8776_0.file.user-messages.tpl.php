<?php
/* Smarty version 4.3.1, created on 2024-10-08 17:02:01
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67053b59d0c436_80427462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a4228ebd3c89af8fd80e3b0429864020aca8776' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-messages.tpl',
      1 => 1728396026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_67053b59d0c436_80427462 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- Messages Inbox -->
<div class="grid grid-cols-1 gap-6">
  <div class="card shadow-lg rounded-lg bg-white dark:bg-slate-800">
    <div class="card-body p-6">
      <!-- Header -->
      <header class="flex justify-between mb-5 items-center border-b border-slate-200 dark:border-slate-700 pb-5">
        <div class="flex-1">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white"><?php echo Lang::T('Messages Inbox');?>
</h2>
        </div>
      </header>

      <!-- Messages List -->
      <div class="card-text">
        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
        <ul class="divide-y divide-slate-200 dark:divide-slate-700">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>
          <li class="py-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition duration-200 ease-in-out">
            <div class="flex justify-between items-center">
              <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/view/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" class="flex-1">
                <div class="text-slate-900 dark:text-white font-medium text-lg"><?php echo $_smarty_tpl->tpl_vars['message']->value['title'];?>
</div>
                <div class="text-slate-500 dark:text-slate-400 text-sm mt-1"><?php echo $_smarty_tpl->tpl_vars['message']->value['date'];?>
</div>
                <!-- Corrected Line -->
                <p class="text-slate-700 dark:text-slate-300 text-sm mt-2"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['message']->value['content'],80,"...");?>
</p>
              </a>
              <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <?php if ($_smarty_tpl->tpl_vars['message']->value['unread']) {?>
                <span class="px-2 py-1 text-xs font-semibold text-blue-600 bg-blue-100 dark:bg-blue-900 dark:text-blue-400 rounded-full"><?php echo Lang::T('Unread');?>
</span>
                <?php }?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
user_messages/mark-as-unread/<?php echo $_smarty_tpl->tpl_vars['message']->value['id'];?>
" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white" title="<?php echo Lang::T('Mark as Unread');?>
">
                  <iconify-icon icon="heroicons-outline:bookmark" class="text-2xl"></iconify-icon>
                </a>
              </div>
            </div>
          </li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <?php } else { ?>
        <div class="text-center text-slate-500 dark:text-slate-400 py-10">
          <p class="text-lg"><?php echo Lang::T('No Messages');?>
</p>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
