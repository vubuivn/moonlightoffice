<?php

    # extract arguments
    extract( shortcode_atts( array(
       'interval' => 6000
    ), $atts ));

?>
<section class="heading-slider" data-interval="<?php echo esc_attr( $interval ); ?>">

    <?php

        # display the heading slides
        echo do_shortcode( $content );

    ?>

</section>