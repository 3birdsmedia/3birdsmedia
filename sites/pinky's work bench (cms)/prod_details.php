  <?php
  include('includes/functions.php');
	  //check for the product_id on the query string
	  if ( isset($_GET['prod_id']) && is_numeric($_GET['prod_id']) ) {
		  
		  //set the variable so it's easier to use later in script
		  $prod_id = $_GET['prod_id']; //for troubleshooting
		  $cat_id = $_GET['cat_id'];//echo "product_id is $prod_id <br>";
	  } else {
		  $prod_id = 0;
		  echo "No product id on the url.";
	  }
		  
  
	
	  //call the db connection script, passing in the type of user.
	  $conn = dbConnect('query'); 
	  
	  //PART 1. Get basic product info and image
	  //note that we're using LEFT JOIN to get image information as well as product info
	  //the ON condition is where we match up the foreign key in the image table with a primary key in the product table
	  $sql = "SELECT *
			  FROM prod_img_lookup, images
			  WHERE prod_img_lookup.prod_id = $prod_id
			  AND prod_img_lookup.img_id = images.img_id
			  ORDER BY images.img_id";
		  
	  //submit the SQL query to the database and get the result
	  $result = $conn->query($sql) or die(mysqli_error());
	  $length = $result->num_rows;
	  //$row = $result->fetch_assoc();
	  
	      while ($row = $result->fetch_assoc()) {
				  //loop through the sql result, add each product_id and type_id to array to use later 
				  $img_url = $row['img_url'];
				  $img_name = $row['img_name'];
			  }
			  //now that we are finished with results, release the db resources to allow a new query.
			  $result->free_result();
			  
	    $sql2 ="SELECT * FROM products
		    WHERE products.prod_id = $prod_id";
		    
	    $result2 = $conn->query($sql2) or die(mysqli_error());
	    
	    $row2 = $result2->fetch_assoc();
	    $prod_name = $row2['prod_name'];
	    $prod_desc = $row2['prod_desc'];
	    $disks = $row2['disks'];
	    $price = $row2['price'];
	    $result2->free_result();
	   
	    $sql3 ="SELECT cat_name FROM categories
		    WHERE categories.cat_id = $cat_id";
    
	    $result3 = $conn->query($sql3) or die(mysqli_error());
	    
	    $row3 = $result3->fetch_assoc();
	    $cat_title = $row3['cat_name'];
	    $result3->free_result();
	    dbClose($conn);
  //print_r($images);			
  ?>
  
  <html>
  <head>
  <title>Pinky's Workbench - Custom Artisan and Concept Jewelry</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script type="text/javascript" src="js/jquery-1.5.1.js"></script>
  <script type="text/javascript" src="js/jquery.slideViewerPro.1.0.js" ></script> 
  <script type="text/javascript" src="js/jquery.timers.js"></script>
 
<script type="text/javascript">

