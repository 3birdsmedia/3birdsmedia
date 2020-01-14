<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
include('../includes/functions.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
    xml:lang="en"
    lang="en"
    dir="ltr">
<head>


 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds.">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  
 <meta name="description" content="Add your sites description here">
 <meta name="keywords" content="Add,your,site,keywords,here">
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen">
  <link rel="stylesheet" type="text/css" href="../css/nivo-slider.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../css/superfish.css" media="screen">
  <link rel="stylesheet" href="../css/svwp_style.css" type="text/css" media="screen" />
  
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/superfish.js"></script>
  <script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
  
  <script type="text/javascript" src="../js/jquery.slideViewerPro.1.0.js" ></script> 
  <script type="text/javascript" src="../js/jquery.timers.js"></script>
  <script type="text/javascript" src="../js/jquery.lightbox-0.5.js"></script> 
  
  <script type="text/javascript">
// initialize plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
</script>

</script>

<!--[if lt IE 8]>
<style>
.prod-img span {
    display: inline-block;
    height: 100%;
}

.slideViewer ul li span {
    display: inline-block;
    height: 100%;
}
</style><![endif]-->


  
<title>CJT - <?php echo $sectionName; ?> </title>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

        <!-- Start: header -->
       <div id="header">
	     <div id="inner-header">
	      <a href="index.php"><span id="logo"><h1>CJT MOUNTING</h1></span></a>
              <span class='slogan'><h1>Products For Real Life</h1></span>
                <div class='info'>
                    <ul>
                        <li><a href="../contact.php#quote">Info Request</a></li>
                        <li><a href="../contact.php#registration">Register Product</a></li>
                    </ul>
                    <div id="contact">
                        <p>T: (714) 751-6295</p>
                        <p>F: (714) 751-5775</p>
                    </div>
                </div>
             </div>
	     <div id="right-header"></div>
	</div><!--End Header-->
