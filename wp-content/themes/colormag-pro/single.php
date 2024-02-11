<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * Hook: colormag_before_body_content.
 */
do_action( 'colormag_before_body_content' );
?>

	<?php colormag_two_sidebar_select(); ?>

	<div id="primary">
		<div id="content" class="clearfix <?php echo esc_attr( ( 1 === get_theme_mod( 'colormag_load_next_post', 0 ) ) ? 'tg-load-next-post' : '' ); ?>">

			<?php
			/**
			 * Hook: colormag_before_single_post_page_loop.
			 */
			do_action( 'colormag_before_single_post_page_loop' );

			while ( have_posts() ) :
				the_post();

				get_template_part( 'content', 'single' );
			endwhile;

			/**
			 * Hook: colormag_after_single_post_page_loop.
			 */
			do_action( 'colormag_after_single_post_page_loop' );
			?>

			<?php
			if ( true === apply_filters( 'colormag_single_post_page_navigation_filter', true ) ) :
				if ( 0 == get_theme_mod( 'colormag_post_navigation_hide', 0 ) ) :
					get_template_part( 'navigation', 'single' );
				endif;
			endif;

			if ( ! class_exists( 'Auto_Load_Next_Post' ) ) :

				/**
				 * Functions hooked into colormag_action_after_single_post_content action.
				 *
				 * @hooked colormag_author_bio - 10
				 * @hooked colormag_social_share - 15
				 * @hooked colormag_related_posts - 20
				 */
				do_action( 'colormag_action_after_single_post_content' );

			endif;

			/**
			 * Hook: colormag_before_comments_template.
			 */
			do_action( 'colormag_before_comments_template' );

			/**
			 * Functions hooked into colormag_action_after_inner_content action.
			 *
			 * @hooked colormag_render_comments - 10
			 */
			do_action( 'colormag_action_comments' );

			/**
			 * Hook: colormag_after_comments_template.
			 */
			do_action( 'colormag_after_comments_template' );
			?>
		</div><!-- #content -->
		<?php
		if ( get_theme_mod( 'colormag_load_next_post', 0 ) && is_single() ) {
			colormag_next_post_load();
		}
		?>
	</div><!-- #primary -->

<?php
colormag_sidebar_select();

/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();
