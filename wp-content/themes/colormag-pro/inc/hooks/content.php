<?php
/**
 * Hooks for the content.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_archive_header' ) ) :

	/**
	 * Archive header.
	 */
	function colormag_archive_header() {
		?>

		<header class="page-header">
			<?php
			if ( is_category() ) :
				do_action( 'colormag_category_title' );
				single_cat_title();
			else :
				?>

				<h1 class="page-title">
					<span>
						<?php
						if ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/**
							 * Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 */
							the_post();

							printf(
								/* Translators: %s: Author name */
								esc_html__( 'Author: %s', 'colormag' ),
								'<span class="vcard">' . esc_html( get_the_author() ) . '</span>'
							);

							/**
							 * Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf(
								/* Translators: %s: Day archive */
								esc_html__( 'Day: %s', 'colormag' ),
								'<span>' . esc_html( get_the_date() ) . '</span>'
							);

						elseif ( is_month() ) :
							printf(
								/* Translators: %s: Month archive */
								esc_html__( 'Month: %s', 'colormag' ),
								'<span>' . esc_html( get_the_date( 'F Y' ) ) . '</span>'
							);

						elseif ( is_year() ) :
							printf(
								/* Translators: %s: Year archive */
								esc_html__( 'Year: %s', 'colormag' ),
								'<span>' . esc_html( get_the_date( 'Y' ) ) . '</span>'
							);

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							esc_html_e( 'Asides', 'colormag' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							esc_html_e( 'Images', 'colormag' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							esc_html_e( 'Videos', 'colormag' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							esc_html_e( 'Quotes', 'colormag' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							esc_html_e( 'Links', 'colormag' );

						elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
							woocommerce_page_title( false );

						else :
							esc_html_e( 'Archives', 'colormag' );

						endif;
						?>
					</span>
				</h1>
				<?php

			endif;

			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf(
					'<div class="taxonomy-description">%s</div>',
					$term_description
				); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			endif;
			?>
		</header><!-- .page-header -->

		<?php

	}

endif;


if ( ! function_exists( 'colormag_render_comments' ) ) :

	/**
	 * Post/Page comments.
	 */
	function colormag_render_comments() {

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}

	}

endif;


if ( ! function_exists( 'colormag_author_bio' ) ) :

	/**
	 * Author bio.
	 */
	function colormag_author_bio() {

		if ( 0 == get_theme_mod( 'colormag_author_bio_disable_setting', 0 ) && get_the_author_meta( 'description' ) ) :

			$author_layout       = get_theme_mod( 'colormag_author_bio_style_setting', 'style_one' );
			$author_class        = str_replace( '_', '-', $author_layout );
			$author_class        = 'author-bio-' . $author_class;
			$social_sites_enable = get_theme_mod( 'colormag_author_bio_social_sites_show', 0 );
			$avatar_image_size   = apply_filters( 'colormag_author_bio_avatar_size_filter', 100 );
			?>

			<div class="author-box <?php echo esc_attr( $author_class ); ?>">
				<div class="author-description-wrapper">
					<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>

					<?php
					if ( 1 == $social_sites_enable && ( 'style_two' === $author_layout || 'style_three' === $author_layout ) ) {
						colormag_author_social_link();
					}
					?>

					<p class="author-description"><?php the_author_meta( 'description' ); ?></p>

					<?php
					if ( 1 == $social_sites_enable && 'style_one' === $author_layout ) {
						colormag_author_social_link();
					}
					?>

					<?php if ( 1 == get_theme_mod( 'colormag_author_bio_links', 0 ) ) : ?>
						<p class="author-url">
							<?php
							printf(
								/* Translators: %1$s: Author display name, %2$s: Author id */
								esc_html__( '%1$s has %2$s posts and counting.', 'colormag' ),
								esc_html( get_the_author_meta( 'display_name' ) ),
								absint( count_user_posts( get_the_author_meta( 'ID' ) ) )
							);
							?>

							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<?php
								printf(
									/* Translators: %1$s: Author display name */
									esc_html__( 'See all posts by %1$s', 'colormag' ),
									esc_html( get_the_author_meta( 'display_name' ) )
								);
								?>
							</a>
						</p>
					<?php endif; ?>
				</div>

				<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), $avatar_image_size ); ?></div>
			</div>
			<?php

		endif;

	}

endif;


if ( ! function_exists( 'colormag_social_share' ) ) :

	/**
	 * Social share.
	 */
	function colormag_social_share() {

		if ( 1 == get_theme_mod( 'colormag_social_share', 0 ) ) {
			get_template_part( 'inc/share' );
		}

	}

endif;


if ( ! function_exists( 'colormag_related_posts' ) ) :

	/**
	 * Related posts.
	 */
	function colormag_related_posts() {

		if ( 1 == get_theme_mod( 'colormag_related_posts_activate', 0 ) ) {
			get_template_part( 'inc/related-posts' );
		}

	}

endif;

if ( ! function_exists( 'colormag_ajax_post_class' ) ) :
	/**
	 * Add missing class `post` while ajax call.
	 */
	function colormag_ajax_post_class( $class ) {
		$class[] = 'post';

		return $class;
	}
endif;

if ( is_admin() && wp_doing_ajax() ) {
	add_action( 'post_class', 'colormag_ajax_post_class' );
}
