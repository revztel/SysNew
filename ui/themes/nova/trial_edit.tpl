{include file="sections/header.tpl"}

<!-- Edit Hotspot Trial Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span>{Lang::T('Edit Hotspot Trial')}</span>
            </div>
            <div class="panel-body">
                <form action="{$_url}trial/edit-post" method="post" id="trial-edit-form">
                    <input type="hidden" name="id" value="{$trial.id}">
                    
                    <div class="form-group">
                        <label for="trial_name">{Lang::T('Trial Name')}</label>
                        <input type="text" name="trial_name" class="form-control" value="{$trial.name}" placeholder="{Lang::T('Enter Trial Name')}" required>
                    </div>

                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control" required>
                            <option value="">{Lang::T('Select Router')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}" {if $router.id == $trial.router_id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_id">{Lang::T('Select Plan')}</label>
                        <select name="plan_id" id="plan_id" class="form-control" required>
                            <option value="">{Lang::T('Select Plan')}</option>
                            {foreach from=$hotspotPlans item=plan}
                                <option value="{$plan.id}" {if $plan.id == $trial.plan_id}selected{/if}>{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time_limit">{Lang::T('Trial Uptime Limit (Minutes)')}</label>
                        <input type="number" name="time_limit" class="form-control" value="{$trial.time_limit}" placeholder="{Lang::T('Enter Trial Uptime Limit in Minutes')}" required>
                    </div>

                    <div class="form-group">
                        <label for="uptime_reset">{Lang::T('Trial Uptime Reset (Days)')}</label>
                        <input type="number" name="uptime_reset" class="form-control" value="{$trial.uptime_reset}" placeholder="{Lang::T('Enter Trial Uptime Reset in Days')}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{Lang::T('Update Trial')}</button>
                    <a href="{$_url}trial/list" class="btn btn-secondary">{Lang::T('Cancel')}</a>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
