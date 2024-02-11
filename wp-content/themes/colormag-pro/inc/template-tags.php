<?php
/**
 * Custom template tags for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_entry_meta' ) ) :

	/**
	 * Shows meta information of post.
	 *
	 * @param bool $full_post_meta       Whether to display full post meta or not.
	 * @param bool $reading_time_display Whether to display reading time post meta or not, used for Ajax call.
	 */
	function colormag_entry_meta( $full_post_meta = true, $reading_time_display = false ) {

		if ( 'post' == get_post_type() ) :

			$human_diff_time = '';
			if ( get_theme_mod( 'colormag_post_meta_date_setting', 'post_date' ) == 'post_human_readable_date' ) {
				$human_diff_time = 'human-diff-time';
			}
			echo '<div class="below-entry-meta ' . esc_attr( $human_diff_time ) . '">';
			?>

			<?php
			// Displays the same published and updated date if the post is never updated.
			$time_string = '<time class="entry-date published updated" datetime="%1$s"' . colormag_schema_markup( 'entry_time' ) . '>%2$s</time>';

			// Displays the different published and updated date if the post is updated.
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s"' . colormag_schema_markup( 'entry_time' ) . '>%2$s</time><time class="updated" datetime="%3$s"' . colormag_schema_markup( 'entry_time_modified' ) . '>%4$s</time>';
			}

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			printf(
				/* Translators: 1. Post link, 2. Post time, 3. Post date */
				__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			if ( 'post_human_readable_date' == get_theme_mod( 'colormag_post_meta_date_setting', 'post_date' ) ) {
				printf(
					/* Translators: %s Timestamp */
					_x( '<span class="posted-on human-diff-time-display">%s ago</span>', '%s = human-readable time difference', 'colormag' ),
					human_time_diff(
						get_the_time( 'U' ),
						current_time( 'timestamp' )
					)
				); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}
			?>

			<span class="byline">
				<span class="author vcard">
					<i class="fa fa-user"></i>
					<a class="url fn n"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
					   title="<?php echo get_the_author(); ?>"
					>
						<?php echo esc_html( get_the_author() ); ?>
					</a>
				</span>
			</span>

			<?php
			if ( $full_post_meta ) {
				if ( 0 == get_theme_mod( 'colormag_post_view_entry_meta_remove', 0 ) ) {
					echo colormag_post_view_display( get_the_ID() ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				}
			}
			?>

			<?php if ( ! post_password_required() && comments_open() ) { ?>
				<span class="comments">
					<?php
					if ( $full_post_meta ) {
						comments_popup_link(
							__( '<i class="fa fa-comment"></i> 0 Comments', 'colormag' ),
							__( '<i class="fa fa-comment"></i> 1 Comment', 'colormag' ),
							__( '<i class="fa fa-comments"></i> % Comments', 'colormag' )
						);
					} else {
						?>
						<i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?>
						<?php
					}
					?>
				</span>
				<?php
			}

			if ( $full_post_meta ) {
				$tags_list = get_the_tag_list( '<span class="tag-links"' . colormag_schema_markup( 'tag' ) . '><i class="fa fa-tags"></i>', __( ', ', 'colormag' ), '</span>' );

				if ( $tags_list ) {
					echo $tags_list; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				}
			}

			// Display the post reading time.
			if ( $full_post_meta || ( ! $full_post_meta && $reading_time_display ) ) {
				if ( 1 == get_theme_mod( 'colormag_reading_time_setting', 0 ) ) {
					?>
					<span class="reading-time">
						<span class="eta"></span> <?php echo esc_html( colormag_reading_time() ); ?>
					</span>
					<?php
				}
			}

			// Edit button remove option add.
			if ( $full_post_meta ) {
				if ( 0 == get_theme_mod( 'colormag_edit_button_entry_meta_remove', 0 ) ) {
					edit_post_link( __( 'Edit', 'colormag' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );
				}
			}

			echo '</div>';

		endif;

	}

endif;


if ( ! function_exists( 'wp_body_open' ) ) :

	/**
	 * Adds backwards compatibility for wp_body_open() introduced with WordPress 5.2.
	 *
	 * @return void
	 * @see   https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}

endif;


if ( ! function_exists( 'colormag_reading_time' ) ) :

	/**
	 * Displays the reading time in post meta.
	 *
	 * Since we were using JS for this feature, we were compromising site speed since it checks every link when loaded,
	 * for displaying the time taken, and hence, we are opting for this function instead for this feature to fix site speed.
	 *
	 * @return string Reading time taken for post.
	 */
	function colormag_reading_time() {

		global $post;
		$post_content        = get_post_field( 'post_content', $post->ID );
		$word_count          = count( preg_split( '/\s+/', $post_content ) );
		$reading_time        = floor( $word_count / 200 );
		$reading_time_suffix = esc_html__( 'min read', 'colormag' );
		$total_reading_time  = $reading_time . ' ' . $reading_time_suffix;

		return $total_reading_time;

	}

endif;

if ( ! function_exists( 'colormag_exclude_duplicate_posts' ) ) :

	/**
	 * Unique Post Display function.
	 *
	 * The following sets of fucntions help in removing the duplicate posts from being shown in a page.
	 *
	 * colormag_exclude_duplicate_posts() - Excluding the Duplicate posts in featured posts widget.
	 * colormag_append_excluded_duplicate_posts() - Appending the duplicate posts.
	 */
	function colormag_exclude_duplicate_posts() {
		global $colormag_duplicate_posts;

		if ( 1 == get_theme_mod( 'colormag_unique_post_system', 0 ) ) {
			$post__not_in = $colormag_duplicate_posts;
		} else {
			$post__not_in = array();
		}

		return $post__not_in;
	}

endif;

if ( ! function_exists( 'colormag_append_excluded_duplicate_posts' ) ) :

	/**
	 * Add the post id's in an array to not duplicate the posts within the theme bundled widgets.
	 *
	 * @param array $featured_posts Duplicated posts ids within the theme bundled widgets.
	 */
	function colormag_append_excluded_duplicate_posts( $featured_posts ) {
		global $colormag_duplicate_posts;

		if ( 1 == get_theme_mod( 'colormag_unique_post_system', 0 ) ) {
			$post_ids                 = wp_list_pluck( $featured_posts->posts, 'ID' );
			$colormag_duplicate_posts = array_unique( array_merge( $colormag_duplicate_posts, $post_ids ) );
		} else {
			return;
		}
	}

endif;


if ( ! function_exists( 'colormag_category_color' ) ) :

	/**
	 * Getting Category Color.
	 *
	 * @param int $wp_category_id Category id.
	 *
	 * @return string The category color.
	 */
	function colormag_category_color( $wp_category_id ) {

		$args     = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$category = get_categories( $args );

		foreach ( $category as $category_list ) {
			$color = get_theme_mod( 'colormag_category_color_' . $wp_category_id );

			return $color;
		}

	}

endif;


if ( ! function_exists( 'colormag_colored_category' ) ) :

	/**
	 * Category Color for widgets and other
	 *
	 * @param bool $echo Boolean value to echo or just return.
	 *
	 * @return mixed
	 */
	function colormag_colored_category( $echo = true ) {

		global $post;
		$categories = get_the_category();
		$separator  = '&nbsp;';
		$output     = '';

		if ( $categories ) {
			$output .= '<div class="above-entry-meta"><span class="cat-links">';

			foreach ( $categories as $category ) {
				$color_code = colormag_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" style="background:' . colormag_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">' . $category->cat_name . '</a>' . $separator;
				} else {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '"  rel="category tag">' . $category->cat_name . '</a>' . $separator;
				}
			}

			$output .= '</span></div>';

			if ( $echo ) {
				echo trim( $output, $separator ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			} else {
				return trim( $output, $separator );
			}
		}

	}

endif;

if ( ! function_exists( 'colormag_two_sidebar_select' ) ) :

	/**
	 * Function to display the two sidebar selected.
	 */
	function colormag_two_sidebar_select() {

		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
		$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
		$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

		if ( 'default_layout' === $layout_meta ) {

			if ( is_page() ) {
				if ( 'two_sidebars' === $colormag_default_page_layout ) {
					colormag_get_sidebar( 'two' );
				}
			} elseif ( is_single() ) {
				if ( 'two_sidebars' === $colormag_default_post_layout ) {
					colormag_get_sidebar( 'two' );
				}
			} else {
				if ( 'two_sidebars' === $colormag_default_layout ) {
					colormag_get_sidebar( 'two' );
				}
			}

		} else {
			if ( 'two_sidebars' === $layout_meta ) {
				colormag_get_sidebar( 'two' );
			}
		}

	}

endif;


if ( ! function_exists( 'colormag_sidebar_select' ) ) :

	/**
	 * Function to display the sidebar selected.
	 */
	function colormag_sidebar_select() {

		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
		$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
		$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

		if ( 'default_layout' === $layout_meta ) {

			if ( is_page() ) {

				if ( 'right_sidebar' === $colormag_default_page_layout || 'two_sidebars' === $colormag_default_page_layout ) {
					colormag_get_sidebar( $colormag_default_page_layout );
				} elseif ( 'left_sidebar' === $colormag_default_page_layout ) {
					colormag_get_sidebar( 'left' );
				}
			} elseif ( is_single() ) {

				if ( 'right_sidebar' === $colormag_default_post_layout || 'two_sidebars' === $colormag_default_post_layout ) {
					colormag_get_sidebar( $colormag_default_post_layout );
				} elseif ( 'left_sidebar' === $colormag_default_post_layout ) {
					colormag_get_sidebar( 'left' );
				}
			} elseif ( 'right_sidebar' === $colormag_default_layout || 'two_sidebars' === $colormag_default_layout ) {
				colormag_get_sidebar( $colormag_default_layout );
			} elseif ( 'left_sidebar' === $colormag_default_layout ) {
				colormag_get_sidebar( 'left' );
			}
		} elseif ( 'right_sidebar' === $layout_meta || 'two_sidebars' === $layout_meta ) {
			colormag_get_sidebar( $layout_meta );
		} elseif ( 'left_sidebar' === $layout_meta ) {
			colormag_get_sidebar( 'left' );
		}

	}

endif;


if ( ! function_exists( 'colormag_social_links' ) ) :

	/**
	 * Displays the social links.
	 */
	function colormag_social_links() {

		// Bail out if social links is not activated.
		if ( 0 == get_theme_mod( 'colormag_social_icons_activate', 0 ) ) {
			return;
		}

		$colormag_social_links = array(
			'colormag_social_facebook'    => 'Facebook',
			'colormag_social_twitter'     => 'Twitter',
			'colormag_social_googleplus'  => 'Google-Plus',
			'colormag_social_instagram'   => 'Instagram',
			'colormag_social_pinterest'   => 'Pinterest',
			'colormag_social_youtube'     => 'YouTube',
			'colormag_social_vimeo'       => 'Vimeo-Square',
			'colormag_social_linkedin'    => 'LinkedIn',
			'colormag_social_delicious'   => 'Delicious',
			'colormag_social_flickr'      => 'Flickr',
			'colormag_social_skype'       => 'Skype',
			'colormag_social_soundcloud'  => 'SoundCloud',
			'colormag_social_vine'        => 'Vine',
			'colormag_social_stumbleupon' => 'StumbleUpon',
			'colormag_social_tumblr'      => 'Tumblr',
			'colormag_social_reddit'      => 'Reddit',
			'colormag_social_xing'        => 'Xing',
			'colormag_social_vk'          => 'VK',
		);

		$colormag_additional_social_link = array(
			'user_custom_social_links_one'   => __( 'Additional Social Link One', 'colormag' ),
			'user_custom_social_links_two'   => __( 'Additional Social Link Two', 'colormag' ),
			'user_custom_social_links_three' => __( 'Additional Social Link Three', 'colormag' ),
			'user_custom_social_links_four'  => __( 'Additional Social Link Four', 'colormag' ),
			'user_custom_social_links_five'  => __( 'Additional Social Link Five', 'colormag' ),
			'user_custom_social_links_six'   => __( 'Additional Social Link Six', 'colormag' ),
		);
		?>

		<div class="social-links clearfix">
			<ul>
				<?php
				/**
				 * Social links set which is static via the theme customize option.
				 */
				$i                     = 0;
				$colormag_links_output = '';
				foreach ( $colormag_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );

					if ( ! empty( $link ) ) {
						$new_tab = '';

						// For opening link in new tab.
						if ( 1 == get_theme_mod( $key . '_checkbox', 0 ) ) {
							$new_tab = 'target="_blank"';
						}

						$colormag_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}

					$i ++;
				}

				// Displays the social links which is set static via theme customize option.
				echo $colormag_links_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped


				/**
				 * Social links set which is dynamic via the theme customize option.
				 */
				$i                                = 0;
				$colormag_additional_links_output = '';
				foreach ( $colormag_additional_social_link as $key => $value ) {
					$link  = get_theme_mod( $key, '' );
					$color = get_theme_mod( $key . '_color' );

					if ( ! empty( $link ) ) {
						$new_tab    = '';
						$color_code = '';

						// For opening link in new tab.
						if ( 1 == get_theme_mod( $key . '_checkbox', 0 ) ) {
							$new_tab = 'target="_blank"';
						}

						// For color set in customize option.
						if ( ! empty( $color ) ) {
							$color_code = ' style="color:' . $color . '"';
						}

						$colormag_additional_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( get_theme_mod( $key . '_fontawesome' ) ) . '"' . $color_code . '></i></a></li>';
					}

					$i ++;
				}

				// Displays the social links which is set dynamic via theme customize option.
				echo $colormag_additional_links_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				?>
			</ul>
		</div><!-- .social-links -->
		<?php

	}

endif;


if ( ! function_exists( 'colormag_date_display' ) ) :

	/**
	 * Display the date in the header.
	 */
	function colormag_date_display() {

		// Bail out if date in header option is disabled.
		if ( 0 == get_theme_mod( 'colormag_date_display', 0 ) ) {
			return;
		}
		?>

		<div class="date-in-header">
			<?php
			if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( 'l, F j, Y' ) );
			} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( get_option( 'date_format' ) ) );
			}
			?>
		</div>

		<?php
	}

