<!-- connect.php -->

 <?php 
 include('includes/functions.php');
 include("fdgg-util_sha2.php");
 ?>
 <HTML>
  <head>
  <title>FDGG Connect Sample for PHP</title>
  </head> 
  <script type="text/javascript"> 
  function forward(){ 
  	identifier = '<?php if(isset($_REQUEST['identifier'])){echo $_REQUEST["identifier"];}else{} ?>'; 
	if(identifier){
		/* For Merchant Test Environment (CTE) */ 
		document.redirectForm.action="https://connect.merchanttest.firstdataglobalgateway.com/IPGConnect/gateway/processing"; 
		/* For Production Environment (PROD) */ 
		//document.redirectForm.action="https://connect.firstdataglobalgateway.com/IPGConnect/gateway/processing";
		document.redirectForm.submit(); } } 
</script> <BODY onLoad="forward()"> 
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
      <input type="hidden" name="tdate" value="<?php echo date(r); ?>"/>
      
      <INPUT value=11.00 name=chargetotal><INPUT value=11.00 name=subtotal>
      <INPUT type=submit value="Submit This Form" name=submitBtn>
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
	</FORM> <?php } ?> </BODY> </HTML>