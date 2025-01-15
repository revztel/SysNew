<?php
/* Smarty version 4.3.1, created on 2024-09-19 00:06:28
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_queues.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb40d44f1898_72376864',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b83e15fa1488f38fde02a45ab04b1009314a4839' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_queues.tpl',
      1 => 1726693499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb40d44f1898_72376864 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Queues Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Queues Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/list/">
                    <div class="form-group">
                        <label for="router_id"><?php echo Lang::T('Select Router');?>
</label>
                        <select name="router_id" id="router_id" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['selected_router']->value)) && $_smarty_tpl->tpl_vars['selected_router']->value['id'] == $_smarty_tpl->tpl_vars['router']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Queues');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['queues']->value))) {?>
                <h3><?php echo Lang::T('Queues');?>
</h3>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/add-queue/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add Queue');?>
</a>
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('ID');?>
</th>
                            <th><?php echo Lang::T('Name');?>
</th>
                            <th><?php echo Lang::T('Target');?>
</th>
                            <th><?php echo Lang::T('Max Limit');?>
</th>
                            <th><?php echo Lang::T('Comment');?>
</th>
                            <th><?php echo Lang::T('Disabled');?>
</th>
                            <th><?php echo Lang::T('Actions');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['queues']->value, 'queue');
$_smarty_tpl->tpl_vars['queue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['queue']->value) {
$_smarty_tpl->tpl_vars['queue']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['target'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['max_limit'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['comment'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['queue']->value['disabled'];?>
</td>
                            <td>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/edit-queue/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['queue']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/delete-queue" style="display:inline;">
                                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                    <input type="hidden" name="queue_id" value="<?php echo $_smarty_tpl->tpl_vars['queue']->value['id'];?>
">
                                    <button type="submit" class="btn btn-danger btn-xs"><?php echo Lang::T('Delete');?>
</button>
                                </form>
                            </td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
