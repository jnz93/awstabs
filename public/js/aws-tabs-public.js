(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function filterByFlag( el ){
	let selectedValue = el.val(),
		trs = jQuery('.table-credit-cards tbody tr');
	console.log(selectedValue)
	console.log(trs);

	trs.each(function() {
		if( selectedValue == ''  ){
			jQuery(this).removeClass('d-none');
		} else if( selectedValue == jQuery(this).attr('data-flag') ){
			jQuery(this).removeClass('d-none');
		} else {
			jQuery(this).addClass('d-none');
		}
	});
}


function filterByIssuer( el ){
	let selectedValue = el.val(),
		trs = jQuery('.table-credit-cards tbody tr');

	trs.each(function() {
		if( selectedValue == ''  ){
			jQuery(this).removeClass('d-none');
		} else if( selectedValue == jQuery(this).attr('data-issuer') ){
			jQuery(this).removeClass('d-none');
		} else {
			jQuery(this).addClass('d-none');
		}
	});
}

function filterBySegment( el ){
	let selectedValue = el.val(),
		trs = jQuery('.table-credit-cards tbody tr');

	trs.each(function() {
		if( selectedValue == ''  ){
			jQuery(this).removeClass('d-none');
		} else if( selectedValue == jQuery(this).attr('data-segment') ){
			jQuery(this).removeClass('d-none');
		} else {
			jQuery(this).addClass('d-none');
		}
	});
}

jQuery(document).ready( function(){
	jQuery('#card-flag').change( function(){
		filterByFlag( jQuery(this) );
	});

	jQuery('#card-issuer').change( function (){
		filterByIssuer( jQuery(this) );
	})

	jQuery('#card-segment').change( function (){
		filterBySegment( jQuery(this) );
	})
});