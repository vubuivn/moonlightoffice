<?php

   /**
    *
    * create default contact form shortcode
    *
    */

    function martanian_oak_house_default_wpcf7_shortcode( $onlyContact = false ) {

        # include the plugins script
        include_once( ABSPATH .'wp-admin/includes/plugin.php' );

        # do we have the polylang plugin?
        if( !martanian_oak_house_is_plugin_active( 'Contact Form 7' ) ) return( '' );

        # get the list of contact forms
        $contact_forms = get_posts( array(
            'posts_per_page' => -1,
            'post_type' => 'wpcf7_contact_form',
            'post_status' => 'publish',
        ));

        # default form ID
        $default = array(
            'id' => '0',
            'title' => ''
        );

        # not only for contact form?
        if( $onlyContact == false ) {

            # walk for each contact form
            foreach( $contact_forms as $form ) {

                # match the title
                if( sanitize_title( $form -> post_title ) == 'schedule-a-visit' ) {

                    $default['id'] = $form -> ID;
                    $default['title'] = $form -> post_title;
                }
            }
        }

        # nothing found?
        if( $default['id'] == '0' ) {

            # walk for each contact form
            foreach( $contact_forms as $form ) {

                # match the title
                if( sanitize_title( $form -> post_title ) == 'contact-form' ) {

                    $default['id'] = $form -> ID;
                    $default['title'] = $form -> post_title;
                }
            }
        }

        # still nothing?
        if( $default['id'] == '0' ) return( '' );

        # create the shortcode
        return( '[contact-form-7 id="'. esc_attr( $default['id'] ) .'" title="'. esc_attr( $default['title'] ) .'"]' );
    }

   /**
    *
    * translate date to "human" value
    *
    */

    function martanian_oak_house_show_when( $date, $display = true ) {

        # translate date
        $when = human_time_diff( $date, current_time( 'timestamp' ) ) . ' '. esc_html( __( 'ago', 'martanian-oak-house' ) );

        # display or return?
        if( $display == true ) echo esc_html( $when );
        else {

            # return result
            return( $when );
        }
    }

   /**
    *
    * translate comments dates
    *
    */

    function martanian_oak_house_translate_comments_dates( $comments ) {

        # do we have required classes?
        if( class_exists( 'DOMDocument' ) && class_exists( 'DOMXpath' ) ) {

            # can we translate publication dates?
            if( martanian_oak_house_get_theme_options_value( 'translate-publication-dates', false, false ) == 'yes' ) {

                # load DOMDocument class
                $dom = new DOMDocument();

                # load comments html to class
                $dom -> loadHTML( $comments );

                # create xpath object
                $xpath = new DOMXpath( $dom );

                # find the single comments
                $result = $xpath -> query( '//li[contains(@class, "comment")]' );

                # if dates are found
                if( $result -> length > 0 ) {

                    # create replacements array
                    $replacements = array();

                    # update the comments array
                    for( $i = 0; $i < $result -> length; $i++ ) {

                        # create comment data array
                        $single_comment = array(
                            'id' => str_replace( 'comment-', '', trim( $result -> item( $i ) -> getAttribute( 'id' ) ) ),
                            'html' => $dom -> saveHTML( $result -> item( $i ) )
                        );

                        # load DOMDocument class
                        $dom_comment = new DOMDocument();

                        # load comments html to class
                        $dom_comment -> loadHTML( $single_comment['html'] );

                        # create xpath object
                        $xpath_comment = new DOMXpath( $dom_comment );

                        # find the dates
                        $result_comment = $xpath_comment -> query( '//div[@class="comment-meta commentmetadata"]/a[not(contains(@class, "comment-edit-link"))]' );

                        # if dates are found
                        if( $result_comment -> length > 0 ) {

                            # get comment date is seconds
                            $single_comment['comment_date'] = get_comment_date( 'U', esc_html( $single_comment['id'] ) );

                            # get comment date string
                            $single_comment['comment_date_string'] = trim( $result_comment -> item( 0 ) -> nodeValue );

                            # get translated comment date
                            $single_comment['comment_date_translated'] = martanian_oak_house_show_when( $single_comment['comment_date'], false );
                        }

                        # add comment data array to replacements array
                        $replacements[] = $single_comment;
                    }

                    # do the replacements
                    foreach( $replacements as $replacement ) {

                        # update comments
                        $comments = str_replace( $replacement['comment_date_string'], $replacement['comment_date_translated'], $comments );
                    }
                }
            }
        }

        # return comments
        echo !empty( $comments ) ? $comments : '';
    }

   /**
    *
    * get post featured image
    *
    */

    function martanian_oak_house_get_featured_image( $post_id ) {

        # if we have post thumbnail
        if( has_post_thumbnail( $post_id ) ) {

            # getting post thumbnail
            $thumbnail = get_the_post_thumbnail( $post_id );

            # there is no thumbnail image?
            if( $thumbnail == '' || $thumbnail == false ) return false;

            # getting post thumbnail URL
            $thumbnail_url = explode( 'src="', $thumbnail );
            $thumbnail_url = substr( $thumbnail_url[1], 0, strpos( $thumbnail_url[1], '"' ) );

            # return thumbnail url
            return( $thumbnail_url );
        }

        # return empty string
        return( '' );
    }

   /**
    *
    * display contact details on top header bar
    *
    */

    function martanian_oak_house_display_top_header_bar_contact_details() {

        # theme mods object
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # if is multilingual, get language slug
        $locale = martanian_oak_house_get_current_language_locale();

        # do we have language slug?
        $locale = $locale == false ? '' : esc_attr( '_'. $locale );

        # default values array
        $defaults = array(
            'phone_number' => array(
                'text' => esc_html( __( '1-800-123-4567', 'martanian-oak-house' ) ),
                'url' => esc_url( __( 'tel:18001234567', 'martanian-oak-house' ) ),
                'in_new_tab' => '1',
                'slug' => 'phone-number'
            ),
            'email_address' => array(
                'text' => esc_html( __( 'email@example.com', 'martanian-oak-house' ) ),
                'url' => esc_url( __( 'mailto:email@example.com', 'martanian-oak-house' ) ),
                'in_new_tab' => '1',
                'slug' => 'email-address'
            ),
            'location' => array(
                'text' => esc_html( __( '15th Avenue, New York, NY', 'martanian-oak-house' ) ),
                'url' => '',
                'in_new_tab' => '1',
                'slug' => 'location'
            )
        );

        # display each element
        foreach( $defaults as $defaultID => $defaultValues ) {

            # contact element content
            $text = $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_'. esc_attr( $defaultID ) . esc_attr( $locale ), esc_attr( $defaultValues['text'] ) );

            # contact element URL
            $url = $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_'. esc_attr( $defaultID ) .'_url'. esc_attr( $locale ), esc_attr( $defaultValues['url'] ) );

            # do we need to open url in new tab?
            $in_new_tab = $theme_mods -> get_mod_value( 'top_header_bar_customizer_contact_details_'. esc_attr( $defaultID ) .'_in_new_tab'. esc_attr( $locale ), esc_attr( $defaultValues['in_new_tab'] ) );

            # do we have text set?
            if( $text != '' ) {

                ?>
                <div class="header-bar-top-element" data-element-type="<?php echo esc_attr( $defaultValues['slug'] ); ?>">

                    <?php

                        # do we have URL here?
                        if( $url != '' ) {

                            ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_html( $in_new_tab == '1' ? '_blank' : '_self' ); ?>">
                            <?php

                        # end of element url
                        }

                        # content
                        echo esc_html( $text );

                        # if we started URL, we need to close it
                        if( $url != '' ) {

                            ?>
                            </a>
                            <?php

                        # end of element url
                        }

                    ?>

                </div>
                <?php

            # end of element
            }
        }
    }

   /**
    *
    * display website logo
    *
    */

    function martanian_oak_house_display_logo() {

        # theme mods object
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # is multilingual?
        $is_multilingual = martanian_oak_house_is_multilingual();

        ?>
        <a href="<?php echo esc_url( home_url() ); ?>">

            <?php

                # not a multilingual website
                if( $is_multilingual == false ) {

                    ?>
                    <img src="<?php echo esc_url( $theme_mods -> get_mod_value( 'logo_customizer_logo_upload', get_template_directory_uri() .'/_assets/_img/logo.png' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" />
                    <?php
                }

                # multilingual
                else {

                    # get current language
                    $slug = martanian_oak_house_get_current_language_locale();

                    ?>
                    <img src="<?php echo esc_url( $theme_mods -> get_mod_value( 'logo_customizer_logo_upload_'. esc_attr( $slug ), get_template_directory_uri() .'/_assets/_img/logo.png' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" />
                    <?php
                }

            ?>

        </a>
        <?php
    }

   /**
    *
    * show heading menu
    *
    */

    function martanian_oak_house_heading_menu( $menu ) {

        $menu = str_replace( 'ul  class="sub-menu', 'ul class="sub-menu', $menu );

        # replace "sub-menu" classes to "children"
        $menu = str_replace( 'ul class="sub-menu', 'ul class="children', $menu );

        # default depth level
        $depth = 1;

        # explode menu elements
        $menu = explode( '<li', $menu );

        # each menu elements loop
        for( $i = 1; $i < count( $menu ); $i++ ) {

            # set removed element back
            $menu[$i] = '<li'. $menu[$i];

            # if this menu element contains sub-elements
            if( strpos( $menu[$i], '<ul class="children">' ) !== false || strpos( $menu[$i], "<ul class='children'>" ) !== false ) {

                # update depth level
                $depth = $depth + 1;

                # add "with-submenu" class
                $menu[$i] = trim( str_replace( 'menu-item-has-children', 'menu-item-has-children with-submenu', $menu[$i] ) );
                $menu[$i] = trim( str_replace( 'page_item_has_children', 'page_item_has_children with-submenu', $menu[$i] ) );

                # if depth = 2
                if( $depth == 2 ) {

                    # add icon "down"
                    $menu[$i] = str_replace( '</a>'. "\n" .'<ul class="children', ' <i class="fa fa-caret-down"></i></a><ul class="children', $menu[$i] );
                    $menu[$i] = str_replace( '</a><ul class=\'children', ' <i class="fa fa-caret-down"></i></a><ul class=\'children', $menu[$i] );
                }

                else {

                    # add icon "left"
                    $menu[$i] = explode( '>', $menu[$i] );
                    $menu[$i][2] = '<i class="fa fa-caret-left"></i> '. $menu[$i][2];
                    $menu[$i] = trim( implode( '>', $menu[$i] ) );
                }
            }

            # is closing element?
            else if( strpos( $menu[$i], '</ul>' ) !== false ) {

                # how much "</ul>" elements here?
                $depth = $depth - substr_count( $menu[$i], '</ul>' );
            }
        }

        # display result
        echo implode( '', str_replace( '<div>', '', str_replace( '</div>', '', $menu ) ) );
    }

   /**
    *
    * get similar posts
    *
    */

    function martanian_oak_house_display_similar_posts( $post = false, $is_404 = false ) {

        # can we display this box?
        if( martanian_oak_house_get_theme_options_value( 'display-similar-posts', false, false ) == 'no' ) return false;

        # default - not the latest posts
        $latest_posts = false;

        # there's no post set?
        if( $post == false ) {

            # change the title
            $latest_posts = true;

            # get last post
            foreach( get_posts( array( 'posts_per_page' => 2, 'ignore_sticky_posts' => 1 ) ) as $single_post ) {

                # save the post to variable
                $post = $single_post;
            }
        }

        # still there's no post?
        if( $post == false ) return;

        # create a copy of original post
        $orig_post = $post;

        # get current post tags
        $tags = wp_get_post_tags( $post -> ID );

        # do we have tags?
        if( $tags ) {

            # create tags ids array
            $tag_ids = array();
            foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag -> term_id;

            # create arguments array
            $args = array(
                'tag__in' => $tag_ids,
                'post__not_in' => array( $post -> ID ),
                'posts_per_page' => 2,
                'caller_get_posts' => 1
            );

            # new wp query
            $my_query = new wp_query( $args );

            # do we have posts?
            if( $my_query -> have_posts() ) {

                ?>
                <section class="similar-posts">

                    <h3><?php echo esc_html( $is_404 ? __( 'Articles you might like', 'martanian-oak-house' ) : __( 'Similar posts', 'martanian-oak-house' ) ); ?></h3>
                    <div class="posts">

                        <?php

                            # is first post?
                            $is_first = true;

                            # posts loop
                            while( $my_query -> have_posts() ) {

                                # current post
                                $my_query -> the_post();

                                ?>
                                <div class="<?php echo esc_attr( $is_first == true ? 'left' : 'right' ); ?>">

                                    <a href="<?php the_permalink()?>">

                                        <?php

                                            # do we have featured image?
                                            if( martanian_oak_house_get_featured_image( get_the_ID() ) != '' ) {

                                                ?>
                                                <div class="images">

                                                    <div class="image">

                                                        <img src="<?php echo martanian_oak_house_get_featured_image( get_the_ID() ); ?>" alt="<?php the_title(); ?>" class="image-data-for-parent" />

                                                    </div>

                                                </div>
                                                <?php

                                            # end of featured image
                                            }

                                        ?>

                                        <h4><?php the_title(); ?></h4>

                                    </a>

                                </div>
                                <?php

                                # update first post flag
                                $is_first = false;
                            }

                        ?>

                    </div>

                </section>
                <?php
            }
        }

        $post = $orig_post;
        wp_reset_query();
    }

   /**
    *
    * display author box after blog post
    *
    */

    function martanian_oak_house_display_author_box( $author_id, $post ) {

        # author description
        $description = get_the_author_meta( 'user_description', $author_id );

        # there's no description set?
        if( empty( $description ) ) return;

        # get the current language
        $language = martanian_oak_house_get_current_language_locale();

        # get the current language key
        $lang_key = $language == false ? '[all]' : '['. strtolower( esc_attr( $language ) ) .']';

        # get the current language key for editor
        $lang_key_editor = $language == false ? 'all' : strtolower( esc_attr( $language ) );

        ?>
        <div class="author-box">

            <div class="author-box-image">

                 <img src="<?php echo esc_url( get_avatar_url( $author_id, array( 'size' => 120 ) ) ); ?>" alt="<?php echo esc_attr( get_the_author_meta( 'display_name', $author_id ) ); ?>" class="image-data-for-parent" />

            </div>

            <div class="author-box-content">

                <h3>

                    <?php

                        # do we have first or last author name?
                        if( get_the_author_meta( 'first_name', $author_id ) != '' || get_the_author_meta( 'last_name', $author_id ) != '' ) {

                            # getting author first name
                            if( get_the_author_meta( 'first_name', $author_id ) != '' ) echo esc_html( get_the_author_meta( 'first_name', $author_id ) );

                            # getting author last name
                            if( get_the_author_meta( 'last_name', $author_id ) != '' ) {

                                ?>
                                <strong><?php echo esc_html( get_the_author_meta( 'last_name', $author_id ) ); ?></strong>
                                <?php

                            # end of author last name
                            }
                        }

                        # get author nick
                        else {

                            # only author nick
                            echo esc_html( get_the_author_meta( 'display_name', $author_id ) );
                        }

                    ?>

                </h3>

                <div class="author-box-description">

                    <?php

                        # display the description
                        echo wpautop( do_shortcode( $description ) );

                    ?>

                </div>

            </div>

        </div>
        <?php
    }

   /**
    *
    * display footer content
    *
    */

    function martanian_oak_house_display_footer_content() {

        # get the current language
        $language = martanian_oak_house_get_current_language_locale();

        # get the current language key
        $lang_key = $language == false ? '[all]' : '['. strtolower( esc_attr( $language ) ) .']';

        # get the current language key for editor
        $lang_key_editor = $language == false ? 'all' : strtolower( esc_attr( $language ) );

        # return result
        echo wpautop( do_shortcode( martanian_oak_house_get_theme_options_value( 'footer', 'martanian_oak_house_theme_options_footer_content_'. strtolower( esc_attr( $lang_key_editor ) ), $lang_key ) ) );
    }

   /**
    *
    * get the custom css code
    *
    */

    function martanian_oak_house_get_custom_css_code( $content ) {

        # get custom CSS, if exists
        $post_content = explode( 'css=".vc_custom_', $content );

        # define the result
        $result = '';

        # do we have it?
        if( count( $post_content ) > 0 ) {

            # loop
            for( $i = 1; $i < count( $post_content ); $i++ ) {

                $post_content[$i] = explode( '"', $post_content[$i] );
                $result .= '.vc_custom_'. $post_content[$i][0];
            }
        }

        ?>
        <style type="text/css"><?php echo esc_html( $result ); ?></style>
        <?php
    }

   /**
    *
    * minify the css
    *
    */

    function martanian_oak_house_minify_css( $buffer ) {

        # do the magic
        $buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
        $buffer = str_replace( ': ', ':', $buffer );
        $buffer = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );

        # return the result
        return( $buffer );
    }

   /**
    *
    * is visual composer content page?
    *
    */

    function martanian_oak_house_is_vc_page( $content ) {

        # return the result
        return( strpos( $content, '[vc_row' ) !== false );
    }

   /**
    *
    * comment field to bottom
    *
    */

    add_filter( 'comment_form_fields', 'martanian_oak_house_move_comment_field_to_bottom' );
    function martanian_oak_house_move_comment_field_to_bottom( $fields ) {

        # do we need to change it?
        if( martanian_oak_house_get_theme_options_value( 'comment-textarea-at-top', false, false ) == 'yes' ) return( $fields );

        # get comment field copy
        $comment_field = $fields['comment'];

        # remove comment field
        unset( $fields['comment'] );

        # and add it again
        $fields['comment'] = $comment_field;

        # return updated result
        return( $fields );
    }

   /**
    *
    * get tags and categories as a tagcloud
    *
    */

    function martanian_oak_house_display_as_tagcloud( $elements, $type = 'category' ) {

        # do we have the links
        if( $elements == false || $elements == null || !is_array( $elements ) || count( $elements ) < 1 ) return false;

        # walk each all links
        foreach( $elements as $element ) {

            # create link
            $link = $type == 'category' ? get_category_link( $element -> term_id ) : get_tag_link( $element -> term_id );

            ?>
            <a href="<?php echo esc_url( $link ); ?>" class="element"><?php echo esc_html( $element -> name ); ?></a>
            <?php
        }
    }

   /**
    *
    * custom search field widget
    *
    */

    add_filter( 'get_search_form', 'martanian_oak_house_custom_search_form_widget' );
    function martanian_oak_house_custom_search_form_widget( $form ) {

        # define the result
        $result = '<form role="search" method="get" id="searchform" action="'. esc_url( home_url( '/' ) ) .'">

                       <span class="search-field">

                           <input type="text" placeholder="'. esc_html( __( 'Search', 'martanian-oak-house' ) ) .'" value="'. esc_attr( get_search_query() ) .'" name="s" id="search-form" />
                           <button type="submit"><i class="fa fa-search"></i></button>

                       </span>

                   </form>';

        # return result
        return( $result );
    }

   /**
    *
    * display facebook like button near the blog post content
    *
    */

    function martanian_oak_house_facebook_like_button_near_blog_post_content() {

        # get the current language
        $language = martanian_oak_house_get_current_language_locale();

        # get the current language key
        $lang_key = $language == false ? '[all]' : '['. strtolower( esc_attr( $language ) ) .']';

        # do we have facebook like button set?
        if( martanian_oak_house_is_facebook_like_button_set() ) {

            ?>
            <div class="facebook-like-share-button">

                <div class="fb-like" data-href="<?php echo esc_url( martanian_oak_house_get_theme_options_value( 'facebook-fanpage-url', false, $lang_key ) ); ?>" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="false">
                </div>

            </div>
            <?php

        # end of facebook button
        }
    }

   /**
    *
    * check if we have facebook like button set
    *
    */

    function martanian_oak_house_is_facebook_like_button_set() {

        # get the current language
        $language = martanian_oak_house_get_current_language_locale();

        # get the current language key
        $lang_key = $language == false ? '[all]' : '['. strtolower( esc_attr( $language ) ) .']';

        # do we have facebook like button set?
        return( martanian_oak_house_get_theme_options_value( 'facebook-fanpage-url', false, $lang_key ) != '' );
    }

   /**
    *
    * add class to next/prev posts links
    *
    */

    add_filter( 'next_posts_link_attributes', 'martanian_oak_house_posts_link_attributes' );
    function martanian_oak_house_posts_link_attributes() {

        # return class
        return( 'class="button button-color"' );
    }

   /**
    *
    * add responsive styles for "faq-short" section
    *
    */

    add_action( 'wp_enqueue_scripts', 'martanian_oak_house_faq_short_styles' );
    function martanian_oak_house_faq_short_styles() {

        # get the content
        $post_data = get_post( get_the_ID() );

        # there's no post?
        if( $post_data == null || !isset( $post_data -> post_content ) ) return;

        # all's fine - get the shortcodes
        $shortcodes = martanian_oak_house_get_faq_short_shortcodes_from_content( $post_data -> post_content );

        # define the result css
        $result_css = '';

        # do we have this shortcodes set?
        if( is_array( $shortcodes ) && count( $shortcodes ) > 0 ) {

            # configure the faq section id
            $section_id = 1;

            # walk for each shortcode
            foreach( $shortcodes as $shortcode ) {

                # default values
                $styles = array(
                    'screen_1200_more' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 100%;',
                    'screen_992_1199' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 72%;',
                    'screen_768_991' => 'background-position: -150px bottom;'. "\n" .'background-size: auto 72%;',
                    'screen_767_less' => 'background-position: -40px bottom;'. "\n" .'background-size: auto 270px;'
                );

                # walk for each options
                foreach( $styles as $style => $value ) {

                    # find the code for current style
                    if( strpos( $shortcode, $style .'="' ) !== false ) {

                        # get the screen styles
                        $value = explode( $style .'="', $shortcode );
                        $value = explode( '"', $value[1] );
                        $value = strip_tags( $value[0] );

                        # update the array
                        $styles[$style] = $value;
                    }
                }

                # update the result css
                $result_css .= martanian_oak_house_minify_css(
                    '@media (max-width: 767px) { section.faq-short[data-faq-short-id="'. esc_attr( $section_id ) .'"] { '. esc_html( $styles['screen_767_less'] ) .' }}
                     @media (min-width: 768px) and (max-width: 991px) { section.faq-short[data-faq-short-id="'. esc_attr( $section_id ) .'"] { '. esc_html( $styles['screen_768_991'] ) .' }}
                     @media (min-width: 992px) and (max-width: 1199px) { section.faq-short[data-faq-short-id="'. esc_attr( $section_id ) .'"] { '. esc_html( $styles['screen_992_1199'] ) .' }}
                     @media (min-width: 1200px) { section.faq-short[data-faq-short-id="'. esc_attr( $section_id ) .'"] { '. esc_html( $styles['screen_1200_more'] ) .' }} '
                );

                # update the section id
                $section_id++;
            }

            # add inline style
            wp_add_inline_style( 'martanian-oak-house-stylesheet', $result_css );
        }
    }

   /**
    *
    * get all shortcode codes from page content
    *
    */

    function martanian_oak_house_get_faq_short_shortcodes_from_content( $content ) {

        # do we have this shortcode set?
        if( strpos( $content, '[martanian_oak_house_shortcode_faq_short' ) === false ) return( false );

        # explode the content
        $content_exploded = explode( '[martanian_oak_house_shortcode_faq_short', $content );

        # result array
        $shortcodes = array();

        # walk for each shortcodes
        for( $i = 0; $i < substr_count( $content, '[martanian_oak_house_shortcode_faq_short' ); $i++ ) {

            # shortcode content
            $shortcode = '[martanian_oak_house_shortcode_faq_short'. $content_exploded[( $i + 1 )];
            $shortcode = explode( ']', $shortcode );
            $shortcode = $shortcode[0] .']';

            # update the results array
            $shortcodes[] = $shortcode;
        }

        return( $shortcodes );
    }

   /**
    *
    * add facebook javascript sdk
    *
    */

    add_action( 'wp_enqueue_scripts', 'martanian_oak_house_facebook_javascript_sdk' );
    function martanian_oak_house_facebook_javascript_sdk() {

        # add the script
        wp_add_inline_script( 'martanian-oak-house-javascript-functions', '(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7"; fjs.parentNode.insertBefore(js, fjs); }(document, "script", "facebook-jssdk"));' );
    }

   /**
    *
    * remove empty paragraphs created by wpautop()
    *
    */

    add_filter( 'the_content', 'martanian_oak_house_remove_empty_p', 20, 1 );
    function martanian_oak_house_remove_empty_p( $content ) {

        # do the updates
        $content = force_balance_tags( $content );
        $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
        $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );

        # return result
        return( $content );
    }

   /**
    *
    * display the content for 404 page
    *
    */

    function martanian_oak_house_get_404_page_content() {

        # get the current language
        $language = martanian_oak_house_get_current_language_locale();

        # get the current language key
        $lang_key = $language == false ? '[all]' : '['. strtolower( esc_attr( $language ) ) .']';

        # get 404 page ID
        $pageID = martanian_oak_house_get_theme_options_value( '404-page', 'page-id', $lang_key );

        # get post content
        $posts_page = get_post( $pageID );

        # do we have it?
        if( $posts_page != null && $posts_page != false ) {

            ?>
            <div class="contents">

                <?php

                    # get the custom css code
                    martanian_oak_house_get_custom_css_code( $posts_page -> post_content );

                    # display it
                    echo apply_filters( 'the_content', $posts_page -> post_content );

                ?>

            </div>
            <?php
        }

        # there's no 404 page configured
        else {

            ?>
            <div class="container">

                <div class="row row-padding-top">

                    <div class="col-md-8">

                        <article class="blog-post content-element">

                            <h1><?php echo esc_html( __( 'Nothing found here...', 'martanian-oak-house' ) ); ?></h1>
                            <p><?php echo esc_html( __( 'We couldn’t find the results you’re looking for - it may be removed, or temporary hidden. Please try to use the search form, or go back to home page.', 'martanian-oak-house' ) ); ?></p>

                        </article>

                        <?php

                            # show similar posts
                            martanian_oak_house_display_similar_posts( false, true );

                        ?>

                    </div>

                    <div class="col-md-4">

                        <?php

                            # get sidebar for blog
                            get_sidebar();

                        ?>

                    </div>

                </div>

            </div>
            <?php
        }
    }

   /**
    *
    * default footer menu
    *
    */

    function martanian_oak_house_default_footer_menu() {

        ?>
        <div class="menu">

            <ul>

                <li><a href="<?php echo esc_url( get_home_url() ); ?>"><?php echo esc_html( __( 'Home page', 'martanian-oak-house' ) ); ?></a></li>

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