<?php
$title = ucwords(basename($_SERVER['SCRIPT_NAME'], '.php'));
$title = str_replace('_', ' ', $title);

if (strtolower($title) == 'index'){
    $title = 'Home';
}
error_reporting(E_ALL);
ini_set('display_errors', '1');


###################################################
#
#        DATABASE CONNECTION FUNCTION
#
#		FOR LOCALHOST
#
###################################################

    function dbConnect($type) {
        if ($type == 'query') {
            $user = '3bm_query';
            $pwd = 'Qwer_7777';
        } elseif ($type == 'admin') {
            $user = '3bm_admin';
            $pwd = 'Asdf_7777';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('localhost', $user, $pwd,'dresstoc_digiprint')
        or die ('Cannot open database');
        return $conn;
    }

###################################################
#
#        DATABASE CONNECTION FUNCTION
#
#		FOR FRIENDLY GODADDY
#
###################################################
 /*   function dbConnect($type) {
        if ($type == 'query') {
            $user = 'Query3bm';
            $pwd = 'Qwer_7777';
        } elseif ($type == 'admin') {
            $user = 'admin3bm';
            $pwd = 'Asdf_7777';
        }else{
            exit('Unrecognized connection type');
        }

        $conn = new mysqli('admin3bm.db.9130702.hostedresource.com', $user, $pwd,'admin3bm')
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
		case "details.php":
			return "Our Current Products";
			break;
		case "about.php":
			return "About  Digiprint";
			break;
		case "contact.php":
			return "Contact Us";
			break;
		case "news.php":
			return "Latest Digiprint";
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
#        YEAR DROPDOWN
#
#################################################################



function expirationYear() {
			ini_set('date.timezone', 'America/Los_Angeles');
			$thisYear = date('Y');

$year = date ('Y');
$years = range ($year, $year + 10);

echo '<select name="exp_year">';
foreach ($years as $value) {echo '<option value="$value">' . $value;}
echo '</select>';

}



#################################################################
#
#        RANDOM PICTURE
#
#################################################################



function randPicture(){
	include ('connection.php');
	//connecting to database
	$conn= dbConnect('query');

	//preparing sql statement
	$sql= 'SELECT * FROM images
		ORDER by RAND()
		LIMIT 1';

	//adding the result to a variable
	$result= $conn->query($sql) or die(mysqli_error());

		while ($numPics = $result->fetch_assoc()){
			echo '<img src="images/'.$numPics['image_name'].'" width="500"/>';
		}
	};


#################################################################
##
#################################################################

function getcat($cat_id){




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

        $chars = 250;



        $text = $text." ";

        $text = substr($text,0,$chars);

        $text = substr($text,0,strrpos($text,' '));

        $text = $text."\"...<span id='excerpt'><a href='news.php'>Read More</a></span>";

        return $text;
}


function getpost($var) {

    if (isset($_GET[$var])){

	$number = $_GET[$var];

	echo 'active:'.$number.',';

   }else{

   }

}



#################################################################
#
#       GET the extention from the file
#
#################################################################


//by calling this function inside the value attribute of a form field, the field will be kept 'filled' on submit, for PHP validation
//works with the $_POST array

//to use simply call the function inside the value attribute
// i.e. <label>*Name:</label><input type="text" id="name" name="name" class='required' value="(--insert php tags here--) prefill('name'); (--and here--)" />
//the argument required is the name of the form field used

function prefill($field){
    //echo $field;
      if (isset($_POST[$field])){
        echo $_POST[$field];
    }else{
        return "";
    }
}

#################################################################
#
#       GET LOCATION FROM SESSION
#
#################################################################

 //Once the session has started this will assing the adress to variables for use throught the site
 if(isset($_SESSION['loggedin'])){
	$member_id = $_SESSION['member_id'];

	$conn = dbConnect('query');

	$sql2 = 'SELECT * FROM member WHERE member_id = '.$member_id.'';
	//echo "<h1>$member_id</h1>";
				  //submit the SQL query to the database and get the result
				  $result2 = $conn->query($sql2) or die(mysqli_error());

				    while ($row2 = $result2->fetch_assoc()) {
				   	$firstname =	ucwords(strtolower($row2['member_fname']));
					$lastname =		ucwords(strtolower($row2['member_lname']));
					$username =		ucwords(strtolower($row2['username']));
					$email =		ucwords(strtolower($row2['email']));
					$street =	ucwords(strtolower($row2['street']));
					$city =		ucwords(strtolower($row2['city']));
					$state =	ucwords(strtoupper($row2['state']));
					$zip =		ucwords(strtolower($row2['zip']));
					}
/*	member_fname 	char(20)
	member_lname 	char(20)
	street 	char(40)
	city 	char(40)
	state 	char(20)
	zip 	char(10)
	username 	varchar(40)
	password 	varchar(32)
	email*/

					dbClose($conn);
}


