<?php

    # extract arguments
    extract( shortcode_atts( array(
        'title' => esc_html( __( 'Frequently Asked Questions', 'martanian-oak-house' ) ),
        'sub_title' => esc_html( __( 'PDF [divider] 13 kB', 'martanian-oak-house' ) ),
        'url' => '#',
        'url_new_tab' => '',
        'icon_library' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-arrow-down',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
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
<a class="document" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $url_new_tab == 'checked' ? '_blank' : '_self' ); ?>" data-icon-library="<?php echo esc_attr( $icon_library ); ?>">

    <i class="<?php echo esc_attr( $icon ); ?>"></i>

    <?php if( !empty( $title ) ) { ?><span class="title"><?php echo esc_html( $title ); ?></span><?php } ?>
    <?php if( !empty( $sub_title ) ) { ?><span class="file"><?php echo str_replace( '[divider]', '<span class="divider">&middot;</span>', esc_html( $sub_title ) ); ?></span><?php } ?>

</a>