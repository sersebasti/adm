<?php
/**
 * Class to include Front Page customize options.
 *
 * Class ColorMag_Customize_Front_Page_Options
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
 * Class to include Front Page customize options.
 *
 * Class ColorMag_Customize_Front_Page_Options
 */
class ColorMag_Customize_Front_Page_Options extends ColorMag_Customize_Base_Option {

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

			array(
				'name'     => 'colormag_front_page_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Front Page', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 10,
			),

			// Front page posts/pages display option.
			array(
				'name'     => 'colormag_hide_blog_front',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to hide blog posts/static page on front page', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_unique_post_system_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Unique Post System', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 30,
			),

			// Unique posts enable/disable option.
			array(
				'name'     => 'colormag_unique_post_system',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to activate the unique post system for the bundled widgets', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_front_page_view_all_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'View All', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 50,
			),

			// View all button text change option.
			array(
				'name'      => 'colormag_view_all_text',
				'default'   => esc_html__( 'View All', 'colormag' ),
				'type'      => 'control',
				'control'   => 'text',
				'label'     => esc_html__( 'Change View All Text', 'colormag' ),
				'section'   => 'colormag_front_page_general_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.view-all-link',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_view_all_button_text',
					),
				),
				'priority'  => 60,
			),

			// Top Full Width Container Layout Option.
			array(
				'name'     => 'colormag_top_full_width_container',
				'default'  => 'boxed',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Front Page: Top Full Width Container', 'colormag' ),
				'section'  => 'colormag_front_page_layout_section',
				'priority' => 0,
				'choices'  => array(
					'boxed'   => esc_html__( 'Boxed', 'colormag' ),
					'stretch' => esc_html__( 'Stretched', 'colormag' ),
				)
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Front_Page_Options();
