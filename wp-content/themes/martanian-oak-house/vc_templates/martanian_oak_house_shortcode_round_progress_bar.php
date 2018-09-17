<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
       'value' => '90%'
    ), $atts ));

?>
<section class="round-progress-bar">

    <div class="round-progress-bar-element" data-progress-bar-value="<?php echo esc_attr( $value ); ?>">
    </div>

    <?php if( !empty( $title ) ) { ?><p><?php echo do_shortcode( esc_html( $title ) ); ?></p><?php } ?>

</section>