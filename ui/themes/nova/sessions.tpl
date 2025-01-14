{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('Active Sessions')}</span>
                <div class="btn-group">
                    <!-- Refresh Button -->
                    <a href="{U}sessions/list" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> {Lang::T('Refresh')}
                    </a>
                </div>
            </div>

            <div class="panel-body">
                {if $sessions|@count > 0}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>{Lang::T('Session ID')}</th>
                                    <th>{Lang::T('User ID')}</th>
                                    <th>{Lang::T('Username')}</th>
                                    <th>{Lang::T('Last Activity')}</th>
                                    <th>{Lang::T('IP Address')}</th>
                                    <th>{Lang::T('Manage')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$sessions item=session}
                                    {if $session.session_id == $current_session_id}
                                        <tr class="info">
                                            <td>{$session.session_id}</td>
                                            <td>{$session.user_id}</td>
                                            <td>{$session.username}</td>
                                            <td>{$session.last_activity}</td>
                                            <td>{$session.ip_address}</td>
                                            <td>
                                                <span class="label label-success">{Lang::T('Current Device')}</span>
                                            </td>
                                        </tr>
                                    {else}
                                        <tr>
                                            <td>{$session.session_id}</td>
                                            <td>{$session.user_id}</td>
                                            <td>{$session.username}</td>
                                            <td>{$session.last_activity}</td>
                                            <td>{$session.ip_address}</td>
                                            <td>
                                                <a href="{U}sessions/delete/{$session.session_id}" class="btn btn-danger btn-xs" onclick="return confirm('{Lang::T('Are you sure you want to log out this user?')}')">
                                                    <i class="glyphicon glyphicon-trash"></i> {Lang::T('Log Out')}
                                                </a>
                                            </td>
                                        </tr>
                                    {/if}
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {else}
                    <p>{Lang::T('No active sessions found.')}</p>
                {/if}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
