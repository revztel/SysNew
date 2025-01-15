<?php
/* Smarty version 4.3.1, created on 2024-10-01 13:59:33
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_prompt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fbd615a55d12_89367275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7746f634b9b0b4254c7d3e250d75629e82c5dcdd' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_prompt.tpl',
      1 => 1727780223,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66fbd615a55d12_89367275 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading d-flex justify-content-between align-items-center">
                <span><?php echo Lang::T('Enter Password');?>
</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    <?php echo Lang::T('Need Help?');?>

                </button>
            </div>
            <div class="panel-body">
                <?php if ((isset($_smarty_tpl->tpl_vars['_error']->value))) {?>
                    <div class="alert alert-danger text-center">
                        <strong>Error!</strong> <?php echo $_smarty_tpl->tpl_vars['_error']->value;?>

                    </div>
                <?php }?>
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers">
                    <div class="form-group">
                        <label for="pg_password" class="font-weight-bold"><?php echo Lang::T('Password');?>
</label>
                        <input type="password" name="pg_password" id="pg_password" class="form-control form-control-lg" required placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><?php echo Lang::T('Submit');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tutorial Modal -->
<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel"><?php echo Lang::T('Tutorial Video');?>
</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo Lang::T('Close');?>
">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/S2SZtktBQSI?si=gcGk8YYVfOXqCru9" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Lang::T('Close');?>
</button>
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
