<?php
require("admin_header.php");
?>
<?php 
    if(isset($_GET['status'])){
        $status = htmlspecialchars($_GET['status']);
    }else{
            $status="";
        }
    $alert ="";
    if(isset($_POST['go'])){
        $photo = new Photograph();
        $photo->category = $_POST['category'];
        $photo->product_name = $_POST['product_name'];
        $photo->product_price = $_POST['product_price'];
        $photo->product_details = $_POST['product_details'];
        $photo->Email = $session->Email;
        $img = str_replace( " ","_",$_FILES['file_upload']['name']);
        
        if($photo->attach_file($_FILES['file_upload'])){
            move_uploaded_file( $_FILES['file_upload']['tmp_name'], "images/content/".$img );
        
            $source = "images/content/";
            $dest = "images/thumb/";
            $photo->thumbnail($img,$source,$dest,180,180);
            $status = "Product added successfully";
        } else {
            $alert = join("<br>",$photo->errors);
            }
        }
    
?>
<?php 
    $user_photos = Photograph::find_by_email($session->Email);
    
?>
<style type="text/css">
    
	@media only screen and (min-width : 1200px){   
    .image-sizing {
    width:110px;
    height:110px;
    }
    .profile-main{
        text-align:center;
        margin-top:2%;
    }
    .product_photo{
        height:180px;
        width:180px;
        margin-left:12%;
    }
    .product_details{
        margin-top:-12%; 
        margin-bottom:3%;
        text-align: center;
    }
    
        
    .product_details p:nth-child(2){
        color:EC7063; 
        margin-top:-8%; 
        
    }
    .product_details a{
            margin-top:-5%;
            margin-bottom:3%;
        
        }    
    #profile_photo{
        width:250px;
        height:200px;
        margin-top:-12%;
    }
        .details_font{
        font-size: 18px;
    
        
    }
    .contact_details{
        font-size:16px;
        text-indent: 1%;
        display:inline-block;
    }
    
    
}
    @media only screen and (max-width : 1200px){
        .image-sizing {
    width:110px;
    height:110px;
    }
    .profile-main{
        text-align:center;
        margin-top:2%;
    }
    .product_photo{
        height:130px;
        width:130px;
        margin-left:12%;
    }
    .product_details{
        margin-top:-12%; 
        margin-bottom:3%;
        text-align: center;
        margin-left:20%;
    }
    
        
    .product_details p:nth-child(2){
        color:EC7063; 
        margin-top:-8%; 
        
    }
    .product_details a{
            margin-top:-5%;
            margin-bottom:3%;
        
        }    
    #profile_photo{
        width:250px;
        height:200px;
        margin-top:-12%;
    }
        .details_font{
        font-size: 18px;
    
        
    }
    .contact_details{
        font-size:16px;
        text-indent: 1%;
        display:inline-block;
    }   
    }
    
    /* Medium Devices, Desktops */
	@media only screen and (max-width : 992px){
            .profile-main{
        text-align:center;
        margin-top:25%;
        margin-bottom:-8%;        
    }
        
        
        .mydiv{
        margin-left:auto;
        margin-right:auto;    
        max-width:50%;
        position:relative;
        height:380px;
        display:block;
        overflow:hidden;
        margin-top:-25%;
        margin-bottom:0;    
    }
        #hello{
            margin-bottom:2%;
        }
        .photo-adjust{
            display: inline-table;
            margin:auto;
        }
        .product_details{
            margin-top:-8%;
            text-align: center; 
            margin-left:-15%;
            margin-bottom:5%;
        }
        .product_details p:nth-child(2){
            color:EC7063;  
           margin-top: -3%;
        }       
        .product_details a{
            margin-top: -3%;
            margin-left:0%;
        }
        .big-box{
            margin:10px 10px 5px 10px;
        }
        
        
        .photo-adjust{
            display:inline-table;
            
        }
        .profile-main a{
        display:block;
    }   
        .product_photo{
            height:140px;
            width:184px;
            
        }
        .footer{
            margin-left:auto;
            margin-right:auto;  
            height:2%;
            margin-bottom:-10%;
            clear:both;
        }
	}
    /* Small Devices, Tablets */
	@media only screen and (max-width : 768px){
            .profile-main{
        text-align:center;
        margin-top:25%;
        margin-bottom:-1%;        
    }
        
        
        .mydiv{
        margin-left:auto;
        margin-right:auto;    
        max-width:50%;
        position:relative;
        height:325px;
        display:block;
        overflow:hidden;
        margin-top:-25%;
        margin-bottom:0;    
    }
        #hello{
            margin-bottom:2%;
        }
        .photo-adjust{
            display: inline-table;
            margin:auto;
        }
        .product_details{
            margin-top:-6%;
            text-align:center;
            margin-bottom: 3%;
            
        }
        .product_details p:nth-child(2){
            color:EC7063;  
           margin-top: -3%;
        }       
        .product_details a{
            margin-top: -4%;
            margin-left:1%;
        }
        .big-box{
            margin:10px 10px 5px 10px;
        }
        
        .profile-main a{
        display:block;
    }
        .product_photo{
            height:204px;
            width:269px;
        }
    
        .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:-10%;
            clear:both;
        }
	}
    /* Extra Small Devices, Phones */
	@media only screen and (max-width : 480px){
        .profile-main{
        text-align:center;
        margin-top:6%;
        margin-bottom:-1%;
            
    }    
	   #profile_photo{
        width:200px;
        height:200px;
        margin-top:30%;
    }
        .mydiv{
        margin-left:auto;
        margin-right:auto;    
        max-width:50%;
        position:relative;
        height:250px;
        display:block;
        overflow:visible;
        margin-top:-22%;
        margin-bottom:10%;    
    }
        #hello{
            margin-bottom:2%;
        }    
        .product_details{
            margin-top:-10%;
            text-align:center;
            
        }
        .product_details p:nth-child(2){
            color:EC7063;  
           margin-top: -7%;
        }       
        .product_details a{
            margin-top: -5%;
            margin-left:1%;
            margin-bottom:3%;
        }
        .big-box{
            margin:10px 10px 5px 10px;
        }
        
        
        .photo-adjust{
            display:inline-table;
            
        }
        .profile-main a{
        display:block;
    }   
        .product_photo{
            height:114px;
            width:149px;
        }
        .footer{
            margin-left:auto;
            margin-right:auto;  
            height:60px;
            margin-top:5%;
            clear:both;
        }

}
    /* Custom, iPhone Retina */
    @media only screen and (max-width : 320px){
        .profile-main{
        text-align:center;
        margin-top:8%;
        margin-bottom:-6%;
            
    }
        
        
        .mydiv{
        margin-left:auto;
        margin-right:auto;    
        max-width:50%;
        position:relative;
        height:220px;
        display:block;
        overflow:hidden;
        margin-top:-10%;
        margin-bottom:0;    
    }
        #hello{
            margin-bottom:2%;
        }
        .photo-adjust{
            display: inline-table;
            
        }
        .product_details{
            margin-top:-15%;
            margin-bottom: 10%;
            text-align:center;
            
        }
        .product_details p:nth-child(2){
            color:EC7063;  
           margin-top: -30%;
        }       
        .product_details a{
            margin-top: -5%;
            margin-left:-10%;
            
        }
        .big-box{
            margin:10px 10px 5px 10px;
        }
        
        
        .photo-adjust{
            display:inline-table;
            
        }
        .profile-main a{
        display:block;
    }
    
        .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-top:5%;
            clear:both;
        }
        .product_photo{
            margin-top:-10%;
        }
} 
 
	
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

















