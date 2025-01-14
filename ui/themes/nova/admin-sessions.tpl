<h2>{Lang::T('Active Sessions')}</h2>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{Lang::T('Session ID')}</th>
            <th>{Lang::T('User ID')}</th>
            <th>{Lang::T('Username')}</th>
            <th>{Lang::T('Last Activity')}</th>
            <th>{Lang::T('Actions')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$sessions item=session}
        <tr>
            <td>{$session.session_id}</td>
            <td>{$session.user_id}</td>
            <td>{$session.username|default:'Guest'}</td>
            <td>{$session.last_activity}</td>
            <td>
                <a href="{$_url}admin/session-delete?id={$session.session_id}" class="btn btn-danger btn-sm" onclick="return confirm('{Lang::T('Are you sure you want to delete this session?')}')">
                    {Lang::T('Delete')}
                </a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
