<?php
	/***
	Plugin Name: plista
	Plugin URI: http://www.plista.com
	Description: Plugin for displaying plista RecommendationAds
	Version: 1.5.10
	Author: wordpress@plista.com
	Author URI: http://www.plista.com
	***/

class plista {

	const VERSION = '1.5.10';

	/**
	 * combatibilitycheck 
	 * register admin menu and custom css
	 * 
	 * @return void
	 */
	public static function init() {
		global $wp_version;
		$exit_msg_wp='plista requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
		$exit_msg_php='plista requires php 5.2 or newer. Your are using PHP Version: '.PHP_VERSION.'. Please contact wordpress@plista.com if you get this message.';
		if ((version_compare($wp_version,"2.5","<")) && (version_compare(PHP_VERSION,"5.2","<"))){
			exit ($exit_msg_wp.'<br />'.$exit_msg_php);
		}
		else if (version_compare(PHP_VERSION,"5.2","<=")){
			exit ($exit_msg_php);
		}
		else if (version_compare($wp_version,"2.5","<")){
			exit ($exit_msg_wp);
		}

		$plista_lang_path = plugin_basename( dirname( __FILE__ ) .'/lang' );
		load_plugin_textdomain( 'plista', '', $plista_lang_path );

		// autoinsert widget after content or not
		$autoinsert = get_option('plista_autoinsert');
		$shorttag = get_option('plista_shorttag');
		if (($autoinsert != 'checked="checked"') && ($shorttag != 'checked="checked"')) {
			// set the priority very high so that the plista plugin is the last being inserted
			add_filter('the_content', array(__CLASS__, 'plista_integration'), 10000);
		}

		add_action('wp_head', array(__CLASS__, 'head'), 200);

		add_action('admin_menu', array(__CLASS__, 'plista_admin_actions'));

	}

	/**
	 * admin options page
	 *
	 * @return void
	 */
	public static function plista_admin() {
		include('plista_integration_admin.php');
	}

	/**
	 * define plista wp version
	 *
	 * @return string
	 */
	public static function plista_version() {
		return self::VERSION;
	}


