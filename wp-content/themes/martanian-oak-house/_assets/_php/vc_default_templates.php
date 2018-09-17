<?php

   /**
    *
    * get default image id
    *
    */

    function martanian_oak_house_get_default_image_id() {

        # get all images from media library
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'published',
            'posts_per_page' => -1,
            'numberposts' => null
        );

        # get the images
        $attachments = get_posts( $args );

        # walk for each image
        foreach( $attachments as $image ) {

            # do we have it?
            if( $image -> post_title == 'martanian-oak-house-default-image' ) {

                # return the ID
                return( $image -> ID );
            }
        }

        # nothing found?
        return( '0' );
    }

   /**
    *
    * prepare the default data for URLs
    *
    */

    function martanian_oak_house_prepare_the_default_url( $url, $title ) {

        # return result
        return( ( !empty( $url ) ? 'url:'. esc_attr( urlencode( $url ) ) : '' ) .'|'. ( !empty( $title ) ? 'title:'. esc_attr( str_replace( '+', '%20', urlencode( $title ) ) ) : '' ) .'||' );
    }

   /**
    *
    * prepare page template based on sections templates
    *
    */

    function martanian_oak_house_prepare_page_template( $sections ) {

        # create page content
        $result = '';

        # walk for each section
        foreach( $sections as $section ) {

            # update the content
            $result .= martanian_oak_house_get_template_shortcode( $section );
        }

        # return result
        return( $result );
    }

   /**
    *
    * get the template shortcode
    *
    */

    function martanian_oak_house_get_template_shortcode( $template ) {

        # default image ID
        $defaultImageID = martanian_oak_house_get_default_image_id();

        # contact form shortcode
        $contactFormShortcode = martanian_oak_house_default_wpcf7_shortcode( true );

        # define the content
        $content = '';

        # switch the template
        switch( $template ) {

           /**
            *
            * pages
            *
            */

            # home page
            case 'pages-home':

                # sections templates used on this page
                $sections = array(
                    'sections-heading-slider',
                    'sections-two-columns-description',
                    'sections-documents-download',
                    'sections-references',
                    'sections-our-services',
                    'sections-gallery',
                    'sections-recent-news',
                    'sections-faq-short'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

            # about us
            case 'pages-about-us':

                # sections templates used on this page
                $sections = array(
                    'sections-three-columns-description',
                    'sections-video',
                    'sections-timeline',
                    'sections-team'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

            # our offer
            case 'pages-our-offer':

                # sections templates used on this page
                $sections = array(
                    'sections-three-images-heading',
                    'sections-offer-description',
                    'sections-pricing-table'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

            # faq
            case 'pages-faq':

                $content = '[vc_row el_class="martanian-row-add-padding-top"][vc_column width="2/3"][martanian_oak_house_shortcode_faq][martanian_oak_house_shortcode_faq_group_title][vc_column_text]
<h4>'. esc_html( __( 'Hundredth patient?', 'martanian-oak-house' ) ) .'</h4>
Sit putant apeirian comprehensam ne, ferri labores nec ne, ex nec vocent pertinacia. No vix mentitum qualisque consetetur, at liber oportere urbanitas cum, sint impedit corpora ei sit. An vix impedit referrentur, mazim soluta gubergren vis ea. Cetero singulis abduro signiferumque et cum, est amet cotidieque intellegebat ut. Has et vero libris accommodare.
<h4>Consequuntur magni dolores eos qui ratione?</h4>
Priad quas delenit laoreet, vix ne novum disputando voluptatibus. Brute albucius similique an his. Eu cum minim vulputate rationibus, et eos eros commodo.
<h4>Neque porro quisquam est?</h4>
Ex iisque liberavisse consectetuer cum, no mea ludus sapientem concludaturque. Has modo malis an. Aeque scripta percipitur at est, delectus complectitur at duo. In nihil impetus per, quodsi inimicus an eos, ei ridens doctus eum. Eum viris vivendo incorrupte ut, autem tibique appetere ius ad. Appetere elaboraret ea his.
<h4>Has modo malis an?</h4>
Quaeque nonumes docendi est eu, antiopam comprehensam ut usu. Vim vitae pericula complectitur at, affert nostro liberavisse vix cu.
<h4>Liber oportere corpora urbanitas cum?</h4>
Eam lorem appetere no, ea pericula scripserit sea. Te duo quis placerat, facilisis necessitatibus id mei, in tibique sapientem ius. Movet vulputate te mea. Tamquam rationibus incorrupte ex mei.[/vc_column_text][martanian_oak_house_shortcode_faq_group_title title="'. esc_attr( __( 'Privacy', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4>Sed ut perspiciatis unde omnis iste natus?</h4>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
<h4>Sit voluptatem accusantium doloremque laudantium?</h4>
Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.

Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.[/vc_column_text][martanian_oak_house_shortcode_faq_group_title title="'. esc_attr( __( 'Other', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4>Novum disputando voluptatibus?</h4>
Sit putant apeirian comprehensam ne, ferri labores nec ne, ex nec vocent pertinacia. No vix mentitum qualisque consetetur, at liber oportere urbanitas cum, sint impedit corpora ei sit. An vix impedit referrentur, mazim soluta gubergren vis ea. Cetero singulis abduro signiferumque et cum, est amet cotidieque intellegebat ut. Has et vero libris accommodare.
<h4>Consequuntur magni dolores eos qui ratione?</h4>
Priad quas delenit laoreet, vix ne novum disputando voluptatibus. Brute albucius similique an his. Eu cum minim vulputate rationibus, et eos eros commodo.
<h4>Neque porro quisquam est?</h4>
Ex iisque liberavisse consectetuer cum, no mea ludus sapientem concludaturque. Has modo malis an. Aeque scripta percipitur at est, delectus complectitur at duo. In nihil impetus per, quodsi inimicus an eos, ei ridens doctus eum. Eum viris vivendo incorrupte ut, autem tibique appetere ius ad. Appetere elaboraret ea his.
<h4>Has modo malis an?</h4>
Quaeque nonumes docendi est eu, antiopam comprehensam ut usu. Vim vitae pericula complectitur at, affert nostro liberavisse vix cu.
<h4>Liber oportere corpora urbanitas cum?</h4>
Eam lorem appetere no, ea pericula scripserit sea. Te duo quis placerat, facilisis necessitatibus id mei, in tibique sapientem ius. Movet vulputate te mea. Tamquam rationibus incorrupte ex mei.[/vc_column_text][/martanian_oak_house_shortcode_faq][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="pages-sidebar"][/vc_column][/vc_row]';

            break;

            # doctor
            case 'pages-doctor':

                # sections templates used on this page
                $sections = array(
                    'sections-doctor-details',
                    'sections-doctor-certificates'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

            # 404 page
            case 'pages-404-page':

                # sections templates used on this page
                $sections = array(
                    'sections-nothing-found',
                    'sections-call-to-action'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

            # contact
            case 'pages-contact':

                # sections templates used on this page
                $sections = array(
                    'sections-google-map',
                    'sections-contact-details',
                    'sections-documents-download',
                    'sections-contact-form'
                );

                # content result
                $content = martanian_oak_house_prepare_page_template( $sections );

            break;

           /**
            *
            * sections
            *
            */

            # heading slider
            case 'sections-heading-slider':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_heading_slider interval="6000"][martanian_oak_house_shortcode_heading_slider_slide image_position_y="50%" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Find our more', 'martanian-oak-house' ) ) ) ) .'" image="'. esc_attr( $defaultImageID ) .'"][martanian_oak_house_shortcode_heading_slider_slide image_position_y="50%" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Find our more', 'martanian-oak-house' ) ) ) ) .'" image="'. esc_attr( $defaultImageID ) .'"][/martanian_oak_house_shortcode_heading_slider][/vc_column][/vc_row]';

            break;

            # two-columns description
            case 'sections-two-columns-description':

                $content = '[vc_row el_class="martanian-row-content-presentation"][vc_column][vc_column_text]
<h2 style="text-align: center;">'. esc_html( __( 'The best healthcare', 'martanian-oak-house' ) ) .'</h2>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
<p class="important">Dulla gravida eros egestas velit. Mauris imperdiet, risus ante eu felis. Aenean aliquet. Aliquam id lectus. Ut sagittis, nunc commodo ligula, sed tortor. Fusce dui non nisl eu lectus. Vivamus pede. Morbi massa vel libero.</p>
Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus purus eu bibendum libero quis dui. Integer erat at erat volutpat. Nulla vestibulum dictum libero, egestas ipsum primis in augue. Vivamus nec tristique eu.[/vc_column_text][martanian_oak_house_shortcode_images_single_image image_position_y="50%" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][/vc_column_inner][vc_column_inner width="1/2"][martanian_oak_house_shortcode_images_single_image image_position_y="50%" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]Quisque ut arcu. Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus purus eu bibendum libero quis dui. Integer erat at erat volutpat. Curabitur adipiscing elit. Vivamus.

Nulla vestibulum dictum libero, egestas ipsum primis in augue. Vivamus nec tristique eu, posuere commodo, tortor eros, ut justo consequat ac, ornare dolor sit amet nunc. Maecenas rhoncus. Morbi ut diam.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_icon_fontawesome="fa fa-paper-plane-o" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ) ) .'"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';

            break;

            # documents download
            case 'sections-documents-download':

                $content = '[vc_row el_class="martanian-row-add-padding martanian-row-border-top"][vc_column][vc_column_text]
<h3>'. esc_html( __( 'Download', 'martanian-oak-house' ) ) .'</h3>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_document sub_title="'. esc_html( __( 'PDF', 'martanian-oak-house' ) ) .' `{`divider`}` '. esc_html( __( '15 kB', 'martanian-oak-house' ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_document title="'. esc_html( __( 'Warranty', 'martanian-oak-house' ) ) .'" sub_title="'. esc_html( __( 'DOC', 'martanian-oak-house' ) ) .' `{`divider`}` '. esc_html( __( '4 MB', 'martanian-oak-house' ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_document title="'. esc_html( __( 'About us - folder', 'martanian-oak-house' ) ) .'" sub_title="'. esc_html( __( 'PDF', 'martanian-oak-house' ) ) .' `{`divider`}` '. esc_html( __( '8 kB', 'martanian-oak-house' ) ) .'"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_document title="'. esc_html( __( 'Contact informations', 'martanian-oak-house' ) ) .'" sub_title="'. esc_html( __( 'PDF', 'martanian-oak-house' ) ) .' `{`divider`}` '. esc_html( __( '5 MB', 'martanian-oak-house' ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_document title="'. esc_html( __( 'References', 'martanian-oak-house' ) ) .'" sub_title="'. esc_html( __( 'DOC', 'martanian-oak-house' ) ) .' `{`divider`}` '. esc_html( __( '14 MB', 'martanian-oak-house' ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';

            break;

            # references
            case 'sections-references':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_references_slider image_position_y="50%" interval="9000" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_references_slider_single_slide]Morbi dui ligula, et velit pede turpis et quam congue orci magna hendrerit nulla ipsum pede, risus elit a leo ut orci magna non nisl felis sagittis luctus.[/martanian_oak_house_shortcode_references_slider_single_slide][martanian_oak_house_shortcode_references_slider_single_slide author_name="'. esc_html( __( 'Monica Wayne', 'martanian-oak-house' ) ) .'"]Nulla dui metus, gravida ut mollis eu, accumsan nec libero. Aliquam et elementum sem. Praesent malesuada, lorem at congue molestie, enim tellus fermentum.[/martanian_oak_house_shortcode_references_slider_single_slide][martanian_oak_house_shortcode_references_slider_single_slide author_name="'. esc_html( __( 'Susane Doe', 'martanian-oak-house' ) ) .'" author_title="'. esc_html( __( 'doctor', 'martanian-oak-house' ) ) .'"]Sed mollis ex nulla, sit amet consequat tortor blandit at. Duis bibendum laoreet augue, in elementum elit interdum a. Nulla consequat pulvinar nulla.[/martanian_oak_house_shortcode_references_slider_single_slide][/martanian_oak_house_shortcode_references_slider][/vc_column][/vc_row]';

            break;

            # our services
            case 'sections-our-services':

                $content = '[vc_row el_class="martanian-row-add-padding"][vc_column][vc_column_text]
<h3 style="text-align: center;">'. esc_html( __( 'Our services', 'martanian-oak-house' ) ) .'</h3>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Permanent or temporary residence', 'martanian-oak-house' ) ) .'</a></h4>
Donec nisl mollis ac, dictum sapien mauris nec adipiscing mauris. Ut sit amet quam. Nam consectetuer congue augue nec odio.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Find out more', 'martanian-oak-house' ) ) ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Rehabilitation holiday', 'martanian-oak-house' ) ) .'</a></h4>
Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Find out more', 'martanian-oak-house' ) ) ) ) .'"][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Medical help', 'martanian-oak-house' ) ) .'</a></h4>
Lorem ipsum primis in dui. Integer mi augue, ullamcorper nec, suscipit urna viverra quis, varius felis auctor metus. Donec mi. Curabitur quam.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Find out more', 'martanian-oak-house' ) ) ) ) .'"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';

            break;

            # gallery
            case 'sections-gallery':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_gallery][martanian_oak_house_shortcode_gallery_element image_size="double_both" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image_size="double_height" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image_size="double_both" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image_size="double_height" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_gallery_element image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][/martanian_oak_house_shortcode_gallery][/vc_column][/vc_row]';

            break;

            # recent news
            case 'sections-recent-news':

                $content = '[vc_row][vc_column][martanian_oak_house_shortcode_recent_news posts_category="*"][/vc_column][/vc_row]';

            break;

            # faq-short
            case 'sections-faq-short':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_faq_short image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h3>'. esc_html( __( 'Frequently Asked Questions', 'martanian-oak-house' ) ) .'</h3>
<h4>Risus neque ante ipsum dolor urna, id leo sodales pretium porttitor?</h4>
Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero malesuada id, ullamcorper id, nunc. Nunc eleifend velit.
<h4>Morbi fermentum consectetuer?</h4>
Ium sociis natoque penatibus et nisl. Morbi pede. In purus dolor tellus enim, ac lacus. In hac habitasse platea dictumst. Proin consectetuer adipiscing quam eget gravida massa imperdiet convallis. Cras suscipit, velit odio eget diam aliquet congue ac, urna. Aenean lobortis augue.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Read more', 'martanian-oak-house' ) ) ) ) .'"][/martanian_oak_house_shortcode_faq_short][/vc_column][/vc_row]';

            break;

            # three-columns description
            case 'sections-three-columns-description':

                $content = '[vc_row full_width="stretch_row" css=".vc_custom_leaf_background{background-image: url('. esc_url( get_template_directory_uri() .'/_assets/_img/leaf.png' ) .') !important;}" el_class="martanian-three-column-content"][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
<p class="important">Dulla gravida eros egestas velit. Mauris imperdiet, risus ante eu felis. Aenean aliquet. Aliquam id lectus. Ut sagittis, nunc commodo ligula, sed tortor.</p>
[line][/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]Quisque ut arcu. Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus purus eu bibendum libero quis dui. Integer erat at erat volutpat. Curabitur adipiscing elit. Vivamus. Nulla vestibulum dictum libero, egestas ipsum primis in augue. Vivamus nec tristique eu.

Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus aimperdiet quis, congue id, condimentum lorem velit suscipit urna quam, lobortis sed. Maecenas bibendum tellus, volutpat.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner][martanian_oak_house_shortcode_images_single_image image_height="long" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][vc_column_text]Quisque ut arcu. Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus purus eu bibendum libero quis dui. Integer erat at erat volutpat. Curabitur adipiscing elit. Vivamus.[/vc_column_text][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]Nulla vestibulum dictum libero, egestas ipsum primis in augue. Vivamus nec tristique eu, posuere commodo, tortor eros, ut justo consequat ac, ornare dolor sit amet nunc. Maecenas rhoncus. Morbi ut diam. Aenean bibendum sapien eleifend et, neque. Fusce imperdiet quis, congue id, condimentum lorem velit suscipit urna quam, lobortis sed.

Maecenas bibendum tellus, volutpat tempus purus. Nulla vestibulum dictum libero, egestas ipsum primis in augue.[/vc_column_text][/vc_column][/vc_row]';

            break;

            # video
            case 'sections-video':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_video_section video_url="https://www.youtube.com/watch?v=6NC_ODHu5jg" video_length="01:15" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"]
<h3>'. esc_html( __( 'Watch our typical day', 'martanian-oak-house' ) ) .'</h3>
Sed at semper odio, quis convallis tortor. Proin eu diam tincidunt, malesuada ex nec, lobortis enim. Ut orci sapien, dignissim sit amet eros ut, sollicitudin egestas enim. Vivamus ac nisi eget turpis venenatis bibendum. Morbi a accumsan mauris.[/martanian_oak_house_shortcode_video_section][/vc_column][/vc_row]';

            break;

            # timeline
            case 'sections-timeline':

                $content = '[vc_row][vc_column][martanian_oak_house_shortcode_timeline][martanian_oak_house_shortcode_timeline_element title="'. esc_html( __( 'Opening of the center', 'martanian-oak-house' ) ) .'" date="'. esc_html( __( '09.2009', 'martanian-oak-house' ) ) .'"]Integer ut diam sodales rutrum, wisi augue sed laoreet viverra. Cras ut augue. Fusce enim. Fusce dui convallis posuere. Quisque rutrum, libero malesuada id, ullamcorper id, nunc. Nunc eleifend velit.[/martanian_oak_house_shortcode_timeline_element][martanian_oak_house_shortcode_timeline_element]Sit putant apeirian comprehensam ne, ferri labores nec ne, ex nec vocent pertinacia. No vix mentitum qualisque consetetur, at liber oportere urbanitas cum, sint impedit corpora ei sit. An vix impedit referrentur, mazim soluta gubergren vis ea. Cetero singulis abduro signiferumque et cum, est amet cotidieque intellegebat ut. Has et vero libris accommodare.[/martanian_oak_house_shortcode_timeline_element][martanian_oak_house_shortcode_timeline_element title="Liber oportere corpora urbanitas cum" date="'. esc_html( __( '12.2011', 'martanian-oak-house' ) ) .'"]Eam lorem appetere no, ea pericula scripserit sea. Te duo quis placerat, facilisis necessitatibus id mei, in tibique sapientem ius. Movet vulputate te mea. Tamquam rationibus incorrupte ex mei.[/martanian_oak_house_shortcode_timeline_element][martanian_oak_house_shortcode_timeline_element title="Rebum quaestio et pri" date="'. esc_html( __( '08.2013', 'martanian-oak-house' ) ) .'"]Priad quas delenit laoreet, vix ne novum disputando voluptatibus. Brute albucius similique an his. Eu cum minim vulputate rationibus, et eos eros commodo.[/martanian_oak_house_shortcode_timeline_element][martanian_oak_house_shortcode_timeline_element title="Choro consetetur elo" date="'. esc_html( __( '10.2013', 'martanian-oak-house' ) ) .'"]Ex iisque liberavisse consectetuer cum, no mea ludus sapientem concludaturque. Has modo malis an. Aeque scripta percipitur at est, delectus complectitur at duo. In nihil impetus per, quodsi inimicus an eos, ei ridens doctus eum. Eum viris vivendo incorrupte ut, autem tibique appetere ius ad. Appetere elaboraret ea his.[/martanian_oak_house_shortcode_timeline_element][martanian_oak_house_shortcode_timeline_element title="Has modo malis an" date="'. esc_html( __( '01.2015', 'martanian-oak-house' ) ) .'"]Quaeque nonumes docendi est eu, antiopam comprehensam ut usu. Vim vitae pericula complectitur at, affert nostro liberavisse vix cu.[/martanian_oak_house_shortcode_timeline_element][/martanian_oak_house_shortcode_timeline][/vc_column][/vc_row]';

            break;

            # team
            case 'sections-team':

                $content = '[vc_row full_width="stretch_row_content"][vc_column][martanian_oak_house_shortcode_gray_section_with_icon][vc_row_inner][vc_column_inner][vc_column_text]
<h3 style="text-align: center;">'. esc_html( __( 'Meet our team', 'martanian-oak-house' ) ) .'</h3>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Dr Susane Smith', 'martanian-oak-house' ) ) .'</a></h4>
Cras tempor a lectus quis egestas. Vestibulum ac lacus ante. Integer sodales facilisis nisi, non consectetur ante tincidunt.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Dr Monica Wayne', 'martanian-oak-house' ) ) .'</a></h4>
Cras tempor a lectus quis egestas. Vestibulum ac lacus ante. Integer sodales facilisis nisi, non consectetur ante tincidunt.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][martanian_oak_house_shortcode_images_single_image image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h4><a href="#">'. esc_html( __( 'Dr Tom Doe', 'martanian-oak-house' ) ) .'</a></h4>
Cras tempor a lectus quis egestas. Vestibulum ac lacus ante. Integer sodales facilisis nisi, non consectetur ante tincidunt.[/vc_column_text][/vc_column_inner][/vc_row_inner][/martanian_oak_house_shortcode_gray_section_with_icon][/vc_column][/vc_row]';

            break;

            # three-images heading
            case 'sections-three-images-heading':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_three_images_header left_top_image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" left_bottom_image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" right_image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" left_top_image="'. esc_attr( $defaultImageID ) .'" left_bottom_image="'. esc_attr( $defaultImageID ) .'" right_image="'. esc_attr( $defaultImageID ) .'"]
<h3>'. esc_html( __( 'Peaceful environment', 'martanian-oak-house' ) ) .'</h3>
Lorem ipsum dolor sit amet dolor. Vestibulum aliquam pharetra ut, eleifend ipsum vel felis vitae tellus. In commodo volutpat tempus erat.

Aliquam eleifend tincidunt, orci luctus et ultrices varius.Fusce gravida, quam sem, eleifend magna vel tincidunt tempus. Suspendisse sed arcu. Praesent gravida non, ultrices posuere cubilia curae.[/martanian_oak_house_shortcode_three_images_header][/vc_column][/vc_row]';

            break;

            # offer description
            case 'sections-offer-description':

                $content = '[vc_row][vc_column][martanian_oak_house_shortcode_content_box][vc_column_text]
<h2>'. esc_html( __( 'Comfortable rooms', 'martanian-oak-house' ) ) .'</h2>
Lorem ipsum dolor sit amet dolor. Vestibulum aliquam pharetra ut, eleifend ipsum vel felis vitae tellus. In commodo volutpat tempus erat. Integer adipiscing. Mauris eget urna. Sed diam vitae sagittis a. Class aptent taciti sociosqu ad litora torquent per inceptos hymenaeos. Fusce vitae felis. Pellentesque habitant morbi tristique id, luctus mauris turpis, accumsan eu, eleifend pede nec velit. Nunc arcu elit, non placerat eget, facilisis vel, augue.

Aliquam eleifend tincidunt, orci luctus et ultrices varius.Fusce gravida, quam sem, eleifend magna vel tincidunt tempus. Suspendisse sed arcu. Praesent gravida non, ultrices posuere cubilia Curae, Sed vel diam. Fusce nonummy justo quis placerat nec, pharetra velit rutrum pede quis placerat pharetra eget, volutpat ante. Quisque porta ligula tortor id erat volutpat. Vivamus est a purus. Sed posuere cubilia Curae, Sed metus tellus, eleifend justo ipsum ut ante.[/vc_column_text][vc_row_inner el_class="martanian-row-two-columns-on-tablet"][vc_column_inner width="1/4"][martanian_oak_house_shortcode_round_progress_bar value="0.92"][/vc_column_inner][vc_column_inner width="1/4"][martanian_oak_house_shortcode_round_progress_bar title="Nullam eu porta felis, vitae rhoncus odio. Sceleri aenean." value="0.85"][/vc_column_inner][vc_column_inner width="1/4"][martanian_oak_house_shortcode_round_progress_bar title="Aenean lobortis eu magna. Nulla egestas turpis elit." value="0.55"][/vc_column_inner][vc_column_inner width="1/4"][martanian_oak_house_shortcode_round_progress_bar title="Praesent quis sem malesuada, gravida fermentum at." value="0.12"][/vc_column_inner][/vc_row_inner][vc_column_text]Mauris et enim augue. Duis in viverra lectus, ultrices ultricies mauris. Ut vel porttitor velit. Aenean mattis urna convallis pharetra cursus. Vestibulum iaculis faucibus erat, vitae dictum ligula faucibus a. In ante sapien, egestas eu tincidunt ut, venenatis id velit. Mauris egestas nunc ullamcorper tellus venenatis, et egestas est efficitur. Mauris vitae purus eget nisl pellentesque faucibus at sed erat.[/vc_column_text][/martanian_oak_house_shortcode_content_box][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_double_images left_image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" right_image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" left_image="'. esc_attr( $defaultImageID ) .'" right_image="'. esc_attr( $defaultImageID ) .'"][/vc_column][/vc_row][vc_row][vc_column][martanian_oak_house_shortcode_content_box][vc_column_text]
<h3>Suspendisse sem orci, tempus ac porttitor</h3>
Suspendisse eros ante, vehicula in ex eget, euismod ornare lorem. Aenean fermentum nunc a urna dignissim, ut interdum metus accumsan. Nunc est mauris, finibus vitae tellus vel, malesuada aliquam eros. Aenean neque felis, imperdiet sit amet interdum eget, cursus eget lectus. Duis blandit iaculis egestas. Donec id orci lacus. Quisque suscipit sit amet arcu vehicula varius. Aliquam at augue.

Donec in metus vestibulum, accumsan odio non, fermentum sapien. Donec quis nunc viverra justo dignissim convallis ut sit amet erat. Phasellus at sapien eget enim tincidunt viverra sed sit amet quam. Nam vel fringilla arcu. In non rhoncus risus. Proin eget lectus felis. Vivamus et orci viverra, rhoncus tellus at, placerat libero. Vestibulum quis maximus sapien, eu scelerisque dui.
<ul>
 	<li>Aliquam euismod tempus nisi. Duis id lorem purus. Pellentesque tempus,</li>
 	<li>Urna nec venenatis condimentum, ex nunc ultricies elit, eget varius mauris nisi a dui,</li>
 	<li>Aliquam at augue malesuada, commodo diam nec, feugiat felis, ullamcorper faucibus,</li>
 	<li>Curabitur et dignissim sapien. Maecenas eget nunc nisi. Ut sollicitudin odio lacus, non venenatis sapien,</li>
</ul>
Vestibulum posuere semper dolor vel ullamcorper. Nam in felis malesuada, pretium lectus id, aliquet nisi. Etiam maximus fermentum sapien, in maximus libero commodo at. Nam hendrerit cursus leo ut hendrerit. Nam turpis tortor, pharetra a viverra id, porta finibus elit. Suspendisse potenti. Nulla feugiat sed mauris tempor finibus. Duis sodales purus ligula.[/vc_column_text][/martanian_oak_house_shortcode_content_box][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_content_with_image image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" image="'. esc_attr( $defaultImageID ) .'"][vc_column_text]
<h4>'. esc_html( __( 'Permanent or temporary residence', 'martanian-oak-house' ) ) .'</h4>
Pellentesque dolor lacus, suscipit placerat, nulla orci luctus et ultrices posuere cubilia Curae, Integer eget libero in est. Maecenas blandit non, facilisis in, iaculis odio, in quam. Phasellus a nunc libero, posuere in, elementum in, purus. Nulla dolor sit amet.

Nulla vehicula ut, rutrum pede eget erat eget enim. Aliquam faucibus orci mauris vitae libero. Curabitur et ultrices posuere cubilia Curae, Nulla facilisi. Mauris nunc justo, hendrerit libero. Class aptent taciti sociosqu ad litora torquent per inceptos hymenaeos. Nullam et.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ) ) .'"][/martanian_oak_house_shortcode_content_with_image][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_content_with_image image_side="right" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" image="'. esc_attr( $defaultImageID ) .'"][vc_column_text]
<h4>'. esc_html( __( 'Rehabilitation holiday', 'martanian-oak-house' ) ) .'</h4>
Pellentesque dolor lacus, suscipit placerat, nulla orci luctus et ultrices posuere cubilia Curae, Integer eget libero in est. Maecenas blandit non, facilisis in, iaculis odio, in quam. Phasellus a nunc libero, posuere in, elementum in, purus. Nulla dolor sit amet.

Nulla vehicula ut, rutrum pede eget erat eget enim. Aliquam faucibus orci mauris vitae libero. Curabitur et ultrices posuere cubilia Curae, Nulla facilisi. Mauris nunc justo, hendrerit libero. Class aptent taciti sociosqu ad litora torquent per inceptos hymenaeos. Nullam et.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ) ) .'"][/martanian_oak_house_shortcode_content_with_image][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_content_with_image image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'" image="'. esc_attr( $defaultImageID ) .'"][vc_column_text]
<h4>'. esc_html( __( 'Medical help', 'martanian-oak-house' ) ) .'</h4>
Pellentesque dolor lacus, suscipit placerat, nulla orci luctus et ultrices posuere cubilia Curae, Integer eget libero in est. Maecenas blandit non, facilisis in, iaculis odio, in quam. Phasellus a nunc libero, posuere in, elementum in, purus. Nulla dolor sit amet.

