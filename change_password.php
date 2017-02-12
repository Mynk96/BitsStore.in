<?php
require_once('include/initialize2.php');
session_start();
$match = "";
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
                $status = true;
                $match = "Passwords do not match";
                $new_password = "";
                $re_new_password = "";
                
            }
            }
    
            
?>

<?php if($status): ?>

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
    
    
    <body>
        
        <h1><a href="index.php">Bits-store.in</a></h1>
        <div class="container form-box">
            <h2>Change Password:</h2><br/>
            
            <form class = "form-inner" action = "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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
        </div>
    </body>
</html>

<?php else:{
    redirect_to("forgot.php");
}?>
<?php endif;?>