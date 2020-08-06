<?php
// if ( function_exists('register_sidebar') ) { gs_register_sidebar(); } // sidebar support
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar

function gs_register_sidebar() {
	register_sidebar(
		array(
			'name' => __( 'Left Sidebar', 'gs' ),
			'description' => __( 'This sidebar will show up in the left gutter', 'gs' ),
			'id' => 'gs_sidebar_left',
			'before_widget' => '<div id="%1$s" class="sticky %2$s">',
			'after_widget' => '</div>'
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Right Sidebar', 'gs' ),
			'description' => __( 'This sidebar will show up in the right gutter', 'gs' ),
			'id' => 'gs_sidebar_right'
		)
	);
	// Define Sidebar Widget Area 1
	// register_sidebar(array(
	// 	'name' => __( 'DO NOT USE', 'theme' ),
	// 	'description' => __( 'this is only a placeholder', 'theme' ),
	// 	'id' => 'widget-do-not-use',
	// 	'before_widget' => '<div id="%1$s" class="%2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<h3>',
	// 	'after_title' => '</h3>'
	// ));

	// Define Sidebar Widget Area 2
	// register_sidebar(array(
	// 	'name' => __('Widget Area 2', 'theme'),
	// 	'description' => __('Description for this widget-area...', 'theme'),
	// 	'id' => 'widget-area-2',
	// 	'before_widget' => '<div id="%1$s" class="%2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<h3>',
	// 	'after_title' => '</h3>'
	// ));
}
?>
