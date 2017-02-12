<?php   
require_once("include/initialize.php");
require("search.php");    
    if(isset($_POST['logout'])){
        $session->logout();
        redirect_with_message("index.php","Have any suggestions ?");
    }
    
    if (!$session->is_logged_in()) 
    { 
        redirect_to("index.php");
    }
    
    


?>   
<style type="text/css">
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
    

    </head>
    
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="userprofile.php" class="navbar-brand">Bits-store.in</a>
                        </div>
                        <div class = "col-sm-12 col-md-offset-1 col-md-2 col-lg-offset-2 search_box">
                                <form role="form" class="form-inline" action="userprofile.php" method="get">
                                        <div class="form-group"><input type="text" class="form-control" placeholder="Search" name="toSearch" id="toSearch"></div>
                                </form>
                        </div>
                        <div class="col-sm-12 col-md-offset-7 col-lg-5 navigation">        
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="userprofile.php">Home</a></li>    
                                <li><a href="myprofile.php">My Profile</a></li>    
                                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle text-capitalize"><?php echo $session->Name; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li style="height:30px; width:1px;"><form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="post"><button type = "submit" class="btn btn-link" name="logout"style="font-size:18px; width:100%; height:100%;">Logout</button></form></li>    
                                </ul>
                                </li>    
                            </ul>    
                        </div>
                </div>
        </nav>
