jQuery( document ).ready( function( $ ) {

   /**
    *
    * strict mode
    *
    */

    'use strict';

   /**
    *
    * configure theme options page tabs
    *
    */

    $( window ).load( function() {

        var tabID = 1;
        $( '.martanian-oak-house-theme-options-single-tab' ).each( function() {

            if( tabID != 1 ) $( this ).css({ 'display': 'none' });
            tabID++;

        });

    });

   /**
    *
    * change tab
    *
    */

    $( 'body' ).on( 'click', '.martanian-oak-house-theme-options-tabs li:not(.active)', function() {

        var tab = $( this );
        var tabKey = tab.data( 'tab-key' );

        tab.siblings( 'li' ).removeClass( 'active' );
        tab.addClass( 'active' );

        $( '.martanian-oak-house-theme-options-single-tab' ).css({ 'display': 'none' });
        $( '.martanian-oak-house-theme-options-single-tab[data-tab-key="'+ tabKey +'"]' ).css({ 'display': 'block' });

    });

   /**
    *
    * action handle
    *
    */

    $( 'body' ).on( 'click', '#martanian_oak_house_import', function() {

        var import_true = confirm( martanian_oak_house_demo_import_script_l10n.confirm );
        if( import_true == false ) return;

        var message_box = $( '#martanian_oak_house_import_message' );
        message_box.html( martanian_oak_house_demo_import_script_l10n.processed ).addClass( 'working' );

        $.post( ajaxurl, { 'action': 'martanian_oak_house_demo_importer' }, function( response ) {

            message_box.html( response );

        });

    });

   /**
    *
    * end of file.
    *
    */

});