<?php
/**
 * Template Name: Template - Latest Events
 */
?>
<?php get_header(); ?>

<article>
<?php
    while ( have_posts() ) : the_post(); ?> 
    		<?php get_template_part('content-header'); ?>
		
    		<?php the_content(); ?> 
    <?php
    endwhile;
    wp_reset_query(); 
?>
</article>

<?php get_template_part('tribe-events/modules/bar'); ?>

<div class="excerpts fetch-excerpts four-in-row without-top-border">
<?php 			
	if ( is_front_page() )
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	else $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	
	$template_query_args = array(
		'posts_per_page' 	=> get_option( 'posts_per_page' ),
		'paged' 			=> $paged,
		'post_type'		=> 'tribe_events'
	);
	$template_query = new WP_Query( $template_query_args );
?>

<?php while ( $template_query->have_posts() ) : 
	$template_query->the_post(); 
	get_template_part('excerpt'); ?>
<?php endwhile; ?>
</div>
	
<div id="load-more" data-load_page="<?php echo intval($paged+1); ?>" data-until="<?php echo intval($template_query->max_num_pages); ?>"><?php echo get_next_posts_link( esc_html('Load More Articles','dk_insider'), $template_query->max_num_pages ); ?></div>
	
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
