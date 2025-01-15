{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{$_url}bulk_actions/bulk_edit_router">
            <div class="panel panel-hovered mb20 panel-primary"> <!-- Default blue panel -->
                <div class="panel-heading">{Lang::T('Bulk Edit Routers')}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="current_router_id">{Lang::T('Current Router')}</label>
                        <select name="current_router_id" id="current_router_id" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_router_id">{Lang::T('New Router')}</label>
                        <select name="new_router_id" id="new_router_id" class="form-control" required>
                            <option value="">{Lang::T('Select New Router')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}">{$router.name}</option>
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
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Routers')}</button> <!-- Primary button style -->
                </div>
            </div>
        </form>
    </div>
</div>

{include file="sections/footer.tpl"}
