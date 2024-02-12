<?php
/**
 * Settings Page
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_version;
?>

<div class="wrap pciwgas-settings">
	<h2><?php esc_html_e( 'Post Category Image Grid and Slider - Settings', 'post-category-image-with-grid-and-slider' ); ?></h2>
	<?php
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {

		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p>'.esc_html__( "Your changes saved successfully.", "post-category-image-with-grid-and-slider" ).'</p>
			</div>';
	}
	?>
	<form action="options.php" method="POST" id="pciwgas-settings-form" class="pciwgas-settings-form">

		<?php
			settings_fields( 'pciwgas_plugin_options' );
			global $pciwgas_options;
			$selected_cat	= pciwgas_get_option( 'pciwgas_category',array() );
		?>

		<div class="metabox-holder">
			<div class="meta-box-sortables">
				<div id="general" class="postbox">

					<div class="postbox-header">
						<h3 class="hndle">
							<span><?php esc_html_e( 'Taxonomy Settings', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
					</div>

					<div class="inside">

						<table class="form-table pciwgas-design-settings-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="pciwgas-enable-author"><?php esc_html_e('Taxonomy', 'post-category-image-with-grid-and-slider'); ?>:</label>
									</th>
									<td>
										<?php
										$args = array(
													'public' => true,
												);
											$output		= 'objects'; 
											$taxonomies	= get_taxonomies( $args,$output );
											foreach ( $taxonomies as $taxonomy ) {
													?>
													<label for="<?php echo esc_attr( $taxonomy->name ); ?>">
													<input type="checkbox" id="<?php echo esc_attr( $taxonomy->name ); ?>" name="pciwgas_options[pciwgas_category][]" value="<?php echo esc_attr( $taxonomy->name ); ?>" class="" <?php checked(in_array( $taxonomy->name, $selected_cat ), true ); ?>> <?php echo esc_attr($taxonomy->label).' ('.esc_attr( $taxonomy->name ).')';?></label><br />
											<?php }
										?>
										<span class="description"><?php esc_html_e('Select taxonomy box to enable support. Custom settings on category listing page will be enabled for selected categories.', 'post-category-image-with-grid-and-slider'); ?></span>
									</td>
								</tr>

								<tr>
									<td colspan="2" scope="row">
										<input type="submit" name="pciwgas_settings_submit" class="button button-primary right pciwgas-settings-submit" value="<?php esc_attr_e('Save Changes','post-category-image-with-grid-and-slider');?>" />
									</td>
								</tr>
							</tbody>
						</table>

					</div><!-- .inside -->
				</div><!-- #general -->

				<div id="how-it-work" class="postbox">

					<div class="postbox-header">
						<h3 class="hndle">
							<span><?php esc_html_e( 'How it Work', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
					</div>

					<div class="inside">

						<table class="form-table pciwgas-design-settings-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="pciwgas-enable-author"><?php esc_html_e('Use the shortcode', 'post-category-image-with-grid-and-slider'); ?>:</label>
									</th>
									<td>
										<p>1. <?php esc_html_e( 'Display categories in grid view', 'post-category-image-with-grid-and-slider' ); ?><br />
										<span class="wpos-copy-clipboard pciwgas-shortcode-preview">[pci-cat-grid]</span> – OR – <span class="wpos-copy-clipboard pciwgas-shortcode-preview">&lt;?php echo do_shortcode(‘[pci-cat-grid]’); ?&gt;</span></p>
										<p>2. <?php esc_html_e( 'Display categories in slider view', 'post-category-image-with-grid-and-slider' ); ?><br />
										<span class="wpos-copy-clipboard pciwgas-shortcode-preview">[pci-cat-slider]</span> – OR – <span class="wpos-copy-clipboard pciwgas-shortcode-preview">&lt;?php  echo do_shortcode(‘[pci-cat-slider]’); ?&gt;</span></p>
									</td>
								</tr>
							</tbody>
						</table>

					</div><!-- .inside -->
				</div><!-- #how-it-work -->

			</div><!-- .meta-box-sortables -->
		</div><!-- .metabox-holder -->
	</form><!-- end .pciwgas-settings-form -->

</div><!-- end .pciwgas-settings -->