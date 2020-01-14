<?php include('includes/functions.php');

	if (isset($_GET['cat_id']) && !$_POST) {
	  $cat_id = $_GET['cat_id'];
	  $conn = dbConnect('query');
	  $catSql = "SELECT cat_name FROM categories WHERE cat_id = ?";
	  		
			//initialize statement
			$stmt = $conn->stmt_init();
			
			if ($stmt->prepare($catSql)) {
				//bind the query parameters
				$stmt->bind_param('i', $cat_id);
				//bind the results to variables
				$stmt->bind_result($cat_title);
				
				//execute the query, and gethe result
				$done = $stmt->execute();
				$stmt->fetch();
				//free the result to get ready for the next query
				$stmt->free_result();

			}
			
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
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
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
      
      <div id="titles"><?php echo ucwords($cat_title); ?>
        <table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="624" height="2" align="left" valign="top" bgcolor="#EC018C"></td>
      </tr>
      </table>
      </div>
      
      <div id="products-top" align="center"></div>
      
      
<?php
	
	 $conn = dbConnect('query');

  			$sql = "SELECT *
				FROM prod_cat_lookup, products
				WHERE prod_cat_lookup.cat_id = $cat_id
				AND prod_cat_lookup.prod_id = products.prod_id
				ORDER BY products.prod_id";

			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());

			while ($row = $result->fetch_assoc()) {
			      //loop through the results of the product query and display product info.
				//Plus build the link dynamically to the details page
				$prod_id = $row['prod_id'];
		  
				echo '<div class="product"><div class="style9">';
				
					    $sql2 = "SELECT *
					    FROM prod_img_lookup, images
		   			    WHERE prod_img_lookup.prod_id = $prod_id
					    AND prod_img_lookup.img_id = images.img_id
					    ORDER BY images.img_id
					    LIMIT 1";
				     
					    //submit the SQL query to the database and get the result
					    $result2 = $conn->query($sql2) or die(mysqli_error());
			    
			    while ($row2 = $result2->fetch_assoc()) {
				    echo '<p>'.$row['prod_name'].'<br />$'.$row['price'].'</p>
					  <div class="boxes"><a href="prod_details.php?prod_id='.$row['prod_id'].'&cat_id='.$cat_id.'">
					      <img src="images/products/'.$row2['img_url'].'" width="168" />
					  </div>
					  <p class="style9">
					      <a href="prod_details.php?prod_id='.$row['prod_id'].'&cat_id='.$cat_id.' ">
						  <h4>click for item details<br />larger image view<br />and to buy</h4>
					      </a>
					    </p>
					</div></div>';
				    
			    } //end of the while loop
			    $result2->free_result();
			    
			    }
			    //release the db resources to allow a new query
			    $result->free_result();
			    
    
			    //close our database connection
			    dbClose($conn);
		


?>
      
      
      <div id="products" align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td height="40" align="left" valign="top"></td>
      </tr>
      </table>
      </div>
      
      </td>
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
</body>
</html>