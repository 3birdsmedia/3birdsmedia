<?php

//$url = $_SERVER['REQUEST_URI'];
//echo $url;

$root = "kovenant";


$title = ucwords(basename($_SERVER['SCRIPT_NAME'], '.php'));
$title = str_replace('_', ' ', $title);

if (strtolower($title) == 'index'){
    $title = 'Home';
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

        $conn = new mysqli('localhost', $user, $pwd,'dresstoc_craze')
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
			return "Homepage";
			break;
		case "catalog/index.php":
			return "Catalog";
			break;
		case "about.php":
			return "About";
			break;
    case "blog.php":
      return "Blog";
      break;
    case "contact.php":
      return "contact";
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
#        VALIDATE EMAIL
#
#################################################################
  

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = "local";

      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid =  "domain";
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid =  "dots";
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = "dots";
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = "valid domain";
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = "dots";
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = "local";
         }
      }
   }
   return $isValid;
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}