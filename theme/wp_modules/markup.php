<?php
add_action( 'init', 'themewp_pagination' ); // Add our theme Pagination
// add_action( 'wp_print_scripts', 'theme_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'wp_enqueue_scripts', 'theme_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_enqueue_scripts', 'theme_styles' ); // Add Theme Stylesheet
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'widgets_init', 'gs_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
// add_action( 'wp_head', 'set_default_og_image', 5 ); // add a default OpenGraph image
add_action( 'wp_head', 'custom_open_graph', 9999 ); // custom OpenGraph
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'style_loader_tag', 'theme_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'wp_nav_menu_args', 'gs_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'next_post_link', 'gs_next_post_link_attributes' );
add_filter( 'previous_post_link', 'gs_previous_post_link_attributes' );
// add_filter( 'pre_get_posts', 'modified_pre_get_posts' ); // modify the main query
// add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)
// add_filter( 'excerpt_more', 'theme_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
// add_action ( 'wp_head', 'my_js_variables' ); // create global javascript variables from server code

// site/markup customization functions
function themewp_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages
	) );
}

function theme_header_scripts() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {

		$path = get_stylesheet_directory() . '/wp.js';
		wp_register_script( 'custom-js', get_stylesheet_directory_uri() . '/wp.js', array( 'wp-api' ), filemtime( $path ), true );
		wp_enqueue_script( 'custom-js' );

		$wnm_custom = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'stylesheet_directory_uri' => get_stylesheet_directory_uri()
		);
		wp_localize_script( 'custom-js', 'gs_custom_js', $wnm_custom );

	}
}

function theme_styles() {
	$path = get_stylesheet_directory() . '/fonts/fonts.css';
	if ( file_exists( $path ) ) {
		wp_register_style( 'fonts', get_stylesheet_directory_uri() . '/fonts/fonts.css', array(), filemtime( $path ), 'all' );
		wp_enqueue_style( 'fonts' );
	}

	$path = get_stylesheet_directory() . '/fonts/font-awesome/all.css';
	if ( file_exists( $path ) ) {
		wp_register_style( 'fontawesome', get_stylesheet_directory_uri() . '/fonts/font-awesome/all.css', array(), filemtime( $path ), 'all' );
		wp_enqueue_style( 'fontawesome' );
	}

	$path = get_stylesheet_directory() . '/style_gs.css';
	if ( file_exists( $path ) ) {
		wp_register_style( 'gs-style', get_stylesheet_directory_uri() . '/style_gs.css', array(), filemtime( $path ), 'all' );
		wp_enqueue_style( 'gs-style' );
	}

	$path = get_stylesheet_directory() . '/style_ie.css';
	if ( file_exists( $path ) ) {
		wp_register_style( 'ie-style', get_stylesheet_directory_uri() . '/style_ie.css', array(), filemtime( $path ), 'all' );
		wp_enqueue_style( 'ie-style' );
	}

	$path = get_stylesheet_directory() . '/style.css';
	if ( file_exists( $path ) ) {
		wp_register_style( 'theme', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( $path ), 'all' );
		wp_enqueue_style( 'theme' );
	}
}
function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
function gs_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	) );
}

