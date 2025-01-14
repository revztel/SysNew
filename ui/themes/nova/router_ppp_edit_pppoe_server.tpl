{include file="sections/header.tpl"}

<!-- Edit PPPoE Server -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit PPPoE Server')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_ppp/edit-pppoe-server/{$router_id}/{urlencode($server.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="server_id" value="{$server.id}">
                    <div class="form-group">
                        <label for="service_name">{Lang::T('Service Name')}</label>
                        <input type="text" name="service_name" class="form-control" value="{$server.service_name}" required>
                    </div>
                    <div class="form-group">
                        <label for="interface">{Lang::T('Interface')}</label>
                        <select name="interface" class="form-control" required>
                            {foreach $interfaces as $interface}
                            <option value="{$interface}" {if $interface == $server.interface}selected{/if}>{$interface}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="max_mtu">{Lang::T('Max MTU')}</label>
                        <input type="number" name="max_mtu" class="form-control" value="{$server.max_mtu}">
                    </div>
                    <div class="form-group">
                        <label for="max_mru">{Lang::T('Max MRU')}</label>
                        <input type="number" name="max_mru" class="form-control" value="{$server.max_mru}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled" {if $server.enabled}checked{/if}> {Lang::T('Enable PPPoE Server')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update PPPoE Server')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
