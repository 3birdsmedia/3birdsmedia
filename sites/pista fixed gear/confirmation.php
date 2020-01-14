<?php
session_start();
ob_start();
include('includes/pistaFunctions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/slider_styles.css" />
<link rel="stylesheet" href="styles/twitter_style.css" />
<style>
.content {
    width:870px;
    margin:auto;
    padding:35px 15px 80px 15px;
    height:350px;
}
</style>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="js/jquery.carouselLite.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/twitter.js"></script>

<title>Pista Fixed Gear<?php echo "&#8212;{$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'>
	<a href='index.php'><div id='logo'><h1>PISTA FIXED GEAR</h1></div></a>
    </div>
	<div class="content">
            
			<h2>Your Order has been placed</h2>
			
			<p>Your confirmation number is <h3>24-65-714323</h3></p>
			
			<p>We will be sending you a shipping confimation soon</p>
			
			<p>-Kevin-</p>
		    <form>
			<input type="button" value="Print This Page" onClick="window.print()" />
		</form>
            
   </div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>

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