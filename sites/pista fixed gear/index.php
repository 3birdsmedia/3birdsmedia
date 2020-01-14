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
		
	    <div id="slideshow">
		<ul>
		    <li><a href="news.php"><img src="images/banner_1.jpg" /></a></li>
		    <li><a href="items.php?brand_id=1"><img src="images/banner_2.jpg" /></a></li>
		    <li><a href="news.php"><img src="images/banner_3.jpg" /></a></li>
		    <li><a href="items.php?brand_id=5"><img src="images/banner_4.jpg" /></a></li>
		</ul>
		
	    </div><!--END OF SLIDESHOW-->
	    
	    <div id="module" class="left">
	    <h2>Featured Products</h2>
		<div class="featured">
		    
		    <ul>
			<?php
				//CONNECTING TO MYSQL WITH QUERY RIGHTS
				$conn = dbConnect('query');
					
				//preparing the sql query
				$sql = "SELECT * FROM products 
					LEFT JOIN images
					ON products.img_id = images.img_id
					LEFT JOIN brands
					ON products.brand_id = products.brand_id
					WHERE products.brand_id = brands.brand_id
					ORDER by RAND()
					LIMIT 4";			
					
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
		       
				     echo '<li><a href="item_detail.php?product_id='.$row['product_id'].' "><h4>'.ucwords($row['brand']) .'</h4>'.ucwords($row['product']).'</a>
						<a href="item_detail.php?product_id='.$row['product_id'].' ">
						    <img  src="images/DB_images/' . $row['img'] . '" width="150" />
						</a>
						<p>Price: ' . $row['price'] . '</p>
					    </li>
					    ';   
				} //end of the while loop
				//
			      //
				    //		<p>Brand: </p>
					echo '</ul>
					';
				    echo '</div><!--end  of Featured-->
				    ';
			    echo '</div><!--end  module-->
			    ';
			    
			    echo '<div id="module" class="right">';

				//now that we are finished with the results set, release the db resources to allow a new query.
				 $result->free_result();
				    
			//create SQL 
			$sql =  "SELECT * FROM newsfeed
						ORDER BY news_id DESC 
						LIMIT 1";
			
				
				$result = $conn->query($sql) or die(mysqli_error());
				$row = $result->fetch_assoc();
				$title = $row['newsTitle'];
				$body = stripslashes(nl2br($row['news_Text']));
				
				echo "<div id='newsBody'>
					    <h3>".$title."</h3>
					    <div id='newsText'>
						".truncText($body)."<br />
					    </div><!-- end of text body-->
				    </div><!--end of newsBody-->";
			?>
		</div><!--END OF Module-->
		</div><!-- end of right cont-->
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