<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");



if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{

//print_r($_POST);	
	
nukeMagicQuotes();
unset($_SESSION['batch']);
		$conn = dbConnect('admin');
		
		//define a maxim size for the uploaded images in Kb
							//100 = 1mb aprox
		//print_r ($_FILES);
	if(isset($_POST['submit'])) {
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
				$done = false;
				$price = str_replace('$', '', $_POST['price']);		
				//create database connection ADMIN		
				//create SQL 
				$sql =  'INSERT INTO products (prod_name, price, prod_desc, disks)
						VALUES (?, ?, ?, ?)';
				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				if ($stmt->prepare($sql)) {
					//bind parameters and execute statement
					
					$stmt->bind_param('sisi', $_POST['prod_name'], $price, $_POST['prod_desc'], $_POST['disks']);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();
				}
				
				if ($done) {
					$prod_name = $_POST['prod_name'];
					$price = $_POST['price'];
					$prod_desc = $_POST['prod_desc'];
					//MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
					$newAddedMsg = $prod_name.'has been created<br />';
				//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
				//for troublshooting: print out each item from the $_POST to check it
				//print_r($_POST);
					
					//exit;
				} else {
					echo $stmt->error;
				}
			
				$sql2 = 'SELECT * FROM products
				ORDER BY prod_id DESC
				LIMIT 1 ';
				
				$result2 = $conn->query($sql2) or die(mysqli_error());
				while($row2 = $result2->fetch_assoc()){
					$prod_id = $row2['prod_id'];	
				}
			
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
							$image_name= $_FILES['image']['name'];
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
	if (isset($_POST['chain'])){	
		foreach ($_POST['chain'] as $key => $value) {
			echo '<br />key'.$key;
			echo $value.' value';
			$chainSql = 'INSERT INTO prod_chain_lookup (prod_id, chain_id)
						VALUES (?,?)';
				
				//initialize statement       
				$stmt = $conn->stmt_init();
					
				if ($stmt->prepare($chainSql)) {
				//bind the perameters
				$stmt->bind_param('ii', $prod_id, $value);
				$OK = $stmt->execute();
				echo "inserted";
				}	
		}
	}
	//print_r ($_SESSION['batch']);
		if(isset($_POST['submit']) && !$errors) {
		
		echo $prod_id;
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
<title>Add a new product</title>
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
		echo "<h2>Add a new product</h2>";
	}
?>
<form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
					<p><label for="prod_name">Name:</label></p>
					<p><input name="prod_name" id="prod_name" type="text" size="50" maxlength="50" class="required" /></p>
					
					
<!-- dynamically build the drop down list for categories-->
					<?php						
						$sql = "SELECT * FROM categories";  //select only those fields we need
					
						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
					?>
					<label for="cat_id">Select a category for the product</label>
					<select name="cat_id" id="cat_id">
           			 <?php
					while ($row = $result->fetch_assoc()) {
						if ($cat_id == $row['cat_id']) {
							echo  '<option selected value="'.$row['cat_id'] .'">' . ucfirst($row['cat_name']) .'</option>';
						}else{
							echo '<option value="'.$row['cat_id'] .'">' . ucfirst($row['cat_name']) .'</option>';
						}
					}	//now that we are finished with the resuls set, release the db resources to allow a new query.
					$result->free_result();
				?>
					</select></p>
					
					<p><label for="price">Price: <span style="font-style:italic;font-size:12px;">(numeric value only i.e. '60.66')</span></label></p>
					<p><input name="price" id="price" type="text" size="50" maxlength="6" class="required" />	
                    </p>
					<label>Select what chain lengths apply to this product</label>
					<?php
						$chainSql = "SELECT * FROM chains";
						$resultChain = $conn->query($chainSql) or die(mysqli_error());
					while ($row = $resultChain->fetch_assoc()) {
						echo '<label class="checkLabel">'.$row['length'].'</label><input class="check" type="checkbox" value="'.$row['chain_id'].'" name="chain[]"/>';
					}	
						
					
					?>
					
					
									
					<p><label for="prod_desc">Describe the product:</label></p>
					<p><textarea cols="60" rows="25" name="prod_desc" id="prod_desc" class="required"></textarea>    
					</p>
					
					
					<p><label for="price">Can you upgrade the disks?:</label></p>
					<p><select name="disks" id="disks">
						<option value="1"> YES </option>
						<option value="0"> NO </option>
					</select>
					
			<p>
			<label for='image'><span class='label'><p>Select Image(s):</p></span></label>
					<input type="file" name="image[]" id="image" class="required"/>
					
					<div id="myDiv"> </div>
					
					<input type="hidden" value="0" id="theValue" />
					<input type="button" onclick="addEvent();" value="Add another image field" id="extra" />
			
			<p>
				<input class="submit" type="submit" name="submit" value="Add the new product" />
			</p>
						
				    
				<?php dbClose($conn);?>

<!--END CONTENT-->		
  
</form>
</div>
            
</body>
</html>
