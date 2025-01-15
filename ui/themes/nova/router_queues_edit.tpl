{include file="sections/header.tpl"}

<!-- Edit Queue -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Edit Queue')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_queues/edit-queue/{$router_id}/{urlencode($queue.id)}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <input type="hidden" name="queue_id" value="{$queue.id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" value="{$queue.name}" required>
                    </div>
                    <div class="form-group">
                        <label for="target">{Lang::T('Target')}</label>
                        <input type="text" name="target" class="form-control" value="{$queue.target}" required>
                    </div>
                    <div class="form-group">
                        <label for="max_limit">{Lang::T('Max Limit')}</label>
                        <input type="text" name="max_limit" class="form-control" value="{$queue.max_limit}" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control" value="{$queue.comment}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled" {if $queue.disabled}checked{/if}> {Lang::T('Disable Queue')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Update Queue')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
