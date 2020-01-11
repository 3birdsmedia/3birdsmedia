<?php
session_start();
ob_start();
include('../includes/functions.php');
if (array_key_exists('approve', $_POST)) {
    if(isset($_POST['note'])){
        $note = "\n ---".date("y-m-d G:i:s")."--- \n ".$_POST['note']."\n ------ \n";     
    }else{
        $note = "\n  ---".date("y-m-d G:i:s")."--- \n No comment \n ------ \n";
    } 
     
    $conn = dbConnect('admin');
    $approved = "approved";
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders
					SET order_status = ?, notes = concat(notes,?)
            WHERE order_id = ?";
//var_dump($approved);				
		                //initialize prepared statement
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	//bind parameters and execute statement
	$stmt->bind_param('sss', $approved, $note, $order_id);
	$done = $stmt->execute();
	// free the statement for the next query
	$stmt->free_result();

	$msg = " Your LLC Reqeust has been approved, go to <a href='https://www.arrowofvictory.com/cpanel/myaccount.php' > your myAOV</a> to review the order";

	$to = "arrowofvictory@arrowofvictory.com";
	$subject = "Your LLC request has been approved";
  $headers =  'From: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
              'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
              'MIME-Version: 1.0' . "\r\n" .
              'Reply-To: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();
	// send it
	$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
	$emailSent = true;
	
    $to = "marco@revlovellc.com";
    $subject = "Your LLC request has been approved";
    // send it
	$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
	$emailSent = true;

    
}elseif(array_key_exists('deny', $_POST)) {
    if(isset($_POST['note'])){
        $note = "\n ---".date("y-m-d G:i:s")."--- \n ".$_POST['note']."\n ------ \n";     
    }else{
        $note = "\n  ---".date("y-m-d G:i:s")."--- \n No comment \n ------ \n";
    }    
        
    $conn = dbConnect('admin');
    $approved = 'cancelled';
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders
					SET order_status = ?, notes = concat(notes,?)
					WHERE order_id = ?";
var_dump($approved);				
				//initialize prepared statement
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql);
					//bind parameters and execute statement
					$stmt->bind_param('sss', $approved, $note, $order_id);
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


<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->
<body>

<!-- Start: Center Wrap -->


<main class="l-main">
	<div class="container">
		
		<h3>LLC REQUEST <strong>DETAILS</strong></h3>

        <div class="row">	
			
			<div class="requested-item col-sm-12 col-md-10 offset-md-1 ">
	    	<form action="" method="post">
			<label>Enter an EIN to approve</label>
		 	<input type="text" name="po_num" id="PO" size="20" />
		 	<input type="submit" name="approve" id="approve" value="Approve" class="btn-approve" />
		    <input type="submit" name="deny" id="deny" value="Deny"  class="btn-deny" />
	        <label>LLC Names</label>
	        <label>Note:</label><textarea name="note" id="note" class=""></textarea>		    

			<div id="order_hist">
			<div class='row'>
				<span class="">Order ID</span><span>LLC NAMES</span><span>LLC MEMBERS</span><span>STATUS</span>
			</div>
		<?php
		 $conn = dbConnect('query');
	           $orderSql = "SELECT * FROM orders WHERE order_id = $order_id ORDER BY order_id ASC LIMIT 30";
		           
		             $order_res = $conn->query($orderSql) or die(mysqli_error());

			        $numRows = $order_res->num_rows;

				        while ($numRows = $order_res->fetch_assoc()) {
										            
					        $order_id = $numRows['order_id'];
					        
					        echo "
						        <div class='row'>
						        <span>".$numRows['order_id']."</span>
						        
						        <span>
						        <textarea>";
									$llc_name_array = explode(" | ", $numRows['LLC_name']);
								
								foreach ($llc_name_array as $key => $value) {
									echo $value."\n";
								}


						        echo "</textarea>
						        </span>

						        <span>";

								$llc_members_array = explode(" | ", $numRows['LLC_members']);
								
								foreach ($llc_members_array as $key => $value) {
									echo str_replace("||", "|", $value."%<br />");
								}						        

						        echo "</span>";
					        
					        if ($numRows['order_status'] == 'approved') {
							echo "<span><a href='order_details.php?order_id=$order_id'>APPROVED</a></span>";
//													if(isset($numRows['po_num'])){echo '<span>'.$numRows['po_num'].'</span>';}
							}elseif ($numRows['order_status'] == 'cancelled') {
							
								echo "<span><a href='order_details.php?order_id=$order_id'>CANCELLED</a></span>";
							}else{

								echo "<span><a href='order_details.php?order_id=$order_id'>PROCESSING</a></span>";
								
							}
									        
					        echo "	
							        </div>
							        <div class='row'>
							       		<span>CONFIRMATION </span><span>".createConfirm($order_id)."</span>
					        		</div>";
					        echo "	</div>
					        			<span>NOTES</span><span>".nl2br($numRows['notes'])."</span>
					        		</div>";
					        echo "</div>
					        ";
					        
					       		        echo "<input type='hidden' value='$order_id' name='order_id' />";
				        ?>
				        <div class='row'>
				        	<span>DATE REQUESTED</span><span><?php echo $numRows['date_requested']; ?></span>
				        </div>
				        <div class='row'>
				        	<span>LAST UPDATED</span><span><?php echo $numRows['last_updated']; ?></span>
				        </div>
	        		</div>
					<input type='hidden' value="<?php echo $order_id; ?>" name='order_id' />";
		        <?php
			    }
	           ?>
		</form>	
	    </div><!--END OF CONT-->
</main>

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