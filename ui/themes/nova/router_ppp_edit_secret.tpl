{include file="sections/header.tpl"}

<!-- Edit Secret -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit Secret')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_ppp/edit-secret/{$router_id}/{urlencode($secret.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="secret_id" value="{$secret.id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" value="{$secret.name}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">{Lang::T('Password')}</label>
                        <input type="text" name="password" class="form-control" value="{$secret.password}" required>
                    </div>
                    <div class="form-group">
                        <label for="profile">{Lang::T('Profile')}</label>
                        <select name="profile" class="form-control">
                            {foreach $profiles as $profile}
                            <option value="{$profile}" {if $profile == $secret.profile}selected{/if}>{$profile}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">{Lang::T('Service')}</label>
                        <select name="service" class="form-control">
                            <option value="any" {if $secret.service == 'any'}selected{/if}>Any</option>
                            <option value="pppoe" {if $secret.service == 'pppoe'}selected{/if}>PPPoE</option>
                            <option value="pptp" {if $secret.service == 'pptp'}selected{/if}>PPTP</option>
                            <!-- Add other services as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control" value="{$secret.comment}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled" {if $secret.enabled}checked{/if}> {Lang::T('Enable Secret')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Secret')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
