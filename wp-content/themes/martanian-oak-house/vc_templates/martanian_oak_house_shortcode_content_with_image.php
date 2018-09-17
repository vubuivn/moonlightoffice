<?php

    # extract arguments
    extract( shortcode_atts( array(
        'image_side' => 'left',
        'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
        'image_position_y' => '50%',
        'image_position_x' => '50%',
        'image_alt' => ''
    ), $atts ));

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<section class="<?php echo esc_attr( $image_side == 'left' ? 'content-with-image-on-left-side' : 'content-with-image-on-right-side' ); ?>">

    <div class="row">

        <?php

            # image on left side?
            if( $image_side == 'left' ) {

                ?>
                <div class="col-md-4 col-md-offset-1">

                    <div class="images">

                        <div class="image">

                            <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />

                        </div>

                    </div>

                </div>
                <?php
            }

            # if not, show the content
            else {

                ?>
                <div class="col-md-4 col-md-offset-3">

                    <div class="content">

                        <?php

                            # content
                            echo do_shortcode( $content );

                        ?>

                    </div>

                </div>
                <?php
            }

            # show the second part of the section
            if( $image_side == 'left' ) {

                ?>
                <div class="col-md-4">

                    <div class="content">

                        <?php

                            # content
                            echo do_shortcode( $content );

                        ?>

                    </div>

                </div>
                <?php
            }

            # show the image
            else {

                ?>
                <div class="col-md-4">

                    <div class="images">

                        <div class="image">

                            <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />

                        </div>

                    </div>

                </div>
                <?php
            }

        ?>

    </div>

</section>