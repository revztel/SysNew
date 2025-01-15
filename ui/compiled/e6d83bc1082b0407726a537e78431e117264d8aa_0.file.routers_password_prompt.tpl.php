<?php
/* Smarty version 4.3.1, created on 2024-12-30 20:57:21
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers_password_prompt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6772df014d32f8_12081652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6d83bc1082b0407726a537e78431e117264d8aa' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers_password_prompt.tpl',
      1 => 1727828700,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6772df014d32f8_12081652 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading d-flex justify-content-between align-items-center">
                <span><?php echo Lang::T('Enter Password');?>
</span>
            </div>
            <div class="panel-body">
                <?php if ((isset($_smarty_tpl->tpl_vars['_error']->value))) {?>
                    <div class="alert alert-danger text-center">
                        <strong>Error!</strong> <?php echo $_smarty_tpl->tpl_vars['_error']->value;?>

                    </div>
                <?php }?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="router_password" class="font-weight-bold"><?php echo Lang::T('Password');?>
</label>
                        <input type="password" class="form-control form-control-lg" id="router_password" name="router_password" required placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><?php echo Lang::T('Submit');?>
</button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/forgot_password" class="btn btn-link mt-3"><?php echo Lang::T('Forgot Password?');?>
</a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .panel {
        border-radius: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .panel-heading {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .form-control-lg {
        font-size: 1.25rem;
    }
    .alert {
        margin-top: 20px;
    }
    .btn-link {
        text-align: center;
        display: block;
        width: 100%;
    }
</style>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
