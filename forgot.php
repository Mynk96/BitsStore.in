<?php
require("include/initialize.php");    
$status="";
$error="";
session_destroy();
session_start();
$match = "";
if(isset($_POST['check'])){
            $check = new User();
            $check->Email = test_input($_POST['check_email']);
            $check->Sec_ques = test_input($_POST['check_sec_ques']);
            $check->Sec_ans = test_input($_POST['check_sec_ans']);
            if($check->check_validation($check->Email,$check->Sec_ques,$check->Sec_ans)){
                
                $_SESSION['temp_email'] = $check->Email;
                print_r($_SESSION);
                $status = true;
            }else{
                $status = false;
                $error = "Details not Matched";    
            }
        }
  /*  if(isset($_POST['change_pwd'])){
            
            print_r($session); 
            
            $new_password = $_POST['password'];
            $re_new_password = $_POST['re_password'];
            if(strcmp($new_password,$re_new_password) == 0){
                $user = new User();
                $found_user = $user->find_by_email($email);
                $status = true;
                print_r($found_user);
                print_r($user);
                
                //$found_user = User::update_password($new_password,$email);
            
                    if($found_user){
                        session_unset();
                        session_destroy();
                        print_r($found_user);
                        require("include/session.php");
                        $session->login($found_user);
                        redirect_to("userprofile.php");
            }
            }else{
                $match = "Passwords do not match";
                $new_password = "";
                $re_new_password = "";
            }
            }*/
    
?>










<html lang="en">

    <head>
        
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width,initial scale=1">
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="custom.css" type="text/css">
        <link rel="stylesheet" href="register.css" type="text/css">
        
    </head>
    <?php if($status):?>
    
    <body>
        
        <h1><a href="index.php">Bits-store.in</a></h1>
        <div class="container form-box">
            <h2>Change Password:</h2><br/>
            
            <form class = "form-inner" action = "change_password.php" method="post">
                <?php if($match != ""):?>
                    <p class="alert alert-danger"><strong>Failed!</strong><?php echo $match;?> </p>
                <?php endif;?>
                <div class="form-group">
                    <label class="control-label" for="password">Enter new Password:</label>
                    <input type="password" class="form-control" id="password"  required name="password">
                    
                </div>
                <div class="form-group">
                    <label class="control-label" for="re_password">Re-Enter your Password:</label>
                    <input type="password" class="form-control" id="re_password" required name="re_password">
                </div>
                <div class="form-group">
                    
                    <input type="submit" class="btn btn-info col-md-12 col-lg-12" style="margin-bottom:10px;" name = "change_pwd" value ="Change Password">
                </div>
            </form>
<?php else:?>
    
    
    
    
    
    <body>
        
        <h2 class="col-sm-offset-2 col-xs-offset-2 col-md-offset-5 col-lg-offset-5">Forgot Password:</h2>
        <div class="container form-box">
            <form class="form-inner" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                 <?php if($error != ""):?>
                    <p class="alert alert-danger"><strong>Failed!</strong><?php echo $error;?> </p>
                <?php endif;?>
                <div class="form-group">
                    <label class="control-label" for="check_email">Email*</label>
                    <input type="email" class="form-control" id="check_email" placeholder="Enter your BITS Email" required name="check_email">
                    
                </div>
                <div class = "form-group">
                    <label class="control-label" for="check_sec_ques">Select a security question:</label>
                    <select class="form-control" name="check_sec_ques" id="check_sec_ques">
                        <option>What is the first name of the person you first kissed?</option>
                        <option>What is the name of your favorite childhood friend?</option>
                        <option>Who is your childhood sports hero?</option>
                        <option>What is the name of the teacher who gave you your first 'A'?</option>
                        <option>What is the name of your pet?</option>
                    </select>
                </div>
            
            <div class="form-group">
                    <label class="control-label" for="check_sec_ans">Answer:</label>
                    <input type="text" class="form-control" id="check_sec_ans" required name="check_sec_ans">
                </div>    
            <div class="form-group">
                    
                    <input type="submit" class="btn btn-INFO col-md-12 col-lg-12" style="margin-bottom:10px;" name = "check" value ="Go">
                </div>
            
            </form>
        </div>
    <?php endif;?>
                
        <script src = "configure.js" type="text/javascript"></script>        
    </body>
</html>
