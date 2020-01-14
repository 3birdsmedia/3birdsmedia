<?php
session_start();
ob_start();

/*foreach ($_POST as $key => $value) {
if (!isset($value)) {$value = "Not Specified";}

echo "key  $key  ------- value   $value  <br />";
 
}*/


echo "<h2>CART</h2>";
print_r($_SESSION['cart']);
echo "<h2>items</h2>";
print_r($_SESSION['items']);
echo "<h2>total price</h2>";
print_r($_SESSION['total_price']);



echo "<h2>___________________________________________________</h2>";

//start a session to store values
		
    //making variables to store the info
    $product_id = $_POST["product_id"];
    $size_id = $_POST["size_id"];
    $price = $_POST["price"];
    $color_id = $_POST["color_id"];
    $quantity = $_POST["qty"];

    
    print_r($product_id); //for troubleshooting
    echo "<br/>"; 
    print_r($size_id); //for troubleshooting
    echo "<br/>"; 
    print_r($price); //for troubleshooting
    echo "<br/>"; 
    print_r($color_id); //for troubleshooting
    echo "<br/>"; 
    print_r($quantity); //for troubleshooting


//need to set the product id to a variable so we can get back to our details page we came from on the header code at end of script
$id = intval($product_id);
	echo "<h2>___________________________________________________</h2>";    
//This is so we can know if something was bought
$cartCount = false;
    
if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); //make an array for the cart
	$_SESSION['items'] = 0;
	$_SESSION['total_price'] = '0.00';

	echo "Just set up a cart.<br/>"; //for troublshooting

}	    
	
	echo "<h2>___________________________________________________</h2>";
	
	echo "Cart already set up<br/>"; //else statement is just for troubleshooting
	       
	   
	if (isset($item_qty) && in_array($item_qty,$_SESSION['cart'])){
                        #DONT DO ANYTHING
        }else{
		$item_qty = 0;
                #Push the element into the array
                 array_push($_SESSION['cart'],$item_qty);
        }
        //Loop through the cart and check quantities for each item 
	$lengthCart = count($_SESSION['cart']); //since using a for loop, need to set a counter.
	echo "LENGTH of cart previously created is: " . $lengthCart . "<br/>"; //for troubleshooting
	if (isset($quantity)) { 
  		while ( $quantity > 0) {	 
		    $item_qty = $item_qty + 1;
		    $item_qty = intval($item_qty);
		    $quantity = $quantity - 1;	  
		  	//for security, force the inputs from the form into an integer type using intval()
		  	$item_qty = intval($item_qty);
			 $key = 0;
			//need to set the product id to a variable so we can get back to our details page 
			//we came from on the header code at end of script
			$id = intval($product_id[$key]);
					
			//create variables for POST items to use in comparison in the CART LOOP below
			$product_id_POST = intval($product_id[$key]);
			$size_id_POST = intval($size_id[$key]);
			$color_id_POST = intval($color_id[$key]);
					
				echo "<hr>";//for troubleshooting
				echo "<hr>";//for troubleshooting
				echo "Product ID on POST is: " . $product_id_POST . "<br/>";//for troubleshooting
				echo "COLOR ID on POST is: " . $color_id_POST . "<br/>";//for troubleshooting
				echo "SIZE ID on POST is: " . $size_id_POST . "<br/>";//for troubleshooting
				
				//set flag to track if we DO NOT have a match between POST and CART
				    $noMatch = true;
				    echo "noMatch is: " . $noMatch . "<br/>"; //for troubleshooting
					
				  	if ($item_qty > 0) {
					  //INNER LOOP: LOOPING THROUGH CART FOR THIS PARTICULAR POST ITEM
					  for ($row = 0; $row < $lengthCart; $row++) { 
						 echo "<hr>";//for troubleshooting
						 echo "Looping through the CART for loop: " . $row . "</br>"; //for troubleshooting
									 
						 //setting the CART product id and type id for use in if conditional
						 $product_id_CART = $_SESSION['cart'][$row]['product_id'];
						 $color_id_CART = $_SESSION['cart'][$row]['color_id'];
						 $size_id_CART = $_SESSION['cart'][$row]['size_id'];
			 
							 //for troubleshooting
					 echo "Already in cart:  Product id is $product_id_CART and COLOR id is $color_id_CART and SIZE is $size_id_CART<br/>";
						 echo "On the post: Product id is $product_id_POST and COLOR id is $color_id_POST and SIZE is $size_id_CART<br/>";
									 
						//COMPARE product id on post (outer loop) to the current row in the cart (inner loop)
						 //COMPARE type id on post (outer loop) to the current row in the cart (inner loop)
						 if (($product_id_POST == $product_id_CART) && ($color_id_POST == $color_id_CART) && ($size_id_POST == $size_id_CART)) {
						    //found a match, so switch flag
						     $noMatch = false;
						     echo "noMatch is: " . $noMatch . "<br/>"; //for troubleshooting
										 
						     //for troubleshooting
						    echo "<p>Product and Type on POST match one in the CART!!!</p>"; 
						    echo "Quantity already on session is : " . $_SESSION['cart'][$row]['item_qty'] . "<br/>";
						    echo "Quantity to add is: $item_qty <br/>";
										
										 //increment quantity
						     $_SESSION['cart'][$row]['item_qty'] = $_SESSION['cart'][$row]['item_qty'] + $item_qty;

										 //for troubleshooting
						    echo "After increment: NEW Quantity on session is : " . $_SESSION['cart'][$row]['item_qty'] . "<br/>";
									 
								 
									 } else {
										 //no match found, but have a qty, so add
										 echo "<p>NO MATCHES for Product and Type on POST to what's in Cart! BUT MORE THAN ZERO </p>";
										 
									 }//end else
									 
							  }//end INNER LOOP through cart
							  ////////DONE LOOPING THROUGH CART FOR THIS PARTICULAR POST ITEM

					} else {
						//quantity on POST was zero
					echo "<p>Quantity was not > 0!!</p>";
						  
					}//end if $item_qty>0
					
					
					//CHECK FLAG TO SEE IF MATCH WAS FOUND
					//ALSO CHECK FOR QTY > 0 TO AVOID ADDING 0 ITEM TO CART
					 if ($noMatch == true && $item_qty > 0 ) {
								//no match found above for what's already in cart for THIS ITEM on post.
								
					    //for troubleshooting
					    echo "<p>no match found above for what's already in cart for THIS ITEM on post, AND more than ZERO:  ADD TO CART</p>";
								
								//ADD ITEM FROM POST TO THE CART
								array_push($_SESSION['cart'], 
								    array(
						'product_id' => intval($product_id[$key]),
						'color_id'=> intval($color_id[$key]),
						'size_id' => intval($size_id[$key]),
						'price'=> floatval($price),
						'item_qty' => intval($item_qty)
														)
											);
					
					} //end if noMatch
					
					
				}//end OUTER LOOP foreach loop through qty on POST
				////////END LOOPING THROUGH POST ITEMS
			
			}// end if is_array($qty)
				
