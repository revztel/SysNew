{include file="sections/header.tpl"}
<!-- pool -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <!-- Sync All Button -->
                    <a class="btn btn-primary btn-xs" title="Save" href="{$_url}pool/sync"
                        onclick="return confirm('This will sync/send IP Pool to Mikrotik?')">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Sync All
                    </a>

                    <!-- Sync by Router Dropdown and Button -->
                    <select id="router-select" class="btn btn-xs">
                        <option value="">{Lang::T('Select Router')}</option>
                        {foreach $routers as $router}
                            <option value="{$router['id']}">{$router['name']}</option>
                        {/foreach}
                    </select>
                    <button class="btn btn-primary btn-xs" onclick="syncByRouter()">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Sync by Router
                    </button>
                </div>
                {Lang::T('IP Pool')}
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="{$_url}pool/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{Lang::T('Search by Name')}...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit">{Lang::T('Search')}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="{$_url}pool/add" class="btn btn-primary btn-block">
                            <i class="ion ion-android-add"></i> {Lang::T('New Pool')}
                        </a>
                    </div>&nbsp;
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{Lang::T('Pool Name')}</th>
                                <th>{Lang::T('Ip Range')}</th>
                                <th>{Lang::T('Routers')}</th>
                                <th>{Lang::T('Manage')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$no = 1}
                            {foreach $d as $ds}
                                <tr>
                                    <td align="center">{$no++}</td>
                                    <td>{$ds['pool_name']}</td>
                                    <td>{$ds['range_ip']}</td>
                                    <td>{$ds['routers']}</td>
                                    <td align="center">
                                        <a href="{$_url}pool/edit/{$ds['id']}" class="btn btn-info btn-xs">
                                            {Lang::T('Edit')}
                                        </a>
                                        <a href="{$_url}pool/delete/{$ds['id']}" id="{$ds['id']}"
                                            class="btn btn-danger btn-xs">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
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

<script type="text/javascript">
function syncByRouter() {
    var routerId = document.getElementById('router-select').value;
    if (routerId) {
        if (confirm('This will sync/send IP Pool to the selected MikroTik Router. Are you sure?')) {
            window.location.href = "{$_url}pool/sync/" + routerId;
        }
    } else {
        alert('Please select a router.');
    }
}
</script>

{include file="sections/footer.tpl"}
