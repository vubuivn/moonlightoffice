<?php

   /**
    *
    * default theme colors
    *
    */

    function martanian_oak_house_get_default_theme_colors() {

        # default theme colors
        $default = array(
            'global-colors' => array(
                'main-color' => '#e1490f',
                'important-text-color' => '#000',
                'text-color' => '#818181',
                'timeline-color' => '#dbeaf1',
                'contact-form-section-background-color' => '#e3e6ed',
                'faq-short-background-color' => '#eaeef1',
                'gray-sections-and-elements-background-color' => '#f8f8f8',
                'gray-elements-background-color-hover' => '#f2f2f2',
                'loader-background-color' => '#fff',
                'document-icon-color' => '#d1d0d0',
                'post-date-color' => '#bebebe',
                'gray-text-on-gray-background-color' => '#adadad',
                'image-caption-icon-background-color' => 'rgba( 19, 42, 60, 0.82 )',
                'image-caption-icon-color' => '#fff',
                'comment-reply-icon-color' => '#d5d5d5',
                'gallery-section-background-color' => '#fafafa'
            ),
            'header-bar' => array(
                'background-color' => '#fff',
                'top-elements-text-color' => '#a09f9f',
                'top-elements-divider-color' => 'rgba( 160, 159, 159, 0.65 )',
                'menu-link-color' => '#4d4d4d',
                'submenu-bottom-border-color' => '#e85922',
                'submenu-background-color' => '#e1490f',
                'submenu-link-color' => 'rgba( 255, 255, 255, 0.8 )',
                'submenu-link-color-hover' => '#fff'
            ),
            'responsive-menu' => array(
                'background-color' => '#132a3c',
                'border-color' => '#1c3142',
                'link-color' => '#d3d1e8',
                'link-color-hover' => '#fff'
            ),
            'heading-slider' => array(
                'slide-overlay-background-color' => 'rgba( 42, 42, 42, 0.2 )',
                'content-background-color' => 'rgba( 19, 42, 60, 0.92 )',
                'content-background-responsive-color' => '#132a3c',
                'title-color' => '#fff',
                'text-color' => '#87939c'
            ),
            'video' => array(
                'overlay-background-color' => 'rgba( 42, 42, 42, 0.5 )',
                'play-button-color-hover' => '#f34909',
                'title-color' => '#fff',
                'text-color' => '#e2e2e2'
            ),
            'doctor-details' => array(
                'background-gradient-first-color' => '#deecf2',
                'background-gradient-last-color' => '#e7f2f7',
                'blockquote-border-top-color' => '#d7dee1'
            ),
            'forms' => array(
                'field-border-color' => '#dedee4',
                'field-border-color-hover' => '#d0d0d8',
                'button-border-color' => '#e5e5e5',
                'button-text-color' => '#000',
                'button-text-color-hover' => '#fff',
                'button-hover-background-color' => '#d6460f',
                'button-icon-color' => '#ccc',
                'button-icon-color-hover' => 'rgba( 255, 255, 255, 0.5 )',
                'button-transparent-on-dark-text-color' => '#fff',
                'button-fill-background-color' => '#f8f8f8',
                'button-color-text-color' => '#fff'
            ),
            'progress-bars' => array(
                'first' => '#ea7512',
                'second' => '#f19a15',
                'third' => '#e1490f'
            )
        );

        # return result
        return( $default );
    }

   /**
    *
    * get single default theme color
    *
    */

    function martanian_oak_house_get_single_default_theme_color( $group, $key, $subkey = false ) {

        # get default colors
        $colors = martanian_oak_house_get_default_theme_colors();

        # do we have the subkey?
        return( ( isset( $colors[$group] ) && isset( $colors[$group][$key] ) ) ? $colors[$group][$key] : false );
    }

   /**
    *
    * theme colors
    *
    */

    add_action( 'wp_enqueue_scripts', 'martanian_oak_house_theme_colors' );
    function martanian_oak_house_theme_colors() {

        # create object of martanian_oak_house_theme_mods_supporter class
        $theme_mods = new martanian_oak_house_theme_mods_supporter();

        # add inline styles
        wp_add_inline_style( 'martanian-oak-house-stylesheet', martanian_oak_house_minify_css(
            'h1,
             h2,
             h3#reply-title.comment-reply-title,
             h3.title,
             .vc_col-sm-12 > .vc_column-inner > .wpb_wrapper > .wpb_text_column > .wpb_wrapper > h3,
             section.faq-short h3,
             a:hover,
             p a:hover,
             blockquote:before,
             .content-element h2 a,
             .content-element h3.title a,
             .content-element span.post-details a:hover,
             form .checkbox-box .checkbox i.fa-check,
             section.references:after,
             section.faq span.faq-group-title span,
             section.round-progress-bar .round-progress-bar-element .value,
             article.blog-post .author-box .author-box-content h3,
             article.blog-post .author-box .author-box-content ul.social-media a:hover i,
             section.similar-posts h3,
             section.comments h3,
             section.comments h3 a,
             section.comments .comments-list .comment .comment-author-name .reply:hover i,
             section.sidebar .widget h4,
             .wpb_widgetised_column .widget h4,
             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:hover,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:hover,
             section.sidebar .widget ul#recentcomments li a:hover,
             .wpb_widgetised_column .widget ul#recentcomments li a:hover,
             section.doctor-details h3 a,
             section.video .video-before-content .video-play-button:after {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             section.sidebar-menu ul li a {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .' !important;
             }

             a,
             h3,
             h4,
             h4 a,
             h5,
             h6,
             h1 a:hover,
             h2 a:hover,
             h3 a:hover,
             h4 a:hover,
             h5 a:hover,
             h6 a:hover,
             p.important,
             p a,
             .content-element h1 a,
             form p.checkbox-field span.checkbox-label,
             form .wpcf7-form-control-wrap[class*="quiz"] label,
             form .wpcf7-quiz-label,
             section.round-progress-bar p,
             section.pricing-table .pricing-table-variants li:not(.space),
             section.pricing-table .pricing-table-list li .pricing-table-element-title,
             article.blog-post .tags-and-categories p span.title,
             article.blog-post .author-box .author-box-content strong,
             #respond.comment-respond #cancel-comment-reply-link,
             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a,
             section.sidebar .widget ul#recentcomments li,
             .wpb_widgetised_column .widget ul#recentcomments li,
             section.sidebar .widget ul.posts-list .title,
             .wpb_widgetised_column .widget ul.posts-list .title,
             section.doctor-details h2,
             section.doctor-details blockquote p,
             section.timeline h2,
             section.comments .comments-list .comment .comment-author-name,
             a.document .title,
             section.contact-details-box span.value,
             .select-field:hover:after {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_important_text_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'important-text-color' ) ) ) .';
             }

             p,
             ul li,
             ol li,
             .content-element span.post-details a,
             blockquote p,
             .select-field select,
             a.document .file,
             section.contact-details-box span.title,
             .content-element span.post-details i,
             section.comments .comments-list .comment .comment-pub-date {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_text_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'text-color' ) ) ) .';
             }

             .line,
             article.blog-post .single-news-page-switcher a:hover .single-news-page,
             section.comments .comments-pagination a:hover,
             section.comments .comments-list .comment.bypostauthor .comment-author-name .author {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a span.content,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a span.content,
             article.blog-post .author-box .author-box-content ul.social-media i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_text_on_gray_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-text-on-gray-background-color' ) ) ) .';
             }

             a.document i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_document_icon_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'document-icon-color' ) ) ) .';
             }

             .images .image .blog-post-date .day,
             .images .image .blog-post-date .rest,
             section.presentation .with-date > .with-date-date .day,
             section.presentation .with-date > .with-date-date .rest {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_post_date_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'post-date-color' ) ) ) .';
             }

             article.blog-post .tags-and-categories p .element,
             section.sidebar .widget .tagcloud a,
             .wpb_widgetised_column .widget .tagcloud a {
                 border: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_text_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'text-color' ) ) ) .';
             }

             #loader {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_loader_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'loader-background-color' ) ) ) .';
             }

             #loader .loader-spinner {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             section.timeline .timeline-line,
             section.timeline .timeline-line:before,
             section.timeline .timeline-line:after,
             section.timeline .timeline-element:before {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_timeline_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'timeline-color' ) ) ) .';
             }

             section.timeline .timeline-element:after {
                 border: 4px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_timeline_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'timeline-color' ) ) ) .';
             }

             section.contact-form .contact-form-background {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_contact_form_section_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'contact-form-section-background-color' ) ) ) .';
             }

             section.faq-short {
                 background-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .';
             }

             section.faq-short .col-md-8.col-md-offset-4:before {
                 background-image: -webkit-gradient( linear, left bottom, right bottom, color-stop( 0, rgba( 255, 255, 255, 0 ) ), color-stop( 0.65, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' ) );
                 background-image: -o-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' 65% );
                 background-image: -moz-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' 65% );
                 background-image: -webkit-linear-gradient( left, rgba( 255, 255, 255, 0 ) 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' 65% );
                 background-image: -ms-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' 65% );
                 background-image: linear-gradient( to right, rgba( 255, 255, 255, 0 ) 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_faq_short_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'faq-short-background-color' ) ) ) .' 65% );
             }

             section.contact-details-box {
                 border: 4px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             section.contact-details-box .contact-details-box-title {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             .vc_row.martanian-row-border-top .row-border-top:before,
             section.contact-cta,
             section.gray-section-with-icon,
             section.faq span.faq-group-title:after,
             article.blog-post .single-news-page-switcher a .single-news-page,
             section.comments .comments-pagination a,
             section.sidebar .widget ul:not(.posts-list):not(#recentcomments),
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments),
             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a,
             section.sidebar .widget ul#recentcomments,
             .wpb_widgetised_column .widget ul#recentcomments,
             section.sidebar .widget ul#recentcomments li,
             .wpb_widgetised_column .widget ul#recentcomments li,
             article.blog-post .author-box,
             a.document {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
             }

             @media (max-width: 430px) {

                 section.contact-cta .button:not(.button-color):not(.button-fill) {
                     background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
                 }
             }

             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:hover,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:hover,
             section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:after,
             .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:after,
             section.sidebar .widget ul#recentcomments li:after,
             .wpb_widgetised_column .widget ul#recentcomments li:after,
             section.sidebar .widget ul#recentcomments li:hover,
             .wpb_widgetised_column .widget ul#recentcomments li:hover,
             a.document:hover {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_elements_background_color_hover', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-elements-background-color-hover' ) ) ) .';
             }

             section.call-to-action-widget,
             section.sidebar .widget.call-to-action-widget,
             .wpb_widgetised_column .widget.call-to-action-widget {
                 border: 3px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
             }

             section.comments .comments-list .comment .sub-comments li.comment .comment-wrapper {
                 border-left: 3px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
             }

             @media (max-width: 991px) {

                 section.sidebar,
                 .wpb_widgetised_column {
                     border-top: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
                 }
             }

             section.sidebar-menu ul li a:after,
             section.sidebar-menu ul li:hover a,
             section.sidebar-menu ul li.current-menu-item a {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .' !important;
             }

             .image-caption .image-caption-icon {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_image_caption_icon_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'image-caption-icon-background-color' ) ) ) .';
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_image_caption_icon_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'image-caption-icon-color' ) ) ) .';
             }

             section.comments .comments-list .comment .comment-author-name .reply i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_comment_reply_icon_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'comment-reply-icon-color' ) ) ) .';
             }

             section.gallery {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gallery_section_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gallery-section-background-color' ) ) ) .';
             }

             header.header-bar {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_background_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'background-color' ) ) ) .';
             }

             header.header-bar .header-bar-top {
                 border-bottom: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_gray_sections_and_elements_background_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'gray-sections-and-elements-background-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element,
             header.header-bar .header-bar-top .header-bar-top-element a,
             header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .current-language {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_top_elements_text_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'top-elements-text-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element:not(.languages-switcher):after {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_top_elements_divider_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'top-elements-divider-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element a:hover,
             header.header-bar .header-bar-top .header-bar-top-element.languages-switcher:hover .current-language,
             header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-item a,
             header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-parent a,
             header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-ancestor a,
             header.header-bar .header-bar-bottom nav.top-menu > ul li:hover a,
             header.header-bar .responsive-menu-button i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             header.header-bar .responsive-menu-button:hover i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_important_text_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'important-text-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li,
             header.header-bar .header-bar-bottom nav.top-menu > ul .children li {
                 border-bottom: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_submenu_bottom_border_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-bottom-border-color' ) ) ) .';
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_submenu_background_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-background-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li a,
             header.header-bar .header-bar-bottom nav.top-menu > ul .children li a {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_submenu_link_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-link-color' ) ) ) .';
             }

             header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li a:hover,
             header.header-bar .header-bar-bottom nav.top-menu > ul .children li:hover > a,
             header.header-bar .header-bar-bottom nav.top-menu > ul .children li.current-menu-item a {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_submenu_link_color_hover', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'submenu-link-color-hover' ) ) ) .';
             }

             header.header-bar .header-bar-bottom nav.top-menu > ul li a {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_header_bar_menu_link_color', martanian_oak_house_get_single_default_theme_color( 'header-bar', 'menu-link-color' ) ) ) .';
             }

             .responsive-menu-content {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_responsive_menu_background_color', martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'background-color' ) ) ) .';
             }

             .responsive-menu-content ul.menu li,
             .responsive-menu-content ul.menu li:last-child,
             .responsive-menu-content .header-bar-top-element {
                 border-bottom: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_responsive_menu_border_color', martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'border-color' ) ) ) .';
             }

             .responsive-menu-content ul.menu li ul.children li:first-child {
                 border-top: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_responsive_menu_border_color', martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'border-color' ) ) ) .';
             }

             .responsive-menu-content ul.menu li a,
             .responsive-menu-content .header-bar-top-element,
             .responsive-menu-content .header-bar-top-element a {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_responsive_menu_link_color', martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'link-color' ) ) ) .';
             }

             .responsive-menu-content ul.menu li a:hover,
             .responsive-menu-content ul.menu li.current-menu-item > a,
             .responsive-menu-content .header-bar-top-element a:hover {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_responsive_menu_link_color_hover', martanian_oak_house_get_single_default_theme_color( 'responsive-menu', 'link-color-hover' ) ) ) .';
             }

             section.heading-slider .heading-slider-single-slide:not(.without-overlay):before {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_heading_slider_slide_overlay_background_color', martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'slide-overlay-background-color' ) ) ) .';
             }

             section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_heading_slider_content_background_color', martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'content-background-color' ) ) ) .';
             }

             section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content h1,
             section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content h2.like-h1 {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_heading_slider_title_color', martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'title-color' ) ) ) .';
             }

             section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content p {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_heading_slider_text_color', martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'text-color' ) ) ) .';
             }

             @media (max-width: 767px) {

                 section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content,
                 section.heading-slider .heading-slider-background-overlay {
                     background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_heading_slider_content_background_responsive_color', martanian_oak_house_get_single_default_theme_color( 'heading-slider', 'content-background-responsive-color' ) ) ) .';
                 }
             }

             section.video:before {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_video_overlay_background_color', martanian_oak_house_get_single_default_theme_color( 'video', 'overlay-background-color' ) ) ) .';
             }

             section.video .video-before-content .video-play-button:hover:after {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_video_play_button_color_hover', martanian_oak_house_get_single_default_theme_color( 'video', 'play-button-color-hover' ) ) ) .';
             }

             section.video .video-before-content h3 {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_video_title_color', martanian_oak_house_get_single_default_theme_color( 'video', 'title-color' ) ) ) .';
             }

             section.video .video-before-content p {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_video_text_color', martanian_oak_house_get_single_default_theme_color( 'video', 'text-color' ) ) ) .';
             }

             section.doctor-details {
                 background-image: -webkit-gradient( linear, right top, right top, color-stop( 0, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' ), color-stop( 1, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' ) );
                 background-image: -o-linear-gradient( right top, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' 100% );
                 background-image: -moz-linear-gradient( right top, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' 100% );
                 background-image: -webkit-linear-gradient( right top, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' 100% );
                 background-image: -ms-linear-gradient( right top, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' 100% );
                 background-image: linear-gradient( to right top, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_first_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-first-color' ) ) ) .' 0%, '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_background_gradient_last_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'background-gradient-last-color' ) ) ) .' 100% );
             }

             section.doctor-details blockquote {
                 border-top: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_doctor_details_blockquote_border_top_color', martanian_oak_house_get_single_default_theme_color( 'doctor-details', 'blockquote-border-top-color' ) ) ) .';
             }

             form input[type="text"],
             form input[type="email"],
             form input[type="password"],
             form input[type="url"],
             form input[type="tel"],
             form input[type="number"],
             form input[type="date"],
             form textarea,
             .select-field {
                 border: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ) ) ) .';
             }

             form input[type="text"]:hover,
             form input[type="email"]:hover,
             form input[type="password"]:hover,
             form input[type="url"]:hover,
             form input[type="tel"]:hover,
             form input[type="number"]:hover,
             form input[type="date"]:hover,
             form textarea:hover,
             .select-field:hover {
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color_hover', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color-hover' ) ) ) .';
             }

             form input[type="text"]:focus,
             form input[type="email"]:focus,
             form input[type="password"]:focus,
             form input[type="url"]:focus,
             form input[type="tel"]:focus,
             form input[type="number"]:focus,
             form input[type="date"]:focus,
             form textarea:focus {
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             form .search-field button[type="submit"] i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ) ) ) .';
             }

             form .checkbox-box .checkbox,
             form .radio-box .radio {
                 border: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ) ) ) .';
             }

             form input[type="range"]::-webkit-slider-runnable-track,
             form input[type="range"]::-webkit-slider-thumb {
                 border: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ) ) ) .';
             }

             form input[type="range"]::-moz-range-track,
             form input[type="range"]::-ms-fill-lower,
             form input[type="range"]::-ms-fill-upper {
                 border: 1px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_field_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'field-border-color' ) ) ) .';
             }

             form .radio-box .radio .radio-checked {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             .button,
             form input[type="submit"] {
                 border: 2px solid '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_border_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-border-color' ) ) ) .';
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_text_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-text-color' ) ) ) .';
             }

             form input[type="submit"]:hover {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             .button:hover,
             form input[type="submit"]:hover {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_text_color_hover', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-text-color-hover' ) ) ) .';
             }

             .button i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_icon_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-icon-color' ) ) ) .';
             }

             .button:hover i,
             .button.button-color i {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_icon_color_hover', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-icon-color-hover' ) ) ) .';
             }

             .button:after {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
             }

             .button.button-transparent-on-dark {
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_transparent_on_dark_text_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-transparent-on-dark-text-color' ) ) ) .';
             }

             .button.button-fill {
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_fill_background_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-fill-background-color' ) ) ) .';
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_fill_background_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-fill-background-color' ) ) ) .';
             }

             .button.button-color:after,
             form input[type="submit"]:hover {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_hover_background_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-hover-background-color' ) ) ) .';
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_hover_background_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-hover-background-color' ) ) ) .';
             }

             article.blog-post .tags-and-categories p .element:hover,
             section.sidebar .widget .tagcloud a:hover,
             .wpb_widgetised_column .widget .tagcloud a:hover,
             .button.button-color,
             form input[type="submit"] {
                 background: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
                 border-color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_global_colors_main_color', martanian_oak_house_get_single_default_theme_color( 'global-colors', 'main-color' ) ) ) .';
                 color: '. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_forms_button_color_text_color', martanian_oak_house_get_single_default_theme_color( 'forms', 'button-color-text-color' ) ) ) .';
             }'
        ));

        # add inline script for progress bars
        wp_add_inline_script(
            'martanian-oak-house-javascript-functions',
            'var martanian_oak_house_progress_bar_colors_first = "'. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_progress_bars_first', martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'first' ) ) ) .'";
             var martanian_oak_house_progress_bar_colors_second = "'. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_progress_bars_second', martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'second' ) ) ) .'";
             var martanian_oak_house_progress_bar_colors_third = "'. esc_attr( $theme_mods -> get_mod_value( 'colors_customizer_progress_bars_third', martanian_oak_house_get_single_default_theme_color( 'progress-bars', 'third' ) ) ) .'";',
            'before'
        );
    }

   /**
    *
    * end of file.
    *
    */

?>