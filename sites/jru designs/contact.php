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

include('includes/functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.lavalamp-1.3.5.js"></script>
<script type="text/javascript" src="js/jquery.bxSlider.js"></script>


<!--styles-->
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/reset.css" />
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
		
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="index.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
		<div id="left-cont">
			
<h2>Contact Me</h2>			
<p>Send me some love, a message, or ask me something :)</p>
<p>I need your name and phone, the rest is up to you.</p>
		
	    

		
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p><h3>The message was Sent!</h3></p>
			<p>I will be contacting you soon, thanks.</p><br />
			
		<?php } ?>

</div>
	
<div id="right-two">
		    <form action="" method="post" id='contactForm' name='contactForm'>
			<p><label>*Name:</label></p>
	                     <p><input type="text" id="name" name="name" class='required' value="<?php if(isset($name)){echo $name;}else{echo "Your Name please";} ?>"/></p>
			</p><p><label>*Phone:</label></p>
			    <p><input type="text" id="phone" name="phone" value="<?php if(isset($phone)){echo $phone;}else{echo "Your number";} ?>"/></p>
			</p><p><label>E-mail:</label></p>
			    <p><input type="text" id="emailAdress" name="emailAdress" class="required email" value="<?php if($emailAdress = false){echo "Your Email goes here";}else{echo $emailAdress;} ?>" /></p>
			</p><p><label>Comments:</label></p>
			    <p><textarea type="text" style="height:80px;" id="message" name="message" value="" class="required"><?php if($message = false){echo "Drop me a line";}else{echo $message;} ?></textarea></p>
			
			</p><p><input type="submit" value="Send Request" id="submit" name="submit" value="" />
		   </p> </form>
	
</div>
	    

	
        </div>  
</div>
<?php include('includes/footer.php'); ?>

<?php include('includes/navBar.php');?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#banner').bxSlider( {mode: 'vertical',controls: false,auto: true, speed: 700} );
  });
</script>
</body>
</html>