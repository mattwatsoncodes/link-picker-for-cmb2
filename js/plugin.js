jQuery( document ).ready( function( $ ) {

	/* Open the Link Window*/

	var url   = $( 'body' );
	var text  = $( 'body' );
	var blank = $( 'body' );

	$( 'body' ).on( 'click', '.js-insert-link', function( event ) {
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();
		url            = $( this ).closest( '.link-picker' ).find( 'input.cmb_text_url' );
		text           = $( this ).closest( '.link-picker' ).find( 'input.cmb_text' );
		blank          = $( this ).closest( '.link-picker' ).find( 'input.cmb_checkbox' );
		wpActiveEditor = 'mkdo_lpfc_placeholder';
		wpLink.open( 'mkdo_lpfc_placeholder' );
		wpLink.textarea = url;

		return false;
	} );

	$( 'body' ).on( 'click', '#wp-link-cancel, #wp-link-backdrop, #wp-link-close', function( event ) {
		wpLink.textarea = url;
		wpLink.close();
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();
		return false;
	} );

	$( 'body' ).on( 'click', '#wp-link-submit', function( event ) {

		var linkAtts = wpLink.getAttrs();
		linkAtts.text = $( '#wp-link-text' ).val();
		url.val( linkAtts.href );

		if ( linkAtts.text != '' ) {
			text.val( linkAtts.text );
		}

		if ( linkAtts.target == '_blank' ) {
			blank.prop( 'checked', true );
		} else {
			blank.prop( 'checked', false );
		}

		wpLink.textarea = url;
		wpLink.close();
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();
		return false;
	} );

	/* Deal with columns and sizes */

    function adjust_element_size() {
		$( '.link-picker div' ).attr( 'style','' );
		$( '.cmb-type-link-picker' ).each( function() {
			url       = $( this ).find( 'input.cmb_text_url' );
			container = $( this ).find( '.link-picker' );
			if( url.width() < 150 ) {
				container.find( 'div' ).each( function() {
						$( this ).css( 'width', '50%' );
					}
				);
			}
		} );
    }

    // Execute on load
    adjust_element_size();

    // Bind event listener
    $( window ).resize( adjust_element_size );
});
