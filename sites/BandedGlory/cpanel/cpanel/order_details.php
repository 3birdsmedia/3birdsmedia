<?php
session_start();
ob_start();
include('../includes/functions.php');
if (array_key_exists('approve', $_POST)) {
    if(isset($_POST['note'])){
        $note = $_POST['note'];
    }else{
        $note = 'No comment';
    }
    if (isset($_POST['po_num'])){ $po = $_POST['po_num'];}else{$po = "Non-PO";}

    $conn = dbConnect('admin');
    $order_status = 1;

    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders
            SET order_status = ?, po_num = ?, note = ?
            WHERE order_id = ?";
var_dump($order_status);
		                //initialize prepared statement
		                $stmt = $conn->stmt_init();
		                $stmt->prepare($sql);
			                //bind parameters and execute statement
			                $stmt->bind_param('issi', $order_status, $po, $note, $_POST['order_id']);
			                $done = $stmt->execute();
			                // free the statement for the next query
			                $stmt->free_result();

                $msg = "Order # $order_id has been approved, go to your Control Panel review the order";

                $to = "mike@designpros-inc.com";
                $subject = "SA - an order has been placed";
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	// send it
	$mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
	$emailSent = true;

                $to = "susanne@designprosinc.com";
                $subject = "SA - an order has been placed";
	// send it
	$mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
	$emailSent = true;

                $to = "HSmart@sarecycling.com";
                $subject = "SA - an order has been placed";
	// send it
	$mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
	$emailSent = true;

                $to = "marco.segura@live.com";
                $subject = "SA - an order has been placed";
                // send it
	$mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
	$emailSent = true;


}elseif(array_key_exists('deny', $_POST)) {
    if(isset($_POST['note'])){
        $note = $_POST['note'];
    }else{
        $note = 'No comment';
    }

    $conn = dbConnect('admin');
    $order_status = 0;
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders
					SET order_status = ?, po_num = ?, note = ?
					WHERE order_id = ?";
var_dump($order_status);
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql);
					//bind parameters and execute statement
					$stmt->bind_param('issi', $order_status, $po, $note, $_POST['order_id']);
					$done = $stmt->execute();
					// free the statement for the next query
					$stmt->free_result();


}else{
//check for the prod_id on the query string
	if ( !isset($_GET['order_id']) && !is_numeric($_GET['order_id']) ) {
        $order_id = 0;
            $msg = "<h2>There seems to be a problem</h2> please <a href='prod_list.php'>CLICK HERE</a> and try again.";


        }elseif($_GET['order_id'] == '') {
               $order_id = 0;
            $msg = "<h2>There seems to be a problem</h2> please <a href='prod_list.php'>CLICK HERE</a> and try again.";
        } else {
	    //set the variable so it's easier to use later in script
		$order_id = $_GET['order_id']; //for troubleshooting
		//echo "order_id is $order_id <br>";
	   //connect to the datase
		$conn = dbConnect('query');

            //Now we make a query request to store the product if it was requested
	    $sql = "SELECT *
					    FROM orders
					    LEFT JOIN order_items
					    ON orders.order_id = order_items.order_id
					    WHERE orders.order_id = '$order_id'";
            //submit the SQL query to the database and get the result
            $result4 = $conn->query($sql) or die(mysqli_error());

        //loop through the result to get the id, product and description
        while ($row2 = $result4->fetch_assoc()) {

      /*
            //getting the brand and image
	    $prod_name =	$row2['prod_name'];
	    $prod_number =	$row2['prod_number'];
	    $prod_desc =	$row2['prod_desc'];
	    $min_qty =		$row2['min_qty'];
	    $price =		$row2['price'];
	    $price_per =	$row2['price_per'];
	    $custom =		$row2['custom'];
	    $img_url =		$row2['img_url'];
            //$invLenght = if count($row['inventory']);
            //echo $invLenght;
      */


        //Begin of While 2

	//create array for the colors
                }
            }
}
//echo $custom;
//print_r($_POST);

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
<script type="text/javascript" language="javascript">
$(document).ready(function() {

	  $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
	  $(".stripeMe tr:even").addClass("alt");

});
</script>
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


		<p><a href="myaccount.php">Go back to the previous page</a></p>

	    	<form action="" method="post">

			<table id="order_hist">
			<tr>
				<td>Order ID</td><td>AMOUNT</td><td>DATE</td><td>STATUS</td><td>CONFIRMATION #</td>
			</tr>
		<?php
		 $conn = dbConnect('query');

		           $orderSql = "SELECT * FROM orders WHERE order_id = $order_id ORDER BY order_id ASC LIMIT 30";

		             $order_res = $conn->query($orderSql) or die(mysqli_error());

			        $numRows = $order_res->num_rows;

				        while ($numRows = $order_res->fetch_assoc()) {

					        $order_id = $numRows['order_id'];

					        echo "<tr>
						        <td>".$numRows['order_id']."</td><td> $".$numRows['amount']."</td><td>".$numRows['date']."</td>";

					        if ($numRows['order_status'] == 1) {echo "<td>APPROVED</td>";
					        }else{
					            echo "<td>ON HOLD</td>";
					        }

					        echo '	<td>'.createConfirm($order_id).'</td>';
					        echo "</tr>
					        </table>";


					        $itemSql = "SELECT * FROM products
					        LEFT JOIN order_items
					        ON order_items.prod_id = products.prod_id
					        WHERE order_items.order_id = $order_id ORDER BY order_id DESC";

					        $items_res = $conn->query($itemSql) or die(mysqli_error());

					        $numRows1 = $items_res->num_rows;
//print_r ($numRows1);
					        echo '<table id="order_hist">
					            <tr><td>Product Name</td><td>Product Name</td><td>Price</td><td>Quantity</td><td>Item Total</td></tr>';
					        while ($numRows1 = $items_res->fetch_assoc()) {
					        $item_total = $numRows1['price'] * $numRows1['quantity'];
					            echo '<tr><td>'.$numRows1['prod_number'].'</td><td>'.$numRows1['prod_name'].'</td><td> $'.$numRows1['price'].'</td><td>'.$numRows1['quantity'].'</td><td>$'.$item_total.'</td></tr>';

					       // $info_msg = $numRows['msg'];

					        }
					        echo '</table>';
					        //echo $info_msg;
				        echo "<input type='hidden' value='$order_id' name='order_id' />";
				        }

	           ?>

		</form>
			</table>
		</div><!--END OF CONT-->
	</div><!--END OF CONT-->

		<?php
		    if (isset($_SESSION['cart'])) {
			    include('../includes/displayCart.php');
		    }

		 ?>

	    <?php include('../includes/cpanelnavBar.php');?>
	</div><!--END OF CONTENT-->

	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('../includes/cpanelfooter.php');?>

<script type="text/javascript" src="js/jquery.validate.js">
<script type="text/javascript" >
		 $('#myForm')
    .validate({
        rules :
            myDate : {
                australianDate : true
            }
    })
;
		 $.validator.addMethod(
    "australianDate",
    function(value, element) {
        // put your own logic here, this is just a (crappy) example
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    },
    "Please enter a date in the format dd/mm/yyyy"
);
</script>

</body>
</html>
