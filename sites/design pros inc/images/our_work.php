<? include('includes/functions.php');?>

<?php include('includes/header.php'); ?> 

<meta name="description" content="Portfolio Work, this is where we showcase our Web Design, Graphic Design, Print Solutions, and more!">

<meta name="keywords" content="portfolio, display, showcase, show, look, web, website, design, graphic, graphics, creativity, creative, print, printing, Orange County">

<script type="text/javascript" src="js/jquery.tools.min.js"></script>

<script type="text/javascript">



$(document).ready(function() {

// main vertical scroll

$("#main").scrollable({



	// basic settings

	vertical: true,



	// up/down keys will always control this scrollable

	keyboard: 'static',



	// assign left/right keys to the actively viewed scrollable

	onSeek: function(event, i) {

		horizontal.eq(i).data("scrollable").focus();

	}



// main navigator (thumbnail images)

}).navigator("#main_navi");



// horizontal scrollables. each one is circular and has its own navigator instance

var horizontal = $(".scrollable").scrollable({ circular: true }).navigator(".navi").autoscroll({interval: 4000});;





// when page loads setup keyboard focus on the first horzontal scrollable

horizontal.eq(0).data("scrollable").focus();



});</script>



<!-- End JavaScript -->

<style>

/* main vertical scroll */

	#slideContainer {

	      width:920px;

	      margin:auto;

	      position:relative;

	}

	

	#main {

		position:relative;

		overflow:hidden;

		height: 460px;

		-moz-box-shadow:2px 2px 4px #555;

		-webkit-box-shadow:2px 2px 4px #555;

		box-shadow:2px 2px 4px #555;

	}

	

/* root element for pages */

	#pages {

		position:absolute;

		height:20000em;

	}

	

/* single page */

	.page {

		     background-color:#D0D2D3;

		     height: 475px;

		     padding: 20px;

		     width: 720px;

	}

	

/* root element for horizontal scrollables */

	.scrollable {

		position:relative;

		overflow:hidden;

		width: 720px;

		height: 410px;

		top:-15px;

	}

	

/* root element for scrollable items */

	.scrollable .items {

		width:20000em;

		position:absolute;

		clear:both;

	}

	

/* single scrollable item */

	.item {

		float:left;

		cursor:pointer;

		width:720px;

		height:410px;

		padding:0px;

	}

	

/* main navigator */

	#main_navi {

		float:right;

		padding:0px !important;

		margin:0px !important;

		-moz-box-shadow:2px 2px 4px #555;

		-webkit-box-shadow:2px 2px 4px #555;

		box-shadow:2px 2px 4px #555;

		position:relative;

	        z-index:100;

	}

	

	#main_navi li {

	      background-color: #FFFFFF;

	      color: #D0D2D3;

	      cursor: pointer;

	      font-size: 10px;

	      height: 45px;

	      list-style-type: none;

	      padding: 10px;

	      width: 140px;

       }

	#main_navi li:hover {background-color:#B7B9B9;color:#A9181E;}

	#main_navi li.active {background-color:#D0D2D3;color:#DA2128;}

	#main_navi img { float:left; margin-right:10px;}

	#main_navi strong {display:block;}

	

	#main div.navi {

		     cursor: pointer;

       float: right;

       position: relative;

       right: 0px;

       top: 415px;

	}

	

	

	

.navi a {

    background: url("images/navigator.jpg") no-repeat scroll -1px -34px transparent;

    display: block;

    float: left;

    font-size: 1px;

    height: 15px;

    margin-left: 5px;

    width: 15px;

}

.navi a:hover {background: url("images/navigator.jpg") no-repeat scroll -1px -17px transparent;}

.navi a.active {background: url("images/navigator.jpg") no-repeat scroll -1px -0px transparent;}

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

     </div><!-- End: header -->	  	   



<!-- Start: content -->

<div id="content">

   

   

<!-- slide Container-->

<div  id="slideContainer">

<!-- main navigator -->

