<?php

/**
 * Class to include Color Footer customize options.
 *
 * Class ColorMag_Customize_Color_Footer_Options
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
 * Class to include Color Footer customize options.
 *
 * Class ColorMag_Customize_Color_Footer_Options
 */
class ColorMag_Customize_Footer_widgets_Area_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_footer_widgets_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 10,
			),

			// Widget title color option.
			array(
				'name'     => 'colormag_footer_widget_title_color',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Widget title color.', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 20,
			),

			// Widget content color option.
			array(
				'name'     => 'colormag_footer_widget_content_color',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Footer widget content color.', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 30,
			),

			// Widget content link text color option.
			array(
				'name'     => 'colormag_footer_widget_content_link_text_color',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Footer widget content link text color.', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 40,
			),

			// Widget content link text hover color option.
			array(
				'name'     => 'colormag_footer_widget_content_link_text_hover_color',
				'default'  => '#289dcc',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Footer widget content link text hover color.', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 50,
			),

			// Footer copyright background group.
			array(
				'name'     => 'colormag_footer_copyright_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 60,
			),

			// Footer copyright background option.
			array(
				'name'     => 'colormag_footer_copyright_background_setting',
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
				'parent'   => 'colormag_footer_copyright_background_group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 70,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_footer_widgets_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 80,
			),

			// Widget title typography group.
			array(
				'name'     => 'colormag_footer_widget_title_typography_group',
				'label'    => esc_html__( 'Widget Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 90,
			),

			// Widget title typography option.
			array(
				'name'     => 'colormag_footer_widget_title_typography_setting',
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
							'min'  => 12,
							'max'  => 46,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 46,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 46,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_footer_widget_title_typography_group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 100,
			),

			// Widget content typography group.
			array(
				'name'     => 'colormag_footer_widget_content_typography_group',
				'label'    => esc_html__( 'Widget Content', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 110,
			),

			// Widget content typography option.
			array(
				'name'     => 'colormag_footer_widget_content_typography_setting',
				'default'  => array(
					'font-size' => array(
						'desktop' => '14',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 30,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 30,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_footer_widget_content_typography_group',
				'section'  => 'colormag_footer_widgets_area_section',
				'priority' => 120,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_widgets_Area_Options();

