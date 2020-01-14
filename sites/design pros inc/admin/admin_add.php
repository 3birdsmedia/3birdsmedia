<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: admin.php');
	exit;
	
	include("../includes/connection.php");

		function dbConnect($type) {
				if ($type == 'query') {
					$user = 'brennan_Query';
					$pwd = 'qwer77';
				} elseif ($type == 'admin') {
					$user = 'brennan_Admin';
					$pwd = 'asdf77';
				}else{
					exit('Unrecognized connection type');
				}
		
				$conn = new mysqli('localhost', $user, $pwd, 'brennah_db')
				or die ('Cannot open database');
				return $conn;
			}
			
		function dbClose($conn) {
			mysqli_close($conn);
		}



//Checking if there is an input in the form
	if (array_key_exists('insert', $_POST)) {


		
		$news = $_POST['newsTitle'];
		echo 'New entry \" '.$news.' \" was added<br />';
			
		
		echo $_POST['newsTitle'] . "</br>";
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST to check it
		print_r($_POST);
		echo $_POST['news_Text'] . "</br>";
		echo $_POST['date']. "</br>";
		
		
		//echo $_POST['frame_desc'] . "</br>";
		
		
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
			
			$stmt->bind_param('sts', $_POST['newsTitle'], $_POST['news_Text'], $_POST['date']);
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
 <?php 
        //connect to the database as a query just for display
	//$conn = dbConnect('admin');
 ?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Brennan Harvey</title>
<script type="text/javascript"></script>
	
	<style type="text/css" media="all">
		@import "../brennanharvey.css";
		
* {
	margin: 0;
}

html, body {
	height: 100%;
}
.wrapper {
	min-height: 100%;
	height: auto !important;
	height: 100%;
	margin: 0 auto -4em;
}
., .push {
	height: 4em;
}

	</style>
	
</head>

<body>
<div class='wrapper'>
	<div id="bodytext"> 

	<h2>Login Succesful</h2>
    
    <p>Input your new article</p>
    
    
<form id="insert" name="insert" method="post" action="input_news.php">
    <p>
        <label for="newsTitle">News Title:</label>
        <input name="newsTitle" id="newsTitle" type="text" size="50" maxlength="50" />
    </p>
    
    <p> <label for="news_Text">Input the body of your text</label>
		<!--<input name="news_Text" id="news_Text" type="text" size="50" maxlenth="25000" style="overflow:scroll;" />-->
        <textarea cols="60" rows="25" name="news_Text" id="news_Text"></textarea>
        <label for="date" style="display:none"><?php echo date(r);?></label>
        <input name="date" id="date" type="hidden" />
    </p>
    
    
 
        <input type="submit" name="insert" id="insert" value="Insert New Entry" />
    </p>
</form>
	<?php
       function dbClose($conn) {
	mysqli_close($conn);
}
    ?>

    
</div>



<div id="pageheader"> </div>

<div id="pagetop"> </div>

<div id="pageleft"> </div>

<div id="pageright"> </div>

<div id="pagebottom"> </div>

<div id="textbox"> </div>

<div id="topnav"> </div>

<div id="sidenavi"> </div>




<div id="topnavi">
	<ul id="nav_top">
		<li id='nav_home'><a href="../index.html"><span>Home</span></a></li>
		<li id='nav_about'><a href="../about.html"><span>About</span></a></li>
		<li id='nav_book'><a href="../book.html"><span>Book</span></a></li>
		<li id='nav_contact'><a href="../contact.php"><span>Contact</span></a></li>
	</ul>
</div>

<div id="sidenavi">
	<ul id="nav_right">
		<li id='nav_news'><a href="../news.php"><span>News</span></a></li>
		<li id="nav_events"><a href="../events.html"><span>Events</span></a></li>
		<li id="nav_media"><a href="../media.html"><span>Media</span></a></li>
		<li id="nav_press"><a href="../press.html"><span>Press</span></a></li>
		<li id="nav_faq"><a href="../faq.html"><span>F.A.Q.</span></a></li>
		<li id="nav_links"><a href="../links.html"><span>Links</span></a></li>
	</ul>
</div>

<div class="push"></div>
</div><!--end of wrapper-->
<div class="">
          <p>Copyright (c) 2008</p>
</div>


</body>
</html>