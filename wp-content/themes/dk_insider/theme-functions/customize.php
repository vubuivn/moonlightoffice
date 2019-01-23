<?php

/* Theme Customizer setup. 
 * This hook allows you define new Theme Customizer sections, settings, and controls.
 *
 */

add_action( 'customize_register', 'insider_customize_register' );

function insider_customize_register( $wp_customize ) {

	/* Enable live preview for WordPress theme features. */
	$wp_customize->get_setting( 'blogname' )->transport = 'refresh';
	
	/* Logo */	
	$wp_customize->add_setting( 'insider_logo_size', array(
			'default' => '20px',
			'sanitize_callback' => 'sanitize_text_field',
			'description' => esc_html__( 'Maximum logo height in px', 'dk_insider' )
		)
	);
	$wp_customize->add_control( 'insider_logo_size', array(
			'label' => esc_html__( 'Logo Size', 'dk_insider' ),
			'section' => 'title_tagline',
			'settings' => 'insider_logo_size',
			'type' => 'text'
        )
	);
	

	/* Font Customizer */
	// SECTION
	$wp_customize->add_section( 'insider_font' , array(
		'title'      => esc_html__( 'Font', 'dk_insider' ),
		'priority'   => 30,
		'description' => esc_html__( 'Choose your fonts from google.com/fonts', 'dk_insider' )
	) );
	
	
	/* Font family dropdown */
	// SETTING
	$wp_customize->add_setting( 'google_font', array(
			'default' => 'Nunito',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting( 'google_font_weights', array(
			'default' => '400,700',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting( 'google_font_2', array(
			'default' => 'Playfair Display',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting( 'google_font_2_weights', array(
			'default' => '400,700',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_setting( 'google_fonts_subset', array(
			'default' => 'latin',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	// CONTROLS
	$wp_customize->add_control( 'google_font', array(
			'label' => esc_html__( 'Google Font', 'dk_insider' ),
			'section' => 'insider_font',
			'settings' => 'google_font',
			'type' => 'text'
        )
	);
	$wp_customize->add_control( 'google_font_weights', array(
			'label' => esc_html__( 'Google Font Weights', 'dk_insider' ),
			'section' => 'insider_font',
			'settings' => 'google_font_weights',
			'type' => 'text'
        )
	);
	$wp_customize->add_control( 'google_font_2', array(
			'label' => esc_html__( 'Google Font', 'dk_insider' ),
			'section' => 'insider_font',
			'settings' => 'google_font_2',
			'type' => 'text'
        )
	);
	$wp_customize->add_control( 'google_font_2_weights', array(
			'label' => esc_html__( 'Google Font Weights', 'dk_insider' ),
			'section' => 'insider_font',
			'settings' => 'google_font_2_weights',
			'type' => 'text'
        )
	);
	$wp_customize->add_control( 'google_fonts_subset', array(
			'label' => esc_html__( 'Character Subset', 'dk_insider' ),
			'section' => 'insider_font',
			'settings' => 'google_fonts_subset',
			'type' => 'select',
			'choices' => array(
		            'latin' => 'Latin (latin)',
		            'latin-ext' => 'Latin Extended (latin-ext)',
		            'greek' => 'Greek (greek)',
		            'greek-ext' => 'Greek Extended (greek-ext)',
		            'vietnamese' => 'Vietnamese (vietnamese)',
		            'cyrillic-ext' => 'Cyrillic Extended (cyrillic-ext)',
		            'cyrillic' => 'Cyrillic (cyrillic)'
		        )
		)
	);
	

	
	/* Footer */
	// SECTION
	$wp_customize->add_section( 'insider_footer' , array(
		'title'      => esc_html__( 'Footer', 'dk_insider' ),
		'priority'   => 100,
	) );
	// SETTING
	$wp_customize->add_setting( 'insider_footer_text', array( 
		'sanitize_callback' => 'balanceTags', 
		'default' => esc_html__( 'Insider &copy; Copyright 2018. All Rights Reserved. With a commitment to quality content for our community.', 'dk_insider' ) ));
	$wp_customize->add_setting( 'insider_facebook_api' , array( 'sanitize_callback' => 'esc_attr' ));
	
	$wp_customize->add_setting( 'insider_facebook' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_twitter' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_linkedin' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_youtube' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_flickr' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_skype' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_tumblr' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_dribbble' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_pinterest' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_gplus' , array( 'sanitize_callback' => 'esc_url' ));
	$wp_customize->add_setting( 'insider_instagram' , array( 'sanitize_callback' => 'esc_url' ));
	// CONTROLS
	$wp_customize->add_control( 'insider_footer_text', array(
			'label' => esc_html__( 'Copyright line', 'dk_insider' ),
			'section' => 'insider_footer',
			'settings' => 'insider_footer_text',
			'type' => 'textarea',
			'description'  => esc_html__( 'Some HTML is allowed', 'dk_insider' )
     ) );
     
	$wp_customize->add_control( 'insider_facebook_api', array(
		'label'    => esc_html__( 'Facebook APP ID', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_facebook_api',
		'description'  => esc_html__( 'For sharing. Get yours at https://developers.facebook.com/apps/', 'dk_insider' )
	) );
	
	$wp_customize->add_control( 'insider_facebook', array(
		'label'    => esc_html__( 'URL for Facebook Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_facebook'
	) );
	$wp_customize->add_control( 'insider_twitter', array(
		'label'    => esc_html__( 'URL for Twitter Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_twitter'
	) );
	$wp_customize->add_control( 'insider_linkedin', array(
		'label'    => esc_html__( 'URL for LinkedIn Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_linkedin'
	) );
	
	$wp_customize->add_control( 'insider_skype', array(
		'label'    => esc_html__( 'URL for Skype Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_skype'
	) );
	$wp_customize->add_control( 'insider_youtube', array(
		'label'    => esc_html__( 'URL for Youtube Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_youtube'
	) );
	
	$wp_customize->add_control( 'insider_flickr', array(
		'label'    => esc_html__( 'URL for Flickr Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_flickr'
	) );
	
	$wp_customize->add_control( 'insider_tumblr', array(
		'label'    => esc_html__( 'URL for Tumblr Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_tumblr'
	) );
	$wp_customize->add_control( 'insider_dribbble', array(
		'label'    => esc_html__( 'URL for Dribbble Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_dribbble'
	) );
	
	$wp_customize->add_control( 'insider_pinterest', array(
		'label'    => esc_html__( 'URL for Pinterest Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_pinterest'
	) );
	$wp_customize->add_control( 'insider_gplus', array(
		'label'    => esc_html__( 'URL for Google+ Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_gplus'
	) );
	$wp_customize->add_control( 'insider_instagram', array(
		'label'    => esc_html__( 'URL for Instagram Button', 'dk_insider' ),
		'type' 	=> 'text',
		'section'  => 'insider_footer',
		'settings' => 'insider_instagram'
	) );
	
	
	/* Color Schemer */
	$colors = array();
	$colors[] = array(
		'slug'=>'bg_color', 
		'default' => '#FBFBFB',
		'label' => esc_html__('Background Color', 'dk_insider')
	);
	$colors[] = array(
		'slug'=>'text_color', 
		'default' => '#000000',
		'label' => esc_html__('Text Color', 'dk_insider')
	);
	$colors[] = array(
		'slug'=>'widgets_bg_color', 
		'default' => '#F5F5F5',
		'label' => esc_html__('Widgets, Footer and Excerpts Background', 'dk_insider')
	);
	$colors[] = array(
		'slug'=>'header_bg_color', 
		'default' => '#202523',
		'label' => esc_html__('Header Background, if no Featured Image is selected', 'dk_insider')
	);
	$colors[] = array(
		'slug'=>'accent_color', 
		'default' => '#29ab82',
		'label' => esc_html__('Links, Buttons, Quotes', 'dk_insider')
	);
	$colors[] = array(
		'slug'=>'line_color', 
		'default' => '#DFDFDF',
		'label' => esc_html__('Delimiters, Lines', 'dk_insider')
	);
	foreach( $colors as $color ) {
		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label' => $color['label'], 
					'section' => 'colors',
					'settings' => $color['slug']
				)
			)
		);
	}
	
	
	
}

/**
 * Output settings CSS into the head.
 * 
 */
function insider_customize_css()
{	
	$bg_color = get_option('bg_color','#FBFBFB');
	$widgets_bg_color = get_option('widgets_bg_color','#F5F5F5');
	$header_bg_color = get_option('header_bg_color','#202523');
	$accent_color = get_option('accent_color','#29ab82');
	$line_color = get_option('line_color','#DFDFDF');
	$text_color = get_option('text_color','#000000');
	$logo_size = get_theme_mod('insider_logo_size','20px');

	if ( get_theme_mod('google_font') ) {
		$font = get_theme_mod('google_font','Nunito');
		$font2 = get_theme_mod('google_font_2','Playfair Display');
	}
	else {
		$font = 'Nunito';
		$font2 = 'Playfair Display';
	}
	
	$insider_custom_css = "
	
	/* Logo */
	#logo img { height: {$logo_size}; }
	
	/* Font */
	body, .editor-styles-wrapper,
	input, textarea, select, button, 
	h1, h2, h3, h4, h5, h6 { font-family: '{$font}', sans-serif; }
	blockquote, em,
	.entry-header h2, .editor-post-title__block .editor-post-title__input, 
	.entry-content > p,  .editor-styles-wrapper p, 
	.entry-content > ul, .editor-styles-wrapper ul, 
	.entry-content > ol, .editor-styles-wrapper ol, 
	.comment-content p { font-family: '{$font2}', serif; }
	
	/* Colors */
	:root {
	  --bg-color:     	  {$bg_color};
	  --widgets-bg-color: {$widgets_bg_color};
	  --header-bg-color:  {$header_bg_color};
	  --accent-color:     {$accent_color};
	  --line-color:       {$line_color};
	  --text-color:       {$text_color};
	}
	
	";
	
	wp_add_inline_style( 'hybrid-style',   $insider_custom_css );
	wp_add_inline_style( 'wp-edit-blocks', $insider_custom_css );
}

/**
 * Enqueue fonts.
 *
 */
function insider_fonts() {
	
	/* google fonts */
	if ( get_theme_mod('google_font') ) {
		$googlefonts_args = array(
			'family' => str_replace(' ', '+', get_theme_mod('google_font')).':'.get_theme_mod('google_font_weights').'|'.str_replace(' ', '+', get_theme_mod('google_font_2')).':'.get_theme_mod('google_font_2_weights'),
			'subset' => get_theme_mod('google_fonts_subset')
		);
	}
	else {
		$googlefonts_args = array(
			'family' => 'Nunito:400,700|Playfair+Display:400,700',
			'subset' => 'latin'
		);
	};
	wp_register_style( 'insider-google-fonts', add_query_arg( $googlefonts_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'insider-google-fonts' );
	
}

/* Output settings CSS into the head. */
add_action( 'wp_enqueue_scripts', 	  'insider_customize_css', 30);
add_action( 'admin_enqueue_scripts', 'insider_customize_css', 30);

/* Enqueue fonts */
add_action( 'wp_enqueue_scripts',    'insider_fonts' );
add_action( 'admin_enqueue_scripts', 'insider_fonts' );
