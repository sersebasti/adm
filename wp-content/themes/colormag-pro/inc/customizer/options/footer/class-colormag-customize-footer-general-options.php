<?php
/**
 * Class to include Footer General customize options.
 *
 * Class ColorMag_Customize_Footer_General_Options
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
 * Class to include Footer General customize options.
 *
 * Class ColorMag_Customize_Footer_General_Options
 */
class ColorMag_Customize_Footer_General_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'     => 'colormag_footer_style_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_footer_general_section',
				'priority' => 10,
			),

			// Main total footer area display type option.
			array(
				'name'      => 'colormag_main_footer_layout_display_type',
				'default'   => 'type_one',
				'type'      => 'control',
				'control'   => 'radio',
				'label'     => esc_html__( 'Choose the main total footer area display type that you want', 'colormag' ),
				'section'   => 'colormag_footer_general_section',
				'choices'   => array(
					'type_one'   => esc_html__( 'Type 1 (Default)', 'colormag' ),
					'type_two'   => esc_html__( 'Type 2', 'colormag' ),
					'type_three' => esc_html__( 'Type 3', 'colormag' ),
				),
				'transport' => 'postMessage',
				'priority'  => 20,
			),

			array(
				'name'     => 'colormag_footer_scroll_to_top_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Scroll To Top', 'colormag' ),
				'section'  => 'colormag_footer_general_section',
				'priority' => 30,
			),

			// Scroll to top button enable/disable option.
			array(
				'name'     => 'colormag_scroll_to_top',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to disable the scroll to top button.', 'colormag' ),
				'section'  => 'colormag_footer_general_section',
				'priority' => 40,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_footer_general_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_footer_general_section',
				'priority' => 50,
			),

			// Footer background group.
			array(
				'name'     => 'colormag_footer_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_general_section',
				'priority' => 60,
			),

			// Footer background option.
			array(
				'name'     => 'colormag_footer_background_setting',
				'default'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_footer_background_group',
				'section'  => 'colormag_footer_general_section',
				'priority' => 70,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_General_Options();
