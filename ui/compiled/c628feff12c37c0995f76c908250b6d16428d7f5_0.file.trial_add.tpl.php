<?php
/* Smarty version 4.3.1, created on 2024-09-07 20:41:18
  from 'F:\xampp\htdocs\radius\ui\themes\nova\trial_add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66dc903e0273c0_76285464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c628feff12c37c0995f76c908250b6d16428d7f5' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\trial_add.tpl',
      1 => 1725730871,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66dc903e0273c0_76285464 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Add Hotspot Trial Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span><?php echo Lang::T('Add Hotspot Trial');?>
</span>
            </div>
            <div class="panel-body">
                <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/add-post" method="post" id="trial-form">
                    <div class="form-group">
                        <label for="trial_name"><?php echo Lang::T('Trial Name');?>
</label>
                        <input type="text" name="trial_name" class="form-control" placeholder="<?php echo Lang::T('Enter Trial Name');?>
" required>
                    </div>

                    <div class="form-group">
                        <label for="router_id"><?php echo Lang::T('Select Router');?>
</label>
                        <select name="router_id" id="router_id" class="form-control" required onchange="fetchPlans()">
                            <option value=""><?php echo Lang::T('Select Router');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_id"><?php echo Lang::T('Select Plan');?>
</label>
                        <select name="plan_id" id="plan_id" class="form-control" required>
                            <option value=""><?php echo Lang::T('Select Plan');?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time_limit"><?php echo Lang::T('Trial Uptime Limit (Minutes)');?>
</label>
                        <input type="number" name="time_limit" class="form-control" placeholder="<?php echo Lang::T('Enter Trial Uptime Limit in Minutes');?>
" required>
                    </div>

                    <div class="form-group">
                        <label for="uptime_reset"><?php echo Lang::T('Trial Uptime Reset (Days)');?>
</label>
                        <input type="number" name="uptime_reset" class="form-control" placeholder="<?php echo Lang::T('Enter Trial Uptime Reset in Days');?>
" required>
                    </div>

                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Create Trial');?>
</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
// JavaScript function to fetch plans based on the selected router
function fetchPlans() {
    var routerId = document.getElementById('router_id').value;

    if (!routerId) {
        console.error('No router selected.');
        return;
    }

    // Make an AJAX call to update the plans dropdown based on the selected router
    fetch('<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/fetch-plans', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'router_id=' + encodeURIComponent(routerId),
    })
    .then(response => response.json())
    .then(data => {
        var planSelect = document.getElementById('plan_id');
        planSelect.innerHTML = '<option value=""><?php echo Lang::T("Select Plan");?>
</option>';
        data.plans.forEach(plan => {
            var option = document.createElement('option');
            option.value = plan.id;
            option.text = plan.name_plan;
            planSelect.add(option);
        });
        console.log('Plans fetched:', data.plans);
    })
    .catch(error => console.error('Error fetching plans:', error));
}
<?php echo '</script'; ?>
>



<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
