<?php
include("includes/functions.php");

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
<html lang="en">
<head>
<?php include_once("includes/analyticstracking.php") ?>

<?php include("includes/header.php") ?>  
  
       <div class="embed-responsive embed-responsive-16by9 hidden-md-down">
        <iframe src="https://player.vimeo.com/video/227705095?autoplay=1&loop=1&title=0&byline=0&portrait=0&color=FAB414" width="640" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


      </div>  
    <div class="container" id="home">

      <div class="overlay">
      </div>

    </div><!-- /.container -->

    <section id="resources">
      <div class="row">
        <div class="col-sm-12">
          <h2>Financials</h2>


        <div class="container">
          <div class="row">
            
            <div class="col-sm-12 ">
              <div class="mission-quote">
                <h2>Coming Soon</h2>

                <!-- BEGIN: Constant Contact Email List Form Button -->
                <div align="center">
                <a href="https://visitor.r20.constantcontact.com/d.jsp?llr=jolwu7zab&amp;p=oi&amp;m=1127316401609&amp;sit=v6gqqdklb&amp;f=62bc5004-6799-4118-aa62-0f2eaeadfca2" class="button" style="background-color: rgb(255, 255, 255); border: 0px solid rgb(91, 91, 91); color: #31c0cc; display: inline-block; padding: 0.5EM 1EM; text-shadow: none; border-radius: 10px;font-size: 1.5em; margin-bottom: 20px;">SIGN UP FOR UPDATES</a>
                <!-- BEGIN: Email Marketing you can trust -->


                </div>
              </div>
            </div>

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