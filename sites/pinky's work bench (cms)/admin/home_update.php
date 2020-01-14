<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{
	$home_id = 1;
	$conn = dbConnect('admin');
			//prepare first SQL query, homeegory_id not included
			$sql = "SELECT * FROM homeText
			WHERE homeText.home_id = ?
			LIMIT 1";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $home_id);
				
				//bind the results to variables
				$stmt->bind_result($homeText,$home_id );
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			}
	dbClose($conn);
//START THE LOOP FOR UPDATE!
		$conn = dbConnect('admin');
		$errors=0;
		 
		//checks if the form has been submitted
		 if(isset($_POST['submit'])) {
			$home_id = $_POST['home_id'];
			$homeText = stripcslashes(nl2br($_POST['homeText']));
			

				 
				$conn = dbConnect('admin');
				//FLagg it up!
				$done = false;
				//create database connection ADMIN		
				//create SQL 
				$sql3 = 'UPDATE homeText
					SET homeText = ?
					WHERE home_id = 1';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql3);
					//bind parameters and execute statement
					
					$stmt->bind_param('s', $homeText);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();

				
		}
		//If no errors registred, print the success message
		 if(isset($_POST['submit']) && $done) {
			$msg = "<h2>The home page paragraph was updated!</h2>
			<h3>Go Back to the <a href='admin.php'>Control Panel</a> or the <a href='home_list.php'>Homepage Update</a><h3>";
		 }
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#insert").validate();
});
</script>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
	<style type="text/css">
	label {width:300px}
	</style>
<title>Update Home Paragraph</title>
</head>

<body>

<div id='wrap'>
    <a href="admin.php"><div id="header">
    </div></a>
    <span class="logout"><a href="logout.php">Logout</a></span>    
<?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo "<div id='msg'>$msg</div>";
        }else{
		echo "<h2>Update Home paragraph</h2>";
	}
?>
    <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					<p><label for="home_name">Paragraph</label></p>
					<p><label for="home_name"><span style="font-style:italic;font-size:12px;">(no more than 400 characters)</span></label></p>
					<p><textarea name="homeText" id="homeText" type="text" size="50" maxlength="400" class="required" ><?php if (isset($homeText)){echo ucfirst($homeText);} ?></textarea></p>

<!-- dynamically build the drop down list for categories-->
					<?php						
						$sql = "SELECT * FROM categories";  //select only those fields we need
					
						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
					?>
					
					<input type="hidden" id="home_id" name="home_id" value="<?php if (isset($home_id)){echo stripcslashes($home_id);} ?>" />
					<p><input class="submit" id="submit" type="submit" name="submit" value="Save changes" /></p>
				</form> 
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
