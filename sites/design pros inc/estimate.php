<? include('includes/functions.php');


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
//and it will be changed to 1 if an error occurs.  
//If the error occurs the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 if(isset($_POST['submit'])) {
	
	//if the name field is empty then give an error
	if($_POST['name'] == ''){
		$msg = '<div id="error">We need your name to be able to reference the files, please fill out your name</div>';
		$errors = 1;
	
	//and if the directory exists then give an error 
	}elseif(is_dir("files/".$_POST['name'])){
	 //echo "Is Dir";
	       $msg = '<div id="error">Someone else with this name has already uploaded a file today, please use another name. Thanks.</div>';
		$errors = 1;
	}else{
	$folder = "files/".$_POST['name'];
	echo "files/".$_POST['name'];
	mkdir($folder);

	$info = '';
	foreach ($_POST as $key => $value) {
					    if (!isset($value))  {
								  $value = "Not Specified";
								 
					    }elseif(is_array($value)){
								   foreach ($value as $key => $value2) {
								   $info  =   $info.ucwords(str_replace('_', ' ', $key)).": ".$value2.'<br />';
								   }
	 				   }else{
								     $info  =   $info.ucwords(str_replace('_', ' ', $key)).": ".$value.'<br />';
					   }
	}

if (isset($_FILES['file']['name'])){
	
foreach ($_FILES['file']['name'] as $key => $value) {
    
    
    //FOR TROUBLE SHOOTING
       
    //echo $_FILES['file']['name']."<br />";
    //echo "Key: $key; Value: $value<br />\n";

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
				 //$_FILES['image']['tmp_name'] is the temporary file name of the file
				 //in which the uploaded file was stored on the server
				 $size=filesize($_FILES['file']['tmp_name'][$key]);
		
					//compare the size with the maxim size we defined and print error if bigger
					if ($size > MAX_SIZE*1024){
						$msg = '<h2>Please use a smaller File</h2>';
						$errors=1;
					}
		
					//we will give an unique name, for example the time in UNIX time format
					$file_name= $value;
					//the new name will be containing the full path where will be stored (images folder)
					$newname= $folder."/".$file_name;
					//we verify if the image has been uploaded, and print error instead
					$copied = copy($_FILES['file']['tmp_name'][$key], $newname);
					if (!$copied) {
						$msg = '<h2>Copy unsuccessful!</h2>';
						$errors=1;
					}
				}
			}
	}
	
 }
 }

 if(isset($_POST['submit']) && !$errors) {
	$to = "marco@designpros-inc.com";
	$subject = "New Upload from ".$_POST['name']."";
	$headers = 'MIME-Version: 1.0' . "\r\n" .
		   'Content-Type: text/html; charset=ISO-8859-1';
	$info .= 'The new upload is located in '.$folder.' ';	    
		    // send it
		   //$mailSent = mail($to, $subject, '<html>'.$info.'</html>', $headers);
 	$msg = "<span class='confirm'>We have received your Estimate Request Form, you will be contacted by one of our experienced professionals within 24 business hours.</span>";
 }

//FOR TROUBLE SHOOTING

//print_r($_POST);
//if (isset ($info)){echo $info;}


include('includes/header.php'); ?>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$().ready(function() {
// validate sign up form on key up and submit
	$("#estimate").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			phone: "required"
		},
		messages: {
			name: "We need your name to be able to reference the files, please fill out your name",
			email: "Please enter a valid email address",
			phone: "Please enter your phone number"
		}
	});
});
</script>

<!-- End JavaScript -->
	<style type="text/css">
		#container{margin-bottom:-120px;}
		.error {width:390px;line-height:18px;}
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
<h2> Design and Printing Estimate Form</h2>

		  <?php
	//if the form has been submitted, display result
        if (isset($msg)) {
        echo $msg;
        }else{
		echo "<p>Receive an Estimate or a Call within 24 Hours.</p>
<p>1-on-1 Assistance from one of our Designers.</p>";
	}
?>


