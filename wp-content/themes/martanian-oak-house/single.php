<?php

    # getting header
    get_header();

    # posts loop
    while( have_posts() ) {

        # initialize post
        the_post();

        ?>
        <div class="container">

            <div class="row row-padding-top">

                <div class="col-md-8">

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

                        <p class="post-details <?php echo martanian_oak_house_get_featured_image( get_the_ID() ) == '' ? 'post-details-top-space' : ''; ?>">

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
                            <span class="divider">&middot;</span>

                            <?php

                                # comments link
                                comments_popup_link( esc_html( __( '0 comments', 'martanian-oak-house' ) ), esc_html( __( '1 comment', 'martanian-oak-house' ) ), esc_html( '% '. __( 'comments', 'martanian-oak-house' ) ) );

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

                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                        <?php

                            # post content
                            the_content( '' );

                            # if we need to paginate content
                            wp_link_pages( array(
                              		'before' => '<div class="single-news-page-switcher"><h5>'. esc_html( __( 'Switch page:', 'martanian-oak-house' ) ) .'</h5>',
                              		'after' => '</div>',
                              		'link_before' => '',
                              		'link_after' => '',
                              		'next_or_number' => 'number',
                              		'separator' => ' ',
                              		'pagelink' => '<span class="single-news-page" data-page-number="%">%</span>',
                              		'echo' => true
                          	 ));

                        ?>

                        <?php martanian_oak_house_facebook_like_button_near_blog_post_content(); ?>
                        <div class="tags-and-categories">

                            <?php

                                # if post has tags
                                if( get_the_tags( '' ) != '' ) {

                                    ?>
                                    <p>

                                        <span class="title"><?php echo esc_html( __( 'Tags:', 'martanian-oak-house' ) ); ?></span>
                                        <?php martanian_oak_house_display_as_tagcloud( get_the_tags( '' ), 'tags' ); ?>

                                    </p>
                                    <?php
                                }

                            ?>

                            <p>

                                <span class="title"><?php echo esc_html( __( 'Categories:', 'martanian-oak-house' ) ); ?></span>
                                <?php martanian_oak_house_display_as_tagcloud( get_the_category( '' ), 'category' ); ?>

                            </p>

                        </div>

                        <?php

                            # author box
                            martanian_oak_house_display_author_box( get_the_author_meta( 'ID' ), $post );

                        ?>

                    </article>

                    <?php

                        # show similar posts
                        martanian_oak_house_display_similar_posts( $post );

                        # show comments
                        comments_template();

                    ?>

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
        martanian_oak_house_show_sections_under_the_blog( false );

    # end of posts loop
    }

    # getting footer
    get_footer();

?>