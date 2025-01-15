<?php
/* Smarty version 4.3.1, created on 2025-01-09 21:08:12
  from 'F:\xampp\htdocs\radius\ui\themes\nova\sections\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6780108c8d8708_20794493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b435d8931c00c791c3ddfd5605771f32c2e024d9' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\sections\\header.tpl',
      1 => 1736446086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6780108c8d8708_20794493 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">

    <link rel="stylesheet" href="ui/ui/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <link rel="stylesheet" href="ui/ui/styles/select2.min.css" />
    <link rel="stylesheet" href="ui/ui/styles/select2-bootstrap.min.css" />
        <link rel="stylesheet" href="ui/ui/styles/sweetalert2.min.css" />
    <link rel="stylesheet" href="ui/ui/styles/plugins/pace.css" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <?php echo '<script'; ?>
 src="ui/ui/scripts/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
    <style>
    .chart-container {
    position: relative;
    height: 400px;
}



    .panel {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .panel:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    .panel-heading {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .panel-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .panel-primary .panel-heading {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .panel-success .panel-heading {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }
    .table {
        margin-bottom: 0;
    }
    .table thead th {
        background-color: #f8f9fa;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
    }
    .table tbody td {
        vertical-align: middle;
    }
    .fa {
        margin-right: 5px;
    }
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1;
}

    .box {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .box:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    .box-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .box-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .box-tools .btn {
        margin-left: 5px;
    }
    .panel {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .panel:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    .panel-heading {
        background-color: #007bff;
        color: #fff;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-size: 18px;
        font-weight: 600;
    }
    .table {
        margin-bottom: 0;
    }
    .table thead th {
        background-color: #f8f9fa;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
    }
    .table tbody td {
        vertical-align: middle;
    }
    .total-row {
        font-weight: bold;
    }

.overlay .fa-refresh {
    font-size: 24px;
}
        ::-moz-selection {
            /* Code for Firefox */
            color: red;
            background: yellow;
        }
        ::selection {
            color: red;
            background: yellow;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            margin-top: 0px !important;
        }
        @media (min-width: 768px) {
            .outer {
                height: 200px
                    /* Or whatever */
            }
        }
        th:first-child,
        td:first-child {
            position: sticky;
            left: 0px;
            background-color: #f9f9f9;
        }
        .text1line {
            display: block;
            /* or inline-block */
            text-overflow: ellipsis;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 1em;
            line-height: 1em;
        }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;
    }

    .chatbot-container {
      position: fixed;
      right: 20px;
      bottom: 20px;
      width: 350px;
      height: 500px;
      border: none;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      display: none;
      transition: height 0.3s ease, width 0.3s ease, bottom 0.3s ease;
      overflow: hidden;
      z-index: 9999; /* Add this line */
    }

     .chatbot-container.expanded {
      width: 100%;
      height: 100%;
      right: 0;
      bottom: 0;
      border-radius: 0;
      z-index: 9999; /* Add this line */
    }
