<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{

	if (isset($_GET['cat_id']) && !$_POST) {
			$conn = dbConnect('query');
			$cat_id = $_GET['cat_id'];
			
			//prepare first SQL query, category_id not included
			$sql = "SELECT * FROM categories
				WHERE categories.cat_id = ?";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $cat_id);
				
				//bind the results to variables
				$stmt->bind_result($cat_id, $cat_name, $cat_desc);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			}
					
		} //end of if isset() for $_GET
	
//START THE LOOP FOR UPDATE!
		$conn = dbConnect('admin');
		$errors=0;
		 
		//checks if the form has been submitted
		 if(isset($_POST['submit'])) {
			$cat_id = $_POST['cat_id'];
			$cat_name = $_POST['cat_name'];
			

				 
				$conn = dbConnect('admin');
				//FLagg it up!
				$done = false;
				//create database connection ADMIN		
				//create SQL 
				$sql3 = 'UPDATE categories
					SET cat_name = ?
					WHERE cat_id = ?';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql3);
					//bind parameters and execute statement
					
					$stmt->bind_param('si', $cat_name, $cat_id);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();

				
		}
		//If no errors registred, print the success message
		 if(isset($_POST['submit']) && $done) {
			$msg = "<h2>The category was updated!</h2>
			<h3>Go Back to the <a href='admin.php'>Control Panel</a> or the <a href='cat_list.php'>Categories List</a><h3>";
		 }
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="../js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#insert").validate();
});
</script>
<title>Update <?php echo $cat_name; ?></title>
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
		echo "<h2>Update $cat_name</h2>";
	}
?>
    <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					<p><label for="cat_name">Name:<span style="font-style:italic;font-size:12px;">(Its recommended to use less than 11 characters per word)</span></label></p>
					<p><input name="cat_name" id="cat_name" type="text" size="50" maxlength="50" class="required" value='<?php if (isset($cat_name)){echo ucfirst($cat_name);} ?>' /></p>

<!-- dynamically build the drop down list for categories-->
					<?php						
						$sql = "SELECT * FROM categories";  //select only those fields we need
					
						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
					?>
					
					<input type="hidden" id="cat_id" name="cat_id" value="<?php if (isset($cat_id)){echo $cat_id;} ?>" />
					<p><input id="submit" class="submit" type="submit" name="submit" value="Save changes" /></p>
				</form> 
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
