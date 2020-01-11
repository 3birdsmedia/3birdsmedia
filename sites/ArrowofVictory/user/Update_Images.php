<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{ 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>


<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>


<title>DJ Soosk CPanel <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
    	<div id="main">
        	<div id="header">
            	<a href="index.php" id="logo"><h1>Tan You're It!</h1></a>
		<?php //include('includes/navBar.php');?>
            </div>
            
       	<div id="cont">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
					<div id="left-cont">
						<a href="admin.php"><h3>Back to the Control Panel</h3></a>
						<h2>Gallery Page</h2>
						
						<p>Here you can delete desired images or add new ones :)</p>
						
						<a href="addimages.php"><h2>Add a new Project</h2></a>
					</div>
					
					<div id="right-two">
					<?php
						$conn = dbConnect('query');

						$sql = "SELECT * FROM images";

						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
				

						while ($row = $result->fetch_assoc()) {
							//loop through the results of the project query and display project info.
							//Plus build the link dynamically to the details page
							
							echo '<div id="thumb">';
							
									echo '<img src="../images/flyers/'.$row['img_url'].'" height="100" />';
							
							echo '<a href="image_delete.php?img_id='.$row['img_id'].' "><h4>DELETE</a></div>'; 
						}
			//release the db resources to allow a new query
			$result->free_result();
			

			//close our database connection
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