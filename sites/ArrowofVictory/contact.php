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
  // process the script only if the form has been submitted
if(isset($_POST['submit'])) {
      $error = '';
        if(trim($_POST['name']) == '') { 
          $hasError = true;
          $error = "Please fill in your name";
        } else {
          $name = trim($_POST['name']);
        }
        
        $email = test_input($_POST["email"]);
        echo  $email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $hasError = true;
          $error = "Invalid email format";

        }

        if(isset($_POST['phone'])){$phone = $_POST['phone'];}
        if(isset($_POST['comments'])){$comments = $_POST['comments'];}

        //Check to make sure comments were entered
        if(trim($_POST['comments']) == '') {
          $hasError = true;
          $error = "Please tell us what your are messaging us about.";
        } else {
          if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
          } else {
            $comments = trim($_POST['comments']);
          }
        }

       //if(validEmail($email) == false){ $error = "Please give us a valid email adress";$hasError = true;}else{}

      //If there is no error, send the email
      if(!isset($hasError)) {
      $to = "ArrowOfVictory@ArrowOfVictory.com";
      $subject = "You've got a message from your site";
      $msg =  "<h2>You have received an inquiry from the website</h2> \n
                \n <h3>Name:</h3>\n  ".$name.
                "\n <h3>Email:</h3>\n  ".$email.
                "\n <h3>Phone:</h3>\n  ".$phone.
                "\n <h3>Decription:</h3>\n  ".$comments;         

      $headers =  'From: ArrowOfVictory@ArrowOfVictory' . "\r\n" .
                      'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                      'MIME-Version: 1.0' . "\r\n" .
                      'Reply-To: ArrowOfVictory@ArrowOfVictory' . "\r\n" .
                      'X-Mailer: PHP/' . phpversion();
      // send it
      $mailSent = mail('marco@revlovellc.com', $subject, '<html>'.$msg.'</html>', $headers);
      $mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      //if (!$mailSent) {
      //    $errorMessage = error_get_last()['message'];
      //    echo "<h1>$errorMessage</h1>";
      $emailSent = true;
  }
}elseif (array_key_exists('login_btn', $_POST)) {
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
      $error = 'Invalid username or password';
      }
      // if the session variable has been set, redirect
      if (isset($_SESSION['loggedin'])) {
      // get the time the session started
      $_SESSION['start'] = time();
      
          $_SESSION['member_id'] = $member_id;
          
          echo "<h1>$member_id</h1>";
          //Take us to 'my account'
          header("Location: cpanel/myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
        
      exit;
      }
    
    #############################
    #
    #   REGISTER
    #
    #############################
    
    }elseif(array_key_exists('register', $_POST)) {
      // start the session
      //    session_start();
      //  ob_start();  // need to buffer output - need this since adding logout via external file
      // clean the $_POST array and assign to shorter variables
     
      nukeMagicQuotes();
      
      //$username = strtolower(trim($_POST['username']));
      
      $randomNumber = rand(10,99);
      
      //$firstname = strtolower(trim($_POST['firstname']));
      //$lastname  = strtolower(trim($_POST['lastname']));
      $password  = strtolower(trim($_POST['password']));
      $conf_password  = strtolower(trim($_POST['conf_password']));
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
        //echo '<h2>false</h2>';
        /*
        $first = strtolower(trim($_POST['firstname']));
      $last  = strtolower(trim($_POST['lastname']));
      $password  = strtolower(trim($_POST['passwrord']));
      $last  = strtolower(trim($_POST['confirm_password']));
      $email = strtolower(trim($_POST['email']));
      $street = strtolower(trim($_POST['street']));
      $city = strtolower(trim($_POST['city']));
      $state = strtolower(trim($_POST['state']));
      if (isset($_POST['zip']) && is_numeric($_POST['zip']){
                                  $zip = strtolower(trim($_POST['zip']));
                                }else{
                                  $zip = 'error';
                                }
      member_fname  char(20)
      member_lname  char(20)
      street  char(40)
      city  char(40)
      state   char(20)
      zip   char(10)
      username  varchar(40)
      password  varchar(32)
      email                         
                                
                                
      */
        
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
              <td align='center' colspan='2' style='border-bottom:thin #ccc solid'><br/><h2>Welcome to the Apokaradokia Family</h2></td>
            </tr>
            <tr>
              <td style='color:#333'>Print this email as a friendly reminder of this important information. Thanks</td>
            </tr>
            
            <tr>
              <td style='color:#333'>
                Password: $password 
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
// Include Wordpress 
 define('WP_USE_THEMES', false);
 require('blog/wp-load.php');
 query_posts('showposts=15');


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
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Arrow of Victory Contact Us page">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon/favicon.ico">

    <title>Arrow of Victory, LLC - Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css<?php echo $buster; ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slick/slick.css<?php echo $buster; ?>"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css<?php echo $buster; ?>"/>

<!-- Animation library -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/site.css<?php echo $buster; ?>" rel="stylesheet">
    <style type="text/css">
      .embed-responsive {
        position: fixed;
      }
    </style>
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
            <a class="nav-link" href="index.php#mission">Why an LLC</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="services.php">Services/Pricing</a>
          </li>
          <li class="nav-item col-4 hidden-md-down">
            <a class="nav-link brand" href="index.php"><span class="rev-logo-header">ARROW OF <strong>VICTORY</strong></span></a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="index.php#blog">Blogs/Tips</a>
          </li>
          <li class="nav-item col-md-2 col-sm-12">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>



       <div class="embed-responsive embed-responsive-16by9 hidden-md-down">
        <iframe src="https://player.vimeo.com/video/239186887?autoplay=1&loop=1&title=0&byline=0&portrait=0&color=333333" width="100%" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

      </div>  
    <div class="container" id="home">
      <div class="overlay">
      </div>

    </div><!-- /.container -->
     <section id="mission">
        <div class="row ">
          <div class="container">
            <div class="col-sm-10 offset-1">
              <H2>GET IN TOUCH WITH US!</H2>

                <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 contact-form">
                  <?php
                  if(isset($error) && $error !== ''){
                    echo "<div id='msg' class='contMsg alert-danger'>$error</div>";
                  }elseif(isset($emailSent) && $emailSent == true){
                    echo "<div id='msg'  class='contMsg alert-success'>Your message has been sent, we will contact you as soon as possible</div>"; 
                  }else{
                    echo "<div id='msg' class='contMsg'>Send us a note and we will get back to you as soon as possible! <br/> or email <a href='mailto:arrowofvictory@arrowofvictory.com'>arrowofvictory@arrowofvictory.com</a></div>";
                    }
                  ?>
                    <form action="#contact" method="post" id='contactForm' name='contactForm' class="form-horizontal" role="form" > 
                        <input type="text" name="name" placeholder="*First & Last Name"  required="required" />
                        <input type="text" name="email" placeholder="*Valid Email" required="required" />
                        <input type="phone" name="phone" placeholder="Phone">
                        <textarea type="text-area" name="comments" placeholder="Message"></textarea>
                        <div class="g-recaptcha" data-sitekey="6LfEvEoUAAAAAO5AvnoHc4z-9NYfNxQS3Ym6D8ih"></div>
                        <span class="msg-error error"></span>
                        <input type="submit" value="Send" name="submit" class="btn btn-branded" id="send-sbmt">
                    </form>
                </div>
                </div> 

          </div>          
        </div>
      </div>
    </section>   

<section class="loginBar">
    <div class="row" id="cpanel">
<?php 
if(isset($_SESSION['loggedin'])){
  echo "<a class='btn add offset-sm-4 col-sm-4' href='cpanel/myaccount.php'>Return to myAOV</a>";
  
}else{
?>
        <div class="col-sm-12 col-md-6">
          <h2>New Member (Sign Up)</h2>
          <?php if(isset($error)){echo $error.'<br />';
                       echo md5($password).'<br />';
                       echo $savedPwd;
                        }
            
                    ?>
            
                <form action="" method="post" name="register" id="register" class="text-left">
                <fieldset>
                    <div class="control-group row">
                      <!-- Email -->
                      <label class="control-label col-sm-12 col-md-3"  for="username">*Email</label>
                      <div class="controls col-sm-12 col-md-9">
                        <input type="email" id="email" name="email" class="input-large" required="required" value="<?php if (isset($email)){echo $email;} else {echo "";} ?>" placeholder="email@domain.com" >
                      </div>
                    </div>

            
                    <div class="control-group row">
                      <!-- Password -->
                      <label class="control-label col-sm-12 col-md-3"  for="username">*Password</label>
                      <div class="controls col-sm-12 col-md-9">
                        <input type="password" id="password" name="password" class="input-large" required="required" placeholder="Password" >
                        <input type="password" id="conf_password" name="conf_password" placeholder="Confirm" class="input-large" required="required" >
                      </div>
                    </div>
                   <div class="control-group row">
                      <!-- Password -->
                      <label class="control-label col-sm-12 col-md-3"  for="">&nbsp;</label>
                      <div class="controls col-sm-12 col-md-9">
                          <input id="submit" type="submit" name="register" value="register" />
                        </div>
                      </div>
                  </form>
                </div><!--END OF LEFT CONT-->
        <div class="col-sm-12 col-md-6">
        <h2>Current Member (log In)</h2>         
            <?php if(isset($error)){echo '<h3 class="error">'.$error.'</h3><br />';
                        //echo md5($password).'<br />';
                        //echo $savedPwd;
                   }else{?>
            
            <?php } ?>  
          <form action="" method="post" enctype="multipart/form-data" id="login">
                   <div class="control-group row">
                      <!-- Password -->
                      <label class="control-label col-sm-12 col-md-3" for="username"> Username:</label>
                      <div class="controls col-sm-12 col-md-9">
                          <input name="username" placeholder="Username or Email" />
                    </div>
                  </div>
                  <div class="control-group row">
                    <label class="control-label col-sm-12 col-md-3" for="password"> Password:</label>
                    <div class="controls col-sm-12 col-md-9">
                        <input type="password" name="password" placeholder="Password" size="20" />
                    </div>
                  </div>
                   <div class="control-group row">
                      <!-- Password -->
                      <label class="control-label col-sm-12 col-md-3"  for="">&nbsp;</label>
                      <div class="controls col-sm-12 col-md-9">
                          <input id="login_btn" type="submit" name="login_btn" value="Login" /><br/>
                          <a href="mailto:arrowofvictory@arrowofvictory.com" title="Forgot my Password">Forgot your password?</a>
          
                        </div>
                      </div>
                  </form>
              </div>
       </div><!--END OF CONT-->
<?php 
};
?>
   </div><!--END OF CONT-->
    


</section>


    <section id="blog">
      <div class="row">
        <div class="col-sm-12">
          <h2>Blog/Tips</h2>
        </div>
        <div class="container">
          <div class="row">
              <?php $the_query = new WP_Query( 'posts_per_page=3' ); ?>
               
              <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
               
              <div class="col-sm-12 col-md-4">
                <a href="<?php the_permalink() ?>" class="tips-wrap">
                <?php if ( has_post_thumbnail()){
                        the_post_thumbnail('excerpt-thumb');
                      }else{
                       echo '<img width="500" height="500" src="images/default.png" class="attachment-excerpt-thumb size-excerpt-thumb wp-post-image" alt="">';
                     }; ?>
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
$('#contactForm').submit(function(e){
    e.preventDefault();
    var $captcha = $( '#recaptcha' ),
        response = grecaptcha.getResponse();
    
    if (response.length === 0) {
      $( '.msg-error').text( "reCAPTCHA is mandatory" );
      if( !$captcha.hasClass( "error" ) ){
        $captcha.addClass( "error" );
      }
    } else {
      $( '.msg-error' ).text('');
      $captcha.removeClass( "error" );
      //alert( 'reCAPTCHA marked' );
      $('#contactForm').submit(
      {
          submit: true
      });
    }
  });
});

</script>
</body></html>