//end OF PRIMARY IF/ELSE to check and add items to cart
/////////////////////////////////////

//////////////////////////////////////
// SETTING THE CONFIRMATION MESSAGE FLAG
/*Want to look at the cart items again, and see if there was anything added.  Because 
the code above is a loop, it looks at each item to see if it's added: mug, mousepad, 
poster, and sets each up if there is something there.  BUT if we set a confirmation 
message in the loop above, if any of the items aren'tordered then the $cartCount variable 
gets overwritten as false on that loop through, EVEN if the item before it was ordered.  
SO we have to look AGAIN outside of the above loops, and if anything is more than 0, set 
the $cartCount variable and then break since we just need to know if ANYTHING was ordered 
on any of the three type lines. */

if ( isset($qty)) {
	  foreach($qty as $key => $item_qty) {
		  //for security, force the inputs from the form into an integer type using intval()
		  $item_qty = intval($item_qty);
		  
		  if ($item_qty > 0) { //if any item is more than 0
			$cartCount = true; //setting the $cartCount variable to true, because something was ordered in at least
								//one of the item types of mug, mousepad or poster
			echo "Cart count set to true.";
			break; //only needs to be set once, so break the loop once we find an item that's been ordered
		  }//end if
	  }//end foreach
}//end if is_array($qty) - confirmation message
		

//if we had items set above, then we need to create our confirmation message
if ($cartCount == true) { //items were added
	  //set a confirmation message that product were added to cart
	  $conf_msg = "Your products were added to your cart.";
	  $_SESSION['conf_msg'] = $conf_msg;
	  //echo $conf_msg;
	  $class = "msg";
	  $_SESSION['class'] = $class;			
} else { //no idems added
	$conf_msg = "<br>SOrry but it seems you had 0 in your quantity please <a href='item_detail.php?product_id=$product_id'>go back</a> and try again.";
	$_SESSION['conf_msg'] = $conf_msg;
	//echo $conf_msg;
	$class = "alert";
	$_SESSION['class'] = $class;
} //end if/else
		
//////////////////////////////////////////////////
//RESORT ARRAY
//NEW WEEK 8
//now that we are done adding the new items to the cart...
//resort all the items in the cart (both new and what we had already added to cart before)
//resort will default to ordering on the first index which is product id, rather than 
//having the array in the order of how they were added
//(this helps keep order the same as when we update cart in view_cart.php
array_multisort($_SESSION['cart']); //sorts on first index which is product id

//////////////////////////////////////////////////
//REDIRECT TO ORIGINAL PAGE
//header("Location: ../product_details.php?product_id=$id");
			
    print_r($_SESSION['cart']);
    //header("Location:item_detail.php?product_id=$product_id");
			
//troubleshooting nav for when header redirect commented out
echo '<h2><a href="index.php">Back Home</a></h1>';
echo '<h2><a href="items.php">Back to Products</a></h1>';
echo '<h2><a href="includes/displayCart.php">VIEW CART</a></h1>';
?>