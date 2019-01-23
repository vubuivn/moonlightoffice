<?php if( is_singular() ):  ?>
<article <?php hybrid_attr( 'post' ); ?>>
	
	<!-- Page header __-->
	<?php get_template_part('content-header'); ?>
	
	<!-- Page content __-->
	<div class="entry-content">
		<?php the_content(); ?>
		
		<!-- Page comments __-->
		<?php if ( comments_open() ) { //at least 1 comment
			comments_template( '', true ); 
		} ?>
	</div>
	
	<!-- Page links __-->
	<?php wp_link_pages(); ?>
</article>	
	

<?php elseif( is_search() ):  ?>

	<!-- Page excerpt - displays in search results __-->
	<?php get_template_part('excerpt'); ?>

<?php endif; ?>
