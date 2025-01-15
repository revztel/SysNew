{include file="sections/header.tpl"}

<!-- Add Secret -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add Secret')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_ppp/add-secret/{$router_id}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">{Lang::T('Password')}</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="profile">{Lang::T('Profile')}</label>
                        <select name="profile" class="form-control">
                            {foreach $profiles as $profile}
                            <option value="{$profile}">{$profile}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">{Lang::T('Service')}</label>
                        <select name="service" class="form-control">
                            <option value="any">Any</option>
                            <option value="pppoe">PPPoE</option>
                            <option value="pptp">PPTP</option>
                            <!-- Add other services as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enabled"> {Lang::T('Enable Secret')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add Secret')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