<form id="estimate" name="estimate" method="post" action="" enctype="multipart/form-data">    
<input type="hidden" value="" name="<h2>Costumer Info</h2>" />
					<p><label for="name">*Name:</label>
					<input name="name" id="name" type="text" size="50" maxlength="50" class="required" /></p>			    
					<p><label for="company">Company:</label>
					<input company="company" id="company" type="text" size="50" maxlength="50" class="" /></p>		    
					<p><label for="email">*E-mail:</label>
					<input name="email" id="email" type="text" size="50" maxlength="50" class="required email" />	</p>	    
					<p><label for="phone">*Phone:</label>
					<input name="phone" id="phone" type="text" size="50" maxlength="50" class="required" />	</p>	    
					

<h2> Tell us about your project.</h2>
<ul class="tabs">
		   
			   <input  class="smallInput" type="checkbox" name="about_Project[]" id="printCheck"  value="Graphic Design Project"/> <li>
				   
				 <a href="#tab1">   <label class="aboutLabel">Graphic Design Project</label>
			   </a></li>
			   
			    <input  class="smallInput" type="checkbox" name="about_Project[]" id="printCheck"  value="Website Project"/><li><a href="#tab2">
				   
				    <label class="aboutLabel">Website Project</label>
			   </a></li>
			   
			   <input  class="smallInput" type="checkbox" name="about_Project[]" id="printCheck"  value="Printing Project"/><li><a href="#tab3">
				    
				    <label class="aboutLabel">Printing Project</label>
			   </a></li>
</ul>


<div class="tab_container">
<div id="tab1" class="tab_content">

<div id="graphicForm">
<div class="formmodule">
<input  class="smallInput" type="checkbox" name="about_Project[]" value="Graphic Design Project"/><p><label>Graphic Design Project</label></p>
 
<input  class="smallInput" type="radio" name="graphic_beggining" value="New Design"/><p><label>New Design</label></p>

<input  class="smallInput" type="radio" name="graphic_beggining" value="Redesign Current Artwork"/><p><label>Redesign Current Artwork</label></p>

<input  class="smallInput" type="radio" name="graphic_beggining" value="I know what I want"/><p><label>I know what I want</label></p>
<p>
<input class="smallInput" type="radio" name="graphic_beggining" value="I need help with design ideas and concepts"/><label>I need help with design ideas and concepts</label></p>

<p><h3> Description </h3></p>
<p>Describe your project in as much detail as you can so we can have a better overall idea of the scope of work to be done.</p>
<textarea></textarea>

</div>


<div class="formmodule">
<p><h3> What are we designing?<br/></p><p>(check all the apply)</h3></p>


<p><input  class="smallInput" type="checkbox" name="graphic_what[]" value="Logo"/><label>Logo</label></p>

<p><input  class="smallInput" type="checkbox" name="graphic_what[]" value="Business Card"/><label>Business Card</label></p>

<p><input  class="smallInput" type="checkbox" name="graphic_what[]" value="Stationary"/><label>Stationery</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Brochures"/><label>Brochures</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Banners/Signs"/><label>Banners/Signs</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Book Covers"/><label>Book Covers</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="CD/DVD Art"/><label>CD/DVD Art</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Folders"/><label>Folders</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Postcard Mailers"/><label>postcard Mailers</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Flier"/><label>Flier</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Sales Sheet"/><label>Sales Sheet</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Invitation"/><label>Invitation</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Program"/><label>Program</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Print Ad"/><label>Print Ad</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Product Box or Display"/><label>Product Box or Display</label></p>
<p>
<input  class="smallInput" type="checkbox" name="graphic_what[]" value="Promotional Item"/><label>Promotional Item</label></p>

</div><!--end of module-->
</div><!--end of  graphic form-->
</div><!--end of tab1-->


<div id="tab2" class="tab_content">
<div id="webForm">



<div class="formmodule">
<input type="hidden" value="<h2>Web Design</h2>" name="<h2>Web Design</h2>" />

