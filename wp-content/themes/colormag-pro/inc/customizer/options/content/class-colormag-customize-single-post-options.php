<?php
/**
 * Class to include Blog Single Post customize options.
 *
 * Class ColorMag_Customize_Single_Post_Options
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
 * Class to include Blog Single Post customize options.
 *
 * Class ColorMag_Customize_Single_Post_Options
 */
class ColorMag_Customize_Single_Post_Options extends ColorMag_Customize_Base_Option {

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
			 * Load Next Post.
			 */
			array(
				'name'     => 'colormag_load_next_post_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Load Next Post', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_load_next_post',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 10,
			),

			array(
				'name'       => 'colormag_load_next_post_event',
				'default'    => 'button',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'button' => esc_html__( 'Button', 'colormag' ),
					'scroll' => esc_html__( 'Scroll', 'colormag' ),
				),
				'priority'   => 10,
				'dependency' => array(
					'colormag_load_next_post',
					'!=',
					0,
				),
			),

			array(
				'name'        => 'colormag_load_next_post_limit',
				'default'     => 2,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Number of Posts', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 10,
				'input_attrs' => array(
					'min' => 1,
					'max' => 5,
				),
				'dependency'  => array(
					'colormag_load_next_post',
					'!=',
					0,
				),
			),

			/**
			 * Author Bio.
			 */
			array(
				'name'     => 'colormag_author_bio_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Author Bio', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 10,
			),

			array(
				'name'        => 'colormag_author_bio_disable_setting',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Disable', 'colormag' ),
				'description' => esc_html__( 'Check to disable the Author Bio', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 20,
			),

			array(
				'name'       => 'colormag_author_bio_social_sites_show',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to show the Social Profiles in the Author Bio', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.author-social-sites',
				),
				'dependency' => array(
					'colormag_author_bio_disable_setting',
					'!=',
					1,
				),
				'priority'   => 30,
			),

			array(
				'name'       => 'colormag_author_bio_links',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to display the link to the author page in the Author Bio section', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.author-url',
				),
				'dependency' => array(
					'colormag_author_bio_disable_setting',
					'!=',
					1,
				),
				'priority'   => 40,
			),

			array(
				'name'       => 'colormag_author_bio_style_setting',
				'default'    => 'style_one',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Choose the author bio layout as needed.', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'style_one'   => esc_html__( 'Style 1', 'colormag' ),
					'style_two'   => esc_html__( 'Style 2', 'colormag' ),
					'style_three' => esc_html__( 'Style 3', 'colormag' ),
				),
				'dependency' => array(
					'colormag_author_bio_disable_setting',
					'!=',
					1,
				),
				'priority'   => 50,
			),

			/**
			 * Featured Image.
			 */
			array(
				'name'     => 'colormag_single_featured_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 70,
			),

			array(
				'name'        => 'colormag_featured_image_show',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Disable', 'colormag' ),
				'description' => esc_html__( 'Check to hide the featured image in single post page.', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 80,
			),

			array(
				'name'        => 'colormag_single_post_title_position',
				'default'     => 'below',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Position', 'colormag' ),
				'description' => esc_html__( 'Post Title Position', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'choices'     => array(
					'above' => esc_html__( 'Above featured image', 'colormag' ),
					'below' => esc_html__( 'Below featured image', 'colormag' ),
				),
				'priority'    => 90,
			),

			array(
				'name'       => 'colormag_featured_image_popup',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to enable the lightbox for the featured images in single post', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'colormag_featured_image_show',
					'!=',
					1,
				),
				'priority'   => 100,
			),

			/**
			 * Social Share.
			 */
			array(
				'name'     => 'colormag_single_post_social_share_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Share Button', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 110,
			),

			array(
				'name'        => 'colormag_social_share',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate social share buttons in single post', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.share-buttons',
				),
				'priority'    => 120,
			),

			array(
				'name'       => 'colormag_social_share_twitter',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Twitter', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_social_share',
					'!=',
					0,
				),
				'priority'   => 122,
			),

			array(
				'name'       => 'colormag_social_share_facebook',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Facebook', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_social_share',
					'!=',
					0,
				),
				'priority'   => 122,
			),

			array(
				'name'       => 'colormag_social_share_pinterest',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Pinterest', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_social_share',
					'!=',
					0,
				),
				'priority'   => 122,
			),

			/**
			 * Post Navigation options.
			 */
			// Post Navigation heading separator.
			array(
				'name'     => 'colormag_post_navigation_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Navigation', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 130,
			),

			// Single post navigation option.
			array(
				'name'        => 'colormag_post_navigation_hide',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Disable', 'colormag' ),
				'description' => esc_html__( 'Disable post navigation', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 140,
			),

			// Single post navigation display type option.
			array(
				'name'       => 'colormag_post_navigation',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Post navigation to be shown as:', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'default'               => esc_html__( 'Default Layout', 'colormag' ),
					'small_featured_image'  => esc_html__( 'Featured image with post title', 'colormag' ),
					'medium_featured_image' => esc_html__( 'Featured image with post title (Style 2)', 'colormag' ),
				),
				'dependency' => array(
					'colormag_post_navigation_hide',
					'!=',
					1,
				),
				'priority'   => 150,
			),

			/**
			 * Related posts options.
			 */
			array(
				'name'     => 'colormag_related_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Related Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 160,
			),

			array(
				'name'        => 'colormag_related_posts_activate',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate the related posts', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.related-posts',
				),
				'priority'    => 170,
			),

			array(
				'name'       => 'colormag_related_posts',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Related Posts Must Be Shown As:', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'colormag' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'colormag' ),
				),
				'dependency' => array(
					'colormag_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 180,
			),

			array(
				'name'       => 'colormag_related_post_number_display',
				'default'    => '3',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Number of post to display', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'3' => esc_html__( '3', 'colormag' ),
					'6' => esc_html__( '6', 'colormag' ),
				),
				'dependency' => array(
					'colormag_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 190,
			),

			array(
				'name'       => 'colormag_related_posts_layout',
				'default'    => 'style_one',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Choose the related posts layout as needed.', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'style_one'   => esc_html__( 'Style 1', 'colormag' ),
					'style_two'   => esc_html__( 'Style 2', 'colormag' ),
					'style_three' => esc_html__( 'Style 3', 'colormag' ),
					'style_four'  => esc_html__( 'Style 4', 'colormag' ),
				),
				'dependency' => array(
					'colormag_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 200,
			),

			array(
				'name'       => 'colormag_you_may_also_like_text',
				'default'    => esc_html__( 'You May Also Like', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Change You May Also Like Text', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.related-posts-main-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_you_may_also_like_text',
					),
				),
				'dependency' => array(
					'colormag_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 210,
			),

			/**
			 * Flyout related posts options.
			 */
			array(
				'name'     => 'colormag_flyout_related_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Flyout Related Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 220,
			),

			array(
				'name'     => 'colormag_related_post_flyout_setting',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to display the related post when browser scrolls at end.', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 230,
			),

			array(
				'name'       => 'colormag_related_posts_flyout_type',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Related Posts Must Be Shown As:', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'colormag' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'colormag' ),
				),
				'dependency' => array(
					'colormag_related_post_flyout_setting',
					'!=',
					0,
				),
				'priority'   => 240,
			),

			array(
				'name'       => 'colormag_read_next_text',
				'default'    => esc_html__( 'Read Next', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Change the Read Next text as required for your site.', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.related-posts-flyout-main-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_read_next_text',
					),
				),
				'dependency' => array(
					'colormag_related_post_flyout_setting',
					'!=',
					0,
				),
				'priority'   => 250,
			),

			/**
			 * Reading progress indicator options.
			 */
			array(
				'name'     => 'colormag_reading_progress_indicator_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Reading Progress Indicator', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 260,
			),

			array(
				'name'     => 'colormag_prognroll_indicator',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to activate the reading progress indicator in single post page.', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 270,
			),

			array(
				'name'       => 'colormag_progress_bar_bgcolor',
				'default'    => '#222222',
				'type'       => 'control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Progress Bar Color', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'colormag_prognroll_indicator',
					'!=',
					0,
				),
				'priority'   => 280,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_single_post_title_color_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Colors', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 600,
			),

			array(
				'name'     => 'colormag_single_post_title_color_group',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 610,
			),

			array(
				'name'     => 'colormag_post_title_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#333333',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_single_post_title_color_group',
				'section'  => 'colormag_single_post_section',
				'priority' => 620,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_single_post_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 630,
			),

			array(
				'name'     => 'colormag_single_post_title_typography_group',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 640,
			),

			array(
				'name'        => 'colormag_post_title_typography_setting',
				'default'     => array(
					'font-size' => array(
						'desktop' => '32',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 52,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 52,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 22,
							'max'  => 52,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'colormag-typography',
				'parent'      => 'colormag_single_post_title_typography_group',
				'section'     => 'colormag_single_post_section',
				'priority'    => 650,
			),

			array(
				'name'     => 'colormag_comment_title_typography_group',
				'label'    => esc_html__( 'Comment Title', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 660,
			),

			array(
				'name'        => 'colormag_comment_title_typography_setting',
				'default'     => array(
					'font-size' => array(
						'desktop' => '24',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 42,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 42,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 42,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'colormag-typography',
				'parent'      => 'colormag_comment_title_typography_group',
				'section'     => 'colormag_single_post_section',
				'priority'    => 670,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Single_Post_Options();
