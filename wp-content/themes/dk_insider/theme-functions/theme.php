<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, and lots of other awesome stuff that WordPress themes do.
 */
 
/* TGM Plugin Activation */
require_once( get_template_directory() . '/theme-functions/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'insider_register_required_plugins' );

/* Add some body classes */
add_filter( 'body_class','insider_attr_body' );
 
/* Register custom image sizes. */
add_action( 'init', 'insider_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'insider_register_menus', 5 );

/* Register sidebar. */
add_action( 'widgets_init', 'insider_widgets_init' );

/* Add js scripts. */
add_action( 'wp_enqueue_scripts', 'insider_load_scripts', 0 );

/* Register css styles. */
add_action( 'wp_enqueue_scripts', 'insider_load_styles', 20 );

/* Change excerpt length and more link */
add_filter( 'excerpt_more', 'insider_custom_excerpt_more');
add_filter( 'excerpt_length', function($length) { return 20; } );

/* Ajax Pagination */
add_action( 'wp_ajax_nopriv_ajax_pagination', 'insider_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'insider_ajax_pagination' );

/* Facebook Open Graph */
add_action( 'wp_head', 'insider_fb_opengraph', 5 );

/* Allow SVG in media uploader */
add_filter( 'upload_mimes', 'insider_cc_mime_types');


/**
 * Body classes.
 *
 */
function insider_attr_body( $classes ) {
	$classes[] = 'loading';
	
	if ( !is_front_page() && has_post_thumbnail() && !is_archive() && !is_search() ){
		$classes[] = 'headered';
	}
	
	/* checks if lazy load is activated */
	if ( class_exists('LazyLoadXT') ){
		$classes[] = 'lazyload';
	}
	
	if ( is_page() && !is_page_template() ) {
		$classes[] = 'page-template-default';
	}
	
	return $classes;
}

/**
 * Registers custom image sizes for the theme.
 *
 */
function insider_register_image_sizes() {
	
	/* Sets the 'post-thumbnail' size. */
	set_post_thumbnail_size( 1200, 840, true );

	/* Adds the additional image sizes. */
	add_image_size( 'insider_featured', 1600, 800, true );
} 

/**
 * Registers nav menu locations.
 *
 */
function insider_register_menus() {
	register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'dk_insider' ) );
}

/**
 * Registers sidebar.
 *
 */
function insider_widgets_init(){
	register_sidebar(
		array(
			'id'=>'footer',
			'name'=>__( 'Footer', 'dk_insider' ),
			'description'=>__('Footer for widgets.','dk_insider'),
			'before_widget'=>'<div class="widget %2$s">',
			'after_widget'=>'</div>',
			'before_title'=>'<h3>',
			'after_title'=>'</h3>'
	));
}
 
/**
 * Enqueues scripts.
 *
 */
function insider_load_scripts() {
	
	/* thickbox for images */
	if ( is_singular() ) {
		wp_enqueue_script( 'thickbox' );
	}
	/* datepicker for event search */
	if ( is_page_template() == 'template-latest-events.php' ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}
	
	/* main scripts file */
	wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array( 'jquery' ), null, true );

	/* ajaxify */
	wp_localize_script( 'theme-scripts', 'ajax_var', array(
	    'url' => admin_url('admin-ajax.php'),
	    'nonce' => wp_create_nonce('ajax-nonce'),
	    'template' => get_page_template_slug()
	));
	
	
}

/**
 * Registers custom stylesheets for the front-send.
 *
 */
function insider_load_styles() {
	
	// Load stylesheet for lightbox
	wp_enqueue_style( 'thickbox' );
	
	// Load editor-style first.
	wp_enqueue_style( 'editor-style', get_template_directory_uri() . '/style-editor.css' );
	
	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'hybrid-parent' );
	
	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );	
	
	// Load stylesheet for Events
	if ( class_exists('Tribe__Events__Main') ){ 
		if ( is_page_template() == 'template-latest-events.php' || tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' )  ) {
			wp_enqueue_style( 'insider-events', get_template_directory_uri() . '/css/events.css' );
		}
	}
}


