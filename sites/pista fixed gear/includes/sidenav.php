<h2>SHOP BY</h2>
<h3>BRANDS</h3>
    <ul id="brand">
         <li><a href='items.php?brand_id=all'>View All</a></li>
            <?php
            
                $conn = dbConnect('query');
                
                $brandSql ="SELECT * FROM brands";
                
                $sideresult = $conn->query($brandSql) or die(mysqli_error());
            
                $numRows = $sideresult->num_rows;
                
                while ($siderow = $sideresult->fetch_assoc()) {
                        $brand_id = $siderow['brand_id'];
                        $side_brand = $siderow['brand'];
                        $prodSql = "SELECT * FROM products 
                                LEFT JOIN brands
                                ON products.brand_id = $brand_id
                                WHERE products.brand_id = brands.brand_id";
                                
                        $sideresult2 = $conn->query($prodSql) or die(mysqli_error());
                        
                        $numProd = $sideresult2->num_rows;
                        
                        echo "<li><a href='items.php?brand_id=$brand_id'>".ucwords($side_brand)." ( $numProd )</a></li>";
                }
                
            ?>
    </ul>
    
<h3>SIZE</h3>
    <ul id="size">
            <?php
            

                
                $sizeSql ="SELECT * FROM size";
                
                $sideresult3 = $conn->query($sizeSql) or die(mysqli_error());
            
                $numRows = $sideresult3->num_rows;
                
                while ($siderow = $sideresult3->fetch_assoc()) {
                        $size_id = $siderow['size_id'];
                        $size = $siderow['size'];
                        
                        echo "<li><a href='items.php?size_id=$size_id'>$size</a></li>";
                }            
            ?>
    </ul>
    
<h3>COLORS</h3>
    <ul id="colors">
            <?php
            

                
                $colorSql ="SELECT * FROM colors";
                
                $sideresult4 = $conn->query($colorSql) or die(mysqli_error());
            
                $numRows = $sideresult4->num_rows;
                
                while ($siderow = $sideresult4->fetch_assoc()) {
                        $color_id = $siderow['color_id'];
                        $color = $siderow['color'];
                        
                        echo "<li><a href='items.php?color_id=$color_id'>".ucwords($color)."</a></li>";
                }            
            ?>
    </ul>
    
    <h3>PRICE</h3>
    <ul id="price">
            <?php
            

                
                $priceSql ="SELECT price FROM products
                            ORDER BY products.price DESC";
                
                $sideresult5 = $conn->query($priceSql) or die(mysqli_error());
            
                $numRows = $sideresult5->num_rows;
                $less = array();
                $med = array();
                $more = array();
                
                while ($siderow = $sideresult5->fetch_assoc()) {
                        $price = $siderow['price'];
                        if($price < 300){
                                array_push($less,$price);
                        }if($price >= 300 || $price < 600 ){
                                array_push($med,$price);
                        }if($price > 600){
                                array_push($more,$price);
                        };
                }       
                $less_count = count($less);  
                echo "<li><a href='items.php?range=less'>Less than \$300 ($less_count)</a></li>";
                $med_count = count($med);  
                echo "<li><a href='items.php?range=med'>\$300 - \$600 ($med_count)</a></li>";
                $more_count = count($more);  
                echo "<li><a href='items.php?range=more'>More than \$600 ($more_count)</a></li>";
                            
            ?>
    </ul>
    <?php dbClose($conn);?>