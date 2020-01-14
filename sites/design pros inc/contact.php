<?php

include ('includes/functions.php');

//echo 'display_errors = ' . ini_get('display_errors') . "<br />";

//echo 'register_globals = ' . ini_get('register_globals') . "<br />";

//echo 'post_max_size = ' . ini_get('post_max_size') . "<br />";

//echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) . "<br />";

//echo 'post_max_size in bytes = ' . return_bytes(ini_get('post_max_size'));

function return_bytes($val) {

    $val = trim($val);

    $last = strtolower($val[strlen($val)-1]);

    switch($last) {

        // The 'G' modifier is available since PHP 5.1.0

        case 'g':

            $val *= 1024;

        case 'm':

            $val *= 1024;

        case 'k':

            $val *= 1024;

    }



    return $val;

}



//define a maxim size for the uploaded images in Kb

 define ("MAX_SIZE","250000"); 



//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.

 function getExtension($str) {

         $i = strrpos($str,".");

         if (!$i) { return ""; }

         $l = strlen($str) - $i;

         $ext = substr($str,$i+1,$l);

         return $ext;

 }



//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  

//and it will be changed to 1 if an errro occures.  

//If the error occures the file will not be uploaded.

 $errors=0;

//checks if the form has been submitted

 if(isset($_POST['submit'])) {

	if($_POST['name'] == ''){

		$msg = 'We need your name to be able to refernece the files, please fill out your name';

		$errors = 1;

	}else{
	$date = date('U');
	//echo $date;
	$folder = "files/".$_POST['name'].$date;

	mkdir($folder);



$info = '';

foreach ($_POST as $key => $value) {

if (!isset($value)) {$value = "Not Specified";}



$info =   $info.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';

 

} 


//print_r($_FILES);
if (isset($_FILES['file']) && $_FILES['file']['error'] != '4'){   
foreach ($_FILES['file']['name'] as $key => $value) {

    

    // echo $_FILES['file']['name']."<br />";

   // echo "Key: $key; Value: $value<br />\n";



			//reads the name of the file the user submitted for uploading

			$file= $value;

				//if it is not empty

			if ($file) {

			//get the original name of the file from the clients machine

				$filename = stripslashes($file);

			//get the extension of the file in a lower case format

				$extension = strtolower(getExtension($filename));

			//if it is not a known extension, we will suppose it is an error and will not  upload the file,  

			//otherwise we will do more tests

				//get the size of the image in bytes

				 //$_FILES['image']['tmp_name'] is the temporary filename of the file

				 //in which the uploaded file was stored on the server

				 $size=filesize($_FILES['file']['tmp_name'][$key]);

		

					//compare the size with the maxim size we defined and print error if bigger

					if ($size > MAX_SIZE*1024){

						$msg = '<h2>Please use a smaller File</h2>';

						$errors=1;

					}

		

					//we will give an unique name, for example the time in unix time format

					$file_name= $value;

					//the new name will be containing the full path where will be stored (images folder)

					$newname= $folder."/".$file_name;

					//we verify if the image has been uploaded, and print error instead

					$copied = copy($_FILES['file']['tmp_name'][$key], $newname);

					if (!$copied) {

						echo '<h2>Copy unsuccessfull!</h2>';

						$errors=1;

					}

				}

			}
}else{
    $upload = false;
//    echo "No upload";
}

	}

	

 }



 if(isset($_POST['submit']) && !$errors) {

	$to = "mike@designpros-inc.com";

	$subject = "New Upload from ".$_POST['name']."";

	$headers = 'MIME-Version: 1.0' . "\r\n" .

		   'Content-Type: text/html; charset=ISO-8859-1';

	$info .= 'The new upload is located in '.$folder.' ';	    

		    // send it

		    $mailSent = mail($to, $subject, '<html>'.$info.'</html>', $headers);

 	if ($_FILES['file']['error'] = '4'){
	    $msg = "<h2 class ='confirm'>Email was sent, we will contact you back, as soon as posible</h2>";
	}else{
	    $msg = "<h2 class ='confirm'>Your file was uploaded an email was sent. We will contact you back as soon as posible</h2>";   
	}
 }

//If no errors registred, print the success message

include('includes/header.php'); ?> 

</head>

<body>

<!-- Start: Center Wrap -->

<div id="wrapper">

   

<!-- Start: container -->

   <div id="container">



<!-- Start: header -->

     <div id="header">

	    <a href="index.php"><h1><span>Design Pros</span></h1></a>

     </div><!-- End: header -->	      

   	   

<!-- Start: content -->

      <div id="content">



   <div id='left-cont'>

      <p>Please feel free to contact us any time if you have any questions. Thank you.</p>



<div class="employee">

<h2>Corporate Address:</h2>

<div id="info">

<p>2730 S. Harbor Blvd., Suite B</p>

<p>Santa Ana, Ca 92704</p>

<p>Toll Free: 877-644-3073</p>

<p>Local Phone: 714-850-8833</p>

<p>General Fax: 714-850-1633</p>

<p>Business Hours: 10am-6pm, Mon-Fri. 

</div>

<div id="map">

<iframe width="300" height="125" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;msa=0&amp;msid=209999337986471854745.0004a1493bf4ca21f244e&amp;ll=33.710632,-117.91935&amp;spn=0.028559,0.051327&amp;z=13&amp;output=embed"></iframe><br /><small>View <a href="http://maps.google.com/maps/ms?hl=en&amp;ie=UTF8&amp;view=map&amp;msa=0&amp;msid=209999337986471854745.0004a1493bf4ca21f244e&amp;ll=33.710632,-117.91935&amp;spn=0.028559,0.051327&amp;z=13&amp;source=embed" style="color:#0000FF;text-align:left">Design Pros Inc</a> in a larger map</small>

