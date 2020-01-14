<?php
//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","500"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;

//checks if the form has been submitted
 if(isset($_POST['submit'])) {
	$folder = "images/".$_POST['name'];
	mkdir($folder);
 
 foreach ($_FILES['image']['name'] as $key => $value) {
    
    echo $_FILES['image']['name']."<br />";
    echo "Key: $key; Value: $value<br />\n";

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
						echo '<h1>Copy unsuccessfull!</h1>';
						$errors=1;
					}
				}
			}
	}
 }
//If no errors registred, print the success message
 if(isset($_POST['submit']) && !$errors) {
 	$msg = "<h2>File Uploaded Successfully</h2>";
 }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/upload.css" />
<script language="javascript">
	fields = 0;
	function addInput() {
		if (fields != 20) {
			document.getElementById('text').innerHTML += "<label for='image'><span class='label'><p>Select Image:</p></span></label><input type='file' class='required' name='image[]' /><br />";
			fields += 1;
		} else {
			document.getElementById('text').innerHTML += "<br />Only 20 upload fields allowed.";
			document.form.add.disabled=true;
		}
	}
</script>


<style type="text/css">
</style>


<title>CJT <?php echo "&#8212;{$title}"; ?></title>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

        <!-- Start: header -->
       <div id="header">
	     <span id="logo"><h1>CJT MOUNTING</h1></span>
              <span class='slogan'><h1>Products For Real Life</h1></span>
               
	</div><!--End Header-->
<!-- Start: content -->
       <div id="content">
		
<?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo "<div id='msg'>$msg</div>";
        }else{
		echo "<h2>Upload your files</h2>";
	}
?>
				<form id="insert" name="insert" method="post" action="" enctype="multipart/form-data">    
					
					<label for="name">Name:</label>
					<input name="name" id="name" type="text" size="50" maxlength="50" class="required" />		    
					
					<label for="image"><span class="label"><p>Select Image:</p></span></label>
					<input type="file" name="image[]" id="image" class="required"/>
					
					<div id="text"></div>
					
					<input type="button" onclick="addInput()" name="add" value="Add input field" />
					
					<!--<label for="pdf"><span class="label"><p>Select PDF:</p></span></label>
					<input type="file" name="pdf" id="pdf" class="required"/>
					
					

					



					<label for="file"><span class="label"><p>Select File:</p></span></label>
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
					<input type="file" name="file" id="file" class=""/>
				 
					<label for="image_url">Image File Name (include extension):</label>
					<input name="image_url" id="image_url" type="text" size="50" maxlength="50" class="required"/>
					-->
					<input type="submit" name="submit" value="Submit Your Files" />
				</form>    
				<?php if(isset($conn)){ dbClose($conn);}?>

<!--END CONTENT-->					
			</div>  
		</div><!--END OF Main-->
	</div><!--END OF WRAP-->


</body>
</html>