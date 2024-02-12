<?php
/**
 * Add form field
 *
 * @package Post Category Image With Grid and Slider
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$prefix = PCIWGAS_META_PREFIX; // Taking metabox prefix
?>

<div class="form-field pciwgas-term-img-wrap">
	<label for="pciwgas-url-btn"><?php esc_html_e( 'Image', 'post-category-image-with-grid-and-slider' ); ?></label>
	<input type="button" name="pciwgas_url_btn" id="pciwgas-url-btn" class="button button-secondary pciwgas-url-btn pciwgas-image-upload" value="<?php esc_attr_e( 'Upload Image', 'post-category-image-with-grid-and-slider' ); ?>" />
	<input type="button" name="pciwgas_url_clear_btn" id="pciwgas-url-clear-btn" class="button button-secondary pciwgas-url-clear-btn pciwgas-image-clear" value="<?php esc_attr_e( 'Clear', 'post-category-image-with-grid-and-slider' ); ?>" /> <br/>

	<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>cat_thumb_id" value="" class="pciwgas-cat-thumb-id pciwgas-thumb-id" />
	<p class="description"><?php esc_html_e( 'Upload or Choose category image.', 'post-category-image-with-grid-and-slider' ); ?></p>
	<div class="pciwgas-img-preview pciwgas-img-view"></div>
</div>