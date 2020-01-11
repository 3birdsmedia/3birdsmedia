<?php
session_start();
ob_start();  // need to buffer output - need this since adding logout via external file
//if session variable not set, redirect to login page
//echo $_SESSION['location_id'];
//print_r($_SESSION);
//print_r($_POST);

include("includes/functions.php");
//print_r($_SESSION);         

 if (!isset($_SESSION['loggedin'])) {
  header('Location: index.php');
  exit;
 }else{

if (array_key_exists('register', $_POST)) {
  
      // clean the $_POST array and assign to shorter variables
      nukeMagicQuotes();
      
      $username = strtolower(trim($_POST['username']));
      
      $randomNumber = rand(10,99);
      
      $firstname = ucfirst(strtolower(trim($_POST['fname'])));
      $lastname  = ucfirst(strtolower(trim($_POST['lname'])));
      $phone  = formatPhone($_POST['phone']);
      $street = ucfirst(strtolower(trim($_POST['street'])));
      $city = ucfirst(strtolower(trim($_POST['city'])));
      $state = ucwords(strtolower(trim($_POST['state'])));
      if (isset($_POST['zip']) && is_numeric($_POST['zip'])){
                                  $zip = strtolower(trim($_POST['zip']));
                                }else{
                                  $error = '5 digit Zipcode';
                                }
      
      $referral = strtolower(trim($_POST['referral']));
      $referred_by = ucfirst(strtolower(trim($_POST['referred_by'])));

      $conn = dbConnect('query');
      $sql = "SELECT username FROM member
          WHERE member.username = ? LIMIT 1";
    
      $stmt = $conn->stmt_init();
      if ($stmt->prepare($sql)) {
      // bind the input parameter
      $stmt->bind_param('s', $username);
      // bind the result, using a new variable for the password
      $stmt->bind_result($strduser);
      $stmt->execute();
      $stmt->fetch();
      }
      
      if (isset($strduser) && ($strduser !== '')){
        //echo '<h2>true</h2>'.$strduser;
        
        $error = "<span class='error'>Sorry, this user name is taken!</span><br />
            You can try $firstname"."."."$lastname"."$randomNumber";
      }else{
        $conn = dbConnect('admin');
        //////////////////////////////////////////////////////////////////
        //create SQL to insert member information  -we are setting up a prepared statement
        $sql = 'UPDATE member 
                SET member_fname = ?,
                member_lname = ?,
                phone = ?,
                street = ?,
                city = ?,
                state = ?,
                zip = ?,
                username = ?,
                referral = ?,
                referred_by = ?
                WHERE member_id = '.$member_id;
        //echo "$sql";
        //initialize prepared statement
        $stmt = $conn->stmt_init();
        if ($stmt->prepare($sql)) {
          //bind parameters and execute statement
          //NOTE!  The first parameter here indicates the data type of each of the variables passed, this order must match the order in the $sql statement above
          $firstname = ucfirst($firstname);
          $lastname = ucfirst($lastname);

          $stmt->bind_param('ssssssisss', $firstname, $lastname, $phone, $street, $city, $state, $zip, $username, $referral, $referred_by);
          $OK = $stmt->execute(); //if statement executes, will set this flag to true
          // free the statement for the next query
          $stmt->free_result();
 

          $AdminMsg = "
          <html>
            <body>
              <table align='center' width='600' style='font-family:Myriad Pro, Helvetica, Arial; color:#F00;border:thin #ccc solid' bordercolor='#ccc' cellpadding='0' cellspacing='10'>
                <tr><td colspan='2' align='center'><img src='http://www.arrowofvictory.com/images/header.jpg' title='Header' width='600'/></td></tr>
                <tr><td align='center' colspan='2' style='border-bottom:thin #ccc solid; color:#777;'><br/><h2>
                A New User Account has Signed Up</h2></td></tr>
                <tr><td style='color:#333'>
                Some one just signed up for an account, you will get an email when the finish their registration.
                <br/></td></tr>
                <tr><td style='color:#333'>Name: $firstname $lastname</td></tr>
                <tr><td style='color:#333'>Phone: $phone</td></tr>
                <tr><td style='color:#333'>Email: $email</td></tr>
                <tr><td style='color:#333'>Address: $street, $city, $state - $zip </td></tr>
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
      $adminMailSent = mail("arrowofvictory@arrowofvictory.com", "A new account has been created", $AdminMsg, $headers);
      $adminMailSent = mail("marco@revlovellc.com", "A new account has been created", $AdminMsg, $headers);
      //$mailSent = mail($to, $subject, '<html><body>'.$msg.'</body></html>', $headers);
      $emailSent = true;

         // echo "<h1>$member_id</h1>";
          //Take us to 'my account'
          header("Location: myaccount.php");  //THIS IS commented out so you can see the echo statements for troubleshooting - uncomment when you've finished troubleshooting.
        
      
        }
        
      }
    }
}
?>






