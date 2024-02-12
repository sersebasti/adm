<?php
/**
 * Function 
 * Handles the functionality of plugin
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to get featured content column
 * 
 * @since 1.0.0
 */
function pciwgas_column( $row = '' ) {
	if( $row == 2 ) {
		$per_row = 6;
	} else if( $row == 3 ) {
		$per_row = 4;	
	} else if( $row == 4 ) {
		$per_row = 3;
	} else if( $row == 1 ) {
		$per_row = 12;
	} else{
		$per_row = 12;
	}
	return $per_row;
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function pciwgas_get_unique() {
	static $unique = 0;
	$unique++;

	// For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique = current_time('timestamp') . '-' . rand();
	}

	return $unique;
}

/**
 * Update default settings
 * 
 * @since 1.0.0
 */
function pciwgas_default_settings(){

	global $pciwgas_options;

	$pciwgas_options = array(
							'pciwgas_enable'    => '1',
							'pciwgas_category'  => array('category'),
						);

	$default_options = apply_filters( 'pciwgas_options_default_values', $pciwgas_options );

	// Update default options
	update_option( 'pciwgas_options', $default_options );

	// Overwrite global variable when option is update
	$pciwgas_options = pciwgas_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @since 1.0.0
 */
function pciwgas_get_settings() {

	$options = get_option( 'pciwgas_options' );

	$settings = is_array( $options )  ? $options : array();

	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @since 1.0.0
*/
function pciwgas_get_option( $key = '', $default = false ) {
	global $pciwgas_options;

	$value = ! empty( $pciwgas_options[ $key ] ) ? $pciwgas_options[ $key ] : $default;
	$value = apply_filters( 'pciwgas_get_option', $value, $key, $default );
	return apply_filters( 'pciwgas_get_option_' . $key, $value, $key, $default );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @since 1.4.8
 */
function pciwgas_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'pciwgas_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash( $data );
	}
}

/**
 * Sanitize Multiple HTML class
 * 
 * @since 1.3
 */
function pciwgas_sanitize_html_classes($classes, $sep = " ") {
	$return = "";

	if( ! is_array( $classes )) {
		$classes = explode( $sep, $classes );
	}

	if( ! empty( $classes )) {
		foreach( $classes as $class ) {
			$return .= sanitize_html_class( $class ) . " ";
		}
		$return = trim( $return );
	}

	return $return;
}

/**
 * Function to add array after specific key
 * 
 * @since 1.2
 */
function pciwgas_add_array(&$array, $value, $index, $from_last = false) {

	if( is_array( $array ) && is_array( $value ) ) {

		if( $from_last ) {
			$total_count	= count( $array );
			$index			= ( ! empty( $total_count ) && ( $total_count > $index )) ? ( $total_count-$index ): $index;
		}

		$split_arr	= array_splice( $array, max( 0, $index ));
		$array		= array_merge( $array, $value, $split_arr );
	}

	return $array;
}

/**
 * Function to get post featured image
 * 
 * @since 1.2
 */
function  pciwgas_get_image_src( $attachment_id = '', $size = 'full' ) {

	$size	= ! empty( $size ) ? $size : 'full';
	$image	= wp_get_attachment_image_src( $attachment_id, $size );

	if( ! empty( $image )) {
		$image = isset( $image[0] ) ? $image[0] : '';
	}

	return $image;
}

/**
 * Get Taxonomy Image
 * 
 * @since 1.2
 */
function pciwgas_term_image( $term_id = 0, $size = 'full' ) {

	$prefix			= PCIWGAS_META_PREFIX;
	$size			= ! empty( $size ) ? $size : 'full';
	$attachment_id	= get_term_meta( $term_id, $prefix.'cat_thumb_id', true );

	// Backword compatibility
	if ( empty( $attachment_id ) ) {
		$attachment_id = get_option( 'pciwgas_categoryimage_'.$term_id );
	}
   
	$image = pciwgas_get_image_src( $attachment_id, $size );
	
	return $image;
}