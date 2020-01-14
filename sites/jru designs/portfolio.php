<?php include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.lavalamp-1.3.5.js"></script>

<!--styles-->
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/reset.css" />
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
			<div id="header" <?php if ($title = 'home'){echo 'class="activeLogo"';} ?> >
				<a href="index.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
					<?php
						$conn = dbConnect('query');

						$sql = "SELECT * FROM projects";

						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
				

						while ($row = $result->fetch_assoc()) {
							//loop through the results of the project query and display project info.
							//Plus build the link dynamically to the details page
							$proj_id = $row['proj_id'];
							echo '<div class="module">';
							echo '<a href="project_details.php?proj_id='.$proj_id.' ">
								<h3>'. $row['proj_name'] .'</h3>
							</a>';
							
							echo '<a href="project_details.php?proj_id='.$proj_id.'">';
							
							$sql2 = "SELECT *
							 FROM project_image_lookup, images
							 WHERE project_image_lookup.proj_id = $proj_id
							 AND project_image_lookup.img_id = images.img_id
							 ORDER BY images.img_id
							 LIMIT 1";
							 
							 //submit the SQL query to the database and get the result
							$result2 = $conn->query($sql2) or die(mysqli_error());
						
							while ($row2 = $result2->fetch_assoc()) {
								echo '<div class="prod-img">
									<img src="images/projects/'.$row['proj_name']."/".$row2['img_url'].'" width="170" />
								</div></a>
							</div>';
				
							} //end of the while loop
							$result2->free_result();
							
			}
			//release the db resources to allow a new query
			$result->free_result();
			

			//close our database connection
			dbClose($conn);
			
?>


			</div>  
</div>
<?php include('includes/footer.php'); ?>

<?php include('includes/navBar.php');?>
</body>
</html>