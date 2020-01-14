<?php
include('includes/functions.php');
	//check for the product_id on the query string
	if ( isset($_GET['prod_id']) && is_numeric($_GET['prod_id']) ) {
		
		//set the variable so it's easier to use later in script
		$prod_id = $_GET['prod_id']; //for troubleshooting
		
		//echo "product_id is $prod_id <br>";
	} else {
		$prod_id = 0;
		echo "No product id on the url.";
	}
	

	
	//call the db connection script, passing in the type of user.
	$conn = dbConnect('query'); 
	
	//PART 1. Get basic product info and image
	//note that we're using LEFT JOIN to get image information as well as product info
	//the ON condition is where we match up the foreign key in the image table with a primary key in the product table
	$sql = "SELECT *
			FROM products_images_lookup, images
			WHERE products_images_lookup.prod_id = $prod_id
			AND products_images_lookup.img_id = images.img_id
			ORDER BY images.img_id";
		
	//submit the SQL query to the database and get the result
	$result = $conn->query($sql) or die(mysqli_error());
	$length = $result->num_rows;
	//$row = $result->fetch_assoc();
	
$images = array();

	    while ($row = $result->fetch_assoc()) {
				//loop through the sql result, add each product_id and type_id to array to use later 
					$images[] = array( 
										'prod_id' => $row['prod_id'], 
										'img_id' => $row['img_id'] ,
										'img_url'=> $row['img_url'],
										'img_name' => $row['img_name']
									);
				
			}
			//now that we are finished with results, release the db resources to allow a new query.
			$result->free_result();
			
	  $sql2 ="SELECT * FROM products
		  WHERE products.prod_id = $prod_id";
		  
	  $result2 = $conn->query($sql2) or die(mysqli_error());
	  
	  $row2 = $result2->fetch_assoc();
	  $prod_name = $row2['prod_name'];
	  $prod_nick = $row2['prod_nick_name'];
	  $prod_tag = $row2['prod_tag'];
	  $prod_desc = $row2['prod_desc'];
	  $prod_specs = $row2['prod_specs'];
	  $prod_FAQ = $row2['prod_faq'];
	  $gallery = $row2['gallery'];
	  $prod_sheet = $row2['prod_sale_sheet'];
	  $result2->free_result();
//print_r($images);			

	   $sql3 = "SELECT *
		    FROM videos_products_lookup, videos
		    WHERE videos_products_lookup.prod_id = $prod_id
		    AND videos_products_lookup.video_id = videos.video_id
		   ORDER BY videos.video_id";
         	   //submit the SQL query to the database and get the result
		   $result3 = $conn->query($sql3); //or die(mysqli_error());
                   $length3 = $result3->num_rows;
		   //$row = $result->fetch_assoc();
		   
		    $videos = array();
	            while ($row3 = $result3->fetch_assoc()) {
		 	   //loop through the sql result, add each product_id and type_id to array to use later 
				   $videos[] = array(
						   'prod_id'  => $row3['prod_id'],
						   'video_id' => $row3['video_id']
					    
						   );
				   }
	   //now that we are finished with results, release the db resources to allow a new query.
		   $result3->free_result();

?>

<?php include('includes/header.php'); ?>
	 <div id='cont_header'>
	  <span class="prod_header"> </span>
	 </div>
<!-- Start: content -->
       <div id="content">
	 <div id="back"><a href="products.php">Back to Products</a></div>
	 
	 <?php include('includes/secondaryNav.php');?>   
	  
	<div id='prod_cont'>
	
	
	
	<div id="img-cont">
	 
	 <div class="enlarge"><span><img src="images/enlarge.jpg" /><p>Click on the image to enlarge</p></span></div> 
	 
	 <div id="prod_slide" class="svwp">
	 	  
	 <ul>
	 <?php
	 $length = count($images);		    
	    //loop through the results of the types query Part 2
	    for ($row = 0; $row < $length; $row++) {
	    
		if ($prod_id == $images[$row]['prod_id']) {
						
			//echo $images[$row]['img_name'];				      
				//needed to create these variables for inclusion in input HTML below.
				$img_id = $images[$row]['img_id'];
			     	$img_url = $images[$row]['img_url'];	      
				//building the form elements.  Create arrays for the product_id, type_id, price and quantity.
				 //regardless of how many products get shown on the page, the array index for each product/type/quantity will match.
				//add hidden field with product id
					 echo '<li><a href="images/product_images/'.$prod_nick.'/'.$img_url.'" class="lightbox"><img src="images/product_images/'.$prod_nick.'/thumb_'.$img_url.'" width="350" /></a></li>';

							    } else {
								    echo "No images found";
							    }

						    }
 
	  ?>
	 </ul>
	 </div>
	 
	 <?php if ($gallery == 'yes'){
	     echo '<div id="galleryLink"><a href="showroom.php#'.($prod_nick).'" >See '.$prod_nick.' in action</a></div>';
	  }else{
	  
	  }?>
	 
	 <!--end prod_slide-->
	</div><!--end Left cont-->
	 
	 <div class='prod_desc'>
            <h2><?php echo$prod_name; ?></h2>
            <h3><?php echo $prod_tag; ?></h3>
	    <?php echo $prod_desc; ?>
       </div>
	 
	<div id="videos">
	<?php
	   if (!empty($videos)){
	     	 echo "<form method='get'><a href=\"javascript:video('videoPop.php')\"><span>Videos</span></a></li>
		       <input type='hidden' value='$prod_id'>
		       </form>";
		       ; 
	   } else {
	           echo "";
	   }
        ?>
	 </div>	 
	</div>

	
	<div id="info">
		       <ul class="tabs">
			   <li><a href="#tab1">Product Specs</a></li>
			   <li><a href="#tab2">FAQ</a></li>
			   <li><a href="#tab3">Product Sale Sheet</a></li>
		       </ul>
	     
		       <div class="tab_container">
				<div id="tab1" class="tab_content">
				 <!--Content--><?php echo $prod_specs; ?>
				</div>
		  
				 <div id="tab2" class="tab_content">
					    <!--Content--><?php echo $prod_FAQ; ?>
				 </div>
				 
				 <div id="tab3" class="tab_content">
					    <!--Content--><?php
					   if($prod_sheet == "") {echo '';}else{echo '<li><a href="'.$prod_sheet.'"><img src="images/pdficon.jpg"></a><a href="'.$prod_sheet.'"><span>'.$prod_nick.' Sale Sheet</span></a></li>';} ?>
				 </div>
		     </div>
<script type="text/javascript">

function video(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL +'?prod_id=<?php echo $prod_id;?>', '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=500,left = 440,top = 262?prod_id='+<?php echo $prod_id;?>);");
}
</script>
	</div>

	 
       </div><!-- End: content -->
<!-- Start: navigation -->
       <div id="navigation">
	     <?php include('includes/navbar.php'); ?> 
       </div><!-- End: navigation -->
       
<!-- Start: push -->
       <div id="push"></div><!-- End: push -->
</div><!-- End: Center Wrap -->

<!-- Start: footer -->
       <div id="footer">
	       <?php include('includes/footer.php'); ?>
       </div><!-- End: footer -->
<script type="text/javascript">
$(function() {
	$('a.lightbox').lightBox(); // Select all links with lightbox class
});


$(document).ready(function() {
 
	   $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
	  $(".stripeMe tr:even").addClass("alt");


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



</script>
<div id="popup" style="display: none;"></div>
<div id="window" style="display: none;">
<div id="popup_content"><a href="#" onclick="Close_Popup();">Close</a> </div>
</div>

</body>
</html>