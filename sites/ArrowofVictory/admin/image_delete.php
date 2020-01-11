<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{
	nukeMagicQuotes();
	
		//initialize flags
		$OK = false;
		$done = false;
		$done2 = false;
		$done3 = false;
		$deleted = false;
		//create database connection - note this connection is made with the admin account, that has permissions to update,insert, and delete records
		$conn = dbConnect('admin');
		
	if (isset($_GET['img_id']) && !$_POST) {
			
			$img_id = $_GET['img_id'];
			
			
			$sql = "SELECT * FROM images WHERE img_id = ?";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
				
			}
			
	} //end of if isset() for $_GET
	

		//if confirm deletion button has been clicked, delete the record
	if (array_key_exists('delete', $_POST)) {
			
			$img_id = $_GET['img_id'];
			
			//prepare first SQL query, category_id not included
			$sql = "SELECT * FROM images WHERE img_id = ?";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			echo $img_id;	
				
			
			$imageFile = "../images/gallery/".$img_url;
			
			unlink($imageFile);
			}

						
			//prepare delete query
			$sql6 = 'DELETE FROM images WHERE img_id = ?';
			
			//initialize statement
			$stmt = $conn->stmt_init();
			if ($stmt->prepare($sql6)) {
				$stmt->bind_param('i', $img_id);
				$deleted = $stmt->execute();

			}
			//echo '<H1>ERROR</H1>'.$proj_id.$proj_name.'';		
			
		
		
		
		//redirect page if deletion is successful, cancel button clicked, OR if $GET['spot_id'] not defined
		if ($deleted || array_key_exists('cancel_delete', $_POST) || !isset($_GET['img_id'])) {
			header('Location: Update_Images.php');  //send us back to the spot list page if delete succeeds
			exit;
		} 
	}
		//display error message if any query fails
		if (isset($stmt) && !$OK && !$deleted) {
			echo $stmt->error;
		}
}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>


<!--styles-->
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/style.css" />

<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

<!-- Start: header -->
<div id="header">
	<a href="admin.php" alt="Marco and Kirstie's wedding"><h2 id="logo"><span>Kirstie and Marco</span></h2></a>
</div><!-- End: header -->


<!-- Start: content -->
<div id="content">
	<div id="inner-content">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
					<div id="left-cont">
<h2>Delete Information</h2>

	<?php 
    //test for a valid spot_id, id there is not one then they get an error message with NO FORM. Otherwise, the form is displayed.
	if($img_id == 0) { ?>
	<p>INVALID REQUEST: record does not exist.</p>
	<?php } else { ?>
        

	<p>Please confirm that you want to delete this record.  This action CANNOT be undone!</p> 
    
    
	<?php } ?>

	<form id="delete" name="delete" id="delete" method="post" action="">
    	<p>
        	<?php if ($img_id > 0 ) { ?>
            	<input type="submit" class="submit" name="delete" id="delete" value="Permanently delete this image" />
            <?php } ?>
            	<input type="submit" class="submit" name="cancel_delete" value="Cancel" />
            <?php if ($img_id > 0 ) { ?>
            	<input type="hidden" name="proj_id" value="<?php echo $img_id; ?>" />
            <?php } ?>
        </p>
   </form>     

	<?php
        //now that we're done, we want to close our database connection.  call the dbClose() connection function
        dbClose($conn);
    ?>
					</div>
					<!--END CONTENT-->				
				</div>
<div id="push"></div>
</div><!-- End: content -->



<!-- Start: footer -->
<div id="footer">
	  <script type="text/javascript" src="../js/countdown.js"></script>
	<script type="text/javascript">countdown_clock(11, 09, 17, 18, 00, 1);</script>
</div><!-- End: footer -->



<!-- Start: navBar -->
<div id="navBar">
	<?php //include('includes/navBar.php');?>
</div><!-- End: navBar -->

</div><!-- End: Center Wrap -->
 </body>
</html>