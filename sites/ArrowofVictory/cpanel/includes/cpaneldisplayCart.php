<?php
/*
session_start();
ob_start();
include('functions.php');*/

//print_r($_SESSION);
if (array_key_exists('goToCheckout', $_POST)) {
		//redirect to checkout page
		header("Location: ../checkout.php");
	} elseif (array_key_exists('view', $_POST)){
		//redirect to checkout page
		header("Location: ../view_cart.php");
	
	} elseif (array_key_exists('update', $_POST)){
	
		
		///NEW WEEK 8 - ENTIRE 'update' SCRIPT
		//update the quantities on the form and reload the form
		//also update the SESSION variables

		////////////////////////
		//For troubleshooting: Reference to see what is on POST vs what is on CART
//		echo "UPDATE ARRAY KEY EXISTS <hr>";
//		echo "ON THE POST in the page: ";
//		print_r($_POST); //for troubleshooting
//		echo "<hr>";
//		echo "IN THE CART in the page: ";
//		print_r($_SESSION['cart']);
//		echo "<hr>";

//////////////////////////////////////
//LOOP THROUGH CART AND CHECK QUANTITIES
		
		//SET COUNTER
		$length = count($_SESSION['cart']); 
//		echo "LENGTH of cart IN UPDATE is: " . $length . "<br/>";//for troubleshooting 
		
		//for troubleshooting 
		if ($length == 0) {
			echo "nothing in the cart now!";
		}
			
		//LOOP THROUGH CART ELEMENTS
		for ($row = 0; $row < $length; $row++) { 
//				   echo "<hr>"; //for troubleshooting
//				   echo "Looping through the update for loop: " . $row . "</br>"; //for troubleshooting
				   
				   //setting the product id and type id for use in if conditional
				   //Need both product and type id to get a true match on item - think about this
				   //like it's a composite primary key
				   $prod_id = $_SESSION['cart'][$row]['prod_id'];
				   $combo_id = $prod_id;//NOTE NO SPACE between variables  .$size_id.$color_id
//				   echo "Combo id is: " . $combo_id . "<br/>"; //for troubleshooting
				   
				   //set quantity variables for use in if/elseif conditionals
				   $origQty = $_SESSION['cart'][$row]['item_qty']; //the original qty in form/session
				   $updateQty = $_POST["item_qty"][$row]; //the new updated qty that came from POST
				   
				   //////////////////////////////////////////
				   //CHECK TO SEE WHAT'S in ITEM QUANTITY FIELD OR IF DELETE CHECKED
				   
				   //ISSUE:  The "delete" checkbox array is created ONLY IF CHECKED.  As a result, if the delete
				   //box for the third item (index 2) was checked it would create an array and have index 0, which
				   //DOES NOT WORK the same way we've been able to use indexes to connect our product, type, and qty
				   
				   //if qty is zero or if "delete" box is checked, then unset from session
					   //The second part of the conditional is a nested conditional statement:
							/* !empty($_POST['delete']) --> is checking to see if there is an array on the post
								named delete - which there will be ONLY IF a delete checkbox was checked
								AND
								in_array($combo_id, $_POST['delete']) --> look in that array and see if there is 
								a value that matches the $combo_id variable which was set above, and matches the value
								that is placed in the HTML form element value for the delete checkbox
								
								If BOTH of these are true, then it means that the delete box was checked for this
								particular Product/Type item that we are currently looping through
							
							*/
					//////IF ZERO QUANTITY OR DELETE BOX CHECKED
				   	if ($updateQty == 0 || (!empty($_POST['delete']) && in_array($combo_id, $_POST['delete'])) ){

//						  echo "<strong>inside if/else for qty: ZERO OR CHECKED</strong> <br/>"; //for troubleshooting
						  
						  //unset the product from session
						  unset($_SESSION['cart'][$row]);
						  unset($_SESSION['cart'][$row]['prod_id']);
						  unset($_SESSION['cart'][$row]['item_qty']);
						$grandTotal = 0;			   
						  //for troubleshooting
//						  echo "Orig qty is: " . $origQty . "</br>";
//						  echo "Update qty is: " . $updateQty . "</br>";
//						  echo "new session qty after changing the session is: " . $_SESSION['cart'][$row]['item_qty']. "</br>";
//						  echo "<hr>";
						  
					 ///////IF UPDATE QTY IS NOT SAME AS ORIGINAL QTY BUT NOT ZERO  
					 } elseif ($updateQty != $origQty ){ 

//						  echo "<strong>inside if/else for qty: ELSEIF - orig not equal to update qty!!!</strong> <br/>"; //for troubleshooting
						  //update the item to the NEW requested quantity FROM THE POST which is NOT ZERO
						  
						  //set variables for the new updated information coming from POST
						  //we will need these to rebuild form and to do comparisons
						  $updateQty = $_POST["item_qty"][$row];
						  $updateProd = $_POST["prod_id"][$row];
							$updatePrice = $_POST["price"][$row];

						  //unset old quantity AND other elements ON SESSION
						  unset($_SESSION['cart'][$row]['prod_id']);
						  unset($_SESSION['cart'][$row]['item_qty']);
						  
						  //REST the elements to the new udpated values
						  //NOTE THE PRODUCT ID COMES FIRST.  NEED this order to match the array key order in the
						  //Add to cart script!
						  $_SESSION['cart'][$row]['prod_id'] = $updateProd;
						   $_SESSION['cart'][$row]['item_qty'] = $updateQty;
					   					   
						  //for troubleshooting
//						  echo "Orig qty is: " . $origQty . "</br>";
//						  echo "Update qty is: " . $updateQty . "</br>";
//						  echo "Update prod is: " . $updateProd . "</br>";
						  //echo "Update id is: " . $updateType . "</br>";
						  //echo "Update price is: " . $updatePrice . "</br>";
//						  echo "New session qty after changing the session is: " . $_SESSION['cart'][$row]['item_qty']. "</br>";
//						  echo "<hr>";
								
				   } else { 
						  //the original quantity is the same as what came through on update, so do nothing
						  //for troubleshooting
///						  echo "<strong>inside if/else for qty: ELSE!! - orig is same as update so no change needed</strong> <br/>";
//							echo "<hr>";
				   }//end if-elseif-else for updating quantities
				   	
	
		}//END FOR LOOP through cart items 
		
		//////////////////////////////////////////////////
		//RESORT ARRAY
		//NEW WEEK 8
		//now that we are done UPDATING cart items - resort all the items in the cart.
		//Resort will default to ordering on the first index which is product id, rather than having 
		//the array in the order of how they were added.  This helps keep order the same as when we 
		//create and add to cart in addtocart.php.
		//ALSO use array_multisort() to reindex the session array since some indexes will be gone 
		//after the unsets and resets.
		
		array_multisort($_SESSION['cart']); //sorts on first index which in this case is product id
		
		//for troubleshooting
//		echo "<hr>";
//		print_r($_SESSION['cart']);
//		echo "<hr>";

		
}//end "array_key_exists update" elseif

