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
	<section id="testimonials" class="sec-parallax">
              <h1 class="title">Testimonials</h1>
  </section>
          <section>
          <div class="container testimonials">
            <div class="row">
              <div class="col-md-4">
                <img class="responsive circle" src="images/daphne.jpg" />
              </div>
              <div class="col-md-8">
                <h2>Daphne Valerius</h2>
                    <p class="lead">I've had the great pleasure of working with Marco and our experience has always been great! Marco always approaches every project with a strong level of integrity, pride and professionalism. To work with Marco is a nothing short of a blessing and your project is perfectly safe in his talented and capable hands, without a doubt!!</p>

                </div>
              </div>

            <div class="row">
              <div class="col-md-8">
                <h2>Jessie Arvizu</h2>
                    <p class="lead">Over the past few years, Marco has been amazing to work with. He has the ability to translate my ideas and execute them brilliantly. He is very talented and professional and delivers work on a timely basis and within budget. Its not only his skill that makes him stand out, but its his passion for what he does. I would highly recommend him to anyone who needs professional web programming.</p>

                </div>
              <div class="col-md-4">
                <img class="responsive circle" src="images/jessie.jpg" />
              </div>
              </div>

            <div class="row">
              <div class="col-md-4">
                <img class="responsive circle" src="images/knotted.jpg" />
              </div>
              <div class="col-md-8">
                <h2>Knotted Ribbon</h2>
                    <p class="lead">
                    As a designer with my own vision of what I wanted my site to look like, I was really apprehensive of working with a web designer. I had no doubt he would be able to develop it just fine but I wanted it to look exactly like what I had envisioned in my mind. However I also didn’t know what all went into that either. Marco at 3BirdsMedia really brought me down to Earth a little bit and took the time to walk me through the process of how he could make my vision a reality. There was a lot more involved than I ever imagined with creating original elements (I thought you could just take a photo off the internet and recreate it haha) and how much time it truly took to create (I thought a few hours was all that was needed – I was so unrealistic haha). Not only was he ethical and had integrity but he created a beautiful design that was even better than what I had asked for. He incorporated all the elements that my company represents and even assisted me with branding as well. The final website has received rave reviews by my clients and friends. Thank you Marco for being so fair, informative and ethical in your work  – I will be referring you to everyone I know!
                    </p>

                </div>
              </div>

            <div class="row">
              <div class="col-md-8">
                <h2>KS Photography</h2>
                    <p class="lead">I’ve worked with Marco in the past on a couple sites so I had every confidence in him to do this one as well. I wanted a super simple, clean design to go with the branding he created for me. I also needed it to be responsive since so many people are using their phones more and more. He delivered exactly what I wanted and in the exact timeline he put together for me. I love that all my social media sites connect to the website, one less thing for me to have to update. Also, anytime I have updated images to upload he does them the same day which I really appreciate. Next phase will be implementing a feature to allow me to upload my own images! Thank you Marco, once again you hit it out of the park. Great working with your positive and energetic personality again.</p>

                </div>
              <div class="col-md-4">
                <img class="responsive circle" src="images/ksphoto.jpg" />
              </div>
              </div>
            </div>
          <section>


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
              <li class="active"><a href="testimonials.php">Testimonials</a></li>
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
      $("#hp-car").carousel();      //Set localstorage variable
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
