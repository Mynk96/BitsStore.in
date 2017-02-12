<?php require_once("include/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("index.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
        if (!$session->is_logged_in()) 
        { 
        redirect_to("index.php");
        }
      else{
	   redirect_to("userprofile.php");
        }
  }

  $photo = Photograph::find_by_id($_GET['id']);
  if($photo && $photo->destroy()) {
      $status="Product Successfully Removed";
    redirect_to("myprofile.php?status={$status}");
  } else {
    
    $status="The photo could not be deleted.";
    redirect_to("myprofile.php?status={$status}");
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
