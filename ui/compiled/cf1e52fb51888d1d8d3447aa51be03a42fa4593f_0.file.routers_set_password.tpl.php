<?php
/* Smarty version 4.3.1, created on 2024-11-12 23:07:19
  from 'F:\xampp\htdocs\radius\ui\themes\nova\routers_set_password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6733b577a9f043_89888911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf1e52fb51888d1d8d3447aa51be03a42fa4593f' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\routers_set_password.tpl',
      1 => 1727828669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6733b577a9f043_89888911 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading d-flex justify-content-between align-items-center">
                <span><?php echo Lang::T('Set Your Password');?>
</span>
            </div>
            <div class="panel-body">
                <?php if ((isset($_smarty_tpl->tpl_vars['_error']->value))) {?>
                    <div class="alert alert-danger text-center">
                        <strong>Error!</strong> <?php echo $_smarty_tpl->tpl_vars['_error']->value;?>

                    </div>
                <?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['_success']->value))) {?>
                    <div class="alert alert-success text-center">
                        <strong>Success!</strong> <?php echo $_smarty_tpl->tpl_vars['_success']->value;?>

                    </div>
                <?php }?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="new_router_password" class="font-weight-bold"><?php echo Lang::T('New Password');?>
</label>
                        <input type="password" class="form-control form-control-lg" id="new_router_password" name="new_router_password" required placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_router_password" class="font-weight-bold"><?php echo Lang::T('Confirm Password');?>
</label>
                        <input type="password" class="form-control form-control-lg" id="confirm_router_password" name="confirm_router_password" required placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><?php echo Lang::T('Set Password');?>
</button>
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
</style>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
