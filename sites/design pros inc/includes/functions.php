<?php

$title = ucwords(basename($_SERVER['SCRIPT_NAME'], '.php'));
$title = str_replace('_', ' ', $title);

if (strtolower($title) == 'index'){
    $title = 'home';
}



###################################################
#
#        DATABASE CONNECTION FUNCTION
#
###################################################



    function dbConnect($type) {
        if ($type == 'query') {
            $user = 'dresstoc_3bmQ';
            $pwd = 'Qwer_7777';
        } elseif ($type == 'admin') {
            $user = 'dresstoc_3bmA';
            $pwd = 'Asdf_7777';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd,'dresstoc_designpros')
        or die ('Cannot open database');
        return $conn;
    }
    

###################################################
#
#              TO CLOSE THE DB
#
###################################################

function dbClose($conn) {
	mysqli_close($conn);
}



###################################################
#
#        Section Name Function
#
###################################################

function setSectionName() {
	//This is to set an automatic page name function
	
	// the function 'basename" extracts the filename off of a filepath, with SERVER SCRIPT NAME we get this path
	
	$currentPage = basename($_SERVER['SCRIPT_NAME']);
	
	//set page name based on $currentPage
	
	switch ($currentPage) {
		case "index.php":
			return "Home";
			break;
		case "about.php":
			return "About";
			break;
		case "contact.php":
			return "Contact Us";
			break;
		
		default:
			return ""; //set the variable to an empty string to prevent the wrong section name
	}
}


##################################################################
#
#Function that strips out backslashes for security
#Written by David Powers, and included in the codebase for "PHP Solutions: Dynamic Web Design Made Easy"
#
#################################################################

function nukeMagicQuotes() {
  if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) {
      $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
      return $value;
      }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    }
  }

#################################################################
#
#        COPYRIGHT CODE
#
#################################################################



function setCopyright($startYear) {
			ini_set('date.timezone', 'America/Los_Angeles');
			$thisYear = date('Y');
			
			if ($startYear == $thisYear) {
				echo $startYear;
			} else {
				echo "$startYear - $thisYear";
			}
}


#################################################################
#
#        TRUNCATE TEXT
#
#################################################################
  
#Add this to your page:
#echo truncText($text);
#where $text is the text you want to shorten.

#Example
#Test it using this in a PHP page:
#include "shortentext.php";
#$text = "The rain in Spain falls mainly on the plain.";
#echo truncText($text);
 
  function truncText($text) {



        // Change to the number of characters you want to display

        $chars = 150;



        $text = $text." ";

        $text = substr($text,0,$chars);

        $text = substr($text,0,strrpos($text,' '));

        $text = $text."\"...<a href='testimonials.php'>Read More</a>";

        return $text;
}

#################################################################
#
#       GET INFO FROM THE POST
#
#################################################################

function getpost($var) {
    if (isset($_GET[$var])){
	$number = $_GET[$var];
	echo 'active:'.$number.',';
   }else{
   }
}




