{include file="sections/header.tpl"}

<!-- FUP Profile Add Form -->
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{$_url}fup/add-post">
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
                            {foreach from=$routers item=router}
                                <option value="{$router.name}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Service Type -->
                    <div class="form-group">
                        <label for="service_type">Service Type *</label>
                        <select name="service_type" class="form-control" required>
                            <option value="">Select Service Type</option>
                            {foreach from=$service_types item=type}
                                <option value="{$type}">{$type}</option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Plan to Switch To -->
                    <div class="form-group">
                        <label for="profile_on_limit">Plan to Switch To *</label>
                        <select name="profile_on_limit" class="form-control" required>
                            <option value="">Select Plan</option>
                            {foreach from=$plans item=plan}
                                <option value="{$plan.id}"
                                    data-service-type="{$plan.type}"
                                    data-router-id="{$plan.routers}">
                                    {$plan.name_plan} ({$plan.type})
                                </option>
                            {/foreach}
                        </select>
                    </div>
                    <!-- Select Plan Under FUP -->
                    <div class="form-group">
                        <label for="plan_under_fup">Select Plan Under FUP *</label>
                        <select name="plan_under_fup" class="form-control" required>
                            <option value="">Select Plan</option>
                            {foreach from=$plans item=plan}
                                <option value="{$plan.id}"
                                    data-service-type="{$plan.type}"
                                    data-router-id="{$plan.routers}">
                                    {$plan.name_plan} ({$plan.type})
                                </option>
                            {/foreach}
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

{include file="sections/footer.tpl"}

<!-- Custom JavaScript to filter plans based on router and service type -->
<script>
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
</script>
