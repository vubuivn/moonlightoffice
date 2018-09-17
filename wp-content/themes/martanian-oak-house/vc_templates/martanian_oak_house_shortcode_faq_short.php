<?php

    # extract arguments
    extract( shortcode_atts( array(
        'image' => '',
        'image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) )
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<section class="faq-short">

    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />
    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-4">

                <?php

                    # the content
                    echo do_shortcode( $content );

                ?>

            </div>

        </div>

    </div>

</section>