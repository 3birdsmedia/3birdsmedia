<?php
session_start();
ob_start();

$busterOn = true;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}
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
          $prod_number  = $row2['prod_number'];
          $prod_desc  = $row2['description'];
          $price 			= $row2['price'];
          $img 			= $row2['img'];
          $alt 			= $row2['alt'];

	}
}

//echo $dimension;
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php googleAnalytics("UA-48260012-6"); ?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#00aaff">
    <link rel="shortcut icon" href="images/favicon.ico">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="msapplication-config" content="images/browserconfig.xml">
    <meta name="theme-color" content="#00aaff">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon/favicon.ico">

<title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>

 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
  <!-- Custom styles for this template -->
    <link href="css/site.css<?php echo $buster; ?>" rel="stylesheet">
</head>

<body>
<main class="wrapper">
<header>
<div class="help-bar row  text-center">
  <div class="contact-phone col-sm-12 col-md-6"><i class="fas fa-envelope"></i><a href="mailto:support@bandedglory.com">support@bandedglory.com</a></div>

  <div class=" col-sm-12 col-md-6">
    <span class="display-cart">
      <a href="view_cart.php" title="View Cart">
        <i class="fas fa-shopping-cart"></i>
  <?php
         if(isset($_SESSION['items'])){
          echo "<span class='cart-count'>".$_SESSION['items']."</span>";
        }
  ?>
      </a>
    </span>
    <span>
      <a href="cpanel/myaccount.php" title="My Account"><i class="fas fa-user-circle"></i>  MY ACCOUNT </a>
  <?php
      if (isset($_SESSION['loggedin'])) {
      echo  '<a href="logout.php" title="Login"><i class="fas fa-sign-out-alt"></i>  LOGOUT</a>';
      }else{
      echo  '<a href="cpanel/index.php" title="Login"><i class="fas fa-sign-in-alt"></i>  LOGIN</a>';
      }
  ?>
    </span>
  </div>
</div>
      <?php include('includes/navBar.php');?>

</div>

</header>
<section id="secondary" class="parallax">
    <div class="" id="secondary">
      <h2>Designed for Comfort & Built to Last</h2>
    </div><!-- /.container -->
</section>

<section class="cont">
      	<h2 >PRODUCTS:</h2>
        <p><a href="products.php" title="Products">Products: &nbsp;>&nbsp;</a> <?php echo $prod_name; ?></p>
		<?php
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



	echo '<div class="container" id="product">';
    echo '<div class="product block row">';
      echo '<div class="prod-img col-sm-12 col-md-6">';
  			//image
  			echo '<img  src="images/products/' .$imgProd. '" class="img-responsive" />';
      echo '</div>';

			echo '<div class="specs text-left col-sm-12 col-md-6">';
      echo '<form action="addToCart.php" name="addToCartForm" value="addToCart" id="AddToCartForm" method="post">';
      echo '<div class="title"><h2>Style: '.ucfirst($prod_name).'</h2></div>';
        echo '<div class="price"><h3>$'.$price.' USD</h3></div>';
        echo '<div class="description">'.nl2br($prod_desc).'</div>';
        echo '<div class="colors form-group">';
        $colorSql = "SELECT DISTINCT color, description
              FROM prod_color_size_lookup, ring_colors
              WHERE prod_color_size_lookup.prod_id = $prod_id
              AND prod_color_size_lookup.color_id = ring_colors.color_id";


        //submit the SQL query to the database and get the result
        $colors_result = $conn->query($colorSql) or die(mysqli_error());
        $colorcount="0";
        //loop through the result to get the id, product and description
        while ($row_color = $colors_result->fetch_assoc()) {
            echo '<label class="color-cont">';
            echo '<input type="radio" name="color" value="'.$row_color['color'].'"';
            if($colorcount=="0"){echo 'checked="checked"';}
            echo '/>
            <span class="checkmark" style="background-color:'.$row_color['description'].'"></span>
            </label>';
        }

?>



<div class="form-group row container">
<label class="bold18"> Select Size:</label>
<select id="sizes">
</select>

<div class="form-group row container">
<label class="bold18"> QTY:</label>
<input type="text" name="qty[]" class="qty" id="qty" style="color:red;" value="1"/>
<span class="bold18">SUBTOTAL:
<span id="price"> $<?php echo number_format($price, 2, '.', ''); ?></span></span>
<input type="submit" id="add" name="Add to Cart" value="Add to Cart" />
<?php
echo '<div id="addToCart">';
echo '<input type="hidden" name="prod_id" value="'.$prod_id.'"/>
<input type="hidden" name="priceHidden" id="priceHidden" value="'.$price.'"/>';
}
?>
</form>
  </div>
</div><!--END OF MODULE-->


</section>
</div><!--end of wrapper-->
<div class="footer">
<?php include('includes/footer.php');?>


</div>
</div></main>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">


    function displayVals() {
        var qty = $("#qty").val()
        var totalprice = (<?php echo $price ?>*1) * (qty*1);

        $("#price").html(" $" + totalprice.toFixed(2));
      };
      //What to do after
      $("#qty").keypress(displayVals);
      $("#qty").keydown(displayVals);
      $("#qty").keyup(displayVals);


 $("document").ready(function(){
    var data = {
      "action": "test"
    };
    data = $(this).serialize() + "&" + $.param(data);
        //data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "includes/displayCart.php", //Relative or absolute path to response.php file
          data: data,
          success: function(data) {
            $(".cart-count").html(
              data["items"]
            )}
        });
        return false;
    });

  $('input[type=radio]').change(function () {
    var value = $(this).val();
    var prod_id = <?php echo $prod_id; ?>;
    // $.ajax({
    //     type: "GET",
    //     url: "includes/displaySizeDropdown.php",
    //     async: true,
    //     data: {
    //         color: value,
    //         prod_id: prod_id // as you are getting in php $_POST['action1']
    //     },
    //     success: function (data) {
    //       var sizes = [];
    //       sizes = jQuery.parseJSON(data);
    //       console.log(sizes);
    //       for (var i = sizes.length - 1; i >= 0; i--) {
    //         console.log(sizes[i]);
    //       }
    //     }
    // });
    $.getJSON( 'includes/displaySizeDropdown.php?color='+value+'&prod_id='+prod_id+'', function( data ) {
      var items = $();
      $.each( data, function( key, val ) {
        items = items.add( "<option id='" + key + "'  value='" + key + "' >" + key + " <em>Only " + val + " remaining</em></option>" );
        console.log( "<option id='" + key + "'  value='" + key + "' >" + key + " <em>Only " + val + " remaining</em></option>" );
      });
      $('#sizes')
          .empty()
          .append(items);
      });



  });



</script></body>
</html>
