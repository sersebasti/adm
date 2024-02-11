<?php
/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_CSS
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
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_CSS
 */
class ColorMag_Dynamic_CSS {

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css          Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		/**
		 * Variable declarations.
		 */
		// Primary color.
		$primary_color = get_theme_mod( 'colormag_primary_color', '#289dcc' );

		// Link color.
		$link_color       = get_theme_mod( 'colormag_link_color', '#289dcc' );
		$link_hover_color = get_theme_mod( 'colormag_link_hover_color', '#289dcc' );


		// Header options.
		$site_title_color                         = get_theme_mod( 'colormag_site_title_color', '#289dcc' );
		$site_title_hover_color                   = get_theme_mod( 'colormag_site_title_hover_color', '#289dcc' );
		$site_tagline_color                       = get_theme_mod( 'colormag_site_tagline_color', '#666666' );
		$primary_menu_text_color                  = get_theme_mod( 'colormag_primary_menu_text_color', '#ffffff' );
		$primary_menu_selected_hovered_text_color = get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color', '#ffffff' );
		$primary_menu_top_border_color            = get_theme_mod( 'colormag_primary_menu_top_border_color', '#289dcc' );
		$header_background_default                = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$site_title_typography_default            = array(
			'font-family' => 'default',
			'font-size'   => array(
				'desktop' => '46',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$site_tagline_typography_default          = array(
			'font-family' => 'default',
			'font-size'   => array(
				'desktop' => '16',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$primary_menu_background_default          = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_sub_menu_background_default      = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_menu_typography_default          = array(
			'font-family' => 'default',
			'font-weight' => 600,
			'font-size'   => array(
				'desktop' => '14',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$primary_sub_menu_typography_default      = array(
			'font-size' => array(
				'desktop' => '14',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$header_background                        = get_theme_mod( 'colormag_header_background_setting', $header_background_default );
		$site_title_typography                    = get_theme_mod( 'colormag_site_title_typography_setting', $site_title_typography_default );
		$site_tagline_typography                  = get_theme_mod( 'colormag_site_tagline_typography_setting', $site_tagline_typography_default );
		$primary_menu_background                  = get_theme_mod( 'colormag_primary_menu_background_setting', $primary_menu_background_default );
		$primary_sub_menu_background              = get_theme_mod( 'colormag_primary_sub_menu_background_setting', $primary_sub_menu_background_default );
		$primary_menu_typography                  = get_theme_mod( 'colormag_primary_menu_typography_setting', $primary_menu_typography_default );
		$primary_sub_menu_typography              = get_theme_mod( 'colormag_primary_sub_menu_typography_setting', $primary_sub_menu_typography_default );


		// Post/Page/Blog options.
		$post_title_color                = get_theme_mod( 'colormag_post_title_color', '#333333' );
		$page_title_color                = get_theme_mod( 'colormag_page_title_color', '#333333' );
		$post_meta_color                 = get_theme_mod( 'colormag_post_meta_color', '#888888' );
		$button_text_color               = get_theme_mod( 'colormag_button_text_color', '#ffffff' );
		$button_background_color         = get_theme_mod( 'colormag_button_background_color', '#289dcc' );
		$post_title_typography_default   = array(
			'font-size' => array(
				'desktop' => '32',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$page_title_typography_default   = array(
			'font-size' => array(
				'desktop' => '34',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$post_meta_typography_default    = array(
			'font-size' => array(
				'desktop' => '12',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$button_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => '12',
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
		);
		$post_content_background_default = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);

		$post_title_typography   = get_theme_mod( 'colormag_post_title_typography_setting', $post_title_typography_default );
		$page_title_typography   = get_theme_mod( 'colormag_page_title_typography_setting', $page_title_typography_default );
		$post_meta_typography    = get_theme_mod( 'colormag_post_meta_typography_setting', $post_meta_typography_default );
		$button_typography       = get_theme_mod( 'colormag_button_typography_setting', $button_typography_default );
		$post_content_background = get_theme_mod( 'colormag_inside_container_background', $post_content_background_default );


		// Footer options.
		$footer_copyright_color                       = get_theme_mod( 'colormag_footer_copyright_text_color', '#b1b6b6' );
		$footer_copyright_link_color                  = get_theme_mod( 'colormag_footer_copyright_link_text_color', '#b1b6b6' );
		$footer_menu_color                            = get_theme_mod( 'colormag_footer_small_menu_text_color', '#b1b6b6' );
		$footer_menu_hover_color                      = get_theme_mod( 'colormag_footer_small_menu_text_hover_color', '#289dcc' );
		$footer_widget_title_color                    = get_theme_mod( 'colormag_footer_widget_title_color', '#ffffff' );
		$footer_widget_content_color                  = get_theme_mod( 'colormag_footer_widget_content_color', '#ffffff' );
		$footer_widget_content_link_text_color        = get_theme_mod( 'colormag_footer_widget_content_link_text_color', '#ffffff' );
		$footer_widget_content_link_text_hover_color  = get_theme_mod( 'colormag_footer_widget_content_link_text_hover_color', '#289dcc' );
		$footer_background_default                    = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_copyright_background_default          = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_copyright_typography_default          = array(
			'font-size' => array(
				'desktop' => '14',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$footer_menu_typography_default               = array(
			'font-size' => array(
				'desktop' => '14',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$footer_sidebar_area_background_default       = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_upper_sidebar_area_background_default = array(
			'background-color'      => '#2c2e34',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_background                            = get_theme_mod( 'colormag_footer_background_setting', $footer_background_default );
		$footer_copyright_background                  = get_theme_mod( 'colormag_footer_copyright_background_setting', $footer_copyright_background_default );
		$footer_copyright_typography                  = get_theme_mod( 'colormag_footer_copyright_typography_setting', $footer_copyright_typography_default );
		$footer_menu_typography                       = get_theme_mod( 'colormag_footer_menu_typography_setting', $footer_menu_typography_default );
		$footer_sidebar_area_background               = get_theme_mod( 'colormag_footer_sidebar_area_background_setting', $footer_sidebar_area_background_default );
		$footer_upper_sidebar_area_background         = get_theme_mod( 'colormag_footer_upper_sidebar_area_background_setting', $footer_upper_sidebar_area_background_default );


		/**
		 * Color options.
		 */
		$base_color                 = get_theme_mod( 'colormag_content_text_color', '#444444' );
		$headings_color             = get_theme_mod( 'colormag_content_part_title_color', '#333333' );
		$heading_h1_color           = get_theme_mod( 'colormag_h1_color', '#333333' );
		$heading_h2_color           = get_theme_mod( 'colormag_h2_color', '#333333' );
		$heading_h3_color           = get_theme_mod( 'colormag_h3_color', '#333333' );
		$sidebar_widget_title_color = get_theme_mod( 'colormag_sidebar_widget_title_color', '#ffffff' );


		/**
		 * Typography options.
		 */
		$base_typography_default                  = array(
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$headings_typography_default              = array(
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
		);
		$heading_h1_typography_default            = array(
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
			'letter-spacing' => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h2_typography_default            = array(
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
			'letter-spacing' => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h3_typography_default            = array(
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
			'letter-spacing' => array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h4_typography_default            = array(
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
		);
		$heading_h5_typography_default            = array(
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
		);
		$heading_h6_typography_default            = array(
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
		);
		$widget_title_typography_default          = array(
			'font-size' => array(
				'desktop' => '18',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$comment_title_typography_default         = array(
			'font-size' => array(
				'desktop' => '24',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$footer_widget_title_typography_default   = array(
			'font-size' => array(
				'desktop' => '18',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$footer_widget_content_typography_default = array(
			'font-size' => array(
				'desktop' => '14',
				'tablet'  => '',
				'mobile'  => '',
			),
		);
		$base_typography                          = get_theme_mod( 'colormag_base_typography_setting', $base_typography_default );
		$headings_typography                      = get_theme_mod( 'colormag_headings_typography_setting', $headings_typography_default );
		$heading_h1_typography                    = get_theme_mod( 'colormag_h1_typography_setting', $heading_h1_typography_default );
		$heading_h2_typography                    = get_theme_mod( 'colormag_h2_typography_setting', $heading_h2_typography_default );
		$heading_h3_typography                    = get_theme_mod( 'colormag_h3_typography_setting', $heading_h3_typography_default );
		$heading_h4_typography                    = get_theme_mod( 'colormag_h4_typography_setting', $heading_h4_typography_default );
		$heading_h5_typography                    = get_theme_mod( 'colormag_h5_typography_setting', $heading_h5_typography_default );
		$heading_h6_typography                    = get_theme_mod( 'colormag_h6_typography_setting', $heading_h6_typography_default );
		$widget_title_typography                  = get_theme_mod( 'colormag_widget_title_typography_setting', $widget_title_typography_default );
		$comment_title_typography                 = get_theme_mod( 'colormag_comment_title_typography_setting', $comment_title_typography_default );
		$footer_widget_title_typography           = get_theme_mod( 'colormag_footer_widget_title_typography_setting', $footer_widget_title_typography_default );
		$footer_widget_content_typography         = get_theme_mod( 'colormag_footer_widget_content_typography_setting', $footer_widget_content_typography_default );


		// Generate dynamic CSS.
		$parse_css = '';


		// For primary color option.
		$primary_color_css = array(
			'.colormag-button, blockquote, button, input[type=reset], input[type=button], input[type=submit], .home-icon.front_page_on, .main-navigation a:hover, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover>a, .main-navigation ul li.current-menu-ancestor>a, .main-navigation ul li.current-menu-item ul li a:hover, .main-navigation ul li.current-menu-item>a, .main-navigation ul li.current_page_ancestor>a, .main-navigation ul li.current_page_item>a, .main-navigation ul li:hover>a, .main-small-navigation li a:hover, .site-header .menu-toggle:hover, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover > a, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor > a, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item > a, #masthead.colormag-header-clean #site-navigation .menu-toggle:hover, #masthead.colormag-header-clean #site-navigation.main-small-navigation .menu-toggle, #masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle, #masthead .main-small-navigation li:hover > a, #masthead .main-small-navigation li.current-page-ancestor > a, #masthead .main-small-navigation li.current-menu-ancestor > a, #masthead .main-small-navigation li.current-page-item > a, #masthead .main-small-navigation li.current-menu-item > a, #masthead.colormag-header-classic #site-navigation .menu-toggle:hover, .main-navigation ul li.focus > a, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.focus > a, .main-small-navigation .current-menu-item>a, .main-small-navigation .current_page_item>a, #masthead.colormag-header-clean .main-small-navigation li:hover > a, #masthead.colormag-header-clean .main-small-navigation li.current-page-ancestor > a, #masthead.colormag-header-clean .main-small-navigation li.current-menu-ancestor > a, #masthead.colormag-header-clean .main-small-navigation li.current-page-item > a, #masthead.colormag-header-clean .main-small-navigation li.current-menu-item > a, #main .breaking-news-latest, .fa.search-top:hover, .widget_featured_posts .article-content .above-entry-meta .cat-links a, .widget_call_to_action .btn--primary, .colormag-footer--classic .footer-widgets-area .widget-title span::before, .colormag-footer--classic-bordered .footer-widgets-area .widget-title span::before, .widget_featured_posts .widget-title span, .widget_featured_slider .slide-content .above-entry-meta .cat-links a, .widget_highlighted_posts .article-content .above-entry-meta .cat-links a, .category-slide-next, .category-slide-prev, .slide-next, .slide-prev, .tabbed-widget ul li, #content .wp-pagenavi .current,#content .wp-pagenavi a:hover, #secondary .widget-title span,#content .post .article-content .above-entry-meta .cat-links a, .page-header .page-title span, .entry-meta .post-format i, .format-link, .more-link, .infinite-scroll .tg-infinite-scroll, .no-more-post-text, .pagination span, .comments-area .comment-author-link span, .footer-widgets-area .widget-title span, .advertisement_above_footer .widget-title span, .sub-toggle, .error, #primary .widget-title span, .related-posts-wrapper.style-three .article-content .entry-title a:hover:before, .widget_slider_area .widget-title span, .widget_beside_slider .widget-title span, .top-full-width-sidebar .widget-title span, .wp-block-quote, .wp-block-quote.is-style-large, .wp-block-quote.has-text-align-right, .page-numbers .current' => array(
				'background-color' => esc_html( $primary_color ),
			),

			'a, #masthead .main-small-navigation li:hover > .sub-toggle i, #masthead .main-small-navigation li.current-page-ancestor > .sub-toggle i, #masthead .main-small-navigation li.current-menu-ancestor > .sub-toggle i, #masthead .main-small-navigation li.current-page-item > .sub-toggle i, #masthead .main-small-navigation li.current-menu-item > .sub-toggle i, #masthead.colormag-header-classic #site-navigation .fa.search-top:hover, #masthead.colormag-header-classic #site-navigation.main-small-navigation .random-post a:hover .fa-random, #masthead.colormag-header-classic #site-navigation.main-navigation .random-post a:hover .fa-random, #masthead.colormag-header-classic .breaking-news .newsticker a:hover, .dark-skin #masthead.colormag-header-classic #site-navigation.main-navigation .home-icon:hover .fa, #masthead.colormag-header-classic .main-navigation .home-icon a:hover .fa, .byline a:hover, .comments a:hover, .edit-link a:hover, .posted-on a:hover, .social-links:not(.search-random-icons-container .social-links) i.fa:hover, .tag-links a:hover, #masthead.colormag-header-clean .social-links li:hover i.fa, #masthead.colormag-header-classic .social-links li:hover i.fa, #masthead.colormag-header-clean .breaking-news .newsticker a:hover, .widget_featured_posts .article-content .entry-title a:hover, .widget_featured_slider .slide-content .below-entry-meta .byline a:hover, .widget_featured_slider .slide-content .below-entry-meta .comments a:hover, .widget_featured_slider .slide-content .below-entry-meta .posted-on a:hover, .widget_featured_slider .slide-content .entry-title a:hover, .widget_block_picture_news.widget_featured_posts .article-content .entry-title a:hover, .widget_highlighted_posts .article-content .below-entry-meta .byline a:hover, .widget_highlighted_posts .article-content .below-entry-meta .comments a:hover, .widget_highlighted_posts .article-content .below-entry-meta .posted-on a:hover, .widget_highlighted_posts .article-content .entry-title a:hover, i.fa-arrow-up, i.fa-arrow-down, #site-title a, #content .post .article-content .entry-title a:hover, .entry-meta .byline i, .entry-meta .cat-links i, .entry-meta a, .post .entry-title a:hover, .search .entry-title a:hover, .entry-meta .comments-link a:hover, .entry-meta .edit-link a:hover, .entry-meta .posted-on a:hover, .entry-meta .tag-links a:hover, .single #content .tags a:hover, .count, .next a:hover, .previous a:hover, .related-posts-main-title .fa, .single-related-posts .article-content .entry-title a:hover, .pagination a span:hover, #content .comments-area a.comment-edit-link:hover, #content .comments-area a.comment-permalink:hover, #content .comments-area article header cite a:hover, .comments-area .comment-author-link a:hover, .comment .comment-reply-link:hover, .nav-next a, .nav-previous a, #colophon .footer-menu ul li a:hover, .footer-widgets-area a:hover, a#scroll-up i, .main-small-navigation li.current-menu-item > .sub-toggle i, .num-404, .related-posts-wrapper-flyout .entry-title a:hover, .human-diff-time .human-diff-time-display:hover' => array(
				'color' => esc_html( $primary_color ),
			),

			'#site-navigation' => array(
				'border-top-color' => esc_html( $primary_color ),
			),

			'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor, #masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item, #masthead.colormag-header-classic #site-navigation .menu-toggle:hover, #masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle, #masthead.colormag-header-classic .main-navigation ul > li:hover > a, #masthead.colormag-header-classic .main-navigation ul > li.current-menu-item > a, #masthead.colormag-header-classic .main-navigation ul > li.current-menu-ancestor > a, #masthead.colormag-header-classic .main-navigation ul li.focus > a, .pagination a span:hover' => array(
				'border-color' => esc_html( $primary_color ),
			),

			'.widget_featured_posts .widget-title, #secondary .widget-title, #tertiary .widget-title, .page-header .page-title, .footer-widgets-area .widget-title, .advertisement_above_footer .widget-title, #primary .widget-title, .widget_slider_area .widget-title, .widget_beside_slider .widget-title, .top-full-width-sidebar .widget-title' => array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $primary_color, $primary_color_css );

		// Primary color for Elementor.
		if ( defined( 'ELEMENTOR_VERSION' ) ) {

			$primary_color_elementor_css = array(
				'.elementor .elementor-widget-wrap .tg-module-wrapper .module-title span, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-post-category, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-5 .tg_module_block .read-more, .elementor .elementor-widget-wrap .tg-module-wrapper tg-module-block.tg-module-block--style-10 .tg_module_block.tg_module_block--list-small:before' => array(
					'background-color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-module-comments a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-auther-name a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-date a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-title:hover a, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-module-comments a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-post-auther-name a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-post-date a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-module-meta a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-module-title a:hover, .elementor .elementor-widget-wrap .tg-trending-news .trending-news-wrapper a:hover, .elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-next:hover, .elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-prev:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-module-title a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-post-auther-name a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-post-date a:hover, .elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-module-comments a:hover' => array(
					'color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-next:hover, .elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-prev:hover' => array(
					'border-color' => esc_html( $primary_color ),
				),
			);

			$parse_css .= colormag_parse_css( '#289dcc', $primary_color, $primary_color_elementor_css );

		}

		/**
		 * Link options.
		 */
		// Link color.
		$link_color_css = array(
			'.entry-content a' => array(
				'color' => esc_html( $link_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $link_color, $link_color_css );

		// Link hover color.
		$link_hover_color_css = array(
			'.post .entry-content a:hover' => array(
				'color' => esc_html( $link_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $link_hover_color, $link_hover_color_css );


		/**
		 * Header options.
		 */
		// Background.
		$parse_css .= colormag_parse_background_css( $header_background_default, $header_background, '#header-text-nav-container' );

		// Site title color.
		$site_title_color_css = array(
			'#site-title a' => array(
				'color' => esc_html( $site_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $site_title_color, $site_title_color_css );

		// Site title hover color.
		$site_title_hover_color_css = array(
			'#site-title a:hover' => array(
				'color' => esc_html( $site_title_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $site_title_hover_color, $site_title_hover_color_css );

		// Site tagline color.
		$site_tagline_color_css = array(
			'#site-description' => array(
				'color' => esc_html( $site_tagline_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#666666', $site_tagline_color, $site_tagline_color_css );

		// Site title typography.
		$parse_css .= colormag_parse_typography_css(
			$site_title_typography_default,
			$site_title_typography,
			'#site-title a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Site tagline typography.
		$parse_css .= colormag_parse_typography_css(
			$site_tagline_typography_default,
			$site_tagline_typography,
			'#site-description',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Primary menu text color.
		$primary_menu_text_color_css = array(
			'.main-navigation a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a, .main-navigation li.menu-item-has-children>a::after, .main-navigation li.page_item_has_children>a::after' => array(
				'color' => esc_html( $primary_menu_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $primary_menu_text_color, $primary_menu_text_color_css );

		// Primary menu text color.
		$primary_menu_selected_hovered_text_color_css = array(
			'.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover>a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover>a, .main-navigation ul li.current-menu-item ul li a:hover, .main-navigation li.page_item_has_children.current-menu-item>a::after' => array(
				'color' => esc_html( $primary_menu_selected_hovered_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $primary_menu_selected_hovered_text_color, $primary_menu_selected_hovered_text_color_css );

		// Primary menu background.
		$parse_css .= colormag_parse_background_css( $primary_menu_background_default, $primary_menu_background, '#site-navigation, #masthead.colormag-header-clean #site-navigation .inner-wrap, #masthead.colormag-header-clean--full-width #site-navigation' );

		// Primary sub menu background.
		$parse_css .= colormag_parse_background_css( $primary_sub_menu_background_default, $primary_sub_menu_background, '.main-navigation .sub-menu, .main-navigation .children' );

		// Primary menu border top color.
		$primary_menu_top_border_color_css = array(
			'#site-navigation' => array(
				'border-top-color' => esc_html( $primary_menu_top_border_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $primary_menu_top_border_color, $primary_menu_top_border_color_css );

		// Primary menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_menu_typography_default,
			$primary_menu_typography,
			'.main-navigation ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Primary sub menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_sub_menu_typography_default,
			$primary_sub_menu_typography,
			'.main-navigation ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);


		/**
		 * Post/Page/Blog options.
		 */
		// Post title color.
		$post_title_color_css = array(
			'.post .entry-title, #content .post .article-content .entry-title a, #content .post .single-title-above .entry-title a' => array(
				'color' => esc_html( $post_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $post_title_color, $post_title_color_css );

		// Post title typography.
		$parse_css .= colormag_parse_typography_css(
			$post_title_typography_default,
			$post_title_typography,
			'#content .post .article-content .entry-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Page title color.
		$page_title_color_css = array(
			'.type-page .entry-title, .type-page .entry-title a' => array(
				'color' => esc_html( $page_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $page_title_color, $page_title_color_css );

		// Page title typography.
		$parse_css .= colormag_parse_typography_css(
			$page_title_typography_default,
			$page_title_typography,
			'.type-page .entry-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post meta typography.
		$parse_css .= colormag_parse_typography_css(
			$post_meta_typography_default,
			$post_meta_typography,
			'#content .post .article-content .below-entry-meta .posted-on a, #content .post .article-content .below-entry-meta .byline a, #content .post .article-content .below-entry-meta .comments a, #content .post .article-content .below-entry-meta .tag-links a, #content .post .article-content .below-entry-meta .edit-link a, #content .post .article-content .below-entry-meta .total-views',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post meta color.
		$post_meta_color_css = array(
			'.below-entry-meta .posted-on a, .below-entry-meta .byline a, .below-entry-meta .comments a, .below-entry-meta .tag-links a, .below-entry-meta .edit-link a, .below-entry-meta .human-diff-time .human-diff-time-display, #content .post .article-content .below-entry-meta .total-views' => array(
				'color' => esc_html( $post_meta_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#888888', $post_meta_color, $post_meta_color_css );

		// Button meta typography.
		$parse_css .= colormag_parse_typography_css(
			$button_typography_default,
			$button_typography,
			'.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post content background.
		$parse_css .= colormag_parse_background_css( $post_content_background_default, $post_content_background, '#main' );

		// Button text color.
		$button_text_color_css = array(
			'.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span' => array(
				'color' => esc_html( $button_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $button_text_color, $button_text_color_css );

		// Button background color.
		$button_background_color_css = array(
			'.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span' => array(
				'background-color' => esc_html( $button_background_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $button_background_color, $button_background_color_css );


		/**
		 * Footer options.
		 */
		// Background.
		$parse_css .= colormag_parse_background_css( $footer_background_default, $footer_background, '#colophon, .footer-widgets-wrapper' );

		// Footer copyright background.
		$parse_css .= colormag_parse_background_css( $footer_copyright_background_default, $footer_copyright_background, '.footer-socket-wrapper' );

		// Footer copyright color.
		$footer_copyright_color_css = array(
			'.footer-socket-wrapper .copyright' => array(
				'color' => esc_html( $footer_copyright_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#b1b6b6', $footer_copyright_color, $footer_copyright_color_css );

		// Footer copyright link color.
		$footer_copyright_link_color_css = array(
			'.footer-socket-wrapper .copyright a' => array(
				'color' => esc_html( $footer_copyright_link_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#b1b6b6', $footer_copyright_link_color, $footer_copyright_link_color_css );

		// Footer menu color.
		$footer_menu_color_css = array(
			'#colophon .footer-menu ul li a' => array(
				'color' => esc_html( $footer_menu_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#b1b6b6', $footer_menu_color, $footer_menu_color_css );

		// Footer menu hover color.
		$footer_menu_hover_color_css = array(
			'#colophon .footer-menu ul li a:hover' => array(
				'color' => esc_html( $footer_menu_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $footer_menu_hover_color, $footer_menu_hover_color_css );

		// Footer copyright typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_copyright_typography_default,
			$footer_copyright_typography,
			'.footer-socket-wrapper .copyright',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer menu typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_menu_typography_default,
			$footer_menu_typography,
			'.footer-menu a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_sidebar_area_background_default, $footer_sidebar_area_background, '.footer-widgets-wrapper' );

		// Footer upper sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_upper_sidebar_area_background_default, $footer_upper_sidebar_area_background, '#colophon .tg-upper-footer-widgets .widget' );


		/**
		 * Color options.
		 */
		// Base color.
		$base_color_css = array(
			'body, button, input, select ,textarea' => array(
				'color' => esc_html( $base_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#444444', $base_color, $base_color_css );

		// Headings color.
		$headings_color_css = array(
			'h1, h2, h3, h4, h5, h6' => array(
				'color' => esc_html( $headings_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $headings_color, $headings_color_css );

		// Heading H1 color.
		$heading_h1_color_css = array(
			'h1' => array(
				'color' => esc_html( $heading_h1_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $heading_h1_color, $heading_h1_color_css );

		// Heading H2 color.
		$heading_h2_color_css = array(
			'h2' => array(
				'color' => esc_html( $heading_h2_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $heading_h2_color, $heading_h2_color_css );

		// Heading H3 color.
		$heading_h3_color_css = array(
			'h3' => array(
				'color' => esc_html( $heading_h3_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $heading_h3_color, $heading_h3_color_css );

		// Sidebar widget title color.
		$sidebar_widget_title_color_css = array(
			'#secondary .widget-title span, #tertiary .widget-title span' => array(
				'color' => esc_html( $sidebar_widget_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $sidebar_widget_title_color, $sidebar_widget_title_color_css );

		// Footer widget title color.
		$footer_widget_title_color_css = array(
			'.footer-widgets-area .widget-title span' => array(
				'color' => esc_html( $footer_widget_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_title_color, $footer_widget_title_color_css );

		// Footer widget content color.
		$footer_widget_content_color_css = array(
			'.footer-widgets-area, .footer-widgets-area p' => array(
				'color' => esc_html( $footer_widget_content_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_content_color, $footer_widget_content_color_css );

		// Footer widget content link text color.
		$footer_widget_content_link_text_color_css = array(
			'.footer-widgets-area a' => array(
				'color' => esc_html( $footer_widget_content_link_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_content_link_text_color, $footer_widget_content_link_text_color_css );

		// Footer widget content link text hover color.
		$footer_widget_content_link_text_hover_color_css = array(
			'.footer-widgets-area a:hover' => array(
				'color' => esc_html( $footer_widget_content_link_text_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $footer_widget_content_link_text_hover_color, $footer_widget_content_link_text_hover_color_css );


		/**
		 * Typography options.
		 */
		// Base typography.
		$parse_css .= colormag_parse_typography_css(
			$base_typography_default,
			$base_typography,
			'body, button, input, select, textarea, blockquote p, .entry-meta, .more-link, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Headings typography.
		$parse_css .= colormag_parse_typography_css(
			$headings_typography_default,
			$headings_typography,
			'h1 ,h2, h3, h4, h5, h6',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H1 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h1_typography_default,
			$heading_h1_typography,
			'h1',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H2 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h2_typography_default,
			$heading_h2_typography,
			'h2',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H3 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h3_typography_default,
			$heading_h3_typography,
			'h3',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H4 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h4_typography_default,
			$heading_h4_typography,
			'h4',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H5 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h5_typography_default,
			$heading_h5_typography,
			'h5',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H6 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h6_typography_default,
			$heading_h6_typography,
			'h6',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Widget title typography.
		$parse_css .= colormag_parse_typography_css(
			$widget_title_typography_default,
			$widget_title_typography,
			'#secondary .widget-title, #tertiary .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Comment title typography.
		$parse_css .= colormag_parse_typography_css(
			$comment_title_typography_default,
			$comment_title_typography,
			'.comments-title, .comment-reply-title, #respond h3#reply-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer widget title typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_widget_title_typography_default,
			$footer_widget_title_typography,
			'.footer-widgets-area .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer widget content typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_widget_content_typography_default,
			$footer_widget_content_typography,
			'#colophon, #colophon p',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);


		// Add the custom CSS rendered dynamically, which is static.
		$parse_css .= self::render_custom_output();


		$parse_css .= $dynamic_css;

		return apply_filters( 'colormag_theme_dynamic_css', $parse_css );

	}

	/**
	 * Function to output Custom CSS code, which does not have the specific CSS design option, ie, static CSS code.
	 *
	 * @return string
	 */
	public static function render_custom_output() {

		/**
		 * Variable declarations.
		 */
		// Post metas.
		$colormag_all_entry_meta_remove      = get_theme_mod( 'colormag_all_entry_meta_remove', 0 );
		$colormag_author_entry_meta_remove   = get_theme_mod( 'colormag_author_entry_meta_remove', 0 );
		$colormag_date_entry_meta_remove     = get_theme_mod( 'colormag_date_entry_meta_remove', 0 );
		$colormag_category_entry_meta_remove = get_theme_mod( 'colormag_category_entry_meta_remove', 0 );
		$colormag_comments_entry_meta_remove = get_theme_mod( 'colormag_comments_entry_meta_remove', 0 );
		$colormag_tags_entry_meta_remove     = get_theme_mod( 'colormag_tags_entry_meta_remove', 0 );


		// Footer options.
		$footer_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_background         = get_theme_mod( 'colormag_footer_background_setting', $footer_background_default );


		// Color in menu.
		$category_menu_color = get_theme_mod( 'colormag_category_menu_color', '' );


		// Generate dynamic CSS.
		$colormag_custom_css = '';


		/**
		 * Post metas.
		 */
		// Total post meta remove.
		if ( 1 == $colormag_all_entry_meta_remove ) {
			$colormag_custom_css .= '.above-entry-meta, .below-entry-meta, .tg-module-meta, .tg-post-categories{display:none}';
		}

		// Author remove from post meta.
		if ( 1 == $colormag_author_entry_meta_remove ) {
			$colormag_custom_css .= '.below-entry-meta .byline, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-auther-name{display:none}';
		}

		// Date remove from post meta.
		if ( 1 == $colormag_date_entry_meta_remove ) {
			$colormag_custom_css .= '.below-entry-meta .posted-on, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-date{display:none}';
		}

		// Category remove from post meta.
		if ( 1 == $colormag_category_entry_meta_remove ) {
			$colormag_custom_css .= '.above-entry-meta, .tg-post-categories{display:none}';
		}

		// Comments remove from post meta.
		if ( 1 == $colormag_comments_entry_meta_remove ) {
			$colormag_custom_css .= '.below-entry-meta .comments, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-module-comments{display:none}';
		}

		// Tags remove from post meta.
		if ( 1 == $colormag_tags_entry_meta_remove ) {
			$colormag_custom_css .= '.below-entry-meta .tag-links{display:none}';
		}


		/**
		 * Footer options.
		 */
		// Footer background image.
		if ( $footer_background['background-image'] ) {
			$colormag_custom_css .= '.footer-widgets-wrapper, .footer-socket-wrapper, .colormag-footer--classic .footer-socket-wrapper{background-color:transparent}';
		}


		// Category color in menu options.
		if ( 1 == $category_menu_color ) {
			$args       = array(
				'orderby'    => 'id',
				'hide_empty' => 0,
			);
			$categories = get_categories( $args );

			$colormag_custom_css .= '.main-navigation .menunav-menu>li.menu-item-object-category>a{position:relative}.main-navigation .menunav-menu>li.menu-item-object-category>a::before{content:"";position:absolute;top:-4px;left:0;right:0;height:4px;z-index:10;transition:width .35s}';

			foreach ( $categories as $category ) {
				$cat_color = get_theme_mod( 'colormag_category_color_' . absint( $category->term_id ) );
				$cat_id    = $category->term_id;

				if ( $cat_color ) {
					$colormag_custom_css .= '.main-navigation .menu-item-object-category.menu-item-category-' . $cat_id . '>a::before, .main-navigation .menu-item-object-category.menu-item-category-' . $cat_id . ':hover>a{background:' . $cat_color . '}';
				}
			}
		}


		return $colormag_custom_css;

	}

}
