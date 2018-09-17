<?php

    /*

      Plugin Name: Martanian Shortcodes
      Description: Shortcodes package dedicated for Martanian themes
      Author: Martanian <support@martanian.com>
      Author URI: http://themeforest.net/user/martanian
      Version: 1.0

    */

   /**
    *
    * clear attribute
    *
    */

    function martanian_shortcodes_clear_attribute( $attr ) {

        # return result
        return( str_replace( '&quot;', '', $attr ) );
    }

   /**
    *
    * link shortcode
    *
    */

    add_shortcode( 'link', 'martanian_shortcodes_shortcode_link' );
    function martanian_shortcodes_shortcode_link( $attr, $content = null ) {

        # is an "to" parameter?
        if( !isset( $attr['to'] ) || $attr['to'] == '' ) return( '' );

        # is is phone number?
        if( isset( $attr['is_phone'] ) && martanian_shortcodes_clear_attribute( $attr['is_phone'] ) == 'yes' ) {

            # phone atts
            $phone = $attr;

            # remove not-phone elements
            unset( $phone['is_phone'] );

            # phone number "bad chars"
            $bad_chars = array(
                '"' => '',
                '&quot;' => '',
                '(' => '',
                ')' => '',
                '+' => '',
                ' ' => ''
            );

            # return the result
            return( '<a href="tel:'. strtr( implode( $phone ), $bad_chars ) .'">'. do_shortcode( esc_html( $content ) ) .'</a>' );
        }

        # is button?
        $button = isset( $attr['is_button'] ) && martanian_shortcodes_clear_attribute( $attr['is_button'] ) == 'yes' ? 'button' : '';

        # target?
        $target = isset( $attr['target'] ) && martanian_shortcodes_clear_attribute( $attr['target'] ) == 'blank' ? '_blank' : '_self';

        # return the result
        return( '<a href="'. martanian_shortcodes_clear_attribute( $attr['to'] ) .'" class="'. esc_attr( $button ) .'" target="'. esc_attr( $target ) .'">'. do_shortcode( esc_html( $content ) ) .'</a>' );
    }

   /**
    *
    * newline shortcode
    *
    */

    add_shortcode( 'newline', 'martanian_shortcodes_shortcode_newline' );
    function martanian_shortcodes_shortcode_newline( $attr ) {

        # return result
        return( '<br />' );
    }

   /**
    *
    * icon shortcode
    *
    */

    add_shortcode( 'icon', 'martanian_shortcodes_shortcode_icon' );
    function martanian_shortcodes_shortcode_icon( $attr ) {

        # before button text?
        $before = isset( $attr['before_text'] ) && martanian_shortcodes_clear_attribute( $attr['before_text'] ) == 'yes' ? 'icon-before-text' : '';

        # return result
        return( !isset( $attr['class'] ) ? '' : '<i class="'. martanian_shortcodes_clear_attribute( $attr['class'] ) .' '. $before .'"></i>' );
    }

   /**
    *
    * strong shortcode
    *
    */

    add_shortcode( 'strong', 'martanian_shortcodes_shortcode_strong' );
    function martanian_shortcodes_shortcode_strong( $attr, $content = null ) {

        # return result
        return( '<strong>'. esc_html( $content ) .'</strong>' );
    }

   /**
    *
    * social
    *
    */

    add_shortcode( 'social_parent', 'martanian_shortcodes_shortcode_social_parent' );
    function martanian_shortcodes_shortcode_social_parent( $attr, $content = null ) {

        # return result
        return( '<ul class="social-media">'. do_shortcode( $content ) .'</ul>' );
    }

   /**
    *
    * social element
    *
    */

    add_shortcode( 'social', 'martanian_shortcodes_shortcode_social' );
    function martanian_shortcodes_shortcode_social( $attr ) {

        # link
        $link = isset( $attr['link'] ) && $attr['link'] != '' ? martanian_shortcodes_clear_attribute( $attr['link'] ) : '';

        # icon
        $icon = isset( $attr['icon'] ) && $attr['icon'] != '' ? martanian_shortcodes_clear_attribute( $attr['icon'] ) : '';

        # return result
        return( '<li><a href="'. esc_attr( $link ) .'"><i class="'. esc_attr( $icon ) .'"></i></a></li>' );
    }

   /**
    *
    * image
    *
    */

    add_shortcode( 'image', 'martanian_shortcodes_shortcode_image' );
    function martanian_shortcode_image( $attr, $content = null ) {

        # width
        $width = isset( $attr['width'] ) && $attr['width'] != '' ? martanian_shortcodes_clear_attribute( $attr['width'] ) : false;

        # height
        $height = isset( $attr['height'] ) && $attr['height'] != '' ? martanian_shortcodes_clear_attribute( $attr['height'] ) : false;

        # define style
        $style = '';

        # do we have width or height?
        if( $width != false || $height != false ) {

            # create style definition
            $style = 'style="'. ( $width != false ? 'width: '. $width .'px; ' : '' ) . ( $height != false ? 'height: '. $height .'px; ' : '' ) .'"';
        }

        # return result
        return( '<img src="'. esc_url( $content ) .'" '. $style .' />' );
    }

   /**
    *
    * facebook "like" box
    *
    */

    add_shortcode( 'facebook_like_box', 'martanian_shortcode_facebook_like_box' );
    function martanian_shortcode_facebook_like_box( $attr, $content = null ) {

        # fanpage url
        $href = isset( $attr['href'] ) && $attr['href'] != '' ? martanian_shortcodes_clear_attribute( $attr['href'] ) : 'https://facebook.com/envato';

        # return result
        return( '<div class="fb-like-box-ccs"><div class="fb-like" data-href="'. esc_url( $href ) .'" data-layout="standard" data-width="270" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div></div>' );
    }

   /**
    *
    * line
    *
    */

    add_shortcode( 'line', 'martanian_shortcode_line' );
    function martanian_shortcode_line() {

        # return result
        return( '<div class="line"></div>' );
    }

   /**
    *
    * end of file.
    *
    */

?>