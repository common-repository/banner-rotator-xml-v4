<?php
/*
Plugin Name: Banner Rotator XML v4
Plugin URI: http://www.flashdo.com/item/banner-rotator-xml-v4/836
Description: XML driven flash banner / image rotator with tile animation effect.
Version: 1.0.0
Author: FlashBlue
Author URI: http://www.flashdo.com/user/flashblue
License: GPL2
*/

/* start global parameters */
	$bannerrotatorxmlv4_params = array(
		'count'	=> 0, // number of Banner Rotator XML v4 embeds
	);
/* end global parameters */

/* start client side functions */
	function bannerrotatorxmlv4_get_embed_code($bannerrotatorxmlv4_attributes) {
		global $bannerrotatorxmlv4_params;
		$bannerrotatorxmlv4_params['count']++;

		$plugin_dir = get_option('bannerrotatorxmlv4_path');
		if ($plugin_dir === false) {
			$plugin_dir = 'flashdo/flashblue/banner-rotator-xml-v4';
		}
		$plugin_dir = trim($plugin_dir, '/');

		$xml_file_name = !empty($bannerrotatorxmlv4_attributes[2]) ? $bannerrotatorxmlv4_attributes[2] : 'xml/banner.xml';
		$xml_file_path = WP_CONTENT_DIR . "/{$plugin_dir}/{$xml_file_name}";

		if (function_exists('simplexml_load_file')) {
			if (file_exists($xml_file_path)) {
				$data = simplexml_load_file($xml_file_path);
				$width = (int)$data->globals->attributes()->width;
				$height = (int)$data->globals->attributes()->height;
			}
		} elseif ((int)$bannerrotatorxmlv4_attributes[4] > 0 && (int)$bannerrotatorxmlv4_attributes[6] > 0) {
			$width = (int)$bannerrotatorxmlv4_attributes[4];
			$height = (int)$bannerrotatorxmlv4_attributes[6];
		} else {
			return '<!-- invalid Banner Rotator XML v4 width and / or height -->';
		}

		$swf_embed = array(
			'width' => $width,
			'height' => $height,
			'text' => isset($bannerrotatorxmlv4_attributes[7]) ? trim($bannerrotatorxmlv4_attributes[7]) : '',
			'component_path' => WP_CONTENT_URL . "/{$plugin_dir}/",
			'swf_name' => 'banner.swf',
		);
		$swf_embed['swf_path'] = $swf_embed['component_path'].$swf_embed['swf_name'];

		if (!is_feed()) {
			$embed_code = '<div id="bannerrotatorxmlv4'.$bannerrotatorxmlv4_params['count'].'">'.$swf_embed['text'].'</div>';
			$embed_code .= '<script type="text/javascript">';
			$embed_code .= "swfobject.embedSWF('{$swf_embed['swf_path']}', 'bannerrotatorxmlv4{$bannerrotatorxmlv4_params['count']}', '{$swf_embed['width']}', '{$swf_embed['height']}', '9.0.0.0', '', {".($xml_file_name != 'xml/banner.xml' ? "xmlUrl: '{$xml_file_name}'" : '')."}, {base: '{$swf_embed['component_path']}', scale: 'noscale', salign: 'tl', wmode: 'transparent', allowScriptAccess: 'sameDomain', allowFullScreen: true }, {});";
			$embed_code.= '</script>';
		} else {
			$embed_code = '<object width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'">';
			$embed_code .= '<param name="base" value="'.$swf_embed['component_path'].'"></param>';
			$embed_code .= '<param name="movie" value="'.$swf_embed['swf_path'].'"></param>';
			$embed_code .= '<param name="scale" value="noscale"></param>';
			$embed_code .= '<param name="salign" value="tl"></param>';
			$embed_code .= '<param name="wmode" value="transparent"></param>';
			$embed_code .= '<param name="allowScriptAccess" value="sameDomain"></param>';
			$embed_code .= '<param name="allowFullScreen" value="true"></param>';
			$embed_code .= '<param name="sameDomain" value="true"></param>';
			$embed_code .= '<param name="flashvars" value="'.($xml_file_name != 'xml/banner.xml' ? '&xmlUrl='.$xml_file_name : '').'"></param>';
			$embed_code .= '<embed type="application/x-shockwave-flash" width="'.$swf_embed['width'].'" height="'.$swf_embed['height'].'" src="'.$swf_embed['swf_path'].'" scale="noscale" salign="tl" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="true" flashvars="'.($xml_file_name != 'xml/banner.xml' ? '&xmlUrl='.$xml_file_name : '').'"';
			$embed_code .= '></embed>';
			$embed_code .= '</object>';
		}

		return $embed_code;
	}

	function bannerrotatorxmlv4_filter_content($content) {
		return preg_replace_callback('|\[banner-rotator-xml-v4\s*(xmlUrl="([^"]+)")?\s*(width="([0-9]+)")?\s*(height="([0-9]+)")?\s*\](.*)\[/banner-rotator-xml-v4\]|i', 'bannerrotatorxmlv4_get_embed_code', $content);
	}

	function bannerrotatorxmlv4_echo_embed_code($settings_xml_path = '', $div_text = '', $width = 0, $height = 0) {
		echo bannerrotatorxmlv4_get_embed_code(array(2 => $settings_xml_path, 7 => $div_text, 4 => $width, 6 => $height));
	}

	function bannerrotatorxmlv4_load_swfobject_lib() {
		wp_enqueue_script('swfobject');
	}
/* end client side functions */

/* start admin section functions */
	function bannerrotatorxmlv4_admin_menu() {
		add_options_page('Banner Rotator XML v4 Options', 'Banner Rotator XML v4', 'manage_options', 'bannerrotatorxmlv4', 'bannerrotatorxmlv4_admin_options');
	}

	function bannerrotatorxmlv4_admin_options() {
		  if (!current_user_can('manage_options'))  {
	    wp_die(__('You do not have sufficient permissions to access this page.'));
	  }

	  $bannerrotatorxmlv4_default_path = get_option('bannerrotatorxmlv4_path');
	  if ($bannerrotatorxmlv4_default_path === false) {
	  	$bannerrotatorxmlv4_default_path = 'flashdo/flashblue/banner-rotator-xml-v4';
	  }
?>
<div class="wrap">
	<h2>Banner Rotator XML v4</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 40em;">SWF and assets path is <?php echo WP_CONTENT_DIR; ?>/</th>
				<td><input type="text" style="width: 25em;" name="bannerrotatorxmlv4_path" value="<?php echo $bannerrotatorxmlv4_default_path; ?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="bannerrotatorxmlv4_path" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php
	}
/* end admin section functions */

/* start hooks */
	add_filter('the_content', 'bannerrotatorxmlv4_filter_content');
	add_action('init', 'bannerrotatorxmlv4_load_swfobject_lib');
	add_action('admin_menu', 'bannerrotatorxmlv4_admin_menu');
/* end hooks */

?>