.chatbot-preferences,
.chatbot-feedback {
  padding: 15px;
  background-color: #f2f2f2;
  border-top: 1px solid #ccc;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.chatbot-preferences.hidden,
.chatbot-feedback.hidden {
  transform: translateY(100%);
  opacity: 0;
}
.chatbot-preferences input[type="text"],
.chatbot-feedback input[type="text"] {
  width: 100%;
  padding: 10px;
  border: none;
  border  font-size: 16px;
  background-color: #fff;
  margin-bottom: 10px;
}

.chatbot-preferences button,
.chatbot-feedback button {
  padding: 10px 20px;
  background-color: #fa7070;
  color: #fff;
  border: none;
  border-radius: 20px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.chatbot-preferences button:hover,
.chatbot-feedback button:hover {
  background-color: #e86060;
}

.success-message {
  display: none;
  background-color: #4caf50;
  color: #fff;
  padding: 10px;
  border-radius: 20px;
  font-size: 14px;
  margin-top: 10px;
  text-align: center;
}

    .chatbot-header {
      background-color: #fa7070;
      color: #fff;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .chatbot-header:hover {
      background-color: #e86060;
    }

.chatbot-messages {
  height: calc(100% - 120px);
  overflow-y: auto;
  padding: 20px;
  background-color: #f9f9f9;
  display: flex;
  flex-direction: column-reverse;
  transition: height 0.3s ease;
  margin-bottom: 60px; /* Adjust the margin at the bottom */
}
    .user-message {
      text-align: right;
    }

    .user-message span {
      display: inline-block;
      background-color: #fa7070;
      color: #fff;
      padding: 10px 15px;
      border-radius: 20px;
      max-width: 70%;
      word-wrap: break-word;
    }

    .bot-message {
      text-align: left;
    }

    .bot-message span {
      display: inline-block;
      background-color: #e2f7ff;
      color: #333;
      padding: 10px 15px;
      border-radius: 20px;
      max-width: 70%;
      word-wrap: break-word;
    }

    .chatbot-input {
  position: absolute;
  right: 0;
  bottom: 60px; /* Adjust the bottom position */
  width: 100%;
  display: flex;
  align-items: center;
  padding: 15px;
  background-color: #fff;
  border-top: 1px solid #ccc;
  box-sizing: border-box;
}

    .chatbot-input input[type="text"] {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      background-color: #f2f2f2;
    }

    .chatbot-input button {
      margin-left: 10px;
      padding: 10px 20px;
      background-color: #fa7070;
      color: #fff;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .chatbot-input button:hover {
      background-color: #e86060;
    }

.chatbot-label {
  position: fixed;
  right: 20px;
  bottom: 20px; /* Adjust the bottom position */
  background-color: #fa7070;
  color: #fff;
  padding: 12px 25px;
  border-radius: 20px;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  transition: transform 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  z-index: 9998;
}

    .chatbot-label:hover {
      transform: scale(1.05);
    }

.expand-button {
  
  top: 70px; /* Adjust this value as needed */
  right: 380px; /* Adjust this value as needed */
  background-color: #fa7070;
  color: #fff;
  padding: 8px 12px;
  border: none;
  border-radius: 50%;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  z-index: 10000; /* Add a higher z-index value */
}
.search-form {
    margin-top: 8px;
    margin-right: 10px;
}

.search-form .input-group {
    width: 200px;
}

.expand-button:hover {
  background-color: #e86060;
}

    .typing-indicator {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

.chatbot-messages.expanded {
  height: calc(100% - 180px); /* Adjust the height when expanded */
}

    .typing-indicator span {
      display: inline-block;
      width: 8px;
      height: 8px;
      margin-right: 5px;
      background-color: #fa7070;
      border-radius: 50%;
      animation: typing 1s infinite;
    }

    .typing-indicator span:nth-child(2) {
      animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
      animation-delay: 0.4s;
    }

    @keyframes typing {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.2);
        opacity: 0.6;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

        .loading {
          pointer-events: none;
          opacity: 0.7;
        }
    
        .loading::after {
          content: "";
          display: inline-block;
          width: 16px;
          height: 16px;
          vertical-align: middle;
          margin-left: 10px;
          border: 2px solid #fff;
          border-top-color: transparent;
          border-radius: 50%;
          animation: spin 0.8s infinite linear;
        }
    
        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }
    
          100% {
            transform: rotate(360deg);
          }
        }

    </style>

    <?php if ((isset($_smarty_tpl->tpl_vars['xheader']->value))) {?>
        <?php echo $_smarty_tpl->tpl_vars['xheader']->value;?>

    <?php }?>

</head>

<body class="hold-transition modern-skin-dark sidebar-mini <?php if ($_smarty_tpl->tpl_vars['_kolaps']->value) {?>sidebar-collapse<?php }?>">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="logo">
                <span class="logo-mini"><b>I</b>Sp</span>
               <span class="logo-lg"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" onclick="return setKolaps()">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                    <li class="search-form">
    <form id="navbar-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list/">
        <div class="input-group input-group-sm">
            <input type="text" name="search" class="form-control" placeholder="<?php echo Lang::T('Search users');?>
...">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
</li>

<li class="dropdown" style="padding-top: 10px;">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="SMS Balance" style="color: white; position: relative;">
        <i class="fa fa-envelope" style="color: red; position: relative;">
            <span class="label label-danger" id="sms-balance" style="position: absolute; top: -10px; right: -10px; font-size: 10px;">
                <?php echo $_smarty_tpl->tpl_vars['_c']->value['sms_unit'];?>

            </span>
        </i>
    </a>
    <ul class="dropdown-menu">
        <li class="user-header">
            <i class="fa fa-envelope"></i> SMS Balance
            <p>
                <span id="sms-balance-details"><?php echo $_smarty_tpl->tpl_vars['_c']->value['sms_unit'];?>
 SMS remaining</span> <!-- Dynamic SMS Balance Details -->
            </p>
        </li>
    </ul>
</li>




                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                                    onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/admin.default.png'" class="user-image"
                                    alt="Avatar">
                                <span class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
</span>
                            </a>
                            <ul class="dropdown-menu">
                               <li class="user-header">
    <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
?set=set3&size=100x100&bgset=bg1" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/admin.default.png'" class="img-circle" alt="Avatar">
    <p>
        <?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>

                                        <small><?php echo Lang::T($_smarty_tpl->tpl_vars['_admin']->value['user_type']);?>
</small>
    </p>
</li>
<li class="user-body">
    <div class="row">
                                        <div class="col-xs-7 text-center text-sm">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/change-password"><i class="ion ion-settings"></i>
                                               <?php echo Lang::T('Change Password');?>
</a>
                                        </div>
                                        <div class="col-xs-5 text-center text-sm">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users-view/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
">
                                                <i class="ion ion-person"></i> <?php echo Lang::T('My Account');?>
</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout" class="btn btn-default btn-flat"><i
                                               class="ion ion-power"></i> <?php echo Lang::T('Logout');?>
</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'dashboard') {?>class="active" <?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard">
                    <i class="ion ion-monitor"></i>
                    <span><?php echo Lang::T('Dashboard');?>
</span>
                </a>
            </li>
            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_DASHBOARD']->value;?>

            <?php if (!in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('Report'))) {?>
                <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'customers' || $_smarty_tpl->tpl_vars['_system_menu']->value == 'map') {?>active menu-open<?php }?> treeview">
                    <a href="#">
                        <i class="ion ion-android-contacts"></i>
                        <span><?php echo Lang::T('Customers');?>
