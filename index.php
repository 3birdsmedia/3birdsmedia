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

<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"  media="screen">
<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Josefin+Slab:400,700,100' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css"  media="screen" />
</head>


<body>
<main class="wrapper">
<div class="updating">
  <p>I'm cooking up some new things, until then you might encouter some quirks, no worries you can still reach me <a href="contact.php">here!</a></p>
  <button class="dismiss">DISMISS</button>
</div>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">3birdsmedia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="portfolio.php">Portfolio</a></li>
            <li class=""><a href="about.php">Resume</a></li>
            <li class=""><a href="contact.php">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  <section id="home-testimonials" class="parallax">
          <div class=" testimonials-wrap">
            <div class="blurb text-center">
              <a href="studies/lucgrey.php"><span class="title">Featured Project</span></a>

              <h2 class="">Branding Studies - LucGrey</h2>
              <a href="studies/lucgrey.php"><img src="images/portfolio/lucgrey/lucgrey_logo.png" alt="LucGrey Logo" class="responsive"></a>
              <a href="studies/lucgrey.php" class="btn btn-port"><i class="glyphicon glyphicon-heart"></i> View More</a>
            </div>

            </div>
          </div>
  </section>
	<section id="home-port" class="parallax">
          <div class="hp-wrap port-wrap">
            <div class="blurb text-center">
              <a href="portfolio.php"><span class="title">My Work</span></a>
              <p>One of my goals is to help small and large businesses achieve branding standards that suit their personalities.</p>
              <a href="portfolio.php" class="btn "><i class="glyphicon glyphicon-eye-open"></i> Take a look</a>
            </div>
          </div>
  </section>
  <section id="home-testimonials" class="parallax">
          <div class=" testimonials-wrap">
            <div class="blurb text-center">
              <a href="testimonials.php"><span class="title">Testimonials</span></a>
              <p>Don't believe me? Here is some third party credibility.</p>
              <div class="row">
                <div class="col-md-4">
                  <img class="responsive circle" src="images/daphne.jpg">
                </div>
              <div class="col-md-4">
                  <img class="responsive circle" src="images/jessie.jpg">
                </div>
              <div class="col-md-4">
                  <img class="responsive circle" src="images/knotted.jpg">
                </div>
              </div>
              <a href="testimonials.php" class="btn btn-port"><i class="glyphicon glyphicon-bullhorn"></i> Read More</a>
            </div>
          </div>
  </section>
  <section id="home-quote" class="parallax">
         <div class="hp-wrap quote-wrap">
            <div class="blurb text-center">
              <span class="title">Design Freedom</span>
              <p>Is not doing whatever you want, but to push as far as the guidelines will let you.</p>
            </div>
          </div>
   </section>

          <!--div class="item ">
            <img src="images/services.jpg" alt="Blurred Painting/Laptop">
            <div class="carousel-caption">
              <span class="title">Services</span>
              <p>3birdsmedia is not just about websites, take a look at the services I offer.</p>
            </div>
          </div-->

    </div>
	</section>
  <section>

    <div class="container icons">


      <div class="col-lg-4 col-sm-12 text-center">
        <div class="bubble">
        	<a href="about.php"><span aria-hidden="true" class="glyphicon glyphicon-console"></span></a>
    	 </div>
        <h1>Who is 3BirdsMedia?</h1>
        <p class="lead">Read about Marco Segura the man behind the code, the graphics and the experience.
          <span aria-hidden="true" class="glyphicon glyphicon-sunglasses"></span></p>
      </div>

      <div class="col-lg-4 col-sm-12 text-center">
        <div class="bubble">
        	<a href="portfolio.php"><span aria-hidden="true" class="glyphicon glyphicon-briefcase"></span></a>
    	</div>
        <h1>The Portfolio</h1>
        <p class="lead">Take a look at my latest and not so latest projects, and the reasoning behind.</p>
      </div>

      <div class="col-lg-4 col-sm-12 text-center">
        <div class="bubble">
        	<a href="contact.php"><span aria-hidden="true" class="glyphicon glyphicon-heart"></span></a>
    	</div>
        <h1>Contact Me</h1>
        <p class="lead">Drop a line or two, get in contact, and lets talk about your projects...<br>did I mention free consultation?</p>
      </div>

    </div><!-- /.container -->

    </section>
    <!--section>
      <div class="container text-center">
        <p>Wanted to see all in a one page layout? Ok!</p>
        <button>
          Convert!
        </button>
      </div>
    </section-->
<footer>
          <div class="col-md-4">
            <a class="navbar-brand" href="index.php">3birdsmedia</a>
          </div>

          <div class="col-md-3 text-center copyright">
            <p>3BirdsMedia - Copyright &copy;
<?php setCopyright(2011); ?></p>
          </div>

          <div class="col-md-5">

            <ul class="nav navbar-nav">
              <li class=""><a href="portfolio.php">Portfolio</a></li>
              <li class=""><a href="about.php">About</a></li>
              <li class=""><a href="about.php">Resume</a></li>
              <li class=""><a href="testimonials.php">Testimonials</a></li>
              <li class=""><a href="contact.php">Contact</a></li>
            </ul>
          </div>
</footer>
</main>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
      // Activate Carousel
      $("#hp-car").carousel();
      //Set localstorage variable
      let notice = localStorage.Notice;
           if(notice){
              $(".updating").hide();
           }else{
              $(".updating").show();
           }

      $('.dismiss').click(function(){
          localStorage.setItem("Notice", "dismissed");
          $(".updating").hide();
        }
      );

    </script><noscript></noscript>

 </body>
</html>
