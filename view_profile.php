<?php
    require_once("include/initialize.php");
    if (!$session->is_logged_in()){
        require("header.php");
    } else{
        require("admin_header.php");
    }

    if(isset($_GET['email']) && isset($_GET['id'])){
            $photo = Photograph::find_by_id($_GET['id']);
            
    }
?>


<?php if(isset($_GET['email'])){
        $info = User::find_by_email($_GET['email']);
        $photo_info = Photograph::find_by_email($_GET['email']);
        if(empty($info) || empty($photo_info)){
            if (!$session->is_logged_in()){
                redirect_to("index.php");
            } else{
                redirect_to("admin_header.php");
            }
        }
    }
?>

<style type="text/css">
    /* Large Devices, Wide Screens */
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
        height:130px;
        width:130px;
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
    .product_details button{
            margin-top:-3%;
        
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
        margin-bottom:3%;        
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
        }
        .product_details{
            margin-top:-8%;
            text-align:center;
            margin-bottom:5%;
        }
        
        .product_details p:nth-child(2){
            color:EC7063;  
           margin-top: -3%;
        }       
        .product_details button{
            margin-top: -3%;
            margin-left:1%;
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
            height:166px;
            width:219px;
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
        margin-top:23%;
        margin-bottom:-5%;        
        
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
        .product_details button{
            margin-top: -4%;
            margin-left:1%;
        }
        .big-box{
            margin:10px 10px 5px 10px;
        }
        
        .profile-main span{
        display:block;
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
        .product_details button{
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
        .photo_adjust img{
            
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
        .product_details button{
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
        <div class="mydiv"><img src = "profile_pics/<?php echo $info->profile_pic;?>" id="profile_photo" class="img-responsive img-thumbnail">
            <span style="font-size:14px;" class="text-capitalize"><?php echo $info->Name;?></span></div>
        
        
    </div>    
    <div class="col-md-10 col-lg-10 big-box" style="border:solid 1px #B3B6B7; border-radius:1%;">
        <div class="row ">
            <div class="col-md-10 col-lg-10">
                <h3>Contact Information:</h3><hr>
                <span class="details_font"><strong>Name:</strong></span><p class="contact_details text-capitalize"><?php echo $info->Name;?></p><br>
                <span class="details_font"><strong>Email:</strong></span><p class="contact_details"><?php echo $info->Email;?></p><br>
                <span class="details_font"><strong>Hostel:</strong></span><p class="contact_details"><?php echo $info->Hostel;?></p><br>
                <span class="details_font"><strong>Contact:</strong></span><p class="contact_details"><?php echo $info->Contact_no;?></p>
            <!--    <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $info->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Contact:</strong></label><span id="name"><?php echo $info->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $info->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $info->Name;?></span><br>--> 
            </div>   
        </div>
    </div>            
        </div><br>
    <div style="margin-bottom:10%;">
    <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#products" >Products</a></li>
        </ul><br>
        <div class="tab-content">
            <div id="products" class="row tab-pane fade in active" style="border:solid 1px #B3B6B7;">
               
                <?php if(empty($photo_info)):?>
                    <div style="height:30%;display:block;"><h3 style="text-align:center;margin-top:9%;">No products added by you.</h3>
                        <p style="text-align:center;margin-left:7%;">Click Add product to add products.</p>
                    </div>
                <?php else:?>
                <h4 style="text-align:left; margin-left:1%;">Select Product to Edit:</h4>
                <?php foreach($photo_info as $photos_info):?>
                
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 photo-adjust">
                    
                    <a href="product.php?name=<?php echo $photos_info->product_name;?>&amp;&amp;id=<?php echo $photos_info->id;?>"><img src="images/<?php echo $photos_info->filename;?>" class="thumbnail img-responsive product_photo" >
                        <div class="product_details">
                        <p class="text text-capitalize"><?php echo $photos_info->product_name;?></p>
                        <p class="text text-capitalize">Rs.<?php echo $photos_info->product_price;?></p>
                        </a>
                        </div>
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
        </div>    
<?php include_layout("admin_footer.php");?>