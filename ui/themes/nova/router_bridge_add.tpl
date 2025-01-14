{include file="sections/header.tpl"}

<!-- Add Bridge -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add Bridge')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_bridge/add-bridge">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Router')}</label>
                        <select name="router_id" class="form-control" required>
                            {foreach $routers as $router}
                            <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{Lang::T('Bridge Name')}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add Bridge')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
