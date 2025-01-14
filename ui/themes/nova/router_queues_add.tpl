{include file="sections/header.tpl"}

<!-- Add Queue -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Add Queue')}
            </div>
            <div class="panel-body">
                <form method="post" action="{$_url}router_queues/add-queue/{$router_id}">
                    <input type="hidden" name="router_id" value="{$router_id}">
                    <div class="form-group">
                        <label for="name">{Lang::T('Name')}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="target">{Lang::T('Target')}</label>
                        <input type="text" name="target" class="form-control" placeholder="e.g., 192.168.1.0/24" required>
                    </div>
                    <div class="form-group">
                        <label for="max_limit">{Lang::T('Max Limit')}</label>
                        <input type="text" name="max_limit" class="form-control" placeholder="e.g., 2M/2M" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">{Lang::T('Comment')}</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="disabled"> {Lang::T('Disable Queue')}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Add Queue')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
