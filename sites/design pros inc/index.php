<? include('includes/functions.php');?>
<?php include('includes/header.php'); ?> 
<meta name="description" content="Home Page for Design Pros Inc, we do Web Design, Graphic Design, Print Solutions, and more!">
<meta name="keywords" content="home, web, website, design, graphic, graphics, creativity, creative, print, printing, Orange County">
<!-- End JavaScript -->
	<style type="text/css">
		#container
		{
			margin-bottom:-120px;
		}
		
		bx-wrapper{    height: 385px;
		 margin: auto;
		}
		.pager-active {
		    background-position: 0 -130px !important;
		    color: #FF0000 !important;
}
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
	   
   
	       <ul id="slider-wrapper">
			<li><a href="services.php?acc=0"><img src="images/graphic-banner.jpg" /></a></li>
			<li><a href="services.php?acc=1"><img src="images/web_banner.jpg" /></a></li>
			<li><a href="services.php?acc=2"><img src="images/print_banner.jpg" /></a></li>
			<li><a href="services.php?acc=3"><img src="images/Business-Solutions_graphic.jpg" /></a></li>
		</ul>
		
		
		<ul class="thumbs">
			<a href="" id='graphic_btn' ><h3 class="title">Graphic Design</h3>
				<p>Enhance your company's branding and increase your bussiness' success with strong and clean design.</p></a>
			<a href="" id='web_btn'><h3 class="title">Web Design</h3>
				<p>Make yourself known in the web world with streamline designs, SEO optimization, and the latest technologies.</p></a>
			<a href="" id='print_btn'><h3 class="title">Print</h3>
				<p>High quality printing, business cards. brochures, letterheads, cards, books,  t-shirts, you name it we do it.</p></a>
			<a href="" id='business_btn'><h3 class="title">Business Solutions</h3>
				<p>Problem solving 101,  cost solutions, branding revamp up to the highest standarts in the industry.</p></a>
		</ul>

	   <div id='loader'><a href="services.php?acc=0"><img src="images/graphic-banner.jpg" /></a></div>
	   
	   
					   
	</div><!-- End: content -->
	   <!-- Start: navigation -->

			     <?php include('includes/navbar.php');?>
		 
		 
	     
		 

	      <div id="push"></div><!-- End: push -->
	      </div><!-- End: container -->

</div><!-- End: Center Wrap -->
	   
	   <!-- Start: footer -->
		 <div id="footer">
			 <?php include("includes/footer.php");?>
		 </div><!-- End: footer -->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.bxSlider.min.js" type="text/javascript"></script>

<script type="text/javascript">
		$(document).ready(function(){
			var slider = $('#slider-wrapper').bxSlider({
				controls: false,
				mode: 'fade',
				auto: true
			});
		
			$('#graphic_btn').click(function(){
				slider.goToSlide(0);
				return false;
			});
			
			$('#web_btn').click(function(){
				slider.goToSlide(1);
				return false;
			});
			
			$('#print_btn').click(function(){
				slider.goToSlide(2);
				return false;
			});
			
			$('#business_btn').click(function(){
				slider.goToSlide(3);
				return false;
			});
			
			$('.thumbs a').click(function(){
				var thumbIndex = $('.thumbs a').index(this);
				slider.goToSlide(thumbIndex);
				$('.thumbs a').removeClass('pager-active');
				$(this).addClass('pager-active');
				return false;
			});
			
			$('.thumbs a:first').addClass('pager-active');
			
		});
				

</script>
</body>
</html>