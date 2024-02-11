<?php
/**
 * Class to include Header Main Area customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
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
 * Class to include Header Main Area customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
 */
class ColorMag_Customize_Site_Identity_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_site_brand_visibility_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Visibility', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 0,
			),

			// Header logo placement option.
			array(
				'name'     => 'colormag_header_logo_placement',
				'default'  => 'header_text_only',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Choose the option that you want', 'colormag' ),
				'section'  => 'title_tagline',
				'choices'  => array(
					'header_logo_only' => esc_html__( 'Header Logo Only', 'colormag' ),
					'header_text_only' => esc_html__( 'Header Text Only', 'colormag' ),
					'show_both'        => esc_html__( 'Show Both', 'colormag' ),
					'disable'          => esc_html__( 'Disable', 'colormag' ),
				),
				'priority' => 3,
			),

			array(
				'name'     => 'colormag_site_logo_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Logo', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_retina_logo',
				'type'     => 'control',
				'control'  => 'image',
				'label'    => esc_html__( 'Retina Logo', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 6,
			),

			array(
				'name'     => 'colormag_site_icon_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Icon', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 7,
			),

			array(
				'name'     => 'colormag_site_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Title', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			),

			array(
				'name'     => 'colormag_site_tagline_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Site Tagline', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 11,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_site_identity_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 105,
			),

			// Site Title.
			array(
				'name'     => 'colormag_site_title_color_group',
				'label'    => esc_html__( 'Site Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'title_tagline',
				'priority' => 110,
			),

			array(
				'name'     => 'colormag_site_title_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#289dcc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_site_title_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 110,
			),

			array(
				'name'     => 'colormag_site_title_hover_color',
				'label'    => esc_html__( 'Hover Color', 'colormag' ),
				'default'  => '#289dcc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_site_title_color_group',
				'tab'      => esc_html__( 'Hover', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 110,
			),

			// Site Tagline.
			array(
				'name'     => 'colormag_site_tagline_color_group',
				'label'    => esc_html__( 'Site Tagline', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'title_tagline',
				'priority' => 115,
			),

			array(
				'name'     => 'colormag_site_tagline_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#666666',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_site_tagline_color_group',
				'section'  => 'title_tagline',
				'priority' => 115,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_site_identity_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 205,
			),

			// Site title typography group.
			array(
				'name'     => 'colormag_site_title_typography_group',
				'label'    => esc_html__( 'Site Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'title_tagline',
				'priority' => 210,
			),

			array(
				'name'     => 'colormag_site_title_typography_setting',
				'default'  => array(
					'font-family' => 'default',
					'font-size'   => array(
						'desktop' => '46',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 90,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 90,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 30,
							'max'  => 90,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_site_title_typography_group',
				'section'  => 'title_tagline',
				'priority' => 210,
			),

			// Site tagline typography group.
			array(
				'name'     => 'colormag_site_tagline_typography_group',
				'label'    => esc_html__( 'Site Tagline', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'title_tagline',
				'priority' => 215,
			),

			// Site tagline typography option.
			array(
				'name'     => 'colormag_site_tagline_typography_setting',
				'default'  => array(
					'font-family' => 'default',
					'font-size'   => array(
						'desktop' => '16',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 40,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 40,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 40,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_site_tagline_typography_group',
				'section'  => 'title_tagline',
				'priority' => 215,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Site_Identity_Options();
