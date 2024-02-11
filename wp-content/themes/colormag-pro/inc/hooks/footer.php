<?php
/**
 * Hooks for the footer.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_main_section_inner_end' ) ) :

	/**
	 *  Main section inner ends.
	 */
	function colormag_main_section_inner_end() {
		?>
		</div><!-- .inner-wrap -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_main_section_end' ) ) :

	/**
	 * Main section ends.
	 */
	function colormag_main_section_end() {
		?>
		</div><!-- #main -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_advertisement_above_footer_sidebar' ) )  :

	/**
	 * Advertisement above footer sidebar area.
	 */
	function colormag_advertisement_above_footer_sidebar() {

		if ( is_active_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ) ) :
			?>
			<div class="advertisement_above_footer">
				<div class="inner-wrap">
					<?php dynamic_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ); ?>
				</div>
			</div>
			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_footer_start' ) ) :

	/**
	 * Footer starts.
	 */
	function colormag_footer_start() {
		?>
		<footer id="colophon" class="clearfix <?php echo esc_attr( colormag_copyright_alignment_class() ); ?> <?php echo esc_attr( colormag_footer_layout_class() ); ?>"<?php echo colormag_schema_markup( 'footer' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_sidebar' ) ) :

	/**
	 * Footer sidebar.
	 */
	function colormag_footer_sidebar() {
		get_sidebar( 'footer' );
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_start' ) ) :

	/**
	 * Footer socket inner wrapper starts.
	 */
	function colormag_footer_socket_inner_wrapper_start() {
		?>
		<div class="footer-socket-wrapper clearfix">
			<div class="inner-wrap">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_area_start' ) ) :

	/**
	 * Footer socket area starts.
	 */
	function colormag_footer_socket_area_start() {
		?>
		<div class="footer-socket-area">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_right_section' ) ) :

	/**
	 * Footer socket area right section.
	 */
	function colormag_footer_socket_right_section() {

		$social_links_enable          = get_theme_mod( 'colormag_social_icons_activate', 0 );
		$social_links_footer_location = get_theme_mod( 'colormag_social_icons_footer_activate', 1 );
		?>

		<div class="footer-socket-right-section">
			<?php
			if ( 1 == $social_links_enable && 1 == $social_links_footer_location ) {
				colormag_social_links();
			}
			?>

			<nav class="footer-menu clearfix">
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'depth'          => -1,
						)
					);
				}
				?>
			</nav>
		</div>

		<?php

	}

endif;


if ( ! function_exists( 'colormag_footer_socket_left_section' ) ) :

	/**
	 * Footer socket area left section.
	 */
	function colormag_footer_socket_left_section() {
		?>
		<div class="footer-socket-left-section">
			<?php do_action( 'colormag_footer_copyright' ); ?>
		</div>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_area_end' ) ) :

	/**
	 * Footer socket area ends.
	 */
	function colormag_footer_socket_area_end() {
		?>
		</div><!-- .footer-socket-area -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_socket_inner_wrapper_end' ) ) :

	/**
	 * Footer socket inner wrapper ends.
	 */
	function colormag_footer_socket_inner_wrapper_end() {
		?>
			</div><!-- .inner-wrap -->
		</div><!-- .footer-socket-wrapper -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_end' ) ) :

	/**
	 * Footer ends.
	 */
	function colormag_footer_end() {
		?>
		</footer><!-- #colophon -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_scroll_top_button' ) ) :

	/**
	 * Scroll to top button.
	 */
	function colormag_scroll_top_button() {

		if ( 0 == get_theme_mod( 'colormag_scroll_to_top', 0 ) ) :
			?>
			<a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_reading_progress_bar' ) ) :

	/**
	 * Reading progress bar.
	 */
	function colormag_reading_progress_bar() {

		if ( 1 == get_theme_mod( 'colormag_prognroll_indicator', 0 ) && is_single() ) :
			?>
			<div class="reading-progress-bar"></div>
			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_flyout_related_post' ) ) :

	/**
	 * Flyout related posts.
	 */
	function colormag_flyout_related_post() {

		if ( 1 == get_theme_mod( 'colormag_related_post_flyout_setting', 0 ) && is_single() ) :
			get_template_part( 'inc/flyout-related-posts' );
		endif;

	}

endif;


if ( ! function_exists( 'colormag_page_end' ) ) :

	/**
	 * Page end.
	 */
	function colormag_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_footer_copyright' ) ) :

	/**
	 * Shows the footer copyright information.
	 */
	function colormag_footer_copyright() {

		$default_footer_value      = get_theme_mod(
			'colormag_footer_editor',
			esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '<br>' . esc_html__( 'Theme: ', 'colormag') . '[tg-link]' .  esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].'
		);
		$colormag_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';

		echo do_shortcode( $colormag_footer_copyright );

	}

endif;
