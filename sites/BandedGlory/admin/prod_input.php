<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");
if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}else{
//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  

//and it will be changed to 1 if an errro occures.  

//If the error occures the file will not be uploaded.
$errors=0;

//checks if the form has been submitted
//print_r($_POST);
 if(isset($_POST['submit'])) {
//print_r($_FILES);

$msg = '';
   if(trim($_POST['prod_name']) == ''){
      $msg = 'Please enter a product name<br />';
      $errors = 1;
   }
   if(trim($_POST['prod_number']) == '')
   {
      $msg = $msg.'Please enter a number for the product<br />';
	$errors = 1;
   }
   if(trim($_POST['prod_desc']) == '')
   {
      $msg = $msg.'Please enter a description<br />';
	$errors = 1;
   }elseif($errors == 0){
			
	nukeMagicQuotes();
	unset($_SESSION['batch']);
		
	//define a maxim size for the uploaded images in Kb
	//100 = 1mb aprox
	
	//print_r ($_FILES);
	if(isset($_POST['submit'])) {
	define ("MAX_SIZE","5000");
				 
	$errors = 0;
	
	$msg = '';
        
	foreach ($_POST as $key => $value) {
	if ($value == "") {$value = "Not Specified";}
	$msg =   $msg.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';
	
	
	}			
	//FLagg it up!
	$done = false;
	//create database connection ADMIN		
	$conn = dbConnect('admin');
	
	//create SQL 
	$sql =  'INSERT INTO products (prod_name, prod_number, min_qty, price, price_per, prod_desc, custom)
	            VALUES (?, ?, ?, ?, ?, ?, ?)';
					
	//initialize prepared statement
	$stmt = $conn->stmt_init();
	if ($stmt->prepare($sql)) {			
	//bind parameters and execute statement
	$stmt->bind_param('ssiissi', $_POST['prod_name'], $_POST['prod_number'], $_POST['min_qty'], $_POST['price'], $_POST['price_per'], $_POST['prod_desc'], $_POST['custom']);
	$done = $stmt->execute();
	// free the statement for the next query
	$stmt->free_result();
	$done = true;
                }

                if (isset($_POST['cat'])) {
		        $sql =  'INSERT INTO categories (category, cat_desc)
		        VALUES (?, ?)';
	
		        //initialize prepared statement
		        $stmt = $conn->stmt_init();
	
		        if ($stmt->prepare($sql)) {			
		        //bind parameters and execute statement
		        $stmt->bind_param('ss', $_POST['cat'], $_POST['cat_desc']);
		        $done = $stmt->execute();
		        // free the statement for the next query
		        $stmt->free_result();
        		$done = true;

		}else {
		        echo $stmt->error;
		}		
			
		if ($done) {
		                $prod_name = $_POST['prod_name'];
		                $prod_desc = $_POST['prod_desc'];	
		                $prod_number = $_POST['prod_number'];	
		                //MAKE A MESSAGE WITH THE DATA THAT WAS 'INPUTED'
		                $newAddedMsg = $prod_name.'has been created<br />
		                <p>Desc: '.$prod_desc.'</p>
		                <p>Product number: '.$prod_number.'</p>';
		                
		                //MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		                //for troublshooting: print out each item from the $_POST to check it
		                			
		                //print_r($_POST);
		      
		} else {
		        echo $stmt->error;
		}
	            }
		
                $sql2 = 'SELECT * FROM products
                	ORDER BY prod_id DESC
	LIMIT 1 ';
				
                //echo '<h1>'.$newAddedMsg.'</h1>';
                			
                $result2 = $conn->query($sql2) or die(mysqli_error());
                while($row2 = $result2->fetch_assoc()){
                $prod_id = $row2['prod_id'];
                
                if (isset($_POST['cat'])){
                		$sql4 = 'SELECT cat_id 
		FROM categories
		ORDER BY cat_id DESC
		LIMIT 1';
	
		$result4 = $conn->query($sql4) or die(mysqli_error());
                	
		while($row4 = $result4->fetch_assoc()){
		        $cat_id = $row4['cat_id'];	
		}
                }else{
	    $cat_id = $_POST['cat_id'];							}
	    
	    if(isset($_POST['inventory'])){
	            $inventory = $_POST['inventory'];
	    }else{
	            $inventory = 0;
	    }
                
                $sql6 = 'INSERT INTO lookup_cat_prod_inv (cat_id, prod_id, inventory)
                	VALUES (?,?,?)';
                					
                //initialize statement       
                $stmt = $conn->stmt_init();
		
                if ($stmt->prepare($sql6)) {
	            //bind the perameters
	            $stmt->bind_param('iii', $cat_id, $prod_id, $inventory);
	            $OK = $stmt->execute();
                }else{
	            echo $stmt->error;
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
	    }////////// END OF FOREACH
	
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
	    
                $sql5 = 'INSERT INTO lookup_prod_img (prod_id, img_id)
	    VALUES (?,?)';
		    
	    //initialize statement       
	    $stmt1 = $conn->stmt_init();
   
	    if ($stmt1->prepare($sql5)) {
		    //bind the perameters
		    $stmt1->bind_param('ii', $prod_id, $img_id);
		        $OK = $stmt1->execute();
	    }else {
		    echo $stmt1->error;
	    }
	    
	    
	    $folder = "../images/products/";
	    $orig_w = 450;
		    
			    
	    $imageFile = $_FILES['image']['tmp_name'][$key];
		    $filename = basename( $_FILES['image']['name'][$key]);
			    
		    list($width, $height) = getimagesize($imageFile);
/*		
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
			}*/
		        }////////////////WHILE END
		}
	            dbClose($conn);		
	    }////////POST LOOP
                }//SESSION LOOP

        }
}
//print_r ($_SESSION['batch']);
if(isset($_POST['submit']) && !$errors) {
			//echo $prod_id;
			//header( 'Location: crop.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <title>SA RECYCLING Control Panel</title>
 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds." />
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
 <meta name="description" content="Add your sites description here" />
 <meta name="keywords" content="Add,your,site,keywords,here" />
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
  <script type="text/javascript" src="../js/jquery.js"></script>
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
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">
   
	   <!-- Start: container -->
	      <div id="container">
	   
	   
		 <!-- Start: header -->
		      <div id="header">
			     <a href="admin.php"><h1><span>SA Recycling</span></h1></a>
		     </div><!-- End: header -->	  	   
		 
	   <!-- Start: content -->
	   <div id="content">
									<span class="logout"><a href="logout.php">Logout</a></span>
		   <div id="lef-cont">
			<a href='admin.php'>Go back to your Control Panel</a>
			
			
				<?php
						//if the form has been submitted, display result
					    if (isset($msg)) {
									echo "<div id='msg'><p>$msg</p></div>";
						}else{
										echo "<h2>Add a new product</h2>
												<p>Here you can add new products to the list.
												You can add categories here too, to edit categories 
												do so <a href='cat_add.php'>here</a>.</p>";
							}
				?>  
	
			</div>
	    
		<div id="right-cont">
		    
					 <form id="insert" name="insert" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">    
						</p>
					<?php
					
						$conn = dbConnect('query');
						$sql = "SELECT * FROM categories";  //select only those fields we need
					
						//submit the SQL query to the database and get the result
						$result = $conn->query($sql) or die(mysqli_error());
					?>
					
					
					<label for="cat_id">Select which category the product belongs to:</label>
					<select name="cat_id" id="cat_id">
           			 <?php
					while ($row = $result->fetch_assoc()) {
							echo  '<option '; if (isset($cat_id) && $cat_id == $row['cat_id']) {echo 'selected';}else{}
							echo  ' value="'.$row['cat_id'] .'">' . ucfirst($row['category']) .'</option>';
					}	//now that we are finished with the resuls set, release the db resources to allow a new query.
					$result->free_result();
				?>
					</select></p>
					
					<p><label for="prod_name">Name:</label></p>
					<p><input name="prod_name" id="prod_name" type="text" size="50" maxlength="50" class="required" value="<?php prefill('prod_name'); ?>" /></p>
					
					<p><label for="prod_number">Product number:</label></p>
					<p><input name="prod_number" id="prod_number" type="text" size="50" maxlength="50" class="required" value="<?php prefill('prod_number'); ?>" /></p>

					<p><label for="min_qty">Minimum Quantity:</label></p>
					<p><input name="min_qty" id="min_qty" type="text" size="50" maxlength="50" value="<?php prefill('min_qty'); ?>" /></p>

					<p><label for="price">Price:</label></p>
					<p><input name="price" id="price" type="text" size="50" maxlength="50" class="required" value="<?php prefill('price'); ?>" />
					
					<select name="price_per" id="price_per" class="required" >
           			 	<?php
					if (isset($price_per)) {
							echo  '<option selected value="'.$price_per.'">' .$price_per.'</option>';
						}else{}
					?>
					<option value="EA">EA</option>
					<option value="CT">CT</option>
					<option value="PK">PK</option>
					</select>
					</p>
                    			
					<p><label for="inventory">Inventory:</label></p>
					<p><input name="inventory" id="inventory" type="text" size="50" maxlength="50" value="<?php prefill('inventory'); ?>" /></p>					
					
					<p><label for="prod_desc">Describe the product:</label></p>
					<p><textarea cols="45" rows="10" name="prod_desc" id="prod_desc" class="required"><?php prefill('prod_desc');?></textarea>    
					</p>
					
					<p><label for="custom">Does the product have an address printed on it:</label>
					<select name="custom" id="custom" class="required" >
           			 	<?php
					if (isset($custom) && $custom == 0) {
							echo  '<option selected value="'.$custom.'">NO</option>';
						}elseif (isset($custom) && $custom == 1){
							echo  '<option selected value="'.$custom.'">YES</option>';
						}else{}
					?>
					<option value="0">NO</option>
					<option value="1">YES</option>
					
					</select></p>
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

			  
			</form>
		</div><!-- End: right cont-->
	   <!-- Start: navigation -->


	      <div id="push"></div><!-- End: push -->
	      </div><!-- End: container -->
	</div><!-- End: Center Wrap -->
</div><!-- End: Center Wrap -->
	   
	   <!-- Start: footer -->
		 <div id="footer">
		 </div><!-- End: footer -->
</body>
</html