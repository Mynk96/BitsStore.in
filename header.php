<?php  
    require_once("include/initialize.php");
    require("search.php");
    $msg = "";
    
    
    
    
    if(isset($_POST['submit'])) {
        $email = test_input($_POST['Email']);
        $password = test_input($_POST['Password']);
        
        $found_user = User::authenticate($email,$password);
        
        
        if($found_user){
            $session->login($found_user);
            redirect_to("{$_SERVER['HTTP_REFERER']}");
            
            
        } else {
            $msg="Incorrect Login Details";
            redirect_to("index.php?msg={$msg}");           
        } 
        
    } else {
        $email = "";
        $password = "";
    }
     
?>












<style>
    html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}


</style>
        


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
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
        <link href="hover.css" rel="stylesheet" media="all">
        <link href="css/lightbox.css"rel="stylesheet">
        <script src="js/lightbox-plus-jquery.js"></script>
    </head>
    
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                        <div class="navbar-header">
                            
                            <a href="userprofile.php" class="navbar-brand">Bits-store.in</a>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> 
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span> 
                            </button>
                        </div>
                        
                        <div class="collapse navbar-collapse" id="myNavbar">
                        <div class="col-sm-12 col-md-offset-2 col-lg-offset-2 search_box">
                                <form role="form" class="form-inline" action="index.php" method="get">
                                        <div class="form-group"><input type="text" class="form-control" placeholder="Search" name="toSearch" id="toSearch"></div>
                                </form>
                        </div>
                        
                        
                        <div class=" col-sm-12 col-md-offset-7 col-md-5 col-lg-5 navigation">       
                            <form class="form-inline" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" role="form">
                            <div class="form-group">
                                <input type="text" placeholder="Email" class="form-control" name="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" name="Password">
                            </div>        
                            <div class="form-group">
                                <button type="Submit" class="btn btn-success mobile" name="submit">Login</buton>    
                                
                            </div>
                            <div class="form-group"><a href="register.php" class="btn btn-info">Add Product(s)</a></div>

                            </form>
                            <div class="col-md-offset-5 col-lg-offset-5" id="forgot">
                                    
                            <a href="forgot.php" class="">Forgot Your Password</a>    
                            </div>
                            </div>
                    </div>
                
                </div>
        </nav>