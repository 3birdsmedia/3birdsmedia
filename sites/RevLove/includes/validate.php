

        
       
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
      
        
        echo "<h1> sending email</h1>";
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


        
        echo "<h1> sending email</h1>";
        //If there is no error, send the email
        if(!isset($hasError)) {
        echo "<h1> EMAIL SENT</h1>";
          $to = "gina@ginanelson.net";
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

