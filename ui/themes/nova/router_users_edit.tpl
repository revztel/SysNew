{include file="sections/header.tpl"}

<!-- Edit Router User -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit User on Router')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_users/edit/{$router_id}/{urlencode($user.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="user_id" value="{$user.id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" value="{$user.name}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">{Lang::T('Password')}</label>
                        <input type="password" name="password" class="form-control" placeholder="{Lang::T('Leave blank to keep current password')}">
                    </div>
                    <div class="form-group">
                        <label for="group">{Lang::T('Group')}</label>
                        <select name="group" class="form-control" required>
                            {foreach $groups as $group}
                            <option value="{$group}" {if $group == $user.group}selected{/if}>{$group}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control" value="{$user.comment}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled" {if $user.disabled}checked{/if}> {Lang::T('Disable User')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update User')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
