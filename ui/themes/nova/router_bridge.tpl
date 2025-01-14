{include file="sections/header.tpl"}

<!-- Router Bridge Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Bridge Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_bridge/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Bridges and Ports')}</button>
                </form>

                {if isset($bridges)}
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#bridges">{Lang::T('Bridges')}</a></li>
                    <li><a data-toggle="tab" href="#ports">{Lang::T('Ports')}</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Bridges Tab -->
                    <div id="bridges" class="tab-pane fade in active">
                        <h3>{Lang::T('Bridges')}</h3>
                        <a href="{$_url}router_bridge/add-bridge/{$selected_router.id}" class="btn btn-success">{Lang::T('Add Bridge')}</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $bridges as $bridge}
                                <tr>
                                    <td>{$bridge.id}</td>
                                    <td>{$bridge.name}</td>
                                    <td>{$bridge.comment}</td>
                                    <td>
                                        <a href="{$_url}router_bridge/edit-bridge/{$selected_router.id}/{$bridge.id}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <form method="post" action="{$_url}router_bridge/delete-bridge" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="bridge_id" value="{$bridge.id}">
                                            <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                        </form>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Ports Tab -->
                    <div id="ports" class="tab-pane fade">
                        <h3>{Lang::T('Ports')}</h3>
                        <a href="{$_url}router_bridge/add-port/{$selected_router.id}" class="btn btn-success">{Lang::T('Add Port')}</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Interface')}</th>
                                    <th>{Lang::T('Bridge')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $ports as $port}
                                <tr>
                                    <td>{$port.id}</td>
                                    <td>{$port.interface}</td>
                                    <td>{$port.bridge}</td>
                                    <td>{$port.comment}</td>
                                    <td>
                                        <a href="{$_url}router_bridge/edit-port/{$selected_router.id}/{urlencode($port.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <form method="post" action="{$_url}router_bridge/delete-port" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="port_id" value="{$port.id}">
                                            <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                        </form>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                {/if}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
