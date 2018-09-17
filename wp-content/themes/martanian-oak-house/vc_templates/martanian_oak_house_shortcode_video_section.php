<?php

    # extract arguments
    extract( shortcode_atts( array(
       'video_url' => '',
       'video_length' => '04:53',
       'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
       'image_position_y' => '50%',
       'image_position_x' => '50%',
       'image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) )
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<section class="video" data-video-url="<?php echo esc_attr( $video_url ); ?>">

    <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="video-before-content">

                    <div class="video-play-button">
                    </div>

                    <?php

                        # content
                        echo do_shortcode( $content );

                        # do we have video length set?
                        if( !empty( $video_length ) ) {

                            ?>
                            <p><span class="video-length"><?php echo esc_html( $video_length ); ?></span></p>
                            <?php
                        }

                    ?>

                </div>

            </div>

        </div>

    </div>

</section>