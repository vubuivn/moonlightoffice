<?php

   /**
    *
    * check if this website is multilingual
    *
    */

    function martanian_oak_house_is_multilingual() {

        # include the plugins script
        include_once( ABSPATH .'wp-admin/includes/plugin.php' );

        # multilingual plugin name
        $plugin = false;

        # do we have the wpml plugin?
        if( martanian_oak_house_is_plugin_active( 'WPML' ) ) $plugin = 'wpml';

        # do we have the polylang plugin?
        if( martanian_oak_house_is_plugin_active( 'Polylang' ) ) $plugin = 'polylang';

        # return the result
        return( $plugin );
    }

   /**
    *
    * get the languages list
    *
    */

    function martanian_oak_house_get_languages_list() {

        # check if is multilingual
        $is_multilingual = martanian_oak_house_is_multilingual();

        # is is not a multilingual website?
        if( $is_multilingual == false ) return;

        # get the languages list from each plugin
        switch( $is_multilingual ) {

            # wpml
            case 'wpml':

                # there is no this function?
                if( !function_exists( 'icl_get_languages' ) ) return false;

                # get the all languages array
                $languages = icl_get_languages( 'skip_missing=0' );

                # prepare the result
                $result = array();

                # walk for each language
                foreach( $languages as $language ) {

                    # update the result
                    $result[] = esc_attr( $language['code'] );
                }

                # return the result
                return( $result );

            break;

            # polylang
            case 'polylang':

                # there is no this function?
                if( !function_exists( 'pll_languages_list' ) ) return false;

                # return the result
                return( pll_languages_list( array( 'fields' => 'locale' ) ) );

            break;
        }

        # false
        return false;
    }

   /**
    *
    * get language name by slug
    *
    */

    function martanian_oak_house_get_language_name( $locale ) {

        # check if is multilingual
        $is_multilingual = martanian_oak_house_is_multilingual();

        # is is not a multilingual website?
        if( $is_multilingual == false ) return;

        # get the languages list from each plugin
        switch( $is_multilingual ) {

            # wpml
            case 'wpml':

                # there is no this function?
                if( !function_exists( 'icl_get_languages' ) ) return false;

                # get the all languages array
                $languages = icl_get_languages( 'skip_missing=0' );

                # walk for each language
                foreach( $languages as $language ) {

                    # update the result
                    if( $language['code'] == $locale ) return( esc_html( $language['native_name'] ) );
                }

                # nothing found
                return false;

            break;

            # polylang
            case 'polylang':

                # there is no this function?
                if( !function_exists( 'PLL' ) ) return false;

                # get all languages list
                $list = PLL() -> model -> get_languages_list();

                # do we have the languages?
                if( !is_array( $list ) || count( $list ) == 0 ) return false;

                # find our language
                for( $i = 0; $i < count( $list ); $i++ ) {

                    # compare
                    if( $list[$i] -> locale == $locale ) return esc_html( $list[$i] -> name );
                }

                # nothing found
                return false;

            break;
        }

        # false
        return false;
    }

   /**
    *
    * get current language slug
    *
    */

    function martanian_oak_house_get_current_language_locale() {

        # check if is multilingual
        $is_multilingual = martanian_oak_house_is_multilingual();

        # is is not a multilingual website?
        if( $is_multilingual == false ) return false;

        # get the languages list from each plugin
        switch( $is_multilingual ) {

            # wpml
            case 'wpml':

                # return result
                return( ICL_LANGUAGE_CODE );

            break;

            # polylang
            case 'polylang':

                # there is no this function?
                if( !function_exists( 'pll_current_language' ) ) return false;

                # nothing found
                return pll_current_language( 'locale' );

            break;
        }

        # false
        return false;
    }

   /**
    *
    * get languages switcher
    *
    */

    function martanian_oak_house_display_languages_switcher( $post ) {

        # check if is multilingual
        $is_multilingual = martanian_oak_house_is_multilingual();

        # is is not a multilingual website?
        if( $is_multilingual == false ) return;

        # current language details
        $current_language = array(
            'key' => '',
            'name' => ''
        );

        # get current language details
        switch( $is_multilingual ) {

            # wpml
            case 'wpml':

                # language key
                $current_language['key'] = ICL_LANGUAGE_CODE;

                # language name
                $current_language['name'] = ICL_LANGUAGE_NAME;

            break;

            # polylang
            case 'polylang':

                # do we have necessary functions?
                if( function_exists( 'pll_current_language' ) ) {

                    # language key
                    $current_language['key'] = pll_current_language( 'locale' );

                    # language name
                    $current_language['name'] = pll_current_language( 'name' );
                }

            break;
        }

        ?>
        <div class="header-bar-top-element languages-switcher" data-element-type="languages">

            <span class="current-language" data-current-language-key="<?php echo esc_attr( $current_language['key'] ); ?>">

                <?php echo esc_html( $current_language['name'] ); ?>
                <i class="fa fa-caret-down"></i>

            </span>

            <ul class="languages-switcher-list">

                <?php

                    # wpml
                    if( $is_multilingual == 'wpml' && function_exists( 'icl_get_languages' ) ) {

                        # default value for "skip missing" translations
                        $skip_missing = 0;

                        # try to get wpml settings
                        $wpml_settings = get_option( 'icl_sitepress_settings' );

                        # do we have wpml settings?
                        if( $wpml_settings != false && $wpml_settings != null && is_array( $wpml_settings ) && isset( $wpml_settings['icl_lso_link_empty'] ) ) {

                            # update "skip missing" variable
                            $skip_missing = $wpml_settings['icl_lso_link_empty'] == 1 ? 0 : 1;
                        }

                        # get the all languages array
                        $languages = icl_get_languages( 'skip_missing='. esc_attr( $skip_missing ) );

                        # walk for each language
                        foreach( $languages as $language ) {

                            ?>
                            <li><a href="<?php echo esc_url( $language['url'] ); ?>"><?php echo esc_html( $language['native_name'] ); ?></a></li>
                            <?php
                        }
                    }

                    # polylang
                    else if( $is_multilingual == 'polylang' && function_exists( 'pll_the_languages' ) ) {

                        # get the languages list
                        pll_the_languages( ( $post == null || $post == false ) ? array() : array( 'post_id' => $post -> ID ) );
                    }

                ?>

            </ul>

        </div>
        <?php
    }

   /**
    *
    * end of file.
    *
    */

?>