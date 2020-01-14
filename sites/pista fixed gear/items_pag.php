<?php
session_start();
ob_start();
include('includes/pistaFunctions.php');

$conn = dbConnect('query');
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$sql = "SELECT COUNT(*) as num FROM products";
	$adjacents = 3;
	$total_pages = mysqli_fetch_array($conn->query($sql));	
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "items_pag.php"; 					//your file name  (the name of this file)
	$limit = 4; 						//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;					//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT *  FROM products 
                            LEFT JOIN images
                            ON products.img_id = images.img_id
                            LEFT JOIN brands
                            ON products.brand_id = products.brand_id
                            WHERE products.brand_id = brands.brand_id LIMIT $start, $limit";
	
	$result = $conn->query($sql) or die(mysqli_error());
		    print_r($result);	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<span class='prev'><a href=\"$targetpage?page=$prev\">&lsaquo; &lsaquo;  previous</a></span>";
		else
			$pagination.= "<span class=\"disabled\">&lsaquo; &lsaquo; previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<span><a class='' href=\"$targetpage?page=$counter\">$counter</a></span>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<span><a href=\"$targetpage?page=$counter\">$counter</a></span>";					
				}
				$pagination.= "...";
				$pagination.= "<span><a href=\"$targetpage?page=$lpm1\">$lpm1</a></span>";
				$pagination.= "<span><a href=\"$targetpage?page=$lastpage\">$lastpage</a></span>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<span><a href=\"$targetpage?page=1\">1</a></span>";
				$pagination.= "<span><a href=\"$targetpage?page=2\">2</a></span>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<span><a href=\"$targetpage?page=$counter\">$counter</a></span>";					
				}
				$pagination.= "...";
				$pagination.= "<span><a href=\"$targetpage?page=$lpm1\">$lpm1</a></span>";
				$pagination.= "<span><a href=\"$targetpage?page=$lastpage\">$lastpage</a></span>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<span><a href=\"$targetpage?page=1\">1</a></span>";
				$pagination.= "<span><a href=\"$targetpage?page=2\">2</a></span>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<span class='next'><a href=\"$targetpage?page=$counter\">$counter</a></span>";					
				}
			}
		}

    
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<span class='next'><a href=\"$targetpage?page=$next\">next &rsaquo; &rsaquo; </a></span>";
		else
			$pagination.= "<span class=\"disabled\">next &rsaquo; &rsaquo; </span>";
		$pagination.= "</div>\n";		
	}
?>


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
                            
                            
    ?>

<?php echo $pagination;?>    
    
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