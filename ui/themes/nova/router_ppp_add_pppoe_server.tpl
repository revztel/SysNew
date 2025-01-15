{include file="sections/header.tpl"}

<!-- Add PPPoE Server -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add PPPoE Server')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_ppp/add-pppoe-server/{$router_id}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <div class="form-group">
                        <label for="service_name">{Lang::T('Service Name')}</label>
                        <input type="text" name="service_name" class="form-control" required>
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
                        <label for="max_mtu">{Lang::T('Max MTU')}</label>
                        <input type="number" name="max_mtu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="max_mru">{Lang::T('Max MRU')}</label>
                        <input type="number" name="max_mru" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled"> {Lang::T('Enable PPPoE Server')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add PPPoE Server')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
