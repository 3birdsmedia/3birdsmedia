<?php
include('includes/functions.php');
$busterOn = true;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);



        
       
print_r($_POST);
if(isset($_POST['submit'])) {
    //  if(isset($_POST['name'])){$name = $_POST['name'];}
    //  if(isset($_POST['email'])){$email = $_POST['email'];}
    //  if(isset($_POST['phone'])){$phone = $_POST['phone'];}
   //   if(isset($_POST['comments'])){$comments = $_POST['comments'];}
      $error = '';
//Check to make sure comments were entered
   /*     if(trim($_POST['comments']) == '') {
          $hasError = true;
          $error = "Please send us a message";
        } else {
          if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
          } else {
            $comments = trim($_POST['comments']);
          }
        }   */  
      
        
        //echo "<h1> sending email</h1>";
      //Check to make sure that the name field is not empty
        if(trim($_POST['name']) == '') { 
          $hasError = true;
          $error = "Please fill in your name";
        } else {
          $name = trim($_POST['name']);
        }
        
        $email = test_input($_POST["email"]);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $hasError = true;
          $error = "Invalid email format";

        }
       
       //if(validEmail($email) == false){ $error = "Please give us a valid email adress";$hasError = true;}else{}


        
        //echo "<h1> sending email</h1>";
        //If there is no error, send the email
        if(!isset($hasError)) {
       // echo "<h1> EMAIL SENT</h1>";
          $to = "adminteam@revlovellc.com";
          $subject = "You've got a message from your site";
      
      
            $msg =  "<h2>You have received an inquiry from the website</h2> \n
                \n <h3>Name:</h3>\n  ".$name.
                "\n <h3>Email:</h3>\n  ".$email.
                "\n <h3>Phone:</h3>\n  ".$phone.
                "\n <h3>Decription:</h3>\n  ".$comments;         

          $headers =  'From: marketingteam@revlovellc.com' . "\r\n" .
                      'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                      'MIME-Version: 1.0' . "\r\n" .
                      'Reply-To: adminteam@revlovellc.com' . "\r\n" .
                      'X-Mailer: PHP/' . phpversion();
        // send it
      $mailSent = mail('marco@revlovellc.com', $subject, '<html>'.$msg.'</html>', $headers);
      $mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      //if (!$mailSent) {
      //    $errorMessage = error_get_last()['message'];
      //    echo "<h1>$errorMessage</h1>";
      //}

      $emailSent = true;

  }
}


?>
<?php include_once("includes/analyticstracking.php") ?>

<?php include("includes/header.php") ?>  
  
       <div class="embed-responsive embed-responsive-16by9 hidden-md-down">
        <iframe src="https://player.vimeo.com/video/227705095?autoplay=1&loop=1&title=0&byline=0&portrait=0&color=FAB414" width="640" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


      </div>  
    <div class="container" id="home">

      <div class="overlay">
      </div>

    </div><!-- /.container -->
    <section id="contact">
      <div class="container">

          <h2>Contact Us</h2>
        <div class="row">
        <div class="col-sm-12 text-center"><h3>Get in touch <strong>with us</strong></h3></div>
          <div class="col-sm-12 col-lg-6 sub">
              <p>RevLove LLC, the first ever faith-based tax preparation firm. Although, our goal as a firm is to be high-caliber professionals, delivering best in class quality to each of our clients, our mission is to be Kingdom-builders and vessels through which God can move His Kingdom forward.</p>
          </div>
          <div class="col-sm-12 col-lg-6 contact-form">
            <?php
              if(isset($error) && $error !== ''){echo "<div id='msg' class='contMsg alert-danger'>$error</div>";
              }elseif(isset($emailSent) && $emailSent == true){
                  echo "<div id='msg'  class='contMsg alert-success'>Your message has been sent, we will contact you as soon as possible</div>"; 
              }else{
                  echo "<div id='msg' class='contMsg'>Send us a note and we will get back to you as soon as possible! </div>";
                            }
            ?>
            <form action="#contact" method="post" id='contactForm' name='contactForm' class="form-horizontal" role="form" > 
              <input type="text" name="name" placeholder="*First & Last Name"  required="required" />
              <input type="text" name="email" placeholder="*Valid Email" required="required" />
              <input type="phone" name="phone" placeholder="Phone">
              <textarea type="text-area" name="comments" placeholder="Message"></textarea>
            <div class="g-recaptcha" data-sitekey="6LdqPUMUAAAAABaWngWG0TcsNRv_4rsPSz4ijMNo"></div>
            <input type="submit" value="Send" name="submit" class="btn btn-branded">
            </form>
          </div>
        </div>
      </div>
      
    </section>
    
   


<section id="footer">
      <h4>REVLOVE</h4>
      <div class="col-xs-12 text-right">
        <h5>AN <a href="http://www.apokaradokiallc.com/" style="color:#ee1e3a;font-weight: bold;">APOKARADOKIA</a> COMPANY </h5><br/>
</section>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript">
    //initiate animations
    AOS.init();

        var oWidth = $( ".overlay" ).width();
        var oHeigth = oWidth*0.5625;
        var vWidth = $( window ).width();
        $('.overlay').height(oHeigth);

        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.5625;
        $('.about-quote iframe').height(vimeoHeigth);
        
        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.5625;
        $('.vid-resource iframe').height(resrcHeigth);

    $(document).ready(function(){
        var oWidth = $( ".overlay" ).width();
        var oHeigth = oWidth*0.5625;
       
        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.5625;

        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.5625;

        $('.vid-resource iframe').animate({
          height: resrcHeigth
        }, 500);

        $('.about-quote iframe').animate({
          height: vimeoHeigth
        }, 500);

        $('.overlay').animate({
          height: oHeigth
        }, 500, function() {
              // Animation complete.
          if( vWidth <= 576) {
              var oVert = (oHeigth/2)-20;
          }else if( vWidth <= 1080) {
              var oVert = (oHeigth/2)-30;
          }else{
              var oVert = (oHeigth/2)-60;
          }

          $('.overlay h1').css('margin-top',(oVert));
        });
    $(window).resize(debouncer(function (e) {
        var oWidth = $( ".overlay" ).width();
        var oHeigth = oWidth*0.5625;
      
        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.5625;

        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.5625;

        $('.vid-resource iframe').animate({
          height: resrcHeigth
        }, 500);
        $('.about-quote iframe').animate({
          height: vimeoHeigth
        }, 500);
        $('.overlay').animate({
          height: oHeigth
        }, 500, function() {
          // Animation complete.
         // Animation complete.
          if( vWidth <= 576) {
              var oVert = (oHeigth/2)-20;
          }else if( vWidth <= 1080) {
              var oVert = (oHeigth/2)-30;
          }else{
              var oVert = (oHeigth/2)-60;
          }
          $('.overlay h1').css('margin-top',(oVert));
        
        });
       }));
      })

$(document).ready(function(){
  $('.services-carousel').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });
});

//--------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------PREVENT RESIZE TO FIRE UP MORE THAN ONE EVENT
//----------------------------------------------------------------------------------------------------------------------------------------------------
//just wrap funtion in this 
//    $(window).resize(debouncer(function (e) {
//        // do stuff 
//    }));
function debouncer(func, timeout) {
    var timeoutID, timeout = timeout || 500;
    return function () {
        var scope = this, args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function () {
            func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
    }
}// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
    </script>
</body></html>