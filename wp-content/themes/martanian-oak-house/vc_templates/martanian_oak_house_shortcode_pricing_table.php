<?php

    # extract arguments
    extract( shortcode_atts( array(
       'column_1_title' => 'Nulla facilis',
       'column_2_title' => 'Class aptent',
       'column_3_title' => 'Accumsan eu',
       'column_4_title' => ''
    ), $atts ));

    # define the variants count
    $variants_count = 0;

    # get the variants count
    if( !empty( $column_1_title ) ) $variants_count++;
    if( !empty( $column_2_title ) ) $variants_count++;
    if( !empty( $column_3_title ) ) $variants_count++;
    if( !empty( $column_4_title ) ) $variants_count++;

?>
<section class="pricing-table" data-variants-count="<?php echo esc_attr( $variants_count ); ?>">

    <div class="pricing-table-container">

        <ul class="pricing-table-variants">

            <li class="space"></li>

            <?php if( !empty( $column_1_title ) ) { ?><li><?php echo esc_html( $column_1_title ); ?></li><?php } ?>
            <?php if( !empty( $column_2_title ) ) { ?><li><?php echo esc_html( $column_2_title ); ?></li><?php } ?>
            <?php if( !empty( $column_3_title ) ) { ?><li><?php echo esc_html( $column_3_title ); ?></li><?php } ?>
            <?php if( !empty( $column_4_title ) ) { ?><li><?php echo esc_html( $column_4_title ); ?></li><?php } ?>

        </ul>

        <ul class="pricing-table-list">

            <?php

                # show the content
                echo do_shortcode( $content );

            ?>

        </ul>

    </div>

</section>