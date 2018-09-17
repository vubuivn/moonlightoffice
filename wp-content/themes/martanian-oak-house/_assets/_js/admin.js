jQuery( document ).ready( function( $ ) {

    var martanian_oak_house_media_frame;
    $( 'body' ).on( 'click', '.martanian-oak-house-media-button', function( event ) {

        event.preventDefault();

        var button = $( this );
        martanian_oak_house_media_frame = wp.media({
            title: martanian_oak_house_javascript_admin_functions_l10n.media_title,
            button: { text: martanian_oak_house_javascript_admin_functions_l10n.button },
            multiple: false
        });

        martanian_oak_house_media_frame.on( 'select', function() {

            var image_preview = button.siblings( '.image-preview' );
            var attachment = martanian_oak_house_media_frame.state().get( 'selection' ).first().toJSON();

            button.siblings( '.martanian-oak-house-media-url' ).attr( 'value', attachment.url ).val( attachment.url );

            if( image_preview.length == 0 ) button.parent().prepend( '<div class="image-preview"><img src="'+ attachment.url +'" /></div>' );
            else image_preview.children( 'img' ).attr( 'src', attachment.url );

        });

        martanian_oak_house_media_frame.open();

    });

});