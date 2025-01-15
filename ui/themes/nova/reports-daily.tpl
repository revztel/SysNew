{include file="sections/header.tpl"}
<!-- reports-daily -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h3 class="text-uppercase text-bold">
                    <i class="fa fa-calendar-alt"></i> {Lang::T('Daily Reports')}
                </h3>
                <p class="small" style="color: #fff;">
                    {Lang::T('.All Transactions at Date')}: {date($_c['date_format'], strtotime($mdate))} {$mtime}
                </p>
            </div>
            <div class="panel-body">
                <div class="clearfix mb20">
                    <div class="pull-left">
                        <h5 class="text-bold mb5">{Lang::T('.All Transactions at Date')}:</h5>
                        <p>{date($_c['date_format'], strtotime($mdate))} {$mtime}</p>
                    </div>
                    <div class="pull-right">
                        <a href="{$_url}export/print-by-date" class="btn btn-primary" target="_blank">
                            <i class="ion ion-printer"></i> {Lang::T('Export for Print')}
                        </a>
                        <a href="{$_url}export/pdf-by-date" class="btn btn-primary">
                            <i class="fa fa-file-pdf-o"></i> {Lang::T('Export to PDF')}
                        </a>
                    </div>
                </div>

                <!-- Transactions Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead style="background-color: #f8f9fa; color: #000;">
                            <tr>
                                <th>{Lang::T('Username')}</th>
                                <th>{Lang::T('Type')}</th>
                                <th>{Lang::T('Plan Name')}</th>
                                <th class="text-right">{Lang::T('Plan Price')}</th>
                                <th>{Lang::T('Created On')}</th>
                                <th>{Lang::T('Expires On')}</th>
                                <th>{Lang::T('Method')}</th>
                                <th>{Lang::T('Routers')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $d as $ds}
                                <tr>
                                    <td>{$ds['username']}</td>
                                    <td>{$ds['type']}</td>
                                    <td>{$ds['plan_name']}</td>
                                    <td class="text-right">{Lang::moneyFormat($ds['price'])}</td>
                                    <td>{Lang::dateAndTimeFormat($ds['recharged_on'], $ds['recharged_time'])}</td>
                                    <td>{Lang::dateAndTimeFormat($ds['expiration'], $ds['time'])}</td>
                                    <td>{$ds['method']}</td>
                                    <td>{$ds['routers']}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Controls -->
                <div class="text-center">
                    {$paginator['contents']}
                </div>

                <!-- Total Income -->
                <div class="clearfix text-right total-sum mt20">
                    <h4 class="text-uppercase text-bold">{Lang::T('Total Income')}:</h4>
                    <h3 class="text-primary">{Lang::moneyFormat($dr)}</h3>
                </div>

                <!-- Footer Note -->
                <p class="text-center small text-info mt20">
                    {Lang::T('Kindly note when the METHOD is FAILOVER, an alternative was used to update Payment since the main one failed. All Transactions at Date')}: 
                    {date($_c['date_format'], strtotime($mdate))} {$mtime}
                </p>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
