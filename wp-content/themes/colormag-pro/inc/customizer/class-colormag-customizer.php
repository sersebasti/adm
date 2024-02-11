<?php
/**
 * ColorMag customizer class for theme customize options.
 *
 * Class ColorMag_Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the customizer framework files.
require( dirname( __FILE__ ) . '/core/class-colormag-customizer-framework.php' );
require( dirname( __FILE__ ) . '/core/class-colormag-customize-base-option.php' );

/**
 * ColorMag customizer class.
 *
 * Class ColorMag_Customizer
 */
class ColorMag_Customizer {

	public function __construct() {

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_register' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ), 1 );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {

		// Override default.
		require COLORMAG_CUSTOMIZER_DIR . '/override-defaults.php';

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the required customize partials file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-partials.php';

		// Include the required customize section and panels register file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-register-sections-panels.php';

		/**
		 * Include the required customize options file.
		 */
		// Global.
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-colors-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-background-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-typography-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-layout-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-button-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/global/class-colormag-customize-widget-options.php';

		// Front Page.
		require COLORMAG_CUSTOMIZER_DIR . '/options/front-page/class-colormag-customize-front-page-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/front-page/class-colormag-customize-front-page-widget-options.php';

		// Header.
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-site-identity-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-header-media-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-header-top-bar-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-primary-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-primary-menu-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-sticky-header-options.php';

		// Content.
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-blog-archive-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-single-post-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-post-meta-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-page-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/content/class-colormag-customize-sidebar-options.php';

		// Additional.
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-additional-general-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-social-icons-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-integrations-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-optimization-options.php';

		// Footer.
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-general-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-widgets-area-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-bottom-bar-options.php';

		// WooCommerce.
		require COLORMAG_CUSTOMIZER_DIR . '/options/woocommerce/class-colormag-customize-woocommerce-sidebar-options.php';
	}

}

return new ColorMag_Customizer();
