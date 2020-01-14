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
				<?php

		
		$conn = dbConnect('query');
		
		//create SQL 
		$sql =  "SELECT * FROM blogtext
			ORDER BY blog_id ASC 
			LIMIT 1";
	
		
		$result = $conn->query($sql) or die(mysqli_error());
		$row = $result->fetch_assoc();
		$title = $row['blogHeader'];
		$body = stripslashes(nl2br($row['blogBody']));
		
		echo "<h2>".$title."</h2>";
		echo "<div id='blogText'>".$body."</div>";

?>
			</div>  

</div>
<?php include('includes/footer.php'); ?>

<?php include('includes/navBar.php');?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#banner').bxSlider( {mode: 'vertical',controls: false,auto: true, speed: 700} );
  });
</script>
</body>
</html>