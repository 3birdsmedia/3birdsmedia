<?php
session_start();
ob_start();
include('includes/functions.php');
//print_r($_POST);
//check for the prod_id on the query string

if ( !isset($_GET['prod_id']) && !is_numeric($_GET['prod_id']) ) {
        $prod_id = 0;
            $msg = "<h2>Oops...</h2> there seems to be a problem, please <a href='products.php'>CLICK HERE</a> and try again.";


        }elseif($_GET['prod_id'] == '') {
               $prod_id = 0;
            $msg = "<h2>Oops...</h2> there seems to be a problem, please <a href='products.php'>CLICK HERE</a> and try again.";
        } else {
	    //set the variable so it's easier to use later in script
		$prod_id = $_GET['prod_id']; //for troubleshooting
		// "prod_id is $prod_id <br>";
	   //connect to the datase
		$conn = dbConnect('query');

            //Now we make a query request to store the product if it was requested
	    $sql = "SELECT *
                    FROM products, prod_img_lookup, images
                    WHERE products.prod_id = prod_img_lookup.prod_id
                    AND prod_img_lookup.img_id = images.img_id
                    AND products.prod_id = $prod_id
                    ORDER BY products.prod_id";

            //submit the SQL query to the database and get the result
            $result4 = $conn->query($sql) or die(mysqli_error());

        //loop through the result to get the id, product and description
        while ($row2 = $result4->fetch_assoc()) {

			     	$prod_id 		= $row2['prod_id'];
                 	$prod_name 		= $row2['prod_name'];
                 	$prod_number	= $row2['prod_number'];
                 	$dimension		= str_replace("|.||.|", '"',  $row2['dimension']);
					$dimension 		= trim($dimension, "|.|");$sheet_size 	= $row2['sheet_size'];
                 	$paper_stock 	= $row2['paper_stock'];
                 	$gsm 			= $row2['gsm'];
                 	$qty_per_sheet 	= $row2['qty_per_sheet'];
                 	$qty_per_pack 	= $row2['qty_per_pack'];
                 	$yeilds 		= $row2['yeilds'];
                 	$application 	= $row2['application'];
                 	$price 			= $row2['price'];
                 	$price_disc 	= $row2['price_disc'];
					$img 			= $row2['img'];
					$alt 			= $row2['alt'];

					$price = getPercent($price);

					//echo $price;
	}
}

//echo $dimension;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.ico" />
<link rel="stylesheet" href="styles/reset.css" />
<link rel="stylesheet" href="styles/styles.css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript" language="javascript">
function popUp(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=750,height=500,left = 440,top = 262');");
}
function enablefields() {
	//window.alert($('input.pprint').is(':checked'));
	if($('input.pprint').is(':checked')){
		//$('input.upload').removeAttr('disabled');
		$('div.pprint').fadeIn('fast');
		$('div.blank').fadeOut('fast');
	}else{
		//$('input.upload').attr('disabled', 'disabled');
		$('div.blank').fadeIn('fast');
		$('div.pprint').fadeOut('fast');
	}

}
$(document).ready(function(){
	$("#AddToCartForm").validate();

});
function isFloat(value) {
		if (/\./.test(value)) {
		return true;
		} else {
		return false;
		}
}
var checkedNum = false;
function numVal(){
	if (checkedNum == true){
		$("#submit").click(function(event) {
  			event.preventDefault();
		});
	}
}
</script>
<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>
</head>
<body>
<div class='wrapper'>
  <div class='center_wrapper'>
    <div id='header'><div id="headerPhone">Toll Free: (877) 421-2155</div>
		<div id='logo'><a href='index.php'><h1>Banded Glory, LLC</h1></a></div>
	</div><!--END OF HEADER-->
	<div class="content">
	  <div id="sideNav">
		<?php
		include('includes/sidenav.php');?>
	  <!--ENDOF SIDEBAR-->
	  <div class="cont">
      	<h2 >PRODUCTS:</h2>
        <p><a href="products.php" title="Products">Products: &nbsp;>&nbsp;</a> <?php echo $prod_name; ?></p>
		<?php
		echo '<div id="social">
				<div class="faceandtweet_retweet" style="float:left; width:110px;">
					<a href="http://twitter.com/share?url='.$_SERVER["REQUEST_URI"].'" class="twitter-share-button" data-text="Social Buttons - Twitter, Facebook data-count="horizontal" data-via="vagrantweb" data-related="carter_vagrant">Tweet</a>
					<script type="text/javascript" src="js/twitter.js"></script>
				</div>
				<div class="faceandtweet_like" style="float:left; width:90px; height:20px;">
					<iframe src="http://www.facebook.com/plugins/like.php?href='.$_SERVER["REQUEST_URI"].'&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px;" allowTransparency="true"></iframe>
				</div>
			</div>';

