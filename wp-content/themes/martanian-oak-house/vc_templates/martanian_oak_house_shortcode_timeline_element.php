<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Hundredth patient', 'martanian-oak-house' ) ),
       'date' => esc_html( __( '02.2010', 'martanian-oak-house' ) )
    ), $atts ));

    # timeline default position
    global $martanian_oak_house_timeline_position;

?>
<div class="timeline-element <?php echo esc_attr( $martanian_oak_house_timeline_position == 'right' ? 'timeline-element-right' : 'timeline-element-left' ); ?>">

    <?php if( !empty( $date ) ) { ?><h4><?php echo do_shortcode( esc_html( $date ) ); ?></h4><?php } ?>
    <?php if( !empty( $title ) ) { ?><h3 class="title"><?php echo do_shortcode( esc_html( $title ) ); ?></h3><?php } ?>

    <?php

        # timeline element content
        echo wpautop( do_shortcode( $content ) );

    ?>

</div>
<?php

    # update timeline position
    $martanian_oak_house_timeline_position = $martanian_oak_house_timeline_position == 'right' ? 'left' : 'right';

?>