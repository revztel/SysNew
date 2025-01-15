<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{Lang::T('Change Password')} - {$_c['CompanyName']}</title>
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
        .change-password {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .change-password__title {
            color: #182848;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .change-password__content {
            margin-bottom: 20px;
        }
        .change-password__input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #182848;
            background: transparent;
            color: #182848;
            margin-bottom: 20px;
        }
        .change-password__button {
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
        .change-password__button:hover {
            background: #3e5a8e;
        }
    </style>
</head>
<body>
    <div class="change-password text-center">
        <h1 class="change-password__title">{Lang::T('Change Password')}</h1>
        {if isset($notify)}
            {$notify}
        {/if}
 <form action="{$_url}change-password/change-password" method="post" class="change-password__form">
    <div class="change-password__content">
        <label for="new-password" class="change-password__label">{Lang::T('New Password')}</label>
        <input type="password" required class="change-password__input" id="new-password" name="new_password" placeholder="{Lang::T('New Password')}">
    </div>
    <div class="change-password__content">
        <label for="confirm-password" class="change-password__label">{Lang::T('Confirm New Password')}</label>
        <input type="password" required class="change-password__input" id="confirm-password" name="confirm_password" placeholder="{Lang::T('Confirm New Password')}">
    </div>
    <button type="submit" class="change-password__button">{Lang::T('Change Password')}</button>
</form>

    </div>
</body>
</html>
