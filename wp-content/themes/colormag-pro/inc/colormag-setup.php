<?php
/**
 * Setup ColorMag required setup hooks.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_setup' ) ) :

	/**
	 * All theme setup functionalities.
	 *
	 * @since 1.0
	 */
	function colormag_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'colormag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support( 'post-thumbnails' );

		// Registering navigation menu.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'colormag' ),
				'footer'  => esc_html__( 'Footer Menu', 'colormag' ),
				'top-bar' => esc_html__( 'Top Bar Menu', 'colormag' ),
			)
		);

		// Cropping the images to different sizes to be used in the theme.
		add_image_size( 'colormag-highlighted-post', 392, 272, true );
		add_image_size( 'colormag-featured-post-medium', 390, 205, true );
		add_image_size( 'colormag-featured-post-small', 130, 90, true );
		add_image_size( 'colormag-featured-image', 800, 445, true );

		// Pro required image sizes.
		add_image_size( 'colormag-default-news', 150, 150, true );
		add_image_size( 'colormag-featured-image-large', 1400, 600, true );

		// Setup the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'colormag_custom_background_args',
				array(
					'default-color' => 'eaeaea',
				)
			)
		);

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for Post Formats.
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'chat',
				'audio',
				'status',
			)
		);

		// Adding excerpt option box for pages as well.
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Adds the support for the Custom Logo introduced in WordPress 4.5.
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Support Auto Load Next Post plugin.
		add_theme_support(
			'auto-load-next-post',
			array(
				'content_container'    => '#content',
				'title_selector'       => 'h1.entry-title',
				'navigation_container' => 'ul.default-wp-page',
				'comments_container'   => 'div#comments',
			)
		);

		// Support for selective refresh widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg layout support.
		add_theme_support( 'align-wide' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Responsive embeds support.
		add_theme_support( 'responsive-embeds' );

	}

endif;

add_action( 'after_setup_theme', 'colormag_setup' );
