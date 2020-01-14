<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}
	
	

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['emailAdress']) == '')  {
		$hasError = true;
	} else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['emailAdress']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['emailAdress']);
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

	//If there is no error, send the email
	if(!isset($hasError)) {
		$to = "marco.segura@live.com";
		$subject = "Test";

		    $name = $_POST['name'];
		    $phone = $_POST['phone'];
		    $emailAdress = $_POST['emailAdress'];
		    $message = $_POST['message'];
		    $msg = 		"Name:".$name.
					"\n Contact Phone:".$phone.
					"\n Email Address:".$emailAdress.
					"\n Message:".$message;
				    
		    
		    // send it
		    $mailSent = mail($to, $subject, $msg);
		    $emailSent = true;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds." />
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Will's Vision</title>
 <meta name="description" content="Will Grant's Portfolio" />
 <meta name="keywords" content="graphic, photo, design,eclipse, vision" />
  <link rel="stylesheet" type="text/css" href="css/bottom.css" media="screen" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />  
 
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
   <script type="text/javascript" src="js/jquery.pikachoose.full.js"></script>
        <script>
	  $(document).ready(function (){
					$("#gallery").PikaChoose({});
				});

        </script>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

<!-- Start: left-cont -->
<div id="left-cont">
	<div id="logo"><span><h1>Wills Vision</h1></span></div>
</div><!-- End: left-cont -->


<!-- Start: right-cont -->
<div id="right-cont">
 <div>

	    <div id='contactDiv'>
		
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />
			
		<?php } ?>

		
	

		    <form action="" method="post" id='contactForm' name='contactForm'>
			<p><label>*Name:</label></p>
	                     <p><input type="text" id="name" name="name" class='required' value="<?php if(isset($name)){echo $name;}else{echo "Your Name please";} ?>"/></p>
			</p><p><label>Phone:</label></p>
			    <p><input type="text" id="phone" name="phone" value="<?php if(isset($phone)){echo $phone;}else{echo "Your number";} ?>"/></p>
			</p><p><label>*E-mail:</label></p>
			    <p><input type="text" id="emailAdress" name="emailAdress" class="required email" value="<?php if($emailAdress = false){echo "Your Email goes here";}else{echo $emailAdress;} ?>" /></p>
			</p><p><label>*Comments:</label></p>
			    <p><textarea type="text" style="height:80px;width:300px;" id="message" name="message" value="" class="required"><?php if($message = false){echo "Drop me a line";}else{echo $message;} ?></textarea></p>
			
			</p><p><input type="submit" value="Send Request" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" />
		   </p> </form>
	
	</div>
	
 </div>
	
	
</div><!-- End: right-cont -->


<!-- Start: navbar -->
<div id="navbar">
	<?php include('includes/navbar.php'); ?>
</div><!-- End: navbar -->


<!-- Start: footer -->
<div id="footer">
	
</div><!-- End: footer -->


</div><!-- End: Center Wrap -->
 </body>
</html>