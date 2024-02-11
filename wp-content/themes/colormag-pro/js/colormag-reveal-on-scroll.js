var revealImagesOnScroll = ( function() {

	var images = document.querySelectorAll( 'img' );
	var relatedPostFlyout = document.querySelector( '.related-posts-wrapper-flyout' );

	var hideImagesInitially = function() {

		images.forEach( function( el ) {

			if ( ! el.classList.contains( 'tg-image-to-reveal-' + imageStyle[0] ) ) {
				el.classList.add( 'tg-image-to-reveal-' + imageStyle[0] );
			}

			el.isRevealed = false;
		});

		images[images.length - 1].isLastItem = true;
	};

	var events = function() {

		window.addEventListener( 'scroll', revealCaller );
		window.addEventListener( 'load', unHideClonedImages );
	};

	var unHideClonedImages = function() {

		var clonedImages = document.querySelectorAll( '.bx-clone img' );

		clonedImages.forEach( function( el ) {

			if ( el.classList.contains( 'tg-image-to-reveal-' + imageStyle[0] ) ) {
				el.classList.remove( 'tg-image-to-reveal-' + imageStyle[0] );
			}
		});

		revealCaller();
	}

	var revealCaller = function() {

		images.forEach( function( el ) {

			if (  false === el.isRevealed ) {
				revealIfScrolledTo( el );
			}
		});
	}

	var revealIfScrolledTo = function( el ) {

		if ( window.scrollY + window.innerHeight > el.offsetTop ) {

			var scrollPercent = ( el.getBoundingClientRect().top / window.innerHeight ) * 100;

			if ( scrollPercent < 85 ) {

				el.classList.add( 'tg-image-to-reveal-' + imageStyle[0] + '--is-revealed' );
				el.isRevealed = true;

			if ( el.isLastItem ){

				window.removeEventListener( 'load', unHideClonedImages );

				if ( null === relatedPostFlyout  ) {
					window.removeEventListener( 'scroll', revealCaller );
					}
				}
			}
		}
	}

	return {

		init: function() {

			hideImagesInitially();
			events();
		},

	};

}) ();

revealImagesOnScroll.init();
