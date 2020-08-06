<?php
add_filter( 'avatar_defaults', 'themegravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
// add_action( 'wp_enqueue_media', 'gs_wp_enqueue_media' ); // add category and tag filters to media library
// add_action( 'add_meta_boxes', 'gs_add_meta_boxes' ); // add custom meta boxes to edit.php
// add_filter( 'custom_menu_order', 'custom_menu_order' ); // Activate custom_menu_order
// add_filter( 'menu_order', 'custom_menu_order' ); // re-order admin menu
add_action( 'admin_menu', 'custom_menu_page_removing' ); // remove items from admin menu
// add_action( 'admin_init', 'remove_dashboard_meta' ); // remove dashboard meta boxes
add_filter( 'upload_mimes', 'custom_upload_mimes' );
add_filter( 'wpseo_metabox_prio', 'yoasttobottom' ); // move Yoast to the bottom of the content editors
add_action( 'admin_print_scripts', 'admin_typekit' ); // add typekit fonts to admin screens
add_action( 'admin_footer', 'gs_update_admin_styles' );

add_filter( 'manage_ctas_posts_columns', 'set_custom_edit_ctas_columns' ); // Add the custom columns to the ctas post type:
add_action( 'manage_ctas_posts_custom_column' , 'custom_ctas_columns', 10, 2 ); // Add the data to the custom columns for the ctas post type:


// wp admin customization functions
function themegravatar( $avatar_defaults ) {
	$myavatar = get_stylesheet_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}
function remove_admin_bar() {
	return false;
}

function gs_wp_enqueue_media() { // @author https://handbuilt.co/tip/add-a-custom-taxonomy-dropdown-filter-to-the-wordpress-media-library/
	// category filter
	wp_enqueue_script( 'media-library-category-taxonomy-filter', get_stylesheet_directory_uri() . '/wp_modules/media/media-category-filter.js', array( 'media-editor', 'media-views' ) );
	// Load 'terms' into a JavaScript variable that collection-filter.js has access to
	wp_localize_script( 'media-library-category-taxonomy-filter', 'MediaLibraryCategoryTaxonomyFilterData', array(
		'terms'     => get_terms( 'mediacategory', array( 'hide_empty' => false ) ),
	) );
	// tag filter
	wp_enqueue_script( 'media-library-tag-taxonomy-filter', get_stylesheet_directory_uri() . '/wp_modules/media/media-tag-filter.js', array( 'media-editor', 'media-views' ) );
	// Load 'terms' into a JavaScript variable that collection-filter.js has access to
	wp_localize_script( 'media-library-tag-taxonomy-filter', 'MediaLibraryTagTaxonomyFilterData', array(
		'terms'     => get_terms( 'mediatag', array( 'hide_empty' => false ) ),
	) );
	// Overrides code styling to accommodate for a third dropdown filter
	add_action( 'admin_footer', function(){
		?>
		<style>
		.media-modal-content .media-frame select.attachment-filters {
			max-width: -webkit-calc(33% - 12px);
			max-width: calc(33% - 12px);
		}
	</style>
	<?php
});
}
function gs_add_meta_boxes() {
	add_meta_box( 'att_thumb_display', 'Attached images', function( $post ) {
		$args = array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_parent' => $post->ID
		);

		?>
		<style>
		ul.attached_images > li {
			display: inline-block;
			width: 107px;
			height: 107px;
			vertical-align: middle;
			margin-left: 3px;
			margin-right: 3px;
			padding: 6px;
			border: solid 1px #ccc;
		}
		ul.attached_images > li > img {
			margin: auto;
			display: block;
			width: inherit;
			height: inherit;
		}
	</style>
	<?php
	echo '<ul class="attached_images">';
	foreach( get_posts( $args ) as $image) {
		echo '<li><img src="' . wp_get_attachment_thumb_url( $image->ID ) . '" /></li>';
	}
	echo '</ul>';
}, array('page', 'blog', 'post', 'resource') );
}
function custom_menu_order( $menu_ord ) {
	if (!$menu_ord) return true;

	return array(
		'index.php', // Dashboard
		'separator1', // First separator
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		// 'edit-comments.php', // Comments
		'edit.php?post_type=casestudy', // CPT Case Study
		'edit.php?post_type=resource', // CPT Resource
		'edit.php?post_type=team', // CPT Team Members
		'upload.php', // Media
		'separator2', // Second separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
function custom_menu_page_removing() {
	// remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );//since 3.8
}
function custom_upload_mimes ( $existing_mimes ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	// $existing_mimes['eps'] = 'application/postscript';
	// $existing_mimes['ttf'] = 'application/octet-stream';
	// $existing_mimes['otf'] = 'font/opentype';

	return $existing_mimes;
}
function yoasttobottom() {
  return 'low';
}

function admin_typekit( ) {
	global $pagenow;
	$arg = array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' );
	if ( ! in_array( $pagenow, $arg ))
	return;
	?>
	<script type="text/javascript">
	(function () {
		var config = {
			kitId:'zbc5ykn',
			scriptTimeout:3000
		};
		var h = document.getElementsByTagName("html")[0];
		h.className += " wf-loading";
		var t = setTimeout(function () {
			h.className = h.className.replace(/( |^)wf-loading( |$)/g, "");
			h.className += " wf-inactive"
		}, config.scriptTimeout);
		var tk = document.createElement("script");
		tk.src = '//use.typekit.net/' + config.kitId + '.js';
		tk.type = "text/javascript";
		tk.async = "true";
		tk.onload = tk.onreadystatechange = function () {
			var a = this.readyState;
			if (a && a != "complete" && a != "loaded")return;
			clearTimeout(t);
			try {
				Typekit.load(config)
			} catch (b) { } };
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(tk, s)
		})();
	</script>
	<?php
}



function gs_theme_register_post_status() {
	$gs_theme_archive_args = array(
		'label' => _x( 'Archive', 'post' ),
		'label_count' => _n_noop( 'Archive <span class="count">(%s)</span>', 'Archive <span class="count">(%s)</span>' ),
		'exclude_from_search' => false,
		'public' => false,
		'internal' => true,
		'protected' => true,
		'private' => true,
		'publicly_queryable' => false,
		'show_in_admin_status_list' => true,
		'show_in_admin_all_list' => false,
	);
	register_post_status( 'archive', $gs_theme_archive_args );
}
add_action( 'init', 'gs_theme_register_post_status' );





// // change post link to display published posts only
// function gs_change_admin_post_link() {
// 	global $submenu;
// 	$submenu['edit.php'][5][2] = 'edit.php?post_status=publish';
// }
// add_action( 'admin_menu', 'gs_change_admin_post_link' );




function put_post_in_archive() {
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'put_post_in_archive' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to archive has been supplied!');
	}

	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;


	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {

		$post->post_status = 'archive';
		wp_update_post( $post );

		wp_redirect( '/wp-admin/edit.php?post_type=post' );

		exit;
	} else {
		wp_die('Post update failed, could not find original post: ' . $post_id);
	}
}
// add_action( 'admin_action_put_post_in_archive', 'put_post_in_archive' );

function set_post_as_draft() {
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'put_post_in_archive' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to archive has been supplied!');
	}

	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;


	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {

		$post->post_status = 'draft';
		wp_update_post( $post );

		wp_redirect( '/wp-admin/edit.php?post_status=archive&post_type=post' );

		exit;
	} else {
		wp_die('Post update failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_set_post_as_draft', 'set_post_as_draft' );

function archive_post_link( $actions, $post ) {
	if ( current_user_can('edit_posts') ) {
		if ( $post->post_status === 'archive' ) {
			$actions['archive'] = '<a href="admin.php?action=set_post_as_draft&amp;post=' . $post->ID . '" title="Unarchive this item" rel="permalink">Unarchive</a>';
		} else {
			$actions['archive'] = '<a href="admin.php?action=put_post_in_archive&amp;post=' . $post->ID . '" title="Archive this item" rel="permalink">Archive</a>';
		}
	}
	return $actions;
}
// add_filter( 'post_row_actions', 'archive_post_link', 10, 2 ); // add the archive/unarchive link to action list for posts



/**
 * Remove posts, with a given status, on the edit.php (post) screen,
 * when there's no post status filter selected.
 */

 // add_action( 'posts_where', function( $where, $q ) {
	// if ( is_admin() && $q->is_main_query() && ! filter_input( INPUT_GET, 'post_status' ) && ( $screen = get_current_screen() ) instanceof \WP_Screen && 'edit-post' === $screen->id ) {
	// 	global $wpdb;
 //
	// 	$status_to_exclude = 'archive';   // Modify this to your needs!
 //
	// 	$where .= sprintf(
	// 		" AND {$wpdb->posts}.post_status NOT IN ( '%s' ) ",
	// 		$status_to_exclude
	// 	);
 //
	// }
	// return $where;
 // }, 10, 2 );


function gs_update_admin_styles(){
	?>
	<style>
		.developer-options {
			border-top: #eee solid 2px !important;
			background-color: #eee;
		}

		span.shortcode {
			display: block;
			margin: 2px 0;
		}
		span.shortcode > input {
			background: inherit;
			color: inherit;
			font-size: 12px;
			border: none;
			box-shadow: none;
			padding: 4px 8px;
			margin: 0;
		}

		.acf-field-message ul {
			list-style: disc;
			margin-bottom: 1.6rem;
			padding-left: 1.6rem;
		}
		.acf-field-message ul li pre {
			margin: 0
		}
		.acf-field-message code {
			margin-top: 1rem;
			display: inline-block;
		}
		.acf-repeater.-block>table>tbody>tr>td {
    	border-bottom-width: 10px;/* spacing between repeater items */
		}
		.highlight-input input {
			font-size:2em !important;
			min-height:2em !important;
		}
		.highlight-label > .acf-label > label {
			font-size:20px;
			min-height:20px;
		}
		.type-engine-header-base .acf-field[data-name="font_size"],
		.type-engine-header-base .acf-field[data-name="background_color"],
		.type-engine-header-base .acf-field[data-name="border_radius"],
		.type-engine-header-base .acf-field[data-name^="margin_right"],
		.type-engine-header-base .acf-field[data-name^="margin_left"],
		.type-engine-header-base .acf-field[data-name^="padding"]
		{
			opacity:0.2;
			pointer-events:none;
			/* display:none; */
		}
		.type-engine-header .acf-field:not([data-name="font_size"]):not([data-name="line_height"]):not([data-name="font_weight"]):not([data-name="margin_top"]):not([data-name="margin_bottom"])
		{
			opacity:0.2;
			pointer-events:none;
			/* display:none; */
		}
		.type-engine-navigation .acf-field[data-name="background_color"],
		.type-engine-navigation .acf-field[data-name="border_radius"]
		{
			opacity:0.2;
			pointer-events:none;
			/* display:none; */
		}
		.type-engine-inline .acf-field[data-name="background_color"],
		.type-engine-inline .acf-field[data-name="border_radius"],
		.type-engine-inline .acf-field[data-name="line_height"],
		.type-engine-inline .acf-field[data-name^="margin"],
		.type-engine-inline .acf-field[data-name^="padding"]
		{
			opacity:0.2;
			pointer-events:none;
			/* display:none; */
		}

	</style>
	<?php
}


function set_custom_edit_ctas_columns ( $columns ) {
	$new = array();
	foreach($columns as $key => $title) {
		if ( $key === 'date' ) { // Put the city column before the date column
			$new['ctas_shortcode'] = __( 'Shortcode', 'keyfactor' );
		}
		$new[$key] = $title;
	}
	return $new;
}

function custom_ctas_columns ( $column, $post_id ) {
	switch ( $column ) {

		case 'ctas_shortcode' :
			echo '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[cta id=&quot;' . $post_id . '&quot;]" class="large-text code"></span>';
			break;

	}
}
