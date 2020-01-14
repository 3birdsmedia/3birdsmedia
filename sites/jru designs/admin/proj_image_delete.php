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
			
			
			$sql = "SELECT *
				FROM project_image_lookup, images
				WHERE images.img_id = ?
				AND project_image_lookup.img_id = images.img_id
				ORDER BY images.img_id";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($proj_id, $img_id, $img_id, $img_name, $img_url);
				
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
			$sql = "SELECT *
				FROM project_image_lookup, images
				WHERE images.img_id = ?
				AND project_image_lookup.img_id = images.img_id
				ORDER BY images.img_id";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($proj_id, $img_id, $img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			echo $proj_id;	
	
				
			}
			
			echo $proj_id;			
			$conn = dbConnect('admin');
			//prepare delete query
			$projSql = "SELECT proj_name FROM projects WHERE proj_id = ?";
				//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($projSql)) {
				//bind the query parameters
				$stmt->bind_param('i', $proj_id);
				
				//bind the results to variables
				$stmt->bind_result($proj_name);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			
			$imageFile = "../images/projects/".$proj_name."/".$img_url;
			
			unlink($imageFile);
			}
			//prepare delete query
			$sql4 = 'DELETE FROM project_image_lookup WHERE img_id = ?';
			
			//initialize statement
			$stmt = $conn->stmt_init();
			if ($stmt->prepare($sql4)) {
				$stmt->bind_param('i', $img_id);
				$deleted = $stmt->execute();

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
		if ($deleted || array_key_exists('cancel_delete', $_POST) || !isset($_GET['proj_id'])) {
			header('Location: updateProjects.php?proj_id='.$proj_id.'');  //send us back to the spot list page if delete succeeds
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
<!--<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>-->

<!--styles-->
<link rel="stylesheet" href="../styles/reset.css" /><link rel="stylesheet" href="../styles/styles.css" />

<style type="css/text">
</style>
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="admin.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
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
<!--END CONTENT-->					
				</div>
		</div>
	</div>

<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php include('../includes/adminfooter.php'); ?>

</body>
</html>