<?php
//Define the core paths 
//Define them as asbsolute paths to make sure that reqire_once works as expected

//DIRECTORY_SEPARATOR is a PHP pre defined constant 
//(\ for windows , / for linux)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
    define('SITE_ROOT',DS.'wamp'.DS.'www'.DS.'final project');
    
defined('LIB_PATH') ? null : define('LIB_PATH',SITE_ROOT.DS.'include');
    
    //Load configuration file
    require_once(LIB_PATH.DS."config.php");
    
    //load basic functions so that everyone after that can use them
    require_once(LIB_PATH.DS."functions.php");
    
    
    //load core objects

    require_once(LIB_PATH.DS."database.php");
    require_once(LIB_PATH.DS."pagination.php");
    

    //load database class
    require_once(LIB_PATH.DS."user.php");
    require_once(LIB_PATH.DS."photograph.php");

    //Order important.
?>