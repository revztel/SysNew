{include file="sections/header.tpl"}

<!-- FUP Profiles List -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <span>Daily FUP Profiles</span>
                <div class="btn-group">
                    <a href="{$_url}fup/add" class="btn btn-primary btn-sm">
                        <i class="ion ion-android-add"></i> Add New FUP Profile
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <!-- Instructions -->
                <div class="mb20">
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#instructions" aria-expanded="false" aria-controls="instructions">
                        View Instructions
                    </button>
                    <div id="instructions" class="collapse" style="margin-top: 15px;">
                        <div class="alert alert-info">
                            <ol>
                                <li>Make sure the FUP plan you have created is of the same type. If it's Hotspot, create a Hotspot FUP plan. If it's PPPoE, create a PPPoE FUP plan.</li>
                                <li>Ensure the FUP plan created under Hotspot or PPPoE has a validity of more than 1 day.</li>
                                <li>How it works:
                                    <ul>
                                        <li>Once the customer exhausts the allocated data usage for the day, they will be switched to a lower Mbps package.</li>
                                        <li>They will be switched back to their original package after midnight, as the settings will reset automatically.</li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Search Form -->
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <form id="site-search" method="post" action="{$_url}fup/list/">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-search"></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Search by Name...">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FUP Profiles Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>FUP Name</th>
                                <th>Plans Under FUP</th>
                                <th>Switch To Plan</th>
                                <th>Data Limit</th>
                                <th>Service Type</th>
                                <th>Router</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $fupProfiles as $fup}
                                <tr>
                                    <td>{$fup.name}</td>
                                    <td>
                                        {foreach from=$fupPlans[$fup.id] item=plan}
                                            <span class="label label-default">{$plan.name_plan}</span>
                                        {/foreach}
                                    </td>
                                    <td>
                                        {$switchPlans[$fup.profile_on_limit]|default:'Unknown'}
                                    </td>
                                    <td>{$fup.data_limit} {$fup.data_limit_unit}</td>
                                    <td>{$fup.service_type}</td>
                                    <td>{$routerNames[$fup.router_id]|default:'Unknown'}</td>
                                    <td>
                                        {if $fup.active == 1}
                                            <span class="label label-success">Active</span>
                                        {else}
                                            <span class="label label-danger">Inactive</span>
                                        {/if}
                                    </td>
                                    <td align="center">
                                        <a href="{$_url}fup/edit/{$fup.id}" class="btn btn-info btn-xs">Edit</a>
                                        <a href="{$_url}fup/delete/{$fup.id}" onclick="return confirm('Are you sure you want to delete this FUP profile?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                {$paginator['contents']}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
