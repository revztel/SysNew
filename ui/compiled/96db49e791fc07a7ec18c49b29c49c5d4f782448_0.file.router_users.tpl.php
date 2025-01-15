<?php
/* Smarty version 4.3.1, created on 2024-09-19 00:21:17
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb444d6588c2_63634963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96db49e791fc07a7ec18c49b29c49c5d4f782448' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_users.tpl',
      1 => 1726694420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb444d6588c2_63634963 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Users Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Users Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_users/list/">
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
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Users');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['users']->value))) {?>
                <h3><?php echo Lang::T('Users on');?>
 <?php echo $_smarty_tpl->tpl_vars['selected_router']->value['name'];?>
</h3>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_users/add/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add User');?>
</a>
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('ID');?>
</th>
                            <th><?php echo Lang::T('Name');?>
</th>
                            <th><?php echo Lang::T('Group');?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['group'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['comment'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['disabled'];?>
</td>
                            <td>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_users/edit/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['user']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_users/delete" style="display:inline;">
                                    <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                    <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
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