</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'add') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/add">
                                <i class="fa fa-user-plus"></i> <?php echo Lang::T('Add New User');?>

                            </a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list">
                                <i class="fa fa-users"></i> <?php echo Lang::T('Users');?>

                            </a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'map') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
map/customer">
                                <i class="ion ion-ios-location"></i> <?php echo Lang::T('User\'s Location');?>

                            </a>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_CUSTOMERS']->value;?>

                    </ul>
                </li>
                <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_CUSTOMERS']->value;?>

                <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'prepaid') {?>active<?php }?> treeview">
                    <a href="#">
                        <i class="fa fa-ticket"></i> <span><?php echo Lang::T('Activation');?>
</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/list">
        <?php echo Lang::T('Prepaid Users');?>

        <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    </a>
</li>


                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/active_packages"><?php echo Lang::T('Active Users');?>
</a>
                        </li>
                                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/expired_packages"><?php echo Lang::T('Expired Users');?>
</a>

                        </li>
                                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/online_users"><?php echo Lang::T('Online Users');?>
</a>
                        </li>

                                                                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/offline_users"><?php echo Lang::T('Offline Users');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'recharge') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/recharge"><?php echo Lang::T('Activate User');?>
</a>
                        </li>

<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'voucher') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/voucher">
        <?php echo Lang::T('Vouchers');?>

    </a>
</li>


                        <?php echo $_smarty_tpl->tpl_vars['_MENU_PREPAID']->value;?>

                    </ul>
                </li>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_PREPAID']->value;?>

            <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'services') {?>active<?php }?> treeview">
