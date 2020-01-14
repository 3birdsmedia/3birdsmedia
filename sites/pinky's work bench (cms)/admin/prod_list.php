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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">

<title>Product List</title>
</head>

<body>

<div id='wrap'>
    <a href="admin.php"><div id="header">
    </div></a>
    <span class="logout"><a href="logout.php">Logout</a></span>

<h2>Product List</h2>

<p><a href="prod_input.php">Add a product</a></p>


<?php	
	 $conn = dbConnect('query');

  			$sql = "SELECT *
				FROM prod_cat_lookup, products, categories
				WHERE prod_cat_lookup.cat_id = categories.cat_id
				AND prod_cat_lookup.prod_id = products.prod_id
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
					      <img src="../images/products/'.$row2['img_url'].'" width="168" />
					  </div>
					  <p class="style9">
					      <a href="prod_update.php?prod_id='.$row['prod_id'] .' ">
						  <h4>'. $row['prod_name'].'</h4>
					      </a>
					      <a href="prod_update.php?prod_id='.$row['prod_id'] .' ">
						  <h4>EDIT INFO</h4>
					      </a>
					      
					      <a href="prod_image_update.php?prod_id='.$row['prod_id'] .' ">
						  <h4>EDIT IMAGES</h4>
					      </a>
					      <a href="prod_delete.php?prod_id='.$row['prod_id'] .' ">
						  <h4>DELETE</h4>
					      </a>
					  </p></div>';
				    
			    } //end of the while loop
			    $result2->free_result();
			    
			    }
			    //release the db resources to allow a new query
			    $result->free_result();
			    
    
			    //close our database connection
			    dbClose($conn);
		
?>

</table>
</div>
</body>
</html>