	/**
	* simple check if wptouch is active
	*
	* @return boolean
	*/
	public static function plista_ismobile() {
		if (preg_match('/wptouch/', get_stylesheet_directory_uri())) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * set adminpage if user is actually current admin
	 *
	 * @return void
	 */
	public static function plista_admin_actions() {
		if( current_user_can('level_10')) {
			wp_enqueue_script( 'plista-admin', plugins_url('/js/plista-admin.js', __FILE__), array(), '1.5.9' );
			wp_enqueue_style( 'plista-admin', plugins_url('/css/plista-admin.css', __FILE__), array(), '1.5.9' );
			add_options_page('plista', 'plista', 1, 'plista', array(__CLASS__, 'plista_admin'));
		}

	}

	/**
	 * extract youtube img from current post
	 *
	 * @return string
	 */
	public static function get_youtube_img() {
		global $post, $posts;
		$youtube_img = '';
		ob_start();
		ob_end_clean();
		$pattern = '/http:\/\/www\.youtube\.com\/(v|embed)\/([1-9|_|A-z]+)/';
		$output = preg_match_all($pattern, $post->post_content, $matches);
		$youtubeid = $matches [2] [0];
		$youtube_img = 'http://img.youtube.com/vi/'.$youtubeid.'/0.jpg';
		return $youtube_img;
	}

	/**
	 * set custom css
	 *
	 * @return void
	 */
	public static function head() {

		// styles for mobile widget
		$mobile_editcss = get_option( 'plista_mobile_editcss' );
		$mobile_hlsize = get_option( 'plista_mobile_hlsize' );
		$mobile_hlcolor = get_option( 'plista_mobile_hlcolor' );
		$mobile_hlbgcolor = get_option( 'plista_mobile_hlbgcolor' );
		$mobile_imgsize = get_option( 'plista_mobile_imgsize' );
		$mobile_imgheight = get_option( 'plista_mobile_imgheight' );
		$mobile_ttlcolor = get_option( 'plista_mobile_ttlcolor' );
		$mobile_ttlsize = get_option( 'plista_mobile_ttlsize ');
		$mobile_txtcolor = get_option( 'plista_mobile_txtcolor' );
		$mobile_txtsize = get_option( 'plista_mobile_txtsize' );

		// styles for non-mobile widget
		$editcss = get_option( 'plista_editcss' );
		$hlsize = get_option( 'plista_hlsize' );
		$hlcolor = get_option( 'plista_hlcolor' );
		$hlbgcolor = get_option( 'plista_hlbgcolor' );
		$imgsize = get_option( 'plista_imgsize' );
		$imgheight = get_option( 'plista_imgheight' );
		$ttlcolor = get_option( 'plista_ttlcolor' );
		$ttlsize = get_option( 'plista_ttlsize' );
		$txtcolor = get_option( 'plista_txtcolor' );
		$txtsize = get_option( 'plista_txtsize' );
		$txthover = get_option( 'plista_txthover' );

		if ($imgheight) {
			$imgheight = 'max-height: '.$imgheight.' !important; height: auto !important; overflow: hidden';
		}

		$imagewrapper = '';

		if ($imgsize) {
			$imagewrapper = '.plista_widget_imgwrapper {width: '.$imgsize.' !important; height: auto !important;}';
		}

		$plistacss = false;

		if (!self::plista_ismobile() && $editcss == 'checked="checked"') {
				$plistacss = ".plistaWidgetHead {
								font-size: ".$hlsize." !important;
								color: ".$hlcolor." !important;
								background-color: ".$hlbgcolor." !important;
							}

							$imagewrapper


							.plistaItem img,
							.itemLink img {
								width: ".$imgsize." !important;
								".$imgheight.";
							}

							.itemTitle {
								color: ".$ttlcolor." !important;
								font-size: ".$ttlsize." !important
							}

							.itemText {
									color: ".$txtcolor." !important;
									font-size: ".$txtsize." !important
							}

							.itemMore {color: ".$txtcolor." !important;}

							.plistaList a:hover,
							.plistaWidgetList a:hover,
							.plistaWidgetList a:active,
							.plistaWidgetList a:focus{background-color:  ".$txthover."  !important}
				";

		} else if ($mobile_editcss == 'checked="checked"') {
				$plistacss = ".plistaWidgetHead {
								font-size: ".$mobile_hlsize." !important;
								color: ".$mobile_hlcolor." !important;
								background-color: ".$mobile_hlbgcolor." !important;
							}

							.plistaItem img,
							.itemLink img {
								width: ".$mobile_imgsize." !important;
								max-height: ".$mobile_imgheight." !important;
							}

							.itemTitle {
								color: ".$mobile_ttlcolor." !important;
								font-size: ".$mobile_ttlsize." !important
							}

							.itemText {
								color: ".$mobile_txtcolor." !important;
								font-size: ".$mobile_txtsize." !important
							}

							.itemMore {color: ".$mobile_txtcolor." !important;}
				";
		}
		if ($plistacss) {
			echo '<style type="text/css">'.$plistacss.'</style>';
		}

