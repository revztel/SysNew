{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{$_url}bulk_actions/bulk_edit_expiry">
            <div class="panel panel-hovered mb20 panel-primary"> <!-- Updated panel color to 'primary' for consistency -->
                <div class="panel-heading">{Lang::T('Bulk Edit Expiry Period')}</div> <!-- Updated panel heading color -->
                <div class="panel-body">
                    <!-- New Expiry Date -->
                    <div class="form-group">
                        <label for="new_expiry_date">{Lang::T('New Expiry Date')}</label>
                        <input type="datetime-local" name="new_expiry_date" id="new_expiry_date" class="form-control" required>
                    </div>

                    <!-- Service Type -->
                    <div class="form-group">
                        <label for="service_type">{Lang::T('Service Type')}</label>
                        <select name="service_type" id="service_type" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$service_types item=type}
                                <option value="{$type}">{$type}</option>
                            {/foreach}
                        </select>
                    </div>

                    <!-- Router Selection -->
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            <option value="">{Lang::T('All')}</option>
                            {foreach from=$routers item=router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Expiry Dates')}</button> <!-- Updated button color to 'primary' -->
                </div>
            </div>
        </form>
    </div>
</div>

{include file="sections/footer.tpl"}
