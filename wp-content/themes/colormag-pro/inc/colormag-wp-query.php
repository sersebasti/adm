<?php
/**
 * ColorMag custom WP_Query functions.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_breaking_news' ) ) :

	/**
	 * Breaking News/Latest Posts ticker section in the header.
	 */
	function colormag_breaking_news() {

		// Arguments for post query.
		$args = array(
			'posts_per_page'         => 5,
			'post_type'              => 'post',
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		);

		// If category is set for displaying breaking news.
		if ( 'category' == get_theme_mod( 'colormag_breaking_news_category_option', 'latest' ) ) {
			$args['category__in'] = get_theme_mod( 'colormag_breaking_news_category' );
		}

		$get_featured_posts = new WP_Query( $args );
		?>

		<div class="breaking-news">
			<strong class="breaking-news-latest">
				<?php echo esc_html( get_theme_mod( 'colormag_breaking_news_content_option', __( 'Latest:', 'colormag' ) ) ); ?>
			</strong>

			<ul class="newsticker">
				<?php
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<?php
		// Reset Post Data.
		wp_reset_postdata();

	}

endif;


if ( ! function_exists( 'colormag_random_post' ) ) :

	/**
	 * Random post icon in menu.
	 */
	function colormag_random_post() {

		// Bail out if random post in menu is not activated.
		if ( 0 == get_theme_mod( 'colormag_random_post_in_menu', 0 ) ) {
			return;
		}

		// Arguments for post query.
		$args = array(
			'posts_per_page'         => 1,
			'post_type'              => 'post',
			'ignore_sticky_posts'    => true,
			'orderby'                => 'rand',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		);

		$get_random_post = new WP_Query( $args );
		?>

		<div class="random-post">
			<?php
			while ( $get_random_post->have_posts() ) :
				$get_random_post->the_post();
				?>
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View a random post', 'colormag' ); ?>">
					<i class="fa fa-random"></i>
				</a>
			<?php endwhile; ?>
		</div>

		<?php
		// Reset Post Data.
		wp_reset_postdata();

	}

endif;


if ( ! function_exists( 'colormag_related_posts_function' ) ) :

	/**
	 * Query for the related posts.
	 */
	function colormag_related_posts_function() {

		wp_reset_postdata();
		global $post;

		// Define shared post arguments.
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => get_theme_mod( 'colormag_related_post_number_display', '3' ),
		);

		// Related by categories.
		if ( 'categories' == get_theme_mod( 'colormag_related_posts', 'categories' ) ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( 'tags' == get_theme_mod( 'colormag_related_posts', 'categories' ) ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			// If no tags added, return.
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;

	}

endif;


if ( ! function_exists( 'colormag_flyout_related_post_query' ) ) :

	/**
	 * Query for the flyout related posts query.
	 */
	function colormag_flyout_related_post_query() {

		wp_reset_postdata();
		global $post;

		// Define shared post arguments.
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 2,
		);

		// Related by categories.
		if ( 'categories' == get_theme_mod( 'colormag_related_posts_flyout_type', 'categories' ) ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( 'tags' == get_theme_mod( 'colormag_related_posts_flyout_type', 'categories' ) ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			// If no tags added, return.
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;

	}

endif;
