<?php

    # extract arguments
    extract( shortcode_atts( array(
       'button_url' => '',
       'button_style' => 'transparent-on-light',
       'show_button_icon' => '',
       'button_icon_library' => 'fontawesome',
       'button_icon_fontawesome' => 'fa fa-long-arrow-right',
       'button_icon_openiconic' => 'vc_icon_element-icon vc-oi vc-oi-dial',
       'button_icon_typicons' => 'typcn typcn-adjust-brightness',
       'button_icon_entypo' => 'entypo-icon entypo-icon-note',
       'button_icon_linecons' => 'vc_li vc_li-heart',
       'button_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'button_icon_material' => 'vc-material vc-material-account_balance'
    ), $atts ));

    # get icon
    $button_icon = '';
    if( $show_button_icon == 'checked' ) {

        switch( $button_icon_library ) {

            case 'fontawesome': $button_icon = $button_icon_fontawesome; break;
            case 'openiconic': $button_icon = $button_icon_openiconic; break;
            case 'typicons': $button_icon = $button_icon_typicons; break;
            case 'entypo': $button_icon = $button_icon_entypo; break;
            case 'linecons': $button_icon = $button_icon_linecons; break;
            case 'monosocial': $button_icon = $button_icon_monosocial; break;
            case 'material': $button_icon = $button_icon_material; break;
        }
    }

    # read button style
    $button_class = 'button';
    switch( $button_style ) {

        case 'transparent-on-light': break;
        case 'transparent-on-dark': $button_class .= ' button-transparent-on-dark'; break;
        case 'filled-color': $button_class .= ' button-color'; break;
        case 'filled-gray': $button_class .= ' button-fill'; break;
    }

    # display button
    martanian_oak_house_display_button_for_vc_section(
        $button_url,
        $button_class,
        $show_button_icon,
        $button_icon
    );

?>