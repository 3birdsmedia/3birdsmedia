<?php
include('includes/functions.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
     
       
//print_r($_POST);
if(isset($_POST['submit'])) {
      if(isset($_POST['name'])){$name = $_POST['name'];}
      if(isset($_POST['email'])){$email = $_POST['email'];}
      if(isset($_POST['email'])){$email = $_POST['email'];}
      if(isset($_POST['comments'])){$comments = $_POST['comments'];}
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
        //echo "<h1> EMAIL SENT</h1>";
          $to = "marco@revlovellc.com";
          $subject = "You've got a message from a Kovenant user";
      
      
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

#HEADER INCLUDES METAS AND NAVIGATION
include('includes/header.php');
?>


  <section id="header" class="contact-header">
        <h1>Contact <span class="slash">/</span></h1>
  </section>

  <section id="contact" class="content">
      <div class="contact">
      <!--  -->
      <div class="row">
        <div class="container">
            <div class="row">
                <h2 class="col-sm-12 ">- Contact Us -</h2>
            
                <div class="col-sm-12 col-lg-6 contact-form">
                  <?php
                    if(isset($error) && $error !== ''){
                      echo "<div id='msg' class='contMsg alert-danger'>$error</div>";
                    }elseif(isset($emailSent) && $emailSent == true){
                      echo "<div id='msg'  class='contMsg alert-success'>Your message has been sent, I will contact you as soon as possible</div>"; 
                    }else{
                      echo "<div id='msg' class='contMsg'>Send us a note and we will get back to you as soon as possible! </div>";
                    }
                  ?>
                  <form action="#contact" method="post" id='contactForm' name='contactForm' class="form-horizontal" role="form" > 
                      <input type="text" name="name" placeholder="*First & Last Name"  required="required" />
                      <input type="text" name="email" placeholder="*Valid Email" required="required" />
                      <input type="phone" name="phone" placeholder="Phone">
                      <textarea type="text-area" name="comments" placeholder="Message"></textarea>
                      <div class="g-recaptcha" data-sitekey="6Lf_HTUUAAAAAHLFYB35WnquG09_Yh0uaysI2XmP" style="width: 302px; margin:0 auto 10px;"></div>
                      <input type="submit" value="Send" name="submit" class="btn btn-branded">
                  </form>
                </div>

                <div class="col-sm-12 col-lg-6 contact-form">
                    <!-- Begin Constant Contact Inline Form Code -->
                      <div class="ctct-inline-form" data-form-id="e85a315a-ef85-4305-b24c-dc81db7e9872"></div>
                    <!-- End Constant Contact Inline Form Code -->
                </div>
        </div>
      </div>
  </section>

     <section id="mission">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="mission-quote">
            "The night is almost gone, and the day is near. Therefore let us lay aside the deeds of darkness and put on the <strong>armor of light.</strong>" 
            <h3> Romans 13:12 </h3>
          </div>
        </div>
      </div>

    </section> 

  <section id="footer">
    <div class="family">
      <h2>Apokaradokia - Family of Companies</h2>
    </div>
    <div class="container">
      <div class="box box1 apokaradokia"><a href="#intro"><div class="inner"> Apokaradokia</div></a></div>
      <div class="box box1 revlove"><a target="_blank" href="http://revlovellc.com/"><div class="inner"> RevLove</div></a></div>
      <div class="box box2 arrowofvictory"><a target="_blank" href="http://arrowofvictory.com/"><div class="inner"> Arrow</div></a></div>
      <div class="box box3 firmfoundation"><a target="_blank" href="http://firmfoundation-llc.com/"><div class="inner"> Foundation</div></a></div>
      <div class="box box4 kovenant"><a target="_blank" href="http://kovenantclothing.com/"><div class="inner"> Kovenant</div></a></div>
      <div class="box  box5 stewardship"><a target="_blank" href="http://www.stewardship-llc.com/"><div class="inner"> Stewardship</div></a></div>  
      <div class="box  box6 revolution"><a target="_blank" href="http://revolutionoflovellc.com/"><div class="inner"> Revolution of Love</div></a></div>  
    </div>
    <div class="container">
      <a href="https://www.facebook.com/Apokaradokia-510663765959355/" target="_blank" class="btn fb_btn">Follow us on <i class="fa fa-facebook-square" aria-hidden="true"></i></a>
    </div>
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
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

    
    <script type="text/javascript">
    $(document).ready(function(){
      $('.slider').bxSlider({
        adaptiveHeight: true,
        mode: 'fade',
        pager: false,
        preloadImages: 'all'
      });
    });
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
</body>

<!-- Begin Constant Contact Active Forms -->
<script> var _ctct_m = "46c44bc9202b63619944d67f9cb270fa"; </script>
<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>
<!-- End Constant Contact Active Forms -->
</html>