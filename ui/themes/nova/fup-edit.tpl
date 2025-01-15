{include file="sections/header.tpl"}

<!-- FUP Profile Edit Form -->
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{$_url}fup/edit-post">
            <input type="hidden" name="id" value="{$d.id}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit FUP Profile</h3>
                </div>
                <div class="panel-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" value="{$d.name}" required>
                    </div>
                    <!-- Data Limit -->
                    <div class="form-group">
                        <label for="data_limit">Data Limit *</label>
                        <input type="number" name="data_limit" class="form-control" value="{$d.data_limit}" required>
                    </div>
                    <!-- Data Limit Unit -->
                    <div class="form-group">
                        <label for="data_limit_unit">Data Limit Unit *</label>
                        <select name="data_limit_unit" class="form-control" required>
                            <option value="MB" {if $d.data_limit_unit == 'MB'}selected{/if}>MB</option>
                            <option value="GB" {if $d.data_limit_unit == 'GB'}selected{/if}>GB</option>
                            <option value="TB" {if $d.data_limit_unit == 'TB'}selected{/if}>TB</option>
                        </select>
                    </div>
                    <!-- Router -->
                    <div class="form-group">
                        <label for="router_id">Router *</label>
                        <select name="router_id" class="form-control" required>
                            <option value="">Select Router</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}" {if $d.router_id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Service Type -->
                    <div class="form-group">
                        <label for="service_type">Service Type *</label>
                        <select name="service_type" class="form-control" required>
                            <option value="">Select Service Type</option>
                            {foreach from=$service_types item=type}
                                <option value="{$type}" {if $d.service_type == $type}selected{/if}>{$type}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Plan Under FUP -->
                    <div class="form-group">
                        <label for="selected_plan">Plan Under FUP *</label>
                        <select name="selected_plan" class="form-control" required>
                            <option value="">Select Plan</option>
                            {foreach from=$allPlans item=plan}
                                <option value="{$plan.id}" {if $plan.id == $plans[0].id}selected{/if}>{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Plan After Limit -->
                    <div class="form-group">
                        <label for="profile_on_limit">Plan to Switch To *</label>
                        <select name="profile_on_limit" class="form-control" required>
                            <option value="">Select Plan</option>
                            {foreach from=$allPlans item=plan}
                                <option value="{$plan.id}" {if $plan.id == $d.profile_on_limit}selected{/if}>{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Active -->
                    <div class="form-group">
                        <label for="active">Active</label>
                        <input type="checkbox" name="active" value="1" {if $d.active == 1}checked{/if}>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Update FUP Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>

{include file="sections/footer.tpl"}
