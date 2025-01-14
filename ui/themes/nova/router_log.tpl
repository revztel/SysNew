{include file="sections/header.tpl"}

<!-- Router Logs -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Logs')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_log/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Logs')}</button>
                </form>

                {if isset($logs)}
                <h3>{Lang::T('Logs')}</h3>
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>{Lang::T('Time')}</th>
                            <th>{Lang::T('Topics')}</th>
                            <th>{Lang::T('Message')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $logs as $log}
                        <tr>
                            <td>{$log.time}</td>
                            <td>{$log.topics}</td>
                            <td>{$log.message}</td>
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
