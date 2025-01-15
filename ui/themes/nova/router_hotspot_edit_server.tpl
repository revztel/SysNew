{include file="sections/header.tpl"}

<!-- Edit Hotspot Server -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit Hotspot Server')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_hotspot/edit-server/{$router_id}/{urlencode($server.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="server_id" value="{$server.id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" value="{$server.name}" required>
                    </div>
                    <div class="form-group">
                        <label for="address_pool">{Lang::T('Address Pool')}</label>
                        <input type="text" name="address_pool" class="form-control" value="{$server.address_pool}">
                    </div>
                    <div class="form-group">
                        <label for="profile">{Lang::T('Profile')}</label>
                        <select name="profile" class="form-control">
                            {foreach $profiles as $profile}
                            <option value="{$profile}" {if $profile == $server.profile}selected{/if}>{$profile}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled" {if $server.disabled}checked{/if}> {Lang::T('Disable Server')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Server')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
