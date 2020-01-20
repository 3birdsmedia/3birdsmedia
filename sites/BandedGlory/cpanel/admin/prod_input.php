<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");
if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}else{
//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  

//and it will be changed to 1 if an errro occures.  

//If the error occures the file will not be uploaded.
$errors=0;

//checks if the form has been submitted
//print_r($_POST);
 if(isset($_POST['submit'])) {
//print_r($_FILES);

$msg = '';
   if(trim($_POST['prod_name']) == ''){
      $msg = 'Please enter a product name<br />';
      $errors = 1;
   }
   if(trim($_POST['prod_number']) == '')
   {
      $msg = $msg.'Please enter a number for the product<br />';
	$errors = 1;
   }
   if(trim($_POST['prod_desc']) == '')
   {
      $msg = $msg.'Please enter a description<br />';
	$errors = 1;
   }elseif($errors == 0){
			
	nukeMagicQuotes();
	unset($_SESSION['batch']);
		
	//define a maxim size for the uploaded images in Kb
	//100 = 1mb aprox
	
	//print_r ($_FILES);
	if(isset($_POST['submit'])) {
	define ("MAX_SIZE","5000");
				 
	$errors = 0;
	
	$msg = '';
        
	foreach ($_POST as $key => $value) {
	if ($value == "") {$value = "Not Specified";}
	$msg =   $msg.ucwords(str_replace('_', ' 