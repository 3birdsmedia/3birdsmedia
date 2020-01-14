<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");
if (!isset($_SESSION['authenticated'])) {	header('Location: index.php');
	exit;
	}else{
		
	if (!isset($_GET['proj_id'])){
	
		$msg = 'Oops there seemed to be an error, please go <a href="uProj.php">BACK</a> and try again.';

	}elseif(isset($_GET['proj_id'])){

		$proj_id = $_GET['proj_id'];
		$conn = dbConnect('query');

		$sql = "SELECT * FROM projects
		WHERE proj_id = $proj_id";
		//submit the SQL query to the database and get the result
		$result = $conn->query($sql) or die(mysqli_error());
					
		while ($row = $result->fetch_assoc()) {
					//loop through the results of the project query and display project info.
					//Plus build the link dynamically to the details page
					$proj_id = stripcslashes($row['proj_id']);
					$proj_name = stripcslashes($row['proj_name']);
					$proj_desc = stripcslashes($row['proj_desc']);
					
		}

		$sql2 = "SELECT *
			 FROM project_image_lookup, images
			 WHERE project_image_lookup.proj_id = $proj_id
			 AND project_image_lookup.img_id = images.img_id
			 ORDER BY images.img_id";

			//submit the SQL query to the database and get the result
			$result2 = $conn->query($sql2) or die(mysqli_error());
			$images = array();
			$count = count($images);
	
			while ($row2 = $result2->fetch_assoc()) {
						 array_push($images, $row2['img_url']);
						//print_r($images);
			} //end of the while loop
					
			$result->free_result();


		$conn = dbConnect('admin');
		//print_r($_POST);		
		//define a maxim size for the uploaded images in Kb
		//100 = 1mb aprox
		 define ("MAX_SIZE","500"); 
		
		//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
		function getExtension($str) {
				 $i = strrpos($str,".");
				 if (!$i) { return ""; }
				 $l = strlen($str) - $i;
				 $ext = substr($str,$i+1,$l);
				 return $ext;
		}
		//print_r ($_POST);
		//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
		//and it will be changed to 1 if an error occurs.  
		//If the error occurs the file will not be uploaded.
		 $errors=0;
		 

		//checks if the form has been submitted
		 if(isset($_POST['submit'])) {
		//	echo "<H2>ERROR</h2>";
			
			
				//echo $_POST['proj_name'];
				$folder = "../images/projects/".$_POST['proj_name'];
				if(!is_dir($folder)){
					mkdir($folder);
				}		 
				
				//Flag it up!
				$done = false;
						
				//create database connection ADMIN		
				//create SQL 
				$sql =  'UPDATE projects
					 SET proj_name = ?, proj_desc = ?
					 WHERE proj_id = ?';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				if ($stmt->prepare($sql)) {
					//bind parameters and execute statement
					
					$stmt->bind_param('ssi', $_POST['proj_name'], $_POST['proj_desc'], $proj_id);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();
				}
				
				if ($done) {
					$proj_name = $_POST['proj_name'];
					$proj_desc = $_POST['proj_desc'];
					//MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
					$newAddedMsg = 'The Project'.$proj_name.'has been added<br />'
					.$proj_desc.'</br>';
				//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
				//for troublshooting: print out each item from the $_POST to check it
				//print_r($_POST);
					
					//exit;
				} else {
					echo $stmt->error;
				}
			
	//echo 'Hello'.$_FILES['image']['name'][0].'new';
				//UPLOAD IMAGE//
				if ($_FILES['image']['name'][0] != ''){
				 //start a loop to check each image uploaded
				 foreach ($_FILES['image']['name'] as $key => $value) {
				// print_r($_FILES);
				if ($value != ''){				//trouble shooting
								//echo $_FILES['image']['name']."<br />";
								//echo "Key: $key; Value: $value<br />\n";
										 
								//reads the name of the file the user submitted for uploading
								$image= $value;
									//if it is not empty
								if ($image) {
								//get the original name of the file from the clients machine
									$filename = stripslashes($value);
								//get the extension of the file in a lower case format
									$extension = strtolower(getExtension($filename));
								//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
								//otherwise we will do more tests
											if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
											//print error message
												$msg = '<h2>Unknown extension!</h2>';
												$errors=1;
											}else{
											//get the size of the image in bytes
											 //$_FILES['image']['tmp_name'] is the temporary filename of the file
											 //in which the uploaded file was stored on the server
											 $size=filesize($_FILES['image']['tmp_name'][$key]);
									
												//compare the size with the maxim size we defined and print error if bigger
														if ($size > MAX_SIZE*1024){
															$msg = '<h2>Please use a smaller image</h2>';
															$errors=1;
														}
									
														//we will give an unique name, for example the time in unix time format
														$image_name= $value;
														//the new name will be containing the full path where will be stored (images folder)
														$newname= $folder."/".$image_name;
														//we verify if the image has been uploaded, and print error instead
														$copied = copy($_FILES['image']['tmp_name'][$key], $newname);
														if (!$copied) {
															$msg = '<h1>Copy unsuccessful!</h1>';
															$errors=1;
														}
											}
								}
				//echo $proj_id;
								 //prep the sql statement       
								$sql3 = 'INSERT INTO images (img_url, img_name)
								VALUES (?,?)';
								//initialize statement       
								$stmt = $conn->stmt_init();
		
								if ($stmt->prepare($sql3)) {
								//bind the parameters
								$stmt->bind_param('ss', $image, $filename);
								$OK = $stmt->execute();
								}
								
								$sql4 = 'SELECT img_id 
										FROM images
										ORDER BY img_id DESC
										LIMIT 1';
										
								$result4 = $conn->query($sql4) or die(mysqli_error());
								while($row4 = $result4->fetch_assoc()){
													$img_id = $row4['img_id'];	
								}
					
					
							
							//	echo $img_id;
									
								$sql5 = 'INSERT INTO project_image_lookup (proj_id, img_id)
										VALUES (?,?)';
								
								//initialize statement       
								$stmt = $conn->stmt_init();
					
								if ($stmt->prepare($sql5)) {
								//bind the parameters
								$stmt->bind_param('ii', $proj_id, $img_id);
								$OK = $stmt->execute();
								}
				}else{};		
					}//End of for each
				}//End of Upload image
		}//end of if isset post
		//If no errors registered, print the success message
		 if(isset($_POST['submit']) && !$errors) {
			$msg = "<h2>The New Project was saved!</h2>";
		 }
		
	}
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
<script language="javascript">
function addEvent() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById("theValue").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
  newdiv.setAttribute("class","newField");
  
  //THIS IS YOUR NEW INPUT
  newdiv.innerHTML = "<label for='image'><span class='label'><p>Select Image:</p></span></label><input type='file' name='image[]' id='image' class='required' /><input type='button' id='remover' onclick=\"removeElement(\'"+divIdName+"\')\" value='Remove this field' />";
  ni.appendChild(newdiv);
}


