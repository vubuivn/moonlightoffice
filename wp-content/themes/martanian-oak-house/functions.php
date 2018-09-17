<?php

   /**
    *
    * theme setup
    *
    */

    add_action( 'after_setup_theme', 'martanian_oak_house_setup' );
    function martanian_oak_house_setup() {

        # load languages from "_assets/_languages" directory
        load_theme_textdomain( 'martanian-oak-house', get_template_directory() .'/_assets/_languages' );

        # add support for automatic feed links
        add_theme_support( 'automatic-feed-links' );

        # add support for "title tag"
        add_theme_support( 'title-tag' );

        # add support for post thumbnails
        add_theme_support( 'post-thumbnails' );

        # register wp_nav menus
        if( function_exists( 'register_nav_menu' ) ) {

            # main menu
            register_nav_menu( 'martanian_oak_house_main_menu', esc_html( __( 'Main Menu', 'martanian-oak-house' ) ) );

            # footer menu
            if( martanian_oak_house_get_theme_options_value( 'footer-menu-enabled', false, false ) == 'yes' ) {

                register_nav_menu( 'martanian_oak_house_footer_menu', esc_html( __( 'Footer Menu', 'martanian-oak-house' ) ) );
            }
        }
    }

   /**
    *
    * comments reply script
    *
    */

    add_action( 'comment_form_before', 'martanian_oak_house_enqueue_comments_reply' );
    function martanian_oak_house_enqueue_comments_reply() {

        # do we have "thread_comments" option?
        if( get_option( 'thread_comments' ) ) {

            # enqueue comments reply script
            wp_enqueue_script( 'comment-reply' );
      	}
    }

   /**
    *
    * setting up content width
    *
    */

    add_action( 'after_setup_theme', 'martanian_oak_house_content_width', 0 );
    function martanian_oak_house_content_width() {

        # update global variable
        $GLOBALS['content_width'] = apply_filters( 'martanian_oak_house_content_width', 640 );
    }

   /**
    *
    * enquerue scripts and styles
    *
    */

    add_action( 'wp_enqueue_scripts', 'martanian_oak_house_enqueue_scripts' );
    function martanian_oak_house_enqueue_scripts() {

        # get google api key
        $google_maps_api_key = martanian_oak_house_get_theme_options_value( 'google-maps-api-key', false, false );

        # enqueue google maps script
        wp_enqueue_script( 'google-maps', ( is_ssl() ? 'https' : 'http' ) .'://maps.google.com/maps/api/js'. ( !empty( $google_maps_api_key ) ? '?key='. esc_attr( $google_maps_api_key ) : '' ), array( 'jquery' ), null, true );

        # enqueue magnific popup script
        wp_enqueue_script( 'magnific-popup', get_template_directory_uri() .'/_assets/_libs/magnific-popup/magnific-popup.min.js', array( 'jquery' ), null, true );

        # register isotope script
        wp_enqueue_script( 'isotope-metafizzy', get_template_directory_uri() .'/_assets/_libs/isotope.pkgd.min.js', array( 'jquery' ), null, true );

        # enqueue circle progress script
        wp_enqueue_script( 'circle-progress', get_template_directory_uri() .'/_assets/_libs/circle-progress.js', array( 'jquery' ), null, true );

        # enqueue main theme functions script
        wp_enqueue_script( 'martanian-oak-house-javascript-functions', get_template_directory_uri() .'/_assets/_js/functions.js', array( 'jquery' ), null, true );

        # enqueue google font
        wp_enqueue_style( 'martanian-oak-house-fonts', martanian_oak_house_fonts_urls(), false, null );

        # enqueue font awesome stylesheet
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/_assets/_libs/font-awesome/css/font-awesome.css', false, null );

        # enqueue animate.css stylesheet
        wp_enqueue_style( 'css-animations', get_template_directory_uri() .'/_assets/_libs/animate.min.css', false, null );

        # enqueue bootstrap stylesheet
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/_assets/_libs/bootstrap/css/bootstrap.min.css', false, null );

        # enqueue magnific popup stylesheet
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/_assets/_libs/magnific-popup/magnific-popup.css', false, null );

        # enqueue main theme stylesheet
        wp_enqueue_style( 'martanian-oak-house-stylesheet', get_template_directory_uri() .'/style.css', false, null );

        # localize template directory path for scripts
        wp_localize_script( 'martanian-oak-house-javascript-functions', 'martanian_oak_house_javascript_functions_l10n', array(
            'template_directory_uri' => esc_url( get_template_directory_uri() )
        ));
    }

   /**
    *
    * register fonts
    *
    */

    function martanian_oak_house_fonts_urls() {

        # default: empty font url
        $font_url = '';

        # translators: if there are characters in your language that are not supported by chosen font(s), translate this to "off"; do not translate into your own language
        if( 'off' !== _x( 'on', 'Google font: on or off', 'martanian-oak-house' ) ) {

            # signika google font
            $font_url = add_query_arg( 'family', urlencode( 'Lato:300,300i,400,400i,700,700i,900,900i|Poppins:300,400,500,600,700&subset=latin,latin-ext,cyrillic' ), '//fonts.googleapis.com/css' );
        }

        # return result
        return( $font_url );
    }

   /**
    *
    * comments "reply" form
    *
    */

    function martanian_oak_house_comments_reply_form() {

        # current commenter
        $commenter = wp_get_current_commenter();

        # name and email required?
        $req = get_option( 'require_name_email' );

        # comment form
        comment_form( array(
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h3>',
            'comment_notes_before' => '',
            'label_submit' => esc_html( __( 'Post reply', 'martanian-oak-house' ) ),
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<input id="author" name="author" placeholder="'. esc_html( __( 'Name...', 'martanian-oak-house' ) ) .'" type="text" value="'. esc_attr( $commenter['comment_author'] ) .'" size="30" aria-required="'. esc_attr( $req ? 'true' : 'false' ) .'" />',
                'email' => '<input id="email" name="email" placeholder="'. esc_html( __( 'E-mail address...', 'martanian-oak-house' ) ) .'" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="30" aria-required="'. esc_attr( $req ? 'true' : 'false' ) .'" />',
                'url' => '<input id="url" name="url" placeholder="'. esc_html( __( 'Website URL...', 'martanian-oak-house' ) ) .'" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .'" size="30" />',
            )),
            'comment_field' => '<textarea id="comment" name="comment" placeholder="'. esc_html( __( 'Comment...', 'martanian-oak-house' ) ) .'" cols="45" rows="8" aria-required="true"></textarea>'
        ));
    }

   /**
    *
    * display the content under blog posts
    *
    */

    function martanian_oak_house_show_sections_under_the_blog( $check = false ) {

        # can we show the blog page content?
        if( ( $check == true && get_option( 'page_for_posts' ) ) || $check == false ) {

            # get the page for posts
            $posts_page = get_option( 'page_for_posts' );

            # there's no page for posts?
            if( $posts_page == false ) return false;

            # get post content
            $posts_page = get_post( $posts_page );

            # do we have it?
            if( $posts_page != null && $posts_page != false ) {

                # only the visual composer sections
                if( martanian_oak_house_is_vc_page( $posts_page -> post_content ) ) {

                    # display it
                    echo apply_filters( 'the_content', $posts_page -> post_content );
                }
            }
        }
    }

   /**
    *
    * register blog sidebar
    *
    */

    add_action( 'widgets_init', 'martanian_oak_house_register_sidebars' );
    function martanian_oak_house_register_sidebars() {

        # register blog sidebar
        register_sidebar( array(
            'name' => esc_html( __( 'Blog sidebar', 'martanian-oak-house' ) ),
            'id' => 'blog-sidebar',
            'description' => esc_html( __( 'Blog sidebar', 'martanian-oak-house' ) ),
            'before_title' => '<h4>',
            'after_title' => '</h4>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));

        # register pages sidebar
        register_sidebar( array(
            'name' => esc_html( __( 'Pages sidebar', 'martanian-oak-house' ) ),
            'id' => 'pages-sidebar',
            'description' => esc_html( __( 'Pages sidebar', 'martanian-oak-house' ) ),
            'before_title' => '<h4>',
            'after_title' => '</h4>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
    }

   /**
    *
    * load custom styles and scritps for admin page
    *
    */

    add_action( 'admin_enqueue_scripts', 'martanian_oak_house_custom_admin_scripts_and_styles' );
    function martanian_oak_house_custom_admin_scripts_and_styles( $hook ) {

        # only for "widgets.php" page
        if( $hook == 'widgets.php' ) {

            # enqueue media library
            wp_enqueue_media();

            # enqueue main theme functions script
            wp_enqueue_script( 'martanian-oak-house-javascript-admin-functions', get_template_directory_uri() .'/_assets/_js/admin.js', array( 'jquery' ), null, true );

            # localize strings for scripts
            wp_localize_script( 'martanian-oak-house-javascript-admin-functions', 'martanian_oak_house_javascript_admin_functions_l10n', array(
                'media_title' => esc_html( __( 'Select or upload image for widget', 'martanian-oak-house' ) ),
                'button' => esc_html( __( 'Use this image', 'martanian-oak-house' ) )
            ));
        }

        # enqueue custom stylesheet for widgets
        wp_enqueue_style( 'martanian-oak-house-widgets-admin-css', get_template_directory_uri() .'/_assets/_css/widgets-admin.css', false, null );

        # enqueue custom stylesheet for visual composer
        wp_enqueue_style( 'martanian-oak-house-visual-composer-admin-css', get_template_directory_uri() .'/_assets/_css/visual-composer-admin.css', false, null );

        # enqueue font awesome stylesheet
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/_assets/_libs/font-awesome/css/font-awesome.css', false, null );

        # enqueue stylesheet
        wp_enqueue_style( 'martanian-oak-house-tgmpa-css', get_template_directory_uri() .'/_assets/_css/tgmpa.css', false, null );
    }

   /**
    *
    * get the plugins activation status
    *
    */

    $martanian_oak_house_plugins_activation_status = array(
        'Visual Composer' => false,
        'Contact Form 7' => false,
        'Martanian Shortcodes' => false,
        'WPML' => false,
        'Polylang' => false
    );

    add_action( 'plugins_loaded', 'martanian_oak_house_check_plugins_activation_status' );
    function martanian_oak_house_check_plugins_activation_status() {

        # get the global array
        global $martanian_oak_house_plugins_activation_status;

        # do we have "visual composer" activated?
        if( class_exists( 'Vc_Manager' ) ) $martanian_oak_house_plugins_activation_status['Visual Composer'] = true;

        # do we have "contact form 7" activated?
        if( class_exists( 'WPCF7' ) ) $martanian_oak_house_plugins_activation_status['Contact Form 7'] = true;

        # do we have "martanian shortcodes" activated?
        if( function_exists( 'martanian_shortcodes_clear_attribute' ) ) $martanian_oak_house_plugins_activation_status['Martanian Shortcodes'] = true;

        # do we have "wpml" activated?
        if( class_exists( 'SitePress' ) ) $martanian_oak_house_plugins_activation_status['WPML'] = true;

        # do we have "polylang" activated?
        if( class_exists( 'Polylang' ) ) $martanian_oak_house_plugins_activation_status['Polylang'] = true;
    }

   /**
    *
    * check if plugin is active
    *
    */

    function martanian_oak_house_is_plugin_active( $plugin ) {

        # update plugins activation status
        martanian_oak_house_check_plugins_activation_status();

        # get the global array
        global $martanian_oak_house_plugins_activation_status;

        # there's no plugin found?
        if( !isset( $martanian_oak_house_plugins_activation_status[$plugin] ) ) return false;

        # return result
        return( $martanian_oak_house_plugins_activation_status[$plugin] );
    }

   /**
    *
    * force Visual Composer to initialize as "built into the theme"
    *
    */

    add_action( 'vc_before_init', 'martanian_oak_house_vcSetAsTheme' );
    function martanian_oak_house_vcSetAsTheme() {

        # set as theme
        vc_set_as_theme();

        # disable front-end option
        vc_disable_frontend();
    }

   /**
    *
    * get "theme mods supporter" class
    *
    */

    require_once( get_template_directory() .'/_assets/_php/theme-mods-supporter.php' );

   /**
    *
    * get custom theme content modificators functions
    *
    */

    require_once( get_template_directory() .'/_assets/_php/content-mods.php' );

   /**
    *
    * get wordpress customizer options
    *
    */

    require_once( get_template_directory() .'/_assets/_php/customizer.php' );

   /**
    *
    * get custom theme widgets
    *
    */

    require_once( get_template_directory() .'/_assets/_php/widgets.php' );

   /**
    *
    * is visual composer plugin active?
    *
    */

    if( martanian_oak_house_is_plugin_active( 'Visual Composer' ) ) {

        # get visual composer shortcodes
        require_once( get_template_directory() .'/_assets/_php/vc_map.php' );

        # get visual composer helper functions
        require_once( get_template_directory() .'/_assets/_php/vc_functions.php' );

        # get visual composer default templates
        require_once( get_template_directory() .'/_assets/_php/vc_default_templates.php' );
    }

   /**
    *
    * get languages functions
    *
    */

    require_once( get_template_directory() .'/_assets/_php/languages.php' );

   /**
    *
    * get theme options page
    *
    */

    require_once( get_template_directory() .'/_assets/_php/theme-options.php' );

   /**
    *
    * theme colors
    *
    */

    require_once( get_template_directory() .'/_assets/_php/colors.php' );

   /**
    *
    * demo data installation
    *
    */

    require_once( get_template_directory() .'/_assets/_demo-installation/demo-importer.php' );

   /**
    *
    * include TGM Plugin Activation class
    *
    */

    require_once( get_template_directory() .'/_assets/_plugins/class-tgm-plugin-activation.php' );

   /**
    *
    * register required plugins
    *
    */

    add_action( 'tgmpa_register', 'martanian_oak_house_register_required_plugins' );
    function martanian_oak_house_register_required_plugins() {

        # required plugins
        $plugins = array(
            array(
                'name' => esc_html( __( 'Martanian Shortcodes', 'martanian-oak-house' ) ),
                'slug' => 'martanian-shortcodes',
                'source' => get_stylesheet_directory() .'/_assets/_plugins/martanian-shortcodes.zip',
                'required' => true
            ),
            array(
                'name' => esc_html( __( 'WPBakery Visual Composer', 'martanian-oak-house' ) ),
                'slug' => 'js_composer',
                'source' => get_stylesheet_directory() .'/_assets/_plugins/js_composer.zip',
                'required' => true
            ),
            array(
                'name' => esc_html( __( 'Contact Form 7', 'martanian-oak-house' ) ),
                'slug' => 'contact-form-7',
                'required' => false
            )
        );

        # start the script
        tgmpa( $plugins, array(
            'id' => 'martanian-oak-house'
        ));
    }

   /**
    *
    * end of file.
    *
    */

?>