<?php
/**
 * Class to include Button customize options.
 *
 * Class ColorMag_Customize_Button_Options
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
 * Class to include Button customize options.
 *
 * Class ColorMag_Customize_Button_Options
 */
class ColorMag_Customize_Button_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_button_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_button_text_color',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Text Color', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_button_background_color',
				'default'  => '#289dcc',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Background Color', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 10,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_button_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 10,
			),

			// Button typography option.
			array(
				'name'     => 'colormag_button_typography_setting',
				'default'  => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height'    => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
					'letter-spacing' => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),'input_attrs' => array(
				'desktop' => array(
					'font-size'      => array(
						'step' => 1,
						'min'  => 10,
						'max'  => 28,
					),
					'line-height'    => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 3,
					),
					'letter-spacing' => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 4,
					),
				),
				'tablet'  => array(
					'font-size'      => array(
						'step' => 1,
						'min'  => 10,
						'max'  => 28,
					),
					'line-height'    => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 3,
					),
					'letter-spacing' => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 4,
					),
				),
				'mobile'  => array(
					'font-size'      => array(
						'step' => 1,
						'min'  => 10,
						'max'  => 28,
					),
					'line-height'    => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 3,
					),
					'letter-spacing' => array(
						'step' => 0.1,
						'min'  => 0,
						'max'  => 4,
					),
				),
			),
				'type'     => 'control',
				'control'  => 'colormag-typography',
				'section'  => 'colormag_button_section',
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Button_Options();
