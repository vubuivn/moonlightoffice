<?php if ( is_single() ) : // BLOG POST  ?>
	<article <?php hybrid_attr( 'post' ); ?>>

		<?php get_template_part('content-header'); ?>
		
		<!-- Social bar ___-->
		<div class="social-bar">
			<div class="youre-reading">
				<strong><?php esc_html_e('You are reading', 'dk_insider'); ?></strong>
				<h2><?php echo esc_attr( substr(get_the_title(), 0, 40)); ?>
				<?php if ( strlen( get_the_title() ) > 40 ) { echo "..." ;}; ?></h2>
			</div>
			<div class="social-buttons">
				<?php if ( class_exists('SimpleSocialButtonsPR') ): ?>
					<?php echo do_shortcode('[SSB]');  ?>
				<?php endif; ?>
			</div>
			
			<div class="comment-count">
				<a href="<?php comments_link(); ?>">
					<span><?php printf( _nx( '1', '%1$s', get_comments_number(), 'comments title', 'dk_insider' ), number_format_i18n( get_comments_number() ) ); ?></span>

<svg viewBox="0 0 50 50" ><path d="M25.1 5.3c-11.5 0-20.9 8.1-20.9 18.2 0 5.8 3.1 11 8 14.3L7.5 45c-.2.2.1.5.3.4a30 30 0 0 0 12.5-4.3c1.5.3 3.1.5 4.8.5 11.5 0 20.9-8.1 20.9-18.2S36.7 5.3 25.1 5.3z"></path></svg>
					
				</a>
			</div>
		</div><!-- .entry-social -->
			
		<!-- Content ___-->
		<div class="entry-content">
			
			<div class="entry-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?></a>
				<strong><?php the_author(); ?></strong>
				<strong><?php the_date(); ?></strong>
			</div>
			
			<?php the_content(); ?>
			
			<div class="entry-footer">	
				<?php if ( get_post_type() == 'tribe_events' ): ?>
				<?php if ( tribe_get_event_website_link() ): ?>
				<p class="button"><strong><?php echo tribe_get_event_website_link(); ?></strong></p>
				<?php endif; ?>
				<?php endif; ?>
					
				<?php if (insider_is_post_paginated()) : ?>
				<div class="entry-page-links">
					<?php wp_link_pages( array(
							'before'  => '<p>',
							'after'   => '</p>',
						)); ?>
				</div>
				<?php endif; ?>
				
				<?php if (has_tag()): ?>
				<div class="entry-tags">
					<p><?php the_tags(' ',' ',' '); ?></p>
				</div>
				<?php endif; ?>
				
				<!-- Comments ___-->
				<?php comments_template( '', true ); ?>
			</div><!-- .entry-footer -->
		</div><!-- .entry-content -->
		
	</article>
	
	<div id="more-excerpts">	
		<?php if ( get_post_type() == 'tribe_events' ): ?>
		<h2><?php esc_html_e('More Events for You', 'dk_insider'); ?></h2>
		<?php else : ?>
		<h2><?php esc_html_e('More Articles for You', 'dk_insider'); ?></h2>
		<?php endif; ?>
		<div class="excerpts">
		<?php
			$excerpts_args = array(
				'posts_per_page' 	=> 6,
				'post_type' 		=> get_post_type(),
				'post_status' 		=> 'publish',
				'orderby'     		=> 'meta_value_num',  
				'order'       		=> 'DESC',
				'post__not_in' 	=> array( get_the_ID() ),
				'ignore_sticky_posts' => true,
			);
			$excerpts_query = new WP_Query( $excerpts_args );
		?>
		
		<?php while ( $excerpts_query->have_posts() ) : 
			$excerpts_query->the_post(); 
			get_template_part('excerpt'); // excerpt.php ?>
		<?php endwhile; ?>
		</div>
	</div>
	
<?php else: // BLOG EXCERPT ?>

	<?php get_template_part('excerpt'); ?>

<?php endif; ?>