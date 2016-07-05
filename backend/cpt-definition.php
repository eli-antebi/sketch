<?php
/////////////////////////////////////////////////////////////////////////////////////////////
function sketch_create_post_type()
{
	$plural = "Sketches";
	$singular = "Sketch";

	register_post_type('sketch',
		array(
			'labels' => array(
				'name' => __($plural),
				'singular_name' => __($singular),
				'add_new' => __('New ' . $singular),
				'add_new_item' => __('Add New ' . $singular),
				'edit_item' => __('Edit ' . $singular),
				'new_item' => __('New ' . $singular),
				'view_item' => __('Show  ' . $singular),
				'all_items' => __('All ' . $plural),
				'search_items' => __('Search ' . $plural),
				'menu_name' => __($plural),
				'name_admin_bar' => __($singular),
				'not_found' => __($plural . ' Not Found'),
				'not_found_in_trash' => __($plural . 'Not Found In Trash'),
				'parent_item_colon' => __('Parent ' . $singular),
				'archives' => __($plural . ' Archive'),
				'insert_into_item' => __('Add To ' . $singular),
				'uploaded_to_this_item' => __('Upload To This ' . $singular),
			),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'menu_icon' => 'dashicons-admin-appearance',
			'can_export' => true,
			'delete_with_user' => false,
			'hierarchical' => false,
			'has_archive' => true,
			//'capability_type' => 'page',
			//'map_meta_cap' => true,
			// 'capabilities' => array(),
			'query_var' => true,
			//'rewrite' => false,
			'rewrite' => array('slug' => 'sketch'),
			'supports' => array('title', 'thumbnail'),
		)
	);
}

add_action('init', 'sketch_create_post_type');