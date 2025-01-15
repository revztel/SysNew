<?php
/* Smarty version 4.3.1, created on 2025-01-02 14:15:30
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67767552190a79_50124624',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4b4dbbaf7556a091d73fec6c50d0c1ff56982ea' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-profile.tpl',
      1 => 1710961780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_67767552190a79_50124624 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- user-profile -->
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
  <div class="card xl:col-span-2">
    <div class="card-body flex flex-col p-6">
      <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
        <div class="flex-1">
          <div class="card-title text-slate-900 dark:text-white"><?php echo Lang::T('Edit User');?>
</div>
        </div>
      </header>
      <div class="card-text h-full ">
        <form class="space-y-4" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/edit-profile-post">
          <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <div class="input-area relative">
              <label for="largeInput" class="form-label"><?php echo Lang::T('Username');?>
</label>
              <input type="text" class="form-control" name="username" id="username" readonly value="<?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
" placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label"><?php echo Lang::T('Full Name');?>
</label>
              <input type="" class="form-control" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['fullname'];?>
">
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label"><?php echo Lang::T('Phone Number');?>
</label>
              <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['phonenumber'];?>
" placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label"><?php echo Lang::T('Email');?>
</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
">
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label"><?php echo Lang::T('Address');?>
</label>
              <textarea name="address" id="address" class="form-control"><?php echo $_smarty_tpl->tpl_vars['d']->value['address'];?>
</textarea>
            </div>
          </div>
          <button type="submit" class="btn inline-flex justify-center btn-primary"><?php echo Lang::T('Save Changes');?>
</button>&nbsp; <a class="btn inline-flex justify-center btn-dark" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
home"><?php echo Lang::T('Cancel');?>
</a>
        </form>
      </div>
    </div>
  </div>
</div> <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
