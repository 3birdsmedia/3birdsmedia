<?php
include('../includes/functions.php');
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
header('Location: index.php');
exit;

}else{

nukeMagicQuotes();

//Checking if there is an input in the form
if (array_key_exists('insert', $_POST)) {
//remove backslashes
if (isset($_POST['event_name']) && $_POST['event_date'] !== ''){
	if (isset($_POST['event_date']) && $_POST['event_date'] !== '' && $_POST['event_date'] !== '<br>'){
		
		$title = $_POST['event_name'];
		/*FOR TROUBLE SHOOTING!!!*/
		//echo 'New entry \" '.$title.' \" was added<br />';
			
		
		//echo $_POST['promoHeader'] . "</br>";
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST tsao check it
		//print_r($_POST);
		//echo $_POST['promoBody'] . "</br>";
		//echo $_POST['date']. "</br>";
		
		
		//echo $_POST['frame_desc'] . "</br>";
		
		
		//Flag it up!
		$done = false;
		
		
		//create database connection ADMIN
		$conn = dbConnect('admin');
		
		//create SQL 
		$sql =  'INSERT INTO events (event_name, event_desc, event_date)
				VALUES (?, ?, ?)';
		
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			
			$stmt->bind_param('sss', $_POST['event_name'], $_POST['event_desc'], $_POST['event_date']);
			
			$done = $stmt->execute();
			// free the statement for the next query
			$stmt->free_result();
		}
		
		if ($done) {
			header('Location: event_Check.php'); //Takes us to the check page
			exit;
		} else {
			echo $stmt->error;
		}
	}else{
		$msg = "People need to know when the event is ;) give them a date";
	}
}else{
	$msg = "Oops, You need a name for your event";
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
<!--<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>-->
<script type="text/javascript" src="wyzz.js"></script>
<!--styles-->
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />
<style type="text/css">
#header {display:block;position:relative;height:100px; width:100%;}
</style>


<title>DJ Soosk CPanel <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
<div id="wrap">      
<div id="main">
<div id="header">
<a href="index.php" id="logo"><h1>Tan You're It!</h1></a>
<?php //include('includes/navBar.php');?>
</div>

<div id="cont">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
			<div id="left-cont">
<a href="admin.php"><h3>Back to the Control Panel</h3></a>
	<?php
	//if the form has been submitted, display result
	if (isset($msg)) {
	echo "<div id='msg'>$msg</div>
	<p>You may also go back to the <a href='admin.php'>Control Panel</a></p>";
	}else{
		echo "<h2>Add an Event</h2>";
		echo "<p>Here you can add upcoming events to display in your events page'.</p>
		<p>You may also go back to the <a href='admin.php'>Control Panel</a></p>";
	}
	?>
	</div>
	<div id="right-two">
		<form id="insert" name="insert" method="post" action="">
		<label for="event_name">Event Name:</label>
		<input name="event_name" id="promoHeader" type="text" size="50" maxlength="50" />
		
		<label for="event_desc">Event Description:</label>
		<textarea name="event_desc" id=""event_desc""  size="160" maxlength="160"> </textarea>
		
		<label for="event_date">Event Date: (Y/M/D/ time)</label>
		<input name="event_date" id="event_date" type="text" size="50" maxlength="50" />
					    		
		<input type="submit" name="insert" id="insert" value="Save Changes" />
		</form>
	</div>
<!--END CONTENT-->					
		</div>
</div>


<!--NABVAR INCLUDE-->
<?php //include('../includes/adminNavBar.php');?>

</div><!--END OF Main-->
<?php //include('../includes/adminfooter.php'); ?>

</body>
</html>