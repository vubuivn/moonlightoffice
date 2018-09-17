<?php

    # extract arguments
    extract( shortcode_atts( array(
        'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
        'image_position_y' => '50%',
        'image_position_x' => '50%',
        'image_alt' => '',
        'interval' => 9000
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<section class="references" data-interval="<?php echo esc_attr( $interval ); ?>">

    <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="references-slider">

                    <?php

                        # display single slides
                        echo do_shortcode( $content );

                    ?>

                </div>

            </div>

        </div>

    </div>

</section>