<?php
include ('includes/functions.php');
//print_r($_POST);
//If the form is submitted
if(isset($_POST['submit'])) {



$msg = '';
foreach ($_POST as $key => $value) {
if (!isset($value)) {$value = "Not Specified";}
$msg =   $msg.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';
}

 		$to = "marco@designpros-inc.com";
		$subject = "From Testimonials";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    // send it
		    $mailSent = mail($to, $subject, '<html>'.$msg.'</html>', $headers);
		    $emailSent = true;
	

}
include('includes/header.php'); ?> 
<!-- End JavaScript -->
<style type="text/css">

</style>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">
   
<!-- Start: container -->
   <div id="container">




		 <!-- Start: header -->
		      <div id="header">
			     <a href="index.php"><h1><span>Design Pros</span></h1></a>
			     <div id="upload"><a href="contact.php"><h2>Upload Your Print Ready Files</h2></a></div>
		      </div><!-- End: header --> 	   

<!-- Start: content -->
<div id="content">

	    <!-- Start: left-cont -->
	    <div id="left-cont">
		   <h2>What people are saying about us...</h2><br />
		   
		     <div>
			    <div class="testiBody">
						 <p>
							"Thanks for helping me make my dream come true."
						 </p>
			    </div>
				   <h3 class="testiName">&mdash; Henry Bibby - Dribble Pro </h3>
		     </div>
		     
		     
		     <div>
			    <div class="testiBody">
						 <p>"Thank you Design Pros for creating two great logos! Mike, you really took care of all our design needs, quickly and beautifully.  We have been so happy with the creativity and the quality of work for every project that you have completed for us. We especially liked that you are a one-stop shop from the creating to the printing and mailing. I have more projects headed your way! - Thank you!" </p>
						  
			    </div>
				   <h3 class="testiName">&mdash; Margaret Rosenberg, Debt Servicing Solutions.</h3>
		     </div>
			   
	
		     <div>
			    <div class="testiBody">
						 <p>
							"Everything looks beautiful, thanks! I am going to grow my business thanks to you. We will have the look of a multi-million dollar business on a small budget." 
						 </p>
			    </div>
				   <h3 class="testiName">&mdash; Dave Payetta, Metro-Chemical, Inc.</h3>
		     </div>
			   
			   
			   
				   <div>
					       <div class="testiBody">
						       
							  <p>"Perfecto!!  Thanks for the quick service and quality of product." </p>
					  
												
						 </div>
					       <h3 class="testiName">&mdash; Julie and son, Torin. Pro-Tec Carpet Cleaners</h3>
					   
				   </div>
			   
			   
				   <div>
					  
						 <div class="testiBody">
						       
							       <p>"Incredibly fast, accurate, accommodating and Skilled Graphic Designer. Thank you for the willingness to go the extra-mile to get the job done!  I will highly recommend you to any and all of my customers and associates. Your willingness to accommodate our needs was very refreshing."</p>
					       
						 </div>    <h3 class="testiName">&mdash; Richard N. Jaffe CMO, MOXXOR, LLC</h3>
					  </div>
					     
					  
					  
					  <div>
						
						  <div class="testiBody">
						  
							
							       <p>"I have used Design Pros, Inc. to create my entire visual business identity for all of my companies and there is no other firm out there I would even consider using."</p>
							
						 </div> <h3 class="testiName">&mdash; Scott Schultze President, TesTeachers Online/www.52hours.com</h3>
						 
					  </div>
					  
					  <div>
					      
						 <div class="testiBody">
						  
							
							       <p>"Thanks so much for all of your help with the EJ proposal. It turned out awesome. You are truly a Da Vinci at Graphic Arts!! Thanks again."</p>
						    
						 </div>   <h3 class="testiName">&mdash; John Wagner, Insurance Securities Schools of California.</h3>
					  </div>
					  
					  <div>
						 
						  <div class="testiBody">
							
							       <p>"Thank you for your incredibly fast turnaround on our Nascar corporate event materials for the Pepsi 500! You are great at what you do and we look forward to working with your you and your company for a long time!"</p>
						      
						 </div><h3 class="testiName">&mdash; Ron M. Garcia, Executive Account Manager, R+L Carriers</h3>
					  </div>
					  
					  <div>
						
						 <div class="testiBody">
						  
							
							       <p>"I have used Design Pros, Inc. to create my entire visual business identity for all of my companies and there is no other firm out there I would even consider using."</p>
							
						 </div> <h3 class="testiName">&mdash; Amy Peterson Owner, Your Girl Friday Interiors.</h3>
					  </div>
					  
					  <div>
						 
						  <div class="testiBody">
						  
							
							       <p>"Nice work.  I really appreciate working with you and have a great deal of respect for your creativity and knowledge."</p>
						       
						 </div><h3 class="testiName">&mdash; Carrie McCormick, CJT Mounting. </h3>
					  </div>
					  
					  <div>
						
						 <div class="testiBody">
						  
							
							       <p>
