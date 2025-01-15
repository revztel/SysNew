<h2>{Lang::T('Active Users')}</h2>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{Lang::T('User ID')}</th>
            <th>{Lang::T('Username')}</th>
            <th>{Lang::T('Last Login')}</th>
            <th>{Lang::T('Actions')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$active_users item=user}
        <tr>
            <td>{$user.id}</td>
            <td>{$user.username}</td>
            <td>{$user.last_login}</td>
            <td>
                <a href="{U}admin/logout-user?id={$user.id}" class="btn btn-danger btn-sm" onclick="return confirm('{Lang::T('Are you sure you want to log out this user?')}')">
                    {Lang::T('Log Out')}
                </a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
