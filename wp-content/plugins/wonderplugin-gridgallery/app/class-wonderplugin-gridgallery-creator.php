<?php

if ( ! defined( 'ABSPATH' ) )
	exit;
	
class WonderPlugin_Gridgallery_Creator {

	private $parent_view, $list_table;
	
	function __construct($parent) {
		
		$this->parent_view = $parent;
	}
	
	function render( $id, $config, $thumbnailsize ) {
		
		?>
		
		<h3><?php _e( 'General Options', 'wonderplugin_gridgallery' ); ?></h3>
		
		<div id="wonderplugin-gridgallery-id" style="display:none;"><?php echo $id; ?></div>
		
		<?php 
		if (!empty($config))
		{
			$config = str_replace("<", "&lt;", $config);
			$config = str_replace(">", "&gt;", $config);
			$config = str_replace("&quot;", "", $config);
		}
		?>
		
		<div id="wonderplugin-gridgallery-id-config" style="display:none;"><?php echo $config; ?></div>
		<div id="wonderplugin-gridgallery-jsfolder" style="display:none;"><?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?></div>
		<div id="wonderplugin-gridgallery-pluginfolder" style="display:none;"><?php echo WONDERPLUGIN_GRIDGALLERY_URL; ?></div>
		<div id="wonderplugin-gridgallery-wp-history-media-uploader" style="display:none;"><?php echo ( function_exists("wp_enqueue_media") ? "0" : "1"); ?></div>
		<div id="wonderplugin-gridgallery-viewadminurl" style="display:none;"><?php echo admin_url('admin.php?page=wonderplugin_gridgallery_show_item'); ?></div>		
		<div id="wonderplugin-gridgallery-thumbnailsize" style="display:none;"><?php echo $thumbnailsize; ?></div>
		<div id="wonderplugin-gridgallery-ajaxnonce" style="display:none;"><?php echo wp_create_nonce( 'wonderplugin-gridgallery-ajaxnonce' ); ?></div>
		<div id="wonderplugin-gridgallery-saveformnonce" style="display:none;"><?php wp_nonce_field('wonderplugin-gridgallery', 'wonderplugin-gridgallery-saveform'); ?></div>
		<div id="wonderplugin-gridgallery-usepostsave" style="display:none;"><?php echo get_option( 'wonderplugin_gridgallery_usepostsave', 0 ); ?></div>
		<div id="wonderplugin-gridgallery-displaytitleineditor" style="display:none;"><?php echo get_option( 'wonderplugin_gridgallery_displaytitleineditor', 1 ); ?></div>
		<?php 
			$cats = get_categories(array(
				'hide_empty' => false,
			));
			$catlist = array();
			foreach ( $cats as $cat )
			{
				$catlist[] = array(
						'ID' => $cat->cat_ID,
						'cat_name' => $cat ->cat_name
				);
			}
		?>
		<div id="wonderplugin-gridgallery-catlist" style="display:none;"><?php echo json_encode($catlist); ?></div>
		
		<?php 
			$folderlist = wonderplugin_gridgallery_dirtoarray(ABSPATH, false);
		?>
		<div id="wonderplugin-gridgallery-folderlist" style="display:none;"><?php echo json_encode($folderlist); ?></div>
		<div id="wonderplugin-gridgallery-folderseperator" style="display:none;"><?php echo DIRECTORY_SEPARATOR; ?></div>
		
		<?php 
		$custom_post_types = get_post_types( array('_builtin' => false), 'objects' );
	
		$custom_post_list = array();
		foreach($custom_post_types as $custom_post)
		{
			$custom_post_list[] = array(
					'name' => $custom_post->name,
					'taxonomies' => array()
				);
		}

		foreach($custom_post_list as &$custom_post)
		{
			$taxonomies = get_object_taxonomies($custom_post['name'], 'objects');			
			if (!empty($taxonomies))
			{
				
				$taxonomies_list = array();
				foreach($taxonomies as $taxonomy)
				{
					$terms = get_terms($taxonomy->name);
					
					$terms_list = array();
					foreach($terms as $term)
					{
						$terms_list[] = array(
								'name' => str_replace('"', '', str_replace("&quot;", "", $term->name)),
								'slug' => $term->slug
							);
					}

					$taxonomies_list[] = array(
							'name' => str_replace('"', '', str_replace("&quot;", "", $taxonomy->name)),
							'terms' => $terms_list
						);
				}
				
				$custom_post['taxonomies'] = $taxonomies_list;
			}
		}
		?>
		<div id="wonderplugin-gridgallery-custompostlist" style="display:none;"><?php echo json_encode($custom_post_list); ?></div>
		
		<?php 
			$langlist = array();
			$default_lang = '';
			$currentlang = '';
			if ( get_option( 'wonderplugin_gridgallery_supportmultilingual', 1 ) == 1 )
			{
				if (class_exists('SitePress'))
				{
					$languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc');
					if ( !empty($languages) )
					{
						$default_lang = apply_filters('wpml_default_language', NULL );
						$currentlang = apply_filters('wpml_current_language', NULL );
						foreach($languages as $key => $lang)
						{
							$lang_item = array(
									'code' => $lang['code'],
									'translated_name' => $lang['translated_name']
							);
							if ($key == $default_lang)
								array_unshift($langlist, $lang_item);
							else
								array_push($langlist, $lang_item);
						}				
					}
				}
			}
		?>
		<div id="wonderplugin-gridgallery-langlist" style="display:none;"><?php echo json_encode($langlist); ?></div>
		<div id="wonderplugin-gridgallery-defaultlang" style="display:none;"><?php echo $default_lang; ?></div>
		<div id="wonderplugin-gridgallery-currentlang" style="display:none;"><?php echo $currentlang; ?></div>
		<?php
			$initd_option = 'wonderplugin_gridgallery_initd';
			$initd = get_option($initd_option);
			if ($initd == false)
			{
				update_option($initd_option, time());
				$initd = time();
			}	
		?>
		<div id="<?php echo $initd_option; ?>" style="display:none;"><?php echo $initd; ?></div>

		<div style="margin:0 12px;">
		<table class="wonderplugin-form-table">
			<tr>
				<th><?php _e( 'Name', 'wonderplugin_gridgallery' ); ?></th>
				<td><input name="wonderplugin-gridgallery-name" type="text" id="wonderplugin-gridgallery-name" value="My Grid Gallery" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php _e( 'Categories', 'wonderplugin_gridgallery' ); ?>
				<?php
					if (!empty($langlist))
					{
				?>
						<div id="wonderplugin-gridgallery-category-langs" style="display:none;"></div>
						<p style="font-weight:normal;"><input type="button" class="button button-primary" id="wonderplugin-gridgallery-category-multilingual" value="Multilingual Translation"></p>
				<?php
					}
				?>
				</th>
				<td><div id="wonderplugin-gridgallery-categorylist"></div>
				<p><i>* You can drag and drop a category to change the order.</i></p></td>
			</tr>
		</table>
		</div>
		
		<h3><?php _e( 'Gallery Editor', 'wonderplugin_gridgallery' ); ?></h3>
		
		<div style="margin:0 12px;">
		<ul class="wonderplugin-tab-buttons" id="wonderplugin-gridgallery-toolbar">
			<li class="wonderplugin-tab-button step1 wonderplugin-tab-buttons-selected"><span class="wonderplugin-icon">1</span><?php _e( 'Images & Videos', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step2"><span class="wonderplugin-icon">2</span><?php _e( 'Layout', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step3"><span class="wonderplugin-icon">3</span><?php _e( 'Skins', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step4"><span class="wonderplugin-icon">4</span><?php _e( 'Options', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step5"><span class="wonderplugin-icon">5</span><?php _e( 'Preview', 'wonderplugin_gridgallery' ); ?></li>
			<li class="laststep"><input class="button button-primary button-hero" type="button" value="<?php _e( 'Save & Publish', 'wonderplugin_gridgallery' ); ?>"></input></li>
		</ul>
				
		<ul class="wonderplugin-tabs" id="wonderplugin-gridgallery-tabs">
			<li class="wonderplugin-tab wonderplugin-tab-selected">	
			
				<div class="wonderplugin-toolbar">	
					<div class="wonderplugin-toolbar-buttons">
					<input type="button" class="button" id="wonderplugin-add-image" value="<?php _e( 'Add Image', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-weblink" value="<?php _e( 'Add Web Link', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-video" value="<?php _e( 'Add Video', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-youtube" value="<?php _e( 'Add YouTube', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-youtube-playlist" value="<?php _e( 'Add YouTube Playlist', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-vimeo" value="<?php _e( 'Add Vimeo', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-dailymotion" value="<?php _e( 'Add Dailymotion', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-iframevideo" value="<?php _e( 'Add Iframe Video', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-pdf" value="<?php _e( 'Add PDF', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-posts" value="<?php _e( 'Add WordPress Posts', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-custompost" value="<?php _e( 'Add WooCommerce / Custom Post Type', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-folder" value="<?php _e( 'Import Folder', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-html" value="<?php _e( 'Add HTML / Shortcode / Soundcloud', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-import-xml" value="<?php _e( 'Import XML', 'wonderplugin_gridgallery' ); ?>" />
					</div>
					<div class="wonderplugin-toolbar-options">
					<label>Category: <select name='wonderplugin-gridgallery-selectcategorylist' id='wonderplugin-gridgallery-selectcategorylist'>
						<option value="all">Show All</option>
					</select></label>
					<label><input type="button" class="button" id="wonderplugin-sortlist" value="<?php _e( 'Sort List', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type="button" class="button" id="wonderplugin-reverselist" value="<?php _e( 'Reverse List', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type="button" class="button" id="wonderplugin-globalsettings" value="<?php _e( 'General Settings', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type="button" class="button" id="wonderplugin-quickedit" value="<?php _e( 'Quick Edit', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type="button" class="button" id="wonderplugin-deleteall" value="<?php _e( 'Delete All', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type="button" class="button" id="wonderplugin-updatevimeothumb" value="<?php _e( 'Update Vimeo Thumbs', 'wonderplugin_gridgallery' ); ?>" /></label>
					<label><input type='checkbox' id='wonderplugin-newestfirst' value='' /> Add new item to the beginning</label>
					</div>
				</div>
        		
        		<ul class="wonderplugin-table" id="wonderplugin-gridgallery-media-table">
			    </ul>
				<div class="wonderplugin-gridgallery-media-table-help"><span class="dashicons dashicons-editor-help"></span>Click the Above Buttons to Add Images, Videos or Posts</div>
			    <div style="clear:both;"></div>
      
			</li>
			<li class="wonderplugin-tab">
				<form>
					<fieldset>
						
						<?php 
						$skins = array(
								"tiles" => "Tiles",
								"list" => "List",
								"focus" => "Focus",
								"twocolumns" => "2 Columns",
								"threecolumns" => "3 Columns",
								"feature" => "Feature",
								"collage" => "Collage",
								"showcase" => "Showcase",
								"highlight" => "Highlight",
								"wall" => "Wall",
								"header" => "Header",
								"fivecolumns" => "5 Columns"
								);
						
						foreach ($skins as $key => $value) {
						?>
							<div class="wonderplugin-tab-skin">
							<label><input checked="checked" type="radio" name="wonderplugin-gridgallery-skin" value="<?php echo $key; ?>"> <?php echo $value; ?> <br /><img class="selected" style="max-width:300px;" src="<?php echo WONDERPLUGIN_GRIDGALLERY_URL; ?>images/<?php echo $key; ?>.png" /></label>
							</div>
						<?php
						}
						?>
						
					</fieldset>
				</form>
			</li>
			<li class="wonderplugin-tab">
				<form>
					<fieldset>
						
						<?php 
						$styles = array(
								"classic" => "Classic",
								"hover" => "Hover",
								"flip" => "3D Flip",
								"teammembers" => "Team Members with Social Media",
								"masonry" => "Masonry Gallery",
								"justified" => "Justified Gallery",
								"listview" => "List View",
								"flipwithtitle" => "3D Flip with Title",
								"circularflip" => "Circular 3D Flip",
								"caption" => "Caption",
								"bluetext" => "Blue Text",
								"roundcorner" => "Round Corner",
								"circular" => "Circular Image",
								"circularwithtext" => "Circular Image with Caption",
								"border" => "Border"
								);
						
						foreach ($styles as $key => $value) {
						?>
							<div class="wonderplugin-tab-style">
							<label><input checked="checked" type="radio" name="wonderplugin-gridgallery-style" value="<?php echo $key; ?>"> <?php echo $value; ?> <br /><img class="selected" style="max-width:300px;" src="<?php echo WONDERPLUGIN_GRIDGALLERY_URL; ?>images/style_<?php echo $key; ?>.jpg" /></label>
							</div>
						<?php
						}
						?>
						
					</fieldset>
				</form>
			</li>
			<li class="wonderplugin-tab">
			
				<div class="wonderplugin-gridgallery-options">
					<div class="wonderplugin-gridgallery-options-menu" id="wonderplugin-gridgallery-options-menu">
						<div class="wonderplugin-gridgallery-options-menu-item wonderplugin-gridgallery-options-menu-item-selected"><?php _e( 'Options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Text and Grid Content', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Skin CSS', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Grid template & Responsive', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Masonry & Justified', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Category options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Load More & Pagination', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Lightbox options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Google Analytics', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'YouTube and Vimeo', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Advanced options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Mobile options', 'wonderplugin_gridgallery' ); ?></div>
					</div>
					
					<div class="wonderplugin-gridgallery-options-tabs" id="wonderplugin-gridgallery-options-tabs">
					
						<div class="wonderplugin-gridgallery-options-tab wonderplugin-gridgallery-options-tab-selected">
							<table class="wonderplugin-form-table-noborder">
							
								<tr>
									<th>Size of One Grid Thumbnail (px): </th>
									<td><label><input name="wonderplugin-gridgallery-width" type="number" id="wonderplugin-gridgallery-width" value="300" class="small-text" /> by <input name="wonderplugin-gridgallery-height" type="number" id="wonderplugin-gridgallery-height" value="300" class="small-text" /></label>
									</td>
								</tr>
								
								<tr>
									<th>Thumbnail scale mode</th>
									<td><label><select name='wonderplugin-gridgallery-scalemode' id='wonderplugin-gridgallery-scalemode'>
											<option value="fill">Fill the grid, crop the image if necessary</option>
											<option value="fit">Resize and fit into the grid</option>
										</select></label>
										<label><input name='wonderplugin-gridgallery-centerimage' type='checkbox' id='wonderplugin-gridgallery-centerimage'  /> Center image</label>
									</td>
								</tr>
								
								<tr>
									<th>Defer loading</th>
									<td><label><input name='wonderplugin-gridgallery-deferloading' type='checkbox' id='wonderplugin-gridgallery-deferloading'  /> Defer loading the gallery and the images after page load for (ms):  </label><input name="wonderplugin-gridgallery-deferloadingdelay" type="number" id="wonderplugin-gridgallery-deferloadingdelay" value="0" class="small-text" /></td>
								</tr>
								
								<tr>
									<th>Random</th>
									<td><label><input name='wonderplugin-gridgallery-random' type='checkbox' id='wonderplugin-gridgallery-random'  /> Random</label>
									</td>
								</tr>
								
								<tr>
									<th>Grid gap:</th>
									<td><label><input name="wonderplugin-gridgallery-gap" type="number" id="wonderplugin-gridgallery-gap" value="24" class="small-text" /></label></td>
								</tr>
								
								<tr>
									<th>Grid margin:</th>
									<td><label><input name="wonderplugin-gridgallery-margin" type="number" id="wonderplugin-gridgallery-margin" value="0" class="small-text" /></label></td>
								</tr>
								
								<tr>
									<th>Image border radius:</th>
									<td><label><input name="wonderplugin-gridgallery-borderradius" type="number" id="wonderplugin-gridgallery-borderradius" value="16" class="small-text" /></label></td>
								</tr>
							
								<tr>
									<th>Hover effect</th>
									<td><label><input name='wonderplugin-gridgallery-nohoverontouchscreen' type='checkbox' id='wonderplugin-gridgallery-nohoverontouchscreen'  /> No hover effect on touch screen </label></td>
								</tr>
									
								<tr>
									<th>Hover zoom effect</th>
									<td><label><input name='wonderplugin-gridgallery-hoverzoomin' type='checkbox' id='wonderplugin-gridgallery-hoverzoomin'  /> Zoom in effect - </label>
									<label>Animation distance (px): <input name="wonderplugin-gridgallery-hoverzoominvalue" type="number" id="wonderplugin-gridgallery-hoverzoominvalue" value="24" class="small-text" /> Animation duration (ms): <input name="wonderplugin-gridgallery-hoverzoominduration" type="number" id="wonderplugin-gridgallery-hoverzoominduration" value="300" class="small-text" /></label>
									<br><label><input name='wonderplugin-gridgallery-hoverzoominimageonly' type='checkbox' id='wonderplugin-gridgallery-hoverzoominimageonly'  />Only zoom in image - </label>
									<label>Image animation scale: <input name="wonderplugin-gridgallery-hoverzoominimagescale" type="number" step="any" id="wonderplugin-gridgallery-hoverzoominimagescale" value="1.1" class="small-text" /> Image animation duration (ms): <input name="wonderplugin-gridgallery-hoverzoominimageduration" type="number" id="wonderplugin-gridgallery-hoverzoominimageduration" value="300" class="small-text" /></label>
									<label><input name='wonderplugin-gridgallery-hoverzoominimagecenter' type='checkbox' id='wonderplugin-gridgallery-hoverzoominimagecenter'  />Zoom from center</label>
									</td>
								</tr>
								
								<tr>
									<th>Hover fade effect</th>
									<td><label><input name='wonderplugin-gridgallery-hoverfade' type='checkbox' id='wonderplugin-gridgallery-hoverfade'  /> Fade effect - </label>
									<label>Opacity: <input name="wonderplugin-gridgallery-hoverfadeopacity" type="number" step="any" id="wonderplugin-gridgallery-hoverfadeopacity" value="0.8" class="small-text" /> Fade duration (ms): <input name="wonderplugin-gridgallery-hoverfadeduration" type="number" id="wonderplugin-gridgallery-hoverfadeduration" value="300" class="small-text" /></label>
									</td>
								</tr>
								
								<tr>
									<th>Circular image</th>
									<td><label><input name='wonderplugin-gridgallery-circularimage' type='checkbox' id='wonderplugin-gridgallery-circularimage'  /> Circular image</label>
									</td>
								</tr>

								<tr>
									<th>Lightbox gallery</th>
									<td><label><input name='wonderplugin-gridgallery-firstimage' type='checkbox' id='wonderplugin-gridgallery-firstimage'  /> Only display first image in grid gallery and create a Lightbox gallery</label>
									</td>
								</tr>
								
								<tr>
									<th>Keyboard Accessibility</th>
									<td>
										<label><input name='wonderplugin-gridgallery-enabletabindex' type='checkbox' id='wonderplugin-gridgallery-enabletabindex'  /> Support tabindex attribute: use Tab key to navigate through images</label>
									</td>
								</tr>
								
								<tr>
									<th>Play video button</th>
									<td>
										<p><label><input name='wonderplugin-gridgallery-addvideoplaybutton' type='checkbox' id='wonderplugin-gridgallery-addvideoplaybutton'  /> Add a play button on video grid</label></p>
										<div>
											<div style="float:left;margin-right:12px;">
											<label>
											<img id="wonderplugin-gridgallery-displayvideoplaybutton" style="background-color:#aaa;"/>
											</label>
											</div>
											<div style="float:left;">
											<label>
												<input type="radio" name="wonderplugin-gridgallery-videoplaybuttonmode" value="custom">
												<span style="display:inline-block;min-width:240px;">Use own image (absolute URL required):</span>
												<input name='wonderplugin-gridgallery-customvideoplaybutton' type='text' class="regular-text" id='wonderplugin-gridgallery-customvideoplaybutton' value='' />
												<input type="button" class="button wonderplugin-select-mediaimage" data-inputname="wonderplugin-gridgallery-videoplaybuttonmode" data-displayid="wonderplugin-gridgallery-displayvideoplaybutton" data-textid="wonderplugin-gridgallery-customvideoplaybutton" value="Upload">
											</label>
											<br />
											<label>
												<input type="radio" name="wonderplugin-gridgallery-videoplaybuttonmode" value="defined">
												<span style="display:inline-block;min-width:240px;">Select from pre-defined images:</span>
												<select name='wonderplugin-gridgallery-videoplaybutton' id='wonderplugin-gridgallery-videoplaybutton'>
												<?php
													$videoplaybutton_list = array("playvideo-64-64-0.png", "playvideo-64-64-1.png", "playvideo-64-64-2.png");
													foreach ($videoplaybutton_list as $videoplaybutton)
														echo '<option value="' . $videoplaybutton . '">' . $videoplaybutton . '</option>';
												?>
												</select>
											</label>
											</div>
											<div style="clear:both;"></div>
										</div>
										<script language="JavaScript">
											jQuery(document).ready(function(){
												jQuery("input:radio[name=wonderplugin-gridgallery-videoplaybuttonmode]").click(function(){
													if (jQuery(this).val() == 'custom')
														jQuery("#wonderplugin-gridgallery-displayvideoplaybutton").attr("src", jQuery('#wonderplugin-gridgallery-customvideoplaybutton').val());
													else
														jQuery("#wonderplugin-gridgallery-displayvideoplaybutton").attr("src", "<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/skins/default/'; ?>" + jQuery('#wonderplugin-gridgallery-videoplaybutton').val());
												});

												jQuery("#wonderplugin-gridgallery-videoplaybutton").change(function(){
													if (jQuery("input:radio[name=wonderplugin-gridgallery-videoplaybuttonmode]:checked").val() == 'defined')
														jQuery("#wonderplugin-gridgallery-displayvideoplaybutton").attr("src", "<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/skins/default/'; ?>" + jQuery(this).val());
												});
											});
										</script>
									</td>
								</tr>

								<tr>
									<th>Add extra attributes to IMG elements</th>
									<td><label><input name="wonderplugin-gridgallery-imgextraprops" type="text" id="wonderplugin-gridgallery-imgextraprops" value="" class="regular-text" /></label></td>
								</tr>

								<tr>
									<th>Add extra attributes to A elements</th>
									<td><label><input name="wonderplugin-gridgallery-aextraprops" type="text" id="wonderplugin-gridgallery-aextraprops" value="" class="regular-text" /></label></td>
								</tr>

								<tr>
									<th>Add extra attributes to A elements of tags and category names</th>
									<td><label><input name="wonderplugin-gridgallery-taglinkextraprops" type="text" id="wonderplugin-gridgallery-taglinkextraprops" value="" class="regular-text" /></label></td>
								</tr>

								<tr>
									<th>Tags and category names separator</th>
									<td><label><input name="wonderplugin-gridgallery-nameseparator" type="text" id="wonderplugin-gridgallery-nameseparator" value="" class="regular-text" /></label></td>
								</tr>
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Text Overlay</th>
									<td><label><input name='wonderplugin-gridgallery-showtitle' type='checkbox' id='wonderplugin-gridgallery-showtitle'  /> Show text overlay&nbsp;&nbsp;</label>
									<label>
										<select name='wonderplugin-gridgallery-titlemode' id='wonderplugin-gridgallery-titlemode'>
											<option value="always">Always Show</option>
											<option value="mouseover">Show On Mouseover</option>
										</select>
									</label>
									<p><label>Animation effect:
										<select name='wonderplugin-gridgallery-titleeffect' id='wonderplugin-gridgallery-titleeffect'>
											<option value=fade>Fade</option>
											<option value="slide">Slide</option>
											<option value="flipy">Flip</option>
											<option value="none">None</option>
										</select>
									</label>
									<label>&nbsp;&nbsp;Effect duration (ms):<input name="wonderplugin-gridgallery-titleeffectduration" type="number" id="wonderplugin-gridgallery-titleeffectduration" value="300" class="small-text" /></label>
									</p>
									<p><label><input name='wonderplugin-gridgallery-usetemplatefortextoverlay' type='radio' value="1" /> Use the following template for text overlay content:</label></p>
									<div style="margin-left:20px;" class="wonderplugin-gridgallery-usetemplatefortextoverlay-true">
										<textarea name='wonderplugin-gridgallery-templatefortextoverlay' id='wonderplugin-gridgallery-templatefortextoverlay' value='' class='large-text' rows="6"></textarea>
									</div>
									<p><label><input name='wonderplugin-gridgallery-usetemplatefortextoverlay' type='radio' value="0" /> Do not use template for text overlay content, use the following options:</label></p>
									<div style="margin-left:20px;" class="wonderplugin-gridgallery-usetemplatefortextoverlay-false">
										<label><input name='wonderplugin-gridgallery-showtexttitle' type='checkbox' id='wonderplugin-gridgallery-showtexttitle'  /> Include title in text</label>
										<p><label><input name='wonderplugin-gridgallery-showtextdescription' type='checkbox' id='wonderplugin-gridgallery-showtextdescription'  /> Include description in text</label></p>
										<p><label><input name='wonderplugin-gridgallery-showtextbutton' type='checkbox' id='wonderplugin-gridgallery-showtextbutton'  /> Include button in text</label></p>
									</div>
									</td>
								</tr>
								
								<tr>
									<th>Grid Caption Height (space below the grid image)</th>
									<td><label><input name="wonderplugin-gridgallery-titleheight" type="number" id="wonderplugin-gridgallery-titleheight" value="" class="small-text" /></label></td>
								</tr>

								<tr>
									<th>Grid Content</th>
									<td>
									<label><input name='wonderplugin-gridgallery-usetemplateforgrid' type='checkbox' id='wonderplugin-gridgallery-usetemplateforgrid'  /> Use the following template for grid content:</label>
									<p><textarea name='wonderplugin-gridgallery-templateforgrid' id='wonderplugin-gridgallery-templateforgrid' value='' class='large-text' rows="6"></textarea></p>
									<p><label>Image width in grid content (%):<input name="wonderplugin-gridgallery-imgwidthpercent" type="number" id="wonderplugin-gridgallery-imgwidthpercent" value="100" class="small-text" /></label> <label>Image height in grid content (%):<input name="wonderplugin-gridgallery-imgheightpercent" type="number" id="wonderplugin-gridgallery-imgheightpercent" value="100" class="small-text" /></label></p>
									</td>
								</tr>
								
								<tr>
									<th>Text Options</th>
									<td>
									<label><input name='wonderplugin-gridgallery-overlaylink' type='checkbox' id='wonderplugin-gridgallery-overlaylink'  /> Open the web link or lightbox when clicking on the text overlay</label>
									<p><label><input name='wonderplugin-gridgallery-applylinktotext' type='checkbox' id='wonderplugin-gridgallery-applylinktotext'  /> Open the web link or lightbox ONLY when clicking on the text overlay</label></p>
									<p><label><input name='wonderplugin-gridgallery-donotaddtext' type='checkbox' id='wonderplugin-gridgallery-donotaddtext'  /> Do not add text to the HTML code (this option will remove all texts from the gallery)</label></p>
									<p><label><input name='wonderplugin-gridgallery-supportshortcode' type='checkbox' id='wonderplugin-gridgallery-supportshortcode'  /> Support shortcodes in title and description</label></p>
									</td>
								</tr>
								
							</table>
						</div>
								
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Skin CSS</th>
									<td><textarea name='wonderplugin-gridgallery-skincss' id='wonderplugin-gridgallery-skincss' value='' class='large-text' rows="20"></textarea></td>
								</tr>
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
							
								<tr>
									<th>Grid template</th>
									<td><label>Column: <input name="wonderplugin-gridgallery-column" type="number" id="wonderplugin-gridgallery-column" value="3" class="small-text" /></label></td>
								</tr>
								<tr>
									<th></th>
									<td><textarea name='wonderplugin-gridgallery-gridtemplate' id='wonderplugin-gridgallery-gridtemplate' value='' class='large-text' rows="8"></textarea></td>
								</tr>
								
								<tr>
									<th>Responsive</th>
									<td><label><input name='wonderplugin-gridgallery-responsive' type='checkbox' id='wonderplugin-gridgallery-responsive'  /> Responsive</label>
									<p><label><input name='wonderplugin-gridgallery-fullwidth' type='checkbox' id='wonderplugin-gridgallery-fullwidth'  /> Create a full width gallery: keep the column number unchanged, change the grid size accordingly</label></p>
									<p><label><input name='wonderplugin-gridgallery-fullwidthsamegrid' type='checkbox' id='wonderplugin-gridgallery-fullwidthsamegrid'  /> Create a full width gallery: keep the grid size unchanged, change the column number accordingly</label></p>
									<p><label><input name='wonderplugin-gridgallery-donotzoomin' type='checkbox' id='wonderplugin-gridgallery-donotzoomin'  /> Do not zoom in grid</label></p>
									</td>
								</tr>
								
								<tr>
									<th>Medium screen</th>
									<td><label><input name='wonderplugin-gridgallery-mediumscreen' type='checkbox' id='wonderplugin-gridgallery-mediumscreen'  /> Apply the following options when screen is smaller than (px): </label><input name="wonderplugin-gridgallery-mediumscreensize" type="number" id="wonderplugin-gridgallery-mediumscreensize" value="800" class="small-text" /></td>
								</tr>
								
								<tr>
									<th></th>
									<td><label>Column: <input name="wonderplugin-gridgallery-mediumcolumn" type="number" id="wonderplugin-gridgallery-mediumcolumn" value="1" class="small-text" /></label>
									<p><label>Image width in grid content (%):<input name="wonderplugin-gridgallery-mediumimgwidthpercent" type="number" id="wonderplugin-gridgallery-mediumimgwidthpercent" value="100" class="small-text" /></label> <label>Image height in grid content (%):<input name="wonderplugin-gridgallery-mediumimgheightpercent" type="number" id="wonderplugin-gridgallery-mediumimgheightpercent" value="100" class="small-text" /></label></p>
									<p><label><input name='wonderplugin-gridgallery-mediumgridsize' type='checkbox' id='wonderplugin-gridgallery-mediumgridsize'  /> Configure a different size for grid thumbnail on medium screens (px): </label>
									<input name="wonderplugin-gridgallery-mediumwidth" type="number" id="wonderplugin-gridgallery-mediumwidth" value="320" class="small-text" /> by <input name="wonderplugin-gridgallery-mediumheight" type="number" id="wonderplugin-gridgallery-mediumheight" value="240" class="small-text" />
									</p>
									</td>
								</tr>
								
								<tr>
									<th>Small screen</th>
									<td><label><input name='wonderplugin-gridgallery-smallscreen' type='checkbox' id='wonderplugin-gridgallery-smallscreen'  /> Apply the following options when screen is smaller than (px): </label><input name="wonderplugin-gridgallery-smallscreensize" type="number" id="wonderplugin-gridgallery-smallscreensize" value="600" class="small-text" /></td>
								</tr>
								
								<tr>
									<th></th>
									<td><label>Column: <input name="wonderplugin-gridgallery-smallcolumn" type="number" id="wonderplugin-gridgallery-smallcolumn" value="1" class="small-text" /></label>
									<p><label>Image width in grid content (%):<input name="wonderplugin-gridgallery-smallimgwidthpercent" type="number" id="wonderplugin-gridgallery-smallimgwidthpercent" value="100" class="small-text" /></label> <label>Image height in grid content (%):<input name="wonderplugin-gridgallery-smallimgheightpercent" type="number" id="wonderplugin-gridgallery-smallimgheightpercent" value="100" class="small-text" /></label></p>
									<p><label><input name='wonderplugin-gridgallery-smallgridsize' type='checkbox' id='wonderplugin-gridgallery-smallgridsize'  /> Configure a different size for grid thumbnail on small screens (px): </label>
									<input name="wonderplugin-gridgallery-smallwidth" type="number" id="wonderplugin-gridgallery-smallwidth" value="320" class="small-text" /> by <input name="wonderplugin-gridgallery-smallheight" type="number" id="wonderplugin-gridgallery-smallheight" value="240" class="small-text" />
									</p>
									</td>
								</tr>
								
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
									
								<tr>
									<th>Masonry Gallery</th>
									<td><label><input name='wonderplugin-gridgallery-masonrymode' type='checkbox' id='wonderplugin-gridgallery-masonrymode'  /> Enable masonry layout: do not crop images and fit all images together</label>
									</td>
								</tr>

								<tr>
									<th>Justified Gallery</th>
									<td><label><input name='wonderplugin-gridgallery-justifymode' type='checkbox' id='wonderplugin-gridgallery-justifymode'  /> Enable justify layout: do not crop images and display images row by row fluidly</label>
									<p><label><input name='wonderplugin-gridgallery-limitjustifymaxheight' type='checkbox' id='wonderplugin-gridgallery-limitjustifymaxheight'  /> Setup maximum row height as <input name="wonderplugin-gridgallery-justifymaxheight" type="number" id="wonderplugin-gridgallery-justifymaxheight" value="1.2" step="0.1" class="small-text" /> * ( thumbnail grid height )</label></p>
									<p><label><input name='wonderplugin-gridgallery-donotjustifylastrowifoverlimit' type='checkbox' id='wonderplugin-gridgallery-donotjustifylastrowifoverlimit'  /> Do not justify the last row if the row height is over the limit</label></p>
									<p><label><input name='wonderplugin-gridgallery-donotjustifyifonlyonerowandoverlimit' type='checkbox' id='wonderplugin-gridgallery-donotjustifyifonlyonerowandoverlimit'  /> Do not justify the row if there is only one row and the row height is over the limit</label></p>
									</td>
								</tr>

							</table>
						</div>

						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Categories</th>
									<td><label><input name="wonderplugin-gridgallery-categoryshow" type="checkbox" id="wonderplugin-gridgallery-categoryshow" /> Show categories buttons</label>
									<p><label><input name="wonderplugin-gridgallery-categoryhideall" type="checkbox" id="wonderplugin-gridgallery-categoryhideall" /> Hide the "Show All" button</label></p>
									<p><label><input name="wonderplugin-gridgallery-categorymulticat" type="checkbox" id="wonderplugin-gridgallery-categorymulticat" /> Allow to select multiple categories</label></p>
									<p><label><input name="wonderplugin-gridgallery-categoryatleastone" type="checkbox" id="wonderplugin-gridgallery-categoryatleastone" /> At least one category must be selected</label></p>
									<p><label><input name="wonderplugin-gridgallery-categorymulticatand" type="checkbox" id="wonderplugin-gridgallery-categorymulticatand" /> When multiple categories are selected, only show items that belong to all selected categories</label></p>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Position</th>
									<td>
									<select name='wonderplugin-gridgallery-categoryposition' id='wonderplugin-gridgallery-categoryposition'>
										<option value="topleft">Top left</option>
										<option value="topcenter">Top center</option>
										<option value="topright">Top right</option>
										<option value="bottomleft">Bottom left</option>
										<option value="bottomcenter">Bottom center</option>
										<option value="bottomright">Bottom right</option>
										<option value="lefttop">Left top</option>
										<option value="righttop">Right top</option>
									</select>
									<br>For position "Left top" and "Right top", change to top and bottom position when the screen width is less than (px): <input name="wonderplugin-gridgallery-verticalcategorysmallscreenwidth" type="number" id="wonderplugin-gridgallery-verticalcategorysmallscreenwidth" value="480" class="small-text" />
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Default category</th>
									<td>
									<select name='wonderplugin-gridgallery-categorydefault' id='wonderplugin-gridgallery-categorydefault'>
										<option value="all">Show All</option>
									</select>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">CSS style</th>
									<td>
									<select name='wonderplugin-gridgallery-categorystyle' id='wonderplugin-gridgallery-categorystyle'>
										<option value="wpp-category-greybutton">wpp-category-greybutton</option>
										<option value="wpp-category-bluebutton-withtick">wpp-category-bluebutton-withtick</option>
										<option value="wpp-category-textlink">wpp-category-textlink</option>
										<option value="wpp-category-bluebutton-dropdownmenu">wpp-category-bluebutton-dropdownmenu</option>
										<option value="wpp-category-regular-dropdown">wpp-category-regular-dropdown</option>
									</select>
									<div class="wonderplugin-gridgallery-category-dropdownmenu-options" style="display:none;"><p><label>Dropdown menu button caption: <input name="wonderplugin-gridgallery-categorymenucaption" type="text" id="wonderplugin-gridgallery-categorymenucaption" value="" class="medium-text" /></label>
									<?php if (!empty($langlist)) { ?>
									<label style="margin-left:12px;"><input type="button" class="button button-primary" id="wonderplugin-gridgallery-categorymenucaption-multilingual" value="Multilingual Translation"></label>
									<?php } ?>
									</p>
									<div id="wonderplugin-gridgallery-categorymenucaption-langs" style="display:none;"></div>
									</div>
									<p><textarea name='wonderplugin-gridgallery-categorycss' id='wonderplugin-gridgallery-categorycss' value='' class='large-text' rows="20"></textarea></p>
									</td>
								</tr>
								
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Load More or Pagination</th>
									<td>
									<select name='wonderplugin-gridgallery-lazyloadmode' id='wonderplugin-gridgallery-lazyloadmode'>
										<option value="none">None</option>
										<option value="loadmore">Display Load More</option>
										<option value="pagination">Pagination</option>
									</select>
									<p><label><input name='wonderplugin-gridgallery-lazyloadimages' type='checkbox' id='wonderplugin-gridgallery-lazyloadimages'  /> Lazy load hidden images</label></p>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Items Per Page/Load</th>
									<td><input name="wonderplugin-gridgallery-itemsperpage" type="number" min=1 id="wonderplugin-gridgallery-itemsperpage" value="12" class="small-text" /></td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Load More Button Caption</th>
									<td><input name="wonderplugin-gridgallery-loadmorecaption" type="text" id="wonderplugin-gridgallery-loadmorecaption" value="Load More" class="medium-text" />
									<p><label><input name='wonderplugin-gridgallery-loadallremaining' type='checkbox' id='wonderplugin-gridgallery-loadallremaining'  /> Load all remaining on click the button</label></p>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Load More Button CSS</th>
									<td>
									<select name='wonderplugin-gridgallery-loadmorecssstyle' id='wonderplugin-gridgallery-loadmorecssstyle'>
										<option value="wpp-loadmore-greybutton">wpp-loadmore-greybutton</option>
										<option value="wpp-loadmore-bluebutton">wpp-loadmore-bluebutton</option>
									</select>
									<p><textarea name='wonderplugin-gridgallery-loadmorecss' id='wonderplugin-gridgallery-loadmorecss' value='' class='large-text' rows="10"></textarea></p>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Pagination Position</th>
									<td>
									<select name='wonderplugin-gridgallery-paginationpos' id='wonderplugin-gridgallery-paginationpos'>
										<option value="top">Top</option>
										<option value="bottom">Bottom</option>
									</select>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Pagination CSS</th>
									<td>
									<select name='wonderplugin-gridgallery-paginationcssstyle' id='wonderplugin-gridgallery-paginationcssstyle'>
										<option value="wpp-pagination-greybutton">wpp-pagination-greybutton</option>
										<option value="wpp-pagination-greydots">wpp-pagination-greydots</option>
										<option value="wpp-pagination-yellowbutton">wpp-pagination-yellowbutton</option>
									</select>
									<p><textarea name='wonderplugin-gridgallery-paginationcss' id='wonderplugin-gridgallery-paginationcss' value='' class='large-text' rows="10"></textarea></p>
									</td>
								</tr>
								
							</table>
						</div>
								
						<div class="wonderplugin-gridgallery-options-tab" style="padding:24px;">
						
						<ul class="wonderplugin-tab-buttons-horizontal" data-panelsid="wonderplugin-lightbox-panels">
							<li class="wonderplugin-tab-button-horizontal wonderplugin-tab-button-horizontal-selected"><?php _e( 'General', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Video', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Thumbnails', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Text', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Enter and Exit Animation', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Social Media', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Transition', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Audio', 'wonderplugin_gridgallery' ); ?></li>
							<li class="wonderplugin-tab-button-horizontal"></span><?php _e( 'Lightbox Advanced Options', 'wonderplugin_gridgallery' ); ?></li>
							<div style="clear:both;"></div>
						</ul>
						
						<ul class="wonderplugin-tabs-horizontal" id="wonderplugin-lightbox-panels">
						
							<li class="wonderplugin-tab-horizontal wonderplugin-tab-horizontal-selected">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">General</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxresponsive" type="checkbox" id="wonderplugin-gridgallery-lightboxresponsive" /> Responsive</label>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Fullscreen Mode</th>
									<td>
									<label><input name="wonderplugin-gridgallery-lightboxfullscreenmode" type="checkbox" id="wonderplugin-gridgallery-lightboxfullscreenmode" /> Display in fullscreen mode (the close button on top right of the web browser)</label>
									<br><label><input name="wonderplugin-gridgallery-lightboxfullscreenmodeonsmallscreen" type="checkbox" id="wonderplugin-gridgallery-lightboxfullscreenmodeonsmallscreen" /> Switch to fullscreen mode when the screen width is less than (px): </label>
									<input name="wonderplugin-gridgallery-lightboxfullscreensmallscreenwidth" type="number" min=0 id="wonderplugin-gridgallery-lightboxfullscreensmallscreenwidth" value="800" class="small-text" />
									<br><label><input name="wonderplugin-gridgallery-lightboxfullscreentextoutside" type="checkbox" id="wonderplugin-gridgallery-lightboxfullscreentextoutside" /> Display text outside the image box in fullscreen mode</label>
									<br><label><input name="wonderplugin-gridgallery-lightboxfullscreentextinside" type="checkbox" id="wonderplugin-gridgallery-lightboxfullscreentextinside" /> Display text inside the image box in fullscreen mode</label>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Slideshow</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxautoslide" type="checkbox" id="wonderplugin-gridgallery-lightboxautoslide" /> Auto play slideshow</label>
									<p>Slideshow interval (ms): <input name="wonderplugin-gridgallery-lightboxslideinterval" type="number" min=0 id="wonderplugin-gridgallery-lightboxslideinterval" value="5000" class="small-text" /></p>
									<p><label><input name="wonderplugin-gridgallery-lightboxshowplaybutton" type="checkbox" id="wonderplugin-gridgallery-lightboxshowplaybutton" /> Show play slideshow button</label></p>
									<p><label><input name="wonderplugin-gridgallery-lightboxshowtimer" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtimer" /> Show line timer for image slideshow</label></p>
									<p>Timer position: <select name="wonderplugin-gridgallery-lightboxtimerposition" id="wonderplugin-gridgallery-lightboxtimerposition">
										  <option value="bottom">Bottom</option>
										  <option value="top">Top</option>
										</select>
									Timer color: <input name="wonderplugin-gridgallery-lightboxtimercolor" type="text" id="wonderplugin-gridgallery-lightboxtimercolor" value="#dc572e" class="medium-text" />
									Timer height: <input name="wonderplugin-gridgallery-lightboxtimerheight" type="number" min=0 id="wonderplugin-gridgallery-lightboxtimerheight" value="2" class="small-text" />
									Timer opacity: <input name="wonderplugin-gridgallery-lightboxtimeropacity" type="number" min=0 max=1 step="0.1" id="wonderplugin-gridgallery-lightboxtimeropacity" value="1" class="small-text" /></p>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Slideshow Arrows</th>
									<td>
									<label>Arrows Position: <select name="wonderplugin-gridgallery-lightboxnavarrowspos" id="wonderplugin-gridgallery-lightboxnavarrowspos">
									<option value="inside">Inside of the Lightbox</option>
									<option value="side">Outside of the Lightbox</option>
									<option value="browserside">Side of the Web Browser</option>
									</select></label>
									<div class="wonderplugin-gridgallery-lightboxnavarrowspos-options">
									<p><label><input name="wonderplugin-gridgallery-lightboxalwaysshownavarrows" type="checkbox" id="wonderplugin-gridgallery-lightboxalwaysshownavarrows" /> Always show left and right navigation arrows</label></p>
									</div>
									</td>
								</tr>
								<tr>
									<th>Overlay</th>
									<td>Color: <label><input name="wonderplugin-gridgallery-lightboxoverlaybgcolor" type="text" id="wonderplugin-gridgallery-lightboxoverlaybgcolor" value="#000" /></label>
									Opacity (from 0 to 1): <label><input name="wonderplugin-gridgallery-lightboxoverlayopacity" type="number" min="0" max="1" step="0.1" id="wonderplugin-gridgallery-lightboxoverlayopacity" value="0.8" class="small-text" /></label>
									<label><input name="wonderplugin-gridgallery-lightboxcloseonoverlay" type="checkbox" id="wonderplugin-gridgallery-lightboxcloseonoverlay" /> Close the lightbox when clicking on the overlay background</label>
									</td>
								</tr>
								<tr>
									<th>Background color</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxbgcolor" type="text" id="wonderplugin-gridgallery-lightboxbgcolor" value="#fff" /></label>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Border</th>
									<td>Border radius (px): <input name="wonderplugin-gridgallery-lightboxborderradius" type="number" min=0 id="wonderplugin-gridgallery-lightboxborderradius" value="0" class="small-text" />
									Border size (px): <input name="wonderplugin-gridgallery-lightboxbordersize" type="number" min=0 id="wonderplugin-gridgallery-lightboxbordersize" value="8" class="small-text" />
									<br>Border margin to top and bottom (px): <input name="wonderplugin-gridgallery-lightboxbordertopmargin" type="number" min=0 id="wonderplugin-gridgallery-lightboxbordertopmargin" value="48" class="small-text" />
									</td>
								</tr>
								<tr>
									<th>Group</th>
									<td><label><input name='wonderplugin-gridgallery-lightboxnogroup' type='checkbox' id='wonderplugin-gridgallery-lightboxnogroup'  /> Do not display lightboxes as a group</label>
									<br><label><input name='wonderplugin-gridgallery-lightboxcategorygroup' type='checkbox' id='wonderplugin-gridgallery-lightboxcategorygroup'  /> Only display lightboxes in the same category as a group</label>
									<br><label><input name='wonderplugin-gridgallery-lightboxshowallcategories' type='checkbox' id='wonderplugin-gridgallery-lightboxshowallcategories'  /> Show all images/videos in the lightbox when "Show All" is selected</label>
									</td>
								</tr>
								
							</table>
							</li>
							
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Default volume of MP4/WebM videos</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxdefaultvideovolume" type="number" min=0 max=1 step="0.1" id="wonderplugin-gridgallery-lightboxdefaultvideovolume" value="1" class="small-text" /> (0 - 1)</label></td>
								</tr>
		
								<tr>
									<th>Video</th>
									<td><label><input name='wonderplugin-gridgallery-lightboxvideohidecontrols' type='checkbox' id='wonderplugin-gridgallery-lightboxvideohidecontrols'  /> Hide MP4/WebM video play control bar</label>
									<p><label><input name='wonderplugin-gridgallery-lightboxenablehtml5poster' type='checkbox' id='wonderplugin-gridgallery-lightboxenablehtml5poster'  /> Use the grid image as the HTML5 video poster</label></p>
									<p style="font-style:italic;">* Video autoplay is not supported on mobile and tables. The limitation comes from iOS and Android.</p>
									</td>
								</tr>
							</table>
							</li>
							
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Thumbnails</th>
									<td><label><input name='wonderplugin-gridgallery-shownavigation' type='checkbox' id='wonderplugin-gridgallery-shownavigation'  /> Show thumbnails</label>
									<p><label><input name='wonderplugin-gridgallery-shownavcontrol' type='checkbox' id='wonderplugin-gridgallery-shownavcontrol'  /> Display a button to show/hide the thumbnails</label></p>
									<p><label><input name='wonderplugin-gridgallery-hidenavdefault' type='checkbox' id='wonderplugin-gridgallery-hidenavdefault'  /> When the show/hide button is displayed, hide the thumbnails by default</label></p>	
									</td>
								</tr>
								<tr>
									<th></th>
									<td><label>Thumbnail size: <input name="wonderplugin-gridgallery-thumbwidth" type="text" id="wonderplugin-gridgallery-thumbwidth" value="96" class="small-text" /> x <input name="wonderplugin-gridgallery-thumbheight" type="text" id="wonderplugin-gridgallery-thumbheight" value="72" class="small-text" /></label> 
									<label>Top margin: <input name="wonderplugin-gridgallery-thumbtopmargin" type="text" id="wonderplugin-gridgallery-thumbtopmargin" value="12" class="small-text" /> Bottom margin: <input name="wonderplugin-gridgallery-thumbbottommargin" type="text" id="wonderplugin-gridgallery-thumbbottommargin" value="12" class="small-text" /></label>
									</td>
								</tr>
								<tr>
									<th></th>
									<td>
									Background color: <input name="wonderplugin-gridgallery-navbgcolor" type="text" id="wonderplugin-gridgallery-navbgcolor" value="" class="regular-text" />								
									</td>
								</tr>
							</table>
							</li>
							
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Text position</th>
									<td>
										<select name="wonderplugin-gridgallery-lightboxtitlestyle" id="wonderplugin-gridgallery-lightboxtitlestyle">
										  <option value="bottom">Bottom</option>
										  <option value="outside">Outside</option>
											<option value="inside">Inside</option>
										  <option value="right">Right</option>
										  <option value="left">Left</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>Maximum text bar height when text position is bottom</th>
									<td><label><input name="wonderplugin-gridgallery-barheight" type="number" id="wonderplugin-gridgallery-barheight" value="48" class="small-text" /></label>
									<p>When the screen height is less than <input name="wonderplugin-gridgallery-lightboxsmallscreenheight" type="number" id="wonderplugin-gridgallery-lightboxsmallscreenheight" value="415" class="small-text" />px:
									<br><label><input name='wonderplugin-gridgallery-lightboxresponsivebarheight' type='checkbox' id='wonderplugin-gridgallery-lightboxresponsivebarheight'  />Change the bar height on small height screen</label> to  <input name="wonderplugin-gridgallery-lightboxbarheightonsmallheight" type="number" id="wonderplugin-gridgallery-lightboxbarheightonsmallheight" value="48" class="small-text" />px
									<br><label><input name='wonderplugin-gridgallery-lightboxnotkeepratioonsmallheight' type='checkbox' id='wonderplugin-gridgallery-lightboxnotkeepratioonsmallheight'  />Do not keep aspect ratio</label>
									<br>Border margin to top and bottom (px): <input name="wonderplugin-gridgallery-lightboxbordertopmarginsmall" type="number" min=0 id="wonderplugin-gridgallery-lightboxbordertopmarginsmall" value="48" class="small-text" />
									</p>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Image/video width percentage when text position is right or left</th>
									<td><input name="wonderplugin-gridgallery-lightboximagepercentage" type="number" id="wonderplugin-gridgallery-lightboximagepercentage" value="75" class="small-text" />%</td>
								</tr>
								<tr valign="top">
									<th scope="row">Title</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxshowtitle" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtitle" /> Show title</label></td>
								</tr>
								<tr valign="top">
									<th scope="row">Add the following prefix to title</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxshowtitleprefix" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtitleprefix" /> Add prefix:</label><input name="wonderplugin-gridgallery-lightboxtitleprefix" type="text" id="wonderplugin-gridgallery-lightboxtitleprefix" value="" class="regular-text" /></td>
								</tr>
								<tr>
									<th>Title CSS</th>
									<td><label><textarea name="wonderplugin-gridgallery-titlebottomcss" id="wonderplugin-gridgallery-titlebottomcss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Title CSS when text position is inside</th>
									<td><textarea name="wonderplugin-gridgallery-lightboxtitleinsidecss" id="wonderplugin-gridgallery-lightboxtitleinsidecss" rows="2" class="large-text code"></textarea></td>
								</tr>
								<tr valign="top">
									<th scope="row">Title CSS when text position is inside and in fullscreen mode</th>
									<td><textarea name="wonderplugin-gridgallery-lightboxfullscreentitlebottomcss" id="wonderplugin-gridgallery-lightboxfullscreentitlebottomcss" rows="2" class="large-text code"></textarea></td>
								</tr>
								<tr valign="top">
									<th scope="row">Description</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxshowdescription" type="checkbox" id="wonderplugin-gridgallery-lightboxshowdescription" /> Show description</label></td>
								</tr>
								
								<tr>
									<th>Description CSS</th>
									<td><label><textarea name="wonderplugin-gridgallery-descriptionbottomcss" id="wonderplugin-gridgallery-descriptionbottomcss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Description CSS when text position is inside</th>
									<td><textarea name="wonderplugin-gridgallery-lightboxdescriptioninsidecss" id="wonderplugin-gridgallery-lightboxdescriptioninsidecss" rows="2" class="large-text code"></textarea></td>
								</tr>
								<tr valign="top">
									<th scope="row">Description CSS when text position is inside and in fullscreen mode</th>
									<td><textarea name="wonderplugin-gridgallery-lightboxfullscreendescriptionbottomcss" id="wonderplugin-gridgallery-lightboxfullscreendescriptionbottomcss" rows="2" class="large-text code"></textarea></td>
								</tr>
							</table>
							</li>
							
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Enter Animation</th>
									<td>
									<select name="wonderplugin-gridgallery-lightboxenteranimation" id="wonderplugin-gridgallery-lightboxenteranimation">
									<option value="">Classic Resizing</option>
									<option value="none">None</option>
									<option value="fadeIn">Fade In</option>
									<option value="fadeInDown">Fade In Down</option>
									<option value="zoomIn">ZoomIn</option>
									<option value="bounceIn">Bounce In</option>
									</select>
									</td>
								</tr>

								<tr valign="top">
									<th scope="row">Exit Animation</th>
									<td>
									<select name="wonderplugin-gridgallery-lightboxexitanimation" id="wonderplugin-gridgallery-lightboxexitanimation">
									<option value="">None</option>
									<option value="fadeOut">Fade Out</option>
									<option value="fadeOutDown">Fade Out Down</option>
									</select>
									</td>
								</tr>
							</table>
							</li>

							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
							
							<tr valign="top">
								<th scope="row">Social Media Share Buttons</th>
								<td><label for="wonderplugin-gridgallery-lightboxshowsocial"><input name="wonderplugin-gridgallery-lightboxshowsocial" type="checkbox" id="wonderplugin-gridgallery-lightboxshowsocial" /> Show social media share buttons</label>
								<p style="padding-left:36px;">
								<label for="wonderplugin-gridgallery-lightboxshowemail"><input name="wonderplugin-gridgallery-lightboxshowemail" type="checkbox" id="wonderplugin-gridgallery-lightboxshowemail" /> Show email button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowfacebook"><input name="wonderplugin-gridgallery-lightboxshowfacebook" type="checkbox" id="wonderplugin-gridgallery-lightboxshowfacebook" /> Show Facebook button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowtwitter"><input name="wonderplugin-gridgallery-lightboxshowtwitter" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtwitter" /> Show Twitter button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowpinterest"><input name="wonderplugin-gridgallery-lightboxshowpinterest" type="checkbox" id="wonderplugin-gridgallery-lightboxshowpinterest" /> Show Pinterest button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowdownload"><input name="wonderplugin-gridgallery-lightboxshowdownload" type="checkbox" id="wonderplugin-gridgallery-lightboxshowdownload" /> Show download button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowwhatsapp"><input name="wonderplugin-gridgallery-lightboxshowwhatsapp" type="checkbox" id="wonderplugin-gridgallery-lightboxshowwhatsapp" /> Show WhatsApp button</label>
								<br><label for="wonderplugin-gridgallery-lightboxshowtelegram"><input name="wonderplugin-gridgallery-lightboxshowtelegram" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtelegram" /> Show Telegram button</label>	
							</p>
								</td>
							</tr>
				        	
							<tr valign="top">
								<th scope="row">Social Media Buttons</th>
								<td><label><input name="wonderplugin-gridgallery-lightboxaddsocialmedia" type="checkbox" id="wonderplugin-gridgallery-lightboxaddsocialmedia" /> Show social media button links defined in step 1</label></td>
							</tr>

				        	<tr valign="top">
								<th scope="row">Position and Size</th>
								<td>
								Position CSS: <input name="wonderplugin-gridgallery-lightboxsocialposition" type="text" id="wonderplugin-gridgallery-lightboxsocialposition" value="" class="regular-text" />
                				<p>Position CSS on small screen: <input name="wonderplugin-gridgallery-lightboxsocialpositionsmallscreen" type="text" id="wonderplugin-gridgallery-lightboxsocialpositionsmallscreen" value="" class="regular-text" /></p>
								<p>Button size: <input name="wonderplugin-gridgallery-lightboxsocialbuttonsize" type="number" id="wonderplugin-gridgallery-lightboxsocialbuttonsize" value="32" class="small-text" />
								Button font size: <input name="wonderplugin-gridgallery-lightboxsocialbuttonfontsize" type="number" id="wonderplugin-gridgallery-lightboxsocialbuttonfontsize" value="18" class="small-text" />
								Buttons direction:
								<select name="wonderplugin-gridgallery-lightboxsocialdirection" id="wonderplugin-gridgallery-lightboxsocialdirection">
								  <option value="horizontal" selected="selected">horizontal</option>
								  <option value="vertical">>vertical</option>
								</select>
								</p>
								<p><label for="wonderplugin-gridgallery-lightboxsocialrotateeffect"><input name="wonderplugin-gridgallery-lightboxsocialrotateeffect" type="checkbox" id="wonderplugin-gridgallery-lightboxsocialrotateeffect" /> Enable button rotating effect on mouse hover</label></p>	
								</td>
							</tr>
							</table>
							</li>
							
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Slideshow Transition</th>
									<td>Lightbox resizing duration (ms): <input name="wonderplugin-gridgallery-lightboxresizespeed" type="number" min=0 id="wonderplugin-gridgallery-lightboxresizespeed" value="400" class="small-text" />
									<p>Image fade in duration (ms): <input name="wonderplugin-gridgallery-lightboxfadespeed" type="number" min=0 id="wonderplugin-gridgallery-lightboxfadespeed" value="0" class="small-text" /></p>
									<p>Slideshow transition:
									<select name="wonderplugin-gridgallery-lightboxtransition" id="wonderplugin-gridgallery-lightboxtransition">
									<option value="none">none</option>
									<option value="slide">slide</option>
									<option value="crossfade">crossfade</option>
									</select>
									Transition duration (ms): <input name="wonderplugin-gridgallery-lightboxtransitionduration" type="number" min=0 id="wonderplugin-gridgallery-lightboxtransitionduration" value="400" class="small-text" />
									</p>
									</td>
								</tr>
							</table>
							</li>

							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Audio</th>
									<td>
									<label for="wonderplugin-gridgallery-lightboxenableaudio"><input name="wonderplugin-gridgallery-lightboxenableaudio" type="checkbox" id="wonderplugin-gridgallery-lightboxenableaudio" /> Enable Lightbox Audio</label>
									<p>MP3 file: <input name='wonderplugin-gridgallery-lightboxaudiofile' type='text' class="regular-text" id='wonderplugin-gridgallery-lightboxaudiofile' value='' />
									<input type="button" class="button wonderplugin-select-audio" data-textid="wonderplugin-gridgallery-lightboxaudiofile" value="Choose MP3 File"></p>
									<p><label for="wonderplugin-gridgallery-lightboxaudioautoplay"><input name="wonderplugin-gridgallery-lightboxaudioautoplay" type="checkbox" id="wonderplugin-gridgallery-lightboxaudioautoplay" /> Autoplay audio on lightbox open</label></p>
									<p><label for="wonderplugin-gridgallery-lightboxaudioloop"><input name="wonderplugin-gridgallery-lightboxaudioloop" type="checkbox" id="wonderplugin-gridgallery-lightboxaudioloop" /> Loop play audio</label></p>
									<p><label for="wonderplugin-gridgallery-lightboxaudioshowonhover"><input name="wonderplugin-gridgallery-lightboxaudioshowonhover" type="checkbox" id="wonderplugin-gridgallery-lightboxaudioshowonhover" /> Only show audio button on mouse hoverover in the lightbox popup</label></p>
									</td>
								</tr>
							</table>
							</li>
					
							<li class="wonderplugin-tab-horizontal">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Data Options</th>
									<td><textarea name="wonderplugin-gridgallery-lightboxadvancedoptions" id="wonderplugin-gridgallery-lightboxadvancedoptions" rows="6" class="large-text code"></textarea></td>
								</tr>
							</table>
							</li>
						</ul>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Google Analytics 4 Measurement ID</th>
									<td><label><input name="wonderplugin-gridgallery-ga4account" type="text" id="wonderplugin-gridgallery-ga4account" value="" class="regular-text" /></label></td>
								</tr>
								<tr>
									<th>Google Universal Analytics ID</th>
									<td><label><input name="wonderplugin-gridgallery-googleanalyticsaccount" type="text" id="wonderplugin-gridgallery-googleanalyticsaccount" value="" class="regular-text" /></label></td>
								</tr>
							</table>
						</div>

						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Video API Initialization</th>
									<td><label><input name='wonderplugin-gridgallery-lightboxinityoutube' type='checkbox' id='wonderplugin-gridgallery-lightboxinityoutube'  /> Initialise YouTube API</label>
									<p><label><input name='wonderplugin-gridgallery-lightboxinitvimeo' type='checkbox' id='wonderplugin-gridgallery-lightboxinitvimeo'  /> Initialise Vimeo API</label></p></td>
								</tr>
							</table>
						</div>

						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th></th>
									<td><p><label><input name='wonderplugin-gridgallery-donotinit' type='checkbox' id='wonderplugin-gridgallery-donotinit'  /> Do not init the gallery when the page is loaded. Check this option if you would like to manually init the gallery with JavaScript API.</label></p>
									<p><label><input name='wonderplugin-gridgallery-addinitscript' type='checkbox' id='wonderplugin-gridgallery-addinitscript'  /> Add init scripts together with gallery HTML code. Check this option if your WordPress site uses Ajax to load pages and posts.</label></p>
									<p><label><input name='wonderplugin-gridgallery-triggerresize' type='checkbox' id='wonderplugin-gridgallery-triggerresize'  /> Trigger window resize event after page load (ms): </label><input name="wonderplugin-gridgallery-triggerresizedelay" type="number" min=0 id="wonderplugin-gridgallery-triggerresizedelay" value="0" class="small-text" /></p>
									<p><label><input name='wonderplugin-gridgallery-triggerresizeafterinit' type='checkbox' id='wonderplugin-gridgallery-triggerresizeafterinit'  /> Trigger window resize event after the gallery is initialized (ms): </label><input name="wonderplugin-gridgallery-triggerresizeafterinitdelay" type="number" min=0 id="wonderplugin-gridgallery-triggerresizeafterinitdelay" value="0" class="small-text" /></p>
									<p><label><input name='wonderplugin-gridgallery-removeinlinecss' type='checkbox' id='wonderplugin-gridgallery-removeinlinecss'  /> Do not add CSS code to HTML source code</label></p>
									</td>
								</tr>
								<tr>
									<th>Custom CSS</th>
									<td><textarea name='wonderplugin-gridgallery-custom-css' id='wonderplugin-gridgallery-custom-css' value='' class='large-text' rows="10"></textarea></td>
								</tr>
								<tr>
									<th>Data Options</th>
									<td><textarea name='wonderplugin-gridgallery-data-options' id='wonderplugin-gridgallery-data-options' value='' class='large-text' rows="10"></textarea></td>
								</tr>
								<tr>
									<th>Custom JavaScript</th>
									<td><textarea name='wonderplugin-gridgallery-customjs' id='wonderplugin-gridgallery-customjs' value='' class='large-text' rows="10"></textarea><br />
									</td>
								</tr>
							</table>
						</div>

						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Extra Data Options for iPhone and Android</th>
									<td><textarea name='wonderplugin-gridgallery-mobiledataoptions' id='wonderplugin-gridgallery-mobiledataoptions' value='' class='large-text' rows="10"></textarea></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				
			</li>
			<li class="wonderplugin-tab">
				<div id="wonderplugin-gridgallery-preview-tab">
					<div id="wonderplugin-gridgallery-preview-message"></div>
					<div id="wonderplugin-gridgallery-preview-container">
					</div>
				</div>
			</li>
			<li class="wonderplugin-tab">
				<div id="wonderplugin-gridgallery-publish-loading"></div>
				<div id="wonderplugin-gridgallery-publish-information"></div>
			</li>
		</ul>
		</div>
		
		<?php
	}
	
	function get_list_data() {
		return array();
	}
}