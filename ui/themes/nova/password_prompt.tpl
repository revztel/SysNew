{include file="sections/header.tpl"}

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading d-flex justify-content-between align-items-center">
                <span>{Lang::T('Enter  Your Till Number or Bank Account to Access')}</span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                    {Lang::T('Need Help?')}
                </button>
            </div>
            <div class="panel-body">
                {if isset($_error)}
                    <div class="alert alert-danger text-center">
                        <strong>Error!</strong> {$_error}
                    </div>
                {/if}
                <form method="post" action="{$_url}paymentgateway">
                    <div class="form-group">
                        <label for="pg_password" class="font-weight-bold">{Lang::T('Password')}</label>
                        <input type="password" name="pg_password" id="pg_password" class="form-control form-control-lg" required placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">{Lang::T('Submit')}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tutorial Modal -->
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/S2SZtktBQSI?si=gcGk8YYVfOXqCru9" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .panel {
        border-radius: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .panel-heading {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .form-control-lg {
        font-size: 1.25rem;
    }
    .alert {
        margin-top: 20px;
    }
</style>

{include file="sections/footer.tpl"}
