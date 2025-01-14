{include file="sections/header.tpl"}

<!-- Router Queues Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Queues Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_queues/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Queues')}</button>
                </form>

                {if isset($queues)}
                <h3>{Lang::T('Queues')}</h3>
                <a href="{$_url}router_queues/add-queue/{$selected_router.id}" class="btn btn-success">{Lang::T('Add Queue')}</a>
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>{Lang::T('ID')}</th>
                            <th>{Lang::T('Name')}</th>
                            <th>{Lang::T('Target')}</th>
                            <th>{Lang::T('Max Limit')}</th>
                            <th>{Lang::T('Comment')}</th>
                            <th>{Lang::T('Disabled')}</th>
                            <th>{Lang::T('Actions')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $queues as $queue}
                        <tr>
                            <td>{$queue.id}</td>
                            <td>{$queue.name}</td>
                            <td>{$queue.target}</td>
                            <td>{$queue.max_limit}</td>
                            <td>{$queue.comment}</td>
                            <td>{$queue.disabled}</td>
                            <td>
                                <a href="{$_url}router_queues/edit-queue/{$selected_router.id}/{urlencode($queue.id)}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                <form method="post" action="{$_url}router_queues/delete-queue" style="display:inline;">
                                    <input type="hidden" name="router_id" value="{$selected_router.id}">
                                    <input type="hidden" name="queue_id" value="{$queue.id}">
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
