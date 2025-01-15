{include file="sections/header.tpl"}

<form method="post" action="{$_url}mikrotik_import/start_import">
    <div class="panel panel-primary">
        <div class="panel-heading">Mikrotik Import</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="router_id">Select Router</label>
                <select name="router_id" id="router_id" class="form-control" required>
                    <option value="">Select Router</option>
                    {foreach from=$routers item=router}
                        <option value="{$router.id}">{$router.name}</option>
                    {/foreach}
                </select>
            </div>
            <div class="form-group">
                <label for="type">Select Service Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Select Service Type</option>
                    <option value="Hotspot">Hotspot</option>
                    <option value="PPPOE">PPPoE</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Start Import</button>
        </div>
    </div>
</form>

{include file="sections/footer.tpl"}
