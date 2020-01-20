<?php
session_start();
ob_start();
include('includes/functions.php');


//If the form is submitted
if(isset($_POST['submit'])) {
		    $first = $_POST['first'];
			$last = $_POST['last'];
 			$phone = $_POST['phone'];
		  	$altphone = $_POST['altphone'];
		    $fax = $_POST['fax'];
		    $email = $_POST['email'];
		    $cname = $_POST['cname'];

			if(isset($_POST['art'])){ $art = $_POST['art'];}else{ $art = '';}
			if(isset($_POST['quote'])){ $quote = $_POST['quote'];}else{ $quote = '';}
			if(isset($_POST['sample'])){ $sample = $_POST['sample'];}else{ $sample = '';}
			if(isset($_POST['remove'])){ $remove = $_POST['remove'];}else{ $remove = '';}

		    $message = $_POST['message'];
	//Check to make sure that the name field is not empty
	if(trim($_POST['first']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['first']);
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
		$to = "mike@designpros-inc.com";
		$subject = "From digiprint contact page";

		    $first = $_POST['first'];
		    $last = $_POST['last'];
		    $phone = $_POST['phone'];
		    $altphone = $_POST['altphone'];
		    $fax = $_POST['fax'];
		    $email = $_POST['email'];
		    $cname = $_POST['cname'];
			$message = $_POST['message'];

			if(isset($_POST['art'])){ $art = $_POST['art'];}else{ $art = '';}
			if(isset($_POST['quote'])){ $quote = $_POST['quote'];}else{ $quote = '';}
			if(isset($_POST['sample'])){ $sample = $_POST['sample'];}else{ $sample = '';}
			if(isset($_POST['remove'])){ $remove = $_POST['remove'];}else{ $remove = '';}

		    $msg = 		"Name:".$first." ".$last.
					"\n Contact Phone:".$phone.
					"\n Alternate Phone:".$altphone.
					"\n Email Address:".$email.
					"\n Fax:".$fax.
					"\n Company Name:".$cname.
					"\n I need to:".$art." or ".$quote." or ".$sample.

					"\n Message:".$message.
					"\n Please:".$remove;

			//echo $msg;

		    $headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    // send it
		    $mailSent = mail('marco.segura@live.com', $subject, '<html>'.$msg.'</html>', $headers);
			$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
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
<script type="text/javascript">

$(document).ready(function(){
	$("#contactForm").validate();
});

function shipsame(form){

if(form.sameasbilling.checked){

     form.Mailing_First_Name.value = form.Billing_First_Name.value;
     form.Mailing_Last_Name.value = form.Billing_Last_Name.value;
     form.Mailing_Address.value = form.Billing_Address.value;
     form.Mailing_City.value = form.Billing_City.value;
     form.Mailing_Zip.value = form.Billing_Zip.value;

     if(form.Billing_State.type == "select-one"){
          var bStateIdx = form.Billing_State.selectedIndex;
          form.Mailing_State.options[bStateIdx].selected = true;
     }
     else{
          form.Mailing_State.value = form.Billing_State.value;
     }
}
else{
     form.Mailing_First_Name.value = "";
     form.Mailing_Last_Name.value = "";
     form.Mailing_Address.value = "";
     form.Mailing_City.value = "";
     if(form.Mailing_State.type == "select-one"){
          form.Mailing_State.options[0].selected = true;
     }
     else{
          form.Mailing_State.value = "";
     }
     form.Mailing_City.value = "";
     form.Mailing_Zip.value = "";
}
}
</script>
<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->

	    <div class="cont">
		 <div id="left" class="module">
		<h2>Contact Us</h2>

        <h3>Corporate Address:</h3>
        	DigiPrint Products Corporation<br />
			2730 S. Harbor Blvd., Suite A<br />
			Santa Ana, CA 92704<br /><br />

        <h3>Toll Free Customer Service:</h3>
			1-877-215-2155<br />
			Mon- Friday 9:00am – 5:00pm<br /><br />

        <h3>Fax Number:</h3>
        	714-597-6809<br /><br />

		<h3>Email Address:</h3>
        	Customer Service and Returns<br />
			<a href="mailto:costumercare@digiprintproducts.com" title="Costumer Care" >customercare@digiprintproducts.com</a><br /><br />

        <h3>Templates/Artwork/Product Info:</h3>
        	<a href="mailto:artwork@digiprintproducts.com" title="Artwork" >artwork@digiprintproducts.com</a><br /><br />

        <h3>Sales:</h3>
        	<a href="mailto:sales@digiprintproducts.com" title="Sales" >sales@digiprintproducts.com</a><br /><br />

		</div> <!--END of Module-->
		<div id="right" class="module">


		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p class="confirm"><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />

		<?php } ?>



		    <form action="contact_us.php" method="post" id='contactForm' name='contactForm'>
			<p><label>*Name:</label>
              <input type="text" id="first" name="first" class='required' value="<?php if(isset($first)){echo $first;}else{ echo "First";} ?>" onfocus="this.value = '',this.style.color='#000',this.style.color='#000'"/></p>
              <input type="text" id="last" name="last" class='required' value="<?php if(isset($last)){echo $last;}else{ echo "Last";} ?>" onfocus="this.value = '',this.style.color='#000'"/></p>

			<p><label>*Phone:</label>
		      <input type="text" id="phone" name="phone" class='required' value="<?php if(isset($phone)){echo $phone;}else{ echo "###-###-####";} ?>" onfocus="this.value = '',this.style.color='#000'"/></p>

            <p><label>Alternate Phone:</label>
		      <input type="text" id="altphone" name="altphone"value="<?php if(isset($altphone)){echo $altphone;} ?>"/></p>

			<p><label>*E-mail:</label>
		      <input type="text" id="emailAdress" name="email" class="required email" value="<?php if(isset($email)){echo $email;} ?>" /></p>

            <p><label>Fax:</label>
		      <input type="text" id="fax" name="fax"value="<?php if(isset($fax)){echo $fax;} ?>"/></p>

            <p><label>Company Name:</label>
		      <input type="text" id="cname" name="cname"value="<?php if(isset($cname)){echo $cname;} ?>"/></p>


           <p><input type="checkbox" id="art" name="art" value="Upload Artwork" style="width: 16px; display: inline; clear: left;"/>
           <label style="clear: right;display: inline;margin-left: 10px;margin-top: 15px;width: 200px;">Upload Artwork:</label></p>
           <p><input type="checkbox" id="quote" name="quote" value="I need a custom Quote" style="width: 16px; display: inline; clear: left;"/>
           <label  style="clear: right;display: inline;margin-left: 10px;margin-top: 15px;width: 200px;">I need a custom Quote:</label></p>
           <p><input type="checkbox" id="sample" name="sample" value="Send me a Sample Pack " style="width: 16px; display: inline; clear: left;"/>
           <label  style="clear: right;display: inline;margin-left: 10px;margin-top: 15px;width: 200px;">Send me a Sample Pack</label></p>



			<p><label>*Comment:</label>
		      <textarea type="text" class='required' id="message" name="message"></textarea></p>

            <p><input type="checkbox" id="remove" name="remove" value="Remove me from mailing list" style="width: 16px; display: inline; clear: left;"/>
           <label  style="clear: right;display: inline;margin-left: 10px;margin-top: 15px;width: 200px;font-size:10px;">Remove me from mailing list</label></p>

            <p><input type="submit" value="Send Request" id="submit" name="submit" value="" /></p>


            </form>



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
