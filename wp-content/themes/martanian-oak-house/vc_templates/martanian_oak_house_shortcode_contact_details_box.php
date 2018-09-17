<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Feel free to contact us', 'martanian-oak-house' ) )
    ), $atts ));

?>
<section class="contact-details-box">

    <?php

        # title
        if( !empty( $title ) ) {

            ?>
            <span class="contact-details-box-title"><span><?php echo esc_html( $title ); ?></span></span>
            <?php
        }

        # the content
        echo do_shortcode( $content );

    ?>

</section>