<h2>OUR PRODUCTS:</h2>
    <ul id="cat">
         <li><a href='products.php?cat_id=all'>View All</a></li>
            <?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
          
                $conn = dbConnect('query');
                
                $categoriesql ="SELECT * FROM categories ORDER BY sort ASC";
                
                $sideresult = $conn->query($categoriesql) or die(mysqli_error());
            
                $numRows = $sideresult->num_rows;
                
                while ($siderow = $sideresult->fetch_assoc()) {
                        $cat_id = $siderow['cat_id'];
                        $side_cat = $siderow['category'];
                        $prodSql = "SELECT COUNT(*) as num FROM prod_cat_lookup WHERE prod_cat_lookup.cat_id=$cat_id";
                                
                        $sideresult2 = $conn->query($prodSql) or die(mysqli_error());
                        
                        $numProd = mysqli_fetch_array($conn->query($prodSql));	
						$numProd = $numProd['num'];
	
                        echo "<li><a href='../products.php?cat_id=$cat_id'>".ucwords($side_cat)." <!--<span class='amount'>($numProd)</span>--></a></li>";
                }
                
            ?>
    </ul>

    <?php //dbClose($conn);?>
	<h2><a href="includes/unset_cart.php" class="">Empty Cart (for Developing Purposes)</a></h2>
    </div>
  	<h2><a href="costumer_care.php" class="costcare"></a></h2>