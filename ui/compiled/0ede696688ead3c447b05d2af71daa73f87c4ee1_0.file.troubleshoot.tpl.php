<?php
/* Smarty version 4.3.1, created on 2024-09-19 21:49:57
  from 'F:\xampp\htdocs\radius\ui\themes\nova\troubleshoot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66ec72555d3c39_16192240',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ede696688ead3c447b05d2af71daa73f87c4ee1' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\troubleshoot.tpl',
      1 => 1726771701,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66ec72555d3c39_16192240 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Troubleshooting Guide -->
<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center"><?php echo Lang::T('Troubleshooting Guide');?>
</h2>
        <hr>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#hotspot" data-toggle="tab"><i class="fa fa-wifi"></i> <?php echo Lang::T('Hotspot');?>
</a></li>
            <li><a href="#pppoe" data-toggle="tab"><i class="fa fa-plug"></i> <?php echo Lang::T('PPPoE');?>
</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="margin-top: 20px;">
            <!-- Hotspot Tab -->
            <div class="tab-pane fade in active" id="hotspot">
                <h3><i class="fa fa-wifi"></i> <?php echo $_smarty_tpl->tpl_vars['troubleshooting']->value['hotspot']['title'];?>
</h3>
                <?php if ((isset($_smarty_tpl->tpl_vars['troubleshooting']->value['hotspot']['description']))) {?>
                    <p><?php echo $_smarty_tpl->tpl_vars['troubleshooting']->value['hotspot']['description'];?>
</p>
                <?php }?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['troubleshooting']->value['hotspot']['sections'], 'section');
$_smarty_tpl->tpl_vars['section']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['section']->value) {
$_smarty_tpl->tpl_vars['section']->do_else = false;
?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['section']->value['title'];?>
</h4>
                        </div>
                        <div class="panel-body">
                            <p><?php echo $_smarty_tpl->tpl_vars['section']->value['description'];?>
</p>

                            <?php if ((isset($_smarty_tpl->tpl_vars['section']->value['steps']))) {?>
                                <h5><i class="fa fa-list-ol"></i> <?php echo Lang::T('Steps');?>
</h5>
                                <ol>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value['steps'], 'step');
$_smarty_tpl->tpl_vars['step']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['step']->value) {
$_smarty_tpl->tpl_vars['step']->do_else = false;
?>
                                        <li><?php echo $_smarty_tpl->tpl_vars['step']->value;?>
</li>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ol>
                            <?php }?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['section']->value['errors']))) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value['errors'], 'error', false, NULL, 'errorloop', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index']++;
?>
                                    <div class="panel-group" id="accordion-hotspot-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index'] : null);?>
">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion-hotspot-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index'] : null);?>
" href="#collapse-hotspot-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index'] : null);?>
">
                                                        <i class="fa fa-exclamation-triangle"></i> <?php echo $_smarty_tpl->tpl_vars['error']->value['error'];?>

                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-hotspot-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_errorloop']->value['index'] : null);?>
" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p><strong><?php echo Lang::T('Log Message');?>
:</strong></p>
                                                    <pre><code><?php echo $_smarty_tpl->tpl_vars['error']->value['log_message'];?>
</code></pre>
                                                    <p><strong><?php echo Lang::T('Description');?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['error']->value['description'];?>
</p>
                                                    <p><strong><?php echo Lang::T('Solution');?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['error']->value['solution'];?>
</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>

            <!-- PPPoE Tab -->
            <div class="tab-pane fade" id="pppoe">
                <h3><i class="fa fa-plug"></i> <?php echo $_smarty_tpl->tpl_vars['troubleshooting']->value['pppoe']['title'];?>
</h3>
                <?php if ((isset($_smarty_tpl->tpl_vars['troubleshooting']->value['pppoe']['description']))) {?>
                    <p><?php echo $_smarty_tpl->tpl_vars['troubleshooting']->value['pppoe']['description'];?>
</p>
                <?php }?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['troubleshooting']->value['pppoe']['sections'], 'section');
$_smarty_tpl->tpl_vars['section']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['section']->value) {
$_smarty_tpl->tpl_vars['section']->do_else = false;
?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['section']->value['title'];?>
</h4>
                        </div>
                        <div class="panel-body">
                            <p><?php echo $_smarty_tpl->tpl_vars['section']->value['description'];?>
</p>

                            <?php if ((isset($_smarty_tpl->tpl_vars['section']->value['steps']))) {?>
                                <h5><i class="fa fa-list-ol"></i> <?php echo Lang::T('Steps');?>
</h5>
                                <ol>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value['steps'], 'step');
$_smarty_tpl->tpl_vars['step']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['step']->value) {
$_smarty_tpl->tpl_vars['step']->do_else = false;
?>
                                        <li><?php echo $_smarty_tpl->tpl_vars['step']->value;?>
</li>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ol>
                            <?php }?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['section']->value['note']))) {?>
                                <div class="alert alert-warning">
                                    <strong><?php echo Lang::T('Note');?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['section']->value['note'];?>

                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
