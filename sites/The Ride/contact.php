<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}
	
	//Check to make sure that the field is not empty
	if(trim($_POST['phone']) == '') {$hasError = true;} else {$phone = trim($_POST['phone']);}
	
	

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

include('includes/functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="styles/styles.css" />
<style type="css/text">
</style>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery.validate.pack.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){
	$("#contactForm").validate();
});

</script>

<title>THE RIDE <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
    	<div id="main">
        	<div id="header">
            	<h1>THE RIDE</h1>
            </div>
            
       	<div id="cont">	
	  <div id="left-cont">   
	    <div id='contactDiv'>
          		
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />
			
		<?php } ?>

		
	

		    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id='contactForm' name='contactForm'>
			<p><label>*Name:</label>
	                     <input type="text" id="name" name="name" class='required' value="<?php if($name = false){echo "Your Name please";}else{echo $name;} ?>"/></p>
			<p><label>*Phone:</label>
			    <input type="text" id="phone" name="phone" class='required' value="<?php if($phone = false){echo "Your Name please";}else{echo $phone;} ?>"/></p>
			<p><label>*E-mail:</label>
			    <input type="text" id="emailAdress" name="emailAdress" class="requiredEmail" value="<?php if($emailAdress = false){echo "Your Name please";}else{echo $emailAdress;} ?>" /></p>
			<p><label>*Comments:</label>
			    <textarea type="text" style="height:80px;width:300px;" id="message" name="message" value=""><?php if($message = false){echo "Your Name please";}else{echo $message;} ?></textarea></p>
			
			<p><input type="submit" value="Send Request" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" />
		    </form>
	   </div>
	  </div>
	   <div id="right-cont">
		<h3>DONATE</h3>
		<p>If you wish to donate, you can do so by Texting "THE RIDE" to 55567.</p>
		<p>Or via paypal</p>
		<p>(paypal donate here)</p>
		
            </div>
		

	</div>
	
        </div>  



		<?php include('includes/navBar.php');?>


	</div><!--END OF Main-->
</div><!--END OF WRAP-->


<div id="footer">
        <p>THE RIDE</p>
        <p>Copyright (c) <?php setCopyright (2010) ?></p>
</div>

</body>
</html>