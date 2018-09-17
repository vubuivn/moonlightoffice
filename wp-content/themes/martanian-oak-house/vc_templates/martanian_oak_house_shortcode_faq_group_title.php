<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'About us', 'martanian-oak-house' ) )
    ), $atts ));

?>
<span class="faq-group-title"><span><?php echo esc_html( $title ); ?></span></span>