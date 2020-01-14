<?php include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--js-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.lavalamp-1.3.5.js"></script>
<script type="text/javascript" src="js/jquery.bxSlider.js"></script>
<style>
.module{height:auto !important;}
</style>

<!--styles-->
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/reset.css" />
<title>JRU Designs <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrapper">
		<div id="content">
		
			<div id="header" <?php if ($title == 'home'){echo 'class="activeLogo"';} ?> >
				<a href="index.php" class="logoBtn"><span><h1 id="header"><p>JR Designs</p></h1></span></a>
			</div>	
			       	<div id="cont">
			<ul id="banner">
				<li><a href="portfolio.php"><img src="images/banner_1.jpg"/></a></li>
				<li><a href="portfolio.php"><img src="images/banner_2.jpg"/></a></li>
			</ul>	
					<div id="latest" class="module">
						<a href="portfolio.php"><h3>My Latest Project...</h3></a>
						<p>Check out what I have been up to in the design world, click here or the image above to read more specific details, challenges and my solutions.</p>
					</div>
					
					<div id="blog" class="module">
						<h3>Whats On My Mind...</h3>
						<p>"Designing all day, everyday!! Logos, Branding,.." Read more...
						</p><p>-Yesterday @ 10:00am-</p>
					</div>
					
					<div id="contact" class="module">
						<h3>My Experience</h3>
						<p>Take a look at my experience in the real world, where I learned what I know, and where I've been, in other words, my resume. Then contact me.</p>
					</div>
					
				</div>
		</div>
<?php include('includes/footer.php'); ?>

<?php include('includes/navBar.php');?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#banner').bxSlider( {mode: 'vertical',controls: false,auto: true,pause: 7000, speed: 1500} );
  });
</script>
</body>
</html>