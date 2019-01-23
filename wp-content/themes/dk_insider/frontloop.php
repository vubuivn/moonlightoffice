<?php

/* Default index (front page set to 'Latest posts') 
 * Layout:
 	 Featured post
 	 Post	Post
 	 --------------
 	 Events
 	 --------------
 	 Post Post Post
 	 Post Post Post
 	 Post Post Post
 	      ...
 */
 ?>
 
<?php $sticky = get_option( 'sticky_posts' );	//get all sticky posts ?>

<!-- 
	FEATURED POST 
-->
<div class="excerpts one-in-row without-top-border">

<?php 		
	if ( count($sticky) > 0 )	{
		/* the latest sticky post */
		$a_query_args = array(
			'posts_per_page' 	  => 1,
			'ignore_sticky_posts' => true, /* DON'T add all sticky posts to the query */
			'post__in'  		  => $sticky,
			'post_status'		  => 'publish',
			'order_by'		  => 'date',
			'order'			  => 'DESC' 
		);
	}
	else {
		/* or just the latest post */
		$a_query_args = array(
			'posts_per_page' 	  => 1,
			'ignore_sticky_posts' => true, 
			'post_status'		  => 'publish',
			'order_by'		  => 'date',
			'order'			  => 'DESC' 
		);
	}
	$a_query = new WP_Query( $a_query_args );
	$already_displayed_1 = wp_list_pluck( $a_query->posts, 'ID' );
?>

<?php while ( $a_query->have_posts() ) : 
	$a_query->the_post(); 
	get_template_part('excerpt'); // excerpt.php ?>
<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>


<!-- 
	2 LATEST POSTS 
-->
<?php
	$sticky_still_to_show = count($sticky) - 1;	
?>

<div class="excerpts two-in-row without-top-border">
<?php 			
	/* show 1 sticky and 1 latest */
	if ( $sticky_still_to_show == 1 ) {
		$b_query_args = array(
			'posts_per_page' 	=> 1,
			'post_status'		=> 'publish',
			'ignore_sticky_posts' => false, /* push the sticky post to the query */
			'offset'			=> 1,	  /* first one is already displayed */
		);
	}
	/* show 2 sticky */
	if ( $sticky_still_to_show > 1 ) {
		$b_query_args = array(
			'posts_per_page' 	=> 2,
			'post_status'		=> 'publish',	
			'post__in'  		=> get_option( 'sticky_posts' ),
			'offset'			=> 1,	  /* first one is already displayed */
			'ignore_sticky_posts' => true,
		);
	}
	/* show 2 latest posts */
	else {
		if ( count($sticky) == 1 ) { $offset = 0; } /* there was only 1 sticky post */
		else 				  { $offset = 1; } /* there was no sticky post */
		$b_query_args = array(
			'posts_per_page' 	=> 2,
			'post_status'		=> 'publish',
			'offset'			=> $offset,
			'ignore_sticky_posts' => true,
		);
	}
	$b_query = new WP_Query( $b_query_args );
	$already_displayed_2 = wp_list_pluck( $b_query->posts, 'ID' );
?>

<?php while ( $b_query->have_posts() ) : 
	$b_query->the_post(); 
	get_template_part('excerpt'); // excerpt.php ?>
<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>

<!-- 
	EVENTS 
-->
<?php 			
	$e_query_args = array(
		'post_type'		  => 'tribe_events',
		'post_status'		  => 'publish',
		'eventDisplay' 	  => 'custom',
		'posts_per_page' 	  => 4,
		'ignore_sticky_posts' => true
	);
	$e_query = new WP_Query( $e_query_args );
?>

<?php if ( $e_query->have_posts() ): ?>

<div class="excerpts four-in-row">
	<h2 class="uppercase"><?php esc_html_e('Upcoming Events', 'dk_insider'); ?></h2>
	<?php while ( $e_query->have_posts() ) : 
		$e_query->the_post(); 
		get_template_part('excerpt'); // excerpt.php ?>
	<?php endwhile; ?>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<!-- 
	ALL OTHER LATEST POSTS 
-->			

<?php
	$sticky_still_to_show = count($sticky) - 3;	
?>
<div class="excerpts fetch-excerpts">
<?php 			
	if ( is_front_page() )
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	else $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	
	$already_displayed = array_merge($already_displayed_1, $already_displayed_2);
	
	/* show all other sticky posts and all latest posts */
	$c_query_args = array(
			'posts_per_page' 	=> 9,
			'post_status'		=> 'publish',
			'paged' 			=> $paged,
			'offset'			=> 0,
			'post__not_in'		=> $already_displayed, 	/* what's been already displayed */
			'ignore_sticky_posts' => true,			/* DONT add sticky posts to the front */
		);
	
	$c_query = new WP_Query( $c_query_args );
?>

<?php while ( $c_query->have_posts() ) : 
	$c_query->the_post(); 
	get_template_part('excerpt'); // excerpt.php ?>
<?php endwhile; ?>
</div>

<?php $already_displayed = implode(",", $already_displayed); ?>
	
<div id="load-more" data-load_page="<?php echo intval($paged+1); ?>" data-until="<?php echo intval($c_query->max_num_pages); ?>" data-already_displayed="<?php echo esc_attr($already_displayed); ?>"><?php echo get_next_posts_link( esc_html('Load More Articles','dk_insider'), $c_query->max_num_pages ); ?></div>
	
<?php wp_reset_postdata(); ?>
