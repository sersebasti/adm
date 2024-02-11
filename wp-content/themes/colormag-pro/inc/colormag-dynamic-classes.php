<?php
/**
 * Dynamic classes for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_header_layout_class' ) ) :

	/**
	 * Function to return the classname for header option layout class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_header_layout_class() {

		// Add the header area display type dynamic class.
		$colormag_header_layout_class = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );
		$class_name                   = '';

		if ( 'type_two' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-clean';
		} elseif ( 'type_three' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-classic';
		} elseif ( 'type_four' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-clean colormag-header-clean--top';
		} elseif ( 'type_five' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-clean colormag-header-clean--full-width';
		} elseif ( 'type_six' === $colormag_header_layout_class ) {
			$class_name = 'colormag-header-classic colormag-header-classic--top';
		}

		return $class_name;

	}

endif;

if ( ! function_exists( 'colormag_top_full_width_area_class' ) ) :

	/**
	 * Function to return the classname for top full width area class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_top_full_width_area_class() {

		// Add the header area display type dynamic class.
		$colormag_top_full_width_area_class = get_theme_mod( 'colormag_top_full_width_container', 'boxed' );
		$class_name                   = '';

		if ( 'stretch' === $colormag_top_full_width_area_class ) {
			$class_name = 'stretched';
		}
		return $class_name;

	}

endif;


if ( ! function_exists( 'colormag_footer_layout_class' ) ) :

	/**
	 * Function to return the classname for footer option layout class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_footer_layout_class() {

		$colormag_footer_layout_class = get_theme_mod( 'colormag_main_footer_layout_display_type', 'type_one' );
		$class_name                   = '';

		if ( 'type_two' === $colormag_footer_layout_class ) {
			$class_name = 'colormag-footer--classic';
		} elseif ( 'type_three' === $colormag_footer_layout_class ) {
			$class_name = 'colormag-footer--classic-bordered';
		}

		return $class_name;

	}

endif;


if ( ! function_exists( 'colormag_copyright_alignment_class' ) ) :

	/**
	 * Function to return the classname for footer copyright alignment class.
	 *
	 * @return string CSS classname.
	 */
	function colormag_copyright_alignment_class() {

		$colormag_copyright_alignment_class = get_theme_mod( 'colormag_footer_copyright_alignment_setting', 'left' );
		$class_name                         = '';

		if ( 'right' === $colormag_copyright_alignment_class ) {
			$class_name = 'copyright-right';
		} elseif ( 'center' === $colormag_copyright_alignment_class ) {
			$class_name = 'copyright-center';
		}

		return $class_name;

	}

endif;
