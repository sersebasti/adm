<?php

add_action( 'admin_menu', 'cyber_security_blocks_gettingstarted' );
function cyber_security_blocks_gettingstarted() {
	add_theme_page( esc_html__('Theme Documentation', 'cyber-security-blocks'), esc_html__('Theme Documentation', 'cyber-security-blocks'), 'edit_theme_options', 'cyber-security-blocks-guide-page', 'cyber_security_blocks_guide');
}

function cyber_security_blocks_admin_theme_style() {
   wp_enqueue_style('cyber-security-blocks-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'cyber_security_blocks_admin_theme_style');

if ( ! defined( 'CYBER_SECURITY_BLOCKS_SUPPORT' ) ) {
define('CYBER_SECURITY_BLOCKS_SUPPORT',__('https://wordpress.org/support/theme/cyber-security-blocks/','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_REVIEW' ) ) {
define('CYBER_SECURITY_BLOCKS_REVIEW',__('https://wordpress.org/support/theme/cyber-security-blocks/reviews/','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_LIVE_DEMO' ) ) {
define('CYBER_SECURITY_BLOCKS_LIVE_DEMO',__('https://www.ovationthemes.com/demos/cyber-security-services/','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_BUY_PRO' ) ) {
define('CYBER_SECURITY_BLOCKS_BUY_PRO',__('https://www.ovationthemes.com/wordpress/wordpress-cyber-security-theme/','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_PRO_DOC' ) ) {
define('CYBER_SECURITY_BLOCKS_PRO_DOC',__('https://www.ovationthemes.com/docs/ot-cyber-security-services-pro-doc/','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_FREE_DOC' ) ) {
define('CYBER_SECURITY_BLOCKS_FREE_DOC',__('http://www.ovationthemes.com/docs/ot-cyber-security-services-free-doc','cyber-security-blocks'));
}
if ( ! defined( 'CYBER_SECURITY_BLOCKS_THEME_NAME' ) ) {
define('CYBER_SECURITY_BLOCKS_THEME_NAME',__('Premium Cyber Security Blocks Theme','cyber-security-blocks'));
}

/**
 * Theme Info Page
 */
function cyber_security_blocks_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( '' ); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'cyber-security-blocks'); ?><?php echo esc_html($theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'cyber-security-blocks'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'cyber-security-blocks'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','cyber-security-blocks'); ?></h3>
					<p><?php $theme = wp_get_theme(); 
						echo wp_kses_post( apply_filters( 'description', esc_html( $theme->get( 'Description' ) ) ) );
					?></p>

					<h4><?php esc_html_e('Edit Your Site','cyber-security-blocks'); ?></h4>
					<p><?php esc_html_e('Now create your website with easy drag and drop powered by gutenburg.','cyber-security-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url() . 'site-editor.php' ); ?>" target="_blank"><?php esc_html_e('Edit Your Site','cyber-security-blocks'); ?></a>

					<h4><?php esc_html_e('Visit Your Site','cyber-security-blocks'); ?></h4>
					<p><?php esc_html_e('To check your website click here','cyber-security-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( home_url() ); ?>" target="_blank"><?php esc_html_e('Visit Your Site','cyber-security-blocks'); ?></a>

					<h4><?php esc_html_e('Theme Documentation','cyber-security-blocks'); ?></h4>
					<p><?php esc_html_e('Check the theme documentation to easily set up your website.','cyber-security-blocks'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation','cyber-security-blocks'); ?></a>
				</div>
       	</div>
			<div class="col-md-3">
				<h3><?php echo esc_html(CYBER_SECURITY_BLOCKS_THEME_NAME); ?></h3>
				<img class="cyber_security_blocks_img_responsive" style="width: 100%;" src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'cyber-security-blocks'); ?></a>
					<a class="button-primary buynow" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'cyber-security-blocks'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( CYBER_SECURITY_BLOCKS_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'cyber-security-blocks'); ?></a>
					<hr>
				</div>
				<ul style="padding-top:10px">
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'cyber-security-blocks');?> </li>                 
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'cyber-security-blocks');?> </li>
					<li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'cyber-security-blocks');?> </li>
               <li class="upsell-cyber_security_blocks"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'cyber-security-blocks');?> </li>
            </ul>
        	</div>
		</div>
	</div>

<?php }?>