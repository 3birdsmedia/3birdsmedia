<?php
include('includes/functions.php');
	//check for the product_id on the query string
	if ( isset($_GET['proj_id']) && is_numeric($_GET['proj_id']) ) {
		
		//set the variable so it's easier to use later in script
		$proj_id = $_GET['proj_id']; //for troubleshooting
		
		//echo "product_id is $proj_id <br>";
	} else {
		$proj_id = 0;
		echo "No product id on the url.";
	}
	
	//call the db connection script, passing in the type of user.
	$conn = dbConnect('query'); 
	
	$sql3 = "SELECT *
								 FROM project_image_lookup, images
								 WHERE project_image_lookup.proj_id = $proj_id
								 AND project_image_lookup.img_id = images.img_id
								 ORDER BY images.img_id";
							//submit the SQL query to the database and get the result
							$result3 = $conn->query($sql3) or die(mysqli_error());
							$images = array();
							
							//echo '<h1>'.$count.'</h2>';
							while ($row3 = $result3->fetch_assoc()) {
							array_push($images, $row3['img_id']);
							} //end of the while loop
							$count = count($images);
							$result3->free_result();

	
	
	
	//PART 1. Get basic product info and image
	//note that we're using LEFT JOIN to get image information as well as product info
	//the ON condition is where we match up the foreign key in the image table with a primary key in the product table
	$sql = "SELECT *
			FROM project_image_lookup, images
			WHERE project_image_lookup.proj_id = $proj_id
			AND project_image_lookup.img_id = images.img_id
			ORDER BY images.img_id";
		
	//submit the SQL query to the database and get the result
	$result = $conn->query($sql) or die(mysqli_error());
	$length = $result->num_rows;
	//$row = $result->fetch_assoc();
	
$images = array();

	    while ($row = $result->fetch_assoc()) {
				//loop through the sql result, add each product_id and type_id to array to use later 
					$images[] = array( 
										'proj_id' => $row['proj_id'], 
										'img_id' => $row['img_id'] ,
										'img_url'=> $row['img_url'],
										'img_name' => $row['img_name']
									);
				
			}
			//now that we are finished with results, release the db resources to allow a new query.
			$result->free_result();
			
	  $sql2 ="SELECT * FROM projects
		  WHERE projects.proj_id = $proj_id";
		  
	  $result2 = $conn->query($sql2) or die(mysqli_error());
	  
	  $row2 = $result2->fetch_assoc();
	  $proj_name = $row2['proj_name'];
	  $proj_desc = $row2['proj_desc'];
	  $result2->free_result();
//print_r($images);			

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.lavalamp-1.3.5.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script> 

<!--styles-->
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/svwp_style.css" />




<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="index.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
			<div id="slider">
				<div id="svwp" class="svwp">
					<ul>	
						<?php
							$conn = dbConnect('query');
							$sql = "SELECT * FROM projects
							WHERE proj_id = $proj_id";
							//submit the SQL query to the database and get the result
							$result = $conn->query($sql) or die(mysqli_error());
							while ($row = $result->fetch_assoc()) {
								//loop through the results of the project query and display project info.
								//Plus build the link dynamically to the details page
								$proj_id = $row['proj_id'];
								$proj_name = $row['proj_name'];
								
							}
							$sql2 = "SELECT *
								 FROM project_image_lookup, images
								 WHERE project_image_lookup.proj_id = $proj_id
								 AND project_image_lookup.img_id = images.img_id
								 ORDER BY images.img_id";
							//submit the SQL query to the database and get the result
							$result2 = $conn->query($sql2) or die(mysqli_error());
							
							
							//echo '<h1>'.$count.'</h2>';
							while ($row2 = $result2->fetch_assoc()) {
							 echo '<li><img src="images/projects/'.$proj_name."/".$row2['img_url'].'" width="350" /></li>';
							
							} //end of the while loop

							$result2->free_result();
					echo '</ul>
				</div>
			</div>';
			
			echo '<div class="prod_desc">
				<h4>'.$proj_name.'</h4>
					<p>'.stripcslashes($proj_desc).'</p>
				</div>';
			//release the db resources to allow a new query
			$result->free_result();
			//close our database connection
			dbClose($conn);
			?>
				</div>
		</div>
<?php include('includes/footer.php'); ?>

<?php include('includes/navBar.php');
//echo $count;
if ($count == 1){}else{?>
<style type="text/css">
.svwp {width: 50px; height: 20px; background: #fff;} /*preloader stuff. do not modify!*/
.svwp ul{position: relative; left: -999em;}/*preloader stuff. do not modify!*/
.selectedLava h1 {font-weight:normal !important; color:#47827F !important;}
</style>
  <script type="text/javascript" src="js/jquery.slideViewerPro.1.0.js" ></script> 
<script type="text/javascript">
$(window).bind("load", function() {
	$("div#svwp").slideViewerPro({
		thumbs: 3, 
		autoslide: true, 
		asTimer: 3500, 
		//typo: true,
		galBorderWidth: 2,
		thumbsBorderOpacity: 0.5, 
		buttonsTextColor: "#02c9c6",
		buttonsWidth: 40,
		thumbsActiveBorderOpacity: 0.8,
		thumbsActiveBorderColor: "#FF7400",
		shuffle: true
 
	});
});
<?php } ?>
</script>
<style type="text/css">
.homeBtn h1, .footerHomeBtn h1{
	color:#3D716E !important;
	font-weight:normal !important;
}
</style>
</body>
</html>