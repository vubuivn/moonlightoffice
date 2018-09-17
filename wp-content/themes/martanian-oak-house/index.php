<?php

    # getting header
    get_header();

    # do we have posts?
    if( have_posts() ) {

        ?>
        <div class="container">

            <div class="row row-padding-top">

                <div class="col-md-8">

                    <?php

                        # are we on the first page of posts?
                        $martanian_oak_house_pagination_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                        # posts loop
                        while( have_posts() ) {

                            # initialize post
                            the_post();

                            ?>
                            <article id="post-<?php the_ID(); ?>" class="blog-post content-element <?php echo esc_attr( implode( ' ', get_post_class() ) ); ?>">

                                <?php

                                    # do we have featured image?
                                    if( martanian_oak_house_get_featured_image( get_the_ID() ) != '' ) {

                                        ?>
                                        <div class="images">

                                            <div class="image">

                                                <img src="<?php echo martanian_oak_house_get_featured_image( get_the_ID() ); ?>" alt="<?php the_title(); ?>" class="image-data-for-parent" />

                                            </div>

                                        </div>
                                        <?php

                                    # end of featured image
                                    }

                                ?>

                                <p class="post-details">

                                    <?php

                                        # can we translate date to human time?
                                        if( martanian_oak_house_get_theme_options_value( 'translate-publication-dates', false, false ) == 'yes' ) martanian_oak_house_show_when( get_the_time( 'U', get_the_ID() ) );
                                        else {

                                            # display default date and time
                                            echo get_the_time( get_option( 'date_format' ), get_the_ID() ) .' '. __( 'at', 'martanian-oak-house' ) .' '. get_the_time( get_option( 'time_format' ), get_the_ID() );
                                        }

                                    ?>

                                    <span class="divider">&middot;</span>
                                    <?php the_author_posts_link(); ?>

                                    <?php

                                        # is sticky post?
                                        if( is_sticky( get_the_ID() ) && is_paged() == false ) {

                                            ?>
                                            <span class="sticky">

                                                <span class="divider">&middot;</span>
                                                <?php echo esc_html( __( 'Sticky', 'martanian-oak-house' ) ); ?>

                                            </span>
                                            <?php
                                        }

                                    ?>

                                </p>

                                <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <?php

                                    # post content
                                    the_content( '' );

                                ?>

                                <p>

                                    <a href="<?php the_permalink(); ?>" class="button"><span><?php echo esc_html( __( 'Read more', 'martanian-oak-house' ) ); ?></span></a>
                                    <span class="post-details"><i class="fa fa-comments-o"></i> <?php comments_popup_link( '0', '1', '%' ); ?></span>

                                </p>

                            </article>
                            <?php

                        # end of loop
                        }

                    ?>

                    <section class="blog-posts-navigation">

                        <?php

                            # pagination
                            $prev_posts_link = get_previous_posts_link( '<i class="fa fa-long-arrow-left"></i> '. esc_html( __( 'Previous posts', 'martanian-oak-house' ) ) );
                            $next_posts_link = get_next_posts_link( '<span>'. esc_html( __( 'Next posts', 'martanian-oak-house' ) ) .' <i class="fa fa-long-arrow-right"></i></span>' );

                            # is pagination active?
                            if( $prev_posts_link != null || $next_posts_link != null ) {

                                ?>
                                <p class="left">

                                    <?php

                                        # do we have previous posts link?
                                        if( $prev_posts_link != null ) {

                                            # display previous posts link
                                            echo get_previous_posts_link( '<span><i class="fa fa-long-arrow-left"></i> '. esc_html( __( 'Previous posts', 'martanian-oak-house' ) ) .'</span>' );
                                        }

                                    ?>

                                </p>

                                <p class="right">

                                    <?php

                                        # do we have next posts link?
                                        if( $next_posts_link != null ) {

                                            # display next posts link
                                            echo get_next_posts_link( '<span>'. esc_html( __( 'Next posts', 'martanian-oak-house' ) ) .' <i class="fa fa-long-arrow-right"></i></span>' );
                                        }

                                    ?>

                                </p>
                                <?php

                            # end of posts navigation
                            }

                        ?>

                        <div class="clear">
                        </div>

                    </section>

                </div>

                <div class="col-md-4">

                    <?php

                        # get sidebar for blog
                        get_sidebar();

                    ?>

                </div>

            </div>

        </div>
        <?php

        # display sections under the blog
        martanian_oak_house_show_sections_under_the_blog( true );

    # end of posts
    }

    # there's no any posts?
    else {

        # get 404 page content
        martanian_oak_house_get_404_page_content();
    }

    # getting footer
    get_footer();

?>