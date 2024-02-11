<?php
/**
 * Hooks for the header.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_head' ) ) :

	/**
	 * HTML Head.
	 */
	function colormag_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php
	}

endif;


if ( ! function_exists( 'colormag_background_image_clickable' ) ) :

	/**
	 * Background image clickable.
	 */
	function colormag_background_image_clickable() {

		$background_image_url_link = get_theme_mod( 'colormag_background_image_link' );

		if ( $background_image_url_link ) {
			echo '<a href="' . esc_url( $background_image_url_link ) . '" class="background-image-clickable" target="_blank"></a>';
		}

	}

endif;


if ( ! function_exists( 'colormag_page_start' ) ) :

	/**
	 * Page start.
	 */
	function colormag_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_skip_content_link' ) ) :

	/**
	 * Skip content link.
	 */
	function colormag_skip_content_link() {
		?>
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'colormag' ); ?></a>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_start' ) ) :

	/**
	 * Header starts.
	 */
	function colormag_header_start() {
		?>
		<header id="masthead" class="site-header clearfix <?php echo esc_attr( colormag_header_layout_class() ); ?>"<?php echo colormag_schema_markup( 'header' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_nav_container_start' ) ) :

	/**
	 * Header nav container starts.
	 */
	function colormag_header_nav_container_start() {
		?>
		<div id="header-text-nav-container" class="clearfix">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header' ) ) :

	/**
	 * Header main area.
	 */
	function colormag_header() {

		$header_layout         = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );
		$header_image_position = get_theme_mod( 'colormag_header_image_position', 'position_two' );

		if ( 'type_one' === $header_layout || 'type_two' === $header_layout || 'type_three' === $header_layout ) :

			// Display the top header bar.
			colormag_top_header_bar_display();

			if ( 'position_one' === $header_image_position ) {
				the_custom_header_markup();
			}

			// Display the middle header bar.
			colormag_middle_header_bar_display();

			if ( 'position_two' === $header_image_position ) {
				the_custom_header_markup();
			}

			// Display the below header bar.
			colormag_below_header_bar_display();

		elseif ( 'type_four' === $header_layout || 'type_six' === $header_layout ) :

			// Display the top header bar.
			colormag_top_header_bar_display();

			// Display the below header bar.
			colormag_below_header_bar_display();

			if ( 'position_one' === $header_image_position || 'position_two' === $header_image_position || 'position_three' === $header_image_position ) {
				the_custom_header_markup();
			}

			// Display the middle header bar.
			colormag_middle_header_bar_display();

		elseif ( 'type_five' === $header_layout ) :

			// Display the below header bar.
			colormag_below_header_bar_display();

			if ( 'position_three' === $header_image_position ) {
				the_custom_header_markup();
			}

			// Display the top header bar.
			colormag_top_header_bar_display();

			if ( 'position_one' === $header_image_position || 'position_two' === $header_image_position ) {
				the_custom_header_markup();
			}

			// Display the middle header bar.
			colormag_middle_header_bar_display();

		endif;

	}

endif;


if ( ! function_exists( 'colormag_header_nav_container_end' ) ) :

	/**
	 * Header nav container ends.
	 */
	function colormag_header_nav_container_end() {
		?>
		</div><!-- #header-text-nav-container -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_header_image_before_nav_container_end' ) ) :

	/**
	 * Display the header image just before the header closes.
	 */
	function colormag_header_image_before_nav_container_end() {
		$colormag_header_layout         = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );
		$colormag_header_image_position = get_theme_mod( 'colormag_header_image_position', 'position_two' );

		if ( 'position_three' === $colormag_header_image_position && ( 'type_one' === $colormag_header_layout || 'type_two' === $colormag_header_layout || 'type_three' === $colormag_header_layout ) ) {
			the_custom_header_markup();
		}
	}

endif;


if ( ! function_exists( 'colormag_header_end' ) ) :

	/**
	 * Header ends.
	 */
	function colormag_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}

endif;


if ( ! function_exists( 'colormag_main_section_start' ) ) :

	/**
	 * Main section starts.
	 */
	function colormag_main_section_start() {
		?>
		<div id="main" class="clearfix"<?php echo colormag_schema_markup( 'content' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
		<?php
	}

endif;


if ( ! function_exists( 'colormag_before_content_breaking_news' ) ) :

	/**
	 * Before content breaking news.
	 */
	function colormag_before_content_breaking_news() {

		if ( 1 == get_theme_mod( 'colormag_breaking_news', 0 ) && 'main' === get_theme_mod( 'colormag_breaking_news_position_options', 'header' ) ) :
			?>
			<div class="breaking-news-main inner-wrap clearfix">
				<?php colormag_breaking_news(); ?>
			</div>
			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_front_page_full_width_sidebar' ) ) :

	/**
	 * Front page full width sidebar area.
	 */
	function colormag_front_page_full_width_sidebar() {

		if ( ( is_front_page() || is_page_template( 'page-templates/magazine.php' ) ) && ! is_page_template( 'page-templates/page-builder.php' ) ) :
			?>
			<div class="top-full-width-sidebar inner-wrap clearfix <?php echo colormag_top_full_width_area_class(); ?> ">
				<?php
				if ( is_active_sidebar( 'colormag_front_page_top_full_width_area' ) ) {
					dynamic_sidebar( 'colormag_front_page_top_full_width_area' );
				}
				?>
			</div>
			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_main_section_inner_start' ) ) :

	/**
	 * Main section inner starts.
	 */
	function colormag_main_section_inner_start() {
		?>
		<div class="inner-wrap clearfix">
		<?php
	}

endif;


if ( ! function_exists( 'colormag_breadcrumb' ) ) :

	/**
	 * Display the breadcrumbs provided via Yoast or BreadCrumb NavXT plugin,
	 * where BreadCrumb NavXT plugin takes precedence.
	 */
	function colormag_breadcrumb() {

		// Bail out if breadcrumb is not enabled.
		if ( 0 == get_theme_mod( 'colormag_breadcrumb_display', 0 ) ) {
			return;
		}

		if ( function_exists( 'bcn_display' ) ) {
			?>

			<div id="breadcrumbs" class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<div class="inner-wrap">
				<?php
				echo '<span class="breadcrumb-title">' . get_theme_mod( 'colormag_breadcrumb_label', esc_html__( 'You are here:', 'colormag' ) ) . '</span>';

				bcn_display();
				?>
				</div>
			</div>

		<?php } elseif ( function_exists( 'yoast_breadcrumb' ) ) { ?>

			<div id="breadcrumbs" class="breadcrumbs">
				<div class="inner-wrap">
				<?php
				echo '<span class="breadcrumb-title">' . get_theme_mod( 'colormag_breadcrumb_label', esc_html__( 'You are here:', 'colormag' ) ) . '</span>';

				yoast_breadcrumb();
				?>
				</div>
			</div>

			<?php
		}

	}

endif;

if ( ! function_exists( 'colormag_change_logo_attr' ) ) :

	/**
	 * Change the image attributes while retina logo is set.
	 *
	 * @param $attr
	 * @param $attachment
	 * @param $size
	 *
	 * @return mixed
	 */
	function colormag_change_logo_attr( $attr, $attachment, $size ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

		if ( ! empty( $custom_logo ) ) {
			$custom_logo = $custom_logo[0];
		}

		if ( isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {
			$retina_logo    = get_theme_mod( 'colormag_retina_logo', '' );
			$attr['srcset'] = '';

			if ( $retina_logo ) {
				$attr['srcset'] = $custom_logo . ' 1x,' . $retina_logo . ' 2x';
			}
		}

		return $attr;
	}

endif;
