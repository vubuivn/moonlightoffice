<?php
/**
 * Template Name: Template - Sticky Posts
 */
?>
<?php get_header(); ?>

<article <?php hybrid_attr( 'post' ); ?>>
	
	<!-- Page header __-->
	<?php get_template_part('content-header'); ?>
	
</article>	
		
	<?php 
		// sticky posts
		$sticky = get_option( 'sticky_posts' ); 
	?>
	<div class="excerpts two-in-row without-top-border">
	<?php 			
		$s_query_args = array(
			'posts_per_page' 	  => 9999,
			'post__in'            => $sticky,
			'ignore_sticky_posts' => true
		);
		$s_query = new WP_Query( $s_query_args );
	?>
	
	<?php while ( $s_query->have_posts() ) : 
		$s_query->the_post(); 
		get_template_part('excerpt'); // excerpt.php ?>
	<?php endwhile; ?>
	</div>



<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
