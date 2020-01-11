<?php

$busterOn = false;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}
?>
<!DOCTYPE html>
<!-- saved from url=(0060)https://v4-alpha.getbootstrap.com/examples/starter-template/ -->
<html lang="en"><head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115468648-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115468648-1');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="images/site.webmanifest">
  <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#2dc0cc">
  <link rel="shortcut icon" href="images/favicon.ico">
  <meta name="msapplication-TileColor" content="#2dc0cc">
  <meta name="msapplication-config" content="/images/browserconfig.xml">
  <meta name="theme-color" content="#333333">


    <script src="https://use.fontawesome.com/9ca8685ba7.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon/favicon.ico">

    <title>Arrow of Victory, LLC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
   
<!-- Animation library -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/site.css<?php echo $buster; ?>" rel="stylesheet">

  <link href="css/register.css<?php echo $buster; ?>" rel="stylesheet">
  </head>

  <body data-spy="scroll" data-target=".navbar" data-offset="50">
 
   <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto col-12">
          <li class="nav-item col-12 hidden-lg-up">
            <a class="nav-link brand" href="index.php"><span class="rev-logo-header">ARROW OF <strong>VICTORY</strong></span></a>
          </li>
          <li class="nav-item col-md-2 hidden-md-down">
            <a class="nav-link brand" href="index.php"><span class="rev-logo-header">ARROW OF <strong>VICTORY</strong></span></a>
          </li><!--
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="index.php">Dashboard</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="../contact.php">Contact Us</a>
          </li>-->
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="logout.php">logout</a>
          </li>
        </ul>
      </div>
    </nav>



