( function($) {

	"use strict";
	
	/* Media Uploader */
	$( document ).on( 'click', '.pciwgas-image-upload', function() {

		var imgfield, showfield, file_frame, button;
		var ele_obj	= jQuery(this);
		imgfield	= ele_obj.parent().find('.pciwgas-img-upload-input');
		showfield	= ele_obj.parent().find('.pciwgas-img-preview');
		button		= jQuery(this);

		/* If the media frame already exists, reopen it. */
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		/* Create the media frame. */
		file_frame = wp.media.frames.file_frame = wp.media({
			frame: 'post',
			state: 'insert',
			title: button.data( 'uploader-title' ),
			button: {
				text: button.data( 'uploader-button-text' ),
			},
			multiple: false  /* Set to true to allow multiple files to be selected */
		});

		file_frame.on( 'menu:render:default', function(view) {
			/* Store our views in an object. */
			var views = {};

			/* Unset default menu items */
			view.unset('library-separator');
			view.unset('gallery');
			view.unset('featured-image');
			view.unset('embed');
			view.unset('playlist');
			view.unset('video-playlist');

			/* Initialize the views in our view object. */
			view.set(views);
		});

		/* When an image is selected, run a callback. */
		file_frame.on( 'insert', function() {

			/* Get selected size from media uploader */
			var selected_size = $('.attachment-display-settings .size').val();
			
			var selection = file_frame.state().get('selection');
			selection.each( function( attachment, index ) {
				attachment = attachment.toJSON();

				/* Selected attachment url from media uploader */
				var attachment_url = attachment.sizes[selected_size].url;

				imgfield.val(attachment_url);
				ele_obj.parent().find('.pciwgas-thumb-id').val( attachment.id );
				showfield.html('<img src="'+attachment_url+'" alt="" />');
			});
		});

		/* Finally, open the modal */
		file_frame.open();
	});
	
	/* Clear Media */
	$( document ).on( 'click', '.pciwgas-image-clear', function() {
		$(this).parent().find('.pciwgas-thumb-id').val('');
		$(this).parent().find('.pciwgas-img-preview').html('');
	});

	/* Clear media fields on submit */
	if( (typeof(adminpage) !== 'undefined') && ( adminpage == 'edit-tags-php' ) ) {
		jQuery( document ).ajaxComplete( function( event, request, options ) {
		   
			if ( request && 4 === request.readyState && 200 === request.status
				&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

				var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
				if ( ! res || res.errors ) {
					return;
				}

				$('.pciwgas-thumb-id').val('');
				$('.pciwgas-img-preview').html('');
				return;
			}
		});
	}

	/* Click to Copy the Text */
	$(document).on('click', '.wpos-copy-clipboard', function() {
		var copyText = $(this);
		copyText.select();
		document.execCommand("copy");
	});

	/* Drag widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.preview-rendered', pciwgas_fl_render_preview );

	/* Save widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.layout-rendered', pciwgas_fl_render_preview );

	/* Publish button event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.didSaveNodeSettings', pciwgas_fl_render_preview );

})(jQuery);

/* Function to render shortcode preview for Beaver Builder */
function pciwgas_fl_render_preview() {
	pciwgas_category_slider_init();
}