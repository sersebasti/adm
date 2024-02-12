<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pciwgas_register_menu') );

		// Action to register plugin settings
		add_action( 'admin_init', array($this, 'pciwgas_register_settings') );

		//Action to add category columns
		add_action( 'admin_init', array($this, 'pciwgas_admin_init_process') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_register_menu() {

		// Main Menu
		add_menu_page( __('Category Image', 'post-category-image-with-grid-and-slider'), __('Category Image', 'post-category-image-with-grid-and-slider'), 'manage_options', 'pciwgas-settings', array( $this, 'pciwgas_settings_page' ), 'dashicons-feedback' );

		// Register plugin premium page
		add_submenu_page( 'pciwgas-settings', __( 'Solutions & Features - Post Category Image With Grid and Slider', 'post-category-image-with-grid-and-slider' ), '<span style="color:#2ECC71">'.__( 'Solutions & Features', 'post-category-image-with-grid-and-slider' ).'</span>', 'manage_options', 'pciwgas-solutions-features', array( $this, 'pciwgas_solutions_features_page' ) );

		// Register plugin premium page
		add_submenu_page( 'pciwgas-settings', __( 'Upgrade To Premium - Post Category Image With Grid and Slider', 'post-category-image-with-grid-and-slider' ), '<span style="color:#ff2700">'.__( 'Upgrade To Premium', 'post-category-image-with-grid-and-slider' ).'</span>', 'manage_options', 'pciwgas-premium', array( $this, 'pciwgas_premium_page' ) );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_settings_page() {
		include_once( PCIWGAS_DIR . '/includes/admin/settings/settings.php' );
	}

	/**
	 * Function to display HTML
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_solutions_features_page() {
		include_once( PCIWGAS_DIR . '/includes/admin/settings/solutions-features.php' );
	}

	/**
	 * Function to handle the upgrade to pro page html
	 * 
	 * @since 1.3.1
	 */
	function pciwgas_premium_page() {
		include_once( PCIWGAS_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_register_settings() {

		// If plugin notice is dismissed
		if( isset($_GET['message']) && $_GET['message'] == 'pciwgas-plugin-notice' ) {
			set_transient( 'pciwgas_install_notice', true, 604800 );
		}

		register_setting( 'pciwgas_plugin_options', 'pciwgas_options', array( $this, 'pciwgas_validate_options' ) );
	}


	/**
	 * Validate Settings Options
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_validate_options( $input ) {
		return $input;
	}

	/**
	 * Add image column
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_admin_init_process() {

		// Redirect to features page
		if ( get_option( 'pciwgas_sf_optin', false ) ) {

			delete_option( 'pciwgas_sf_optin' );

			$redirect_link = add_query_arg( array( 'page' => 'pciwgas-solutions-features' ), admin_url( 'admin.php' ) );

			wp_safe_redirect( $redirect_link );
			exit;
		}

		// Get Taxonomy from plugin setting page
		$taxonomies = pciwgas_get_option( 'pciwgas_category' );

		if( ! empty( $taxonomies )) {
			foreach ((array) $taxonomies as $taxonomy) {
				$this->pciwgas_taxonomy_hooks( $taxonomy );
			}
		}
	}

    /**
	 * Add custom column field
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_taxonomy_hooks( $taxonomy ) {
		
		add_action("{$taxonomy}_add_form_fields", array( $this, 'pciwgas_add_taxonomy_field' ));
		add_action("{$taxonomy}_edit_form_fields", array( $this, 'pciwgas_edit_taxonomy_field' ));

		// Save taxonomy fields
		add_action('edited_'.$taxonomy, array( $this, 'pciwgas_save_taxonomy_custom_meta' ));
		add_action('create_'.$taxonomy, array( $this, 'pciwgas_save_taxonomy_custom_meta' ));

		// Add custom columns to custom taxonomies
		add_filter("manage_edit-{$taxonomy}_columns", array( $this, 'pciwgas_manage_category_columns' ));
		add_filter("manage_{$taxonomy}_custom_column", array( $this, 'pciwgas_manage_category_columns_fields' ), 10, 3);
	}

	/**
	 * Add form field on taxonomy page
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_add_taxonomy_field( $taxonomy ) {
		include_once( PCIWGAS_DIR . '/includes/admin/form-field/add-form.php' );
	}

	/**
	 * Add form field on edit-taxonomy page
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_edit_taxonomy_field( $term ) {
		include_once( PCIWGAS_DIR . '/includes/admin/form-field/edit-form.php' );
	}

	/**
	 * Function to add term field on edit screen
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_save_taxonomy_custom_meta( $term_id ) {

		$prefix = PCIWGAS_META_PREFIX; // Taking metabox prefix

		// If post data is submitted
		if( isset( $_POST[$prefix.'cat_thumb_id'] ) ) {

			$cat_thumb_id = ! empty( $_POST[$prefix.'cat_thumb_id'] ) ? pciwgas_clean( $_POST[$prefix.'cat_thumb_id'] ) : '';

			update_term_meta( $term_id, $prefix.'cat_thumb_id', $cat_thumb_id );
		}
	}

	/**
	 * Add image column
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_manage_category_columns($columns){

		$new_columns['pciwgas_image'] = __( 'Image', 'post-category-image-with-grid-and-slider' );
		
		$columns = pciwgas_add_array( $columns, $new_columns, 1, true );

		return $columns;
	}

	/**
	 * Add column data
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_manage_category_columns_fields($output, $column_name, $term_id) {
		
		if( $column_name == 'pciwgas_image' ) {
			
			$prefix			= PCIWGAS_META_PREFIX; // Taking metabox prefix
			$cat_thum_image	= pciwgas_term_image( $term_id, 'thumbnail' );

			if( ! empty( $cat_thum_image ) ) {
				$output .= '<img class="pciwgas-cat-img" src="'.esc_url( $cat_thum_image ).'" height="70" width="70" />';
			}
		}

		return $output;
	}
}

$pciwgas_admin = new Pciwgas_Admin();