<?php
session_start();
ob_start();
include('includes/pistaFunctions.php');

//check for the product_id on the query string
	if ( !isset($_GET['product_id']) && !is_numeric($_GET['product_id']) ) {
        $product_id = 0;
            $msg = "<h2>Oops...</h2> there seems to be a problem, please <a href='items.php'>CLICK HERE</a> and try again.";   
              
	
        }elseif($_GET['product_id'] == '') {
               $product_id = 0;
            $msg = "<h2>Oops...</h2> there seems to be a problem, please <a href='items.php'>CLICK HERE</a> and try again.";   	
        } else {
	    //set the variable so it's easier to use later in script
		$product_id = $_GET['product_id']; //for troubleshooting
		//echo "product_id is $product_id <br>";
	   //connect to the datase
		$conn = dbConnect('query');            
        
            //Now we make a query request to store the product if it was requested
	    $sql = "SELECT *
                    FROM products, product_color_size_lookup, colors, size
                    WHERE products.product_id = product_color_size_lookup.product_id
                    AND product_color_size_lookup.color_id = colors.color_id
                    AND product_color_size_lookup.size_id = size.size_id
                    AND products.product_id = $product_id
                    ORDER BY products.product_id";

            //submit the SQL query to the database and get the result
            $result4 = $conn->query($sql) or die(mysqli_error());
            
        //loop through the result to get the id, product and description
        while ($row2 = $result4->fetch_assoc()) {
                
                $products = array(
                               'product_id' => $row2['product_id'], 
                               'product' => $row2['product'] ,
                               'descrition' => $row2['description'],
			       'price' => $row2['price']
                                                                                
                         );
                $product_name = $row2['product'];
                $description = $row2['description'];
		$price = $row2['price'];
            //getting the brand and image
	    
               $sql2 = "SELECT * FROM products 
		    LEFT JOIN images
                    ON products.img_id = images.img_id
                    LEFT JOIN brands
                    ON products.brand_id = brands.brand_id
                    WHERE product_id = $product_id";
           $result2 = $conn->query($sql2) or die(mysqli_error());
	    //$result3 = $conn->query($sql3) or die(mysqli_error());
	    
	while ($row2 = $result2->fetch_assoc()){
                        $image = $row2['img'];
                        $brand = $row2['brand'];
            }
            //$invLenght = if count($row['inventory']); 
            //echo $invLenght;
           
                                   
             
        //Begin of While 2
	
	//create array for the colors
        $colors =   array();
		//fetch result        
            while ($row = $result4->fetch_assoc()) {
                #if the inventory is more than 0
                if ($row['inventory'] > 0 ){
                    #and if the 'color' is in the array then
                    if (in_array($row['color_id'],$colors)){
                        #DONT DO ANYTHING
                    }else{
                        #Push the element into the array
                        array_push($colors,$row['color_id']);
                    }
                }    
            }
	}//End of WHILE 1
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
	</div><!--END OF HEADER-->
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sideNav.php');?>
	    </div><!--END OF SIDEBAR-->
	    
	    <div class="cont">
			<?php
			if(isset($msg)){
				echo $msg;
			}else{

			 //print_r ($product);
			echo "<div id='module' class='left'><img src=\"images/DB_images/".$image.'" width="375" />'.'<br />';
			
			
			echo '<h2>You may also like</h2>
				<div class="featured">
		    
				<ul>';
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
				    </div><!--END OF MODULE-->';
			
			
			
			    
			echo '<div id="module" class="right">
				<h2>'.ucfirst(strtolower($brand)).' &mdash; '.ucfirst(strtolower($product_name)).'</h2>';
			echo '<h3>'.$price.'</h3>';
			echo '<div class="faceandtweet_retweet" style="float:left; width:110px;">
					<a href="http://twitter.com/share?url='.$_SERVER["REQUEST_URI"].'" class="twitter-share-button" data-text="Social Buttons - Twitter, Facebook data-count="horizontal" data-via="vagrantweb" data-related="carter_vagrant">Tweet</a>
					<script type="text/javascript" src="js/twitter.js"></script>
				</div>
				<div class="faceandtweet_like" style="float:left; width:90px; height:20px;">
					<iframe src="http://www.facebook.com/plugins/like.php?href='.$_SERVER["REQUEST_URI"].'&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px;" allowTransparency="true"></iframe>
				</div>';
			
			echo "<div id='desc'>$description</div>";
			echo '<div id="addToCart">';	
			echo '<p>This Bike is Available in:</p>';
						
				#how many elements im getting 
				//$amount_colors = count($colors);
				//echo $amount_colors.'<br />'.'<br />';
				//print_r ($colors);
				//echo "<br /><br />";
			
			$conn = dbConnect('query');

				//for each element in colors assign key and a create a value
				foreach ($colors as $key => $value){
				//for trouble shoot
				//echo $value;
				$sql3 = "SELECT * FROM colors
					WHERE colors.color_id = $value";
			
				$result3 = $conn->query($sql3) or die(mysqli_error());
		
				while ($row3 = $result3->fetch_assoc()){
			                       $color = $row3['color'];
					       $color_id = $row3['color_id'];
		     		       
				echo '<label id="'.$color.'" class="color">'.ucwords($color).'</label>';
				echo '<div><form action="addToCart.php" name="addToCartForm" value="addToCart" id="AddToCartForm" method="post">
						<input type="hidden" name="product_id" value="'.$product_id.'"/>
						<input type="hidden" name="price" value="'.$price.'"/>
						<input type="hidden" name="color_id" value="'.$color_id.'"/>
						
						<label for="size_id">Select your size</label>
						<select name="size_id" id="size_id">';		       
			
				$sql4 = "SELECT *
					FROM product_color_size_lookup, colors, size
					WHERE product_color_size_lookup.color_id = colors.color_id
					AND product_color_size_lookup.size_id = size.size_id
					AND product_color_size_lookup.product_id = $product_id
					AND colors.color_id = $value";
			
				$result4 = $conn->query($sql4) or die(mysqli_error());
			
					while ($row4 = $result4->fetch_assoc()) {
						
						if ($row4['inventory'] >= 3 ){
							//$sizeTemp = $row4['size'];
							echo '<option value="'.$row4['size_id'].'">' . $row4['size'] . '</option>';
						}elseif($row4['inventory'] < 3 && $row4['inventory'] >= 1  ){
							echo '<option value="'.$row4['size_id'].'">' . $row4['size'] . '/Low Inventory</option>';
						}if($row4['inventory'] == 0 ){
							echo '<option value="'.$row4['size_id'].'">' . $row4['size'] . '/Out of Stock</option>';
						}
				
					}
						$result4->free_result();
						echo '</select>';
						echo '<label class="qty">Qty:</label><input type="text" id="qty" name="qty['.$row4.']" size="2" maxlength="2" value="1" id="qty"/>';
						echo '<input type="submit" id="add" name="Add to Cart" value="Add to Cart" />';
				}
				
				$result3->free_result();
				echo "</form></div>";
			//now that we are finished with the resuls set, release the db resources to allow a new query.
			}
		echo "</div><!--END OF MODULE-->
		</div><!--END OF Add to cart-->";
		} 
	//$result->free_result();
	         
	?>
	</div><!--END OF CONT-->
		
		
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
   
$(function(){$(".featured").carousel( {
    dispItems: 2,
    effect: "vertical",
    loop: true,
    animSpeed: "slow",
    circular: true
    

    } );
  })

$(function(){
		// Accordion
		$("#addToCart").accordion({
			collapsible: true,
    			animated: 'easeslide' ,
			header: '.color', 
			event: 'click' 
		});						
});
</script>


</body>
</html>