<a href="#">
    <i class="ion ion-cube"></i> <span><?php echo Lang::T('Packages/Plans');?>
</span>
    <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                    <ul class="treeview-menu">
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'hotspot') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/hotspot"><?php echo Lang::T('Hotspot Plans');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'pppoe') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/pppoe"><?php echo Lang::T('PPPOE Plans');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'static') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/static"><?php echo Lang::T('Static ip plans');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bandwidth/list"><?php echo Lang::T('Bandwidth Plans');?>
</a>
                        </li>
                                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'trial') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
trial/list"><?php echo Lang::T('Hotspot Trials');?>
</a>
                        </li>
                                                </li>
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'pppoe') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fup/list">
        <?php echo Lang::T('FUP');?>

        <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    </a>
</li>

                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'balance') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/balance"><?php echo Lang::T('Balance Plans');?>
</a>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_SERVICES']->value;?>

                    </ul>
                </li>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_SERVICES']->value;?>

            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'reports') {?>active<?php }?> treeview">
<a href="#">
    <i class="ion ion-clipboard"></i> <span><?php echo Lang::T('Transactions');?>
</span>
    <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                <ul class="treeview-menu">
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'daily-report') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/daily-report"><?php echo Lang::T('Daily Transactions');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'by-period') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/by-period"><?php echo Lang::T('Period Transactions');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'activation') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/activation"><?php echo Lang::T('Activation History');?>
</a>
                    </li>
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'transactions-graph') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/transactions-graph">
        <?php echo Lang::T('Comparisons/Graphs');?>

        <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    </a>
</li>

                    <?php echo $_smarty_tpl->tpl_vars['_MENU_REPORTS']->value;?>

                </ul>
            </li>
            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_REPORTS']->value;?>

            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'message') {?>active<?php }?> treeview">
                <a href="#">
                    <i class="ion ion-android-chat"></i> <span><?php echo Lang::T('Notifications');?>
</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send"><?php echo Lang::T('Single User');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send_bulk') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send_bulk"><?php echo Lang::T('Bulk Send');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'specific') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/specific"><?php echo Lang::T('Router Specific');?>
</a>

<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'schedule') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/schedule">
        <?php echo Lang::T('Schedule SMS');?>

    </a>
</li>
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'sms_groups') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/sms_groups">
        <?php echo Lang::T('Sms Groups');?>

    </a>
</li>

                    <?php echo $_smarty_tpl->tpl_vars['_MENU_MESSAGE']->value;?>

                </ul>
            </li>






















            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_MESSAGE']->value;?>

<?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
    <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'network') {?>active<?php }?> treeview">
        <a href="#">
            <i class="ion ion-network"></i> <span><?php echo Lang::T('Network');?>
</span>

            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    

                    <ul class="treeview-menu">
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'routers' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list"><?php echo Lang::T('Routers');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'pool' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pool/list"><?php echo Lang::T('IP Pool');?>
</a>
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_backups') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_backups/backup">
        <?php echo Lang::T('Router Backups');?>

    </a>
</li>




<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'wireless') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/wireless">
        <?php echo Lang::T('Wireless Settings');?>

    </a>
</li>


                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_bridge') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_bridge/list">
        <?php echo Lang::T('Bridge');?>


    </a>
</li>



                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_addresses') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_addresses/list">
        <?php echo Lang::T('Ip Address');?>


    </a>
</li>


<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_files') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_files/list">
        <?php echo Lang::T('Files');?>


    </a>
</li>



                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_hotspot') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_hotspot/list">
        <?php echo Lang::T('Hotspot');?>


    </a>
</li>



                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_ppp') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_ppp/list">
        <?php echo Lang::T('ppp');?>


    </a>
</li>


                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_queues') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_queues/list">
        <?php echo Lang::T('Queues');?>


    </a>
</li>


                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_terminal') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_terminal/list">
        <?php echo Lang::T('Terminal');?>


    </a>
