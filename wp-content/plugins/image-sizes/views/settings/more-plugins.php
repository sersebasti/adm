<?php
$plugins = [
	'codesigner'	=> [
		'name'	=> __( 'CoDesigner', 'image-sizes' ),
		'url'	=> 'https://codexpert.io/codesigner',
		'desc'	=> __( 'Every part of your WooCommerce store can now be edited with Elementor. Be it your Shop or cart page, or even checkout fields. Everything!
			A great shop and checkout always boost your sales. <strong>CoDesigner</strong> helps you do just that.', 'image-sizes' ),
		'thumb'	=> plugins_url( 'assets/img/codesigner.png', IMAGE_SIZES )
	],
	'wc-affiliate'	=> [
		'name'	=> __( 'WC Affiliate', 'image-sizes' ),
		'url'	=> 'https://codexpert.io/wc-affiliate',
		'desc'	=> __( 'The most feature-rich WooCommerce affiliate plugin. <strong>WC Affiliate</strong> helps you build a full-featured affiliate program for your online site.
			Multi-level commissions, cross-domain cookie sharing, automated payout, shortlink and much more!', 'image-sizes' ),
		'thumb'	=> plugins_url( 'assets/img/wc-affiliate.png', IMAGE_SIZES )
	],
	'share-logins'	=> [
		'name'	=> __( 'Share Logins', 'image-sizes' ),
		'url'	=> 'https://share-logins.com',
		'desc'	=> __( 'It\'s always boring for your users to register and log in to different sites. This is where <strong>Share Logins</strong> came into picture.
			With this one-of-a-kind plugin, you can sync your userbase accross multiple sites. Even if they use different database on different domains!', 'image-sizes' ),
		'thumb'	=> plugins_url( 'assets/img/share-logins.png', IMAGE_SIZES )
	]
];

$utm = [
	'utm_campaign'	=> 'image-sizes',
	'utm_source'	=> 'free-plugins',
	'utm_medium'	=> 'settings-page',
];

echo '<p class="image_sizes-desc">Supercharge your WordPress sites with these exclusive plugins! 🤩</p>';
echo '<div id="image_sizes-more-plugins">';
	
	foreach ( $plugins as $slug => $plugin ) {
		$url = add_query_arg( $utm, $plugin['url'] );
		echo "
		<div class='image_sizes-plugin' id='image_sizes-{$slug}'>
			<div class='image_sizes-thumb-wrap'>
				<a href='{$url}' target='_blank'><img class='image_sizes-thumb' src='{$plugin['thumb']}' /></a>
			</div>
			<div class='image_sizes-name-wrap'>
				<a href='{$url}' target='_blank'><h2 class='image_sizes-name'>{$plugin['name']}</h2></a>
			</div>
			<div class='image_sizes-desc-wrap'>";
				foreach ( explode( PHP_EOL, $plugin['desc'] ) as $line ) {
					echo "<p class='image_sizes-desc'>{$line}</p>";
				}
			echo "
			</div>
			<div class='image_sizes-url-wrap'>
				<a class='image_sizes-url' href='{$url}' target='_blank'>" . __( 'Learn More..', 'image-sizes' ) . "</a>
			</div>
		</div>";
	}

	echo "
	<div class='image_sizes-plugin' id='image_sizes-custom'>
		<div class='image_sizes-name-wrap'>
			<h2 class='image_sizes-name'>" . __( 'Something else?', 'image-sizes' ) . "</h2>
		</div>
		<div class='image_sizes-desc-wrap'>
			<p class='image_sizes-desc'>Even there are thousands of plugins available out there, we know sometimes none of them fits your requirements and you need a <strong>custom solution</strong> built especially for you.</p>
			<p class='image_sizes-desc'>We understand your situation and are available for custom developments. We're a team of some talented developers working exclusively with WordPress for more than a decade now!</p>
			<p class='image_sizes-desc'>Interested?</p>
		</div>
		<div class='image_sizes-url-wrap'>
			<a class='image_sizes-url' href='" . add_query_arg( $utm, 'https://codexpert.io/hire/' ) . "' target='_blank'>" . __( 'Get A Free Quote', 'image-sizes' ) . "</a>
		</div>
	</div>";

echo '</div>';