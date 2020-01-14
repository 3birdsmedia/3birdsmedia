<? include('includes/functions.php');?>

<?php include('includes/header.php'); ?> 

<meta name="description" content="Portfolio Work, this is where we showcase our Web Design, Graphic Design, Print Solutions, and more!">

<meta name="keywords" content="portfolio, display, showcase, show, look, web, website, design, graphic, graphics, creativity, creative, print, printing, Orange County">
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="js/jquery.tiny.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#main').fadeIn('slow');

       
       $('#slider1').bxSlider({infiniteLoop: true, pagerLocation: 'top', pager: true, auto: true });
       $('#slider2').bxSlider({infiniteLoop: true, pagerLocation: 'top',   pager: true });
       $('#slider3').bxSlider({infiniteLoop: true, pagerLocation: 'top',   pager: true });
       $('#slider4').bxSlider({infiniteLoop: true, pagerLocation: 'top',   pager: true });
       $('#slider5').bxSlider({infiniteLoop: true, pagerLocation: 'top',   pager: true });
       $('#slider6').bxSlider({infiniteLoop: true, pagerLocation: 'top',   pager: true });
        
    });
</script>




<!-- End JavaScript -->

<style>

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
	      	     <!-- slide Container-->
		     <div  id="slideContainer">
	      		     <!-- main navigator -->
			         
			    <div id="slider-code">
				        
				   <ul id="main_navi" class="pager">
					   <li><a rel="0" class="pagenum" href="#">PRINT MEDIA</a></li>
					   <li><a rel="1" class="pagenum" href="#">BRANDING</a></li>
					   <li><a rel="2" class="pagenum" href="#">SIGNS/BANNERS/<br />TRADESHOW</a></li>
					   <li><a rel="3" class="pagenum" href="#">GREETINGCARDS/<br />INVITATIONS</a></li>
					   <li><a rel="4" class="pagenum" href="#">WEBSITES</a></li>
					   <li><a rel="5" class="pagenum" href="#">CLOTHING</a></li>
				   </ul>
				   
				   <div class="viewport">
					  <ul class="overview">
						 
						 
						 <!-- page #1 -->
						 <div id="slider1" class="page"> 
							<!-- items on the first page  -->
							 <div class="item"> <img src="images/work/print/dribblepro.jpg"> </div>
							 <div class="item"> <img src="images/work/print/truecolors.jpg"> </div>
							 <div class="item"> <img src="images/work/print/moxxor.jpg"> </div>
							 <div class="item"> <img src="images/work/print/cjt_sheets.jpg"> </div>
							 <div class="item"> <img src="images/work/print/dr_decal.jpg"> </div>
							 <div class="item"> <img src="images/work/print/gts_coupons.jpg"> </div>
							 <div class="item"> <img src="images/work/print/harbor.jpg"> </div>
							 <div class="item"> <img src="images/work/print/thedoctors.jpg"> </div>
							 <div class="item"> <img src="images/work/print/jay_calvert.jpg"> </div>
							 <div class="item"> <img src="images/work/print/roxbury.jpg"> </div>
							 <div class="item"> <img src="images/work/print/aecp.jpg"> </div>
							 <div class="item"> <img src="images/work/print/acg.jpg"> </div>
							 <div class="item"> <img src="images/work/print/localhype.jpg"> </div>
							 <div class="item"> <img src="images/work/print/quick.jpg"> </div>
							 <div class="item"> <img src="images/work/print/series7.jpg"> </div>
							 <div class="item"> <img src="images/work/print/testeachers.jpg"> </div>
							 <div class="item"> <img src="images/work/print/testeachersce.jpg"> </div>
						 </div>	
						 <!-- page #2 branding -->
						 <div id="slider2" class="page">
							 <div class="item"> <img src="images/work/branding/cjt.jpg"> </div>
							 <div class="item"> <img src="images/work/branding/gropech.jpg"> </div>
							 <div class="item"> <img src="images/work/branding/moxxor.gif"> </div>
							 <div class="item"> <img src="images/work/branding/iwillenergy.jpg"> </div>
							 <div class="item"> <img src="images/work/branding/public_modesl.jpg"> </div>
							 <div class="item"> <img src="images/work/branding/caliplate.gif"> </div>
							 <div class="item"> <img src="images/work/branding/suns_natural.jpg"> </div>
						 </div>	
						 <!-- page #3 Signs and Banners -->
						 <div id="slider3" class="page">
							 <div class="item"> <img src="images/work/signs/moxxor.jpg"> </div>
							 <div class="item"> <img src="images/work/signs/counterdisplays.jpg"> </div>
							 <div class="item"> <img src="images/work/signs/ckd.jpg"> </div>
							 <div class="item"> <img src="images/work/signs/ccp_banner.jpg"> </div>
							 <div class="item"> <img src="images/work/signs/truecolors.jpg"> </div>
							 <div class="item"> <img src="images/work/signs/cerritos.jpg"> </div>
						 </div>
				   		 <!-- page #4 greeting cards and invites -->
						 <div id="slider4" class="page">
						 	 <div class="item"> <img src="images/work/invites/ayla.jpg"> </div>
							 <div class="item"> <img src="images/work/invites/annalia.jpg"> </div>
							 <div class="item"> <img src="images/work/invites/anna.jpg"> </div>
						 </div>
						 <!-- page #5 Websites -->
						 <div id="slider5" class="page">
							 <div class="item"><a href="http://www.dribblepro.com/" target="_blank" ><img src="images/work/web/Dribble_Pro_Front.jpg"></a> </div>
							 <div class="item"><a href="http://www.cjtmounting.com" target="_blank" > <img src="images/work/web/cjt_web.jpg"> </a></div>
							 <div class="item"><a href="http://www.pinkysworkbench.com" target="_blank" > <img src="images/work/web/pinkys.jpg"> </a></div>
							 <div class="item"><a href="#" target="_blank" > <img src="images/work/web/CitylifeHome-site.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/Karens-Custom-Frames.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/MexMen-Djs.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/moxx_america_web.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/moxx_pharmacy.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/OC-Fabrics.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/pnp_web.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/drdecalsweb.jpg"> </a></div>
							 <div class="item"><a href="http://www." target="_blank" > <img src="images/work/web/Stepping-Stone-Therapy.jpg"> </a></div>
						 </div>
						 <!-- page #6 Clothing -->
						 <div id="slider6" class="page">
							 <div class="item"> <img src="images/work/shirts/drdecal.jpg"> </div>
							 <div class="item"> <img src="images/work/shirts/californiaplate.jpg"> </div>
							 <div class="item"> <img src="images/work/shirts/allornothing.jpg"> </div>
						 </div>
					  </ul>
				   </div>

			    </div><!--SLider CODE-->
				   
				   
		     </div><!--End of Slide Container-->
	      </div> <!--END CONTENT-->
<!-- Start: navigation -->

		  <?php include('includes/navbar.php');?>
	      <div id="push">	    </div><!-- End: push -->

   </div><!-- End: container -->

</div><!-- End: Center Wrap -->



<!-- Start: footer -->

      <div id="footer">

	      <?php include("includes/footer.php");?>

      </div><!-- End: footer -->

<script type="text/javascript">
   	$(document).ready(function(){
				
		$('#slider-code').tinycarousel({axis: 'y', pager: true});
		
	});

</script>

 </body>

</html>