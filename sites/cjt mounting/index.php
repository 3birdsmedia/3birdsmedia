<?php include('includes/functions.php');
include('includes/header.php'); ?>
 <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
   <script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider({
        effect:'random', //Specify sets like: 'fold,fade,sliceDown'
        slices:5,
        animSpeed:600, //Slide transition speed
        pauseTime:7000,
        startSlide:0 //Set starting Slide (0 index)
    });
});
</script>
<!-- Start: content -->
<div id="home_bg">
       <div id="content">
	 <div id='slide-left'>
	  <img src="images/success.jpg" width='170' height='175' />
	  <h2>Success Stories</h2>
	  <p>Read what CJT's clients have to say about their mounting products and service</p>
	  <a href="javascript:success('success.php')">(Click Here)</a>
	  
	 </div>
	<div id="slider-wrapper">

            <div id="slider" class="nivoSlider">
                <img src="images/header1.jpg" alt="" />
		<img src="images/profiler_anim.gif" alt="" />
		<img src="images/turtletalk.jpg" alt="" />
		<img src="images/floor_anim.gif" alt="" />
		<img src="images/tabletbuddy.jpg" alt="" />
		<img src="images/sara.jpg" alt="" />
            </div>
            <div id="slider-layover"></div>
        
        </div>


       <div id='bottom'>
	 <div id='left-cont'>
		       <ul>
			  <li class="inforreq"><a href='contact.php#quote'><span><h2>Info Request</h2></span></a></li>
			  <li class="prodreg"><a href='contact.php#registration'><span><h2>Product Registration</h2></span></a></li>
			  </ul>
	  </div>
	 
	 <div id='middle-cont'>
	   <h3>Welcome to CJT Mounting</h3>
	   <p>CJT is a mounting company. Mounting and
	   positioning technology is our business and has
	   been for nearly 20 years. Our primary focus as
	   a company is to listen to our customers and
	   develope quality mounting and positioning
	   products that will promote the growth,
	   productivity and potential of every individual.</p>
	   
	   <a class="link" href="javascript:success('inspiration.php')">Our Inspiration</a>
	   

	   
	   
	   
	 </div>
	 
	 <div id="right-cont">
	  
	<ul>  
	  <li class="compprod"><a href='news.php'><span><h2>Company/Product News</h2></span></a></li>
	  <li class="helping"><a href='resources.php'><span><h2>CJT Helping hand</h2></span></a></li>
	</ul>
	 </div>

       </div><!-- End: bottom -->

       
       
       
       
       
      
       
 </div><!-- End: content -->      

    
       
</div><!--end home bg-->
 <!-- Start: navigation -->
       <div id="navigation">
	     <?php include('includes/navbar.php'); ?> 
       </div><!-- End: navigation -->

  <!-- Start: push -->
       <div id="push">
	       
       </div><!-- End: push -->

</div><!-- End: Center Wrap -->
             <!-- Start: footer -->
      <div id="footer">
	       <?php include('includes/footer.php'); ?>
       </div><!-- End: footer -->
 </body>
</html>