<?php
/* Smarty version 4.3.1, created on 2024-11-22 18:05:47
  from 'F:\xampp\htdocs\radius\ui\themes\nova\fup-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67409dcbbb13e6_89474951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '393f769f7da61fdf1c6d7439591d28a0801546b9' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\fup-list.tpl',
      1 => 1731925262,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_67409dcbbb13e6_89474951 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- FUP Profiles List -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span>Daily FUP Profiles</span>
                <div class="btn-group">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/add" class="btn btn-primary btn-sm">
                        <i class="ion ion-android-add"></i> Add New FUP Profile
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <!-- Instructions -->
                <div class="mb20">
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#instructions" aria-expanded="false" aria-controls="instructions">
                        View Instructions
                    </button>
                    <div id="instructions" class="collapse" style="margin-top: 15px;">
                        <div class="alert alert-info">
                            <ol>
                                <li>Make sure the FUP plan you have created is of the same type. If it's Hotspot, create a Hotspot FUP plan. If it's PPPoE, create a PPPoE FUP plan.</li>
                                <li>Ensure the FUP plan created under Hotspot or PPPoE has a validity of more than 1 day.</li>
                                <li>How it works:
                                    <ul>
                                        <li>Once the customer exhausts the allocated data usage for the day, they will be switched to a lower Mbps package.</li>
                                        <li>They will be switched back to their original package after midnight, as the settings will reset automatically.</li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Search Form -->
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/list/">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-search"></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Search by Name...">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FUP Profiles Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>FUP Name</th>
                                <th>Plans Under FUP</th>
                                <th>Switch To Plan</th>
                                <th>Data Limit</th>
                                <th>Service Type</th>
                                <th>Router</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fupProfiles']->value, 'fup');
$_smarty_tpl->tpl_vars['fup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fup']->value) {
$_smarty_tpl->tpl_vars['fup']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['name'];?>
</td>
                                    <td>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fupPlans']->value[$_smarty_tpl->tpl_vars['fup']->value['id']], 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                            <span class="label label-default"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</span>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </td>
                                    <td>
                                        <?php echo (($tmp = $_smarty_tpl->tpl_vars['switchPlans']->value[$_smarty_tpl->tpl_vars['fup']->value['profile_on_limit']] ?? null)===null||$tmp==='' ? 'Unknown' ?? null : $tmp);?>

                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['data_limit'];?>
 <?php echo $_smarty_tpl->tpl_vars['fup']->value['data_limit_unit'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['service_type'];?>
</td>
                                    <td><?php echo (($tmp = $_smarty_tpl->tpl_vars['routerNames']->value[$_smarty_tpl->tpl_vars['fup']->value['router_id']] ?? null)===null||$tmp==='' ? 'Unknown' ?? null : $tmp);?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['fup']->value['active'] == 1) {?>
                                            <span class="label label-success">Active</span>
                                        <?php } else { ?>
                                            <span class="label label-danger">Inactive</span>
                                        <?php }?>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/edit/<?php echo $_smarty_tpl->tpl_vars['fup']->value['id'];?>
" class="btn btn-info btn-xs">Edit</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/delete/<?php echo $_smarty_tpl->tpl_vars['fup']->value['id'];?>
" onclick="return confirm('Are you sure you want to delete this FUP profile?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
