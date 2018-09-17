<?php

    # extract arguments
    extract( shortcode_atts( array(
       'interval' => 6000
    ), $atts ));

?>
<div class="images" data-interval="<?php echo esc_attr( $interval ); ?>">

    <?php

        # execute the shortcodes
        echo do_shortcode( $content );

    ?>

</div>