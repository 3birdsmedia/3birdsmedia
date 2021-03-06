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
<script type="text/javascript" src="js/jquery.easing.js"></script>

<title>DigiPrint Products Corp. <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>DigiPrint Products Corp.</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->
	    
	    <div class="cont" id="resources">
		<h2>Resources</h2>	
            
            <div id="buttons">
            	<div id="videos" class="button">
                	<a href="videos.php" title="How to Videos"><h2>How-To <br/>Videos</h2></a>
                </div>
            	<div id="templates" class="button">
                	<a href="templates.php" title="Templates"><h2 style="margin-top:50px;">Templates</h2></a>
                </div>
            	<div id="artwork" class="button">
                	<a href="artwork.php" title="Artwork Guidelines"><h2>Artwork Guidelines</h2></a>
                </div>
            	<div id="tips" class="button">
                	<a href="tips.php" title="Tips & Instructions"><h2>Tips & Instructions</h2></a>
                </div>
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