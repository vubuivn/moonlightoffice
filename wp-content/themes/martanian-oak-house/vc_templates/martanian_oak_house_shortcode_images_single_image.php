<?php

    # extract arguments
    extract( shortcode_atts( array(
        'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
        'image_position_y' => '50%',
        'image_position_x' => '50%',
        'image_alt' => '',
        'image_height' => 'normal'
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<div class="image <?php echo esc_attr( $image_height != 'normal' ? 'image-long' : '' ); ?>" data-check-if-single="yes">

    <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />

</div>