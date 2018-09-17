<?php

    # extract arguments
    extract( shortcode_atts( array(
       'lat' => '34.061606',
       'lng' => '-118.277556'
    ), $atts ));

?>
<span class="location-details-map-marker" data-lat="<?php echo esc_attr( $lat ); ?>" data-lng="<?php echo esc_attr( $lng ); ?>"></span>