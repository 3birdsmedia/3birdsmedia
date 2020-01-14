<?php //pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']);

?>
<div id="navbar">
    <ul class="sf-menu">
        <li id="homeBtn"><a href="index.php"<?php if ($currentPage == 'index.php'){echo 'class="activePage"';} ?>><span><h2>Home</h2></span></a></li>
        <li><a href="news.php" id="newsBtn" <?php if ($currentPage == 'news.php'){echo 'class="activePage"';} ?>><span><h2>News</h2></span></a></li>
        <li><a href="products.php" id="productBtn" <?php if ($currentPage == 'products.php'){echo 'class="activePage"';} ?>><span><h2>Products</h2></span></a>
            <ul class="hover">
                <?php
		        $conn = dbConnect('query');

  			$sql = "SELECT * FROM products
			ORDER BY products.prod_id";

			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
                        
			while ($row = $result->fetch_assoc()) {
                                $prod_id = $row['prod_id'];
                                
                                $sql2= "SELECT *
				 FROM products_images_lookup, images
				 WHERE products_images_lookup.prod_id = $prod_id
				 AND products_images_lookup.img_id = images.img_id
				 ORDER BY images.img_id
				 LIMIT 1";
                                 
                                 $result2 = $conn->query($sql2) or die(mysqli_error());
			
			while ($row2 = $result2->fetch_assoc()) {
                                
				//Plus build the link dynamically to the details page 
				echo '<li><a href="product_details.php?prod_id='.$row['prod_id'] .'"><span><h4>'.ucwords($row['prod_nick_name']).'</h4></span><img src="images/product_images/'.$row['prod_nick_name']."/thumb_".$row2['img_url'].'" width="50" /></a></li>';
                        } //end of the while loop
			$result2->free_result();
                        
                        } //end of the while loop
		       
			//release the db resources to allow a new query
			$result->free_result();

			//close our database connection
			dbClose($conn);
                    ?>
            </ul></li>
        <li><a href="showroom.php" id="showroomBtn"<?php if ($currentPage == 'showroom.php'){echo 'class="activePage"';} ?>><span><h2>Showroom</h2></span></a></li>
        <li><a href="resources.php" id="resourcesBtn"<?php if ($currentPage == 'resources.php'){echo 'class="activePage"';} ?>><span><h2>Resources / Support</h2></span></a></li>
        <li><a href="Price_List.pdf" target="_blank" id="pricelistBtn"<?php if ($currentPage == 'pricelist.php'){echo 'class="activePage"';} ?>><span><h2>Price list</h2></span></a></li>
        <li><a href="contact.php" id="contactBtn"<?php if ($currentPage == 'contact.php'){echo 'class="activePage"';} ?>><span><h2>Contact Us</h2></span></a></li>
    </ul>
</div>
