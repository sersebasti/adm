<?php
/**
 * All front facing functions
 */
namespace Codexpert\Image_Sizes;
use Codexpert\Plugin\Base;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author codexpert <hello@codexpert.io>
 */
class Front extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->server	= $this->plugin['server'];
		$this->version	= $this->plugin['Version'];
	}

	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'IMAGE_SIZES_DEBUG' ) && IMAGE_SIZES_DEBUG ? '' : '.min';

		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/front{$min}.js", IMAGE_SIZES ), [ 'jquery' ], $this->version, true );
		$localized = array(
			'version'	=> $this->version,
			'disables'	=> Helper::get_option( 'prevent_image_sizes', 'disables', [] ),
		);
		wp_localize_script( $this->slug, 'IMAGE_SIZES', apply_filters( "{$this->slug}-localized", $localized ) );
	}
}