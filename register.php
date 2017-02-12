<?php  
    require_once("include/initialize.php");
    
    if ($session->is_logged_in()) {
        redirect_to("userprofile.php");
    }
    $message = "";
    $name = "";
    $email = "";
    $pwd = "";
    $hostel = "";
    $year = "";
    $phone = "";
    global $database;   
    $found_user = false;
    if(isset($_POST['register'])){ 
                
                 $user = new User();
        
                $user->Name         = ($_POST['fullname']);
                $user->Email        = test_input($_POST['email']);
                        
                $user->Password     = $_POST['pwd'];
                $user->Hostel       = test_input($_POST['hostel']);
                $user->Select_year  = test_input($_POST['year']);
                $user->Contact_no   = test_input($_POST['phone']);
                $user->Sec_ques     = test_input($_POST['sec_ques']);
                $user->Sec_ans      = test_input($_POST['sec_ans']);
                    if($user->check_email($user->Email)){
                        
                        $message = "Email already exists";
                        $found_user = false;
                        }
                    elseif(!(bits_verification($user->Email))){
                        $message = "Please Enter your Bits Email";
                        $found_user = false;
                        }
                    
                    else{
                        if(($_FILES['profile_picture']['error'] == 0))
                        {
                        $user->profile_pic = ($_FILES['profile_picture']['name']);
                        if($user->attach_file($_FILES['profile_picture'])){
                            if($user->save()){    
                            $user->create();
                            $found_user = $user->authenticate($user->Email,$user->Password);
                            }else{
                                    $message = join("<br>",$user->errors);        
                                    $found_user = false;
                                }
                        }else {
                            $message = join("<br>",$user->errors);
                            $found_user = false;
                            }
                        
                        }elseif(($_FILES['profile_picture']['error'] == 4)){
                           $image_prop = getimagesize("profile_pics/default.jpeg");
                            $user->profile_pic = "default.jpeg";
                            $user->type = $image_prop['mime'];
                            $user->size = filesize("profile_pics/default.jpeg");
                            $user->create();
                            $found_user = $user->authenticate($user->Email,$user->Password);
                            
                        }
                        else {
                            $message = join("<br>",$user->errors);
                            $found_user = false;
                            }
                        }
        
    }
        if($found_user){
            $session->login($found_user);
            redirect_to_profile("userprofile.php","{$session->Name}");    
            
        }   
        
        unset($_POST['register']);
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
    
    <body>
        
        <h1>Bits-store.in</h1>
        <div class="container form-box">
            <h2>Register</h2><br/>
            
            <form class = "form-inner" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <?php if($message != ""):?>
                    <p class="alert alert-danger"><strong>Failed!</strong><?php echo $message;?> </p>
                <?php endif;?>
                <div class = "form-group">
                    <h5>* means required field</h5>
                </div>
                <div class="form-group">
                    <label class="control-label" for="name">Name*</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your Fullname" required name="fullname">
                    
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Email*</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your BITS Email" required name="email">
                    
                </div>
                <div class="form-group">
                    <label class="control-label" for="pwd">Password*</label>
                    <input type="password" class="form-control" id="pwd" placeholder="at least 6 characters" required name="pwd">
                    
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="hostel">Hostel*</label>
                    <select class="form-control" name="hostel" id="hostel">
                            <option>AH-1</option>  
                            <option>AH-2</option>  
                            <option>AH-3</option>  
                            <option>AH-4</option>  
                            <option>AH-6</option>
                            <option>AH-7</option>
                            <option>AH-8</option>
                            <option>CH-1</option>
                            <option>CH-2</option>
                            <option>CH-3</option>
                            <option>CH-4</option>
                            <option>CH-5</option>
                            <option>CH-6</option>
                            <option>CH-7</option>
                            <option>CH-8</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label class="control-label" for="year">Select Year *:</label>
                    <select class="form-control" name="year" id="year">
                            <option>1st Year</option>  
                            <option>2nd Year</option>  
                            <option>3rd Year</option>  
                            <option>4th Year</option>  
                            <option>Higher Degree</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label class="control-label" for="phone">Contact/Whatsapp No*</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter your contact number" required name = "phone">
                    
                </div>
                <div class = "form-group">
                    <label class="control-label" for="sec_ques">Select a security question:</label>
                    <select class="form-control" name="sec_ques" id="sec_ques">
                        <option>What is the first name of the person you first kissed?</option>
                        <option>What is the name of your favorite childhood friend?</option>
                        <option>Who is your childhood sports hero?</option>
                        <option>What is the name of the teacher who gave you your first 'A'?</option>
                        <option>What is the name of your pet?</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="sec_ans">Answer:</label>
                    <input type="text" class="form-control" id="sec_ans" required name="sec_ans">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="profile_picture">Add Profile Picture:</label>
                    <input type="file" name="profile_picture" value="default.jpeg">   
                </div>
                <div class="form-group">
                    
                    <input type="submit" class="btn btn-success col-md-12 col-lg-12" style="margin-bottom:10px;" name = "register" value ="Register">
                </div>
                
            </form>
            <div style="text-align:center; margin-bottom:2%;">Already registered?<a href="index.php"> Login</a></div>
        </div>
        </div>
        <?php include_layout("admin_footer.php");?>
    </body>
</html>
    
            
