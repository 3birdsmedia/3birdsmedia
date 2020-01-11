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
<link rel="icon" href="images/favicon.ico" />


<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>

<!--styles-->
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>


<title>Tan You're It! <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
    	<div id="main">
        	<div id="header">
            	<a href="admin.php" id="logo"><h1>Tan You're It!</h1></a>	
			       	<div id="cont">
<span class="logout"><a href="../includes/logout.php">LOGOUT</a></span>
					<div id="left-cont">
<a href="admin.php"><h3>Back to the Control Panel</h3></a>
        

<h2>New Promo</h2>


<p>Your new promo has been added!</p>
<p>Here is a preview</p>

<?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM promos
				ORDER BY promo_id DESC 
				LIMIT 1";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		$row = $result->fetch_assoc();
		$title = $row['promo'];
		$body = nl2br($row['promo_desc']);
		
		echo $title."<br />";
		echo $body;
		
		
		
?>
</div><!--End of cont-->
<!--NABVAR INCLUDE-->
<?php //include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->
<?php //include('../includes/adminfooter.php'); ?>

</body>
</html>