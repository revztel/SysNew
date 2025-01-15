<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{Lang::T('Forgot Password')} - {$_c['CompanyName']}</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #4b6cb7, #182848, #ff416c, #4b6cb7);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .forgot-password {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .forgot-password__title {
            color: #182848;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .forgot-password__content {
            margin-bottom: 20px;
        }
        .forgot-password__input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #182848;
            background: transparent;
            color: #182848;
        }
        .forgot-password__button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #4b6cb7;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: background .3s;
        }
        .forgot-password__button:hover {
            background: #3e5a8e;
        }
    </style>
</head>
<body>
    <div class="forgot-password text-center">
        <h1 class="forgot-password__title">{Lang::T('Forgot Password')}</h1>
        {if isset($notify)}
            {$notify}
        {/if}
        <form action="{$_url}admin/forgot-password" method="post" class="forgot-password__form">
            <div class="forgot-password__content">
                <label for="forgot-email" class="forgot-password__label">{Lang::T('Enter your email')}</label>
                <input type="email" required class="forgot-password__input" id="forgot-email" name="email" placeholder="{Lang::T('Email')}">
            </div>
            <button type="submit" class="forgot-password__button">{Lang::T('Reset Password')}</button>
        </form>
    </div>
</body>
</html>
