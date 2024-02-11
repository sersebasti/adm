<?php
/**
 * Class to include Blog Post Meta customize options.
 *
 * Class ColorMag_Customize_Post_Meta_Options
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
 * Class to include Post Meta customize options.
 *
 * Class ColorMag_Customize_Post_Meta_Options
 */
class ColorMag_Customize_Post_Meta_Options extends ColorMag_Customize_Base_Option {

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

			// Post meta date display type option.
			array(
				'name'       => 'colormag_post_meta_date_setting',
				'default'    => 'post_date',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Choose post meta display type:', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'choices'    => array(
					'post_date'                => esc_html__( 'Display published date ', 'colormag' ),
					'post_human_readable_date' => esc_html__( 'Display published date in "X time ago" format', 'colormag' ),
				),
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_all_entry_meta_remove',
							'==',
							0,
						),
						array(
							'colormag_date_entry_meta_remove',
							'==',
							0,
						),
					),
					'operator'   => 'AND',
				),
				'priority'   => 10,
			),

			/**
			 * Post meta display options.
			 */
			// Post meta display heading separator.
			array(
				'name'     => 'colormag_post_meta_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Meta Display', 'colormag' ),
				'section'  => 'colormag_post_meta_section',
				'priority' => 20,
			),

			// Total post meta display enable/disable option.
			array(
				'name'      => 'colormag_all_entry_meta_remove',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the post meta for the post totally, ie, remove all of the meta data.', 'colormag' ),
				'section'   => 'colormag_post_meta_section',
				'transport' => 'postMessage',
				'priority'  => 30,
			),

			// Author post meta display enable/disable option.
			array(
				'name'       => 'colormag_author_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the author only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 40,
			),

			// Date post meta display enable/disable option.
			array(
				'name'       => 'colormag_date_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the date only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 50,
			),

			// Category post meta display enable/disable option.
			array(
				'name'       => 'colormag_category_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the category only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 60,
			),

			// Comments post meta display enable/disable option.
			array(
				'name'       => 'colormag_comments_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the comments only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 70,
			),

			// Tags post meta display enable/disable option.
			array(
				'name'       => 'colormag_tags_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the tags only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 80,
			),

			// Reading time display enable/disable option.
			array(
				'name'       => 'colormag_reading_time_setting',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to display the reading time.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 90,
			),

			// Post view post meta display enable/disable option.
			array(
				'name'       => 'colormag_post_view_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the post view only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 100,
			),

			// Edit button post meta display enable/disable option.
			array(
				'name'       => 'colormag_edit_button_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Disable the edit button only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 110,
			),

			/**
			 * Colors.
			 */

			// Color options heading separator.
			array(
				'name'       => 'colormag_post_meta_colors_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Colors', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 120,
			),

			// Post meta color group.
			array(
				'name'       => 'colormag_post_meta_color_group',
				'label'      => esc_html__( 'Post Meta', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 130,
			),

			// Post meta normal color option.
			array(
				'name'       => 'colormag_post_meta_color',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'default'    => '#888888',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_post_meta_color_group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 140,
			),

			/**
			 * Typography options.
			 */
			// Typography options heading separator.
			array(
				'name'       => 'colormag_post_meta_typography_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Typography', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 150,
			),

			// Post meta Typography group.
			array(
				'name'       => 'colormag_post_meta_title_typography_group',
				'label'      => esc_html__( 'Post Meta', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 160,
			),

			// Post meta typography option.
			array(
				'name'       => 'colormag_post_meta_typography_setting',
				'default'    => array(
					'font-size' => array(
						'desktop' => '12',
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
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
						),
					),
				),
				'type'       => 'sub-control',
				'control'    => 'colormag-typography',
				'parent'     => 'colormag_post_meta_title_typography_group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 170,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Post_Meta_Options();
