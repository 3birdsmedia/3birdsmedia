<?php
session_start();
ob_start();
include('includes/functions.php');


nukeMagicQuotes();
//If the form is submitted
if(isset($_POST['submit'])) {
			$errors=0;

			$name = $_POST['name'];
		    $message = $_POST['message'];
	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","25000"); 

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
 
if(isset($_FILES)){
	
	$folder = "testimonials/".$_POST['name'].date('r');
	mkdir($folder);
 
	foreach ($_FILES['file']['name'] as $key => $value) {
    
    echo $_FILES['file']['name']."<br />";
    echo "Key: $key; Value: $value<br />\n";

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
	}//end of for each
}else{
		$newname = '';
}
	




//If there is no error, send the email
if(!isset($hasError) && ($errors == '0')) {
		    $name = $_POST['name'];
		    $message = $_POST['message'];
echo "NEW NAME = $newname";			
		$conn = dbConnect('admin');
		
		//create SQL -we are setting up a prepared statement
		$sql = "INSERT INTO testimonials (test_name, test_body, img_url, approved, sort)
				VALUES (?, ?, ?, 1, 0)";
				
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
			$stmt->bind_param('sss', $name, $message, $newname);
			$OK = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		
		$to = "mike@designpros-inc.com";
		$subject = "You have a new testimonial to approve";
		$headers = "";
		$headers .= "CC: marco.segura@live.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		    $msg = 	"Name:".$name.
					"\n Message:".$message.
					"\n <br /> To approve this testimonial go to your <a href='3birdsmedia.com/DigiPrint/admin'>Control Panel</a>";
				    
		    
		    // send it
		    $mailSent = mail($to, $subject, $msg, $headers);
		    $emailSent = true;
			
		$totester = "marco.segura@live.com";
		$mailSent = mail($totester, $subject, $msg, $headers);
		$emailSent = true;
	}

}
//}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
function addEvent() {
  var ni = document.getElementById('myDiv');
  alert(ni);
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


$(document).ready(function(){
	$("#testForm").validate();
});
</script>

<title>DigiPrint Products Corp. <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>DigiPrint Products Corp.</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->
	    
	    <div class="cont">
        <div class="module" id="testimonials">
      <?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM testimonials
				WHERE approved = 1
				ORDER BY sort DESC";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		
		while ($row = $result->fetch_assoc()){
		
				$title = $row['test_name'];
				$body = stripslashes(nl2br($row['test_body']));
				
				echo "<div class='testimonial'><h3>".$title."</h3>";
				echo "<div id='bodyText'>";
				if($row['img_url'] !== ''){
						 if($row['img_url'] !== NULL){
								echo "<img src='".$row['img_url']."' title='testimonial' width='480' />";
							}
				}
				echo $body."</div></div><br/><br/>";
		}
	?>
		</div>
        <div class="module" id="test_form">
        
        		
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
              <form action="" method="post" id='testForm' name='testForm' enctype="multipart/form-data" >
                <p><label>Name:</label>
                  <input type="text" id="name" name="name" class='required' value="<?php if(isset($first)){echo $first;}else{ echo "Optional";} ?>" onfocus="this.value = ''"/></p>
                  
                <p><label>*Comment:</label>
                  <textarea type="text" class='required' id="message" name="message"></textarea></p>
                
				<p><label for="file"><span class="label"><p>Select File:</p></span></label>
					<input type="file" name="file[]" id="file" />
                
                <p><input type="submit" value="Send Request" id="submit" name="submit" value="" /></p>
                </form>
            
		<?php }elseif(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p class="confirm"><strong>Your testimonial was submitted!</strong></p>
			<p>One of our representatives will review your comment. If approved your comment will not be edited and will be used as is.</p><br />
			
		<?php }Else{ ?>


            <form action="" method="post" id='testForm' name='testForm' enctype="multipart/form-data">
                <p><label>Name:</label>
                  <input type="text" id="name" name="name" class='required' value="<?php if(isset($first)){echo $first;}else{ echo "Anonymous";} ?>" onfocus="this.value = ''"/></p>
                  
                <p><label>*Comment:</label>
                  <textarea type="text" class='required' id="message" name="message"></textarea></p>
                  
                <p><label for="file"><span class="label"><p>Select Image:</p></span></label>
					<input type="file" name="file[]" id="file" />	
                
                <p><input type="submit" value="Submit Testimonials" id="submit" name="submit" value="" /></p>
                
                </form>
		<?php } ?>
        
        </div>
	</div><!--END OF CONT-->
	</div><!--END OF CONT-->
		
		
		<?php
		    if (isset($_SESSION['cart'])) {
			    include('includes/displayCart.php');
		    }
	    
		 ?>

	    <?php include('includes/navBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>