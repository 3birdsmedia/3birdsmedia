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
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['emailAdress']))) {
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
		    $company = $_POST['company'];
		    $adress = $_POST['adress'];
		    $city = $_POST['city'];
		    $state = $_POST['state_name'];
		    $phone = $_POST['phone'];
		    $fax = $_POST['fax'];
		    $emailAdress = $_POST['emailAdress'];
		    $message = $_POST['message'];
		    $msg = 		"Name:".$name.
					"\n Company Name:".$company.
					"\n Contact Phone:".$phone.
					"\n Fax:".$fax.
					"\n Adress:\n"
					.$adress.",\n"
					.$city.",".$state.
					"\n Email Address:".$emailAdress.
					"\n Message:".$message;
				    
		    
		    // send it
		    $mailSent = mail($to, $subject, $msg);
		    $emailSent = true;
	}

}?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script  src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.pack.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){
	$("#contactForm").validate();
});

</script>

<style type='text/css'>
    @import url(styles/gallery.css);
    @import url(styles/styles.css);
</style>
<?php include('includes/title.php');?>
<title>Pacific Newport Properties <?php echo "&#8212;{$title}";?></title>
</head>


<body>
	<div id='wrapper'>
	    
	    <div class="header">
	      <a href="index2.php"><h1><span>Pacific Newport Properties, INC</span></h1></a>
	    </div>
	    
	    
	    
	    <div class="bodyCopy">
		
		<div id="contactInfo">
			<img src="images/pnp_contact.jpg" />
		    
		    
			<br /><br /><p class='contParagraph'>
			    Pacific Newport Properties, Inc.<br />
			    17842 Mitchell North, Suite 100<br />
			    Irvine, CA 92614<br />
			    Main: 949-474-2000<br />
			    Fax: 949-474-7664<br />
			</p>
			
			
			<p class='contParagraph'>
			    <ul>
				<li><a href="mailto:info@pacificnewport.com">William R. Patton</a></li>
				<li><a href="mailto:sandy@pacificnewport.com">Sandra K. Dilgard </a></li>
				<li><a href="mailto:sue@pacificnewport.com">Sue A. Smith </a></li>
				<li><a href="mailto:jon.patton@pacificnewport.com">Jon B. Patton</a></li>
				<li><a href="mailto:marsh@pacificnewport.com">Marshall P. Wilkinson</a></li>
			    </ul>
			</p>

			
			
		</div>
	    
	
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
                    <input type="text" id="name" name="name" class='required' value="<?php echo $name; ?>"/></p>
			
			<p><label>Company:</label>
			    <input type="text" id="company" name="company" class='required' value="<?php echo $company; ?>" /></p>
			
			<p><label>Adress:</label>
			    <input type="text" id="adress" name="adress" value="<?php echo $adress; ?>"/></p>
			
			<p><label>City:</label>
			    <input type="text" id="city" name="city" class='required' value="<?php echo $city; ?>"/></p>
			
			<p><label>State:</label>
			    <select id="state_name" name="state_name">
				<option value="<?php echo $state_name; ?>">Select a State</option>
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
			    </select>
			    
			
			<p><label>*Phone:</label>
			    <input type="text" id="phone" name="phone" class='required' value="<?php echo $phone; ?>"/></p>
			<p><label>Fax:</label>
			    <input type="text" id="fax" name="fax" value="<?php echo $fax; ?>"/></p>	
			<p><label>*E-mail:</label>
			    <input type="text" id="emailAdress" name="emailAdress" class="requiredEmail" value="<?php echo $emailAdress; ?>" /></p>
			<p><label>*Comments:</label>
			    <textarea type="text" style="height:80px;width:300px;" id="message" name="message" value=""><?php echo $message; ?></textarea></p>
			
			<p><input type="submit" value="Send Request" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" />
		    </form>
		

	</div>
	
	       
	    </div><!---END OF BODYCOPY-->
	
	   
	
	<!--PHP GENERATED NAVBAR and ADD THIS BUTTON BAR-->
	
	<?php include('includes/navBar.php');?>
	
	
	   
	    
	<!-- FOOTER-->   
	   
	    <div id="footer">
		<p>Copyright &copy; 2008 - 2010 Pacific Newport Properties, Inc. All rights reserved.</p>
	    </div>
	
		
	</div><!-----End Of Wrapper---->






</body>
</html>
