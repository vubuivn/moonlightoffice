<?php

    # extract arguments
    extract( shortcode_atts( array(
        'title' => esc_html( __( 'Gallery', 'martanian-oak-house' ) )
    ), $atts ));

?>
<section class="gallery">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <?php

                    # section title
                    if( !empty( $title ) ) {

                        ?>
                        <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                        <?php

                    # end of the title
                    }

                ?>

                <div class="isotope-grid">

                    <?php

                        # display gallery images
                        echo do_shortcode( $content );

                    ?>

                </div>

            </div>

        </div>

    </div>

</section>