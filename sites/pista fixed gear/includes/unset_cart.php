<?php
session_start();
ob_start();
include('pistaFunctions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" href="../styles/slider_styles.css" />
<link rel="stylesheet" href="../styles/twitter_style.css" />



<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="../js/jquery.carouselLite.js"></script>
<script type="text/javascript" src="../js/jquery.easing.js"></script>
<script type="text/javascript" src="../js/twitter.js"></script>

<title>Pista Fixed Gear<?php echo "&#8212;{$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'>
	<a href='index.php'><div id='logo'><h1>PISTA FIXED GEAR</h1></div></a>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('sideNav.php');?>
	    </div><!--END OF SID EBAR-->
	    
	    <div class="cont">
<?php

//FOR TROUBLESHOOTING for when need to clear the session
		unset($_SESSION['cart']);
                unset($_SESSION['total_price']);
                unset($_SESSION['items']);
                unset($_SESSION['conf_msg']);
		echo "<h2>Your Cart Has Been Emptied</h2>";
		echo '<h2><a href="../items.php">Keep on shopping</a></h1>';
                echo '<h2><a href="../index.php">Continue checking out Pista</a></h1>';
		

		
?>
</div><!-- end of right cont-->
		<?php
		    if (isset($_SESSION['cart'])) {
			    include('displayCart.php');
		    }
	    
		 ?>

	    <?php include('navBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('footer.php');?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#slideshow ul').bxSlider({
            auto: true,
	    randomStart: true,
	    pause:5000,
	    speed:1000,
	    autoHover: true,
            pager: true                
        });
    });
    
$(function(){$(".featured").carousel( {
    dispItems: 2,
    effect: "vertical",
    loop: true,
    animSpeed: "slow",
    circular: true
    

    } );
  })

</script>

</body>
</html>