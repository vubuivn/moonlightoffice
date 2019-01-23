<?php

/* Load the core theme framework. */
require_once( get_template_directory() . '/library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'insider_theme_setup' );

/**
 * Theme setup function adds support for theme features and defines the default theme actions and filters.
 */
function insider_theme_setup() {

	/* Load files. */
     require_once( get_template_directory() . '/theme-functions/theme.php' );
     require_once( get_template_directory() . '/theme-functions/customize.php' );
	
	/* Title tag	. */
	add_theme_support( 'title-tag' );
	
	/* Custom logo	. */
	add_theme_support( 'custom-logo' );
	
	/* The best thumbnail/image/attachments script ever. */
	add_theme_support( 'get-the-image' );
	
	/* Pagination. */
	add_theme_support( 'loop-pagination' );
	
	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Register menus. */
	add_theme_support( 'hybrid-core-menus', array( 'primary' ) );
	
	/* Intenationalizing. */
	load_theme_textdomain('dk_insider', get_template_directory() . '/languages');
	
	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 640 );
	
	/* Gutenberg */
	add_theme_support( 'editor-styles' );
	add_editor_style(  'style-editor.css' );
	add_theme_support( 'align-wide' );

}

?>
