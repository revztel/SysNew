{include file="sections/header.tpl"}

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading d-flex justify-content-between align-items-center">
                <span>{Lang::T('Forgot Password')}</span>
            </div>
            <div class="panel-body">
                {if isset($_error)}
                    <div class="alert alert-danger text-center">
                        <strong>Error!</strong> {$_error}
                    </div>
                {/if}
                <form method="post" action="">
                    <div class="form-group">
                        <label for="reset_token" class="font-weight-bold">{Lang::T('Enter Reset Token')}</label>
                        <input type="password" class="form-control form-control-lg" id="reset_token" name="reset_token" required placeholder="Enter reset token">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">{Lang::T('Reset Password')}</button>
                </form>
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
