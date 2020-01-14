<?php
  include('../includes/functions.php');
  // process the script only if the form has been submitted
if (array_key_exists('login', $_POST)) {
  // start the session
  session_start();
  ob_start();  // need to buffer output - need this since adding logout via external file
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
    $_SESSION['authenticated'] = 'pinky';
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


<!--styles-->
<link rel="stylesheet" href="stylesheet.css" />
<style type="css/text">
</style>


<title>Pinky's Workbench <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
		<a href="admin.php"><div id="header">
		</div></a>
    <span class="logout"><a href="logout.php">Logout</a></span>
       	<div id="cont">
        
        <?php	if(isset($error)){echo $error;}; ?>

	<form action="" method="post">
		<p><label for="username"> Username:</label> <input name="username" size="13" /></p>
		<p><label for="password"> Password:</label> <input type="password" name="password" size="13" /></p>
	
    	<input id="submit" type="submit" name="login" value="Login" />
	</form>
	
        
        </div>  





</body>
</html>