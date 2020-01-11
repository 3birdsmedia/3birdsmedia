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

<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->
<body>


<section class="loginBar">
	<div class="container">
	    <div class="row" id="cpanel">
	        <div class="col-sm-12 col-md-6">
	        	<h2>ADMINISTRATIVE PANEL</h2>
						<?php	if(isset($error)){echo $error.'<br />';
	                       // echo md5($password).'<br />';
	                       // echo $savedPwd;
	                        }
	            
	                    ?>
	                    <form action="" method="post" enctype="multipart/form-data">
							<p><label for="username"> Username:</label> <input name="username" size="13" /></p>
							<p><label for="password"> Password:</label> <input type="password" name="password" size="13" /></p>
							<p><a href="mailto:marco@3birdsmedia.com" title="Forgot my Password">Forgot your password?</a></p>
				    		<p><input id="loginBtn" type="submit" name="login" value="Login" /></p>
						</form>
	        </div>
	    </div><!--END OF CONT-->
	</div>
</section><!--END OF CONT-->
		
<div class="footer">
<?php include('../includes/footer.php');?>
<script type="text/javascript">
</script>


</body>
</html>