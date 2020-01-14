<?php
include('../includes/functions.php');
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
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
       

<h2>New blog</h2>


<p>Your blog has been updated.</p>
<p>Here is a preview</p>

<?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM blogtext
				ORDER BY blog_id DESC 
				LIMIT 1";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		$row = $result->fetch_assoc();
		$title = $row['blogHeader'];
		$body = nl2br($row['blogBody']);
		
		echo "<h2>$title</h2><br />";
		echo $body;
		
		
		
?>				</div>
<!--END CONTENT-->					
				</div>
		</div>


<!--NABVAR INCLUDE-->
<?php include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php include('../includes/adminfooter.php'); ?>

</body>
</html>