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

<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->
<body>




<main class="l-main">
	<div class="container">
                    <h3>Welcome to your <strong> Control Panel</strong></h3>

        <div class="row">	
			
			<div class="requested-item col-sm-12 col-md-10 offset-md-1 ">
			<h3>Order History</h3>
			<p>
				<table id="order_hist" cellpadding="12">
				<tr>
					<td>Order ID</td><td>DATE REQUESTED</td><td>LAST UPDATED</td><td>STATUS</td><td>LAST UPDATE BY</td></tr>
				</tr>
			
			
			<?php

/*
order_id
date_requested
order_status
last_updated
last_update_by
*/
		$conn = dbConnect('query');
		$orderSqlad = "SELECT * FROM orders ORDER BY order_status DESC";
		
		  $order_res = $conn->query($orderSqlad) or die(mysqli_error());
    
				$numRows = $order_res->num_rows;
        
					while ($numRows = $order_res->fetch_assoc()) {
						$order_id = $numRows['order_id'];
						echo "<tr>
						<td><a href='order_details.php?order_id=$order_id'>".$numRows['order_id']."</a></td>
						<td><a href='order_details.php?order_id=$order_id'>".$numRows['date_requested']."</a></td>
						<td><a href='order_details.php?order_id=$order_id'>".$numRows['last_updated']."</a></td>";
						if ($numRows['order_status'] == 'approved') {
							echo "<td><a href='order_details?order_id=$order_id'>APPROVED</a></td>";
//													if(isset($numRows['po_num'])){echo '<td>'.$numRows['po_num'].'</td>';}
						}elseif ($numRows['order_status'] == 'cancelled') {
						
							echo "<td><a href='order_details?order_id=$order_id'>CANCELLED</a></td>";
						}else{

							echo "<td><a href='order_details?order_id=$order_id'>PROCESSING</a></td>";
							
						}

						echo "<td><a href='order_details.php?order_id=$order_id'>".$numRows['last_update_by']."</a></td>";
						echo "</tr>";
										
						}
	
			?>
		</table>
		
		
			</div>
    </div>
    
  </div>
</main>


</body>
</html>