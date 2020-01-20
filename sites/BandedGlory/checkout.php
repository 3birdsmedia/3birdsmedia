<?php
session_start();
ob_start();

$busterOn = true;
if($busterOn !== false){
	$buster = rand (1,254);
	$buster = "?v=.$buster";
}else{
	$buster = "";
}
// echo "SESSION<hr/>";
// print_r($_SESSION);
// echo "POST<hr/>";
// print_r($_POST);
// echo "<hr/>";

$amount = $_SESSION['total_price'];//get this from session, set in view_cart.php
include('includes/functions.php');

logginFunc('checkout.php');

/*
Author: D. Jean Hester
Date:  February 2011
Course:  Ecommerce Site Design
Version: 4.0
Description:  Script to build a summary of items in shopping cart, build order form, capture information from form and add to database when customer checks out.
*/


/* TO DO -
	  -- Add shipping address to form, and code the check if the same then ignore, otherwise use that shipping address for orders table
	  --Validation on form
	  --if customer already in table, then don't insert, just get their customer # and use that
	  -- Update inventory number by decrementing from number of items bought.
	  -- Comment out all troubleshooting code

 PLAN OF ATTACK:
	insert customer stuff into customer table
	then get the customer id for customer just inserted
	then use that customer id to insert the order into the orders table
	then get that order id just inserted
	then finally use that order id to enter products into order_items table by
		looping through the SESSION cart variables
*/

