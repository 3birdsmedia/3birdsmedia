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
    <section id="mission">
      <div class="row">
        <!--div class="mission-wrap col-sm-12 col-md-6 col-lg-4">
          <h2>Our<br/> Mission</h2>
        </div-->
        <div class="col-sm-12 ">
          <div class="mission-quote">
            We are fixing a few things<br/>
            Come back soon to see what has changed!
          </div>
            <div class="verse">Questions? <a href="mailto:Revlove@Revlovellc.com">Contact Us</a></div>
        </div>
      </div>

    </section>
    <!--section id="about">
      <div class="row">
        <div class="about-wrap col-sm-12 col-md-6 col-lg-4">
          <h2>What is<br/> <span class="rev-logo-inline">REV<strong>LOVE</strong></span></h2>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-8">
          <div class="about-quote">
            <iframe src="https://player.vimeo.com/video/229332642" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

          </div>
        </div>
      </div>

    </section>
    <section id="services">
      <div class="row">
        <div class="col-sm-12">
          <h2>Services</h2>
        </div>
        <div class="offset-sm-1 col-sm-10">
          <div class="services-carousel">
                      
            <div> 
              <div class="serv-icon" ><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
              <h3>Diakonos</h3>
            </div>

            <div> 
              <div class="serv-icon" ><i class="fa fa-user-circle" aria-hidden="true"></i></div>
              <h3>Kainos</h3>
            </div>
           
            <div> 
              <div class="serv-icon" ><i class="fa fa-users" aria-hidden="true"></i></div>
              <h3>Concierge</h3>
            </div>

            <div> 
              <div class="serv-icon" ><i class="fa fa-repeat" aria-hidden="true"></i></div>
              <h3>Revenue Cycle Management</h3>
            </div>

          
            <div> 
              <div class="serv-icon" ><i class="fa fa-home" aria-hidden="true"></i></div>
              <h3>Portfolio Real Estate</h3>
            </div>
 
            <div> 
              <div class="serv-icon" ><i class="fa fa-lock" aria-hidden="true"></i></div>
              <h3>Asset Protection</h3>
            </div>

           
            <div> 
              <div class="serv-icon" ><i class="fa fa-paint-brush" aria-hidden="true"></i></div>
              <h3>Brand Enrichment</h3>
            </div>
            <div> 
              <div class="serv-icon" ><i class="fa fa-usd" aria-hidden="true"></i></div>
              <h3>Tax Offset Strategies</h3>
            </div>
            
            <div> 
              <a href="resources/bookkeeping.php" title="Bookkeeping"><div class="serv-icon" ><img class="" src="images/logo-quickbooks.svg" width="60" height="60" alt="Quickbooks Logo"></div></a>
              <h3><a href="resources/bookkeeping.php" title="Bookkeeping">Bookkeeping</a></h3>
            </div>

          </div>
        </div>
      </div>
        <div class="offset-sm-1 col-sm-10 blurb" >
          <p>Your team at RevLove will lock arms with you to create a customized Stewardsihp Schedule that incorporates asset protection planning, tax offset strategies, cash flow analytics, gracious giving, and tax-free transfers. As a member of RevLove, you will have direct access to the highest caliber legal, tax and fulfillment leaders in the industry. You will be empowered by the deeply meaningful understanding of stewardship in your life and have a corresponding plan that aligns perfectly with that understanding.</p>
        </div>

    </section>
    <section id="tribe">
      <div class="row">
        <div class="col-sm-12 offset-md-1 col-md-3 blurb"><h2>Get to Know the Tribe</h2></div>
        <div class="col-sm-12 col-md-7"><img src="images/comingsoon.jpg" alt="Coming Soon" class="img-responsive"></div>
      </div>
    </section>
    <section id="resources">
      <div class="row">
        <div class="col-sm-12">
          <h2>Resources</h2> <a class="view-more" href="resources.php">view more >></a>
        </div>
        <div class="container">
          <div class="row">
           <style id="badge-styles">
           /* You can modify these CSS styles */
           #badge { width: 100% }
           .vimeoBadge { margin: 0; padding: 0; }
           .vimeoBadge img { border: 0; }
           .vimeoBadge a, .vimeoBadge a:link, .vimeoBadge a:visited, .vimeoBadge a:active { color: #777; text-decoration: none; cursor: pointer; }
           .vimeoBadge a:hover { color:#31c0cc; }
           .vimeoBadge #vimeo_badge_logo { margin-top:10px; width: 57px; height: 16px; }
           .vimeoBadge .credit { font: normal 11px verdana,sans-serif; }
           .vimeoBadge .clip { padding:0; float:left; margin:0 10px 10px 0; line-height:1; }
           .vimeoBadge.vertical .clip { float: none; }
           .vimeoBadge .caption { font-family:inherit;font-size:1em; text-transform:uppercase;overflow:hidden; width: auto; height: 30px; }
           .vimeoBadge .clear { display: block; clear: both; visibility: hidden; }
           .vimeoBadge .s160 { width: 160px; } .vimeoBadge .s80 { width: 80px; } .vimeoBadge .s100 { width: 100px; } .vimeoBadge .s200 { width: 32%; }
           </style><div id="badge">
          <div class="vimeoBadge horizontal">
          <script src="https://vimeo.com/apokaradokia/badgeo/?script=1&badge_layout=horizontal&badge_quantity=3&badge_size=200&badge_stream=album&show_titles=yes&badge_album=4814015"></script>
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