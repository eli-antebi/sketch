<?php
/*
 * Plugin Name: Sketch
 * Version: 1.0
 * Plugin URI:
 * Description: Allows you to upload images and send your client link to see them in a browser window with popular resolutions guide lines
 * Author: Eli Antebi
 * Author URI: http://eli.antebi.net/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once(plugin_dir_path(__FILE__) . 'backend/cpt-definition.php');
require_once(plugin_dir_path(__FILE__) . 'backend/admin-table.php');

add_theme_support('post-thumbnails');

function sketch_template_loader($original_template)
{
	if (get_query_var("post_type") == "sketch") {
		if (is_archive() || is_search()) {
			if (file_exists(get_stylesheet_directory() . "/archive-sketch.php")) {
				return get_stylesheet_directory() . "/archive-sketch.php";
			} else {
				return plugin_dir_path(__FILE__) . "frontend/archive-sketch.php";
			}
		} else {
			if (file_exists(get_stylesheet_directory() . "/single-sketch.php")) {
				return get_stylesheet_directory() . "/single-sketch.php";
			} else {
				return plugin_dir_path(__FILE__) . "frontend/single-sketch.php";
			}
		}
	}
	else{
		return $original_template;
	}
}

add_action("template_include", "sketch_template_loader");