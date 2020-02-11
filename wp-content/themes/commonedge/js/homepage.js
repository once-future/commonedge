(function($) {

	var scrollTimer = null;
	var fixedNavVisible = false;
	var fullyLoaded = false;
	var menuopen = false;
	var wasDesktop = true;

	function handleResize() {

		displayFixedNav();

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

	function hasHomeHeader() {
		if ( $(".homeheader").css("display") == "none" ) { 
			return false;
		} else {
			return true;
		}
	}

	function isMobile() {
		if ( $(".responsivecue").css("float") == "right" ) { 
			return false;
		} else {
			return true;
		}
	}

	function toggleFixedMenu() {
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

	function setupHeaderSpacer() {

		var headerspacer = 0;
		headerspacer +=  $('.fixedheader h1').outerHeight();

		if ($('#wpadminbar').length != 0) {
			var adminbarheight = $('#wpadminbar').outerHeight();

			$('.fixedheader').css('top', adminbarheight + 'px');

		}

		if ( hasHomeHeader() ) {
			headerspacer = 0;
		}

		$('.headerspacer').css('height', headerspacer + 'px');

	}

	jQuery.fn.isBelow = function () {

//		var heightToThis = $(this).offset().top;
		var heightToThis = 300;

		if ($('#wpadminbar').length != 0) {
			heightToThis = heightToThis - $('#wpadminbar').outerHeight();
		}

		var scrollPosition = $(window).scrollTop();

		if ( (scrollPosition < heightToThis ) ) {
			return true;
		}

	}

	function displayFixedNav() {

		setupHeaderSpacer();

		if ( fullyLoaded == true ) {

			var fixedheader = $('.fixedheader');

			if ( hasHomeHeader() ) {

				if ( $('.biglogo').isBelow() ) { 
					if ( fixedNavVisible == true ) {
						fixedheader.fadeOut( 100, function() {
						    // Animation complete
							fixedNavVisible = false;
						  });;
					}
				} else {
					if ( fixedNavVisible == false ) {
						fixedheader.fadeIn( 100, function() {
						    // Animation complete
							fixedNavVisible = true;
						  });;
					}
				}

			} else {
				if ( fixedNavVisible == false ) {
					fixedheader.show();
					fixedNavVisible = true;
				}
			}

		}

	}

	$(document).ready( function() {

		handleResize();

		$('.fixedheader .hamburger').on("click", function(event) {
			event.preventDefault();
			toggleFixedMenu();
		});

	});

	$(window).load( function() {
		fullyLoaded = true;
		handleResize();
	});

	$(window).resize(function(){
		handleResize();
	});

	$(window).scroll(function(){
	    if (scrollTimer) {
	        clearTimeout(scrollTimer);   // clear any previous pending timer
	    }
	    scrollTimer = setTimeout(displayFixedNav, 1);   // set new timer

	});

})(jQuery);