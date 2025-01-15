<?php
/* Smarty version 4.3.1, created on 2024-10-13 19:29:29
  from 'F:\xampp\htdocs\radius\ui\themes\nova\bulk_actions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_670bf569de9979_18073212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3835c7f8c637a9fc18d0b19aab39907af89c87d7' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\bulk_actions.tpl',
      1 => 1728836769,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_670bf569de9979_18073212 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-info">
            <div class="panel-heading"><?php echo Lang::T('Bulk Actions');?>
</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/mass_delete" class="list-group-item">
                        <?php echo Lang::T('Mass Delete Users');?>

                    </a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/bulk_edit_expiry" class="list-group-item">
                        <?php echo Lang::T('Bulk Edit Expiry Period');?>

                    </a>
                    <!-- Add more bulk actions here -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
