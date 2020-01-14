<?php include('includes/functions.php');
//print_r($_POST);
//If the form is submitted
if(isset($_POST['submit'])) {



$msg = '';
foreach ($_POST as $key => $value) {
if (!isset($value)) {$value = "Not Specified";}

$msg =   $msg.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';
 
}

	//Check to make sure that the name field is not empty
	if(trim($_POST['first_name']) == '') {
		$hasError = true;
		
	} else {
		$name = trim($_POST['first_name']);
	}
	
	//Check to make sure that the field is not empty
	
	

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['emailAddress']) == '')  {
		
		echo 'Has'.$hasError.'ERRORfirst'; 
	} else if (!preg_match('/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/', trim($_POST['emailAddress']))) {
	
		
	
	} else {
		$email = trim($_POST['emailAddress']);
	}


	//If there is no error, send the email
	
 		$to = "info@cjtmounting.com";
		$subject = "From Contact Page";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    // send it
		    $mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
		    $emailSent = true;
	

}
//echo $msg;
include('includes/header.php'); ?>
	 <div id='cont_header'>
	  <span class="contact_header"> </span>
	 </div>
<!-- Start: content -->
       <div id="content" class="contact">
	 
	<ul id="secondaryNav" class="contactLinks" >
	        <li><a href="#registration">Product Registration</a></li>
	        <li><a href="#quote">Request Information</a></li>
                 <li><a href="javascript:popUp('helping.php')">Helping Hand</a></li>
                <li id="upload"><a href="showroom.php">Showroom</a></li>
</ul> 
	  
	
   <div id="contactInfo">
	<h3 class='contactHeader'>Contact Information</h3>
	<p><span class="contactTitle">Telephone:  714-751-6295</p></span>
	<p><span class="contactTitle">Fax: 714-751-5775</p></span>
	<p><span class="contactTitle">Postal Address: </span> P.O. Box 10028, Costa Mesa, CA 92627</p>
	<p><span class="contactTitle">Email:</span>  <a href="mailto:info@cjtmounting.com">info@cjtmounting.com</a></p>
   </div>
   <?php if (isset($msg)){echo "<p>You email was successfully sent, one of our representatives will contact you soon, Thank you</p>";}?>
   <div id="contlogo"></div>
	
	
<div id="registration">	
<h3 class='contactHeader'>Product Registration Form</h3>
		
	   
<div class="left-cont">    
<form action="" method="post" id='registrationForm' name='registrationForm'>
		    
		    <h3 class="contH3">Communication Device User</h3>
			
			<h4>Name*</h4>
			   <p><label for="first_name">First</label>
			   <input type="text" id="first_name" name="first_name" class='required' value="<?php if (isset($first_name)){echo $first_name;} else {echo "";} ?>"/></p>
			   <p><label for="last_name">last</label>
			   <input type="text" id="last_name" name="last_name" class='required' value="<?php if (isset($last_name)){echo $last_name;} else {echo "";} ?>"/></p>
			
			<h4>Address*</h4>
			
			<p><label for="street_address">Street Address</label>
			    <input type="text" id="street_address" class='required' name="Address" value="<?php if (isset($name)){echo $name;} else {echo "";} ?>"/></p>
			
			<p><label for="city">City:</label>
			    <input type="text" id="city" name="city" class='required' value="<?php if(isset($city)){echo $city;} ?>"/></p>
			
			<p><label for="state_name">State:</label>
			    <select class='required' id="state_name" name="state_name">
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
			    
			<p><label for="postal">Postal/Zip Code:</label>
			    <input type="text" id="postal" name="postal" class='required' value="<?php if (isset($postal)){echo $postal;} else {echo "";} ?>"/></p>
		        
			<p><label for="postal">Country:</label>
			    <input type="text" id="country" name="country" class='required' value="<?php if (isset($country)){echo $country;} else {echo "United States";} ?>"/></p>
			
			<h4>Phone</h4>
			<p><label for="work_phone">Work</label>
			    <input type="text" id="work_phone" name="work_phone"  value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			<p><label for="home_phone">*Home</label>
			    <input type="text" id="home_phone" name="home_phone" class='required' value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			<p><label for="emailAddress">*Email:</label>
			    <input type="text" id="emailAddress" name="emailAddress" class="required email" value="<?php if (isset($emailAddress)){echo $emailAddress;} else {echo "";} ?>"/></p>
			
			<h3 class="contH3">Primary Contact if Different</h3>
			
			<h4>Name*</h4>
			   <p><label for="first_name_other">First</label>
			   <input type="text" id="first_name_other" name="first_name_other" value="<?php if (isset($first_name_contact)){echo $first_name_contact;} else {echo "";} ?>"/></p>
			   <p><label for="last_name_other">Last</label>
			   <input type="text" id="last_name_other" name="last_name_other" value="<?php if (isset($last_name_contact)){echo $last_name_contact;} else {echo "";} ?>"/></p>
			
			<p><label for="phone">Phone</label>
			    <input type="text" id="other_phone" name="other_phone"  value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			
			<p><label for="emailAddress">Email:</label>
			    <input type="text" id="otherEmailAddress" name="otherEmailAddress" value="<?php if (isset($emailAddress)){echo $emailAddress;} else {echo "";} ?>"/></p>
