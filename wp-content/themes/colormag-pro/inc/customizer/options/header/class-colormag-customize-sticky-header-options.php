<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Sticky_Header_Options
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
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Sticky_Header_Options
 */
class ColorMag_Customize_Sticky_Header_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Sticky Menu.
			 */
			// Sticky menu heading separator.
			array(
				'name'     => 'colormag_primary_sticky_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sticky Menu', 'colormag' ),
				'section'  => 'colormag_sticky_header_section',
				'priority' => 5,
			),

			// Primary sticky menu enable/disable option.
			array(
				'name'        => 'colormag_primary_sticky_menu',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
				'section'     => 'colormag_sticky_header_section',
				'priority'    => 10,
			),

			// Primary sticky menu type option.
			array(
				'name'        => 'colormag_primary_sticky_menu_type',
				'default'     => 'sticky',
				'type'        => 'control',
				'control'     => 'radio',
				'label'       => esc_html__( 'Style', 'colormag' ),
				'description' => esc_html__( 'Select the option you want:', 'colormag' ),
				'section'     => 'colormag_sticky_header_section',
				'choices'     => array(
					'sticky'           => esc_html__( 'Make the menu sticky', 'colormag' ),
					'reveal_on_scroll' => esc_html__( 'Reveal the menu on scroll up', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_primary_sticky_menu',
					'!=',
					0,
				),
				'priority'    => 15,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Sticky_Header_Options();
