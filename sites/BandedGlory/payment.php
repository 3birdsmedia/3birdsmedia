<?php
session_start();
ob_start();
//print_r($_SESSION);
include('includes/functions.php');
include("fdgg-util_sha2.php");


//print_r($_SESSION);
if($_SESSION['payment']['state'] == 'CA' ) {

	$price = $_SESSION['new_total_price'];
	$tax = 0.0775;

	//echo $price.'<br/>';
	//echo $tax.'<br />';

	$totalprice = $price + ($price * $tax);
	$totalprice = number_format($totalprice, 2, '.', '');
	//echo 'Total: '.$totalprice;
}else{

	$price = $_SESSION['new_total_price'];
	$tax = 0;

	//echo $price.'<br/>';
	//echo $tax.'<br />';

	$totalprice = $price;
	$totalprice = number_format($totalprice, 2, '.', '');
	//echo 'Total: '.$totalprice;

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="Self assemble custom packaging for multiple types of products and marketing purposes. The Print, Punch and Assemble method allows you to have a final professional product without the use of any glue. " />
<meta name="keywords" content="Retail Package, Gift Box, Business Gift, Promotional Item, Weddings, Birthdays, Baby Showers, Dry Foods, Candles, Jewelry, Tradeshow Giveaways, Gift Cards" />
<meta name="author" content="Design Pros Inc, 3 birds Media" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<link rel="icon" href="images/favicon.ico" /><link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript">
 function forward(){
 var identifier = '<?php echo $_REQUEST["identifier"]; ?>';
  if(identifier){
  /* For Merchant Test Environment (CTE) */
  //document.redirectForm.action="https://connect.merchanttest.firstdataglobalgateway.com/IPGConnect/gateway/processing";
  /* For Production Environment (PROD) */
  document.redirectForm.action="https://connect.firstdataglobalgateway.com/IPGConnect/gateway/processing";
 document.redirectForm.submit();
  }
  }
 </script>
<title>Digiprint Products LLC <?php echo "&#8212; {$title}"; ?></title>
</head>


<body onLoad="forward()">
<div class='wrapper'>

  <div class='center_wrapper'>
    <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
	<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
    </div>


   <div class="cont" id="cartCont">
  <?php if (!isset($_REQUEST["identifier"])){
				   $_REQUEST["identifier"] = NULL;
		}
		if ($_REQUEST["identifier"] == NULL){ ?>

  <h2>Secure Payment</h2>

  <table class="checkout">
  <tr><td align="right">SUBTOTAL:</td><td align="center"><?php echo $price; ?></td></tr>
  <tr><td align="right">STATE TAX:</td><td align="center"><?php echo ($tax*100);  ?></td></tr>
  <tr><td align="right">TOTAL:</td><td align="center"><?php echo $totalprice; ?></td></tr>
  </table>

  <!--<FORM action="/connect_p.php" method=post name="mainform"><BR>--><br />
 	<FORM action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="mainform"><BR />

   	<INPUT type='hidden' value='sale' name='txntype' />
	<h3>* Please Select your Card Type</h3>
	<SELECT size='1' name='paymentMethod'>
        <OPTION value='V'>Visa</OPTION>
        <OPTION value='M'>MasterCard</OPTION>
        <OPTION value='A'>American Express</OPTION>
        <OPTION value='D'>Discover</OPTION>
        <OPTION value='J'>JCB</OPTION>
        <OPTION value="">Other</OPTION>
    </SELECT>

    <INPUT type='hidden' value='payonly' name='mode' />
    <INPUT type='hidden' value='ECI' name='trxOrigin' />
    <input type="hidden" name="oid" value="<?php print_r($_SESSION['payment']['order_id']); ?>"/>
    <input type="hidden" name="tdate" value="<?php echo $dateTime; ?>"/>
    <INPUT type="hidden" value='<?php echo $totalprice; ?>' name='subtotal' />
    <INPUT type="hidden" value='<?php echo $totalprice;?>' name='chargetotal' />
    <input type="hidden" name="identifier" value="true" />

    <INPUT type='submit' class="submit" id="upload" value="SECURE PAY!" name='submitBtn' />

</FORM>

<?php } else {?>


 <h2>Please wait while you are being redirected</h2>
 <img src="images/ajax-loader.gif" width="220" height="19" alt="loader" />
 <FORM method="post" id="redirectForm" name="redirectForm">

  <?php
  $mode = $_REQUEST["mode"];
  $chargetotal = $_REQUEST["chargetotal"];
  $subtotal = $_REQUEST["subtotal"]; ?>
   <input type="hidden" name="timezone" value="<?php echo getTimezone() ?>" />
    <input type="hidden" name="authenticateTransaction" value="false" />
     <input size="50" type="hidden" name="paymentMethod" value="<?php echo $_REQUEST["paymentMethod"] ?>"/>
     <input size="50" type="hidden" name="txntype" value="<?php echo $_REQUEST["txntype"] ?>"/>
      <input size="50" type="hidden" name="txndatetime" value="<?php echo getDateTime() ?>" />
      <input size="50" type="hidden" name="hash" value="<?php echo createHash($chargetotal) ?>" />
      <input size="50" type="hidden" name="mode" value="<?php echo $mode ?>"/>
      <input size="50" type="hidden" name="storename" value="<?php echo getStorename() ?>"/>
      <input size="50" type="hidden" name="chargetotal" value="<?php echo $chargetotal ?>"/>
      <input size="50" type="hidden" name="subtotal" value="<?php echo $subtotal ?>"/>
       <input size="50" type="hidden" name="trxOrigin" value="<?php echo $_REQUEST["trxOrigin"] ?>"/>
       <input size="50" type="hidden" name="oid" value="<?php echo $_REQUEST["oid"] ?>"/>
        <input size="50" type="hidden" name="tdate" value="<?php echo $_REQUEST["tdate"] ?>"/>
        </FORM> <?php } ?> </div></div></div></BODY> </HTML>
