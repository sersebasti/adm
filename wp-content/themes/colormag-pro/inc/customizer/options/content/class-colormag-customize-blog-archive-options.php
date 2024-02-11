<?php
/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
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
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
 */
class ColorMag_Customize_Blog_Archive_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_blog_layout_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Layout', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_archive_search_layout',
				'default'  => 'double_column_layout',
				'type'     => 'control',
				'control'  => 'radio',
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'double_column_layout' => esc_html__( 'Default (First image large and other two side by side)', 'colormag' ),
					'single_column_layout' => esc_html__( 'One Column (Featured image on left and post excerpt on right)', 'colormag' ),
					'full_width_layout'    => esc_html__( 'Full Width (Featured image on top and post excerpt below)', 'colormag' ),
					'grid_layout'          => esc_html__( 'Grid Layout (Featured image on top and post excerpt below in two column grid)', 'colormag' ),
				),
				'priority' => 20,
			),

			array(
				'name'       => 'colormag_grid_layout_column',
				'default'    => 'two',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Columns', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'choices'    => array(
					'two'   => esc_html__( '2', 'colormag' ),
					'three' => esc_html__( '3', 'colormag' ),
					'four'  => esc_html__( '4', 'colormag' ),
				),
				'dependency' => array(
					'colormag_archive_search_layout',
					'===',
					'grid_layout',
				),
				'priority'   => 25,
			),

			array(
				'name'     => 'colormag_blog_breadcrumb_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Breadcrumb', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 40,
			),

			// Breadcrumb enable/disable option.
			array(
				'name'     => 'colormag_breadcrumb_display',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to display the breadcrumb. Note: Supports BreadCrumb NavXT plugin and Yoast SEO BreadCrumb settings.', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 50,
			),

			array(
				'name'       => 'colormag_breadcrumb_label',
				'default'    => esc_html__( 'You are here:', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Breadcrumb Label', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.breadcrumbs .breadcrumb-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_breadcrumb_label',
					),
				),
				'dependency' => array(
					'colormag_breadcrumb_display',
					'!=',
					0,
				),
				'priority'   => 60,
			),

			array(
				'name'     => 'colormag_blog_featured_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 60,
			),

			// Featured image caption display enable/disable option.
			array(
				'name'      => 'colormag_featured_image_caption_show',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to show the image caption under the featured image in archive, search as well as the single post page.', 'colormag' ),
				'section'   => 'colormag_blog_archive_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.featured-image-caption',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_featured_image_caption',
					),
				),
				'priority'  => 70,
			),

			array(
				'name'     => 'colormag_blog_post_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 80,
			),

			// Post title length input number field.
			array(
				'name'      => 'colormag_blog_post_title_length',
				'default'   => '',
				'type'      => 'control',
				'control'   => 'number',
				'label'     => esc_html__( 'Number of Words', 'colormag' ),
				'section'   => 'colormag_blog_archive_section',
				'transport' => 'refresh',
				'priority'  => 90,
			),

			array(
				'name'     => 'colormag_blog_content_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Content', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 100,
			),

			// Archive pages content display type option.
			array(
				'name'     => 'colormag_archive_content_excerpt_display',
				'default'  => 'excerpt',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose to display the post content or excerpt:', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'excerpt' => esc_html__( '(Default) Display Excerpt', 'colormag' ),
					'content' => esc_html__( 'Display Content', 'colormag' ),
				),
				'priority' => 110,
			),

			// Archive pages content display type important notice.
			array(
				'name'     => 'colormag_custom_information_for_content_display_type',
				'type'     => 'control',
				'control'  => 'colormag-custom',
				'label'    => esc_html__( 'Important Notice:', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'info'     => sprintf(
				/* Translators: %1$s: Strong tag open, %2$s: Strong tag close */
					esc_html__(
						'The content will only be displayed if you have chosen %1$sOne Column (Featured image on left and post excerpt on right)%2$s or %1$sFull Width (Featured image on top and post excerpt below)%2$s option in %1$sBlog/Archive and Search Pages Layout%2$s under the %1$sDesign Settings%2$s.',
						'colormag'
					),
					'<strong>',
					'</strong>'
				),
				'priority' => 120,
			),

			// Excerpt length option.
			array(
				'name'       => 'colormag_excerpt_length_setting',
				'default'    => 20,
				'type'       => 'control',
				'control'    => 'number',
				'label'      => esc_html__( 'Excerpt Length', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'dependency' => array(
					'colormag_archive_content_excerpt_display',
					'===',
					'excerpt',
				),
				'priority'   => 130,
			),

			// Read more text change option.
			array(
				'name'       => 'colormag_excerpt_more_text',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Change Excerpt More Text', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'dependency' => array(
					'colormag_archive_content_excerpt_display',
					'===',
					'excerpt',
				),
				'priority'   => 140,
			),

			// Read More title
			array(
				'name'     => 'colormag_read_more_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Read More', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 150,
			),

			// Enable Read More Button.
			array(
				'name'       => 'colormag_enable_read_more',
				'default'    => 'button',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Type', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'choices'    => array(
					'none'   => esc_html__( 'None', 'colormag' ),
					'button' => esc_html__( 'Button', 'colormag' ),
				),
				'dependency' => array(
					'colormag_archive_content_excerpt_display',
					'===',
					'excerpt',
				),
				'priority'   => 160,
			),

			// Read more text change option.
			array(
				'name'       => 'colormag_read_more_text',
				'default'    => esc_html__( 'Read more', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Change Read More Text', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.more-link span',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_read_more_text',
					),
				),
				'dependency' => array(
					'colormag_enable_read_more',
					'!=',
					'none',
				),
				'priority'   => 170,
			),

			array(
				'name'     => 'colormag_pagination_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Pagination', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 180,
			),

			array(
				'name'     => 'colormag_post_pagination',
				'default'  => 'default',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'default'             => esc_html__( 'Default', 'colormag' ),
					'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
					'infinite_scroll'     => esc_html__( 'Infinite Scroll', 'colormag' ),
				),
				'priority' => 190,
			),

			array(
				'name'     => 'colormag_infinite_scroll_event',
				'default'  => 'button',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'button' => esc_html__( 'Button', 'colormag' ),
					'scroll' => esc_html__( 'Scroll', 'colormag' ),
				),
				'priority' => 200,
				'dependency' => array(
					'colormag_post_pagination',
					'===',
					'infinite_scroll',
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Blog_Archive_Options();
