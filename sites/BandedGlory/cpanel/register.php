<?php
  include('../includes/functions.php');

  // process the script only if the form has been submitted
if (array_key_exists('login', $_POST)) {
  // start the session
  session_start();
  ob_start();  // need to buffer output - need this since adding logout via external file
  // clean the $_POST array and assign to shorter variables
  
  nukeMagicQuotes();
  $username = strtolower(trim($_POST['username']));
  $password = trim($_POST['password']);
  // connect to the database as a restricted user
  $conn = dbConnect('query');		
  // get the username's details from the database
  $sql = "SELECT password FROM users WHERE username = ?";
  // initialize and prepare locationment
  $stmt = $conn->stmt_init();
  if ($stmt->prepare($sql)) {
    // bind the input parameter
    $stmt->bind_param('s', $username);
	// bind the result, using a new variable for the password
	$stmt->bind_result($savedPwd);
	$stmt->execute();
	$stmt->fetch();
	}
  // use the salt to encrypt the password entered in the form
  // and compare it with the stored version of the password
  // if they match, set the authenticated session variable 
  if (md5($password) == $savedPwd) {
    $_SESSION['authenticated'] = 'digiprint';
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
		
	/*if ($location == '42' && $username == 'designpros'){
	header('Location: admin/admin.php');
	exit;
	}elseif($location == '42' && $username !== 'designpros'){
	  session_destroy();
	  $error = 'Invalid location for this username, please check your location';
	}else{*/
	 header('Location: admin.php');
	exit;
	//}
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
			confirm_password: {
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
			confirm_password: {
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

	//code to hide topic selection, disable for demo
	var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});
});
</script>

<title>Digiprint Products LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'>
		<a href='index.php'><div id='logo'><h1>Digiprint Products LLC</h1></div></a>
	</div><!--END OF HEADER-->
	<div class="content">
	  <div id="sideNav">
		<?php include('../includes/cpanelsidenav.php');?>
	  </div><!--END OF SIDEBAR-->
	    
	  <div class="cont">
      	<h2 >Register:</h2>
        
        <?php	if(isset($error)){echo $error.'<br />';
		    //echo md5($password).'<br />';
		    //echo $savedPwd;
		    }

		?>



	<form action="" method="post" name="register" id="register">

		<label for="username">*Username:</label>
        	<input name="username" class="required" size="13" />
            
		<label for="password">*Password:</label>
        	<input type="password" name="password" id="password" size="13" />
        
        <label for="password">*Confirm Password:</label>
        	<input type="password" id="confirm_password" name="confirm_password"  size="13" />
              
        <label>*First Name:</label> 
        	<input name="firstname" type="text" value="" class="required" size="20" />
       	
        <label>*Last Name:</label>
        	<input name="lastname" type="text" value="" class="required" size="20" />
              
        <label>Street:</label>
        	<input name="street" type="text" value="" size="40" />
        
        <label>City:</label>
        	<input name="city" type="text" value="" size="40" />
            
        <label>State:</label>
        	<select name="state" size="1">
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

		<label>Zip:</label>
        	<input name="zip" type="text" value="" size="10" />
              
        <h3>Payment Details (optional)</h3>
        <hr />
	
        <label>Name on Card:</label>
        	<input name="cardname" type="text" value="" size="30" />
        
        <label>Card Type:</label>
        	<select name="card_type" size="1">
              						<option value="visa">Visa</option>
                                    <option value="mc">MasterCard</option>
                                    <option value="amex">American Express</option>
              					  </select></label></p>
              <p><label>Number:</label><input name="cardnumber" class="disabled" type="text" value="12345678912" size="24" disabled="disabled" /></label></p>
              <p><label>Security Code:</label><input name="security" class="disabled" type="text" value="123" size="3" disabled="disabled"  /></label></p>
              <p><label>Expiration:</label><select name="exp_mo" size="1">
              						<option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
              					  </select>

								<?php expirationYear(); ?>
              
              <p><input id="submit" type="submit" name="register" value="register" /></p>

          </form>
	
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