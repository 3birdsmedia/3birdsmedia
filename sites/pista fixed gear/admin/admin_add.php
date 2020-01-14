<?php 
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;

}else{	
include('../includes/pistaFunctions.php');


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
        <label for="date" style="display:none"><?php echo date('r');?></label>
        <input name="date" id="date" type="hidden" />
    </p>
    
    
 
        <input type="submit" name="insert" id="insert" value="Insert New Entry" />
    </p>
</form>


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