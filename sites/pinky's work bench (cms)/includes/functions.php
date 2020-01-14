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
            $user = 'pwbQuery';
            $pwd = 'QWERY7777q';
        } elseif ($type == 'admin') {
            $user = 'pinkyadmin';
            $pwd = 'pwbAdmin12';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd, 'pinkysdb')
//	$conn = new mysqli('pinkyadmin.db.5853813.hostedresource.com', $user, $pwd, 'pinkyadmin')
        or die ('Cannot open database');
        return $conn;
    }

/*
function dbConnect($type) {
        if ($type == 'query') {
            $user = 'dresstoc_Query';
            $pwd = 'QWERY7777';
        } elseif ($type == 'admin') {
            $user = 'dresstoc_3bmA';
            $pwd = 'Asdf_7777';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd,'dresstoc_pinkys')
        or die ('Cannot open database');
        return $conn;
    }
*/
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
		case "news.php":
			return "News";
			break;
		case "showroom.php":
			return "Showroom";
			break;
		case "products.php":
			return "Products";
			break;
		case "resources.php":
			return "Resources/Support";
			break;
		case "pricelist.php":
			return "Pricelist";
			break;
		case  "contact.php":
			return "Contact Us";
			break;
		case  "imageUpload.php":
			return "Upload an image";
			break;
		
		default:
			return "Mounting"; //set the variable to an empty string to prevent the wrong section name
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