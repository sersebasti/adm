<?php
/**
 * Migration scripts for ColorMag theme.
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
 * Migrate all of the customize options for 3.0.0 theme update.
 *
 * @since ColorMag 3.0.0
 */
function colormag_major_update_v1_customize_migrate() {

	$demo_import_migration = colormag_demo_import_migration();

	// Migrate the customize option if migration is done manually.
	if ( ! $demo_import_migration ) {

		// Bail out if the migration is already done.
		if ( get_option( 'colormag_major_update_v1_customize_migrate' ) ) {
			return;
		}
	}

	/**
	 * Assign the required variables.
	 */
	// Header.
	$header_background_color           = get_theme_mod( 'colormag_header_background_color', '#ffffff' );
	$site_title_font_family            = get_theme_mod( 'colormag_site_title_font', 'Open Sans' );
	$site_title_font_size              = get_theme_mod( 'colormag_title_font_size', '46' );
	$site_tagline_font_family          = get_theme_mod( 'colormag_site_tagline_font', 'Open Sans' );
	$site_tagline_font_size            = get_theme_mod( 'colormag_tagline_font_size', '16' );
	$primary_menu_background_color     = get_theme_mod( 'colormag_primary_menu_background_color', '#232323' );
	$primary_sub_menu_background_color = get_theme_mod( 'colormag_primary_sub_menu_background_color', '#232323' );
	$primary_menu_font_family          = get_theme_mod( 'colormag_primary_menu_font', 'Open Sans' );
	$primary_menu_font_size            = get_theme_mod( 'colormag_primary_menu_font_size', '14' );
	$primary_sub_menu_font_size        = get_theme_mod( 'colormag_primary_sub_menu_font_size', '14' );


	// Content.
	$post_title_font_size = get_theme_mod( 'colormag_post_title_font_size', '32' );
	$page_title_font_size = get_theme_mod( 'colormag_page_title_font_size', '34' );
	$post_meta_font_size  = get_theme_mod( 'colormag_post_meta_font_size', '12' );
	$button_font_size     = get_theme_mod( 'colormag_button_text_font_size', '12' );
	$post_content_color   = get_theme_mod( 'colormag_content_section_background_color', '#ffffff' );


	// Footer.
	$footer_background_image              = get_theme_mod( 'colormag_footer_background_image' );
	$footer_background_image_position     = get_theme_mod( 'colormag_footer_background_image_position', 'center-center' );
	$footer_background_size               = get_theme_mod( 'colormag_footer_background_image_size', 'auto' );
	$footer_background_attachment         = get_theme_mod( 'colormag_footer_background_image_attachment', 'scroll' );
	$footer_background_repeat             = get_theme_mod( 'colormag_footer_background_image_repeat', 'repeat' );
	$footer_copyright_background_color    = get_theme_mod( 'colormag_footer_copyright_part_background_color', '' );
	$footer_copyright_text_font_size      = get_theme_mod( 'colormag_footer_copyright_text_font_size', '14' );
	$footer_small_menu_font_size          = get_theme_mod( 'colormag_footer_small_menu_font_size', '14' );
	$footer_widget_background_color       = get_theme_mod( 'colormag_footer_widget_background_color', '' );
	$upper_footer_widget_background_color = get_theme_mod( 'colormag_upper_footer_widget_background_color', '#2c2e34' );


	// Typography.
	$content_font                    = get_theme_mod( 'colormag_content_font', 'Open Sans' );
	$content_font_size               = get_theme_mod( 'colormag_content_font_size', '15' );
	$all_titles_font                 = get_theme_mod( 'colormag_all_titles_font', 'Open Sans' );
	$heading_h1_font_size            = get_theme_mod( 'colormag_heading_h1_font_size', '36' );
	$heading_h2_font_size            = get_theme_mod( 'colormag_heading_h2_font_size', '32' );
	$heading_h3_font_size            = get_theme_mod( 'colormag_heading_h3_font_size', '28' );
	$heading_h4_font_size            = get_theme_mod( 'colormag_heading_h4_font_size', '24' );
	$heading_h5_font_size            = get_theme_mod( 'colormag_heading_h5_font_size', '22' );
	$heading_h6_font_size            = get_theme_mod( 'colormag_heading_h6_font_size', '18' );
	$widget_title_font_size          = get_theme_mod( 'colormag_widget_title_font_size', '18' );
	$comment_title_font_size         = get_theme_mod( 'colormag_comment_title_font_size', '24' );
	$footer_widget_title_font_size   = get_theme_mod( 'colormag_footer_widget_title_font_size', '18' );
	$footer_widget_content_font_size = get_theme_mod( 'colormag_footer_widget_content_font_size', '14' );


	/**
	 * Update the theme mods data.
	 */
	/**
	 * Header options.
	 */
	// Header background.
	if ( '#ffffff' !== $header_background_color ) {
		set_theme_mod(
			'colormag_header_background_setting',
			array(
				'background-color'      => $header_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}

	// Site title.
	if ( 'Open Sans' !== $site_title_font_family || '46' !== $site_title_font_size ) {
		set_theme_mod(
			'colormag_site_title_typography_setting',
			array(
				'font-family' => $site_title_font_family,
				'font-size'   => array(
					'desktop' => $site_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Site tagline.
	if ( 'Open Sans' !== $site_tagline_font_family || '16' !== $site_tagline_font_size ) {
		set_theme_mod(
			'colormag_site_tagline_typography_setting',
			array(
				'font-family' => $site_tagline_font_family,
				'font-size'   => array(
					'desktop' => $site_tagline_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Primary menu background.
	if ( '#232323' !== $primary_menu_background_color ) {
		set_theme_mod(
			'colormag_primary_menu_background_setting',
			array(
				'background-color'      => $primary_menu_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}

	// Primary sub menu background.
	if ( '#232323' !== $primary_sub_menu_background_color ) {
		set_theme_mod(
			'colormag_primary_sub_menu_background_setting',
			array(
				'background-color'      => $primary_sub_menu_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}

	// Primary menu fonts.
	if ( 'Open Sans' !== $primary_menu_font_family || '14' !== $primary_menu_font_size ) {
		set_theme_mod(
			'colormag_primary_menu_typography_setting',
			array(
				'font-family' => $primary_menu_font_family,
				'font-weight' => '400',
				'font-size'   => array(
					'desktop' => $primary_menu_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Primary sub menu fonts.
	if ( '14' !== $primary_sub_menu_font_size ) {
		set_theme_mod(
			'colormag_primary_sub_menu_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $primary_sub_menu_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}


	/**
	 * Post/Page/Blog options.
	 */
	// Post title fonts.
	if ( '32' !== $post_title_font_size ) {
		set_theme_mod(
			'colormag_post_title_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $post_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Page title fonts.
	if ( '34' !== $page_title_font_size ) {
		set_theme_mod(
			'colormag_page_title_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $page_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Post meta fonts.
	if ( '12' !== $post_meta_font_size ) {
		set_theme_mod(
			'colormag_post_meta_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $post_meta_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Button fonts.
	if ( '12' !== $button_font_size ) {
		set_theme_mod(
			'colormag_button_typography_setting',
			array(
				'font-family'    => 'Open Sans',
				'font-weight'    => 'regular',
				'subsets'        => array( 'latin' ),
				'font-size'      => array(
					'desktop' => $button_font_size,
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
			)
		);
	}

	// Post content background.
	if ( '#ffffff' !== $post_content_color ) {
		set_theme_mod(
			'colormag_inside_container_background',
			array(
				'background-color'      => $post_content_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}


	/**
	 * Footer options.
	 */
	// Footer background.
	if ( $footer_background_image || 'center-center' !== $footer_background_image_position || 'auto' !== $footer_background_size || 'scroll' !== $footer_background_attachment || 'repeat' !== $footer_background_repeat ) {
		set_theme_mod(
			'colormag_footer_background_setting',
			array(
				'background-color'      => '',
				'background-image'      => $footer_background_image,
				'background-position'   => str_replace( '-', ' ', $footer_background_image_position ),
				'background-size'       => $footer_background_size,
				'background-attachment' => $footer_background_attachment,
				'background-repeat'     => $footer_background_repeat,
			)
		);
	}

	// Footer copyright background.
	if ( '' !== $footer_copyright_background_color ) {
		set_theme_mod(
			'colormag_footer_copyright_background_setting',
			array(
				'background-color'      => $footer_copyright_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}

	// Footer copyright fonts.
	if ( '14' !== $footer_copyright_text_font_size ) {
		set_theme_mod(
			'colormag_footer_copyright_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $footer_copyright_text_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Footer menu fonts.
	if ( '14' !== $footer_small_menu_font_size ) {
		set_theme_mod(
			'colormag_footer_menu_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $footer_small_menu_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Footer sidebar area background.
	if ( '' !== $footer_widget_background_color ) {
		set_theme_mod(
			'colormag_footer_sidebar_area_background_setting',
			array(
				'background-color'      => $footer_widget_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}

	// Upper footer sidebar area background.
	if ( '#2c2e34' !== $upper_footer_widget_background_color ) {
		set_theme_mod(
			'colormag_footer_upper_sidebar_area_background_setting',
			array(
				'background-color'      => $upper_footer_widget_background_color,
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			)
		);
	}


	/**
	 * Typography options.
	 */
	// Base fonts.
	if ( 'Open Sans' !== $content_font || '15' !== $content_font_size ) {
		set_theme_mod(
			'colormag_base_typography_setting',
			array(
				'font-family'    => $content_font,
				'font-weight'    => 'regular',
				'subsets'        => array( 'latin' ),
				'font-size'      => array(
					'desktop' => $content_font_size,
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
				'font-style'     => 'normal',
				'text-transform' => 'none',
			)
		);
	}

	// All title fonts.
	if ( 'Open Sans' !== $all_titles_font ) {
		set_theme_mod(
			'colormag_headings_typography_setting',
			array(
				'font-family'    => $all_titles_font,
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
			)
		);
	}

	// Heading H1 fonts.
	if ( '36' !== $heading_h1_font_size ) {
		set_theme_mod(
			'colormag_h1_typography_setting',
			array(
				'font-family'    => 'Open Sans',
				'font-weight'    => 'regular',
				'subsets'        => array( 'latin' ),
				'font-size'      => array(
					'desktop' => $heading_h1_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
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
			)
		);
	}

	// Heading H2 fonts.
	if ( '32' !== $heading_h2_font_size ) {
		set_theme_mod(
			'colormag_h2_typography_setting',
			array(
				'font-family'    => 'Open Sans',
				'font-weight'    => 'regular',
				'subsets'        => array( 'latin' ),
				'font-size'      => array(
					'desktop' => $heading_h2_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
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
			)
		);
	}

	// Heading H3 fonts.
	if ( '28' !== $heading_h3_font_size ) {
		set_theme_mod(
			'colormag_h3_typography_setting',
			array(
				'font-family'    => 'Open Sans',
				'font-weight'    => 'regular',
				'subsets'        => array( 'latin' ),
				'font-size'      => array(
					'desktop' => $heading_h3_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
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
			)
		);
	}

	// Heading H4 fonts.
	if ( '24' !== $heading_h4_font_size ) {
		set_theme_mod(
			'colormag_h4_typography_setting',
			array(
				'font-size'   => array(
					'desktop' => $heading_h4_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
				'line-height' => array(
					'desktop' => '1.2',
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Heading H5 fonts.
	if ( '22' !== $heading_h5_font_size ) {
		set_theme_mod(
			'colormag_h5_typography_setting',
			array(
				'font-size'   => array(
					'desktop' => $heading_h5_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
				'line-height' => array(
					'desktop' => '1.2',
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Heading H6 fonts.
	if ( '18' !== $heading_h6_font_size ) {
		set_theme_mod(
			'colormag_h6_typography_setting',
			array(
				'font-size'   => array(
					'desktop' => $heading_h6_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
				'line-height' => array(
					'desktop' => '1.2',
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Widget title fonts.
	if ( '18' !== $widget_title_font_size ) {
		set_theme_mod(
			'colormag_widget_title_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $widget_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Comment title fonts.
	if ( '24' !== $comment_title_font_size ) {
		set_theme_mod(
			'colormag_comment_title_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $comment_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Footer widget title fonts.
	if ( '18' !== $footer_widget_title_font_size ) {
		set_theme_mod(
			'colormag_footer_widget_title_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $footer_widget_title_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}

	// Footer widget content fonts.
	if ( '14' !== $footer_widget_content_font_size ) {
		set_theme_mod(
			'colormag_footer_widget_content_typography_setting',
			array(
				'font-size' => array(
					'desktop' => $footer_widget_content_font_size,
					'tablet'  => '',
					'mobile'  => '',
				),
			)
		);
	}


	/**
	 * Remove unrequired theme mods datas.
	 */
	$remove_theme_mod_settings = array(

		// Header options.
		'colormag_site_title_font',
		'colormag_title_font_size',
		'colormag_site_tagline_font',
		'colormag_tagline_font_size',
		'colormag_header_background_color',
		'colormag_primary_menu_background_color',
		'colormag_primary_sub_menu_background_color',
		'colormag_primary_menu_font',
		'colormag_primary_menu_font_size',
		'colormag_primary_sub_menu_font_size',


		// Post/Page/Blog options.
		'colormag_post_title_font_size',
		'colormag_page_title_font_size',
		'colormag_post_meta_font_size',
		'colormag_button_text_font_size',
		'colormag_content_section_background_color',


		// Footer options.
		'colormag_footer_background_image',
		'colormag_footer_background_image_position',
		'colormag_footer_background_image_size',
		'colormag_footer_background_image_attachment',
		'colormag_footer_background_image_repeat',
		'colormag_footer_copyright_part_background_color',
		'colormag_footer_copyright_text_font_size',
		'colormag_footer_small_menu_font_size',
		'colormag_footer_widget_background_color',
		'colormag_upper_footer_widget_background_color',


		// Typography options.
		'colormag_content_font',
		'colormag_content_font_size',
		'colormag_all_titles_font',
		'colormag_heading_h1_font_size',
		'colormag_heading_h2_font_size',
		'colormag_heading_h3_font_size',
		'colormag_heading_h4_font_size',
		'colormag_heading_h5_font_size',
		'colormag_heading_h6_font_size',
		'colormag_widget_title_font_size',
		'colormag_comment_title_font_size',
		'colormag_footer_widget_title_font_size',
		'colormag_footer_widget_content_font_size',

	);

	// Loop through the theme mods to remove them.
	foreach ( $remove_theme_mod_settings as $remove_theme_mod_setting ) {
		remove_theme_mod( $remove_theme_mod_setting );
	}

	// Set flag to not repeat the migration process, ie, run it only once.
	update_option( 'colormag_major_update_v1_customize_migrate', true );

	// Set flag for demo import migration to not repeat the migration process, ie, run it only once.
	if ( $demo_import_migration ) {
		update_option( 'colormag_demo_import_migration_notice_dismiss', true );
	}

}

add_action( 'after_setup_theme', 'colormag_major_update_v1_customize_migrate' );

function colormag_social_icons_control_migrate() {

	$social_icon     = get_theme_mod( 'colormag_social_link_activate', 0 );
	$social_icon_visibility = get_theme_mod( 'colormag_social_link_location_option', 'both' );

	// Disable social icon on header if enabled on footer only.
	if ( 0 !== $social_icon ) {
		set_theme_mod( 'colormag_social_icons_activate', true );
	}


	// Disable social icon on header if enabled on footer only.
	if ( 'footer' === $social_icon_visibility ) {
		set_theme_mod( 'colormag_social_icons_header_activate', false );
	}

	// Disable social icon on footer if enabled on header only.
	if ( 'header' === $social_icon_visibility ) {
		set_theme_mod( 'colormag_social_icons_footer_activate', false );
	}

	$remove_theme_mod_settings = array(
		'colormag_social_link_activate',
		'colormag_social_link_location_option'
	);

	// Loop through the theme mods to remove them.
	foreach ( $remove_theme_mod_settings as $remove_theme_mod_setting ) {
		remove_theme_mod( $remove_theme_mod_setting );
	}

	// Set flag to not repeat the migration process, ie, run it only once.
	update_option( 'colormag_social_icons_control_migrate', true );

}

add_action( 'after_setup_theme', 'colormag_social_icons_control_migrate' );
