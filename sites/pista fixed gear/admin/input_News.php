<?php include('../includes/pistaFunctions.php');
	

//Checking if there is an input in the form
if (array_key_exists('insert', $_POST)) {

		//remove backslashes
	
		
		$news = $_POST['newsTitle'];
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
		
		
	}
		
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>


<title>Pista Fixed Gear<?php echo "&#8212;{$title}"; ?></title>
</head>

<body>

<div class='wrapper'>
<div id="bg"><img class="resizeBG" src="../images/bg.jpg" /></div>
	<div class="content">
            <div class="transparency">

<h2>Input Your Lastest News</h2>


<p>Your latest news have been added. </p>.
<p>Here is a preview</p>


<?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM newsfeed
				ORDER BY news_id DESC 
				LIMIT 1";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		$row = $result->fetch_assoc();
		$title = $row['newsTitle'];
		$body = stripslashes(nl2br($row['news_Text']));
		
		echo $title."<br />";
		echo $body;
		
		
		
?>

<div class="push"></div>

</div>
<!--Slides--> <div id="supersized"></div></div><!--END OF CONTENT-->

<?php include('../includes/adminNavBar.php');?>

</div><!--END OF WRAPPER-->

<div class="footer">
        <p>Copyright (c) 2008</p>
</div>

</body>
</html>