(function($) {

	function setupLayout() {

		$('body').addClass('js');

		$('#loading').html('<span>Loading...</span>');

	}

	$(document).ready( function() {
		setupLayout();
	});


	$(window).load( function() {
		$('#loading').hide();
	});

	$(window).resize( function() {
	});


})(jQuery);