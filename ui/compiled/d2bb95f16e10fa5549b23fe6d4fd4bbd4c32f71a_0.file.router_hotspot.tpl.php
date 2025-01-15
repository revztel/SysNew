<?php
/* Smarty version 4.3.1, created on 2024-09-19 01:00:50
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_hotspot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb4d9274d1a5_25507672',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2bb95f16e10fa5549b23fe6d4fd4bbd4c32f71a' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_hotspot.tpl',
      1 => 1726696776,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb4d9274d1a5_25507672 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Hotspot Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Hotspot Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/list/">
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
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Hotspot Data');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['servers']->value))) {?>
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#servers"><?php echo Lang::T('Servers');?>
</a></li>
                    <li><a data-toggle="tab" href="#profiles"><?php echo Lang::T('Server Profiles');?>
</a></li>
                    <li><a data-toggle="tab" href="#users"><?php echo Lang::T('Users');?>
</a></li>
                    <li><a data-toggle="tab" href="#active"><?php echo Lang::T('Active');?>
</a></li>
                    <li><a data-toggle="tab" href="#hosts"><?php echo Lang::T('Hosts');?>
</a></li>
                    <li><a data-toggle="tab" href="#ip_bindings"><?php echo Lang::T('IP Bindings');?>
</a></li>
                    <li><a data-toggle="tab" href="#walled_garden"><?php echo Lang::T('Walled Garden');?>
</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Servers Tab -->
                    <div id="servers" class="tab-pane fade in active">
                        <h3><?php echo Lang::T('Hotspot Servers');?>
</h3>
                        <!-- Edit functionality -->
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Interface');?>
</th>
                                    <th><?php echo Lang::T('Address Pool');?>
</th>
                                    <th><?php echo Lang::T('Profile');?>
</th>
                                    <th><?php echo Lang::T('Disabled');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servers']->value, 'server');
$_smarty_tpl->tpl_vars['server']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['interface'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['address_pool'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['profile'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['server']->value['disabled'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/edit-server/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['server']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                    </td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Server Profiles Tab -->
                    <div id="profiles" class="tab-pane fade">
                        <h3><?php echo Lang::T('Hotspot Server Profiles');?>
</h3>
                        <!-- Edit functionality -->
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Hotspot Address');?>
</th>
                                    <th><?php echo Lang::T('DNS Name');?>
</th>
                                    <th><?php echo Lang::T('Login By');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
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
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['hotspot_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['dns_name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['profile']->value['login_by'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/edit-profile/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['profile']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                    </td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Users Tab (Read-only) -->
                    <div id="users" class="tab-pane fade">
                        <h3><?php echo Lang::T('Hotspot Users');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Profile');?>
</th>
                                    <th><?php echo Lang::T('Uptime');?>
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
                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['profile'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['uptime'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Active Tab (Read-only) -->
                    <div id="active" class="tab-pane fade">
                        <h3><?php echo Lang::T('Active Users');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('User');?>
</th>
                                    <th><?php echo Lang::T('Address');?>
</th>
                                    <th><?php echo Lang::T('Uptime');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activeUsers']->value, 'active');
$_smarty_tpl->tpl_vars['active']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['active']->value) {
$_smarty_tpl->tpl_vars['active']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['active']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['active']->value['user'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['active']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['active']->value['uptime'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Hosts Tab (Read-only) -->
                    <div id="hosts" class="tab-pane fade">
                        <h3><?php echo Lang::T('Hosts');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Address');?>
</th>
                                    <th><?php echo Lang::T('MAC Address');?>
</th>
                                    <th><?php echo Lang::T('To Address');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hosts']->value, 'host');
$_smarty_tpl->tpl_vars['host']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['host']->value) {
$_smarty_tpl->tpl_vars['host']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['host']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['host']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['host']->value['mac_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['host']->value['to_address'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- IP Bindings Tab (Read-only) -->
                    <div id="ip_bindings" class="tab-pane fade">
                        <h3><?php echo Lang::T('IP Bindings');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('MAC Address');?>
</th>
                                    <th><?php echo Lang::T('Address');?>
</th>
                                    <th><?php echo Lang::T('Type');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ipBindings']->value, 'binding');
$_smarty_tpl->tpl_vars['binding']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['binding']->value) {
$_smarty_tpl->tpl_vars['binding']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['binding']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['binding']->value['mac_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['binding']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['binding']->value['type'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Walled Garden Tab (Read-only) -->
                    <div id="walled_garden" class="tab-pane fade">
                        <h3><?php echo Lang::T('Walled Garden');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Dst Host');?>
</th>
                                    <th><?php echo Lang::T('Dst Port');?>
</th>
                                    <th><?php echo Lang::T('Action');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['walledGardens']->value, 'wg');
$_smarty_tpl->tpl_vars['wg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['wg']->value) {
$_smarty_tpl->tpl_vars['wg']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['wg']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['wg']->value['dst_host'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['wg']->value['dst_port'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['wg']->value['action'];?>
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
