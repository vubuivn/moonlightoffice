<?php

    # extract arguments
    extract( shortcode_atts( array(
       'author_name' => esc_html( __( 'Martha Smith', 'martanian-oak-house' ) ),
       'author_title' => esc_html( __( 'boarder', 'martanian-oak-house' ) )
    ), $atts ));

?>
<div class="single-reference">

    <div class="middle-helper">
    </div>

    <div class="single-reference-content">

        <?php

            # content
            echo wpautop( do_shortcode( $content ) );

            # author
            if( !empty( $author_name ) || !empty( $author_title ) ) {

                ?>
                <p class="author">

                    <?php

                        # author name
                        if( !empty( $author_name ) ) echo esc_html( $author_name );

                        # author title
                        if( !empty( $author_title ) ) {

                            ?>
                            <br />
                            <span class="title"><?php echo esc_html( $author_title ); ?></span>
                            <?php
                        }

                    ?>

                </p>
                <?php

            # end of author
            }

        ?>

    </div>

</div>