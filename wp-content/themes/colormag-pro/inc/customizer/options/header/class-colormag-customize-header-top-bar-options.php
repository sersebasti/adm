<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
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
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
 */
class ColorMag_Customize_Header_Top_Bar_Options extends ColorMag_Customize_Base_Option {

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
			 * Show Date.
			 */
			array(
				'name'     => 'colormag_date_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Show Date', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 10,
			),

			// Date in header display option.
			array(
				'name'        => 'colormag_date_display',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show the date in header', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_current_date',
					),
				),
				'priority'    => 20,
			),

			// Date in header display type option.
			array(
				'name'        => 'colormag_date_display_type',
				'default'     => 'theme_default',
				'type'        => 'control',
				'control'     => 'radio',
				'label'       => esc_html__( 'Date Format', 'colormag' ),
				'description' => esc_html__( 'Date in header display type:', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'transport'   => $customizer_selective_refresh,
				'choices'     => array(
					'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
					'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
				),
				'partial'     => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_date_display_type',
					),
				),
				'dependency'  => array(
					'colormag_date_display',
					'!=',
					0,
				),
				'priority'    => 30,
			),

			/**
			 * Breaking news.
			 */
			// Breaking news heading separator.
			array(
				'name'     => 'colormag_breaking_news_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Breaking News', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 40,
			),

			// Breaking news in header enable/disable option.
			array(
				'name'        => 'colormag_breaking_news',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'priority'    => 50,
			),

			// Breaking news position option.
			array(
				'name'        => 'colormag_breaking_news_position_options',
				'default'     => 'header',
				'type'        => 'control',
				'control'     => 'radio',
				'label'       => esc_html__( 'Position', 'colormag' ),
				'description' => esc_html__( 'Choose the location/area to place the Breaking News', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'choices'     => array(
					'header' => esc_html__( 'Header', 'colormag' ),
					'main'   => esc_html__( 'Below Navigation', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 60,
			),

			// Breaking news display posts via latest posts or from specific category option.
			array(
				'name'        => 'colormag_breaking_news_category_option',
				'default'     => 'latest',
				'type'        => 'control',
				'control'     => 'radio',
				'label'       => esc_html__( 'Filter', 'colormag' ),
				'description' => esc_html__( 'Choose the required option to display the latest posts from:', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'choices'     => array(
					'latest'   => esc_html__( 'Latest Posts', 'colormag' ),
					'category' => esc_html__( 'Category', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 70,
			),

			// Breaking news category choose option.
			array(
				'name'        => 'colormag_breaking_news_category',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'colormag-dropdown-categories',
				'label'       => esc_html__( 'Category', 'colormag' ),
				'description' => esc_html__( 'Choose the required category to display as the latest posts:', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'dependency'  => array(
					'conditions' => array(
						array(
							'colormag_breaking_news',
							'!=',
							0,
						),
						array(
							'colormag_breaking_news_category_option',
							'==',
							'category',
						),
					),
				),
				'priority'    => 80,
			),

			// Breaking news text content option.
			array(
				'name'        => 'colormag_breaking_news_content_option',
				'default'     => esc_html__( 'Latest:', 'colormag' ),
				'type'        => 'control',
				'control'     => 'text',
				'label'       => esc_html__( 'Title', 'colormag' ),
				'description' => esc_html__( 'Enter the text to display for the ticker news', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector'        => '.breaking-news-latest',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_breaking_news_text',
					),
				),
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 90,
			),

			// Breaking news animation style option.
			array(
				'name'        => 'colormag_breaking_news_setting_animation_options',
				'default'     => 'down',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Animation Style', 'colormag' ),
				'description' => esc_html__( 'Choose the animation style for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'choices'     => array(
					'up'   => esc_html__( 'Up', 'colormag' ),
					'down' => esc_html__( 'Down', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 100,
			),

			// Breaking news duration time option.
			array(
				'name'        => 'colormag_breaking_news_duration_setting_options',
				'default'     => 4,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Transition Duration', 'colormag' ),
				'description' => esc_html__( 'Enter the duration time for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 110,
			),

			// Breaking news speed time option.
			array(
				'name'        => 'colormag_breaking_news_speed_setting_options',
				'default'     => 1,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Transition Speed', 'colormag' ),
				'description' => esc_html__( 'Enter the speed time for the Breaking News in the Header', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'dependency'  => array(
					'colormag_breaking_news',
					'!=',
					0,
				),
				'priority'    => 120,
			),

			// Social Icons.
			array(
				'name'     => 'colormag_top_bar_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 130,
			),

			array(
				'name'          => 'colormag_top_bar_social_icons_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_top_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_social_icons_section',
					'target_label' => esc_html__( 'Social Icons', 'colormag' ),
				),
				'priority'      => 140,
			),

			// Menu.
			array(
				'name'     => 'colormag_top_bar_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Menu', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 150,
			),

			array(
				'name'     => 'colormag_top_bar_menu_enable',
				'type'     => 'control',
				'default'  => 0,
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 160,
			),

			array(
				'name'          => 'colormag_top_bar_menu',
				'default'       => 0,
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_top_bar_section',
				'navigate_info' => array(
					'target_id'    => 'add_menu',
					'target_label' => esc_html__( 'Menus', 'colormag' ),
				),
				'priority'      => 170,
				'dependency'    => array(
					'colormag_top_bar_menu_enable',
					'==',
					'1',
				),
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Header_Top_Bar_Options();
