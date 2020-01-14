<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
	
	 <div id='cont_header'>
	  <span class="news_header"> </span>
	 </div>
<!-- Start: content -->
       <div id="content">
	  <div id="news">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #news -->
		

<?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