<div class = "container" >
    <div class= "row">
    <div class="col-md-2 col-lg-2 profile-main">
        <div class="mydiv"><img src = "profile_pics/<?php echo $session->profile_pic;?>" id="profile_photo" class="img-responsive img-thumbnail">
            <a href="userprofile.php" style="font-size:14px;" class="text-capitalize"><?php echo $session->Name;?></a></div>
        
        
    </div>    
    <div class="col-md-10 col-lg-10 big-box" style="border:solid 1px #B3B6B7; border-radius:1%;">
        <div class="row ">
            <div class="col-md-10 col-lg-10">
                <h3>Contact Information:</h3><hr>
                <span class="details_font"><strong>Name:</strong></span><p class="contact_details text-capitalize"><?php echo $session->Name;?></p><br>
                <span class="details_font"><strong>Email:</strong></span><p class="contact_details"><?php echo $session->Email;?></p><br>
                <span class="details_font"><strong>Hostel:</strong></span><p class="contact_details"><?php echo $session->Hostel;?></p><br>
                <span class="details_font"><strong>Contact:</strong></span><p class="contact_details"><?php echo $session->Contact_no;?></p>
            <!--    <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Contact:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br>--> 
            </div>
            
            <div class="col-md-2 col-lg-2" style="margin-top:2%;">
                <a href="edit.php" class="btn btn-default pull-right" id="hello" name="edit"><span class="glyphicon glyphicon-edit"></span>  Edit</a>
            </div>   
        </div>
    </div>            
        </div><br>
    <div style="margin-bottom:10%;">
    <ul class="nav nav-pills">
            <li><a data-toggle="pill" href="#products" >Products</a></li>
            <li class="active"><a data-toggle="pill" href="#addproduct" >Add Product</a></li>
        </ul><br>
        <div class="tab-content">
            <div id="products" class="row tab-pane fade" style="border:solid 1px #B3B6B7;">
               
                <?php if(empty($user_photos)):?>
                    <div style="height:30%;display:block;"><h3 style="text-align:center;margin-top:9%;">No products added by you.</h3>
                        <p style="text-align:center;">Click Add product to add products.</p>
                    </div>
                <?php else:?>
                <h4 style="text-align:left; margin-left:1%;">Select Product to Edit:</h4>
                <?php foreach($user_photos as $user_photo):?>
                
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 photo-adjust">
                    
                    <a href="product.php?name=<?php echo $user_photo->product_name;?>&amp;&amp;id=<?php echo $user_photo->id;?>"><img src="images/<?php echo $user_photo->filename;?>" class="thumbnail img-responsive product_photo" >
                        <div class="product_details">
                        <p class="text text-capitalize"><?php echo $user_photo->product_name;?></p>
                        <p class="text text-capitalize">Rs.<?php echo $user_photo->product_price;?></p>
                        </a>
                        <a onclick="return confirmfunction()" href="delete_product.php?id=<?php echo $user_photo->id;?>" class="btn btn-danger btn-xs">Remove</a></div>
                        </div>     
                    <?php endforeach;?>
                    <?php endif;?>
                <!--<div class="col-md-2 col-lg-2 border-adjust">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%;text-align:center; margin-bottom:3%;">
                        <p class="text text-capitalize">Product Name:</p>
                        <p style="color:EC7063; margin-top:-5%; text-align:center;">Rs 8,000</p>
                        </div>
                        </div>
                <div class="col-md-2 col-lg-2 border-adjust">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%;text-align:center; margin-bottom:3%;">
                        <p class="text text-capitalize">Product Name:</p>
                        <p style="color:EC7063; margin-top:-5%; text-align:center;">Rs 8,000</p>
                        </div>
                        </div>
                <div class="col-md-2 col-lg-2 border-adjust">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%;text-align:center; margin-bottom:3%;">
                        <p class="text text-capitalize">Product Name:</p>
                        <p style="color:EC7063; margin-top:-5%; text-align:center;">Rs 8,000</p>
                        </div>
                        </div>
                <div class="col-md-2 col-lg-2 border-adjust">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%;text-align:center; margin-bottom:3%;">
                        <p class="text text-capitalize">Product Name:</p>
                        <p style="color:EC7063; margin-top:-5%; text-align:center;">Rs 8,000</p>
                        </div>
                        </div>
                <div class="col-md-2 col-lg-2 border-adjust">
                        <img src="1.jpg" class="thumbnail img-responsive image-sizing">
                        <div style="margin-top:-8%;text-align:center; margin-bottom:3%;">
                        <p class="text text-capitalize">Product Name:</p>
                        <p style="color:EC7063; margin-top:-5%; text-align:center;">Rs 8,000</p>
                        </div>
                        </div>-->
               
        </div>        
                <div id="addproduct" class="tab-pane fade in active" style="border:solid 1px #B3B6B7;margin-bottom:5%;">
                    <h2 style="padding-left:2px;">Product details:</h2>
                    <?php if($status != ""):?>
                    <div class="alert alert-success fade in" style="padding-left:2px;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong><?php {echo $status;};?></div>
                    <?php $status ="";elseif($alert !=""):?>
                    <div class="alert alert-danger fade in" style="padding-left:2px;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Failed! </strong><?php {echo $alert;};?></div>
                    <?php endif;?>
                    
                    
                    
                    <form action = "<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="post" role="form" class="form-horizontal" >
                        <div class="form-group">
                            <input type="hidden" name = "MAX_FILE_SIZE" value="2000000">
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <label for="product_name" class="control-label col-md-2 col-lg-2">Product Name:</label> 
                            <div class="col-md-6 col-lg-6"><input type="text" class="form-control" id="product_name" name ="product_name" required maxlength = "20"></div>
                                
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <label for="product_price" class="control-label col-md-2 col-lg-2">Product Price(in Rs.):</label> 
                            <div class="col-md-3 col-lg-3"><input type="number" name="product_price" class="form-control" id="product_price" required></div>
                                
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <label class="col-md-2 col-lg-2 control-label" for="product_details">Product Details:</label>
                            <div class="col-md-5 col-lg-5"><textarea class="form-control" name ="product_details" rows="4" id="product_details" placeholder="Enter Product details..."></textarea></div>
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <label class="control-label col-md-2 col-lg-2" for="category">Categories:</label>
                            <div class="col-md-3 col-lg-3">
                            <select class="form-control " name="category" required id="catgory">
                                <option>Books</option>    
                                <option>Electronics</option>  
                                <option>Sports</option>  
                                <option>Music</option>  
                                <option>Other</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <label class="control-label col-md-2 col-lg-2" for="product_image">Product Image:</label>
                            <div class="col-md-2 col-lg-2"><input type="file" name = "file_upload" id="product_image" required>
                            <p style="font-size:10px;">(File size less than 2MB)</p></div>
                        </div>
                        <div class="form-group" style="padding:0px 10px 0px 10px;">
                            <div class="col-md-offset-2 col-md-10 col-lg-offset-2 col-lg-10">
                                <input type="submit" name="go" class="btn btn-success" value="Add Product">
                                <input type="reset" name="reset" class="btn btn-danger" value="Reset" style="margin-left:1%;">
                            </div>
                        </div>
                    </form>
                </div>
        
        </div>    

    </div>
</div>

<script type="text/javascript">
    function confirmfunction() {
         var confirm = window.confirm("You really want to remove this product");
        return confirm;
    }

</script>
<?php include_layout("admin_footer.php");?>



















