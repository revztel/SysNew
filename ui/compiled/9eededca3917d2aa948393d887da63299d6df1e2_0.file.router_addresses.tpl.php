<?php
/* Smarty version 4.3.1, created on 2024-09-18 23:55:32
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_addresses.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb3e44879c54_17458620',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9eededca3917d2aa948393d887da63299d6df1e2' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_addresses.tpl',
      1 => 1726692802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb3e44879c54_17458620 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Addresses Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Addresses Management');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/list/">
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
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Load Data');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['ipAddresses']->value))) {?>
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#ip_addresses"><?php echo Lang::T('IP Addresses');?>
</a></li>
                    <li><a data-toggle="tab" href="#arp"><?php echo Lang::T('ARP Table');?>
</a></li>
                    <li><a data-toggle="tab" href="#ip_services"><?php echo Lang::T('IP Services');?>
</a></li>
                    <li><a data-toggle="tab" href="#firewall"><?php echo Lang::T('Firewall');?>
</a></li>
                </ul>

                <div class="tab-content">
                    <!-- IP Addresses Tab -->
                    <div id="ip_addresses" class="tab-pane fade in active">
                        <h3><?php echo Lang::T('IP Addresses');?>
</h3>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/add-ip/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
" class="btn btn-success"><?php echo Lang::T('Add IP Address');?>
</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Address');?>
</th>
                                    <th><?php echo Lang::T('Network');?>
</th>
                                    <th><?php echo Lang::T('Interface');?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ipAddresses']->value, 'ip');
$_smarty_tpl->tpl_vars['ip']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ip']->value) {
$_smarty_tpl->tpl_vars['ip']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['network'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['interface'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['comment'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ip']->value['disabled'];?>
</td>
                                    <td>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/edit-ip/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['ip']->value['id']);?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/delete-ip" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="ip_id" value="<?php echo $_smarty_tpl->tpl_vars['ip']->value['id'];?>
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

                    <!-- ARP Table Tab -->
                    <div id="arp" class="tab-pane fade">
                        <h3><?php echo Lang::T('ARP Table');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('IP Address');?>
</th>
                                    <th><?php echo Lang::T('MAC Address');?>
</th>
                                    <th><?php echo Lang::T('Interface');?>
</th>
                                    <th><?php echo Lang::T('Comment');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arpEntries']->value, 'arp');
$_smarty_tpl->tpl_vars['arp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['arp']->value) {
$_smarty_tpl->tpl_vars['arp']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['arp']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['arp']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['arp']->value['mac_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['arp']->value['interface'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['arp']->value['comment'];?>
</td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- IP Services Tab -->
                    <div id="ip_services" class="tab-pane fade">
                        <h3><?php echo Lang::T('IP Services');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Name');?>
</th>
                                    <th><?php echo Lang::T('Port');?>
</th>
                                    <th><?php echo Lang::T('Address');?>
</th>
                                    <th><?php echo Lang::T('Disabled');?>
</th>
                                    <th><?php echo Lang::T('Actions');?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ipServices']->value, 'service');
$_smarty_tpl->tpl_vars['service']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
$_smarty_tpl->tpl_vars['service']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['port'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['disabled'];?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['service']->value['disabled'] == 'Yes') {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/disable-service/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['service']->value['id']);?>
" class="btn btn-warning btn-xs"><?php echo Lang::T('Disable');?>
</a>
                                        <?php } else { ?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/enable-service/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['service']->value['id']);?>
" class="btn btn-success btn-xs"><?php echo Lang::T('Enable');?>
</a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Firewall Tab -->
                    <div id="firewall" class="tab-pane fade">
                        <h3><?php echo Lang::T('Firewall Rules');?>
</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::T('ID');?>
</th>
                                    <th><?php echo Lang::T('Chain');?>
</th>
                                    <th><?php echo Lang::T('Action');?>
</th>
                                    <th><?php echo Lang::T('Src Address');?>
</th>
                                    <th><?php echo Lang::T('Dst Address');?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['firewallRules']->value, 'rule');
$_smarty_tpl->tpl_vars['rule']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rule']->value) {
$_smarty_tpl->tpl_vars['rule']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['chain'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['action'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['src_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['dst_address'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['comment'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rule']->value['disabled'];?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['rule']->value['disabled'] == 'Yes') {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/disable-firewall-rule/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['rule']->value['id']);?>
" class="btn btn-warning btn-xs"><?php echo Lang::T('Disable');?>
</a>
                                        <?php } else { ?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/enable-firewall-rule/<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
/<?php echo urlencode($_smarty_tpl->tpl_vars['rule']->value['id']);?>
" class="btn btn-success btn-xs"><?php echo Lang::T('Enable');?>
</a>
                                        <?php }?>
                                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/delete-firewall-rule" style="display:inline;">
                                            <input type="hidden" name="router_id" value="<?php echo $_smarty_tpl->tpl_vars['selected_router']->value['id'];?>
">
                                            <input type="hidden" name="rule_id" value="<?php echo $_smarty_tpl->tpl_vars['rule']->value['id'];?>
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