#################################################################
#
#				FORMAT PHONE
#
#################################################################

/**
 * FORMATPHONE
 * Converts phone numbers to the formatting standard
 *
 * @param   String   $num   A unformatted phone number
 * @return  String   Returns the formatted phone number
 */
function formatPhone($num)
{
     $num = preg_replace('/[^\d]/', '', $num); //Remove anything that is not a number


    $len = strlen($num);
    if($len == 7)
        $num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $num);
    elseif($len == 10)
        $num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $num);

    return $num;
}

// echo formatPhone('1 208 - 386 2934');
// will print: (208) 386-2934


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
						$con_number = $row['member_id'].'-'.$row['order_id'].'-'.preg_replace(array('/\:/', '/\s/','/\s\s+/'), '', $row['date']);
						echo "<td>$con_number</td>"; //for troubleshooting

			    }
			    dbClose($conn);
}



#######################################################################
##
##
## GET THE PERCENTAGE INCREASE
##
##
#######################################################################
function  getPercent($original_price){
	$conn = dbConnect('query');
		  //  $imgresult = $conn->query($imgSql) or die(mysqli_error());
		$perSql =  "SELECT percent
					FROM percent
					WHERE percent.percent_id = 1
					LIMIT 1";

			$percent = mysqli_fetch_array($conn->query($perSql));
			$percent = $percent['percent'];

			$updated_price = $original_price + ($original_price * ($percent/100));

		dbClose($conn);
			//echo $price;
			return $updated_price;

}

#######################################################################
##
##
## GET THE ORDER ID
##
##
#######################################################################
function  getOrderID(){
	$conn = dbConnect('query');
		  //  $imgresult = $conn->query($imgSql) or die(mysqli_error());
		$orderSql =  "SELECT order_id
					FROM orders
					ORDER BY orders.order_id DESC
					LIMIT 1";

			$order = mysqli_fetch_array($conn->query($orderSql));
			$order = $order['order_id'];


		dbClose($conn);
			//echo $price;
			return $order;

}


######################################################################
##
## FEATURE/TOP SELLER FUNCTION
##
#######################################################################

function pullSingleProduct($type){
  //CONNECTING TO MYSQL WITH QUERY RIGHTS
  $conn = dbConnect('query');

  if ($type = "topseller"){
      //preparing the sql query
     $sql =   "SELECT SUM(quantity) AS total, prod_id FROM order_items
              GROUP BY prod_id
              ORDER BY total DESC
              LIMIT 1"
  }else{
      $sql = "SELECT *
      FROM products,prod_img_lookup, images
      WHERE products.prod_id = prod_img_lookup.prod_id
      AND prod_img_lookup.img_id = images.img_id
      ORDER by RAND()
      LIMIT 1";
  }

  // submit the query and capture the result or die in the process jajaja!!!
  $result = $conn->query($sql) or die(mysqli_error());
  //echo ($result);
  // Lets count the results
  $numRows = $result->num_rows;
  while ($row = $result->fetch_assoc()) {
    echo '<a href="product_detail.php?prod_id='.$row['prod_id'].' ">';
    echo '<img  src="images/products/' . $row['img'] . '" width="150" />';
    echo '</a>';
  };

}

