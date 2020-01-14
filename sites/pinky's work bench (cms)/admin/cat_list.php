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

<h2>Category List</h2>



<?php	
	 $conn = dbConnect('query');

  			$sql = "SELECT *
				FROM categories
				ORDER BY categories.cat_id";

			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
				while ($row = $result->fetch_assoc()) {
				//loop through the results of the product query and display product info.
				//Plus build the link dynamically to the details page
				$cat_id = $row['cat_id'];
				$cat_name = $row['cat_name'];
				echo '<div class="category">';
				echo '<p class="style9">
					<a href="cat_update.php?cat_id='.$cat_id.' ">
						  <h4>'. $cat_name.'</h4>
					      </a></div>';
				    			    
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
