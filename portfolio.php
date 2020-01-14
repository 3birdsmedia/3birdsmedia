<?php
include('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="This is the portfolio site for Marco Segura, the man behind 3BirdsMedia" />
<meta name="author" content="Marco Segura">
<meta name="keywords" content="orange county, design, graphic, development, 3birdsmedia, 3 birds media, marco segura, HTML, CSS, PHP, JS, MySQL, branding, logo" />
<title>3BirdsMedia - Design and Development Services</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css"  media="screen" />
</head>


<body>
  <div class="wrapper">
  <?php
    include('includes/header.php')
  ?>


<main class="cd-main-content">
  <section id="portfolio" class="sec-parallax">
              <h1 class="title">My Work</h1>
  </section>
    <div class="cd-tab-filter-wrapper">
      <div class="cd-tab-filter">
        <ul class="cd-filters">
          <li class="placeholder">
            <a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
          </li>
          <li class="filter"><a class="selected" href="#0" data-type="all">All</a></li>
          <li class="filter" data-filter=".design"><a href="#design" data-type="design">Designed</a></li>
          <li class="filter" data-filter=".developed"><a href="#0" data-type="developed">Developed</a></li>
          <li class="filter" data-filter=".responsive"><a href="#0" data-type="responsive">Responsive</a></li>
          <li class="filter" data-filter=".cms"><a href="#0" data-type="cms">CMS</a></li>
          <li class="filter" data-filter=".live"><a href="#0" data-type="live">Live</a></li>
          <li class="filter" data-filter=".latest"><a href="#0" data-type="latest">Latest</a></li>
          <li class="filter" data-filter=".db"><a href="#0" data-type="db">MySQL</a></li>
        </ul> <!-- cd-filters -->
      </div> <!-- cd-tab-filter -->
    </div> <!-- cd-tab-filter-wrapper -->

    <section class="cd-gallery">
      <ul>
        <li class="mix developed html css php latest responsive design live" data-load="daphne"><img src="images/portfolio/daphne-thumb.jpg" alt="Link to Daphnes section"></li>
        <li class="mix developed html css php latest  responsive design live" data-load="ksegura"><img src="images/portfolio/ksegura-thumb.jpg" alt="Link to KSegura Photograpy section"></li>
        <li class="mix developed html css php design" data-load="designpros"><img src="images/portfolio/designpros-thumb.jpg" alt="Link to Design Pros section"></li>
        <li class="mix developed html css php  db mysql cms" data-load="digiprint"><img src="images/portfolio/digiprint-thumb.jpg" alt="Link to Digiprint section"></li>
        <li class="mix developed html css php  latest responsive design live" data-load="jevans"><img src="images/portfolio/jevans-thumb.jpg" alt="Link to Jennifer Evants section"></li>
        <li class="mix developed html css php  design live" data-load="knotted"><img src="images/portfolio/knotted-thumb.jpg" alt="Link to Knotted Ribbon"></li>
        <li class="mix developed html css php   latest responsive design" data-load="midpath"><img src="images/portfolio/midpath-thumb.jpg" alt="Link to Midpath"></li>
        <li class="mix developed html css php  responsive design" data-load="nocostdrugs"><img src="images/portfolio/nocostdrugs-thumb.jpg" alt="Link to NoCostDrugs section"></li>
        <li class="mix developed html css php  db mysql wordpress cms live" data-load="pnp"><img src="images/portfolio/pnp-thumb.jpg" alt="Link to PNP section"></li>
        <li class="mix developed html css php  db mysql design cms" data-load="surtech"><img src="images/portfolio/surtech-thumb.jpg" alt="Link to Surtech section"></li>
        <li class="gap"></li>
        <li class="gap"></li>
        <li class="gap"></li>
      </ul>
      <div class="cd-fail-message">No results found</div>
    </section> <!-- cd-gallery -->

  </main> <!-- cd-main-content -->
  <?php
   include('includes/footer.php')
  ?>
  </div>
 </body>
</html>

    </script><noscript>If you dont have javascript enabled the slideshow, sorting, pop-up, etc, won't work</noscript>

 </body>
</html>
