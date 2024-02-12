<?php
/**
 * Edit form field
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Getting stored values
$prefix			= PCIWGAS_META_PREFIX; // Taking metabox prefix
$cat_thumb_id	= get_term_meta( $term->term_id, $prefix.'cat_thumb_id', true );
$cat_thum_image	= pciwgas_term_image( $term->term_id, 'thumbnail' ); ?>

<tr class="form-field">
	<th scope="row" valign="top"><label for="pciwgas-cat-image"><?php esc_html_e( 'Image', 'post-category-image-with-grid-and-slider' ); ?></label></th>
	<td>
		<input type="button" name="pciwgas_url_btn" id="pciwgas_url_btn" class="button button-secondary pciwgas-url-btn pciwgas-image-upload" value="<?php esc_attr_e( 'Upload Image', 'post-category-image-with-grid-and-slider' ); ?>" />
		<input type="button" name="pciwgas_url_clear_btn" id="pciwgas_url_clear_btn" class="button button-secondary pciwgas-url-clear-btn pciwgas-image-clear" value="<?php esc_attr_e( 'Clear', 'post-category-image-with-grid-and-slider' ); ?>" /> <br/>

		<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>cat_thumb_id" value="<?php echo esc_attr( $cat_thumb_id );?>" class="pciwgas-cat-thumb-id pciwgas-thumb-id" />
		<p class="description"><?php esc_html_e( 'Upload or Choose category image.', 'post-category-image-with-grid-and-slider' ); ?></p>

		<div class="pciwgas-img-preview pciwgas-img-view pciwgas-img-view">
			<?php if( ! empty( $cat_thum_image ) ) { ?>
				<img src="<?php echo esc_url( $cat_thum_image ); ?>" alt="" />
			<?php } ?>
		</div>
	</td>
</tr>