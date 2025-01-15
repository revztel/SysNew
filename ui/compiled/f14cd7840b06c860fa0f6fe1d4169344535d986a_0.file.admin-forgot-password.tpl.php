<?php
/* Smarty version 4.3.1, created on 2024-09-07 08:39:33
  from 'F:\xampp\htdocs\radius\ui\themes\nova\admin-forgot-password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66dbe7158b4005_81616530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f14cd7840b06c860fa0f6fe1d4169344535d986a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\admin-forgot-password.tpl',
      1 => 1725687421,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66dbe7158b4005_81616530 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Lang::T('Forgot Password');?>
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
        .forgot-password {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .forgot-password__title {
            color: #182848;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .forgot-password__content {
            margin-bottom: 20px;
        }
        .forgot-password__input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #182848;
            background: transparent;
            color: #182848;
        }
        .forgot-password__button {
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
        .forgot-password__button:hover {
            background: #3e5a8e;
        }
    </style>
</head>
<body>
    <div class="forgot-password text-center">
        <h1 class="forgot-password__title"><?php echo Lang::T('Forgot Password');?>
</h1>
        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
            <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

        <?php }?>
        <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
admin/forgot-password" method="post" class="forgot-password__form">
            <div class="forgot-password__content">
                <label for="forgot-email" class="forgot-password__label"><?php echo Lang::T('Enter your email');?>
</label>
                <input type="email" required class="forgot-password__input" id="forgot-email" name="email" placeholder="<?php echo Lang::T('Email');?>
">
            </div>
            <button type="submit" class="forgot-password__button"><?php echo Lang::T('Reset Password');?>
</button>
        </form>
    </div>
</body>
</html>
<?php }
}
