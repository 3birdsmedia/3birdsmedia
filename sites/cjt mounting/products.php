<?php include('includes/functions.php');
include('includes/header.php'); ?>
	 <div id='cont_header'>
	  <span class="prod_header"> </span>
	 </div>
<!-- Start: content -->
       <div id="content">
	 
	 <?php include('includes/secondaryNav.php');?>   
	  
<div id="products">
<?php
		        $conn = dbConnect('query');

  			$sql = "SELECT * FROM products
				ORDER BY prod_id";

			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
	

			while ($row = $result->fetch_assoc()) {
				//loop through the results of the product query and display product info.
				//Plus build the link dynamically to the details page
				$prod_id = $row['prod_id'];
				echo '<div class="product">';
				
				echo '<a href="product_details.php?prod_id='.$prod_id.'">';
				
				$sql2 = "SELECT *
				 FROM products_images_lookup, images
				 WHERE products_images_lookup.prod_id = $prod_id
				 AND products_images_lookup.img_id = images.img_id
				 ORDER BY images.img_id
				 LIMIT 1";
				 
				 //submit the SQL query to the database and get the result
			$result2 = $conn->query($sql2) or die(mysqli_error());
			
			while ($row2 = $result2->fetch_assoc()) {
			 echo '<div class="prod-img"><img src="images/product_images/'.$row['prod_nick_name']."/thumb_".$row2['img_url'].'" width="120" /></div></a>';
				
			} //end of the while loop
			$result2->free_result();
			echo '<p><a href="product_details.php?prod_id='.$row['prod_id'] .' "><h4>'. $row['prod_nick_name'] .'</h4></a></p></div>';
			}
			//release the db resources to allow a new query
			$result->free_result();
			

			//close our database connection
			dbClose($conn);
			
?>    	 
	  </div>
       </div><!-- End: content -->
<!-- Start: navigation -->
       <div id="navigation">
	     <?php include('includes/navbar.php'); ?> 
       </div><!-- End: navigation -->
       
       
<!-- Start: push -->
       <div id="push"></div><!-- End: push -->
</div><!-- End: Center Wrap -->

<!-- Start: footer -->
       <div id="footer">
	       <?php include('includes/footer.php'); ?>
       </div><!-- End: footer -->
</body>
</html>