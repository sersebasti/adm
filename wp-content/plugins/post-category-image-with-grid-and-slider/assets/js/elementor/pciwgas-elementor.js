( function($) {

	'use strict';

	jQuery(window).on('elementor/frontend/init', function() {

		elementorFrontend.hooks.addAction( 'frontend/element_ready/wp-widget-text.default', pciwgas_elementor_init );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/shortcode.default', pciwgas_elementor_init );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/text-editor.default', pciwgas_elementor_init );

		/* Tabs Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/tabs.default', function( $scope ) {

			if( $scope.find('.pciwgas-cat-slider-main').length >= 1 ) {
				$scope.find('.elementor-tabs-content-wrapper').addClass('pciwgas-elementor-tab-wrap');
			} else {
				$scope.find('.elementor-tabs-content-wrapper').removeClass('pciwgas-elementor-tab-wrap');
			}

			/* Tweak for slick slider */
			$scope.find('.pciwgas-cat-slider-main').each(function( index ) {

				var slider_id = $(this).attr('id');

				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				pciwgas_category_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Accordion Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/accordion.default', function( $scope ) {

			/* Tweak for slick slider */
			$scope.find('.pciwgas-cat-slider-main').each(function( index ) {

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				pciwgas_category_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Toggle Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/toggle.default', function( $scope ) {

			/* Tweak for slick slider */
			$scope.find('.pciwgas-cat-slider-main').each(function( index ) {

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				pciwgas_category_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Post Category Slider Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/wp-widget-pciwgas-cat-slider-shrt.default', function() {
			pciwgas_category_slider_init();
		});
	});

	/**
	 * Initialize Plugin Functionality
	 */
	function pciwgas_elementor_init() {
		pciwgas_category_slider_init();
	}
})(jQuery);