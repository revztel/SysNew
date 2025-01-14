{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="panel-title">{Lang::T('Offline History for Router')} <strong>{$router['name']}</strong></h3>
                <a href="{$_url}routers/list" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> {Lang::T('Back to Routers')}
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed">
                        <thead>
                            <tr class="info">
                                <th>{Lang::T('Offline Timestamp')}</th>
                                <th>{Lang::T('Online Timestamp')}</th>
                                <th>{Lang::T('Duration')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {if $offlineEvents|@count > 0}
                                {foreach $offlineEvents as $event}
                                <tr>
                                    <td>{$event.offline_timestamp|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td>{$event.online_timestamp|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td>{$event.formatted_duration}</td>
                                </tr>
                                {/foreach}
                            {else}
                                <tr>
                                    <td colspan="3" class="text-center text-muted">{Lang::T('No offline events found')}</td>
                                </tr>
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .panel {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
    .panel-heading {
        background-color: #31708f;
        color: #ffffff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        padding: 15px;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .table thead {
        background-color: #f0f8ff;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-primary {
        background-color: #31708f;
        border-color: #31708f;
    }
</style>

{include file="sections/footer.tpl"}
