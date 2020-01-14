<?php
session_start();
ob_start();
print_r($_POST);
//start a session to store values
		
    //making variables to store the info
    $product_id = $_POST["product_id"];
    $size_id = $_POST["size_id"];
    $price = $_POST["price"];
    $color_id = $_POST["color_id"];
    $quantity = $_POST["qty"];
    $item_qty = '';
    
    print_r($product_id); //for troubleshooting
    echo "<br/>"; 
    print_r($size_id); //for troubleshooting
    echo "<br/>"; 
    print_r($price); //for troubleshooting
    echo "<br/>"; 
    print_r($color_id); //for troubleshooting
    echo "<br/>"; 
    print_r($quantity); //for troubleshooting
    echo "<br/>"; 
    print_r($item_qty); //for troubleshooting

//need to set the product id to a variable so we can get back to our details page we came from on the header code at end of script
$id = intval($product_id);
    
    
    //This is so we can know if something was bought
    $cartCount = false;
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); //make an array for the cart
	$_SESSION['items'] = 0;
	$_SESSION['total_price'] = '0.00';
	echo "Just set up a cart.<br/>"; //for troublshooting
	   
	if (isset($item_qty) || in_array($item_qty,$_SESSION['cart'])){
                        #DONT DO ANYTHING
                    }else{
			$item_qty = 0;
                        #Push the element into the array
                        array_push($_SESSION['cart'],$item_qty);
                    }	
		
		
		
		
		} else {
		echo "Cart already set up<br/>"; //else statement is just for troubleshooting
	}

 
        
  //now that cart has been created, then loop through items and add to 'cart' session variable
 // foreach($quantity as $key => $item_qty) {
		 
	  
  //intval() forces the Integer value to the variable, in case someone typed a letter
	while ( $quantity > 0) {	 
		$item_qty = $item_qty + 1;
		$item_qty = intval($item_qty);
		$quantity = $quantity - 1;	  
		 // if ($item_qty > 0) {
			  	  //need to set the product id to a variable so we can get back to our details page we came from on the header code at end of script
				  $prod_id = intval($product_id);
				  $color = intval($color_id);
				  $size = intval($size_id);
				  
				  //keeping track of how many items we have
				  echo "Total items before adding is: ".  $_SESSION['items'] . "</br>";
				  
				  
			if (array_key_exists($product_id, $_SESSION['cart'])){
			    echo $item_qty.'HOLLAAA';
			    }else{	  
				  //here for troubleshooting:
				  //echo "We have $item_qty of Product Item $id of type $type. </br></br>";
				  
				  //TO FIX:  this basic adding works.  But we need to increment items that arealready in cart, not just add more of them.  THIS IS A PROBLEM.  Leave it this way for now.
		  
			    array_push($_SESSION['cart'], 
							array(
							    'product_id' => intval($product_id),
							    'color_id'=> intval($color_id),
							    'size_id' => intval($size_id),
							    'price'=> floatval($price),
							    'item_qty' => intval($item_qty)
				  )
			    );
			    
			}
			    //add the new items to the existing number of items in the session
			    $_SESSION['items'] = $_SESSION['items'] + 1;
					  
			    echo "Total items after adding is: ".  $_SESSION['items'] . "</br>";
			   

			    $cartCount = true;
 				    
			  
			}
			  
			/*  if ( is_array($qty)) {
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
			  }//end if
*/					  
                	  //NEW WEEK 7/8
			  //if we had items set above, then we need to create our confirmation message
			  if ($cartCount == true) { //items were added
					//set a confirmation message that product were added to cart
		  			$conf_msg = "The Bikes were added to your cart.";
					$_SESSION['conf_msg'] = $conf_msg;
					//echo $conf_msg;
					$class = "msg";
					$_SESSION['class'] = $class;
		  			
					
			  } else { //no idems added
				  $conf_msg = "You might have not add a quantity, please do so to purchase.";
				  $_SESSION['conf_msg'] = $conf_msg;
				  //echo $conf_msg;
				  $class = "alert";
				  $_SESSION['class'] = $class;
			  }
						  
		  //return us back to the page we were on
		  //
		  //end if} 		

               print_r($_SESSION['cart']);
	    //header("Location:item_detail.php?product_id=$product_id");

?>