endif;


if ( ! function_exists( 'colormag_top_header_bar_display' ) ) :

	/**
	 * Function to display the top header bar.
	 *
	 * @since ColorMag 2.2.1
	 */
	function colormag_top_header_bar_display() {

		$breaking_news_enable           = get_theme_mod( 'colormag_breaking_news', 0 );
		$breaking_news_position         = get_theme_mod( 'colormag_breaking_news_position_options', 'header' );
		$date_display_enable            = get_theme_mod( 'colormag_date_display', 0 );
		$social_links_enable            = get_theme_mod( 'colormag_social_icons_activate', 0 );
		$social_links_header_visibility = get_theme_mod( 'colormag_social_icons_header_activate', 1 );
		$social_links_header_location   = get_theme_mod( 'colormag_social_icons_header_location', 'top-bar' );
		$top_bar_menu_enable            = get_theme_mod( 'colormag_top_bar_menu_enable', 0 );

		if (
			( 1 == $date_display_enable ) ||
			( 1 == $breaking_news_enable && 'header' === $breaking_news_position ) ||
			( 1 == $social_links_enable && 1 == $social_links_header_visibility && 'top-bar' === $social_links_header_location ) ||
			( 1 == $top_bar_menu_enable )
		) :
			?>
			<div class="news-bar">
				<div class="inner-wrap clearfix">
					<div class="tg-new-bar__one clearfix">
						<?php
						// Date.
						if ( 1 == $date_display_enable ) {
							colormag_date_display();
						}

						// Breaking news.
						if ( 1 == $breaking_news_enable && 'header' === $breaking_news_position ) {
							colormag_breaking_news();
						}
						?>
					</div>

					<div class="tg-new-bar__two clearfix">
						<?php
						// Menu.
						if ( 1 == $top_bar_menu_enable ) {
							?>
							<nav class="top-bar-menu clearfix">
								<?php
								if ( has_nav_menu( 'top-bar' ) ) {
									wp_nav_menu(
										array(
											'theme_location' => 'top-bar',
											'depth'          => - 1,
										)
									);
								}
								?>
							</nav>
							<?php
						}

						// Social icons.
						if ( 1 == $social_links_header_visibility && 'top-bar' === $social_links_header_location ) {
							colormag_social_links();
						}
						?>
					</div>
				</div>
			</div>

		<?php
		endif;
	}