// add customized opengraph implementation
function custom_open_graph() {
	global $post;

	$og_description_length = 300;

	$output = "\n";

	// title
	$og_title = esc_attr( strip_tags( stripslashes( $post->post_title ) ) );

	// description
	$og_description = trim( $post->post_excerpt ) != '' ? trim( $post->post_excerpt ) : trim( $post->post_content );
	$og_description = esc_attr( strip_tags( strip_shortcodes( stripslashes( $og_description ) ) ) );
	if ( $og_description_length )
		$og_description = substr( $og_description, 0, $og_description_length );
	if ( $og_description == '' )
		$og_description = $og_title;


	// site name
	$og_site_name = get_bloginfo( 'name' );

	// type
	$og_type = 'article';

	// url
	$og_url = get_permalink();

	// image
	$og_image = '';
	$attachment_id = get_post_thumbnail_id( $post->ID );
	if ( $attachment_id ) {
		$og_image = wp_get_attachment_url( $attachment_id );
	} else {
		$og_image = get_stylesheet_directory_uri() . '/img/client.png';
	}


	// Open Graph output
	$output .= '<meta property="og:title" content="'.trim( esc_attr( $og_title ) ).'"/>'."\n";

	$output .= '<meta property="og:description" content="'.trim( esc_attr( $og_description ) ).'"/>'."\n";

	$output .= '<meta property="og:site_name" content="'.trim( esc_attr( $og_site_name ) ).'"/>'."\n";

	$output .= '<meta property="og:type" content="'.trim( esc_attr( $og_type ) ).'"/>'."\n";

	$output .= '<meta property="og:url" content="'.trim( esc_attr( $og_url ) ).'"/>'."\n";

	if ( trim( $og_image ) != '' )
		$output .= '<meta property="og:image" content="'.trim( esc_attr( $og_image ) ).'"/>'."\n";

	// Google Plus output
	$output .= "\n";
	$output .= '<meta itemprop="name" content="'.trim( esc_attr( $og_title ) ).'"/>'."\n";

	$output .= '<meta itemprop="description" content="'.trim( esc_attr( $og_description ) ).'"/>'."\n";

	if ( trim( $og_image ) != '' )
		$output .= '<meta itemprop="image" content="'.trim( esc_attr( $og_image ) ).'"/>'."\n";

	echo $output;
}

function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > -1 ) {
			unset( $classes[$key] );
		}
		$classes[] = sanitize_html_class( basename( get_permalink( get_option( 'page_for_posts', true ) ) ) );
	} elseif (is_page()) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}
function theme_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
function gs_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}
function gs_next_post_link_attributes( $output ) {
	$code = 'class=""'; // NOTE: add custom classes here
	return str_replace( '<a href=', '<a '.$code.' href=', $output );
}
function gs_previous_post_link_attributes( $output ) {
	$code = 'class=""'; // NOTE: add custom classes here
	return str_replace( '<a href=', '<a '.$code.' href=', $output );
}
function modified_pre_get_posts( $query ) {
	if ( ! is_admin() ) {
		// on search
		if ( $query->is_search() ) {
			// if there is no post_type specified
			// if ( $query->get('post_type') == '' || $query->get('post_type') == null ) {
			// 	// set post_type to post
			// 	$query->set('post_type', 'post');
			// } elseif ( $query->get('post_type') == 'resource' ) { // if post_type is resource
			// 	// set query to not look for child pages
			// 	$query->set('post_parent', '0');
			// }
		} else {
			if ( $query->is_main_query() ) {

				// if ( $query->get( 'post_type' ) === 'resource' || $query->is_tax( 'resource_type' ) || $query->is_tax( 'resource_category' ) ) {
				// 	$query->set( 'posts_per_page', 9 );
				//
				// 	// $rq = $_REQUEST['rq'];
				// 	// if ( ! empty( $rq ) ) {
				// 	// 	$query->set( 's', $rq );
				// 	// }
				//
				// 	if ( $query->is_tax( 'resource_type' ) || $query->is_tax( 'resource_category' ) ) {
				//
				// 	} else {
				// 		$meta_query = $query->get( 'meta_query' )? : [];
				//
				// 		$meta_query[] = [
				// 			'key' => 'resources_featured',
				// 			'value' => '0',
				// 			'compare' => '='
				// 		];
				//
				// 		$query->set( 'meta_query', $meta_query );
				// 	}
				//
				// }

			}
		}
	} else {

	}
	return $query;
}

function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}
function theme_view_article( $more ) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'theme' ) . '</a>';
}
function my_js_variables(){
	?>
	<script type="text/javascript">
		var template_directory = '<?php echo get_stylesheet_directory_uri(); ?>';
	</script>
	<?php
}


