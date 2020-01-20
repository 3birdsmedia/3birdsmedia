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
	header("Location: admin.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.

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
		  // if they match, set the adminloggedin session variable
		  if (md5($password) == $savedPwd) {
			$_SESSION['adminloggedin'] = 'loggedin';
			}
		  // if no match, destroy the session and prepare error message
		  else {
			$_SESSION = array();
			session_destroy();
			$error = 'Invalid username or password';
			}
		  // if the session variable has been set, redirect
		  if (isset($_SESSION['adminloggedin'])) {
			// get the time the session started
			$_SESSION['start'] = time();

					//Take us to 'my account'
					header("Location: admin.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.

			exit;
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
        	<h2>ADMINISTRATIVE PANEL</h2>
					<?php	if(isset($error)){echo $error.'<br />';
                       // echo md5($password).'<br />';
                       // echo $savedPwd;
                        }

                    ?>

                <h3>LOGIN</h3>
                    <form action="" method="post" enctype="multipart/form-data">
						<p><label for="username"> Username:</label> <input name="username" size="13" /></p>
						<p><label for="password"> Password:</label> <input type="password" name="password" size="13" /></p>
						<p><a href="mailto:marco@3birdsmedia.com" title="Forgot my Password">Forgot your password?</a></p>
			    		<p><input id="loginBtn" type="submit" name="login" value="Login" /></p>
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
