<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The footer widget area is triggered if any of the areas have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'colormag_footer_sidebar_one' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_two' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_three' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_four' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_one_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_two_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_three_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_full_width' ) ) {
	return;
}
?>

<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area clearfix">
			<div class="tg-upper-footer-widgets clearfix">
				<div class="footer_upper_widget_area tg-one-third">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_one_upper' ); ?>
				</div>
				<div class="footer_upper_widget_area tg-one-third">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_two_upper' ); ?>
				</div>
				<div class="footer_upper_widget_area tg-one-third tg-one-third-last">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_three_upper' ); ?>
				</div>
			</div>

			<div class="tg-footer-main-widget">
				<div class="tg-first-footer-widget">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_one' ); ?>
				</div>
			</div>

			<div class="tg-footer-other-widgets">
				<div class="tg-second-footer-widget">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_two' ); ?>
				</div>
				<div class="tg-third-footer-widget">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_three' ); ?>
				</div>
				<div class="tg-fourth-footer-widget">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_four' ); ?>
				</div>
			</div>

			<div class="footer-full-width-sidebar inner-wrap clearfix">
				<?php dynamic_sidebar( 'colormag_footer_sidebar_full_width' ); ?>
			</div>
		</div>
	</div>
</div>