</div>
<div class="right-cont">			
			<h3 class="contH3">Referring Clinical/Professional Contact</h3>
			
			<h4>Name*</h4>
			   <p><label for="first_name">Name</label>
			   <input type="text" id="clinical_name" name="clinical_name" class='required' value="<?php if (isset($clinical_name)){echo $clinical_name;} else {echo "";} ?>"/></p>
			   
			<h4>Address*</h4>
			
			<p><label for="street_address">Street Address</label>
			    <input type="text" id="clinicalstreet_address" class='required' name="clinicalAddress" value="<?php if (isset($clinicalAdress)){echo $clinicalAdress;} else {echo "";} ?>"/></p>
			
			<p><label for="city">City:</label>
			    <input type="text" id="clinicalcity" name="clinicalcity" class='required' value="<?php if(isset($clinicalcity)){echo $clinicalcity;} ?>"/></p>
			
			<p><label for="state_name">State:</label>
			    <select class='required' id="clinicalstate_name" name="clinicalstate_name">
				<option value="<?php echo $clinicalstate_name; ?>">Select a State</option>
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
			    
			<p><label for="postal">Postal/Zip Code:</label>
			    <input type="text" id="clinicalpostal" name="clinicalpostal" class='required' value="<?php if (isset($clinicalpostal)){echo $postal;} else {echo "";} ?>"/></p>
		        
			<p><label for="postal">Country:</label>
			    <input type="text" id="clinicalcountry" name="clinicalcountry" class='required' value="<?php if (isset($clinicalcountry)){echo $country;} else {echo "United States";} ?>"/></p>
			
			<h4>Phone</h4>
			<p><label for="clinical_phone">Phone</label>
			    <input type="text" id="clinical_phone" name="clinical_phone"  value="<?php if (isset($clinical_phone)){echo $clinical_phone;} else {echo "";} ?>"/></p>
			<p><label for="emailAddress">Email:</label>
			    <input type="text" id="clinicalEmailAddress" name="clinicalEmailAddress" class="required email" value="<?php if (isset($clinicalemailAddress)){echo $clinicalemailAddress;} else {echo "";} ?>"/></p>

			<h3 class="contH3" id="prodinfo">Product Info</h3>
			
			<p><label for="date_purchase">Date of Purchase</label></p>
			<input type="text" id="purchaseDate" name="purchaseDate" value="<?php if (isset($purchaseDate)){echo $purchaseDate;} else {echo "";} ?>"/></p>
			
			<p><label for="sales_order">Sales Order #</label></p>
			<input type="text" id="sales_order" name="sales_order" value="<?php if (isset($sales_order)){echo $psales_order;} else {echo "";} ?>"/></p>
			
			<p><label class="purchase">Device was purchased through</label></p>
			
			<input type="text" id="purchase" name="purchase" value="<?php if (isset($purchase)){echo $purchase;} else {echo "";} ?>"/></p>
			
			<p><label for="method">Have you used a CJT product before</label></p>
			
			<p><input type="radio" class="radio" id="" name="used" value="yes"/><label class="radioLabel">Yes</label> <input type="text" id="other" name="yes" value="<?php if (isset($yes)){echo $yes;} else {echo "";} ?>"/></p>
		
			<p><input type="radio" class="radio" id="" name="used" value="no"/><label class="radioLabel">No</label></p>
			
			
			<p><input type="submit" value="Send Registration" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" /></p>
</form>
</div>
	
	
	
	
	
	
	
	
	
	<ul class="contactLinks" id="contactmiddle">
	        <li><a href="#quote">Request Information</a></li>
	        <li><a href="#wrapper">Back to Top</a></li>
	</ul>	    
</div>	
   
	    
	  
       
<div id="quote">     
 <h3  class='contactHeader'>Request Information</h3>
		
	   
    