$(window).bind("load", function() {
	$("div#prod_slide").slideViewerPro({});
});

  //-->
  </script>
  
  
  <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
  <link rel="stylesheet" href="css/svwp_style.css" type="text/css" media="screen" />
  </head>
  <body leftmargin="0" marginwidth="0">
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
     <!--NAVBAR INCLUDE-->    
    <?php include('includes/navbar.php') ?>
    <tr>
	<td height="643" colspan="11" align="left" valign="top" bgcolor="#FFFFFF">
	    <div align="center"><table border="0" cellpadding="0" cellspacing="0">
	    <tr>
		<td height="45"></td>
	    </tr>
    </table>
  </div>
	
  <div id="titles"><?php echo $cat_title; ?> Product Details
        <table border="0" cellpadding="0" cellspacing="0">
	    <tr>
	      <td width="624" align="left" valign="top" class="return"><a href="prodlist.php?cat_id=<?php echo $cat_id; ?>">Return to Main <?php echo $cat_title; ?> Page</a></td>
	    </tr>
            <tr>
	        <td width="624" height="2" align="left" valign="top" bgcolor="#EC018C"></td>
            </tr>
            <tr>
	        <td width="624" height="10" align="left" valign="top"></td>
            </tr>
      </table>
  </div>
      
  <div id="productsdetails-top">
      <table border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td id="productsdetailstd1">
		    <?php echo $prod_name; ?><span class="productsdetailstextspan">$<?php echo $price; ?></span></td>
	      <td id="buytop">&nbsp;</td>
	  </tr>
	  <tr>
	    <td><p class="productsdetailsdesc"><?php echo nl2br($prod_desc); ?></p></td>
	    <td></td>
      
          </tr>
      </table>
  </div>
      
      
   <div id="productsdetails">
     <table border="0" cellpadding="0" cellspacing="0">
          <tr><td class="boxesdetail" align="left" valign="middle">
		<div id="prod_slide" class="svwp">
	  	 <ul>
		      <?php
		      $conn = dbConnect('query');
			//prepare first SQL query, category_id not included
			$sql = "SELECT *
				FROM prod_img_lookup, images
				WHERE prod_img_lookup.prod_id = $prod_id
				AND prod_img_lookup.img_id = images.img_id
				ORDER BY prod_img_lookup.prod_id";
					
			//submit the SQL query to the database and get the result
			$result = $conn->query($sql) or die(mysqli_error());
	

			while ($row = $result->fetch_assoc()) {
			  echo '<li>
				    <a href="#">
				      <img src="images/products/'.$row['img_url'].'"/>
				    </a>
				</li>';

			}      
		?></ul>
	   </td>
	   <td>
	    
	   </td>
	</tr>
      </table>
  </div>
      
      
      
  <div id="cart" align="center">
    <table border="0" cellpadding="0" cellspacing="0">			
	<tr>
	        <td height="40" align="left" valign="top" class="cartlinks">
			      
			     <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" />
			       <input type="hidden" name="cmd" value="_cart" />
			       <input type="hidden" name="business" value="39YGG6Z6E8CZS" />
			       <input type="hidden" name="lc" value="US">
			       <input type="hidden" name="item_name" value="<?php echo $prod_name; ?>" />
			       <input type="hidden" name="item_number" value="<?php echo $prod_id;?>" />
			       <input type="hidden" name="currency_code" value="USD" />
			       <input type="hidden" name="add" value="1" />
			       <!-- dynamically build the drop down list for categories-->
			       <?php						
				 $sql = "SELECT * FROM prod_chain_lookup, chains
				 WHERE prod_chain_lookup.prod_id = $prod_id
				 AND prod_chain_lookup.chain_id = chains.chain_id
				 ORDER by chains.chain_id";  //select only those fields we need
								     
				 //submit the SQL query to the database and get the result
				 $result = $conn->query($sql) or die(mysqli_error());
				     
				 $num_rows = mysqli_num_rows($result);
				     
				 if ($num_rows !== 0 ) {
				 echo '<label for="cat_id">Select the chain length</label></td></tr><tr><td>
					      <select name="os0" id="chain">';
								     
						     while ($row = $result->fetch_assoc()) {
									     echo '<option value="'.$row['addit_price'] .'"> '. $row['length'].'"  (Add $'.$row['addit_price'].'.00) </option>';
									     
								     }
					     echo "</select>";
				     }//now that we are finished with the resuls set, release the db resources to allow a new query.
								     $result->free_result();
				if ($prod_id == 186) {echo
				      '<input type="hidden" name="on1" value="Disks"><label for="disks">Would you like to add bars?</label></td></tr>
					  <tr><td><select name="os1" id="disk">
						    <option value="0">No</option>
						    <option value="16">Add 1 ($16.00)</option>
						    <option value="32">Add 2 ($32.00)</option>
						    <option value="48">Add 3 ($48.00)</option>
						    
						  </select><td></tr>';
				}elseif ($disks == 1) {echo
				      '<input type="hidden" name="on1" value="Disks"><label for="disks">Would you like to add disks?</label></td></tr>
					  <tr><td><select name="os1" id="disk">
						    <option value="0">No</option>
						    <option value="16">Add 1 ($16.00)</option>
						    <option value="32">Add 2 ($32.00)</option>
						    <option value="48">Add 3 ($48.00)</option>
						    
						  </select><td></tr>';
				}
				
							     ?>
			     
			     
			     <script>
				 function displayVals() {
				  <?php if ($num_rows !== 0 ) { echo 'var singleValues = $("#chain").val();';}?>
				  <?php if ($disks == 1) {echo  'var diskValues = $("#disk").val();
							      var disks = diskValues*1 / 16;';}?>
				 var totalprice = <?php echo $price ?>*1 + <?php if ($num_rows !== 0 ) { echo 'singleValues*1';}?> + <?php if ($disks == 1) {echo  'diskValues*1';}?>; 
				   $("#price").html(totalprice + ".00");
				   $('#priceHidden').attr('value', totalprice);
				   $('#disks').attr('value', disks);
				 }
			     	 $("select").change(displayVals);
				
				 displayVals();
			     </script>
	      </td>
	      <td></td>
	  <tr>
	      <td><input type="hidden" name="on0" value="0" id="disks">
		  <input type="hidden" name="amount" id="priceHidden" value="<?php echo $price ?>">
		  <input type="hidden" name="on3" value="Costumize your Product"><label>Costumize your product.</label>
		  <textarea name="os3" maxlength="200"  ></textarea></td>
	  </tr>
	  
	  <tr>
	      
	  <td></td>
	  </tr>
	  
	 
    
	  <tr><td><input id="paypal" type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	      </td>
	  </tr>
	  </form>
	  <tr>
	    <td>TOTAL: <span id="price"> <?php echo $price.'.00'; ?></span></td>
	  </tr>
	  
	  </div>      
      </tr>
      </tr>
      <tr>
            <td width="719" height="82" colspan="11" align="left" valign="top"></td>
      </tr>

    </table>
</div>  

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