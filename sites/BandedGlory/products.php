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
include("includes/functions.php");
$conn = dbConnect('query');
	/*
	   First get total number of rows in data table.
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/

	if ( isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) && $_GET['cat_id'] != 0 ) {
		$cat_id = $_GET['cat_id'];
		$sql = "SELECT COUNT(*) as num FROM prod_cat_lookup WHERE prod_cat_lookup.cat_id=$cat_id";

//	}elseif(isset($_GET['size_id'])){
//		$size_id = $_GET['size_id'];
//		$sql = "SELECT size_id,
//			COUNT(DISTINCT prod_id) as num
//			FROM product_color_size_lookup
//			WHERE product_color_size_lookup.size_id= $size_id
//			AND inventory > 0
//			GROUP BY product_color_size_lookup.size_id";

//	}elseif(isset($cat_id)){
		//echo "<h2>$cat_id llalalal</h2>";
//		$sql = "SELECT COUNT(*) as num FROM products";
	}elseif( isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) && $_GET['cat_id'] == 0){
		$cat_id = 0;
		$sql = "SELECT COUNT(*) as num FROM products";
	}else{
		$cat_id = 0;
		$sql = "SELECT COUNT(*) as num FROM products";
	}
	$adjacents = 3;
	$total_pages = mysqli_fetch_array($conn->query($sql));
	$total_pages = $total_pages['num'];

	/* Setup vars for query. */
	$targetpage = "products.php"; 					//your file name  (the name of this file)
	$limit = 3; 						//how many products to show per page
	if(isset($_GET['page'])){
		$page = $_GET['page'];}
	else{
		$page = 1;
	}
	if($page)
		$start = ($page - 1) * $limit; 			//first product to display on this page
	else
		$start = 0;					//if no page var is given, set start to 0

	/* Get data. */
	if ( isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) && $_GET['cat_id'] != 0) {
	$sql = "SELECT *
			FROM prod_cat_lookup, products
			WHERE prod_cat_lookup.cat_id = $cat_id
			AND prod_cat_lookup.prod_id = products.prod_id
			LIMIT $start , $limit";
/*	}elseif(isset($_GET['size_id'])){
	echo $size_id;
	$sql = 	"SELECT *
                    FROM products, product_color_size_lookup, size
                    LEFT JOIN brands
                    ON products.brand_id = brands.brand_id
                    LEFT JOIN images
                    ON products.img_id = images.img_id
		    WHERE products.prod_id = product_color_size_lookup.prod_id
                    AND product_color_size_lookup.size_id = $size_id
                    AND inventory > 0
                    LIMIT $start, $limit";*/
	}else{
		$sql = "SELECT *
				FROM  products
				ORDER BY prod_id
				LIMIT $start , $limit";
	}
	$sqlresult = $conn->query($sql) or die(mysqli_error());
	//print_r($sqlresult);
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / products per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	/*
		Now we apply our rules and draw the pagination object.
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{
		$pagination .= "<ul class=\"pagination\">";
		//previous button
		if ($page > 1)
			$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$prev&cat_id=$cat_id\" aria-label='Previous'>
        <span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";
		else
			$pagination.= "<li class='page-item'><span class=\"disabled\" aria-label='Previous'>
        <span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>";

		//pages
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"page-item active\"> $counter</li>";
				else
					$pagination.= "<li class='page-item'><a class='' href=\"$targetpage?page=$counter&cat_id=$cat_id\">$counter</a></span>";
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$counter&cat_id=$cat_id\">$counter</a></span>";
				}
				$pagination.= "...";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$lpm1&cat_id=$cat_id\">$lpm1</a></span>";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$lastpage&cat_id=$cat_id\">$lastpage</a></span>";
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=1&cat_id=$cat_id\">1</a></span>";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=2&cat_id=$cat_id\">2</a></span>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$counter&cat_id=$cat_id\">$counter</a></span>";
				}
				$pagination.= "...";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$lpm1&cat_id=$cat_id\">$lpm1</a></span>";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=$lastpage&cat_id=$cat_id\">$lastpage</a></span>";
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=1&cat_id=$cat_id\">1</a></span>";
				$pagination.= "<li class='page-item'><a href=\"$targetpage?page=2&cat_id=$cat_id\">2</a></span>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter&cat_id=$cat_id</span>";
					else
						$pagination.= "<span class='next'><a href=\"$targetpage?page=$counter&cat_id=$cat_id\">$counter</a></span>";
				}
			}
		}


		//next button
		if ($page < $counter - 1)
			$pagination.= "<span class='next'><a href=\"$targetpage?page=$next&cat_id=$cat_id\">next &rsaquo; &rsaquo; </a></span>";
		else
			$pagination.= "<span class=\"disabled\">next &rsaquo; &rsaquo; </span>";
		$pagination.= "</ul>\n";

}
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

<section>
  <div class="container">
  	<div class="row">
  			<h2 class="col-sm-6 text-left">
  				<?php echo $title.':'; ?>
				</h2>
				<?php
				//<span id="pag" class="col-sm-6">
				//	 echo $pagination;
				//</span>
				?>
		</div>
    <div class="products row">
    <?php
		$conn = dbConnect('query');

    while ($row = $sqlresult->fetch_assoc()) {
			//this will loop through the table made by the left joins and spit out
      //the info needed
      //print_r($sqlresult);
			//echo $row['prod_id'];
			$prodimg_id = $row['prod_id'];

			$imgSql = "SELECT *
							FROM prod_img_lookup, images
							WHERE prod_img_lookup.prod_id = $prodimg_id
							AND prod_img_lookup.img_id = images.img_id";
//			$imgresult = $conn->query($imgSql) or die(mysqli_error());

				$imgProd = mysqli_fetch_array($conn->query($imgSql));
				$imgProd = $imgProd['img'];
			//	$dimension = str_replace("|.||.|", '"',  $row['dimension']);
				$dimension = "";

				echo '<div class="col-md-4 col-sm-12">';
					//image
					echo '<a href="product_detail.php?prod_id='.$row['prod_id'].' "><img  src="images/products/' .$imgProd. '" class="img-responsive" /></a>';
					echo '<h4><a href="product_detail.php?prod_id='.$row['prod_id'].' ">'.strtoupper($row['prod_name']).'</h4>';
					echo '<div class="specs">';
						echo '<span class="spec" id="psize"><h5>Product description</h5><p>'. $dimension.'</p></span>';
					echo '</div></a>';
				echo '</div>';
				} //end of the while loop

				//now that we are finished with the sqlresults set, release the db resources to allow a new query.
				$sqlresult->free_result();

				//now that we're done, we want to close our database connection.  call the dbClose() connection function
				dbClose($conn);
?>

<?php //echo $pagination;?>

</section>

<section>
  <div class="container">
    <div class="policies row">
      <div class="col-md-4 col-sm-12"><i class="fas fa-plane"></i><br/>Free Shipping</div>
      <div class="col-md-4 col-sm-12"><i class="far fa-clock"></i><br/>30-Days Size Exchange</div>
      <div class="col-md-4 col-sm-12"><i class="far fa-life-ring"></i><br/>Lifetime Warranty</div>
    </div>
  </div>
</section>

<?php include('includes/footer.php');?>


</main>
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
    </script>
</body>
</html>
