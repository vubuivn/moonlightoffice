            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <footer>

                            <div class="container">

                                <div class="row">

                                    <div class="col-md-9 vertical-align-middle">

                                        <nav>

                                            <?php

                                                # format the menu
                                                if( !has_nav_menu( 'martanian_oak_house_footer_menu' ) || martanian_oak_house_get_theme_options_value( 'footer-menu-enabled', false, false ) == 'no' ) martanian_oak_house_default_footer_menu();
                                                else {

                                                    wp_nav_menu( array(
                                                       'theme_location' => 'martanian_oak_house_footer_menu',
                                                       'menu' => '',
                                                       'container' => '',
                                                       'container_class' => '',
                                                       'container_id' => '',
                                                       'menu_class' => 'menu',
                                                       'menu_id' => '',
                                                       'echo' => true,
                                                       'fallback_cb' => 'wp_page_menu',
                                                       'before' => '',
                                                       'after' => '',
                                                       'link_before' => '',
                                                       'link_after' => '',
                                                       'items_wrap' => '<div class="menu"><ul class="%2$s">%3$s</ul></div>',
                                                       'depth' => 0,
                                                       'walker' => ''
                                                    ));

                                                }

                                            ?>

                                        </nav>

                                    </div>

                                    <div class="col-md-3 vertical-align-middle">

                                        <?php

                                           # display footer content
                                           martanian_oak_house_display_footer_content();

                                       ?>

                                    </div>

                                </div>

                            </div>

                        </footer>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php wp_footer(); ?>

</body>
</html>