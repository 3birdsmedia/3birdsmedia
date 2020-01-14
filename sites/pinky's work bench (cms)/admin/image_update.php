<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{
	if ( isset($_GET['img_id']) && is_numeric($_GET['img_id']) ) {
		  
		  //set the variable so it's easier to use later in script
		  $img_id = $_GET['img_id']; //for troubleshooting
	} else {
		  $img_id = 0;
		  $msg = "There seems to be a problem, please <a href='home_list.php'> GO BACK </a> and try again.";
	}
	$conn = dbConnect('query');
			
			//prepare first SQL query, category_id not included
			$sql = "SELECT * FROM images
				WHERE images.img_id = ?";
					
			//initialize statement
			$stmt = $conn->stmt_init();
			if ($stmt->prepare($sql)) {
				//bind the query parameters
				$stmt->bind_param('i', $img_id);
				
				//bind the results to variables
				$stmt->bind_result($img_id, $img_name, $img_url);
				
				//execute the query, and get the result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
			}
			
	dbClose($conn);
			
	
	
//START THE LOOP FOR UPDATE!
		$conn = dbConnect('admin');
		
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
		//and it will be changed to 1 if an errro occures.  
		//If the error occures the file will not be uploaded.
		 $errors=0;
		 

		//checks if the form has been submitted
		 if(isset($_POST['submit'])) {
			$img_id = $_POST['img_id'];
			$img_name = $_POST['img_name'];
			$img_url = $_POST['img_url'];
				
			
			if (isset($_POST['oldImg'])){
					$image = $_POST['oldImg'];
					$filename = $_POST['oldImg'];
			}else{
				//UPLOAD IMAGE//
					// remove the image and the thumbnail from the server
					unlink('../images/'.$_POST['img_delete']);
				
					//reads the name of the file the user submitted for uploading
					$image= $_FILES['image']['name'];
						//if it is not empty
					if ($image) {
						
						//get the original name of the file from the clients machine
						$filename = stripslashes($image);
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
								 $size=filesize($_FILES['image']['tmp_name']);
						
									//compare the size with the maxim size we defined and print error if bigger
											if ($size > MAX_SIZE*1024){
												$msg = '<h2>Please use a smaller image</h2>';
												$errors=1;
											}
																									//we will give an unique name, for example the time in unix time format
											$image_name= $_FILES['image']['name'];
											//the new name will be containing the full path where will be stored (images folder)
											$newname= '../images/'.$image_name;
											//we verify if the image has been uploaded, and print error instead
											$copied = copy($_FILES['image']['tmp_name'], $newname);
											if (!$copied) {
												$msg = '<h1>Copy unsuccessfull!</h1>';
												$errors=1;
											}
								}

	
					 //prep the sql statement       
					$sql4 = 'UPDATE images
						SET img_url = ?, img_name = ?
						WHERE img_id = ?';
							
						//initialize prepared statement
						$stmt = $conn->stmt_init();
						if ($stmt->prepare($sql4)) {
							//bind parameters and execute statement
							
							$stmt->bind_param('ssi', $image, $filename, $img_id);
							$done = $stmt->execute();
							// free the statement for the next query
							$stmt->free_result();
					}
					
					}			
						//If no errors registred, print the success message
				 
						$folder = '../images/';
						$orig_w = 400;
					
					
						$imageFile = $_FILES['image']['tmp_name'];
						$filename = basename( $_FILES['image']['name']);
						
						list($width, $height) = getimagesize($imageFile);
						
						$src = imagecreatefromjpeg($imageFile);
						$orig_h = ($height/$width)* $orig_w;
						
						$tmp = imagecreatetruecolor($orig_w, $orig_h);
						imagecopyresampled($tmp, $src, 0,0,0,0,$orig_w,$orig_h,$width,$height);
						imagejpeg($tmp, $folder.$filename,100);
						
						imagedestroy($tmp);
						imagedestroy($src);
						
						$filename = urlencode($filename);
						header( 'Location: crop_head.php?filename='.$filename.'&height='.$orig_h.'&cat='.ucfirst($cat_name).'');

			}
		}
		//If no errors registred, print the success message
		 if(isset($_POST['submit']) && !$errors) {
			$msg = "<h2>The New picture was saved!</h2>
			<h3>Go Back to the <a href='admin.php'>Control Panel</a> or the <a href='home_list.php'>Home update page</a><h3>";
		 }
		
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
<title>Update Your Headshot</title>
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
		echo "<h2>Update your Headshot</h2>";
	}
?>
    <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
				<?php if (isset($img_url)){echo "<label for='image'>Use this image:</label><input type='checkbox' id='oldImg' name='oldImg' value='$img_url' /><img src='../images/$img_url' />";} ?>
					
					<p><label for="image"><span class="label"><p>Or Upload a new image:</span></label></p>
					<p><input type="file" name="image" id="image" class="required" value='<?php if (isset($img_url)){echo $img_url;} ?>' />
					</p>
					<input type="hidden" id="img_id" name="img_id" value="<?php if (isset($img_id)){echo $img_id;} ?>" />
					<input type="hidden" id="img_delete" name="img_delete" value="<?php if (isset($img_url)){echo $img_url;} ?>" />
					<input type="hidden" id="img_name" name="img_name" value="<?php if (isset($img_name)){echo $img_name;} ?>" />
					<input type="hidden" id="img_url" name="img_url" value="<?php if (isset($img_url)){echo $img_url;} ?>" />
					<p><input class="submit" id="submit" type="submit" name="submit" value="Save Changes" /></p>
				</form> 
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
