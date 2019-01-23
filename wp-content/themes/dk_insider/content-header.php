<div class="entry-header">
			
	<!-- Categories ___-->
	<div class="entry-meta">
		<?php if ( get_post_type() == 'tribe_events' ): ?>
			<p class="large-event-date"><?php echo tribe_events_event_schedule_details(); ?></p>
		<?php endif; ?>
		<?php if ( has_category() ): ?>
			<strong><?php the_category(', '); ?></strong>
		<?php endif; ?> 
	</div>
				
	<!-- Heading ___-->
	<h2><?php the_title(); ?></h2>
	
	<!-- Excerpt ___-->
	<div class="entry-excerpt">
		<?php if ( get_post_type() == 'tribe_events' ): ?>
			<strong class="uppercase"><?php echo tribe_get_venue(); ?></strong><br />
			<?php echo tribe_get_full_address(); ?>
		<?php elseif ( has_excerpt() ): ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
	</div>
	
	<!-- Image ___-->
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="featured-image">
		<?php get_the_image( array( 'size' => 'insider_featured', 'link_to_post' => false )); ?>
	</div>
	<?php endif; ?>
</div>