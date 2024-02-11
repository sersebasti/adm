<?php
/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Sidebar_Options
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
 * Class to include sidebar customize options.
 *
 * Class ColorMag_Customize_Sidebar_Options
 */
class ColorMag_Customize_Sidebar_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_sticky_sidebar_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sticky Sidebar', 'colormag' ),
				'section'  => 'colormag_sidebar_section',
				'priority' => 10,
			),

			// Sticky sidebar and content area enable/disable option.
			array(
				'name'        => 'colormag_sticky_content_sidebar',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate the sticky options for content and sidebar areas.', 'colormag' ),
				'section'     => 'colormag_sidebar_section',
				'priority'    => 20,
			),

			/**
			 * Colors
			 */
			array(
				'name'     => 'colormag_sidebar_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_sidebar_section',
				'priority' => 30,
			),

			// Sidebar widget title color option.
			array(
				'name'     => 'colormag_sidebar_widget_title_color',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Sidebar widget title color.', 'colormag' ),
				'section'  => 'colormag_sidebar_section',
				'priority' => 40,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_sidebar_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_sidebar_section',
				'priority' => 50,
			),

			// Widget title typography group.
			array(
				'name'     => 'colormag_widget_title_typography_group',
				'label'    => esc_html__( 'Widget Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_sidebar_section',
				'priority' => 60,
			),

			// Widget title typography option.
			array(
				'name'     => 'colormag_widget_title_typography_setting',
				'default'  => array(
					'font-size' => array(
						'desktop' => '18',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 44,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 44,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 44,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_widget_title_typography_group',
				'section'  => 'colormag_sidebar_section',
				'priority' => 70,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Sidebar_Options();
