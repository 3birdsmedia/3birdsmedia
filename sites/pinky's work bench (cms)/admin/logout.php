<?php
// start the session
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
// clean the $_POST array and assign to shorter variables

	//empty the $_SESSION array
	$_SESSION = array();
	print_r ($_SESSION);
	//invalidate the session cookie
	if (isset($_COOKIE[session_name()])) {
		setCookie(session_name(), '', time()-86400, '/');
	}
	//end session and redirect
	session_destroy();
	header('Location: ../index.php');
	exit;


?>
