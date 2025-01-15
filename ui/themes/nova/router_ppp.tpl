{include file="sections/header.tpl"}

<!-- Router PPP Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router PPP Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_ppp/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load PPP Data')}</button>
                </form>

                {if isset($pppoeServers)}
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pppoe_servers">{Lang::T('PPPoE Servers')}</a></li>
                    <li><a data-toggle="tab" href="#secrets">{Lang::T('Secrets')}</a></li>
                    <li><a data-toggle="tab" href="#interfaces">{Lang::T('Interfaces')}</a></li>
                    <li><a data-toggle="tab" href="#profiles">{Lang::T('Profiles')}</a></li>
                </ul>

                <div class="tab-content">
                    <!-- PPPoE Servers Tab -->
                    <div id="pppoe_servers" class="tab-pane fade in active">
                        <h3>{Lang::T('PPPoE Servers')}</h3>
                        <a href="{$_url}router_ppp/add-pppoe-server/{$selected_router.id}" class="btn btn-success">{Lang::T('Add PPPoE Server')}</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Service Name')}</th>
                                    <th>{Lang::T('Interface')}</th>
                                    <th>{Lang::T('Max MTU')}</th>
                                    <th>{Lang::T('Max MRU')}</th>
                                    <th>{Lang::T('Enabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $pppoeServers as $server}
                                <tr>
                                    <td>{$server.id}</td>
                                    <td>{$server.service_name}</td>
                                    <td>{$server.interface}</td>
                                    <td>{$server.max_mtu}</td>
                                    <td>{$server.max_mru}</td>
                                    <td>{$server.enabled}</td>
                                    <td>
                                        <a href="{$_url}router_ppp/edit-pppoe-server/{$selected_router.id}/{urlencode($server.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <form method="post" action="{$_url}router_ppp/delete-pppoe-server" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="server_id" value="{$server.id}">
                                            <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                        </form>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Secrets Tab -->
                    <div id="secrets" class="tab-pane fade">
                        <h3>{Lang::T('Secrets')}</h3>
                        <a href="{$_url}router_ppp/add-secret/{$selected_router.id}" class="btn btn-success">{Lang::T('Add Secret')}</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Password')}</th>
                                    <th>{Lang::T('Service')}</th>
                                    <th>{Lang::T('Profile')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                    <th>{Lang::T('Enabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $secrets as $secret}
                                <tr>
                                    <td>{$secret.id}</td>
                                    <td>{$secret.name}</td>
                                    <td>{$secret.password}</td>
                                    <td>{$secret.service}</td>
                                    <td>{$secret.profile}</td>
                                    <td>{$secret.comment}</td>
                                    <td>{$secret.enabled}</td>
                                    <td>
                                        <a href="{$_url}router_ppp/edit-secret/{$selected_router.id}/{urlencode($secret.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <form method="post" action="{$_url}router_ppp/delete-secret" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="secret_id" value="{$secret.id}">
                                            <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                        </form>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Interfaces Tab -->
                    <div id="interfaces" class="tab-pane fade">
                        <h3>{Lang::T('Interfaces')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Type')}</th>
                                    <th>{Lang::T('MTU')}</th>
                                    <th>{Lang::T('MAC Address')}</th>
                                    <th>{Lang::T('Running')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $interfaces as $interface}
                                <tr>
                                    <td>{$interface.id}</td>
                                    <td>{$interface.name}</td>
                                    <td>{$interface.type}</td>
                                    <td>{$interface.mtu}</td>
                                    <td>{$interface.mac_address}</td>
                                    <td>{$interface.running}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Profiles Tab -->
                    <div id="profiles" class="tab-pane fade">
                        <h3>{Lang::T('Profiles')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Local Address')}</th>
                                    <th>{Lang::T('Remote Address')}</th>
                                    <th>{Lang::T('Only One')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $profiles as $profile}
                                <tr>
                                    <td>{$profile.id}</td>
                                    <td>{$profile.name}</td>
                                    <td>{$profile.local_address}</td>
                                    <td>{$profile.remote_address}</td>
                                    <td>{$profile.only_one}</td>
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
