{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('Prepaid Users')}</span>
                {if in_array($_admin['user_type'],['SuperAdmin','Admin'])}
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-right: 10px;">
                            {Lang::T('Need Help?')}
                        </button>
                        <a class="btn btn-primary btn-xs" title="sync" href="{$_url}prepaid/sync" onclick="return confirm('This will sync/send Customer active plan to Mikrotik?')">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Sync All
                        </a>
                        <!-- Sync by Router Button -->
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#routerSyncModal">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> {Lang::T('Sync by Router')}
                        </button>
                        <a class="btn btn-info btn-xs" title="export" href="{$_url}customers/csv-prepaid" onclick="return confirm('This will export to CSV?')">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> CSV
                        </a>
                    </div>
                {/if}
            </div>

            <!-- Tab Navigation for different types of users -->
            <ul class="nav nav-tabs nav-justified">
                <li class="{if $filter == 'list'}active{/if}">
                    <a href="{$_url}prepaid/list" class="bg-primary">
                        <i class="fa fa-users"></i> {Lang::T('All Users')}
                    </a>
                </li>
                <li class="{if $filter == 'hotspot'}active{/if}">
                    <a href="{$_url}prepaid/list_hotspot" class="bg-warning">
                        <i class="fa fa-wifi"></i> {Lang::T('Hotspot Users')}
                    </a>
                </li>
                <li class="{if $filter == 'static'}active{/if}">
                    <a href="{$_url}prepaid/list_static" class="bg-info">
                        <i class="fa fa-desktop"></i> {Lang::T('Static Users')}
                    </a>
                </li>
                <li class="{if $filter == 'pppoe'}active{/if}">
                    <a href="{$_url}prepaid/list_pppoe" class="bg-purple">
                        <i class="fa fa-exchange"></i> {Lang::T('PPPoE Users')}
                    </a>
                </li>
            </ul>

            <!-- Prepaid Users Table -->
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="{$_url}prepaid/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="{Lang::T('Search by Username')}..." value="{$search}">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit">{Lang::T('Search')}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="{$_url}prepaid/recharge" class="btn btn-primary btn-block">
                            <i class="ion ion-android-add"> </i> {Lang::T('Recharge Account')}
                        </a>
                    </div>&nbsp;
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>{Lang::T('Username')}</th>
                                <th>{Lang::T('Plan Name')}</th>
                                <th>{Lang::T('Type')}</th>
                                <th>{Lang::T('Created On')}</th>
                                <th>{Lang::T('Expires On')}</th>
                                <th>{Lang::T('Method')}</th>
                                <th>{Lang::T('Routers')}</th>
                                <th>{Lang::T('Status')}</th>
                                <th>{Lang::T('Last Seen')}</th>
                                <th>{Lang::T('Daily Data')} </th>
                                <th>{Lang::T('Was Connected?')} <a href="#" data-toggle="tooltip" title="This column shows if the account was connected during payment."><i class="fa fa-question-circle"></i></a></th>
                                <th>{Lang::T('Reconnection SMS')} <a href="#" data-toggle="tooltip" title="If not connected, we send SMS for reconnection to the customer."><i class="fa fa-question-circle"></i></a></th>
                                <!-- New Disconnection Reason Column -->
                                <th>{Lang::T('Disconnection Reason')} <a href="#" data-toggle="tooltip" title="This column shows the reason for disconnection."><i class="fa fa-question-circle"></i></a></th>
                                <th>{Lang::T('FUP')}</th> <!-- Added FUP Column -->
                                <th>{Lang::T('Manage')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $d as $ds}
                                <tr {if $ds['status']=='off'}class="danger"{/if}>
                                    <td><a href="{$_url}customers/viewu/{$ds['username']}">{$ds['username']}</a></td>
                                    <td>{$ds['namebp']}</td>
                                    <td>{$ds['type']}</td>
                                    <td>{Lang::dateAndTimeFormat($ds['recharged_on'], $ds['recharged_time'])}</td>
                                    <td>{Lang::dateAndTimeFormat($ds['expiration'], $ds['time'])}</td>
                                    <td>{$ds['method']}</td>
                                    <td>{$ds['routers']}</td>
                                    <td>
                                        <span class="label {if $ds['state'] == 'Online'}label-success{elseif $ds['state'] == 'disabled'}label-warning{else}label-danger{/if}">
                                            {$ds['state']}
                                        </span>
                                    </td>
                                    <td>
                                        {if $ds['state'] == 'Online'}
                                            <span class="label label-success">{Lang::T('Currently Online')}</span>
                                        {elseif $ds['state'] == 'disabled'}
                                            <span class="label label-warning">{Lang::T('Disabled')}</span>
                                        {else}
                                            <span class="label label-danger">{Lang::dateAndTimeFormat($ds['last_seen'], '')}</span>
                                        {/if}
                                    </td>
                                    <td>
                                        {if $ds['daily_usage']}
                                            <strong>{Lang::T('')}</strong> {$ds['daily_usage']['total']|convert_bytes}
                                        {else}
                                            <span class="label label-danger">{Lang::T('No data')}</span>
                                        {/if}
                                    </td>
                                    <td>
                                        {if $ds['was_connected'] == 'yes'}
                                            <span class="label label-success">Yes</span>
                                        {elseif $ds['was_connected'] == 'no'}
                                            <span class="label label-danger">No</span>
                                        {else}
                                            <span class="label label-default">N/A</span>
                                        {/if}
                                    </td>
                                    <td>
                                        {if $ds['reconnection'] == 'sms sent'}
                                            <span class="label label-success">Sent</span>
                                        {elseif $ds['reconnection'] == 'n/a'}
                                            <span class="label label-default">N/A</span>
                                        {else}
                                            <span class="label label-warning">Not Sent</span>
                                        {/if}
                                    </td>
                                    <!-- Disconnection Reason Column -->
                                    <td>
                                        {if $ds['disconnection_reason'] != ''}
                                            <div class="label label-danger">
                                                {$ds['disconnection_reason']}
                                            </div>
                                            <a href="#" class="label label-success btn-xs rectify-button" data-username="{$ds['username']}" data-reason="{$ds['disconnection_reason']}">Click to Rectify</a>
                                        {else}
                                            <span class="label label-default">N/A</span>
                                        {/if}
                                    </td>
                                    <td>
    {if $ds['fup_enabled'] == 1}
        <span class="label label-success">{Lang::T('Enabled')}</span>
    {else}
        <span class="label label-danger">{Lang::T('Disabled')}</span>
    {/if}
