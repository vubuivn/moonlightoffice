<?php

   /**
    *
    * get all default theme options
    *
    */

    function martanian_oak_house_get_all_default_theme_options( $to_database = false ) {

        # default 404 page
        $page_404 = get_page_by_title( esc_html( __( '404 page', 'martanian-oak-house' ) ) );

        # default values
        $default = array(
            '404-page' => array(
                'page-id' => array(
                    'all' => esc_attr( $page_404 != null && $page_404 != false ? $page_404 -> ID : '0' )
                )
            ),
            'google-maps-api-key' => '',
            'facebook-fanpage-url' => array(
                'all' => esc_url( 'https://facebook.com/envato' )
            ),
            'translate-publication-dates' => 'yes',
            'comment-textarea-at-top' => 'no',
            'author-box' => array(
                'display' => array(
                    'all' => 'yes'
                )
            ),
            'display-similar-posts' => 'yes',
            'footer' => array(
                'martanian_oak_house_theme_options_footer_content_all' => date( 'Y' ) .' &copy; <a href="'. esc_url( get_home_url() ) .'">'. esc_html( __( 'Oak House - Senior Care', 'martanian-oak-house' ) ) .'</a>'
            ),
            'footer-menu-enabled' => 'no'
        );

        # insert to database?
        if( $to_database == true ) {

            unset( $default['footer']['martanian_oak_house_theme_options_footer_content_all'] );
        }

        # return result
        return( $default );
    }

   /**
    *
    * get values for each field
    *
    */

    function martanian_oak_house_get_theme_options_value( $section, $field, $language ) {

        # get martanian_options
        $options = get_option( 'martanian_oak_house_theme_options' );

        # not found martanian_options?
        if( $options == false || $options == '' ) $options = array();

        # default values
        $default = martanian_oak_house_get_all_default_theme_options();

        # get "footer" editor content
        if( $section == 'footer' && strpos( $field, 'martanian_oak_house_theme_options_footer_content_' ) !== false ) {

            # get the option value
            $result = get_option( $field );

            # do we have it?
            if( $result != false ) return( $result );
            else return( $default['footer']['martanian_oak_house_theme_options_footer_content_all'] );
        }

        # get other options
        else {

            # get single option, without other settings
            if( in_array( $section, array( 'google-maps-api-key', 'translate-publication-dates', 'comment-textarea-at-top', 'display-similar-posts', 'footer-menu-enabled' ), true ) ) {

                # return the result
                return( isset( $options[$section] ) ? $options[$section] : $default[$section] );
            }

            # get single option with language settings
            else if( in_array( $section, array( 'facebook-fanpage-url' ), true ) ) {

                # get the language key
                $language = strtolower( str_replace( '[', '', str_replace( ']', '', $language ) ) );

                # return
                if( isset( $options[$section] ) && isset( $options[$section][$language] ) ) return( $options[$section][$language] );
                else return( $default[$section]['all'] );
            }

            # other options
            else {

                # get the language key
                $language = strtolower( str_replace( '[', '', str_replace( ']', '', $language ) ) );

                # return
                if( isset( $options[$section] ) && isset( $options[$section][$field] ) && isset( $options[$section][$field][$language] ) ) return( $options[$section][$field][$language] );
                else return( $default[$section][$field]['all'] );
            }
        }
    }

   /**
    *
    * theme options page
    *
    */

    add_action( 'admin_menu', 'martanian_oak_house_add_admin_pages' );
    function martanian_oak_house_add_admin_pages() {

        # add theme page for theme options
        $martanian_oak_house_theme_options_page = add_theme_page(
            esc_html( __( 'Martanian Theme Options', 'martanian-oak-house' ) ),
            esc_html( __( 'Martanian Theme Options', 'martanian-oak-house' ) ),
            'manage_options',
            'martanian_oak_house_admin',
            'martanian_oak_house_show_admin_page'
        );

        # load scripts and styles for theme options page
        add_action( 'load-'. $martanian_oak_house_theme_options_page, 'martanian_oak_house_load_scripts_for_theme_options_page' );
    }

   /**
    *
    * add action - enqueue scripts and styles for
    * theme options page
    *
    */

    function martanian_oak_house_load_scripts_for_theme_options_page() {

        # add action for "admin_enqueue_scripts" hook
        add_action( 'admin_enqueue_scripts', 'martanian_oak_house_scripts_and_styles_for_theme_options_page' );
    }

   /**
    *
    * all scripts and styles needed by theme options page
    *
    */

    function martanian_oak_house_scripts_and_styles_for_theme_options_page() {

        # theme options page stylesheet
        wp_enqueue_style( 'martanian-oak-house-theme-options-stylesheet', get_template_directory_uri() .'/_assets/_css/theme-options.css', false, null );

        # enqueue demo import script
        wp_enqueue_script( 'martanian-oak-house-demo-import-script', get_template_directory_uri() .'/_assets/_demo-installation/demo-import.js', array( 'jquery' ), null );

        # localize strings for script
        wp_localize_script( 'martanian-oak-house-demo-import-script', 'martanian_oak_house_demo_import_script_l10n', array(
            'confirm' => esc_html( __( 'Are you sure to import dummy content? It will overwrite the existing data.', 'martanian-oak-house' ) ),
            'processed' => esc_html( __( 'Data is being imported, please wait for a while...', 'martanian-oak-house' ) )
        ));
    }

   /**
    *
    * this function displays theme options
    * page - Martanian Theme Options
    *
    */

    function martanian_oak_house_show_admin_page() {

        # empty message
        $martanian_message = isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ? esc_html( __( 'Settings saved!', 'martanian-oak-house' ) ) : '';

        # get the pages list
        $pages_list = get_pages();

        # get the languages array
        $languages = martanian_oak_house_get_languages_list();

        # there's no any language?
        if( $languages == false ) $languages = array( 'default' );

        ?>
        <div class="wrap">

            <div class="martanian-oak-house-theme-options-container">

                <div class="martanian-oak-house-theme-options-tabs-switcher">

                    <h3><?php echo esc_html( __( 'Oak House - WordPress Theme by Martanian', 'martanian-oak-house' ) ); ?></h3>
                    <ul class="martanian-oak-house-theme-options-tabs">

                        <li class="active" data-tab-key="<?php echo esc_attr( sanitize_title( esc_html( __( 'Theme options', 'martanian-oak-house' ) ) ) ); ?>"><?php echo esc_html( __( 'Theme options', 'martanian-oak-house' ) ); ?></li>
                        <li data-tab-key="<?php echo esc_attr( sanitize_title( esc_html( __( 'Load demo data', 'martanian-oak-house' ) ) ) ); ?>"><?php echo esc_html( __( 'Load demo data', 'martanian-oak-house' ) ); ?></li>

                    </ul>

                </div>

                <div class="martanian-oak-house-theme-options-single-tab" data-tab-key="<?php echo esc_attr( sanitize_title( esc_html( __( 'Theme options', 'martanian-oak-house' ) ) ) ); ?>">

                    <form action="options.php" method="post" enctype="multipart/form-data" name="martanian-options-form" class="martanian-theme-options">

                        <?php

                            # main settings fields
                            settings_fields( 'martanian_oak_house_admin' );

                            # main settings section
                            do_settings_sections( 'martanian_oak_house_admin_settings' );

                            # do we have the message?
                            if( !empty( $martanian_message ) ) {

                                ?>
                                <div class="updated">

                                    <p><?php echo esc_html( $martanian_message ); ?></p>

                                </div>
                                <?php

                            # end of message
                            }

                        ?>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( '404 page', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'Which of your pages should be used as "404 - not found" error page?', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <?php

                                # walk for each language
                                for( $i = 0; $i < count( $languages ); $i++ ) {

                                    # language key
                                    $lang_key = $languages[$i] == 'default' ? '[all]' : '['. strtolower( esc_attr( $languages[$i] ) ) .']';

                                    ?>
                                    <div class="martanian-theme-options-single-option-form">

                                        <?php

                                            # language name
                                            if( $languages[$i] != 'default' ) {

                                                # get the language name
                                                $language_name = martanian_oak_house_get_language_name( $languages[$i] );

                                                ?>
                                                <div class="martanian-theme-options-single-option-form-language"><?php echo esc_html( $language_name ); ?></div>
                                                <?php
                                            }

                                        ?>

                                        <h4><?php echo esc_html( __( 'Select page:', 'martanian-oak-house' ) ); ?></h4>
                                        <select name="martanian_oak_house_theme_options[404-page][page-id]<?php echo esc_attr( $lang_key ); ?>">

                                            <?php

                                                # get pages options
                                                foreach( $pages_list as $single_page ) {

                                                    ?>
                                                    <option value="<?php echo esc_attr( $single_page -> ID ); ?>" <?php selected( martanian_oak_house_get_theme_options_value( '404-page', 'page-id', $lang_key ), esc_attr( $single_page -> ID ) ); ?>><?php echo esc_html( $single_page -> post_title ); ?></option>
                                                    <?php
                                                }

                                            ?>

                                        </select>

                                    </div>
                                    <?php

                                # end of loop
                                }

                            ?>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Google maps API key', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'You can set here your Google maps API key.', 'martanian-oak-house' ) ); ?> <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"><?php echo esc_html( __( 'How to get an API key?', 'martanian-oak-house' ) ); ?></a></p>

                            </div>

                            <div class="martanian-theme-options-single-option-form">

                                <h4><?php echo esc_html( __( 'API key:', 'martanian-oak-house' ) ); ?></h4>
                                <input type="text" name="martanian_oak_house_theme_options[google-maps-api-key]" value="<?php echo esc_attr( martanian_oak_house_get_theme_options_value( 'google-maps-api-key', false, false ) ); ?>" />

                            </div>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Facebook FanPage URL', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'You can set here your Facebook FanPage URL - it will be used for "like" button on left side of each blog post and as default value for other Facebook buttons.', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <?php

                                # walk for each language
                                for( $i = 0; $i < count( $languages ); $i++ ) {

                                    # language key
                                    $lang_key = $languages[$i] == 'default' ? '[all]' : '['. strtolower( esc_attr( $languages[$i] ) ) .']';

                                    # language key for editor
                                    $lang_key_editor = $languages[$i] == 'default' ? 'all' : strtolower( esc_attr( $languages[$i] ) );

                                    ?>
                                    <div class="martanian-theme-options-single-option-form">

                                        <?php

                                            # language name
                                            if( $languages[$i] != 'default' ) {

                                                # get the language name
                                                $language_name = martanian_oak_house_get_language_name( $languages[$i] );

                                                ?>
                                                <div class="martanian-theme-options-single-option-form-language"><?php echo esc_html( $language_name ); ?></div>
                                                <?php
                                            }

                                        ?>

                                        <h4><?php echo esc_html( __( 'Facebook FanPage URL:', 'martanian-oak-house' ) ); ?></h4>
                                        <input type="text" name="martanian_oak_house_theme_options[facebook-fanpage-url]<?php echo esc_attr( $lang_key ); ?>" value="<?php echo esc_attr( martanian_oak_house_get_theme_options_value( 'facebook-fanpage-url', false, $lang_key ) ); ?>" />

                                    </div>
                                    <?php

                                # end of loop
                                }

                            ?>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <?php

                                    # example date object
                                    $example_date_obj = new DateTime( '-32 mins' );

                                    # example date
                                    $example_date_not_translated = $example_date_obj -> format( 'F j, Y' ) .' '. __( 'at', 'martanian-oak-house' ) .' '. $example_date_obj -> format( 'g:i a' );

                                    # example date translated
                                    $example_date_translated = martanian_oak_house_show_when( $example_date_obj -> format( 'U' ), false );

                                ?>

                                <h3><?php echo esc_html( __( 'Publication dates', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php printf( esc_html__( 'Do you want the script to automatically replace publication dates to human difference? For example: replace "%1$s" to "%2$s"', 'martanian-oak-house' ), $example_date_not_translated, $example_date_translated ); ?></p>

                            </div>

                            <div class="martanian-theme-options-single-option-form">

                                <h4><?php echo esc_html( __( 'Replace publication dates:', 'martanian-oak-house' ) ); ?></h4>
                                <select name="martanian_oak_house_theme_options[translate-publication-dates]">

                                    <option value="yes" <?php selected( martanian_oak_house_get_theme_options_value( 'translate-publication-dates', false, false ), 'yes' ); ?>><?php echo esc_html( __( 'Yes', 'martanian-oak-house' ) ); ?></option>
                                    <option value="no" <?php selected( martanian_oak_house_get_theme_options_value( 'translate-publication-dates', false, false ), 'no' ); ?>><?php echo esc_html( __( 'No', 'martanian-oak-house' ) ); ?></option>

                                </select>

                            </div>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Textarea field in comment reply form', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'Do you want to display textarea field at the top of comments form (WordPress default) or at the bottom (theme default)?', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <div class="martanian-theme-options-single-option-form">

                                <h4><?php echo esc_html( __( 'Display textarea field at the top of comment reply form:', 'martanian-oak-house' ) ); ?></h4>
                                <select name="martanian_oak_house_theme_options[comment-textarea-at-top]">

                                    <option value="yes" <?php selected( martanian_oak_house_get_theme_options_value( 'comment-textarea-at-top', false, false ), 'yes' ); ?>><?php echo esc_html( __( 'Yes', 'martanian-oak-house' ) ); ?></option>
                                    <option value="no" <?php selected( martanian_oak_house_get_theme_options_value( 'comment-textarea-at-top', false, false ), 'no' ); ?>><?php echo esc_html( __( 'No', 'martanian-oak-house' ) ); ?></option>

                                </select>

                            </div>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Author box under blog post', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'You can configure author box under blog posts visibility here:', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <?php

                                # walk for each language
                                for( $i = 0; $i < count( $languages ); $i++ ) {

                                    # language key
                                    $lang_key = $languages[$i] == 'default' ? '[all]' : '['. strtolower( esc_attr( $languages[$i] ) ) .']';

                                    # language key for editor
                                    $lang_key_editor = $languages[$i] == 'default' ? 'all' : strtolower( esc_attr( $languages[$i] ) );

                                    ?>
                                    <div class="martanian-theme-options-single-option-form">

                                        <?php

                                            # language name
                                            if( $languages[$i] != 'default' ) {

                                                # get the language name
                                                $language_name = martanian_oak_house_get_language_name( $languages[$i] );

                                                ?>
                                                <div class="martanian-theme-options-single-option-form-language"><?php echo esc_html( $language_name ); ?></div>
                                                <?php
                                            }

                                        ?>

                                        <h4><?php echo esc_html( __( 'Display author box under blog post:', 'martanian-oak-house' ) ); ?></h4>
                                        <select name="martanian_oak_house_theme_options[author-box][display]<?php echo esc_attr( $lang_key ); ?>">

                                            <option value="yes" <?php selected( martanian_oak_house_get_theme_options_value( 'author-box', 'display', $lang_key ), 'yes' ); ?>><?php echo esc_html( __( 'Yes', 'martanian-oak-house' ) ); ?></option>
                                            <option value="no" <?php selected( martanian_oak_house_get_theme_options_value( 'author-box', 'display', $lang_key ), 'no' ); ?>><?php echo esc_html( __( 'No', 'martanian-oak-house' ) ); ?></option>

                                        </select>

                                    </div>
                                    <?php

                                # end of loop
                                }

                            ?>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Similar posts under blog post', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'Do you want to display similar posts under each single blog post?', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <div class="martanian-theme-options-single-option-form">

                                <h4><?php echo esc_html( __( 'Display similar posts under blog post:', 'martanian-oak-house' ) ); ?></h4>
                                <select name="martanian_oak_house_theme_options[display-similar-posts]">

                                    <option value="yes" <?php selected( martanian_oak_house_get_theme_options_value( 'display-similar-posts', false, false ), 'yes' ); ?>><?php echo esc_html( __( 'Yes', 'martanian-oak-house' ) ); ?></option>
                                    <option value="no" <?php selected( martanian_oak_house_get_theme_options_value( 'display-similar-posts', false, false ), 'no' ); ?>><?php echo esc_html( __( 'No', 'martanian-oak-house' ) ); ?></option>

                                </select>

                            </div>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Footer menu', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'Do you want to display the menu links in footer?', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <div class="martanian-theme-options-single-option-form">

                                <h4><?php echo esc_html( __( 'Footer menu enabled:', 'martanian-oak-house' ) ); ?></h4>
                                <select name="martanian_oak_house_theme_options[footer-menu-enabled]">

                                    <option value="yes" <?php selected( martanian_oak_house_get_theme_options_value( 'footer-menu-enabled', false, false ), 'yes' ); ?>><?php echo esc_html( __( 'Yes', 'martanian-oak-house' ) ); ?></option>
                                    <option value="no" <?php selected( martanian_oak_house_get_theme_options_value( 'footer-menu-enabled', false, false ), 'no' ); ?>><?php echo esc_html( __( 'No', 'martanian-oak-house' ) ); ?></option>

                                </select>

                            </div>

                        </div>

                        <div class="martanian-theme-options-single-option">

                            <div class="martanian-theme-options-single-option-padding">

                                <h3><?php echo esc_html( __( 'Footer content', 'martanian-oak-house' ) ); ?></h3>
                                <p><?php echo esc_html( __( 'You can configure your footer content here:', 'martanian-oak-house' ) ); ?></p>

                            </div>

                            <?php

                                # walk for each language
                                for( $i = 0; $i < count( $languages ); $i++ ) {

                                    # language key
                                    $lang_key = $languages[$i] == 'default' ? '[all]' : '['. strtolower( esc_attr( $languages[$i] ) ) .']';

                                    # language key for editor
                                    $lang_key_editor = $languages[$i] == 'default' ? 'all' : strtolower( esc_attr( $languages[$i] ) );

                                    ?>
                                    <div class="martanian-theme-options-single-option-form">

                                        <?php

                                            # language name
                                            if( $languages[$i] != 'default' ) {

                                                # get the language name
                                                $language_name = martanian_oak_house_get_language_name( $languages[$i] );

                                                ?>
                                                <div class="martanian-theme-options-single-option-form-language"><?php echo esc_html( $language_name ); ?></div>
                                                <?php
                                            }

                                        ?>

                                        <h4><?php echo esc_html( __( 'Footer content:', 'martanian-oak-house' ) ); ?></h4>
                                        <?php

                                            # textarea settings
                                            $settings = array(
                                                'teeny' => true,
                                                'textarea_rows' => 15,
                                                'tabindex' => 1
                                            );

                                            # show the editor
                                            wp_editor(
                                                martanian_oak_house_get_theme_options_value( 'footer', 'martanian_oak_house_theme_options_footer_content_'. strtolower( esc_attr( $lang_key_editor ) ), $lang_key ),
                                                'martanian_oak_house_theme_options_footer_content_'. strtolower( esc_attr( $lang_key_editor ) ),
                                                $settings
                                            );

                                        ?>

                                    </div>
                                    <?php

                                # end of loop
                                }

                            ?>

                        </div>

                        <div class="martanian-theme-options-save-changes">

                            <?php

                                # submit button
                                submit_button( esc_html( __( 'Save all changes', 'martanian-oak-house' ) ) );

                            ?>

                        </div>

                    </form>

                </div>

                <div class="martanian-oak-house-theme-options-single-tab" data-tab-key="<?php echo esc_attr( sanitize_title( esc_html( __( 'Load demo data', 'martanian-oak-house' ) ) ) ); ?>">

                    <div class="martanian-theme-options-demo-data-installation">

                        <h3><?php echo esc_html( __( 'Load demo data with one click', 'martanian-oak-house' ) ); ?></h3>
                        <p><?php echo esc_html( __( 'All current settings, widgets, menus will be overwritten, this operation can not be undone. Your website will be configured as same as theme demo page (without images, which are not included).', 'martanian-oak-house' ) ); ?></p>

                        <button id="martanian_oak_house_import" type="button" class="button"><?php echo esc_html( __( 'Yes, install demo data', 'martanian-oak-house' ) ); ?></button>
                        <div id="martanian_oak_house_import_message"></div>

                    </div>

                </div>

            </div>

        </div>
        <?php
    }

   /**
    *
    * register settings
    *
    */

    add_action( 'admin_init', 'martanian_oak_house_register_settings' );
    function martanian_oak_house_register_settings() {

        # get the languages array
        $languages = martanian_oak_house_get_languages_list();

        # there's no any language?
        if( $languages == false ) $languages = array( 'default' );

        # add theme options settings section
        add_settings_section( 'martanian_oak_house_admin_settings', '', null, 'martanian_oak_house_admin' );

        # add settings field: general theme options
        add_settings_field( 'martanian_oak_house_theme_options', '', null, 'martanian_oak_house_admin', 'martanian_oak_house_admin_settings' );
        register_setting( 'martanian_oak_house_admin', 'martanian_oak_house_theme_options', 'martanian_oak_house_validate_options' );

        # add settings field: footer content for each language
        for( $i = 0; $i < count( $languages ); $i++ ) {

            # language key for editor
            $lang_key_editor = $languages[$i] == 'default' ? 'all' : esc_attr( $languages[$i] );

            # add settings field
            add_settings_field( 'martanian_oak_house_theme_options_footer_content_'. strtolower( esc_attr( $lang_key_editor ) ), '', null, 'martanian_oak_house_admin', 'martanian_oak_house_admin_settings' );
            register_setting( 'martanian_oak_house_admin', 'martanian_oak_house_theme_options_footer_content_'. strtolower( esc_attr( $lang_key_editor ) ), 'martanian_oak_house_validate_contents' );
        }
    }

   /**
    *
    * settings validation function
    *
    */

    function martanian_oak_house_validate_options( $input ) {

        # getting current options
        $martanian_theme_options = get_option( 'martanian_oak_house_theme_options' );

        # option keys
        $option_keys = array(
            '404-page',
            'google-maps-api-key',
            'facebook-fanpage-url',
            'translate-publication-dates',
            'comment-textarea-at-top',
            'author-box',
            'display-similar-posts',
            'footer-menu-enabled',
            'footer'
        );

        # for each option keys
        foreach( $option_keys as $option_key ) {

            # if option key exists
            if( isset( $input[$option_key] ) ) {

                # protect inserts
                $martanian_theme_options[$option_key] = martanian_oak_house_secure( $input[$option_key] );
            }
        }

        # return values
        return( $martanian_theme_options );
    }

   /**
    *
    * contents validation function
    *
    */

    function martanian_oak_house_validate_contents( $input ) {

        # return result
        return( wp_kses_post( $input ) );
    }

   /**
    *
    * function for secure values
    * before saving in database
    *
    */

    function martanian_oak_house_secure( $data, $is_url = false ) {

        # if it is single variable, protect it
        if( !is_array( $data ) ) return( esc_attr( $data ) );

        # if array - recurence
        else {

            # recurence - protect every single variable
            foreach( $data as $key => $value ) {

                # get variable protection
                $data[$key] = martanian_oak_house_secure( $value );
            }
        }

        # return result
        return( $data );
    }

   /**
    *
    * end of file.
    *
    */

?>