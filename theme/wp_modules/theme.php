<?php
if ( function_exists('add_theme_support') ) { gs_add_theme_support(); } // theme support

function gs_add_theme_support() {
	if ( ! isset($content_width) ) {
		$content_width = 900;
	}

	add_theme_support( 'custom-logo' );

	// Add Menu Support
	add_theme_support('menus');
	register_nav_menus( array(
		'header-menu' => 'Header Menu',
		'footer-menu' => 'Footer Menu',
		'mobile-menu' => 'Mobile Menu',
	));

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('extra-large', 1600, '', false);
	add_image_size('thumbnail-square', 500, 500, true);

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Jetpack Infinite Scrolling
	// function renderFunc()
	// {
	// 	while( have_posts() ) {
	// 		the_post();
	// 		echo '<div class="col-sm-4">';
	// 		include 'blog-panel-module.php';
	// 		echo '</div>';
	// 	}
	// }
	//
	// add_theme_support( 'infinite-scroll', array(
	// 	'type'           => 'scroll',
	// 	'footer'         => false,
	// 	'footer_widgets' => false,
	// 	'container'      => 'articles',
	// 	'wrapper'        => true,
	// 	'render'         => 'renderFunc',
	// 	'posts_per_page' => 9,
	// ) );

	// Localisation Support
	load_theme_textdomain('theme', get_template_directory() . '/languages');

	// fallback shim for new wp_body_open hook added to WP 5.2
	if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
	}
}
?>
