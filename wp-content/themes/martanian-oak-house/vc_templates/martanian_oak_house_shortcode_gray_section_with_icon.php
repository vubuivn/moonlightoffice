<?php

    # extract arguments
    extract( shortcode_atts( array(
       'icon_library' => 'fontawesome',
       'icon_fontawesome' => 'fa fa-heart-o',
       'icon_openiconic' => 'vc_icon_element-icon vc-oi vc-oi-dial',
       'icon_typicons' => 'typcn typcn-adjust-brightness',
       'icon_entypo' => 'entypo-icon entypo-icon-note',
       'icon_linecons' => 'vc_li vc_li-heart',
       'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'icon_material' => 'vc-material vc-material-account_balance'
    ), $atts ));

    # get icon
    $icon = '';
    switch( $icon_library ) {

        case 'fontawesome': $icon = $icon_fontawesome; break;
        case 'openiconic': $icon = $icon_openiconic; break;
        case 'typicons': $icon = $icon_typicons; break;
        case 'entypo': $icon = $icon_entypo; break;
        case 'linecons': $icon = $icon_linecons; break;
        case 'monosocial': $icon = $icon_monosocial; break;
        case 'material': $icon = $icon_material; break;
    }

?>
<section class="gray-section-with-icon">

    <i class="<?php echo esc_attr( $icon ); ?> background-icon"></i>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <?php

                    # content
                    echo do_shortcode( $content );

                ?>

            </div>

        </div>

    </div>

</section>