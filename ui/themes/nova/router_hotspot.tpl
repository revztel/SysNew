{include file="sections/header.tpl"}

<!-- Router Hotspot Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Hotspot Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_hotspot/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Hotspot Data')}</button>
                </form>

                {if isset($servers)}
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#servers">{Lang::T('Servers')}</a></li>
                    <li><a data-toggle="tab" href="#profiles">{Lang::T('Server Profiles')}</a></li>
                    <li><a data-toggle="tab" href="#users">{Lang::T('Users')}</a></li>
                    <li><a data-toggle="tab" href="#active">{Lang::T('Active')}</a></li>
                    <li><a data-toggle="tab" href="#hosts">{Lang::T('Hosts')}</a></li>
                    <li><a data-toggle="tab" href="#ip_bindings">{Lang::T('IP Bindings')}</a></li>
                    <li><a data-toggle="tab" href="#walled_garden">{Lang::T('Walled Garden')}</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Servers Tab -->
                    <div id="servers" class="tab-pane fade in active">
                        <h3>{Lang::T('Hotspot Servers')}</h3>
                        <!-- Edit functionality -->
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Interface')}</th>
                                    <th>{Lang::T('Address Pool')}</th>
                                    <th>{Lang::T('Profile')}</th>
                                    <th>{Lang::T('Disabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $servers as $server}
                                <tr>
                                    <td>{$server.id}</td>
                                    <td>{$server.name}</td>
                                    <td>{$server.interface}</td>
                                    <td>{$server.address_pool}</td>
                                    <td>{$server.profile}</td>
                                    <td>{$server.disabled}</td>
                                    <td>
                                        <a href="{$_url}router_hotspot/edit-server/{$selected_router.id}/{urlencode($server.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Server Profiles Tab -->
                    <div id="profiles" class="tab-pane fade">
                        <h3>{Lang::T('Hotspot Server Profiles')}</h3>
                        <!-- Edit functionality -->
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Hotspot Address')}</th>
                                    <th>{Lang::T('DNS Name')}</th>
                                    <th>{Lang::T('Login By')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $profiles as $profile}
                                <tr>
                                    <td>{$profile.id}</td>
                                    <td>{$profile.name}</td>
                                    <td>{$profile.hotspot_address}</td>
                                    <td>{$profile.dns_name}</td>
                                    <td>{$profile.login_by}</td>
                                    <td>
                                        <a href="{$_url}router_hotspot/edit-profile/{$selected_router.id}/{urlencode($profile.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Users Tab (Read-only) -->
                    <div id="users" class="tab-pane fade">
                        <h3>{Lang::T('Hotspot Users')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Profile')}</th>
                                    <th>{Lang::T('Uptime')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $users as $user}
                                <tr>
                                    <td>{$user.id}</td>
                                    <td>{$user.name}</td>
                                    <td>{$user.profile}</td>
                                    <td>{$user.uptime}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Active Tab (Read-only) -->
                    <div id="active" class="tab-pane fade">
                        <h3>{Lang::T('Active Users')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('User')}</th>
                                    <th>{Lang::T('Address')}</th>
                                    <th>{Lang::T('Uptime')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $activeUsers as $active}
                                <tr>
                                    <td>{$active.id}</td>
                                    <td>{$active.user}</td>
                                    <td>{$active.address}</td>
                                    <td>{$active.uptime}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Hosts Tab (Read-only) -->
                    <div id="hosts" class="tab-pane fade">
                        <h3>{Lang::T('Hosts')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Address')}</th>
                                    <th>{Lang::T('MAC Address')}</th>
                                    <th>{Lang::T('To Address')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $hosts as $host}
                                <tr>
                                    <td>{$host.id}</td>
                                    <td>{$host.address}</td>
                                    <td>{$host.mac_address}</td>
                                    <td>{$host.to_address}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- IP Bindings Tab (Read-only) -->
                    <div id="ip_bindings" class="tab-pane fade">
                        <h3>{Lang::T('IP Bindings')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('MAC Address')}</th>
                                    <th>{Lang::T('Address')}</th>
                                    <th>{Lang::T('Type')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $ipBindings as $binding}
                                <tr>
                                    <td>{$binding.id}</td>
                                    <td>{$binding.mac_address}</td>
                                    <td>{$binding.address}</td>
                                    <td>{$binding.type}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Walled Garden Tab (Read-only) -->
                    <div id="walled_garden" class="tab-pane fade">
                        <h3>{Lang::T('Walled Garden')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Dst Host')}</th>
                                    <th>{Lang::T('Dst Port')}</th>
                                    <th>{Lang::T('Action')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $walledGardens as $wg}
                                <tr>
                                    <td>{$wg.id}</td>
                                    <td>{$wg.dst_host}</td>
                                    <td>{$wg.dst_port}</td>
                                    <td>{$wg.action}</td>
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