class Menu_Item_With_Description extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		* Filters the arguments for a single nav menu item.
		*
		* @since 4.4.0
		*
		* @param stdClass $args  An object of wp_nav_menu() arguments.
		* @param WP_Post  $item  Menu item data object.
		* @param int      $depth Depth of menu item. Used for padding.
		*/
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		* Filters the CSS class(es) applied to a menu item's list item element.
		*
		* @since 3.0.0
		* @since 4.1.0 The `$depth` parameter was added.
		*
		* @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		* @param WP_Post  $item    The current menu item.
		* @param stdClass $args    An object of wp_nav_menu() arguments.
		* @param int      $depth   Depth of menu item. Used for padding.
		*/
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		* Filters the ID applied to a menu item's list item element.
		*
		* @since 3.0.1
		* @since 4.1.0 The `$depth` parameter was added.
		*
		* @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		* @param WP_Post  $item    The current menu item.
		* @param stdClass $args    An object of wp_nav_menu() arguments.
		* @param int      $depth   Depth of menu item. Used for padding.
		*/
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		* Filters the HTML attributes applied to a menu item's anchor element.
		*
		* @since 3.6.0
		* @since 4.1.0 The `$depth` parameter was added.
		*
		* @param array $atts {
		*     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		*
		*     @type string $title  Title attribute.
		*     @type string $target Target attribute.
		*     @type string $rel    The rel attribute.
		*     @type string $href   The href attribute.
		* }
		* @param WP_Post  $item  The current menu item.
		* @param stdClass $args  An object of wp_nav_menu() arguments.
		* @param int      $depth Depth of menu item. Used for padding.
		*/
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		* Filters a menu item's title.
		*
		* @since 4.4.0
		*
		* @param string   $title The menu item's title.
		* @param WP_Post  $item  The current menu item.
		* @param stdClass $args  An object of wp_nav_menu() arguments.
		* @param int      $depth Depth of menu item. Used for padding.
		*/
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		if ( $item->description ) {
			$item_output .= '<div class="menu-item-description">' . $item->description . '</div>';
		}
		$item_output .= $args->after;

		/**
		* Filters a menu item's starting output.
		*
		* The menu item's starting output only includes `$args->before`, the opening `<a>`,
		* the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		* no filter for modifying the opening and closing `<li>` for a menu item.
		*
		* @since 3.0.0
		*
		* @param string   $item_output The menu item's starting HTML output.
		* @param WP_Post  $item        Menu item data object.
		* @param int      $depth       Depth of menu item. Used for padding.
		* @param stdClass $args        An object of wp_nav_menu() arguments.
		*/
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}


function pagination( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class=\"pagination\">";//<span>Page " . $paged . " of " . $pages . "</span>";
		echo "<hr class=\"background-divider\" data-paged=\"" . $paged . "\" data-pages=\"" . $pages . "\" data-showitems=\"" . $showitems . "\">";

		// if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
		// 	echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo; First</a>";
		// }
		// if ( $paged > 1 && $showitems < $pages ) {
		if ( $paged > 1 ) {
			echo "<div class=\"pagination-previous\"><a href='" . get_pagenum_link( $paged - 1 ) . "'><i class=\"fa fa-arrow-left\"></i></a></div>";
		} else {
			echo "<div class=\"pagination-previous text-grayscale-gray-3\"><i class=\"fa fa-arrow-left\"></i></div>";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged+$range + 1 || $i <= $paged-$range - 1 ) || $pages <= $showitems ) ){
				echo ( $paged == $i ) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . "</a>";
			}
		}

		// if ($paged < $pages && $showitems < $pages) {
		if ( $paged < $pages ) {
			echo "<div class=\"pagination-next\"><a href=\"" . get_pagenum_link( $paged + 1 ) . "\"><i class=\"fa fa-arrow-right\"></i></a></div>";
		} else {
			echo "<div class=\"pagination-next text-grayscale-gray-3\"><i class=\"fa fa-arrow-right\"></i></div>";
		}

		// if ( ( $paged < $pages - 1 ) && ( $paged + $range - 1 < $pages ) && ( $showitems < $pages ) ) {
		// 	echo "<a href='" . get_pagenum_link( $pages ) . "'>Last &raquo;</a>";
		// }

		echo "</div>\n";
	}
}

