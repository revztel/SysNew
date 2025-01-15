{include file="sections/header.tpl"}

<!-- Add Hotspot Trial Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span>{Lang::T('Add Hotspot Trial')}</span>
            </div>
            <div class="panel-body">
                <form action="{$_url}trial/add-post" method="post" id="trial-form">
                    <div class="form-group">
                        <label for="trial_name">{Lang::T('Trial Name')}</label>
                        <input type="text" name="trial_name" class="form-control" placeholder="{Lang::T('Enter Trial Name')}" required>
                    </div>

                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control" required onchange="fetchPlans()">
                            <option value="">{Lang::T('Select Router')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_id">{Lang::T('Select Plan')}</label>
                        <select name="plan_id" id="plan_id" class="form-control" required>
                            <option value="">{Lang::T('Select Plan')}</option>
                            {foreach from=$plans item=plan}
                                <option value="{$plan.id}">{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time_limit">{Lang::T('Trial Uptime Limit (Minutes)')}</label>
                        <input type="number" name="time_limit" class="form-control" placeholder="{Lang::T('Enter Trial Uptime Limit in Minutes')}" required>
                    </div>

                    <div class="form-group">
                        <label for="uptime_reset">{Lang::T('Trial Uptime Reset (Days)')}</label>
                        <input type="number" name="uptime_reset" class="form-control" placeholder="{Lang::T('Enter Trial Uptime Reset in Days')}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{Lang::T('Create Trial')}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// JavaScript function to fetch plans based on the selected router
function fetchPlans() {
    var routerId = document.getElementById('router_id').value;

    if (!routerId) {
        console.error('No router selected.');
        return;
    }

    // Make an AJAX call to update the plans dropdown based on the selected router
    fetch('{$_url}trial/fetch-plans', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'router_id=' + encodeURIComponent(routerId),
    })
    .then(response => response.json())
    .then(data => {
        var planSelect = document.getElementById('plan_id');
        planSelect.innerHTML = '<option value="">{Lang::T("Select Plan")}</option>';
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
</script>



{include file="sections/footer.tpl"}
