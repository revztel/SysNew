<?php
/* Smarty version 4.3.1, created on 2024-07-17 17:59:03
  from 'F:\xampp\htdocs\radius\ui\themes\nova\select_router.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6697dc37d3fba0_12696414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b719a111a4407d2a08a2e950f8d2d001e496b1c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\select_router.tpl',
      1 => 1721228255,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_6697dc37d3fba0_12696414 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
/* Include your styling here */
.table th, .table td {
    vertical-align: middle !important;
}
.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
}
.thead-dark th {
    background-color: #343a40;
    color: #000;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}
.accordion .card {
    margin-bottom: 1rem;
}
.accordion .card-header {
    cursor: pointer;
    background-color: #007bff;
    color: white;
}
.accordion .card-header h5 {
    margin-bottom: 0;
}
.accordion .card-header .btn {
    width: 100%;
    text-align: left;
    color: white;
}
.accordion .card-header .btn:hover {
    text-decoration: none;
}
.card-body {
    background-color: #f8f9fa;
}
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Select Router');?>
</span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="color: black;"><?php echo Lang::T('Router Name');?>
</th>
                                <th style="color: black;"><?php echo Lang::T('Actions');?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ip/view-ips?id=<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> <?php echo Lang::T('View IPs');?>

                                    </a>
                                </td>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
