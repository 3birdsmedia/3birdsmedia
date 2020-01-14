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
	
		
		$title = $_POST['homeHeader'];
		/*FOR TROUBLE SHOOTING!!!*/
		//echo 'New entry \" '.$title.' \" was added<br />';
			
		
		//echo $_POST['homeHeader'] . "</br>";
		//MY BFF!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
		//for troublshooting: print out each item from the $_POST tsao check it
		//print_r($_POST);
		//echo $_POST['homeBody'] . "</br>";
		//echo $_POST['date']. "</br>";
		
		
		//echo $_POST['frame_desc'] . "</br>";
		
		
		//Flag it up!
		$done = false;
		
		
		//create database connection ADMIN
		$conn = dbConnect('admin');
		
		//create SQL 
		$sql =  'INSERT INTO homeText (homeHeader, homeBody, date)
				VALUES (?, ?, ?)';
		
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			
			$stmt->bind_param('sss', $_POST['homeHeader'], $_POST['homeBody'], $_POST['date']);
			
			$done = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		}
		
		if ($done) {
			header('Location: homeCheck.php'); //Takes us to the check page
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
<!--<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>-->
<script type="text/javascript" src="wyzz.js"></script>

<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/reset.css" />


<style type="css/text">
</style>
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="admin.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
<span class="logout">
			<a href="admin.php"><h4>CONTROL PANEL</h4></a>
			<a href="../includes/logout.php"><h4>LOGOUT</h4></a>
</span>

					<div id="left-cont">

						<?php
							//if the form has been submitted, display result
						if (isset($msg)) {
							echo "<div id='msg'>$msg</div>
							<p>You may also go back to the <a href='uProj.php'>project list</a> or to the <a href='admin.php'>Control Panel</a></p>";
						}else{
							echo "<h2>Edit the Home Page</h2>";
							echo "<p>Here you can edit the wording on the 3 calls to action. To change the content, simply type in the
							new content in the inputs, then click 'Save Changes'.</p>
							<p>You may also go back to the <a href='admin.php'>Control Panel</a></p>";
						}
						?>
					</div>
					<div id="right-two">
    
    
							<form id="insert" name="insert" method="post" action="">
		
								<label for="homeHeader">Home Page Title:</label>
								<input name="homeHeader" id="homeHeader" type="text" size="50" maxlength="50" />
					
							    
							   <label for="homeBody">Input the body of your text</label>
									<!--<input name="news_Text" id="news_Text" type="text" size="50" maxlenth="25000" style="overflow:scroll;" />-->
								<textarea cols="60" rows="25" name="homeBody" id="homeBody"></textarea>
								<script language="javascript1.2">
									make_wyzz('homeBody');
								</script>
								
								<input name="date" id="date" type="hidden" value="<?php echo date('r');?>" />
						
		    
		    
		 
								<input type="submit" name="insert" id="insert" value="Save Changes" />
				
							</form>
					</div>
<!--END CONTENT-->					
				</div>
		</div>


<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php include('../includes/adminfooter.php'); ?>

</body>
</html>