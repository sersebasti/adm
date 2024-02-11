<?php
/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
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
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
 */
class ColorMag_Customize_Footer_Bottom_Bar_Options extends ColorMag_Customize_Base_Option {

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

		// Footer copyright default value.
		$default_footer_value = esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '<br>' . esc_html__( 'Theme: ', 'colormag') . '[tg-link]' .  esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].';

		$configs = array(

			/**
			 * Alignment.
			 */
			array(
				'name'     => 'colormag_footer_bottom_bar_alignment_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Alignment', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 10,
			),

			// Footer copyright alignment option.
			array(
				'name'      => 'colormag_footer_copyright_alignment_setting',
				'default'   => 'left',
				'type'      => 'control',
				'control'   => 'radio',
				'label'     => esc_html__( 'Select the footer copyright, footer menu and social icons alignment.', 'colormag' ),
				'section'   => 'colormag_footer_bottom_bar_section',
				'choices'   => array(
					'left'   => esc_html__( 'Left/Right', 'colormag' ),
					'right'  => esc_html__( 'Right/Left', 'colormag' ),
					'center' => esc_html__( 'Center', 'colormag' ),
				),
				'transport' => 'postMessage',
				'priority'  => 20,
			),

			/**
			 * Alignment.
			 */
			array(
				'name'     => 'colormag_footer_copyright_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Copyright', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 30,
			),

			array(
				'name'      => 'colormag_footer_editor',
				'default'   => $default_footer_value,
				'type'      => 'control',
				'control'   => 'colormag-editor',
				'label'     => esc_html__( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'colormag' ),
				'section'   => 'colormag_footer_bottom_bar_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.copyright',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_footer_copyright_text',
					),
				),
				'priority'  => 40,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_footer_bottom_bar_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 50,
			),

			// Background.
			array(
				'name'     => 'colormag_footer_copyright_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 60,
			),

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
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 70,
			),

			// Footer Copyright.
			array(
				'name'     => 'colormag_footer_copyright_color_group',
				'label'    => esc_html__( 'Footer Copyright', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 80,
			),

			array(
				'name'     => 'colormag_footer_copyright_text_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 90,
			),

			array(
				'name'     => 'colormag_footer_copyright_link_text_color',
				'label'    => esc_html__( 'Link Color', 'colormag' ),
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 100,
			),

			// Footer Menu.
			array(
				'name'     => 'colormag_footer_menu_color_group',
				'label'    => esc_html__( 'Footer Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 110,
			),

			array(
				'name'     => 'colormag_footer_small_menu_text_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_menu_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 120,
			),

			array(
				'name'     => 'colormag_footer_small_menu_text_hover_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#289dcc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_menu_color_group',
				'tab'      => esc_html__( 'Hover', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 130,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_footer_bottom_bar_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 140,
			),

			// Footer Copyright.
			array(
				'name'     => 'colormag_footer_copyright_typography_group',
				'label'    => esc_html__( 'Footer Copyright', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 150,
			),

			array(
				'name'     => 'colormag_footer_copyright_typography_setting',
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
							'max'  => 24,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 24,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 24,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_footer_copyright_typography_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 160,
			),

			// Footer Menu.
			array(
				'name'     => 'colormag_footer_menu_typography_group',
				'label'    => esc_html__( 'Footer Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 170,
			),

			array(
				'name'     => 'colormag_footer_menu_typography_setting',
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
							'max'  => 24,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 24,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 24,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_footer_menu_typography_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 180,
			),

			/**
			 * Social Icons.
			 */
			array(
				'name'     => 'colormag_footer_bar_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 190,
			),

			array(
				'name'          => 'colormag_footer_bar_social_icons_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'label'         => esc_html__( 'Social Icons', 'colormag' ),
				'section'       => 'colormag_footer_bottom_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_social_icons_section',
					'target_label' => esc_html__( 'Social Icons', 'colormag' ),
				),
				'priority'      => 200,
			),

		);


		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_Bottom_Bar_Options();
