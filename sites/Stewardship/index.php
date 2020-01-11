<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$busterOn = false;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}
include("includes/functions.php");
?>

<!DOCTYPE html>
<!-- saved from url=(0060)https://v4-alpha.getbootstrap.com/examples/starter-template/ -->
<html lang="en">
<head>

<?php googleAnalytics("UA-118674812-1"); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119261488-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-119261488-1');
</script>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#2dc0cc">
    <link rel="shortcut icon" href="images/favicon.ico">
<link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#9500ff">
<meta name="msapplication-TileColor" content="#9500ff">
<meta name="theme-color" content="#cccccc">

    <script src="https://use.fontawesome.com/9ca8685ba7.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon/favicon.ico">

    <title>Stewardship, LLC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slick/slick.css<?php echo $buster; ?>"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css<?php echo $buster; ?>"/>

<!-- Animation library -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/site.css<?php echo $buster; ?>" rel="stylesheet"><!-- Start of revlovellc Zendesk Widget script -->
<script>/*<![CDATA[*/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","a2485b9f-807d-4592-ae76-a2ff6cf845c4");/*]]>*/</script>
<!-- End of revlovellc Zendesk Widget script -->
  </head>


  <body data-spy="scroll" data-target=".navbar" data-offset="50">
 
  
       <div class="embed-responsive embed-responsive-16by9 hidden-md-down">
        <iframe src="https://player.vimeo.com/video/268139210?autoplay=1&loop=1&title=0&byline=0&portrait=0&color=333333&muted=1" width="100%" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

      </div>  
    <div class="container" id="home">
      <div class="overlay">
      </div>

    </div><!-- /.container -->
     <section id="mission">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="mission-quote">
            RE<STRONG>BUILDING</strong>
          </div>
          <H3>"By wisdom a house is built, and by understanding it is established;"<H3>
            <DIV class=""><H4>Proverbs 24:3</H4></DIV>
            <DIV class=""><H3>For inquiries please <a href="adminteam@Stewardship-llc.com">email us</a></H3></DIV>

        </div>
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
    <script type="text/javascript">
    //initiate animations
    AOS.init();

        var oWidth = $( ".overlay" ).width();
        var oHeigth = oWidth*0.4;
        var vWidth = $( window ).width();
        $('.overlay').height(oHeigth);

        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.4;
        $('.about-quote iframe').height(vimeoHeigth);
        
        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.4;
        $('.vid-resource iframe').height(resrcHeigth);

    $(document).ready(function(){
        var oWidth = $( ".overlay" ).width();
        var oHeigth = oWidth*0.4;
       
        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.4;

        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.4;

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
        var oHeigth = oWidth*0.4;
      
        var vimeoWidth = $( ".about-quote iframe" ).width();
        var vimeoHeigth = vimeoWidth*0.4;

        var resrcWidth = $( ".vid-resource iframe" ).width();
        var resrcHeigth = resrcWidth*0.4;

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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">

$(document).ready(function() {
// validate signup form on keyup and submit
  $("#register").validate({
    rules: {
      password: {
        required: true,
        minlength: 5
      },
      conf_password: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      email: {
        required: true,
        email: true
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      conf_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        equalTo: "Please enter the same password as above"
      },
      email: "Please enter a valid email address",
    }
  });

  // propose username by combining first- and lastname
  $("#username").focus(function() {
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    if(firstname && lastname && !this.value) {
      this.value = firstname + "." + lastname;
    }
  });

});
</script>
</body></html>