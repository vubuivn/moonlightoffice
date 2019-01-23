<div class="excerpt <?php if ( !has_post_thumbnail()) echo 'no-featured-image'; ?>">
	
		<!-- Date ___-->
		<?php if ( get_post_type() == 'tribe_events' ): ?>
		<div class="event-date">
			<p class="large-event-date"><?php echo tribe_events_event_schedule_details(); ?></p>
		</div>
		<?php endif; ?>
		
		<!-- Thumb ___-->	
		<div class="featured-image-excerpt">
			<a href="<?php the_permalink(); ?>">
				<?php get_the_image( array( 'size' => 'post-thumbnail', 'link_to_post' => false ) ); ?>
			</a>
		</div>
		
		<div class="entry-header">
			
			<!-- Categories ___-->
			<div class="entry-meta">
				<?php if ( get_post_type() == 'tribe_events' ): ?>
				<strong><?php echo tribe_get_city();?>, <?php echo tribe_get_country(); ?></strong>
				<?php endif; ?>
				<?php if ( has_category() ): ?>
				<strong><?php the_category(', '); ?></strong>
				<?php endif; ?>
				<?php if ( get_post_type() == 'tribe_events' ): ?>
				<span class="event-venue"> &nbsp; &bull; &nbsp; <?php echo tribe_get_venue();?></span>
				<?php endif; ?>
				<?php if ( get_post_type() == 'post' ): ?>
				<span class="entry-date"> &nbsp; &bull; &nbsp;
				<?php the_time(get_option( 'date_format' )) ?></span> 
				<a href="<?php the_permalink(); ?>" class="entry-read-time">
					<span>&nbsp; &bull; &nbsp;</span>
					<?php echo insider_estimated_reading_time() . ' ' . esc_html('read', 'dk_insider'); ?>
				</a>
				<?php endif; ?>
			</div>
			
			<!-- Heading ___-->
			<a href="<?php the_permalink(); ?>">
				<h2><?php the_title(); ?></h2>			
			</a>
			
			<!-- Excerpt ___-->
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
			
			<?php if ( is_sticky() ): ?>
				<mark class="featured">&mdash; <?php esc_html_e('Featured', 'dk_insider'); ?> &mdash;</mark>
			<?php endif; ?>
			
		</div><!-- .entry-header -->
		
	</div>