<?php include('includes/navBar.php'); ?>

  <!-- Custom styles for this template -->


<body>


  <div class="container">
      <div class="row main">
        <div class="main-login main-center">
          <h2 >Continue your registration:</h2>
          
        
        <?php if(isset($error)){echo $error.'<br />';
              //echo md5($password).'<br />';
              //echo $savedPwd;
              }else{
                echo "<p>We will use this information to auto-populate the fields needed in your LLCs.</p>";
              }

        ?>

          <form action="" method="post" name="register" id="register">
            
            <div class="form-group">
              <label for="fname" class="col-sm-2 control-label">First Name*</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">1</span>
                  <input type="text" class="form-control" name="fname" id="fname"  placeholder="Enter your First Name" required="required" value="<?php prefill('fname'); ?>" />
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="lname" class="col-sm-2 control-label">Last Name*</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">2</span>
                  <input type="text" class="form-control" name="lname" id="lname"  placeholder="Enter your Last Name" required="required" value="<?php prefill('lname'); ?>" />
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="lname" class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">2</span>
                  <input type="tel" class="form-control" name="phone" id="phone"  placeholder="(###) ###-####" required="required" value="<?php prefill('phone'); ?>" min="7" max="15" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="col-sm-2 control-label">Username</label>
              <p class="bg-warning text-center small">This is a suggested username, please change to something you will remember</p>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="street">Street</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-road" aria-hidden="true"></i></span>
                    <input name="street" type="text" value="" size="40" value="<?php prefill('street'); ?>" />
                </div>
              </div>
            </div>
        
            <div class="form-group row">
              <label class="col-sm-12 control-label" for="street">City/State/Zip</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <input name="city" type="text" value="" size="40" value="<?php prefill('city'); ?>" />
                </div>
              </div>
              <div class="col-sm-3">
                <div class="input-group">
                     <select name="state" size="1" required="required">

                        <option value="">Select...</option>
                        <option value="AK">AK</option>
                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                    </select>

                </div>
              </div>


              <div class="col-sm-3">
                <div class="input-group">
                    <input name="zip" type="text" value="" size="5" placeholder="Zip-Code" value="<?php prefill('zip'); ?>"  />
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-12 control-label" for="street">Referral</label>
              <div class="col-sm-12">
                <div class="input-group">
                     <select name="referral" size="1" required="required">

                        <option value="adwords">Google paid Ad</option>
                        <option value="google">Google Search</option>
                        <option value="facebook_ad">Facebook Ad</option>
                        <option value="Facebook">Friend Shared a post</option>
                        <option value="word2mouth">A Friend Referred me</option>
                        <option value="employee">Sales Rep</option>
                    </select>
                  </div>
                </div>
              <label class="col-sm-12 control-label" for="street">If it was a person, could you share their name? We would like to send them a thank you!</label>
              <div class="col-sm-12">
                <div class="input-group">
                    <input name="referred_by" type="text" value="" size="100" placeholder="Referred By" value="<?php prefill('referred_by'); ?>"  />
                </div>
              </div>
                </div>
              </div>
            </div>

            <div class="form-group ">
              <p><input id="submit" type="submit" name="register" value="Complete Registration" /></p>

            </div>
            
          </form>
        </div>
      </div>
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


<script type="text/javascript"> // propose username by combining first- and lastname
  $("#username").focus(function() {
    var firstname = $("#fname").val();
    var lastname = $("#lname").val();
    var randomNumber = Math.floor(Math.random() * 90 + 10);
    if(firstname && lastname && !this.value) {
      this.value = firstname + "." + lastname + "." + randomNumber ;
    }
  });
</script>


</body>
</html>