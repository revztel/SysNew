{include file="sections/header.tpl"}

<!-- Edit Port -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit Port')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_bridge/edit-port">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="port_id" value="{$port.id}">
                    <div class="form-group">
                        <label for="interface">{Lang::T('Interface')}</label>
                        <select name="interface" class="form-control" required>
                            {foreach $interfaces as $interface}
                                <option value="{$interface}" {if $interface == $port.interface}selected{/if}>{$interface}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bridge">{Lang::T('Bridge')}</label>
                        <select name="bridge" class="form-control" required>
                            {foreach $bridges as $bridge}
                                <option value="{$bridge}" {if $bridge == $port.bridge}selected{/if}>{$bridge}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control" value="{$port.comment}">
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Port')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
