<?php
require_once('include/initialize2.php');
session_start();
print_r($_SESSION);
if(isset($_POST['change_pwd'])){
            
            
            $new_password = $_POST['password'];
            $re_new_password = $_POST['re_password'];
            if(strcmp($new_password,$re_new_password) == 0){
                $user = new User();
                $user = $user->find_by_email($_SESSION['temp_email']); 
                $user->update_password($new_password,$user->Email);
                print_r($user);
                session_destroy();
                
                require("include/session.php");
                print_r($session);    
                    if($user){
                        $session->login($user);
                        redirect_to("userprofile.php");
            }
            }else{
                $match = "Passwords do not match";
                $new_password = "";
                $re_new_password = "";
                $GLOBALSstatus = true;
                redirect_to("change_password.php");
            }
            }
    
            
?>    