"I received our printed marketing materials late this afternoon and I want to Thank You for such an OUTSTANDING job…they look Amazing.
I’m excited to get these in the mail and see what type of response we get.
Thanks again, your efforts are greatly appreciated."

							       </p>
						       
						 </div> <h3 class="testiName">&mdash; Terri Recknor - www.powerfulomegas.com </h3>
					  </div>
					  
					  <div>
					       
						  <div class="testiBody">
						  
							
							       <p>
								  "True Colors International has been utilizing the production and printing services of Design Pros, Inc. for more than three years. We have always found the services to be very satisfactory. The workmanship is of excellent quality. The charges are extremely competitive and deliveries are the best that we have ever experienced. Mike Shepherd, the principal, is very reliable and the relationship is always pleasant."    
							       </p>
							
						 </div>  <h3 class="testiName">&mdash; John G Campbell - Director, International Business, True Colors International </h3>
					  </div>
					  
					  <div>
					       
						  <div class="testiBody">
						  
							
							       <p>
								      "Everything looks great! - Even better than I imagined....that's why you're the pro!"
							       </p>
						       
						 </div>  <h3 class="testiName">&mdash; Dr. Howard Rubin – Pharmacist </h3>
					  </div>
					  
					  <div>
						
						  <div class="testiBody">
						  
							
							       <p>
								  "Design Pros has been an integral partner in growing Jungle Tech Group from a one man vision into a world class corporate team and television series. Revolutionizing the way the world sees wildlife through unique zoological habitats is Jungle Tech Group’s specialty.  Presenting this to our clients, media and the public takes incredible strokes of visual creativity – this is Design Pro’s specialty. Clear to the point communication and excellent intuition to our needs as a client have resulted excellent results from the Design Pros team each and every time. Operating in a market which consists of mega-million dollar resort and gaming properties requires that we maintain the visual edge with our clients. We approach every client with full confidence, knowing that our presentation materials will hit a home run out of the park every time! This is for one simple reason – the number of times at the person at the top of the ladder has stopped to compliment me personally on the effectiveness of our designed and printed materials. When this happens enough times, you then realize that you are with the right designer and printer for your business."    
							       </p>
							
						 
						 </div> <h3 class="testiName">&mdash; Robert Paul Curtis, CEO, Jungle Tech Group Inc. </h3>
					  </div>
			  
	      </div><!-- End: left-cont -->
					 
	      
	      <div id="right-cont">
				   <form action="" method="post" id='submitTesti' name='submitTesti'>
	      				   <?php if (isset($msg)){
						 echo "<h3>Your experience has been sent to us, we will review it and post it on the site soon.</h3>";
					  }else{echo "<h2>Send us your experience</h2>";}
			    		   ?>
					  		<p><label for="name">*Name</label>
							       <input type="text" id="name" name="name" class='required' value="<?php if (isset($name)){echo $name;} else {echo "";} ?>"/></p>
							<p><label for="name">Title/Position</label>
							       <input type="text" id="title" name="title" value=""/></p>
							<p><label for="name">Company Name</label>
							       <input type="text" id="comp_name" name="comp_name" value="<?php if (isset($comp_name)){echo $comp_name;} else {echo "";} ?>"/></p>
						       <p><label for="testi">Your Experience</label>
							       <textarea id="testim" name="testim" class='required' value="<?php if (isset($testim)){echo $testim;} else {echo "";} ?>"></textarea></p>
			
					  <p><input type="submit" value="Send" id="submit" name="submit" value="" style="width: 100px;" /></p>
					  
					 <p><label id="disclaimer">*Design Pros retains the right to add or delete your testimony at our discretion.</label>
				   </form>
	      </div>

</div> <!--END CONTENT-->

				

<!-- Start: navigation -->
	    <div id="general-navigation">
		  <?php include('includes/navbar.php');?>
	    </div><!-- End: navigation -->
    
</div><!-- End: container -->
   
<!-- Start: push -->
<div id="push"></div><!-- End: push -->


</div><!-- End: Center Wrap -->

    



<!-- Start:  -->
      <div id="footer">
	      <?php include("includes/footer.php");?>
      </div><!-- End:  -->

<script type="text/javascript">
// initialize plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
		

</script>
 </body>
</html>