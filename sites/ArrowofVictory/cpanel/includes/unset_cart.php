<?php
session_start();
ob_start();
include('functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />


<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js">
<script type="text/javascript" src="../js/jquery.easing.js"></script>

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
		<?php include('sidenav.php');?>
	    <!--END OF SID EBAR-->
	    
	    <div class="cont">
<?php

//FOR TROUBLESHOOTING for when need to clear the session
		unset($_SESSION['cart']);
                unset($_SESSION['total_price']);
                unset($_SESSION['items']);
                unset($_SESSION['conf_msg']);
		echo "<h3>Your Cart Has Been Emptied</h3>";
		echo '<h3><a href="../products.php">Keep on shopping</a></h3>';
                echo '<h3><a href="../index.php">Back to Digiprint Home</a></h3>';
		

		
?>
</div><!-- end of right cont-->
		<?php
		    if (isset($_SESSION['cart'])) {
			    include('cpaneldisplayCart.php');
		    }
	    
		 ?>
</div><!--END OF CONTENT-->
	
	    <?php include('cpanelnavBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('cpanelfooter.php');?>

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