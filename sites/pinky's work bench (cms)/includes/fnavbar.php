<?php //pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>
      <td align="center" valign="middle" bgcolor="#FFFFFF">
	    <p class="style5"><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'class="style8"';} ?>>home</span> <span class="style6">|</span>
	    <a href="aboutus.php" <?php if ($currentPage == 'aboutus.php'){echo 'class="style8"';} ?>>about us</a> <span class="style6">|</span>
	    <a href="faq.php" <?php if ($currentPage == 'faq.php'){echo 'class="style8"';} ?>>faq's</a> <span class="style6">|</span>
	<?php 
$conn = dbConnect('query');
  			$navsql = "SELECT * FROM categories
				ORDER BY categories.cat_id";
			//submit the SQL query to the database and get the result
			$resultnav = $conn->query($navsql) or die(mysqli_error());
				while ($rownav = $resultnav->fetch_assoc()) {
				//loop through the results of the product query and display product info.
				//Plus build the link dynamically to the details page
				$navcat_id = $rownav['cat_id'];
				$cat_name = $rownav['cat_name'];
				echo '<a href="prodlist.php?cat_id='.$navcat_id.'"';if ($currentPage == 'prodlist.php?cat_id='.$navcat_id.''){echo 'class="style8"';};
				echo '>'.strtolower($cat_name).'</a><span class="style6">|</span>';
				    			    
			    }
			    //release the db resources to allow a new query
			    $resultnav->free_result();
    
			    //close our database connection
			    dbClose($conn);
?>  
	   
	   
	    <a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'class="style8"';} ?>>contact</a></p>