if (array_key_exists('checkout', $_POST)) {//if checkout button pressed
	//assign _POST variables to variables for easier use
	$customer_fname = $_POST['firstname'];
	$customer_lname = $_POST['lastname'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$ship_customer_fname = $_POST['shipfirstname'];
	$ship_customer_lname = $_POST['shiplastname'];
	$ship_street = $_POST['shipstreet'];
	$ship_city = $_POST['shipcity'];
	$ship_state = $_POST['shipstate'];
	$ship_zip = $_POST['shipzip'];

	$_SESSION['total_price'] = $_POST['newTotalPrice'];

	$amount = $_SESSION['total_price'];//get this from session, set in view_cart.php

	//echo "<h1>".$amount."</h1>";

	//set variable for the order status
	$order_status = 'N'; //N for new order


	//echo "<p>Name is: " . $customer_fname . $customer_lname . "</p>"; //for troubleshooting

	//initialize flags  - one for each insert
	//we will use these to check that everything worked BEFORE we commit the transaction
		$OK = false; //flag for customer insert
		$OK2 = false; //flag to get customerID
		$OK3 = false; //flag for for orders insert
		$OK4 = false; //flag to get orderID
		$OK5 = false; //flag for order_items insert


		//create database connection - note this connection is made with the admin account, that has permissions to update,insert, and delete records
		$conn = dbConnect('admin');

		// we want to insert the order as a transaction
  		// start one by turning off autocommit
 		$conn->autocommit(FALSE);

  		//TO DO:  IF WE HAD A SECURE SERVER AND/OR AN CREDIT CARD AUTHENTICATION PROVIDER, WE WOULD SEND CREDIT CARD INFO
		//OFF HERE, WAIT FOR INFO BACK, IF THEY HAVE $$ PROCESS ORDER, ELSE TELL THEM TO TRY AGAIN.

  		//TO DO:  test to see if this customer already exists, if so, don't add them, just get
		//	their customer id
	if(isset($_SESSION['loggedin'])){
		//the customer already exists, no need to create  new one
		$OK = true;
	}else{
		//////////////////////////////////////////////////////////////////
		//create SQL to insert customer information  -we are setting up a prepared statement
		$sql = 'INSERT INTO customer (customer_fname, customer_lname, street, city, state, zip)
				VALUES (?, ?, ?, ?, ?, ?)';

		//initialize prepared statement
		$stmt = $conn->stmt_init();
		if ($stmt->prepare($sql)) {
			//bind parameters and execute statement
			//NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
			$stmt->bind_param('ssssss', $customer_fname, $customer_lname, $street, $city, $state, $zip);
			$OK = $stmt->execute(); //if statement executes, will set this flag to true
			// free the statement for the next query
	  		$stmt->free_result();
		}
	}

		//////////////////////////////////////////////////////
		//move on to inserting the order information into orders table, then the products into order_items table

			//get the customer id of the customer just inserted
			//remember, name and street etc info comes from _POST array from checkout form
			//using all the customer info to make a match just to be certain
	if(!isset($_SESSION['customer_id'])){
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
		}else{
			$OK2 = true;
		}
		//////////////////////////////////////////////////////////////////
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
				//NOTE:  the amount is a data type of a double, so use 'd' for 'double' in the second parameter below
				//can use the same variables as the other query
				$stmt->bind_param('idsssssss', $customer_id, $amount, $order_status, $ship_customer_fname, $ship_customer_lname, $ship_street, $ship_city, $ship_state, $ship_zip);
				$OK3 = $stmt->execute();
				// free the statement for the next query
		  		$stmt->free_result();
				}
		//////////////////////////////////////////////////////////////////
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
			  //NOTE:  the amount is a data type of a float, so use 'd' for 'double' in the second parameter below
			  $stmt->bind_param('idsssssss', $customer_id, $amount, $order_status, $customer_fname, $customer_lname, $street, $city, $state, $zip);
			  // bind the result to $order_id
			  $stmt->bind_result($order_id);
			  // execute the statement and get the result
			  $OK4 = $stmt->execute();
			  $stmt->fetch();
			  // free the statment for the next query
			  $stmt->free_result();
//			  echo "<p>Order id is: " . $order_id . "</p>"; //for troubleshooting
			}

		 ////////////////////////////////////////////////////////////////////////
		//then use the order id from order table AND products in cart array to insert into order_items

			//Do an insert for each loop through the cart variables below, and be sure to add other info as needed
			//		like the order id and price etc.  Set a variable for each $_session item below and then put that
			//		variable into the SQL statement
			// must add price to other pages and to session!

			$length = count($_SESSION['cart']);

			for ($row = 0; $row < $length; $row++) { //loop through all the cart elements

						//assign each SESSION item to variables for SQL
						$prod_id = $_SESSION['cart'][$row]['prod_id'];
						$type = $_SESSION['cart'][$row]['type'];
						$item_price = $_SESSION['cart'][$row]['price'];
						$quantity = $_SESSION['cart'][$row]['item_qty'];
						$extra = $_SESSION['cart'][$row]['extra'];

//						echo "<p>Product is $prod_id, Type is $type, Item Price is $item_price, and Quantity is $quantity.</p>";
						//create SQL -we are setting up a prepared statement
						$sql = 'INSERT INTO order_items (order_id, prod_id, type, item_price, quantity, extra)
							VALUES (?,?,?,?,?,?)';

						//echo "SQL is: " . $sql . "</br>";//for troubleshooting

						//initialize prepared statement
						$stmt = $conn->stmt_init();
						if ($stmt->prepare($sql)) {
							//bind parameters and execute statement
							//NOTE!  The first parameter here indicates the data type of each of the variables passed,
							//this order must match the order in the $sql statement above
							$stmt->bind_param('iisdii', $order_id, $prod_id, $type, $item_price, $quantity, $extra);
							$OK5 = $stmt->execute();
							// free the statement for the next query
							$stmt->free_result();
						}//end if
			}//end for loop

		//TRANSACTIONS AND ROLLBACK
		//FOR TROUBLESHOOTING ONLY & DEMONSTRATION PURPOSES ONLY
		//changing status of $OK5 to false so we can see if rollback is working.
		//When $OK5 is set to false, none of the previous database inserts will be committed.
		//You can take a look at the page in a browser, and you'll see the customer ID and order ID there.  Make a note of them.
		//Next, go to the database - you'll see that neither of those items is in the database.
		//They weren't committed, and the status of the database was rolled back.  Data integrity
		//is maintained!
		//$OK5 = false; //for troubleshooting only

		//THE FOLLOWING echo statements are for troubleshooting and demo purposes only.
		if ($OK == true) {
				echo "<p>OK true.</p>";
			}

		if ($OK2 == true) {
			echo "<p>OK2 true.</p>";
		}

		if ($OK3 == true) {
			echo "<p>OK3 true.</p>";
		}

		if ($OK4 == true) {
			echo "<p>OK4 true.</p>";
		}

		if ($OK5 == true) {
			echo "<p>OK5 true.</p>";
		}
		//CHECK THOSE OK FLAGS!  Make sure all are set to true BEFORE committing the transaction!!!!!!!!
		if($OK == true && $OK2 == true && $OK3 == true && $OK4 == true && $OK5 == true) {
			//all of the inserts and queries worked, so we can commit this transaction
//			echo "<h3>All of the inserts were fine, we are committing!</h3>";
			// end transaction, turn autocommit back on
  			$conn->commit();
  			$conn->autocommit(TRUE);
		} else {
			//To see this 'else' in action, uncomment the $OK5 = false line of code back in.
			//That line of code is directly above the echo statements for all the OKs.

			//there was an error, redirect to error page
//			echo "<h3>OOPS!  There was an error processing your order.</h3>";
			//rollback those inserts, and get the database back to where it was before we started.
			$conn->rollback();
			//turn autocommit back on
			$conn->autocommit(TRUE);
			//header("Location: error.php"); //THIS IS commented out so you can see the echo statements for troubleshooting
		}

		//need to destroy the session, so the cart gets emptied and destroyed
		//session_destroy();

		//close the database connection
		dbClose($conn);
  		$_SESSION['payment']['order_id'] = $order_id;
			$_SESSION['payment']['state'] = $state;

			$_SESSION['new_total_price'] = $_POST['newTotalPrice'];


		print_r($_SESSION);

		echo $_POST['newTotalPrice'];

		//return us to confirmation page
		header("Location: payment.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.

} else {
	$message = "<p class='alert'>Please fill out the form in order to checkout.</p>";
};
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<?php googleAnalytics("UA-48260012-6"); ?>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
	<link rel="manifest" href="images/site.webmanifest">
	<link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#00aaff">
	<link rel="shortcut icon" href="images/favicon.ico">
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-config" content="images/browserconfig.xml">
	<meta name="theme-color" content="#00aaff">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon/favicon.ico">

	<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/site.css<?php echo $buster; ?>" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>

	<script type="text/javascript">
