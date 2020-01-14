<?php ini_set('display_errors',1);
 error_reporting(E_ALL);
 include('includes/functions.php');

//print_r($_POST);
if(isset($_POST['submit'])) {
      if(isset($_POST['name'])){$name = $_POST['name'];}
      if(isset($_POST['email'])){$email = $_POST['email'];}
      if(isset($_POST['comments'])){$comments = $_POST['comments'];}
      $error = '';
//Check to make sure comments were entered
        if(trim($_POST['comments']) == '') {
          $hasError = true;
          $error = "Please send us a message";
        } else {
          if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
          } else {
            $comments = trim($_POST['comments']);
          }
        }

      //Check to make sure that the name field is not empty
        if(trim($_POST['name']) == '') {
          $hasError = true;
          $error = "Please fill in your name";
        } else {
          $name = trim($_POST['name']);
        }


       if(validEmail($email) == false){ $error = "Please give me a valid email adress";$hasError = true;}else{}



        //If there is no error, send the email
        if(!isset($hasError)) {
          $to = "marco@3birdsmedia.com";
          $subject = "You've got a message from your site";


            $msg =  "<h2>You have received an inquiry from the website</h2> \n
                \n <h3>Name:</h3>\n  ".$name.
                "\n <h3>Email:</h3>\n  ".$email.
                "\n <h3>Decription:</h3>\n  ".$comments;

      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      // send it
      $mailSent = mail('marco.segura@live.com', $subject, '<html>'.$msg.'</html>', $headers);
      $mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      $emailSent = true;

  }
}
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
	<section id="contact" class="sec-parallax">
              <h1 class="title">Contact Me</h1>
	</section>
  <section class="contactBody" >
          <div class="container">
            <div class="row">
              <div class="col-md-4 contact-img">
                <img class="responsive circle" src="images/about.jpg" />
              </div>
              <div class="col-md-8">
                <h3>Let's Keep It Simple!</h3>

                <?php
                    if(isset($error) && $error !== ''){echo "<div id='msg' class='contMsg alert-danger'>$error</div>";
                    }elseif(isset($emailSent) && $emailSent == true){
                        echo "<div id='msg'  class='contMsg alert-success'>Your message has been sent, I will contact you as soon as possible</div>";
                    }else{
                        echo "<div id='msg' class='contMsg'>If you would like to contact me or give me feedback, feel free to email me at <a href='mailto:marco@3birdsmedia.com' title='Email me'>marco@3birdsmedia.com</a> or use the form below. </div>";
                    }
                ?>

               <form action="#contact" method="post" id='contactForm' name='contactForm' class="form-horizontal" role="form" >
                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="name">*Name:</label>
                              <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control required" placeholder="Full Name"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">*Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control required email" id="email" name="email" placeholder="name@email.com">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="comments" class="col-sm-2 control-label">*Message:</label>
                               <div class="col-sm-10">
                                  <textarea id="comments" name="comments" class="form-control required" ></textarea>
                               </div>
                            </div>
                            <div class="form-group">
                              <input type="submit" name="submit" id="submit" class="btn btn-default pull-right" value="send"/>
                            </div>


                            </form>
                </div>
              </div>
            </div>

          </section>


<footer>
          <div class="col-md-4">
            <a class="navbar-brand" href="index.php">3birdsmedia</a>
          </div>

          <div class="col-md-3 text-center copyright">
            <p>3BirdsMedia - Copyright &copy; 2011 - 2015</p>
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
