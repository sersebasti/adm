<?php
/**
 * The template used for displaying page content in archive pages.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$featured_image_size   = 'colormag-featured-image';
$class_name_layout_two = '';
$archive_search_layout = get_theme_mod( 'colormag_archive_search_layout', 'double_column_layout' );

if ( 'single_column_layout' === $archive_search_layout ) {
	$featured_image_size   = 'colormag-featured-post-medium';
	$class_name_layout_two = 'archive-layout-two';
} elseif ( 'full_width_layout' === $archive_search_layout ) {
	$class_name_layout_two = 'archive-layout-full-width';
} elseif ( 'grid_layout' === $archive_search_layout ) {
	$column = get_theme_mod( 'colormag_grid_layout_column', 'two' );

	if ( 'two' === $column ) {
		$featured_image_size   = 'colormag-featured-post-medium';
		$class_name_layout_two = 'archive-layout-grid';
	} elseif ( 'three' === $column ) {
		$featured_image_size   = 'colormag-featured-post-medium';
		$class_name_layout_two = 'archive-layout-grid-col-3';
	} elseif ( 'four' === $column ) {
		$featured_image_size   = 'colormag-featured-post-medium';
		$class_name_layout_two = 'archive-layout-grid-col-4';
	}
}
?>

<article id="post-<?php the_ID(); ?>"
	<?php post_class( array( $class_name_layout_two ) ); ?>
	<?php echo colormag_schema_markup( 'entry' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
	<?php
	/**
	 * Hook: colormag_before_post_content.
	 */
	do_action( 'colormag_before_post_content' );

	/**
	 * Hook: colormag_before_posts_loop.
	 */
	do_action( 'colormag_before_posts_loop' );
	?>

	<?php
	if ( ! has_post_format( array( 'gallery' ) ) ) :

		if ( has_post_thumbnail() ) :
			?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( $featured_image_size ); ?>
				</a>
				<?php
				if ( has_post_format( 'video' ) ) {
				?>
					<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
					</span>
				<?php
				}
				?>
			</div>

			<?php if ( 1 == get_theme_mod( 'colormag_featured_image_caption_show', 0 ) && get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>

			<span class="featured-image-caption">
						<?php echo wp_kses_post( get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
				</span>
			<?php
			endif;
		endif;

	endif;
	?>

	<div class="article-content clearfix">
		<?php
		if ( get_post_format() ) :
			get_template_part( 'inc/post-formats' );
		endif;

		colormag_colored_category();
		?>

		<header class="entry-header">
			<h2 class="entry-title"<?php echo colormag_schema_markup( 'entry_title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo esc_html( colormag_get_the_title( get_the_title() ) ); ?>
				</a>
			</h2>
		</header>

		<?php colormag_entry_meta(); ?>

		<div
			class="entry-content clearfix"<?php echo colormag_schema_markup( 'entry_summary' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
			<?php
			if ( 'content' === get_theme_mod( 'colormag_archive_content_excerpt_display', 'excerpt' ) && ! ( 'grid_layout' === $archive_search_layout || 'double_column_layout' === $archive_search_layout ) ) :
				the_content( '<span>' . esc_html( get_theme_mod( 'colormag_read_more_text', __( 'Read more', 'colormag' ) ) ) . '</span>' );
			else :
				?>
				<?php the_excerpt(); ?>

				<?php if ( 'button' === get_theme_mod( 'colormag_enable_read_more', 'button' ) ) { ?>
				<a class="more-link" title="<?php the_title_attribute(); ?>"
				href="<?php the_permalink(); ?>">
					<span><?php echo esc_html( get_theme_mod( 'colormag_read_more_text', __( 'Read more', 'colormag' ) ) ); ?></span>
				</a>
			<?php } ?>
			<?php endif; ?>
		</div>
	</div>


	<?php
	/**
	 * Hook: colormag_after_posts_loop.
	 */
	do_action( 'colormag_after_posts_loop' );

	/**
	 * Hook: colormag_after_post_content.
	 */
	do_action( 'colormag_after_post_content' );
	?>
</article>
