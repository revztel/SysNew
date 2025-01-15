<?php
/* Smarty version 4.3.1, created on 2024-10-01 00:21:58
  from 'F:\xampp\htdocs\radius\ui\themes\nova\user-login-noreg.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66fb1676c6aba5_01074508',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '705201c1595d02299b90ce25310ff41c5a63aa15' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\user-login-noreg.tpl',
      1 => 1727105251,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66fb1676c6aba5_01074508 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Lang::T('Login');?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
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
                <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>

            </h1>
            <hr style="border-color: #fff;">
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
            <div class="alert alert-<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == 's') {?>success<?php } else { ?>danger<?php }?>">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                </button>
                <div><?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
</div>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-md-8">
                <div class="panel announcement">
                    <h4><?php echo Lang::T('Announcement');?>
</h4>
                    <p><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['_path']->value)."/../pages/Announcement.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?php echo Lang::T('Activate Voucher');?>
</div>
                    <div class="panel-body">
                        <form id="activationForm" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login/activation" method="post">
                            <div class="form-group">
                                <label><?php echo Lang::T('Enter your name or number');?>
</label>
                                <div class="input-group">
                                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {?>
                                        <span class="input-group-addon" id="basic-addon1">+</span>
                                    <?php } else { ?>
                                        <span class="input-group-addon" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                                    <?php }?>
                                    <input type="text" class="form-control" name="username" required placeholder="07xxxxxxx">
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo Lang::T('Enter voucher code here');?>
</label>
                                <input type="text" class="form-control" name="voucher" required autocomplete="off" placeholder="<?php echo Lang::T('Code Voucher');?>
">
                            </div>
                            <div class="btn-group btn-group-justified mb15">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="activateAndLogin()"><?php echo Lang::T('Activate Voucher');?>
</button>
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
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <!-- Include Bootstrap JS (if needed) -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>

</body>
</html><?php }
}
