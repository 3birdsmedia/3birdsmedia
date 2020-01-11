<?php
include('../includes/functions.php');
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;

	



//Checking if there is an input in the form
	if (array_key_exists('insert', $_POST)) {

		//remove backslashes
	
		
		$news = $_POST['homeHeader'];
		/*FOR TROUBLE SHOOTING!!!echo 'New entry \" '.$news.' \" was added<br />';
			
		
		echo $_POST['newsTitle'] . "</br>";
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST tsao check it
		print_r($_POST);
		echo $_POST['news_Text'] . "</br>";
		echo $_POST['date']. "</br>";
		
		
		//echo $_POST['frame_desc'] . "</br>";
		
		*/
		//FLagg it up!
		$done = false;
		
		
		//create database connection ADMIN
		$conn = dbConnect('admin');
		
		//create SQL 
		$sql =  'INSERT INTO newsfeed (newsTitle, news_Text, date)
				VALUES (?, ?, ?)';
		
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			
			$stmt->bind_param('sss', $_POST['newsTitle'], $_POST['news_Text'], $_POST['date']);
			//$stmt->bind_param('ss', $_POST['crank_id'], $_POST['crank']);
			$done = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		}
		
		if ($done) {
			header('Location: input_News.php'); //Takes us to the check page
			exit;
		} else {
			echo $stmt->error;
		}
		
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>

<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>

<title>JRu Admin <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
<div id="wrap">      
    	<div id="main">
            
       	<div id="cont">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
        

<h2>Input Your Lastest News</h2>


<p>Your latest news have been added. </p>.
<p>Here is a preview</p>


<?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM homeText
				ORDER BY text_id DESC 
				LIMIT 1";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		$row = $result->fetch_assoc();
		$title = $row['homeHeader'];
		$body = nl2br($row['homeBody']);
		
		echo $title."<br />";
		echo $body;
		
		
		
?>
</div><!--End of cont-->
<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php include('../includes/adminfooter.php'); ?>

</body>
</html>