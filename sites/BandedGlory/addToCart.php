<?php
session_start();
ob_start();
include('includes/functions.php');
foreach ($_POST as $key => $value) {
	if (!isset($value)) {$value = "Not Specified";}
	echo "<br/>Key  ---  ";
	print_r($key);
	echo "<br/>Value  ---  ";
	print_r($value);
	echo "<br/>   ------  <br/>";

};
//session_destroy();
    //making variables to store the info
    $prod_id 	= $_POST["prod_id"];
    $price 		= $_POST["priceHidden"];
    $quantity = $_POST["qty"];
    $color		= $_POST["color"];

    $item_qty = '';

    echo "<br/>Prod id   ";
    print_r($prod_id); //for troubleshooting
    echo "<br/>Price   ";
    print_r($price); //for troubleshooting
    echo "<br/>Quantity   ";
    print_r($quantity); //for troubleshooting
    echo "<br/>Item Qty   ";
    print_r($item_qty); //for troubleshooting
		echo "<br/>";



/////////////////////////////////////
//SET CART COUNT FLAG
/////////////////////////////////////
//setting flag for the count of items in the cart, we will use this later to set a confirmation message
$cartCount = false;

////////////////////////////////////////////////////////////////////////////////////
//PRIMARY IF/ELSE with NESTED LOOPS - CREATE CART IF NONE OR ADD TO CART IF CART EXISTS//
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////
//IF
//NO CART ALREADY SET UP, CREATE CART, ADD ITEMS
/////////////////////////////////////
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array(); //make an array for the cart
	$_SESSION['items'] = 0;
	$_SESSION['total_price'] = '0.00';
	echo "Just set up a cart.<br/>"; //for troublshooting

	//ADD ITEMS TO CART HERE
	//Since this is a toally new cart (nothing there previously), we don't have to do
	//any checking and comparing - just loop through what came in on the POST and add to cart.

	//here we're using the index from the quantity array as the key to the other two arrays
	//for product and type.  Loop through each row in array and access the info.
	//loop through each row in POST array and add to _SESSION variable rather than printing it out
		  if (is_array($quantity)) {
			  	//now that cart has been created, then loop through items and add to 'cart' session variable
			  	foreach($quantity as $key => $item_qty) {
				  	//for security, force the inputs from the form into an integer type using intval()
				  	$item_qty = intval($item_qty);
				  	if ($item_qty > 0) {
							//need to set the product id to a variable so we can get back to our details page
							//we came from on the header code at end of script
							$id = intval($prod_id[$key]);
							//keeping track of how many items we have
							echo "Total items before adding is: ".  $_SESSION['items'] . "</br>";
							//add the new items to the existing number of items in the session
							$_SESSION['items'] = count($_SESSION['cart'])+1;
							$_SESSION['total_price'] = floatval($price*$item_qty);
							echo "Total items after adding is: ".  $_SESSION['items'] . "</br>";
							//Add the completely new item to the cart session
							array_push($_SESSION['cart'],
													  array(
															'prod_id' 	=> intval($prod_id[$key]),
															'price'			=> floatval($price),
															'item_qty' 	=> intval($item_qty),
															'color'			=> $color
															)
							);
						} else {
							echo "<p>New Cart: Quantity was not > 0</p>"; //for troubleshooting
						  //that item's quantity was set to 0, so don't need to add to cart, BUT
						  //still need to set the product id to a variable so we can get back to our
						  //details page we came from on the header code at end of script even if a 0
						  //value set in the quantity, the product id is still sent on the POST so we can get it
						  $id = intval($prod_id[$key]);

						}//end if/else for qty >0
			  	}//end foreach

		  }