function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

function removeFirst(divNum) {
   var d = document.getElementById('firstField');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
</script>
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
						<?php
							//if the form has been submitted, display result
						if (isset($msg)) {
							echo "<div id='msg'>$msg</div>
							<p>You may also go back to the <a href='uProj.php'>project list</a> or to the <a href='admin.php'>Control Panel</a></p>";
						}else{
							echo "<h2>Edit Project</h2>";
							echo "<p>Here you can edit the project contents and pictures. To change the content, simply type in the
							new content in the inputs, just like when adding a new one, same goes to the pictures. If you wish to delete
							a picture, do so by checking the check box and saving the project.</p>
							<p>You may also go back to the <a href='uProj.php'>project list</a> or to the <a href='admin.php'>Control Panel</a></p>";
						}
						?>
					</div>
			
					<div id="middle-cont">
						<form id="insert" name="insert" method="post" action="" enctype="multipart/form-data">    
					
							<label for="proj_name">Name:</label>
							<input name="proj_name" id="proj_name" type="text" size="50" maxlength="50" class="required" value="<?php if(isset($proj_name)){echo $proj_name;} ?>"/>		
					    
							<label for="proj_desc">Describe the project:</label>
							<textarea cols="60" rows="25" name="proj_desc" id="proj_desc" class="required"><?php if(isset($proj_desc)){echo stripcslashes($proj_desc);} ?></textarea>    
							<div id="firstField">
								<div id="remover">
							<label for="image"><span class="label"><p>Add a New Image</p></span></label>
							<input type="file" name="image[]" id="image" class="required"/><input id="remover" type="button" value="Remove this field" onclick="removeFirst('remover')">
								</div>
							</div>	
							<div id="myDiv"> </div>
			
								
							<input type="hidden" value="0" id="theValue" />
							<input type="button" onclick="addEvent();" value="Add an Extra Input Field" />
							<input type="submit" name="submit" value="Save the Changes" />
						</form>
					</div>
					
					<div id="right-cont">
						<?php
							//prepare first SQL query, category_id not included
							$sql = "SELECT *
								FROM project_image_lookup, images
								WHERE project_image_lookup.proj_id = $proj_id
								AND project_image_lookup.img_id = images.img_id
								ORDER BY project_image_lookup.proj_id";
									
							//submit the SQL query to the database and get the result
							$result = $conn->query($sql) or die(mysqli_error());
					
				
							while ($row = $result->fetch_assoc()) {
								echo '<div class="thumb">
									<img src="../images/projects/'.$proj_name."/".$row['img_url'].'" height="100" />
										<h4><a href="proj_image_delete.php?img_id='.$row['img_id'].'">DELETE</a></h4>
									</div>';
										
							}
						?>
					</div>
			<?php dbClose($conn);?>	
		</div><!--END -->
	
</div><!--END OF Main-->

<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		
<?php include('../includes/adminfooter.php'); ?>
</body>
</html>
