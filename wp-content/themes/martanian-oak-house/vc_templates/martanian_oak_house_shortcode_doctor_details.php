<?php

    # extract arguments
    extract( shortcode_atts( array(
       'title' => esc_html( __( 'Certificates', 'martanian-oak-house' ) ),
       'motto_author' => esc_html( __( 'Monica Wayne', 'martanian-oak-house' ) ),
       'motto_author_title' => esc_html( __( 'Boarder', 'martanian-oak-house' ) ),
       'certificates_number' => '3',
       'certificate_1_title' => esc_html( __( 'Quality of work', 'martanian-oak-house' ) ),
       'certificate_1_url' => '',
       'certificate_1_date' => '09.2009',
       'certificate_1_content' => 'Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero malesuada id, ullamcorper id, nunc.',
       'certificate_2_title' => esc_html( __( 'Suspendisse turpis', 'martanian-oak-house' ) ),
       'certificate_2_url' => '',
       'certificate_2_date' => '02.2010',
       'certificate_2_content' => 'Sit putant apeirian comprehensam ne, ferri labores nec ne, ex nec vocent pertinacia. No vix mentitum qualisque consetetur, at liber oportere urbanitas cum, sint impedit corpora ei sit.',
       'certificate_3_title' => esc_html( __( 'Rebum quaestio et pri', 'martanian-oak-house' ) ),
       'certificate_3_url' => '',
       'certificate_3_date' => '08.2016',
       'certificate_3_content' => 'Priad quas delenit laoreet, vix ne novum disputando voluptatibus. Brute albucius similique an his. Eu cum minim vulputate rationibus, et eos eros commodo. Nunc eleifend velit.',
       'certificate_4_title' => '',
       'certificate_4_url' => '',
       'certificate_4_date' => '',
       'certificate_4_content' => ''
    ), $atts ));

