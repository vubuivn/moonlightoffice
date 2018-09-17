jQuery( document ).ready( function( $ ) {

   /**
    *
    * strict mode
    *
    */

    'use strict';

   /**
    *
    * global variables
    *
    */

    var martanianOakHouseIntervals = [];
    var martanianOakHousePageWidth = 0;
    var martanianOakHouseResponsiveMenuVisible = false;

   /**
    *
    * functions after window load
    *
    */

    $( window ).load( function() {

       /**
        *
        * configure images backgrounds
        *
        */

        $.martanianOakHouseConfigureImagesBackgrounds();

       /**
        *
        * configure heading slider
        *
        */

        $.martanianOakHouseConfigureHeadingSlider();

       /**
        *
        * configure heading slider content for mobile
        *
        */

        $.martanianOakHouseConfigureHeadingSliderContentForMobile( false );

       /**
        *
        * configure isotope
        *
        */

        $.martanianOakHouseConfigureIsotope();

       /**
        *
        * configure references
        *
        */

        $.martanianOakHouseConfigureReferences();

       /**
        *
        * configure images header section heights
        *
        */

        $.martanianOakHouseConfigureImagesHeaderSection();

       /**
        *
        * configure progress bars
        *
        */

        $.martanianOakHouseConfigureProgressBars();

       /**
        *
        * configure images heights
        *
        */

        $.martanianOakHouseConfigureImagesHeights();

       /**
        *
        * configure google maps
        *
        */

        $.martanianOakHouseConfigureGoogleMaps();

       /**
        *
        * configure selects
        *
        */

        $.martanianOakHouseConfigureSelects();

       /**
        *
        * configure date fields
        *
        */

        $.martanianOakHouseConfigureDateFields();

       /**
        *
        * configure checkbox
        *
        */

        $.martanianOakHouseConfigureCheckbox();

       /**
        *
        * configure radio elements
        *
        */

        $.martanianOakHouseConfigureRadioElements();

       /**
        *
        * add styles for "call to action" widgets
        *
        */

        $.martanianOakHouseAddStylesForCallToActionWidgets();

       /**
        *
        * configure comments visibility
        *
        */

        $.martanianOakHouseConfigureCommentsVisibility();

       /**
        *
        * configure responsive menu
        *
        */

        $.martanianOakHouseConfigureResponsiveMenu();

       /**
        *
        * configure contact form backgrounds
        *
        */

        $.martanianOakHouseConfigureContactFormBackgrounds();

       /**
        *
        * check and wrap single images
        *
        */

        $.martanianOakHouseCheckAndWrapSingleImage();

       /**
        *
        * configure images slider
        *
        */

        $.martanianOakHouseConfigureImagesSlider();

       /**
        *
        * configure images for magnific popup
        *
        */

        $.martanianOakHouseConfigureImagesForMagnificPopup();

       /**
        *
        * configure closer menu
        *
        */

        $.martanianOakHouseHeaderMenuCloser();

       /**
        *
        * configure sidebar menu list counter
        *
        */

        $.martanianOakHouseConfigureSidebarMenuListCounter();

       /**
        *
        * add border line to row
        *
        */

        $.martanianOakHouseAddBorderLineForRow();

       /**
        *
        * manage top header bar position for responsive view,
        * when logged-in to wordpress
        *
        */

        $.martanianOakHouseManageTopHeaderBarForResponsiveWP();

       /**
        *
        * add ids for faq-short sections
        *
        */

        $.martanianOakHouseAddIDsForFAQshortSections();

       /**
        *
        * page width
        *
        */

        martanianOakHousePageWidth = $( 'body' ).width();

       /**
        *
        * delete loader
        *
        */

        $( '#loader' ).animate({ 'opacity': 0 }, 300 );
        setTimeout( function() {

            $( '#loader' ).remove();

        }, 600 );

       /**
        *
        * end of functions.
        *
        */

    });

   /**
    *
    * resize functions
    *
    */

    $.martanianOakHouseResizeFunction = function() {

       /**
        *
        * page width
        *
        */

        var newPageWidth = $( 'body' ).width();
        if( newPageWidth != martanianOakHousePageWidth ) {

           /**
            *
            * update current page width
            *
            */

            martanianOakHousePageWidth = newPageWidth;

           /**
            *
            * configure heading slider content for mobile
            *
            */

            $.martanianOakHouseConfigureHeadingSliderContentForMobile( false );

           /**
            *
            * configure isotope
            *
            */

            $.martanianOakHouseConfigureIsotope();

           /**
            *
            * configure images heights
            *
            */

            $.martanianOakHouseConfigureImagesHeights();

           /**
            *
            * configure images header section heights
            *
            */

            $.martanianOakHouseConfigureImagesHeaderSection();

           /**
            *
            * configure responsive menu
            *
            */

            $.martanianOakHouseConfigureResponsiveMenu();

           /**
            *
            * configure contact form backgrounds
            *
            */

            $.martanianOakHouseConfigureContactFormBackgrounds();

           /**
            *
            * manage top header bar position for responsive view,
            * when logged-in to wordpress
            *
            */

            $.martanianOakHouseManageTopHeaderBarForResponsiveWP();

           /**
            *
            * end of functions
            *
            */
        }

       /**
        *
        * end of functions
        *
        */
    }

   /**
    *
    * catch resize actions
    *
    */

    $( window ).resize( function() { $.martanianOakHouseResizeFunction(); });
    $( window ).on( 'orientationchange', function() { $.martanianOakHouseResizeFunction(); });

   /**
    *
    * configure images backgrounds
    *
    */

    $.martanianOakHouseConfigureImagesBackgrounds = function() {

        $( '.image-data-for-parent' ).each( function() {

            var image = $( this );
            var imageSrc = image.attr( 'src' );
            var imagePositionY = image.data( 'image-position-y' );
            var imagePositionX = image.data( 'image-position-x' );

            imagePositionY = typeof imagePositionY != 'undefined' && imagePositionY != '' && imagePositionY !== false && imagePositionY !== null ? imagePositionY : '50%';
            imagePositionX = typeof imagePositionX != 'undefined' && imagePositionX != '' && imagePositionX !== false && imagePositionX !== null ? imagePositionX : '50%';

            image.parent().css({ 'background-image': 'url('+ imageSrc +')' });
            if( !image.parent().hasClass( 'faq-short' ) && !image.parent().hasClass( 'call-to-action-widget' ) && !image.parent().hasClass( 'contact-form' ) ) {

                image.parent().css({ 'background-position-y': imagePositionY, 'background-position-x': imagePositionX });
            }

            image.remove();

        });

    };

   /**
    *
    * configure heading slider
    *
    */

    $.martanianOakHouseConfigureHeadingSlider = function() {

        var sliderID = 1;
        $( 'section.heading-slider' ).each( function() {

           /**
            *
            * set id for slider
            *
            */

            var headingSlider = $( this );
            if( headingSlider.find( '.heading-slider-single-slide' ).length > 1 ) headingSlider.attr( 'data-slider-id', sliderID );

           /**
            *
            * set id for single slide and show / hide each one
            *
            */

            var slideID = 1;
            headingSlider.find( '.heading-slider-single-slide' ).each( function() {

                var slide = $( this );

                if( slideID != 1 ) slide.css({ 'display': 'none' });
                else slide.addClass( 'active' );

                if( headingSlider.find( '.heading-slider-single-slide' ).length > 1 ) slide.attr( 'data-slide-id', slideID );

                slideID++;

            });

           /**
            *
            * configure navigation
            *
            */

            if( slideID > 2 ) {

                var navigation = '';
                for( var i = 1; i < slideID; i++ ) {

                    navigation += '<li data-slide-id="'+ i +'"><span class="slider-navigation-dot '+ ( i == 1 ? 'slider-navigation-dot-active' : '' ) +'"></span></li>';
                }

                headingSlider.append( '<ul class="slider-navigation-dots">'+ navigation +'</ul>' );
            }

           /**
            *
            * run the slider
            *
            */

            var intervalTime = headingSlider.data( 'interval' );
            if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;

            if( intervalTime !== 0 ) {

                martanianOakHouseIntervals['heading-slider-'+ sliderID] = setInterval( function() {

                    $.martanianOakHouseSwitchHeadingSlide( headingSlider, headingSlider.find( '.heading-slider-single-slide' ).length, 'next' );

                }, parseInt( intervalTime, 10 ) );
            }

           /**
            *
            * increase slider id flag
            *
            */

            sliderID++;

           /**
            *
            * end of function.
            *
            */

        });
    };

   /**
    *
    * switch images slider image
    *
    */

    $.martanianOakHouseSwitchHeadingSlide = function( slider, slidesCount, slideID ) {

        slider.find( '.slider-navigation-dots' ).addClass( 'proceed' );

        var currentSlideID = slider.children( '.heading-slider-single-slide.active' ).data( 'slide-id' );
        if( slidesCount == 'find' ) slidesCount = slider.children( '.heading-slider-single-slide' ).length;

        if( slideID == 'next' ) slideID = currentSlideID + 1 > slidesCount ? 1 : currentSlideID + 1;
        else if( slideID == 'prev' ) slideID = currentSlideID - 1 == 0 ? slidesCount : currentSlideID - 1;

        slider.find( '.heading-slider-single-slide[data-slide-id="'+ slideID +'"]' ).find( '.heading-slider-single-slide-content' ).css({ 'display': 'none' });

        slider.find( '.heading-slider-single-slide[data-slide-id="'+ slideID +'"]' ).css({ 'z-index': '1', 'display': 'block' }).addClass( 'active' );
        slider.find( '.heading-slider-single-slide[data-slide-id="'+ currentSlideID +'"]' ).css({ 'z-index': '500' }).removeClass( 'active' );

        setTimeout( function() {

            slider.find( '.heading-slider-single-slide[data-slide-id="'+ currentSlideID +'"]' ).find( '.heading-slider-single-slide-content' ).addClass( 'animated animated-semi-speed fadeOutLeftSmall' );
            setTimeout( function() {

                slider.find( '.heading-slider-single-slide[data-slide-id="'+ currentSlideID +'"]' ).fadeOut( 300 );
                slider.find( '.heading-slider-single-slide[data-slide-id="'+ slideID +'"]' ).find( '.heading-slider-single-slide-content' ).addClass( 'animated animated-semi-speed fadeInRightSmall' ).css({ 'display': '' });

                $.martanianOakHouseConfigureHeadingSliderContentForMobile( true );

                slider.children( '.slider-navigation-dots' ).children( 'li[data-slide-id="'+ currentSlideID +'"]' ).children( '.slider-navigation-dot' ).removeClass( 'slider-navigation-dot-active' );
                slider.children( '.slider-navigation-dots' ).children( 'li[data-slide-id="'+ slideID +'"]' ).children( '.slider-navigation-dot' ).addClass( 'slider-navigation-dot-active' );

                setTimeout( function() {

                    slider.find( '.heading-slider-single-slide' ).css({ 'z-index': '' });
                    slider.find( '.heading-slider-single-slide' ).find( '.heading-slider-single-slide-content' ).removeClass( 'animated animated-semi-speed fadeInRightSmall fadeOutLeftSmall' );

                    slider.find( '.slider-navigation-dots' ).removeClass( 'proceed' );

                }, 800 );

            }, 400 );

        }, 100 );

    };

   /**
    *
    * action after click on images slider navigation
    *
    */

    $( 'body' ).on( 'click touchstart', 'section.heading-slider .slider-navigation-dots li', function( event ) {

        event.preventDefault();

        var element = $( this );
        var slider = element.parent().parent();
        var navigation = element.parent();
        var intervalTime = slider.data( 'interval' );
        var sliderID = slider.data( 'slider-id' );
        var slideID = element.data( 'slide-id' );
        var slidesCount = slider.find( '.slider-navigation-dots' ).children( 'li' ).length;

        if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;
        if( !navigation.hasClass( 'proceed' ) && !element.children().hasClass( 'slider-navigation-dot-active' ) && ( slidesCount > 1 ) ) {

            element.siblings( 'li' ).children( '.slider-navigation-dot' ).removeClass( 'slider-navigation-dot-active' );
            element.children( '.slider-navigation-dot' ).addClass( 'slider-navigation-dot-active' );

            clearInterval( martanianOakHouseIntervals['heading-slider-'+ sliderID] );
            $.martanianOakHouseSwitchHeadingSlide( slider, 'find', slideID );

            setTimeout( function() {

                if( intervalTime !== 0 ) {

                    martanianOakHouseIntervals['heading-slider-'+ sliderID] = setInterval( function() {

                        $.martanianOakHouseSwitchHeadingSlide( slider, 'find', 'next' );

                    }, parseInt( intervalTime, 10 ) );
                }

            }, 300 );
        }

    });

   /**
    *
    * isotope
    *
    */

    $.martanianOakHouseConfigureIsotope = function() {

        var columnWidthValue = 0;
        switch( parseInt( $( 'section.gallery > .container' ).css( 'width' ), 10 ) ) {

            case 1170: columnWidthValue = 390; break;
            case 970: columnWidthValue = 323; break;
            case 750: columnWidthValue = 375; break;
            default: columnWidthValue = 0; break;
        }

        $( '.isotope-grid' ).isotope({
            itemSelector: '.isotope-grid-item',
            layoutMode: 'masonry',
            masonry: { columnWidth: columnWidthValue }
        });

    };

   /**
    *
    * configure references
    *
    */

    $.martanianOakHouseConfigureReferences = function() {

        var sliderID = 1;
        $( 'section.references' ).each( function() {

            var slider = $( this );
            var referencesSlider = slider.find( '.references-slider' );

            slider.data( 'slider-id', sliderID ).attr( 'data-slider-id', sliderID );

           /**
            *
            * set id for single slide and show / hide each one
            *
            */

            var referenceID = 1;
            referencesSlider.find( '.single-reference' ).each( function() {

                var reference = $( this );

                if( referenceID != 1 ) reference.css({ 'display': 'none' });
                else reference.addClass( 'active' );

                if( referencesSlider.find( '.single-reference' ).length > 1 ) reference.attr( 'data-slide-id', referenceID );

                referenceID++;

            });

           /**
            *
            * configure navigation
            *
            */

            if( referenceID > 2 ) {

                var navigation = '';
                for( var i = 1; i < referenceID; i++ ) {

                    navigation += '<li data-slide-id="'+ i +'"><span class="slider-navigation-dot '+ ( i == 1 ? 'slider-navigation-dot-active' : '' ) +'"></span></li>';
                }

                slider.append( '<ul class="slider-navigation-dots">'+ navigation +'</ul>' );
            }

           /**
            *
            * run the slider
            *
            */

            var intervalTime = slider.data( 'interval' );
            if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;

            if( intervalTime !== 0 ) {

                martanianOakHouseIntervals['references-'+ sliderID] = setInterval( function() {

                    $.martanianOakHouseSwitchReference( slider, referencesSlider.find( '.single-reference' ).length, 'next' );

                }, parseInt( intervalTime, 10 ) );
            }

           /**
            *
            * increase slider id flag
            *
            */

            sliderID++;

           /**
            *
            * end of function.
            *
            */

        });

    };

   /**
    *
    * switch references slider
    *
    */

    $.martanianOakHouseSwitchReference = function( slider, referencesCount, referenceID ) {

        slider.find( '.slider-navigation-dots' ).addClass( 'proceed' );
        var currentReferenceID = slider.find( '.single-reference.active' ).data( 'slide-id' );

        if( referencesCount == 'find' ) referencesCount = slider.children( '.slider-navigation-dots' ).children( 'li' ).length;
        if( referenceID == 'next' ) referenceID = currentReferenceID + 1 > referencesCount ? 1 : currentReferenceID + 1;

        var currentSlide = slider.find( '.single-reference[data-slide-id="'+ currentReferenceID +'"]' );
        var newSlide = slider.find( '.single-reference[data-slide-id="'+ referenceID +'"]' );

        currentSlide.removeClass( 'active' ).addClass( 'animated fadeOutDownSmall' );
        setTimeout( function() {

            newSlide.css({ 'display': 'block' }).addClass( 'active animated fadeInDownSmall' );

            slider.find( '.slider-navigation-dots' ).children( 'li[data-slide-id="'+ currentReferenceID +'"]' ).children( '.slider-navigation-dot' ).removeClass( 'slider-navigation-dot-active' );
            slider.find( '.slider-navigation-dots' ).children( 'li[data-slide-id="'+ referenceID +'"]' ).children( '.slider-navigation-dot' ).addClass( 'slider-navigation-dot-active' );

            setTimeout( function() {

                currentSlide.css({ 'display': 'none' }).removeClass( 'animated fadeOutDownSmall' );
                newSlide.removeClass( 'animated fadeInDownSmall' );

                slider.find( '.slider-navigation-dots' ).removeClass( 'proceed' );

            }, 900 );

        }, 300 );

    };

   /**
    *
    * action after click on images slider navigation
    *
    */

    $( 'body' ).on( 'click touchstart', 'section.references .slider-navigation-dots li', function( event ) {

        event.preventDefault();

        var element = $( this );
        var slider = element.parents( 'section.references' );
        var navigation = element.parent();
        var intervalTime = slider.data( 'interval' );
        var sliderID = slider.data( 'slider-id' );
        var referenceID = element.data( 'slide-id' );
        var sliderReferencesCount = slider.find( '.slider-navigation-dots' ).children( 'li' ).length;

        if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;
        if( !navigation.hasClass( 'proceed' ) && !element.children().hasClass( 'slider-navigation-dot-active' ) && ( sliderReferencesCount > 1 ) ) {

            element.siblings( 'li' ).children( '.slider-navigation-dot' ).removeClass( 'slider-navigation-dot-active' );
            element.children( '.slider-navigation-dot' ).addClass( 'slider-navigation-dot-active' );

            clearInterval( martanianOakHouseIntervals['references-'+ sliderID] );
            $.martanianOakHouseSwitchReference( slider, 'find', referenceID );

            setTimeout( function() {

                if( intervalTime !== 0 ) {

                    martanianOakHouseIntervals['references-'+ sliderID] = setInterval( function() {

                        $.martanianOakHouseSwitchReference( slider, 'find', 'next' );

                    }, parseInt( intervalTime, 10 ) );
                }

            }, 300 );
        }

    });

   /**
    *
    * configure images header section heights
    *
    */

    $.martanianOakHouseConfigureImagesHeaderSection = function() {

        $( 'section.images-header' ).each( function() {

            var section = $( this );
            var leftColumn = section.find( '.col-md-6' ).first();
            var rightColumn = section.find( '.col-md-6' ).last();
            var elements = {
                'firstImages': leftColumn.children( '.images' ),
                'secondImages': leftColumn.children( '.images-header-bottom' ).children( '.images' ),
                'content': leftColumn.children( '.images-header-bottom' ).children( '.content' )
            };

            var contentHeight = parseInt( elements.content.css( 'height' ), 10 );
            var sectionHeight = parseInt( rightColumn.css( 'height' ), 10 );

            if( leftColumn.css( 'float' ) != 'none' ) {

                elements.secondImages.css({ 'height': contentHeight });
                elements.firstImages.css({ 'height': sectionHeight - contentHeight - parseInt( elements.firstImages.css( 'margin-bottom' ), 10 ) });
            }

            else {

                elements.secondImages.css({ 'height': '' });
                elements.firstImages.css({ 'height': '' });
            }

        });
    };

   /**
    *
    * configure progress bars
    *
    */

    $.martanianOakHouseConfigureProgressBars = function() {

        $( 'section.round-progress-bar' ).each( function() {

            var section = $( this );
            var progressBarElement = section.find( '.round-progress-bar-element' );

            progressBarElement.append( '<span class="value"></span>' );
            progressBarElement.circleProgress({

                value: progressBarElement.data( 'progress-bar-value' ),
                fill: { gradient: [martanian_oak_house_progress_bar_colors_first, martanian_oak_house_progress_bar_colors_second, martanian_oak_house_progress_bar_colors_third] },
                size: 140.0
            })

            progressBarElement.on( 'circle-animation-progress', function( event, progress, stepValue ) {

                var value = parseInt( String( stepValue.toFixed( 2 ) ).substr( 2 ), 10 );
                $( this ).find( 'span.value' ).html( value +'%' );

            });

        });

    };

   /**
    *
    * re-configure progress bars
    *
    */

    $.martanianOakHouseReConfigureProgressBars = function() {

        $( 'section.round-progress-bar' ).each( function() {

            var section = $( this );
            var progressBarElement = section.find( '.round-progress-bar-element' );

            progressBarElement.circleProgress({
                fill: { gradient: [martanian_oak_house_progress_bar_colors_first, martanian_oak_house_progress_bar_colors_second, martanian_oak_house_progress_bar_colors_third] },
                animation: false
            })

        });

    };

   /**
    *
    * configure images heights
    *
    */

    $.martanianOakHouseConfigureImagesHeights = function() {

        $( 'section.content-with-image-on-left-side, section.content-with-image-on-right-side' ).each( function() {

            var section = $( this );
            var images = section.find( '.col-md-4' ).children( '.images' );
            var content = section.find( '.col-md-4' ).children( '.content' );
            var isMobile = content.parents( '.col-md-4' ).css( 'display' ) == 'block' && content.parents( '.col-md-4' ).css( 'float' ) == 'none';

            if( isMobile == false ) images.css({ 'height': parseInt( content.css( 'height' ), 10 ) });
            else images.css({ 'height': '' });

        });
    };

   /**
    *
    * configure google maps
    *
    */

    $.martanianOakHouseConfigureGoogleMaps = function() {

        var mapID = 1;
        $( '.location-details-map' ).each( function() {

            var mapBox = $( this );
            var lat = mapBox.data( 'lat' );
            var lng = mapBox.data( 'lng' );
            var zoomedOut = false;
            var zoom = mapBox.data( 'zoom-level' );
            var contentSize = parseInt( mapBox.parents( 'section.location-details' ).css( 'width' ), 10 );

            if( contentSize < 690 && zoom > 1 ) {

                zoom = zoom - 1;
                zoomedOut = true;
            }

            mapBox.attr( 'id', 'google-map-'+ mapID );

            var map = new google.maps.Map( document.getElementById( 'google-map-'+ mapID ), {
                zoom: zoom,
                center: new google.maps.LatLng( lat, lng ),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}]
            });

            mapBox.siblings( '.location-details-map-marker' ).each( function() {

                var markerLat = $( this ).data( 'lat' );
                var markerLng = $( this ).data( 'lng' );
                var markerType = $( this ).data( 'type' );

                new google.maps.Marker({
                    position: new google.maps.LatLng( markerLat, markerLng ),
                    map: map
                });

            });

            google.maps.event.addDomListener( window, 'resize', function() {

                var mapCenter = map.getCenter();

                google.maps.event.trigger( map, 'resize' );
                map.setCenter( mapCenter );

               /**
                *
                * zoom-in and zoom-out for map
                *
                */

                var currentZoom = map.getZoom();
                contentSize = parseInt( mapBox.parents( 'section.location-details' ).css( 'width' ), 10 );

                if( contentSize < 690 && zoomedOut == false ) {

                    map.setZoom( currentZoom - 1 );
                    zoomedOut = true;
                }

                else if( contentSize >= 690 && zoomedOut == true ) {

                    map.setZoom( currentZoom + 1 );
                    zoomedOut = false;
                }

            });

            mapID++;

        });

    };

   /**
    *
    * configure sidebar menu list counter
    *
    */

    $.martanianOakHouseConfigureSidebarMenuListCounter = function() {

        $( 'section.sidebar .widget ul li:not(.recentcomments), .wpb_widgetised_column .widget ul li:not(.recentcomments)' ).each( function() {

            var element = $( this );
            $.martanianOakHouseConfigureSidebarMenuListCounterSingleElement( element );

            element.find( '.content' ).each( function() {

                var count = $( this );
                if( count.children( '.content' ).length != 0 ) {

                    count.children( '.content' ).unwrap();
                }

            });

        });

    };

   /**
    *
    * configure single element for sidebar menu list counter
    *
    */

    $.martanianOakHouseConfigureSidebarMenuListCounterSingleElement = function( element ) {

        var link = element.children( 'a' );

        if( element.children( 'ul.children, ul.sub-menu' ).length == 0 ) {

            element.wrapInner( '<span class="content"></span>' );
            element.prepend( link );

            var count = element.children( '.content' );
            link.append( count );
        }

        else {

            var submenu = element.children( 'ul.children, ul.sub-menu' );

            element.wrapInner( '<span class="content"></span>' );
            element.prepend( link );
            element.append( submenu );

            var count = element.children( '.content' );
            link.append( count );

            if( submenu.children( 'ul.children, ul.sub-menu' ) ) {

                submenu.children( 'li' ).each( function() {

                    $.martanianOakHouseConfigureSidebarMenuListCounterSingleElement( $( this ) );

                });
            }
        }
    };

   /**
    *
    * manage top header bar position for responsive view,
    * when logged-in to wordpress
    *
    */

    $( window ).scroll( function() { $.martanianOakHouseManageTopHeaderBarForResponsiveWP(); });
    $.martanianOakHouseManageTopHeaderBarForResponsiveWP = function() {

        if( !$( 'body' ).hasClass( 'admin-bar' ) ) return false;
        if( $( 'body' ).width() <= 600 ) {

            var toTop = $( window ).scrollTop();
            var positionToTop = 0;

            if( toTop < 46 ) positionToTop = 46 - toTop;

            $( 'body.admin-bar header.header-bar' ).css({ 'top': positionToTop });
            $( 'body.admin-bar .responsive-menu-content' ).css({ 'margin-top': positionToTop, 'height': 'calc( 100% - '+ positionToTop +'px )' });
        }

        else {

            $( 'body.admin-bar header.header-bar' ).css({ 'top': '' });
            $( 'body.admin-bar .responsive-menu-content' ).css({ 'margin-top': '', 'height': '' });
        }

    };

   /**
    *
    * check and wrap single images
    *
    */

    $.martanianOakHouseCheckAndWrapSingleImage = function() {

        $( '.image[data-check-if-single="yes"]' ).each( function() {

            var image = $( this );
            if( image.parents( '.images' ).length === 0 ) image.wrap( '<div class="images"></div>' );

        });
    };

   /**
    *
    * configure selects
    *
    */

    $.martanianOakHouseConfigureSelects = function() {

        $( 'select' ).each( function() {

            var element = $( this );
            var multiple = typeof element.attr( 'multiple' ) == 'undefined' ? false : ( element.attr( 'multiple' ) == 'multiple' );

            element.wrap( '<span class="select-field '+ ( multiple == true ? 'is-multiple-select' : '' ) +'"></span>' );

        });

    };

   /**
    *
    * configure checkbox
    *
    */

    $.martanianOakHouseConfigureCheckbox = function() {

        $( 'input[type="checkbox"]' ).each( function() {

            var checkbox = $( this );
            var holder = checkbox.parent().parent();
            var checked = checkbox.is( ':checked' );

            checkbox.after( '<div class="checkbox-box"><span class="checkbox">'+ ( checked ? '<i class="fa fa-check"></i>' : '' ) +'</span></div>' );
            holder.addClass( 'checkbox-field' );

            if( checkbox.parents( 'label' ).length !== 0 ) checkbox.parents( 'label' ).addClass( 'checkbox-label' );
            else {

                holder.wrapInner( '<span class="checkbox-label"></span>' );
                holder.children( 'span.checkbox-label' ).before( holder.find( 'span.wpcf7-form-control-wrap' ) );
            }

        });

    };

   /**
    *
    * checkbox field change
    *
    */

    $( 'body' ).on( 'click touchstart', '.checkbox-box', function( event ) {

        event.preventDefault();

        var checkboxBox = $( this );
        $.martanianOakHouseChangeCheckbox( checkboxBox );

    });

   /**
    *
    * action after click on checkbox label
    *
    */

    $( 'body' ).on( 'click touchstart', '.checkbox-label', function( event ) {

        if( $( event.target ).is( 'a' ) ) return;

        event.preventDefault();
        if( !$( event.target ).is( 'span.checkbox' ) && !$( event.target ).is( 'i.fa.fa-check' ) ) {

            var label = $( this );
            var checkboxBox = label.siblings( '.wpcf7-form-control-wrap' ).find( '.checkbox-box' );

            $.martanianOakHouseChangeCheckbox( checkboxBox );
        }

    });

   /**
    *
    * change checkbox value function
    *
    */

    $.martanianOakHouseChangeCheckbox = function( checkboxBox ) {

        var checkboxInput = checkboxBox.siblings( 'input[type="checkbox"]' );
        var checkboxInputName = checkboxInput.attr( 'name' );
        var isCheckboxMultiple = checkboxInputName.indexOf( '[]' ) == -1 ? false : true;
        var isAcceptance = checkboxInput.hasClass( 'wpcf7-acceptance' );

        if( checkboxInput.attr( 'checked' ) == 'checked' ) {

            checkboxInput.removeAttr( 'checked' );
            checkboxBox.children( '.checkbox' ).html( '' );
        }

        else {

            if( !isCheckboxMultiple ) $.martanianOakHouseUncheckAllCheckboxes( checkboxInputName );

            checkboxInput.attr( 'checked', 'checked' );
            checkboxBox.children( '.checkbox' ).html( '<i class="fa fa-check"></i>' );
        }

        if( isAcceptance ) $.martanianOakHouseUpdateAcceptance( checkboxBox );

    };

   /**
    *
    * uncheck all checkboxes
    *
    */

    $.martanianOakHouseUncheckAllCheckboxes = function( name ) {

        $( 'input[type="checkbox"][name="'+ name +'"]' ).each( function() {

            var checkboxInput = $( this );
            var checkboxBox = checkboxInput.siblings( '.checkbox-box' );

            checkboxInput.removeAttr( 'checked' );
            checkboxBox.children( '.checkbox' ).html( '' );

        });

    };

   /**
    *
    * configure radio elements
    *
    */

    $.martanianOakHouseConfigureRadioElements = function() {

        $( 'input[type="radio"]' ).each( function() {

            var radio = $( this );
            var holder = radio.parent();
            var checked = radio.is( ':checked' );

            radio.after( '<div class="radio-box"><span class="radio">'+ ( checked ? '<span class="radio-checked"></span>' : '' ) +'</span></div>' );
            holder.addClass( 'radio-field' );

            if( radio.parents( 'label' ).length !== 0 ) radio.parents( 'label' ).addClass( 'radio-label' );
            else {

                holder.wrapInner( '<span class="radio-label"></span>' );
                holder.children( 'span.radio-label' ).before( holder.find( 'span.wpcf7-form-control-wrap' ) );
            }

        });

    };

   /**
    *
    * radio field change
    *
    */

    $( 'body' ).on( 'click touchstart', '.radio-box', function( event ) {

        event.preventDefault();

        var radioBox = $( this );
        $.martanianOakHouseChangeRadioElement( radioBox );

    });

   /**
    *
    * action after click on radio label
    *
    */

    $( 'body' ).on( 'click touchstart', 'label.radio-label', function( event ) {

        event.preventDefault();
        if( !$( event.target ).is( 'span.radio' ) && !$( event.target ).is( 'span.radio-checked' ) ) {

            var label = $( this );
            var radioBox = label.find( '.radio-box' );

            $.martanianOakHouseChangeRadioElement( radioBox );
        }

    });

   /**
    *
    * change checkbox value function
    *
    */

    $.martanianOakHouseChangeRadioElement = function( radioBox ) {

        var radioInput = radioBox.siblings( 'input[type="radio"]' );
        var radioInputName = radioInput.attr( 'name' );

        $.martanianOakHouseUncheckAllRadioElements( radioInputName );

        radioInput.attr( 'checked', 'checked' );
        radioBox.children( '.radio' ).html( '<span class="radio-checked"></span>' );
    };

   /**
    *
    * uncheck all radio elements
    *
    */

    $.martanianOakHouseUncheckAllRadioElements = function( name ) {

        $( 'input[type="radio"][name="'+ name +'"]' ).each( function() {

            var radioInput = $( this );
            var radioBox = radioInput.siblings( '.radio-box' );

            radioInput.removeAttr( 'checked' );
            radioBox.children( '.radio' ).html( '' );

        });

    };

   /**
    *
    * acceptance field
    * do tad!
    *
    */

    $.martanianOakHouseUpdateAcceptance = function( checkboxBox ) {

        var form = checkboxBox.parents( 'form.wpcf7-form' );
        var button = form.find( 'input[type="submit"].wpcf7-submit' );
        var isError = false;

        form.find( 'input[type="checkbox"].wpcf7-acceptance' ).each( function() {

            var field = $( this );
            var isInvert = field.hasClass( 'wpcf7-invert' );
            var isCorrect = isInvert ? ( field.is( ':checked' ) ? false : true ) : ( field.is( ':checked' ) ? true : false );

            if( isCorrect == false ) isError = true;

        });

        if( isError == true ) button.attr( 'disabled', 'disabled' );
        else button.removeAttr( 'disabled' );

    };

   /**
    *
    * configure date fields
    *
    */

    $.martanianOakHouseConfigureDateFields = function() {

        $( 'input[type="date"]' ).each( function() {

            var field = $( this );
            field.wrap( '<span class="date-field"></span>' );

            field.parents( '.date-field' ).prepend( '<span class="date-field-icon"><i class="fa fa-calendar"></i></span>' );

        });

    };

   /**
    *
    * play the video
    *
    */

    $( 'body' ).on( 'click touchstart', 'section.video .video-play-button', function( event ) {

        event.preventDefault();

        var section = $( this ).parents( 'section.video' );
        var videoURL = section.data( 'video-url' );

        $.magnificPopup.open({
          		type: 'iframe',
            items: {
                src: videoURL
            }
       	});

    });

   /**
    *
    * change menu visibility flag
    *
    */

    $.martanianOakHouseChangeResponsiveMenuVisibilityFlag = function( visibility ) {

        martanianOakHouseResponsiveMenuVisible = visibility;

    };

   /**
    *
    * configure responsive menu
    *
    */

    $.martanianOakHouseConfigureResponsiveMenu = function() {

        var contentSize = parseInt( $( 'header.header-bar .container' ).css( 'width' ), 10 );
        var responsiveMenuWidth = contentSize < 750 ? ( contentSize <= 370 ? 180 : 250 ) : 300;

        var headerBar = $( 'header.header-bar' );
        var headerMenu = headerBar.find( 'nav.top-menu > ul' );
        var headerTopBar = headerBar.find( '.header-bar-top' );

        martanianOakHouseResponsiveMenuVisible = false;

        headerBar.css({ 'left': '0' });
        $( '.big-wrapper' ).css({ 'margin-left': '', 'width': '' });
        $( '.responsive-menu-content' ).css({ 'display': 'none', 'right': '-'+ responsiveMenuWidth +'px' });

        if( contentSize >= 970 ) $( '.responsive-menu-content' ).remove();
        else {

            if( $( '.responsive-menu-content' ).length == 0 ) {

                $( 'body' ).append( '<div class="responsive-menu-content"></div>' );
                $( '.responsive-menu-content' ).append( '<ul class="menu">'+ headerMenu.html() +'</ul>'+ headerTopBar.html() );
                $( '.responsive-menu-content' ).find( '.children' ).removeClass( 'animated animated-speed fadeInDown' );

                $( '.responsive-menu-content .header-bar-top-element[data-element-type="phone-number"]' ).prepend( '<i class="fa fa-phone"></i>' );
                $( '.responsive-menu-content .header-bar-top-element[data-element-type="email-address"]' ).prepend( '<i class="fa fa-envelope-o"></i>' );
                $( '.responsive-menu-content .header-bar-top-element[data-element-type="location"]' ).prepend( '<i class="fa fa-map-marker"></i>' );
                $( '.responsive-menu-content .header-bar-top-element[data-element-type="languages"]' ).prepend( '<i class="fa fa-globe"></i>' );

                $( '.responsive-menu-content .header-bar-top-element[data-element-type="languages"] i.fa-caret-down' ).remove();
            }
        }
    };

   /**
    *
    * show responsive menu
    *
    */

    $( 'body' ).on( 'click touchstart', '.responsive-menu-button', function( event ) {

        event.preventDefault();

        var contentSize = parseInt( $( 'header.header-bar .container' ).css( 'width' ), 10 );
        var responsiveMenuWidth = contentSize < 750 ? ( contentSize <= 370 ? 180 : 250 ) : 300;

        if( martanianOakHouseResponsiveMenuVisible == false ) {

            var wrapper = $( '.big-wrapper' );
            var wrapperWidth = wrapper.width();
            var headerBar = $( this ).parents( 'header.header-bar' );

            headerBar.animate({ 'left': '-'+ responsiveMenuWidth +'px' }, 300 );
            wrapper.animate({ 'margin-left': '-'+ responsiveMenuWidth +'px', 'width': wrapperWidth }, 300 );

            $( '.responsive-menu-content' ).css({ 'display': 'block' }).animate({ 'right': '0' }, 300 );
            martanianOakHouseResponsiveMenuVisible = true;
        }

        else {

            var wrapper = $( '.big-wrapper' );
            var wrapperWidth = wrapper.width();
            var headerBar = $( this ).parents( 'header.header-bar' );

            headerBar.animate({ 'left': '0' }, 300 );
            wrapper.animate({ 'margin-left': '0' }, 300 );

            $( '.responsive-menu-content' ).css({ 'display': 'block' }).animate({ 'right': '-'+ responsiveMenuWidth +'px' }, 300 );

            setTimeout( function() {

                $( '.responsive-menu-content' ).css({ 'display': 'none' });
                wrapper.css({ 'margin-left': '', 'width': '' });
                headerBar.css({ 'left': '' });

            }, 300 );

            martanianOakHouseResponsiveMenuVisible = false;
        }

    });

   /**
    *
    * configure contact form backgrounds
    *
    */

    $.martanianOakHouseConfigureContactFormBackgrounds = function() {

        $( 'section.contact-form' ).each( function() {

            var section = $( this );
            var formBackground = section.find( '.contact-form-background' );
            var imageBackground = section.find( '.contact-form-background-image' );
            var form = section.find( '.contact-form-box' );
            var formHeight = parseInt( form.css( 'height' ), 10 );
            var isMobile = section.find( '.col-md-6' ).css( 'float' ) == 'none';

            if( isMobile == false ) {

                formBackground.css({ 'height': formHeight });
                imageBackground.css({ 'height': formHeight });
            }

            else {

                formBackground.css({ 'height': formHeight });
                imageBackground.css({ 'height': 350 });
            }

        });
    }

   /**
    *
    * refresh the contact form backgrounds
    * on submit
    *
    */

    $( 'body' ).on( 'click touchstart', '.wpcf7-submit', function() {

        var count = 0;
        var interval = setInterval( function() {

            $.martanianOakHouseConfigureContactFormBackgrounds();
            count++;

            if( count == 15 ) clearInterval( interval );

        }, 100 );

    });

   /**
    *
    * configure heading slider content for mobile
    *
    */

    $.martanianOakHouseConfigureHeadingSliderContentForMobile = function( animate ) {

        $( 'section.heading-slider' ).each( function() {

            var slider = $( this );
            var currentSlide = slider.find( '.heading-slider-single-slide.active' );
            var currentSlideContent = currentSlide.find( '.heading-slider-single-slide-content' );
            var isMobile = currentSlideContent.css( 'display' ) == 'block';

            if( isMobile == true ) {

                var height = parseInt( currentSlideContent.css( 'height' ), 10 );

                if( animate == false ) slider.css({ 'margin-bottom': height });
                else slider.animate({ 'margin-bottom': height }, 200 );

                if( slider.find( '.heading-slider-background-overlay' ).length == 0 ) slider.append( '<div class="heading-slider-background-overlay"></div>' );
                slider.find( '.heading-slider-background-overlay' ).css({ 'height': height, 'bottom': '-'+ height +'px' });
            }

            else {

                slider.css({ 'margin-bottom': '' });
                slider.find( '.heading-slider-background-overlay' ).remove();
            }

        });
    };

   /**
    *
    * function returns an image URL from background css attribute
    *
    */

    $.martanianOakHouseGetImageURL = function( image ) {

        var backgroundURL = /^url\((['"]?)(.*)\1\)$/.exec( image );
        return( backgroundURL ? backgroundURL[2] : false );
    };

   /**
    *
    * configure images for magnific popup
    *
    */

    $.martanianOakHouseConfigureImagesForMagnificPopup = function() {

        $( '.images' ).each( function() {

            var images = $( this );
            if( images.parents( '.widget' ).length == 0 ) {

                images.find( '.image' ).each( function() {

                    var image = $( this );
                    var imageURL = $.martanianOakHouseGetImageURL( image.css( 'background-image' ) );

                    image.data( 'mfp-src', imageURL ).attr( 'data-mfp-src', imageURL );
                    image.html( '<div class="image-caption"><div class="image-caption-icon"><i class="fa fa-expand"></i></div></div>' );

                });

                images.magnificPopup({
                    delegate: '.image',
                    type: 'image',
                    gallery: { enabled: true }
                });
            }

        });

        $( 'section.gallery' ).each( function() {

            var gallery = $( this );
            gallery.find( '.isotope-grid-item' ).each( function() {

                var image = $( this );
                var imageURL = $.martanianOakHouseGetImageURL( image.css( 'background-image' ) );

                image.data( 'mfp-src', imageURL ).attr( 'data-mfp-src', imageURL );
                image.html( '<div class="image-caption"><div class="image-caption-icon"><i class="fa fa-expand"></i></div></div>' );

            });

            gallery.magnificPopup({
                delegate: '.isotope-grid-item',
                type: 'image',
                gallery: { enabled: true }
            });

        });
    };

   /**
    *
    * configure comments visibility
    *
    */

    $.martanianOakHouseConfigureCommentsVisibility = function() {

        var comments = $( '.comments' );
        comments.find( 'li.comment' ).each( function() {

            var comment = $( this ).children( '.comment-body' );
            var author = comment.find( '.comment-author' ).find( 'cite.fn' );
            var reply = comment.find( '.reply' );
            var authorNotice = comment.parent().hasClass( 'bypostauthor' ) ? ' <span class="author">'+ comments.data( 'author-text' ) +'</span>' : '';

            comment.addClass( 'content-element' );
            reply.children( 'a' ).html( '<i class="fa fa-reply"></i>' );

            if( reply.length == 0 ) comment.find( '.comment-author' ).after( '<div class="comment-author-name">'+ author.html() + authorNotice +'</div>' );
            else comment.find( '.comment-author' ).after( '<div class="comment-author-name">'+ author.html() + authorNotice +' <span class="reply">'+ reply.html() +'</span></div>' );

            author.remove();
            reply.remove();
            comment.find( '.says' ).remove();

            comment.find( '.comment-meta' ).addClass( 'comment-pub-date' );
            comment.find( '.comment-author, .comment-author-name, .comment-pub-date' ).wrapAll( '<div class="comment-data"></div>' );
            comment.children( '*:not(.comment-data)' ).wrapAll( '<div class="comment-content"></div>' );

            var avatar = comment.find( 'img.avatar' );
            avatar.parent().before( '<div class="comment-author-image" style="background-image: url( '+ avatar.attr( 'src' ) +' );"></div>' );
            avatar.parent().remove();

            comment.parent().find( 'ul.children' ).addClass( 'sub-comments' );
            comment.parent().find( 'ul.children li.comment .comment-body' ).addClass( 'comment-wrapper' );

            if( !comment.parent().hasClass( 'depth-1' ) ) {

                comment.find( '.comment-content p' ).last().addClass( 'without-margin-bottom' );
            }

        });

    };

   /**
    *
    * add border line to row
    *
    */

    $.martanianOakHouseAddBorderLineForRow = function() {

        $( '.vc_row.martanian-row-border-top' ).each( function() {

            var row = $( this );
            row.prepend( '<div class="row-border-top"></div>' );

        });
    };

   /**
    *
    * configure images slider
    *
    */

    $.martanianOakHouseConfigureImagesSlider = function() {

        var sliderID = 1;
        $( '.images' ).each( function() {

            var slider = $( this );
            var imageID = 1;
            var magnificAvailable = slider.parents( 'section.recent-news' ).length == 0 && slider.parents( 'section.sidebar' ).length == 0 && slider.parents( 'section.similar-posts' ).length == 0;

            slider.children( '.image' ).each( function() {

                var image = $( this );
                var imageURL = $.martanianOakHouseGetImageURL( image.css( 'background-image' ) );

                image.attr( 'data-image-id', imageID );

                if( imageID != 1 ) image.css({ 'display': 'none' });
                else {

                    if( image.hasClass( 'image-long' ) ) slider.addClass( 'images-long' );
                }

                if( magnificAvailable ) {

                    image.data( 'mfp-src', imageURL ).attr( 'data-mfp-src', imageURL );
                    image.html( '<div class="image-caption"><div class="image-caption-icon"><i class="fa fa-expand"></i></div></div>' );
                }

                imageID++;

            });

            if( slider.children( '.image' ).length > 1 ) {

                slider.attr( 'data-images-slider-id', sliderID );

                var navigation = '';
                for( var i = 1; i < imageID; i++ ) {

                    navigation += '<li data-images-slider-image-id="'+ i +'" '+ ( i == 1 ? 'class="active"' : '' ) +'><span class="circle"></span></li>';
                }

                slider.append( '<ul class="navigation">'+ navigation +'</ul>' );

                var intervalTime = slider.data( 'interval' );
                if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;

                if( intervalTime !== 0 ) {

                    martanianOakHouseIntervals['images-slider-'+ sliderID] = setInterval( function() {

                        $.martanianOakHouseSwitchImagesImage( slider, slider.children( '.image' ).length, 'next' );

                    }, parseInt( intervalTime, 10 ) );
                }

                sliderID++;
            }

            if( magnificAvailable ) {

                slider.magnificPopup({
                    delegate: '.image',
                    type: 'image',
                    gallery: { enabled: true }
                });
            }

        });
    };

   /**
    *
    * switch images slider image
    *
    */

    $.martanianOakHouseSwitchImagesImage = function( slider, imagesCount, imageID ) {

        var currentImageID = slider.children( '.navigation' ).children( 'li.active' ).data( 'images-slider-image-id' );

        if( imagesCount == 'find' ) imagesCount = slider.children( '.navigation' ).children( 'li' ).length;
        if( imageID == 'next' ) imageID = currentImageID + 1 > imagesCount ? 1 : currentImageID + 1;

        slider.find( '.image[data-image-id="'+ currentImageID +'"]' ).fadeOut( 300 );
        slider.find( '.image[data-image-id="'+ imageID +'"]' ).fadeIn( 300 );

        slider.children( '.navigation' ).children( 'li[data-images-slider-image-id="'+ currentImageID +'"]' ).removeClass( 'active' );
        slider.children( '.navigation' ).children( 'li[data-images-slider-image-id="'+ imageID +'"]' ).addClass( 'active' );

        setTimeout( function() {

            if( slider.find( '.image[data-image-id="'+ imageID +'"]' ).hasClass( 'image-long' ) ) slider.addClass( 'images-long' );
            else slider.removeClass( 'images-long' );

        }, 150 );

    };

   /**
    *
    * action after click on images slider navigation
    *
    */

    $( 'body' ).on( 'click touchstart', '.images .navigation li', function( event ) {

        event.preventDefault();

        var element = $( this );
        var slider = element.parent().parent();
        var navigation = element.parent();
        var intervalTime = slider.data( 'interval' );
        var sliderID = slider.data( 'images-slider-id' );
        var imageID = element.data( 'images-slider-image-id' );
        var sliderImagesCount = slider.find( '.navigation' ).children( 'li' ).length;

        if( typeof intervalTime == 'undefined' || intervalTime === null || intervalTime === false ) intervalTime = 6000;
        if( !navigation.hasClass( 'proceed' ) && !element.hasClass( 'active' ) && ( sliderImagesCount > 1 ) ) {

            navigation.addClass( 'proceed' );

            clearInterval( martanianOakHouseIntervals['images-slider-'+ sliderID] );
            $.martanianOakHouseSwitchImagesImage( slider, 'find', imageID );

            setTimeout( function() {

                if( intervalTime !== 0 ) {

                    martanianOakHouseIntervals['images-slider-'+ sliderID] = setInterval( function() {

                        $.martanianOakHouseSwitchImagesImage( slider, 'find', 'next' );

                    }, parseInt( intervalTime, 10 ) );
                }

                navigation.removeClass( 'proceed' );

            }, 300 );
        }

    });

   /**
    *
    * add ids for faq-short sections
    *
    */

    $.martanianOakHouseAddIDsForFAQshortSections = function() {

        var sectionID = 1;
        $( 'section.faq-short' ).each( function() {

            var section = $( this );

            section.data( 'faq-short-id', sectionID ).attr( 'data-faq-short-id', sectionID );
            sectionID++;

        });

    };

   /**
    *
    * add styles for "call to action" widgets
    *
    */

    $.martanianOakHouseAddStylesForCallToActionWidgets = function() {

        $( '.widget.call-to-action-widget' ).each( function() {

            var head = $( 'head' )
            var widget = $( this );
            var widget_css = widget.children( '.call-to-action-widget-styles' );

            if( head.find( '#martanian-oak-house-call-to-action-widgets-css' ).length == 0 ) head.append( '<style type="text/css" id="martanian-oak-house-call-to-action-widgets-css">'+ widget_css.html() +'</style>' );
            else head.find( '#martanian-oak-house-call-to-action-widgets-css' ).append( widget_css.html() );

            widget_css.remove();

        });
    };

   /**
    *
    * configure closer menu
    *
    */

    $.martanianOakHouseHeaderMenuCloser = function() {

        var headerBar = $( 'header.header-bar' );
        if( headerBar.find( 'nav.top-menu' ).height() > 77 ) {

            headerBar.addClass( 'top-menu-closer' );
        }
    };

   /**
    *
    * end of file.
    *
    */

});