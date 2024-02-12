<?php
/**
 * 'pci-cat-slider' Shortcode
 * 
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function pciwgas_slider_shortcode( $atts, $content ) {

	// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
	if( isset( $_POST['action'] ) && ($_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json') ) {
		return '[pci-cat-slider]';
	}

	// Divi Frontend Builder - Do not Display Preview
	if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_POST['is_fb_preview'] ) && isset( $_POST['shortcode'] ) ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__( 'Post Category Image Slider - Shortcode', 'post-category-image-with-grid-and-slider' ).'</span></div>
					pci-cat-slider
				</div>';
	}

	// Fusion Builder Live Editor - Do not Display Preview
	if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'get_shortcode_render' )) ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__( 'Post Category Image Slider - Shortcode', 'post-category-image-with-grid-and-slider' ).'</span></div>
					pci-cat-slider
				</div>';
	}

	// Shortcode Parameter
	$atts = extract( shortcode_atts(array(
				'size'				=> 'full',
				'term_id'			=> null, 
				'taxonomy'			=> 'category',
				'orderby'			=> 'name',
				'order'				=> 'ASC',
				'show_title'		=> 'true',
				'show_count'		=> 'true',
				'show_desc'			=> 'true',
				'hide_empty'		=> 'true',
				'slidestoshow'		=> 3,
				'slidestoscroll'	=> 1,
				'loop'				=> 'true',
				'dots'				=> 'true',
				'arrows'			=> 'true',
				'autoplay'			=> 'false',
				'autoplay_interval'	=> 3000,
				'speed'				=> 300,
				'rtl'				=> '',
				'exclude_cat'		=> array(),
				'extra_class'		=> '',
				'className'			=> '',
				'align'				=> '',
	), $atts,'pci-cat-slider') );

	$unique				= pciwgas_get_unique();
	$size				= ! empty( $size )				? $size							: 'full';
	$term_id			= ! empty( $term_id )			? explode( ',', $term_id )		: '';
	$taxonomy			= ! empty( $taxonomy )			? $taxonomy						: 'category';
	$slidestoshow		= ! empty( $slidestoshow )		? $slidestoshow					: 3;
	$slidestoscroll		= ! empty( $slidestoscroll )	? $slidestoscroll				: 1;
	$autoplay_interval	= ! empty( $autoplay_interval )	? $autoplay_interval			: 3000;
	$speed				= ! empty( $speed )				? $speed						: 300;
	$exclude_cat		= ! empty( $exclude_cat )		? explode( ',', $exclude_cat )	: array();
	$show_title			= ( $show_title == 'true' )		? true							: false;
	$show_count			= ( $show_count == 'true' )		? true							: false;
	$show_desc			= ( $show_desc == 'true' )		? true							: false;
	$hide_empty			= ( $hide_empty == 'false' )	? false							: true;
	$loop				= ( $loop == 'false' )			? 'false'						: 'true';
	$dots				= ( $dots == 'false' )			? 'false'						: 'true';
	$arrows				= ( $arrows == 'false' )		? 'false'						: 'true';
	$autoplay			= ( $autoplay == 'false' )		? 'false'						: 'true';
	$align				= ! empty( $align )				? 'align'.$align				: '';
	$extra_class		= $extra_class .' '. $align .' '. $className;
	$extra_class		= pciwgas_sanitize_html_classes( $extra_class );

	// For RTL
	if( empty( $rtl ) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'pciwgas-public-script' );

	// get terms and workaround WP bug with parents/pad counts
	$args = array(
			'orderby'		=> $orderby,
			'order'			=> $order,
			'include'		=> $term_id,
			'hide_empty'	=> $hide_empty,
			'exclude'		=> $exclude_cat,
		);

	$post_categories = get_terms( $taxonomy, $args );

	// Slider configuration
	$slider_conf = compact( 'slidestoshow', 'slidestoscroll', 'loop', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl' );

	ob_start();

	if ( $post_categories ) { ?>
		<div class="pciwgas-cat-wrap pciwgas-cat-wrap-slider pciwgas-clearfix pciwgas-design-1 <?php echo esc_attr( $extra_class ); ?>">
			<div id="pciwgas-<?php echo esc_attr( $unique ); ?>" class="pciwgas-cat-slider-main" data-conf="<?php echo htmlspecialchars( json_encode( $slider_conf )); ?>">
				<?php
				foreach ( $post_categories as $category ) {

					$category_image	= pciwgas_term_image( $category->term_id, $size );
					$term_link		= get_term_link( $category, $taxonomy );
				?>
					<div class="pciwgas-pdt-cat-slider">
						<div class="pciwgas-post-cat-inner">
							<div class="pciwgas-img-wrapper">
								<?php if( ! empty( $category_image ) ) { ?>
									<a href="<?php echo esc_url( $term_link ); ?>"><img src="<?php echo esc_url( $category_image ); ?>" class="pciwgas-cat-img" alt="<?php echo esc_attr( $category->name ); ?>" /></a>
								<?php } ?>
							</div>

							<div class="pciwgas-title">
								<?php if( $show_title && $category->name ) { ?>
									<a href="<?php echo esc_url( $term_link ); ?>"><?php echo wp_kses_post( $category->name ); ?> </a>
								<?php }

								if( $show_count ) { ?>
									<span class="pciwgas-cat-count"><?php echo esc_attr( $category->count ); ?></span>
								<?php } ?>
							</div>

							<?php if( $show_desc && $category->description ) { ?>
								<div class="pciwgas-description">
									<div class="pciwgas-cat-desc"><?php echo wp_kses_post( wpautop( wptexturize( $category->description ) ) ); ?></div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}

	$content .= ob_get_clean();
	return $content;
}

// Category Slider Shortcode
add_shortcode( 'pci-cat-slider', 'pciwgas_slider_shortcode' );