<?php
session_start();
ob_start();
include('includes/pistaFunctions.php');


//If the form is submitted
if(isset($_POST['submit'])) {
		    $name = $_POST['name'];
		    $adress = $_POST['adress'];
		    $city = $_POST['city'];
		    $state = $_POST['state_name'];
		    $phone = $_POST['phone'];
		    $email = $_POST['email'];
		    $message = $_POST['message'];
	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}
	
	//Check to make sure that the field is not empty
	if(trim($_POST['phone']) == '') {$hasError = true;} else {$phone = trim($_POST['phone']);}
	
	



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
		    $adress = $_POST['adress'];
		    $city = $_POST['city'];
		    $state = $_POST['state_name'];
		    $phone = $_POST['phone'];
		    $email = $_POST['email'];
		    $message = $_POST['message'];
		    $msg = 		"Name:".$name.
					"\n Contact Phone:".$phone.
					"\n Adress:\n"
					.$adress.",\n"
					.$city.",".$state.
					"\n Email Address:".$email.
					"\n Message:".$message;
				    
		    
		    // send it
		    $mailSent = mail($to, $subject, $msg);
		    $emailSent = true;
	}

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
<script type="text/javascript" src="js/twitter.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#contactForm").validate();
});

</script>
<title>Pista Fixed Gear<?php echo "&#8212;{$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'>
	<a href='index.php'><div id='logo'><h1>PISTA FIXED GEAR</h1></div></a>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sideNav.php');?>
	    </div><!--END OF SID EBAR-->
	    
	    <div class="cont">
		 <div id="module" class="left">
		<h2>Contact Info</h2>
		<h3>Kevin Maurice</h3>
		<p>P: 714-543-3422</p>
		<p>E: info@pistafixedgear.com</p>
		
		<iframe width="375" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;ctz=420&amp;msa=0&amp;msid=202139918174726279664.0004a48a46b9bf695e8de&amp;ll=33.624751,-117.927637&amp;spn=23.875,57.630033&amp;output=embed"></iframe><br /><small>View <a href="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;ctz=420&amp;msa=0&amp;msid=202139918174726279664.0004a48a46b9bf695e8de&amp;ll=33.624751,-117.927637&amp;spn=23.875,57.630033&amp;source=embed">Pista Fixed Gear</a> in a larger map</small>
		
		
		</div> <!--END of Module-->
		<div id="module" class="right">
		
		
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p class="confirm"><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />
			
		<?php } ?>

		
	

		    <form action="contact.php" method="post" id='contactForm' name='contactForm'>
			<p><label>*Name:</label>
              <input type="text" id="name" name="name" class='required' value="<?php if(isset($name)){echo $name;} ?>"/></p>
			
			<p><label>Adress:</label>
		      <input type="text" id="adress" name="adress" value="<?php if(isset($adress)){echo $adress;} ?>"/></p>
			
			<p><label>City:</label>
		      <input type="text" id="city" name="city"  value="<?php if(isset($city)){echo $city;} ?>"/></p>
			
			<p><label>State:</label>
			    <select id="state_name" name="state_name">
				<?php if(isset($state)){echo "<option value='$state'>$state</option>";} ?>
				<option value="">Select a State</option>
				<option value="AK">AK</option>
				<option value="AL">AL</option>
				<option value="AR">AR</option>
				<option value="AZ">AZ</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>
				<option value="ND">ND</option>
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VA">VA</option>
				<option value="VT">VT</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>
				<option value="WV">WV</option>
				<option value="WY">WY</option>		
			    </select></p>
			    
			
			<p><label>*Phone:</label>
		      <input type="text" id="phone" name="phone" class='required' value="<?php if(isset($phone)){echo $phone;} ?>"/></p>
			<p><label>*E-mail:</label>
		      <input type="text" id="emailAdress" name="email" class="required email" value="<?php if(isset($email)){echo $email;} ?>" /></p>
			<p><label>*Comments:</label>
		      <textarea type="text" class='required' id="message" name="message"></textarea></p>
			
			<p><input type="submit" value="Send Request" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" /></p>
		    </form>
            
		</div>
           

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