endif;


if ( ! function_exists( 'colormag_middle_header_bar_display' ) ) :

	/**
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 2.2.1
	 */
	function colormag_middle_header_bar_display() {

		$screen_reader       = '';
		$description         = get_bloginfo( 'description', 'display' );
		$header_display_type = get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' );
		?>

		<div class="inner-wrap">
			<div id="header-text-nav-wrap" class="clearfix">

				<div id="header-left-section">
					<?php
					if ( 'show_both' === $header_display_type || 'header_logo_only' === $header_display_type ) {
						?>
						<div id="header-logo-image">
							<?php
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							}
							?>
						</div><!-- #header-logo-image -->
						<?php
					}

					if ( 'header_logo_only' === $header_display_type || 'disable' === ( $header_display_type ) ) {
						$screen_reader = 'screen-reader-text';
					}
					?>

					<div id="header-text" class="<?php echo esc_attr( $screen_reader ); ?>">
						<?php if ( is_front_page() || is_home() ) : ?>
							<h1 id="site-title"<?php echo colormag_schema_markup( 'site-title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php else : ?>
							<h3 id="site-title"<?php echo colormag_schema_markup( 'site-title' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h3>
						<?php endif; ?>

						<?php
						if ( $description || is_customize_preview() ) :
							?>
							<p id="site-description"<?php echo colormag_schema_markup( 'site-description' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
								<?php echo $description; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
							</p><!-- #site-description -->
						<?php endif; ?>
					</div><!-- #header-text -->
				</div><!-- #header-left-section -->

				<div id="header-right-section">
					<?php
					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						?>
						<div id="header-right-sidebar" class="clearfix">
							<?php dynamic_sidebar( 'colormag_header_sidebar' ); ?>
						</div>
						<?php
					}
					?>
				</div><!-- #header-right-section -->

			</div><!-- #header-text-nav-wrap -->
		</div><!-- .inner-wrap -->

		<?php

	}

endif;


if ( ! function_exists( 'colormag_below_header_bar_display' ) ) :

	/**
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 2.2.1
	 */
	function colormag_below_header_bar_display() {

		$random_post_icon               = get_theme_mod( 'colormag_random_post_in_menu', 0 );
		$search_icon                    = get_theme_mod( 'colormag_search_icon_in_menu', 0 );
		$social_links_enable            = get_theme_mod( 'colormag_social_icons_activate', 0 );
		$social_links_header_visibility = get_theme_mod( 'colormag_social_icons_header_activate', 1 );
		$social_links_header_location   = get_theme_mod( 'colormag_social_icons_header_location', 'top-bar' );
		$primary_header_type            = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );

		if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) :
			?>

			<div class="mega-menu-integrate">
				<div class="inner-wrap clearfix">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
						)
					);
					?>
				</div>
			</div>

		<?php else : ?>

			<nav id="site-navigation" class="main-navigation clearfix"<?php echo colormag_schema_markup( 'nav' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
				<div class="inner-wrap clearfix">
					<?php
					if ( 1 == get_theme_mod( 'colormag_home_icon_display', 0 ) ) {
						$home_icon_class = 'home-icon';
						if ( is_front_page() ) {
							$home_icon_class = 'home-icon front_page_on';
						}
						?>

						<div class="<?php echo esc_attr( $home_icon_class ); ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
							>
								<i class="fa fa-home"></i>
							</a>
						</div>
					<?php } ?>

					<?php if ( 1 == $random_post_icon || 1 == $search_icon || ( 1 == $social_links_enable && 1 == $social_links_header_visibility && 'menu' === $social_links_header_location && 'type_one' === $primary_header_type ) ) { ?>
						<div class="search-random-icons-container">
							<?php
							// Displays the social links in header.
							if ( 1 == $social_links_header_visibility && 'menu' === $social_links_header_location && 'type_one' === $primary_header_type ) {
								colormag_social_links();
							}

							// Displays the random post.
							if ( 1 == $random_post_icon ) {
								colormag_random_post();
							}

							// Displays the search icon.
							if ( 1 == $search_icon ) {
								?>
								<div class="top-search-wrap">
									<i class="fa fa-search search-top"></i>
									<div class="search-form-top">
										<?php get_search_form(); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>

					<p class="menu-toggle"></p>
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => 'menu-primary-container',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							)
						);
					} else {
						wp_page_menu();
					}
					?>

				</div>
			</nav>

			<?php
		endif;

	}

