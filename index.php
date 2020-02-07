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
<!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.2/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"-->
<!-- Bootstrap core CSS -->
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
  <main>
    <section id="choose-a-side" class="parallax">
        <div class="d-flex flex-row col-sm-6 design side">
          <div class="content text-right w-100 d-flex">
            <h2 class="title align-self-center"><a href="portfolio.php#design">Design</a></h2>
          </div>
        </div>
        <div class="d-flex flex-row col-sm-6 development side">
          <div class="content w-100 d-flex">
            <h2 class="title text-left align-self-center"><a href="portfolio.php#development">Dev&shye­­l&shyop&shyment</a></h2>
          </div>
        </div>
        <button value="home-port" class="scrollDown"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
    </section>


    <!--section id="home-testimonials" class="parallax">
            <div class=" testimonials-wrap">
              <div class="blurb text-center">
                <a href="studies/lucgrey.php"><span class="title">Featured Project</span></a>

                <h2 class="">Branding Studies - LucGrey</h2>
                <a href="studies/lucgrey.php"><img src="images/portfolio/lucgrey/lucgrey_logo.png" alt="LucGrey Logo" class="responsive"></a>
                <a href="studies/lucgrey.php" class="btn btn-port"><i class="glyphicon glyphicon-heart"></i> View More</a>
              </div>

              </div>
            </div>
    </section-->
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
                <a href="testimonials.php"><h2 class="title">Testimonials</h2></a>
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
                <h2 class="title">Design Freedom</h2>
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

    <section>

      <div class="container icons">
        <div class="row">


          <div class="col-lg-4 col-sm-12 text-center">
            <div class="bubble">
            	<a href="about.php"><span aria-hidden="true" class="fab fa-ello"></span></a>
        	 </div>
            <h3>Who is 3BirdsMedia?</h3>
            <p class="lead">Read about Marco Segura the man behind the code, the graphics and the experience.
              <span aria-hidden="true" class="glyphicon glyphicon-sunglasses"></span></p>
          </div>

          <div class="col-lg-4 col-sm-12 text-center">
            <div class="bubble">
            	<a href="portfolio.php"><span aria-hidden="true" class="fas fa-briefcase"></span></a>
        	</div>
            <h3>The Portfolio</h3>
            <p class="lead">Take a look at my latest and not so latest projects, and the reasoning behind.</p>
          </div>

          <div class="col-lg-4 col-sm-12 text-center">
            <div class="bubble">
            	<a href="contact.php"><span aria-hidden="true" class="fas fa-heart"></span></a>
        	</div>
            <h3>Contact Me</h3>
            <p class="lead">Drop a line or two, get in contact, and lets talk about your projects...<br>did I mention free consultation?</p>
          </div>

        </div><!-- /.container -->
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
  </main>
  <?php
   include('includes/footer.php')
  ?>
  </div>
  <script>
    $('button.scrollDown').click(function(){
      document.getElementById('home-port').scrollIntoView({ behavior: 'smooth' });
    });
  </script>
 </body>
</html>
