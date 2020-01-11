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
}
?>

<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->

<style type="text/css">
	.main {display: none;}
</style>
<body>

<section class="addnew" >

<main class="l-main">
	<div class="container text-center">
		<div class="row">	
			<div class="requested-item col-sm-12 col-md-10 offset-md-1">
				<div class="row text-center">
					<h1 class="col-sm-12">
					Your request is being processed! 
					</h1>
						<br/>
					<p>
						Check back for updates in 3 business days. Thank you!
					</p>
				</div>

				<div class="services row">
					<p>
					Keep it in the family, click below if you need any of these services. 
					</p>
						<div class="col-sm-12 col-md-3">
							<a href="http://revlovellc.com/" target="_blank">
								<img src="images/thankyou-revlove.jpg" alt="Do you need tax and payroll services for your company?" class="img-circle img-responsive">
							</a>
						</div>
						<div class="col-sm-12 col-md-3">
							<a href="http://bethelteam.com/" target="_blank">
								<img src="images/thankyou-bethel.jpg" alt="Do you need strategy consulting services for your company?" class="img-circle img-responsive">
							</a>
						</div>
						<div class="col-sm-12 col-md-3">
							<a href="http://stewardship-llc.com/" target="_blank">
								<img src="images/thankyou-stewardship.jpg" alt="Do you need legal services for your company?" class="img-circle img-responsive">
							</a>
						</div>
						<div class="col-sm-12 col-md-3">
							<a href="http://firmfoundation-llc.com/" target="_blank">
								<img src="images/thankyou-firmfoundation.jpg" alt="Do you need fincancial backing for your company?" class="img-circle img-responsive">
							</a>
						</div>
				</div>

				<div class="row">
					<a class='btn add offset-sm-4 col-sm-4' href='myaccount.php'>Return to myAOV</a>
				</div>
			</div>
		</div>
	</div>
</main>



</section>

<div class="footer">
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