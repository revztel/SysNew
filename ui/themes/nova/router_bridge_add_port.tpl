{include file="sections/header.tpl"}

<!-- Add Port to Bridge -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add Port to Bridge')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_bridge/add-port">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <div class="form-group">
                        <label for="interface">{Lang::T('Interface')}</label>
                        <select name="interface" class="form-control" required>
                            {foreach $interfaces as $interface}
                            <option value="{$interface}">{$interface}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bridge">{Lang::T('Bridge')}</label>
                        <select name="bridge" class="form-control" required>
                            {foreach $bridges as $bridge}
                            <option value="{$bridge}">{$bridge}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add Port')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
