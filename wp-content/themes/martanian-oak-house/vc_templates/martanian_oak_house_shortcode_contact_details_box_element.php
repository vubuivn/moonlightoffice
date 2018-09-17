<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Phone, FAX', 'martanian-oak-house' ) ),
       'value' => esc_html( __( '1-800-123-4567', 'martanian-oak-house' ) ),
       'size' => 'normal'
    ), $atts ));

    # title
    if( !empty( $title ) ) {

        ?>
        <span class="title"><?php echo esc_html( $title ); ?></span>
        <?php
    }

    # value
    if( !empty( $value ) ) {

        ?>
        <span class="value <?php echo esc_attr( $size == 'bigger' ? 'value-big' : '' ); ?>"><?php echo do_shortcode( $value ); ?></span>
        <?php
    }

?>