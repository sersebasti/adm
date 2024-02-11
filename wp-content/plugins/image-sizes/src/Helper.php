<?php
/**
 * All helpers functions
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
 * @subpackage Helper
 * @author codexpert <hi@codexpert.io>
 */
class Helper extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->server	= $this->plugin['server'];
		$this->version	= $this->plugin['Version'];
	}

	public static function pri( $data ) {
		echo '<pre>';
		if( is_object( $data ) || is_array( $data ) ) {
			print_r( $data );
		}
		else {
			var_dump( $data );
		}
		echo '</pre>';
	}

	public static function get_option( $key, $section, $default = '' ) {

		$options = get_option( $key );

		if ( isset( $options[ $section ] ) ) {
			return $options[ $section ];
		}

		return $default;
	}

	/**
	 * Includes a template file resides in /views diretory
	 *
	 * It'll look into /image-sizes directory of your active theme
	 * first. if not found, default template will be used.
	 * can be overwriten with image-sizes_template_overwrite_dir hook
	 *
	 * @param string $slug slug of template. Ex: template-slug.php
	 * @param string $sub_dir sub-directory under base directory
	 * @param array $fields fields of the form
	 */
	public static function get_template( $slug, $base = 'views', $args = null ) {

		// templates can be placed in this directory
		$overwrite_template_dir = apply_filters( 'image_sizes_template_overwrite_dir', get_stylesheet_directory() . '/image-sizes/', $slug, $base, $args );
		
		// default template directory
		$plugin_template_dir = dirname( IMAGE_SIZES ) . "/{$base}/";

		// full path of a template file in plugin directory
		$plugin_template_path =  $plugin_template_dir . $slug . '.php';
		
		// full path of a template file in overwrite directory
		$overwrite_template_path =  $overwrite_template_dir . $slug . '.php';

		// if template is found in overwrite directory
		if( file_exists( $overwrite_template_path ) ) {
			ob_start();
			include $overwrite_template_path;
			return ob_get_clean();
		}
		// otherwise use default one
		elseif ( file_exists( $plugin_template_path ) ) {
			ob_start();
			include $plugin_template_path;
			return ob_get_clean();
		}
		else {
			return __( 'Template not found!', 'image-sizes' );
		}
	}

	public static function default_image_sizes() {
	    global $_wp_additional_image_sizes;

	    $thumb_crop = get_option( 'thumbnail_crop' ) == 1;

	    /**
	     * Standard image sizes
	     */
	    $sizes = [
	    	'thumbnail' => [
		    	'type'		=> 'default',
		    	'width'		=> get_option( 'thumbnail_size_w' ),
		    	'height'	=> get_option( 'thumbnail_size_h' ),
		    	'cropped'	=> $thumb_crop
		    ],
		    'medium' => [
	        	'type'		=> 'default',
	        	'width'		=> get_option( 'medium_size_w' ),
	        	'height'	=> get_option( 'medium_size_h' ),
	        	'cropped'	=> $thumb_crop
	        ],
	        'medium_large' => [
	        	'type'		=> 'default',
	        	'width'		=> get_option( 'medium_large_size_w' ),
	        	'height'	=> get_option( 'medium_large_size_h' ),
	        	'cropped'	=> $thumb_crop
	        ],
	        'large' => [
	        	'type'		=> 'default',
	        	'width'		=> get_option( 'large_size_w' ),
	        	'height'	=> get_option( 'large_size_h' ),
	        	'cropped'	=> $thumb_crop
	        ]
	    ];

	    /**
	     * Additional image sizes
	     */
	    if( is_array( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) :
	    foreach ( $_wp_additional_image_sizes as $size => $data ) {
	        $sizes[ $size ] = [
	        	'type'		=> 'custom',
	        	'width'		=> $data['width'],
	        	'height'	=> $data['height'],
	        	'cropped'	=> $data['crop'] == 1
	        ];
	    }
	    endif;

	    return $sizes;
	}

	/**
	 * @link https://ourcodeworld.com/articles/read/718/converting-bytes-to-human-readable-values-kb-mb-gb-tb-pb-eb-zb-yb-with-php
	 */
	public static function format_bytes( $bytes, $hide_unit = false, $hide_amount = false ) {

	    if( $bytes <= 0 ) {
	    	return sprintf( '%.02F B', 0 );
	    }

		$i = floor( log( $bytes ) / log( 1024 ) );

	    $sizes = [ 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' ];

	    $amount = sprintf( '%.02F', $bytes / pow( 1024, $i ) );
	    $unit = $sizes[ $i ];

	    if( $hide_amount ) {
	    	return $unit;
	    }

	    if( $hide_unit ) {
	    	return $amount;
	    }

	    return "{$amount} {$unit}";
	}

	public static function api_base() {
		// return 'https://wppeople.net/wp-json/optimaze/v1/optimize/';
		return 'http://wp.wp/wp-json/optimaze/v1/optimize/';
	}

	/**
	 * @return [
	 * 				[
	 *					'path'	=> $thumb_path,
	 *					'url'	=> $thumb_url,
	 *				]
	 * 			];
	 */
	public static function get_images( $image_id, $include_thumbs = true ) {
		$images = [];

		$main_img_path	= get_attached_file( $image_id );
		$main_img_url	= wp_get_attachment_url( $image_id );

		$thumb_dir_path	= dirname( $main_img_path ) . DIRECTORY_SEPARATOR;
		$thumb_dir_url	= dirname( $main_img_url ) . DIRECTORY_SEPARATOR;

		$images[] = [
			'id'	=> $image_id,
			'path'	=> $main_img_path,
			'url'	=> $main_img_url,
		];

		if( $include_thumbs ) {
			$metadata	= wp_get_attachment_metadata( $image_id );
			foreach ( $metadata['sizes'] as $size => $size_data ) {
				$thumb_path = $thumb_dir_path . $size_data['file'];
				$thumb_url = $thumb_dir_url . $size_data['file'];

				$images[] = [
					'id'	=> $image_id,
					'path'	=> $thumb_path,
					'url'	=> $thumb_url,
				];
			}
		}

		return $images;
	}

	/**
	 * @return [
	 *		'success'		=> 1,
	 *		'message'		=> __( 'Image optimized!', 'optimaze-server' ),
	 *		'before'		=> [
	 *			'image_url'	=> $remote_image_url,
	 *			'size_byte'	=> $size_before,
	 *		],
	 *		'after'			=> [
	 *			'image_url'	=> $image_url,
	 *			'size_byte'	=> $size_after,
	 *		],
	 *		'saved_byte'	=> ( $size_before - $size_after ),
	 *		'saved_percent'	=> round( ( $size_before - $size_after ) / $size_before * 100, 2 )
	 *	];
	 */
	public static function optimize_image( $image_url, $quality = 85 ) {
		$api_base = Helper::api_base();
		$url = add_query_arg( [ 'email' => wp_get_current_user()->user_email, 'image' => $image_url, 'quality' => $quality ], $api_base );
		$remote = wp_remote_post( $url );
		return $body = json_decode( wp_remote_retrieve_body( $remote ), true );
	}
}