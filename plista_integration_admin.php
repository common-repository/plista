<?php
/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function get_image_size( $size ) {
	$sizes = get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function get_image_width( $size ) {
	if ( ! $size = get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['width'] ) ) {
		return $size['width'];
	}

	return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function get_image_height( $size ) {
	if ( ! $size = get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['height'] ) ) {
		return $size['height'];
	}

	return false;
}

?>


<?php
$plistachange = isset($_POST['plista_hidden']) ? $_POST['plista_hidden'] : '';
if($plistachange == 'P') {

	$categories = isset($_POST['plista_categories']) ? $_POST['plista_categories'] : '';
	update_option('plista_categories', $categories);

	$tags = isset($_POST['plista_tags']) ? $_POST['plista_tags'] : '';
	update_option('plista_tags', $tags);

	$post_types = isset($_POST['plista_post_types']) ? $_POST['plista_post_types'] : '';
	update_option('plista_post_types', $post_types);

	$widgetname = isset($_POST['plista_widgetname']) ? $_POST['plista_widgetname'] : '';
	update_option('plista_widgetname', $widgetname);

	$publickey = isset($_POST['plista_publickey']) ? $_POST['plista_publickey'] : '';
	update_option('plista_publickey', $publickey);

	$origin = isset($_POST['plista_origin']) ? $_POST['plista_origin'] : '';
	update_option('plista_origin', $origin);

	$reinit = isset($_POST['plista_reinit']) ? $_POST['plista_reinit'] : '';
	update_option('plista_reinit', $reinit);
	if (get_option('plista_reinit')) {
		$reinit = 'checked="checked"';
		update_option('plista_reinit', $reinit);
	} else {
		$reinit = '';
	}

	$autoinsert = isset($_POST['plista_autoinsert']) ? $_POST['plista_autoinsert'] : '';
	update_option('plista_autoinsert', $autoinsert);
	if (get_option('plista_autoinsert')) {
			$autoinsert = 'checked="checked"';
			update_option('plista_autoinsert', $autoinsert);
	} else {
			$autoinsert = '';
	}

	$shorttag = isset($_POST['plista_shorttag']) ? $_POST['plista_shorttag'] : '';
	update_option('plista_shorttag', $shorttag);
	if (get_option('plista_shorttag')) {
			$shorttag = 'checked="checked"';
			update_option('plista_shorttag', $shorttag);
	} else {
			$shorttag = '';
	}

	$imagesize = isset($_POST['plista_imagesize']) ? $_POST['plista_imagesize'] : '';
	update_option('plista_imagesize', $imagesize);

	$defaultimg = isset($_POST['plista_defaultimg']) ? $_POST['plista_defaultimg'] : '';
	update_option('plista_defaultimg', $defaultimg);

	$editcss = isset($_POST['plista_editcss']) ? $_POST['plista_editcss'] : '';
	update_option('plista_editcss', $editcss);
	if (get_option('plista_editcss')) {
		$editcss = 'checked="checked"';
		update_option('plista_editcss', $editcss);
	} else {
		$editcss = '';
	}

	$mobile_editcss = isset($_POST['plista_mobile_editcss']) ? $_POST['plista_mobile_editcss'] : '';
	update_option('plista_mobile_editcss', $mobile_editcss);
	if (get_option('plista_mobile_editcss')) {
		$mobile_editcss = 'checked="checked"';
		update_option('plista_mobile_editcss', $mobile_editcss);
	} else {
		$mobile_editcss = '';
	}

	$setblacklist = isset($_POST['plista_setblacklist']) ? $_POST['plista_setblacklist'] : '';
	update_option('plista_setblacklist', $setblacklist);
	if (get_option('plista_setblacklist')) {
		$setblacklist = 'checked="checked"';
		update_option('plista_setblacklist', $setblacklist);
	} else {
		$setblacklist = '';
	}

	$hlsize = $_POST['plista_hlsize'];
    update_option('plista_hlsize', $hlsize);

	$hlcolor = $_POST['plista_hlcolor'];
    update_option('plista_hlcolor', $hlcolor);

	$hlbgcolor = $_POST['plista_hlbgcolor'];
    update_option('plista_hlbgcolor', $hlbgcolor);

	$imgsize = $_POST['plista_imgsize'];
    update_option('plista_imgsize', $imgsize);

	$imgheight = $_POST['plista_imgheight'];
    update_option('plista_imgheight', $imgheight);

	$ttlcolor = $_POST['plista_ttlcolor'];
    update_option('plista_ttlcolor', $ttlcolor);

	$ttlsize = $_POST['plista_ttlsize'];
    update_option('plista_ttlsize', $ttlsize);

	$txtcolor = $_POST['plista_txtcolor'];
    update_option('plista_txtcolor', $txtcolor);

	$txtsize = $_POST['plista_txtsize'];
    update_option('plista_txtsize', $txtsize);

	$txthover = $_POST['plista_txthover'];
    update_option('plista_txthover', $txthover);

	$mobile_hlsize = $_POST['plista_mobile_hlsize'];
    update_option('plista_mobile_hlsize', $mobile_hlsize);

	$mobile_hlcolor = $_POST['plista_mobile_hlcolor'];
    update_option('plista_mobile_hlcolor', $mobile_hlcolor);

	$mobile_hlbgcolor = $_POST['plista_mobile_hlbgcolor'];
    update_option('plista_mobile_hlbgcolor', $mobile_hlbgcolor);

	$mobile_imgsize = $_POST['plista_mobile_imgsize'];
    update_option('plista_mobile_imgsize', $mobile_imgsize);

	$mobile_imgheight = $_POST['plista_mobile_imgheight'];
    update_option('plista_mobile_imgheight', $mobile_imgheight);

	$mobile_ttlcolor = $_POST['plista_mobile_ttlcolor'];
    update_option('plista_mobile_ttlcolor', $mobile_ttlcolor);

	$mobile_ttlsize = $_POST['plista_mobile_ttlsize'];
    update_option('plista_mobile_ttlsize', $mobile_ttlsize);

	$mobile_txtcolor = $_POST['plista_mobile_txtcolor'];
    update_option('plista_mobile_txtcolor', $mobile_txtcolor);

	$mobile_txtsize = $_POST['plista_mobile_txtsize'];
    update_option('plista_mobile_txtsize', $mobile_txtsize);

	$blacklistrecads = isset($_POST['plista_blacklistrecads']) ? $_POST['plista_blacklistrecads'] : '';
    update_option('plista_blacklistrecads', $blacklistrecads);

?>
	<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php

} else {
	//Show choosen options
	$widgetname = get_option('plista_widgetname');
	$publickey = get_option('plista_publickey');
	$origin = get_option('plista_origin');
	$reinit = get_option('plista_reinit');
	$autoinsert = get_option('plista_autoinsert');
	$shorttag = get_option('plista_shorttag');
	$imagesize = get_option('plista_imagesize');
	$defaultimg = get_option('plista_defaultimg');
	$editcss = get_option('plista_editcss');
	$setblacklist = get_option('plista_setblacklist');

	$hlsize = get_option('plista_hlsize');
	$hlcolor = get_option('plista_hlcolor');
	$hlbgcolor = get_option('plista_hlbgcolor');
	$imgsize = get_option('plista_imgsize');
	$imgheight = get_option('plista_imgheight');
	$ttlcolor = get_option('plista_ttlcolor');
	$ttlsize = get_option('plista_ttlsize');
	$txtcolor = get_option('plista_txtcolor');
	$txtsize = get_option('plista_txtsize');
	$txthover = get_option('plista_txthover');

	$mobile_editcss = get_option('plista_mobile_editcss');
	$mobile_hlsize = get_option('plista_mobile_hlsize');
	$mobile_hlcolor = get_option('plista_mobile_hlcolor');
	$mobile_hlbgcolor = get_option('plista_mobile_hlbgcolor');
	$mobile_imgsize = get_option('plista_mobile_imgsize');
	$mobile_imgheight = get_option('plista_mobile_imgheight');
	$mobile_ttlcolor = get_option('plista_mobile_ttlcolor');
	$mobile_ttlsize = get_option('plista_mobile_ttlsize');
	$mobile_txtcolor = get_option('plista_mobile_txtcolor');
	$mobile_txtsize = get_option('plista_mobile_txtsize');

	$domainid = get_option('plista_domainid');
	$blacklistrecads = get_option('plista_blacklistrecads');
	$categories = get_option('plista_categories');
	$tags = get_option('plista_tags');
	$post_types = get_option('plista_post_types');
}
?>

