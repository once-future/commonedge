(function($) {

	var scrollTimer = null;
	var fixedNavVisible = false;
	var fullyLoaded = false;
	var menuopen = false;
	var wasDesktop = true;

	function handleResize() {

		console.log('handleResize');

		displayFixedNav();

		if ( wasDesktop == true ) {

			console.log('1');

			menuopen = false;

			if ( isMobile() ) {

				console.log('2');

				wasDesktop = false;

				$('.fixedheader nav').hide();
				$('.fixedheader .hamburger').removeClass('selected');

			} else {

				console.log('3');

				$('.fixedheader nav').show();

			}

		} else {

			console.log('4');

			if( !isMobile() ) {

				console.log('5');

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
		if ( $(".homepageresponsivecue").css("float") == "right" ) {
			console.log('mobile');
			return true;
		} else {
			console.log('no mobile');
			return false;
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
