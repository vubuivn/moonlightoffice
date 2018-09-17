<?php

    # extract arguments
    extract( shortcode_atts( array(
       'lat' => '34.061606',
       'lng' => '-118.277556',
       'zoom' => '17'
    ), $atts ));

?>
<section class="location-details">

    <?php

        # get the markers
        echo do_shortcode( $content );

    ?>

    <div class="location-details-map" data-lat="<?php echo esc_attr( $lat ); ?>" data-lng="<?php echo esc_attr( $lng ); ?>" data-zoom-level="<?php echo esc_attr( $zoom ); ?>">
    </div>

</section>