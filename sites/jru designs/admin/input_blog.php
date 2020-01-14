<?php
include('../includes/functions.php');
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;

	}else{	



//Checking if there is an input in the form
	if (array_key_exists('insert', $_POST)) {

		//remove backslashes
	
		
		$title = $_POST['aboutHeader'];
		/*FOR TROUBLE SHOOTING!!!*/
		echo 'New entry \" '.$title.' \" was added<br />';
			
		
		echo $_POST['aboutHeader'] . "</br>";
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST tsao check it
		print_r($_POST);
		//echo $_POST['aboutBody'] . "</br>";
		//echo $_POST['date']. "</br>";
		
		
		//echo $_POST['frame_desc'] . "</br>";
		
		
		//FLagg it up!
		$done = false;
		
		
		//create database connection ADMIN
		$conn = dbConnect('admin');
		
		//create SQL 
		$sql =  'INSERT INTO aboutText (aboutHeader, aboutBody, date)
				VALUES (?, ?, ?)';
		
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			
			$stmt->bind_param('sss', $_POST['aboutHeader'], $_POST['aboutBody'], $_POST['date']);
			
			$done = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		}
		
		if ($done) {
			header('Location: aboutCheck.php'); //Takes us to the check page
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


<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>
<script type="text/javascript" src="wyzz.js"></script>

<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/reset.css" />
<style type="css/text">
</style>

<title>JRu Admin <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
<div id="wrap">      
    	<div id="main">
            
       	<div id="cont">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
        

<h2>New about body</h2>


<p>Input your new A bout page content</p>
    
    
<form id="insert" name="insert" method="post" action="updateAbout.php">
    <p>
        <label for="aboutHeader">About Page Title:</label>
        <input name="aboutHeader" id="aboutHeader" type="text" size="50" maxlength="50" />
    </p>
    
    <p> <label for="aboutBody">Input the body of your text</label>
		<!--<input name="news_Text" id="news_Text" type="text" size="50" maxlenth="25000" style="overflow:scroll;" />-->
        <textarea cols="60" rows="25" name="aboutBody" id="aboutBody"></textarea>
	<script language="javascript1.2">
		make_wyzz('aboutBody');
	</script>
        <label for="date"><?php echo date('r');?></label>
        <input name="date" id="date" type="hidden" value="<?php echo date('r');?>" />
    </p>
    
    
 
        <input type="submit" name="insert" id="insert" value="Insert New Entry" />
    </p>
</form>


</div><!--End of cont-->
<!--NABVAR INCLUDE-->

</body>
</html>