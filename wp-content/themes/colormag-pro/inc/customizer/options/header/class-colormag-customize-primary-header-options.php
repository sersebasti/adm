<?php
/**
 * Class to include Header General customize options.
 *
 * Class ColorMag_Customize_Primary_Header_Options
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
 * Class to include Header General customize options.
 *
 * Class ColorMag_Customize_Primary_Header_Options
 */
class ColorMag_Customize_Primary_Header_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_primary_header_style_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 5,
			),

			// Main total header area display type option.
			array(
				'name'     => 'colormag_main_total_header_area_display_type',
				'default'  => 'type_one',
				'type'     => 'control',
				'control'  => 'colormag-radio-image',
				'label'    => esc_html__( 'Choose the main total header area display type that you want', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'choices'  => array(
					'type_one'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-1.png',
					),
					'type_two'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-2.png',
					),
					'type_three' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-3.png',
					),
					'type_four'  => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-4.png',
					),
					'type_five'  => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-5.png',
					),
					'type_six'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-6.png',
					),
				),
				'priority' => 10,
			),

			array(
				'name'       => 'colormag_primary_header_alignment_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Alignment', 'colormag' ),
				'section'    => 'colormag_primary_header_section',
				'priority'   => 15,
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_main_total_header_area_display_type',
							'!=',
							'type_three',
						),
						array(
							'colormag_main_total_header_area_display_type',
							'!=',
							'type_six',
						),
					),
					'operator'   => 'AND',
				),
			),

			array(
				'name'       => 'colormag_header_display_type',
				'default'    => 'type_one',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Choose the header display type that you want', 'colormag' ),
				'section'    => 'colormag_primary_header_section',
				'transport'  => 'postMessage',
				'choices'    => array(
					'type_one'   => esc_html__( 'Type 1 (Default): Header text & logo on left, header sidebar on right', 'colormag' ),
					'type_two'   => esc_html__( 'Type 2: Header sidebar on left, header text & logo on right', 'colormag' ),
					'type_three' => esc_html__( 'Type 3: Header text, header sidebar both aligned center', 'colormag' ),
				),
				'priority'   => 20,
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_main_total_header_area_display_type',
							'!=',
							'type_three',
						),
						array(
							'colormag_main_total_header_area_display_type',
							'!=',
							'type_six',
						),
					),
					'operator'   => 'AND',
				),
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_primary_header_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 105,
			),

			// Header background group.
			array(
				'name'     => 'colormag_header_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_header_section',
				'priority' => 110,
			),

			// Header background option.
			array(
				'name'     => 'colormag_header_background_setting',
				'default'  => array(
					'background-color'      => '#ffffff',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_header_background_group',
				'section'  => 'colormag_primary_header_section',
				'priority' => 110,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Primary_Header_Options();