</li>


                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_users') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_users/list">
        <?php echo Lang::T('Mikrotik users');?>


    </a>
</li>










                        <?php echo $_smarty_tpl->tpl_vars['_MENU_NETWORK']->value;?>

                    </ul>
                </li>
















<li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'bulk_actions') {?>active<?php }?> treeview">
    <a href="#">
        <i class="fa fa-tasks"></i>
        <span><?php echo Lang::T('Bulk Actions');?>
</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'mass_delete') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/mass_delete">
                <?php echo Lang::T('Mass Delete Users');?>

            </a>
        </li>
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'bulk_edit_expiry') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/bulk_edit_expiry">
                <?php echo Lang::T('Bulk Edit Expiry Period');?>

            </a>
        </li>
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'bulk_edit_plan') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/bulk_edit_plan">
                <?php echo Lang::T('Bulk Edit Plans');?>

            </a>
        </li>
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'bulk_edit_router') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bulk_actions/bulk_edit_router">
                <?php echo Lang::T('Bulk Edit Routers');?>

            </a>
        </li>
        <!-- Add more bulk actions here -->
    </ul>
</li>











                <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_NETWORKS']->value;?>

                <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>
                    <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'radius') {?>active<?php }?> treeview">
                        <a href="#">
                            <i class="fa fa-database"></i> <span><?php echo Lang::T('Radius');?>
</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'radius' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'nas-list') {?>class="active" <?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
radius/nas-list"><?php echo Lang::T('Radius NAS');?>
</a>
                            </li>
                            <?php echo $_smarty_tpl->tpl_vars['_MENU_RADIUS']->value;?>

                        </ul>
                    </li>
                <?php }?>

            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'sessions') {?>active<?php }?> treeview">
<a href="#">
    <i class="fa fa-address-card"></i> 
    <span><?php echo Lang::T('Sessions');?>
</span>
   
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                <ul class="treeview-menu">
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
sessions/list">
        <?php echo Lang::T('Logged In Users');?>


    </a>
</li>
                  
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_SESSIONS']->value;?>

                </ul>
            </li>
                <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_RADIUS']->value;?>

                <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'pages') {?>active<?php }?> treeview">
                    <a href="#">
                        <i class="ion ion-document"></i> <span><?php echo Lang::T("Static Pages");?>
</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Order_Voucher') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Order_Voucher"><?php echo Lang::T('Order Voucher');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Voucher') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Voucher"><?php echo Lang::T('Voucher');?>
 Template</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Announcement') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Announcement"><?php echo Lang::T('Announcement');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Registration_Info') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Registration_Info"><?php echo Lang::T('Registration Info');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Privacy_Policy') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Privacy_Policy">Privacy Policy</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Terms_and_Conditions') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Terms_and_Conditions">Terms and Conditions</a>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_PAGES']->value;?>

                    </ul>
                </li>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_PAGES']->value;?>

            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'settings' || $_smarty_tpl->tpl_vars['_system_menu']->value == 'paymentgateway') {?>active<?php }?> treeview">
<a href="#">
    <i class="ion ion-gear-a"></i> <span><?php echo Lang::T('Settings');?>
</span>
    <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                <ul class="treeview-menu">
                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'app') {?>class="active" <?php }?>>
<a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app">
    <?php echo Lang::T('General Settings');?>

    <span class="label label-success" style="margin-left: 5px; background-color: green;">New</span>
</a>

</li>

                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'localisation') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/localisation"><?php echo Lang::T('Localisation');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'notifications') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/notifications"><?php echo Lang::T('Auto Notifications / Reminders');?>
</a>
                        </li>
                    <?php }?>
                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin','Agent'))) {?>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'users') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users"><?php echo Lang::T('Administrator Users');?>
</a>
                        </li>
                    <?php }?>
                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'dbstatus') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/dbstatus"><?php echo Lang::T('Backup/Restore');?>
</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'paymentgateway') {?>class="active" <?php }?>>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway">
                                <span class="text"><?php echo Lang::T('Payment Gateway');?>
