<?php
session_start(); //

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNSET CART</title>
</head>

<body>
<?php

//FOR TROUBLESHOOTING for when need to clear the session
		unset($_SESSION['cart']);
		unset($_SESSION['conf_msg']);
		echo "<h1>CART SESSION unset.</h1>";
		echo '<h2><a href="../index.php">Back Home</a></h1>';
		echo '<h2><a href="../details.php">Back to Products</a></h1>';

		
?>
</body>
</html>