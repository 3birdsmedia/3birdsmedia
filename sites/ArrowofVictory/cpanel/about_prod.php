<?php
session_start();
ob_start();
include('includes/functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />


<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>

<title>DigiPrint Products Corp. <?php echo "&#8212; {$title}"; ?></title>
</head>

<body>

<div class='wrapper'>

  <div class='center_wrapper'>
        <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>DigiPrint Products Corp.</h1></a></div>
    </div>
	<div class="content">
	    <div id="sideNav">
		<?php include('includes/sidenav.php');?>
	    <!--END OF SID EBAR-->
	    
	    <div class="cont" id="about">
			<h2>ABOUT DigiPrint PRODUCTS</h2>
    
	<p>DigiPrint Products Corporation was created for two main purposes.</p>
		<ol>
        	<li>For all the digital print shops out there to expand there capabilities and revenue sources and to diversify themselves and remain successful.</li>
			<li>For all those start up and established small, med, large, home businesses to have access to custom marketing products that will enhance the look and feel of there product(s) or business. Low Cost, High Quality!</li>
	
    	</ol>
        
     <p>
     The owner(s) of DigiPrint Products Corporation have been in the printing industry for over 15 years, owners of Design Pros, Inc. a Design and Printing company, and know what people are asking for today. The consumer wants to have the look and feel that is bigger than their budget and designing and printing custom die cut marketing pieces is not part of that budget. The cost to do a custom die cut Box, CD mailer or Door hangar is expensive if you just need a small amount. That is why we at DigiPrint created and have a patent pending on custom designed pre-die cut products that allow everyone the choice of how many they want to print and distribute at a fraction of the cost.
     </p>

	<p>
    DigiPrint Products Corporation will continue to design and introduce new and innovative ideas for all who need and want to enhance the quality of there business.
    </p>
    
	<p>
  DigiPrint Products: Self assemble custom packaging for multiple types of products and marketing purposes. The Print, Punch and Assemble method allows you to have a final professional product without the use of any glue.   </p>
	
    <p>
 The general public wants to have customized items with their image or logo on them but the cost is way too high and the quantity requirement is way over what the general consumer needs. Which means they are paying for extra products they don't need and won't use. The time and money to produce custom packaging prevents people from starting that new business or promoting themselves.   </p>
	
    <p>
    The DigiPrint product is Easy To Assemble, Affordable and is an On Demand Printed Product.
    </p><br />
 
 <h2>Suggested uses of our products:</h2>
 
 <ul>
 	<li>Retail Package</li>
    <li>Gift Box</li>
    <li>Business Gift</li>
	<li>Promotional Item</li>
    <li>Weddings</li>
    <li>Birthdays</li>
    <li>Baby Showers</li>
    <li>Dry Foods</li>
    <li>Candles</li>
    <li>Jewelry</li>
    <li>Tradeshow Giveaways</li>
    <li>Gift Cards</li>
    <li>And Much, Much More, the possibilities are endless!</li>
  </ul>
  <br/>
  <br/>

<h2>How our products work: </h2>

<ol>
<li>Take pre-diecut blank sheets and load into a commercial digital printer/press.</li>
<li>Print custom artwork onto the blank sheets.</li>
<li>Punch out the product from the now printed sheets.</li>
<li>Fold (on the pre-scored lines)</li>
<li>Snap together using the die-cut tabs or the locking mechanisms that go into the provide slots on each product.</li>
<li>Hand out or sell your final custom product to the world! </li>
</ol>


    
    </div><!--END OF CONT-->
</div><!--END OF CONT-->   
		
		
		<?php
		    if (isset($_SESSION['cart'])) {
			    include('includes/displayCart.php');
		    }
	    
		 ?>

	    <?php include('includes/navBar.php');?>
	</div><!--END OF CONTENT-->
	
	<div class="push"></div>
  </div><!--end of center_wrapper-->
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>