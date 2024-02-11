<?php
/**
 * The left sidebar widget area.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="secondary"<?php echo colormag_schema_markup( 'sidebar' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
	<?php do_action( 'colormag_before_sidebar' ); ?>

	<?php
	if ( is_page_template( 'page-templates/contact.php' ) ) {
		$sidebar = 'colormag_contact_page_sidebar';
	} else {
		$sidebar = 'colormag_left_sidebar';
	}

	// Displays the sidebar area as needed.
	if ( ! is_active_sidebar( $sidebar ) ) :

		if ( 'colormag_contact_page_sidebar' == $sidebar ) {
			$sidebar_display = esc_html__( 'Contact Page', 'colormag' );
		} else {
			$sidebar_display = esc_html__( 'Left', 'colormag' );
		}

		the_widget(
			'WP_Widget_Text',
			array(
				'title'  => esc_html__( 'Example Widget', 'colormag' ),
				'text'   => sprintf(
					/* Translators: 1. Label for Contact Page or Left sidebar area, 2. Opening of the link for widgets.php WordPress section, 3. Closing of the link for widgets.php WordPress section */
					esc_html__( 'This is an example widget to show how the %s Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'colormag' ),
					$sidebar_display,
					current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '',
					current_user_can( 'edit_theme_options' ) ? '</a>' : ''
				),
				'filter' => true,
			),
			array(
				'before_widget' => '<aside class="widget widget_text clearfix">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

	else :
		dynamic_sidebar( $sidebar );
	endif;
	?>

	<?php do_action( 'colormag_after_sidebar' ); ?>
</div>