<input  class="smallInput" type="checkbox" name="about_Project[]" value="Web Design Project"/><p><label>Web Design Project</label></p>
<input  class="smallInput" type="radio" name="web_beggining" value="New Design"/><p><label>New Design</label></p>
<input  class="smallInput" type="radio" name="web_beggining" value="Redesign Current Artwork"/><p><label>Redesign Current Site</label></p>
<input  class="smallInput" type="radio" name="web_beggining" value="Make Small Updates Only"/><p><label>Make Small Updates Only</label></p>
<input  class="smallInput" type="radio" name="web_beggining" value="I know what I want"/><p><label>I know what I want</label></p>
<input  class="smallInput" type="radio" name="web_beggining" value="I need help with design ideas and concepts"/><p><label>I need help with design ideas and concepts</label></p>

<p><h3><label>How Many Pages/Tabs will the site have:</label></h3></p>
<input type="text" name="num_pages" />

<p><h3><label>Website Name/Address:</label></h3></p>
<input type="text" name="web_name" />

<p><label class="budgetLabel">Allotted Budget</label><input type="text" id="budget" name="budget" class="budgetLabel" style="border:0;font-weight:bold;" /></p>
<label><div id="slider-range"></div></label>


<p><h3><label>Time line for completion</label></h3></p>
<input type="text" name="web_timeline" />

<p><h3><label>What are your needs</p><p>(check all the apply)</label></h3></p>

<input  class="smallInput" type="checkbox" name="web_what[]" value="Creative Website Design"/><p><label>Creative Website Design</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Search Engine Optimization"/><p><label>Search Engine Optimization (SEO)</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Hostingraphic_Email"/><p><label>Hosting/Email Services</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Form Data"/><p><label>Form Data Collection</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Website Search" /><p><label>Website Search</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Photo Gallery"/><p><label>Photo Gallery</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Video"/><p><label>Video</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Calendar_Events"/><p><label>Calendar/Events</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Store_Ecommerce"/><p><label>Store/Ecommerce</label></p>
<input  class="smallInput" type="checkbox" name="web_what[]" value="Social Media"/><p><label>Twitter/Facebook Integration</label></p>
<p><label>Other (please be specific)</label></p><input type="text" name="web_needs" />

<p><h3><label>Identify your Target Audience</label></h3></p>
<input type="text" name="Target Audience" />

<p><h3><label>List three objectives</label></h3></p>
<input type="text" name="First_Objective" />
<input type="text" name="Second_Objective" />
<input type="text" name="Third_Objective" />


<p><h3><label>What constitutes a successful project?</label></h3></p>
<input type="text" name="successful_project" />

</div>
<div class="formmodule">

<p><h3><label>What do you want your website to do</label></h3></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Online Presence"/><p><label>Establish Online Prescience</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Provide Secure Information"/><p><label>Provide Secure Information</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Online Community"/><p><label>Online Community</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="CMS"/><p><label>Content Management</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Provide Public Information" /><p><label>Provide Public Information</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Sell Products Online"/><p><label>Sell Products Online</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Intranet"/><p><label>Intranet</label></p>
<input  class="smallInput" type="checkbox" name="web_function[]" value="Not Sure"/><p><label>Not Sure</label></p>

<p><h3><label>Other Functionality</label></h3></p>
<input type="text" name="web_other_functionality" />


<p><h3><label>List example websites that you like and tell us what you like about them.</label></h3></p>
<textarea  name="examples"></textarea>


<p><h3><label>Other</label></h3></p>
<input  class="smallInput" type="radio" name="web_other" value="Managed by costumer" /><p><label>I want to make changes and updates to the<br /> site myself</label></p><br />
<input  class="smallInput" type="radio" name="web_other" value="Maintained by DesignPros"/><p><label>I would like you to maintain our site.</label></p>

<p><h3> Description </h3></p>
<p>Describe your project in as much detail as you can so we can have a better overall idea of the scope of work to be done.</p>
<textarea  name="web_describe"></textarea>

