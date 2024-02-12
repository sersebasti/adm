<?php
/**
 * Blocks Initializer
 * 
 * @package post-category-image-with-grid-and-slider
 * @since 2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function pciwgas_register_guten_block() {

	// Block Editor Script
	wp_register_script( 'pciwgas-block-js', PCIWGAS_URL.'assets/js/blocks.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components' ), PCIWGAS_VERSION, true );
	wp_localize_script( 'pciwgas-block-js', 'Pciwgas_Block', array(
																'pro_demo_link'		=> 'https://demo.essentialplugin.com/prodemo/post-category-image-with-grid-and-slider-demo/',
																'free_demo_link'	=> 'https://demo.essentialplugin.com/post-category-image-with-grid-and-slider-demo/#check-free-demo-wr',
																'pro_link'			=> PCIWGAS_PLUGIN_LINK_UNLOCK,
															));

	// Register block and explicit attributes for grid
	register_block_type( 'pciwgas/pci-cat-grid', array(
		'attributes' => array(
			'design' => array(
							'type'		=> 'string',
							'default'	=> 'design-1',
						),
			'columns' => array(
							'type'		=> 'number',
							'default'	=> 3,
						),
			'show_title' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_count' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_desc' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'size' => array(
							'type'		=> 'string',
							'default'	=> 'full',
						),
			'taxonomy' => array(
							'type'		=> 'string',
							'default'	=> 'category',
						),
			'orderby' => array(
							'type'		=> 'string',
							'default'	=> 'name',
						),
			'order' => array(
							'type'		=> 'string',
							'default'	=> 'asc',
						),
			'term_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'exclude_cat' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'hide_empty' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
		),
		'render_callback' => 'pciwgas_grid_shortcode',
	));

	//Register block, and explicitly define the attributes for slider
	register_block_type( 'pciwgas/pci-cat-slider', array(
		'attributes' => array(
			'design' => array(
							'type'		=> 'string',
							'default'	=> 'design-1',
						),
			'show_title' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_count' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_desc' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'size' => array(
							'type'		=> 'string',
							'default'	=> 'full',
						),
			'slidestoshow' => array(
							'type'		=> 'number',
							'default'	=> 3,
						),
			'slidestoscroll' => array(
							'type'		=> 'number',
							'default'	=> 1,
						),
			'dots' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'arrows' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'autoplay' => array(
							'type'		=> 'string',
							'default'	=> 'false',
						),
			'autoplay_interval' => array(
							'type'		=> 'number',
							'default'	=> 3000,
						),
			'speed' => array(
							'type'		=> 'number',
							'default'	=> 300,
						),
			'loop' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'taxonomy' => array(
							'type'		=> 'string',
							'default'	=> 'category',
						),
			'orderby' => array(
							'type'		=> 'string',
							'default'	=> 'name',
						),
			'order' => array(
							'type'		=> 'string',
							'default'	=> 'asc',
						),
			'term_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'exclude_cat' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'hide_empty' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
		),
		'render_callback' => 'pciwgas_slider_shortcode',
	));

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'pciwgas-block-js', 'post-category-image-with-grid-and-slider', PCIWGAS_DIR . '/languages' );
	}

}
add_action( 'init', 'pciwgas_register_guten_block' );

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @since 2.3
 */
function pciwgas_block_assets() {	
}
add_action( 'enqueue_block_assets', 'pciwgas_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * 
 * @since 2.3
 */
function pciwgas_editor_assets() {

	// Block Editor CSS
	if( ! wp_style_is( 'wpos-free-guten-block-css', 'registered' ) ) {
		wp_register_style( 'wpos-free-guten-block-css', PCIWGAS_URL.'assets/css/blocks.editor.build.css', array( 'wp-edit-blocks' ), PCIWGAS_VERSION );
	}

	// Block Editor Script
	wp_enqueue_style( 'wpos-free-guten-block-css' );
	wp_enqueue_script( 'pciwgas-block-js' );

}
add_action( 'enqueue_block_editor_assets', 'pciwgas_editor_assets' );

/**
 * Adds an extra category to the block inserter
 *
 * @since 2.3
 */
function pciwgas_add_block_category( $categories ) {

	$guten_cats = wp_list_pluck( $categories, 'slug' );

	if( ! in_array( 'wpos_guten_block', $guten_cats ) ) {
		$categories[] = array(
							'slug'	=> 'wpos_guten_block',
							'title'	=> __('Essential Plugin Blocks', 'post-category-image-with-grid-and-slider'),
							'icon'	=> null,
						);
	}

	return $categories;
}
add_filter( 'block_categories_all', 'pciwgas_add_block_category' );