<?php
session_start();
ob_start();
$amount = $_SESSION['total_price'];//get this from session, set in view_cart.php
	
//echo $amount;
include("includes/pistaFunctions.php");
if (array_key_exists('checkout', $_POST)) {//if checkout button pressed
	//assign _POST variables to variables for easier use
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	
	
	//set variable for the order status
	$order_status = 'N'; //N for new order
	
	
	//echo "Name is: " . $customer_fname . $customer_lname; //for troubleshooting
	
	//initialize flags  - one for each insert 
		/*$OK = false; //flag for customer insert
		$OK2 = false; //flag for orders insert
		$OK3 = false; //flag for order_items insert
		*/
		
		//create database connection - note this connection is made with the admin account, that has permissions to update,insert, and delete records
		$conn = dbConnect('admin');
		
		// we want to insert the order as a transaction
  		// start one by turning off autocommit
 		$conn->autocommit(FALSE);
  
  		//TO DO:  test to see if this customer already exists, if so, don't add them, just get
		//	their customer id
		
		//create SQL -we are setting up a prepared statement
		$sql = 'INSERT INTO customer (customer_fname, customer_lname, street, city, state, zip)
				VALUES (?, ?, ?, ?, ?, ?)';
				
		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
			$stmt->bind_param('ssssss', $customer_fname, $customer_lname, $street, $city, $state, $zip);
			$OK = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
		}
				
		//move on to inserting the order information into orders table, then the products into order_items table

			//get the customer id of the customer just inserted
			//remember, name and street etc info comes from _POST array from checkout form
			//using all the customer info to make a match just to be certain
			$getCustomerId = 'SELECT customer_id FROM customer
						  WHERE customer_fname = ? 
						  AND customer_lname = ? 
						  AND street = ?
						  AND city = ?
						  AND state = ?
						  AND zip = ?';
			// statement object already exists, so you just need to prepare it with the new SQL
			if ($stmt->prepare($getCustomerId)) {
			  // bind parameters and execute statment
			  $stmt->bind_param('ssssss', $customer_fname, $customer_lname, $street, $city, $state, $zip); 
			  // bind the result to $customer_id
			  $stmt->bind_result($customer_id);
			  // execute the statement and get the result
			  $OK2 = $stmt->execute();
			  $stmt->fetch();
			  // free the statment for the next query
			  $stmt->free_result();
			  echo "Customer id is: " . $customer_id; //for troubleshooting
			}
			
		//now use the customer_id to insert into order table...
			//create SQL -we are setting up a prepared statement
			//TO DO:  this shipping address needs to be added to form, and checked to see if the same as address
				//for now, just using same address they entered before for both customer address AND shipping address
			$sql = 'INSERT INTO orders (customer_id, amount, order_status, ship_customer_fname, ship_customer_lname, ship_street, ship_city, ship_state, ship_zip, date)
				VALUES (?,?,?,?,?,?,?,?,?,NOW())';
			
			//initialize prepared statement
			$stmt = $conn->stmt_init();
			if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
			//can use the same variables as the other query
			$stmt->bind_param('sisssssss', $customer_id, $amount, $order_status, $customer_fname, $customer_lname, $street, $city, $state, $zip);
			$OK3 = $stmt->execute();
			// free the statement for the next query
	  		$stmt->free_result();
			}
			
		//then find out the order_id of the order we just inserted...
			//get the order id
			//remember, name and street etc info comes from _POST array from checkout form
			//using all the same customer info to make a match just to be certain
			$getOrderId = 'SELECT order_id FROM orders
						  WHERE customer_id = ?
						  AND amount = ?
						  AND order_status = ?
						  AND ship_customer_fname = ? 
						  AND ship_customer_lname = ? 
						  AND ship_street = ?
						  AND ship_city = ?
						  AND ship_state = ?
						  AND ship_zip = ?';
			// statement object already exists, so you just need to prepare it with the new SQL
			if ($stmt->prepare($getOrderId)) {
			  // bind parameters and execute statment
			  //NOTE:  the amount is a data type of a float, so use 'd' for 'double' in the first parameter below
			  $stmt->bind_param('idsssssss', $customer_id, $amount, $order_status, $customer_fname, $customer_lname, $street, $city, $state, $zip); 
			  // bind the result to $order_id
			  $stmt->bind_result($order_id);
			  // execute the statement and get the result
			  $OK4 = $stmt->execute();
			  $stmt->fetch();
			  // free the statment for the next query
			  $stmt->free_result();
			  echo "Order id is: " . $order_id; //for troubleshooting
			}
			
		//then use the order id from order table AND products in cart array to insert into order_items

			//DONE: Do an insert for each loop through the cart variables below, and be sure to add other info as needed
			//		like the order id and price etc.  Set a variable for each $_session item below and then put that
			//		variable into the SQL statement
			//DONE: must add price to other pages and to session!
			
			$length = count($_SESSION['cart']);
			
			for ($row = 0; $row < $length; $row++) { //loop through all the cart elements 
						
						//assign each SESSION item to variables for SQL
						$product_id = $_SESSION['cart'][$row]['product_id'];
						$type_id = $_SESSION['cart'][$row]['type_id'];
						$item_price = $_SESSION['cart'][$row]['price'];
						$quantity = $_SESSION['cart'][$row]['item_qty'];
												
						//create SQL -we are setting up a prepared statement
						$sql = 'INSERT INTO order_items (order_id, product_id, type_id, item_price, quantity)
							VALUES (?,?,?,?,?)';
						
						echo "SQL is: " . $sql . "</br>";//for troubleshooting
						
						//initialize prepared statement
						$stmt = $conn->stmt_init();
						if ($stmt->prepare($sql)) {
							//bind parameters and execute statement
							//NOTE!  The first parameter here indicates the data type of each of the variables passed, 
							//this order must match the order in the $sql statement above
							$stmt->bind_param('iiidi', $order_id, $product_id, $type_id, $item_price, $quantity);
							$OK5 = $stmt->execute();
							// free the statement for the next query
							$stmt->free_result();
						}//end if
			}//end for loop
			
		//CHECK THOSE OK FLAGS!  Make sure all are set to true BEFORE commit!!!!!!!!
		//but we haven't written this code yet, so just pretend all is well.
		
		// end transaction
  		$conn->commit();
  		$conn->autocommit(TRUE);
		
		//need to destroy the session, so the cart gets emptied and destroyed
		session_destroy();
		
		//close the database connection
		dbClose($conn);
  
		//return us to confirmation page
		header("Location: confirmation.php");
		  
} else {
	$message = "<p class=\"alert\">Please fill out this form.</p>";
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery.validate.pack.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
	$("#checkout").validate();
});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/slider_styles.css" />
<link rel="stylesheet" href="styles/twitter_style.css" />


