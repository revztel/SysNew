<?php
/* Smarty version 4.3.1, created on 2024-09-19 01:09:25
  from 'F:\xampp\htdocs\radius\ui\themes\nova\router_terminal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66eb4f950aec31_05543363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad4ad42da07c8dc36703ef99f32ce3dfb499e293' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\router_terminal.tpl',
      1 => 1726696706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66eb4f950aec31_05543363 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Router Terminal -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php echo Lang::T('Router Terminal');?>

            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_terminal/terminal/">
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
                    <div class="form-group">
                        <label for="command"><?php echo Lang::T('Command');?>
</label>
                        <textarea name="command" id="command" class="form-control" rows="5"><?php if ((isset($_smarty_tpl->tpl_vars['command']->value))) {
echo $_smarty_tpl->tpl_vars['command']->value;
}?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Execute');?>
</button>
                </form>

                <?php if ((isset($_smarty_tpl->tpl_vars['output']->value))) {?>
                <h3><?php echo Lang::T('Output');?>
</h3>
                <pre><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
</pre>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
