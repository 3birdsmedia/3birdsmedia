<?php
  include('../includes/pistafunctions.php');
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
  $sql = "SELECT password FROM users WHERE username = ?";
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
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/slider_styles.css" />
<link rel="stylesheet" href="../styles/twitter_style.css" />



<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="../js/jquery.carouselLite.js"></script>
<script type="text/javascript" src="../js/jquery.easing.js"></script>
<script type="text/javascript" src="../js/twitter.js"></script>

<title>Pista Fixed Gear<?php echo "&#8212;{$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'>
	<a href='index.php'><div id='logo'><h1>PISTA FIXED GEAR</h1></div></a>
    </div>
	<div class="content">

	    
	    <div class="cont">

	<form action="" method="post">
		<p>Username: <input name="username" size="13" /></p>
		<p>Password: <input type="password" name="password" size="13" /></p>
	
    	<input type="submit" name="login" value="Login" />
	</form>
</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
</div>

<div class="footer">
<?php include('../includes/adminfooter.php');?>


</script>

</body>
</html>