endif;


if ( ! function_exists( 'colormag_get_embed_data' ) ) :

	/**
	 * Get Thumbnails and Embed URL from Youtube and Vimeo Link.
	 *
	 * @param string $video_url Video link.
	 *
	 * @return array $embed_data
	 */
	function colormag_get_embed_data( $video_url ) {

		$embed_data = array();

		$youtube_thumbnail_base = 'https://i.ytimg.com/vi/';
		$youtube_player_base    = 'https://www.youtube.com/embed/';
		$vimeo_thumbnail_base   = 'https://i.vimeocdn.com/video/';
		$vimeo_player_base      = 'https://player.vimeo.com/video/';

		if ( preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_url, $matches ) ) {
			$embed_data['id']    = $matches[0];
			$embed_data['thumb'] = $youtube_thumbnail_base . $embed_data['id'] . '/default.jpg';
			$embed_data['url']   = $youtube_player_base . $embed_data['id'] . '?enablejsapi=1&amp;rel=0&amp;showinfo=0';
		} elseif ( preg_match( "/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $video_url, $matches ) ) {
			$embed_data['id']    = $matches[5];
			$embed_data['thumb'] = $vimeo_thumbnail_base . $embed_data['id'];
			$embed_data['url']   = $vimeo_player_base . $embed_data['id'] . '?api=1&amp;title=0&amp;byline=0';
		}

		return $embed_data;

	}

