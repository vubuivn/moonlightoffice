<?php

   /**
    *
    * array of available intervals
    *
    */

    function martanian_oak_house_intervals() {

        # basement value
        $base = 1000;

        # results array
        $result = array();

        # loop
        for( $i = 1; $i < 31; $i++ ) {

            # update results array
            $result[] = $base * $i;
        }

        # return result
        return( $result );
    }

   /**
    *
    * array of available image positions
    *
    */

    function martanian_oak_house_image_positions() {

        # results array
        $result = array();

        # loop 0 - 100
        for( $i = 0; $i < 101; $i++ ) {

            # update results array
            $result[] = $i .'%';
        }

        # return result
        return( $result );
    }

   /**
    *
    * array of progress bar values
    *
    */

    function martanian_oak_house_progress_bar_values() {

        # results array
        $result = array();

        # loop 0 - 100
        for( $i = 0; $i < 101; $i++ ) {

            # update results array
            $result[$i .'%'] = '0.'. ( $i < 10 ? '0'. $i : $i );
        }

        # return result
        return( $result );
    }

   /**
    *
    * get list of all available post categories
    *
    */

    function martanian_oak_house_post_categories() {

        # categories
        $categories = get_categories();

        # results array
        $output = array( esc_html( __( 'Posts from all categories', 'martanian-oak-house' ) ) => '*' );

        # walk for each category
        foreach( $categories as $category ) {

            # update the output
            $output[$category -> name] = $category -> slug;
        }

        # return result
        return( $output );
    }

   /**
    *
    * get google map zoom options
    *
    */

    function martanian_oak_house_get_map_zoom_options() {

        # result array
        $result = array();

        # loop
        for( $i = 0; $i < 21; $i++ ) $result[$i] = $i;

        # return result
        return( $result );
    }

   /**
    *
    * heading slider slides per page counter
    *
    */

    $martanian_oak_house_heading_slider_slides_counter = 0;

   /**
    *
    * timeline default position
    *
    */

    $martanian_oak_house_timeline_position = 'right';

   /**
    *
    * register icon fonts from visual composer
    *
    */

    add_action( 'vc_base_register_front_css', 'martanian_oak_house_register_vc_iconfonts' );
    function martanian_oak_house_register_vc_iconfonts() {

        wp_enqueue_style( 'vc_openiconic', vc_asset_url( 'css/lib/vc-open-iconic/vc_openiconic.css' ), false, WPB_VC_VERSION );
        wp_enqueue_style( 'vc_typicons', vc_asset_url( 'css/lib/typicons/src/font/typicons.min.css' ), false, WPB_VC_VERSION );
        wp_enqueue_style( 'vc_entypo', vc_asset_url( 'css/lib/vc-entypo/vc_entypo.css' ), false, WPB_VC_VERSION );
        wp_enqueue_style( 'vc_linecons', vc_asset_url( 'css/lib/vc-linecons/vc_linecons_icons.css' ), false, WPB_VC_VERSION );
        wp_enqueue_style( 'vc_monosocial', vc_asset_url( 'css/lib/monosocialiconsfont/monosocialiconsfont.min.css' ), false, WPB_VC_VERSION );
        wp_enqueue_style( 'vc_material', vc_asset_url( 'css/lib/vc-material/vc_material.min.css' ), false, WPB_VC_VERSION );
    }

   /**
    *
    * register custom shortcodes for visual composer
    *
    */

    add_action( 'vc_before_init', 'martanian_oak_house_vc_map' );
    function martanian_oak_house_vc_map() {

       /**
        *
        * button shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Button', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_button',
            'content_element' => true,
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html( __( 'Button URL', 'martanian-oak-house' ) ),
                    'param_name' => 'button_url'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button style', 'martanian-oak-house' ) ),
                    'param_name' => 'button_style',
                    'value' => array(
                        esc_html( __( 'Transparent (on light background)', 'martanian-oak-house' ) ) => 'transparent-on-light',
                        esc_html( __( 'Transparent (on dark background)', 'martanian-oak-house' ) ) => 'transparent-on-dark',
                        esc_html( __( 'Filled color background', 'martanian-oak-house' ) ) => 'filled-color',
                        esc_html( __( 'Filled gray background', 'martanian-oak-house' ) ) => 'filled-gray'
                    ),
                    'std' => 'transparent-on-light'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Show button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'show_button_icon',
                    'std' => '',
                    'value' => array(
                        esc_html( __( 'Yes, show icon after button text', 'martanian-oak-house' ) ) => 'checked'
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'show_button_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-long-arrow-right'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance'
                )
            )
        ));

       /**
        *
        * call to action with icon: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Call to action with icon', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_call_to_action_with_icon',
            'content_element' => true,
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # content

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => 'Vestibulum eu ex ornare, iaculis tellus in, placerat nisi. Cras lobortis ac tortor tincidunt elementum. Nam ut orci ante. In id augue vel orci commodo commodo vitae et massa. Mauris congue, nibh id fermentum dictum, odio neque tempus elit, vitae sollicitudin ligula nisi quis ante. Nam id varius metus, sit amet lacinia felis. Vivamus sed ligula ut magna consequat facilisis quis ac ipsum.',
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display button', 'martanian-oak-house' ) ),
                    'param_name' => 'display_button',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Display button?', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display additional link near the button', 'martanian-oak-house' ) ),
                    'param_name' => 'display_additional_link',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Display additional link near the button?', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'display_background_icon',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Display background icon?', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),

                # button

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html( __( 'Button URL', 'martanian-oak-house' ) ),
                    'param_name' => 'button_url',
                    'std' => martanian_oak_house_get_default_button_url( esc_html( __( 'Contact', 'martanian-oak-house' ) ), esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ),
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button style', 'martanian-oak-house' ) ),
                    'param_name' => 'button_style',
                    'value' => array(
                        esc_html( __( 'Transparent (on light background)', 'martanian-oak-house' ) ) => 'transparent-on-light',
                        esc_html( __( 'Transparent (on dark background)', 'martanian-oak-house' ) ) => 'transparent-on-dark',
                        esc_html( __( 'Filled color background', 'martanian-oak-house' ) ) => 'filled-color',
                        esc_html( __( 'Filled gray background', 'martanian-oak-house' ) ) => 'filled-gray'
                    ),
                    'std' => 'transparent-on-light',
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Show button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'show_button_icon',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Yes, show icon after button text', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'show_button_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-long-arrow-right',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),

                # additional link near the button

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html( __( 'Additional link', 'martanian-oak-house' ) ),
                    'param_name' => 'additional_link',
                    'dependency' => array(
                        'element' => 'display_additional_link',
                        'value' => 'checked'
                    ),
                    'std' => martanian_oak_house_get_default_button_url( '#', esc_html( __( 'or call us now!', 'martanian-oak-house' ) ) ),
                    'group' => esc_html( __( 'Additional link', 'martanian-oak-house' ) )
                ),

                # background icon

                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Background icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'display_background_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-envelope-o',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * contact details box shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Contact details box', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_contact_details_box',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_contact_details_box_element' ),
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Feel free to contact us', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * contact details box element shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Contact details box: element', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_contact_details_box_element',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_contact_details_box' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Phone, FAX', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Value', 'martanian-oak-house' ) ),
                    'param_name' => 'value',
                    'std' => esc_html( __( '1-800-123-4567', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Size', 'martanian-oak-house' ) ),
                    'param_name' => 'size',
                    'value' => array(
                        esc_html( __( 'Normal', 'martanian-oak-house' ) ) => 'normal',
                        esc_html( __( 'Bigger', 'martanian-oak-house' ) ) => 'bigger'
                    ),
                    'std' => 'normal'
                )
            )
        ));

       /**
        *
        * contact form shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Contact form', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_contact_form',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # content

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis velit odio, consequat nec efficitur et, fringilla eget sapien. Phasellus finibus scelerisque felis. Praesent interdum risus cursus, porttitor dui vitae.',
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Contact form shortcode', 'martanian-oak-house' ) ),
                    'param_name' => 'form_shortcode',
                    'std' => martanian_oak_house_default_wpcf7_shortcode( true ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Background image side', 'martanian-oak-house' ) ),
                    'param_name' => 'background_image_side',
                    'value' => array(
                        esc_html( __( 'Left side', 'martanian-oak-house' ) ) => 'left',
                        esc_html( __( 'Right side', 'martanian-oak-house' ) ) => 'right'
                    ),
                    'std' => 'right',
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display background icon?', 'martanian-oak-house' ) ),
                    'param_name' => 'show_background_icon',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Yes, display background icon', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),

                # background icon

                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Background icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'show_background_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-envelope-o',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Background icon', 'martanian-oak-house' ) ),
                    'param_name' => 'background_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'background_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance',
                    'group' => esc_html( __( 'Background icon', 'martanian-oak-house' ) )
                ),

                # background image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * content box shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Content box', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_content_box',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'show_settings_on_create' => false,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array()
        ));

       /**
        *
        * content centered shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Content centered', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_content_centered',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'show_settings_on_create' => false,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array()
        ));

       /**
        *
        * content with image on left/right side: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Content with image on left/right side', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_content_with_image',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Image side', 'martanian-oak-house' ) ),
                    'param_name' => 'image_side',
                    'value' => array(
                        esc_html( __( 'Left', 'martanian-oak-house' ) ) => 'left',
                        esc_html( __( 'Right', 'martanian-oak-house' ) ) => 'right'
                    ),
                    'std' => 'left'
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'image'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * doctor details shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Doctor details', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_doctor_details',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # section title and motto

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Certificates', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Title and motto', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Motto', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => 'Morbi dui ligula, et velit pede turpis et quam congue orci magna hendrerit nulla ipsum pede, risus elit a leo ut orci magna non nisl felis sagittis luctus.',
                    'group' => esc_html( __( 'Title and motto', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Motto author', 'martanian-oak-house' ) ),
                    'param_name' => 'motto_author',
                    'std' => esc_html( __( 'Monica Wayne', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Title and motto', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Motto author title', 'martanian-oak-house' ) ),
                    'param_name' => 'motto_author_title',
                    'std' => esc_html( __( 'Boarder', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Title and motto', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Certificates number', 'martanian-oak-house' ) ),
                    'param_name' => 'certificates_number',
                    'value' => array(
                        esc_html( __( 'Do not display certificates', 'martanian-oak-house' ) ) => '0',
                        '1',
                        '2',
                        '3',
                        '4'
                    ),
                    'std' => '3',
                    'group' => esc_html( __( 'Title and motto', 'martanian-oak-house' ) )
                ),

                # certificate: 1

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_1_title',
                    'std' => esc_html( __( 'Quality of work', 'martanian-oak-house' ) ),
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '1',
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 1', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'URL', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_1_url',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '1',
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 1', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Date', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_1_date',
                    'std' => '09.2009',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '1',
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 1', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_1_content',
                    'std' => 'Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero malesuada id, ullamcorper id, nunc.',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '1',
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 1', 'martanian-oak-house' ) )
                ),

                # certificate: 2

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_2_title',
                    'std' => esc_html( __( 'Suspendisse turpis', 'martanian-oak-house' ) ),
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 2', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'URL', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_2_url',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 2', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Date', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_2_date',
                    'std' => '02.2010',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 2', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_2_content',
                    'std' => 'Sit putant apeirian comprehensam ne, ferri labores nec ne, ex nec vocent pertinacia. No vix mentitum qualisque consetetur, at liber oportere urbanitas cum, sint impedit corpora ei sit.',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '2',
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 2', 'martanian-oak-house' ) )
                ),

                # certificate: 3

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_3_title',
                    'std' => esc_html( __( 'Rebum quaestio et pri', 'martanian-oak-house' ) ),
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 3', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'URL', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_3_url',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 3', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Date', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_3_date',
                    'std' => '08.2016',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 3', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_3_content',
                    'std' => 'Priad quas delenit laoreet, vix ne novum disputando voluptatibus. Brute albucius similique an his. Eu cum minim vulputate rationibus, et eos eros commodo. Nunc eleifend velit.',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '3',
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 3', 'martanian-oak-house' ) )
                ),

                # certificate: 4

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_4_title',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 4', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'URL', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_4_url',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 4', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Date', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_4_date',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 4', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'certificate_4_content',
                    'dependency' => array(
                        'element' => 'certificates_number',
                        'value' => array(
                            '4'
                        )
                    ),
                    'group' => esc_html( __( 'Certificate 4', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * document shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Document', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_document',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Document title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Frequently Asked Questions', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Document sub-title', 'martanian-oak-house' ) ),
                    'param_name' => 'sub_title',
                    'std' => esc_html( __( 'PDF [divider] 13 kB', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Document URL', 'martanian-oak-house' ) ),
                    'param_name' => 'url',
                    'std' => '#'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Open document in new tab?', 'martanian-oak-house' ) ),
                    'param_name' => 'url_new_tab',
                    'std' => '',
                    'value' => array(
                        esc_html( __( 'Yes, open this document in new tab', 'martanian-oak-house' ) ) => 'checked'
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'std' => 'fontawesome'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-arrow-down'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance'
                )
            )
        ));

       /**
        *
        * double images: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Double images', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_double_images',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # left image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_image',
                    'group' => esc_html( __( 'Left image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'left_image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Left image', 'martanian-oak-house' ) )
                ),

                # right image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * faq shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'FAQ', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_faq',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'show_settings_on_create' => false,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array()
        ));

       /**
        *
        * faq element shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'FAQ group title', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_faq_group_title',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_faq' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'About us', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * faq-short shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'FAQ (short)', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_faq_short',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # background image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Background image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),

                # background image position

                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'More than 1200px width screens', 'martanian-oak-house' ) ),
                    'param_name' => 'screen_1200_more',
                    'std' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 100%;',
                    'group' => esc_html( __( 'Background image position', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( '992px - 1199px width screens', 'martanian-oak-house' ) ),
                    'param_name' => 'screen_992_1199',
                    'std' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 72%;',
                    'group' => esc_html( __( 'Background image position', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( '768px - 991px width screens (tablets)', 'martanian-oak-house' ) ),
                    'param_name' => 'screen_768_991',
                    'std' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 72%;',
                    'group' => esc_html( __( 'Background image position', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html( __( 'Less than 767px width screens (smartphones)', 'martanian-oak-house' ) ),
                    'param_name' => 'screen_767_less',
                    'std' => 'background-position: -40px bottom;'. "\n" .'background-size: auto 270px;',
                    'group' => esc_html( __( 'Background image position', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * gallery shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Gallery', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_gallery',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_gallery_element' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Gallery', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * gallery element shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Gallery element', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_gallery_element',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_gallery' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'image'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Image size', 'martanian-oak-house' ) ),
                    'param_name' => 'image_size',
                    'value' => array(
                        esc_html( __( 'Normal', 'martanian-oak-house' ) ) => 'normal',
                        esc_html( __( 'Double image width', 'martanian-oak-house' ) ) => 'double_width',
                        esc_html( __( 'Double image height', 'martanian-oak-house' ) ) => 'double_height',
                        esc_html( __( 'Double image width and height', 'martanian-oak-house' ) ) => 'double_both'
                    ),
                    'std' => 'normal'
                )
            )
        ));

       /**
        *
        * google maps: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Google maps', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_google_maps',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_google_maps_marker' ),
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Latitude', 'martanian-oak-house' ) ),
                    'param_name' => 'lat',
                    'std' => '34.061606'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Longitude', 'martanian-oak-house' ) ),
                    'param_name' => 'lng',
                    'std' => '-118.277556',
                    'description' => '<a href="'. esc_url( 'https://support.google.com/maps/answer/18539' ) .'" target="_blank">'. esc_html( __( 'How to get map coordinates?', 'martanian-oak-house' ) ) .'</a>'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Zoom', 'martanian-oak-house' ) ),
                    'param_name' => 'zoom',
                    'value' => martanian_oak_house_get_map_zoom_options(),
                    'std' => '17'
                )
            )
        ));

       /**
        *
        * google maps marker: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Google maps: marker', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_google_maps_marker',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_google_maps' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Latitude', 'martanian-oak-house' ) ),
                    'param_name' => 'lat',
                    'std' => '34.0598462'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Longitude', 'martanian-oak-house' ) ),
                    'param_name' => 'lng',
                    'std' => '-118.2789686',
                    'description' => '<a href="'. esc_url( 'https://support.google.com/maps/answer/18539' ) .'" target="_blank">'. esc_html( __( 'How to get map coordinates?', 'martanian-oak-house' ) ) .'</a>'
                )
            )
        ));

       /**
        *
        * gray section with icon: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Gray section with icon', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_gray_section_with_icon',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'std' => 'fontawesome'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-heart-o'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx'
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Icon', 'martanian-oak-house' ) ),
                    'param_name' => 'icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance'
                )
            )
        ));

       /**
        *
        * heading slider shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Heading slider', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_heading_slider',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_heading_slider_slide' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Interval', 'martanian-oak-house' ) ),
                    'param_name' => 'interval',
                    'description' => esc_html( __( 'Interval between each slides change, in miliseconds.', 'martanian-oak-house' ) ),
                    'value' => martanian_oak_house_intervals(),
                    'std' => 6000
                )
            )
        ));

       /**
        *
        * heading slider - heading slider single slide shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Heading slider single slide', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_heading_slider_slide',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_heading_slider' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # background image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Slider background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),

                # content

                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'Retirement you deserve', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Sub-title', 'martanian-oak-house' ) ),
                    'param_name' => 'sub_title',
                    'std' => 'Morbi eu dui mattis eros lobortis pharetra. Integer nibh sapien, eleifend sed dapibus eget, vestibulum quis felis. Aliquam non elit magna.',
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display button', 'martanian-oak-house' ) ),
                    'param_name' => 'display_button',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Display button?', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),

                # button

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html( __( 'Button URL', 'martanian-oak-house' ) ),
                    'param_name' => 'button_url',
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'std' => martanian_oak_house_get_default_button_url( esc_html( __( 'About us', 'martanian-oak-house' ) ), esc_html( __( 'Find out more', 'martanian-oak-house' ) ) ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button style', 'martanian-oak-house' ) ),
                    'param_name' => 'button_style',
                    'value' => array(
                        esc_html( __( 'Transparent (on light background)', 'martanian-oak-house' ) ) => 'transparent-on-light',
                        esc_html( __( 'Transparent (on dark background)', 'martanian-oak-house' ) ) => 'transparent-on-dark',
                        esc_html( __( 'Filled color background', 'martanian-oak-house' ) ) => 'filled-color',
                        esc_html( __( 'Filled gray background', 'martanian-oak-house' ) ) => 'filled-gray'
                    ),
                    'std' => 'filled-color',
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Show button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'show_button_icon',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Yes, show icon after button text', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'show_button_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-long-arrow-right',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * images: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Images', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_images',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_images_single_image' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Interval', 'martanian-oak-house' ) ),
                    'param_name' => 'interval',
                    'description' => esc_html( __( 'Interval between each images change, in miliseconds.', 'martanian-oak-house' ) ),
                    'value' => martanian_oak_house_intervals(),
                    'std' => 6000
                )
            )
        ));

       /**
        *
        * images single image: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Single image', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_images_single_image',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'image',
                    'group' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'group' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Image height', 'martanian-oak-house' ) ),
                    'param_name' => 'image_height',
                    'value' => array(
                        esc_html( __( 'Normal', 'martanian-oak-house' ) ) => 'normal',
                        esc_html( __( 'Long', 'martanian-oak-house' ) ) => 'long'
                    ),
                    'std' => 'normal',
                    'group' => esc_html( __( 'Image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * pricing table shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Pricing table', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_pricing_table',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_pricing_table_element' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title: column 1', 'martanian-oak-house' ) ),
                    'param_name' => 'column_1_title',
                    'std' => 'Nulla facilis'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title: column 2', 'martanian-oak-house' ) ),
                    'param_name' => 'column_2_title',
                    'std' => 'Class aptent'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title: column 3', 'martanian-oak-house' ) ),
                    'param_name' => 'column_3_title',
                    'std' => 'Accumsan eu'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title: column 4', 'martanian-oak-house' ) ),
                    'param_name' => 'column_4_title'
                )
            )
        ));

       /**
        *
        * pricing table element shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Pricing table element', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_pricing_table_element',
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_pricing_table' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Row title', 'martanian-oak-house' ) ),
                    'param_name' => 'row_title',
                    'std' => esc_html( __( 'Full-day medical care', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Value: column 1', 'martanian-oak-house' ) ),
                    'param_name' => 'column_1_value',
                    'std' => 'icon:no'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Value: column 2', 'martanian-oak-house' ) ),
                    'param_name' => 'column_2_value',
                    'std' => '1 / month'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Value: column 3', 'martanian-oak-house' ) ),
                    'param_name' => 'column_3_value',
                    'std' => 'unlimited'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Value: column 4', 'martanian-oak-house' ) ),
                    'param_name' => 'column_4_value'
                )
            )
        ));

       /**
        *
        * recent news shortcode: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Recent news', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_recent_news',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Section title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => esc_html( __( 'From our Blog', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Posts category:', 'martanian-oak-house' ) ),
                    'param_name' => 'posts_category',
                    'value' => martanian_oak_house_post_categories(),
                    'std' => esc_html( __( 'Posts from all categories', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Display button', 'martanian-oak-house' ) ),
                    'param_name' => 'display_button',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Display button?', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'group' => esc_html( __( 'Content', 'martanian-oak-house' ) )
                ),

                # button

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html( __( 'Button', 'martanian-oak-house' ) ),
                    'param_name' => 'button_url',
                    'std' => martanian_oak_house_get_default_button_url( esc_html( __( 'Blog', 'martanian-oak-house' ) ), esc_html( __( 'Read all older news', 'martanian-oak-house' ) ) ),
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button style', 'martanian-oak-house' ) ),
                    'param_name' => 'button_style',
                    'value' => array(
                        esc_html( __( 'Transparent (on light background)', 'martanian-oak-house' ) ) => 'transparent-on-light',
                        esc_html( __( 'Transparent (on dark background)', 'martanian-oak-house' ) ) => 'transparent-on-dark',
                        esc_html( __( 'Filled color background', 'martanian-oak-house' ) ) => 'filled-color',
                        esc_html( __( 'Filled gray background', 'martanian-oak-house' ) ) => 'filled-gray'
                    ),
                    'std' => 'transparent-on-light',
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html( __( 'Show button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'show_button_icon',
                    'std' => 'checked',
                    'value' => array(
                        esc_html( __( 'Yes, show icon after button text', 'martanian-oak-house' ) ) => 'checked'
                    ),
                    'dependency' => array(
                        'element' => 'display_button',
                        'value' => 'checked'
                    ),
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Button icon library', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_library',
                    'value' => array(
                        esc_html( __( 'Font Awesome', 'martanian-oak-house' ) ) => 'fontawesome',
                        esc_html( __( 'Open Iconic', 'martanian-oak-house' ) ) => 'openiconic',
                        esc_html( __( 'Typicons', 'martanian-oak-house' ) ) => 'typicons',
                        esc_html( __( 'Entypo', 'martanian-oak-house' ) ) => 'entypo',
                        esc_html( __( 'Linecons', 'martanian-oak-house' ) ) => 'linecons',
                        esc_html( __( 'Mono Social', 'martanian-oak-house' ) ) => 'monosocial',
                        esc_html( __( 'Material', 'martanian-oak-house' ) ) => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'show_button_icon',
                        'value' => 'checked'
                    ),
                    'std' => 'fontawesome',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_fontawesome',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'fontawesome'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'fontawesome'
                    ),
                    'std' => 'fa fa-long-arrow-right',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_openiconic',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'openiconic'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'openiconic'
                    ),
                    'std' => 'vc-oi vc-oi-dial',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_typicons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'typicons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'typicons'
                    ),
                    'std' => 'typcn typcn-adjust-brightness',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_entypo',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'entypo'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'entypo'
                    ),
                    'std' => 'entypo-icon entypo-icon-note',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_linecons',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'linecons'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'linecons'
                    ),
                    'std' => 'vc_li vc_li-heart',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_monosocial',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'monosocial'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'monosocial'
                    ),
                    'std' => 'vc-mono vc-mono-fivehundredpx',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html( __( 'Button icon', 'martanian-oak-house' ) ),
                    'param_name' => 'button_icon_material',
                    'settings' => array(
                        'empty' => false,
                        'type' => 'material'
                    ),
                    'dependency' => array(
                        'element' => 'button_icon_library',
                        'value' => 'material'
                    ),
                    'std' => 'vc-material vc-material-account_balance',
                    'group' => esc_html( __( 'Button', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * references slider: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'References slider', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_references_slider',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_references_slider_single_slide' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Background image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Interval', 'martanian-oak-house' ) ),
                    'param_name' => 'interval',
                    'description' => esc_html( __( 'Interval between each slides change, in miliseconds.', 'martanian-oak-house' ) ),
                    'value' => martanian_oak_house_intervals(),
                    'std' => 9000
                )
            )
        ));

       /**
        *
        * references slider single slide: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'References slider single slide', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_references_slider_single_slide',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_references_slider' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Reference content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => 'Morbi dui ligula, et velit pede turpis et quam congue orci magna hendrerit nulla ipsum pede, risus elit a leo ut orci magna non nisl felis sagittis luctus.'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Reference author name', 'martanian-oak-house' ) ),
                    'param_name' => 'author_name',
                    'std' => esc_html( __( 'Martha Smith', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Reference author title', 'martanian-oak-house' ) ),
                    'param_name' => 'author_title',
                    'std' => esc_html( __( 'boarder', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * round progress bar: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Round progress bar', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_round_progress_bar',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'param_name' => 'title',
                    'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Progress bar value', 'martanian-oak-house' ) ),
                    'param_name' => 'value',
                    'value' => martanian_oak_house_progress_bar_values(),
                    'std' => 0.92
                )
            )
        ));

       /**
        *
        * sidebar wrapper: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Sidebar', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_sidebar',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'show_settings_on_create' => false,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array()
        ));

       /**
        *
        * three images header: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Three images header', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_three_images_header',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(

                # content

                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => '<h3>'. esc_html( __( 'Peaceful environment', 'martanian-oak-house' ) ) ."</h3>\n\nLorem ipsum dolor sit amet dolor. Vestibulum aliquam pharetra ut, eleifend ipsum vel felis vitae tellus. In commodo volutpat tempus erat.\n\nAliquam eleifend tincidunt, orci luctus et ultrices varius.Fusce gravida, quam sem, eleifend magna vel tincidunt tempus. Suspendisse sed arcu. Praesent gravida non, ultrices posuere cubilia curae."
                ),

                # left-top image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_top_image',
                    'group' => esc_html( __( 'Left-top image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_top_image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left-top image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_top_image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left-top image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'left_top_image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Left-top image', 'martanian-oak-house' ) )
                ),

                # left-bottom image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_bottom_image',
                    'group' => esc_html( __( 'Left-bottom image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_bottom_image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left-bottom image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'left_bottom_image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Left-bottom image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'left_bottom_image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Left-bottom image', 'martanian-oak-house' ) )
                ),

                # right image

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of image', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'right_image_alt',
                    'std' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
                    'group' => esc_html( __( 'Right image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * timeline: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Timeline', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_timeline',
            'as_parent' => array( 'only' => 'martanian_oak_house_shortcode_timeline_element' ),
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'std' => esc_html( __( 'Oak House history', 'martanian-oak-house' ) ),
                    'param_name' => 'title'
                )
            )
        ));

       /**
        *
        * references slider single slide: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Timeline element', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_timeline_element',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'as_child' => array( 'only' => 'martanian_oak_house_shortcode_timeline' ),
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Title', 'martanian-oak-house' ) ),
                    'std' => esc_html( __( 'Hundredth patient', 'martanian-oak-house' ) ),
                    'param_name' => 'title'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Date', 'martanian-oak-house' ) ),
                    'std' => esc_html( __( '02.2010', 'martanian-oak-house' ) ),
                    'param_name' => 'date'
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => 'Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero malesuada id, ullamcorper id, nunc. Nunc eleifend velit.'
                )
            )
        ));

       /**
        *
        * video section: map the shortcodes with visual composer
        *
        */

        vc_map( array(
            'name' => esc_html( __( 'Video section', 'martanian-oak-house' ) ),
            'base' => 'martanian_oak_house_shortcode_video_section',
            'category' => esc_html( __( 'Oak House', 'martanian-oak-house' ) ),
            'content_element' => true,
            'icon' => esc_url( get_template_directory_uri() .'/_assets/_img/vc-icon.png' ),
            'params' => array(
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html( __( 'Content', 'martanian-oak-house' ) ),
                    'param_name' => 'content',
                    'std' => '<h3>'. esc_html( __( 'Watch our typical day', 'martanian-oak-house' ) ) ."</h3>\n\n" .'Sed at semper odio, quis convallis tortor. Proin eu diam tincidunt, malesuada ex nec, lobortis enim. Ut orci sapien, dignissim sit amet eros ut, sollicitudin egestas enim. Vivamus ac nisi eget turpis venenatis bibendum. Morbi a accumsan mauris.',
                    'group' => esc_html( __( 'General', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Video URL', 'martanian-oak-house' ) ),
                    'param_name' => 'video_url',
                    'std' => '',
                    'group' => esc_html( __( 'General', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Video length', 'martanian-oak-house' ) ),
                    'param_name' => 'video_length',
                    'std' => '04:53',
                    'group' => esc_html( __( 'General', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html( __( 'Background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Vertical position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_y',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html( __( 'Horizontal position of background image', 'martanian-oak-house' ) ),
                    'param_name' => 'image_position_x',
                    'value' => martanian_oak_house_image_positions(),
                    'std' => '50%',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html( __( 'Background image alternative text', 'martanian-oak-house' ) ),
                    'param_name' => 'image_alt',
                    'group' => esc_html( __( 'Background image', 'martanian-oak-house' ) )
                )
            )
        ));

       /**
        *
        * end of integration
        *
        */
    }

   /**
    *
    * extend WPBakeryShortCodesContainer class to inherit all required functionality
    *
    */

    if( class_exists( 'WPBakeryShortCodesContainer' ) ) {

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Contact_Details_Box extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Content_Box extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Content_Centered extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Content_With_Image extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_FAQ extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_FAQ_Short extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Gallery extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_martanian_Oak_House_Shortcode_Google_Maps extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Gray_Section_With_Icon extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Heading_Slider extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Images extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Pricing_Table extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_References_Slider extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Sidebar extends WPBakeryShortCodesContainer {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Timeline extends WPBakeryShortCodesContainer {
        }
    }

    if( class_exists( 'WPBakeryShortCode' ) ) {

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Button extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Call_To_Action_With_Icon extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Contact_Details_Box_Element extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Contact_Form extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Doctor_Details extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Document extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Double_Images extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_FAQ_Group_Title extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Gallery_Element extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_martanian_Oak_House_Shortcode_Google_Maps_Marker extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Heading_Slider_Slide extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Images_Single_Image extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Pricing_Table_Element extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Recent_News extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_References_Slider_Single_Slide extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Round_Progress_Bar extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Three_Images_Header extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Timeline_Element extends WPBakeryShortCode {
        }

        class WPBakeryShortCode_Martanian_Oak_House_Shortcode_Video_Section extends WPBakeryShortCode {
        }
    }

   /**
    *
    * end of file
    *
    */

?>