<?php

    # extract arguments
    extract( shortcode_atts( array(
       'left_image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
       'left_image_position_y' => '50%',
       'left_image_position_x' => '50%',
       'left_image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
       'right_image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
       'right_image_position_y' => '50%',
       'right_image_position_x' => '50%',
       'right_image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) )
    ), $atts ));

    # get images src
    $left_image = martanian_oak_house_get_image_src( $left_image );
    $right_image = martanian_oak_house_get_image_src( $right_image );

?>
<section class="double-images">

    <div class="col-md-5 col-md-offset-1">

        <div class="images">

            <div class="image">

                <img src="<?php echo esc_url( $left_image ); ?>" data-image-position-x="<?php echo esc_attr( $left_image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $left_image_position_y ); ?>" alt="<?php echo esc_attr( $left_image_alt ); ?>" class="image-data-for-parent" />

            </div>

        </div>

    </div>

    <div class="col-md-5">

        <div class="images">

            <div class="image">

                <img src="<?php echo esc_url( $right_image ); ?>" data-image-position-x="<?php echo esc_attr( $right_image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $right_image_position_y ); ?>" alt="<?php echo esc_attr( $right_image_alt ); ?>" class="image-data-for-parent" />

            </div>

        </div>

    </div>

</section>