<?php
/**
 * All AJAX related functions
 */
namespace Codexpert\Image_Sizes;
use Codexpert\Plugin\Base;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage AJAX
 * @author codexpert <hello@codexpert.io>
 */
class AJAX extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}

	/**
	 * Regenerate thumbnails
	 *
	 * @since 3.0
	 */
	public function regen_thumbs() {

		$response = [
			'status'	=> 0,
			'message'	=> __( 'Failed', 'image-sizes' ),
		];

		if( !wp_verify_nonce( $_GET['_nonce'], $this->slug ) ) {
			$response['message'] = __( 'Unauthorized', 'image-sizes' );
			wp_send_json( $response );
		}

		extract( $_GET );

		global $wpdb;

		$images_count = $wpdb->get_results( "SELECT `ID` FROM `$wpdb->posts` WHERE `post_type` = 'attachment' AND `post_mime_type` LIKE 'image/%'" );
		$total_images_count = count( $images_count );

		$images = $wpdb->get_results( "SELECT `ID` FROM `$wpdb->posts` WHERE `post_type` = 'attachment' AND `post_mime_type` LIKE 'image/%'  LIMIT {$limit} OFFSET {$offset}" );

		$offsets = $offset + count( $images );

		$has_image = false;
		if ( count( $images ) > 0 ) {
			$has_image = true;
		}

		$thumbs_created = $thumbs_deleted = 0;

		foreach ( $images as $image ) {
			$image_id = $image->ID;
			$main_img = get_attached_file( $image_id );

			// remove old thumbnails first
			$old_metadata = wp_get_attachment_metadata( $image_id );
			$thumb_dir = dirname( $main_img ) . DIRECTORY_SEPARATOR;
			foreach ( $old_metadata['sizes'] as $old_size => $old_size_data ) {
				wp_delete_file( $thumb_dir . $old_size_data['file'] );
				$thumbs_deleted++;
			}

			// generate new thumbnails
			if ( false !== $main_img && file_exists( $main_img ) ) {
				$new_thumbs = wp_generate_attachment_metadata( $image_id, $main_img );
				wp_update_attachment_metadata( $image_id, $new_thumbs );
				$thumbs_created += count( $new_thumbs['sizes'] );
			}
		}

		$_thumbs_deleteds 	= $thumbs_deleteds + $thumbs_deleted;
		$_thumbs_createds 	= $thumbs_createds + $thumbs_created;

		$response['status'] 	= 1;
		$response['message'] 	= '<p id="cx-processed"><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( '%d images processed', 'image-sizes' ), $offsets ) . '</p>';
		$response['message'] 	.= '<p id="cx-removed"><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( '%d thumbnails removed', 'image-sizes' ), $_thumbs_deleteds ) . '</p>';
		$response['message'] 	.= '<p id="cx-regenerated"><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( '%d thumbnails regenerated', 'image-sizes' ), $_thumbs_createds ) . '</p>';

		$response['counter'] 	= [
			'handled'	=> $offsets,
			'deleted'	=> $_thumbs_deleteds,
			'created'	=> $_thumbs_createds,
		];
		$response['offset'] 		= $offsets;
		$response['has_image'] 		= $has_image;
		$response['thumbs_deleted'] = $_thumbs_deleteds;
		$response['thumbs_created'] = $_thumbs_createds;
		$response['total_images_count'] = $total_images_count;

		wp_send_json( $response );
	}

	public function dismiss_notice() {

		$response = [
			'status'	=> 0,
			'message'	=> __( 'Failed', 'image-sizes' ),
		];

		if( !wp_verify_nonce( $_GET['_nonce'], $this->slug ) ) {
			$response['message'] = __( 'Unauthorized', 'image-sizes' );
			wp_send_json( $response );
		}

		update_option( $_GET['meta_key'], 1 );
		wp_send_json( [] );
	}

	public function analyze() {

		$response = [
			'status'	=> 0,
			'message'	=> __( 'Something went wrong', 'image-sizes' ),
		];

		if( ! wp_verify_nonce( $_POST['_wpnonce'], 'image_sizes-optimize' ) ) {
			$response['message'] = __( 'Unauthorized', 'image-sizes' );
			wp_send_json( $response );
		}

		if( ! isset( $_POST['image-type'] ) || count( $_POST['image-type'] ) <= 0 ) {
			$response['html'] = '<p><span class="dashicons dashicons-dismiss cx-icon cx-error"></span>' . __( 'Please select some image types first!', 'image-sizes' ) . '</p>';
			wp_send_json( $response );
		}

		$images = [];
		$total_size = $old_size = $new_size = 0;
		$analyze_only = isset( $_POST['operation'] ) && sanitize_text_field( $_POST['operation'] ) == 'analyze';
		$include_thumbs = isset( $_POST['include-thumbs'] ) && sanitize_text_field( $_POST['include-thumbs'] ) == 'yes';

		if( ! $analyze_only ) {
			$response = [
				'status'	=> 1,
				'message'	=> __( 'Success', 'image-sizes' ),
				'images'	=> $images,
				'size'		=> $total_size,
				'html'		=> '<p><span class="dashicons dashicons-superhero-alt cx-icon cx-success"></span><a href="https://codexpert.io/dashboard/?p=27950" target="_blank">' . __( 'PRO Feature: Upgrade to Unlock!', 'image-sizes' ) .'</a></p>',
			];

			wp_send_json( $response );
		}

		// the file system
		if( ! function_exists( 'request_filesystem_credentials' ) ) {
			include_once ABSPATH . '/wp-admin/includes/file.php';
		}

		$nonce = wp_create_nonce( 'optimaze-server' );
		if ( false === ( $creds = request_filesystem_credentials( $nonce, '', false, false, null ) ) ) {
			return;
		}
		
		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( $nonce, '', true, false, null );
			return;
		}

		global $wp_filesystem, $wpdb;

		$sql = "SELECT `ID`, `guid` FROM `$wpdb->posts` WHERE `post_type` = 'attachment' AND 1 = 0";

		foreach( $_POST['image-type'] as $_type ) {
			$type = sanitize_text_field( $_type );
			$sql .= " OR `post_mime_type` LIKE 'image/{$type}'";
		}

		$queried_images = $wpdb->get_results( $sql );

		if( count( $queried_images ) <= 0 ) {
			$response['html'] = '<p><span class="dashicons dashicons-dismiss cx-icon cx-error"></span>' . __( 'No images have been found!', 'image-sizes' ) . '</p>';
			wp_send_json( $response );
		}

		foreach ( $queried_images as $image ) {
			$thumbs = Helper::get_images( $image->ID, $include_thumbs );
			$images = array_merge( $images, $thumbs );
			foreach ( $thumbs as $thumb ) {
				$total_size += $wp_filesystem->size( $thumb['path'] );
			}
		}

		$quantity = isset( $_POST['quality'] ) ? sanitize_text_field( $_POST['quality'] ) : 85;

		foreach ( $images as $image ) {
			$the_image = Helper::optimize_image( $image['url'], $quantity );

			$old_size += $the_image['before']['size_byte'];
			$new_size += $the_image['after']['size_byte'];
		}

		if( $analyze_only ) {
			$html  = '<p><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( '%d images can be optimized' ), count( $images ) ) .'</p>';
			$html .= '<p><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( '%s of disk space can be saved' ), Helper::format_bytes( $old_size - $new_size ) ) .'</p>';
			$html .= '<p><span class="dashicons dashicons-yes-alt cx-icon cx-success"></span>' . sprintf( __( 'Saving Rate: %d%%' ), ( 1 - $new_size / $old_size ) * 100 ) .'</p>';
		}

		$response = [
			'status'	=> 1,
			'message'	=> __( 'Success', 'image-sizes' ),
			'images'	=> $images,
			'size'		=> $total_size,
			'html'		=> $html,
		];

		wp_send_json( $response );
	}
}