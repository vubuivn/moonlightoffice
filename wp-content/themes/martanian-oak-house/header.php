<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <div id="loader">

        <div class="loader-spinner">
        </div>

    </div>

    <div id="fb-root">
    </div>

    <header class="header-bar">

        <div class="container">

            <div class="row">

                <div class="col-md-3 header-bar-logo">

                    <div class="logo-middle-helper">
                    </div>

                    <?php

                        # display logo
                        martanian_oak_house_display_logo();

                    ?>

                </div>

                <div class="col-md-9">

                    <div class="header-bar-top">

                        <?php

                            # display contact elements
                            martanian_oak_house_display_top_header_bar_contact_details();

                            # display languages switcher
                            martanian_oak_house_display_languages_switcher( $post );

                        ?>

                    </div>

                    <div class="header-bar-bottom">

                        <nav class="top-menu">

                            <?php

                                # format the menu
                                martanian_oak_house_heading_menu( wp_nav_menu( array(
                                    'theme_location' => 'martanian_oak_house_main_menu',
                                    'menu' => '',
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => '',
                                    'menu_id' => '',
                                    'echo' => false,
                                    'fallback_cb' => 'wp_page_menu',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<div><ul>%3$s</ul></div>',
                                    'depth' => 0,
                                    'walker' => ''
                                ) ) );

                            ?>

                        </nav>

                    </div>

                    <div class="responsive-menu-button">

                        <i class="fa fa-bars"></i>

                    </div>

                </div>

            </div>

        </div>

    </header>

    <div class="big-wrapper">

        <div class="wrapper">