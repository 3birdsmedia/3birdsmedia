<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page

include('../includes/functions.php');


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{
nukeMagicQuotes();
	if (isset($_GET['prod_id']) && !$_POST) {
			$conn = dbConnect('query');
			$prod_id = $_GET['prod_id'];
			
			
			
} //end of if isset() for $_GET
unset($_SESSION['batch']);
		$conn = dbConnect('admin');
		
		//define a maxim size for the uploaded images in Kb
							//100 = 1mb aprox
		//print_r ($_FILES);
	if(isset($_POST['submit'])) {
		
		$prod_id = $_POST['prod_id'];
			 define ("MAX_SIZE","5000");
			 //This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
			function getExtension($str) {
				 $i = strrpos($str,".");
				 if (!$i) { return ""; }
				 $l = strlen($str) - $i;
				 $ext = substr($str,$i+1,$l);
				 return $ext;
			}
			 
			$errors = 0;
			//FLagg it up!
			
			
//UPLOAD IMAGE//
				
		foreach ($_FILES['image']['name'] as $key => $value) {
					 
				//echo $_FILES['image']['name']."<br />";
				 //echo "Key: $key; Value: $value<br />\n";
						
			//reads the name of the file the user submitted for uploading
			$image= $value;			
				if ($image) {
				//get the original name of the file from the clients machine
				$filename = $image;
				
				
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
							$date = date('B');
							$image_name= $_FILES['image']['name'].$date;
							//the new name will be containing the full path where will be stored (images folder)
							$newname= '../images/products/'.$image_name;
							//we verify if the image has been uploaded, and print error instead
							$copied = copy($_FILES['image']['tmp_name'][$key], $newname);
							
							if (!$copied) {
									$msg = '<h1>Copy unsuccessfull!</h1>';
									$errors=1;
							}
						}
				}
				
				 //prep the sql statement       
				$sql3 = 'INSERT INTO images (img_url, img_name)
				VALUES (?,?)';
				//initialize statement       
				$stmt = $conn->stmt_init();
				
				if ($stmt->prepare($sql3)) {
				//bind the perameters
				$stmt->bind_param('ss', $image, $filename);
				$OK = $stmt->execute();
				}
				
				$sql4 = 'SELECT img_id 
						FROM images
						ORDER BY img_id DESC
						LIMIT 1';
	echo "<H2>ERROR</h2>";					
				$result4 = $conn->query($sql4) or die(mysqli_error());
				while($row4 = $result4->fetch_assoc()){
									$img_id = $row4['img_id'];	
				}
				$sql5 = 'INSERT INTO prod_img_lookup (prod_id, img_id)
						VALUES (?,?)';
				
				//initialize statement       
				$stmt = $conn->stmt_init();
					
				if ($stmt->prepare($sql5)) {
				//bind the perameters
				$stmt->bind_param('ii', $prod_id, $img_id);
				$OK = $stmt->execute();
				}
				
				$sql6 = 'INSERT INTO prod_cat_lookup (prod_id, cat_id)
						VALUES (?,?)';
				
				//initialize statement       
				$stmt = $conn->stmt_init();
					
				if ($stmt->prepare($sql6)) {
				//bind the perameters
				$stmt->bind_param('ii', $prod_id, $_POST['cat_id']);
				$OK = $stmt->execute();
				
				}
				
			
				
			//If no errors registred, print the success message
			$folder = "../images/products/";
			$orig_w = 450;
				
					
			$imageFile = $_FILES['image']['tmp_name'][$key];
				$filename = basename( $_FILES['image']['name'][$key]);
					
				list($width, $height) = getimagesize($imageFile);
					
				$src = imagecreatefromjpeg($imageFile);
				$orig_h = ($height/$width)* $orig_w;
				
				$tmp = imagecreatetruecolor($orig_w, $orig_h);
				imagecopyresampled($tmp, $src, 0,0,0,0,$orig_w,$orig_h,$width,$height);
				imagejpeg($tmp, $folder.$filename,100);
					
				imagedestroy($tmp);
				imagedestroy($src);
					
				$filename = urlencode($filename);
				if (!isset($_SESSION['batch'])){
					$_SESSION['batch']['name'] = array();
					$_SESSION['batch']['height'] = array();
					array_push($_SESSION['batch']['name'], $filename);
					array_push($_SESSION['batch']['height'], $orig_h);
				 }else{
				    array_push($_SESSION['batch']['name'], $filename);
				    array_push($_SESSION['batch']['height'], $orig_h);
				}
				
		}			
			print_r ($_SESSION['batch']);
		if(isset($_POST['submit']) && !$errors) {
				header( 'Location: crop.php');
		}
	}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="../js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#insert").validate();
});

function addEvent() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById("theValue").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
  newdiv.innerHTML = "<input type='file' name='image[]' id='image' class='required' /><input type='button' id='remove' onclick=\"removeElement(\'"+divIdName+"\')\" value='Remove this Image' />";
  ni.appendChild(newdiv);
}


function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
</script>
<title>Update </title>
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
		echo "<h2>Update Images</h2>";
	}
?>

	
	<?php
			//prepare first SQL query, category_id not included
			$sql = "SELECT *
				FROM prod_img_lookup, images
				WHERE prod_img_lookup.prod_id = $prod_id
				AND prod_img_lookup.img_id = images.img_id
				ORDER BY prod_img_lookup.prod_id";
					
			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
	

			while ($row = $result->fetch_assoc()) {
				echo '<div class="product"><div class="boxes">
						<img src="../images/products/'.$row['img_url'].'" width="150"/>
						<a href="prod_image_delete.php?img_id='.$row['img_id'].'" class="style9">DELETE</a>
					</div> </div>';
			} ?>
   
				
	<form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
			<label for='image'><span class='label'><p>Select Image(s):</p></span></label>
					<input type="file" name="image[]" id="image" class="required"/>
					
					<div id="myDiv"> </div>
					
					<input type="hidden" value="0" id="theValue" />
					<input type="button" onclick="addEvent();" value="Add another image field" id="extra" />
			
			<p>
				<input type="hidden" value="<?php echo $prod_id; ?>" id="prod_id" name="prod_id" />
				<input class="submit" type="submit" name="submit" value="Add the new picture" />
			</p>
						

				
				    
				<?php dbClose($conn);?>
				
				
				

<!--END CONTENT-->		
  

         </div>   
</body>
</html>