</div>
</div><!--end of web form-->
</div><!-- end of tab2-->



<div id="tab3" class="tab_content">
<div id="printForm"> 
 


<div class="formmodule">
<input type="hidden" value="" name="<h2>Print Project</h2>" />

<input  class="smallInput" type="checkbox" name="about_Project[]" value="Printing Project"/> <p><label>Print Project</label></p>
<input  class="smallInput" type="radio" name="print_order_type" value="New Print Job"/><p><label>New Print Job</label></p>
<input  class="smallInput" type="radio" name="print_order_type" value="Redesign Current Artwork"/><p><label>Re-Order of existing job</label></p>
<input  class="smallInput" type="checkbox" name="order_with_changes"/> <p><label>(Check if the order has changes)</label></p>

<p>If you are re-ordering please provide us with the invoice number, approximate date of job, and/or a short description of the job.</p>
<textarea name="print_describe"></textarea>

<p>**If you are requesting a new job please fill in the following spec requesting full detail:**</p>

<h3>Printing Specs: (for printed marketing materials, banners, etc.)</h3>
<p><label>What is the finished size of your job:</label></p>
<p><h3><label>Width</label><input type="text" name='job_full_width'/></h3></p>
<p><h3><label>Height</label><input type="text" name='job_full_height'/></h3></p>

<p><label>Folded size (if applies):</label></p>
<p><h3><label>Width</label></h3><input type="text" name='job_fold_width'/></p>
<p><h3><label>Height</label></h3><input type="text" name='job_fold_height'/></p>

<p><h3><label>Number of Pages:</label></h3><input type="text" name="print_page_number"/></p>


</div>
<div class="formmodule">
<p><h3><label>Paper Choice:(choose stock) </label><h3></p>
<p>*House stocks are cheaper</p>
<select name="Stock">
	<option value=""></option>
	<option value="50lb_Bond">50lb Bond (house)</option>
	<option value="60lb_Bond">60lb Bond (house)</option>
	<option value="70lb_Bond">70lb Bond (house)</option>
	<option value="80lb_Book">80lb Book</option>
	<option value="80lb_Cover">80lb Cover</option>
	<option value="100lb_Book">100lb_Book (house)</option>
	<option value="100lb_Cover">100lb_Book (house)</option>
	<option value="110lb_Cover">110lb_Book (house)</option>
	<option value="135lb_Cover">135lb_Cover</option>
	<option value="12pt_Cover">12pt Cover(house)</option>
	<option value="14pt_Cover">14pt Cover(house)</option>
	<option value="16pt_Cover">16pt Cover</option>
	<option value="18pt_Cover">18pt Cover</option>
	<option value="Linen_Textured_Cover">Linen/Textured Cover</option>
	<option value="Linen_Textured_Writing">Linen/Textured Writing</option>
	<option value="Label_Matte">Label Matte</option>
	<option value="Label_Semigloss">Label Semi-Gloss</option>
	<option value="White_Vinyl">White Vinyl (indoor/outdoor)</option>
	<option value="Adhesive_Vinyl">Adhesive Vinyl (indoor/outdoor)</option>
	<option value="Static_Cling">Static Cling</option>
	<option value="Canvas">Canvas</option>
	<option value="Water_Color">Water Color</option>
	<option value="Other">Other</option>
</select>

<p><label>Color:(choose color) </label></p>
<select name="Color">
	<option value=""></option>
	<option value="4/4">Full Color Both Sides</option>
	<option value="4/1">Full Color Front Black and White Back</option>
	<option value="4/0">Full Color One Side</option>
	<option value="1/1">Black and White Both Sides</option>
	<option value="1/0">Black and White One Side</option>
	<option value="PMS">PMS Color</option>
	<option value="Other">Other</option>
</select>    
   