$(document).ready(function(){
	$("#checkout").validate();
});
function shipsame(form){

if(form.sameasbilling.checked){

     form.shipfirstname.value = form.firstname.value;
     form.shiplastname.value = form.lastname.value;
     form.shipstreet.value = form.street.value;
     form.shipcity.value = form.city.value;
     form.shipzip.value = form.zip.value;

     if(form.state.type == "select-one"){
          var bStateIdx = form.state.selectedIndex;
          form.shipstate.options[bStateIdx].selected = true;
     }
     else{
          form.shipstate.value = form.state.value;
     }
}
else{
     form.shipname.value = "";
     form.shiplastame.value = "";
     form.shipaddress.value = "";
     form.shipcity.value = "";
     if(form.shipstate.type == "select-one"){
          form.shipstate.options[0].selected = true;
     }
     else{
          form.shipstate.value = "";
     }
     form.shipcity.value = "";
     form.shipzip.value = "";
}
}
//-->
</script>

</head>

<body>
	<main class="wrapper">
		<header>
			<div class="help-bar row  text-center">
				<div class="contact-phone col-sm-12 col-md-6"><i class="fas fa-envelope"></i><a href="mailto:support@bandedglory.com">support@bandedglory.com</a></div>

				<div class=" col-sm-12 col-md-6">
					<span class="display-cart">
						<a href="view_cart.php" title="View Cart">
							<i class="fas fa-shopping-cart"></i>
							<?php
							if(isset($_SESSION['items'])){
								echo "<span class='cart-count'>".$_SESSION['items']."</span>";
							}
							?>
						</a>
					</span>
					<span>
						<a href="cpanel/myaccount.php" title="My Account"><i class="fas fa-user-circle"></i>  MY ACCOUNT </a>
						<?php
						if (isset($_SESSION['loggedin'])) {
							echo  '<a href="logout.php" title="Login"><i class="fas fa-sign-out-alt"></i>  LOGOUT</a>';
						}else{
							echo  '<a href="cpanel/index.php" title="Login"><i class="fas fa-sign-in-alt"></i>  LOGIN</a>';
						}
						?>
					</span>
				</div>
			</div>
			<?php include('includes/navBar.php');?>

		</div>

	</header>
	<section id="secondary" class="parallax">
		<div class="" id="secondary">
			<h2>Designed for Comfort & Built to Last</h2>
		</div><!-- /.container -->
	</section>
	<section>

		<h2>Check out</h2>

	    <div id="cart">

	    <div id="checkoutlogin" class="cartMod">
		<?php
	        if (isset($_SESSION['loggedin'])) {
	            echo	'<h3>You are already Logged In.</h3> <br/>';
	        }else{
	            ?>
			<form action="" method="post" enctype="multipart/form-data">
				<p><label for="username" style="text-transform:none;display:block; float:left;"> Username:</label>
	            <input name="username" size="13" style="text-transform:none;display:block; float:left;margin-left:10px;" />
	            <label for="password" style="text-transform:none;display:block; float:left;margin-left:10px;"> Password:</label>
	            <input type="password" name="password" size="13" style="text-transform:none;display:block; float:left;margin-left:10px;" />
	            <input class="login" type="submit" name="login" value="Login" style="text-transform:none;display:block; float:left;margin-left:10px;" />
	            <div style="float:left;clear:both;">
	            	<a href="mailto:costumercare@digiprintproducts.com" title="Forgot my Password">Forgot your password?</a>
	                 |
	                <a href="cpanel/index.php" title="Register">Register</a>
	            </div>
			</form>

	        	<?php
	        }
	    ?>
	     </div>


	 </div>

	 <div id="leftcart" class="cartMod">

	            <h3><?php if(isset($message)){echo strtoupper($message);} ?></h3>


	            <form name="checkout" id="checkout" method="post" action="">

				<p><label>*Name:</label>
	              <input type="text" id="firstname" name="firstname" class='required' value="<?php if(isset($firstname)){echo $firstname;}else{ echo "First Name";} ?>" onfocus="this.value = '',this.style.color='#000',this.style.color='#000'"/></p>
	              <input type="text" id="lastname" name="lastname" class='required' value="<?php if(isset($lastname)){echo $lastname;}else{ echo "Last Name";} ?>" onfocus="this.value = '',this.style.color='#000'"/></p>

	              <p><label>Street:</label><input name="street" class='required' type="text" value="<?php if (isset($street)){echo $street;} else {echo "";} ?>" size="40" /></p>
	              <p><label>City:</label><input name="city" class='required' type="text" value="<?php if (isset($city)){echo $city;} else {echo "";} ?>" size="40" /></p>

	 				<label>State:</label>
	                        <select name="state" size="1">
	                        <?php if(isset($state)){echo "<option selected value='$state'>$state</option>";} ?>

	                                    <option value="CA">CA</option>
	                                    <option value="AK">AK</option>
	                                    <option value="AL">AL</option>
	                                    <option value="AR">AR</option>
	                                    <option value="AZ">AZ</option>
	                                    <option value="CO">CO</option>
	                                    <option value="CT">CT</option>
	                                    <option value="DC">DC</option>
	                                    <option value="DE">DE</option>
	                                    <option value="FL">FL</option>
	                                    <option value="GA">GA</option>
	                                    <option value="HI">HI</option>
	                                    <option value="IA">IA</option>
	                                    <option value="ID">ID</option>
	                                    <option value="IL">IL</option>
	                                    <option value="IN">IN</option>
	                                    <option value="KS">KS</option>
	                                    <option value="KY">KY</option>
	                                    <option value="LA">LA</option>
	                                    <option value="MA">MA</option>
	                                    <option value="MD">MD</option>
	                                    <option value="ME">ME</option>
	                                    <option value="MI">MI</option>
	                                    <option value="MN">MN</option>
	                                    <option value="MO">MO</option>
	                                    <option value="MS">MS</option>
	                                    <option value="MT">MT</option>
	                                    <option value="NC">NC</option>
	                                    <option value="ND">ND</option>
	                                    <option value="NE">NE</option>
	                                    <option value="NH">NH</option>
	                                    <option value="NJ">NJ</option>
	                                    <option value="NM">NM</option>
	                                    <option value="NV">NV</option>
	                                    <option value="NY">NY</option>
	                                    <option value="OH">OH</option>
	                                    <option value="OK">OK</option>
	                                    <option value="OR">OR</option>
	                                    <option value="PA">PA</option>
	                                    <option value="RI">RI</option>
	                                    <option value="SC">SC</option>
	                                    <option value="SD">SD</option>
	                                    <option value="TN">TN</option>
	                                    <option value="TX">TX</option>
	                                    <option value="UT">UT</option>
	                                    <option value="VA">VA</option>
	                                    <option value="VT">VT</option>
	                                    <option value="WA">WA</option>
	                                    <option value="WI">WI</option>
	                                    <option value="WV">WV</option>
	                                    <option value="WY">WY</option>
	                                </select>
	              <p><label>Zip:</label> <input name="zip" type="text" value="<?php if (isset($zip)){echo $zip;} else {echo "";} ?>" size="10" /></label></p>

		</div>
	    <div id="rightcart" class="cartMod">

	              <h3>SHIPPING</h3>
	              <p><input type="checkbox" name="sameasbilling" value="checkbox" onClick="shipsame(this.form);" style="clear:none;float:none;display:inline;margin-right:10px;">Same As Billing:</p>

	              <p><label>First Name:</label> <input name="shipfirstname" class='required' type="text" value="" size="20" /></label></p>
	              <p><label>Last Name:</label> <input name="shiplastname" class='required' type="text" value="" size="20" /></label></p>

	              <p><label>Street:</label> <input name="shipstreet" class='required' type="text" value="" size="40" /></label></p>
	              <p><label>City:</label> <input name="shipcity" id="shipcity" class='required' type="text" value="" size="40" /></label></p>
	              <label>State:</label>
	                        <select id="shipstate" name="shipstate" size="1">
	                        <?php if(isset($state)){echo "<option selected value='$state'>$state</option>";} ?>

	                                    <option value="CA">CA</option>
	                                    <option value="AK">AK</option>
	                                    <option value="AL">AL</option>
	                                    <option value="AR">AR</option>
	                                    <option value="AZ">AZ</option>
	                                    <option value="CO">CO</option>
	                                    <option value="CT">CT</option>
	                                    <option value="DC">DC</option>
	                                    <option value="DE">DE</option>
	                                    <option value="FL">FL</option>
	                                    <option value="GA">GA</option>
	                                    <option value="HI">HI</option>
	                                    <option value="IA">IA</option>
	                                    <option value="ID">ID</option>
	                                    <option value="IL">IL</option>
	                                    <option value="IN">IN</option>
	                                    <option value="KS">KS</option>
	                                    <option value="KY">KY</option>
	                                    <option value="LA">LA</option>
	                                    <option value="MA">MA</option>
	                                    <option value="MD">MD</option>
	                                    <option value="ME">ME</option>
	                                    <option value="MI">MI</option>
	                                    <option value="MN">MN</option>
	                                    <option value="MO">MO</option>
	                                    <option value="MS">MS</option>
	                                    <option value="MT">MT</option>
	                                    <option value="NC">NC</option>
	                                    <option value="ND">ND</option>
	                                    <option value="NE">NE</option>
	                                    <option value="NH">NH</option>
	                                    <option value="NJ">NJ</option>
	                                    <option value="NM">NM</option>
	                                    <option value="NV">NV</option>
	                                    <option value="NY">NY</option>
	                                    <option value="OH">OH</option>
	                                    <option value="OK">OK</option>
	                                    <option value="OR">OR</option>
	                                    <option value="PA">PA</option>
	                                    <option value="RI">RI</option>
	                                    <option value="SC">SC</option>
	                                    <option value="SD">SD</option>
	                                    <option value="TN">TN</option>
	                                    <option value="TX">TX</option>
	                                    <option value="UT">UT</option>
	                                    <option value="VA">VA</option>
	                                    <option value="VT">VT</option>
	                                    <option value="WA">WA</option>
	                                    <option value="WI">WI</option>
	                                    <option value="WV">WV</option>
	                                    <option value="WY">WY</option>
	                                </select>
	                          <p><label>Zip:</label> <input name="shipzip" id="shipzip" class='required' type="text" value="" size="10" /></label></p>



		</div>


	    <div id="review" class="cartMod">
	    <h3>PLEASE REVIEW YOUR ITEMS</h3>

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
							$grandTotal = 0;
							 $grandTotalItems = 0;
						}else{
					}


					if (isset ($_SESSION['cart'][0]['prod_id'])){
					//print_r($_SESSION);


				?>
	              <form name="review" id="review" method="post" action="">
					<table border="0" class="checkout">


	                	<tr> <th>Product Name</th> <th> Type </th> <th> Price/Unit </th> <th> Qty </th> <th> UV Coated </th> <th> Price/Total </th>
	                </tr>
				<?php

					$pweight = '';
					for ($row = 0; $row < $length; $row++) { //loop through all the cart elements and display

					//create variables for the product id and type id which we will need for queries
					$prod_id = $_SESSION['cart'][$row]['prod_id'];
					//$up = $_SESSION['cart'][$row]['up'];
					//	echo $up;


						//GET NAME OF PRODUCT
						//create SQL query to get the product name that matches the product id
					$sqlProduct = "SELECT prod_name FROM products
								  	WHERE prod_id = $prod_id";

						//submit the SQL query to the database and get the result for product name
						$resultProduct = $conn->query($sqlProduct) or die(mysqli_error());
						$rowProduct = $resultProduct->fetch_assoc();

						//assign product name to variable that we can use to display
						$product = $rowProduct['prod_name'];
						//$up		 = $rowProduct['qty_per_sheet'].'up';
						//free result of product name query
						$resultProduct->free_result();


						//GET PRICE INFORMATION
						//variables for price info on the $_SESSION

				//$pweight = $pweight + $rowProduct['weight'];

				//echo '<h1>'.$pweight.'</h2>';


					$price = 'N/A';
					$totalPriceEach = $_SESSION['cart'][$row]['price'];

					//DISPLAY PRODUCT INFORMATION IN OUR CART DISPLAY
					//write out the information for this product/type in our table
					echo "<tr><td>" . ucwords($product) . "</td>";
						//product
	  					echo "<input type=\"hidden\" name=\"prod_id[]\" value=\"$prod_id\">";
						echo "<input type=\"hidden\" name=\"price[]\" value=\"$totalPriceEach\">";
						//echo "<input type=\"hidden\" name=\"up[]\" value=\"$up\">";
						echo "<td>" . $price . "</td>"; //price each
						echo "<td>".$_SESSION['cart'][$row]['item_qty']."</td>"; //quantity in editable form field
						echo "<td>$ " . $totalPriceEach . "</td>"; //total for that product
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



					dbClose($conn);
				// $extraItem = 0;
				// for ($row = 0; $row < $length; $row++) {
				// 	if($_SESSION['cart'][$row]['extra'] == '1'){
				// 		$extraItem = $extraItem + 1;
				// 	}
				// }

//		$extraPrice = $extraItem * 15;
		// echo "<tr>";
		// echo "<td></td><td></td><td></td><td>Extras:</td><td>$ 15 x $extraItem</td><td>$ ".number_format($extraPrice, 2, '.', ',') ."</td>";
		// echo "</tr>";
		echo "<tr>";
		echo "<td>SHIPPING</td><td></td><td></td><td>";
			echo '<select id="selService" name="selService">
	               <option value="GND">Ground</option>
	               <option value="3DS">3 Day Select</option>
	               <option value="1DA">Next Day Air</option>
	            </select>';
		echo "</td><td>";
		echo "<input name=\"ship\" type=\"button\" value=\"Calculate Shipping\" onclick=\"javascript:ship_calc('ship');\" />";

		echo "</td><td>$ <span id='shipping'></span></td>";
		echo "</tr>";
		echo "<tr>";
		// echo "<td></td><td></td><td></td><td></td><td>Sub-Total:</td><td>$ <span id='totalPrice'> ".number_format(($_SESSION['total_price']+$extraPrice), 2, '.', ',')."</span></td>";
		// echo "<input type='hidden' name='newTotalPrice' id='newTotalPrice' value=' ".number_format(($_SESSION['total_price']+$extraPrice), 2, '.', ',')."' /></tr>";
		echo "<td></td><td></td><td></td><td></td><td>Sub-Total:</td><td>$ <span id='totalPrice'> ".number_format(($_SESSION['total_price']), 2, '.', ',')."</span></td>";
		echo "<input type='hidden' name='newTotalPrice' id='newTotalPrice' value=' ".number_format(($_SESSION['total_price']	), 2, '.', ',')."' /></tr>";


		?>
	                </table>
	                <input name="weight" id="weight" type="hidden" value="<?php echo $pweight ?>" /></p>
		<a href='includes/unset_cart.php'>Empty your cart</a>

	                 <hr /><br />
	            <input name="checkout" type="submit"  class="submit" id="upload" value="Place Order!" />
	        </form>


	<?php }else{
		echo "<hr /><br /> There are no items in your cart!, please feel free to go <a href='products.php' title='shopping'>back shopping</a>!";
	}

	}?>

	 </div>


	</div><!--END OF CONTENT-->

