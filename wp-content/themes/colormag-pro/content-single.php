<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image_popup_id  = get_post_thumbnail_id();
$image_popup_url = wp_get_attachment_url( $image_popup_id );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo colormag_schema_markup( 'entry' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
	<?php
	/**
	 * Hook: colormag_before_post_content.
	 */
	do_action( 'colormag_before_post_content' );

	/**
	 * Hook: colormag_before_single_post_page_loop.
	 */
	do_action( 'colormag_before_single_post_page_loop' );
	?>

	<?php if ( 'above' === get_theme_mod( 'colormag_single_post_title_position', 'below' ) ) : ?>
		<div class="single-title-above">
			<?php colormag_colored_category(); ?>

			<header class="entry-header">
				<h1 class="entry-title"<?php echo colormag_schema_markup( 'entry_title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
					<?php the_title(); ?>
				</h1>
			</header>

			<?php colormag_entry_meta(); ?>
		</div>
	<?php endif; ?>

	<?php
	if ( ! has_post_format( array( 'gallery', 'video' ) ) ) :
		if ( 0 == get_theme_mod( 'colormag_featured_image_show', 0 ) && has_post_thumbnail() ) :
			?>
			<div class="featured-image"<?php echo colormag_schema_markup( 'image' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
				<?php if ( 1 == get_theme_mod( 'colormag_featured_image_popup', 0 ) ) : ?>
					<a href="<?php echo esc_url( $image_popup_url ); ?>" class="image-popup"><?php the_post_thumbnail( 'colormag-featured-image' ); ?></a>
					<?php
				else :
					the_post_thumbnail( 'colormag-featured-image' );
				endif;

				if ( 1 == get_theme_mod( 'colormag_schema_markup', '' ) ) :
					?>
					<meta itemprop="url" content="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, 'full' ) ); ?>">
				<?php endif; ?>
			</div>

			<?php if ( 1 == get_theme_mod( 'colormag_featured_image_caption_show', 0 ) && get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
				<span class="featured-image-caption">
					<?php echo wp_kses_post( get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
				</span>
				<?php
			endif;
		endif;
	endif;

	if ( has_post_format( 'video' ) ) :

		$video_post_url = get_post_meta( $post->ID, 'video_url', true );

		if ( ! empty( $video_post_url ) ) :
			?>
			<div class="fitvids-video">
				<?php
				$embed_code = wp_oembed_get( $video_post_url );

				echo $embed_code; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				?>
			</div>
		<?php
		endif;

	endif;
	?>

	<div class="article-content clearfix">

		<?php
		if ( get_post_format() ) :
			get_template_part( 'inc/post-formats' );
		endif;

		if ( 'below' === get_theme_mod( 'colormag_single_post_title_position', 'below' ) ) :
			colormag_colored_category();
			?>

			<header class="entry-header">
				<h1 class="entry-title"<?php echo colormag_schema_markup( 'entry_title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
					<?php the_title(); ?>
				</h1>
			</header>

			<?php
			colormag_entry_meta();
		endif;
		?>

		<div class="entry-content clearfix"<?php echo colormag_schema_markup( 'entry_content' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . esc_html__( 'Pages:', 'colormag' ),
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				)
			);
			?>
		</div>

		<?php colormag_post_view_setup( get_the_ID() ); ?>
	</div>

	<?php
	/**
	 * Hook: colormag_after_single_post_page_loop.
	 */
	do_action( 'colormag_after_single_post_page_loop' );

	/**
	 * Hook: colormag_after_post_content.
	 */
	do_action( 'colormag_after_post_content' );
	?>
</article>