Nulla vehicula ut, rutrum pede eget erat eget enim. Aliquam faucibus orci mauris vitae libero. Curabitur et ultrices posuere cubilia Curae, Nulla facilisi. Mauris nunc justo, hendrerit libero. Class aptent taciti sociosqu ad litora torquent per inceptos hymenaeos. Nullam et.[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ) ) .'"][/martanian_oak_house_shortcode_content_with_image][/vc_column][/vc_row]';

            break;

            # pricing table
            case 'sections-pricing-table':

                $content = '[vc_row][vc_column][martanian_oak_house_shortcode_pricing_table][martanian_oak_house_shortcode_pricing_table_element][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Rehabilitation treatments', 'martanian-oak-house' ) ) .'" column_2_value="'. esc_html( __( 'in 4-persons groups', 'martanian-oak-house' ) ) .'" column_3_value="'. esc_html( __( 'individual', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Help in daily activities', 'martanian-oak-house' ) ) .'" column_2_value="icon:yes" column_3_value="icon:yes"][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Laundry', 'martanian-oak-house' ) ) .'" column_1_value="'. esc_html( __( '2 / month', 'martanian-oak-house' ) ) .'" column_2_value="'. esc_html( __( 'unlimited', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Hygienic measures', 'martanian-oak-house' ) ) .'" column_2_value="icon:no"][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Sightseeing tours', 'martanian-oak-house' ) ) .'" column_2_value="icon:no"][martanian_oak_house_shortcode_pricing_table_element row_title="'. esc_html( __( 'Integration and cultural events', 'martanian-oak-house' ) ) .'" column_1_value="yes" column_2_value="yes" column_3_value="yes"][/martanian_oak_house_shortcode_pricing_table][/vc_column][/vc_row]';

            break;

            # doctor details
            case 'sections-doctor-details':

                $content = '[vc_row el_class="martanian-row-add-padding-top"][vc_column width="1/3"][martanian_oak_house_shortcode_images_single_image image_height="long" image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"][vc_column_text]
<h2>'. esc_html( __( 'Dr Caroline Wellington', 'martanian-oak-house' ) ) .'</h2>
Cras tempor a lectus quis egestas. Vestibulum ac lacus ante. Integer sodales facilisis nisi, non consectetur ante tincidunt in.
<h4><a href="#">'. esc_html( __( '1-123-456-7890', 'martanian-oak-house' ) ) .'</a>
<a href="#">'. esc_html( __( 'caroline@example.com', 'martanian-oak-house' ) ) .'</a></h4>
[/vc_column_text][/vc_column][vc_column width="2/3" css=".vc_custom_doctor_details_padding{padding-left: 35px !important; padding-bottom: 60px !important;}"][vc_column_text]
<h3>'. esc_html( __( 'About', 'martanian-oak-house' ) ) .'</h3>
Quisque ut arcu. Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus purus eu bibendum libero quis dui. Integer erat at erat volutpat. Curabitur adipiscing elit. Vivamus.

Cras at arcu a velit suscipit id, bibendum ac, semper convallis. Suspendisse turpis egestas. Praesent vitae ante. Vivamus sed libero. Maecenas bibendum tellus, volutpat tempus aimperdiet quis, congue id, condimentum lorem velit suscipit urna quam, lobortis sed. Maecenas bibendum tellus, volutpat tempus.
<h4>'. esc_html( __( 'Responsibility & Services', 'martanian-oak-house' ) ) .'</h4>
Maecenas bibendum tellus, volutpat tempus aimperdiet quis, congue id, condimentum lorem velit suscipit urna quam. Nullam eu purus eu urna consectetur ullamcorper sed ultricies nisi. Vivamus ac tempor lorem. Suspendisse vel diam feugiat, ultrices dolor a, consectetur orci:
<ul>
 	<li>Semper convallis curabitur adipiscing elit</li>
 	<li>Suspendisse turpis maecenas bibendum tellus</li>
 	<li>Vivamus sed libero &amp; lorem velit</li>
 	<li>Volutpat tempus</li>
</ul>
[/vc_column_text][martanian_oak_house_shortcode_button show_button_icon="checked" button_icon_fontawesome="fa fa-envelope-o" button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact with Caroline', 'martanian-oak-house' ) ) ) ) .'"][/vc_column][/vc_row]';

            break;

            # doctor certificates
            case 'sections-doctor-certificates':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_doctor_details]Morbi dui ligula, et velit pede turpis et quam congue orci magna hendrerit nulla ipsum pede, risus elit a leo ut orci magna non nisl felis sagittis luctus.[/martanian_oak_house_shortcode_doctor_details][/vc_column][/vc_row]';

            break;

            # nothing found
            case 'sections-nothing-found':

                $content = '[vc_row][vc_column][martanian_oak_house_shortcode_content_centered][vc_column_text]
<h2>'. esc_html( __( 'Oh...', 'martanian-oak-house' ) ) .'</h2>
<h3>'. esc_html( __( '404 error - nothing found here', 'martanian-oak-house' ) ) .'</h3>
Vestibulum eu ex ornare, iaculis tellus in, placerat nisi. Cras lobortis ac tortor tincidunt elementum. Nam ut orci ante. In id augue vel orci commodo commodo vitae et massa. Mauris congue, nibh id fermentum dictum, odio neque tempus elit, vitae sollicitudin ligula nisi quis ante. Nam id varius metus, sit amet lacinia felis. Vivamus sed ligula ut magna consequat facilisis quis ac ipsum.[/vc_column_text][martanian_oak_house_shortcode_button button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Go back to home page', 'martanian-oak-house' ) ) ) ) .'"][/martanian_oak_house_shortcode_content_centered][/vc_column][/vc_row][vc_row][vc_column][martanian_oak_house_shortcode_recent_news title="" posts_category="*" display_button=""][/vc_column][/vc_row]';

            break;

            # contact call-to-action
            case 'sections-call-to-action':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_call_to_action_with_icon button_url="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'Contact us!', 'martanian-oak-house' ) ) ) ) .'" additional_link="'. esc_attr( martanian_oak_house_prepare_the_default_url( '#', esc_html( __( 'or call us now!', 'martanian-oak-house' ) ) ) ) .'"]Vestibulum eu ex ornare, iaculis tellus in, placerat nisi. Cras lobortis ac tortor tincidunt elementum. Nam ut orci ante. In id augue vel orci commodo commodo vitae et massa. Mauris congue, nibh id fermentum dictum, odio neque tempus elit, vitae sollicitudin ligula nisi quis ante. Nam id varius metus, sit amet lacinia felis. Vivamus sed ligula ut magna consequat facilisis quis ac ipsum.[/martanian_oak_house_shortcode_call_to_action_with_icon][/vc_column][/vc_row]';

            break;

            # google map
            case 'sections-google-map':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_google_maps lat="34.062503" zoom="15"][martanian_oak_house_shortcode_google_maps_marker lat="34.062785" lng="-118.272800"][martanian_oak_house_shortcode_google_maps_marker lat="34.062280" lng="-118.281279"][/martanian_oak_house_shortcode_google_maps][/vc_column][/vc_row]';

            break;

            # contact details
            case 'sections-contact-details':

                $content = '[vc_row el_class="martanian-row-add-padding-for-heading"][vc_column][vc_column_text]
<h2 class="title" style="text-align: center;">'. esc_html( __( 'Do you have a question?', 'martanian-oak-house' ) ) .'</h2>
[/vc_column_text][/vc_column][/vc_row][vc_row el_class="martanian-row-add-padding-bottom"][vc_column width="7/12"][vc_column_text]
<h4>Donec nisl mollis ac ictum sapien mauris</h4>
Aliquam erat volutpat. Pellentesque suscipit elementum eleifend, ligula. Ut lorem. In malesuada quis, venenatis nisl am diam elit ornare interdum. Vitae wisi eget nibh condimentum et, pharetra sem, rutrum sit amet, tincidunt, diam ut malesuada id, luctus augue imperdiet convallis. Praesent blandit justo, condimentum sagittis lacus iaculis et.
<h4>Nam consectetuer congue:</h4>
<ul>
 	<li><a href="#">'. esc_html( __( 'Frequently Asked Questions', 'martanian-oak-house' ) ) .'</a></li>
 	<li><a href="#">'. esc_html( __( 'Our offer', 'martanian-oak-house' ) ) .'</a></li>
 	<li><a href="#">'. esc_html( __( 'About us', 'martanian-oak-house' ) ) .'</a></li>
 	<li><a href="#">'. esc_html( __( 'News', 'martanian-oak-house' ) ) .'</a></li>
</ul>
[/vc_column_text][/vc_column][vc_column width="5/12"][martanian_oak_house_shortcode_contact_details_box][martanian_oak_house_shortcode_contact_details_box_element size="bigger"][martanian_oak_house_shortcode_contact_details_box_element title="'. esc_attr( __( 'E-mail', 'martanian-oak-house' ) ) .'" value="'. esc_attr( __( 'contact@example.com', 'martanian-oak-house' ) ) .'" size="bigger"][martanian_oak_house_shortcode_contact_details_box_element title="'. esc_attr( __( 'Address', 'martanian-oak-house' ) ) .'" value="'. esc_attr( __( '1234 Example', 'martanian-oak-house' ) ) .',
'. esc_attr( __( 'Los Angeles, CA 98765', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_contact_details_box_element title="'. esc_html( __( 'Tax ID', 'martanian-oak-house' ) ) .'" value="'. esc_html( __( '123456789', 'martanian-oak-house' ) ) .'"][martanian_oak_house_shortcode_contact_details_box_element title="'. esc_html( __( 'Bank account number', 'martanian-oak-house' ) ) .'" value="'. esc_html( __( '00 0000 0000 0000 0000 0000 0000', 'martanian-oak-house' ) ) .'"][/martanian_oak_house_shortcode_contact_details_box][/vc_column][/vc_row]';

            break;

            # contact form
            case 'sections-contact-form':

                $content = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][martanian_oak_house_shortcode_contact_form image="'. esc_attr( $defaultImageID ) .'" image_alt="'. esc_html( __( 'Image', 'martanian-oak-house' ) ) .'"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis velit odio, consequat nec efficitur et, fringilla eget sapien. Phasellus finibus scelerisque felis. Praesent interdum risus cursus, porttitor dui vitae.[/martanian_oak_house_shortcode_contact_form][/vc_column][/vc_row]';

            break;

           /**
            *
            * end of options.
            *
            */
        }

        # return result
        return( $content );
    }

   /**
    *
    * add template for home page
    *
    */

    add_action( 'vc_load_default_templates_action', 'martanian_oak_house_add_default_vc_template_page_home' );
    function martanian_oak_house_add_default_vc_template_page_home() {

        # add default template: home page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - Home', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-home' )
        ));

        # add default template: about us page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - About us', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-about-us' )
        ));

        # add default template: our offer page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - Our offer', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-our-offer' )
        ));

        # add default template: faq page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - FAQ', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-faq' )
        ));

        # add default template: doctor page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - Doctor', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-doctor' )
        ));

        # add default template: 404 page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - 404 (nothing found)', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-404-page' )
        ));

        # add default template: contact page
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Page - Contact', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'pages-contact' )
        ));

        # ..................................................................................................................

        # add default template: heading slider section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Heading slider', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-heading-slider' )
        ));

        # add default template: two columns description section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Two columns description', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-two-columns-description' )
        ));

        # add default template: documents download section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Documents download', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-documents-download' )
        ));

        # add default template: references section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - References', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-references' )
        ));

        # add default template: our services section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Our services', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-our-services' )
        ));

        # add default template: gallery section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Gallery', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-gallery' )
        ));

        # add default template: recent news section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Recent news', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-recent-news' )
        ));

        # add default template: faq-short section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - FAQ-short', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-faq-short' )
        ));

        # add default template: three-columns description section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Three-columns description', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-three-columns-description' )
        ));

        # add default template: video section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Video', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-video' )
        ));

        # add default template: timeline section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Timeline', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-timeline' )
        ));

        # add default template: team section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Team', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-team' )
        ));

        # add default template: three-images heading section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Three-images heading', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-three-images-heading' )
        ));

        # add default template: offer description section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Offer description', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-offer-description' )
        ));

        # add default template: pricing table section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Pricing table', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-pricing-table' )
        ));

        # add default template: pricing table section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Doctor details', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-doctor-details' )
        ));

        # add default template: pricing table section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Doctor certificates', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-doctor-certificates' )
        ));

        # add default template: nothing found section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Nothing found', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-nothing-found' )
        ));

        # add default template: call to action section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Call to action', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-call-to-action' )
        ));

        # add default template: google map section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Google map', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-google-map' )
        ));

        # add default template: contact details section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Contact details', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-contact-details' )
        ));

        # add default template: contact form section
        vc_add_default_templates( array(
            'name' => esc_html( __( 'Oak House - Section - Contact form', 'martanian-oak-house' ) ),
            'content' => martanian_oak_house_get_template_shortcode( 'sections-contact-form' )
        ));
    }

   /**
    *
    * end of file.
    *
    */

?>