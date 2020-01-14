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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<!--<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>-->

<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/reset.css" />


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
						<a href="admin.php"><h3>Back to the Control Panel</h3></a>
						<h2>Project Page</h2>
						
						<p>Click on one of the links to edit the desired section of the site. If you need to get back to this page at any moment, click on the logo or back buttons.</p>
						
						<a href="addProjects.php"><h2>Add a new Project</h2></a>
					</div>
					
					<div id="right-two">
					<?php
						$conn = dbConnect('query');

						$sql = "SELECT * FROM projects";

						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
				

						while ($row = $result->fetch_assoc()) {
							//loop through the results of the project query and display project info.
							//Plus build the link dynamically to the details page
							$proj_id = $row['proj_id'];
							$proj_name = $row['proj_name'];
							echo '<div id="thumb"><a href="updateProjects.php?proj_id='.$proj_id.'">';
							echo '<h3>'.ucwords($proj_name).'</h3>';
							$sql2 = "SELECT *
							 FROM project_image_lookup, images
							 WHERE project_image_lookup.proj_id = $proj_id
							 AND project_image_lookup.img_id = images.img_id
							 ORDER BY images.img_id
							 LIMIT 1";
							 
							 //submit the SQL query to the database and get the result
							$result2 = $conn->query($sql2) or die(mysqli_error());
						
							while ($row2 = $result2->fetch_assoc()) {
	
									echo '<img src="../images/projects/'.$row['proj_name']."/".$row2['img_url'].'" height="100" /></a>';
							
							} //end of the while loop
							echo '<a href="delete.php?proj_id='.$proj_id.' "><h4>DELETE</a> | <a href="updateProjects.php?proj_id='.$proj_id.' ">EDIT</h4></a></p></div>';
							
							$result2->free_result();
							
			}
			//release the db resources to allow a new query
			$result->free_result();
			

			//close our database connection
			dbClose($conn);
			
?>
							
					</div>
<!--END CONTENT-->					
				</div>
		</div>


<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php include('../includes/adminfooter.php'); ?>

</body>
</html>