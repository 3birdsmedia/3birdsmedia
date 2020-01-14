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
        
<h2>Welcome to your Control Panel</h2>

<p>Here you can add, delete or update any product or category.</p>

<p>What do you wanna do?</p>

<h3>Products</h3>
<p><a href="prod_list.php">Take a look at the products you have</a></p>

<p><a href="prod_input.php">Add a new product</a></p>
<p><a href="chain_list.php">List the your chains</a></p>

<h3>Categories</h3>
<p><a href="cat_list.php">List the your categories</a></p>


<h3>Home</h3>
<p><a href="home_list.php">Update your home page</a></p>


<h3>About</h3>
<p><a href="about_update.php">Update your about page</a></p>

<h3>FAQ</h3>
<p><a href="faq_list.php">Update your FAQs page</a></p>
</div>

</body>
</html>