?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../styles/jquery.custom.css"/>
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js"></script>
<title>Digiprint Products LLC</title>
</head>
<link rel="stylesheet" href="../styles/styles.css" />-->

<script type="text/javascript">
$(function(){

				// Accordion
				$("#shoppingCart").accordion({
						collapsible: true,
						active: false,
						animated: 'fade',
						header: "h3" 
				});
				
				
});
</script>

<?php

//print_r($_SESSION);

?>
<div id="shoppingCart">
	         <h3><a href="#">VIEW CART &nbsp;&nbsp;</a> | </h3>
         <div>
        	<form name="displayCart" id="displayCart" method="post" action="">
				<table border="0">

                
                	<tr> <td>cat/Name</td> <td> Price/Unit </td> <td> Qty </td> <td> Price/Total </td>
                </tr>
				<?php 
               if (isset($_SESSION['cart'])) {
				//PLAN O'ACTION: <----THANK YOU JEAN THIS REALLY HELPED :)
                //for each item in cart, take the product id, do query for that info from product table
                //for each item in cart, take type id and do query for that info from type table
                //display results
                                     
				//display what's in the session
										 
				//Loop through the cart and display items
				$length = count($_SESSION['cart']); //since using a for loop, need to set a counter.
			
				//echo $length;
				//print_r($_SESSION['cart']);//for troubleshooting
				
				//connect to database
				$conn = dbConnect('query');
				
				if (!isset($grandTotal)){
						$grandTotal = '';
						 $grandTotalItems = '';
					}else{}	
				for ($row = 0; $row < $length; $row++) { //loop through all the cart elements and display
					
					//create variables for the product id and type id which we will need for queries
					$prod_id = $_SESSION['cart'][$row]['prod_id'];
					//echo $prod_id;
					
					
					//GET NAME OF PRODUCT	
					//create SQL query to get the product name that matches the product id
					$sqlProduct = "SELECT prod_name FROM products
							  WHERE prod_id = $prod_id";
					
					//submit the SQL query to the database and get the result for product name
					$resultProduct = $conn->query($sqlProduct) or die(mysqli_error());
					$rowProduct = $resultProduct->fetch_assoc();
					
					//assign product name to variable that we can use to display
					$product = $rowProduct['prod_name'];
					
					//free result of product name query
					$resultProduct->free_result();
			
  
				   
					//GET PRICE INFORMATION
					//variables for price info on the $_SESSION
					$price = $_SESSION['cart'][$row]['price'];
					
					
					$totalPriceEach = ($_SESSION['cart'][$row]['item_qty'] * $price);
		
						
					
					//DISPLAY PRODUCT INFORMATION IN OUR CART DISPLAY
					//write out the information for this product/type in our table
				echo "<tr><td>" . ucwords($product) . "</td>";
					//product
  					echo "<input type=\"hidden\" name=\"prod_id[]\" value=\"$prod_id\">";
					echo "<input type=\"hidden\" name=\"price[]\" value=\"$price\">";
					echo "<td>" . number_format($price, 2, '.', ',') . "</td>"; //price each
					echo "<td><input type=\"text\" name=\"item_qty[]\" size=\"3\" maxlength=\"3\" value=\"". $_SESSION['cart'][$row]['item_qty'] . "\"/></td>"; //quantity in editable form field
					echo "<td>" . number_format($totalPriceEach, 2, '.', ',') . "</td>"; //total for that product
					//echo "<td> <input name=\"delete\" type=\"checkbox\" value=\"delete\" /></td>"; //check if want to delete product
					echo "</tr>";
					
					
						///Now add to the grand total each time through the loop
						$grandTotal = $grandTotal + $totalPriceEach;
						$_SESSION['total_price'] = $grandTotal; //add to the session
						  
						  //NEW WEEK 8
						  // update the total number of items
						  $grandTotalItems = $grandTotalItems + $_SESSION['cart'][$row]['item_qty'];
						  $_SESSION['items'] = $grandTotalItems; //add to session
					}
			   }
	

   
                   
               
		/*	  			//Build summary section of cart display
                          echo "<tr>";
                          echo "<td colspan=\"6\">Number of Items: " . $_SESSION['items'];;
                          echo "</tr>";
                          echo "<tr>";
                          echo "<td colspan=\"6\">Grand total: " . number_format($_SESSION['total_price'], 2, '.', ',') . "</td>";
                          echo "</tr>";
                */
				
				dbClose($conn);
              ?>
             </table>
	
				<input name="update" id="update" type="submit" value="Update Quantity" />
           	 	<input name="view" id="view" type="submit" value="Edit Cart" />
             	<input name="goToCheckout" id="goToCheckout" type="submit" value="Checkout!" />
             </form>
        	<table>
                <tr>
		<?php echo "<tr>";
				echo "<td></td><td></td><td></td><td colspan=\"6\">Total: " . number_format($_SESSION['total_price'], 2, '.', ',') . "</td>";
				echo "</tr>"; ?>
                </tr>   
            </table>
            <a href='includes/unset_cart.php'>Empty your cart</a>
    </div>
    
</div>