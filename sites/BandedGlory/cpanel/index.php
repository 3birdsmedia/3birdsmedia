<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
//echo $_SESSION['location_id'];
include("../includes/functions.php");
//print_r($_SESSION);
if(isset($_SESSION['loggedin'])){
	//echo "<h1>$customer_id</h1>";
	//Take us to 'my account'
	header("Location: myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.

}else{
		// process the script only if the form has been submitted
		if (array_key_exists('login', $_POST)) {
		  // start the session
//		  session_start();
//		  ob_start();  // need to buffer output - need this since adding logout via external file
		  // clean the $_POST array and assign to shorter variables

		  nukeMagicQuotes();
		  $username = strtolower(trim($_POST['username']));
		  $password = trim($_POST['password']);
		  // connect to the database as a restricted user
		  $conn = dbConnect('query');
		  // get the username's details from the database
		  $sql = "SELECT password, customer_id FROM customer WHERE username = ?";
		  // initialize and prepare locationment
		  $stmt = $conn->stmt_init();
		  if ($stmt->prepare($sql)) {
			// bind the input parameter
			$stmt->bind_param('s', $username);
			// bind the result, using a new variable for the password
			$stmt->bind_result($savedPwd, $customer_id);
			$stmt->execute();
			$stmt->fetch();
			}
		  // use the salt to encrypt the password entered in the form
		  // and compare it with the stored version of the password
		  // if they match, set the authenticated session variable
		  if (md5($password) == $savedPwd) {
			$_SESSION['loggedin'] = 'loggedin';
			}
		  // if no match, destroy the session and prepare error message
		  else {
			$_SESSION = array();
			session_destroy();
			$error = 'Invalid username or password';
			}
		  // if the session variable has been set, redirect
		  if (isset($_SESSION['loggedin'])) {
			// get the time the session started
			$_SESSION['start'] = time();

					$_SESSION['customer_id'] = $customer_id;

					echo "<h1>$customer_id</h1>";
					//Take us to 'my account'
					header("Location: myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.

			exit;
			}

		#############################
		#
		#   REGISTER
		#
		#############################

		}elseif (array_key_exists('register', $_POST)) {
		  // start the session
	//	  session_start();
		//  ob_start();  // need to buffer output - need this since adding logout via external file
		  // clean the $_POST array and assign to shorter variables

		  nukeMagicQuotes();

			$username = strtolower(trim($_POST['username']));

			$randomNumber = rand(10,99);

			$firstname = strtolower(trim($_POST['firstname']));
			$lastname  = strtolower(trim($_POST['lastname']));
			$password  = strtolower(trim($_POST['password']));
			$conf_password  = strtolower(trim($_POST['conf_password']));
			$email = strtolower(trim($_POST['email']));
			$street = strtolower(trim($_POST['street']));
			$city = strtolower(trim($_POST['city']));
			$state = strtolower(trim($_POST['state']));
			if (isset($_POST['zip']) && is_numeric($_POST['zip'])){
																	$zip = strtolower(trim($_POST['zip']));
																}else{
																	$zip = '5 digit Zipcode';
																}

			$conn = dbConnect('query');
			$sql = "SELECT username FROM customer
					WHERE customer.username = ? LIMIT 1";

			$stmt = $conn->stmt_init();
			if ($stmt->prepare($sql)) {
			// bind the input parameter
			$stmt->bind_param('s', $username);
			// bind the result, using a new variable for the password
			$stmt->bind_result($strduser);
			$stmt->execute();
			$stmt->fetch();
			}

			if (isset($strduser) && ($strduser !== '')){
				//echo '<h2>true</h2>'.$strduser;

				$error = "<span class='error'>Sorry, this user name is taken!</span><br />
						You can try $first"."."."$last"."$randomNumber";
			}elseif($password !== $conf_password){
				$error = "<span class='error'>Sorry, the passwords you entered don't match!</span>";
			}elseif($email == ''){
				$error = "<span class='error'>Please provide us with an email, so we can contact you.</span>";
			}else{
				//echo '<h2>false</h2>';
				/*
				$first = strtolower(trim($_POST['firstname']));
			$last  = strtolower(trim($_POST['lastname']));
			$password  = strtolower(trim($_POST['passwrord']));
			$last  = strtolower(trim($_POST['confirm_password']));
			$email = strtolower(trim($_POST['email']));
			$street = strtolower(trim($_POST['street']));
			$city = strtolower(trim($_POST['city']));
			$state = strtolower(trim($_POST['state']));
			if (isset($_POST['zip']) && is_numeric($_POST['zip']){
																	$zip = strtolower(trim($_POST['zip']));
																}else{
																	$zip = 'error';
																}
			customer_fname 	char(20)
			customer_lname 	char(20)
			street 	char(40)
			city 	char(40)
			state 	char(20)
			zip 	char(10)
			username 	varchar(40)
			password 	varchar(32)
			email


			*/

				$conn = dbConnect('admin');
				//////////////////////////////////////////////////////////////////
				//create SQL to insert customer information  -we are setting up a prepared statement
				$sql = 'INSERT INTO customer (customer_fname, customer_lname, street, city, state, zip, username, password, email)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

				//initialize prepared statement
				$stmt = $conn->stmt_init();
				if ($stmt->prepare($sql)) {
					//bind parameters and execute statement
					//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
					$stmt->bind_param('sssssssss', ucfirst($firstname), ucfirst($lastname), $street, $city, $state, $zip, $username, md5($password), $email);
					$OK = $stmt->execute(); //if statement executes, will set this flag to true
					// free the statement for the next query
					$stmt->free_result();

					$sql = "SELECT customer_id FROM customer
					WHERE customer.username = ?
					ORDER BY customer_id DESC LIMIT 1";

					$stmt = $conn->stmt_init();
					if ($stmt->prepare($sql)) {
					// bind the input parameter
					$stmt->bind_param('i', $customer_id);
					// bind the result, using a new variable for the password
					$stmt->bind_result($customer_id);
					$stmt->execute();
					$stmt->fetch();
					}
					$_SESSION['loggedin'] = 'loggedin';
					$_SESSION['customer_id'] = $customer_id;

					$subject = "Welcome to Digiprint!";
$msg = "
<html>
	<body>
		<table align='center' width='600' style='font-family:Myriad Pro, Helvetica, Arial; color:#F00;border:thin #ccc solid' bordercolor='#ccc' cellpadding='0' cellspacing='10'>
			<tr>
            	<td colspan='2' align='center'><img src='http://3birdsmedia.com/DigiPrintNew/images/header.jpg' title='Header' width='600'/></td>
			</tr>
            <tr>
            	<td align='center' colspan='2' style='border-bottom:thin #ccc solid'><br/><h2>Welcome to the Digiprint Family</h2></td>
            </tr>
            <tr>
            	<td style='color:#333'>Print this email as a friendly reminder of this important information. Thanks</td>
            </tr>

            <tr>
            	<td style='color:#333'>Username: $username <br/>
            							Password: $password
            </td>
            </tr>
		</table>
	</body>
</html>";

			//echo $msg;

		    $headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    // send it
		    $mailSent = mail($email, $subject, $msg, $headers);
			//$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
			$emailSent = true;
					//echo "<h1>$customer_id</h1>";
					//Take us to 'my account'
					header("Location: myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.


				}

			}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />

<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">

$(document).ready(function() {
// validate signup form on keyup and submit
	$("#register").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},
			conf_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			conf_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
		}
	});

	// propose username by combining first- and lastname
	$("#username").focus(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if(firstname && lastname && !this.value) {
			this.value = firstname + "." + lastname;
		}
	});

});
</script>

