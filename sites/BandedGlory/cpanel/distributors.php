<?php
session_start();
ob_start();
include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>

<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->

	    <div class="cont">

		<h2>Design Pros, Inc.</h2>

            <div id="info">

            <p>2730 S. Harbor Blvd., Suite B</p>

            <p>Santa Ana, Ca 92704</p>

            <p>Tel: 877.644.3073</p>

            <p>Fax: 714.850.1633</p>

            <p>Business Hours: 10am-6pm, Mon-Fri.

            </div>



            <div id="map">

            <iframe width="300" height="125" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;msa=0&amp;msid=209999337986471854745.0004a1493bf4ca21f244e&amp;ll=33.710632,-117.91935&amp;spn=0.028559,0.051327&amp;z=13&amp;output=embed"></iframe><br /><small>View <a href="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;msa=0&amp;msid=209999337986471854745.0004a1493bf4ca21f244e&amp;ll=33.710632,-117.91935&amp;spn=0.028559,0.051327&amp;z=13&amp;source=embed" style="color:#0000FF;text-align:left">Design Pros Inc</a> in a larger map</small>

            </div>



	</div><!--END OF CONT-->
	</div><!--END OF CONT-->


		<?php
		    if (isset($_SESSION['cart'])) {
			    include('includes/displayCart.php');
		    }

		 ?>

	    <?php include('includes/navBar.php');?>
	</div><!--END OF CONTENT-->

	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>
