<?php
/* Smarty version 4.3.1, created on 2024-09-18 23:16:41
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_bridge.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb3529f17452_03995412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21b7e06a8e922bd317de994a65f1f5d3dfa7e444' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_bridge.tpl',
      1 => 1726690292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb3529f17452_03995412 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Bridge Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Bridge Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/list/">
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
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Bridges and Ports');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['bridges']->value))) {?>
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#bridges"><?php echo Lang::T('Bridges');?>
</a></li>
                    <li><a data-toggle="tab" href="#ports"><?php echo Lang::T('Ports');?>
</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Bridges Tab -->
                    <div id="bridges" class="tab-pane fade in active">
                        <h3><?php echo Lang::T('Bridges');?>
</h3>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/add-bridge/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add Bridge');?>
</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Comment');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bridges']->value, 'bridge');
$_smarty_tpl->tpl_vars['bridge']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bridge']->value) {
$_smarty_tpl->tpl_vars['bridge']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['bridge']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['bridge']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['bridge']->value['comment'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/edit-bridge/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['bridge']->value['id'];?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/delete-bridge" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="bridge_id" value="<?php echo $_smarty_tpl->tpl_vars['bridge']->value['id'];?>
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
                    </div>

                    <!-- Ports Tab -->
                    <div id="ports" class="tab-pane fade">
                        <h3><?php echo Lang::T('Ports');?>
</h3>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/add-port/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add Port');?>
</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Interface');?>
</th>
                                    <th><?php echo Lang::T('Bridge');?>
</th>
                                    <th><?php echo Lang::T('Comment');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ports']->value, 'port');
$_smarty_tpl->tpl_vars['port']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['port']->value) {
$_smarty_tpl->tpl_vars['port']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['port']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['port']->value['interface'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['port']->value['bridge'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['port']->value['comment'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/edit-port/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['port']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/delete-port" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="port_id" value="<?php echo $_smarty_tpl->tpl_vars['port']->value['id'];?>
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
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
