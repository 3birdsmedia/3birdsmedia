<?php
$title = ucwords(basename($_SERVER['SCRIPT_NAME'], '.php'));
$title = str_replace('_', ' ', $title);

if (strtolower($title) == 'index'){
    $title = 'home';
}


####################################################
#
#		Google Analytics ID
#
###############################################


function googleAnalytics( $googleId ){
	echo '<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id='.$googleId.'"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag(\'js\', new Date());

			  gtag(\'config\', \''.$googleId.'\');
			</script>';
}

			
################################################
#
#        DATABASE CONNECTION FUNCTION
#
###################################################


function dbConnect($type) {
        if ($type == 'query') {
            $user = 'Apokaradokia_Q';
            $pwd = 'Qwer_7777';
        } elseif ($type == 'admin') {
            $user = 'Apokaradokia_A';
            $pwd = 'Asdf_7777';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd, 'stewardship_main')
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
			return "What is THERIDE";
			break;
		case "riders.php":
			return "TheRIDErs";
			break;
		case "contact.php":
			return "Send us a message";
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
#        breadcrums
#
#################################################################



function backlinks(){
	
	
$convert_toSpace = true;	// true if script should convert _ in folder names to spaces
$upperCaseWords = true;	// true if script should convert lowercase to initial caps
$topLevelName = "HOME";		// name of home/root directory
$separator = " &gt; ";		// characters(s) to separate links in hierarchy (default is a > with 2 spaces on either side)

// find index page in directory...
function MPBCDirIndex($dir) {
	$index = '';
	@$dir_handle = opendir($dir);
	if ($dir_handle) {
		while ($file = readdir($dir_handle)) {
			$test = substr(strtolower($file), 0, 6);
			if ($test == 'index.') {
				$index = $file;
				break;
				}
			}
		}
	return $index;
	}

// make clean array (trim entries and remove blanks)...
function MPBCTrimArray($array) {
	$clean = array();
	for ($n=0; $n<count($array); $n++) {
		$entry = trim($array[$n]);
		if ($entry != '') $clean[] = $entry;
		}
	return $clean;
	}

// function to prep string folder names if needed...
function MPBCFixNames($string) {
	global $convert_toSpace;
	global $upperCaseWords;
	if ($convert_toSpace) $string = str_replace('_', ' ', $string);
	if ($upperCaseWords) $string = ucwords($string);
	return $string;
	}

$server = (isset($_SERVER)) ? $_SERVER : $HTTP_SERVER_VARS;

$htmlRoot = (isset($server['DOCUMENT_ROOT'])) ? $server['DOCUMENT_ROOT'] : '';
if ($htmlRoot == '') $htmlRoot = (isset($server['SITE_HTMLROOT'])) ? $server['SITE_HTMLROOT'] : '';

$pagePath = (isset($server['SCRIPT_FILENAME'])) ? $server['SCRIPT_FILENAME'] : '';
if ($pagePath == '') $pagePath = (isset($server['SCRIPT_FILENAME'])) ? $server['SCRIPT_FILENAME'] : '';

$httpPath = ($htmlRoot != '/') ? str_replace($htmlRoot, '', $pagePath) : $pathPath;

$dirArray = explode('/', $httpPath);
if (!is_dir($htmlRoot.$httpPath)) $dirArray = array_slice($dirArray, 0, count($dirArray) - 1);

$linkArray = array();
$thisDir = '';
$baseDir = ($htmlRoot == '') ? '' : $htmlRoot;
for ($n=0; $n<count($dirArray); $n++) {
	$thisDir .= $dirArray[$n].'/';
	$thisIndex = MPBCDirIndex($htmlRoot.$thisDir);
	$thisText = ($n == 0) ? $topLevelName : MPBCFixNames($dirArray[$n]);
	$thisLink = ($thisIndex != '') ? '<a href="'.$thisDir.$thisIndex.'">'.$thisText.'</a>' : $thisText;
	if ($thisLink != '') $linkArray[] = $thisLink;
	}

$results = (count($linkArray) > 0) ? implode($separator, $linkArray) : '';
if ($results != '') print('<div class="backlinks">'.$results.'</div>');

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




#######################################################################
##
##
## TO create a confirmation number
##
##
#######################################################################

function createConfirm($order_id){
				$conn = dbConnect('query');
    
				$conSql = "SELECT * FROM orders WHERE order_id = $order_id ORDER BY order_id DESC LIMIT 1";
				// statement object already exists, so you just need to prepare it with the new SQL
				$result = $conn->query($conSql) or die(mysqli_error());
					while ($row = $result->fetch_assoc()) {
					   // echo $row['date'];
						$con_number = $row['member_id'].'-'.$row['order_id'].'-'.preg_replace(array('/\:/', '/\s/','/\s\s+/'), '', $row['date_requested']);
						return $con_number; //for troubleshooting
						
			    }
			    dbClose($conn);
}