/*
	Custom function based on wp_get_attachment_image (adds lazy loading support)
*/
function gs_get_attachment_image_attributes( $attrs, $attachment, $size ) {

	remove_filter( 'image_downsize', 'gs_image_downsize', 10, 3 );

	$image = wp_get_attachment_image_src( $attachment->ID, $size, false );
	if ( $image ) {
		list( $src, $width, $height ) = $image;

		$image_meta = wp_get_attachment_metadata( $attachment->ID );

		if ( is_array( $image_meta ) ) {
			$size_array = array( absint( $width ), absint( $height ) );
			$srcset     = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment->ID );
			$sizes      = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment->ID );

			if ( $srcset && ( $sizes || ! empty( $attrs['sizes'] ) ) ) {
				$attrs['srcset'] = $srcset;

				if ( empty( $attrs['sizes'] ) ) {
					$attrs['sizes'] = $sizes;
				}
			}
		}
	}

	add_filter( 'image_downsize', 'gs_image_downsize', 10, 3 );

	if ( array_key_exists( 'class', $attrs ) ) {
		$class_split = explode( ' ', $attrs['class'] );
		if ( in_array( 'lazy', $class_split ) ) {
			$attrs['data-src'] = $attrs['src'];
			$attrs['src'] = '';
			$attrs['data-srcset'] = $attrs['srcset'];
			$attrs['srcset'] = '';
		}
	}

	return $attrs;
}
add_filter( 'wp_get_attachment_image_attributes', 'gs_get_attachment_image_attributes', 10, 3 );

/**
 * This is a modification of image_downsize() function in wp-includes/media.php
 * we will remove all the width and height references, therefore the img tag
 * will not add width and height attributes to the image sent to the editor.
 *
 * @param bool false No height and width references.
 * @param int $id Attachment ID for image.
 * @param array|string $size Optional, default is 'medium'. Size of image, either array or string.
 * @return bool|array False on failure, array on success.
 */
function gs_image_downsize( $value = false, $id, $size ) {
	if ( ! wp_attachment_is_image( $id ) ) {
		return false;
	}

	$img_url = wp_get_attachment_url( $id );
	$is_intermediate = false;
	$img_url_basename = wp_basename( $img_url );

	// try for a new style intermediate size
	if ($intermediate = image_get_intermediate_size( $id, $size ) ) {
		$img_url = str_replace( $img_url_basename, $intermediate['file'], $img_url );
		$is_intermediate = true;
	} elseif ( $size == 'thumbnail' ) {
		// Fall back to the old thumbnail
		if ( ( $thumb_file = wp_get_attachment_thumb_file( $id ) ) && $info = getimagesize( $thumb_file ) ) {
			$img_url = str_replace( $img_url_basename, wp_basename( $thumb_file ), $img_url );
			$is_intermediate = true;
		}
	}

	// We have the actual image size, but might need to further constrain it if content_width is narrower
	if ( $img_url ) {
		return array( $img_url, 0, 0, $is_intermediate );
	} else {
		return false;
	}
}
add_filter( 'image_downsize', 'gs_image_downsize', 10, 3 );

// function remove_img_attr( $html ) {
// 	return preg_replace( '/(width|height)="\d+"\s/', "", $html );
// }
// add_filter( 'post_thumbnail_html', 'remove_img_attr' );

// retrieves the attachment ID from the file URL
function gs_get_image_id( $image_url ) {
	global $wpdb;
	$image_parts = explode( '://', $image_url );
	$prepared_statement = $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid LIKE '%s';", '%' . $image_parts[1] );
	$attachment = $wpdb->get_col( $prepared_statement );
	return $attachment[0];
}


// function wrap_embed_with_div( $html, $url, $attr ) {
// 	return '<div class="video-wrapper">' . $html . '</div>';
// }
//
// add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);

function iframe_wrapper( $content ) {
	// match any iframes
	$pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
	preg_match_all( $pattern, $content, $matches );

	foreach ( $matches[0] as $match ) {
		// wrap matched iframe with div
		$wrappedframe = '<div class="video-wrapper">' . $match . '</div>';

		//replace original iframe with new in content
		$content = str_replace( $match, $wrappedframe, $content );
	}

	return $content;
}
add_filter('the_content', 'iframe_wrapper');
add_filter('acf/format_value/type=wysiwyg', 'iframe_wrapper', 10, 1);


add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
// add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
// remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether
remove_action( 'wp_print_styles', 'print_emoji_styles' ); // remove emoji support for comments
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // remove emoji support for comments
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'wp_generator' ); // removes the “generator” meta tag from the document header
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // adds a “shortlink” into your document head that will look like http://example.com/?p=ID
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Removes a link to the next and previous post from the document header
remove_action( 'wp_head', 'rsd_link' ); // The RSD is an API to edit your blog from external services and clients
remove_action( 'wp_head', 'wlwmanifest_link' ); // removes the “wlwmanifest” link. wlwmanifest.xml is the resource file needed to enable support for Windows Live Writer
?>
