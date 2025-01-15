{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{$_url}bulk_actions/mass_delete">
            <div class="panel panel-hovered mb20 panel-danger"> <!-- Kept 'panel-danger' for consistency in delete actions -->
                <div class="panel-heading">{Lang::T('Mass Delete Users')}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="criteria">{Lang::T('Delete Users Based On')}</label>
                        <select name="criteria" id="criteria" class="form-control" required>
                            <option value="expired">{Lang::T('Expired Accounts')}</option>
                            <option value="inactive">{Lang::T('Inactive Accounts')}</option>
                            <!-- Add more criteria if needed -->
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
                    <button type="submit" class="btn btn-danger">{Lang::T('Delete Users')}</button> <!-- Kept 'btn-danger' for delete action -->
                </div>
            </div>
        </form>
    </div>
</div>

{include file="sections/footer.tpl"}