endif;


if ( ! function_exists( 'colormag_get_weather_color' ) ) :

	/**
	 * Get Weather Color.
	 *
	 * @param string $weather_code Weather code.
	 *
	 * @return string HEX Color Code.
	 */
	function colormag_get_weather_color( $weather_code ) {

		$output = '';

		if ( substr( '2' == $weather_code, 0, 1 ) || '2' == substr( $weather_code, 0, 1 ) ) {
			$output = '#1B364F';
		} elseif ( '5' == substr( $weather_code, 0, 1 ) ) {
			$output = '#7F89A2';
		} elseif ( '6' == substr( $weather_code, 0, 1 ) || 903 == $weather_code ) {
			$output = '#7E9EF3';
		} elseif ( 781 == $weather_code || 900 == $weather_code ) {
			$output = '#666C7A';
		} elseif ( 800 == $weather_code || 904 == $weather_code ) {
			$output = '#628EFB';
		} elseif ( '7' == substr( $weather_code, 0, 1 ) ) {
			$output = '#628EFB';
		} elseif ( '8' == substr( $weather_code, 0, 1 ) ) {
			$output = '#AAB4CD';
		} elseif ( 901 == $weather_code || 902 == $weather_code || 962 == $weather_code ) {
			$output = '#666C7A';
		} elseif ( 905 == $weather_code ) {
			$output = '#81A4FE';
		} elseif ( 906 == $weather_code ) {
			$output = '#81A4FE';
		} elseif ( 951 == $weather_code ) {
			$output = '#628EFB';
		} elseif ( 951 < $weather_code && 962 > $weather_code ) {
			$output = '##628EFB';
		}

		return $output;

	}

endif;


