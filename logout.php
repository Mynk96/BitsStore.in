<?php   
require_once("../../include/initialize.php");
    if(isset($_POST['logout']){
        $session->logout();
        redirect_to("../index.php", "Successfully LoggedOut");
    }
    
    if (!$session->is_logged_in()) 
    { 
        redirect_to("../index.php");
    }
    
       
?> 