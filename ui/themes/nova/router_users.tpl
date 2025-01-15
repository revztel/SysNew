{include file="sections/header.tpl"}

<!-- Router Users Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Users Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_users/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Users')}</button>
                </form>

                {if isset($users)}
                <h3>{Lang::T('Users on')} {$selected_router.name}</h3>
                <a href="{$_url}router_users/add/{$selected_router.id}" class="btn btn-success">{Lang::T('Add User')}</a>
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>{Lang::T('ID')}</th>
                            <th>{Lang::T('Name')}</th>
                            <th>{Lang::T('Group')}</th>
                            <th>{Lang::T('Comment')}</th>
                            <th>{Lang::T('Disabled')}</th>
                            <th>{Lang::T('Actions')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $users as $user}
                        <tr>
                            <td>{$user.id}</td>
                            <td>{$user.name}</td>
                            <td>{$user.group}</td>
                            <td>{$user.comment}</td>
                            <td>{$user.disabled}</td>
                            <td>
                                <a href="{$_url}router_users/edit/{$selected_router.id}/{urlencode($user.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                <form method="post" action="{$_url}router_users/delete" style="display:inline;">
                                    <input type="hidden" name="router_id" value="{$selected_router.id}">
                                    <input type="hidden" name="user_id" value="{$user.id}">
                                    <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                </form>
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                {/if}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
