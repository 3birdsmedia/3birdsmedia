<?php
include('includes/functions.php');
#HEADER INCLUDES METAS AND NAVIGATION
include('includes/header.php');
?>

  <section id="slideshow">
    
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
         <div class="slider">
              <div><img src="images/slideshow/armoroflight-kovenant.jpg" alt="Turntable" width="100%" /></div>
              <div><img src="images/slideshow/urbanmeetsrock-kovenant.jpg" alt="Turntable" width="100%" /></div>
          </div>
      </div> 
  </section>

  <section id="action">
      <div class="row no-gutters">
        <!-- CATALOG -->
        <div class="col-md-12 col-lg-4 catalog">
          <a class="icon-wrapper" href="catalog/index.php">
            <div class="icon"><img src="images/action/action-03.svg" /></div>
            <div class="title">Catalog</div>
            <div class="quote">Check out our latest lines and vote for your favorites!</div>
          </a>
        </div>

        <!-- ABOUT -->
        <div class="col-md-12 col-lg-4 about">
          <a class="icon-wrapper" href="about.php" title="About the Company">
            <div class="icon"><img src="images/action/action-01.svg" /></div>
            <div class="title">About</div>
            <div class="quote">Get to know the company and heart behind Kovenant</div>
          </a>
        </div>

        <!-- CONTACT -->
        <div class="col-md-12 col-lg-4 contact">
          <a class="icon-wrapper" href="contact.php">
            <div class="icon"><img src="images/action/action-02.svg" /></div>
            <div class="title">Contact</div>
            <div class="quote">Drop us a line, give us feedback and get involved</div>
          </a>
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
</body></html>