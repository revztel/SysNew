{include file="sections/header.tpl"}

<!-- pool -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('IP Pool')}</span>
                <div class="btn-group">
                    <!-- Sync All Button -->
                    <a class="btn btn-primary btn-xs" title="Sync All" href="{$_url}pool/sync" onclick="return confirm('This will sync/send IP Pool to all Mikrotik routers?')">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> {Lang::T('Sync All')}
                    </a>
                    <!-- Sync Specific Router Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#routerSyncModal">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> {Lang::T('Sync by Router')}
                    </button>
                    <!-- Need Help Button -->
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: 10px;">
                        {Lang::T('Need Help?')}
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="{$_url}pool/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="{Lang::T('Search by Name')}...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit">{Lang::T('Search')}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="{$_url}pool/add" class="btn btn-primary btn-block"><i class="ion ion-android-add"> </i> {Lang::T('New Pool')}</a>
                    </div>&nbsp;
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>{Lang::T('Name Pool')}</th>
                                <th>{Lang::T('Range IP')}</th>
                                <th>{Lang::T('Routers')}</th>
                                <th>{Lang::T('Manage')}</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $d as $ds}
                                <tr>
                                    <td>{$ds['pool_name']}</td>
                                    <td>{$ds['range_ip']}</td>
                                    <td>{$ds['routers']}</td>
                                    <td align="center">
                                        <a href="{$_url}pool/edit/{$ds['id']}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <a href="{$_url}pool/delete/{$ds['id']}" id="{$ds['id']}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    <td>{$ds['id']}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                {$paginator['contents']}
            </div>
        </div>
    </div>
</div>

<!-- Sync by Router Modal -->
<div class="modal fade" id="routerSyncModal" tabindex="-1" role="dialog" aria-labelledby="routerSyncModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="routerSyncModalLabel">{Lang::T('Select Router to Sync')}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="routerSyncForm" method="post" action="{$_url}pool/sync-specific">
                    <div class="form-group">
                        <label for="routerSelect">{Lang::T('Router')}</label>
                        <select id="routerSelect" name="router_id" class="form-control select2" required>
                            <option value="">{Lang::T('Select Router')}</option>
                            {foreach $routers as $router}
                                <option value="{$router.id}">{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Sync Now')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Need Help Modal -->
<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tQNY_TfIIQE?si=pu14iOtkGNa3sO59" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<pre id="debug-output" style="background: #f0f0f0; padding: 10px; border: 1px solid #ddd;"></pre>

{include file="sections/footer.tpl"}
