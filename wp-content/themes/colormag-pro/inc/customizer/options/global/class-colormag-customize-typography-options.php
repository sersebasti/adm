<?php
/**
 * Class to include Typography General customize options.
 *
 * Class ColorMag_Customize_Typography_options
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
 * Class to include Typography General customize options.
 *
 * Class ColorMag_Customize_Typography_options
 */
class ColorMag_Customize_Typography_options extends ColorMag_Customize_Base_Option {

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
			 * Base.
			 */
			array(
				'name'     => 'colormag_body_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Body', 'colormag' ),
				'section'  => 'colormag_base_typography_section',
				'priority' => 5,
			),

			array(
				'name'        => 'colormag_base_typography_setting',
				'default'     => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => '15',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height'    => array(
						'desktop' => '1.6',
						'tablet'  => '',
						'mobile'  => '',
					),
					'letter-spacing' => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
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
							'max'  => 36,
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
							'max'  => 36,
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
				'type'        => 'control',
				'control'     => 'colormag-typography',
				'section'     => 'colormag_base_typography_section',
				'priority'    => 5,
			),

			/**
			 * Headings.
			 */
			array(
				'name'     => 'colormag_headings_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Headings', 'colormag' ),
				'section'  => 'colormag_headings_typography_section',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_headings_typography_setting',
				'default'  => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'line-height'    => array(
						'desktop' => '1.2',
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
				),
				'input_attrs' => array(
					'desktop' => array(
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
				'section'  => 'colormag_headings_typography_section',
				'priority' => 15,
			),

			// Separator.
			array(
				'name'     => 'colormag_headings_typography_separator',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 20,
			),

			/**
			 * H1.
			 */
			array(
				'name'     => 'colormag_h1_typography_group',
				'label'    => esc_html__( 'H1', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 25,
			),

			array(
				'name'     => 'colormag_h1_typography_setting',
				'default'  => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => '36',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height'    => array(
						'desktop' => '1.2',
						'tablet'  => '',
						'mobile'  => '',
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 34,
							'max'  => 60,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 34,
							'max'  => 60,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 34,
							'max'  => 60,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h1_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 25,
			),

			/**
			 * H2.
			 */
			array(
				'name'     => 'colormag_h2_typography_group',
				'label'    => esc_html__( 'H2', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_h2_typography_setting',
				'default'  => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => '32',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height'    => array(
						'desktop' => '1.2',
						'tablet'  => '',
						'mobile'  => '',
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 56,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 56,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 56,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h2_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 30,
			),

			/**
			 * H3.
			 */
			array(
				'name'     => 'colormag_h3_typography_group',
				'label'    => esc_html__( 'H3', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 35,
			),

			array(
				'name'     => 'colormag_h3_typography_setting',
				'default'  => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => '28',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height'    => array(
						'desktop' => '1.2',
						'tablet'  => '',
						'mobile'  => '',
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 52,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 52,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 52,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h3_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 35,
			),

			/**
			 * H4.
			 */
			array(
				'name'     => 'colormag_h4_typography_group',
				'label'    => esc_html__( 'H4', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_h4_typography_setting',
				'default'  => array(
					'font-size'   => array(
						'desktop' => '24',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height' => array(
						'desktop' => '1.2',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 48,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 48,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 48,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h4_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 40,
			),

			/**
			 * H5.
			 */
			array(
				'name'     => 'colormag_h5_typography_group',
				'label'    => esc_html__( 'H5', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 45,
			),

			array(
				'name'     => 'colormag_h5_typography_setting',
				'default'  => array(
					'font-size'   => array(
						'desktop' => '22',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height' => array(
						'desktop' => '1.2',
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
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 44,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 44,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h5_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 45,
			),

			/**
			 * H6.
			 */
			array(
				'name'     => 'colormag_h6_typography_group',
				'label'    => esc_html__( 'H6', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_h6_typography_setting',
				'default'  => array(
					'font-size'   => array(
						'desktop' => '18',
						'tablet'  => '',
						'mobile'  => '',
					),
					'line-height' => array(
						'desktop' => '1.2',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 14,
							'max'  => 40,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 14,
							'max'  => 40,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 14,
							'max'  => 40,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_h6_typography_group',
				'section'  => 'colormag_headings_typography_section',
				'priority' => 50,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Typography_options();
