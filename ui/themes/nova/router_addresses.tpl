{include file="sections/header.tpl"}

<!-- Router Addresses Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Addresses Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_addresses/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Data')}</button>
                </form>

                {if isset($ipAddresses)}
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#ip_addresses">{Lang::T('IP Addresses')}</a></li>
                    <li><a data-toggle="tab" href="#arp">{Lang::T('ARP Table')}</a></li>
                    <li><a data-toggle="tab" href="#ip_services">{Lang::T('IP Services')}</a></li>
                    <li><a data-toggle="tab" href="#firewall">{Lang::T('Firewall')}</a></li>
                </ul>

                <div class="tab-content">
                    <!-- IP Addresses Tab -->
                    <div id="ip_addresses" class="tab-pane fade in active">
                        <h3>{Lang::T('IP Addresses')}</h3>
                        <a href="{$_url}router_addresses/add-ip/{$selected_router.id}" class="btn btn-success">{Lang::T('Add IP Address')}</a>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Address')}</th>
                                    <th>{Lang::T('Network')}</th>
                                    <th>{Lang::T('Interface')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                    <th>{Lang::T('Disabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $ipAddresses as $ip}
                                <tr>
                                    <td>{$ip.id}</td>
                                    <td>{$ip.address}</td>
                                    <td>{$ip.network}</td>
                                    <td>{$ip.interface}</td>
                                    <td>{$ip.comment}</td>
                                    <td>{$ip.disabled}</td>
                                    <td>
                                        <a href="{$_url}router_addresses/edit-ip/{$selected_router.id}/{urlencode($ip.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <form method="post" action="{$_url}router_addresses/delete-ip" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="ip_id" value="{$ip.id}">
                                            <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                        </form>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- ARP Table Tab -->
                    <div id="arp" class="tab-pane fade">
                        <h3>{Lang::T('ARP Table')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('IP Address')}</th>
                                    <th>{Lang::T('MAC Address')}</th>
                                    <th>{Lang::T('Interface')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $arpEntries as $arp}
                                <tr>
                                    <td>{$arp.id}</td>
                                    <td>{$arp.address}</td>
                                    <td>{$arp.mac_address}</td>
                                    <td>{$arp.interface}</td>
                                    <td>{$arp.comment}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- IP Services Tab -->
                    <div id="ip_services" class="tab-pane fade">
                        <h3>{Lang::T('IP Services')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Name')}</th>
                                    <th>{Lang::T('Port')}</th>
                                    <th>{Lang::T('Address')}</th>
                                    <th>{Lang::T('Disabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $ipServices as $service}
                                <tr>
                                    <td>{$service.id}</td>
                                    <td>{$service.name}</td>
                                    <td>{$service.port}</td>
                                    <td>{$service.address}</td>
                                    <td>{$service.disabled}</td>
                                    <td>
                                        {if $service.disabled == 'Yes'}
                                            <a href="{$_url}router_addresses/disable-service/{$selected_router.id}/{urlencode($service.id)}" class="btn btn-warning btn-xs">{Lang::T('Disable')}</a>
                                        {else}
                                            <a href="{$_url}router_addresses/enable-service/{$selected_router.id}/{urlencode($service.id)}" class="btn btn-success btn-xs">{Lang::T('Enable')}</a>
                                        {/if}
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <!-- Firewall Tab -->
                    <div id="firewall" class="tab-pane fade">
                        <h3>{Lang::T('Firewall Rules')}</h3>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('ID')}</th>
                                    <th>{Lang::T('Chain')}</th>
                                    <th>{Lang::T('Action')}</th>
                                    <th>{Lang::T('Src Address')}</th>
                                    <th>{Lang::T('Dst Address')}</th>
                                    <th>{Lang::T('Comment')}</th>
                                    <th>{Lang::T('Disabled')}</th>
                                    <th>{Lang::T('Actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $firewallRules as $rule}
                                <tr>
                                    <td>{$rule.id}</td>
                                    <td>{$rule.chain}</td>
                                    <td>{$rule.action}</td>
                                    <td>{$rule.src_address}</td>
                                    <td>{$rule.dst_address}</td>
                                    <td>{$rule.comment}</td>
                                    <td>{$rule.disabled}</td>
                                    <td>
                                        {if $rule.disabled == 'Yes'}
                                            <a href="{$_url}router_addresses/disable-firewall-rule/{$selected_router.id}/{urlencode($rule.id)}" class="btn btn-warning btn-xs">{Lang::T('Disable')}</a>
                                        {else}
                                            <a href="{$_url}router_addresses/enable-firewall-rule/{$selected_router.id}/{urlencode($rule.id)}" class="btn btn-success btn-xs">{Lang::T('Enable')}</a>
                                        {/if}
                                        <form method="post" action="{$_url}router_addresses/delete-firewall-rule" style="display:inline;">
                                            <input type="hidden" name="router_id" value="{$selected_router.id}">
                                            <input type="hidden" name="rule_id" value="{$rule.id}">
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
