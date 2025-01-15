<?php
/* Smarty version 4.3.1, created on 2024-09-30 00:27:25
  from 'F:\xampp\htdocs\radius\ui\themes\nova\fup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66f9c63dca9dc0_08485131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98b220f8f86b0a4c83e0000d60ce8fed29715a2c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\fup.tpl',
      1 => 1727645148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66f9c63dca9dc0_08485131 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- FUP Profiles List -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span><?php echo Lang::T('FUP Profiles');?>
</span>
                <div class="btn-group">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/add" class="btn btn-primary btn-sm">
                        <i class="ion ion-android-add"></i> <?php echo Lang::T('New FUP Profile');?>

                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/list/">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-search"></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="<?php echo Lang::T('Search by Name');?>
...">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="submit"><?php echo Lang::T('Search');?>
</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Name');?>
</th>
                                <th><?php echo Lang::T('Data Limit');?>
</th>
                                <th><?php echo Lang::T('Capped Rate Down');?>
</th>
                                <th><?php echo Lang::T('Capped Rate Up');?>
</th>
                                <th><?php echo Lang::T('Status');?>
</th>
                                <th><?php echo Lang::T('Manage');?>
</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'fup');
$_smarty_tpl->tpl_vars['fup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fup']->value) {
$_smarty_tpl->tpl_vars['fup']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['data_limit'];?>
 <?php echo $_smarty_tpl->tpl_vars['fup']->value['data_limit_unit'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['capped_rate_down'];?>
 <?php echo $_smarty_tpl->tpl_vars['fup']->value['capped_rate_down_unit'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['capped_rate_up'];?>
 <?php echo $_smarty_tpl->tpl_vars['fup']->value['capped_rate_up_unit'];?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['fup']->value['active'] == 1) {?>
                                            <span class="label label-success"><?php echo Lang::T('Active');?>
</span>
                                        <?php } else { ?>
                                            <span class="label label-danger"><?php echo Lang::T('Inactive');?>
</span>
                                        <?php }?>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/edit/<?php echo $_smarty_tpl->tpl_vars['fup']->value['id'];?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/delete/<?php echo $_smarty_tpl->tpl_vars['fup']->value['id'];?>
" onclick="return confirm('<?php echo Lang::T('Are you sure you want to delete this FUP profile?');?>
');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['fup']->value['id'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
