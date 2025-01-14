{include file="sections/header.tpl"}

<form class="form-horizontal" method="post" role="form" action="{$_url}paymentgateway/iotec">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Iotec Uganda Payment Gateway</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_client_id" name="iotec_client_id"
                                value="{$iotec_client_id}">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Client ID.</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Secret</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_client_secret" name="iotec_client_secret"
                                value="{$iotec_client_secret}">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Client Secret.</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Wallet ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iotec_wallet_id" name="iotec_wallet_id"
                                value="{$iotec_wallet_id}">
                            <a href="#" target="_blank" class="help-block">Provide your Iotec Wallet ID.</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit">{Lang::T('Save Changes')}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{include file="sections/footer.tpl"}
