<?php

    # return if password is required
    if( post_password_required() ) return;

    # get paginate comments
    $martanian_oak_house_paginate_comments_links = paginate_comments_links( array(
        'prev_text' => '&laquo; '. esc_html( __( 'Newer comments', 'martanian-oak-house' ) ),
        'next_text' => esc_html( __( 'Older comments', 'martanian-oak-house' ) ) .' &raquo;',
        'echo' => false
    ) );

    # if have comments
    if( have_comments() ) {

        ?>
        <section class="comments" data-author-text="<?php echo esc_attr( __( 'Author', 'martanian-oak-house' ) ); ?>">

            <?php

                # do we have comments?
                if( have_comments() ) {

                    ?>
                    <h3>

                        <a name="comments">

                            <?php

                                # comments number
                                echo esc_html( get_comments_number() );

                                # comments title
                                echo esc_html( get_comments_number() == 1 ? __( ' comment', 'martanian-oak-house' ) : __( ' comments', 'martanian-oak-house' ) );

                            ?>

                        </a>

                    </h3>

                    <ul class="comments-list">

                        <?php

                            # list blog post comments
                            martanian_oak_house_translate_comments_dates( wp_list_comments( array(
                          					'style' => 'ul',
                          					'short_ping' => true,
                          					'avatar_size' => 47,
                               'echo' => false
                        				)));

                        ?>

                    </ul>

                    <?php

                        # comments pagination
                        if( $martanian_oak_house_paginate_comments_links != null ) {

                            ?>
                            <div class="comments-pagination">

                                <?php

                                    # display paginate comments links
                                    paginate_comments_links( array(
                                        'prev_text' => '&laquo; '. esc_html( __( 'Newer comments', 'martanian-oak-house' ) ),
                                        'next_text' => esc_html( __( 'Older comments', 'martanian-oak-house' ) ) .' &raquo;',
                                        'echo' => true
                                    ));

                                ?>

                                <div class="clear">
                                </div>

                            </div>
                            <?php
                        }

                    ?>
                    <?php
                }

                # remove temporary options
                $martanian_oak_house_paginate_comments_links = false;

            ?>

        </section>
        <?php

    # end of comments
    }

    # if comments are open, show comments form
    if( comments_open() ) {

        # comments reply form
        martanian_oak_house_comments_reply_form();
    }

?>