<?php
/**
 * Plugin Name: Stop Generating Unnecessary Thumbnails
 * Description: So, it creates multiple thumbnails while uploading an image? Here is the solution!
 * Plugin URI: https://wordpress.org/plugins/image-sizes/
 * Author: Codexpert
 * Author URI: https://codexpert.io/?utm_source=free-plugins&utm_medium=author-uri&utm_campaign=image-sizes
 * Version: 3.4.4
 * Text Domain: image-sizes
 * Domain Path: /languages
 *
 * Stop Generating Unnecessary Thumbnails is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Stop Generating Unnecessary Thumbnails is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

namespace Codexpert\Image_Sizes;
use Codexpert\Plugin\Widget;
use Codexpert\Plugin\Survey;
use Codexpert\Plugin\Notice;
use Codexpert\Plugin\Feature;
use Codexpert\Plugin\Deactivator;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package Plugin
 * @author codexpert <hello@codexpert.io>
 */
final class Plugin {
	
	/**
	 * Plugin instance
	 * 
	 * @return Plugin
	 */
	public static $_instance;

	/**
	 * The constructor method
	 * 
	 * @since 1.0
	 */
	private function __construct() {
		/**
		 * Includes required files
		 */
		$this->include();

		/**
		 * Defines contants
		 */
		$this->define();

		/**
		 * Run actual hooks
		 */
		$this->hook();
	}

	/**
	 * Includes files
	 */
	public function include() {
		require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
	}

	/**
	 * Define variables and constants
	 */
	public function define() {
		// constants
		define( 'IMAGE_SIZES', __FILE__ );
		define( 'IMAGE_SIZES_DIR', dirname( IMAGE_SIZES ) );
		define( 'IMAGE_SIZES_DEBUG', apply_filters( 'image-sizes_debug', false ) );

		// plugin data
		$this->plugin				= get_plugin_data( IMAGE_SIZES );
		$this->plugin['basename']	= plugin_basename( IMAGE_SIZES );
		$this->plugin['file']		= IMAGE_SIZES;
		$this->plugin['server']		= apply_filters( 'image-sizes_server', 'https://codexpert.io/dashboard' );
		$this->plugin['min_php']	= '5.6';
		$this->plugin['min_wp']		= '4.0';
		$this->plugin['doc_id']		= 1375;
	}

	/**
	 * Hooks
	 */
	public function hook() {

		if( is_admin() ) :

			/**
			 * Admin facing hooks
			 *
			 * To add an action, use $admin->action()
			 * To apply a filter, use $admin->filter()
			 */
			$admin = new Admin( $this->plugin );
			$admin->activate( 'install' );
			$admin->action( 'plugins_loaded', 'i18n' );
			$admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
			$admin->action( 'admin_head', 'set_init_sizes' );
			$admin->filter( 'intermediate_image_sizes_advanced', 'image_sizes' );
			$admin->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );
			$admin->filter( 'plugin_row_meta', 'plugin_row_meta', 10, 2 );
			$admin->action( 'admin_footer_text', 'footer_text' );
			$admin->action( 'admin_notices', 'admin_notices' );

			/**
			 * Settings related hooks
			 *
			 * To add an action, use $settings->action()
			 * To apply a filter, use $settings->filter()
			 */
			$settings = new Settings( $this->plugin );
			$settings->action( 'plugins_loaded', 'init_menu' );
			$settings->action( 'admin_notices', 'admin_notices' );

			// Product related classes
			$widget			= new Widget( $this->plugin );
			$survey			= new Survey( $this->plugin );
			$notice			= new Notice( $this->plugin );
			$feature		= new Feature( $this->plugin );
			$deactivator	= new Deactivator( $this->plugin );

		else : // ! is_admin() ?

			/**
			 * Front facing hooks
			 *
			 * To add an action, use $front->action()
			 * To apply a filter, use $front->filter()
			 */
			$front = new Front( $this->plugin );
			$front->action( 'wp_enqueue_scripts', 'enqueue_scripts' );

		endif;

		/**
		 * AJAX facing hooks
		 *
		 * To add a hook for logged in users, use $ajax->priv()
		 * To add a hook for non-logged in users, use $ajax->nopriv()
		 */
		$ajax = new AJAX( $this->plugin );
		$ajax->priv( 'image_sizes-regen-thumbs', 'regen_thumbs' );
		$ajax->priv( 'image_sizes-dismiss', 'dismiss_notice' );
		$ajax->priv( 'image_sizes-analyze', 'analyze' );

		/**
		 * Cron facing hooks
		 *
		 * To add a hook for logged in users, use $ajax->priv()
		 * To add a hook for non-logged in users, use $ajax->nopriv()
		 */
		$cron = new Cron( $this->plugin );
		$cron->activate( 'install' );
		$cron->deactivate( 'uninstall' );
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() { }

	/**
	 * Instantiate the plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

Plugin::instance();