<form action="" method="post" id='requestInfo' name='requestInfo'>
		    
		    <h4>Consumer/Augmented Communicator</h4>
			
			<h4>Name*</h4>
			   <p><label for="first_name">First</label>
			   <input type="text" id="first_name" name="first_name" class='required' value="<?php if (isset($first_name)){echo $first_name;} else {echo "";} ?>"/></p>
			   <p><label for="last_name">last</label>
			   <input type="text" id="last_name" name="last_name" class='required' value="<?php if (isset($last_name)){echo $last_name;} else {echo "";} ?>"/></p>
			
			<h4>Address</h4>
			
			<p><label for="street_address">Street Address</label>
			    <input type="text" id="street_address" name="Address" value="<?php if (isset($name)){echo $name;} else {echo "";} ?>"/></p>
			
			<p><label for="city">City:</label>
			    <input type="text" id="city" name="city" class='required' value="<?php if(isset($city)){echo $city;} ?>"/></p>
			
			<p><label for="state_name">State:</label>
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
			    
			<p><label for="postal">Postal/Zip Code:</label>
			    <input type="text" id="postal" name="postal" class='required' value="<?php if (isset($postal)){echo $postal;} else {echo "";} ?>"/></p>
			
			<h4>Phone</h4>
			<p><label for="work_phone">Work</label>
			    <input type="text" id="work_phone" name="work_phone"  value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			<p><label for="home_phone">*Home</label>
			    <input type="text" id="home_phone" name="home_phone" class='required' value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			<p><label for="emailAddress">*Email:</label>
			    <input type="text" id="emailAddress" name="emailAddress" class="required email" value="<?php if (isset($emailAddress)){echo $emailAddress;} else {echo "";} ?>"/></p>
			
			<h4>Primary Contact if Different</h4>
			
			<h4>Name*</h4>
			   <p><label for="first_name_contact">First</label>
			   <input type="text" id="first_name_contact" name="first_name_contact" value="<?php if (isset($first_name_contact)){echo $first_name_contact;} else {echo "";} ?>"/></p>
			   <p><label for="last_name_contact">last</label>
			   <input type="text" id="last_name_contact" name="last_name_contact" value="<?php if (isset($last_name_contact)){echo $last_name_contact;} else {echo "";} ?>"/></p>
			
			<p><label for="phone">Phone</label>
			    <input type="text" id="work_phone" name="work_phone"  value="<?php if (isset($work_phone)){echo $work_phone;} else {echo "";} ?>"/></p>
			
			
			
			<p><label>*Comments:</label>
			    <textarea type="text" style="height:80px;width:305px;" id="message" name="message" value=""><?php if (isset($message)){echo $message;} else {echo "";} ?></textarea></p>
			


			<p><input type="submit" value="Send Request" id="submit" name="submit" value="" style="width: 100px;margin-left:90px;" />
		    </form>


	   <ul class="contactLinks" id="contactbottom">
	        <li><a href="#registration">Product Registration</a></li>
	        <li><a href="#wrapper">Back to Top</a></li>
	</ul>
	    </div>
	  </div>
 
       
       </div>
       
 
       </div><!-- End: content -->
<!-- Start: navigation -->
       <div id="navigation">
	     <?php include('includes/navbar.php'); ?> 
       </div><!-- End: navigation -->
       
       
<!-- Start: push -->
       <div id="push"></div><!-- End: push -->
</div><!-- End: Center Wrap -->

<!-- Start: footer -->
       <div id="footer">
	       <?php include('includes/footer.php'); ?>
       </div><!-- End: footer -->
       
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
<!--

$().ready(function() {
	// validate the comment form when it is submitted
	$("#registrationForm").validate();
});
$().ready(function() {
	  //validate the comment form when it is submitted
	   $("#registrationForm").validate(
				   {
				      rules: {
					     name: "required",
					     email: {
						      required: true,
						       email: true},
					     messages: {
				      			name: "Please enter your name",
				 			email: "Please enter a valid email address"}
					      }
				   });
	});

$().ready(function() {
	// validate the comment form when it is submitted
	$("#requestInfo").validate();
});
$().ready(function() {
	  //validate the comment form when it is submitted
	   $("#requestInfo").validate(
				   {
				      rules: {
					     name: "required",
					     email: {
						      required: true,
						       email: true},
					     messages: {
				      			name: "Please enter your name",
				 			email: "Please enter a valid email address"}
					      }
				   });
	});

$(function() {
	$('ul.contactLinks a').bind('click',function(event){
		var $anchor = $(this);

		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500,'easeInOutExpo');

		event.preventDefault();
	});
});
-->
</script>
	
	
</body>
</html>