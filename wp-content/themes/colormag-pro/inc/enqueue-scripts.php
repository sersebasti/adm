<?php
/**
 * ColorMag enqueue CSS and JS files.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue CSS and JS files.
 */
function colormag_scripts_styles_method() {

	// Return if enqueueing is not enabled by the user.
	if ( false === apply_filters( 'colormag_enqueue_theme_assets', true ) ) {
		return;
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Loads our main stylesheet.
	wp_enqueue_style( 'colormag_style', get_stylesheet_uri(), array(), COLORMAG_THEME_VERSION );
	wp_style_add_data( 'colormag_style', 'rtl', 'replace' );

	// Load the dark color skin via theme options.
	if ( 'dark' == get_theme_mod( 'colormag_color_skin_setting', 'white' ) ) {
		wp_enqueue_style( 'colormag_dark_style', get_template_directory_uri() . '/dark.css', array(), COLORMAG_THEME_VERSION );
	}

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// BxSlider JS.
	wp_register_script( 'colormag-bxslider', COLORMAG_JS_URL . '/jquery.bxslider' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// Related post carousel.
	if ( 'style_four' == get_theme_mod( 'colormag_related_posts_layout', 'style_one' ) ) {
		wp_enqueue_script( 'colormag-bxslider' );
	}

	// Sticky Menu.
	if ( 1 == get_theme_mod( 'colormag_primary_sticky_menu', 0 ) ) {
		// Sticky JS enqueue.
		if ( 'sticky' == get_theme_mod( 'colormag_primary_sticky_menu_type', 'sticky' ) ) {
			wp_enqueue_script( 'colormag-sticky-menu', COLORMAG_JS_URL . '/sticky/jquery.sticky' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
		} elseif ( 'reveal_on_scroll' == get_theme_mod( 'colormag_primary_sticky_menu_type', 'sticky' ) ) {
			// Headroomjs enqueue.
			wp_enqueue_script( 'Headroom', COLORMAG_JS_URL . '/headroom/Headroom' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );
			wp_enqueue_script( 'jQuery-headroom', COLORMAG_JS_URL . '/headroom/jQuery.headroom' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
		}
	}

	// News Ticker.
	wp_register_script( 'colormag-news-ticker', COLORMAG_JS_URL . '/news-ticker/jquery.newsTicker' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
	if ( 1 == get_theme_mod( 'colormag_breaking_news', 0 ) ) {
		wp_enqueue_script( 'colormag-news-ticker' );
	}

	// MagnificPopup JS.
	wp_register_script( 'colormag-featured-image-popup', COLORMAG_JS_URL . '/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// MagnificPopup CSS.
	wp_register_style( 'colormag-featured-image-popup-css', COLORMAG_JS_URL . '/magnific-popup/magnific-popup' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

	if ( ( 1 == get_theme_mod( 'colormag_featured_image_popup', 0 ) ) && ( is_single() || is_page() ) ) {
		wp_enqueue_script( 'colormag-featured-image-popup' );
		wp_enqueue_style( 'colormag-featured-image-popup-css' );
	}

	// EasyTabs JS.
	wp_register_script( 'colormag-easy-tabs', COLORMAG_JS_URL . '/easytabs/jquery.easytabs' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// Navigation JS.
	wp_enqueue_script( 'colormag-navigation', COLORMAG_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// FontAwesome CSS.
	wp_enqueue_style( 'colormag-fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

	// Weather Icons.
	wp_register_style( 'owfont', get_template_directory_uri() . '/css/owfont-regular' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

	// FitVids JS.
	wp_enqueue_script( 'colormag-fitvids', COLORMAG_JS_URL . '/fitvids/jquery.fitvids' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// jQuery Video JS.
	wp_register_script( 'jquery-video', COLORMAG_JS_URL . '/jquery.video' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// HTML5Shiv for Lower IE versions.
	wp_enqueue_script( 'html5', COLORMAG_JS_URL . '/html5shiv' . $suffix . '.js', array(), COLORMAG_THEME_VERSION );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

	// Theia Sticky Sidebar enqueue.
	if ( 1 == get_theme_mod( 'colormag_sticky_content_sidebar', 0 ) ) {
		wp_enqueue_script( 'theia-sticky-sidebar', COLORMAG_JS_URL . '/theia-sticky-sidebar/theia-sticky-sidebar' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
		wp_enqueue_script( 'ResizeSensor', COLORMAG_JS_URL . '/theia-sticky-sidebar/ResizeSensor' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
	}

	// prognroll JS enqueue.
	if ( 1 == get_theme_mod( 'colormag_prognroll_indicator', 0 ) && is_single() ) {
		wp_enqueue_script( 'prognroll', COLORMAG_JS_URL . '/prognroll/prognroll' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
	}

	// Enqueue the Google Maps API key if it exits.
	$google_maps_api_key = get_theme_mod( 'colormag_googlemap_api_key' );
	if ( $google_maps_api_key ) {
		wp_enqueue_script( 'GoogleMaps', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ), array(), COLORMAG_THEME_VERSION, true );
	}

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'colormag-skip-link-focus-fix', COLORMAG_JS_URL . '/skip-link-focus-fix' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );

	// Theme custom JS.
	wp_enqueue_script( 'colormag-custom', COLORMAG_JS_URL . '/colormag-custom' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// Theme reveal image on scroll JS.
	if ( 1 === get_theme_mod( 'colormag_enable_smooth_image_loading', 0 ) ) {

		wp_enqueue_script( 'colormag-reveal-on-scroll', COLORMAG_JS_URL . '/colormag-reveal-on-scroll' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

		$image_loading_styles = get_theme_mod( 'colormag_smooth_image_loading_animation', 'fade-in' );

		if ( in_array( $image_loading_styles, array( 'fade-in', 'fade-in-down', 'fade-in-up' ), true ) ) {
			wp_localize_script( 'colormag-reveal-on-scroll', 'imageStyle', array( $image_loading_styles ) );
		}
	}

	if ( 1 == get_theme_mod( 'colormag_breaking_news', 0 ) ) {
		$breaking_news_slide_effect = get_theme_mod( 'colormag_breaking_news_setting_animation_options', 'down' );
		$breaking_news_duration     = get_theme_mod( 'colormag_breaking_news_duration_setting_options', 4 );
		$breaking_news_speed        = get_theme_mod( 'colormag_breaking_news_speed_setting_options', 1 );

		$breaking_news_duration = intval( $breaking_news_duration );
		$breaking_news_speed    = intval( $breaking_news_speed );

		if ( 0 != $breaking_news_duration ) {
			$breaking_news_duration = $breaking_news_duration * 1000;
		} else {
			$breaking_news_duration = 4000;
		}

		if ( 0 != $breaking_news_speed ) {
			$breaking_news_speed = $breaking_news_speed * 1000;
		} else {
			$breaking_news_speed = 1000;
		}

		wp_localize_script(
			'colormag-custom',
			'colormag_ticker_settings',
			array(
				'breaking_news_slide_effect' => $breaking_news_slide_effect,
				'breaking_news_duration'     => $breaking_news_duration,
				'breaking_news_speed'        => $breaking_news_speed,
			)
		);
	}

	if ( 1 == get_theme_mod( 'colormag_prognroll_indicator', 0 ) && is_single() ) {
		$progress_bar_bgcolor = get_theme_mod( 'colormag_progress_bar_bgcolor', '#222222' );
		wp_localize_script(
			'colormag-custom',
			'colormag_progress_bar_bgcolor',
			array(
				'bg_color' => $progress_bar_bgcolor,
			)
		);
	}

	// Enqueue bxslider if post has gallery post format.
	if ( has_post_format( 'gallery' ) || is_home() || is_search() || is_archive() ) {
		wp_enqueue_script( 'colormag-bxslider' );
	}

	/**
	 * Inline CSS for this theme.
	 */
	add_filter( 'colormag_dynamic_theme_css', array( 'ColorMag_Dynamic_CSS', 'render_output' ) );

	// Enqueue required Google font for the theme.
	ColorMag_Generate_Fonts::render_fonts();

	// Generate dynamic CSS to add inline styles for the theme.
	$theme_dynamic_css = apply_filters( 'colormag_dynamic_theme_css', '' );
	wp_add_inline_style( 'colormag_style', $theme_dynamic_css );

}

add_action( 'wp_enqueue_scripts', 'colormag_scripts_styles_method' );


/**
 * Enqueue block editor styles.
 *
 * @since ColorMag 2.4.6
 */
function colormag_block_editor_styles() {

	wp_enqueue_style( 'colormag-editor-googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600', array(), COLORMAG_THEME_VERSION );
	wp_enqueue_style( 'colormag-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css', array(), COLORMAG_THEME_VERSION );
	wp_style_add_data( 'colormag-block-editor-styles', 'rtl', 'replace' );

}

add_action( 'enqueue_block_editor_assets', 'colormag_block_editor_styles', 1, 1 );


/**
 * Action hook to get the required Google fonts for this theme.
 */
function colormag_get_fonts() {

	/**
	 * Header options.
	 */
	$site_title_typography_default   = array(
		'font-family' => 'default',
	);
	$site_tagline_typography_default = array(
		'font-family' => 'default',
	);
	$primary_menu_typography_default = array(
		'font-family' => 'default',
		'font-weight' => '600',
	);
	$site_title_typography           = get_theme_mod( 'colormag_site_title_typography_setting', $site_title_typography_default );
	$site_tagline_typography         = get_theme_mod( 'colormag_site_tagline_typography_setting', $site_tagline_typography_default );
	$primary_menu_typography         = get_theme_mod( 'colormag_primary_menu_typography_setting', $primary_menu_typography_default );


	/**
	 * Global.
	 */

	$button_typography_default = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);
	$button_typography         = get_theme_mod( 'colormag_button_typography_setting', $button_typography_default );


	/**
	 * Typography options.
	 */
	$base_typography_default       = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);
	$headings_typography_default   = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);
	$heading_h1_typography_default = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);
	$heading_h2_typography_default = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);
	$heading_h3_typography_default = array(
		'font-family' => 'default',
		'font-weight' => 'regular',
	);

	$base_typography       = get_theme_mod( 'colormag_base_typography_setting', $base_typography_default );
	$headings_typography   = get_theme_mod( 'colormag_headings_typography_setting', $headings_typography_default );
	$heading_h1_typography = get_theme_mod( 'colormag_h1_typography_setting', $heading_h1_typography_default );
	$heading_h2_typography = get_theme_mod( 'colormag_h2_typography_setting', $heading_h2_typography_default );
	$heading_h3_typography = get_theme_mod( 'colormag_h3_typography_setting', $heading_h3_typography_default );

	/**
	 * Enqueue required Google fonts.
	 */
	// Header options.
	if ( 'default' === $site_title_typography['font-family'] ) {
		$site_title_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $site_tagline_typography['font-family'] ) {
		$site_tagline_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $primary_menu_typography['font-family'] ) {
		$primary_menu_typography['font-family'] = 'Open Sans';
	}
	ColorMag_Generate_Fonts::add_font( $site_title_typography['font-family'] );
	ColorMag_Generate_Fonts::add_font( $site_tagline_typography['font-family'] );
	ColorMag_Generate_Fonts::add_font( $primary_menu_typography['font-family'], $primary_menu_typography['font-weight'] );

	// Global.
	if ( 'default' === $button_typography['font-family'] ) {
		$button_typography['font-family'] = 'Open Sans';
	}
	ColorMag_Generate_Fonts::add_font( $button_typography['font-family'], $button_typography['font-weight'] );

	// Typography options.
	if ( 'default' === $base_typography['font-family'] ) {
		$base_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $headings_typography['font-family'] ) {
		$headings_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $heading_h1_typography['font-family'] ) {
		$heading_h1_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $heading_h2_typography['font-family'] ) {
		$heading_h2_typography['font-family'] = 'Open Sans';
	}
	if ( 'default' === $heading_h3_typography['font-family'] ) {
		$heading_h3_typography['font-family'] = 'Open Sans';
	}
	ColorMag_Generate_Fonts::add_font( $base_typography['font-family'], $base_typography['font-weight'] );
	ColorMag_Generate_Fonts::add_font( $headings_typography['font-family'], $headings_typography['font-weight'] );
	ColorMag_Generate_Fonts::add_font( $heading_h1_typography['font-family'], $heading_h1_typography['font-weight'] );
	ColorMag_Generate_Fonts::add_font( $heading_h2_typography['font-family'], $heading_h2_typography['font-weight'] );
	ColorMag_Generate_Fonts::add_font( $heading_h3_typography['font-family'], $heading_h3_typography['font-weight'] );
}

add_action( 'colormag_get_fonts', 'colormag_get_fonts' );


/**
 * Filter hook to get the required Google font subsets for this theme.
 */
function colormag_font_subset() {

	$google_font_subsets = array();

	// Button.
	$button_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$button_typography         = get_theme_mod( 'colormag_button_typography_setting', $button_typography_default );

	if ( isset( $button_typography['subsets'] ) && is_array( $button_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $button_typography['subsets'], $google_font_subsets );
	}


	/**
	 * Typography options.
	 */
	// Base typography.
	$base_typography_default = array(
		'subsets' => array( 'latin' ),
	);

	$base_typography = get_theme_mod( 'colormag_base_typography_setting', $base_typography_default );

	if ( isset( $base_typography['subsets'] ) && is_array( $base_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $base_typography['subsets'], $google_font_subsets );
	}

	// Headings typography.
	$headings_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$headings_typography         = get_theme_mod( 'colormag_headings_typography_settings', $headings_typography_default );

	if ( isset( $headings_typography['subsets'] ) && is_array( $headings_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $headings_typography['subsets'], $google_font_subsets );
	}

	// Heading H1 typography.
	$heading_h1_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h1_typography         = get_theme_mod( 'colormag_h1_typography_setting', $heading_h1_typography_default );

	if ( isset( $heading_h1_typography['subsets'] ) && is_array( $heading_h1_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h1_typography['subsets'], $google_font_subsets );
	}

	// Heading H2 typography.
	$heading_h2_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h2_typography         = get_theme_mod( 'colormag_h2_typography_setting', $heading_h2_typography_default );

	if ( isset( $heading_h2_typography['subsets'] ) && is_array( $heading_h2_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h2_typography['subsets'], $google_font_subsets );
	}

	// Heading H3 typography.
	$heading_h3_typography_default = array(
		'subsets' => array( 'latin' ),
	);
	$heading_h3_typography         = get_theme_mod( 'colormag_h3_typography_setting', $heading_h3_typography_default );

	if ( isset( $heading_h3_typography['subsets'] ) && is_array( $heading_h3_typography['subsets'] ) ) {
		$google_font_subsets = array_merge( $heading_h3_typography['subsets'], $google_font_subsets );
	}

	return $google_font_subsets;
}

add_filter( 'colormag_font_subset', 'colormag_font_subset' );


/**
 * Enqueue image upload script for use within widgets.
 */
function colormag_image_uploader() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_media();
	wp_enqueue_script( 'colormag-widget-image-upload', COLORMAG_JS_URL . '/image-uploader' . $suffix . '.js', false, COLORMAG_THEME_VERSION, true );

}

add_action( 'admin_enqueue_scripts', 'colormag_image_uploader' );


if ( ! function_exists( 'colormag_darkcolor' ) ) :

	/**
	 * Generate darker color
	 *
	 * @param string $hex   Hex color value.
	 * @param string $steps Steps to change the hex color value for equivalent dark color.
	 *
	 * @return string
	 */
	function colormag_darkcolor( $hex, $steps ) {

		// Steps should be between -255 and 255. Negative = darker, positive = lighter.
		$steps = max( -255, min( 255, $steps ) );

		// Normalize into a six character long hex string.
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B.
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {

			// Convert to decimal.
			$color = hexdec( $color );

			// Adjust the color.
			$color = max( 0, min( 255, $color + $steps ) );

			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code.

		}

		return $return;

	}

endif;

if ( ! function_exists( 'colormag_parse_css' ) ) :

	/**
	 * Parses CSS.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param array        $css_output    Array of CSS.
	 * @param string       $min_media     Min Media breakpoint.
	 * @param string       $max_media     Max Media breakpoint.
	 *
	 * @return string Generated CSS.
	 */
	function colormag_parse_css( $default_value, $output_value, $css_output = array(), $min_media = '', $max_media = '' ) {

		// Return if default value matches.
		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( null === $properties ) {
					break;
				}

				if ( ! count( $properties ) ) {
					continue;
				}

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue;
					}

					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' !== $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}

				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}

				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;

			}
		}

		return $parse_css;

	}

endif;

if ( ! function_exists( 'colormag_parse_background_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 *
	 * @return string|void Generated CSS for background CSS property.
	 */
	function colormag_parse_background_css( $default_value, $output_value, $selector ) {

		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		$parse_css .= $selector . '{';

		// For background color.
		if ( isset( $output_value['background-color'] ) && ( $output_value['background-color'] != $default_value['background-color'] ) ) {
			$parse_css .= 'background-color:' . $output_value['background-color'] . ';';
		}

		// For background image.
		if ( isset( $output_value['background-image'] ) && ( $output_value['background-image'] != $default_value['background-image'] ) ) {
			$parse_css .= 'background-image:url(' . $output_value['background-image'] . ');';
		}

		// For background position.
		if ( isset( $output_value['background-position'] ) && ( $output_value['background-position'] != $default_value['background-position'] ) ) {
			$parse_css .= 'background-position:' . $output_value['background-position'] . ';';
		}

		// For background size.
		if ( isset( $output_value['background-size'] ) && ( $output_value['background-size'] != $default_value['background-size'] ) ) {
			$parse_css .= 'background-size:' . $output_value['background-size'] . ';';
		}

		// For background attachment.
		if ( isset( $output_value['background-attachment'] ) && ( $output_value['background-attachment'] != $default_value['background-attachment'] ) ) {
			$parse_css .= 'background-attachment:' . $output_value['background-attachment'] . ';';
		}

		// For background repeat.
		if ( isset( $output_value['background-repeat'] ) && ( $output_value['background-repeat'] != $default_value['background-repeat'] ) ) {
			$parse_css .= 'background-repeat:' . $output_value['background-repeat'] . ';';
		}

		$parse_css .= '}';

		return $parse_css;

	}

endif;

if ( ! function_exists( 'colormag_parse_typography_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 * @param array        $devices       Devices for breakpoints.
	 *
	 * @return string|void Generated CSS for typography CSS.
	 */
	function colormag_parse_typography_css( $default_value, $output_value, $selector, $devices = array() ) {

		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		$parse_css .= $selector . '{';

		// For font family.
		if ( isset( $output_value['font-family'] ) && ( $output_value['font-family'] != $default_value['font-family'] ) ) {
			$parse_css .= 'font-family:' . $output_value['font-family'] . ';';
		}

		// For font style.
		if ( isset( $output_value['font-style'] ) && ( $output_value['font-style'] != $default_value['font-style'] ) ) {
			$parse_css .= 'font-style:' . $output_value['font-style'] . ';';
		}

		// For text transform.
		if ( isset( $output_value['text-transform'] ) && ( $output_value['text-transform'] != $default_value['text-transform'] ) ) {
			$parse_css .= 'text-transform:' . $output_value['text-transform'] . ';';
		}

		// For text decoration.
		if ( isset( $output_value['text-decoration'] ) && ( $output_value['text-decoration'] != $default_value['text-decoration'] ) ) {
			$parse_css .= 'text-decoration:' . $output_value['text-decoration'] . ';';
		}

		// For font weight.
		if ( isset( $output_value['font-weight'] ) && ( $output_value['font-weight'] != $default_value['font-weight'] ) ) {
			$font_weight_value = $output_value['font-weight'];

			if ( 'italic' === $font_weight_value || 'regular' === $font_weight_value ) {
				$parse_css .= 'font-weight:' . 400 . ';';
			} else {
				$parse_css .= 'font-weight:' . str_replace( 'italic', '', $font_weight_value ) . ';';
			}
		}

		// For font size on desktop.
		if ( isset( $output_value['font-size']['desktop'] ) && ( $output_value['font-size']['desktop'] != $default_value['font-size']['desktop'] ) ) {
			$parse_css .= 'font-size:' . $output_value['font-size']['desktop'] . 'px;';
		}

		// For line height on desktop.
		if ( isset( $output_value['line-height']['desktop'] ) && ( $output_value['line-height']['desktop'] != $default_value['line-height']['desktop'] ) ) {
			$parse_css .= 'line-height:' . $output_value['line-height']['desktop'] . ';';
		}

		// For letter spacing on desktop.
		if ( isset( $output_value['letter-spacing']['desktop'] ) && ( $output_value['letter-spacing']['desktop'] != $default_value['letter-spacing']['desktop'] ) ) {
			$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['desktop'] . 'px;';
		}

		$parse_css .= '}';

		// For responsive devices.
		if ( is_array( $devices ) ) {

			foreach ( $devices as $device => $size ) {

				// For tablet devices.
				if ( 'tablet' === $device && $size ) {
					if ( ( isset( $output_value['font-size']['tablet'] ) && $output_value['font-size']['tablet'] ) || ( isset( $output_value['line-height']['tablet'] ) && $output_value['line-height']['tablet'] ) || ( isset( $output_value['letter-spacing']['tablet'] ) && $output_value['letter-spacing']['tablet'] ) ) {
						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';

						// For font size on tablet.
						if ( isset( $output_value['font-size']['tablet'] ) && ( $output_value['font-size']['tablet'] != $default_value['font-size']['tablet'] ) ) {
							$parse_css .= 'font-size:' . $output_value['font-size']['tablet'] . 'px;';
						}

						// For line height on tablet.
						if ( isset( $output_value['line-height']['tablet'] ) && ( $output_value['line-height']['tablet'] != $default_value['line-height']['tablet'] ) ) {
							$parse_css .= 'line-height:' . $output_value['line-height']['tablet'] . ';';
						}

						// For letter spacing on tablet.
						if ( isset( $output_value['letter-spacing']['tablet'] ) && ( $output_value['letter-spacing']['tablet'] != $default_value['letter-spacing']['tablet'] ) ) {
							$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['tablet'] . 'px;';
						}

						$parse_css .= '}';
						$parse_css .= '}';
					}
				}

				// For mobile devices.
				if ( 'mobile' === $device && $size ) {
					if ( ( isset( $output_value['font-size']['mobile'] ) && $output_value['font-size']['mobile'] ) || ( isset( $output_value['line-height']['mobile'] ) && $output_value['line-height']['mobile'] ) || ( isset( $output_value['letter-spacing']['mobile'] ) && $output_value['letter-spacing']['mobile'] ) ) {
						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';

						// For font size on mobile.
						if ( isset( $output_value['font-size']['mobile'] ) && ( $output_value['font-size']['mobile'] != $default_value['font-size']['mobile'] ) ) {
							$parse_css .= 'font-size:' . $output_value['font-size']['mobile'] . 'px;';
						}

						// For line height on mobile.
						if ( isset( $output_value['line-height']['mobile'] ) && ( $output_value['line-height']['mobile'] != $default_value['line-height']['mobile'] ) ) {
							$parse_css .= 'line-height:' . $output_value['line-height']['mobile'] . ';';
						}

						// For letter spacing on mobile.
						if ( isset( $output_value['letter-spacing']['mobile'] ) && ( $output_value['letter-spacing']['mobile'] != $default_value['letter-spacing']['mobile'] ) ) {
							$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['mobile'] . 'px;';
						}

						$parse_css .= '}';
						$parse_css .= '}';
					}
				}
			}
		}

		return $parse_css;

	}

endif;