</td>

                                    <td>
                                        <a href="{$_url}prepaid/edit/{$ds['id']}" class="btn btn-success btn-xs">{Lang::T('Edit')}</a>
                                        <a href="{$_url}prepaid/extend/{$ds['id']}" class="btn btn-info btn-xs">{Lang::T('Extend')}</a>
                                        {if in_array($_admin['user_type'],['SuperAdmin','Admin'])}
                                            <a href="{$_url}prepaid/enable/{$ds['id']}" id="{$ds['id']}" onclick="return confirm('{Lang::T('Enable')}?')" class="btn btn-primary btn-xs">{Lang::T('Enable')}</a>
                                            <a href="{$_url}prepaid/disable/{$ds['id']}" id="{$ds['id']}" onclick="return confirm('{Lang::T('Disable')}?')" class="btn btn-warning btn-xs">{Lang::T('Disable')}</a>
                                            <a href="{$_url}prepaid/delete/{$ds['id']}" id="{$ds['id']}" onclick="return confirm('{Lang::T('Delete')}?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                {$paginator['contents']}
            </div>
        </div>
    </div>

<!-- Tutorial Modal -->
<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/8sHAiUXxH9w?si=KWoO8w_-dSFWuJoL" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Sync by Router Modal -->
<div class="modal fade" id="routerSyncModal" tabindex="-1" role="dialog" aria-labelledby="routerSyncModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="routerSyncModalLabel">{Lang::T('Select Router to Sync')}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="routerSyncForm" method="post" action="{$_url}prepaid/sync-router">
                    <div class="form-group">
                        <label for="routerSelect">{Lang::T('Router')}</label>
                        <select id="routerSelect" name="router" class="form-control select2" required>
                            <option value="">{Lang::T('Select Router')}</option>
                            {foreach $routerssync as $router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">{Lang::T('Sync Now')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}

<!-- Include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="path/to/sweetalert2.min.css">
<script src="path/to/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.rectify-button').on('click', function(e) {
            e.preventDefault();
            var username = $(this).data('username');
            var reason = $(this).data('reason');

            // Check disconnection reason and show appropriate message
            if (reason === 'keepalive timeout') {
                Swal.fire({
                    title: 'Connection Issue',
                    html: 'Customer disconnected/moved out of network. To reconnect, tell the customer to click on sign in. If it doesn\'t work, use this username: <strong>' + username + '</strong> and password: <strong>1234</strong> and enter on "Already Paid" Section. Only do this if Client Complains He/She might have disconnected willingly',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'traffic limit reached') {
                Swal.fire({
                    title: 'Information',
                    text: 'Customer has exhausted assigned data. Renew the account to reconnect.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'session timeout') {
                Swal.fire({
                    title: 'Session Expired/Time Limit Reached',
                    text: 'The customer\'s allocated time has ended. Ask them to Pay again to continue using the service.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'N/A') {
                Swal.fire({
                    title: 'Information',
                    text: 'Customer is either expired / online / just disconnected/Router is Offline or the system hasn\'t checked yet. Please wait at least 10 minutes and check again.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else if (reason === 'expired') {
                Swal.fire({
                    title: 'Account Expired',
                    text: 'This disconnection was caused by account  expiry. Reactivate or let the customer buy again.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Unknown Reason',
                    text: 'No specific instructions available for this disconnection reason.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
