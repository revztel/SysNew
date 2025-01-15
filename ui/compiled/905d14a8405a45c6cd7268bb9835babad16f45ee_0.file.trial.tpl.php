<?php
/* Smarty version 4.3.1, created on 2024-09-07 21:22:50
  from 'F:\xampp\htdocs\radius\ui\themes\nova\trial.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66dc99fa404092_45032825',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '905d14a8405a45c6cd7268bb9835babad16f45ee' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\trial.tpl',
      1 => 1725732480,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66dc99fa404092_45032825 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- Hotspot Trial Profiles -->
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-hovered mb20 panel-primary">
        <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
            <span><?php echo Lang::T('Hotspot Trial Profiles');?>
</span>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/add" class="btn btn-primary btn-xs"><?php echo Lang::T('Add New Trial');?>
</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Trial Name');?>
</th>
                            <th><?php echo Lang::T('Assigned Plan');?>
</th>
                            <th><?php echo Lang::T('Trial Uptime Limit (Minutes)');?>
</th>
                            <th><?php echo Lang::T('Trial Uptime Reset (Days)');?>
</th>
                            <th><?php echo Lang::T('Manage');?>
</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trials']->value, 'trial');
$_smarty_tpl->tpl_vars['trial']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['trial']->value) {
$_smarty_tpl->tpl_vars['trial']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['trial']->value['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['trial']->value['plan_name'];?>
</td> <!-- Display the assigned plan name -->
                                <td><?php echo $_smarty_tpl->tpl_vars['trial']->value['time_limit'];?>
 <?php echo Lang::T('Minutes');?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['trial']->value['uptime_reset'];?>
 <?php echo Lang::T('Days');?>
</td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/edit/<?php echo $_smarty_tpl->tpl_vars['trial']->value['id'];?>
" class="btn btn-info btn-xs"><?php echo Lang::T('Edit');?>
</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/delete/<?php echo $_smarty_tpl->tpl_vars['trial']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['trial']->value['id'];?>
" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo Lang::T('Are you sure you want to delete this trial?');?>
')">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['trial']->value['id'];?>
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





<!-- Usage Instructions -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('Usage Instructions-Add One Plan At A Time and Save Changes In Hotspot Settings  ');?>
</span>
            </div>
            <div class="panel-body">
                <h4><?php echo Lang::T('Overview');?>
</h4>
                <p><?php echo Lang::T('Hotspot Trials allow potential customers to experience the service before committing to a paid plan. They are an excellent way to showcase the value of your offerings while controlling access and preventing abuse.');?>
</p>
                
                <h4><?php echo Lang::T('Setting Up Trials');?>
</h4>
                <ul>
                    <li><?php echo Lang::T('After adding each trial plan, go to the Hotspot settings for the selected router and save changes before adding another trial plan. Repeat this process for each new trial plan.');?>
</li>
                    <li><?php echo Lang::T('Ensure the assigned plan is correctly configured with appropriate bandwidth and usage limits.');?>
</li>
                    <li><?php echo Lang::T('Set a reasonable "Trial Uptime Limit" to control how long the trial can be used without interruptions.');?>
</li>
                    <li><?php echo Lang::T('Use the "Trial Uptime Reset" feature to periodically reset the trial usage, providing flexibility for repeated trials.');?>
</li>
                </ul>

                <h4><?php echo Lang::T('Best Practices');?>
</h4>
                <ul>
                    <li><?php echo Lang::T('Create a new hotspot plan and name it uniquely to easily identify the associated router. For example, name the plan "Trial for Router1" (replace "Router1" with your actual router name). This naming convention will help you quickly identify and select the correct plan when configuring your trial plans for different routers.');?>
</li>
                    <li><?php echo Lang::T('When creating a trial plan choose the right plan its advised to create a hotspot trial plan for each router and name it differently.');?>
</li>
                    <li><?php echo Lang::T('Keep trial periods short enough to encourage conversion to paid plans, but long enough for users to see the full value.');?>
</li>
                    <li><?php echo Lang::T('Communicate clearly with users about trial limits, reset intervals, and what happens when the trial ends.');?>
</li>
                </ul>

                <h4><?php echo Lang::T('Troubleshooting');?>
</h4>
                <p><?php echo Lang::T('If users report issues with trial connectivity or unexpected disconnections, check the uptime limits and reset intervals. Ensure that the assigned router and plan settings are correctly configured and that no conflicting settings exist.');?>
</p>

                <h4><?php echo Lang::T('Additional Resources');?>
</h4>
                <p><?php echo Lang::T('For further assistance and advanced configuration tips, refer to our comprehensive guide available in the support section or reach out to our technical support team.');?>
</p>
                
                <div class="alert alert-info">
                    <strong><?php echo Lang::T('Tip');?>
:</strong> <?php echo Lang::T('NOTE:: After adding a trial plan
                    immediately go to Hotspot Settings and Save Changes on the right router before going to the next router if you have multiple routers
                   .');?>
</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
