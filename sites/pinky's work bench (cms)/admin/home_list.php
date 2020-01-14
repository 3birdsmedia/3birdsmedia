<?php

session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");


if (!isset($_SESSION['authenticated'])) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">

<title>Control Panel</title>
</head>

<body>
<div id='wrap'>
    <a href="admin.php">
        <div id="header">
        </div>
    </a>
    <span class="logout"><a href="logout.php">Logout</a></span>       

<h2>Home page control panel</h2>

<p>Here you can add, delete or update your homepage</p>

<p>What do you wanna do?</p>

<h3>Homepage paragraph</h3>
<p><a href="home_update.php">Update your homepage paragraph</a></p>

<h3>Front Image</h3>
<p><a href="image_update.php?img_id=1">Update your headshot</a></p>
<p><a href="banner_update.php">Update your frontbanner</a></p>

<div class="admin_images"> 
<h3>Left image</h3>
<p><a href="image_update.php?img_id=3">Update the Image on the left</a></p>
</div>

<div class="admin_images"> 
<h3>Center image</h3>
<p><a href="image_update.php?img_id=4">Update the Image on the middle</a></p>
</div>

<div class="admin_images"> 
<h3>Right image</h3>
<p><a href="image_update.php?img_id=5">Update the Image on the right</a></p>
</div>

</div>

</body>
</html>
