<?php
session_start();
ob_start();
 include('includes/functions.php');
 include("fdgg-util_sha2.php");
//print_r($_SESSION);

$amount = $_SESSION['total_price'];//get this from session, set in view_cart.php
session_destroy();

 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript">
  function forward(){
  	identifier = '<?php if(isset($_REQUEST['identifier'])){echo $_REQUEST["identifier"];}else{} ?>';
	if(identifier){
		/* For Merchant Test Environment (CTE) */
		document.redirectForm.action="https://connect.merchanttest.firstdataglobalgateway.com/IPGConnect/gateway/processing";
		/* For Production Environment (PROD) */
		//document.redirectForm.action="https://connect.firstdataglobalgateway.com/IPGConnect/gateway/processing";
		document.redirectForm.submit(); } }
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
<?php if ($_REQUEST["identifier"]== NULL ) { ?>
<P> <H1>Order Form </H1>
 <!--<FORM action="/connect_p.php" method=post name="mainform"><BR>-->
  <FORM action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="mainform">
    <INPUT type='hidden'  value='sale' name='txntype'>
       * Credit Card Type
       <SELECT size='1' name='paymentMethod'>
       	<OPTION value='V' selected>Visa</OPTION>
        <OPTION value='M'>MasterCard</OPTION>
        <OPTION value='A'>American Express</OPTION>
        <OPTION value='D'>Discover</OPTION>
        <OPTION value='J'>JCB</OPTION>
        <OPTION value='9'>Check</OPTION>
        <OPTION value="">Other</OPTION>
      </SELECT>

      <input value='payonly' type='hidden' />
      <INPUT type='hidden' value='ECI' name='trxOrigin' />
      <?php $oid =  getOrderID(); ?>
      <input type="hidden" name="oid" value="<?php echo $oid; ?>"/>
      <input type="hidden" name="tdate" value="<?php echo date('r'); ?>"/>

      <INPUT value="<? echo $amount ?>" name="chargetotal">
      <INPUT type="hidden" value="<? echo $amount ?>" name="subtotal">
      <INPUT type="submit" value="Proceed to Secure Payment" name=submitBtn>
      <input type="hidden" name="identifier" value="true" />
  </FORM> <?php } else {?>

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
     <input size="50" type="hidden" name="mode" value="<?php echo $mode ?>"/><br>
	<input size="50" type="hidden" name="storename" value="<?php echo getStorename() ?>"/>
	<input size="50" type="hidden" name="chargetotal" value="<?php echo $chargetotal ?>"/>
	<input size="50" type="hidden" name="subtotal" value="<?php echo $subtotal ?>"/>
	<input size="50" type="hidden" name="trxOrigin" value="<?php echo $_REQUEST["trxOrigin"] ?>"/>
	<input size="50" type="hidden" name="oid" value="<?php echo $_REQUEST["oid"] ?>"/>
	<input size="50" type="hidden" name="tdate" value="<?php echo $_REQUEST["tdate"] ?>"/>
	</FORM> <?php } ?>

    </div>


</div><!--END OF CONTENT-->

<?php include('includes/navBar.php');?>
 <div class="push"></div>

</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>
</body>
</html>
