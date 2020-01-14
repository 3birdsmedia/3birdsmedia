<?php

// process the script only if the form has been submitted
if (array_key_exists('login', $_POST)) {
		// start the session
		session_start();
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		function dbConnect($type) {
								  //checks if type is equal to 'query'
								  if ($type == 'query') {
								  //user will be "psquery" and the password will be "fuji"
								  $user = 'brennan_Query';
								  $pwd = 'qwer77';
								  //if thats not the case it will check if it is equal to "admin"		
								  }elseif ($type == 'admin') {
								  //if this is true the then it will asign the value of $user to "psadmi
								  $user = 'brennan_admin';
								  //and the value of $pwd to "kyoto"
								  $pwd = 'asdf77';
								  //if all else fails, spit out this message
								  } else {
											  exit('Unrecognized connection type');
								  }
								
				// Connection code goes here
				
				// creates a variable that contains the values needed for conection
				// creates passes arguments to 'mysqli' which is an object
																		//if it fails to connect, spit out the message
				$conn = new mysqli('localhost', $user, $pwd, 'brennah_DB') or die ('Cannot open database');
				return $conn;
		}//END OF DB CONNECT
		
		
		
		// connect to the database as a restricted user
		$conn = dbConnect('query');
		
		// get the username's details from the database
		$sql = "SELECT password FROM users WHERE user_name = ?";
		// initialize and prepare statement
		$stmt = $conn->stmt_init();
		
		if ($stmt->prepare($sql)) {
				// bind the input parameter
				$stmt->bind_param('s', $username);
				// bind the result, using a new variable for the password
				$stmt->bind_result($storedPwd);
				$stmt->execute();
				$stmt->fetch();
		}
		
		if ($password == $storedPwd) {
			$_SESSION['authenticated'] = 'Add_Books';
			echo "Session started";
		}
		// if no match, destroy the session and prepare error message
		else {
				$_SESSION = array();
				session_destroy();
				$error = 'Invalid username or password';
				echo $error;
		}
		// if the session variable has been set, redirect
		if (isset($_SESSION['authenticated'])) {
		// get the time the session started
		header('Location: admin_add.php');
		exit;
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Brennan Harvey</title>
<script type="text/javascript"></script>
	
	<style type="text/css" media="all">
		@import "../brennanharvey.css";
		
		


form {

	position:relative;
}


	</style>
	
</head>

<body>

	<div id="bodytext"> 


	<form action="" method="post">
		<p>Username: <input name="username" size="13" /></p>
		<p>Password: <input type="password" name="password" size="13" /></p>
	
    	<input type="submit" name="login" value="Login" />
	</form>
	
</div>



<div id="pageheader"> </div>

<div id="pagetop"> </div>

<div id="pageleft"> </div>

<div id="pageright"> </div>

<div id="pagebottom"> </div>

<div id="textbox"> </div>

<div id="topnav"> </div>

<div id="sidenavi"> </div>




<div id="topnavi">
	<ul id="nav_top">
		<li id='nav_home'><a href="../index.html"><span>Home</span></a></li>
		<li id='nav_about'><a href="../about.html"><span>About</span></a></li>
		<li id='nav_book'><a href="../book.html"><span>Book</span></a></li>
		<li id='nav_contact'><a href="../contact.php"><span>Contact</span></a></li>
	</ul>
</div>

<div id="sidenavi">
	<ul id="nav_right">
		<li id='nav_news'><a href="../news.php"><span>News</span></a></li>
		<li id="nav_events"><a href="../events.html"><span>Events</span></a></li>
		<li id="nav_media"><a href="../media.html"><span>Media</span></a></li>
		<li id="nav_press"><a href="../press.html"><span>Press</span></a></li>
		<li id="nav_faq"><a href="../faq.html"><span>F.A.Q.</span></a></li>
		<li id="nav_links"><a href="../links.html"><span>Links</span></a></li>
	</ul>
</div>



</body>
</html>