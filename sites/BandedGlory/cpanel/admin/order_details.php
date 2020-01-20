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
    $approved = 1;
    
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders
            SET approved = ?, po_num = ?, note = ?
            WHERE order_id = ?";
var_dump($approved);				
		                //initialize prepared statement
		                $stmt = $conn->stmt_init();
		                $stmt->prepare($sql);
			                //bind parameters and execute statement
			                $stmt->bind_param('issi', $approved, $po, $note, $_POST['order_id']);
			                $done = $stmt->execute();
			                // free the statement for the next query
			                $stmt->free_result();

                $msg = "Order # $order_id has been approved, go to <a href='http://www.designpros-inc.com/sarecycling/admin' > your SA Control Panel</a> review the order";
                
                $to = "mike@designpros-inc.com";
                $subject = "SA - an order has been placed";
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	// send i