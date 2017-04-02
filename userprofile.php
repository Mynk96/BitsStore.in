<?php     
    
    require("admin_header.php");
    
    if(isset($_POST['request'])){
        $requested_user = $session->Name;
        $requested_product = $_POST['requested_product'];
        $new_request = Request::build($requested_user,$session->Email,$requested_product);
        if($new_request && $new_request->save()){
            redirect_to($_SERVER['HTTP_REFERER']);
        }else{
            $message = "Request couldn't be made";
			echo($message);
        }
    }else{
        $requested_user = "";
        $requested_product = "";
    }
    
    $requests = Request::last_7_days();
?>
<style>
    .text{
        font-family:"Arial",sans-serif;
        color:#626567;
        font-size:18px;
        align-items: center;
        
    }.image-sizing{
    width:180px;
    height:180px;
	}
	.product_data p{
        font-family:"Arial",sans-serif;
        color:#626567;
        font-size:18px;
        text-align:center;
        margin-left:-20%;
    }




</style>
        
    
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
                        
                        <form role="form" method="post">
                        <div class="form-group">    
                            <label for = "requested_product" class="control-label">Request Product:</label>
                            <input type="text" class="form-control" id="requested_product" maxlength="255" name="requested_product"></div>
                            <div class="form-group"><input type="submit" value="Request" name="request" class="btn btn-default">
                            </div>
                        </form>
                    </div>
                
                
                    
               <div class="col-md-8 col-lg-8">
                    <div class="row">
                    <?php if(empty($photos)):?>
                        <div class="col-md-12 col-lg-12" style="margin-top:12%;text-align:center;">
                        <div>
                            <h2 style="text-align:center;">No products Added.</h2>
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
            <!--    <div class="col-md-8 col-lg-8">
                    <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <p>Product Name</p>
                        <p>Price</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
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
                    </div>
                    
                </div>
                
                </div> -->
            
        </div>        
    </div>    
</div>
    </div>
<nav class="col-md-offset-2 col-lg-offset-2">        
        <ul class="pagination pagination-lg " style="margin-left:30%; margin-bottom:3%;">    
    
        <?php if($pagination->total_pages() > 1){
                if($pagination->has_previous_page())
                    {
                        echo "<li><a href=\"userprofile.php?".$_SERVER['QUERY_STRING']."&page={$pagination->previous_page()}\"><span>&laquo;</span></a></li>";
                    }   
                for($i = 1; $i <= $pagination->total_pages(); $i++){    
                    echo "<li><a href=\"userprofile.php?".$_SERVER['QUERY_STRING']."&page={$i}\"><span>{$i}</span></a></li>";
                }
    
    
                if($pagination->has_next_page())
                    {
                        echo "<li><a href=\"userprofile.php?".$_SERVER['QUERY_STRING']."&page={$pagination->next_page()}\"><span>&raquo;</span></a></li>";
                    }
                
                    
}?>
                
            </ul>
        </nav>
     <?php include_layout("admin_footer.php");?>