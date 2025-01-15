<?php
/* Smarty version 4.3.1, created on 2024-09-18 23:39:41
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_ppp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb3a8df37de7_48234586',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '093c61249b3a05d257f7c10b9afa176696238db9' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_ppp.tpl',
      1 => 1726691837,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb3a8df37de7_48234586 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router PPP Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router PPP Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/list/">
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
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load PPP Data');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['pppoeServers']->value))) {?>
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pppoe_servers"><?php echo Lang::T('PPPoE Servers');?>
</a></li>
                    <li><a data-toggle="tab" href="#secrets"><?php echo Lang::T('Secrets');?>
</a></li>
                    <li><a data-toggle="tab" href="#interfaces"><?php echo Lang::T('Interfaces');?>
</a></li>
                    <li><a data-toggle="tab" href="#profiles"><?php echo Lang::T('Profiles');?>
</a></li>
                </ul>

                <div class="tab-content">
                    <!-- PPPoE Servers Tab -->
                    <div id="pppoe_servers" class="tab-pane fade in active">
                        <h3><?php echo Lang::T('PPPoE Servers');?>
</h3>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/add-pppoe-server/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add PPPoE Server');?>
</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Service Name');?>
</th>
                                    <th><?php echo Lang::T('Interface');?>
</th>
                                    <th><?php echo Lang::T('Max MTU');?>
</th>
                                    <th><?php echo Lang::T('Max MRU');?>
</th>
                                    <th><?php echo Lang::T('Enabled');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pppoeServers']->value, 'server');
$_smarty_tpl->tpl_vars['server']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['service_name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['interface'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['max_mtu'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['max_mru'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['enabled'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/edit-pppoe-server/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['server']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/delete-pppoe-server" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="server_id" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
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

                    <!-- Secrets Tab -->
                    <div id="secrets" class="tab-pane fade">
                        <h3><?php echo Lang::T('Secrets');?>
</h3>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/add-secret/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add Secret');?>
</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Password');?>
</th>
                                    <th><?php echo Lang::T('Service');?>
</th>
                                    <th><?php echo Lang::T('Profile');?>
</th>
                                    <th><?php echo Lang::T('Comment');?>
</th>
                                    <th><?php echo Lang::T('Enabled');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['secrets']->value, 'secret');
$_smarty_tpl->tpl_vars['secret']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['secret']->value) {
$_smarty_tpl->tpl_vars['secret']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['password'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['service'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['profile'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['comment'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['secret']->value['enabled'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/edit-secret/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['secret']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/delete-secret" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="secret_id" value="<?php echo $_smarty_tpl->tpl_vars['secret']->value['id'];?>
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

                    <!-- Interfaces Tab -->
                    <div id="interfaces" class="tab-pane fade">
                        <h3><?php echo Lang::T('Interfaces');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Type');?>
</th>
                                    <th><?php echo Lang::T('MTU');?>
</th>
                                    <th><?php echo Lang::T('MAC Address');?>
</th>
                                    <th><?php echo Lang::T('Running');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['interfaces']->value, 'interface');
$_smarty_tpl->tpl_vars['interface']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['interface']->value) {
$_smarty_tpl->tpl_vars['interface']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['type'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['mtu'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['mac_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['interface']->value['running'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Profiles Tab -->
                    <div id="profiles" class="tab-pane fade">
                        <h3><?php echo Lang::T('Profiles');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Local Address');?>
</th>
                                    <th><?php echo Lang::T('Remote Address');?>
</th>
                                    <th><?php echo Lang::T('Only One');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile');
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['local_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['remote_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['only_one'];?>
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
