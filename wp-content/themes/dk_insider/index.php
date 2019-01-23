<?php get_header(); // Loads the header.php template. ?>

	<?php if ( !is_front_page() && hybrid_is_plural() ) : // If viewing a multi-post page ?>
		<?php locate_template( array( 'loop-meta.php' ), true ); ?>
		<div class="excerpts without-top-border">
	<?php endif; ?>
	
	<?php if ( is_front_page() || is_home() ): ?>
		<?php get_template_part('frontloop'); // frontloop.php ?>

	<?php elseif ( have_posts() ) : // Checks if any posts were found. ?>
		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); ?>
			<?php hybrid_get_content_template(); // Loads the content-*.php template. ?>
			
		<?php endwhile; ?>
		
		<?php if ( !is_front_page() && hybrid_is_plural() ) : // If viewing a multi-post page ?>
			</div><!-- .excerpts -->
			<?php locate_template( array( 'loop-nav.php' ), true ); // Loads the nav template. ?>
		<?php endif; ?>
	
	<?php else : // If no posts were found. ?>
		<?php locate_template( array( 'loop-error.php' ), true ); // Loads the error template. ?>
	<?php endif;  ?>

<?php get_footer(); // Loads the footer.php template. ?>
