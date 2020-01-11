<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
//echo $_SESSION['location_id'];
//print_r($_SESSION);

include("includes/functions.php");
//print_r($_SESSION);					
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}else{



/*
order_id
member_id
LLC_name
LLC_members
purpose
date_requested
order_status
last_updated
last_update_by
notes
*/

//print_r($_POST);

	if (array_key_exists('request', $_POST)) {
   // clean the $_POST array and assign to shorter variables
     
      nukeMagicQuotes();
		//LLC_name
		//LLC_members
		//purpose
      $llc_name_list =	ucwords(trim($_POST['choice1']))." | "
      				   .ucwords(trim($_POST['choice2']))." | "
      				   .ucwords(trim($_POST['choice3']));

      $llc_member_list =ucwords(trim($_POST['member-n1']))." "
      					.ucwords(trim($_POST['member-l1']))." || "
      					.trim($_POST['member-perc-1'])." | "
      				   	.ucwords(trim($_POST['member-n2']))." "
      				   	.ucwords(trim($_POST['member-l2']))." || "
      				   	.trim($_POST['member-perc-2'])." | "
      				   	.ucwords(trim($_POST['member-n3']))." "
      				   	.ucwords(trim($_POST['member-l3']))." || "
      				   	.trim($_POST['member-perc-3']);

      $identity = [	trim($_POST['member-ssn-1']),
      				trim($_POST['member-ssn-2']),
      				trim($_POST['member-ssn-3'])];


      $purpose  = 		ucwords(trim($_POST['purpose']));
	  $notes  = 		strtolower(trim($_POST['notes']));
      
      $last_updated =	date("y-m-d G:i:s"); 

      $conn = dbConnect('query');
      $sql = "SELECT LLC_name FROM orders
          WHERE orders.LLC_name = ? LIMIT 1";
    
      $stmt = $conn->stmt_init();
      if ($stmt->prepare($sql)) {
      // bind the input parameter
      $stmt->bind_param('s', $llc_name);
      // bind the result, using a new variable for the password
      $stmt->bind_result($strduser);
      $stmt->execute();
      $stmt->fetch();
      }
      
      if (isset($strduser) && ($strduser !== '')){
        //echo '<h2>true</h2>'.$strduser;

        $error = "<span class='error'>Sorry, $llc_name  is already in use!</span><br />
                  Please try a different LLC name";
      }else{
        //echo '<h2>false</h2>';

        $conn = dbConnect('admin');
        //////////////////////////////////////////////////////////////////
        //create SQL to insert member information  -we are setting up a prepared statement
        $sql = 'INSERT INTO orders (member_id, LLC_name, LLC_members, purpose, date_requested, last_updated, last_update_by, notes)
            VALUES (?, ?, ?, ?, ?, ?, "user", ?)';
         
        echo "INSERT INTO orders (member_id, LLC_name, LLC_members, purpose, date_requested, last_updated, last_update_by, notes)
            VALUES ($member_id, $llc_name_list, $llc_member_list, $purpose, $last_updated, $last_updated, 'user' , $notes)";
            
        //initialize prepared statement
        $stmt = $conn->stmt_init();
        if ($stmt->prepare($sql)) {
          //bind parameters and execute statement
          //NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
          $stmt->bind_param('issssss', $member_id, $llc_name_list, $llc_member_list, $purpose, $last_updated, $last_updated, $notes);
          $OK = $stmt->execute(); //if statement executes, will set this flag to true
          // free the statement for the next query
          $stmt->free_result();
     
         
        	$sql_lookup = 'SELECT * FROM orders
				ORDER BY order_id DESC
				LIMIT 1 ';

			$result_lookup = $conn->query($sql_lookup) or die(mysqli_error());
			while($row_lookup = $result_lookup->fetch_assoc()){
				$order_id = $row_lookup['order_id'];	
			}

//print_r($identity);
			 foreach ($identity as $key => $value) {
			 	if ($value !== '') {
			 	
			 		$preview = substr($value, -4);
			 		$identity = md5($value);

			 		//echo "<h1>key: $key & value: $value </h1>";
			 		//echo "<h1>preview: $preview & identity: $identity </h1>";
 //prep the sql statement       
								$sql3 = 'INSERT INTO identity  (identity , preview)
								VALUES (?,?)';

echo  "

INSERT INTO identity  (identity , preview)
	VALUES ($identity ,$preview)";

								//initialize statement       
								$stmt = $conn->stmt_init();
		
								if ($stmt->prepare($sql3)) {
								//bind the perameters
								$stmt->bind_param('ss', $identity, $preview);
								$OK = $stmt->execute();
								}
								
								$sql4 = 'SELECT identity_id 
										FROM identity
										ORDER BY identity_id DESC
										LIMIT 1';
										
								$result4 = $conn->query($sql4) or die(mysqli_error());
								while($row4 = $result4->fetch_assoc()){
													$identity_id = $row4['identity_id'];	
								}
					
					
					//echo "<h1>order id: $order_id </h1> ";
					//echo "<h1>identity: $identity_id </h1> ";
								$sql5 = 'INSERT INTO order_identity_lookup (order_id, identity_id)
										VALUES (?,?)';
								
								//initialize statement       
								$stmt = $conn->stmt_init();
					
								if ($stmt->prepare($sql5)) {
								//bind the perameters
								$stmt->bind_param('ii', $order_id, $identity_id);
								$OK = $stmt->execute();
								}
			 	}
			 }


		$email = $email;
        $subject = "Your request for an Arrow of Victory LLC is being processed!";
		$msg = "
		<html>
		<body>
		<table align='center' width='600' style='font-family:Myriad Pro, Helvetica, Arial; color:#F00;border:thin #ccc solid' bordercolor='#ccc' cellpadding='0' cellspacing='10'>
		<tr>
		<td colpan='2' align='center'><img src='http://www.arrowofvictory.com/images/header.jpg' title='Header' width='600'/></td>
		</tr>
		<tr>
		<td align='center' colpan='2' style='border-bottom:thin #ccc solid'><br/><h2>Your request for an Arrow of Victory LLC is being processed!</h2></td>
		</tr>
		<tr>
		<td style='color:#333'>
						Please allow  up to 3 business days while we process your request. Thank you!. Thanks</td>
		</tr>

		</table>  
		</body>
		</html>";


          $AdminMsg = "
          <html>
            <body>
              <table align='center' width='600' style='font-family:Myriad Pro, Helvetica, Arial; color:#F00;border:thin #ccc solid' bordercolor='#ccc' cellpadding='0' cellspacing='10'>
                <tr><td colspan='2' align='center'><img src='http://www.arrowofvictory.com/images/header.jpg' title='Header' width='600'/></td></tr>
                <tr><td align='center' colspan='2' style='border-bottom:thin #ccc solid; color:#777;'><br/><h2>
                A user created a new LLC request</h2></td></tr>
                <tr><td style='color:#333'>
                There is a new LLC request, please log into your <a href='https://www.arrowofvictory.com/admin/'>admin panel</a> to review it.
                <br/></td></tr>
              </table>  
            </body>
          </html>";


      //echo $msg;
        

      $headers =  'From: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
                  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                  'MIME-Version: 1.0' . "\r\n" .
                  'Reply-To: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
      // send it
      $mailSent = mail($email, $subject, $msg, $headers);
      $adminMailSent = mail("arrowofvictory@arrowofvictory.com", "You have a new LLC request!", $AdminMsg, $headers);
      $adminMailSent = mail("marco@revlovellc.com", "A new account has been created", $AdminMsg, $headers);
    
     //$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      $emailSent = true;
          //echo "<h1>$member_id</h1>";
          //Take us to 'my account'
          header("Location: thankyou.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
        
      
        }
        
      }
    }

}

?>




<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->

<style type="text/css">
	.main {display: none;}
</style>
<body>

<section class="addnew" >
	<div class="row">
		<div class="container">
			<div class="">
				<button class="add offset-sm-2 col-sm-8">REQUEST A NEW WYOMING LLC</button>
			</div>

			<div class="addnewform">
				<div class="row main">
			        <div class="main-login main-center col-sm-12 col-md-10 offset-md-1">
			          <form action="" method="post" name="register" id="register">
			         <?php 

/*
LLC_members
purpose
date_requested
order_status
last_updated
last_update_by
notes
*/
			         ?>   
			            <div class="form-group">
			              <label for="LLC_names" class="col-sm-12 control-label">
			          		<?php if(isset($error)){
			          			echo $error.'<br />';
			              		//echo md5($password).'<br />';
			              		//echo $savedPwd;
			              		}else{
			                	echo "Please provide 3 choices of LLC Names in order of preference. If your first choice is unavailable we will use the next option.";
			              	}
			        ?>
			              </label>
			              <div class="col-sm-12">
			                <div class="input-group">
			                  <input type="text" class="form-control" name="choice1" id="choice1"  placeholder="1. Top Choice" required="required" value="<?php prefill('choice1'); ?>" />
			                </div>
			                <div class="input-group">
			                  <input type="text" class="form-control" name="choice2" id="choice2"  placeholder="2. Second  Choice" value="<?php prefill('choice12'); ?>" />
			                </div>
			                <div class="input-group">
			                  <input type="text" class="form-control" name="choice3" id="choice3"  placeholder="3. Last Choice" value="<?php prefill('choice3'); ?>" />
			                </div>
			              </div>
			            </div>


			            <div class="form-group">
			              <label for="lname" class="col-sm-12 control-label">List the Members and their ownership percentage (if more than 3 are needed, please specify in comments below. </label>

				          	<!--Member 1-->

			            	<div class="form-group row member">
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-n1" id="member-n1"  placeholder="1. Member First Name" required="required" value="<?php prefill('member-n1'); ?>" />
				              	</div>
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-l1" id="member-l1"  placeholder="1. Member Last Name" required="required" value="<?php prefill('member-l1'); ?>" />
				              	</div>
				          		<div class="col-sm-2">
			                		<input type="text" class="form-control" name="member-perc-1" id="member-perc-1"  placeholder="%" required="required" value="<?php prefill('member-1'); ?>" />
			                	</div>
			                	<label class="col-sm-12">Social Security*</label>
			              		<div class="col-sm-12">
			                  		<input type="text" class="form-control" name="member-ssn-1" id="member-1"  placeholder="###-##-####" required="required" value="<?php prefill('member-ssn-1'); ?>" />
				              	</div>
				          	</div>

				          	<!--Member 2-->
				          	
			            	<div class="form-group row member">
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-n2" id="member-n2"  placeholder="2. Member First Name" value="<?php prefill('member-n2'); ?>" />
				              	</div>
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-l2" id="member-l2"  placeholder="2. Member Last Name" value="<?php prefill('member-l2'); ?>" />
				              	</div>
				          		<div class="col-sm-2">
			                		<input type="text" class="form-control" name="member-perc-2" id="member-perc-2"  placeholder="%"  value="<?php prefill('member-2'); ?>" />
			                	</div>
			                	<label class="col-sm-12">Social Security*</label>
			              		<div class="col-sm-12">
			                  		<input type="text" class="form-control" name="member-ssn-2" id="member-2"  placeholder="###-##-####"  value="<?php prefill('member-ssn-2'); ?>" />
				              	</div>
				          	</div>

				          	<!--Member 3-->
				          	
			            	<div class="form-group row member">
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-n3" id="member-n3"  placeholder="3. Member First Name" value="<?php prefill('member-n3'); ?>" />
				              	</div>
			              		<div class="col-sm-5">
			                  		<input type="text" class="form-control" name="member-l3" id="member-l3"  placeholder="3. Member Last Name" value="<?php prefill('member-l3'); ?>" />
				              	</div>
				          		<div class="col-sm-2">
			                		<input type="text" class="form-control" name="member-perc-3" id="member-perc-3"  placeholder="%"  value="<?php prefill('member-3'); ?>" />
			                	</div>
			                	<label class="col-sm-12">Social Security*</label>
			              		<div class="col-sm-12">
			                  		<input type="text" class="form-control" name="member-ssn-3" id="member-3"  placeholder="###-##-####"  value="<?php prefill('member-ssn-3'); ?>" />
				              	</div>
				          	</div>

			              </div>


			            <div class="form-group">
			              <label for="purpose" class="col-sm-12 control-label">What is this LLC for?</label>
			              <div class="col-sm-12">
			                <div class="input-group">
			                	<select type="text" list="purpose" name="purpose" id="purpose" placeholder="Select from Dropdown">
			                        <option value="New business">Starting a new business</option>
			                        <option value="Direct Sales">Direct Sales</option>
			                        <option value="Transportation">Transportation</option>
			                        <option value="Housing">Housing</option>
			                        <option value="Subsidiary Entity">Subsidiary Entity</option>
			                        <option value="Investment">Investment</option>
			                        <option value="Other">Other - Add in the comments</option>
			                    </select>
			                </div>
			              </div>
			            </div>
			            <div class="form-group">
			              <label for="purpose" class="col-sm-12 control-label">Additional Comments</label>
			              <div class="col-sm-12">
			                <div class="input-group">
<textarea maxlength="300" name="notes" id="notes" placeholder='Additional notes like: "this a foreign entity" or "I need additional members"'>
</textarea>
			                </div>
			              </div>
			            </div>

			            <div class="form-group ">
			              <p><input id="request" type="submit" name="request" value="Complete Registration" /></p>

			            </div>
			            
			          </form>
			        </div>
			      </div>

			</div>

		</div>
	</div>

<main class="l-main">
	<div class="container">

        <div class="row">	
			<?php
				$conn = dbConnect('query');
				$orderSqlad = "SELECT * FROM orders WHERE member_id = $member_id ORDER BY order_id DESC";
				
				$order_res = $conn->query($orderSqlad) or die(mysqli_error());
            
				$numRows = $order_res->num_rows;
                //echo $numRows;
                if($numRows == '0'){
                	echo "<div class='requested-item col-sm-12 col-md-10 offset-md-1 text-center'>
					        <div class='row'>
					        	<p>
					        	Do you wish to form an LLC? Click the \"Request a New Wyoming LLC
					        	\" button above to get started.
					        	</p>
					       	</div>
					    </div>";
                }else{

                echo "<h3>Request <strong>History</strong></h3>";
				
				while ($numRows = $order_res->fetch_assoc()) {
					$order_id = $numRows['order_id'];
					echo "<div class='requested-item col-sm-12 col-md-6'>
					        <div class='row'>";
									if ($numRows['order_status'] == 'approved') {
										echo "<div class='btn btn-success col-md-12 text-center status'>
												<i class='fa fa-check-square'></i>
												APPROVED
											</div>";
									}elseif ($numRows['order_status'] == 'denied') {
										echo "<div class='btn btn-warning col-md-12 text-center status'>	<i class='fa fa-clock-o'></i>
												CANCELED
												</div>";
									}else{
										echo "<div class='btn btn-warning col-md-12 text-center status'>	<i class='fa fa-clock-o'></i>
												PROCESSING
												</div>";
									}
							echo "</div>
							<hr/>
							<div class='row'>
								<h4 class=''>Requested Names</h4>";
								
								$llc_name_array = explode(" | ", $numRows['LLC_name']);
								
								foreach ($llc_name_array as $key => $value) {
									echo "<p class='-text'>".$value."</p>";
								}
								
							echo "</div>
							<hr/>
					        <div class='row'>
					     		<h4 class=''>Members:</h4>";

										$llc_members_array = explode(" | ", $numRows['LLC_members']);
										
										foreach ($llc_members_array as $key => $value) {
											echo "<p class='-text'>".$value."% </p>";
										}
								echo "
							</div>
							<hr/>
					        <div class='row'>
					     		<h4 class=''>Date Requested:</h4>
					     		<p>".$numRows['date_requested']."</p>
					        </div> 
							</div>";}
							};
						?>

    </div>
    
  </div>
</main>
</section>


<?php include('includes/footer.php'); ?>


</body>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
	$('button.add').click(function(){
		$('.main').slideToggle();
		}
	);
	
</script>
</html>