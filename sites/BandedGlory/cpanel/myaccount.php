<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
//echo $_SESSION['location_id'];
include("../includes/functions.php");
//print_r($_SESSION);
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../styles/reset.css" />
<link rel="stylesheet" href="../styles/styles.css" />

<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.10.custom.min.js"></script>

<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('../includes/cpanelsidenav.php');?>
	  <!--END OF SIDEBAR-->
	<div class="cont" id="cpanel">


           <div id="lef-cont">
                    <h2>Welcome <?php echo $firstname;?></h2>

			</div>

    <div id="right-cont">
 	<h3>Order History</h3>
		<p>
				<table id="order_hist">
			<tr>
				<td>Order ID</td><td>AMOUNT</td><td>DATE</td><td>STATUS</td></tr>
			</tr>


			<?php
				$conn = dbConnect('query');
				$orderSqlad = "SELECT * FROM orders WHERE customer_id = $customer_id ORDER BY order_id DESC";

				  $order_res = $conn->query($orderSqlad) or die(mysqli_error());

						$numRows = $order_res->num_rows;

							while ($numRows = $order_res->fetch_assoc()) {
								$order_id = $numRows['order_id'];
									echo "<tr>
									<td><a href='order_details.php?order_id=$order_id'>".$numRows['order_id']."</a></td>
								<td><a href='order_details.php?order_id=$order_id'>".$numRows['amount']."</a></td>
								<a href='order_details.php?order_id=$order_id'><td>".$numRows['date']."</a></td>";
														if ($numRows['order_status'] == 'y') {
															echo "<td><a href='order_details?order_id=$order_id'>APPROVED</a></td>";
														}else{
															echo "<td><a href='order_details?order_id=$order_id'>ON HOLD</a><td />";
														}
								echo "</tr>";

								}

			?>
		</table>
            </div>


		</div><!--END OF CONT-->
	</div><!--END OF CONT-->

		<?php
		    if (isset($_SESSION['cart'])) {
			    include('../includes/cpaneldisplayCart.php');
		    }

		 ?>

	    <?php include('../includes/cpanelnavBar.php');?>
	</div><!--END OF CONTENT-->

	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('../includes/cpanelfooter.php');?>
</body>
</html>
