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
echo "SESSION<hr/>";
print_r($_SESSION);
echo "<hr/>POST<br/>";
print_r($_POST);
echo "<hr/>";

include('includes/functions.php');
//print_r($_SESSION);
if (array_key_exists('goToCheckout', $_POST)) {
		//LOOP THROUGH CART AND CHECK QUANTITIES
		//SET COUNTER
		$length = count($_SESSION['cart']);
		//LOOP THROUGH CART ELEMENTS
		for ($row = 0; $row < $length; $row++) {

				$prod_id = $_SESSION['cart'][$row]['prod_id'];
				$type 	= $_SESSION['cart'][$row]['color'];

				$combo_id = $prod_id.$color;
				//set quantity variables for use in if/elseif conditionals
				$origQty 	 = $_SESSION['cart'][$row]['item_qty']; //the original qty in form/session
				$updateQty 	 = $_POST["item_qty"][$row]; //the new updated qty that came from POST

				//////IF ZERO QUANTITY OR DELETE BOX CHECKED
				if ($updateQty == 0 || (!empty($_POST['delete']) && in_array($combo_id, $_POST['delete'])) ){
						//echo "<strong>inside if/else for qty: ZERO OR CHECKED</strong> <br/>"; //for troubleshooting
						//Alter the grand total
						$_SESSION['total_price'] = ($_SESSION['total_price']) - ($_SESSION['cart'][$row]['price']);
						//Alter the Item Quantity
						$_SESSION['items'] = ($_SESSION['items']) - ($_SESSION['cart'][$row]['item_qty']);

						//unset the product from session
						unset($_SESSION['cart'][$row]);
						unset($_SESSION['cart'][$row]['prod_id']);
						unset($_SESSION['cart'][$row]['color']);
						unset($_SESSION['cart'][$row]['price']);
						unset($_SESSION['cart'][$row]['item_qty']);
						$grandTotal = 0;
						$grandTotalItems = 0;

						//for troubleshooting
						//echo "Orig qty is: " . $origQty . "</br>";
						//echo "Update qty is: " . $updateQty . "</br>";
						//echo "new session qty after changing the session is: " . $_SESSION['cart'][$row]['item_qty']. "</br>";
						//echo "<hr>";

				///////IF UPDATE QTY IS NOT SAME AS ORIGINAL QTY BUT NOT ZERO
				} elseif ($updateQty != $origQty ){

						//echo "<strong>inside if/else for qty: ELSEIF - orig not equal to update qty!!!</strong> <br/>";
						//for troubleshooting
						//update the item to the NEW requested quantity FROM THE POST which is NOT ZERO
						//set variables for the new updated information coming from POST
						//we will need these to rebuild form and to do comparisons
						$updateQty = $_POST["item_qty"][$row];
						$updateProd = $_POST["prod_id"][$row];
						$updatePrice = $_POST["price"][$row];

						//unset old quantity AND other elements ON SESSION
						unset($_SESSION['cart'][$row]['prod_id']);
						unset($_SESSION['cart'][$row]['item_qty']);
						unset($_SESSION['cart'][$row]['color']);

						$_SESSION['cart'][$row]['prod_id'] = $updateProd;
						$_SESSION['cart'][$row]['item_qty'] = $updateQty;
				} else {
//						unset($_SESSION['cart'][$row]['extra']);
//						$_SESSION['cart'][$row]['extra']	  = $updateXTRA;
				}//end if-elseif-else for updating quantities
		}//END FOR LOOP through cart items
		//sorts on first index which in this case is product id
		array_multisort($_SESSION['cart']);
		//redirect to checkout page
		header("Location: checkout.php");

//UPDATE CART
} elseif (array_key_exists('update', $_POST)){
		//////////////////////////////////////
		//LOOP THROUGH CART AND CHECK QUANTITIES
		//SET COUNTER
		$length = count($_SESSION['cart']);
		//echo "LENGTH of cart IN UPDATE is: " . $length . "<br/>";//for troubleshooting
		//LOOP THROUGH CART ELEMENTS
		for ($row = 0; $row < $length; $row++) {
				$prod_id = $_SESSION['cart'][$row]['prod_id'];
				$color 	= $_SESSION['cart'][$row]['color'];

				$combo_id = $prod_id.$color;//NOTE NO SPACE between variables  .$size_id.$color_id
				//set quantity variables for use in if/elseif conditionals
				$origQty 	 = $_SESSION['cart'][$row]['item_qty']; //the original qty in form/session
				$updateQty 	 = $_POST["item_qty"][$row]; //the new updated qty that came from POST

				//////IF ZERO QUANTITY OR DELETE BOX CHECKED
				if ($updateQty == 0 || (!empty($_POST['delete']) && in_array($combo_id, $_POST['delete'])) ){

						//Alter the grand total
						$_SESSION['total_price'] = ($_SESSION['total_price']) - ($_SESSION['cart'][$row]['price']);

						//Alter the Item Quantity
						$_SESSION['items'] = ($_SESSION['items']) - ($_SESSION['cart'][$row]['item_qty']);

						//unset the product from session
							unset($_SESSION['cart'][$row]);
							unset($_SESSION['cart'][$row]['prod_id']);
							unset($_SESSION['cart'][$row]['color']);
							unset($_SESSION['cart'][$row]['price']);
							unset($_SESSION['cart'][$row]['item_qty']);
							$grandTotal = 0;
							$grandTotalItems = 0;

				///////IF UPDATE QTY IS NOT SAME AS ORIGINAL QTY BUT NOT ZERO
				} elseif ($updateQty != $origQty ){
						//echo "<strong>inside if/else for qty: ELSEIF - orig not equal to update qty!!!</strong> <br/>"; //for troubleshooting
						//update the item to the NEW requested quantity FROM THE POST which is NOT ZERO
						//set variables for the new updated information coming from POST
						//we will need these to rebuild form and to do comparisons
						$updateQty = $_POST["item_qty"][$row];
						$updateProd = $_POST["prod_id"][$row];

						$updatePrice = $_POST["price"][$row];
						//echo "<h3>$updatePrice</h3>";
						//unset old quantity AND other elements ON SESSION
						unset($_SESSION['cart'][$row]['prod_id']);
						unset($_SESSION['cart'][$row]['item_qty']);

						//REST the elements to the new udpated values
						//NOTE THE PRODUCT ID COMES FIRST.  NEED this order to match the array key order in the
						//Add to cart script!
						$_SESSION['cart'][$row]['prod_id'] = $updateProd;
						$_SESSION['cart'][$row]['item_qty'] = $updateQty;
						$_SESSION['items'] = $_SESSION['items'] + $updateQty;
				} else {

				}//end if-elseif-else for updating quantities
		}//END FOR LOOP through cart items

		//sorts on first index which in this case is product id
		array_multisort($_SESSION['cart']);

};//end "array_key_exists update" elseif

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

	<section class="cont">
		<h2 >Shopping Cart</h2>
		<?php

		echo '<div class="container" id="product">';
		echo '<div class="product block row">';
		echo '<div class="prod-img col-sm-12">';

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
			}

