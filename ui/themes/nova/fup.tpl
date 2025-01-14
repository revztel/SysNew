{include file="sections/header.tpl"}

<!-- FUP Profiles List -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span>{Lang::T('FUP Profiles')}</span>
                <div class="btn-group">
                    <a href="{$_url}fup/add" class="btn btn-primary btn-sm">
                        <i class="ion ion-android-add"></i> {Lang::T('New FUP Profile')}
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <form id="site-search" method="post" action="{$_url}fup/list/">
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>{Lang::T('Name')}</th>
                                <th>{Lang::T('Data Limit')}</th>
                                <th>{Lang::T('Service Type')}</th>
                                <th>{Lang::T('Router')}</th>
                                <th>{Lang::T('Profile on Limit')}</th>
                                <th>{Lang::T('Status')}</th>
                                <th>{Lang::T('Manage')}</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $d as $fup}
                                <tr>
                                    <td>{$fup.name}</td>
                                    <td>{$fup.data_limit} {$fup.data_limit_unit}</td>
                                    <td>{$fup.service_type}</td>
                                    <td>{RouterName($fup.router_id)}</td>
                                    <td>{$fup.profile_on_limit}</td>
                                    <td>
                                        {if $fup.active == 1}
                                            <span class="label label-success">{Lang::T('Active')}</span>
                                        {else}
                                            <span class="label label-danger">{Lang::T('Inactive')}</span>
                                        {/if}
                                    </td>
                                    <td align="center">
                                        <a href="{$_url}fup/edit/{$fup.id}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                        <a href="{$_url}fup/delete/{$fup.id}" onclick="return confirm('{Lang::T('Are you sure you want to delete this FUP profile?')}');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    <td>{$fup.id}</td>
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

{include file="sections/footer.tpl"}

{* Helper function to get router name *}
{function name=RouterName router_id=0}
    {assign var=router name='Unknown'}
    {foreach $routers as $routerData}
        {if $routerData.id == $router_id}
            {assign var=router value=$routerData.name}
        {/if}
    {/foreach}
    {$router}
{/function}
