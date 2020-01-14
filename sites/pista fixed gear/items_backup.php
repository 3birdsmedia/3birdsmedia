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
	    <div id="sideNav">
		<?php include('includes/sideNav.php');?>
	    </div><!--END OF SID EBAR-->
	    
	    <div class="cont">

    
    <?php
    //CONNECTING TO MYSQL WITH QUERY RIGHTS
                    $conn = dbConnect('query');
                    
                    //preparing the sql query
                    $sql = "SELECT * FROM products 
                            LEFT JOIN images
                            ON products.img_id = images.img_id
                            LEFT JOIN brands
                            ON products.brand_id = products.brand_id
                            WHERE products.brand_id = brands.brand_id";			
                    
                    
                    
                    // submit the query and capture the result or die in the process jajaja!!!
                    $result = $conn->query($sql) or die(mysqli_error());
                   //echo ($result);
                    //
                    // Lets count the results 
                    $numRows = $result->num_rows;
                    
                    
                    while ($row = $result->fetch_assoc()) {
                                    //this will loop through the table made by the left joins and spit out
                                    //the info needed
                                    //print_r($result);
    
				echo '<div class="items">
						<a href="item_detail.php?product_id='.$row['product_id'].' "><p>'.$row['product'].'</p></a>
						<a href="item_detail.php?product_id='.$row['product_id'].' "><img  src="images/DB_images/' . $row['img'] . '" width="180" /></a>
						<p>Price: ' . $row['price'] . '</p>
						<p>Brand: ' . $row['brand'] . '</p>
					     
				</div>';   
                            } //end of the while loop
                            
                            //now that we are finished with the results set, release the db resources to allow a new query.
                            $result->free_result();
    
                            
                            //now that we're done, we want to close our database connection.  call the dbClose() connection function
                            dbClose($conn);
                            
    ?>
<?php
	if (isset($_SESSION['cart'])) {
		include('includes/displayCart.php');
	}else{}
     ?>
	</div>
	    <?php include('includes/navBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>