if(isset($msg)){
				echo $msg;
} else {
				$conn = dbConnect('query');
		  		//$imgresult = $conn->query($imgSql) or die(mysqli_error());
				$imgSql = "SELECT *
							FROM prod_img_lookup, images
							WHERE prod_img_lookup.prod_id = $prod_id
							AND prod_img_lookup.img_id = images.img_id";

				$imgProd = mysqli_fetch_array($conn->query($sql));
				$imgProd = $imgProd['img'];


	echo '<div class="left" id="module">';
		echo '<div class="product block" id="leftcont">';
			//image
			echo '<img  src="images/products/' .$imgProd. '" width="340" />';

			echo '<div class="specs">';
				echo '<span class="spec" id="ssize"><h5>Sheet Size</h5><p>'.$sheet_size.'</p></span>';
				echo '<span class="spec" id="psize"><h5>Product Size</h5><p>'. $dimension.'</p></span>';
				echo '<span class="spec" id="app"><h5>Application</h5><p>'.$application.'</p></span>';
			echo '</div>';
?>

        <div id="download">
			<a href="templates.php" title="Downloads"></a>
		</div>

		<div id="description">
          	<h3>Description:</h3>
            	<p>All our products use high quality papers that are eco-friendly and made in the USA and are coated and treated for all toner based printers and digital presses.  Our products are made for on demand quick turnaround for all types of applications and uses, see useage suggestions below for ideas. This product can be ordered as blank kiss cut sheets or you can order as a pre-printed item by uploading your print ready artwork on this site or email it to artwork@digiprintproducts.com.</p>

           <h3>Useage Suggestions:</h3>
           		<p>Retail Package, Gift Box, Business Gift, Promotional Item, Weddings, Birthdays, Baby Showers, Candy and Dry Foods, Candles, Jewelry, Tradeshow Giveaways, Etc...	</p>

			<h3>Features:</h3>
				<p>Scored, micro perffed, nicked for easy punch out and assemble.</p>

            <h3 class="notice">Notice:</h3>
				<p class="notice">Printing across score lines may result in cracking or faded color due  to different printing equipment and capabilities.</p>

			<p id="center" class="desc">Turn your product or marketing piece from just “OK”  to “WOW” when<br/>you choose any of our high quality products.</p>

		<div id="myOnPageContent">
         <table class="specs">
         	<tbody>
            	<tr>
                	<td class="left">Units</td><td class="right">Package</td>
                </tr>
                <tr>
                	<td class="left">Sheet Size</td><td class="right"><?php echo $sheet_size;?></td>
                </tr>
                <tr>
                	<td class="left">Product Size</td><td class="right"><?php echo $dimension;?></td>
                </tr>
                <tr>
                	<td class="left">Quantity/Package</td><td class="right"><?php echo $qty_per_pack; ?> Sheets per Package</td>
                </tr>
                <tr>
                	<td class="left">Quantity per Sheet</td><td class="right"><?php echo $qty_per_sheet; ?> </td>
                </tr>
                <tr>
                	<td class="left">Yields</td><td class="right"><?php echo $yeilds; ?> pieces</td>
                </tr>
                <tr>
                	<td class="left">GSM</td><td class="right"><?php echo $gsm;?> </td>
                </tr>
                <tr>
                	<td class="left">Stock Type</td><td class="right"><?php echo $paper_stock; ?></td>
                </tr>
              </tbody>
            </table>
            </div>
		</div><!--END OF DESCRIPTION-->
	</div><!--END OF LEFTCONT PRODUCT LEFT-->
</div><!--END OF MODULE LEFT-->
<?
echo '<div id="prod_desc" class="module">
		<span class="digilogo"></span>
		<span class="title">Style:</span> '.ucfirst($prod_name).'<br />';
echo '<p><span class="title">Product#:</span> '.$prod_number.'</p>';
echo '<p><span class="body">Please select how you will order this product!</span></p>';
?>

<form action="addToCart.php" name="addToCartForm" value="addToCart" id="AddToCartForm" method="post">
	<input type="radio" name="enable" class="blank" onclick="enablefields();" id="blank" value="blank" checked="checked" style="display:inline;float:left;margin-right:10px;"/> <label> Blank Sheets Only<input alt="#TB_inline?height=150&amp;width=400&amp;inlineId=myOnPageContent" title="add a caption to title attribute / or leave blank" class="thickbox" type="button" value="(25-50 SHEETS PER PACKAGE, SEE PRODUCT SPECS)" id="thickboxBtn" onmouseover="$(this).css('color','#6C0200');" onmouseout="$(this).css('color','#f00');" /></label>
	<input type="radio" name="enable" class="pprint" onclick="enablefields();" value="pprint" id="preprint" style="display:inline;float:left;margin-right:10px;"/> <label> Pre-printed product using your files (25 piece minimum)</label>

<hr style="margin-bottom:15px;" />

	<div class="blank">
      <h3 class="unit">UNIT/PACKAGE PRICE:$<?php echo number_format($price, 2, '.', ''); ?></h3><br />

         <label class="bold18"> QTY:</label>
         <input type="text" name="qty[]" class="qty" id="qty" style="color:red;" value="1"/>

<script>
	function displayVals() {
		var qty = $("#qty").val()
		var totalprice = (<?php echo $price ?>*1) * (qty*1);

		$("#price").html(" $" + totalprice.toFixed(2));
	};
	//What to do after
	$("#qty").keypress(displayVals);
	$("#qty").keydown(displayVals);
	$("#qty").keyup(displayVals);
</script>

			<span class="bold18">SUBTOTAL:
            <span id="price"> $<?php echo number_format($price, 2, '.', ''); ?></span></span>
            <br />

            <input type="submit" id="add" name="Add to Cart" value="Add to Cart" />
</div>

<!--PREPRINT-->
<div class="pprint" style="display:none">
	<p class="font17">Please select the quantity you want printed:</p>
 	<span class="title">
            <?php
				if($qty_per_sheet = 1){ $up = "1up";}
				elseif($qty_per_sheet = 2){ $up = "2up";}
				else{$up = "3up";}

				$sql = "SELECT bprice, ".$up."
						FROM  bulk_price
						ORDER BY bprice ASC";

				//echo $sql;

				//submit the SQL query to the database and get the result
				$result4 = $conn->query($sql) or die(mysqli_error());
       			$counter = $result4->num_rows;


				//loop through the result to get the id, product and description
        		while ($row2 = $result4->fetch_assoc()) {

					//array_push($bulk_prices,$row2['bprice']);
					//echo '<br/>'.$row2['bprice'];

				echo "<input type='radio' name='bprice' id='".$row2['bprice']."' value='".$row2[$up]."' style='display:block;margin-right:10px;float:left;' onclick='displayPrice();' /><label>".$row2['bprice']."</label>";
					if ($counter == 7) {
						$btotalprice = $row2[$up];
						$counter = $counter - 7;
						//echo $btotalprice;
					}
				}

				?>
			</span><br />


            <input type="hidden" name="bqty[]" class="bqty" id="bqty" value="25"/>
            <p><label id="bqtyErr" class="error"></label></p>


<script>
		function displayPrice(){
		//Get the value of that input
		var bprice = $('input[name=bprice]:checked').val();
		var bqty = $('input[name=bprice]:checked').attr('id');
		//alert (bqty);
		//use it to update the price
		$('#bprice').html("$" + bprice);
		$('#bpriceHidden').val(bprice);
		$('#bqty').val(bqty);
		}
</script>

<p class="bold16"> For Larger Quantities Please Contact <br />us at Toll Free: (877) 421-2155 for a Quote.</p>
			<span class="bold18">SUBTOTAL:
			<span id="bprice"> $<?php echo number_format($btotalprice, '2', '.',''); ?></span></span><br />

            <br />

            <span class="bold16">EXTRA:</span><br />
			<input type="checkbox" id="extra" name="extra" style="float:left; margin-right:10px;" /> <label  style="float:left;clear:right;">Add High Gloss UV 1 Side <br/> - $15 additional in orders up to 250 -</label>


            <input type="submit" id="add" class="submit" name="Add to Cart" value="Add to Cart" onclick="numVal()" /><br />


           <?php
			echo '<div id="addToCart">';

			echo '<input type="hidden" name="prod_id" value="'.$prod_id.'"/>
					<input type="hidden" name="up" id="up" value="'.$up.'"/>
					<input type="hidden" name="priceHidden" id="priceHidden" value="'.$price.'"/>
					<input type="hidden" name="bpriceHidden" id="bpriceHidden" value="'.$btotalprice.'"/>';
}
		?>
      	</form>
	</div>
</div><!--END OF MODULE-->



	<input type="button" onclick="popUp('imageUpload.php')" id="upload" class="submit" value="Upload Artwork" /><br/>

<p><span class="notice large">Notice: </span>
When sending print ready artwork please make sure it is setup using our provided templates as your guide and under 25mb in size. For larger size files and or questions about setting up your files please contact us at artwork@digiprintproducts.com or call us toll free at 1.877.421.2155. We also offer full design services if you would like one of our experience designers to design your project.</p>

<p><span class="notice">Print Process:</span></p>
<p>We print using CMYK process for all pre-printed </p>
<p>products. Optional High Gloss UV Coating 1 Side.</p>

<p>Standard turnaround time for pre-printed products using print ready files is 48 hours after customer sign off on artwork. Plus shipping time.</p>

		</div><!--END OF Add to cart-->
	</div><!--end of preprint-->





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


</div>
</div><script type="text/javascript">

$(function(){
		// Accordion
		$("#addToCart").accordion({
			collapsible: true,
    			animated: 'easeslide' ,
			header: '.color',
			event: 'click'
		});
});



</script></body>
</html>