/**
 * TGM Plugins Activation 
 *
 */
function insider_register_required_plugins() {
 
    $plugins = array(
		array(
            	'name'      => esc_html__('Lazy Load XT','dk_insider'), 
            	'slug'      => 'lazy-load-xt',  
            	'required'  => true,
		),
		array(
            	'name'      => esc_html__('The Events Calendar','dk_insider'), 
            	'slug'      => 'the-events-calendar',  
            	'required'  => false,
		),
		array(
            	'name'      => esc_html__('Gutenberg','dk_insider'), 
            	'slug'      => 'gutenberg',  
            	'required'  => false,
		),
		array(
            	'name'      => esc_html__('Widget Importer Exporter','dk_insider'), 
            	'slug'      => 'widget-importer-exporter',  
            	'required'  => false,
		),
		array(
            	'name'      => esc_html__('Simple Social Buttons','dk_insider'), 
            	'slug'      => 'simple-social-buttons',  
            	'required'  => false,
		),
		
    );
 
    $config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
 
    tgmpa( $plugins, $config );
}

/**
 * Change excerpt more link
 * 
*/
function insider_custom_excerpt_more($more) {
	return ' ...';
}

/**
 * Is post paginated?
 * 
*/
function insider_is_post_paginated() {					
	global $multipage;			
	return 0 !== $multipage;				
}

/**
 * Ajax Load More Pagination
 * 
*/
function insider_ajax_pagination() {
	
	$paged = intval($_POST['page']) - 1;
	
	/* what to fetch */
	$template = $_POST['template'];
	$already_displayed  = explode(",", $_POST['already_displayed']);
	$post_type = 'post';
	$fetch_posts = 9;
	
	/* how many posts to offset */	
	$offset = ( $paged * $fetch_posts ) + 2; 	/* Codex: Making Custom Queries using Offset and Pagination */
		
	if ( $template == 'template-latest-events.php' ){
		$post_type = 'tribe_events';
		$offset = 0;
	}
	
	/* build query */
	$blog_query_args = array(
		'posts_per_page' 	=> $fetch_posts,
		'paged' 			=> $paged,
		'post_type' 		=> $post_type,
		'orderby'     		=> 'date',
		'order'       		=> 'DESC',
		'post_status'		=> 'publish',
		'offset'			=> $offset,
		'post__not_in'		=> $already_displayed,
		'ignore_sticky_posts' => true,
		
	);
	
	$loaded_posts = new WP_Query( $blog_query_args );

   	while ( $loaded_posts->have_posts() ) { 
     	$loaded_posts->the_post();
		get_template_part('excerpt');
   	}

    	die();
}


/**
 * Estimate time required to read the article
 *
 * @return string
 */
function insider_estimated_reading_time() {
    $post = get_post();

    $words = str_word_count( strip_tags( $post->post_content ) );
    $minutes = floor( $words / 120 );
    $seconds = floor( $words % 120 / ( 120 / 60 ) );

    if ( $minutes >= 1 ) {
        $estimated_time = $minutes . ' min';
    } else {
        $estimated_time = '1 min';
    }

    return $estimated_time;
}


/**
 * Facebook OpenGraph
 * 
*/
function insider_fb_opengraph() {
	if ( is_singular() ) {
	?>    
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo strip_tags( get_the_excerpt(get_the_ID()) ); ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail'); ?>
		<?php if ($fb_image) : ?>
		<meta property="og:image" content="<?php echo esc_url( $fb_image[0] ); ?>" />
		<?php endif; ?>
		<meta property="og:type" content="<?php if ( is_single() ) { echo "article"; } else { echo "website"; } ?>" />
		<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	<?php
	}
}


/**
 * Allow SVG in media uploader
 * 
*/
function insider_cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}

	

