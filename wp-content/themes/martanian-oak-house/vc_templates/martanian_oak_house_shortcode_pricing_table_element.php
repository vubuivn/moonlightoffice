<?php

    # extract arguments
    extract( shortcode_atts( array(
       'row_title' => esc_html( __( 'Full-day medical care', 'martanian-oak-house' ) ),
       'column_1_value' => 'icon:no',
       'column_2_value' => '1 / month',
       'column_3_value' => 'unlimited',
       'column_4_value' => ''
    ), $atts ));

?>
<li>

    <span class="pricing-table-element-title"><?php echo esc_html( $row_title ); ?></span>

    <span class="pricing-table-variant-value" data-variant-id="1"><?php echo martanian_oak_house_pricing_table_icons( esc_html( $column_1_value ) ); ?></span>
    <span class="pricing-table-variant-value" data-variant-id="2"><?php echo martanian_oak_house_pricing_table_icons( esc_html( $column_2_value ) ); ?></span>
    <span class="pricing-table-variant-value" data-variant-id="3"><?php echo martanian_oak_house_pricing_table_icons( esc_html( $column_3_value ) ); ?></span>
    <span class="pricing-table-variant-value" data-variant-id="4"><?php echo martanian_oak_house_pricing_table_icons( esc_html( $column_4_value ) ); ?></span>

</li>