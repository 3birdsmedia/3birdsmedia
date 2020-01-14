<?php
include ('includes/functions.php');
    $conn = dbConnect('query');
	   $sql3 = "SELECT *
		    FROM testimonials";
         	   //submit the SQL query to the database and get the result
		   $result3 = $conn->query($sql3); //or die(mysqli_error());
                   $length3 = $result3->num_rows;
		   //$row = $result->fetch_assoc();
		   
		    $testims = array();
	            while ($row3 = $result3->fetch_assoc()) {
		 	   //loop through the sql result, add each product_id and type_id to array to use later 
				   $testims[] = array(
						   'testi_id'  => $row3['testi_id'],
						   'testi_name' => $row3['testi_name'] ,
						   'testi_desc'=> $row3['testi_desc']
 						   );
				   }
	   //now that we are finished with results, release the db resources to allow a new query.
		   $result3->free_result();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/popUp.css" />

  <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>


<script type="text/javascript">

$(function() {
	$('a.lightbox').lightBox(); // Select all links with lightbox class
});
</script>

<style type="text/css">

</style>

<title>CJT <?php echo "&#8212;{$title}"; ?></title>
</head>
<body>
<!-- Start: Center Wrap -->
<div id="wrapper">

        <!-- Start: header -->
       <div id="header">
	     <span id="logo"><h1>CJT MOUNTING</h1></span>
              <span class='slogan'><h1>Products For Real Life</h1></span>
               
	</div><!--End Header-->
<!-- Start: content -->
       <div id="popcontent" class="success">
<?php
//if (!empty($testims)){
//	 
//	 
//  
//	 $length3 = count($testims);
//	 
//	 
//	    //loop through the results of the types query Part 2
//	    for ($row3 = 0; $row3 < $length3; $row3++) {	
//							
//			//echo $images[$row]['img_name'];				      
//				//needed to create these variables for inclusion in input HTML below.
//				$testi_id = $testims[$row3]['testi_id'];
//			     	$testi_name = $testims[$row3]['testi_name'];
//				$testi_desc = $testims[$row3]['testi_desc'];
//				//building the form elements.  Create arrays for the product_id, type_id, price and quantity.
//				 //regardless of how many products get shown on the page, the array index for each product/type/quantity will match.
//				//add hidden field with product id
//					 echo "<h3>$testi_name</h3>
//                                         <p>".nl2br($testi_desc)."</p>";
//                                         
//                                         echo '<div id="left" class="">';
//
//							    
//
//						    }
//}
?>

<h3>Matt</h3>
<p>Dear CJT,<br />
<br />
Thank you so much for the Freedom Table Stand, it is such an awesome piece of equipment, I use the stand everyday to position and hold my device.<br />
<br />

Thank you,<br />
<br />
Matt, MN</p>
<div id="left" class="success">
		<a class="lightbox" href="images/success/matt_01.jpg"><img src="images/success/thumb_matt_01.jpg" alt="" width='110'/></a>
		<a class="lightbox" href="images/success/matt_02.jpg"><img src="images/success/thumb_matt_02.jpg" alt="" width='110'/></a>
</div>


<br /><h3>Dave Langsdale</h3>
                                         <p>Hello, whoops, I mean Aloha Carrie,<br />
<br />
Boy, has your w/c laptop mount ever made a difference. But, first you were right, it only took about 30-45 min. to assemble, install & fine-tune the table to my liking. And even my wife, who dislikes computers and nearly everything associated with them, appreciates the simplicity of the only 20-30 SECONDS it takes to attach it to the w/c, followed by the additional minute or so it takes to place the laptop on the tray, the mouthstick in it's recepticle, the microphone on my head and turn on the computer. After that, and with the help of Dragon NaturallySpeaking voice software, its just me-and-my-computer =. independence. Oh, and your asking for and use of the picture & measurements of the laptop we sent you was well worthwhile. It fits perfectly on the tray, and because of the properly placed cutouts for breathing, the laptop stays much cooler than when it was just lying on my lap; doesn't slip anymore either.<br />
<br />
And finally, as you can see from the attached picture, though I may be in a wheelchair and considered a full quadriplegic (by some), with the help of people like you and the products you design and create for us, well, let's just say you've played a big part in my considering myself Les'abled (my trademark attached).<br />

<br />
Jan just told me there is one more thing she REALLY likes about the laptop tray... The 10 seconds it takes to pull the pin and remove the whole thing when I'm done!<br />
<br />
Mahalo Nue Loa,<br />
Dave Langsdale<br />
<br />
Btw... Mahalo Nue Loa means thank you very much in Hawai'ian</p>
<div id="left" class="success">
		<a class="lightbox" href="images/success/001.jpg"><img src="images/success/thumb_001.jpg" alt="" width='110'/></a>
		<a class="lightbox" href="images/success/002.jpg"><img src="images/success/thumb_002.jpg" alt="" width='110'/></a>
		<a class="lightbox" href="images/success/003.jpg"><img src="images/success/thumb_003.jpg" alt="" width='110'/></a>
		<a class="lightbox" href="images/success/004.jpg"><img src="images/success/thumb_004.jpg" alt="" width='110'/></a>
</div>
	 
<br /><h3>Johana Schwartz</h3>
<p>Dear Carrie,</p>
<p>Good to see you. Welcome to my state and thank you for working on my mount today.<br />
I hope your video is helpful. Allow me to reiterate that I acquired the Profile on my power chair in April of 2007 and I have had successful outcomes with it.<br />
Gillette identified your mount as a solution for my Pathfinder and my power chair. I had been going into Gillette every six weeks with my prior brand of mount because I was constantly breaking it off the chair when I bumped into walls and furniture, and especially in the car. Gillette recommended the CJT Profile as an alternative that was more compatible. It does not protrude beyond the boundaries of my chair and does not ever snap off when I drive into things. It has been durable and indestructible. It has never broken off when I bump into things. Furthermore, the profile mount was something I could adjust at home with the included tools. I no longer needed a doctor's order and an appointment at Gillette to adjust the position of my device.
<br />
Have a safe trip back to the warmth.<br />
Johana Schwartz</p>

Watch her video
    <a href='http://www.youtube.com/watch?v=YVPHsf2KA8k' target='_blank'><div id='youtube_link' class='video_link' style='float:none;'></div></a>





<br /><h3>Britte</h3>
                                         <p>Dear CJT,<br />
<br />
I love the mount! It makes it so easy for Cameron to use his Tango.  The fact that the mount easily detaches from my son's chair; makes moving the chair in and out of the car a cinch.  I never worry about the mount breaking because it is so close to the chair!<br />

<br />
You Guys are great!<br />
<br />
Britte,<br />
Mom, OR</p>

<!--END CONTENT-->					
			</div>  
		</div><!--END OF Main-->
	</div><!--END OF WRAP-->

</script>
</body>
</html>