<?php

    # extract arguments
    extract( shortcode_atts( array(
        'image' => '',
        'image_position_y' => '50%',
        'image_position_x' => '50%',
        'image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
        'image_size' => 'normal'
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

    # additional class for image size
    $class_size = '';

    # do we need to add additional class name for size?
    if( $image_size != 'normal' ) {

        # get image size class name
        switch( $image_size ) {

            case 'double_width': $class_size .= 'isotope-grid-item-double-width'; break;
            case 'double_height': $class_size .= 'isotope-grid-item-double-height'; break;
            case 'double_both': $class_size .= 'isotope-grid-item-double-width isotope-grid-item-double-height'; break;
        }
    }

?>
<div class="isotope-grid-item <?php echo esc_attr( $class_size ); ?>">

    <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />

</div>