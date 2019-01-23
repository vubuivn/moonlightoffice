<?php
/* If viewing a singular page, return. */
if ( is_singular() || is_home() )
	return;
?>

<?php
/* If no posts found, return. */
if ( !have_posts() )
	return;
?>

<article class="loop-meta">
	<div class="entry-header">	
	<?php if ( is_category() ) : ?>
		<h2><?php single_cat_title(); ?></h2>
		<div class="entry-excerpt"><?php echo category_description(); ?></div>
	
	<?php elseif ( is_tag() ) : ?>
		<h2><?php esc_html_e('Tag','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php single_tag_title(); ?></div>
	
	<?php elseif ( is_tax() ) : ?>
		<h2><?php esc_html_e('Term','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php single_term_title(); ?></div>
	
	<?php elseif ( is_author() ) : ?>
		<h2><?php the_author_meta( 'nickname' ); ?></h2>
		<div class="entry-excerpt"><p><?php the_author_meta( 'description' ); ?> <br /><a href="<?php the_author_meta( 'user_url' ); ?>" target-"_blank"><?php the_author_meta( 'user_url' ); ?></a></p></div>
		
	<?php elseif ( is_search() ) : ?>
		<h2><?php esc_html_e('Search','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php echo esc_attr( get_search_query() ); ?></div>
	
	<?php elseif ( is_post_type_archive() ) : ?>
		<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
		<h2><?php esc_html_e('Post Type','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php post_type_archive_title(); ?></div>
	
	<?php elseif ( is_day() || is_month() || is_year() ) : ?>
		<?php
			if ( is_day() )
				$date = get_the_time( esc_html__( 'F d, Y', 'dk_insider' ) );
			elseif ( is_month() )
				$date = get_the_time( esc_html__( 'F Y', 'dk_insider' ) );
			elseif ( is_year() )
				$date = get_the_time( esc_html__( 'Y', 'dk_insider' ) );
		?>
		<h2><?php esc_html_e('Archive','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php echo esc_attr($date); ?></div>
	
	<?php elseif ( is_archive() ) : ?>
		<h2><?php esc_html_e('Archive','dk_insider'); ?> </h2>
		<div class="entry-excerpt"><?php echo esc_attr($date); ?></div>
		
	<?php endif; ?>
</div>
</article>
