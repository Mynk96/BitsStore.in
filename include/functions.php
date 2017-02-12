<?php

function redirect_to($location = NULL) {
    if($location != NULL){
        header("Location: {$location}");
        exit;
    }
}

function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = "../include/{$class_name}.php";
    if(file_exists($path)) {
        require_once($path);
        }
    else {
        die("the file {$class_name}.php could not be found");
    }
    
}

function include_layout($file_name="") {
    include(SITE_ROOT.DS.$file_name);

}

function test_input($data="") {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect_with_message($location = NULL,$message = "") {
    if($location != NULL){
        header("Location: {$location}"."?msg={$message}");
        exit;
    }
}
function redirect_to_profile($location = NULL,$message = "") {
    if($location != NULL){
        header("Location: {$location}"."?id={$message}");
        exit;
    }
}


function bits_verification($email){
    $m = strpos($email,"goa.bits-pilani.ac.in");
    if($m != false){
        return true;
    }else{
        return false;
    }
}

   


?>