<?php
/**
 * Plugin Name: Post Category Image With Grid and Slider
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/post-category-image-grid-slider/
 * Description: Post Category Image With Grid and Slider plugin allow users to upload  category (taxonomy) image and display in grid and slider view. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport, Essential Plugin
 * Author URI: https://www.essentialplugin.com/wordpress-plugin/post-category-image-grid-slider/
 * Text Domain: post-category-image-with-grid-and-slider
 * Domain Path: languages
 * Version: 1.4.8
 * 
 * @package Post Category Image With Grid and Slider
 * @author Essential Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

 /**
 * Basic plugin definitions
 * 
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */
if( ! defined( 'PCIWGAS_VERSION' ) ) {
	define( 'PCIWGAS_VERSION', '1.4.8' ); // Version of plugin
}
if( ! defined( 'PCIWGAS_WP_VERSION' ) ) {
	define( 'PCIWGAS_WP_VERSION', get_bloginfo('version') ); 
}
if( ! defined( 'PCIWGAS_NAME' ) ) {
	define( 'PCIWGAS_NAME', 'Post Category Image With Grid and Slider' ); // Name of plugin
}
if( ! defined( 'PCIWGAS_URL' ) ) {
	define( 'PCIWGAS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'PCIWGAS_DIR' ) ) {
	define( 'PCIWGAS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'PCIWGAS_PLUGIN_BASE' ) ) {
	define( 'PCIWGAS_PLUGIN_BASE',  plugin_dir_path(__FILE__)); // plugin base
}
if( ! defined( 'PCIWGAS_META_PREFIX' ) ) {
	define( 'PCIWGAS_META_PREFIX',  '_pciwgas_'); // plugin base
}
if( ! defined( 'PCIWGAS_PLUGIN_LINK_UNLOCK' ) ) {
	define( 'PCIWGAS_PLUGIN_LINK_UNLOCK', 'https://www.essentialplugin.com/wordpress-plugin/post-category-image-grid-slider/?utm_source=WP&utm_medium=Post-Category-Image&utm_campaign=Features-PRO#wpos-epb' ); // Plugin link
}
if( ! defined( 'PCIWGAS_PLUGIN_UPGRADE' ) ) {
	define('PCIWGAS_PLUGIN_UPGRADE','https://www.essentialplugin.com/pricing/?utm_source=WP&utm_medium=Post-Category-Image&utm_campaign=Upgrade-PRO#wpos-epb'); // Plugin Check link
}
if( ! defined( 'PCIWGAS_PLUGIN_WELCOME' ) ) {
	define('PCIWGAS_PLUGIN_WELCOME','https://www.essentialplugin.com/pricing/?utm_source=WP&utm_medium=Post-Category-Image&utm_campaign=Welcome-Screen#wpos-epb'); // Plugin Check link
}
if( ! defined( 'PCIWGAS_SITE_LINK' ) ) {
	define('PCIWGAS_SITE_LINK', 'https://www.essentialplugin.com'); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @since 1.0.0
 */
function pciwgas_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$pciwgas_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$pciwgas_lang_dir = apply_filters( 'pciwgas_languages_directory', $pciwgas_lang_dir );
	
	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'post-category-image-with-grid-and-slider' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'post-category-image-with-grid-and-slider', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( PCIWGAS_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'post-category-image-with-grid-and-slider', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'post-category-image-with-grid-and-slider', false, $pciwgas_lang_dir );
	}
}
add_action('plugins_loaded', 'pciwgas_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @since 1.0.0
 */

register_activation_hook( __FILE__, 'pciwgas_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 *
 * @since 1.0.0
 */
function pciwgas_install() {

	// Get settings for the plugin
	$pciwgas_options = get_option( 'pciwgas_options' );

	if( empty( $pciwgas_options ) ) { // Check plugin version option
		
		// Set default settings
		pciwgas_default_settings();
		
		// Update plugin version to option
		update_option( 'pciwgas_plugin_version', '1.0' );
	}

	// Deactivate free version
	if( is_plugin_active('post-category-image-with-grid-and-slider-pro/post-category-image-with-grid-and-slider-pro.php') ) {
		add_action('update_option_active_plugins', 'pciwgas_free_deactivate_pro_version');
	}

	// Add option for solutions & features
	add_option( 'pciwgas_sf_optin', true );
}

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'pciwgas_uninstall');

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @since 1.0.0
 */
function pciwgas_uninstall() {
	// Uninstall functionality
}

/**
 * Deactivate free plugin
 *
 * @since 1.0.0
 */
function pciwgas_free_deactivate_pro_version() {
	deactivate_plugins('post-category-image-with-grid-and-slider-pro/post-category-image-with-grid-and-slider-pro.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @since 1.0.0
 */
function pciwgas_admin_notice() {

	global $pagenow;

	// If not plugin screen
	if( 'plugins.php' != $pagenow ) {
		return;
	}

	// Check Lite Version
	$dir = WP_PLUGIN_DIR . '/post-category-image-with-grid-and-slider-pro/post-category-image-with-grid-and-slider-pro.php';

	if( ! file_exists( $dir ) ) {
		return;
	}

	$notice_link		= add_query_arg( array('message' => 'pciwgas-plugin-notice'), admin_url('plugins.php') );
	$notice_transient	= get_transient( 'pciwgas_install_notice' );

	// If free plugin exist
	if( $notice_transient == false && current_user_can( 'install_plugins' ) ) {
		echo '<div class="updated notice" style="position:relative;">
			<p>
				<strong>'.sprintf( __('Thank you for activating %s', 'post-category-image-with-grid-and-slider'), 'Post Category Image With Grid and Slider').'</strong>.<br/>
				'.sprintf( __('It looks like you had Pro version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'post-category-image-with-grid-and-slider'), '<strong>Post Category Image With Grid and Slider Pro</strong>' ).'
			</p>
			<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
		</div>';
	}
}

// Action to display notice
add_action( 'admin_notices', 'pciwgas_admin_notice');

/**
 * Include require files 
 * 
 * @since 1.0.0
 */
global $pciwgas_options;

// Function File
require_once( PCIWGAS_DIR . '/includes/pciwgas-function.php' );
$pciwgas_options = pciwgas_get_settings();

// Script Class
require_once( PCIWGAS_DIR . '/includes/class-pciwgas-script.php' );

// Admin Class
require_once( PCIWGAS_DIR . '/includes/admin/class-pciwgas-admin.php' );

/** Shortcode files */
require_once( PCIWGAS_DIR . '/includes/shortcode/pciwgas-grid.php' );
require_once( PCIWGAS_DIR . '/includes/shortcode/pciwgas-slider.php' );

// Gutenberg Block
if ( function_exists( 'register_block_type' ) ) {
	require_once( PCIWGAS_DIR . '/includes/admin/supports/gutenberg-block.php' );
}