<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
include("../includes/functions.php");

if (!isset($_SESSION['adminloggedin'])) {
	header('Location: ../index.php');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta name="generator" content="InstantBlueprint.com - Create a web project framework in seconds." />
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>SA RECYCLING Control Panel</title>
 <meta name="description" content="Add your sites description here" />
 <meta name="keywords" content="Add,your,site,keywords,here" />
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
  <script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">
   
	   <!-- Start: container -->
	      <div id="container">
	   
	   
		 <!-- Start: header -->
		      <div id="header">
			     <a href="index.php"><h1><span>SA Recycling</span></h1></a>
		     </div><!-- End: header -->	  	   
		 
	   <!-- Start: content -->
	   <div id="content">
           <div id="lef-cont">
                    <h2>Welcome to your Control Panel</h2>
                        <p>Here you can add, delete or update any product or category.</p>
                        <p>What do you wanna do?</p>
	</div>
    
    <div id="right-cont">
    					<h3>Products</h3>
									<p><a href="prod_list.php">Take a look at the products you have</a></p>
									<p><a href="prod_input.php">Add a new product</a></p>
									
						<h3>Categories</h3>
									<p><a href="cat_list.php">List the your categories</a></p>
									<p><a href="cat_add.php">Add a new category</a></p>
									
                     <h3>Order History</h3>
		<p>
		<table id="order_hist">
			<tr>
				<td>Order ID</td><td>AMOUNT</td><td>DATE</td><td>STATUS</td><td>PO#</td></tr>
			</tr>
			
			
			<?php
				$conn = dbConnect('query');
				$orderSqlad = "SELECT * FROM orders ORDER BY order_id DESC";
				
				  $order_res = $conn->query($orderSqlad) or die(mysqli_error());
            
						$numRows = $order_res->num_rows;
                
							while ($numRows = $order_res->fetch_assoc()) {
								$order_id = $numRows['order_id'];
									echo "<tr>
									<td><a href='order_details.php?order_id=$order_id'>".$numRows['order_id']."</a></td>
								<td><a href='order_details.php?order_id=$order_id'>".$numRows['amount']."</a></td>
								<a href='order_details.php?order_id=$order_id'><td>".$numRows['date']."</a></td>";
														if ($numRows['order_status'] == 'Y') {
															echo "<td><a href='order_details?order_id=$order_id'>APPROVED</a></td>";
															if(isset($numRows['po_num'])){echo '<td>'.$numRows['po_num'].'</td>';}else{}
														}else{
															echo "<td><a href='order_details?order_id=$order_id'>ON HOLD</a><td />";
														}
								echo "</tr>";
												
								}
			
			?>
		</table>
		
		
	</div>
	</div><!-- End: content -->
	   <!-- Start: navigation -->


	      <div id="push"></div><!-- End: push -->
	      </div><!-- End: container -->

</div><!-- End: Center Wrap -->
	   
	   <!-- Start: footer -->
		 <div id="footer">
		 </div><!-- End: footer -->
</body>
</html