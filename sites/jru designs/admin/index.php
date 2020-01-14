<?php
  include('../includes/functions.php');
  // process the script only if the form has been submitted
if (array_key_exists('login', $_POST)) {
  // start the session
  session_start();

  // clean the $_POST array and assign to shorter variables
  nukeMagicQuotes();
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  // connect to the database as a restricted user
  $conn = dbConnect('query');
  // get the username's details from the database
  $sql = "SELECT saved_password FROM users WHERE user_name = ?";
  // initialize and prepare statement
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
    $_SESSION['authenticated'] = 'JRU Designs';
	}
  // if no match, destroy the session and prepare error message
  else {
    $_SESSION = array();
	session_destroy();
	$error = 'Invalid username or password';
	}
  // if the session variable has been set, redirect
  if (isset($_SESSION['authenticated'])) {
	// get the time the session started
	$_SESSION['start'] = time();
	header('Location: admin.php');
	exit;
	}
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>


<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/reset.css" />
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
		
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="admin.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
 <span class="logout"><a href="../index.php">Go Back to the site</a></span>
      				<form action="" method="post">
					  	<label>Username:</label><input name="username" size="13" />
						<label>Password:</label> <input type="password" name="password" size="13" />
				
						<input type="submit" id="submit" name="login" value="Login" />
					</form>
				
				
				</div>  
	</div>



<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php //include('../includes/adminfooter.php'); ?>

</body>
</html>