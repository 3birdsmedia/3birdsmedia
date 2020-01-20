<?php
session_start();
ob_start();
include('includes/functions.php');


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
		 <div id="module" class="left">
		<h2>Costumer Support</h2>
		<?php if(isset($hasError)) { //If errors are found ?>
		    <p class="error">Please check if you've filled all the fields with valid information.<br />
		    * Required</p><br />
		<?php } ?>

		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p class="confirm"><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />

		<?php } ?>

<form id="care" class="care" action="" method="post" enctype="multipart/form-data">
<p><label>*Name:</label></p>
              <p><input type="text" id="first" name="first" tabindex="1" class='required' value="<?php if(isset($first)){echo $first;}else{ echo "First";} ?>" onfocus="this.value = '',this.style.color='#000',this.style.color='#000'"/></p>
              <p><input type="text" id="last" name="last" tabindex="2" class='required' value="<?php if(isset($last)){echo $last;}else{ echo "Last";} ?>" onfocus="this.value = '',this.style.color='#000'"/></p>

<p><label class="comp" for="company">Company</label></p>
<p><input id="company" class="field" type="text" tabindex="3" maxlength="255" value="" name="company"></p>

<p><label id="email" class="label" for="email">Email</label></p>
<p><input id="email" class="required email" type="email" tabindex="4" maxlength="255" value="" name="email"></p>

<p><label>*Phone</label></p>
		      <p><input type="text" id="phone" name="phone" tabindex="5" class='required' value="<?php if(isset($phone)){echo $phone;}else{ echo "###-###-####";} ?>" onfocus="this.value = '',this.style.color='#000'"/></p>

<p><label id="prod" class="desc" for="product">Product</label></p>
<p><select id="prod" class="field select medium" tabindex="6" name="product">
<?php
    $conn = dbConnect('query');
    $categoriesql ="SELECT * FROM categories ORDER BY sort ASC";
    $sideresult = $conn->query($categoriesql) or die(mysqli_error());
    $numRows = $sideresult->num_rows;

    while ($siderow = $sideresult->fetch_assoc()) {
		$cat_id = $siderow['cat_id'];
		$side_cat = $siderow['category'];
		$prodSql = "SELECT COUNT(*) as num FROM prod_cat_lookup WHERE prod_cat_lookup.cat_id=$cat_id";

		$sideresult2 = $conn->query($prodSql) or die(mysqli_error());

		$numProd = mysqli_fetch_array($conn->query($prodSql));
		$numProd = $numProd['num'];

		echo "<option value='".ucwords($side_cat)."'>".ucwords($side_cat)." </option>";
	}
?>
<option value="Other"> Other </option>
</select></p>

<p><label id="qty_needed" class="desc" for="Qty">Quantity Needed</label></p>
<p><input id="qty_needed" class="field text medium" type="text" tabindex="7" maxlength="255" value="" name="qty_needed"></p>

<p><label id="finished" class="desc" for="finished">Finished Size</label></p>
<p><input id="finished" class="field text medium" type="text" tabindex="8" maxlength="255" value="" name="finished"></p>

<p><label id="paper" class="desc" for="paper"> Paper </label></p>
<p><select id="paper" class="field select medium" tabindex="9" name="paper">
<option selected="selected" value="Choose paper"> Choose paper </option>
<option value="C1S"> C1S </option>
<option value="C2S"> C2S </option>
</select></p>

<p><label id="details" class="desc" for="Project"> Project Details </label></p>
<p><textarea id="project_details" class="field textarea medium" tabindex="10" cols="40" rows="10" spellcheck="true" name="details"></textarea></p>

<p id="instruct" class="instruct">
Please provide details about inks, folding, die cutting, etc. as well as any fulfillment or special shipping requirements.
</p>
<input id="care" class="submit" type="submit" value="Submit" name="care" tabindex="11">
</form>




		</div>


	</div><!--END OF CONT-->
</div>

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
