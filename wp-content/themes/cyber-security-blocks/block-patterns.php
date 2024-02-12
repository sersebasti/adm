<?php
/**
 * Cyber Security Blocks: Block Patterns
 *
 * @since Cyber Security Blocks 1.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since Cyber Security Blocks 1.0
 *
 * @return void
 */
function cyber_security_blocks_register_block_patterns() {
	$block_pattern_categories = array(
		'cyber-security-blocks'    => array( 'label' => __( 'Cyber Security Blocks', 'cyber-security-blocks' ) ),
	);

	$block_pattern_categories = apply_filters( 'cyber_security_blocks_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', 'cyber_security_blocks_register_block_patterns', 9 );