</span>
                            </a>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_SETTINGS']->value;?>

                    <?php }?>
                </ul>
            </li>

<?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_SETTINGS']->value;?>


            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'message') {?>active<?php }?> treeview">
<a href="#">
    <i class="fa fa-cogs"></i> 
    <span><?php echo Lang::T('TR069 ACS');?>
</span>
   
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                <ul class="treeview-menu">
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'tutorials') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
tutorials/list">
        <?php echo Lang::T('Sign Up');?>

  
    </a>
</li>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send_bulk') {?>class="active" <?php }?>>
                    
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send_bulk"><?php echo Lang::T('ACS Server');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'specific') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/specific"><?php echo Lang::T('Devices');?>
</a>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_TUTORIALS']->value;?>

                </ul>
            </li>


            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'message') {?>active<?php }?> treeview">
<a href="#">
    <i class="fa fa-cubes"></i> 
    <span><?php echo Lang::T('Extras');?>
</span>

    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>

                <ul class="treeview-menu">
<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'tutorials') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
tutorials/list">
        <?php echo Lang::T('Tutorials');?>

      
    </a>
</li>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send_bulk') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send_bulk"><?php echo Lang::T('Human Resource');?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'specific') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/specific"><?php echo Lang::T('Tax');?>
</a>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_TUTORIALS']->value;?>

                </ul>
            </li>



            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'recycle') {?>active<?php }?> treeview">
    <a href="#">
        <i class="fa fa-bullhorn"></i> <!-- Trash icon -->
        <span><?php echo Lang::T('Uisp');?>
</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'recycle') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
uisp/list">
                <i class="fa fa-"></i> <!-- Trash icon for submenu -->
                <?php echo Lang::T('Uisp Signup');?>

            </a>
        </li>

        <?php echo $_smarty_tpl->tpl_vars['_MENU_RECYCLE']->value;?>

    </ul>
</li>



<li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'logs') {?>active<?php }?> treeview">
    <a href="#">
        <i class="ion ion-clock"></i> <span><?php echo Lang::T('Logs');?>
</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    



    <ul class="treeview-menu">
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'logs') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logs/freeispradius">FreeIspRadius</a>

<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'router_log') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
router_log/list">
        <i class="ion ion-clipboard"></i> <span>Mikrotik Logs</span>
    </a>
</li>


<li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'troubleshoot') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
troubleshoot/view">
        <i class="ion ion-clipboard"></i> <span>Troubleshooting</span>
    </a>
</li>

        <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>
            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'radius') {?>class="active" <?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logs/radius">Radius</a>
            </li>
        <?php }?>
    </ul>

    
    
    <?php echo $_smarty_tpl->tpl_vars['_MENU_LOGS']->value;?>

</li>
<?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_LOGS']->value;?>

<li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'community') {?>class="active" <?php }?>>
    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
community">
        <i class="fa fa-commenting"></i>
        <span class="text"><?php echo Lang::T('Social Spot');?>
</span>
    </a>
</li>
<?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_COMMUNITY']->value;?>


<li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'recycle') {?>active<?php }?> treeview">
    <a href="#">
        <i class="fa fa-trash"></i> <!-- Trash icon -->
        <span><?php echo Lang::T('Recycle Bin');?>
</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'recycle') {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
recycle/list">
                <i class="fa fa-trash"></i> <!-- Trash icon for submenu -->
                <?php echo Lang::T('Deleted Items');?>

            </a>
        </li>

        <?php echo $_smarty_tpl->tpl_vars['_MENU_RECYCLE']->value;?>

    </ul>
</li>








</ul>
</section>
</aside>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $_smarty_tpl->tpl_vars['_title']->value;?>

                </h1>
            </section>

            <section class="content">
<?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                    <?php echo '<script'; ?>
>
                        // Display SweetAlert toast notification
                        Swal.fire({
                            icon: '<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == "s") {?>success<?php } else { ?>error<?php }?>',
                            title: '<?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    <?php echo '</script'; ?>
>
<?php }
}
}
