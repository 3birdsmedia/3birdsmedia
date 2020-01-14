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
				FROM prod_img_lookup, images
				WHERE images.img_id = ?
				AND prod_img_lookup.img_id = images.img_id
				ORDER BY images.img_id";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($prod_id, $img_id, $img_id, $img_name, $img_url);
				
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
				FROM prod_img_lookup, images
				WHERE images.img_id = ?
				AND prod_img_lookup.img_id = images.img_id
				ORDER BY images.img_id";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($prod_id, $img_id, $img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
				
	
				
			}
			
						
			$conn = dbConnect('admin');
			//prepare delete query
			$projSql = "SELECT proj_name FROM projects WHERE proj_id = $prod_id"
			
			$imageFile = "../images/projects/".$_POST['proj_name'];
			
			unlink($imageFile);		
			//prepare delete query
			$sql4 = 'DELETE FROM prod_img_lookup WHERE img_id = ?';
			
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
			//echo '<H1>ERROR</H1>'.$prod_id.$prod_name.'';		
			
		
		
		
		//redirect page if deletion is successful, cancel button clicked, OR if $GET['spot_id'] not defined
		if ($deleted || array_key_exists('cancel_delete', $_POST) || !isset($_GET['prod_id'])) {
			header('Location: prod_image_update.php?prod_id='.$prod_id.'');  //send us back to the spot list page if delete succeeds
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>


<!--styles-->
<link rel="stylesheet" href="stylesheet.css" />
<style type="css/text">
</style>


<title>Delete IMAGE</title>
    <?php 
        //connect to the database - this is the query account, that only has SELECT permission on the database
        $conn = dbConnect('query');
    ?>
</head>


<body>
	<div id="wrap">      
		<a href="admin.php"><div id="header">
		</div></a>
    
       	<div id="cont">
<body>

<p><a href="prod_list.php">Back the products list</a></p>
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
            	<input type="hidden" name="prod_id" value="<?php echo $img_id; ?>" />
            <?php } ?>
        </p>
   </form>     

	<?php
        //now that we're done, we want to close our database connection.  call the dbClose() connection function
        dbClose($conn);
    ?>
</body>
</html>
