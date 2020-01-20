<?php
session_start();
ob_start();

include ('functions.php');

$busterOn = true;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php googleAnalytics("UA-48260012-6"); ?>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">
  <link rel="mask-icon" href="../images/safari-pinned-tab.svg" color="#00aaff">
  <link rel="shortcut icon" href="../images/favicon.ico">
  <meta name="msapplication-TileColor" content="#00aba9">
  <meta name="msapplication-config" content="images/browserconfig.xml">
  <meta name="theme-color" content="#00aaff">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/favicon/favicon.ico">

  <title>Banded Glory, LLC <?php echo "&#8212; {$title}"; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../css/site.css<?php echo $buster; ?>" rel="stylesheet">
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
      <?php include('../includes/navBar.php');?>

    </div>

  </header>
  <section id="secondary" class="parallax">
    <div class="" id="secondary">
      <h2>Designed for Comfort & Built to Last</h2>
    </div><!-- /.container -->
  </section>

  <section class="cont">
    <h2 >Shopping Cart</h2>

<?php

//FOR TROUBLESHOOTING for when need to clear the session
    unset($_SESSION['cart']);
                unset($_SESSION['total_price']);
                unset($_SESSION['items']);
                unset($_SESSION['conf_msg']);
    echo "<h3>Your Cart Has Been Emptied</h3>";
    echo '<h3><a href="../products.php">Keep on shopping</a></h3>';
                echo '<h3><a href="../index.php">Back to Banded Glory Home</a></h3>';



?>
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

<?php include('../includes/footer.php');?>


</main>
<script type="text/javascript">

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