if ( ! function_exists( 'colormag_get_available_currencies' ) ) :

	/**
	 * Get available currencies for fixer.io API.
	 *
	 * @return array
	 */
	function colormag_get_available_currencies() {

		$available_currencies = array(
			'eur' => esc_html__( 'Euro Member Countries', 'colormag' ),
			'aud' => esc_html__( 'Australian Dollar', 'colormag' ),
			'bgn' => esc_html__( 'Bulgarian Lev', 'colormag' ),
			'brl' => esc_html__( 'Brazilian Real', 'colormag' ),
			'cad' => esc_html__( 'Canadian Dollar', 'colormag' ),
			'chf' => esc_html__( 'Swiss Franc', 'colormag' ),
			'cny' => esc_html__( 'Chinese Yuan Renminbi', 'colormag' ),
			'czk' => esc_html__( 'Czech Republic Koruna', 'colormag' ),
			'dkk' => esc_html__( 'Danish Krone', 'colormag' ),
			'gbp' => esc_html__( 'British Pound', 'colormag' ),
			'hkd' => esc_html__( 'Hong Kong Dollar', 'colormag' ),
			'hrk' => esc_html__( 'Croatian Kuna', 'colormag' ),
			'huf' => esc_html__( 'Hungarian Forint', 'colormag' ),
			'idr' => esc_html__( 'Indonesian Rupiah', 'colormag' ),
			'ils' => esc_html__( 'Israeli Shekel', 'colormag' ),
			'inr' => esc_html__( 'Indian Rupee', 'colormag' ),
			'jpy' => esc_html__( 'Japanese Yen', 'colormag' ),
			'krw' => esc_html__( 'Korean (South) Won', 'colormag' ),
			'mxn' => esc_html__( 'Mexican Peso', 'colormag' ),
			'myr' => esc_html__( 'Malaysian Ringgit', 'colormag' ),
			'nok' => esc_html__( 'Norwegian Krone', 'colormag' ),
			'nzd' => esc_html__( 'New Zealand Dollar', 'colormag' ),
			'php' => esc_html__( 'Philippine Peso', 'colormag' ),
			'pln' => esc_html__( 'Polish Zloty', 'colormag' ),
			'ron' => esc_html__( 'Romanian (New) Leu', 'colormag' ),
			'rub' => esc_html__( 'Russian Ruble', 'colormag' ),
			'sek' => esc_html__( 'Swedish Krona', 'colormag' ),
			'sgd' => esc_html__( 'Singapore Dollar', 'colormag' ),
			'thb' => esc_html__( 'Thai Baht', 'colormag' ),
			'try' => esc_html__( 'Turkish Lira', 'colormag' ),
			'usd' => esc_html__( 'United States Dollar', 'colormag' ),
			'zar' => esc_html__( 'South African Rand', 'colormag' ),
		);

		return $available_currencies;

	}

endif;


if ( ! function_exists( 'colormag_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param array      $args    An array of arguments.
	 * @param int        $depth   Depth of the current comment.
	 */
	function colormag_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php esc_html_e( 'Pingback:', 'colormag' ); ?>
					<?php comment_author_link(); ?>
					<?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"<?php echo colormag_schema_markup( 'comment' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<header class="comment-meta comment-author vcard">
							<?php
							echo get_avatar( $comment, 74 );
							printf(
								'<div class="comment-author-link"' . colormag_schema_markup( 'comment_author' ) . '><i class="fa fa-user"></i>%1$s%2$s</div>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'colormag' ) . '</span>' : ''
							);

							printf(
								'<div class="comment-date-time"' . colormag_schema_markup( 'comment_time' ) . '><i class="fa fa-calendar-o"></i>%1$s</div>',
								sprintf(
									/* Translators: 1. Comment date, 2. Comment time */
									esc_html__( '%1$s at %2$s', 'colormag' ),
									esc_html( get_comment_date() ),
									esc_html( get_comment_time() )
								)
							); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							printf(
								'<a class="comment-permalink" href="%1$s"' . colormag_schema_markup( 'comment_link' ) . '><i class="fa fa-link"></i>' . esc_html__( 'Permalink', 'colormag' ) . '</a>',
								esc_url( get_comment_link( $comment->comment_ID ) )
							); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							edit_comment_link();
							?>
						</header><!-- .comment-meta -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'colormag' ); ?></p>
						<?php endif; ?>

						<section class="comment-content comment"<?php echo colormag_schema_markup( 'comment_content' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
							<?php
							comment_text();

							comment_reply_link(
								array_merge(
									$args,
									array(
										'reply_text' => esc_html__( 'Reply', 'colormag' ),
										'after'      => '',
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
									)
								)
							);
							?>
						</section><!-- .comment-content -->

					</article><!-- #comment-## -->
				<?php
				break;

		endswitch; // End comment_type check.

	}

endif;


if ( ! function_exists( 'colormag_post_view_display' ) ) :

	/**
	 * Function to display the total number of posts view
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return string
	 */
	function colormag_post_view_display( $post_id ) {

		$count_key = 'total_number_of_views';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' === $count ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );

			$output = '<span class="post-views"><i class="fa fa-eye"></i><span class="total-views">' . esc_html__( '0 View', 'colormag' ) . '</span></span>';
		} else {
			/* Translators: %s Post view count */
			$output = '<span class="post-views"><i class="fa fa-eye"></i><span class="total-views">' . sprintf( esc_html__( '%s Views', 'colormag' ), $count ) . '</span></span>';
		}

		return $output;

	}

endif;


if ( ! function_exists( 'colormag_post_view_setup' ) ) :

	/**
	 * Function to count views for the posts
	 *
	 * @param int $post_id Post ID.
	 */
	function colormag_post_view_setup( $post_id ) {

		$count_key = 'total_number_of_views';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' === $count ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
		} else {
			$count ++;
			update_post_meta( $post_id, $count_key, $count );
		}

	}

