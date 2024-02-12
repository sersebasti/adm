<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Script {

	function __construct() {

		// Action to add style and script in backend
		add_action( 'admin_enqueue_scripts', array( $this, 'pciwgas_admin_style_script' ));

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'pciwgas_front_style_script' ));
	}

	/**
	 * Function to register admin scripts and styles
	 * 
	 * @since 1.4
	 */
	function pciwgas_register_admin_assets() {

		global $typenow, $wp_version;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Registring admin style
		wp_register_style( 'pciwgas-admin-style', PCIWGAS_URL.'assets/css/pciwgas-admin.css', array(), PCIWGAS_VERSION );

		// Registring admin script
		wp_register_script( 'pciwgas-admin-js', PCIWGAS_URL.'assets/js/pciwgas-admin.js', array( 'jquery' ), PCIWGAS_VERSION, true );
		wp_localize_script( 'pciwgas-admin-js', 'CategoryImage', array(
														'wp_version'=> $wp_version,
														'label'		=> array(
																			'title'		=> __('Choose Category Image', 'post-category-image-with-grid-and-slider'),
																			'button'	=> __('Choose Image', 'post-category-image-with-grid-and-slider')
																		),
														'new_ui' 	=>	$new_ui,
												));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @since 1.0
	 */
	function pciwgas_admin_style_script( $hook ) {	

		$this->pciwgas_register_admin_assets();

		// Pages array
		$pages_array = array( 'toplevel_page_pciwgas-settings', 'category-image_page_pciwgas-solutions-features', 'category-image_page_pciwgas-premium', 'edit-tags.php', 'term.php' );

		// If page is plugin setting page then enqueue style
		if( in_array($hook, $pages_array) ) {
			wp_enqueue_style( 'pciwgas-admin-style' );
			wp_enqueue_media();
		}
		wp_enqueue_script( 'pciwgas-admin-js' );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_front_style_script() {		
		
		global $post;

		// Determine Elementor Preview Screen
		// Check elementor preview is there
		$elementor_preview = ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) ? 1 : 0;

		/* Styles */
		// Registring and enqueing slick slider css
		if( ! wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', PCIWGAS_URL.'assets/css/slick.css', array(), PCIWGAS_VERSION );
		}
		wp_enqueue_style( 'wpos-slick-style' );

		// Registring Public style
		wp_register_style( 'pciwgas-publlic-style', PCIWGAS_URL.'assets/css/pciwgas-public.css', array(), PCIWGAS_VERSION );
		wp_enqueue_style( 'pciwgas-publlic-style' );

		/* Scripts */
		// Registring slick slider script
		if( ! wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', PCIWGAS_URL.'assets/js/slick.min.js', array('jquery'), PCIWGAS_VERSION, true );
		}

		// Register Elementor script
		wp_register_script( 'pciwgas-elementor-script', PCIWGAS_URL.'assets/js/elementor/pciwgas-elementor.js', array('jquery'), PCIWGAS_VERSION, true );

		// Registring and enqueing public script
		wp_register_script( 'pciwgas-public-script', PCIWGAS_URL.'assets/js/pciwgas-public.js', array('jquery'), PCIWGAS_VERSION, true );
		wp_localize_script( 'pciwgas-public-script', 'Pciwgas', array(
																	'elementor_preview'	=> $elementor_preview,
																	'is_mobile'	=> (wp_is_mobile()) ? 1 : 0,
																	'is_rtl'	=> (is_rtl()) 		? 1 : 0,
																	'is_avada'	=> (class_exists( 'FusionBuilder' ))	? 1 : 0,
																));

		// Enqueue Script for Elementor Preview
		if ( defined( 'ELEMENTOR_PLUGIN_BASE' ) && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) {

			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'pciwgas-public-script' );
			wp_enqueue_script( 'pciwgas-elementor-script' );
		}

		// Enqueue Style & Script for Beaver Builder
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

			$this->pciwgas_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style');
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'pciwgas-admin-js' );
			wp_enqueue_script( 'pciwgas-public-script' );
		}

		// Enqueue Admin Style & Script for Divi Page Builder
		if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_GET['et_fb'] ) && $_GET['et_fb'] == 1 ) {
			$this->pciwgas_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style' );
		}

		// Enqueue Admin Style for Fusion Page Builder
		if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) ) ) {
			$this->pciwgas_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style' );
		}
	}
}

$pciwgas_script = new Pciwgas_Script();