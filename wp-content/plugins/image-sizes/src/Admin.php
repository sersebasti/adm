<?php
/**
 * All admin facing functions
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
 * @subpackage Admin
 * @author codexpert <hello@codexpert.io>
 */
class Admin extends Base {

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

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'image-sizes', false, IMAGE_SIZES_DIR . '/languages/' );
	}

	/**
	 * Installer. Runs once when the plugin in activated.
	 *
	 * @since 1.0
	 */
	public function install() {
		if( get_option( 'image-sizes_survey_agreed' ) != 1 ) {
			delete_option( 'image-sizes_survey' );
		}

		if( ! get_option( 'image-sizes_version' ) ){
			update_option( 'image-sizes_version', $this->version );
		}
		
		if( ! get_option( 'image-sizes_install_time' ) ){
			update_option( 'image-sizes_install_time', time() );
		}
	}

	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'IMAGE_SIZES_DEBUG' ) && IMAGE_SIZES_DEBUG ? '' : '.min';
		
		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/admin{$min}.js", IMAGE_SIZES ), [ 'jquery' ], $this->version, true );
		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/admin{$min}.css", IMAGE_SIZES ), '', $this->version, 'all' );
		
		$localized = array(
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'nonce'			=> wp_create_nonce( $this->slug ),
			'regen'			=> __( 'Regenerate', 'image-sizes' ),
			'regening'		=> __( 'Regenerating..', 'image-sizes' ),
			'analyze'		=> __( 'Analyze', 'image-sizes' ),
			'analyzing'		=> __( 'Analyzing..', 'image-sizes' ),
			'analyzed'		=> __( 'Analyzed', 'image-sizes' ),
			'optimize'		=> __( 'Optimize', 'image-sizes' ),
			'optimizing'	=> __( 'Optimizing..', 'image-sizes' ),
			'optimized'		=> __( 'Optimized', 'image-sizes' ),
		);
		wp_localize_script( $this->slug, 'IMAGE_SIZES', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	public function set_init_sizes() {
		update_option( '_image-sizes', Helper::default_image_sizes() );
	}

	/**
     * unset image size(s)
     *
     * @since 1.0
     */
    public function image_sizes( $sizes ){
        $disables = Helper::get_option( 'prevent_image_sizes', 'disables', [] );

        if( count( $disables ) ) :
        foreach( $disables as $disable ){
            unset( $sizes[ $disable ] );
        }
        endif;
        
        return $sizes;
    }

	public function action_links( $links ) {
		$this->admin_url = admin_url( 'upload.php' );

		$new_links = [
			'settings'	=> sprintf( '<a href="%1$s">' . __( 'Settings', 'image-sizes' ) . '</a>', add_query_arg( 'page', $this->slug, $this->admin_url ) )
		];
		
		return array_merge( $new_links, $links );
	}

	public function plugin_row_meta( $plugin_meta, $plugin_file ) {
		
		if ( $this->plugin['basename'] === $plugin_file ) {
			$plugin_meta['help'] = '<a href="https://help.codexpert.io/?utm_source=free-plugins&utm_medium=help-link&utm_campaign=image-sizes" target="_blank" class="cx-help">' . __( 'Help', 'image-sizes' ) . '</a>';
		}

		return $plugin_meta;
	}

	public function footer_text( $text ) {
		if( get_current_screen()->parent_base != $this->slug ) return $text;

		return sprintf( __( 'If you like <strong>%1$s</strong>, please <a href="%2$s" target="_blank">leave us a %3$s rating</a> on WordPress.org! It\'d motivate and inspire us to make the plugin even better!', 'image-sizes' ), $this->name, "https://wordpress.org/support/plugin/{$this->slug}/reviews/?filter=5#new-post", '⭐⭐⭐⭐⭐' );
	}

	public function admin_notices() {
		
		if( ! current_user_can( 'manage_options' ) ) return;

		$notice_key = "_{$this->slug}_notices-dismissed";
		/**
		 * Promotional banners
		 */
		$banners = [
			'march-deal'	=> [
				'name'	=> __( 'CoDesigner', 'woolementor' ),
				'url'	=> 'https://codexpert.io/coupons/',
				'type'	=> 'text',
				'text'	=> '<p>Grab the deal &amp; get <strong>35% Discount</strong> on all our Plugins including <a href="https://codexpert.io/codesigner" target=_blank>CoDesigner Pro</a>, <a href="https://codexpert.io/wc-affiliate" target=_blank>WC Affiliate Pro</a> & <a href="https://codexpert.io/share-logins" target=_blank>Share Logins</a>. Offer ends soon. <a class="button button-primary" href="https://codexpert.io/coupons/" target="_blank">Learn More..</a></p>',
				// 'from'	=> 1647661561,
				'to'	=> strtotime( '2022-04-01 23:59:59' ),
			],
		];

		if( isset( $_GET['is-dismiss'] ) && array_key_exists( $_GET['is-dismiss'], $banners ) ) {
			$dismissed = get_option( $notice_key ) ? : [];
			$dismissed[] = sanitize_text_field( $_GET['is-dismiss'] );
			update_option( $notice_key, array_unique( $dismissed ) );
		}

		$dismissed = get_option( $notice_key ) ? : [];
		$active_banners = array_values( array_diff( array_keys( $banners ), $dismissed ) );

		$rand_index = rand( 0, count( $active_banners ) - 1 );
		$rand_img = false;
		if( isset( $active_banners[ $rand_index ] ) ) {
			$rand_img = $active_banners[ $rand_index ];
		}

		if( $rand_img ) {
			$query_args = [ 'is-dismiss' => $rand_img ];

			if( count( $_GET ) > 0 ) {
				$query_args = array_map( 'sanitize_text_field', $_GET ) + $query_args;
			}

			if( isset( $banners[ $rand_img ]['to'] ) && $banners[ $rand_img ]['to'] < time() ) return;

			?>
			<div class="notice notice-success cx-notice cx-shadow is-dismissible cx-promo cx-promo-<?php echo $banners[ $rand_img ]['type']; ?>">

				<?php if( 'image' == $banners[ $rand_img ]['type'] ) : ?>
				<a href="<?php echo add_query_arg( [ 'utm_campaign' => $rand_img ], $banners[ $rand_img ]['url'] ); ?>" target="_blank">
					<img id="<?php echo "promo-{$rand_img}"?>" src="<?php echo $banners[ $rand_img ]['image']; ?>">
				</a>
				<?php endif; ?>

				<?php if( 'text' == $banners[ $rand_img ]['type'] ) : ?>
				<!-- <a href="<?php echo add_query_arg( [ 'utm_campaign' => $rand_img ], $banners[ $rand_img ]['url'] ); ?>" target="_blank"> -->
					<?php echo $banners[ $rand_img ]['text']; ?>
				<!-- </a> -->
				<?php endif; ?>

				<a href="<?php echo add_query_arg( $query_args, '' ); ?>" class="notice-dismiss"><span class="screen-reader-text"></span></a>
			</div>
			<?php
		}
	}
}