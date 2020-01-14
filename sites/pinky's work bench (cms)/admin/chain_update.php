<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{

	if (isset($_GET['chain_id']) && !$_POST) {
			$conn = dbConnect('query');
			$chain_id = $_GET['chain_id'];
			
			//prepare first SQL query, chainegory_id not included
			$sql = "SELECT * FROM chains
				WHERE chains.chain_id = ?";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $chain_id);
				
				//bind the results to variables
				$stmt->bind_result($chain_id, $length, $extra);
				
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
			$chain_id = $_POST['chain_id'];
			$length = $_POST['length'];
			$extra = $_POST['extra'];
			

				 
				$conn = dbConnect('admin');
				//FLagg it up!
				$done = false;
				//create database connection ADMIN		
				//create SQL 
				$sql3 = 'UPDATE chains
					SET length = ?, addit_price = ?
					WHERE chain_id = ?';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql3);
					//bind parameters and execute statement
					
					$stmt->bind_param('iii', $length, $extra, $chain_id);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();

				
		}
		//If no errors registred, print the success message
		 if(isset($_POST['submit']) && $done) {
			$msg = "<h2>The Chain was updated!</h2>
			<h3>Go Back to the <a href='admin.php'>Control Panel</a> or the <a href='chain_list.php'>Chains List</a><h3>";
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
<title>Update <?php echo $length; ?> </title>
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
		echo "<h2>Update $length</h2>";
	}
?>
    <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					<p><label for="length">Length:<span style="font-style:italic;font-size:12px;">(total number i.e. 20)</span></label></p>
					<p><input name="length" id="length" type="text" size="50" maxlength="50" class="required" value='<?php if (isset($length)){echo ucfirst($length);} ?>' /></p>
					<label for="extra">Extra Price</label>
					<p><input name="extra" id="extra" type="text" size="50" maxlength="20" class="required" value='<?php if (isset($extra)){echo ucfirst($extra);} ?>' /></p>
					<input type="hidden" id="chain_id" name="chain_id" value="<?php if (isset($chain_id)){echo $chain_id;} ?>" />
					<p><input class="submit"  id="submit" type="submit" name="submit" value="Save changes" /></p>
				</form> 
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
