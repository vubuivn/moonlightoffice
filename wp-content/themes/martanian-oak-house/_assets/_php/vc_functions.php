<?php

   /**
    *
    * get default button url
    *
    */

    function martanian_oak_house_get_default_button_url( $page, $title ) {

        # get blog page permalink
        if( $page == esc_html( __( 'Blog', 'martanian-oak-house' ) ) ) $link = get_permalink( get_option( 'page_for_posts' ) );

        # get home page permalink
        else if( $page == esc_html( __( 'Home', 'martanian-oak-house' ) ) ) $link = get_permalink( get_option( 'page_on_front' ) );

        # other pages permalinks
        else {

            $page = get_page_by_title( $page );
            $link = $page != null ? get_permalink( $page -> ID ) : '';
        }

        # return result
        return( 'url:'. rawurlencode( esc_url( $link ) ) .'|title:'. rawurlencode( esc_html( $title ) ) .'||' );
    }

   /**
    *
    * check if button is empty
    *
    */

    function martanian_oak_house_is_button_for_vc_section_empty( $button_url, $button_icon ) {

        # is empty?
        if( empty( $button_url ) ) return true;

        # get button details
        $button = vc_build_link( $button_url );

        # check again
        if( empty( $button['url'] ) || ( empty( $button['title'] ) && empty( $button_icon ) ) ) return true;

        # is not empty
        return false;
    }

   /**
    *
    * display buttons on custom visual composer sections
    *
    */

    function martanian_oak_house_display_button_for_vc_section( $button_url, $button_class, $show_button_icon, $button_icon ) {

        # get button details
        $button = vc_build_link( $button_url );

        # do we have a button?
        if( !empty( $button['url'] ) && ( !empty( $button['title'] ) || !empty( $button_icon ) ) ) {

            # form popup button
            if( $button['url'] == '#show-form-popup' ) {

                ?>
                <button class="<?php echo esc_attr( $button_class ); ?>" data-action="show-form-popup">

                    <span>

                        <?php

                            # button title
                            echo esc_html( $button['title'] );

                            # do we have icon set?
                            if( $show_button_icon == 'checked' ) {

                                ?>
                                <i class="<?php echo esc_attr( $button_icon ); ?>"></i>
                                <?php
                            }

                        ?>

                    </span>

                </button>
                <?php
            }

            # link
            else {

                ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( trim( $button['target'] ) == '_blank' ? '_blank' : '_self' ); ?>" class="<?php echo esc_attr( $button_class ); ?>">

                    <span>

                        <?php

                            # link title
                            echo esc_html( $button['title'] );

                            # do we have icon set?
                            if( $show_button_icon == 'checked' ) {

                                ?>
                                <i class="<?php echo esc_attr( $button_icon ); ?>"></i>
                                <?php
                            }

                        ?>

                    </span>

                </a>
                <?php

            # end of link
            }

        # end of the button
        }
    }

   /**
    *
    * get image src
    *
    */

    function martanian_oak_house_get_image_src( $image ) {

        # is image chosen?
        if( is_numeric( $image ) ) {

            # get image source
            $image_src = wp_get_attachment_image_src( $image, 'full' );

            # update image variable
            if( $image_src == false ) $image = esc_url( get_template_directory_uri() .'/_assets/_img/image.png' );
            else $image = $image_src[0];
        }

        # return image src
        return( $image );
    }

   /**
    *
    * display pricing table icons
    *
    */

    function martanian_oak_house_pricing_table_icons( $text ) {

        # icon:no
        if( $text == 'icon:no' ) return( '<i class="fa fa-times"></i>' );

        # icon:yes
        if( $text == 'icon:yes' ) return( '<i class="fa fa-check"></i>' );

        # default
        return( $text );
    }

   /**
    *
    * end of the file.
    *
    */

?>