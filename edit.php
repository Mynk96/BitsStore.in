<?php 
    require_once("include/initialize.php");
    if (!$session->is_logged_in()){
        require("header.php");
    } else{
        require("admin_header.php");
    }
     $alert = "";
?>

<?php 
   
    if(isset($_POST['change_details'])){
        $photo = "";
        $user = User::find_by_id($session->id); 
        if(!empty($_POST['public_no'])){
            $user->Contact_no = $_SESSION['Contact_no'] = test_input($_POST['public_no']);    
        }
        if(!empty($_POST['public_hostel'])){
            $user->Hostel = $_SESSION['public_hostel'] = test_input($_POST['public_hostel']);    
        }
        if(($_FILES['change_avatar']['error'] == 0))
        {
            $user->profile_pic = $_SESSION['profile_pic'] = ($_FILES['change_avatar']['name']);
            
            if($user->attach_file($_FILES['change_avatar'])){
                
                if($user->update_photo()){
                    $session->update_session($user);
                    $alert = "Details Updated";
                }else{
                    $alert = join("<br>",$user->errors);        
                }
            }else{
                $alert = join("<br>",$user->errors);
                }  
        }elseif(($_FILES['change_avatar']['error'] == 4)){
                    $user->update();
                    $session->update_session($user);
                    $alert = "Details Updated";
                    
        }elseif(($_FILES['change_avatar']['error'] == 1)){
        
        }else {
            print_r($_FILES['change_avatar']['error']);
            $alert = join("<br>",$user->errors);
            }
            
    }
    
?>
<style>
    div > p{
        font-family:"Arial",sans-serif;
        font-size: 14px;
        
    }
    @media only screen and (max-width: 768px){
        .edit_details_box{
            padding:1%;
        }
    }

</style>


    <h2 class="col-md-offset-3 col-lg-offset-5 col-xs-9 col-md-9 col-lg-9" id="edit_profile">Edit Profile:</h2>
    <div class="container edit_details_box">
    <div style="border:1px solid #ddd; padding:1%;" class="col-sm-offset-2 col-md-offset-2 col-lg-offset-4 col-sm-4 col-md-4 col-lg-4">
        <form class="form" role="form" method="post" enctype="multipart/form-data">
           <?php if($alert != ""):?>
            <?php if($alert == "Details Updated" ):?>
                <div class="form-group">
                    <div class="alert alert-success"><?php echo $alert;?></div>
                </div>
            <?php else:?>
                <div class="form-group">
                    <div class="alert alert-danger"><?php echo $alert;?></div>
                </div>
            <?php endif;?>
            <?php endif;?>
            <div class="form-group">
                <label for="public_hostel" class="control-label">Current Hostel:</label>
                <select class="form-control" name="public_hostel" id="public_hostel">
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
                <label for="public_no" class="control-label">Current Contact no:</label>
                <input type="number" class="form-control" id="public_no" name="public_no" placeholder="<?php echo $session->Contact_no;?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="chane_avatar">Change Avatar:</label>
                <input type="file" name="change_avatar" id="change_avatar"><span style="font-size:10px;">(File Less than 2MB.)</span>
            </div>
            <div class="form-group">
                <input type="submit" name="change_details" class="btn btn-success" value="Change_details">
            </div>
        </form>
        
    
    
    
    
    
    </div>



</div>
<?php include_layout("admin_footer.php");?>