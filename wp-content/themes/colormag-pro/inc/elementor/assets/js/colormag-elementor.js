/**
 * ColorMag Custom Elementor JS settings.
 */
(
	function ( $ ) {

		// Trending News JS settings.
		var ColorMagPostsTrendingNewsHandle = function ( $scope, $ ) {

			// Load only if Swiper is not loaded.
			if ( typeof Swiper !== 'undefined' ) {

				var trending_news_selector = $scope.find( '.tg-trending-news' );

				var trending_news_swiper = new Swiper(
					trending_news_selector,
					{
						speed      : parseInt( trending_news_selector.attr( 'data-speed' ) ),
						delay      : parseInt( trending_news_selector.attr( 'data-transition-time' ) ),
						loop       : true,
						autoplay   : true,
						navigation : {
							nextEl : '.swiper-button-next',
							prevEl : '.swiper-button-prev',
						},
					}
				);

			}

		};

		// Grid 7 JS settings.
		var ColorMagPostsGrid7Handle = function ( $scope, $ ) {

			// Load only if Swiper is not loaded.
			if ( typeof Swiper !== 'undefined' ) {

				var grid_7_selector       = $scope.find( '.tg-module-grid--style-7 .swiper-container' );
				var grid_7_autoplay       = grid_7_selector.attr( 'data-autoplay' );
				var grid_7_autoplay_value = (
					grid_7_autoplay === 'true'
				) ? true : false;

				var grid_7_swiper = new Swiper(
					grid_7_selector,
					{
						speed      : parseInt( grid_7_selector.attr( 'data-speed' ) ),
						delay      : parseInt( grid_7_selector.attr( 'data-transition-time' ) ),
						loop       : true,
						navigation : {
							nextEl : '.swiper-button-next',
							prevEl : '.swiper-button-prev',
						},
						autoplay   : grid_7_autoplay_value
					}
				);

				// Pause autoplay on hover.
				var grid_7_pause_on_hover       = grid_7_selector.attr( 'data-pause_on_hover' );
				var grid_7_pause_on_hover_value = (
					grid_7_pause_on_hover === 'true'
				) ? true : false;

				if ( grid_7_pause_on_hover_value ) {
					grid_7_selector.on(
						{
							mouseenter : function () {
								grid_7_swiper.autoplay.stop();
							},

							mouseleave : function () {
								grid_7_swiper.autoplay.start();
							}
						}
					);
				}

			}

		};

		$( window ).on(
			'elementor/frontend/init',
			function () {

				// JS hook for Trending News element.
				elementorFrontend.hooks.addAction( 'frontend/element_ready/ColorMag-Posts-Trending-News.default', ColorMagPostsTrendingNewsHandle );

				// JS hook for Grid 7 element.
				elementorFrontend.hooks.addAction( 'frontend/element_ready/ColorMag-Posts-Grid-7.default', ColorMagPostsGrid7Handle );

			}
		);

	}
)( jQuery );
