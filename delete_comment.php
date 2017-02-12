<?php require_once("include/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("index.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['comment_id'] && $_GET['product_id'] && $_GET['product_name'])) {
        if (!$session->is_logged_in()) 
        { 
        redirect_to("index.php");
        }
      else{
	   redirect_to("userprofile.php");
        }
  }

  $comment = Comment::find_by_id($_GET['comment_id']);
  if($comment && $comment->delete($_GET['comment_id'])) {
    redirect_to("product.php?name={$_GET['product_name']}&&id={$_GET['product_id']}");
  } else {
    
    $status="The comment could not be deleted.";
    redirect_to("product.php?name={$_GET['product_name']}&&id={$_GET['product_id']}&&status={$status}");
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
