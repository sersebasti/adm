<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
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
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
 */
class ColorMag_Customize_Primary_Menu_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Home icon options.
			 */
			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_home_icon_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Show Home Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 105,
			),

			// Home icon in menu display option.
			array(
				'name'        => 'colormag_home_icon_display',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show the home icon in the primary menu', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.home-icon',
				),
				'priority'    => 110,
			),

			// Search Icon.
			array(
				'name'     => 'colormag_search_icon_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Search Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 205,
			),

			array(
				'name'        => 'colormag_search_icon_in_menu',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the Search Icon in the primary menu', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 210,
			),

			// Random Post.
			array(
				'name'     => 'colormag_random_post_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Random Post', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 305,
			),

			array(
				'name'        => 'colormag_random_post_in_menu',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the Random Post Icon in the primary menu', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
				'priority'    => 310,
			),

			// Category Color.
			array(
				'name'     => 'colormag_primary_menu_category_color_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Category Color', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 315,
			),

			array(
				'name'        => 'colormag_category_menu_color',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show category color in menu.', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 320,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_primary_menu_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 405,
			),

			// Primary Menu.
			array(
				'name'     => 'colormag_primary_menu_color_group',
				'label'    => esc_html__( 'Primary Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 410,
			),

			array(
				'name'     => 'colormag_primary_menu_text_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#ffffff',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 410,
			),

			array(
				'name'     => 'colormag_primary_menu_selected_hovered_text_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#ffffff',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Hover/Selected', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 410,
			),

			// Background.
			array(
				'name'     => 'colormag_primary_menu_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 415,
			),

			array(
				'name'     => 'colormag_primary_menu_background_setting',
				'default'  => array(
					'background-color'      => '#232323',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_primary_menu_background_group',
				'tab'      => esc_html__( 'Primary Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 415,
			),

			array(
				'name'     => 'colormag_primary_sub_menu_background_setting',
				'default'  => array(
					'background-color'      => '#232323',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_primary_menu_background_group',
				'tab'      => esc_html__( 'Sub Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 415,
			),

			// Border Top.
			array(
				'name'     => 'colormag_primary_menu_border_top_group',
				'label'    => esc_html__( 'Border Top', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 425,
			),

			array(
				'name'     => 'colormag_primary_menu_top_border_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#289dcc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_border_top_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 425,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_primary_menu_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 505,
			),

			// Primary Menu.
			array(
				'name'     => 'colormag_primary_menu_typography_group',
				'label'    => esc_html__( 'Primary Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 510,
			),

			array(
				'name'     => 'colormag_primary_menu_typography_setting',
				'default'  => array(
					'font-family' => 'default',
					'font-weight' => '600',
					'font-size'   => array(
						'desktop' => '14',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_primary_menu_typography_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 510,
			),

			// Sub Menu.
			array(
				'name'     => 'colormag_primary_sub_menu_typography_group',
				'label'    => esc_html__( 'Sub Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 515,
			),

			// Primary sub menu typography option.
			array(
				'name'     => 'colormag_primary_sub_menu_typography_setting',
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
							'min'  => 12,
							'max'  => 30,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-typography',
				'parent'   => 'colormag_primary_sub_menu_typography_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 515,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Primary_Menu_Options();
