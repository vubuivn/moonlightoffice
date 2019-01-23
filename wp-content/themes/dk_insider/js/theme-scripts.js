(function( $ ){
	"use strict";
	
	var handheldBreakpoint = 1088;
		
	// **************
	// document.ready
	// **************
	jQuery(document).ready(function(){	
		
		// *****************
		// load screen
		// *****************
		jQuery('body').removeClass('loading');
		
		jQuery('#logo a, #menu a, #content p a, #content h2 a, .post-pagination a, .widget a').on('click', function(event){
			if ( jQuery(this).attr('href')!="#" && jQuery(this).attr('href')!="" && jQuery(this).attr('target')!="_blank" ){
				setTimeout(function(){
					jQuery('body').addClass('loading unloading');
				});
			}
		});
	});
	
		
	// ***********
	// window.load
	// ***********
	jQuery(window).load(function(){
		
		// *****************
		// dropdown menu
		// *****************
		if ( jQuery(window).width() <= handheldBreakpoint ){
			// mobile
			jQuery('#menu ul li:has(> ul) > a').on('click', function(event) {
				event.preventDefault();
				jQuery(this).closest('li').toggleClass('submenu-shown');
			});
		} 
		else {
			// desktop
			jQuery('#menu ul li:has(> ul)').on('mouseenter mouseleave', function() {
				var $this = jQuery(this);
				  
				if ( !$this.hasClass('submenu-shown') ) {			
					$this.addClass('submenu-shown');
				}
				else {
					setTimeout( function() {
						$this.removeClass('submenu-shown');
					});
				}
			});
		}
		
		
		// *****************
		// mobile menu close
		// *****************
		jQuery('#menu').on('click', function(){
			jQuery('#menutoggle').prop('checked', false);
		});
		
		
		// *****************
		// search icon
		// *****************
		jQuery('#searchbar').on('click', function(event) {
			event.preventDefault();
			if( jQuery(this).hasClass('searchbar-shown') ) {
				if( jQuery('#searchbar input').val() ){
			        	jQuery("#searchbar button").click();
			    	}
			    	else {
				    	jQuery(this).removeClass('searchbar-shown');
			    	}
			}
			else {
				jQuery(this).addClass('searchbar-shown').find('input').focus();
			}
		});
	
		
		// *****************
		// social buttons stay on top while scrolling
		// *****************
		var $social = jQuery('.social-bar');
		if ( $social.length > 0 && jQuery('#comments').length > 0 ) {
			
			var socialTopPos = $social.offset().top;
			var socialLeftPos = $social.offset().left;
			var socialHeight = $social.outerHeight(true);
			var commentsPos  = jQuery('#comments').offset().top;
						
			jQuery(window).on('scroll', function() {
				// is the element out of viewport?
				var scrollPos = jQuery(window).scrollTop();		
				if ( scrollPos > (socialTopPos - socialHeight) ){
					$social.addClass('fixed-position').css('left',socialLeftPos);
					commentsPos  = jQuery('#comments').offset().top;
					if ( scrollPos > commentsPos ) {
						$social.addClass('hide');
					}
					else {
						$social.removeClass('hide');
					}
				}
				else {
					$social.removeClass('hide').removeClass('fixed-position').css('left',0);
				}
			});
			
			// recalculate after window resize
			jQuery(window).resize(function() {
			    clearTimeout(window.resizedFinished);
			    window.resizedFinished = setTimeout(function(){
			        console.log('Resized finished.');
			        
			        // recalculate
				   socialTopPos = $social.offset().top;
				   socialLeftPos = $social.offset().left;
				   commentsPos  = jQuery('#comments').offset().top;
			    }, 250);
			});
		}
	
	
		// *****************
		// smooth scroll internal links (comments)
		// *****************
		jQuery('a[href*="#"]:not([href="#"])').on('click', function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = jQuery(this.hash);
				target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					jQuery('html, body').animate({
						scrollTop: target.offset().top
		        		}, 800);
			   		return false;
	      		}
	      	}
	  	});
	  	
	  	
	  	// *****************
		// remove title on img hover
		// *****************
		jQuery('a,img').on('hover', function(e){
			jQuery(this).attr('data-title', jQuery(this).attr('title'));
			jQuery(this).removeAttr('title');
		},
		function(e){
	        	jQuery(this).attr('title', jQuery(this).attr('data-title'));
	    	});
	    	
	    	
	    	// *****************
		// Thickbox gallery
		// *****************
	    	jQuery('.gallery-icon a').addClass('thickbox').attr('rel','gallery');
	    	
	        	
	    	// *****************
	    	// load more pagination
	    	// *****************
	    	jQuery(document).on('click', '#load-more a', function(event){
			event.preventDefault();
			var page = parseInt( jQuery('#load-more').attr('data-load_page') );
			var until = parseInt( jQuery('#load-more').attr('data-until') );
			var already_displayed = parseInt( jQuery('#load-more').attr('data-already_displayed') );
			jQuery('body').addClass('fetching');
			
			jQuery.ajax({
				type: "post",
				url: ajax_var.url,
				data: {
					action: 'ajax_pagination',
					template: ajax_var.template,
					page: page,
					already_displayed: already_displayed
				},
				success: function( html ) {
					// fetch individual excerpts
					var fetchedExcerpts = jQuery(jQuery.parseHTML(html)).filter('.excerpt');
					
					// append excerpts one by one
					jQuery.each( fetchedExcerpts, function( i, val ) {
						setTimeout( function() { 
							jQuery('.fetch-excerpts').append(val);
						}, i*100);
						
						setTimeout( function() {
							jQuery(val).find('.featured-image-excerpt img').addClass('lazy-loaded');
						}, 1000);
					});
					jQuery('body').removeClass('fetching');
							
										
					if ( page < until ) {
						// increment flag
						jQuery('#load-more').attr('data-load_page',parseInt( page + 1 ));
					} else 
					{
						// if nothing else to show, hide navigation
						jQuery('#load-more').remove();
					}
				}
			})
		});	
	   		
		
		// *****************
		// Events datepicker
		// *****************
		if ( jQuery('#tribe-bar-date').length > 0 ){
		    	jQuery('#tribe-bar-date').datepicker({
		        dateFormat: 'dd-mm-yy'
			});
		}
	
	
	});
			

} )( jQuery );