<title>Digiprint Products LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
		<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
	</div><!--END OF HEADER-->
	<div class="content">
	  <div id="sideNav">
		<?php include('../includes/cpanelsidenav.php');?>
	  <!--END OF SIDEBAR-->

	  <div class="cont" id="cpanel">
      	<div id="leftcont">
	        <h2>Register</h2>
        	<h3>Registration is free!</h3>
					<?php	if(isset($error)){echo $error.'<br />';
                       // echo md5($password).'<br />';
                       // echo $savedPwd;
                        }

                    ?>



                <form action="" method="post" name="register" id="register">

                      <label>*First Name:</label>
                        <input name="firstname" type="text" value="<?php if (isset($firstname)){echo $firstname;} else {echo "";} ?>" id="firstname" class="required" size="20" />

                    <label>*Last Name:</label>
                        <input name="lastname" type="text" value="<?php if (isset($lastname)){echo $lastname;} else {echo "";} ?>" id="lastname" class="required" size="20" />



                    <label for="username">*Username:</label>
                        <input name="username" class="required" id="username" size="13" value="<?php if (isset($username)){echo $username;} else {echo "";} ?>"/>

                    <label for="password">*Password:</label>
                        <input type="password" name="password" id="password" size="13" />

                    <label for="password">*Confirm Password:</label>
                        <input type="password" id="conf_password" name="conf_password"  size="13" />

                  <label>*Email:</label>
                        <input name="email" type="text" value="<?php if (isset($email)){echo $email;} else {echo "";} ?>" class="required email" size="40" />

                    <label>Street:</label>
                        <input name="street" type="text" value="<?php if (isset($street)){echo $street;} else {echo "";} ?>" size="40" />

                    <label>City:</label>
                        <input name="city" type="text" value="<?php if (isset($city)){echo $city;} else {echo "";} ?>" size="40" />

                    <label>State:</label>
                        <select name="state" size="1">
                                    <option value="CA">CA</option>
                                    <option value="AK">AK</option>
                                    <option value="AL">AL</option>
                                    <option value="AR">AR</option>
                                    <option value="AZ">AZ</option>
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

                    <label>Zip:</label>
                        <input name="zip" type="text" value="<?php if (isset($zip)){echo $zip;} else {echo "";} ?>" size="10" />

                          <p><input id="submit" type="submit" name="register" value="register" /></p>

                      </form>
                </div><!--END OF LEFT CONT-->
				<div id="right">
                <h2>Login</h2>
                		<?php	if(isset($error)){echo '<h3 class="error">'.$error.'</h3><br />';
                        //echo md5($password).'<br />';
                        //echo $savedPwd;
                        }else{?>

               			 <h3>For Returning Customers</h3>
						<?php } ?>
                    <form action="" method="post" enctype="multipart/form-data">
						<p><label for="username"> Username:</label> <input name="username" size="13" style="text-transform:none;" /></p>
						<p><label for="password"> Password:</label> <input type="password" name="password" size="13" /></p>
						<p><a href="mailto:costumercare@digiprintproducts.com" title="Forgot my Password">Forgot your password?</a></p>
			    	<input id="login" type="submit" name="login" value="Login" />
					</form>
                </div>
       </div><!--END OF CONT-->
	 </div><!--END OF CONT-->


	    <?php include('../includes/cpanelnavBar.php');?>
	</div><!--END OF CONTENT-->

	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('../includes/cpanelfooter.php');?>
<script type="text/javascript">
</script>


</body>
</html>
