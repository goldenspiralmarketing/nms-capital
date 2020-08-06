<?php
add_action( 'init', 'gs_add_excerpts_to_pages' ); // add excerpt field to page post types
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)

function gs_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}


// Custom Excerpts
function themewp_index( $length ) { // Create 20 Word Callback for Index page Excerpts, call using themewp_excerpt('themewp_index');
	return 20;
}

function themewp_custom_post( $length ) { // Create 40 Word Callback for Custom Post Excerpts, call using themewp_excerpt('themewp_custom_post');
	return 40;
}

function themewp_excerpt($length_callback = '', $more_callback = '') { // Create the Custom Excerpts callback
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}
?>
