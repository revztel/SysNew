<?php
/* Smarty version 4.3.1, created on 2025-01-06 17:10:36
  from '/var/www/html/demo/ui/themes/nova/admin-change-password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677be45c782375_43770029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac36142ec267b3e5a689ac23175762e3ba88773f' => 
    array (
      0 => '/var/www/html/demo/ui/themes/nova/admin-change-password.tpl',
      1 => 1736167044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677be45c782375_43770029 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Lang::T('Change Password');?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #4b6cb7, #182848, #ff416c, #4b6cb7);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .change-password {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .change-password__title {
            color: #182848;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .change-password__content {
            margin-bottom: 20px;
        }
        .change-password__input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #182848;
            background: transparent;
            color: #182848;
            margin-bottom: 20px;
        }
        .change-password__button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #4b6cb7;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: background .3s;
        }
        .change-password__button:hover {
            background: #3e5a8e;
        }
    </style>
</head>
<body>
    <div class="change-password text-center">
        <h1 class="change-password__title"><?php echo Lang::T('Change Password');?>
</h1>
        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
            <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

        <?php }?>
 <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
change-password/change-password" method="post" class="change-password__form">
    <div class="change-password__content">
        <label for="new-password" class="change-password__label"><?php echo Lang::T('New Password');?>
</label>
        <input type="password" required class="change-password__input" id="new-password" name="new_password" placeholder="<?php echo Lang::T('New Password');?>
">
    </div>
    <div class="change-password__content">
        <label for="confirm-password" class="change-password__label"><?php echo Lang::T('Confirm New Password');?>
</label>
        <input type="password" required class="change-password__input" id="confirm-password" name="confirm_password" placeholder="<?php echo Lang::T('Confirm New Password');?>
">
    </div>
    <button type="submit" class="change-password__button"><?php echo Lang::T('Change Password');?>
</button>
</form>

    </div>
</body>
</html>
<?php }
}
