<?php

   /**
    *
    * demo data imported callback function
    *
    */

    add_action( 'wp_ajax_martanian_oak_house_demo_importer', 'martanian_oak_house_demo_importer_callback' );
    function martanian_oak_house_demo_importer_callback() {

        # globals
        global $wpdb;

        # define importers flag
        if( !defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );

        # load importer API
        require_once( ABSPATH .'wp-admin/includes/import.php' );

        # there is no wp_importer class?
        if( !class_exists( 'WP_Importer' ) ) {

            # get the importer class
            $class_wp_importer = ABSPATH .'wp-admin/includes/class-wp-importer.php';

            # if file exists, require it
            if( file_exists( $class_wp_importer ) ) require $class_wp_importer;
        }

        # there is not wp_import class?
        if( !class_exists( 'WP_Import' ) ) {

            # get the import class
            $class_wp_import = get_template_directory() .'/_assets/_demo-installation/_inc/wordpress-importer.php';

            # if file exists, require it
            if( file_exists( $class_wp_import ) ) require $class_wp_import;
        }

        # do we finally have wp_import class?
        if( class_exists( 'WP_Import' ) ) {

            # file with demo data
            $import_filepath = get_template_directory() .'/_assets/_demo-installation/_data/oakhouse.wordpress.2016-12-06.xml';

            # custom extend for wp_import claas
            class martanian_oak_house_import extends WP_Import {

                function martanian_oak_house_custom_theme_configuration() {

                   /**
                    *
                    * set the menus
                    *
                    */

                    $menu_locations = array();

                    $main_menu = get_term_by( 'name', esc_html( __( 'Main menu', 'martanian-oak-house' ) ), 'nav_menu' );
                    $footer_menu = get_term_by( 'name', esc_html( __( 'Footer menu', 'martanian-oak-house' ) ), 'nav_menu' );

                    if( $main_menu != false && isset( $main_menu -> term_id ) ) $menu_locations['martanian_oak_house_main_menu'] = $main_menu -> term_id;
                    if( $footer_menu != false && isset( $footer_menu -> term_id ) ) $menu_locations['martanian_oak_house_footer_menu'] = $footer_menu -> term_id;

                    set_theme_mod( 'nav_menu_locations', $menu_locations );

                   /**
                    *
                    * "reading" settings
                    *
                    */

                    $front_page = array(
                        'home' => get_page_by_title( esc_html( __( 'Home', 'martanian-oak-house' ) ) ),
                        'blog' => get_page_by_title( esc_html( __( 'Blog', 'martanian-oak-house' ) ) )
                    );

                    update_option( 'show_on_front', 'page' );

                    if( $front_page['blog'] != null && isset( $front_page['blog'] -> ID ) ) update_option( 'page_for_posts', $front_page['blog'] -> ID );
                    if( $front_page['home'] != null && isset( $front_page['home'] -> ID ) ) update_option( 'page_on_front', $front_page['home'] -> ID );

                   /**
                    *
                    * theme options
                    *
                    */

                    $theme_options = martanian_oak_house_get_all_default_theme_options( true );
                    update_option( 'martanian_oak_house_theme_options', $theme_options );

                   /**
                    *
                    * sidebars and widgets
                    *
                    */

                    $sidebar_pages_menu = get_term_by( 'name', esc_html( __( 'Sidebar pages menu', 'martanian-oak-house' ) ), 'nav_menu' );
                    $sidebar_pages_menu_id = $sidebar_pages_menu != false && isset( $sidebar_pages_menu -> term_id ) ? $sidebar_pages_menu -> term_id : 0;

                    $widgets = array(
                        'widget_categories' => array(
                            1 => array(
                                'title' => '',
                                'count' => 1,
                                'hierarchical' => 0,
                                'dropdown' => 0,
                            ),
                            '_multiwidget' => 1,
                        ),
                        'widget_search' => array(
                            1 => array(
                                'title' => '',
                            ),
                            '_multiwidget' => 1,
                        ),
                        'widget_tag_cloud' => array(
                            1 => array(
                                'title' => esc_html( __( 'Popular tags', 'martanian-oak-house' ) ),
                                'taxonomy' => 'post_tag',
                            ),
                            '_multiwidget' => 1,
                        ),
                        'widget_martanian_oak_house_popular_posts_widget' => array(
                            1 => array(
                                'posts_number' => '3',
                                'title' => esc_html( __( 'Popular posts', 'martanian-oak-house' ) ),
                            ),
                            '_multiwidget' => 1,
                        ),
                        'widget_martanian_oak_house_alternative_style_menu_widget' => array(
                            1 => array(
                                'nav_menu' => $sidebar_pages_menu_id,
                            ),
                            '_multiwidget' => 1,
                        ),
                        'widget_martanian_oak_house_call_to_action_widget' => array(
                            1 => array(
                                'button_url' => '#',
                                'background_image_url' => '',
                                'button_icon' => '',
                                'button_in_new_tab' => '',
                                'screen_1200_more' => 'background-position: 125% bottom;'. "\n" .'background-size: auto 100%;',
                                'screen_992_1199' => 'background-position: 205% bottom;'. "\n" .'background-size: auto 100%;',
                                'screen_768_991' => 'background-position: 108% 11%;'. "\n" .'background-size: auto 180%;',
                                'screen_767_less' => '',
                                'title' => esc_html( __( 'Still have any questions?', 'martanian-oak-house' ) ),
                                'content' => 'Quaeque nonumes doce est eu, antio pam compre.',
                                'button_text' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                            ),
                            2 => array(
                                'button_url' => '#',
                                'background_image_url' => '',
                                'button_icon' => '',
                                'button_in_new_tab' => '',
                                'screen_1200_more' => 'background-position: 125% bottom;'. "\n" .'background-size: auto 100%;',
                                'screen_992_1199' => 'background-position: 205% bottom;'. "\n" .'background-size: auto 100%;',
                                'screen_768_991' => 'background-position: 108% 11%;'. "\n" .'background-size: auto 180%;',
                                'screen_767_less' => '',
                                'title' => esc_html( __( 'Still have any questions?', 'martanian-oak-house' ) ),
                                'content' => 'Quaeque nonumes doce est eu, antio pam compre.',
                                'button_text' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                            ),
                            '_multiwidget' => 1,
                        ),
                        'sidebars_widgets' => array(
                            'wp_inactive_widgets' => array(),
                            'blog-sidebar' => array(
                                0 => 'categories-1',
                                1 => 'search-1',
                                2 => 'martanian_oak_house_call_to_action_widget-2',
                                3 => 'martanian_oak_house_popular_posts_widget-1',
                                4 => 'tag_cloud-1',
                            ),
                            'pages-sidebar' => array(
                                0 => 'martanian_oak_house_alternative_style_menu_widget-1',
                                1 => 'martanian_oak_house_call_to_action_widget-1',
                            ),
                            'array_version' => 3,
                        )
                    );

                    update_option( 'widget_categories', $widgets['widget_categories'] );
                    update_option( 'widget_search', $widgets['widget_search'] );
                    update_option( 'widget_tag_cloud', $widgets['widget_tag_cloud'] );
                    update_option( 'widget_martanian_oak_house_popular_posts_widget', $widgets['widget_martanian_oak_house_popular_posts_widget'] );
                    update_option( 'widget_martanian_oak_house_alternative_style_menu_widget', $widgets['widget_martanian_oak_house_alternative_style_menu_widget'] );
                    update_option( 'widget_martanian_oak_house_call_to_action_widget', $widgets['widget_martanian_oak_house_call_to_action_widget'] );
                    update_option( 'sidebars_widgets', $widgets['sidebars_widgets'] );

                   /**
                    *
                    * end of custom configurations
                    *
                    */
                }
            }

            # create an object
            $wp_import = new martanian_oak_house_import();

            # fetch the demo data attachments
            $wp_import -> fetch_attachments = true;

            # import
            $wp_import -> import( $import_filepath );

            # handle our custom function
            $wp_import -> martanian_oak_house_custom_theme_configuration();
        }

        # finish the function
        die();
    }

   /**
    *
    * end of file.
    *
    */

?>