<div class="wrap plistawrapper">

	<h2><img src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . '/image/logo.png'; ?>" alt="plista logo" /><span>Version <?php echo plista::plista_version(); ?></span></h2>

	<form name="plista_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="plista_hidden" value="P">
		<div class="plistabox">
			<h3><?php _e('Hint', 'plista'); ?></h3>
			<p><?php printf(__('You have to register at %1$s first to get all necessary data.', 'plista'), '<a href="https://www.plista.com/publisher_registrations/domain">plista.com</a>'); ?></p>
			<p><?php printf(__('Please pay attention to the %1$s', 'plista'), '<a target="_blank" href="http://wordpress.org/extend/plugins/plista/installation/">Readme</a>'); ?>. </p>
		</div>

		<div id="plistabasics" class="plistabox">
			<h3><?php _e('Basic settings', 'plista'); ?></h3>
			<p>
				<label class="textlabel" for="plista_widgetname">Widgetname <span class="required">*<?php _e('required', 'plista') ?></span></label>
				<input aria-required="true" required type="text" name="plista_widgetname" value="<?php echo $widgetname; ?>" size="80">
				<span><?php _e('e.g.', 'plista'); ?> plista_widget_standard_1</span>
			</p>

			<p>
				<label class="textlabel" for="plista_publickey"><?php _e('Publickey', 'plista'); ?> <span class="required">*<?php _e('required', 'plista') ?></span></label>
				<input aria-required="true" required type="text" name="plista_publickey" value="<?php echo $publickey; ?>" size="80">
				<span><?php _e('e.g.', 'plista'); ?> 46895ab564asdgsagas6546</span>
			</p>

			<p>
				<label class="textlabel" for="plista_origin"><?php _e('Origin', 'plista'); ?> <span class="optional">*<?php _e('optional', 'plista') ?></span></label>
				<input type="text" name="plista_origin" value="<?php echo $origin; ?>" size="2">
				<span><?php _e('e.g.', 'plista'); ?> cn</span>
			</p>
			<p>
				<label class="textlabel" for="plista_reinit"><?php _e('Single page website', 'plista'); ?> <span class="optional">*<?php _e('optional', 'plista') ?></span></label>
				<input type="checkbox" id="plista_reinit" name="plista_reinit" value="1" <?php echo $reinit; ?>>
				<span><?php _e('Reinit', 'plista'); ?></span>
			</p>
		</div>


		<div id="plistaposition" class="plistabox">
			<h3><?php _e('Shorttag', 'plista'); ?></h3>
			<p><?php _e('In addition to automatically positioning the widget via the plugin, plista also offers the possibility to manually position the widget via the shortcode [plista]. The shortcode also provides additional setting options using the following parameters:', 'plista'); ?></p>
			<ol>
				<li><strong><?php _e('widgetname=WIDGETNAME (e.g. [plista widgetname=plista_widget_standard_2]):', 'plista'); ?></strong> <?php _e('For sites with multiple widgets in use, the parameter widgetname allows you to decide which widget should be displayed. If this parameter is not utilized, the widget in the default setting is automatically chosen.', 'plista'); ?></li>
				<li><strong><?php _e('additional=1 (e.g. [plista widgetname=plista_widget_standard_2 additional=1]):', 'plista'); ?> </strong><?php _e('To display more than one widget on an article page (for example, below the article and in the sidebar), you can place other widgets with additional=1. Please note: the first widget is loaded without the parameter additional=1; all additional widgets must have the parameter additional=1 in order to be loaded.', 'plista'); ?></li>
				<li><strong><?php _e('index=0 (e.g. [plista index=0]):', 'plista'); ?> </strong><?php _e('To display a widget in an article page without adding that article to the recommendation pool, you can disable the indexing of the article with index=0. Please note: the plista widget performs best with a large recommendation pool so this parameter is only suggested for a small number of article pages. ', 'plista'); ?></li>
			</ol>
			<p><?php _e('To learn more about how you can you integrate the shortcode directly into your template, click ', 'plista'); ?> <a href="https://developer.wordpress.org/reference/functions/do_shortcode/"><?php _e('here', 'plista'); ?></a></p>
			<p>
				<input type="checkbox" id="plista_shorttag" name="plista_shorttag" value="1" <?php echo $shorttag ?>/>
				<label  for="plista_shorttag"><?php _e('Use Shorttag', 'plista'); ?></label>

			</p>
		</div>



		<div id="plistaposition" class="plistabox">
			<h3><?php _e('Manual positioning of the widget:', 'plista'); ?></h3>
			<p><?php _e('With the addition of the shortcode, the old method of manual positioning is now outdated. For existing integrations the old method remains available, but all future widgets should use the shortcode feature.', 'plista') ?></p>
			<p>
				<input type="checkbox" id="plista_autoinsert" name="plista_autoinsert" value="1" <?php echo $autoinsert ?>/>
				<label  for="plista_autoinsert"><?php _e('Yes, I would like to position the widget', 'plista'); ?></label>

			</p>
		</div>



		<div class="plistabox">
			<h3><?php _e('Image Size', 'plista'); ?></h3>
			<p><?php _e('This field dictates the size of image thumbnails in the widget. Under Settings->Media sizing can be adjusted.', 'plista') ?></p>
			<p>
				<?php if (get_image_width('thumbnail')) { ?>
					<input type="radio" name="plista_imagesize" value="thumbnail" <?php if ($imagesize === "thumbnail") { echo 'checked'; } ?>>
					<label for="plista_imagesize">Thumbnail (<?php echo get_image_width('thumbnail'); ?>px x <?php echo get_image_height('thumbnail'); ?>px)</label>
				<?php } ?>
				<?php if (get_image_width('medium')) { ?>
					<input type="radio" name="plista_imagesize" value="medium" <?php if ($imagesize === "medium") { echo 'checked'; } ?>>
					<label for="plista_imagesize">Medium (<?php echo get_image_width('medium'); ?>px x <?php echo get_image_height('medium'); ?>px)</label>
				<?php } ?>
				<?php if (get_image_width('large')) { ?>
					<input type="radio" name="plista_imagesize" value="large" <?php if ($imagesize === "large") { echo 'checked'; } ?>>
					<label for="plista_imagesize">Large (<?php echo get_image_width('large'); ?>px x <?php echo get_image_height('large'); ?>px)</label>
				<?php } ?>
			</p>

		</div>

		<div class="plistabox">
			<h3><?php _e('Default image', 'plista'); ?></h3>
			<p><?php _e('Define a default image for articles without an image.', 'plista') ?></p>
			<p>
				<label class="textlabel" for="plista_defaultimg"><?php _e('Default image', 'plista'); ?> <span class="optional">*<?php _e('optional', 'plista') ?></span></label>
				<input type="text" name="plista_defaultimg" value="<?php echo $defaultimg; ?>" size="80">
				<span><?php _e('e.g.', 'plista'); ?> http://www.example.org/default.jpg</span>
			</p>
		</div>

		<div class="plistabox">
			<h3><?php _e('Exclude pages', 'plista'); ?></h3>
			<p>
				<input type="checkbox" id="plista_setblacklist" name="plista_setblacklist" value="1" <?php echo $setblacklist ?>/>
				<label for="plista_setblacklist"><?php _e('Don\'t show the widget on some pages', 'plista'); ?></label>
			</p>

			<p>
				<label class="textlabel" for="plista_blacklistrecads"><?php _e('Exclude the following pages', 'plista'); ?></label>
				<input type="text" name="plista_blacklistrecads" value="<?php echo $blacklistrecads; ?>" size="42">
				<span><?php _e('Insert the Page-Id\'s separated by comma (e.g.: 5, 235, 1340) where the widget should be excluded', 'plista'); ?>.</span>
			</p>
		</div>

		<?php
			$wp_tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => 100));
			if ($wp_tags) {
		?>
		<div class="plistabox">
			<h3><?php _e('Exclude tags', 'plista'); ?></h3>
			<ul class="plista-categories">
			<?php
			foreach ($wp_tags as $wp_tag) {
			?>
				<li>
					<input type="checkbox" name="plista_tags[]" value="<?= $wp_tag->term_id; ?>" <?php if (is_array($tags) && in_array($wp_tag->term_id,$tags)) echo "checked"; ?>/>
					<label for="plista_tags[]"><?= $wp_tag->name; ?></label>
				</li>

		  	<?php } ?>
			</ul>
			<div class="plistaclear"></div>
		</div>
		<?php } ?>

		<div class="plistabox">
			<h3><?php _e('Exclude post types', 'plista'); ?></h3>
			<ul class="plista-categories">
			<?php
			$wp_post_types = get_post_types();
			foreach ( $wp_post_types as $wp_post_type ) {
			?>
				<li>
					<input type="checkbox" name="plista_post_types[]" value="<?= $wp_post_type; ?>" <?php if (is_array($post_types) && in_array($wp_post_type,$post_types)) echo "checked"; ?>/>
					<label for="plista_post_types[]"><?= $wp_post_type; ?></label>
				</li>
			<?php
			}
			?>
			</ul>
		</div>

		<div class="plistabox">
			<h3><?php _e('Exclude categories', 'plista'); ?></h3>
			<ul class="plista-categories">
			<?php
			$wp_categories = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'number' => 100));
			if (isset($wp_categories)) {
				foreach ($wp_categories as $wp_category):
				?>
					<li>
						<input type="checkbox" name="plista_categories[]" value="<?= $wp_category->cat_ID; ?>" <?php if (is_array($categories) && in_array($wp_category->cat_ID,$categories)) echo "checked"; ?>/>
						<label for="plista_categories[]"><?= $wp_category->cat_name; ?></label>
					</li>
			  	<?php endforeach;
			 } else {
			 	_e('No categories found', 'plista');
			 } ?>
			</ul>
			<div class="plistaclear"></div>
		</div>

		<div class="plistabox" id="plistadesign">
			<h3 class="plistaclear"><?php _e('plista widget design', 'plista');?></h3>
			<p>
				<input type="checkbox" id="plista_editcss" name="plista_editcss" value="1" <?php echo $editcss ?>/>
				<label for="plista_editcss"><?php _e('I would like to change the widget design', 'plista'); ?></label>
			</p>

			<div id="plistadesignbox">
				<p>
					<label class="textlabel" for="plista_hlsize"><?php _e('Widgetheadline (font-size)', 'plista'); ?></label>
					<input type="text" name="plista_hlsize" value="<?php echo $hlsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 16px</span>
				</p>

				<p>
					<label class="textlabel" for="plista_hlcolor"><?php _e('Widgetheadline (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_hlcolor" value="<?php echo $hlcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #000000</span>
				</p>

				<p>
					<label class="textlabel" for="plista_hlbgcolor"><?php _e('Widgetheadline (background-color)', 'plista'); ?></label>
					<input type="text" name="plista_hlbgcolor" value="<?php echo $hlbgcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #EEEEEE</span>
				</p>

				<p>
					<label class="textlabel" for="plista_imgsize"><?php _e('Images (width)', 'plista'); ?></label>
					<input type="text" name="plista_imgsize" value="<?php echo $imgsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 70px</span>
				</p>

				<p>
					<label class="textlabel" for="plista_imgheight"><?php _e('Images (max-height)', 'plista'); ?></label>
					<input type="text" name="plista_imgheight" value="<?php echo $imgheight; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 70px</span>
				</p>

				<p>
					<label class="textlabel" for="plista_ttlcolor"><?php _e('Article headline (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_ttlcolor" value="<?php echo $ttlcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #000000</span>
				</p>

				<p>
					<label class="textlabel" for="plista_ttlsize"><?php _e('Article headline (font-size)', 'plista'); ?></label>
					<input type="text" name="plista_ttlsize" value="<?php echo $ttlsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 13px</span>
				</p>

				<p>
					<label class="textlabel" for="plista_txtcolor"><?php _e('Text (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_txtcolor" value="<?php echo $txtcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #333333</span>
				</p>

				<p>
					<label class="textlabel" for="plista_txtsize"><?php _e('Text (font-size)', 'plista'); ?>)</label>
					<input type="text" name="plista_txtsize" value="<?php echo $txtsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 12px</span>
				</p>

				<p>
					<label class="textlabel" for="plista_txthover"><?php _e('Mouseover (background-color)', 'plista'); ?></label>
					<input type="text" name="plista_txthover" value="<?php echo $txthover; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #FFFFFF</span>
				</p>
			</div>
		</div>

		<div class="plistabox" id="plistamobiledesign">
			<h3 class="plistaclear"><?php _e('plista widget mobile design for wptouch', 'plista');?></h3>
			<p>
				<input type="checkbox" id="plista_mobile_editcss" name="plista_mobile_editcss" value="1" <?php echo $mobile_editcss ?>/>
				<label for="plista_mobile_editcss"><?php _e('I would like to change the mobile widget design', 'plista'); ?></label>
			</p>

			<div id="plistamobiledesignbox">
				<p>
					<label class="textlabel" for="plista_mobile_hlsize"><?php _e('Widgetheadline (font-size)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_hlsize" value="<?php echo $mobile_hlsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 14px</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_hlcolor"><?php _e('Widgetheadline (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_hlcolor" value="<?php echo $mobile_hlcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #000000</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_hlbgcolor"><?php _e('Widgetheadline (background-color)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_hlbgcolor" value="<?php echo $mobile_hlbgcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #FFFFFF</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_imgsize"><?php _e('Images (width)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_imgsize" value="<?php echo $mobile_imgsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 70px</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_imgheight"><?php _e('Images (max-height)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_imgheight" value="<?php echo $mobile_imgheight; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 70px</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_ttlcolor"><?php _e('Article headline (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_ttlcolor" value="<?php echo $mobile_ttlcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #000000</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_ttlsize"><?php _e('Article headline (font-size)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_ttlsize" value="<?php echo $mobile_ttlsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 13px</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_txtcolor"><?php _e('Text (font-color)', 'plista'); ?></label>
					<input type="text" name="plista_mobile_txtcolor" value="<?php echo $mobile_txtcolor; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> #333333</span>
				</p>
				<p>
					<label class="textlabel" for="plista_mobile_txtsize"><?php _e('Text (font-size)', 'plista'); ?>)</label>
					<input type="text" name="plista_mobile_txtsize" value="<?php echo $mobile_txtsize; ?>" size="12">
					<span><?php _e('e.g.', 'plista'); ?> 12px</span>
				</p>
			</div>
		</div>

		<p class="submit">
			<input type="submit" name="Submit" value="Speichern" />
		</p>
	</form>
</div>
