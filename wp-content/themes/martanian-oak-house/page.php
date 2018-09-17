<?php

    # getting header
    get_header();

    # do we have posts?
    if( have_posts() ) {

        # initialize post
        the_post();

        # do we have the page with visual composer content?
        if( martanian_oak_house_is_vc_page( get_the_content() ) ) {

            ?>
            <div class="contents">

                <?php the_content(); ?>

            </div>
            <?php
        }

        # default page
        else {

            ?>
            <div class="container">

                <?php

                    # do we have featured image?
                    if( martanian_oak_house_get_featured_image( get_the_ID() ) != '' ) {

                        ?>
                        <div class="row row-padding-top">

                            <div class="col-md-12">

                                <div class="images">

                                    <div class="image">

                                        <img src="<?php echo martanian_oak_house_get_featured_image( get_the_ID() ); ?>" alt="<?php the_title(); ?>" class="image-data-for-parent" />

                                    </div>

                                </div>

                            </div>

                        </div>
                        <?php

                    # end of featured image
                    }

                ?>

                <div class="row row-page <?php echo esc_attr( martanian_oak_house_get_featured_image( get_the_ID() ) == '' ? 'row-padding-top' : '' ); ?>">

                    <div class="col-md-12">

                        <div class="content-element">

                            <h1><?php the_title(); ?></h1>
                            <?php the_content(); ?>

                        </div>

                        <?php

                            # do we have comments?
                            if( comments_open() || get_comments_number() ) {

                                # comments template
                                comments_template();
                            }

                        ?>

                    </div>

                </div>

            </div>
            <?php
        }

    # end of posts
    }

    # getting footer
    get_footer();

?>