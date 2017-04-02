<?php 
    require_once("include/initialize.php");
    require("search.php");
    
    if($session->is_logged_in()) {
        redirect_to("userprofile.php");
    }
?>

<?php if (isset($_GET['msg'])):?> 
    <?php if ($_GET['msg'] == "Have any suggestions ?" ):?>
                <script>var r = confirm("<?php echo $_GET['msg'];?>");
                        if(r==true){
                            window.open('http://www.w3schools.com/bootstrap/bootstrap_alerts.asp');
                            }
                </script>
            <?php elseif(($_GET['msg']) == "Incorrect Login Details"):?>
                 <script>window.alert("<?php echo ($_GET['msg']);?>");</script>   
            <?php unset($_GET['msg']);?>
    <?php endif;?>
<?php endif;?>
<?php 
    
    
    
    
    
    /*if(isset($_POST['submit'])) {
        $email = trim($_POST['Email']);
        $password = trim($_POST['Password']);
        
        $found_user = User::authenticate($email,$password);
        
        
        if($found_user){
            $session->login($found_user);
            redirect_to("userprofile.php");
            
        } else {
            $msg="Incorrect";
            redirect_to("{$_SERVER['REQUEST_URI']}");           
        } 
        
    } else {
        $email = "";
        $password = "";
    }*/
     $requests = Request::last_7_days();
?>
<?php require_once("header.php");?>

<style>
    
    .product_data p{
        font-family:"Arial",sans-serif;
        color:#626567;
        font-size:18px;
        text-align:center;
        margin-left:-20%;
    }
    
    .image-sizing {
    width:180px;
    height:180px;
    }
</style>

<?php if(!empty($_POST['category']))
    {
        echo "hello";
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        
    
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-2 col-lg-2">
                    <h3>Categories</h3>
                    <div class="list-group" role="group">
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?category=books" class="list-group-item">Books</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?category=electronics" class="list-group-item">Electronics</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?category=sports" class="list-group-item">Sports</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?category=music" class="list-group-item">Music</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?category=other" class="list-group-item">Other</a>
            
                    </div>
                        <div class="panel panel-primary " style="overflow-y:scroll; max-height:30%;">
                            <div class="panel-heading">Requested Products:</div>
                            <div class="panel-body">
                        <?php foreach($requests as $request):?>        
                                <p><a href="view_profile.php?email=<?php echo $request->email;?>"><?php echo $request->requested_user;?></a> requested <?php echo $request->requested_product;?></p>
                        <?php endforeach;?>    
                            </div>
                        </div>
                        </div>
                
                        
                    
               <div class="col-md-8 col-lg-8">
                    <div class="row">
                    <?php if(empty($photos)):?>
                        <div class="col-md-12 col-lg-12" style="margin-top:12%; text-align:center;">
                        <div>
                            <h2 style="text-align:center;">No products found.</h2>
                            <?php if(!$session->is_logged_in()):?>
                                <span>Want to add one.</span><a href="register.php" style="text-center:center;">Click Here!</a>
                            <?php else: ?>
                                <span>Want to add one.</span><a href="myprofile.php">Click Here!</a>
                            <?php endif;?>
                        </div>
                    <?php else: ?>    
                        
                        
                        
                    <?php foreach($photos as $photo):?>
                    <div class="col-md-3 col-lg-3 hvr-float" style="display:inline-block">        
                        <a href="product.php?name=<?php echo $photo->product_name;?>&amp;&amp;id=<?php echo $photo->id;?>"><img src="images/thumb/<?php echo $photo->filename;?>" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%; margin-bottom:10%;" class="product_data">
                            <p class="text text-capitalize"><?php echo $photo->product_name;?></p>
                            <p style="color:EC7063; margin-top:-5%;">Rs.<?php echo $photo->product_price;?></p>
                            </div></a>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <!--    <div class="col-md-4 col-lg-4">
                        <img src="2.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <img src="3.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    
                </div>
                    <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p class="bg-info">Product Name</p>
                        <p class="bg-danger">Price</p>
                    </div>-->
                    
                </div>
                
                </div>
            
        </div>        
    </div>    
        
        <nav class="col-md-offset-2 col-lg-offset-2">        
        <ul class="pagination pagination-lg " style="margin-left:30%; margin-bottom:3%;">    
        <?php if($pagination->total_pages() > 1){
                if($pagination->has_previous_page())
                    {
                        echo "<li><a href=\"index.php?".$_SERVER['QUERY_STRING']."&page={$pagination->previous_page()}\"><span>&laquo;</span></a></li>";
                    }   
                for($i = 1; $i <= $pagination->total_pages(); $i++){    
                    echo "<li><a href=\"index.php?".$_SERVER['QUERY_STRING']."&page={$i}\"><span>{$i}</span></a></li>";
                }
    
    
                if($pagination->has_next_page())
                    {
                        echo "<li><a href=\"index.php?".$_SERVER['QUERY_STRING']."&page={$pagination->next_page()}\"><span>&raquo;</span></a></li>";
                    }
                
                    
}?>
                
            </ul>
        </nav>
    <?php include_layout("admin_footer.php");?>        