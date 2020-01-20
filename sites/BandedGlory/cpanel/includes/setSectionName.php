<?php
function setSectionName() {
	//This is to set an automatic page name function

	// the function 'basename" extracts the filename off of a filepath, with SERVER SCRIPT NAME we get this path

	$currentPage = basename($_SERVER['SCRIPT_NAME']);

	//set page name based on $currentPage

	switch ($currentPage) {
		case "index.php":
			return "Home";
			break;
		case "details.php":
			return "Our Current Products";
			break;
		case "about.php":
			return "About Banded Glory, LLC";
			break;
		case "contact.php":
			return "Contact Pista";
			break;
		case "news.php":
			return "Lately at Banded Glory, LLC";
			break;

		default:
			return ""; //set the variable to an empty string to prevent the wrong section name
	}
}
/*to call this function in a page, create a variable that will be assigned the return value of the function.  for example,
call the function like this:  $mySectionName = setSectionName();   You can then use $mySectionName throughout the page. */


?>
