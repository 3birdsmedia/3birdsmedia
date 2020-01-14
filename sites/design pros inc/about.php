<? include('includes/functions.php');?>
<?php include('includes/header.php'); ?>
<style type="text/css">
#one-column ul{
       list-style:disc !important;
       margin-left:15px;
       font-size:0.8em;
       line-height:1.5  
}
#one-column li{margin-bottom:10px;}
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

      

<!-- Start: right-cont -->
	   <div id="one-column">
	      <h2>ABOUT US</h2>

<p>Our mission is to create effective, compelling, and unique identity packages. We have developed processes focused on usability while maintaining a strong commitment to our clients' goals, schedule, and budget.
</p>
<p>At Design Pros we have successfully designed and developed identities for many small to large companies. An identity is the MOST important part of a business. So don't trust your image to the kid down the street, leave it to the professionals at Design Pros, Inc.
</p>

  <div id="accordion">
							 <div>
							      <h3><a href="#">OUR TEAM</a></h3>
							      <div>
								      <p>We have assembled a team of talented, creative professionals with diverse backgrounds of work and creative experiences. Our team has expertise ranging from advertising, marketing and sales to web and graphic design. We combine this knowledge along with foresight and strategic planning to approach new challenges with your overall business goals in mind.
</p>

								      <p>We strive to understand your business so we can respond to your questions as your business and technology evolves. That's what makes Design Pros, Inc. different.</p>

								      <p>Design Pros is a Concept to Completion company which uses in-house creative and technical talent as well as hand-picked vendors to offer full-service marketing and branding services to small, medium and large enterprises, as well as government agencies and non-profit organizations. Our design and marketing services include:</p>
								      <ul>
									     <li>Brand development/rebranding</li>
									     <li>Web design and development</li>
									     <li>Interactive presentations and media</li>
									     <li>Graphic design, illustrations and 3-D modeling</li>
									     <li>Logos and corporate identity</li>
									     <li>Exhibit design and hardware</li>
									     <li>Advertising campaigns</li>
									     <li>Direct mail</li>
									     <li>Full Service Digital and Offset Printing</li>
								      </ul>
							       </div>
							</div>
							
							<div>
							      <h3><a href="#">DESIGN PROS ADVANTAGES:</a></h3>
							      <div>
								      <ul>
									     <li>Design Pros has a proven process that has been built and refined over 8 years. We take the time to get to know our customers and their marketing objectives from an unbiased outsider's perspective. We combine our knowledge, our customers' own perspectives and, quite often, their customers' perspectives to create an effective marketing strategy. This process helps us create a unique "branding blueprint" that gives all members of the creative team valuable insight and creates a foundation from which to design, develop and implement contracted media.
									     </li>
									     <li>Another reason to choose Design Pros is the quality of our current and past work. We invite you to take a look and form your own opinion. We specialize in more than a few industries, as limiting ourselves to just a few could result in a lack of creativity and true insight as well as the possibility of our work competing with itself. The truth is that you don't want your marketing company to know your business too well. It would lose a true outsider's perspective if it did...and that perspective is exactly what's required to build a successful branding or rebranding campaign.
									     </li>
									     <li>Another of our core competitive advantages is the talent of the people we employ. Each member of our team has been hand-picked by the owners of Design Pros. We hire the best talent and train them to think outside the box and to focus on results and clarity over fancy design with no apparent conversion goals or marketing direction.
									     </li>
									     To learn more about how Design Pros can assist your organization, or to discuss ideas and branding strategies with us, just give us a call at 714-850-8833 or email sales@DesignPros-Inc.com.
									     </ul>
							       </div>
							</div>
							
							<div>
							       <h3><a href="#">INDUSTRIES SERVED:</a></h3>
							       <div>
								      <p>With over 500 successful marketing/branding projects completed it is impossible to show all our customers and work online; however, some of projects are available in our online portfolio. Industries we have worked with recently:
								      <ul>
									     <li>Retail/Wholesale</li>
									     <li>Technology</li>
									     <li>Legal/Financial</li>
									     <li>Federal & Local Governments</li>
									     <li>Associations and Non Profits</li>
									     <li>Hospitality & Service</li>
									     <li>Real Estate/Construction</li>
									     <li>Medical Related</li>
									     <li>Beauty & Healthcare
									     <li>Sports & Gaming</li>
									     <li>Distributors</li>
									     <li>and Much More!</li>
								      </ul>
							       </div>
							</div>
		     </div><!-- End of Accordion-->							      
	   </div><!-- End: right-cont -->
      
   
      
<!-- Start: right-cont -->
	   <div id="right-cont">
		   
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
    <script type="text/javascript">
  // initialise plugins
	    $(function(){
				// Accordion
				$("#accordion").accordion({ header: "h3",
							  active: 0,
							  animated: 'fade',
							  autoHeight: false,
							  <?php getpost('acc');?>
							  collapsible: true
							  });
			});
	    
  
 
	
</script> 
 </body>
</html>