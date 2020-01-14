	 </div> </div>
       </div><!-- End: content -->
<!-- Start: navigation -->
       <div id="navigation">
	   <?php //pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']);

?>
<div id="navbar">
    <ul class="sf-menu">
        <li id="homeBtn"><a href="../index.php"<?php if ($currentPage == 'index.php'){echo 'class="activePage"';} ?>><span><h2>Home</h2></span></a></li>
        <li><a href="../news.php" id="newsBtn" <?php if ($currentPage == 'news.php'){echo 'class="activePage"';} ?>><span><h2>News</h2></span></a></li>
        <li><a href="../products.php" id="productBtn" <?php if ($currentPage == 'products.php'){echo 'class="activePage"';} ?>><span><h2>Products</h2></span></a>
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
				echo '<li><a href="../product_details.php?prod_id='.$row['prod_id'] .'"><span><h4>'.ucwords($row['prod_nick_name']).'</h4></span><img src="../images/product_images/'.$row['prod_nick_name']."/thumb_".$row2['img_url'].'" width="50" /></a></li>';
                        } //end of the while loop
			$result2->free_result();
                        
                        } //end of the while loop
		       
			//release the db resources to allow a new query
			$result->free_result();

			//close our database connection
			dbClose($conn);
                    ?>
            </ul></li>
        <li><a href="../showroom.php" id="showroomBtn"<?php if ($currentPage == 'showroom.php'){echo 'class="activePage"';} ?>><span><h2>Showroom</h2></span></a></li>
        <li><a href="../resources.php" id="resourcesBtn"<?php if ($currentPage == 'resources.php'){echo 'class="activePage"';} ?>><span><h2>Resources / Support</h2></span></a></li>
        <li><a href="../Price_List.pdf" target="_blank" id="pricelistBtn"<?php if ($currentPage == 'pricelist.php'){echo 'class="activePage"';} ?>><span><h2>Price list</h2></span></a></li>
        <li><a href="../contact.php" id="contactBtn"<?php if ($currentPage == 'contact.php'){echo 'class="activePage"';} ?>><span><h2>Contact Us</h2></span></a></li>
    </ul>
</div>

       </div><!-- End: navigation -->
       
       
<!-- Start: push -->
       <div id="push"></div><!-- End: push -->
</div><!-- End: Center Wrap -->

<!-- Start: footer -->
       <div id="footer">
	      <?php $currentPage = basename($_SERVER['SCRIPT_NAME']); ?>
<ul id="social">
	      <li id="fb"><a href="http://www.facebook.com/pages/CJT-Mounting/137061943023148" target="_blank"><span>Facebook</span></a></li>
	      <li id="tw"><a href="http://twitter.com/CJT_Mounting" target="_blank"><span>Twitter</span></a></li>
	      <li id="vi"><a href="http://vimeo.com/user6208668" target="_blank"><span>Vimeo</span></a></li>
	      <li id="yt"><a href="http://www.youtube.com/user/yescjt" target="_blank"><span>YouTube</span></a></li>
</ul>

<div id="footerNav">
    <ul>
                             <li><a href="../index.php" id="fhomeBtn" <?php if ($currentPage == 'index.php'){echo 'class="activePage"';} ?>><span><h4>Home</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../news.php" id="newsBtn" <?php if ($currentPage == 'news.php'){echo 'class="activePage"';} ?>><span><h4>News</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../products.php" id="productBtn" <?php if ($currentPage == 'products.php'){echo 'class="activePage"';} ?>><span><h4>Products</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../showroom.php" id="showroomBtn"<?php if ($currentPage == 'showroom.php'){echo 'class="activePage"';} ?>><span><h4>Showroom</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../resources.php" id="resourcesBtn"<?php if ($currentPage == 'resources.php'){echo 'class="activePage"';} ?>><span><h4>Resources / Support</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../Price_List.pdf" target="_blank" id="pricelistBtn"<?php if ($currentPage == 'pricelist.php'){echo 'class="activePage"';} ?>><span><h4>Price list</h4></span></a></li>
<span class='spacer'>|</span><li><a href="../contact.php" id="contactBtn"<?php if ($currentPage == 'contact.php'){echo 'class="activePage"';} ?>><span><h4>Contact Us</h4></span></a></li>
    </ul>
</div>

<p>CJT &copy; ALL RIGHTS RESERVED, <?php setCopyright("2000") ?> WEB DESIGN AND DEVELOPMENT: <a href='http://www.designpros-inc.com' target="_blank">DESIGN PROS-INC</a></p>

       </div><!-- End: footer -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
