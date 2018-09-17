<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
       'display_button' => 'checked',
       'display_additional_link' => 'checked',
       'display_background_icon' => 'checked',
       'button_url' => martanian_oak_house_get_default_button_url( esc_html( __( 'Contact', 'martanian-oak-house' ) ), esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ),
       'button_style' => 'transparent-on-light',
       'show_button_icon' => 'checked',
       'button_icon_library' => 'fontawesome',
       'button_icon_fontawesome' => 'fa fa-long-arrow-right',
       'button_icon_openiconic' => 'vc-oi vc-oi-dial',
       'button_icon_typicons' => 'typcn typcn-adjust-brightness',
       'button_icon_entypo' => 'entypo-icon entypo-icon-note',
       'button_icon_linecons' => 'vc_li vc_li-heart',
       'button_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'button_icon_material' => 'vc-material vc-material-account_balance',
       'additional_link' => martanian_oak_house_get_default_button_url( '#', esc_html( __( 'or call us now!', 'martanian-oak-house' ) ) ),
       'background_icon_library' => 'fontawesome',
       'background_icon_fontawesome' => 'fa fa-envelope-o',
       'background_icon_openiconic' => 'vc-oi vc-oi-dial',
       'background_icon_typicons' => 'typcn typcn-adjust-brightness',
       'background_icon_entypo' => 'entypo-icon entypo-icon-note',
       'background_icon_linecons' => 'vc_li vc_li-heart',
       'background_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'background_icon_material' => 'vc-material vc-material-account_balance'
    ), $atts ));

?>
<section class="contact-cta">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <?php

                    # can we show the background icon?
                    if( $display_background_icon == 'checked' ) {

                        # get icon
                        $background_icon = '';
                        if( $display_background_icon == 'checked' ) {

                            switch( $background_icon_library ) {

                                case 'fontawesome': $background_icon = $background_icon_fontawesome; break;
                                case 'openiconic': $background_icon = $background_icon_openiconic; break;
                                case 'typicons': $background_icon = $background_icon_typicons; break;
                                case 'entypo': $background_icon = $background_icon_entypo; break;
                                case 'linecons': $background_icon = $background_icon_linecons; break;
                                case 'monosocial': $background_icon = $background_icon_monosocial; break;
                                case 'material': $background_icon = $background_icon_material; break;
                            }
                        }

                        ?>
                        <i class="<?php echo esc_attr( $background_icon ); ?> background-icon"></i>
                        <?php
                    }

                    # show the title
                    if( !empty( $title ) ) {

                        ?>
                        <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                        <?php
                    }

                    # show the content
                    echo wpautop( do_shortcode( $content ) );

                    # button and link
                    if( $display_button == 'checked' || $display_additional_link == 'checked' ) {

                        ?>
                        <p>

                            <?php

                                # button
                                if( $display_button == 'checked' ) {

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
                                }

                                # additional link
                                if( $display_additional_link == 'checked' ) {

                                    # get button details
                                    $additional_link = vc_build_link( $additional_link );

                                    # do we have it?
                                    if( !empty( $additional_link['url'] ) && !empty( $additional_link['title'] ) ) {

                                        ?>
                                        <a href="<?php echo esc_url( $additional_link['url'] ); ?>" target="<?php echo esc_attr( trim( $additional_link['target'] ) == '_blank' ? '_blank' : '_self' ); ?>"><?php echo esc_html( $additional_link['title'] ); ?></a>
                                        <?php
                                    }
                                }

                            ?>

                        </p>
                        <?php
                    }

                ?>

            </div>

        </div>

    </div>

</section>