endif;


if ( ! function_exists( 'colormag_font_size_range_generator' ) ) :

	/**
	 * Function to generate font size range for font size options.
	 *
	 * @param int $start_range Start range.
	 * @param int $end_range   End range.
	 *
	 * @return array
	 */
	function colormag_font_size_range_generator( $start_range, $end_range ) {
		$range_string = array();

		for ( $i = $start_range; $i <= $end_range; $i ++ ) {
			$range_string[ $i ] = $i;
		}

		return $range_string;
	}

endif;


if ( ! function_exists( 'colormag_plugin_version_compare' ) ) :

	/**
	 * Compare user's current version of plugin.
	 *
	 * @param string $plugin_slug        The plugin slug.
	 * @param string $version_to_compare The plugin's version.
	 *
	 * @return bool
	 */
	function colormag_plugin_version_compare( $plugin_slug, $version_to_compare ) {
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$plugin_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $plugin_version, $version_to_compare, '<' );
	}

endif;


if ( ! function_exists( 'colormag_author_social_link' ) ) :

	/**
	 * Function to show the profile field data.
	 */
	function colormag_author_social_link() {
		?>

		<ul class="author-social-sites">
			<?php if ( get_the_author_meta( 'colormag_twitter' ) ) { ?>
				<li class="twitter-link">
					<a href="https://twitter.com/<?php the_author_meta( 'colormag_twitter' ); ?>">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
			<?php } // End check for twitter. ?>

			<?php if ( get_the_author_meta( 'colormag_facebook' ) ) { ?>
				<li class="facebook-link">
					<a href="https://facebook.com/<?php the_author_meta( 'colormag_facebook' ); ?>">
						<i class="fa fa-facebook"></i>
					</a>
				</li>
			<?php } // End check for facebook. ?>

			<?php if ( get_the_author_meta( 'colormag_google_plus' ) ) { ?>
				<li class="google_plus-link">
					<a href="https://plus.google.com/<?php the_author_meta( 'colormag_google_plus' ); ?>">
						<i class="fa fa-google-plus"></i>
					</a>
				</li>
			<?php } // End check for google_plus. ?>

			<?php if ( get_the_author_meta( 'colormag_flickr' ) ) { ?>
				<li class="flickr-link">
					<a href="https://flickr.com/<?php the_author_meta( 'colormag_flickr' ); ?>">
						<i class="fa fa-flickr"></i>
					</a>
				</li>
			<?php } // End check for flickr. ?>

			<?php if ( get_the_author_meta( 'colormag_linkedin' ) ) { ?>
				<li class="linkedin-link">
					<a href="https://linkedin.com/<?php the_author_meta( 'colormag_linkedin' ); ?>">
						<i class="fa fa-linkedin"></i>
					</a>
				</li>
			<?php } // End check for linkedin. ?>

			<?php if ( get_the_author_meta( 'colormag_instagram' ) ) { ?>
				<li class="instagram-link">
					<a href="https://instagram.com/<?php the_author_meta( 'colormag_instagram' ); ?>">
						<i class="fa fa-instagram"></i>
					</a>
				</li>
			<?php } // End check for instagram. ?>

			<?php if ( get_the_author_meta( 'colormag_tumblr' ) ) { ?>
				<li class="tumblr-link">
					<a href="https://tumblr.com/<?php the_author_meta( 'colormag_tumblr' ); ?>">
						<i class="fa fa-tumblr"></i>
					</a>
				</li>
			<?php } // End check for tumblr. ?>

			<?php if ( get_the_author_meta( 'colormag_youtube' ) ) { ?>
				<li class="youtube-link">
					<a href="https://youtube.com/<?php the_author_meta( 'colormag_youtube' ); ?>">
						<i class="fa fa-youtube"></i>
					</a>
				</li>
			<?php } // End check for youtube. ?>
		</ul>

		<?php
	}

endif;

if ( ! function_exists( 'colormag_get_the_title' ) ) :

	/**
	 * Function to set length of the post title, depending upon the number of words user enters from the customizer pane.
	 *
	 * @param string $title get_the_title().
	 *
	 * @return string $title.
	 */
	function colormag_get_the_title( $title ) {

		$title_length = get_theme_mod( 'colormag_blog_post_title_length', '' );

		if ( is_int( $title_length ) ) {
			$title = wp_trim_words( $title, $title_length );
		}

		return $title;

	}
endif;

if ( ! function_exists( 'colormag_pagination' ) ) :
	function colormag_pagination() {

		/**
		 * Hook: colormag_after_archive_page_loop.
		 */
		if ( 'default' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) :
			if ( true === apply_filters( 'colormag_page_navigation_filter', true ) ) :
				get_template_part( 'navigation', 'none' );
			endif;
		endif;

		if ( 'numbered_pagination' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) :
			colormag_numbered_pagination();
		endif;
	}
endif;

