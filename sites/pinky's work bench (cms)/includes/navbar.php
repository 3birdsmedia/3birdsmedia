<?php //pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

<tr id="navBar">
      <td width="19" height="34" bgcolor="#FFFFFF"></td>
      <td><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'class="activePage"';}?>>HOME</a></td>
      <td><a href="aboutus.php" <?php if ($currentPage == 'aboutus.php'){echo 'class="activePage"';}?>>ABOUT US</a></td>
      <td><a href="faq.php" <?php if ($currentPage == 'faq.php'){echo 'class="activePage"';}?>>FAQ</a></td>
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
				echo '<td><a href="prodlist.php?cat_id='.$navcat_id.'"';if ($currentPage == 'prodlist.php?cat_id='.$navcat_id.''){echo 'class="activePage"';};
				echo '><p>'.strtoupper($cat_name).'</p></a></td>';
				    			    
			    }
			    //release the db resources to allow a new query
			    $resultnav->free_result();
    
			    //close our database connection
			    dbClose($conn);
?>
      <td><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'class="activePage"';}?>><p>CONTACT</p></a></td>
      <td width="19" height="34" bgcolor="#FFFFFF"></td>
</tr>