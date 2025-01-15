<?php
/* Smarty version 4.3.1, created on 2024-11-17 21:32:06
  from 'F:\xampp\htdocs\radius\ui\themes\nova\fup-add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_673a36a64ec6a9_41754270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3340b80357bd438db8041e5a62aea032465ceac1' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\fup-add.tpl',
      1 => 1731868252,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_673a36a64ec6a9_41754270 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- FUP Profile Add Form -->
<div class="row">
    <div class="col-md-12">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/add-post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New FUP Profile</h3>
                </div>
                <div class="panel-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <!-- Data Limit -->
                    <div class="form-group">
                        <label for="data_limit">Data Limit *</label>
                        <input type="number" name="data_limit" class="form-control" required>
                    </div>
                    <!-- Data Limit Unit -->
                    <div class="form-group">
                        <label for="data_limit_unit">Data Limit Unit *</label>
                        <select name="data_limit_unit" class="form-control" required>
                            <option value="MB">MB</option>
                            <option value="GB">GB</option>
                            <option value="TB">TB</option>
                        </select>
                    </div>
                    <!-- Router -->
                    <div class="form-group">
                        <label for="router_name">Router *</label>
                        <select name="router_name" class="form-control" required>
                            <option value="">Select Router</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Service Type -->
                    <div class="form-group">
                        <label for="service_type">Service Type *</label>
                        <select name="service_type" class="form-control" required>
                            <option value="">Select Service Type</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_types']->value, 'type');
$_smarty_tpl->tpl_vars['type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Plan to Switch To -->
                    <div class="form-group">
                        <label for="profile_on_limit">Plan to Switch To *</label>
                        <select name="profile_on_limit" class="form-control" required>
                            <option value="">Select Plan</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
"
                                    data-service-type="<?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
"
                                    data-router-id="<?php echo $_smarty_tpl->tpl_vars['plan']->value['routers'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
 (<?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
)
                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <!-- Select Plan Under FUP -->
                    <div class="form-group">
                        <label for="plan_under_fup">Select Plan Under FUP *</label>
                        <select name="plan_under_fup" class="form-control" required>
                            <option value="">Select Plan</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
"
                                    data-service-type="<?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
"
                                    data-router-id="<?php echo $_smarty_tpl->tpl_vars['plan']->value['routers'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>
 (<?php echo $_smarty_tpl->tpl_vars['plan']->value['type'];?>
)
                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                        <small>Select the plan that will be under this FUP profile.</small>
                    </div>
                    <!-- Active -->
                    <div class="form-group">
                        <label for="active">Active</label>
                        <input type="checkbox" name="active" value="1" checked>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Add FUP Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Custom JavaScript to filter plans based on router and service type -->
<?php echo '<script'; ?>
>
$(document).ready(function () {
    function filterProfiles() {
        var selectedRouter = $('select[name="router_name"]').val();
        var selectedServiceType = $('select[name="service_type"]').val();

        // Filter "Plan to Switch To"
        $('select[name="profile_on_limit"] option').each(function () {
            var optionServiceType = $(this).data('service-type');
            var optionRouter = $(this).data('router-id');

            // Show or hide options based on selected router and service type
            if (optionServiceType === selectedServiceType && optionRouter.includes(selectedRouter)) {
                $(this).show();
            } else {
                $(this).hide();
                if ($(this).is(':selected')) {
                    $(this).prop('selected', false);
                }
            }
        });

        // Filter "Plan Under FUP"
        $('select[name="plan_under_fup"] option').each(function () {
            var optionServiceType = $(this).data('service-type');
            var optionRouter = $(this).data('router-id');

            if (optionServiceType === selectedServiceType && optionRouter.includes(selectedRouter)) {
                $(this).show();
            } else {
                $(this).hide();
                if ($(this).is(':selected')) {
                    $(this).prop('selected', false);
                }
            }
        });
    }

    // Trigger filtering when router or service type changes
    $('select[name="router_name"], select[name="service_type"]').change(function () {
        filterProfiles();
    });

    // Apply filtering on page load
    filterProfiles();
});
<?php echo '</script'; ?>
>
<?php }
}
