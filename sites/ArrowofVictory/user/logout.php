<?php
include('../includes/functions.php');
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;

	}else{
	//empty the $_SESSION array
	$_SESSION = array();
	//invalidate the session cookie
	if (isset($_COOKIE[session_name()])) {
		setCookie(session_name(), '', time()-86400, '/');
	}
	//end session and redirect
	session_destroy();
	header('Location: ../index.php');
	exit;
}
	
?>
