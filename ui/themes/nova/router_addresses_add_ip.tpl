{include file="sections/header.tpl"}

<!-- Add IP Address -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add IP Address')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_addresses/add-ip/{$router_id}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <div class="form-group">
                        <label for="address">{Lang::T('Address')}</label>
                        <input type="text" name="address" class="form-control" placeholder="e.g., 192.168.1.1/24" required>
                    </div>
                    <div class="form-group">
                        <label for="interface">{Lang::T('Interface')}</label>
                        <select name="interface" class="form-control" required>
                            {foreach $interfaces as $interface}
                            <option value="{$interface}">{$interface}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled"> {Lang::T('Disable IP Address')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add IP Address')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
