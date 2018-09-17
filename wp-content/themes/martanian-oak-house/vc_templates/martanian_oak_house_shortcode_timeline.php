<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Oak House history', 'martanian-oak-house' ) )
    ), $atts ));

    # timeline default position
    global $martanian_oak_house_timeline_position;
    $martanian_oak_house_timeline_position = 'right';

?>
<section class="timeline">

    <?php if( !empty( $title ) ) { ?><h2><?php echo do_shortcode( esc_html( $title ) ); ?></h2><?php } ?>
    <div class="timeline">

        <div class="timeline-line">
        </div>

        <?php

            # timeline elements
            echo do_shortcode( $content );

        ?>

        <div class="clear">
        </div>

    </div>

</section>