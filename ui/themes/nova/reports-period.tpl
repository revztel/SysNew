{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
            <div class="panel-heading">{Lang::T('Period Reports')}</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" action="{$_url}reports/period-view">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{Lang::T('From Date')}</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" value="{$tdate}" name="fdate" id="fdate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{Lang::T('To Date')}</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" value="{$mdate}" name="tdate" id="tdate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{Lang::T('Type')}</label>
                        <div class="col-md-9">
                            <select class="form-control" id="stype" name="stype">
                                <option value="" selected="">{Lang::T('All Transactions')}</option>
                                <option value="Hotspot">Hotspot</option>
                                <option value="PPPOE">PPPOE</option>
                                <option value="Static">Static</option>
                                <option value="Balance">Balance</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{Lang::T('Router')}</label>
                        <div class="col-md-9">
                            <select class="form-control" id="router" name="router">
                                <option value="" selected="">{Lang::T('All Routers')}</option>
                                {foreach from=$routers item=router}
                                    <option value="{$router.name|escape}">{$router.name|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" id="submit" class="btn btn-primary">{Lang::T('Generate Reports')}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
