(function($) {

	var scrollTimer = null;
	var menuopen = false;
	var wasDesktop = true;

	function handleResize() {

		setupHeaderSpacer();

		if ( wasDesktop == true ) {

			menuopen = false;

			if ( isMobile() ) {

				wasDesktop = false;

				$('.fixedheader nav').hide();
				$('.fixedheader .hamburger').removeClass('selected');

			} else {

				$('.fixedheader nav').show();

			}

		} else {
			if( !isMobile() ) {

				wasDesktop = true;
				$('.fixedheader nav').show();

			}
		}

	}

	function isMobile() {
		if ( $(".responsivecue").css("float") == "right" ) { 
			return false;
		} else {
			return true;
		}
	}

	function toggleMenu() {
		if ( isMobile() ) {
			if ( menuopen === false ) {
				$('.fixedheader nav').stop().slideDown(150, function() {
					$('.fixedheader .hamburger').addClass('selected');
					menuopen = true;
				});
			} else {
				$('.fixedheader nav').stop().slideUp(150, function() {
					$('.fixedheader .hamburger').removeClass('selected');
					menuopen = false;
				});
				
			}
		}
	}


	function setupDropcap() {
		$('article main p').first().html(function (i, html) {
		    return html.replace(/^[^a-zA-Z]*([a-zA-Z])/g, '<span class="dropcap">$1</span>');
		});
	}

	function setupHeaderSpacer() {

		if ($('#wpadminbar').length != 0) {
			var adminbarheight = $('#wpadminbar').outerHeight();
			$('.fixedheader').css('top', adminbarheight + 'px');
		}

		var headerspacer = $('.fixedheader h1').outerHeight();
		$('.headerspacer').css('height', headerspacer + 'px');


	}

	$(document).ready( function() {
		handleResize();
		setupDropcap();

		$('.hamburger').on("click", function(event) {
			event.preventDefault();
			toggleMenu();
		});

	});

	$(window).load( function() {
		handleResize();
	});

	$(window).resize(function(){

		handleResize();

	});

	$(window).scroll(function(){

	    if (scrollTimer) {
	        clearTimeout(scrollTimer);   // clear any previous pending timer
	    }
	    scrollTimer = setTimeout(setupHeaderSpacer, 1);   // set new timer

	});

})(jQuery);