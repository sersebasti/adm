<?php
/**
 * Perform when the plugin is being uninstalled
 */

// If uninstall is not called, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'image-sizes_regened' );
delete_option( 'image-sizes_version' );
delete_option( 'prevent_image_sizes' );
delete_option( 'image-sizes_regenerate' );
delete_option( 'image-sizes_more_plugins' );