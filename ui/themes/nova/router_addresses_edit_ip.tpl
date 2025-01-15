{include file="sections/header.tpl"}

<!-- Edit IP Address -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit IP Address')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_addresses/edit-ip/{$router_id}/{urlencode($ip.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="ip_id" value="{$ip.id}">
                    <div class="form-group">
                        <label for="address">{Lang::T('Address')}</label>
                        <input type="text" name="address" class="form-control" value="{$ip.address}" required>
                    </div>
                    <div class="form-group">
                        <label for="interface">{Lang::T('Interface')}</label>
                        <select name="interface" class="form-control" required>
                            {foreach $interfaces as $interface}
                            <option value="{$interface}" {if $interface == $ip.interface}selected{/if}>{$interface}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control" value="{$ip.comment}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled" {if $ip.disabled}checked{/if}> {Lang::T('Disable IP Address')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update IP Address')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