//			if (isset ($_SESSION['cart'][0]['prod_id'])){
			?>
				<form name="displayCart" id="displayCart" method="post" action="">
					<table border="0" width="100%" cellpadding="10">
						<tr>
							<th>Product Name</th>
							<th>Color</th>
							<th>Price/Unit</th>
							<th>Qty</th>
							<th>Price/Total</th>
						</tr>
			<?php
			//loop through all the cart elements and display
			for ($row = 0; $row < $length; $row++) {
				//create variables for the product id and type id which we will need for queries
				$prod_id = $_SESSION['cart'][$row]['prod_id'];
				$color = $_SESSION['cart'][$row]['color'];
				//GET NAME OF PRODUCT
				//create SQL query to get the product name that matches the product id
				$sqlProduct = "SELECT prod_name FROM products
				WHERE prod_id = $prod_id";
				$resultProduct = $conn->query($sqlProduct) or die(mysqli_error());
				$rowProduct = $resultProduct->fetch_assoc();
				$product = $rowProduct['prod_name'];
				$resultProduct->free_result();
				//GET PRICE INFORMATION
				//variables for price info on the $_SESSION
				$color = $_SESSION['cart'][$row]['color'];

				$price = number_format($_SESSION['cart'][$row]['price'], 2, '.', ',');
				$totalPriceEach = number_format(($_SESSION['cart'][$row]['item_qty'] * $price), 2, '.', ',');

				//DISPLAY PRODUCT INFORMATION IN OUR CART DISPLAY
				//write out the information for this product/type in our table
				echo "<tr><td>" . ucwords($product) . "</td>";
				echo "<td>" . ucwords($color) . "</td>";
				//product
				echo "<input type=\"hidden\" name=\"prod_id[]\" value=\"$prod_id\">";
				echo "<input type=\"hidden\" name=\"price[]\" value=\"$price\">";
				echo "<td>" . $price . "</td>"; //price each
				echo "<td><input type=\"text\" name=\"item_qty[]\" size=\"3\" maxlength=\"3\" value=\"". $_SESSION['cart'][$row]['item_qty'] . "\" id='qty' class='qty' class='text-center'/></td>"; //quantity in editable form field
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

			};
			dbClose($conn);

		echo "<tr>";
		echo "<td></td><td></td><td>Total:</td><td>$ " . number_format($_SESSION['total_price'], 2, '.', ',') . "</td>";
		echo "</tr>";
	?>
</table>

<input name="update" id="update" type="submit" value="Update Quantity" />
<input name="goToCheckout" id="goToCheckout" type="submit" value="Checkout!" />
</form>

<a href='includes/unset_cart.php'>Empty your cart</a>
<?php }else{
	echo "There are no items in your cart!, please feel free to go <a href='products.php' title='shopping'>back shopping</a>!";
};?>

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

	$(function(){
// Accordion
$("#addToCart").accordion({
	collapsible: true,
	animated: 'easeslide' ,
	header: '.color',
	event: 'click'
});
});



</script></body>
</html>
