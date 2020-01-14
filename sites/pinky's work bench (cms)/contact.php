<?php include('includes/functions.php');

//print_r($_POST);
//If the form is submitted
if(isset($_POST['submit'])) {



$msg = '';
foreach ($_POST as $key => $value) {
if (!isset($value)) {$value = "Not Specified";}

$msg =   $msg.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';
 
}

	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
		
	} else {
		$name = trim($_POST['name']);
	}
	
	//Check to make sure that the field is not empty
	
	

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		
		//echo 'Has'.$hasError.'ERRORfirst'; 
	} else if (!preg_match('/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/', trim($_POST['email']))) {
	
		
	
	} else {
		$email = trim($_POST['emailAddress']);
	}


	//If there is no error, send the email
	
 		$to = "adela1920@mindspring.com";
		$subject = "Contact Page";
		    
		    // send it
		    $mailSent = mail($to, $subject, $msg);
		    $emailSent = true;
	

}

?>
<html>
<head>
<title>Pinky's Workbench - Custom Artisan and Concept Jewelry</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body leftmargin="0" marginwidth="0" onLoad="MM_preloadImages('images/cart-r.jpg','images/special-r.jpg','images/about-r.jpg','images/faq-r.jpg','images/necklace-r.jpg','images/children-r.jpg','images/men-r.jpg','images/bracelets-r.jpg','images/contact-r.jpg','images/blog-r.jpg')">
  <div align="center">
    <!-- ImageReady Slices (Home-template.psd) -->
    <table width="719" height="924" border="0" cellpadding="0" cellspacing="0" id="Table_01">
      <tr><td width="719" height="165" colspan="11" align="right" valign="top" background="images/top-banner.jpg"><a href="http://www.pinkysworkbench.com/blog" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('blog','','images/blog-r.jpg',1)"><img src="images/blog.jpg" alt="blog" name="blog" width="146" height="51" border="0"></a>
	  <form id="paypal" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIG1QYJKoZIhvcNAQcEoIIGxjCCBsICAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYB3kFoAk+K0Zjidkmne0kk5EJPWEHw/EhSmOe/VbkgFPsgQGA5NTbrCYZ505gvqm60ImKTkJKPQqd9wI3whMbsJSQt7du0idfCzq/z+jL5RM0fRKVXXVd0URYAZm/126t5lVz9M/ioe2XeBGxSLHVFMivPy+ldIHb9BI1+4GAeP0jELMAkGBSsOAwIaBQAwUwYJKoZIhvcNAQcBMBQGCCqGSIb3DQMHBAhj/NtR/ekcAYAwFzUtV6mnk3AeHYOtGslLlZIBHik46xu/b7OEdLG5d7iKZN/6BHcEppnJtOJPMoBZoIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMTEwMzE2MjMzODU0WjAjBgkqhkiG9w0BCQQxFgQUyR4OGFcMwQl+TYLEtDg1Q23H0GQwDQYJKoZIhvcNAQEBBQAEgYAAejpyiD4L5+5q0TN5yJP47OOLcu0Md0rW3ap0zN4lYQglLVblUqPTm3cGo4Uh0arw1lxpFKO1XIZ4zBVeNSdzgnBnaC7FqhCYAktWMrwMSThkVeNOLCCHgxvuU0vcCwlUNJM3lPJFgFnoU+bQR78dRGUc7ey4xn4eTmUD5qIIrQ==-----END PKCS7-----
"><input type="image" src="images/cart.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	  </form>
	  </td>
      </tr>
   
    <?php include('includes/navbar.php') ?>
    <tr>
      <td width="719" height="643" colspan="11" align="left" valign="top" bgcolor="#FFFFFF">
      <div align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="719" height="45"></td>
      </tr></table>
      </div>
      
      <div id="titles">Contact Us
        <table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="624" height="2" align="left" valign="top" bgcolor="#EC018C"></td>
      </tr>
      </table>
      </div>
      
      <div id="products-top" align="center"></div>

      
      <div id="content" class="style1content">
        <p><span class="style1faqpink">Please fill out the form below to be added to our customer list.</span><br>
          </p>
        <p>&nbsp;</p>
        <p>
        		
		<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
			<p><strong>Email was Sent!</strong></p>
			<p>One of our representatives will contact you soon.</p><br />
			
		<?php } ?>
        
        <!-- Begin myContactForm.com Form HTML -->
