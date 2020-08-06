<?php
add_filter( 'pre_get_posts', 'gs_set_posts_order' );
add_filter( 'manage_resource_posts_columns', 'gs_add_img_column' );
add_filter( 'manage_resource_posts_custom_column', 'gs_manage_img_column', 10, 2 );
add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
add_filter( 'post_class', 'gs_highlight_featured_resources', 10, 3 );
add_action( 'admin_head', 'gs_add_custom_styles' );
add_action( 'init', 'create_post_type_team' ); // create team members CPT
add_action( 'init', 'create_team_taxonomies', 0 ); // create team member taxonomy


function gs_set_posts_order( $query ) {

	if ( $query->is_admin ) {

		if ( $query->get( 'post_type' ) == 'resource' ) {
			$query->set( 'orderby', 'post_date' );
			$query->set( 'order', 'DESC' );
		}

	}
	return $query;
}
/* CPT - team */
function create_post_type_team() {
    register_post_type('team', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Team Members', 'team'), // Rename these to suit
            'singular_name' => __('Team Member', 'team'),
            'add_new' => __('Add New', 'team'),
            'add_new_item' => __('Add New Team Member', 'team'),
            'edit' => __('Edit', 'team'),
            'edit_item' => __('Edit Team Member', 'team'),
            'new_item' => __('New Team Member', 'team'),
            'view' => __('View Team Members', 'team'),
            'view_item' => __('View Team Member', 'team'),
            'search_items' => __('Search Team Members', 'team'),
            'not_found' => __('No Team Members found', 'team'),
            'not_found_in_trash' => __('No Team Members found in Trash', 'team')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes'
        ),
        'can_export' => true, // Allows export in Tools > Export
        'rewrite' => array(
            'slug' => 'team',
            'with_front' => false
        )
    ));
}

/* CPT Tax - teamcategory */
function create_team_taxonomies() {
    register_taxonomy(
        'teamcategory',
        'team',
        array(
            'labels' => array(
                'name' => 'Team Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => 'New Category',
                'search_items' => 'Search Categories',
                'not_found' => 'No Categories found'
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'show_admin_column' => true,
            'rewrite' => array(
                'slug' => 'team/category'
            )
        )
    );
}


function gs_add_img_column( $columns ) {
	$columns = array_slice( $columns, 0, 1, true ) + array( 'img' => 'Featured Image' ) + array_slice( $columns, 1, count( $columns ) - 1, true );
	return $columns;
}

function gs_manage_img_column( $column_name, $post_id ) {
	if ( $column_name == 'img' ) {
		$url = get_field( 'resource_external_url', $post_id );
		echo '<figure style="margin: 0;">';
 			echo '<a href="' . $url . '" target="_blank" style="display:inline-block;">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</a>';
			// echo '<figcaption>Click to open resource</figcaption>';
		echo '</figure>';
	}
	return $column_name;
}

function remove_row_actions( $actions ){
	if( get_post_type() === 'resources' ) {
		unset( $actions['view'] );
	}
	return $actions;
}

function gs_highlight_featured_resources( $classes, $class, $post_id ) {
	global $post;
	if ( $post->post_type == 'resource' ) {
		if ( get_field( 'resources_featured', $post_id ) ) {
			$classes[] = 'resource-featured';
		}
	}
	return $classes;
}

function gs_add_custom_styles() {
	echo '<style>tr.resource-featured td, tr.resource-featured th { background-color: rgba( 89, 219, 150, 0.5); }</style>'; // featured resource
}

?>
