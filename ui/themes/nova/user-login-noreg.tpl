<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{Lang::T('Login')} - {$_c['CompanyName']}</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(to right, #ff5f6d, #ffc371);
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .site-logo {
            color: #fff;
            text-shadow: 2px 2px 4px #000;
            font-size: 2.5rem;
        }

        .panel {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        .panel-heading {
            background-color: #ff5f6d !important;
            color: #fff !important;
            font-size: 1.2rem;
        }

        .form-group .input-group-addon {
            background-color: #ff5f6d;
            color: #fff;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff5f6d;
            border-color: #ff5f6d;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #ff4a57;
            border-color: #ff4a57;
        }

        .btn-group .btn-primary {
            width: 100%;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .announcement {
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 10px;
            border-radius: 10px;
        }

        .announcement h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .announcement p {
            font-size: 1rem;
        }

        @media (max-width: 767px) {
            .form-head {
                text-align: center;
            }

            .panel-heading {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-head mb20">
            <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold">
                {$_c['CompanyName']}
            </h1>
            <hr style="border-color: #fff;">
        </div>
        {if isset($notify)}
            <div class="alert alert-{if $notify_t == 's'}success{else}danger{/if}">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                </button>
                <div>{$notify}</div>
            </div>
        {/if}
        <div class="row">
            <div class="col-md-8">
                <div class="panel announcement">
                    <h4>{Lang::T('Announcement')}</h4>
                    <p>{include file="$_path/../pages/Announcement.html"}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">{Lang::T('Activate Voucher')}</div>
                    <div class="panel-body">
                        <form id="activationForm" action="{$_url}login/activation" method="post">
                            <div class="form-group">
                                <label>{Lang::T('Enter your name or number')}</label>
                                <div class="input-group">
                                    {if $_c['country_code_phone']!= ''}
                                        <span class="input-group-addon" id="basic-addon1">+</span>
                                    {else}
                                        <span class="input-group-addon" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                                    {/if}
                                    <input type="text" class="form-control" name="username" required placeholder="07xxxxxxx">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{Lang::T('Enter voucher code here')}</label>
                                <input type="text" class="form-control" name="voucher" required autocomplete="off" placeholder="{Lang::T('Code Voucher')}">
                            </div>
                            <div class="btn-group btn-group-justified mb15">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="activateAndLogin()">{Lang::T('Activate Voucher')}</button>
                                </div>
                            </div>
                            <br>
                            <center class="footer-links">
                                <a href="./pages/Privacy_Policy.html" target="_blank">Privacy</a>
                                &bull;
                                <a href="./pages/Terms_of_Conditions.html" target="_blank">ToC</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Mikrotik login form -->
    <div class="container" style="display:none;">
        <form id="loginForm" class="form" name="login" action="http://192.168.180.1/login" method="post" onSubmit="return doLogin()">
            <input type="hidden" name="dst" value="http://192.168.180.1/status" />
            <input type="hidden" name="popup" value="true" />
            <!-- Username and Password Fields -->
            <input id="usernameInput" name="username" type="text" value="" />
            <input id="passwordInput" name="password" type="password" value="" />
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <script>
    var retryCount = 0;
    var maxRetries = 5;
    var retryInterval = 5000; // 5 seconds between retries
    var totalRetryTime = 120000; // 2 minutes total retry time

    function activateAndLogin() {
        // Get the username and voucher values
        var username = $('input[name="username"]').val();
        var voucher = $('input[name="voucher"]').val();

        // Store the username and voucher in localStorage before submitting the form
        localStorage.setItem('username', username);
        localStorage.setItem('voucher', voucher);

        // Record the time when we start retrying
        localStorage.setItem('retryStartTime', new Date().getTime());

        // Reset retry count
        localStorage.setItem('retryCount', 0);

        // Submit activation form
        $('#activationForm').submit();
    }

    function attemptLogin() {
        // Get the username and voucher from localStorage
        var username = localStorage.getItem('username');
        var voucher = localStorage.getItem('voucher');
        var retryCount = parseInt(localStorage.getItem('retryCount')) || 0;
        var retryStartTime = parseInt(localStorage.getItem('retryStartTime')) || new Date().getTime();

        if (username && voucher) {
            var currentTime = new Date().getTime();
            var elapsedTime = currentTime - retryStartTime;

            // Stop retries after 2 minutes
            if (elapsedTime > totalRetryTime) {
                console.log('Total retry time exceeded (2 minutes). Stopping retries.');
                // Clear stored data
                localStorage.removeItem('username');
                localStorage.removeItem('voucher');
                localStorage.removeItem('retryCount');
                localStorage.removeItem('retryStartTime');
                return;
            }

            // Stop after 5 retries
            if (retryCount >= maxRetries) {
                console.log('Maximum retries reached (5). Stopping retries.');
                // Clear stored data
                localStorage.removeItem('username');
                localStorage.removeItem('voucher');
                localStorage.removeItem('retryCount');
                localStorage.removeItem('retryStartTime');
                return;
            }

            // Set the values to Mikrotik login form
            $('#usernameInput').val(username);
            $('#passwordInput').val(voucher);

            // Submit the Mikrotik login form
            $('#loginForm').submit();

            // Increment retry count and store it
            retryCount++;
            localStorage.setItem('retryCount', retryCount);

            console.log('Login attempt ' + retryCount);

            // Retry the login every 5 seconds
            setTimeout(attemptLogin, retryInterval);
        }
    }

    $(document).ready(function() {
        // Check if username and voucher are stored in localStorage
        var username = localStorage.getItem('username');
        var voucher = localStorage.getItem('voucher');

        if (username && voucher) {
            // Wait for 5 seconds to allow activation to complete
            setTimeout(function() {
                // Start attempting to login
                attemptLogin();
            }, 5000); // Wait 5 seconds after page load
        }
    });

    function doLogin() {
        // Allow form submission
        return true;
    }
</script>

</body>
</html>