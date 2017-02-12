<?php 
    require_once("include/initialize.php");
    if (!$session->is_logged_in()){
        require("header.php");
    } else{
        require("admin_header.php");
    }

    if(isset($_GET['name']) && isset($_GET['id'])){
            $photo = Photograph::find_by_id($_GET['id']);
            $seller = User::find_by_email($photo->Email);
            if(empty($photo) || empty($seller)){
            if (!$session->is_logged_in()){
                redirect_to("index.php");
            } else{
                redirect_to("admin_header.php");
            }
        
         }
    }

    if(isset($_POST['post_comment'])){
        $author = $session->Name;
        $body = trim($_POST['body']);
        $profile_pic = $session->profile_pic;
        $new_comment = Comment::make($photo->id,$author,$profile_pic,$body);
        if($new_comment && $new_comment->save()){
            
            $new_comment->try_to_send_notification($_POST['body']);
            redirect_to($_SERVER['HTTP_REFERER']);
        }else{
            $message="The Comment couldn't be posted";
        }
    }else{
        $author = "";
        $body = "";
        $profile_pic = "";
        
    }

    $comments = Comment::find_comments_on($photo->id);

?>

<style>
    .text{
        font-family:"Arial",sans-serif;
        color:#626567;
        font-size:22px;
        align-items: center;
        
    }
    .list-items{
        margin:10px 0px;
    }
    
	@media only screen and (min-width : 1200px){
        .main_product{
            max-width:20%;
            height:40%;
            margin:3% auto 2%;
            overflow:hidden;
            display:block;
      	    	      
            
        }
        .main_product img{
            height:100%;
            width:100%;
        }
        .seller_photo{
            display: block;
            height:19%;
            width:100%;
            margin-top:3%;
            margin-left:5%;
            
        }
        .seller_photo img{
            height: 100%;
            width:100%;
        }
	   .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:0%;
            clear:both;
            
        }
        .comment-box{
            border:0.1px solid #F9F4F4;
            margin-top:3%;
            padding:2%;
        }
 
	}
 
	
 
	
 
	
 
	/* Large Devices, Wide Screens */
	@media only screen and (max-width : 1200px){
 
	}
    
    /* Medium Devices, Desktops */
	@media only screen and (max-width : 992px){
 		.main_product{
            width:50%;
            height:25%;
            display:block;
       		
        }
        .main_product img{
        	width:100%;
        	height:100%;
        	}
        .seller_photo{
            display: block;
            height:10%;
            width:40%;
            margin-top:3%;
            
        }
	   .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:-22%;
            clear:both;
        }
        .comment-box{
            margin-top:20%;
            border:0.1px solid #F9F4F4;padding:2%;
        }
    }
    
    /* Small Devices, Tablets */
	@media only screen and (max-width : 768px){
            .main_product{
            max-width:auto;
            max-height:auto;
            margin:2% auto 2%;
            overflow:hidden;
            display:block;
        }
        .seller_photo{
            display: block;
            height:15%;
            width:50%;
            margin-top:3%;
            margin-left:5%;
        }
	   .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:-30%;
            clear:both;
        }
	}
    
    /* Extra Small Devices, Phones */
	@media only screen and (max-width : 480px){
        .main_product{
            width:100%;
            height:80%;
            margin:2% auto 2%;
            overflow:hidden;
            display:block;
        }
        .seller_photo{
            display: block;
            height:15%;
            width:50%;
            margin-top:3%;
            margin-left:5%;
        }
	   .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:-45%;
            clear:both;
        }
	}
    /* Custom, iPhone Retina */
    @media only screen and (max-width : 320px){
        .main_product{
            max-width:100%;
            height:50%;
            display:block;
            border:solid 1px black;
        }
        .seller_photo{
            display: block;
            height:15%;
            width:70%;
            margin-top:3%;
            
        }
	   .footer{
            margin-left:auto;
            margin-right:auto;  
            height:3%;
            margin-bottom:-35%;
            clear:both;
        }
    }
 