<form name="contactForm" id="contactForm" method="post" action="">
<input name="user" type="hidden" id="user" value="forms" /><input name="formid" type="hidden" id="formid" value="270112" /><input name="subject" type="hidden" id="subject" value="Online Contact Form Submission" />
<table width="500" style="border: 0px solid #623A38; margin: 0; padding: 0; background-color: #FFFFFF;"><tr><td>
<table width="100%" border="0" cellspacing="11" cellpadding="5">
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">First Name:<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><input class="required" name="name" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Last Name:<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><input class="required"  name="lname" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Company<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><input name="company" class="required"  type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr><td><font color="#3A2313" size="2" face="Arial"> E-mail Address:<font color="#FF0000"> *</font></font></td><td><input name="email" class="required email" type="text" id="email" size="20" maxlength="100" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></td></tr><tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Phone:</font></td><td><font color="#3A2313" size="2" face="Arial"><input name="phone" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Address 1:</font></td><td><font color="#3A2313" size="2" face="Arial"><input name="adress1" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Address 2:</font></td><td><font color="#3A2313" size="2" face="Arial"><input name="adress2" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">City:<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><input class="required"  name="city" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">State:<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><select  class="required" name="state" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;"> <option value="AL">AL</option> <option value="AK">AK</option> <option value="AZ">AZ</option> <option value="AR">AR</option> <option value="CA">CA</option> <option value="CO">CO</option> <option value="CT">CT</option> <option value="DC">DC</option> <option value="DE">DE</option> <option value="FL">FL</option> <option value="GA">GA</option> <option value="HI">HI</option> <option value="ID">ID</option> <option value="IL">IL</option> <option value="IN">IN</option> <option value="IA">IA</option> <option value="KS">KS</option> <option value="KY">KY</option> <option value="LA">LA</option> <option value="ME">ME</option> <option value="MD">MD</option> <option value="MA">MA</option> <option value="MI">MI</option> <option value="MN">MN</option> <option value="MS">MS</option> <option value="MO">MO</option> <option value="MT">MT</option> <option value="NE">NE</option> <option value="NV">NV</option> <option value="NH">NH</option> <option value="NJ">NJ</option> <option value="NM">NM</option> <option value="NY">NY</option> <option value="NC">NC</option> <option value="ND">ND</option> <option value="OH">OH</option> <option value="OK">OK</option> <option value="OR">OR</option> <option value="PA">PA</option> <option value="RI">RI</option> <option value="SC">SC</option> <option value="SD">SD</option> <option value="TN">TN</option> <option value="TX">TX</option> <option value="UT">UT</option> <option value="VT">VT</option> <option value="VA">VA</option> <option value="WA">WA</option> <option value="WV">WV</option> <option value="WI">WI</option> <option value="WY">WY</option> <option value="">-Terr.-</option> <option value="AS">AS</option> <option value="FM">FM</option> <option value="GU">GU</option> <option value="MI">MI</option> <option value="PR">PR</option> <option value="VI">VI</option> </select></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Zip:<font color="#FF0000"> *</font></font></td><td><font color="#3A2313" size="2" face="Arial"><input  class="required" name="zip" type="text" value="" size="20" maxlength="" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;" /></font></td></tr>
<tr bgcolor=""><td><font color="#3A2313" size="2" face="Arial">Comments:</font></td><td><font color="#3A2313" size="2" face="Arial"><textarea name="msg" cols="20" rows="msg" style="font-family: Arial; font-size: 14px; font-weight: normal; color: #3A2313; background-color: #FFFFFF; border: 1px solid #C3B59B; vertical-align: middle; padding-left: 4px;"></textarea></font></td></tr>
<tr><td colspan="2"><hr size="1" /></td></tr>
<tr><td colspan="2"><input name="submit" type="submit" style="background-color: #C3B59B; font-family: Arial; font-size: 14px; color: #3A2313; border-bottom:1px solid #EC008B; border-right:1px solid #EC008B; border-top:1px solid #EC008B; border-left:1px solid #EC008B" value="Submit" /> <input name="reset" type="reset" style="background-color: #C3B59B; font-family: Arial; font-size: 14px; color: #3A2313; border-bottom:1px solid #EC008B; border-right:1px solid #EC008B; border-top:1px solid #EC008B; border-left:1px solid #EC008B" value="Reset" /> </td></tr>
<tr><td><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>*</b></font> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Required</font></td><td align="right"></td></tr>
</table></td></tr></table></form>
<!-- End myContactForm.com Form HTML -->
        <span class="style9small">Note: Please be assured that your personal information will never be sold, shared or used for other purposes without your permission.</span>
        </p>
        </div>
      
      
      
      <div id="products" align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td height="40" align="left" valign="top"></td>
      </tr>
      </table>
      </div>      </td>
    </tr>
    <tr>
      <td width="719" height="82" colspan="11" align="left" valign="top">
      
      <div align="center">
      <table width="719" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
      <td width="32"></td>
      <td width="655" height="10" align="center" valign="middle"></td>
      <td width="32"></td>
      </tr>
      <tr>
      <td width="32"></td>
      <td width="655"  height="2" align="center" valign="middle" bgcolor="#c1c1c1"></td>
      <td width="32"></td>
      </tr>
      <tr>
      <td width="32"></td>
      <td width="655" height="3" align="center" valign="middle"></td>
      <td width="32"></td>
      </tr></table>
      
<table width="719" border="0" cellpadding="0" cellspacing="0">
      <tr>
	<?php include('includes/fnavbar.php'); ?>

      <br />
      </td>
      </tr></table>
      
      <table width="719" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td height="20" bgcolor="#FFFFFF"></td>
      </tr></table>
      
      <table width="719" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td align="center"><span class="style5">&copy;2010 Pinky's Workbench</span> <span class="style6">|</span> <span class="style5">web design by: <a href="http://www.designpros-inc.com/" target="_blank">Design Pros Inc.</a> / Corner 10</span></td>
      </tr></table>
      </div>      </td>
    </tr>
  </table>
  <!-- End ImageReady Slices -->
  </div>
<br />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactForm").validate();
});
$().ready(function() {
	  //validate the comment form when it is submitted
	   $("#contactForm").validate(
				   {
				      rules: {
					     name: "required",
					     email: {
						      required: true,
						       email: true},
					     messages: {
				      			name: "Please enter your name",
				 			email: "Please enter a valid email address"}
					      }
				   });
	});
</script>
</body>
</html>