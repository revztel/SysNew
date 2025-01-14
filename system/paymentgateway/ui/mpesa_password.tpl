{include file="sections/header.tpl"}

<form class="form-horizontal" method="post" role="form" action="{U}paymentgateway/MpesatillStk">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">Enter Till Number to Access M-Pesa Configuration</div>
                <div class="panel-body">
                    {if isset($error)}
                        <div class="alert alert-danger">{$error}</div>
                    {/if}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{include file="sections/footer.tpl"}