</div>

</div>

<div class="employee">

  <h2>Mike Shepherd</h2>

    <img src="images/user.png" />

     <div class="desc">

 

       <h3>President/CEO</h3>
       <h3>Creative Director</h3>

	    <p>Tel: 714-850-8833 ext. 100</p>

	    <p>Fax: 714-597-6809</p>

	    <p>Cell: 562-208-6227</p>

	    <p><a href="mailto:mike@designprosinc.com" title="Mike Email">mike@designprosinc.com</a></p>

	</div>

</div>



<div  class="employee">

  <h2>Kelly Shepherd</h2>

     <img src="images/user.png" />

       <div class="desc">

	<h3>Vice President of
Accounting &
Human Resources</h3>

	     <p>Tel: 714-850-8833 ext. 101</p>

	     <p>Fax: 714-850-1633</p>

	    <p><a href="mailto:kelly@designpros-inc.com" title="Kelly Email">kelly@designpros-inc.com</a></p>

	</div>

</div>

<div  class="employee">

  <h2>Sean Fahlen</h2>

     <img src="images/user.png" />

       <div class="desc">

	<h3>Graphic Designer</h3>

	     <p>Tel: 714-850-8833 ext. 102</p>

	     <p>Fax: 714-850-1633</p>

	    <p><a href="mailto:seanf@designprosinc.com" title="Sean Email">seanf@designprosinc.com</a></p>

	</div>

</div>

<div  class="employee">

  <h2>Susanne McFadden</h2>

     <img src="images/user.png" />

       <div class="desc">

	<h3>Sales Manager – LA & Orange County</h3>

	     <p>Tel: 714-850-8833</p>

	     <p>Direct Line: 714-420-5275</p>

	     <p>Fax: 714-597-6809</p>

	    <p><a href="mailto:susanne@designprosinc.com" title="Susanne Email">susanne@designprosinc.com</a></p>

	</div>

</div>

<div  class="employee">

  <h2>Mark Shepherd</h2>

     <img src="images/user.png" />

       <div class="desc">

	<h3>Sales Manager – Northern California</h3>

	     <p>Tel: 714-850-8833</p>

	     <p>Direct Line: 760-889-1399</p>

	     <p>Fax: 714-597-6809</p>

	    <p><a href="mailto:marks@designprosinc.com" title="Mark Email">marks@designprosinc.com</a></p>

	</div>

</div>



<div class="employee">

   <h2>Kristopher Evans</h2>

       <img src="images/user.png" />

	   <div class="desc">

	     <h3>Web-developer</h3>

	       <p>Tel: 714.850.8833</p>

	       <p>Fax: 714-597-6809</p>

	       <p><a href="mailto:kris@designprosinc.com" title="Kris Email">kris@designprosinc.com</a></p>
	    </div>

</div>



<div class="employee">

   <h2>Marco Segura</h2>

       <img src="images/user.png" />

	   <div class="desc">

	     <h3>Web-developer/Web Designer</h3>

	       <p>Tel: 714.850.8833</p>

	       <p>Cell: 714.654.3852</p>

	       <p><a href="mailto:marco@3birdsmedia.com" title="Marco Email">marco@3birdsmedia.com</a></p>
	 

</div>

</div>

</div>



<!-- Start: right-cont -->

	   <div id="right-cont">

		  

		  <?php

	//if the form has been submitted, display result

        if (isset($msg)) {

        echo "<div>$msg</div>";

        }else{

		echo "<h2>Upload your print ready files</h2>";

	}

?>

				<form id="insert" name="insert" method="post" action="" enctype="multipart/form-data">    

				

					<label for="name">*Name:</label>

					<input name="name" id="name" type="text" size="50" maxlength="50" class="required" />			    

					<label for="name">Company:</label>

					<input company="name" id="company" type="text" size="50" maxlength="50" class="" />		    

					<label for="email">E-mail:</label>

					<input name="email" id="email" type="text" size="50" maxlength="50" class="required email" />		    

					<label for="phone">Phone:</label>

					<input name="phone" id="phone" type="text" size="50" maxlength="50" class="" />		    

					

					

					

					    <div id="file-uploader">       

        <noscript>          

            <p>Please enable JavaScript to use file uploader. Or use this simple file upload</p>

            <!-- or put a simple form for upload here -->

	    

	    <label for="file"><span class="label"><p>Select File:</p></span></label>

					<input type="file" name="file[]" id="file" class="required"/>

					<p class="request">(please limit your files to 250mb)</p>

        </noscript>         

    </div>

					

					<label for="comm">Comment:</label>

					<textarea name="comm" id="comm" class=""></textarea>		    

					

					<input type="submit" name="submit" value="Send Request" />

				</form>   

		  

		   

	   </div><!-- End: right-cont -->

      

     

      </div><!-- End: content -->

      

<!-- Start: navigation -->

	    <div id="navigation">

		  <?php include('includes/navbar.php');?>

	    </div><!-- End: navigation -->

      

      

      

 



   </div><!-- End: container -->

<!-- Start: push -->

	    <div id="push">

		    

	    </div><!-- End: push -->

</div><!-- End: Center Wrap -->



<!-- Start:  -->

      <div id="footer">

	      <?php include("includes/footer.php");?>

      </div><!-- End:  -->

<script type="text/javascript" src="js/fileuploader.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

  <script type="text/javascript">
    $("#insert").validate();
<!--

      var uploader = new qq.FileUploader({

        // pass the dom node (ex. $(selector)[0] for jQuery users)

        element: document.getElementById('file-uploader'),

        // path to server-side upload script

        action: 'includes/uploader.php'

    }); 


 -->

 </script>

 </body>

</html>