<style>
.content {
    width:870px;
    margin:auto;
    padding:35px 15px 80px 15px;
    height:350px;
}
</style>
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
    </div>
	<div class="content">
          <div id="left"> 	
            <table id="view_cart">
            <tr>
            	<td><strong>Product</strong></td>
                <td><strong>Type</strong></td>
                <td><strong>Price Each</strong></td>
                <td><strong>Quantity</strong></td>                
                <td><strong>Subtotal</strong></td>
             </tr>
            
			  <?php 
               if (isset($_SESSION['cart'])) {
				   //TO DO:  this would be GREAT if it were a function that could be called, since this
				   //	code exists in similar form in two separate files (which isn't a great idea) - view_cart.php and checkout.php
                
				//PLAN O'ACTION:
                //for each item in cart, take the product id, do query for that info from product table
                //for each item in cart, take type id and do query for that info from type table
                //display results
                
                      
                      //display what's in the session
                                               
                      //Loop through the cart and display items
                      $length = count($_SESSION['cart']); //since using a for loop, need to set a counter.
                      
                      //print_r($_SESSION['cart']);//for troubleshooting
                      
                      //connect to database
                      $conn = dbConnect('query');
                          
                      for ($row = 0; $row < $length; $row++) { //loop through all the cart elements and display
                          
                          //create variables for the product id and type id which we will need for queries
                          $product_id = /*$_SESSION['cart'][$row]['product_id'];*/ 7;
                       //   $type_id = $_SESSION['cart'][$row]['type_id'];
                          
                          //GET NAME OF PRODUCT	
                          //create SQL query to get the product name that matches the product id
                          $sqlProd = "SELECT product 
                          FROM products 
                          WHERE product_id = 7";
                          
                          //submit the SQL query to the database and get the result for product name
                          $resultProd = $conn->query($sqlProd) or die(mysqli_error());
                          $rowProd = $resultProd->fetch_assoc();
                          
						  //assign product name to variable that we can use to display
                          $productName = $rowProd['product'];
                          
                          //free result of product name query
                          $resultProd->free_result();
  
  
                          //GET TYPE OF PRODUCT
                          //create SQL query to get the type name that matches the type id
                         // $sqlType = "SELECT type_name 
                          //FROM type 
                          //WHERE type_id = $type_id";
                          
                          //submit the SQL query to the database and get the result for type name
                          //$resultType = $conn->query($sqlType) or die(mysqli_error());
                          //$rowType = $resultType->fetch_assoc();
                          
						  //assign type name to variable that we can to display
                        //  $typeName = $rowType['type_name'];
                          
                          //free result of type name query
                          //$resultType->free_result();
                          
                          
                          //GET PRICE INFORMATION
                          //variables for price info on the $_SESSION
                          $price = $_SESSION['cart'][$row]['price'];
                          $totalPriceEach = ($_SESSION['cart'][$row]['item_qty'] * $price);
                          
                          //write out the information for this product/type in our table
                          echo "<tr>";
                          echo "<td>" . ucwords($productName) . "</td>";//product
                          //echo "<td>" . ucwords($typeName) . "</td>";//type
                          echo "<td>" . number_format($price, 2, '.', ',') . "</td>"; //price each
                          echo "<td>" . $_SESSION['cart'][$row]['item_qty'] . "</td>"; //quantity
                          echo "<td>" . number_format($totalPriceEach, 2, '.', ',') . "</td>"; //total for that product
                          echo "</tr>";
                          
                          //need to add to the grand total each time through the loop
            //              $grandTotal = $grandTotal + $totalPriceEach;
            //              $_SESSION['total_price'] = $grandTotal;
                      }
              } else {
                  echo "<tr>";
                  echo "<td colspan=\"5\">You have nothing in your cart yet.  Add something!</td>";
                  echo "</tr>";
              }//end if else
              
                          echo "<tr>";
                          echo "<td colspan=\"5\">Number of Items: " . $_SESSION['items'];;
                          echo "</tr>";
                          echo "<tr>";
                         // echo "<td colspan=\"5\">Grand total: " . number_format($grandTotal, 2, '.', ',') . "</td>";
                          echo "</tr>";
              ?>
             </table>
             
 			<hr />
            <?php if(isset($message)){echo $message;} ?>
	  </div>
	<div id="right">		<p><strong>Fill in name and shipping information:</strong></p>
	
            <form name="checkout" id="checkout" method="post" action="">
            
              <p><label>First Name:</label> <input name="firstname" type="text" value="" size="20" /></label></p>
              <p><label>Last Name:</label> <input name="lastname" type="text" value="" size="20" /></label></p>
              
              <p><label>Street:</label> <input name="street" type="text" value="" size="40" /></label></p>
              <p><label>City:</label> <input name="city" type="text" value="" size="40" /></label></p>
              <p><label>State:</label> <input name="state" type="text" value="" size="2" /></label></p>
              <p><label>Zip:</label> <input name="zip" type="text" value="" size="10" /></label></p>
              
              <hr />
	</div>
	<div id="right">
              <p><strong>Payment Details:</strong></p>
              <p><label>Name on Card:</label><input name="cardname" type="text" value="" size="30" /></label></p>
              <p><label>Card Type:</label><select name="card_type" size="1">
              						<option value="visa">Visa</option>
                                    <option value="mc">MasterCard</option>
                                    <option value="amex">American Express</option>
              					  </select></label></p>
              <p><label>Number:</label><input name="cardnumber" class="disabled" type="text" value="12345678912" size="24" disabled="disabled" /></label></p>
              <p><label>Security Code:</label><input name="security" class="disabled" type="text" value="123" size="3" disabled="disabled"  /></label></p>
              <p><label>Expiration:</label><select name="exp_mo" size="1">
              						<option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
              					  </select>
                                  <select name="exp_yr" size="1">
              						<option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
              					  </select>
                                  </p>
                            
              <input name="checkout" type="submit" value="Checkout!" />

            </form>
	</div>


 
</div>
</div><!--END OF CONTENT-->

<?php include('includes/navBar.php');?>
 <div class="push"></div>

</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>