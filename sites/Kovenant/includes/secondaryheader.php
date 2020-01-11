<?php
function activeNav($page){
//pulls out the meta data of the serever giving out the file name.
  $currentPage = basename($_SERVER['SCRIPT_NAME']); 
  if ($currentPage == $page.'.php'){ echo 'activePage';} 
} 
$busterOn = true;
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113295690-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113295690-1');
</script>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="apple-touch-icon" sizes="57x57" href="../images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="manifest" href="../images/manifest.json">
    <meta name="msapplication-TileColor" content="#9500ff">
    <meta name="msapplication-TileImage" content="../images/ms-icon-144x144.png">
    <meta name="theme-color" content="#9500ff">



    <script src="https://use.fontawesome.com/9ca8685ba7.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon/favicon.ico">

    <title>Kovenant Clothing - <?php echo setSectionName();?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../slick/slick.css<?php echo $buster; ?>"/>
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css<?php echo $buster; ?>"/>

<!-- Animation library -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/site.css<?php echo $buster; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  </head>

  <body data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto col-12">
          <li class="nav-item col-4 hidden-lg-up">
            <a class="nav-link brand" href="#home">KOVENANT</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="catalog/index.php">Catalog</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="about.php">About</a>
          </li>

          <li class="nav-item col-4 hidden-md-down">
            <a class="nav-link brand" href="#home"><span class="kov-logo-header">KOVENANT</strong></span></a>
          </li>

          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="blog.php">Blog</a>
          </li>

          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </nav>