(function($) {

	var scrollTimer = null;
	var resizeTimer = null;
	var fixedNavVisible = false;

	jQuery.fn.isScrolledIntoView = function () {

		var heightToThis = $(this).offset().top;
		var thisHeight = $(this).height();
		var thisRange = heightToThis + thisHeight;

		var headerHeight = $('.header').outerHeight();

		if ($('#wpadminbar').length != 0) {
			headerHeight = headerHeight + $('#wpadminbar').outerHeight();
		}

		var scrollPosition = $(window).scrollTop() + headerHeight + 1;

		scrollPosition = scrollPosition + 61; // Shim so that titles switch over stripe breaks

		if ( (scrollPosition >= heightToThis ) && (scrollPosition <= thisRange ) ) {
			return true;
		}

	}

	function displayFixedNav() {

		var fixedheader = $('.fixedheader');

		if ( $('.layout').isScrolledIntoView() ) { 
			if ( fixedNavVisible == false ) {
				fixedNavVisible = true;
				fixedheader.fadeIn( 100, function() {
				    // Animation complete
				  });;
			}
		} else {
			if ( fixedNavVisible == true ) {
				fixedNavVisible = false;
				fixedheader.fadeOut( 100, function() {
				    // Animation complete
				  });;
			}
		}
		
	}

	$(document).ready( function() {
		displayFixedNav();


	});

	$(window).load( function() {
		displayFixedNav();
	});

	$(window).resize(function(){
		// Timer increases RAM effiency
		// Resize actions are in handleResize()
	    if (resizeTimer) {
	        clearTimeout(resizeTimer);   // clear any previous pending timer
	    }
	    resizeTimer = setTimeout(displayFixedNav, 1);   // set new timer

	});

	$(window).scroll(function(){
		// Timer increases RAM effiency
		// Resize actions are in handleScroll()

	    if (scrollTimer) {
	        clearTimeout(scrollTimer);   // clear any previous pending timer
	    }
	    scrollTimer = setTimeout(displayFixedNav, 1);   // set new timer

	});

})(jQuery);