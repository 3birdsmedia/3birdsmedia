<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}else{ 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../images/favicon.ico" />

<!--js-->
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<!--<script type="text/javascript" src="../js/jquery.lavalamp-1.3.5.js"></script>-->

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
						<h2><a href="admin.php">Control Panel</a></h2>
						<p>Click on one of the links to edit the desired section of the site. If you need to get back to this page at any moment, click on the logo or back buttons.</p>
						
					</div>
					
					<div id="right-two">
						<h3><a href="add_event.php">add Event</a></h3>
						<h3><a href="delete_event.php">Delete Event</a></h3>
						
						<h3><a href="Update_Images.php">Gallery Page</a></h3>
						<p>Add, edit and delete the images</p>
						
						
					</div>
<!--END CONTENT-->					
				</div>
		</div>


<!--NABVAR INCLUDE-->
<?php //include('../includes/adminNavBar.php');?>

		</div><!--END OF Main-->

</body>
</html>