<ul id="main_navi">



	<li class="active">PRINT MEDIA</li>

	<li>BRANDING</li>

	<li>SIGNS/BANNERS/<br />TRADESHOW</li>

	<li>GREETINGCARDS/<br />INVITATIONS

	<li>WEBSITES</li>

	<li>CLOTHING</li>

</ul>



<!-- root element for the main scrollable -->

<div id="main">



	<!-- root element for pages -->

	<div id="pages">

	      <!-- page #1 --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

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

							       </div>

			    </div>	

			    

	

	      <!-- page #2 branding --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

							       <!-- items on the first page  -->

													 <div class="item"> <img src="images/work/branding/cjt.jpg"> </div>

													 <div class="item"> <img src="images/work/branding/gropech.jpg"> </div>

													 <div class="item"> <img src="images/work/branding/moxxor.gif"> </div>

													 <div class="item"> <img src="images/work/branding/iwillenergy.jpg"> </div>

													 <div class="item"> <img src="images/work/branding/public_modesl.jpg"> </div>

													 <div class="item"> <img src="images/work/branding/caliplate.gif"> </div>

													 <div class="item"> <img src="images/work/branding/suns_natural.jpg"> </div>

													

											   </div>

							       </div>

			    </div>	

			



	      <!-- page #3 Signs and Banners --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

							       <!-- items on the first page  -->

													 <div class="item"> <img src="images/work/signs/moxxor.jpg"> </div>

													 <div class="item"> <img src="images/work/signs/ckd.jpg"> </div>

													 <div class="item"> <img src="images/work/signs/ccp_banner.jpg"> </div>

													 													 </div>

							       </div>

			    </div>



	      <!-- page #4 greeting cards and invites --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

							       <!-- items on the first page  -->

													 <div class="item"> <img src="images/work/invites/ayla.jpg"> </div>

													 <div class="item"> <img src="images/work/invites/annalia.jpg"> </div>

													 <div class="item"> <img src="images/work/invites/anna.jpg"> </div>

													

											   </div>

							       </div>

			    </div>



	      <!-- page #5 Websites --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

							       <!-- items on the first page  -->

													 <div class="item"> <img src="images/work/web/Dribble_Pro_Front.jpg"> </div>

													 <div class="item"> <img src="images/work/web/cjt_web.jpg"> </div>

													 <div class="item"> <img src="images/work/web/pinkys.jpg"> </div>

												 	 <div class="item"> <img src="images/work/web/CitylifeHome-site.jpg"> </div>

													 <div class="item"> <img src="images/work/web/Karens-Custom-Frames.jpg"> </div>

													 <div class="item"> <img src="images/work/web/MexMen-Djs.jpg"> </div>

													 <div class="item"> <img src="images/work/web/moxx_america_web.jpg"> </div>

													 <div class="item"> <img src="images/work/web/moxx_pharmacy.jpg"> </div>

													 <div class="item"> <img src="images/work/web/OC-Fabrics.jpg"> </div>


													 <div class="item"> <img src="images/work/web/pnp_web.jpg"> </div>

													 <div class="item"> <img src="images/work/web/drdecalsweb.jpg"> </div>

													 <div class="item"> <img src="images/work/web/Stepping-Stone-Therapy.jpg"> </div>
													

											   </div>

							       </div>

			    </div>

	      

	      	      <!-- page #6 Clothing --><div class="page">

			    <!-- sub navigator #1 --><div class="navi"></div>

				   <!-- inner scrollable #1 --><div class="scrollable">

						 <!-- root element for scrollable items --><div class="items">

							       <!-- items on the first page  -->

													 <div class="item"> <img src="images/work/shirts/drdecal.jpg"> </div>

													 <div class="item"> <img src="images/work/shirts/californiaplate.jpg"> </div>

													 <div class="item"> <img src="images/work/shirts/allornothing.jpg"> </div>

													 

											   </div>

							       </div>

			    </div>





	</div><!-- pages end-->



</div><!--main End-->



</div><!--End of Slide Container-->





</div> <!--END CONTENT-->



				



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



 </body>

</html>