<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file

error_reporting(E_ALL);
ini_set('display_errors', 1);

$busterOn = false;
if($busterOn !== false){
  $buster = rand (1,254);
  $buster = "?v=.$buster";
}else{
  $buster = "";
}

//if session variable not set, redirect to login page
//echo $_SESSION['location_id'];
include("includes/functions.php");
print_r($_SESSION);
print_r($_POST);
//if(isset($_SESSION['loggedin'])){
  //echo "<h1>$member_id</h1>";
  //Take us to 'my account'
  //header("Location: myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
  
//}else{
    // process the script only if the form has been submitted
    if (array_key_exists('login_btn', $_POST)) {
      // start the session
//      session_start();
//      ob_start();  // need to buffer output - need this since adding logout via external file
      // clean the $_POST array and assign to shorter variables
     
      nukeMagicQuotes();
      $username = strtolower(trim($_POST['username']));
      $password = trim($_POST['password']);

      // connect to the database as a restricted user
      $conn = dbConnect('query');   
      // get the username's details from the database

      if(stripos($username,'@') !== FALSE){
          $sql = "SELECT password, member_id FROM member WHERE email = ?";
        }else{
          $sql = "SELECT password, member_id FROM member WHERE username = ?";
      }
      // initialize and prepare locationment
      $stmt = $conn->stmt_init();
      if ($stmt->prepare($sql)) {
      // bind the input parameter
      $stmt->bind_param('s', $username);
      // bind the result, using a new variable for the password
      $stmt->bind_result($savedPwd, $member_id);
      $stmt->execute();
      $stmt->fetch();
      }
      // use the salt to encrypt the password entered in the form
      // and compare it with the stored version of the password
      // if they match, set the authenticated session variable 
      if (md5($password) == $savedPwd) {
      $_SESSION['loggedin'] = 'loggedin';
      }
      // if no match, destroy the session and prepare error message
      else {
      $_SESSION = array();
      session_destroy();
      $log_error = 'Invalid username or password';
      }
      // if the session variable has been set, redirect
      if (isset($_SESSION['loggedin'])) {
      // get the time the session started
      $_SESSION['start'] = time();
      
          $_SESSION['member_id'] = $member_id;
          
         // echo "<h1>$member_id</h1>";
          //Take us to 'my account'
          header("Location: cpanel/myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
        
      exit;
      }
    
    #############################
    #
    #   REGISTER
    #
    #############################
    
    }elseif (array_key_exists('register', $_POST)) {
      // start the session
      //    session_start();
      //  ob_start();  // need to buffer output - need this since adding logout via external file
      // clean the $_POST array and assign to shorter variables
     
      nukeMagicQuotes();
      
      //$username = strtolower(trim($_POST['username']));
      
      $randomNumber = rand(10,99);
      
      //$firstname = strtolower(trim($_POST['firstname']));
      //$lastname  = strtolower(trim($_POST['lastname']));
      $password  = trim($_POST['password']);
      $conf_password  = trim($_POST['conf_password']);
      $email = strtolower(trim($_POST['email']));
      //$street = strtolower(trim($_POST['street']));
      //$city = strtolower(trim($_POST['city']));
      //$state = strtolower(trim($_POST['state']));
      //if (isset($_POST['zip']) && is_numeric($_POST['zip'])){
      //                            $zip = strtolower(trim($_POST['zip']));
      //                          }else{
      //                            $zip = '5 digit Zipcode';
      //                          }
      
      $conn = dbConnect('query');
      $sql = "SELECT email FROM member
          WHERE member.email = ? LIMIT 1";
    
      $stmt = $conn->stmt_init();
      if ($stmt->prepare($sql)) {
      // bind the input parameter
      $stmt->bind_param('s', $email);
      // bind the result, using a new variable for the password
      $stmt->bind_result($strduser);
      $stmt->execute();
      $stmt->fetch();
      }
      
      if (isset($strduser) && ($strduser !== '')){
        //echo '<h2>true</h2>'.$strduser;

        $error = "<span class='error'>Sorry, this email is already in use!</span><br />
                  Please try a different email address";
      }elseif($password !== $conf_password){
        $error = "<span class='error'>Sorry, the passwords you entered don't match!</span>";
      }elseif($email == ''){
        $error = "<span class='error'>Please provide an email to create your account.</span>";
      }else{
        
        $conn = dbConnect('admin');
        //////////////////////////////////////////////////////////////////
        //create SQL to insert member information  -we are setting up a prepared statement
        $sql = 'INSERT INTO member (password, email)
            VALUES (?, ?)';
            
        //initialize prepared statement
        $stmt = $conn->stmt_init();
        if ($stmt->prepare($sql)) {
          //bind parameters and execute statement
          //NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
          $org_password = $password;
          $password = md5($password);
          $stmt->bind_param('ss', $password, $email);
          $OK = $stmt->execute(); //if statement executes, will set this flag to true
          // free the statement for the next query
          $stmt->free_result();
        
          $sql = "SELECT member_id FROM member
          WHERE member.email = ?
          ORDER BY member_id DESC LIMIT 1";
        
          $stmt = $conn->stmt_init();
          if ($stmt->prepare($sql)) {
          // bind the input parameter
          $stmt->bind_param('s', $email);
          // bind the result, using a new variable for the password
          $stmt->bind_result($member_id);
          $stmt->execute();
          $stmt->fetch();
          }
          $_SESSION['loggedin'] = 'loggedin';
          $_SESSION['member_id'] = $member_id;
          
          $subject = "Welcome to Arrow of Victory!";
$msg = "
<html>
  <body>
    <table align='center' width='600' style='font-family:Myriad Pro, Helvetica, Arial; color:#F00;border:thin #ccc solid' bordercolor='#ccc' cellpadding='0' cellspacing='10'>
      <tr>
              <td colspan='2' align='center'><img src='http://www.arrowofvictory.com/images/header.jpg' title='Header' width='600'/></td>
      </tr>
            <tr>
              <td align='center' colspan='2' style='border-bottom:thin #ccc solid; color:#777;'><br/><h2>Welcome to the Apokaradokia Family</h2></td>
            </tr>
            <tr>
              <td style='color:#333'>Print this email as a friendly reminder of this important information. Thanks<br/></td>
            </tr>
            
            <tr>
              <td style='color:#333'>
                Email: $email 
            </td>
            </tr>
            
            <tr>
              <td style='color:#333'>
                Password: $org_password 
            </td>
            </tr>
    </table>  
  </body>
</html>";

      //echo $msg;
        

      $headers =  'From: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
                  'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                  'MIME-Version: 1.0' . "\r\n" .
                  'Reply-To: ArrowOfVictory@arrowofvictory.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
        // send it
      $mailSent = mail($email, $subject, $msg, $headers);
      //$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      $emailSent = true;
          //echo "<h1>$member_id</h1>";
          //Take us to 'my account'
          header("Location: cpanel/register.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
        
      
        }
        
      }
    }
//}

// Include Wordpress 
 define('WP_USE_THEMES', false);
 require('blog/wp-load.php');
 query_posts('showposts=3');

?>

<!DOCTYPE html>
<!-- saved from url=(0060)https://v4-alpha.getbootstrap.com/examples/starter-template/ -->
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115468648-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115468648-1');
</script>
<!-- Global site tag (gtag.js) - Google AdWords: 807480324 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-807480324"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-807480324');
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#2dc0cc">
    <link rel="shortcut icon" href="images/favicon.ico">
    <meta name="msapplication-TileColor" content="#2dc0cc">
    <meta name="msapplication-config" content="/images/browserconfig.xml">
    <meta name="theme-color" content="#333333">


    <script src="https://use.fontawesome.com/9ca8685ba7.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon/favicon.ico">

    <title>Arrow of Victory, LLC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slick/slick.css<?php echo $buster; ?>"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css<?php echo $buster; ?>"/>

<!-- Animation library -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/site.css<?php echo $buster; ?>" rel="stylesheet">
    
  </head>

  <body data-spy="scroll" data-target=".navbar" data-offset="50">
 
   <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto col-12">
          <li class="nav-item col-12 hidden-lg-up">
            <a class="nav-link brand" href="index.phe"><span class="rev-logo-header">ARROW OF <strong>VICTORY</strong></span></a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="#mission">Why an LLC</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="services.php">Services/Pricing</a>
          </li>
          <li class="nav-item col-4 hidden-md-down">
            <a class="nav-link brand" href="index.php"><span class="rev-logo-header">ARROW OF <strong>VICTORY</strong></span></a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="#blog">Blogs/Tips</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>

    </div><!-- /.container -->
 


 <section id="services" class="main">
      <div class="row">
        <div class="col-sm-12">
          <h2>Services</h2>
        </div>
        <div class="offset-sm-1 col-sm-10 blurb" >
          <H2>Prosper and protect your business</H2>
          <p>Create your business's success by establishing it in an LLC. Arrow of Victory specializes in LLC and Registered Agent services. These services are unique to Arrow of Victory in that they are rooted in Christian values. We steward you through the birth of your business to its success. You'll find that Arrow of Victory is personal, extensive, and brilliant at prospering and protecting your family.</p>
        </div>
        <div class="container">
            <div class="services-carousel row">
              <div class="col-sm-12 col-md-4">
                <div class="serv-wrap"> 
                  <div class="serv-icon" ><i class="fa fa-building" aria-hidden="true"></i></div>
                  <h3>LLC Formation</h3>
                  <span class="price">$499.00 <em>+tax</em></span><br/>
                  <p class="text-left">
                    Enjoy the benefits of Wyoming's tax and corporate law, by creating a new entity through Arrow of Victory.
                  </p>

                <div class="row" id="cpanel">
                <?php 
                  if(isset($_SESSION['loggedin'])){
                  echo "<a class='btn add offset-sm-4 col-sm-4' href='cpanel/myaccount.php'>Return to myAOV</a>";

                  }else{
                ?>
                  <h3 class="col-sm-12">Create your free account!</h3>
                  <?php 
                  if(isset($error)){

                  echo '<p class="text-danger contMsg">'.$error.'</p><br />';
                  //echo md5($password).'<br />';
                  //echo $savedPwd;
                  }
                ?>
                  <form action="" method="post" name="register" id="register" class="text-left">
                    <fieldset>
                    <div class="control-group row">
                      <!-- Email -->
                      <div class="controls col-sm-12">
                        <input type="email" id="email" name="email" class="input-large" required="required" value="<?php if (isset($email)){echo $email;} else {echo "";} ?>" placeholder="email@domain.com" >
                      </div>
                    </div>
                    <div class="control-group row">
                    <!-- Password -->
                      <div class="controls col-sm-12">
                        <input type="password" id="password" name="password" class="input-large" required="required" placeholder="Password" >
                        <input type="password" id="conf_password" name="conf_password" placeholder="Confirm" class="input-large" required="required" >
                      </div>
                    </div>
                    <div class="control-group row">
                      <!-- Password -->
                      <div class="controls col-sm-12">
                        <input id="submit" type="submit" name="register" value="register" />
                      </div>
                    </div>
                  </form>
                </div><!--END OF LEFT CONT-->
                <?php 
                };
                ?>
                </div>
              </div>
             
              <div class="col-sm-12 col-md-4">
                <div class="serv-wrap"> 
                  <div class="serv-icon" ><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                  <h3>Registered Agent Services</h3>
                  <span class="price">$17.77 <em>+tax</em></span><br/>
                  <ul class="text-left">
                    <li>Annual Report: A yearly fee owed to the state to keep the entity active.</li>
                    <!--li>Financial Accounting: A monthly charge for Arrow of Victory to perform an accounting of the business P&amp;L</li-->
                    <li>E-Mail Forwarding: With an out of state LLC, your business will have a fixed address in that state. We will forward all letters so you can live where you wish.</li>
                  </ul>
                  <a class="btn" href="contact.php">Contact us</a>
                </div>
              </div>
             
              <div class="col-sm-12 col-md-4">
                <div class="serv-wrap"> 
                  <div class="serv-icon" ><i class="fa fa-file" aria-hidden="true"></i></div>
                  <h3>Foreign LLC Filing </h3>
                    <span class="price">CA | $120.00 <em>+tax</em></span><br/>
                    <span class="price">NC | $300.00 <em>+tax</em></span><br/>
                    <span class="price">TX | $900.00 <em>+tax</em></span><br/>
                  <p class="text-left">
                    A foreign filing designates that a business run out of one state, performs services in another state  
                  </p>
                  <a class="btn" href="contact.php">Contact us</a>
                </div>
              </div>

              <div class="col-sm-10 offset-sm-1">
                <div class="serv-wrap other-serv"> 
                  <div class="serv-icon" ><i class="fa fa-handshake-o" aria-hidden="true"></i></div>
                  <h3>Other Services </h3>
                  
                  <ul class="text-left">
                    <li>Annual Report: a yearly fee owed to the state to keep the entity active.<span class="price"> $99.00 <em>+tax</em></span></li>

                    <li>LLC Dissolution: dissolving an entity – no longer active, closed for business. <span class="price"> $149.99 <em>+tax</em></span></li> 
               
                    <li>Shipping: shipping items to or on behalf of a member/entity. <span class="price">Cost + 17%</span></li>

                    <li>Web Hosting: procuring a domain and associated email on a business or persons behalf. <span class="price">$17.77 <em>+tax</em> per user</span></li> 
                    
                    <li>Wyoming Sales Tax: Wyoming state sales tax (5%) <br/></li>
                  </ul>

                  <a class="btn" href="contact.php">Contact us</a>
                </div>
              </div>
             
            </div>
          </div>
        </div>

    </section>
    
<div class="row">
  

    <section id="mission" class="col-sm-12 col-md-6">
        <div class="row ">
          <div class="container">
            <div class="col-sm-10 offset-1">
              <H2>WHY AN LLC?<H2>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe src="https://player.vimeo.com/video/248201336" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>   
          </div>          
        </div>
      </div>
    </section> 
      <section id="blog" class="col-sm-12 col-md-6">
      <div class="row">
        <div class="col-sm-12">
          <h2>Featured</h2>
        </div>
        <div class="container">
          <div class="row">
              <?php $the_query = new WP_Query( 'posts_per_page=1' ); ?>
               
              <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
               
              <div class="col-sm-12 col-md-6 offset-sm-3">
                <a href="<?php the_permalink() ?>" class="tips-wrap">
                <?php if ( has_post_thumbnail()) the_post_thumbnail('excerpt-thumb'); ?>
                <!-- displays thumbnail if it exists -->
                  <div class="tips-title">
                    <?php the_title(); ?>
                  </div>
                </a>
              </div>
               
              <?php 
              endwhile;
              wp_reset_postdata();
              ?>
          </div>
        </div>
      
      </div>
    </section>  


</div>


<?php include('includes/footer.php');?>

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