?>
<section class="doctor-details">

    <div class="container">

        <?php

            # do we have the title?
            if( !empty( $title ) ) {

                ?>
                <div class="row">

                    <h2><?php echo esc_html( $title ); ?></h2>

                </div>
                <?php

            # end of the title
            }

            # can we show the certificates?
            if( $certificates_number != 0 ) {

                # column class
                $col_class = '';
                switch( $certificates_number ) {

                    case '1': $col_class = 'col-md-12'; break;
                    case '2': $col_class = 'col-md-6'; break;
                    case '3': $col_class = 'col-md-4'; break;
                    case '4': $col_class = 'col-md-3'; break;
                }

                ?>
                <div class="row">

                    <?php

                        # first certificate
                        if( in_array( $certificates_number, array( '1', '2', '3', '4' ), true ) ) {

                            ?>
                            <div class="<?php echo esc_attr( $col_class ); ?>">

                                <?php

                                    # certificate date
                                    if( !empty( $certificate_1_date ) ) {

                                        ?>
                                        <h4><?php echo esc_html( $certificate_1_date ); ?></h4>
                                        <?php
                                    }

                                    # certificate title
                                    if( !empty( $certificate_1_title ) ) {

                                        ?>
                                        <h3 class="title">

                                            <?php

                                                # do we have the url set?
                                                if( !empty( $certificate_1_url ) ) {

                                                    ?>
                                                    <a href="<?php echo esc_url( $certificate_1_url ); ?>">
                                                    <?php
                                                }

                                                # the title
                                                echo esc_html( $certificate_1_title );

                                                # close the url tag
                                                if( !empty( $certificate_1_url ) ) {

                                                    ?>
                                                    </a>
                                                    <?php
                                                }

                                            ?>

                                        </h3>
                                        <?php
                                    }

                                    # the content
                                    if( !empty( $certificate_1_content ) ) echo wpautop( do_shortcode( $certificate_1_content ) );

                                ?>

                            </div>
                            <?php

                        # end of first certificate
                        }

                        # second certificate
                        if( in_array( $certificates_number, array( '2', '3', '4' ), true ) ) {

                            ?>
                            <div class="<?php echo esc_attr( $col_class ); ?>">

                                <?php

                                    # certificate date
                                    if( !empty( $certificate_2_date ) ) {

                                        ?>
                                        <h4><?php echo esc_html( $certificate_2_date ); ?></h4>
                                        <?php
                                    }

                                    # certificate title
                                    if( !empty( $certificate_2_title ) ) {

                                        ?>
                                        <h3 class="title">

                                            <?php

                                                # do we have the url set?
                                                if( !empty( $certificate_2_url ) ) {

                                                    ?>
                                                    <a href="<?php echo esc_url( $certificate_2_url ); ?>">
                                                    <?php
                                                }

                                                # the title
                                                echo esc_html( $certificate_2_title );

                                                # close the url tag
                                                if( !empty( $certificate_2_url ) ) {

                                                    ?>
                                                    </a>
                                                    <?php
                                                }

                                            ?>

                                        </h3>
                                        <?php
                                    }

                                    # the content
                                    if( !empty( $certificate_2_content ) ) echo wpautop( do_shortcode( $certificate_2_content ) );

                                ?>

                            </div>
                            <?php

                        # end of second certificate
                        }

                        # third certificate
                        if( in_array( $certificates_number, array( '3', '4' ), true ) ) {

                            ?>
                            <div class="<?php echo esc_attr( $col_class ); ?>">

                                <?php

                                    # certificate date
                                    if( !empty( $certificate_3_date ) ) {

                                        ?>
                                        <h4><?php echo esc_html( $certificate_3_date ); ?></h4>
                                        <?php
                                    }

                                    # certificate title
                                    if( !empty( $certificate_3_title ) ) {

                                        ?>
                                        <h3 class="title">

                                            <?php

                                                # do we have the url set?
                                                if( !empty( $certificate_3_url ) ) {

                                                    ?>
                                                    <a href="<?php echo esc_url( $certificate_3_url ); ?>">
                                                    <?php
                                                }

                                                # the title
                                                echo esc_html( $certificate_3_title );

                                                # close the url tag
                                                if( !empty( $certificate_3_url ) ) {

                                                    ?>
                                                    </a>
                                                    <?php
                                                }

                                            ?>

                                        </h3>
                                        <?php
                                    }

                                    # the content
                                    if( !empty( $certificate_3_content ) ) echo wpautop( do_shortcode( $certificate_3_content ) );

                                ?>

                            </div>
                            <?php

                        # end of third certificate
                        }

                        # fourth certificate
                        if( in_array( $certificates_number, array( '4' ), true ) ) {

                            ?>
                            <div class="<?php echo esc_attr( $col_class ); ?>">

                                <?php

                                    # certificate date
                                    if( !empty( $certificate_4_date ) ) {

                                        ?>
                                        <h4><?php echo esc_html( $certificate_4_date ); ?></h4>
                                        <?php
                                    }

                                    # certificate title
                                    if( !empty( $certificate_4_title ) ) {

                                        ?>
                                        <h3 class="title">

                                            <?php

                                                # do we have the url set?
                                                if( !empty( $certificate_4_url ) ) {

                                                    ?>
                                                    <a href="<?php echo esc_url( $certificate_4_url ); ?>">
                                                    <?php
                                                }

                                                # the title
                                                echo esc_html( $certificate_4_title );

                                                # close the url tag
                                                if( !empty( $certificate_4_url ) ) {

                                                    ?>
                                                    </a>
                                                    <?php
                                                }

                                            ?>

                                        </h3>
                                        <?php
                                    }

                                    # the content
                                    if( !empty( $certificate_4_content ) ) echo wpautop( do_shortcode( $certificate_4_content ) );

                                ?>

                            </div>
                            <?php

                        # end of fourth certificate
                        }

                    ?>

                </div>
                <?php

            # end of the certificates
            }

            # do we have the motto?
            if( !empty( $content ) || !empty( $motto_author ) || !empty( $motto_author_title ) ) {

                ?>
                <div class="row">

                    <blockquote>

                        <?php

                            # do we have the content?
                            if( !empty( $content ) ) echo wpautop( do_shortcode( $content ) );

                            # do we have the author?
                            if( !empty( $motto_author ) || !empty( $motto_author_title ) ) {

                                ?>
                                <p class="author">

                                    <?php echo do_shortcode( esc_html( $motto_author ) ); ?>
                                    <span class="title"><?php echo do_shortcode( esc_html( $motto_author_title ) ); ?></span>

                                </p>
                                <?php
                            }

                        ?>

                    </blockquote>

                </div>
                <?php

            # end of the motto
            }

        ?>

    </div>

</section>