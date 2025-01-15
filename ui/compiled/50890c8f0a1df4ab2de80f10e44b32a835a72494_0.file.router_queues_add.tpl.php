<?php
/* Smarty version 4.3.1, created on 2024-09-19 00:06:54
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_queues_add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb40ee179932_06222231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50890c8f0a1df4ab2de80f10e44b32a835a72494' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_queues_add.tpl',
      1 => 1726693540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb40ee179932_06222231 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Add Queue -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Add Queue');?>

            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/add-queue/<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['router_id']->value;?>
">
                    <div class="form-group">
                        <label for="name"><?php echo Lang::T('Name');?>
</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="target"><?php echo Lang::T('Target');?>
</label>
                        <input type="text" name="target" class="form-control" placeholder="e.g., 192.168.1.0/24" required>
                    </div>
                    <div class="form-group">
                        <label for="max_limit"><?php echo Lang::T('Max Limit');?>
</label>
                        <input type="text" name="max_limit" class="form-control" placeholder="e.g., 2M/2M" required>
                    </div>
                    <div class="form-group">
                        <label for="comment"><?php echo Lang::T('Comment');?>
</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled"> <?php echo Lang::T('Disable Queue');?>

                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Add Queue');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
