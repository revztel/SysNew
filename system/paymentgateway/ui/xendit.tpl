{include file="sections/header.tpl"}

<form class="form-horizontal" method="post" role="form" action="{$_url}paymentgateway/xendit">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">XENDIT</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Secret Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="xendit_secret_key" name="xendit_secret_key" placeholder="xnd_" value="{$_c['xendit_secret_key']}">
                            <a href="https://dashboard.xendit.co/settings/developers#api-keys" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#api-keys</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Verification Token</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="xendit_verification_token" name="xendit_verification_token" placeholder="Your Verification Token" value="{$_c['xendit_verification_token']}">
                            <a href="https://dashboard.xendit.co/settings/developers#callbacks" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#callbacks</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Callback URL</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control" onclick="this.select()" value="{$_url}callback/xendit">
                            <a href="https://dashboard.xendit.co/settings/developers#callbacks" target="_blank" class="help-block">https://dashboard.xendit.co/settings/developers#callbacks</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Channels</label>
                        <div class="col-md-6">
                            <!-- Display available payment channels -->
                            <!-- Remove the hidden input causing issues -->
                            <!-- <input type="hidden" name="xendit_channel[]" value=""> -->

                            <!-- Checkbox for each payment channel -->
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CREDIT_CARD" {if strpos($_c['xendit_channel'], 'CREDIT_CARD') !== false}checked="true"{/if}> CREDIT CARD
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_BPI" {if strpos($_c['xendit_channel'], 'DD_BPI') !== false}checked="true"{/if}> BPI
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_CHINABANK" {if strpos($_c['xendit_channel'], 'DD_CHINABANK') !== false}checked="true"{/if}> Chinabank
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_RCBC" {if strpos($_c['xendit_channel'], 'DD_RCBC') !== false}checked="true"{/if}> RCBC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DD_UBP" {if strpos($_c['xendit_channel'], 'DD_UBP') !== false}checked="true"{/if}> UBP
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="GCASH" {if strpos($_c['xendit_channel'], 'GCASH') !== false}checked="true"{/if}> GCash
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="GRABPAY" {if strpos($_c['xendit_channel'], 'GRABPAY') !== false}checked="true"{/if}> GrabPay
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="PAYMAYA" {if strpos($_c['xendit_channel'], 'PAYMAYA') !== false}checked="true"{/if}> Maya
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="SHOPEEPAY" {if strpos($_c['xendit_channel'], 'SHOPEEPAY') !== false}checked="true"{/if}> ShopeePay
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="7ELEVEN" {if strpos($_c['xendit_channel'], '7ELEVEN') !== false}checked="true"{/if}> 7-Eleven
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CEBUANA" {if strpos($_c['xendit_channel'], 'CEBUANA') !== false}checked="true"{/if}> Cebuana
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="LBC" {if strpos($_c['xendit_channel'], 'LBC') !== false}checked="true"{/if}> LBC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="BILLEASE" {if strpos($_c['xendit_channel'], 'BILLEASE') !== false}checked="true"{/if}> BillEase
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="QRPH" {if strpos($_c['xendit_channel'], 'QRPH') !== false}checked="true"{/if}> QRPH
                            </label>
                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_MLHUILLIER" {if strpos($_c['xendit_channel'], 'DP_MLHUILLIER') !== false}checked="true"{/if}> DP_MLHUILLIER
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_PALAWAN" {if strpos($_c['xendit_channel'], 'DP_PALAWAN') !== false}checked="true"{/if}> PALAWAN
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="EPAY" {if strpos($_c['xendit_channel'], 'EPAY') !== false}checked="true"{/if}> EPAY
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="CASHALO" {if strpos($_c['xendit_channel'], 'CASHALO') !== false}checked="true"{/if}> CASHALO
                            </label>

                               <label class="checkbox-inline">
                                <input type="checkbox" id="xendit_channel" name="xendit_channel[]" value="DP_ECPAY_SCHOOL" {if strpos($_c['xendit_channel'], 'DP_ECPAY_SCHOOL') !== false}checked="true"{/if}> ECPAY_School
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">{Lang::T('Save')}</button>
                        </div>
                    </div>
                    <pre>/ip hotspot walled-garden
add dst-host=xendit.co
add dst-host=*.xendit.co</pre>
                    <small id="emailHelp" class="form-text text-muted">Set Telegram Bot to get any error and notification</small>
                </div>
            </div>
        </div>
    </div>
</form>

{include file="sections/footer.tpl"}