if ( ! function_exists( 'colormag_numbered_pagination' ) ) :
	function colormag_numbered_pagination() {
		?>

		<div class="tg-numbered-pagination">
			<?php
			$args = array(
				'type'      => 'list',
				'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
				'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
			);

			the_posts_pagination( $args );
			?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'colormag_infinite_scroll' ) ) :

	function colormag_infinite_scroll() {

		global $wp_query;
		$event      = get_theme_mod( 'colormag_infinite_scroll_event', 'button' );
		$pagination = get_theme_mod( 'colormag_post_pagination', 'default' );

		if ( $wp_query->max_num_pages > 1 ) :
			?>
			<?php if ( 'infinite_scroll' === $pagination ) : ?>
			<nav class="tg-infinite-pagination tg-infinite-pagination--<?php echo esc_attr( $event ); ?>">
				<div class="tg-load-more">

					<div class="tg-load-more-icon">
						<div class="spinner"></div>
					</div>

					<?php if ( 'button' === $event ) : ?>
						<a href="#" class="tg-load-more-btn">
							<span class="tg-load-more-text"><?php esc_html_e( 'Load More', 'colormag' ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</nav> <!-- /.tg-infinite-scroll -->
		<?php
			endif;
		endif;
		?>
		<?php
	}
endif;

if ( ! function_exists( 'colormag_next_post_load' ) ) :

	function colormag_next_post_load() {

		$event = get_theme_mod( 'colormag_load_next_post_event', 'button' );
		?>
			<nav class="tg-infinite-pagination tg-infinite-pagination--<?php echo esc_attr( $event ); ?>">
				<div class="tg-load-more">

					<div class="tg-load-more-icon">
						<div class="spinner"></div>
					</div>

					<?php if ( 'button' === $event ) : ?>
						<a href="#" class="tg-load-more-btn">
							<span class="tg-load-more-text"><?php esc_html_e( 'Load Next Post', 'colormag' ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</nav> <!-- /.tg-infinite-scroll -->
		<?php
	}
endif;

if ( ! function_exists( 'colormag_infinite_scroll_js_localize' ) ) :

	/**
	 * @param array $localize
	 */
	function colormag_infinite_scroll_js_localize( $arr ) {

		global $wp_query;

		$is_single_post = ( is_single() && get_theme_mod( 'colormag_load_next_post', 0 ) );

		if ( $is_single_post ) {

			global $post;

			$cats = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );

			$args = array(
				'post__not_in' => array( $post->ID ),
				'category__in' => $cats,
			);

			$cat_query = new WP_Query( $args ); // Returns all Posts associated all the categories.

			$post_limit  = esc_html( get_theme_mod( 'colormag_load_next_post_limit', 2 ) );
			$total_count = is_numeric( $post_limit ) ? abs( intval( $post_limit ) ) : 2;

			$arr['catId']             = $cats;
			$arr['catQueryVars']      = wp_json_encode( $cat_query->query_vars );
			$arr['curPostId']         = $post->ID;
			$arr['nextPostLoadEvent'] = get_theme_mod( 'colormag_load_next_post_event', 'button' );

			wp_reset_postdata();
		}

		$arr['isSinglePost']          = $is_single_post;
		$arr['queryVars']             = wp_json_encode( $wp_query->query_vars );
		$arr['ajaxUrl']               = admin_url( 'admin-ajax.php' );
		$arr['infiniteCount']         = $is_single_post ? 1 : 2;
		$arr['infiniteTotal']         = $is_single_post ? $total_count : $wp_query->max_num_pages;
		$arr['pagination']            = get_theme_mod( 'colormag_post_pagination', 'default' );
		$arr['infiniteScrollEvent']   = get_theme_mod( 'colormag_infinite_scroll_event', 'button' );
		$arr['infiniteNonce']         = wp_create_nonce( 'colormag_infinite_scroll_nonce' );
		$arr['allPostsLoadedMessage'] = __( 'All Posts Loaded', 'colormag' );

		return $arr;

	}
	add_filter( 'colormag_infinite_scroll_params', 'colormag_infinite_scroll_js_localize' );
endif;

if ( ! function_exists( 'tg_infinite_scroll' ) ) {

	function tg_infinite_scroll() {

		check_ajax_referer( 'colormag_infinite_scroll_nonce', 'nonce' );

		$query_vars                = json_decode( stripslashes( $_POST['query_vars'] ), true );
		$query_vars['post_type']   = 'post';
		$query_vars['paged']       = ( isset( $_POST['page_no'] ) ) ? stripslashes( $_POST['page_no'] ) : 1;
		$query_vars['post_status'] = 'publish';
		$posts                     = new WP_Query( $query_vars );

		if ( $posts->have_posts() ) {

			while ( $posts->have_posts() ) {
				$posts->the_post();

				get_template_part( 'content', '' );
			}
		}

		wp_reset_postdata();

		wp_die();
	}
	add_action( 'wp_ajax_tg_infinite_scroll', 'tg_infinite_scroll' );
	add_action( 'wp_ajax_nopriv_tg_infinite_scroll', 'tg_infinite_scroll' );
}
