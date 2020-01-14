<?php
	
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Brennan Harvey</title>
<script type="text/javascript"></script>
	
	<style type="text/css" media="all">
		@import "brennanharvey.css";
	</style>
	
</head>

<body>

<div id="bodytext"> 


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
		
		echo "<h2>".$title."</h2>";
		echo $body;
		
		
		
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




<div id="bottomnavl1">

 					 	<a href="index.html"title="Home">Home</a> &nbsp;|&nbsp;
						<a href="about.html"title="About">About</a> &nbsp;|&nbsp;
                        <a href="book.html"title="Book">Book</a> &nbsp;|&nbsp;
                        <a href="contact.php"title="Contact">Contact</a>
</div>


<div id="bottomnavl2"> 	
						<a href="news.php"title="News">News</a> &nbsp;|&nbsp;
						<a href="events.html"title="Events">Events</a> &nbsp;|&nbsp;
                        <a href="media.html"title="media">Media</a> &nbsp;|&nbsp;
                        <a href="press.html"title="Press">Press</a> &nbsp;|&nbsp;
                        <a href="faq.html"title="F.A.Q.">F.A.Q.</a> &nbsp;|&nbsp;
                        <a href="links.html"title="Links">Links</a>
</div>





<div id="topnavi">
	<ul id="nav_top">
		<li id='nav_home'><a href="index.html"><span>Home</span></a></li>
		<li id='nav_about'><a href="about.html"><span>About</span></a></li>
		<li id='nav_book'><a href="book.html"><span>Book</span></a></li>
		<li id='nav_contact'><a href="contact.php"><span>Contact</span></a></li>
	</ul>
</div>

<div id="sidenavi">
	<ul id="nav_right">
		<li id='nav_news'><a href="news.php"><span>News</span></a></li>
		<li id="nav_events"><a href="events.html"><span>Events</span></a></li>
		<li id="nav_media"><a href="media.html"><span>Media</span></a></li>
		<li id="nav_press"><a href="press.html"><span>Press</span></a></li>
		<li id="nav_faq"><a href="faq.html"><span>F.A.Q.</span></a></li>
		<li id="nav_links"><a href="links.html"><span>Links</span></a></li>
	</ul>
</div>



</body>
</html>

