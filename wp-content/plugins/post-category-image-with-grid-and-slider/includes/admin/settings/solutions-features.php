<?php
/**
 * Plugin Solutions & Features Page
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variables
$popup_add_link = add_query_arg( array( 'taxonomy' => 'category' ), admin_url( 'edit-tags.php' ) );
?>
	
<div id="wrap">
	<div class="pciwgas-sf-wrap">
		<div class="pciwgas-sf-inr">

			<div style="text-align: center; background: #DCDCDC; margin: 30px 0; padding: 10px 30px 30px 30px;">
			<p style="font-weight: bold !important; font-size:20px !important;"><span style="color: #50c621;">Essential Plugin Bundle</span> + Any Leading Builders (Avada / Elementor / Divi / <br>VC-WPBakery / Site Origin / Beaver) = <span style="background: #50c621;color: #fff;padding: 2px 10px;">WordPress Magic</span></p>
			<h4 style="color: #333; font-size: 14px; font-weight: 700;">Over 15K+ Customers Using <span style="color: #50c621 !important;">Essential Plugin Bundle</span></h4>
			<a href="<?php echo PCIWGAS_PLUGIN_WELCOME; ?>" target="_blank" class="pciwgas-sf-btn pciwgas-sf-btn-orange"><span class="dashicons dashicons-cart"></span> View Essential Plugin Bundle</a>
			</div>

			<!-- Start - Welcome Box -->
			<div class="pciwgas-sf-welcome-wrap">
				<div class="pciwgas-sf-welcome-inr">
					<div class="pciwgas-sf-welcome-left">
						<div class="pciwgas-sf-subtitle">Getting Started</div>
						<h2 class="pciwgas-sf-title">Welcome to Post Category Image</h2>
						<p class="pciwgas-sf-content">Display post categories with grid and slider layout. Also given option to upload image for post category. </p>
						<a href="<?php echo esc_url( $popup_add_link ); ?>" class="pciwgas-sf-btn">Launch Post Category Image</a></br> <b>OR</b> </br>
						<p style="font-size: 14px;"><span class="pciwgas-sf-blue">Post Category </span>Including in <span class="pciwgas-sf-blue">Essential Plugin Bundle</span></p>
						<a href="<?php echo esc_url( PCIWGAS_PLUGIN_WELCOME ); ?>" target="_blank" class="pciwgas-sf-btn pciwgas-sf-btn-orange"> View Bundle Deal</a>
						<div class="pciwgas-rc-wrap">
							<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
								<div class="pciwgas-rc-icon">
									<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
								</div>
								<div class="pciwgas-rc-cont">
									<h3>14 Days Refund Policy. 0 risk to you.</h3>
									<p>14-day No Question Asked Refund Guarantee</p>
								</div>
							</div>
							<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
								<div class="pciwgas-rc-icon">
									<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
								</div>
								<div class="pciwgas-rc-cont">
									<h3>Include Done-For-You Post Category Setup</h3>
									<p>Our  experts team will design 1 free Post Category for you as per your need.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="pciwgas-sf-welcome-right">
						<div class="pciwgas-sf-fp-ttl">Free vs Pro</div>
						<div class="pciwgas-sf-fp-box-wrp">
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="pciwgas-sf-box-ttl">1 Designs for Post Category Grid</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="pciwgas-sf-box-ttl">1 Designs for Post Category Slider</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-category"></i>
								<div class="pciwgas-sf-box-ttl">Display Slides for Particular Categories</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-editor-rtl"></i>
								<div class="pciwgas-sf-box-ttl">Slider RTL Support</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-block-default"></i>
								<div class="pciwgas-sf-box-ttl">Gutenbreg Block Support</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-move"></i>
								<div class="pciwgas-sf-box-ttl">Post Order / Order By Parameters</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box">
								<i class="dashicons dashicons-admin-post"></i>
								<div class="pciwgas-sf-box-ttl">Hide Empty</div>
								<div class="pciwgas-sf-tag">Free</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-art"></i>
								<div class="pciwgas-sf-box-ttl">20+ Designs</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-html"></i>
								<div class="pciwgas-sf-box-ttl">WP Templating Features </div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="pciwgas-sf-box-ttl">3 – (Post Category Grid, Slider, Centermode)</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-admin-links"></i>
								<div class="pciwgas-sf-box-ttl">Category Custom Link</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-layout"></i>
								<div class="pciwgas-sf-box-ttl">Elementor, Beaver, SiteOrigin, and VC Page Builder Support</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-format-image"></i>
								<div class="pciwgas-sf-box-ttl">Image Lazyload for Slider</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-align-center"></i>
								<div class="pciwgas-sf-box-ttl">Center Mode</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
							<div class="pciwgas-sf-fp-box pciwgas-sf-pro-box">
								<i class="dashicons dashicons-shortcode"></i>
								<div class="pciwgas-sf-box-ttl">Shortcode Generator</div>
								<div class="pciwgas-sf-tag">Pro</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Welcome Box -->

			<!-- Start - Post Category Image With Grid and Slider - Features -->
			<div class="pciwgas-features-section">
				<div class="pciwgas-center pciwgas-features-ttl">
					<h2 class="pciwgas-sf-ttl">Powerful Pro Features, Simplified</h2>
				</div>
				<div class="pciwgas-features-section-inr">
					<div class="pciwgas-features-box-wrap">
						<ul class="pciwgas-features-box-grid">
							<li>
							<div class="pciwgas-popup-icon"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/post-grid.png" /></div>
							Post Category Grid View</li>
							<li>
							<div class="pciwgas-popup-icon"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/slider.png" /></div>
							Post Category Slider View</li>
							<li>
							<div class="pciwgas-popup-icon"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/centermode.png" /></div>
							Post Category Centermode View</li>
						</ul>
					</div>
					<p style="font-size: 14px;"><span class="pciwgas-sf-blue">Post Category </span>Including in <span class="pciwgas-sf-blue">Essential Plugin Bundle</span></p>
					<a href="<?php echo esc_url( PCIWGAS_PLUGIN_WELCOME ); ?>" target="_blank" class="pciwgas-sf-btn pciwgas-sf-btn-orange"> View Bundle Deal</a>
					<div class="pciwgas-rc-wrap">
						<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
							<div class="pciwgas-rc-icon">
								<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
							</div>
							<div class="pciwgas-rc-cont">
								<h3>14 Days Refund Policy. 0 risk to you.</h3>
								<p>14-day No Question Asked Refund Guarantee</p>
							</div>
						</div>
						<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
							<div class="pciwgas-rc-icon">
								<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
							</div>
							<div class="pciwgas-rc-cont">
								<h3>Include Done-For-You Post Category Setup</h3>
								<p>Our  experts team will design 1 free Post Category for you as per your need.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Post Category - Features -->

			<!-- Start - Post Category Section -->
			<div class="pciwgas-sf-testimonial-wrap">
				<div class="pciwgas-center pciwgas-features-ttl">
					<h2 class="pciwgas-sf-ttl">Looking for a Reason to Use Essential Plugin Bundle with Post Category? Here are 3+...</h2>
				</div>
				<div class="pciwgas-testimonial-section-inr">
					<div class="pciwgas-testimonial-box-wrap">
						<div class="pciwgas-testimonial-box-grid">
							<h3 class="pciwgas-testimonial-title">Excellent Plugin & Support</h3>
							<div class="pciwgas-testimonial-desc">Professional solution from one side with the simple configuration from another. Thanks for a great solution! Buy the Pro version you wont regret it. Excellent & friendly support.</div>
							<div class="pciwgas-testimonial-clnt">@kboyjoon</div>
							<div class="pciwgas-testimonial-rating"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/rating.png" /></div>
						</div>
						<div class="pciwgas-testimonial-box-grid">
							<h3 class="pciwgas-testimonial-title">Excellent!</h3>
							<div class="pciwgas-testimonial-desc">Nice looking, easy to setup and very useful because unique.</div>
							<div class="pciwgas-testimonial-clnt">@dsl225</div>
							<div class="pciwgas-testimonial-rating"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/rating.png" /></div>
						</div>
						<div class="pciwgas-testimonial-box-grid">
							<h3 class="pciwgas-testimonial-title">Great support</h3>
							<div class="pciwgas-testimonial-desc">Plugin is working as expected and great plugin to create category based grid. And support is great and friendly. Thank you Guys</div>
							<div class="pciwgas-testimonial-clnt">@kaktarua</div>
							<div class="pciwgas-testimonial-rating"><img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/rating.png" /></div>
						</div>
					</div>
					<a href="https://wordpress.org/support/plugin/post-category-image-with-grid-and-slider/reviews/?filter=5" target="_blank" class="pciwgas-sf-btn"><span class="dashicons dashicons-star-filled"></span> View All Reviews</a> OR 
					<p style="font-size: 14px;"><span class="pciwgas-sf-blue">Post Category </span>Including in <span class="pciwgas-sf-blue">Essential Plugin Bundle</span></p>
					<a href="<?php echo PCIWGAS_PLUGIN_WELCOME; ?>"  target="_blank" class="pciwgas-sf-btn pciwgas-sf-btn-orange"> View Bundle Deal</a>
					<div class="pciwgas-rc-wrap">
						<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
							<div class="pciwgas-rc-icon">
								<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
							</div>
							<div class="pciwgas-rc-cont">
								<h3>14 Days Refund Policy. 0 risk to you.</h3>
								<p>14-day No Question Asked Refund Guarantee</p>
							</div>
						</div>
						<div class="pciwgas-rc-inr pciwgas-rc-bg-box">
							<div class="pciwgas-rc-icon">
								<img src="<?php echo esc_url( PCIWGAS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
							</div>
							<div class="pciwgas-rc-cont">
								<h3>Include Done-For-You Post Category Setup</h3>
								<p>Our experts team will design 1 free Post Category for you as per your need.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Post Category Section -->
		</div>
	</div><!-- end .pciwgas-sf-wrap -->
</div><!-- end .wrap -->