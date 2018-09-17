<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
       'form_shortcode' => martanian_oak_house_default_wpcf7_shortcode( true ),
       'background_image_side' => 'right',
       'show_background_icon' => 'checked',
       'background_icon_library' => 'fontawesome',
       'background_icon_fontawesome' => 'fa fa-envelope-o',
       'background_icon_openiconic' => 'vc-oi vc-oi-dial',
       'background_icon_typicons' => 'typcn typcn-adjust-brightness',
       'background_icon_entypo' => 'entypo-icon entypo-icon-note',
       'background_icon_linecons' => 'vc_li vc_li-heart',
       'background_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
       'background_icon_material' => 'vc-material vc-material-account_balance',
       'image' => esc_url( get_template_directory_uri() .'/_assets/_img/image.png' ),
       'image_position_y' => '50%',
       'image_position_x' => '50%',
       'image_alt' => esc_html( __( 'Image', 'martanian-oak-house' ) )
    ), $atts ));

    # get icon
    $background_icon = '';
    if( $show_background_icon == 'checked' ) {

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

    # get image src
    $image = martanian_oak_house_get_image_src( $image );

?>
<section class="contact-form <?php echo esc_attr( $background_image_side == 'left' ? 'contact-form-reverse' : '' ); ?>">

    <div class="contact-form-background">

        <i class="<?php echo esc_attr( $background_icon ); ?> background-icon"></i>

    </div>

    <div class="contact-form-background-image">

        <img src="<?php echo esc_url( $image ); ?>" data-image-position-x="<?php echo esc_attr( $image_position_x ); ?>" data-image-position-y="<?php echo esc_attr( $image_position_y ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="image-data-for-parent" />

    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-6 <?php echo esc_attr( $background_image_side == 'left' ? 'col-md-offset-6' : '' ); ?>">

                <div class="contact-form-box">

                    <?php

                        # title
                        if( !empty( $title ) ) {

                            ?>
                            <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                            <?php
                        }

                        # content
                        echo wpautop( do_shortcode( $content ) );

                        # contact form
                        if( !empty( $form_shortcode ) ) echo do_shortcode( $form_shortcode );

                    ?>

                </div>

            </div>

        </div>

    </div>

</section>