(function($) {

	function setupHeaderSpacer() {

		var headerspacer = 0;
		var fixedheader = $('.fixedheader');
		headerspacer += fixedheader.outerHeight();

		if ($('#wpadminbar').length != 0) {
			var adminbarheight = $('#wpadminbar').outerHeight();
			fixedheader.css('top', adminbarheight + 'px');
			headerspacer += adminbarheight;
		}

		$('.headerspacer').css('height', headerspacer + 'px');

	}

	$(document).ready( function() {
		setupHeaderSpacer();
	});

	$(document).load( function() {
		setupHeaderSpacer();
	});

})(jQuery);