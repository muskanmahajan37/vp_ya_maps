var $ = jQuery.noConflict();
$(document).ready(function($) {
    /***** Colour picker *****/

    $('.colorpicker').hide();
    $('.colorpicker').each( function() {
        $(this).farbtastic( $(this).closest('.color-picker').find('.color') );
    });

    $('.color').click(function() {
        $(this).closest('.color-picker').find('.colorpicker').fadeIn();
    });

    $(document).mousedown(function() {
        $('.colorpicker').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
    });


    /***** Uploading images *****/

    var file_frame;

    $.fn.uploadMediaFile = function( button, preview_media ) {
        var button_id = button.attr('id');
        var field_id = button_id.replace( '_button', '' );
        var preview_id = button_id.replace( '_button', '_preview' );

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
                text: $( this ).data( 'uploader_button_text' ),
            },
            multiple: false
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $("#"+field_id).val(attachment.id);
            if( preview_media ) {
                $("#"+preview_id).attr('src',attachment.sizes.thumbnail.url);
            }
        });

        // Finally, open the modal
        file_frame.open();
    }

    $('.image_upload_button').click(function() {
        $.fn.uploadMediaFile( $(this), true );
    });

    $('.image_delete_button').click(function() {
        $(this).closest('td').find( '.image_data_field' ).val( '' );
        $( '.image_preview' ).remove();
        return false;
    });


    /***** Navigation for settings page *****/

        // Make sure each heading has a unique ID.
    $( 'ul#settings-sections.subsubsub' ).find( 'a' ).each( function ( i ) {
        var id_value = $( this ).attr( 'href' ).replace( '#', '' );
        $( 'h3:contains("' + $( this ).text() + '")' ).attr( 'id', id_value ).addClass( 'section-heading' );
    });

    // Create nav links for settings page
    $( '#plugin_settings .subsubsub a.tab' ).click( function ( e ) {
        // Move the "current" CSS class.
        $( this ).parents( '.subsubsub' ).find( '.current' ).removeClass( 'current' );
        $( this ).addClass( 'current' );

        // If "All" is clicked, show all.
        if ( $( this ).hasClass( 'all' ) ) {
            $( '#plugin_settings h3, #plugin_settings form p, #plugin_settings table.form-table, p.submit' ).show();

            return false;
        }

        // If the link is a tab, show only the specified tab.
        var toShow = $( this ).attr( 'href' );

        // Remove the first occurance of # from the selected string (will be added manually below).
        toShow = toShow.replace( '#', '', toShow );

        $( '#plugin_settings h3, #plugin_settings form > p:not(".submit"), #plugin_settings table' ).hide();
        $( 'h3#' + toShow ).show().nextUntil( 'h3.section-heading', 'p, table, table p' ).show();

        return false;
    });
});