<p><label>Folding:(choose folding) </label></p>
<select name="Folding">
	<option value=""></option>
	<option value="Half_Fold">Half Fold</option>
	<option value="Tri_Fold">Tri-Fold</option>
	<option value="Z-Fold">Z-Fold</option>
	<option value="Gate_Fold">Gate Fold</option>
	<option value="Accordion Fold">Accordion Fold</option>
	<option value="Other">Other</option>
</select>	
	
<p><h3>Scoring</h3></p>
<input  class="smallInput" type="radio" name="scoring" value="With_Scoring"/><p><label>Yes</label></p>
<input  class="smallInput" type="radio" name="scoring" value="No_Scoring"/><p><label>No</label></p>
	

<p><h3>Perfing</h3></p>
<input  class="smallInput" type="radio" name="perfing" value="With_perfing"/><p><label>Yes</label></p>
<input  class="smallInput" type="radio" name="perfing" value="No_perfing"/><p><label>No</label></p>
												  


<p><label>Book Binding:(choose binding)</label></p>
<select name="Binding">
	     <option value=""></option>
	     <option value="Perfect_Bound">Perfect Bound</option>
	     <option value="Saddle stitched">Saddle stitched</option>
	     <option value="3_hole_punch">3 Hole Punch</option>
	     <option value="Coil_Binding">Coil Binding</option>
	     <option value="Wire_Bind">Wire Bind</option>
	     <option value="Comb_Bind">Perfect Bound</option>
	     <option value="Other">Other</option>
</select>

<p><label>Coating:(choose your coating)</label></p>
<select name="Coating">
	    <option value=""></option>
	    <option value="High_Gloss_One_Side">High Gloss UV Coating One Side</option>
	    <option value="High_Gloss_Two_Side">High Gloss UV Coating Two Sides</option>
	    <option value="Matte_One_Side">Matte UV Coating One Side</option>
	    <option value="Matte_Two_Side">Matte UV Coating Two Side</option>
	    <option value="Gloss_Aquious">Gloss Aquious (AQ) - Large quantities required</option>
	    <option value="Gloss_Varnish">Gloss Varnish - Large quantities required</option>
</select>


<p><label>Turnaround:(choose turnaround)</label></p>
<select name="Turnaround">
	    <option value=""></option>
	    <option value="1_2_Bussiness_Days">1-2 Business Days (rush charges may apply)</option>
	    <option value="3_5_Bussiness_Days">3-5 Business Days (rush charges may apply)</option>
	    <option value="6_10_Bussiness_Days">6-10 Business Days (rush charges may apply)</option>
	    <option value="take_your_time">Take Your Time</option>
</select>

<p><h3><label>Quantity:</label></h3></p>
 <p>(even though Design Pros doesn't have a set minimum on printing, some projects do require a minimum in order to counter balance costs to produce)</p>
<input type="text" name='print_quantity'/>


<p><h3><label>Select File:</label></h3></p>
<p class="request">(please limit your files to 250MB)</p>
<input type="file" name="file[]" id="file" class=""/>
</div>
</div><!--end of print form-->
</div><!--end of tab 3-->

	<input type="submit" name="submit" id="submitBtn" value="Request Estimate" />
</form>   

</div> <!--END CONTENT-->
</div>
				

<!-- Start: navigation -->
	    <div id="general-navigation">
		  <?php include('includes/navbar.php');?>
	    </div><!-- End: navigation -->
      
      
  
      
      </div><!-- End: content -->
	    <div id="push">
		    
	    </div><!-- End: push -->
   </div><!-- End: container -->
<!-- Start: push -->

</div><!-- End: Center Wrap -->

<!-- Start: footer -->
      <div id="footer">
	      <?php include("includes/footer.php");?>
      </div><!-- End: footer -->

  <script type="text/javascript">
  // initialize plug ins
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});

   

	$(function() {
		$( "#slider-range" ).slider({
			range: true,
			min: 15,
			max: 50000,
			values: [ 500, 10000 ],
			slide: function( event, ui ) {
				$( "#budget" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			}
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
			" - $" + $( "#slider-range" ).slider( "values", 1 ) );
	});


</script>
 </body>
</html>