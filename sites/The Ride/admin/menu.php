<?php
  include('../includes/functions.php');
  // process the script only if the form has been submitted
if (array_key_exists('login', $_POST)) {
  // start the session
  session_start();

  
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="../styles/styles.css" />
<style type="css/text">
</style>


<title>THE RIDE <?php echo "&#8212;{$title}"; ?></title>
</head>

<body>
	<div id="wrap">      
    	<div id="main">
        	<div id="header">
            	<h1>THE RIDE</h1>
            </div>
            
       	<div id="cont">
        
        
 
        </div>  



		<?php include('../includes/adminNavBar.php');?>


	</div><!--END OF Main-->
</div><!--END OF WRAP-->


<div id="footer">
        <p>THE RIDE</p>
        <p>Copyright (c) <?php setCopyright (2010) ?></p>
</div>

</body>
</html>