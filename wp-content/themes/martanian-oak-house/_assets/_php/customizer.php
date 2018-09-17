<?php

   /**
    *
    * load scripts for live customizer preview
    *
    */

    add_action( 'customize_preview_init', 'martanian_oak_house_customizer_javascripts' );
    function martanian_oak_house_customizer_javascripts() {

        # enqueue custom scripts
        wp_enqueue_script( 'martanian-oak-house-customizer-live-preview-js', get_template_directory_uri() .'/_assets/_js/customizer.js', array( 'customize-preview', 'jquery' ), null );
    }

   /**
    *
    * load styles for live customizer preview
    *
    */

    add_action( 'customize_controls_print_styles', 'martanian_oak_house_customizer_stylesheet' );
    function martanian_oak_house_customizer_stylesheet() {

        # enqueue custom stylesheet
        wp_enqueue_style( 'martanian-oak-house-customizer-live-preview-css', get_template_directory_uri() .'/_assets/_css/customizer.css', false, null );

        # enqueue font awesome stylesheet
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/_assets/_libs/font-awesome/css/font-awesome.css', false, null );
    }

   /**
    *
    * custom field - icon
    *
    */

    if( class_exists( 'WP_Customize_Control' ) ) {

        class WP_Customize_Custom_Control_Icon extends WP_Customize_Control {

            public $type = 'icon';
          		public function render_content() {

                ?>
             			<label class="martanian-oak-house-customizer-icon-field">

                				<span class="customize-control-title"><?php echo esc_html( $this -> label ); ?></span>
                    <span class="description"><?php echo sprintf( esc_html( __( 'You can use any of the FontAwesome %s icon.', 'martanian-oak-house' ) ), '<a href="'. esc_url( __( 'http://fontawesome.io/icons/', 'martanian-oak-house' ) ) .'" target="_blank"><i class="fa fa-external-link"></i></a>' ); ?></span>

                				<input type="text" <?php $this -> link(); ?> value="<?php echo esc_textarea( $this -> value() ); ?>" />

             			</label>

                <div class="martanian-oak-house-customizer-line">
                </div>
              		<?php
          		}
       	}
    }

   /**
    *
    * custom logo option for
    * wordpress customizer
    *
    */

    add_action( 'customize_register', 'martanian_oak_house_logo_customizer' );
    function martanian_oak_house_logo_customizer( $wp_customize ) {

        # create object of martanian_oak_house_theme_mods_supporter class
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # is multilingual?
        $is_multilingual = martanian_oak_house_is_multilingual();

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_logo_customizer',
            array(
                'title' => esc_html( __( 'Logo', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'Upload your website logo here.', 'martanian-oak-house' ) ),
                'priority' => 10,
                'capability' => 'edit_theme_options'
            )
        );

        # is not multilingual?
        if( $is_multilingual == false ) {

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_logo_customizer_logo_upload',
                array(
                    'default' => get_template_directory_uri() .'/_assets/_img/logo.png',
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'martanian_oak_house_section_logo_customizer_logo_upload',
                    array(
                        'label' => esc_html( __( 'Your website logo', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_logo_customizer',
                        'settings' => 'martanian_oak_house_section_logo_customizer_logo_upload'
                    )
                )
            );
        }

        else {

            # languages array
            $languages = martanian_oak_house_get_languages_list();

            # display logo option for each language
            for( $i = 0; $i < count( $languages ); $i++ ) {

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_logo_customizer_logo_upload_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => get_template_directory_uri() .'/_assets/_img/logo.png',
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    new WP_Customize_Image_Control(
                        $wp_customize,
                        'martanian_oak_house_section_logo_customizer_logo_upload_'. esc_attr( $languages[$i] ),
                        array(
                            'label' => esc_html( __( 'Your website logo', 'martanian-oak-house' ) ) .' ('. esc_html( martanian_oak_house_get_language_name( $languages[$i] ) ) .')',
                            'section' => 'martanian_oak_house_section_logo_customizer',
                            'settings' => 'martanian_oak_house_section_logo_customizer_logo_upload_'. esc_attr( $languages[$i] )
                        )
                    )
                );
            }
        }
    }

   /**
    *
    * custom content for top header bar,
    * for wordpress customizer
    *
    */

    add_action( 'customize_register', 'martanian_oak_house_top_header_bar_customizer' );
    function martanian_oak_house_top_header_bar_customizer( $wp_customize ) {

        # create object of martanian_oak_house_theme_mods_supporter class
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # is multilingual?
        $is_multilingual = martanian_oak_house_is_multilingual();

        # is not multilingual?
        if( $is_multilingual == false ) {

           /**
            *
            * customizer section: contact details on top header bar
            *
            */

            # add customizer section
            $wp_customize -> add_section(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                array(
                    'title' => esc_html( __( 'Top header bar', 'martanian-oak-house' ) ),
                    'description' => esc_html( __( 'Set your phone number, email address and location details in top header bar. If you do not want to use any of the element, just leave it empty.', 'martanian-oak-house' ) ),
                    'priority' => 10,
                    'capability' => 'edit_theme_options',
                )
            );

           /**
            *
            * customizer settings for phone number on top header bar
            *
            */

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number', esc_html( __( '1-800-123-4567', 'martanian-oak-house' ) ) ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number',
                array(
                    'label' => esc_html( __( 'Phone number', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number_url', esc_url( __( 'tel:18001234567', 'martanian-oak-house' ) ) ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url',
                array(
                    'label' => esc_html( __( 'Phone number URL', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number_in_new_tab', '1' ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab',
                array(
                    'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'checkbox'
                )
            );

           /**
            *
            * customizer settings for email address on top header bar
            *
            */

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address', esc_html( __( 'email@example.com', 'martanian-oak-house' ) ) ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address',
                array(
                    'label' => esc_html( __( 'Email address', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address_url', esc_url( __( 'mailto:email@example.com', 'martanian-oak-house' ) ) ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url',
                array(
                    'label' => esc_html( __( 'Email address URL', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address_in_new_tab', '1' ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab',
                array(
                    'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'checkbox'
                )
            );

           /**
            *
            * customizer settings for location details on top header bar
            *
            */

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location', esc_html( __( '15th Avenue, New York, NY', 'martanian-oak-house' ) ) ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location',
                array(
                    'label' => esc_html( __( 'Location', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location_url', '' ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url',
                array(
                    'label' => esc_html( __( 'Location URL', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'text'
                )
            );

            # add customizer setting
            $wp_customize -> add_setting(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab',
                array(
                    'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location_in_new_tab', '1' ),
                    'transport' => 'postMessage'
                )
            );

            # add customizer controll
            $wp_customize -> add_control(
                'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab',
                array(
                    'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details',
                    'type' => 'checkbox'
                )
            );

           /**
            *
            * end of options
            *
            */
        }

        # is multilingual?
        else {

            # add customizer panel
            $wp_customize -> add_panel(
                'martanian_oak_house_section_top_header_bar_customizer',
                array(
                    'priority' => 10,
                    'capability' => 'edit_theme_options',
                    'title' => esc_html( __( 'Top header bar', 'martanian-oak-house' ) ),
                    'description' => esc_html( __( 'Set your phone number, email address and location details in top header bar.', 'martanian-oak-house' ) ),
                )
            );

            # languages array
            $languages = martanian_oak_house_get_languages_list();

            # display logo option for each language
            for( $i = 0; $i < count( $languages ); $i++ ) {

               /**
                *
                * customizer section: contact details on top header bar
                *
                */

                # add customizer section
                $wp_customize -> add_section(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                    array(
                        'title' => esc_html( __( 'Contact details', 'martanian-oak-house' ) ) .' ('. esc_html( martanian_oak_house_get_language_name( $languages[$i] ) ) .')',
                        'description' => esc_html( __( 'Set your phone number, email address or location details in top header bar. If you do not want to use any of the element, just leave it empty.', 'martanian-oak-house' ) ),
                        'priority' => 10,
                        'panel' => 'martanian_oak_house_section_top_header_bar_customizer'
                    )
                );

               /**
                *
                * customizer settings for phone number on top header bar
                *
                */

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number', esc_html( __( '1-800-123-4567', 'martanian-oak-house' ) ) ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Phone number', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number_url', esc_url( __( 'tel:18001234567', 'martanian-oak-house' ) ) ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Phone number URL', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_phone_number_in_new_tab', '1' ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'checkbox'
                    )
                );

               /**
                *
                * customizer settings for email address on top header bar
                *
                */

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address', esc_html( __( 'email@example.com', 'martanian-oak-house' ) ) ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Email address', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address_url', esc_url( __( 'mailto:email@example.com', 'martanian-oak-house' ) ) ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Email address URL', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_email_address_in_new_tab', '1' ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'checkbox'
                    )
                );

               /**
                *
                * customizer settings for location details on top header bar
                *
                */

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location', esc_html( __( '15th Avenue, New York, NY', 'martanian-oak-house' ) ) ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Location', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location_url', '' ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Location URL', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'text'
                    )
                );

                # add customizer setting
                $wp_customize -> add_setting(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'default' => $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_location_in_new_tab', '1' ),
                        'transport' => 'postMessage'
                    )
                );

                # add customizer controll
                $wp_customize -> add_control(
                    'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab_'. esc_attr( $languages[$i] ),
                    array(
                        'label' => esc_html( __( 'Open link in new tab', 'martanian-oak-house' ) ),
                        'section' => 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'. esc_attr( $languages[$i] ),
                        'type' => 'checkbox'
                    )
                );

               /**
                *
                * end of options for languages
                *
                */
            }
        }

       /**
        *
        * end of function.
        *
        */
    }

   /**
    *
    * theme colors customizer
    *
    */

    add_action( 'customize_register', 'martanian_oak_house_colors_customizer' );
    function martanian_oak_house_colors_customizer( $wp_customize ) {

        # create object of martanian_oak_house_theme_mods_supporter class
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # get the alpha-color-picker claas
        require_once( get_template_directory() .'/_assets/_libs/alpha-color-picker/alpha-color-picker.php' );

        # add customizer panel
        $wp_customize -> add_panel(
            'martanian_oak_house_section_colors_customizer',
            array(
                'title' => esc_html( __( 'Theme colors', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage theme colors here.', 'martanian-oak-house' ) ),
                'priority' => 10,
                'capability' => 'edit_theme_options'
            )
        );

       /**
        *
        * general elements colors
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_general_colors',
            array(
                'title' => esc_html( __( 'General colors', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage general website colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_main_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_main_color',
                array(
                    'label' => esc_html( __( 'Main color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_main_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_important_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'important-text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_important_text_color',
                array(
                    'label' => esc_html( __( 'Important text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_important_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_text_color',
                array(
                    'label' => esc_html( __( 'Text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_timeline_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'timeline-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_timeline_color',
                array(
                    'label' => esc_html( __( 'Timeline color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_timeline_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_contact_form_section_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'contact-form-section-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_contact_form_section_background_color',
                array(
                    'label' => esc_html( __( 'Contact form section background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_contact_form_section_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_faq_short_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_faq_short_background_color',
                array(
                    'label' => esc_html( __( 'FAQ-short section background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_faq_short_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_gray_sections_and_elements_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_gray_sections_and_elements_background_color',
                array(
                    'label' => esc_html( __( 'Gray sections and elements background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_gray_sections_and_elements_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_gray_elements_background_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-elements-background-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_gray_elements_background_color_hover',
                array(
                    'label' => esc_html( __( 'Gray elements background color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_gray_elements_background_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_loader_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'loader-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_loader_background_color',
                array(
                    'label' => esc_html( __( 'Loader background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_loader_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_document_icon_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'document-icon-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_document_icon_color',
                array(
                    'label' => esc_html( __( 'Document icon color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_document_icon_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_post_date_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'post-date-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_post_date_color',
                array(
                    'label' => esc_html( __( 'Post date color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_post_date_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_gray_text_on_gray_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-text-on-gray-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_gray_text_on_gray_background_color',
                array(
                    'label' => esc_html( __( 'Gray text on gray background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_gray_text_on_gray_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'image-caption-icon-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_background_color',
                array(
                    'label' => esc_html( __( 'Image caption icon background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'image-caption-icon-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_color',
                array(
                    'label' => esc_html( __( 'Image caption icon color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_comment_reply_icon_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'comment-reply-icon-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_comment_reply_icon_color',
                array(
                    'label' => esc_html( __( 'Comment reply icon color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_comment_reply_icon_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_global_colors_gallery_section_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gallery-section-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_global_colors_gallery_section_background_color',
                array(
                    'label' => esc_html( __( 'Gallery section background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_general_colors',
                    'settings' => 'martanian_oak_house_section_colors_customizer_global_colors_gallery_section_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * header bar
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_header_bar',
            array(
                'title' => esc_html( __( 'Header bar', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage header bar colors settings here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_background_color',
                array(
                    'label' => esc_html( __( 'Background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_top_elements_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'top-elements-text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_top_elements_text_color',
                array(
                    'label' => esc_html( __( 'Top elements text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_top_elements_divider_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'top-elements-divider-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_top_elements_divider_color',
                array(
                    'label' => esc_html( __( 'Top elements divider color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_divider_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_menu_link_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'menu-link-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_menu_link_color',
                array(
                    'label' => esc_html( __( 'Menu link color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_menu_link_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_submenu_bottom_border_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-bottom-border-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_submenu_bottom_border_color',
                array(
                    'label' => esc_html( __( 'Submenu bottom border color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_submenu_bottom_border_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_submenu_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_submenu_background_color',
                array(
                    'label' => esc_html( __( 'Submenu background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_submenu_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-link-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color',
                array(
                    'label' => esc_html( __( 'Submenu link color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-link-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color_hover',
                array(
                    'label' => esc_html( __( 'Submenu link color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_header_bar',
                    'settings' => 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * responsive menu
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_responsive_menu',
            array(
                'title' => esc_html( __( 'Responsive menu', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage responsive menu colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_responsive_menu_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_responsive_menu_background_color',
                array(
                    'label' => esc_html( __( 'Background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_responsive_menu',
                    'settings' => 'martanian_oak_house_section_colors_customizer_responsive_menu_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_responsive_menu_border_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'border-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_responsive_menu_border_color',
                array(
                    'label' => esc_html( __( 'Border color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_responsive_menu',
                    'settings' => 'martanian_oak_house_section_colors_customizer_responsive_menu_border_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_responsive_menu_link_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'link-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_responsive_menu_link_color',
                array(
                    'label' => esc_html( __( 'Link color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_responsive_menu',
                    'settings' => 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_responsive_menu_link_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'link-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_responsive_menu_link_color_hover',
                array(
                    'label' => esc_html( __( 'Link color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_responsive_menu',
                    'settings' => 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * responsive menu
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_heading_slider',
            array(
                'title' => esc_html( __( 'Heading slider', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage heading slider colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_heading_slider_slide_overlay_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'slide-overlay-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_heading_slider_slide_overlay_background_color',
                array(
                    'label' => esc_html( __( 'Slide overlay background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_heading_slider',
                    'settings' => 'martanian_oak_house_section_colors_customizer_heading_slider_slide_overlay_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_heading_slider_content_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'content-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_heading_slider_content_background_color',
                array(
                    'label' => esc_html( __( 'Content background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_heading_slider',
                    'settings' => 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_heading_slider_content_background_responsive_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'content-background-responsive-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_heading_slider_content_background_responsive_color',
                array(
                    'label' => esc_html( __( 'Content background responsive color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_heading_slider',
                    'settings' => 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_responsive_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_heading_slider_title_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'title-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_heading_slider_title_color',
                array(
                    'label' => esc_html( __( 'Title color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_heading_slider',
                    'settings' => 'martanian_oak_house_section_colors_customizer_heading_slider_title_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_heading_slider_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_heading_slider_text_color',
                array(
                    'label' => esc_html( __( 'Text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_heading_slider',
                    'settings' => 'martanian_oak_house_section_colors_customizer_heading_slider_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * video
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_video',
            array(
                'title' => esc_html( __( 'Video section', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage video section colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_video_overlay_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'video', 'overlay-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_video_overlay_background_color',
                array(
                    'label' => esc_html( __( 'Overlay background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_video',
                    'settings' => 'martanian_oak_house_section_colors_customizer_video_overlay_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_video_play_button_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'video', 'play-button-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_video_play_button_color_hover',
                array(
                    'label' => esc_html( __( 'Play button color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_video',
                    'settings' => 'martanian_oak_house_section_colors_customizer_video_play_button_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_video_title_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'video', 'title-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_video_title_color',
                array(
                    'label' => esc_html( __( 'Title color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_video',
                    'settings' => 'martanian_oak_house_section_colors_customizer_video_title_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_video_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'video', 'text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_video_text_color',
                array(
                    'label' => esc_html( __( 'Text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_video',
                    'settings' => 'martanian_oak_house_section_colors_customizer_video_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * doctor details
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_doctor_details',
            array(
                'title' => esc_html( __( 'Doctor details', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage doctor details section colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_first_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_first_color',
                array(
                    'label' => esc_html( __( 'Background gradient first color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_doctor_details',
                    'settings' => 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_first_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_last_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_last_color',
                array(
                    'label' => esc_html( __( 'Background gradient last color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_doctor_details',
                    'settings' => 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_last_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_doctor_details_blockquote_border_top_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'blockquote-border-top-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_doctor_details_blockquote_border_top_color',
                array(
                    'label' => esc_html( __( 'Blockquote border top color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_doctor_details',
                    'settings' => 'martanian_oak_house_section_colors_customizer_doctor_details_blockquote_border_top_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * forms
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_forms',
            array(
                'title' => esc_html( __( 'Forms', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage forms colors here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_field_border_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_field_border_color',
                array(
                    'label' => esc_html( __( 'Field border color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_field_border_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_field_border_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_field_border_color_hover',
                array(
                    'label' => esc_html( __( 'Field border color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_field_border_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_border_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-border-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_border_color',
                array(
                    'label' => esc_html( __( 'Button border color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_border_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_text_color',
                array(
                    'label' => esc_html( __( 'Button text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_text_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-text-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_text_color_hover',
                array(
                    'label' => esc_html( __( 'Button text color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_text_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_hover_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-hover-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_hover_background_color',
                array(
                    'label' => esc_html( __( 'Button hover background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_hover_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_icon_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-icon-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_icon_color',
                array(
                    'label' => esc_html( __( 'Button icon color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_icon_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_icon_color_hover',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-icon-color-hover' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_icon_color_hover',
                array(
                    'label' => esc_html( __( 'Button icon color hover:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_icon_color_hover',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_transparent_on_dark_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-transparent-on-dark-text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_transparent_on_dark_text_color',
                array(
                    'label' => esc_html( __( 'Button transparent on dark text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_transparent_on_dark_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_fill_background_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-fill-background-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_fill_background_color',
                array(
                    'label' => esc_html( __( 'Button fill background color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_fill_background_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_forms_button_color_text_color',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'forms', 'button-color-text-color' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_forms_button_color_text_color',
                array(
                    'label' => esc_html( __( 'Button color text color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_forms',
                    'settings' => 'martanian_oak_house_section_colors_customizer_forms_button_color_text_color',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * progress bars
        *
        */

        # add customizer section
        $wp_customize -> add_section(
            'martanian_oak_house_section_colors_customizer_progress_bars',
            array(
                'title' => esc_html( __( 'Progress bars', 'martanian-oak-house' ) ),
                'description' => esc_html( __( 'You can manage progress bars gradient color here.', 'martanian-oak-house' ) ),
                'panel' => 'martanian_oak_house_section_colors_customizer'
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_progress_bars_first',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'first' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_progress_bars_first',
                array(
                    'label' => esc_html( __( 'First color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_progress_bars',
                    'settings' => 'martanian_oak_house_section_colors_customizer_progress_bars_first',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_progress_bars_second',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'second' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_progress_bars_second',
                array(
                    'label' => esc_html( __( 'Second color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_progress_bars',
                    'settings' => 'martanian_oak_house_section_colors_customizer_progress_bars_second',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

        # add customizer setting
        $wp_customize -> add_setting(
            'martanian_oak_house_section_colors_customizer_progress_bars_third',
            array(
                'default' => martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'third' ),
                'transport' => 'postMessage'
            )
        );

        # add customizer control
        $wp_customize -> add_control(
            new Customize_Alpha_Color_Control(
                $wp_customize,
                'martanian_oak_house_section_colors_customizer_progress_bars_third',
                array(
                    'label' => esc_html( __( 'Third color:', 'martanian-oak-house' ) ),
                    'section' => 'martanian_oak_house_section_colors_customizer_progress_bars',
                    'settings' => 'martanian_oak_house_section_colors_customizer_progress_bars_third',
                    'show_opacity' => true,
                    'palette' => false
                )
            )
        );

       /**
        *
        * end of function.
        *
        */
    }

   /**
    *
    * end of file.
    *
    */

?>