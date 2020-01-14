<?php include('includes/functions.php');
	  $conn = dbConnect('query');
	  $bannerSql = "SELECT img_name FROM images WHERE img_id = 2";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($bannerSql)) {
				//bind the results to variables
				$stmt->bind_result($banner);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
		}
	  $headSql = "SELECT img_name FROM images WHERE img_id = 1";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($headSql)) {
				//bind the results to variables
				$stmt->bind_result($headshot);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  $homeSql = "SELECT homeText FROM homeText WHERE home_id = 1";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($homeSql)) {
				//bind the results to variables
				$stmt->bind_result($homeText);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  
	  $homeSql = "SELECT homeText FROM homeText WHERE home_id = 1";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($homeSql)) {
				//bind the results to variables
				$stmt->bind_result($homeText);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  $headSql = "SELECT img_name FROM images WHERE img_id = 3";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($headSql)) {
				//bind the results to variables
				$stmt->bind_result($left_img);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  $headSql = "SELECT img_name FROM images WHERE img_id = 4";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($headSql)) {
				//bind the results to variables
				$stmt->bind_result($center_img);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  	  $headSql = "SELECT img_name FROM images WHERE img_id = 5";
	  //initialize statement
	  $stmt = $conn->stmt_init();
	  if ($stmt->prepare($headSql)) {
				//bind the results to variables
				$stmt->bind_result($right_img);
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();
	  }
	  dbClose($conn);
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
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"><input type="image" src="images/cart.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	  </form>
	  </td>
      </tr>
   
    <?php include('includes/navbar.php') ?>
    <tr>
      
<!--BANNER -->
      <td width="719" height="203" colspan="11" align="left" valign="top" id="banner_head">
      <?php
	echo "<img id='banner' src='images/$banner'/>";
	echo "<img id='head' src='images/$headshot'/>";
      ?>
      </td>
    </tr>
    <tr>
      <td width="719" height="440" colspan="11" align="left" valign="top" background="images/content2.jpg" style="background-repeat:no-repeat;" bgcolor="#FFFFFF">
      <div align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="719" height="77"></td>
      </tr></table>
<!-- HOME TEXT -->      
      <div class="homepagetext">
	<?php
	  echo $homeText.'<br />';
	?>
<br /><br />
Thanks for visiting!</span></div>

<div id="home-top" align="center"></div>

<div id="home" align="center">
        <table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td class="boxes" width="170" height="170" align="center" valign="middle"><img src="images/<?php echo $left_img; ?>" width="170" height="170" border="0"></td>
      <td width="64" height="170" align="center" valign="middle"></td>
      <td class="boxes" width="170" height="170" align="center" valign="middle"><img src="images/<?php echo $center_img; ?>" width="170" height="170" border="0"></td>
      <td width="64" height="170" align="center" valign="middle"></td>
      <td class="boxes" width="170" height="170" align="center" valign="middle"><img src="images/<?php echo $right_img; ?>" border="0"></td>
      </tr>
      </table>
      </div>
      
      <div id="homepagecontact">
      <span class="bold">Pinky's Workbench</span><br />
      Phone number: 714-916-7430<br /><span class="style1faqgray">email: <a href="mailto:adela@pinkysworkbench.com">adela@pinkysworkbench.com</a></span>      </div>     </td>
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
      <td align="center"><span class="style5"><a href="admin/index.php">&copy;</a>2010 Pinky's Workbench</span> <span class="style6">|</span> <span class="style5">web design by: <a href="http://www.designpros-inc.com/" target="_blank">Design Pros Inc.</a> / Corner 10</span></td>
      </tr></table>
      </div>      </td>
    </tr>
  </table>
  <!-- End ImageReady Slices -->
  </div>
<br />
</body>
</html>