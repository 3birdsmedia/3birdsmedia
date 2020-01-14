<?php
//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","5000"); 

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
	if($_POST['name'] == ''){
		$msg = 'We need your name to be able to refernece the files, please fill out your Name';
		$errors = 1;
	}else{
	$folder = "images/".$_POST['name'];
	mkdir($folder);
 
		 foreach ($_FILES['image']['name'] as $key => $value) {
    
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
						echo '<h2>Copy unsuccessfull!</h2>';
						$errors=1;
					}
				}
			}
	}
	
foreach ($_FILES['file']['name'] as $key => $value) {
    
    //echo $_FILES['file']['name']."<br />";
    //echo "Key: $key; Value: $value<br />\n";

			//reads the name of the file the user submitted for uploading
			$file= $value;
				//if it is not empty
			if ($file) {
			//get the original name of the file from the clients machine
				$filename = stripslashes($file);
			//get the extension of the file in a lower case format
				$extension = strtolower(getExtension($filename));
			//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
			//otherwise we will do more tests
				//get the size of the image in bytes
				 //$_FILES['image']['tmp_name'] is the temporary filename of the file
				 //in which the uploaded file was stored on the server
				 $size=filesize($_FILES['file']['tmp_name'][$key]);
		
					//compare the size with the maxim size we defined and print error if bigger
					if ($size > MAX_SIZE*1024){
						$msg = '<h2>Please use a smaller File</h2>';
						$errors=1;
					}
		
					//we will give an unique name, for example the time in unix time format
					$file_name= $value;
					//the new name will be containing the full path where will be stored (images folder)
					$newname= $folder."/".$file_name;
					//we verify if the image has been uploaded, and print error instead
					$copied = copy($_FILES['file']['tmp_name'][$key], $newname);
					if (!$copied) {
						echo '<h2>Copy unsuccessfull!</h2>';
						$errors=1;
					}
				}
			}
	}
	
 }
//If no errors registred, print the success message
 if(isset($_POST['submit']) && !$errors) {
	$to = "info@cjtmounting.com";
	$subject = "New Upload from".$_POST['name']."";
	$link = 'The new upload is located in '.$folder.'';	    
		    // send it
		    $mailSent = mail($to, $subject, $link);
 	$msg = "<h2>File Uploaded Successfully</h2>";
 }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/popUp.css" />
<script language="javascript">
function addEvent() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById("theValue").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
  newdiv.innerHTML = "<label for='image'><span class='label'><p>Select Image:</p></span></label><input type='file' name='image[]' id='image' class='required' /><input type='button' id='remove' onclick=\"removeElement(\'"+divIdName+"\')\" value='Remove' />";
  ni.appendChild(newdiv);
}


function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

function addEventFile() {
  var ni = document.getElementById('myfileDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById("theValue").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
  newdiv.innerHTML = "<label for='file'><span class='label'><p>Select File:</p></span></label><input type='file' name='file[]' id='file' class='required' /><input type='button' id='remove' onclick=\"removeElementFile(\'"+divIdName+"\')\" value='Remove this field' />";
  ni.appendChild(newdiv);
}


function removeElementFile(divNum) {
  var d = document.getElementById('myfileDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
</script>


<style type="text/css">
#popcontent {
	  width: 730px !important;
}
</style>


<title>CJT - Image Upload</title>
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
       <div id="popcontent">
		
<?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo "<div id='msg'>$msg</div>";
        }else{
		echo "<h2>Upload your files</h2>";
	}
?>
       <div id="bodyCont">
       <p>To upload your files simply click on the "Browse" button to look for the files in your computer.
       The Column on the LEFT is for IMAGES, the column on the RIGHT is for FILES. To add more than one image,
       click on the "Add another image" button, for files use the "Add another file" button. If you wish to remove an image from the queue,
       simply click on the "Remove" button, next to the desired field.</p>
       
       <p>The maximum file size accepted is 5 megabytes <span style="font-style:italic;">(5000 kilobytes)</span>.
       If your images are too big, you may try using <a href="http://www.smushit.com/ysmush.it/">Yahoo's Smush it Tool</a> which allows you to compress multiple pictures
       at one time. For PDF's you may choose "Compression" under the saving options, and select "Compress for faster web viewing".
       </p>
       
       </div>
				<form id="insert" name="insert" method="post" action="" enctype="multipart/form-data">    
				<div id="left">
					<label for="name">Name:</label>
					<input name="name" id="name" type="text" size="50" maxlength="50" class="required" />		    
					
					<label for="image"><span class="label"><p>Select Image:</p></span></label>
					<input type="file" name="image[]" id="image" class="required"/>
					
					<div id="myDiv"> </div>
					
					<input type="hidden" value="0" id="theValue" />
					<input type="button" onclick="addEvent();" value="Add another image" id="extra" />
				</div>
				<div id="right">
					<label for="file"><span class="label"><p>Select File:</p></span></label>
					<input type="file" name="file[]" id="file" class="required"/>
					
					<div id="myfileDiv"> </div>
					
					<input type="hidden" value="0" id="theValue" />
					<input type="button" onclick="addEventFile();" value="Add another file" id="extra" />
					
				</div>
					
					<input type="submit" name="submit" id="submit" value="Send us your files" />
				</form>    
				<?php if(isset($conn)){ dbClose($conn);}?>

<!--END CONTENT-->					
			</div>  
		</div><!--END OF Main-->
	</div><!--END OF WRAP-->


</body>
</html>