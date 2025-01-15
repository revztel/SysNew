<?php

    define('APP_URL', 'http://localhost/radius');
    $_app_stage = 'Live';

    // Database freeispradius
    $db_host	    = 'localhost';
    $db_user        = 'root';
    $db_password	= '';
    $db_name	    = 'radius';

    if($_app_stage!='Live'){
        error_reporting(E_ERROR);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }else{
        error_reporting(E_ERROR);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
    }
    