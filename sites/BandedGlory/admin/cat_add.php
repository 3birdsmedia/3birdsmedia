<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");



if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}else{
//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  

//and it will be changed to 1 if an errro occures.  

//If the error occures the file will not be uploaded.

 $errors=0;

//checks if the form has been submitted
//print_r($_POST);

if(isset($_POST['submit'])) {
	$msg = '';

	if(trim($_POST['category']) == ''){
		$msg = 'Please enter a product name<br />';
		$errors = 1;
	}
  
	
	if($errors == 0){
	$done = false;
		$conn = dbConnect('admin');
			
			  $sql =  'INSERT INTO categories (category, sort)
					VALUES (?, 0)';
						
				//initialize prepared statement
				$stmt = $conn->stmt_init();
						
				if ($stmt->prepare($sql)) {			
					//bind parameters and execute statement
					$stmt->bind_param('si', $_POST['category'], $_POST['sort']);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();
					$done = true;
				}else {
					echo $stmt->error;
				}		
			
				if ($done) {
					$category = $_POST['category'];
					$cat_desc = $_POST['sort'];	
					
					//MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
					$msg = $category.'has been created<br />
							<p>Desc: '.$cat_desc.'</p>';
																				
					//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
					//for troublshooting: print out each item from the $_POST to check it
							
					//print_r($_POST);
							
					} else {
						echo $stmt->error;
					}
					
				$sql2 = 'SELECT * FROM categories
				ORDER BY cat_id DESC
				LIMIT 1 ';
				
				//echo '<h1>'.$msg.'</h1>';
				
				$result2 = $conn->query($sql2) or die(mysqli_error());
				
				
				while($row2 = $result2->fetch_assoc()){
						$cat_id = $row2['cat_id'];
						
				
				}
				dbClose($conn);		
			}////////POST LOOP
		}//SESSION LOOP

}
if(isset($_POST['submit']) && !$errors) {
			//MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
			$msg = $category.' has been created<br />
				<p>Desc: '.$cat_desc.'</p>';
			//header( 'Location: crop.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <title>SA RECYCLING Control Panel</title>
 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds." />
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
 <meta name="description" content="Add your sites description here" />
 <meta name="keywords" content="Add,your,site,keywords,here" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
	$().ready(function() {
		// validate the comment form when it is submitted
		$("#insert").validate();
	});

</script>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">
   
	   <!-- Start: container -->
	      <div id="container">
	   
	   
		 <!-- Start: header -->
		      <div id="header">
			     <a href="admin.php"><h1><span>SA Recycling</span></h1></a>
		     </div><!-- End: header -->	  	   
		 
	   <!-- Start: content -->
	   <div id="content">
								<span class="logout"><a href="logout.php">Logout</a></span>
           <div id="lef-cont">
		<a href='admin.php'>Go back to your Control Panel</a>
		
		
<?php
		//if the form has been submitted, display result
    	    if (isset($msg)) {
        				echo "<div id='msg'>$msg</div>";
        	}else{
						echo "<h2>Add a new category</h2>
								You can add categories here, to edit categories 
								do so <a href='cat_list.php'>here</a>.</p>";
			}
?>  

		</div>
    
	<div id="right-cont">

		<form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					
					<p><label for="category">Add a new categorie:</label></p>
					<p><input name="category" id="category" type="text"  maxlength="100" value="<?php prefill('category'); ?>" /></p>
<!-- dynamically build the drop down list for categories-->
					<p><label for="sort">Add a number to sort this category by:</label></p>
					<p><input name="sort" id="sort" type="text"  maxlength="3" value="<?php prefill('sort'); ?>" /></p>
</p>
					
					
					
			<p>
					<input class="submit" type="submit" name="submit" value="Add new category" />
			</p>
						
				    
				<!--END CONTENT-->		
  
			</form>
		</div>
	
   <div id="push"></div><!-- End: push -->
	      </div><!-- End: container -->
	</div><!-- End: Center Wrap -->
</div><!-- End: Center Wrap -->
	   
	   <!-- Start: footer -->
		 <div id="footer">
		 </div><!-- End: footer -->
</body>
</html