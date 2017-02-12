<?php 
    require_once("include/initialize.php");
print_r($session);
  if(isset($_POST['change_pwd'])){
            print_r($_POST);
            echo $_POST['verify_email'];        
            $new_password = $_POST['password'];
            $re_new_password = $_POST['re_password'];
            if(strcmp($new_password,$re_new_password) == 0){
                $found_user = User::update_password($new_password,$verify_email);
                $found_user = User::authenticate($verify_email,$new_password);
                    if($found_user){
                        $session->login($found_user);
                        redirect_to("userprofile.php");
            }
            }else{
                $match = "Passwords do not match";
                $new_password = "";
                $re_new_password = "";
            }
            }   
?>
        