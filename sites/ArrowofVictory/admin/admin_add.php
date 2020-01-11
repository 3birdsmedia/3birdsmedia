<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{ 





$conn = dbConnect('admin');

// define a constant for the maximum upload size
define ('MAX_FILE_SIZE', 5120000);

//Checking if there is an input in the form
	if (array_key_exists('insert', $_POST)) {
		
		//FLagg it up!
		$done = false;
		
		//create database connection ADMIN
		
		
		//create SQL 
		$sql =  'INSERT INTO riders (rider_name, rider_desc, rider_tweet)
				VALUES (?, ?, ?)';
		
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			
			$stmt->bind_param('sss', $_POST['riderName'], $_POST['riderDesc'], $_POST['riderTweet']);
			//$stmt->bind_param('ss', $_POST['crank_id'], $_POST['crank']);
			$done = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		}
		
		if ($done) {
			$riderName = $_POST['riderName'];
			$riderDesc = $_POST['riderDesc'];
			//MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
			$newAddedMsg = 'New RIDEr'.$riderName.'was added<br />'
			.$riderDesc.'</br>';
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST to check it
		//print_r($_POST);
			
			//exit;
		} else {
			echo $stmt->error;
		}
	
//UPLOAD IMAGE//
//if (array_key_exists('insert', $_POST)) {
	//nukeMagicQuotes();
	//initialize flags       
	$image_url = $_FILES['image']['name'];
	$OK = false;
	//connect to the database
	//$conn = dbConnect('admin');
	//prep the sql statement       
	$sql2 = 'INSERT INTO images (image_url)
	VALUES (?)';
	//initialize statement       
	$stmt = $conn->stmt_init();
	
	
	if ($stmt->prepare($sql2)) {
		//bind the perameters
		$stmt->bind_param('s', $image_url);
		$OK = $stmt->execute();
		//}
	
	define('UPLOAD_DIR', '../images/');
	// replace any spaces in original filename with underscores
	// at the same time, assign to a simpler variable
		$file = str_replace(' ', '_', $_FILES['image']['name']);
		
		// convert the maximum size to KB
		$max = number_format(MAX_FILE_SIZE/1024, 1).'KB';
		// create an array of permitted MIME types
		$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
		// begin by assuming the file is unacceptable
		$sizeOK = false;
		$typeOK = false;
 
	// check that file is within the permitted size
	if ($_FILES['image']['size'] > 0 && $_FILES['image']['size'] <= MAX_FILE_SIZE) {
		$sizeOK = true;
	}

	// check that file is of an permitted MIME type
	foreach ($permitted as $type) {
		if ($type == $_FILES['image']['type']) {
		$typeOK = true;
		break;
	}
    }
 
  if ($sizeOK && $typeOK) {
    switch($_FILES['image']['error']) {
      case 0:
        include('../includes/resize.php');
        break;
      case 3:
        $result = "Error uploading $file. Please try again.";
      default:
        $result = "System error uploading $file. Contact webmaster.";
      }
    }
  elseif ($_FILES['image']['error'] == 4) {
    $result = 'No file selected';
    }
  else {
    $result = "$file cannot be uploaded. Maximum size: $max. Acceptable file types: gif, jpg, png.";
    }
  }
}

	$sql2 = 'SELECT * FROM images
		ORDER BY img_id DESC
		LIMIT 1 ';
		
	$result2 = $conn->query($sql2) or die(mysqli_error());
	while($row2 = $result2->fetch_assoc()){
		$img_id = $row2['img_id'];	
	}
	
	
	$sql3 = 'SELECT * FROM riders
		ORDER BY rider_id DESC
		LIMIT 1 ';
		
	$result3 = $conn->query($sql3) or die(mysqli_error());
	while($row3 = $result3->fetch_assoc()){
		$rider_id = $row3['rider_id'];	
	}
	
	
	echo $img_id;
	echo $rider_id;
	
//Link the image and Tan You're It!r
	$sql4 = 'UPDATE riders
		SET rider_img = (?)
		WHERE rider_id = (?)';
			
	//initialize prepared statement
	$stmt1 = $conn->stmt_init();
	if ($stmt1->prepare($sql4)) {
			//bind parameters and execute statement
			//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
			$stmt1->bind_param('ii', $img_id, $rider_id);
			//$stmt->bind_param('ss', $_POST['crank_id'], $_POST['crank']);
			$stmt1->execute();
			// free the statement for the next query
	  		$stmt1->free_result();
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../images/favicon.ico" />

<link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>


<title>Tan You're It! <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
	    	<div id="main">
	        	<div id="header">
		            	<a href="index.php" id="logo"><h1>Tan You're It!</h1></a>
		        </div>
            
			<div id="cont">
				<h2>Input THE new RIDEr</h2>
<?php
	//if the form has been submitted, display result
        if (isset($result)) {
        echo "<p><strong>$result</strong></p>";
        }
?>
				<form id="insert" name="insert" method="post" action="" enctype="multipart/form-data">    
					
					<label for="riderName">RIDEr Name:</label>
					<input name="riderName" id="riderName" type="text" size="50" maxlength="50" class="required" />
					
					
					<label for="riderTweet">RIDEr tWEet(don't include @):</label>
					<input name="riderTweet" id="riderTweet" type="text" size="50" maxlength="50" class="required" />
					
					
					<label for="riderDesc">Tell ME about Tan You're It!er</label>
					<!--<input name="news_Text" id="news_Text" type="text" size="50" maxlenth="25000" style="overflow:scroll;" />-->
					<textarea cols="60" rows="25" name="riderDesc" id="riderDesc"></textarea>
					
				    
					<label for="image"><span class="label"><p>Upload image:</p></span></label>
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
					<input type="file" name="image" id="image" class="required"/>
					
				 
					<!--<label for="image_url">Image File Name (include extension):</label>
					<input name="image_url" id="image_url" type="text" size="50" maxlength="50" class="required"/>
					-->
					<input type="submit" name="insert" value="Add New Rider" />
				</form>    
				<?php dbClose($conn);?>

<!--END CONTENT-->					
			</div>  


<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>


		</div><!--END OF Main-->
	</div><!--END OF WRAP-->


	<div id="footer">
		        <?php include("includes/footer.php") ?>
		        <p>Copyright (c) <?php setCopyright (2010) ?></p>
	</div>

</body>
</html>