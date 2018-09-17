jQuery( function( $ ) {

   /**
    *
    * strict mode
    *
    */

    'use strict';

   /**
    *
    * update logo
    *
    */

    $.martanianOakHouseUpdateLogo = function( key ) {

        var logo = wp.customize.value( key )();
        var box = $( 'header.header-bar .header-bar-logo img' );

        box.attr( 'src', logo );

    };

   /**
    *
    * logo changed
    *
    */

    wp.customize( 'martanian_oak_house_section_logo_customizer_logo_upload', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateLogo( 'martanian_oak_house_section_logo_customizer_logo_upload' ); }); });
    if( $( 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher' ).length !== 0 ) {

        var language = $( 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher span.current-language' ).data( 'current-language-key' );
        wp.customize( 'martanian_oak_house_section_logo_customizer_logo_upload_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateLogo( 'martanian_oak_house_section_logo_customizer_logo_upload_'+ language ); }); });
    }

   /**
    *
    * update boxes on top header bar
    *
    */

    $.martanianOakHouseUpdateContactElementInTopHeaderBar = function( contactID, language ) {

        var contactType = '';
        var previousElement = false;
        var previousElementAlt = false;

        switch( contactID ) {

            case 'phone_number': contactType = 'phone-number'; break;
            case 'email_address': contactType = 'email-address'; previousElement = 'phone-number'; break;
            case 'location': contactType = 'location'; previousElement = 'email-address'; previousElementAlt = 'phone-number'; break;
        }

        language = language == false ? '' : ( '_'+ language );

        var text = wp.customize.value( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'+ contactID + language )();
        var url = wp.customize.value( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'+ contactID +'_url'+ language )();
        var in_new_tab = wp.customize.value( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_'+ contactID +'_in_new_tab'+ language )();

        var box = $( 'header.header-bar .header-bar-top .header-bar-top-element[data-element-type="'+ contactType +'"]' );
        if( box.length == 0 ) {

            if( text == '' ) return;
            else {

                var html = '<div class="header-bar-top-element" data-element-type="'+ contactType +'"></div>';

                if( previousElement == false ) $( 'header.header-bar .header-bar-top-elements-wrapper' ).prepend( html );
                else {

                    var prevBox = $( 'header.header-bar .header-bar-top .header-bar-top-element[data-element-type="'+ previousElement +'"]' );

                    if( prevBox.length !== 0 ) prevBox.after( html );
                    else {

                        if( previousElementAlt == false ) $( 'header.header-bar .header-bar-top-elements-wrapper' ).prepend( html );
                        else {

                            prevBox = $( 'header.header-bar .header-bar-top .header-bar-top-element[data-element-type="'+ previousElementAlt +'"]' );

                            if( prevBox.length == 0 ) $( 'header.header-bar .header-bar-top-elements-wrapper' ).prepend( html );
                            else prevBox.after( html );
                        }
                    }
                }

                box = $( 'header.header-bar .header-bar-top .header-bar-top-element[data-element-type="'+ contactType +'"]' );
            }
        }

        if( text == '' ) box.remove();
        else {

            if( url == '' ) box.html( text );
            else box.html( '<a href="'+ url +'" '+ ( in_new_tab == true ? 'target="_blank"' : '' ) +'>'+ text +'</a>' );
        }

        $.martanianOakHouseConfigureResponsiveMenu( true );
    };

   /**
    *
    * phone number on top header bar
    *
    */

    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', false ); }); });

   /**
    *
    * email address on top header bar
    *
    */

    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', false ); }); });

   /**
    *
    * location on top header bar
    *
    */

    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', false ); }); });
    wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', false ); }); });

   /**
    *
    * update contact elements on top header bar for each language
    *
    */

    if( $( 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher' ).length !== 0 ) {

        var language = $( 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher span.current-language' ).data( 'current-language-key' );

       /**
        *
        * phone number on top header bar
        *
        */

        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_url_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_phone_number_in_new_tab_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'phone_number', language ); }); });

       /**
        *
        * email address on top header bar
        *
        */

        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_url_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_email_address_in_new_tab_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'email_address', language ); }); });

       /**
        *
        * location on top header bar
        *
        */

        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_url_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', language ); }); });
        wp.customize( 'martanian_oak_house_section_top_header_bar_customizer_contact_details_location_in_new_tab_'+ language, function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateContactElementInTopHeaderBar( 'location', language ); }); });
    }

   /**
    *
    * update theme colors function
    *
    */

    $.martanianOakHouseUpdateThemeColors = function() {

        var output_css = '';
        var global_colors_main_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_main_color' )();
        var global_colors_important_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_important_text_color' )();
        var global_colors_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_text_color' )();
        var global_colors_timeline_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_timeline_color' )();
        var global_colors_contact_form_section_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_contact_form_section_background_color' )();
        var global_colors_faq_short_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_faq_short_background_color' )();
        var global_colors_gray_sections_and_elements_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_gray_sections_and_elements_background_color' )();
        var global_colors_gray_elements_background_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_gray_elements_background_color_hover' )();
        var global_colors_loader_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_loader_background_color' )();
        var global_colors_document_icon_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_document_icon_color' )();
        var global_colors_post_date_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_post_date_color' )();
        var global_colors_gray_text_on_gray_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_gray_text_on_gray_background_color' )();
        var global_colors_image_caption_icon_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_background_color' )();
        var global_colors_image_caption_icon_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_color' )();
        var global_colors_comment_reply_icon_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_comment_reply_icon_color' )();
        var global_colors_gallery_section_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_global_colors_gallery_section_background_color' )();
        var header_bar_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_background_color' )();
        var header_bar_top_elements_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_text_color' )();
        var header_bar_top_elements_divider_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_divider_color' )();
        var header_bar_menu_link_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_menu_link_color' )();
        var header_bar_submenu_bottom_border_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_bottom_border_color' )();
        var header_bar_submenu_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_background_color' )();
        var header_bar_submenu_link_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color' )();
        var header_bar_submenu_link_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color_hover' )();
        var responsive_menu_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_responsive_menu_background_color' )();
        var responsive_menu_border_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_responsive_menu_border_color' )();
        var responsive_menu_link_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color' )();
        var responsive_menu_link_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color_hover' )();
        var heading_slider_slide_overlay_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_heading_slider_slide_overlay_background_color' )();
        var heading_slider_content_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_color' )();
        var heading_slider_content_background_responsive_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_responsive_color' )();
        var heading_slider_title_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_heading_slider_title_color' )();
        var heading_slider_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_heading_slider_text_color' )();
        var video_overlay_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_video_overlay_background_color' )();
        var video_play_button_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_video_play_button_color_hover' )();
        var video_title_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_video_title_color' )();
        var video_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_video_text_color' )();
        var doctor_details_background_gradient_first_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_first_color' )();
        var doctor_details_background_gradient_last_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_last_color' )();
        var doctor_details_blockquote_border_top_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_doctor_details_blockquote_border_top_color' )();
        var forms_field_border_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_field_border_color' )();
        var forms_field_border_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_field_border_color_hover' )();
        var forms_button_border_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_border_color' )();
        var forms_button_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_text_color' )();
        var forms_button_text_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_text_color_hover' )();
        var forms_button_hover_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_hover_background_color' )();
        var forms_button_icon_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_icon_color' )();
        var forms_button_icon_color_hover = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_icon_color_hover' )();
        var forms_button_transparent_on_dark_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_transparent_on_dark_text_color' )();
        var forms_button_fill_background_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_fill_background_color' )();
        var forms_button_color_text_color = wp.customize.value( 'martanian_oak_house_section_colors_customizer_forms_button_color_text_color' )();

        output_css += 'h1, h2, h3#reply-title.comment-reply-title, h3.title, .vc_col-sm-12 > .vc_column-inner > .wpb_wrapper > .wpb_text_column > .wpb_wrapper > h3, section.faq-short h3, a:hover, p a:hover, blockquote:before, .content-element h2 a, .content-element h3.title a, .content-element span.post-details a:hover, form .checkbox-box .checkbox i.fa-check, section.references:after, section.faq span.faq-group-title span, section.round-progress-bar .round-progress-bar-element .value, article.blog-post .author-box .author-box-content h3, article.blog-post .author-box .author-box-content ul.social-media a:hover i, section.similar-posts h3, section.comments h3, section.comments h3 a, section.comments .comments-list .comment .comment-author-name .reply:hover i, section.sidebar .widget h4, .wpb_widgetised_column .widget h4, section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:hover, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:hover, section.sidebar .widget ul#recentcomments li a:hover, .wpb_widgetised_column .widget ul#recentcomments li a:hover, section.doctor-details h3 a, section.video .video-before-content .video-play-button:after { color: '+ global_colors_main_color +'; } ';
        output_css += 'section.sidebar-menu ul li a { color: '+ global_colors_main_color +' !important; } ';
        output_css += 'a, h3, h4, h4 a, h5, h6, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, p.important, p a, .content-element h1 a, form p.checkbox-field span.checkbox-label, form .wpcf7-form-control-wrap[class*="quiz"] label, form .wpcf7-quiz-label, section.round-progress-bar p, section.pricing-table .pricing-table-variants li:not(.space), section.pricing-table .pricing-table-list li .pricing-table-element-title, article.blog-post .tags-and-categories p span.title, article.blog-post .author-box .author-box-content strong, #respond.comment-respond #cancel-comment-reply-link, section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a, section.sidebar .widget ul#recentcomments li, .wpb_widgetised_column .widget ul#recentcomments li, section.sidebar .widget ul.posts-list .title, .wpb_widgetised_column .widget ul.posts-list .title, section.doctor-details h2, section.doctor-details blockquote p, section.timeline h2, section.comments .comments-list .comment .comment-author-name, a.document .title, section.contact-details-box span.value, .select-field:hover:after { color: '+ global_colors_important_text_color +'; } ';
        output_css += 'p, ul li, ol li, .content-element span.post-details a, blockquote p, .select-field select, a.document .file, section.contact-details-box span.title, .content-element span.post-details i, section.comments .comments-list .comment .comment-pub-date { color: '+ global_colors_text_color +'; } ';
        output_css += '.line, article.blog-post .single-news-page-switcher a:hover .single-news-page, section.comments .comments-list .comment.bypostauthor .comment-author-name .author, section.comments .comments-pagination a:hover { background: '+ global_colors_main_color +'; } ';
        output_css += 'section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a span.content, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a span.content, article.blog-post .author-box .author-box-content ul.social-media i { color: '+ global_colors_gray_text_on_gray_background_color +'; } ';
        output_css += 'a.document i { color: '+ global_colors_document_icon_color +'; } ';
        output_css += '.images .image .blog-post-date .day, .images .image .blog-post-date .rest, section.presentation .with-date > .with-date-date .day, section.presentation .with-date > .with-date-date .rest { color: '+ global_colors_post_date_color +'; } ';
        output_css += 'article.blog-post .tags-and-categories p .element, section.sidebar .widget .tagcloud a, .wpb_widgetised_column .widget .tagcloud a { border: 2px solid '+ global_colors_gray_sections_and_elements_background_color +'; color: '+ global_colors_text_color +'; } ';
        output_css += '#loader { background: '+ global_colors_loader_background_color +'; } ';
        output_css += '#loader .loader-spinner { background: '+ global_colors_main_color +'; } ';
        output_css += 'section.timeline .timeline-line, section.timeline .timeline-line:before, section.timeline .timeline-line:after, section.timeline .timeline-element:before { background: '+ global_colors_timeline_color +'; } ';
        output_css += 'section.timeline .timeline-element:after { border: 4px solid '+ global_colors_timeline_color +'; } ';
        output_css += 'section.contact-form .contact-form-background { background: '+ global_colors_contact_form_section_background_color +'; } ';
        output_css += 'section.faq-short { background-color: '+ global_colors_faq_short_background_color +'; } ';
        output_css += 'section.faq-short .col-md-8.col-md-offset-4:before { background-image: -webkit-gradient( linear, left bottom, right bottom, color-stop( 0, rgba( 255, 255, 255, 0 ) ), color-stop( 0.65, '+ global_colors_faq_short_background_color +' ) ); background-image: -o-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '+ global_colors_faq_short_background_color +' 65% ); background-image: -moz-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '+ global_colors_faq_short_background_color +' 65% ); background-image: -webkit-linear-gradient( left, rgba( 255, 255, 255, 0 ) 0%, '+ global_colors_faq_short_background_color +' 65% ); background-image: -ms-linear-gradient( right, rgba( 255, 255, 255, 0 ) 0%, '+ global_colors_faq_short_background_color +' 65% ); background-image: linear-gradient( to right, rgba( 255, 255, 255, 0 ) 0%, '+ global_colors_faq_short_background_color +' 65% ); } ';
        output_css += 'section.contact-details-box { border: 4px solid '+ global_colors_main_color +'; } ';
        output_css += 'section.contact-details-box .contact-details-box-title { color: '+ global_colors_main_color +'; } ';
        output_css += '.vc_row.martanian-row-border-top .row-border-top:before, section.contact-cta, section.gray-section-with-icon, section.faq span.faq-group-title:after, article.blog-post .single-news-page-switcher a .single-news-page, section.comments .comments-pagination a, section.sidebar .widget ul:not(.posts-list):not(#recentcomments), .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments), section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a, section.sidebar .widget ul#recentcomments, .wpb_widgetised_column .widget ul#recentcomments, section.sidebar .widget ul#recentcomments li, .wpb_widgetised_column .widget ul#recentcomments li, article.blog-post .author-box, a.document { background: '+ global_colors_gray_sections_and_elements_background_color +'; } ';
        output_css += '@media (max-width: 430px) { section.contact-cta .button:not(.button-color):not(.button-fill) { background: '+ global_colors_gray_sections_and_elements_background_color +'; }} ';
        output_css += 'section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:hover, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:hover, section.sidebar .widget ul:not(.posts-list):not(#recentcomments) li a:after, .wpb_widgetised_column .widget ul:not(.posts-list):not(#recentcomments) li a:after, section.sidebar .widget ul#recentcomments li:after, .wpb_widgetised_column .widget ul#recentcomments li:after, section.sidebar .widget ul#recentcomments li:hover, .wpb_widgetised_column .widget ul#recentcomments li:hover, a.document:hover { background: '+ global_colors_gray_elements_background_color_hover +'; } ';
        output_css += 'section.call-to-action-widget, section.sidebar .widget.call-to-action-widget, .wpb_widgetised_column .widget.call-to-action-widget { border: 3px solid '+ global_colors_gray_sections_and_elements_background_color +'; } ';
        output_css += 'section.comments .comments-list .comment .sub-comments li.comment .comment-wrapper { border-left: 3px solid '+ global_colors_gray_sections_and_elements_background_color +'; } ';
        output_css += '@media (max-width: 991px) { section.sidebar, .wpb_widgetised_column { border-top: 2px solid '+ global_colors_gray_sections_and_elements_background_color +'; }} ';
        output_css += 'section.sidebar-menu ul li a:after, section.sidebar-menu ul li:hover a, section.sidebar-menu ul li.current-menu-item a { background: '+ global_colors_gray_sections_and_elements_background_color +' !important; } ';
        output_css += '.image-caption .image-caption-icon { background: '+ global_colors_image_caption_icon_background_color +'; color: '+ global_colors_image_caption_icon_color +'; } ';
        output_css += 'section.comments .comments-list .comment .comment-author-name .reply i { color: '+ global_colors_comment_reply_icon_color +'; } ';
        output_css += 'section.gallery { background: '+ global_colors_gallery_section_background_color +'; } ';
        output_css += 'header.header-bar { background: '+ header_bar_background_color +'; } ';
        output_css += 'header.header-bar .header-bar-top { border-bottom: 1px solid '+ global_colors_gray_sections_and_elements_background_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element, header.header-bar .header-bar-top .header-bar-top-element a, header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .current-language { color: '+ header_bar_top_elements_text_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element:not(.languages-switcher):after { color: '+ header_bar_top_elements_divider_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element a:hover, header.header-bar .header-bar-top .header-bar-top-element.languages-switcher:hover .current-language, header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-item a, header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-parent a, header.header-bar .header-bar-bottom nav.top-menu > ul li.current-menu-ancestor a, header.header-bar .header-bar-bottom nav.top-menu > ul li:hover a, header.header-bar .responsive-menu-button i { color: '+ global_colors_main_color +'; } ';
        output_css += 'header.header-bar .responsive-menu-button:hover i { color: '+ global_colors_important_text_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li, header.header-bar .header-bar-bottom nav.top-menu > ul .children li { border-bottom: 1px solid '+ header_bar_submenu_bottom_border_color +'; background: '+ header_bar_submenu_background_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li a, header.header-bar .header-bar-bottom nav.top-menu > ul .children li a { color: '+ header_bar_submenu_link_color +'; } ';
        output_css += 'header.header-bar .header-bar-top .header-bar-top-element.languages-switcher .languages-switcher-list li a:hover, header.header-bar .header-bar-bottom nav.top-menu > ul .children li:hover > a, header.header-bar .header-bar-bottom nav.top-menu > ul .children li.current-menu-item a { color: '+ header_bar_submenu_link_color_hover +'; } ';
        output_css += 'header.header-bar .header-bar-bottom nav.top-menu > ul li a { color: '+ header_bar_menu_link_color +'; } ';
        output_css += '.responsive-menu-content { background: '+ responsive_menu_background_color +'; } ';
        output_css += '.responsive-menu-content ul.menu li, .responsive-menu-content ul.menu li:last-child, .responsive-menu-content .header-bar-top-element { border-bottom: 1px solid '+ responsive_menu_border_color +'; } ';
        output_css += '.responsive-menu-content ul.menu li ul.children li:first-child { border-top: 1px solid '+ responsive_menu_border_color +'; } ';
        output_css += '.responsive-menu-content ul.menu li a, .responsive-menu-content .header-bar-top-element, .responsive-menu-content .header-bar-top-element a { color: '+ responsive_menu_link_color +'; } ';
        output_css += '.responsive-menu-content ul.menu li a:hover, .responsive-menu-content ul.menu li.current-menu-item > a, .responsive-menu-content .header-bar-top-element a:hover { color: '+ responsive_menu_link_color_hover +'; } ';
        output_css += 'section.heading-slider .heading-slider-single-slide:not(.without-overlay):before { background: '+ heading_slider_slide_overlay_background_color +'; } ';
        output_css += 'section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content { background: '+ heading_slider_content_background_color +'; } ';
        output_css += 'section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content h1, section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content h2.like-h1 { color: '+ heading_slider_title_color +'; } ';
        output_css += 'section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content p { color: '+ heading_slider_text_color +'; } ';
        output_css += '@media (max-width: 767px) { section.heading-slider .heading-slider-single-slide .heading-slider-single-slide-content, section.heading-slider .heading-slider-background-overlay { background: '+ heading_slider_content_background_responsive_color +'; }} ';
        output_css += 'section.video:before { background: '+ video_overlay_background_color +'; } ';
        output_css += 'section.video .video-before-content .video-play-button:hover:after { color: '+ video_play_button_color_hover +'; } ';
        output_css += 'section.video .video-before-content h3 { color: '+ video_title_color +'; } ';
        output_css += 'section.video .video-before-content p { color: '+ video_text_color +'; } ';
        output_css += 'section.doctor-details { background-image: -webkit-gradient( linear, right top, right top, color-stop( 0, '+ doctor_details_background_gradient_first_color +' ), color-stop( 1, '+ doctor_details_background_gradient_last_color +' ) ); background-image: -o-linear-gradient( right top, '+ doctor_details_background_gradient_first_color +' 0%, '+ doctor_details_background_gradient_last_color +' 100% ); background-image: -moz-linear-gradient( right top, '+ doctor_details_background_gradient_first_color +' 0%, '+ doctor_details_background_gradient_last_color +' 100% ); background-image: -webkit-linear-gradient( right top, '+ doctor_details_background_gradient_first_color +' 0%, '+ doctor_details_background_gradient_last_color +' 100% ); background-image: -ms-linear-gradient( right top, '+ doctor_details_background_gradient_first_color +' 0%, '+ doctor_details_background_gradient_last_color +' 100% ); background-image: linear-gradient( to right top, '+ doctor_details_background_gradient_first_color +' 0%, '+ doctor_details_background_gradient_last_color +' 100% ); } ';
        output_css += 'section.doctor-details blockquote { border-top: 1px solid '+ doctor_details_blockquote_border_top_color +'; } ';
        output_css += 'form input[type="text"], form input[type="email"], form input[type="password"], form input[type="url"], form input[type="tel"], form input[type="number"], form input[type="date"], form textarea, .select-field { border: 2px solid '+ forms_field_border_color +'; } ';
        output_css += 'form input[type="text"]:hover, form input[type="email"]:hover, form input[type="password"]:hover, form input[type="url"]:hover, form input[type="tel"]:hover, form input[type="number"]:hover, form input[type="date"]:hover, form textarea:hover, .select-field:hover { border-color: '+ forms_field_border_color_hover +'; } ';
        output_css += 'form input[type="text"]:focus, form input[type="email"]:focus, form input[type="password"]:focus, form input[type="url"]:focus, form input[type="tel"]:focus, form input[type="number"]:focus, form input[type="date"]:focus, form textarea:focus { border-color: '+ global_colors_main_color +'; } ';
        output_css += 'form .search-field button[type="submit"] i { color: '+ forms_field_border_color +'; } ';
        output_css += 'form .checkbox-box .checkbox, form .radio-box .radio { border: 2px solid '+ forms_field_border_color +'; } ';
        output_css += 'form input[type="range"]::-webkit-slider-runnable-track, form input[type="range"]::-webkit-slider-thumb { border: 2px solid '+ forms_field_border_color +'; } ';
        output_css += 'form input[type="range"]::-moz-range-track, form input[type="range"]::-ms-fill-lower, form input[type="range"]::-ms-fill-upper { border: 1px solid '+ forms_field_border_color +'; } ';
        output_css += 'form .radio-box .radio .radio-checked { background: '+ global_colors_main_color +'; } ';
        output_css += '.button, form input[type="submit"] { border: 2px solid '+ forms_button_border_color +'; color: '+ forms_button_text_color +'; } ';
        output_css += 'form input[type="submit"]:hover { background: '+ global_colors_main_color +'; border-color: '+ global_colors_main_color +'; } ';
        output_css += '.button:hover, form input[type="submit"]:hover { color: '+ forms_button_text_color_hover +'; } ';
        output_css += '.button i { color: '+ forms_button_icon_color +'; } ';
        output_css += '.button:hover i, .button.button-color i { color: '+ forms_button_icon_color_hover +'; } ';
        output_css += '.button:after { background: '+ global_colors_main_color +'; border-color: '+ global_colors_main_color +'; } ';
        output_css += '.button.button-transparent-on-dark { color: '+ forms_button_transparent_on_dark_text_color +'; } ';
        output_css += '.button.button-fill { border-color: '+ forms_button_fill_background_color +'; background: '+ forms_button_fill_background_color +'; } ';
        output_css += '.button.button-color:after, form input[type="submit"]:hover { background: '+ forms_button_hover_background_color +'; border-color: '+ forms_button_hover_background_color +'; } ';
        output_css += 'article.blog-post .tags-and-categories p .element:hover, section.sidebar .widget .tagcloud a:hover, .wpb_widgetised_column .widget .tagcloud a:hover, .button.button-color, form input[type="submit"] { background: '+ global_colors_main_color +'; border-color: '+ global_colors_main_color +'; color: '+ forms_button_color_text_color +'; } ';

        $( 'style#martanian-oak-house-stylesheet-inline-css' ).remove();
        $( 'head' ).append( '<style id="martanian-oak-house-stylesheet-inline-css" type="text/css">'+ output_css +'</style>' );

    };

   /**
    *
    * theme colors
    *
    */

    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_main_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_important_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_timeline_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_contact_form_section_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_faq_short_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_gray_sections_and_elements_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_gray_elements_background_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_loader_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_document_icon_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_post_date_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_gray_text_on_gray_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_image_caption_icon_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_comment_reply_icon_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_global_colors_gallery_section_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_top_elements_divider_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_menu_link_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_bottom_border_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_header_bar_submenu_link_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_responsive_menu_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_responsive_menu_border_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_responsive_menu_link_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_heading_slider_slide_overlay_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_heading_slider_content_background_responsive_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_heading_slider_title_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_heading_slider_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_video_overlay_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_video_play_button_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_video_title_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_video_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_first_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_doctor_details_background_gradient_last_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_doctor_details_blockquote_border_top_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_field_border_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_field_border_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_border_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_text_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_hover_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_icon_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_icon_color_hover', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_transparent_on_dark_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_fill_background_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_forms_button_color_text_color', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateThemeColors(); }); });

   /**
    *
    * update progress bars colors function
    *
    */

    $.martanianOakHouseUpdateProgressBarsColors = function() {

        martanian_oak_house_progress_bar_colors_first = wp.customize.value( 'martanian_oak_house_section_colors_customizer_progress_bars_first' )();
        martanian_oak_house_progress_bar_colors_second = wp.customize.value( 'martanian_oak_house_section_colors_customizer_progress_bars_second' )();
        martanian_oak_house_progress_bar_colors_third = wp.customize.value( 'martanian_oak_house_section_colors_customizer_progress_bars_third' )();

        $.martanianOakHouseReConfigureProgressBars();
    };

   /**
    *
    * progress bars colors
    *
    */

    wp.customize( 'martanian_oak_house_section_colors_customizer_progress_bars_first', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateProgressBarsColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_progress_bars_second', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateProgressBarsColors(); }); });
    wp.customize( 'martanian_oak_house_section_colors_customizer_progress_bars_third', function( value ) { value.bind( function( to ) { $.martanianOakHouseUpdateProgressBarsColors(); }); });

   /**
    *
    * end of file.
    *
    */

});