<?php

    # extract arguments
    extract( shortcode_atts( array(
       'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
       'image_position_y' => '50%',
       'image_position_x' => '50%',
       'image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) ),
       'title' => esc_html( __( 'Retirement you deserve', 'martanian-oak-house' ) ),
       'sub_title' => 'Morbi eu dui mattis eros lobortis pharetra. Integer nibh sapien, eleifend sed dapibus eget, vestibulum quis felis. Aliquam non elit magna.',
       'display_button' => 'checked',
       'button_url' => martanian_oak_house_get_default_button_url( esc_html( __( 'About us', 'martanian-oak-house' ) ), esc_html( __( 'Find out more', 'martanian-oak-house' ) ) ),
       'button_style' => 'filled-color',
       'show_button_icon' => 'checked',
       'button_icon_library' => 'fontawesome',
       'button_icon_fontawesome' => 'fa fa-long-arrow-right',
       'button_icon_openiconic' => 'vc_icon_element-icon vc-oi vc-oi-dial',
       'button_icon_typicons' => 'typcn typcn-adjust-brightness',
       'button_icon_entypo' => 'entypo-icon entypo-icon-note',
       'button_icon_linecons' => 'vc_li vc_li-heart',
       'button_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'button_icon_material' => 'vc-material vc-material-account_balance'
    ), $atts ));

    # update slides counter
    global $martanian_oak_house_heading_slider_slides_counter;
    $martanian_oak_house_heading_slider_slides_counter++;

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

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<div class="heading-slider-single-slide">

    <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />
    <div class="container">

        <div class="row">

            <div class="col-md-offset-4 col-md-4">

                <div class="heading-slider-middle-helper">
                </div>

                <div class="heading-slider-single-slide-content">

                    <?php

                        # do we have title set?
                        if( !empty( $title ) ) {

                            # h1 or h2?
                            if( $martanian_oak_house_heading_slider_slides_counter == 1 ) {

                                ?>
                                <h1><?php echo esc_html( $title ); ?></h1>
                                <?php
                            }

                            else {

                                ?>
                                <h2 class="like-h1"><?php echo esc_html( $title ); ?></h2>
                                <?php
                            }

                        # end of title
                        }

                        # do we have subtitle set?
                        if( !empty( $sub_title ) ) {

                            ?>
                            <p><?php echo esc_html( $sub_title ); ?></p>
                            <?php

                        # end of title
                        }

                        # do we have button set?
                        if( !martanian_oak_house_is_button_for_vc_section_empty( $button_url, $button_icon ) ) {

                            ?>
                            <p>

                                <?php

                                    # display button
                                    martanian_oak_house_display_button_for_vc_section(
                                        $button_url,
                                        $button_class,
                                        $show_button_icon,
                                        $button_icon
                                    );

                                ?>

                            </p>
                            <?php

                        # end of content set
                        }

                    ?>

                </div>

            </div>

        </div>

    </div>

</div>