</section>
<section>
	<div class="container">
		<div class="policies row">
			<div class="col-md-4 col-sm-12"><i class="fas fa-plane"></i><br/>Free Shipping</div>
			<div class="col-md-4 col-sm-12"><i class="far fa-clock"></i><br/>30-Days Size Exchange</div>
			<div class="col-md-4 col-sm-12"><i class="far fa-life-ring"></i><br/>Lifetime Warranty</div>
		</div>
	</div>
</section>

<?php include('includes/footer.php');?>


</main>
<script type="text/javascript">
var str = '';
function ship_calc(str){
var zip = document.getElementById('shipzip').value;
//alert(zip);
var city = document.getElementById('shipcity').value;
//alert(city);
var service = document.getElementById('selService').value;
//alert(service);
var weight = document.getElementById('weight').value;
//alert(weight);


var xmlhttp;
	if (str.length==0){
	  document.getElementById("shipping").innerHTML="";
	  return;
	}

	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var shippingPrice = xmlhttp.responseText;
			var totalPrice = (<?php echo $_SESSION['total_price'] ?>)*1 + (shippingPrice)*1;
			document.getElementById("shipping").innerHTML=shippingPrice;
			document.getElementById("newTotalPrice").value=totalPrice;
			document.getElementById("totalPrice").innerHTML=totalPrice;
		}
	}
	xmlhttp.open("GET","includes/getship.php?szip=" + zip + "&scity=" + city + "malibu&service=" + service + "&weight=" + weight + "",true);
	xmlhttp.send();
}
</script>
</body>
</html>
