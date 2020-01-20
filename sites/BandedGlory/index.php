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

?>

<!DOCTYPE html>
<!-- saved from url=(0060)https://v4-alpha.getbootstrap.com/examples/starter-template/ -->
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
    <?php     if(isset($_SESSION['items'])){
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


<section id="hero" class="parallax">
    <div class="" id="home">
      <h2>Designed for Comfort & Built to Last</h2>
      <div class="overlay row">
        <div class="col-sm-12 col-md-4 col-lg-3"><img src="images/braided-teal.png" class="img-responsive"></div>
        <div class="col-sm-12 col-md-4 col-lg-6"><img src="images/stacked-blue.png" class="img-responsive"></div>
        <div class="col-sm-12 col-md-4 col-lg-3"><img src="images/womens-white.png" class="img-responsive"></div>
      </div>
      <a href="products.php" class="btn btn-primary"> SHOP NOW </a>
    </div><!-- /.container -->
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

<section class="whybandedglory">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12"><h2>Why You Should Wear A Banded Glory Silicone Wedding Ring</h2></div>
    </div>
    <div class="row text-center">
      <div class="col-sm-12 col-md-4">
        <img src="images/placeholder-left.jpg" alt="Ring being use to workout" class="img-responsive" />
      </div>
      <div class="col-sm-12 col-md-4 text-center">
        <ul>
          <li>Safe Wedding Ring</li>
          <li>Don't Lose Your Ring</li>
          <li>​Comfortable Alternative</li>
          <li>Safety First</li>
          <li>The Great Outdoors</li>
          <li>Pregnancy Hands</li>
        </ul>
      </div>
      <div class="col-sm-12 col-md-4">
        <img src="images/placeholder-right.jpg" alt="Ring being use by couple outdoors" class="img-responsive" />
      </div>
    </div>
  </div>
</section>


<section>
<a href="products.php">
    <img src="images/all-rings.jpg" alt="Link to store, picture of all rings" class="img-responsive">
</a>
			<?php
        // OPTIONAL PLACE TO USE A FUNCTION LIKE THIS
        //pullSingleProduct("topseller");
      ?>
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
