<?php
if (array_key_exists('goToCheckout', $_POST)) {
		//redirect to checkout page
		header("Location: checkout.php");
	} elseif (array_key_exists('update', $_POST)) {

	}
/*	
session_start();
ob_start();
include('pistaFunctions.php');
//print_r($_SESSION);*/
?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../styles/styles.css" />
<link rel="stylesheet" type="text/css" href="../styles/jquery.custom.css"/>
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js"></script>
<title>Pista Fixed Gear</title>
</head>



</script>-->
<div id="shoppingCart">
	         <h3><a href="#">VIEW CART</a></h3>
         <div>
        	<form name="displayCart" id="displayCart" method="post" action="">
				<table border="0">
                	<tr> <th>Your Cart</th></tr>
                
                	<tr> <td>Item Name</td> <td>Price</td> <td>Quantity</td> <td>Total Amount</td>
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
				
					
				for ($row = 1; $row < $length; $row++) { //loop through all the cart elements and display
					//create variables for the product id and type id which we will need for queries
					$product_id = $_SESSION['cart'][$row]['product_id'];
					//echo $product_id;
					$color_id = $_SESSION['cart'][$row]['color_id'];
					$size_id = $_SESSION['cart'][$row]['size_id'];
					
					//GET NAME OF PRODUCT	
					//create SQL query to get the product name that matches the product id
					$sqlProduct = "SELECT product FROM products
							  WHERE product_id = $product_id";
					
					//submit the SQL query to the database and get the result for product name
					$resultProduct = $conn->query($sqlProduct) or die(mysqli_error());
					$rowProduct = $resultProduct->fetch_assoc();
					
					//assign product name to variable that we can use to display
					$product = $rowProduct['product'];
					
					//free result of product name query
					$resultProduct->free_result();
			
  
				   
					//GET PRICE INFORMATION
					//variables for price info on the $_SESSION
					$price = $_SESSION['cart'][$row]['price'];
					$totalPriceEach = ($_SESSION['cart'][$row]['item_qty'] * $price);
					
					$items = array();
					array_push($items, $product_id,$color_id,$size_id,$product,$totalPriceEach);
				//print_r($items);
				
				//array_shift($_SESSION['cart'][$row]);
				}
				
					//DISPLAY PRODUCT INFORMATION IN OUR CART DISPLAY
					//write out the information for this product/type in our table
				echo "<tr><td>" . ucwords($product) . "</td>";
					//product
  
					echo "<td>" . number_format($price, 2, '.', ',') . "</td>"; //price each
					//echo "<td><input type=\"text\" name=\"" . $_SESSION['cart'][$row]['item_qty'] . "\" size=\"3\" maxlength=\"3\" value=\"". $_SESSION['cart'][$row]['item_qty'] . "\"/>
					//</td>"; //quantity in editable form field
					echo "<td>" . number_format($totalPriceEach, 2, '.', ',') . "</td>"; //total for that product
					echo "<td> <input name=\"delete\" type=\"checkbox\" value=\"delete\" /></td>"; //check if want to delete product
					echo "</tr>";
				
				
					
					//Now add to the grand total each time through the loop
					if (!isset($grandTotal)){$grandTotal = 0;}else{
					$grandTotal = $grandTotal + $totalPriceEach;
					$_SESSION['total_price'] = $grandTotal; //add to the session
			   }
	   }

  /*   
                      }
              } else {
                  echo "<tr>";
                  echo "<td colspan=\"6\">You have nothing in your cart yet.  Add something!</td>";
                  echo "</tr>";
              }//end if else
              
			  			//Build summary section of cart display
                          echo "<tr>";
                          echo "<td colspan=\"6\">Number of Items: " . $_SESSION['items'];;
                          echo "</tr>";
                          echo "<tr>";
                          echo "<td colspan=\"6\">Grand total: " . number_format($_SESSION['total_price'], 2, '.', ',') . "</td>";
                          echo "</tr>";
              */
              ?>
             </table>
             <input name="update" id="update" type="submit" value="Update Quantity" />
             <input name="goToCheckout" id="goToCheckout" type="submit" value="Checkout!" />
             </form>
        	<table>
                <tr>Total:<?php echo "<tr>";
				echo "<td colspan=\"6\">Total: " . number_format($_SESSION['total_price'], 2, '.', ',') . "</td>";
				echo "</tr>"; ?>
                </tr>   
            </table>
            <a href='includes/unset_cart.php'>Empty your cart</a>
    </div>
    
</div>
<script type="text/javascript">
   


$(function(){
		// Accordion
		$("#shoppingCart").accordion({
			collapsible: true,
    			animated: 'fade',
			header: '.h3', 
			navigation: true, 
			event: 'click' 
		});						
});
</script>