/////////////////////////////////////
//ELSE
//CART HAS ALREADY BEEN SET UP.
//LOOP THROUGH CART SESSION, AND CHECK WHAT'S IN CART VS WHAT'S ON POST
//IF THEY MATCH, THEN JUST INCREMENT QUANTITY AND DON'T ADD NEW ITEM TO SESSION
//IF NO MATCH, THEN ADD ALL ELEMENTS OF NEW ITEM TO SESSION

} else {
	echo "Cart already set up.<br/>"; //for troubleshooting

	//SINCE CART WAS ALREADY SET UP - we have to check what's already in cart against what we are adding from the POST.
	//If the same product is already in cart, then we just increment quantity, and don't add new row to session.
	//If the same product IS NOT already in cart, then we add all elements of that product to cart session as usual.

	//Loop through the cart and check quantities for each item
	$lengthCart = count($_SESSION['cart']); //since using a for loop, need to set a counter.
	echo "LENGTH of cart previously created is: " . $lengthCart . "<br/>"; //for troubleshooting

	if ( is_array($quantity)) {
			/////OUTER LOOP: LOOPING THROUGH POST ITEMS
			foreach($quantity as $key => $item_qty) {
				//for security, force the inputs from the form into an integer type using intval()
				$item_qty = intval($item_qty); //POST QUANTITY
				//need to set the product id to a variable so we can get back to our details page
				//we came from on the header code at end of script
				$id = intval($prod_id[$key]);
				//create variables for POST items to use in comparison in the CART LOOP below
				$prod_id_POST = intval($prod_id[$key]);
				$color_POST = $color;

				echo "<hr>";//for troubleshooting
				echo "Product ID on POST is: " . $prod_id_POST . "<br/>";//for troubleshooting
				echo '<h1>'.$prod_id_POST.'</h1>';
				echo "Color on POST is: " . $color_POST . "color<br/>";//for troubleshooting

				//set flag to track if we DO NOT have a match between POST and CART
				$noMatch = true;
				echo "noMatch is: true " . $noMatch . "<br/>"; //for troubleshooting

				if ($item_qty > 0) {
						//INNER LOOP: LOOPING THROUGH CART FOR THIS PARTICULAR POST ITEM
						for ($row = 0; $row < $lengthCart; $row++) {
								echo "<hr>";//for troubleshooting
								echo "Looping through the CART for loop: " . $row . "</br>"; //for troubleshooting

								//setting the CART product id and type id for use in if conditional
								$prod_id_CART = $_SESSION['cart'][$row]['prod_id'];
								$color_CART = $_SESSION['cart'][$row]['color'];

								//for troubleshooting
								echo "Already in cart:  Product id is $prod_id_CART";// and type is $color_POST<br/color						echo "On the post: Product id is $prod_id";// and type is $type_CART<br/>";

								//COMPARE product id on post (outer loop) to the current row in the cart (inner loop)
								//COMPARE type id on post (outer loop) to the current row in the cart (inner loop)
								if (($prod_id == $prod_id_CART) && ($color_CART == $color_POST)) {
										//found a match, so switch flag
											$noMatch = false;
									echo "noMatch is: " . $noMatch . "<br/>"; //for troubleshooting

									//for troubleshooting
									echo "<p>Product and Type on POST match one in the CART!!!</p>";
									echo "Quantity already on session is : " . $_SESSION['cart'][$row]['item_qty'] . "<br/>";
									echo "Quantity to add is: $item_qty <br/>";
									//increment quantity
									$_SESSION['cart'][$row]['item_qty'] = $_SESSION['cart'][$row]['item_qty'] + $item_qty;
									$_SESSION['items'] = count($_SESSION['cart']);
									$_SESSION['total_price'] = $_SESSION['total_price'] + (floatval($price*$item_qty));
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
															'prod_id' 	=> intval($prod_id[$key]),
															'price'			=> floatval($price),
															'item_qty' 	=> intval($item_qty),
															'color'			=> $color
															)
								);
					} //end if noMatch


				}//end OUTER LOOP foreach loop through qty on POST
				////////END LOOPING THROUGH POST ITEMS

	}// end if is_array($quantity)
}//end OF PRIMARY IF/ELSE to check and add items to cart
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

if ( is_array($quantity) ){//&& $type == 'blank') {
	  foreach($quantity as $key => $item_qty) {
		  //for security, force the inputs from the form into an integer type using intval()
		  $item_qty = intval($item_qty);

		  if ($item_qty > 0) { //if any item is more than 0
			$cartCount = true; //setting the $cartCount variable to true, because something was ordered in at least
								//one of the item types of mug, mousepad or poster
			echo "Cart count set to true.<br/>";
			break; //only needs to be set once, so break the loop once we find an item that's been ordered
		  }//end if
	  }//end foreach
}//end if is_array($quantity) - confirmation message

//if we had items set above, then we need to create our confirmation message
if ($cartCount == true) { //items were added
	  //set a confirmation message that product were added to cart
	  $conf_msg = "Your products were added to your cart.";
	  $_SESSION['conf_msg'] = $conf_msg;
	  //echo $conf_msg;
	  $class = "msg";
	  $_SESSION['class'] = $class;
} else { //no idems added
	$conf_msg = "<br>Sorry but it seems you had 0 in your quantity please <a href='product_detail.php?prod_id=$prod_id'>go back</a> and try again.";
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
echo "<div>";
    print_r($_SESSION);
echo "</div>";

    header("Location:product_detail.php?prod_id=$prod_id");

//troubleshooting nav for when header redirect commented out
echo '<h2><a href="index.php">Back Home</a></h1>';
echo '<h2><a href="products.php">Back to Products</a></h1>';
echo '<h2><a href="view_cart.php">VIEW CART</a></h1>';
?>
