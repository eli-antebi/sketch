<?php
/////////////////////////////////////////////////////////////////////////////////////////////

function sketch_admin_columns($columns)
{
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'permalink' => 'Permalink',
		'image' => 'Image',
		'date' => 'Upload Date',
	);
	return $columns;
}

function sketch_custom_columns($column)
{
	global $post;

	switch ($column) {

		case 'permalink' :
			echo '<a href="' . get_the_permalink() . '" target="_blank">' . get_the_permalink() . '</a>';
			break;

		case 'image' :
			echo
				'<div style="position:relative">
					<a onmouseover="jQuery(this).next().show()" onmouseout="jQuery(this).next().hide()" href="' . get_the_post_thumbnail_url($post->ID, 'full') . '" target="_blank">' . get_the_post_thumbnail_url() . '</a>
					<img style="position:absolute; left:0; top:30px; display:none; width:300px; z-index:2;" src="' . get_the_post_thumbnail_url() . '" alt="" />
				</div>';
			break;

		default :
			break;
	}
}

add_filter("manage_edit-sketch_columns", "sketch_admin_columns");
add_action("manage_sketch_posts_custom_column", "sketch_custom_columns");

