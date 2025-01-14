<?php

    define('APP_URL', 'https://billing.ueix.net');
    $_app_stage = 'Live';

    // Database freeispradius
    $db_host	    = 'localhost';
    $db_user        = 'demo';
    $db_password	= 'demo';
    $db_name	    = 'demo';

    if($_app_stage!='Live'){
        error_reporting(E_ERROR);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }else{
        error_reporting(E_ERROR);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
    }
    