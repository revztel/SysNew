{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{$_url}bulk_actions/bulk_edit_plan">
            <div class="panel panel-hovered mb20 panel-primary"> <!-- Changed to 'panel-primary' for consistent styling -->
                <div class="panel-heading">{Lang::T('Bulk Edit Plans')}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="current_plan_id">{Lang::T('Current Plan')}</label>
                        <select name="current_plan_id" id="current_plan_id" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$plans item=plan}
                                <option value="{$plan.id}">{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_plan_id">{Lang::T('New Plan')}</label>
                        <select name="new_plan_id" id="new_plan_id" class="form-control" required>
                            <option value="">{Lang::T('Select New Plan')}</option>
                            {foreach from=$plans item=plan}
                                <option value="{$plan.id}">{$plan.name_plan}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_type">{Lang::T('Service Type')}</label>
                        <select name="service_type" id="service_type" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$service_types item=type}
                                <option value="{$type}">{$type}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Plans')}</button> <!-- Changed button color to 'primary' for consistency -->
                </div>
            </div>
        </form>
    </div>
</div>

{include file="sections/footer.tpl"}
