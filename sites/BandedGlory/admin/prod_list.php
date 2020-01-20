<?php

session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}else{
	nukeMagicQuotes();
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
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
<title>Product List</title>
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
<h2>Product List</h2>

<p><a href="prod_input.php">Add a product</a></p>


<?php	
	 $conn = dbConnect('query');

  			$sql = "SELECT prod_id, prod_name FROM products
				ORDER BY products.prod_id";

			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
	

			while ($row = $result->fetch_assoc()) {
				//loop through the results of the product query and display product info.
				//Plus build the link dynamically to the details page
				$prod_id = $row['prod_id'];
				echo '<div class="product">';
					    $sql2 = "SELECT *
					    FROM prod_img_lookup, images
		   			    WHERE prod_img_lookup.prod_id = $prod_id
					    AND prod_img_lookup.img_id = images.img_id
					    ORDER BY images.img_id
					    LIMIT 1";
				     
					    //submit the SQL query to the database and get the result
					    $result2 = $conn->query($sql2) or die(mysqli_error());
			    
			    while ($row2 = $result2->fetch_assoc()) {
				    echo '
					  <div class="boxes"><a href="prod_update.php?prod_id='.$row['prod_id'] .' ">
					      <img src="../images/products/'.$row2['img'].'" width="150" /></a>
					  </div>

					      <h4><a href="prod_update.php?prod_id='.$row['prod_id'] .' ">'. $row['prod_name'].'</a></h4>
						  
					       <h4><a href="prod_update.php?prod_id='.$row['prod_id'] .' "> EDIT INFO</a></h4>
						
						<h4> <a href="prod_image_update.php?prod_id='.$row['prod_id'] .' ">EDIT IMAGES  </a></h4>
						  
						   <h4> <a href="prod_delete.php?prod_id='.$row['prod_id'] .' ">DELETE</a></h4>';
					      
						
					      
					  
				    
			    } //end of the while loop
			    $result2->free_result();
			    echo "</div>";
			    }
			    //release the db resources to allow a new query
			    $result->free_result();
			    
    
			    //close our database connection
			    dbClose($conn);
		
?>

<div id="push"></div><!-- End: push -->
	      </div><!-- End: container -->
	</div><!-- End: Center Wrap -->
</div><!-- End: Center Wrap -->
	   
	   <!-- Start: footer -->
		 <div id="footer">
		 </div><!-- End: footer -->
</body>
</html