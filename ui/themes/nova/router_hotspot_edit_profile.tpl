{include file="sections/header.tpl"}

<!-- Edit Hotspot Server Profile -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit Hotspot Server Profile')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_hotspot/edit-profile/{$router_id}/{urlencode($profile.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="profile_id" value="{$profile.id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Profile Name')}</label>
                        <input type="text" name="name" class="form-control" value="{$profile.name}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dns_name">{Lang::T('DNS Name')}</label>
                        <input type="text" name="dns_name" class="form-control" value="{$profile.dns_name}">
                    </div>
                    <div class="form-group">
                        <label>{Lang::T('Login By')}</label>
                        {assign var='selectedMethods' value=','|explode:$profile.login_by}
                        {foreach from=$loginMethods item=method}
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="login_by[]" value="{$method}" {if in_array($method, $selectedMethods)}checked{/if}> {$method}
                            </label>
                        </div>
                        {/foreach}
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Profile')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