		return;
	}

	/**
	 * main plista js code
	 *
	 * @return string
	 */
	public static function plista_content( $plista_data, $atts_shortcode) {

		if ($atts_shortcode['widgetname']) {
			$widgetname = $atts_shortcode['widgetname'];
		} else {
			$widgetname = get_option( 'plista_widgetname' );
		}

		
		// check if user entered "full" widgetname otherwise complete it
		if (substr( $widgetname, 0, 14 ) !== "plista_widget_") {
			$widgetname = "plista_widget_".$widgetname;

		}
		$publickey = get_option( 'plista_publickey' );
		$origin = get_option( 'plista_origin' );
		$reinit = get_option( 'plista_reinit' );

		$setblacklist = get_option( 'plista_setblacklist' );
		$blacklistrecads = get_option( 'plista_blacklistrecads' );
		$tags = get_option( 'plista_tags' );
		$tag_ID = array();
		$post_tags = get_the_tags();
		if (isset($post_tags) && is_array($post_tags)) {
			foreach($post_tags as $tag) {
				array_push($tag_ID,$tag->term_id);
			}
			$istag = is_array($tags) ? array_intersect($tag_ID, $tags) : '';
		} else {
			$istag = '';
		}

		$post_types = get_option( 'plista_post_types' );
		$post_type_current = get_post_type();
		if (is_array($post_types) && in_array($post_type_current, $post_types)) {
			$is_posttype = $post_types;
		} else if ($post_types == $post_type_current) {
			$is_posttype = $post_types;
		} else {
			$is_posttype = '';
		}

		$categories = get_option( 'plista_categories' );
		$cat_ID = array();
		$post_categories = get_the_category();
		if (isset($post_categories)) {
			foreach($post_categories as $category) {
				array_push($cat_ID,$category->cat_ID);
			}
			$iscategory = is_array($categories) ? array_intersect($cat_ID, $categories) : '';
		} else {
			$iscategory = '';
		}

		$postid = get_the_ID();


		if (($setblacklist == 'checked="checked"') && (!empty($blacklistrecads))) {
			$isreclist = array_search((string)$postid, explode(',', $blacklistrecads));
			$setblacklist = ($isreclist === false) ? false : true;
		} else {
			$isreclist = false;
			$setblacklist = false;
		}
		

		$plistapush = '';

		if (!self::plista_ismobile()) {
			$plistapush = '"item": ' . ($plista_data ? json_encode($plista_data) : '{}');
			if (trim($plistapush) == '"item":') {
				$plistapush = '';
			}
			if ($plistapush) {
				$plistapush = ',' . "\n\t" . $plistapush;
			}
		}


		// don't index article if set to false via shortcode parameter or if more than 1 widget is shown
		if ($atts_shortcode && ($atts_shortcode['index'] == 0) || ($atts_shortcode['additional'] == 1)) {
			$plistapush = '';
		}

		if ($origin) {
			$origin = ',' . "\n\t" . '"origin": "' . strtolower($origin) .'"';
		}
		if ($reinit) {
			$reinit = 'else{w[n].reset();w[n].item=c.item;w[n].init();}';
		}


		$plistascript = '
<script type="text/javascript">
(function(c){var g,s=\'script\',w=window,n=c.name||\'PLISTA\';if(!w[n]){w[n]=c;g=w.document.getElementsByTagName(s)[0];s=w.document.createElement(s);s.async=true;s.type=\'text/javascript\';s.src=(w.location.protocol===\'https:\'?\'https:\':\'http:\')+\'//static\'+(c.origin?\'-\'+c.origin:\'\')+\'.plista.com/async\'+(c.name?\'/\'+c.name:\'\')+\'.js\';g.parentNode.insertBefore(s,g);}' . $reinit . '
}({
    "publickey": "'.$publickey.'"' . $plistapush . $origin . '
}));
</script>
';
		$plistacomment = '<!-- plista wp Version '.self::plista_version().' -->';

		// don't include plista async for additional widgets on page
		if ($atts_shortcode && ($atts_shortcode['additional'] == 1)) {
			$plistascript = '';
			$plistacomment = '';
		}

		//blacklist some pages where widget should never be shown
		if (($isreclist === false) && ($setblacklist === false) && empty($iscategory) && empty($is_posttype) && empty($istag)) {
			if(strpos($_SERVER['REQUEST_URI'], '/attachment/') == false) {
				if((is_single() || is_page()) &&
					!is_attachment() &&
					!is_admin() &&
					get_post_status() == 'publish' &&
					!post_password_required() &&
					!wp_is_post_revision($postid) &&
					!is_404() &&
					!is_preview() &&
					!is_feed() &&
					!is_trackback() &&
					!is_archive() &&
					!is_search()) {

					return $plistacomment.'<div data-widget="'.$widgetname.'"></div>
					'.$plistascript.'';
				} 
			} 
		} 
			
	}

	/**
	 * extract basic data like title, text from current post
	 *
	 * @return array
	 */
	public static function plista_integration ( $content, $atts_shortcode = NULL ) {
		global $post;
		$text = get_the_content() ? get_the_content() : $post->post_content ? $post->post_content : '';
		$bad = array(
			'@<script[^>]*?>.*?</script>@si',	// strip out javascript
			'@<iframe[^>]*?>.*?</iframe>@si',	// strip out iframe
			'@<style[^>]*?>.*?</style>@siU',	// strip style tags properly
			'@<[\/\!]*?[^<>]*?>@si',			// strip out HTML tags
			'@<![\s\S]*?--[ \t\n\r]*>@'			// strip multi-line comments including CDATA
		);
		$text = strip_tags(preg_replace($bad, '', $text));
		$defaultimg = get_option('plista_defaultimg');

		$title = get_the_title();
		$title = substr($title,0, 255); // truncate to 255 chars
		
		$text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text ); // strip out caption tags
		$text = substr($text,0, 255); // truncate to 255 chars
		
		$id = get_the_id();
		$youtubepattern = "/http:\/\/www\.youtube\.com\/(v|embed)\/([1-9|_|A-z]+)/";
		$isyoutube = preg_match($youtubepattern, $post->post_content);

		// get all categories, max 30 and only parent categories
		$categories = get_the_category();
		$separator = ',';
		$output = '';
		if($categories){
			$catcount = 0;
			foreach($categories as $category) {
				if (($category->category_parent) == 0 && ($catcount < 30)) {
					$catcount++;
					$output .= $category->cat_name.$separator;
				}
			}
			$categories = trim($output, $separator);
		}

		$imagesize = get_option( 'plista_imagesize' );

		if (($imagesize == "") || ($imagesize === NULL)) {
			$imagesize = 'medium';
		}

		$imgsrc = null;
		// first try to get the article thumbnail image
		if ( function_exists('has_post_thumbnail') && has_post_thumbnail($id) ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), $imagesize);
			$imgsrc = $thumbnail[0];
		}
		// if we couldn't find one, check for other images in the article
		if (!$imgsrc || is_null($imgsrc)) {
			$attachments = get_children( array(
				'post_parent'    => get_the_ID(),
				'post_type'      => 'attachment',
				'numberposts'    => 1, // show all -1
				'post_status'    => 'inherit',
				'post_mime_type' => 'image',
				'order'          => 'ASC',
				'orderby'        => 'menu_order ASC'
			));

			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumbnail = wp_get_attachment_image_src( $attachment_id );
				$imgsrc = $thumbnail[0];
			}
			if (!$imgsrc && !empty($isyoutube)) {
				$imgsrc = self::get_youtube_img();
			}
		}

		// still no image found so take the default img
		if (!$imgsrc || is_null($imgsrc)) {
				$imgsrc = strtolower($defaultimg);
		}

		// get publish date and if not available use current date as publish date
		$published_at = get_the_time('U', $id);
		if ($published_at === false) {
			$published_at = current_time('timestamp');
		}
		

		// get the last modified date if available
		$updated_at = get_the_modified_date('U');

		$content .= self::plista_content(array(
			'objectid' => get_the_id(),
			'title' => $title,
			'text' => $text,
			'url' => get_permalink(),
			'img' => $imgsrc,
			'category' => $categories,
			'published_at' => $published_at,
			'updated_at' => $updated_at
		), $atts_shortcode);

		return $content;
	}

}
plista::init();

function plista_integration() {
	return plista::plista_integration(NULL, NULL);
}

function plista_integration_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'index' => 1,
		'widgetname' => false,
		'additional' => 0
	), $atts, 'plista' );

	$shorttag = get_option('plista_shorttag');

	if ($shorttag != 'checked="checked"') {
		return '';
	}

	return plista::plista_integration(NULL, $atts);
}

add_shortcode( 'plista', 'plista_integration_shortcode' );
?>
