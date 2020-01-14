<?php include('includes/functions.php');

// Include Wordpress 
 define('WP_USE_THEMES', false);
 require('cjt_news/wp-load.php');
 query_posts('showposts=500');

include('includes/header.php'); ?>
	 <div id='cont_header'>
	  <span class="news_header"> </span>
	 </div>
<!-- Start: content -->
       <div id="content">
	  <div id="news">
	   
<?php while (have_posts()): the_post(); ?>
 

    <h2><?php the_title(); ?></h2>

<?php the_content(); ?>
<?php wp_get_archives() ?>
<?php posts_nav_link(); ?>
<?php endwhile; ?>
	 
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
</body>
</html>