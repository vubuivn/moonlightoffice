<?php

    # extract arguments
    extract( shortcode_atts( array(
        'title' => esc_html( __( 'From our Blog', 'martanian-oak-house' ) ),
        'posts_category' => '*',
        'display_button' => 'checked',
        'button_url' => martanian_oak_house_get_default_button_url( esc_html( __( 'Blog', 'martanian-oak-house' ) ), esc_html( __( 'Read all older news', 'martanian-oak-house' ) ) ),
        'button_style' => 'filled',
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

    # query arguments
    $query_arguments = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => get_option( 'sticky_posts' ),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

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

    # do we have category set?
    if( $posts_category != '*' ) $query_arguments['category_name'] = $posts_category;

    # get most commented posts
    $posts = new WP_Query( $query_arguments );

    # do we have the result?
    if( isset( $posts -> posts ) && is_array( $posts -> posts ) && count( $posts -> posts ) > 0 ) {

        ?>
        <section class="presentation">

            <div class="container">

                <?php

                    # do we have the title?
                    if( $title != '' ) {

                        ?>
                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="title"><?php echo esc_html( $title ); ?></h3>

                            </div>

                        </div>
                        <?php

                    # end of the title
                    }

                ?>

                <div class="row">

                    <?php

                        # walk for each post
                        for( $i = 0; $i < count( $posts -> posts ); $i++ ) {

                            ?>
                            <div class="col-md-4">

                                <?php

                                    # do we have featured image?
                                    if( martanian_oak_house_get_featured_image( $posts -> posts[$i] -> ID ) != '' ) {

                                        ?>
                                        <div class="images">

                                            <div class="image">

                                                <img src="<?php echo martanian_oak_house_get_featured_image( $posts -> posts[$i] -> ID ); ?>" alt="<?php echo get_the_title( $posts -> posts[$i] -> ID ); ?>" class="image-data-for-parent" />

                                            </div>

                                        </div>
                                        <?php

                                    # end of featured image
                                    }

                                ?>

                                <div class="with-date">

                                    <div class="with-date-date">

                                        <span class="day"><?php echo get_the_date( 'd', $posts -> posts[$i] -> ID ); ?></span>
                                        <span class="rest"><?php echo get_the_date( 'm.y', $posts -> posts[$i] -> ID ); ?></span>

                                    </div>

                                    <div class="with-date-content">

                                        <h4><a href="<?php echo esc_url( get_the_permalink( $posts -> posts[$i] -> ID ) ); ?>"><?php echo esc_html( get_the_title( $posts -> posts[$i] -> ID ) ); ?></a></h4>

                                        <?php

                                            # content
                                            echo wpautop( wp_trim_words( do_shortcode( $posts -> posts[$i] -> post_content ), 17 ) );

                                        ?>

                                        <p><a href="<?php echo esc_url( get_the_permalink( $posts -> posts[$i] -> ID ) ); ?>"><?php echo esc_html( __( 'Read more', 'martanian-oak-house' ) ); ?></a></p>

                                    </div>

                                </div>

                            </div>
                            <?php

                        }

                    ?>

                </div>

                <?php

                    # do we have button set?
                    if( $display_button == 'checked' && !martanian_oak_house_is_button_for_vc_section_empty( $button_url, $button_icon ) ) {

                        ?>
                        <div class="row">

                            <div class="col-md-12">

                                <p class="read-all-news">

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

                            </div>

                        </div>
                        <?php

                    # end of the button
                    }

                ?>

            </div>

        </section>
        <?php
    }

?>