</style>


    <div class = "container" >
    <div class= "row">
    
    <div class="col-md-3 col-lg-3 main_product">
        <a href="images/content/<?php echo $photo->filename;?>" data-lightbox="<?php echo $photo->filename;?>"><img src = "images/content/<?php echo $photo->filename;?>" class="img-thumbnail img-responsive"></a>
    
    </div>    
    <div class="col-md-9 col-lg-9 big-box">
        <div class="row ">
            <div class="col-md-9 col-lg-9">
                <h3 style="margin-bottom:-1%;">Product Information:</h3><hr>
                    <ul style="margin-top:-1%;">
                        <li class=" text text-capitalize"><?php echo $photo->product_name;?></li>
                        <li style="color:EC7063;font-size:20px;">Rs.<?php echo $photo->product_price;?></li>
                    </ul>
            <!--    <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Contact:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br> 
                <label class="control-label" for="name"><strong>Name:</strong></label><span id="name"><?php echo $session->Name;?></span><br>--> 
                <div class="well well-sm"style="margin-top:5%;"><h4>Specs/Details:</h4><br><?php echo $photo->product_details;?></h3></div>
            <span style="font-size:18px;">Sold by:<a href="view_profile.php?email=<?php echo $photo->Email;?>"><?php echo $photo->Email;?></a></span>
            </div>
               
        </div>
    </div>            
        </div><br>
    <div class="col-md-10 col-lg-10">
        <h3>Seller information:</h3><hr> 
        <div class="row">
    <div class="col-md-4 col-lg-4">
    <ul style="font-size:16px;font-weight:bold;">
        <li class="list-items">Name:<span style="font-family:Palatino Linotype, Book Antiqua, Palatino, serif;" class="text-capitalize"><?php echo $seller->Name;?></span></li>
        <li class="list-items">Hostel:<span style="font-family:Palatino Linotype, Book Antiqua, Palatino, serif;"><?php echo $seller->Hostel;?></span></li>
        <li class="list-items">Contact No:<span style="font-family:Palatino Linotype, Book Antiqua, Palatino, serif;"><?php echo $seller->Contact_no;?></span></li>
    </ul>
    </div>
    <div class="col-md-offset-5 col-lg-offset-5 col-md-2 col-lg-2">
        <div class="seller_photo"><img src="profile_pics/<?php echo $seller->profile_pic;?>" class="img-thumbnail img-responsive"></div>
        
    </div>
        </div>
</div>
<div class="comment-box col-lg-10">
        <?php if($session->is_logged_in()):?>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <form role="form" method="post">
                <div class="col-lg-1" style="margin-top:3%;">
                    <img src="profile_pics/<?php echo $session->profile_pic;?>" class="img-circle" style="width:60px;height:60px; border:solid 0.2px grey;">    
                </div>
                
                <div class="col-lg-11">
                    <div class="form-group">
                        <label for="comment">Add comment:</label>
                        <textarea class="form-control" rows="3" id="comment" placeholder="Leave a Comment.." name="body"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-info pull-right" name="post_comment">
            </div>
                </form>
        </div>
            
         <?php endif;?>       
        <?php foreach($comments as $comment):?>        
        <div class="col-lg-10">
                    <div class="row">
                    <div class="col-lg-1" style="margin-top:2%;">
                        <img src="profile_pics/<?php echo $comment->profile_pic;?>" class="img-circle" style="width:55px;height:55px; border:solid 0.2px grey;">
                    </div>
                    <div class="col-lg-11">
                        <label class="control-label"><?php echo $comment->author;?></label> <span><?php echo $comment->created;?></span><?php if($session->is_logged_in
() && $session->Name == $comment->author):?>   <a onclick="return confirmfunction()" href="delete_comment.php?comment_id=<?php echo $comment->id;?>&&product_name=<?php echo $photo->product_name;?>&&product_id=<?php echo $photo->id;?>">Delete</a><?php endif;?>
                        <div class="panel panel-default"><div class="panel-body"><span><?php echo $comment->body;?></span></div></div>
                    </div>
                </div>        
        </div>
        <?php endforeach;?>
    
        <?php if(empty($comments)):?>
            <h3 style="text-align:center;">No comments.</h3>
        <?php endif;?>
        </div>
</div>
</div>
<script type="text/javascript">
    function confirmfunction() {
         var confirm = window.confirm("You really want to remove this comment");
        return confirm;
    }

</script>
    


<script src="lightbox.js"></script>
<?php include_layout("admin_footer.php");?>